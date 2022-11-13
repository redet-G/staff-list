<?php
//=== ALL START === Returns all record IDs, sorted. Uses include/exclude categories for subsets.  ============
//Not sored, hidden removed. Shortcode category filters implemented. Parameters = cat excluded, included.
function abcfsl_db_staff_ids_all_filtered_not_sorted( $parentID, $catsPar ) {

    $catDefaults = array(
        'scodeCat' => '',
        'scodeCatExcl' => ''
    );
    $catsPar = wp_parse_args( $catsPar, $catDefaults );
    
    $allIDs = abcfsl_db_staff_ids_not_sorted( $parentID );
    $allIDs = abcfsl_db_all_staff_ids_scode_cat_incl( $parentID, $allIDs, $catsPar['scodeCat'] );
    $allIDs = abcfsl_db_all_staff_ids_scode_cat_excl( $parentID, $allIDs, $catsPar['scodeCatExcl'] );
    return $allIDs;
}

//-- New, implemented in 3.7.1. Replaced abcfsl_db_staff_ids_sorted_scode_cat_incl_excl
//-- Called from abcfsl_db_staff_member_ids
//-- Parameters are merged into a single array.
//-- Used for all layouts and all filter options. 
//-- OUTPUT: All post IDs, sorted. 
//-- Minus category shortcode options (included/excluded).
//-- Minus hidden (or hidden only or all including hidden). hiddenRecords shordcode 
function abcfsl_db_all_staff_ids_sorted( $parentID, $allPar ) {    
    
    $allPar = abcfsl_db_all_par_fix( $parentID, $allPar );

    $allIDs = abcfsl_db_all_staff_ids_sorted_all( $parentID, $allPar );
    $allIDs = abcfsl_db_all_staff_ids_scode_cat_incl( $parentID, $allIDs, $allPar['scodeCat'] );
    $allIDs = abcfsl_db_all_staff_ids_scode_cat_excl( $parentID, $allIDs, $allPar['scodeCatExcl'] );
    return $allIDs;
}

//Fix missing values if any.
function abcfsl_db_all_par_fix( $parentID, $allPar )  {
    
    $orderDefaults = array(
        'scodeOrder' => '',
        'sortType' => '',
        'dSort' => '',
        'cSort' => '',
        'dSortOrder' => '',
        'cSortOrder' => '',
        'scodeCat' => '',
        'scodeCatExcl' => '',
        'hiddenRecords' => 0        
    );

    $allPar = wp_parse_args( $allPar, $orderDefaults );
    $sortType = $allPar['sortType']; 

    if( empty( $sortType ) ){
        $sortTypeSaved = get_post_meta( $parentID, '_sortType', true );
        if( empty( $sortTypeSaved ) ) { 
            $sortType = 'P'; 
        }
        else{
            $sortType = $sortTypeSaved;
        }
    }

    // M = Manual
    // P = Post Title
    // T = Sort Text
    switch ( $sortType ) {
        case 'P' :
        case 'T' :         
            break; 
        case 'M' :
            $sortType = 'T';
            break;                                 
        default:
            $sortType = 'P';           
            break;
    }

    $allPar['sortType'] = $sortType;
    return $allPar;
}

//====================================================================================
// OUT = IDs. Select, order and remove hidden. 
// Used by by Staff List, Staff List Search and OLD Staff Search
// Used by SLS
function abcfsl_db_all_staff_ids_sorted_all( $parentID, $allPar )  {

    // order="DESC"
    //c-sort= F4 post-title sort-text
    //d-sort= F4 post-title sort-text
    //c-sort-order="DESC" "ASC"
    //d-sort-order="DESC" "ASC"
   
    $sortType = $allPar['sortType']; 
    $scodeOrder = $allPar['scodeOrder'];  
    $cSort = $allPar['cSort'];
    $dSort = $allPar['dSort'];
    $dSortOrder = $allPar['dSortOrder'];
    $cSortOrder = $allPar['cSortOrder']; // default ASC
    $hiddenRecords = $allPar['hiddenRecords'];
    

    //---Sort order defaults -----------------------
    if( empty( $dSortOrder) ){ $dSortOrder = 'ASC'; }
    if( empty( $cSortOrder) ){ $cSortOrder = 'ASC'; }
    //-- Sort Type: M-Manual; P-Post Title; T-Sort Text; -----------
    //if( empty( $sortType ) ) { $sortType = 'P'; } 

    $sortTypeOptns = abcfsl_db_all_scode_sort_type( $scodeOrder, $cSort, $dSort );

    $scodeSortType = $sortTypeOptns['scodeSortType'];
    $scodeOrder = $sortTypeOptns['scodeOrder'];
    $cSortField = $sortTypeOptns['cSortField'];
    $cSortType = $sortTypeOptns['cSortType'];
    $dSortType = $sortTypeOptns['dSortType'];

    //--Not custom sort (template options) -----------------------------------------    
    if ( $scodeSortType == 'TP' ) {
        return abcfsl_db_staff_ids_not_custom( $parentID, $sortType, $scodeOrder, $hiddenRecords );
    }

    //-- Custom sort. By single field --------------------------------
    if ( $scodeSortType == 'CS' ) {

        if ( $cSortType == 'P' ) {
            return abcfsl_db_staff_ids_not_custom( $parentID, $cSortType, $cSortOrder, $hiddenRecords );      
        }

        if ( $cSortType == 'T' ) {
            return abcfsl_db_staff_ids_not_custom( $parentID, $cSortType, $cSortOrder, $hiddenRecords );      
        }

        //Sorted by single custom field only.
        if ( $cSortType == 'C' ) {
            $outIDs = abcfsl_db_staff_ids_custom( $parentID, $cSortField, $cSortOrder ); 
            return abcfsl_db_all_remove_hidden( $parentID, $outIDs, $hiddenRecords );           
        }
 
    }

    //-- Custom sort. Double ----------------------------------------------
    if ( $scodeSortType == 'CD' ) {

        if ( $cSortType == 'P' && $dSortType == 'T' ) {
            $outIDs = abcfsl_db_staff_ids_custom_double_P_T( $parentID, $cSortOrder, $dSortOrder );
            return abcfsl_db_all_remove_hidden( $parentID, $outIDs, $hiddenRecords );           
        }

        if ( $cSortType == 'T' && $dSortType == 'P' ) {
            $outIDs = abcfsl_db_staff_ids_custom_double_T_P( $parentID, $cSortOrder, $dSortOrder ); 
            return abcfsl_db_all_remove_hidden( $parentID, $outIDs, $hiddenRecords );          
        }

        //Sorted by custom field + Post Title or Sort Text. 
        if ( $cSortType == 'C' && $dSortType == 'P' ) {
            $outIDs = abcfsl_db_staff_ids_custom_double_C_P( $parentID, $cSortField, $cSortOrder, $dSortOrder ); 
            return abcfsl_db_all_remove_hidden( $parentID, $outIDs, $hiddenRecords );          
        }  

        if ( $cSortType == 'C' && $dSortType == 'T' ) {
            $outIDs = abcfsl_db_staff_ids_custom_double_C_T( $parentID, $cSortField, $cSortOrder, $dSortOrder ); 
            return abcfsl_db_all_remove_hidden( $parentID, $outIDs, $hiddenRecords );          
        }  
    }
}

function abcfsl_db_all_remove_hidden( $parentID, $outIDs, $hiddenRecords ) {

    //Shortcode hidden-records: 0=Not hidden; 1=All including hidden; 2=Hidden only; .
    switch ( $hiddenRecords ) {
        case 1 :
            break; 
        case 2 :
            $outIDs = abcfsl_db_all_staff_ids_only_hidden( $parentID, $outIDs );
            break;                                 
        default:
            $outIDs = abcfsl_db_all_staff_ids_not_hidden( $parentID, $outIDs );           
            break;
    }

    return $outIDs;
}

//=======================================================================
function abcfsl_db_staff_ids_not_custom( $parentID, $sortType, $scodeOrder, $hiddenRecords ) {

    $outIDs = array();

    if ( $sortType == 'T' || $sortType == 'M'  ) {
        if (  $scodeOrder == 'DESC' ){
            $outIDs = abcfsl_db_staff_ids_T_DESC( $parentID );
        }  
        else{
            $outIDs = abcfsl_db_staff_ids_T_ASC( $parentID ); 
        }     
    }

    if ( $sortType == 'P' ) {
        if (  $scodeOrder == 'DESC' ){
            $outIDs = abcfsl_db_staff_ids_P_DESC( $parentID );                
        } 
        else{
            $outIDs = abcfsl_db_staff_ids_P_ASC( $parentID ); 
        }
    }

    return abcfsl_db_all_remove_hidden( $parentID, $outIDs, $hiddenRecords );

}

function abcfsl_db_staff_ids_custom( $parentID, $cSortField, $cSortOrder ) {

    $outIDs = array();

    if (  $cSortOrder == 'DESC' ){
        $outIDs = abcfsl_db_staff_ids_C_DESC( $parentID, $cSortField );   
    }
    else{
        $outIDs = abcfsl_db_staff_ids_C_ASC( $parentID, $cSortField );
    }

    return $outIDs;
}

//Sorted by custom field (Post Title) + Sort Text.
function abcfsl_db_staff_ids_custom_double_P_T( $parentID, $cSortOrder, $dSortOrder ) {

    $outIDs = array();      
        
    if (  $cSortOrder == 'ASC' && $dSortOrder == 'ASC' ){
        $outIDs = abcfsl_db_staff_ids_P_T_ASC_ASC( $parentID );
    }
    
    if (  $cSortOrder == 'DESC' && $dSortOrder =='ASC' ){
        $outIDs = abcfsl_db_staff_ids_P_T_DESC_ASC( $parentID );
    }
    
    if (  $cSortOrder == 'ASC' && $dSortOrder =='DESC' ){
        $outIDs = abcfsl_db_staff_ids_P_T_ASC_DESC( $parentID );
    }
    
    if (  $cSortOrder == 'DESC' && $dSortOrder == 'DESC' ){
        $outIDs = abcfsl_db_staff_ids_P_T_DESC_DESC( $parentID );
    }

    return $outIDs;
}

//Sorted by custom field (Sort Text) + Post Title.
function abcfsl_db_staff_ids_custom_double_T_P( $parentID, $cSortOrder, $dSortOrder ) {

    $outIDs = array();      
        
    if (  $cSortOrder == 'ASC' && $dSortOrder == 'ASC' ){
        $outIDs = abcfsl_db_staff_ids_T_P_ASC_ASC( $parentID );
    }
    
    if (  $cSortOrder == 'DESC' && $dSortOrder =='ASC' ){
        $outIDs = abcfsl_db_staff_ids_T_P_DESC_ASC( $parentID );
    }
    
    if (  $cSortOrder == 'ASC' && $dSortOrder =='DESC' ){
        $outIDs = abcfsl_db_staff_ids_T_P_ASC_DESC( $parentID );
    }
    
    if (  $cSortOrder == 'DESC' && $dSortOrder == 'DESC' ){
        $outIDs = abcfsl_db_staff_ids_T_P_DESC_DESC( $parentID );
    }

    return $outIDs;
}

//Sorted by custom field (C) + Post Title.
function abcfsl_db_staff_ids_custom_double_C_P( $parentID, $cSortField, $cSortOrder, $dSortOrder ) {

    $outIDs = array();      
        
    if (  $cSortOrder == 'ASC' && $dSortOrder == 'ASC' ){
        $outIDs = abcfsl_db_staff_ids_C_P_ASC_ASC( $parentID, $cSortField );
    }
    
    if (  $cSortOrder == 'DESC' && $dSortOrder =='ASC' ){
        $outIDs = abcfsl_db_staff_ids_C_P_DESC_ASC( $parentID, $cSortField );
    }
    
    if (  $cSortOrder == 'ASC' && $dSortOrder =='DESC' ){
        $outIDs = abcfsl_db_staff_ids_C_P_ASC_DESC( $parentID, $cSortField );
    }
    
    if (  $cSortOrder == 'DESC' && $dSortOrder == 'DESC' ){
        $outIDs = abcfsl_db_staff_ids_C_P_DESC_DESC( $parentID, $cSortField );
    }

    return $outIDs;
}

//Sorted by custom field (C) + Sort Text.
function abcfsl_db_staff_ids_custom_double_C_T( $parentID, $cSortField, $cSortOrder, $dSortOrder ) {

    $outIDs = array();      
        
    if (  $cSortOrder == 'ASC' && $dSortOrder == 'ASC' ){
        $outIDs = abcfsl_db_staff_ids_C_T_ASC_ASC( $parentID, $cSortField );
    }
    
    if (  $cSortOrder == 'DESC' && $dSortOrder =='ASC' ){
        $outIDs = abcfsl_db_staff_ids_C_T_DESC_ASC( $parentID, $cSortField );
    }
    
    if (  $cSortOrder == 'ASC' && $dSortOrder =='DESC' ){
        $outIDs = abcfsl_db_staff_ids_C_T_ASC_DESC( $parentID, $cSortField );
    }
    
    if (  $cSortOrder == 'DESC' && $dSortOrder == 'DESC' ){
        $outIDs = abcfsl_db_staff_ids_C_T_DESC_DESC( $parentID, $cSortField );
    }

    return $outIDs;
}
//=== ALL END ==============================================


//== NOT SORTED, NO ORDER BY
function abcfsl_db_staff_ids_not_sorted( $parentID ) {
    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT ID
        FROM $wpdb->posts
        WHERE post_parent = %d
        AND post_status = 'publish'", $parentID ));      
    $outIDs = isset( $out ) ? $out : array();

    return abcfsl_db_all_staff_ids_not_hidden( $parentID, $outIDs );
}

//== ORDER BY - START =======================================

//=== NO CUSTOM - ORDER BY menu_order ===========
function abcfsl_db_staff_ids_T_ASC( $parentID ) {
    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT ID
        FROM $wpdb->posts
        WHERE post_parent = %d
        AND post_status = 'publish'
        ORDER BY menu_order ASC", $parentID ));      
    return isset( $out ) ? $out : array();
}

function abcfsl_db_staff_ids_T_DESC( $parentID ) {
    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT ID
        FROM $wpdb->posts
        WHERE post_parent = %d
        AND post_status = 'publish'
        ORDER BY menu_order DESC", $parentID ));
    return isset( $out ) ? $out : array();
}

//=== NO CUSTOM - ORDER BY post_title ==============
function abcfsl_db_staff_ids_P_ASC( $parentID ) {
    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT ID
        FROM $wpdb->posts
        WHERE post_parent = %d
        AND post_status = 'publish'
        ORDER BY post_title ASC", $parentID ));  
    
    $out = isset( $out ) ? $out : array();
    return $out;        
}


function abcfsl_db_staff_ids_P_DESC( $parentID ) {
    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT ID
        FROM $wpdb->posts
        WHERE post_parent = %d
        AND post_status = 'publish'
        ORDER BY post_title DESC", $parentID ));

    $out = isset( $out ) ? $out : array();
    return $out;
}

//=== CUSTOM - ORDER BY custom field (C) ================
function abcfsl_db_staff_ids_C_ASC( $parentID, $cSortField ) {
    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT p.ID
        FROM $wpdb->posts p
        JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
        WHERE post_parent = %d
        AND post_status = 'publish'
        AND pm.meta_key = %s
        ORDER BY pm.meta_value ASC", $parentID, $cSortField ));

    $out = isset( $out ) ? $out : array();
    return $out;
}

function abcfsl_db_staff_ids_C_DESC( $parentID, $cSortField ) {
    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT p.ID
        FROM $wpdb->posts p
        JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
        WHERE post_parent = %d
        AND post_status = 'publish'
        AND pm.meta_key = %s
        ORDER BY pm.meta_value DESC", $parentID, $cSortField ));

    $out = isset( $out ) ? $out : array();
    return $out;
}

//=== CUSTOM DOUBLE - ORDER BY post_title, menu_order ===================
function abcfsl_db_staff_ids_P_T_ASC_ASC( $parentID ) {
    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT ID
        FROM $wpdb->posts
        WHERE post_parent = %d
        AND post_status = 'publish'
        ORDER BY post_title ASC, menu_order ASC", $parentID ));  
    
    $out = isset( $out ) ? $out : array();
    return $out;        
}

function abcfsl_db_staff_ids_P_T_ASC_DESC( $parentID ) {
    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT ID
        FROM $wpdb->posts
        WHERE post_parent = %d
        AND post_status = 'publish'
        ORDER BY post_title ASC, menu_order DESC", $parentID ));  
    
    $out = isset( $out ) ? $out : array();
    return $out;        
}

function abcfsl_db_staff_ids_P_T_DESC_ASC( $parentID ) {
    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT ID
        FROM $wpdb->posts
        WHERE post_parent = %d
        AND post_status = 'publish'
        ORDER BY post_title DESC, menu_order ASC", $parentID ));  
    
    $out = isset( $out ) ? $out : array();
    return $out;        
}

function abcfsl_db_staff_ids_P_T_DESC_DESC( $parentID ) {
    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT ID
        FROM $wpdb->posts
        WHERE post_parent = %d
        AND post_status = 'publish'
        ORDER BY post_title DESC, menu_order DESC", $parentID ));  
    
    $out = isset( $out ) ? $out : array();
    return $out;        
}

//=== CUSTOM DOUBLE - ORDER BY menu_order, post_title =======
function abcfsl_db_staff_ids_T_P_ASC_ASC( $parentID ) {
    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT ID
        FROM $wpdb->posts
        WHERE post_parent = %d
        AND post_status = 'publish'
        ORDER BY menu_order ASC, post_title ASC", $parentID ));  
    
    $out = isset( $out ) ? $out : array();
    return $out;        
}

function abcfsl_db_staff_ids_T_P_ASC_DESC( $parentID ) {
    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT ID
        FROM $wpdb->posts
        WHERE post_parent = %d
        AND post_status = 'publish'
        ORDER BY menu_order ASC, post_title DESC", $parentID ));  
    
    $out = isset( $out ) ? $out : array();
    return $out;        
}

function abcfsl_db_staff_ids_T_P_DESC_ASC( $parentID ) {
    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT ID
        FROM $wpdb->posts
        WHERE post_parent = %d
        AND post_status = 'publish'
        ORDER BY menu_order DESC, post_title ASC", $parentID ));  
    
    $out = isset( $out ) ? $out : array();
    return $out;        
}

function abcfsl_db_staff_ids_T_P_DESC_DESC( $parentID ) {
    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT ID
        FROM $wpdb->posts
        WHERE post_parent = %d
        AND post_status = 'publish'
        ORDER BY menu_order DESC, post_title DESC", $parentID ));  
    
    $out = isset( $out ) ? $out : array();
    return $out;        
}

//=== CUSTOM DOUBLE - ORDER BY custom field (C) + post_title ========
function abcfsl_db_staff_ids_C_P_ASC_ASC( $parentID, $cSortField ) {
    global $wpdb;
    $out = array();

    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT p.ID
        FROM $wpdb->posts p
        JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
        WHERE post_parent = %d
        AND post_status = 'publish'
        AND pm.meta_key = %s
        ORDER BY pm.meta_value ASC, p.post_title ASC", $parentID, $cSortField ));

    $out = isset( $out ) ? $out : array();
    return $out;
}

function abcfsl_db_staff_ids_C_P_DESC_ASC( $parentID, $cSortField ) {
    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT p.ID
        FROM $wpdb->posts p
        JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
        WHERE post_parent = %d
        AND post_status = 'publish'
        AND pm.meta_key = %s
        ORDER BY pm.meta_value DESC, p.post_title ASC", $parentID, $cSortField ));
    
    $out = isset( $out ) ? $out : array();
    return $out;
}

function abcfsl_db_staff_ids_C_P_ASC_DESC( $parentID, $cSortField ) {
    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT p.ID
        FROM $wpdb->posts p
        JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
        WHERE post_parent = %d
        AND post_status = 'publish'
        AND pm.meta_key = %s
        ORDER BY pm.meta_value ASC, p.post_title DESC", $parentID, $cSortField ));

    $out = isset( $out ) ? $out : array();
    return $out;
}

function abcfsl_db_staff_ids_C_P_DESC_DESC( $parentID, $cSortField ) {
    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT p.ID
        FROM $wpdb->posts p
        JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
        WHERE post_parent = %d
        AND post_status = 'publish'
        AND pm.meta_key = %s
        ORDER BY pm.meta_value DESC, p.post_title DESC", $parentID, $cSortField ));

    $out = isset( $out ) ? $out : array();
    return $out;
}

//=== CUSTOM DOUBLE - ORDER BY custom field (C) + menu_order =================
function abcfsl_db_staff_ids_C_T_ASC_ASC( $parentID, $cSortField ) {
    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT p.ID
        FROM $wpdb->posts p
        JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
        WHERE post_parent = %d
        AND post_status = 'publish'
        AND pm.meta_key = %s
        ORDER BY pm.meta_value ASC, p.menu_order ASC", $parentID, $cSortField ));

    $out = isset( $out ) ? $out : array();
    return $out;
}

function abcfsl_db_staff_ids_C_T_DESC_ASC( $parentID, $cSortField ) {
    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT p.ID
        FROM $wpdb->posts p
        JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
        WHERE post_parent = %d
        AND post_status = 'publish'
        AND pm.meta_key = %s
        ORDER BY pm.meta_value DESC, p.menu_order ASC", $parentID, $cSortField ));
    
    $out = isset( $out ) ? $out : array();
    return $out;
}

function abcfsl_db_staff_ids_C_T_ASC_DESC( $parentID, $cSortField ) {
    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT p.ID
        FROM $wpdb->posts p
        JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
        WHERE post_parent = %d
        AND post_status = 'publish'
        AND pm.meta_key = %s
        ORDER BY pm.meta_value ASC, p.menu_order DESC", $parentID, $cSortField ));

    $out = isset( $out ) ? $out : array();
    return $out;
}

function abcfsl_db_staff_ids_C_T_DESC_DESC( $parentID, $cSortField ) {
    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
        "SELECT p.ID
        FROM $wpdb->posts p
        JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
        WHERE post_parent = %d
        AND post_status = 'publish'
        AND pm.meta_key = %s
        ORDER BY pm.meta_value DESC, p.menu_order DESC", $parentID, $cSortField ));

    $out = isset( $out ) ? $out : array();
    return $out;
}
//== ORDER BY END ===================================================

function abcfsl_db_all_staff_ids_scode_cat_incl( $parentID, $allIDs, $scodeCatIncl ) {

    if( !empty( $scodeCatIncl ) ) {
        //Staff IDs, filtered by shordcode categories. NOT sorted.
        $catsIDs = abcfsl_db_staff_ids_not_sorted_cats( $parentID, $scodeCatIncl );

        //Return only not in excluded in categories
        $allIDs = array_intersect( $allIDs, $catsIDs );
    }
    //Staff IDs, sorted.
    return $allIDs;
}

function abcfsl_db_all_staff_ids_scode_cat_excl( $parentID, $allIDs, $scodeCatExcl ) {

    if( !empty( $scodeCatExcl ) ) {
        //Staff IDs, filtered by shordcode categories. NOT sorted.
        $catsIDs = abcfsl_db_staff_ids_not_sorted_cats( $parentID, $scodeCatExcl );

        //Return only not in excluded in categories
        $allIDs = array_diff( $allIDs, $catsIDs );
    }
    //Staff IDs, sorted.
    return $allIDs;
}

//Get all not hidden-records.
// Used by SLS
function abcfsl_db_all_staff_ids_not_hidden( $parentID, $allIDs ) {

    $hiddenIDs = abcfsl_db_staff_members_hidden( $parentID );

    //Remove excluded. EXCLUDED hidden-records
    //Return an array that contains the entries from array1 that are not present in array2.
    return array_diff ( $allIDs, $hiddenIDs );
}

function abcfsl_db_all_staff_ids_only_hidden( $parentID, $allIDs ) {

    $hiddenIDs = abcfsl_db_staff_members_hidden( $parentID );

    //Return  only those elements of the array1 that are present in array2.
    return array_intersect ( $hiddenIDs, $allIDs );
}

function abcfsl_db_all_scode_sort_type( $scodeOrder, $cSort, $dSort ){

    // TP-template option, CS-custom single, CD-custom double
    $out['scodeSortType'] = '';
    $out['scodeOrder'] = '';
    $out['cSortField'] = '';
    $out['cSortType'] = '';
    $out['dSortType'] = '';

    if( empty( $scodeOrder ) ) {
        if( empty( $cSort ) ) { 
            $out['scodeSortType'] = 'TP'; 
            $out['scodeOrder'] = 'ASC';
            return $out;
        }
    }

    if( !empty( $scodeOrder ) ) {
        $out['scodeSortType'] = 'TP'; 
        $out['scodeOrder'] = $scodeOrder;
        return $out;
    }

    if( !empty( $cSort ) && empty( $dSort ) ) { 
        $out['scodeSortType'] = 'CS'; 
        $customSingle = abcfsl_db_custom_sort_single( $cSort );
        $out['cSortField'] = $customSingle['cSortField'];
        $out['cSortType'] = $customSingle['cSortType'];
        return $out;
    }

    if( empty( $cSort ) && !empty( $dSort ) ) { 
        $out['scodeSortType'] = 'TP'; 
        $out['scodeOrder'] = 'ASC';
        return $out;
    }

    if( !empty( $cSort ) && !empty( $dSort ) ) { 

        $out['scodeSortType'] = 'CD'; 

        $customSingle = abcfsl_db_custom_sort_single( $cSort );
        $out['cSortField'] = $customSingle['cSortField'];
        $out['cSortType'] = $customSingle['cSortType'];

        $customDouble = abcfsl_db_custom_sort_double( $dSort, $cSort );
        $dSortType = $customDouble['dSortType'];
        $out['dSortType'] = $dSortType;

        if ( $dSortType == '' ) {
            $out['scodeSortType'] = 'CS';
            return $out;
        }

        if ( $dSortType == $out['cSortType'] ) { 
            $out['scodeSortType'] = 'CS';
            return $out;
        }
    }

    return $out;
}

function abcfsl_db_custom_sort_single( $cSort ){

    $out['cSortField'] = '';
    $out['cSortType'] = '';

    if( empty( $cSort ) ) { return $out; }

    $cSort = strtoupper( $cSort ); 
    switch ( $cSort ) {
        case 'POST-TITLE' :
            $out['cSortType'] = 'P';
            $out['cSortField'] = 'P';            
            break;
        case 'SORT-TEXT' :
            $out['cSortType'] = 'T';
            $out['cSortField'] = 'T';
            break;                       
        default:
            $out['cSortType'] = 'C';            
            //'_txt_F1'
            $out['cSortField'] = '_txt_' . $cSort;            
            break;
    }

    return $out;
}

function abcfsl_db_custom_sort_double( $dSort, $cSort ){

    //$out['dSortField'] = '';
    $out['dSortType'] = '';

    if( empty( $cSort ) ) { return $out; }

    $dSort = strtoupper( $dSort ); 
    switch ( $dSort ) {
        case 'POST-TITLE' :
            $out['dSortType'] = 'P';
            //$out['dSortField'] = 'P';            
            break;
        case 'SORT-TEXT' :
            $out['dSortType'] = 'T';
            //$out['dSortField'] = 'T';
            break;                       
    }

    return $out;
}
//=== USED BY OTHER PLUGINS START ==================================

// Old name. Used by other plugins.
function abcfsl_db_staff_members_not_hidden( $parentID, $postIDs ) {
    return abcfsl_db_all_staff_ids_not_hidden( $parentID, $postIDs );
}

function abcfsl_db_staff_ids_sorted_all( $parentID, $allPar ){
    return abcfsl_db_all_staff_ids_sorted_all( $parentID, $allPar );
}

//-- All post IDs, sorted. Minus category shortcode options (included/excluded). Minus hidden. 
//-- Used by SLT
//-- In SL replaced by abcfsl_db_all_staff_ids_sorted 
function abcfsl_db_staff_ids_sorted_scode_cat_incl_excl( $parentID, $scodeCatIncl, $scodeCatExcl, $orderPar ) {

    $orderPar = abcfsl_db_all_par_fix( $parentID, $orderPar );

    $allIDs = abcfsl_db_all_staff_ids_sorted_all( $parentID, $orderPar );
    $allIDs = abcfsl_db_all_staff_ids_scode_cat_incl( $parentID, $allIDs, $scodeCatIncl );
    $allIDs = abcfsl_db_all_staff_ids_scode_cat_excl( $parentID, $allIDs, $scodeCatExcl );
    return $allIDs;
}

function abcfsl_db_staff_ids_scode_cat_incl( $parentID, $allIDs, $scodeCatIncl ) {

    return abcfsl_db_all_staff_ids_scode_cat_incl( $parentID, $allIDs, $scodeCatIncl );
}

function abcfsl_db_staff_ids_scode_cat_excl( $parentID, $allIDs, $scodeCatExcl ) {
  
    return abcfsl_db_all_staff_ids_scode_cat_excl( $parentID, $allIDs, $scodeCatExcl );
}

//=== USED BY OTHER PLUGINS END ==================================

//###############################################################
// function abcfsl_db_staff_ids_sorted_all_OLD( $parentID, $orderPar )  {

//     // order="DESC"
//     //c-sort= F4 post-title sort-text
//     //d-sort= F4 post-title sort-text
//     //c-sort-order="DESC" "ASC"
//     //d-sort-order="DESC" "ASC"

//     $orderPar = abcfsl_db_order_par_fix( $parentID, $orderPar );
   
//     $sortType = $orderPar['sortType']; 
//     $scodeOrder = $orderPar['scodeOrder'];  
//     $cSort = $orderPar['cSort'];
//     $dSort = $orderPar['dSort'];
//     $dSortOrder = $orderPar['dSortOrder'];
//     $cSortOrder = $orderPar['cSortOrder']; // default ASC

//     //---Sort order defaults -----------------------
//     if( empty( $dSortOrder) ){ $dSortOrder = 'ASC'; }
//     if( empty( $cSortOrder) ){ $cSortOrder = 'ASC'; }
//     //-- Sort Type: M-Manual; P-Post Title; T-Sort Text; -----------
//     if( empty( $sortType ) ) { $sortType = 'P'; } 

//     $sortTypeOptns = abcfsl_db_all_scode_sort_type( $scodeOrder, $cSort, $dSort );

//     $scodeSortType = $sortTypeOptns['scodeSortType'];
//     $scodeOrder = $sortTypeOptns['scodeOrder'];
//     $cSortField = $sortTypeOptns['cSortField'];
//     $cSortType = $sortTypeOptns['cSortType'];
//     $dSortType = $sortTypeOptns['dSortType'];

//     //--Not custom sort -----------------------------------------    
//     if ( $scodeSortType == 'TP' ) {
//         return abcfsl_db_staff_ids_not_custom( $parentID, $sortType, $scodeOrder );
//     }

//     //-- Custom sort. Single  --------------------------------
//     if ( $scodeSortType == 'CS' ) {

//         if ( $cSortType == 'P' ) {
//             return abcfsl_db_staff_ids_not_custom( $parentID, $cSortType, $cSortOrder );           
//         }

//         if ( $cSortType == 'T' ) {
//             return abcfsl_db_staff_ids_not_custom( $parentID, $cSortType, $cSortOrder );           
//         }

//         //Sorted by custom field only.
//         if ( $cSortType == 'C' ) {
//             return abcfsl_db_staff_ids_custom( $parentID, $cSortField, $cSortOrder );           
//         }
 
//     }

//     //-- Custom sort. Double ----------------------------------------------
//     if ( $scodeSortType == 'CD' ) {

//         if ( $cSortType == 'P' && $dSortType == 'T' ) {
//             return abcfsl_db_staff_ids_custom_double_P_T( $parentID, $cSortOrder, $dSortOrder );           
//         }

//         if ( $cSortType == 'T' && $dSortType == 'P' ) {
//             return abcfsl_db_staff_ids_custom_double_T_P( $parentID, $cSortOrder, $dSortOrder );           
//         }

//         //Sorted by custom field + Post Title or Sort Text. 
//         if ( $cSortType == 'C' && $dSortType == 'P' ) {
//             return abcfsl_db_staff_ids_custom_double_C_P( $parentID, $cSortField, $cSortOrder, $dSortOrder );           
//         }  

//         if ( $cSortType == 'C' && $dSortType == 'T' ) {
//             return abcfsl_db_staff_ids_custom_double_C_T( $parentID, $cSortField, $cSortOrder, $dSortOrder );           
//         }  
//     }
// }

//Fix missing values if any.
// function abcfsl_db_order_par_fix( $parentID, $orderPar )  {
    
//     $orderDefaults = array(
//         'scodeOrder' => '',
//         'sortType' => '',
//         'dSort' => '',
//         'cSort' => '',
//         'dSortOrder' => '',
//         'cSortOrder' => '',
//         'scodeCat' => '',
//         'scodeCatExcl' => '',
//         'hiddenRecords' => 0
//     );

//     $orderPar = wp_parse_args( $orderPar, $orderDefaults );
//     $sortType = $orderPar['sortType']; 

//     //Fix for abcfsls_db_staff_ids_no_menu. Used by abcfsls_db_mf_MFP_NEW
//     //if( $orderPar['dSortOrder'] == '' && $orderPar['scodeOrder'] != '' ) { $orderPar['dSortOrder'] = $orderPar['scodeOrder']; }

//     if( empty( $sortType ) ){
//         $sortTypeSaved = get_post_meta( $parentID, '_sortType', true );
//         if( empty( $sortTypeSaved ) ) { 
//             $sortType = 'P'; 
//         }
//         else{
//             $sortType = $sortTypeSaved;
//         }
//     }

//     // M = Manual
//     // P = Post Title
//     // T = Sort Text
//     switch ( $sortType ) {
//         case 'P' :
//         case 'T' :         
//             break; 
//         case 'M' :
//             $sortType = 'T';
//             break;                                 
//         default:
//             $sortType = 'P';           
//             break;
//     }

//     $orderPar['sortType'] = $sortType;

//     return $orderPar;
// }