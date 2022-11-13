<?php
//var_dump( $wpdb->last_query ); die;
function abcfsl_dba_chidren_qty( $parentID ) {
    global $wpdb;
    return  $wpdb->get_var( $wpdb->prepare(
            "SELECT COUNT(1) FROM $wpdb->posts WHERE post_parent = %d AND post_type = 'cpt_staff_lst_item' AND post_status != 'trash'", $parentID ) );
}

function abcfsl_dba_duplicate_post_meta( $postID, $newPostID ) {
    //duplicate all post meta just in two SQL queries
    global $wpdb;
    $postMetaInfo = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id= $postID");

    if ( count($postMetaInfo)!= 0 ) {
           $sqlQuery = "INSERT $wpdb->postmeta ( post_id, meta_key, meta_value ) ";
           foreach ($postMetaInfo as $metaInfo) {
                   $metaKey = $metaInfo->meta_key;
                   $metaValue = addslashes($metaInfo->meta_value);
                   $sqlQquerySel[]= "SELECT $newPostID, '$metaKey', '$metaValue'";
           }
           $sqlQuery.= implode(" UNION ALL ", $sqlQquerySel);
           $wpdb->query($sqlQuery);
   }
}

function abcfsl_dba_max_custom_post_id() {
    global $wpdb;
    return  $wpdb->get_var( "SELECT MAX(ID) FROM $wpdb->posts" );
}

function abcfsl_dba_cbo_tplates( $defaultTxt = ' - - - ' ) {
    global $wpdb;
    $cps = array();
    $cps[0] = $defaultTxt;
    $dbRows = $wpdb->get_results( "SELECT ID, post_title FROM $wpdb->posts
        WHERE post_type = 'cpt_staff_lst' AND post_status = 'publish'
        ORDER BY post_title" );
    if ($dbRows) { foreach ($dbRows as $row) {$cps[$row->ID] = $row->post_title;} }
    return $cps;
}

function abcfsl_dba_items_for_order($parentID) {
    global $wpdb;
    $dbRows = $wpdb->get_results( $wpdb->prepare(
    "SELECT ID, post_title, menu_order
    FROM $wpdb->posts
    WHERE post_parent = %d
    AND post_status = 'publish'
    ORDER BY menu_order ASC", $parentID ), OBJECT_K );
    return $dbRows;
}

function abcfsl_dba_get_post_children_ids($parentID) {
    global $wpdb;
    $postIDs = $wpdb->get_col( $wpdb->prepare(
    "SELECT ID
    FROM $wpdb->posts
    WHERE post_parent = %d
    AND post_status = 'publish'", $parentID ));
    return $postIDs;
}

//=== SORT ORDER UPDATE - START ================================
function abcfsl_dba_get_version() {  
    global $wpdb;
    return $wpdb->get_var("SELECT VERSION();"); 
}

function abcfsl_dba_update_menu_order( $parentID, $sortType ) {

    if( $sortType != 'T' ){ return; } 
    //-------------------------------------------   
    $dbVersion = abcfsl_dba_get_version();

    if( empty( $dbVersion ) ) {
        global $wpdb;
        if ( empty( $wpdb->use_mysqli ) ) {
            $dbVersion = mysql_get_server_info();
        } else {
            $dbVersion = mysqli_get_server_info( $wpdb->dbh );
        }
    }

    //$dbVersion = '5.7.27';
    //$dbVersion = '10.0.38-MariaDB-cll-lve'; 8.0.18-0ubuntu0.19.10.1; 5.5.5-10.4.11-MariaDB
    //ROW_NUMBER. MySQL since version 8.0. MariaDB 10.2.0 and above.
    $hasRowNumber = abcfsl_dba_has_row_number( $dbVersion );
    abcfsl_dba_update_menu_order_sort_txt( $parentID, $hasRowNumber);
}

function abcfsl_dba_update_menu_order_sort_txt( $parentID, $hasRowNumber) {

    //mySQL 8 and above, MariaDB 12.0 and above. ROW_NUMBER
    if( $hasRowNumber ) {        
        abcfsl_dba_update_menu_order_sort_txt_row_number( $parentID );
        return;
    }

    //No ROW_NUMBER. Seems OK with MySQL up to 8.0.12 and MARIA 10.0
    abcfsl_dba_update_menu_order_sort_txt_no_row_number( $parentID );
}

function abcfsl_dba_update_menu_order_post_title_row_number( $parentID ) {

    global $wpdb;
    $result = $wpdb->query("UPDATE $wpdb->posts u
        JOIN (SELECT  
        ROW_NUMBER() OVER ( ORDER BY p.post_title ASC ) MenuOrder,
        p.ID,
        p.post_title,
        p.menu_order
        FROM $wpdb->posts p
        WHERE p.post_parent = $parentID
        AND  p.post_status = 'publish') de ON u.ID = de.ID
        SET u.menu_order = de.MenuOrder;");
}

//No ROW_NUMBER. Seems OK with MySQL up to 8.0.12 and MARIA 10.0
function abcfsl_dba_update_menu_order_post_title_no_row_number( $parentID ) {

    global $wpdb;
    $result = $wpdb->query("UPDATE $wpdb->posts u
        JOIN (SELECT @row := @row + 1 as MenuOrder, pd.ID
        FROM (SELECT p.ID
        FROM $wpdb->posts p
        WHERE p.post_parent = $parentID
        AND post_status = 'publish'
        ORDER BY p.post_title ASC) pd, (SELECT @row := 0) d) d2
        ON u.ID = d2.ID
        SET u.menu_order = d2.MenuOrder;");
}

function abcfsl_dba_update_menu_order_sort_txt_row_number( $parentID ) {

    global $wpdb;
    $result = $wpdb->query("UPDATE $wpdb->posts u
    JOIN (SELECT ROW_NUMBER() 
    OVER ( ORDER BY pm.meta_value ASC ) MenuOrder, p.ID
    FROM $wpdb->posts p
    JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
    WHERE p.post_parent = $parentID
    AND post_status = 'publish'
    AND pm.meta_key = '_sortTxt') de ON u.ID = de.ID
    SET u.menu_order = de.MenuOrder;");
}

//Original, old version. Seems OK. 
function abcfsl_dba_update_menu_order_sort_txt_no_row_number( $parentID ) {

    global $wpdb;
    $result = $wpdb->query("UPDATE $wpdb->posts u
        JOIN (SELECT @row := @row + 1 as MenuOrder, pd.ID
        FROM (SELECT p.ID
        FROM $wpdb->posts p
        JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
        WHERE p.post_parent = $parentID
        AND post_status = 'publish'
        AND pm.meta_key = '_sortTxt'
        ORDER BY pm.meta_value ASC) pd, (SELECT @row := 0) d) d2
        ON u.ID = d2.ID
        SET u.menu_order = d2.MenuOrder;");
}

//Not used. Works with MARIA 10.0. Reverse sort order on MySQL 8.
function abcfsl_dba_update_menu_order_sort_txt_maria( $parentID ) {

    global $wpdb;
    $result = $wpdb->query("UPDATE $wpdb->posts u
    JOIN (SELECT (@row_number:=@row_number + 1) AS MenuOrder, pd.ID
    FROM ( SELECT p.ID, pm.meta_value
    FROM $wpdb->posts p
    JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
    WHERE p.post_parent = $parentID
    AND p.post_status = 'publish'
    AND pm.meta_key = '_sortTxt') pd, (SELECT @row_number:= 0) rn ORDER BY pd.meta_value ASC) de ON u.ID = de.ID
    SET u.menu_order = de.MenuOrder;");
}

function abcfsl_dba_has_row_number( $dbVersion ) {

    $hasRowNumber = false;
    $isMaria = false;
    $isMaria = abcfsl_dba_is_maria( $dbVersion );

    if( $isMaria ){
        $hasRowNumber = abcfsl_dba_maria_has_row_number( $dbVersion );
        return $hasRowNumber;
    }

    $hasRowNumber = abcfsl_dba_mysql_has_row_number( $dbVersion );
    return $hasRowNumber;
}

function abcfsl_dba_is_maria( $dbVersion ) {

    //MySQL-Version: 10.1.44-MariaDB
    //10.0.38-MariaDB-cll-lve
    //5.5.5-10.4.11-MariaDB
    if( strpos( $dbVersion, 'MariaDB' ) !== false ){ return true; }    
    return false;
}

function abcfsl_dba_maria_has_row_number( $dbVersion ) {

    $out = false;
    if( strlen( $dbVersion ) < 14 ) { return false; }
    
    $version = substr( $dbVersion, 0, 4 );
    switch ( $version ) {
        case '10.2':
            $out = true;
            break;
        case '10.3':
            $out = true;
            break;
        case '10.4':
            $out = true;
            break;
        case '10.5':
            $out = true;
            break;
        case '10.6':
            $out = true;
            break;
        case '10.7':
            $out = true;
            break;
        default:
            break;
    }
    return $out;
}

function abcfsl_dba_mysql_has_row_number( $dbVersion ) {

    $out = false;
    if( strlen( $dbVersion ) < 3 ) { return $out; }

    $version = substr( $dbVersion, 0, 2 );
    if( $version == '8.' ) { $out = true; }

    return $out;
}

//Not used now. Keep as an option if required for MARIA 10.0. 
function abcfsl_dba_update_menu_order_sort_txt_OK( $parentID, $dbVersion, $hasRowNumber) {

    //mySQL 8 and above, MariaDB 12.0 and above. ROW_NUMBER
    if( $hasRowNumber ) {        
        abcfsl_dba_update_menu_order_sort_txt_row_number( $parentID );
        return;
    }

    //Maria with no ROW_NUMBER.
    $isMaria = abcfsl_dba_is_maria( $dbVersion );
    if( $isMaria ) { 

        //No ROW_NUMBER. Seems with MARIA 10.0
        abcfsl_dba_update_menu_order_sort_txt_no_row_number( $parentID );

        //Not implemented. Works on MARIA 10.0. Reverse sort order on MySQL 8.
        //abcfsl_dba_update_menu_order_sort_txt_maria( $parentID );
        return;
    }
    
    //No ROW_NUMBER. Seems OK with MySQL up to 8.0.12 
    abcfsl_dba_update_menu_order_sort_txt_no_row_number( $parentID );

    return;
}
//=== SORT ORDER UPDATE END ================================

function abcfsl_dba_update_menu_order_DISCONTINUED( $parentID, $sortType ) {

    global $wpdb;

    //$wpdb->db_version(); 10.0.38 (only for Maria)
    $dbVersion = '';
    if ( empty( $wpdb->use_mysqli ) ) {
        $dbVersion = mysql_get_server_info();
    } else {
        $dbVersion = mysqli_get_server_info( $wpdb->dbh );
    }

    //$dbVersion = '5.7.27';
    //$dbVersion = '10.0.38-MariaDB-cll-lve'; 8.0.18-0ubuntu0.19.10.1
    //ROW_NUMBER. MySQL since version 8.0. MariaDB 10.2.0 and above.
    $hasRowNumber = abcfsl_dba_has_row_number( $dbVersion );

    switch ( $sortType ) {
        case 'T':
            abcfsl_dba_update_menu_order_sort_txt( $parentID, $hasRowNumber);
            break; 
        case 'P':
            abcfsl_dba_update_menu_order_post_title( $parentID, $hasRowNumber);
            break;                       
        default:
            break;
    }
}

//Discontinued. Post title is queried directly.
function abcfsl_dba_update_menu_order_post_title_DISCONTINUED( $parentID, $hasRowNumber) {

    //Discontinued
    return;

    if( $hasRowNumber ) {        
        abcfsl_dba_update_menu_order_post_title_row_number( $parentID );
        return;
    }

    //No ROW_NUMBER. Seems OK with MySQL up to 8.0.12 and MARIA 10.0
    abcfsl_dba_update_menu_order_post_title_no_row_number( $parentID );
}
