<?php
//var_dump( $wpdb->last_query );

//Called from: abcfsl_paginator_post_ids. Used for all layouts and all filter options. Returns array of postIDs filtered and sorted.
function abcfsl_db_staff_member_ids( $optns, $menu, $filters ){

    //Filters are populated with no Ajax ?????????
    $optns['filtersEmpty'] = abcfsl_cnt_filters_empty( $filters );
    $parentID = $optns['parentID'];
    $scodeCat = $optns['scodeCat'];
    $scodeCatIncl = $optns['scodeCat'];
    $scodeCatExcl = $optns['scodeCatExcl'];
    $scodeOrder = $optns['scodeOrder'];

    $menuType = $menu['menuType'];
    $filterField = $menu['filterField'];
    $qryFilter = $menu['qryFilter'];
    $first = $menu['first'];
    //------------------------------------
    $outIDs = array();
    //----------------------------------------
    $allPar['scodeOrder'] = $optns['scodeOrder'];
    $allPar['sortType'] = $optns['sortType'];
    $allPar['dSort'] = $optns['dSort'];
    $allPar['dSortOrder'] = $optns['dSortOrder'];
    $allPar['cSort'] = $optns['cSort'];
    $allPar['cSortOrder'] = $optns['cSortOrder'];
    $allPar['scodeCat'] = $optns['scodeCat'];
    $allPar['scodeCatExcl'] = $optns['scodeCatExcl'];
    $allPar['hiddenFields'] = $optns['hiddenFields'];
    $allPar['hiddenRecords'] = $optns['hiddenRecords'];
    $allPar['privateFields'] = $optns['privateFields'];
    
    //-- All post IDs, sorted, shordcode options implemented. Isotope doesn't use filters or first. For Isotope return all postIDs.
    $postIDs = abcfsl_db_all_staff_ids_sorted( $parentID, $allPar );
    //---------------------------------------
    
    switch ( $menuType ) {
        case 'CAT':   
            $outIDs = abcfsl_db_staff_ids_menu_cat( $parentID, $postIDs, $qryFilter, $first );
            break;
        case 'AZM':
            $outIDs = abcfsl_db_staff_ids_menu_az( $parentID, $filterField, $postIDs, $qryFilter, $first );
            break;
        case 'MTF':   
            $outIDs = abcfsl_db_staff_ids_MTF( $parentID, $postIDs, $optns, $menu, $filters );
            break;
        case 'MFP': 
            $outIDs = abcfsl_db_staff_ids_MFP( $parentID, $postIDs, $optns, $menu, $filters );
            break;
        case 'CATI':
        case 'MTFI':    
            $outIDs = $postIDs;
            break;            
        default:
            $outIDs = $postIDs;
            break;
    }
    return $outIDs;
}

function abcfsl_db_staff_ids_MFP( $parentID, $postIDs, $optns, $menu, $filters ) {

    $outIDs = array();

    //Added in SLS 1.1.2
    if ( function_exists( 'abcfsls_db_ids_MFP' ) ){
        $filtersEmpty = $optns['filtersEmpty'];
        $outIDs = abcfsls_db_ids_MFP( $parentID, $postIDs, $filtersEmpty, $menu, $filters );
        return $outIDs;
    }

    // Used only by discontinued Staff Search
    if ( function_exists( 'abcfsls_db_mf_MFP_NEW' ) ){
        //Calls: abcfsl_db_staff_members_not_hidden , abcfsl_db_staff_ids_no_menu , abcfsl_db_staff_ids_sorted_all_or_cat  
        $orderPar=''; 
        $scodeOrder = $optns['scodeOrder'];  
        $scodeCatIncl = $optns['scodeCat'];  
        return abcfsls_db_mf_MFP_NEW( $parentID, $scodeCatIncl, $scodeOrder, $optns, $menu, $filters, $orderPar );
    }

    return $outIDs;      
}

//== CATEGORIES MENU START ================================
function abcfsl_db_staff_ids_menu_cat( $parentID, $postIDs, $qryFilter, $first ) {

    if( empty( $qryFilter ) ) { $qryFilter = $first; }
    //Menu ALL selected
    if( empty( $qryFilter ) ) { return $postIDs; }
    if( $qryFilter == '*' ) {  return $postIDs; }    

    $catsIDs = abcfsl_db_staff_ids_not_sorted_cats( $parentID, $qryFilter );
    return array_intersect( $postIDs, $catsIDs );
}

//Staff IDs. Filtered by category or categories. category="slug1,slug2,slug3,"
// Used by SLS
function abcfsl_db_staff_ids_not_sorted_cats( $parentID, $scodeCat ) {

    if( empty( $scodeCat ) ) { return array(); }

    $scodeCat = str_replace(' ', '', $scodeCat);
    $scodeCat = rtrim(trim($scodeCat), ',');

    //Single category
    if( strpos($scodeCat, ',') === false ){
        return abcfsl_db_staff_ids_not_sorted_cat( $parentID, $scodeCat );
    }

    $catIDs = array();
    $uniqueIDs = array();
    $cats = explode( ',', $scodeCat );

    foreach ( $cats as $catValue ) {
        $catIDs = abcfsl_db_staff_ids_not_sorted_cat( $parentID, $catValue );

        //Remove duplicate values (staff IDs) from an array
        $uniqueIDs = array_unique (array_merge ($uniqueIDs, $catIDs));
    }

    return $uniqueIDs;
}
//== CATEGORIES MENU END =========================

//== AZ MENU START ================================
function abcfsl_db_staff_ids_menu_az( $parentID, $filterField, $postIDs, $qryFilter, $first ) {

    if( empty( $qryFilter ) ) { $qryFilter = $first; }
    //Menu ALL selected
    if( empty( $qryFilter ) ) { return $postIDs; }
    if( $qryFilter == '*' ) {  return $postIDs; }

    $azIDs = abcfsl_db_staff_ids_not_sorted_az( $parentID, $filterField, $qryFilter );
    $outIDs = array_intersect( $postIDs, $azIDs );

    return $outIDs;
}
//== AZ MENU END ================================

//== MULTIFILTER START ===========================
//Menu type: MTF.  Multi filter output.
function abcfsl_db_staff_ids_MTF( $parentID, $postIDs, $optns, $menu, $filters ) {

    $totalQty = count( $postIDs );
    if( $totalQty == 0 ) { return array(); }
    //-------------------------------------------
    if( $optns['filtersEmpty'] ) { return $postIDs; }

    //-------------------------------------------
    $filter1Value = $filters[1];
    $filter2Value = $filters[2];

    $filter1Type = $menu['filter1Type'];
    $filter2Type = $menu['filter2Type'];

    $filter1Field = $menu['filter1Field'];
    $filter2Field = $menu['filter2Field'];

    //---------------------------------
    $minLen = 3;
    $runF1 = abcfsl_db_mf_run( $parentID, $filter1Type, $filter1Value, $filter1Field, $postIDs, $minLen  );
    if( $runF1['qty'] == 0 ) { return array(); }

    $runF2 = abcfsl_db_mf_run( $parentID, $filter2Type, $filter2Value, $filter2Field, $runF1['postIDs'], $minLen );
    if( $runF2['qty'] == 0 ) { return array(); }

    $postIDsOut = array_intersect( $postIDs, $runF2['postIDs'] );

    return $postIDsOut;
}

// SLT
function abcfsl_db_mf_run( $parentID, $filterType, $filterValue, $filterField, $postIDsIn, $minLen ) {

    //$postIDsIn = all records from the last query.
    //$filterValue = filter to run.
    //Filter value empty = return all records from the last query.
    //Filter not empty = run query.
    //Return only matching records from last query and query in. Dicard others.

    $out['postIDs'] = $postIDsIn;
    $out['qty'] = count( $postIDsIn );

    if( $filterValue == '*') { $filterValue = ''; }
    if( !empty( $filterValue ) ){

        $postIDs = abcfsl_db_mf_run_filter_type( $parentID, $filterType, $filterValue, $filterField, $minLen );
        $postIDsOut = array_intersect( $postIDsIn, $postIDs );
        $out['postIDs'] = $postIDsOut;
        $out['qty'] = count( $postIDsOut );
    }
    return $out;
}

// Called from abcfsls_db_mf_MFP_NEW Check when is used??? USED ALSO BY OLD STAFF SEARCH ????????????????????????
// Used by SLS
function abcfsl_db_mf_run_filter_type( $parentID, $filterType, $filterValue, $filterField, $minLen ) {

    $postIDs = array();

    switch ( $filterType ) {
        case 'C' :
            $postIDs = abcfsl_db_staff_ids_not_sorted_cat( $parentID, $filterValue );
            break;
        case 'AZ' :
            $postIDs = abcfsl_db_staff_ids_not_sorted_az( $parentID, $filterField, $filterValue );
            break;
        case 'TXT' :
            $postIDs = abcfsls_db_mf_txt( $parentID, $filterField, $filterValue, $minLen );
            break;
        case 'TXTM' :
            $postIDs = abcfsls_db_mf_txt_m( $parentID, $filterField, $filterValue, $minLen );
            break;
        case 'DROP':
            $postIDs = abcfsls_db_mf_drop_not_sorted( $parentID, $filterField, $filterValue );
            break;
       default:
            break;
    }

    return $postIDs;
}
//== MULTIFILTER END ===========================

function abcfsl_db_staff_ids_not_sorted_az( $parentID, $filterField, $qryFilter ) {

    //qryFilter= 1 Letter; filterField = meta_key

    if( $filterField == '_sortTxtST' ){ $filterField = '_sortTxt'; }
    if( $filterField == 'postTitlePT' ){ $filterField = 'postTitle'; }

    global $wpdb;
    $out =array();

    if( $filterField == 'postTitle' ) {
        $out = $wpdb->get_col( $wpdb->prepare(
            "SELECT p.ID
            FROM $wpdb->posts p 
            WHERE p.post_parent = %d
            AND p.post_status = 'publish'
            AND LEFT( p.post_title, 1 ) = %s;", $parentID, $qryFilter ));    
    }
    else {
        $out = $wpdb->get_col( $wpdb->prepare(
            "SELECT pm.post_id
            FROM $wpdb->postmeta pm
            JOIN $wpdb->posts p ON pm.post_id =  p.ID
            WHERE p.post_parent = %d
            AND p.post_status = 'publish'
            AND pm.meta_key = %s
            AND LEFT( pm.meta_value, 1 ) = %s;", $parentID, $filterField, $qryFilter ));
    }

    return isset( $out ) ? $out : array();
}

//Shortcode option: category. Select records from single category.
function abcfsl_db_staff_ids_not_sorted_cat( $parentID, $filterValue ) {

    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
            "SELECT p.ID
            FROM $wpdb->term_relationships tr
            JOIN $wpdb->posts p ON tr.object_id = p.ID
            JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
            JOIN $wpdb->terms t ON tt.term_id = t.term_id
            WHERE p.post_parent = %d
            AND t.slug = %s
            AND p.post_status = 'publish'", $parentID, $filterValue ));

    return isset( $out ) ? $out : array();
}

function abcfsl_db_image_meta( $postID ) {
    global $wpdb;
    $meta = $wpdb->get_col(
    "SELECT meta_value
    FROM $wpdb->postmeta
    WHERE post_id = ' . $postID .
    ' AND meta_key = '_wp_attachment_metadata'");
    return $meta;
}

//-- PRETTY -----------------------------------------
function abcfsl_db_staff_id_by_tplate_and_pretty( $tplateID, $prettyName ) {

    if( empty( $prettyName ) ) { return 0; }

    global $wpdb;
    $postID = $wpdb->get_var( $wpdb->prepare(
        "SELECT pm.post_id
        FROM $wpdb->postmeta pm
        JOIN $wpdb->posts p ON  pm.post_id = p.ID
        WHERE p.post_parent = %d
        AND p.post_status = 'publish'
        AND pm.meta_key = '_pretty'
        AND pm.meta_value = %s;", $tplateID, $prettyName ) );

    if( is_null($postID) ) { return 0; }
    return $postID;
}


//Get staffMemberID by pretty when rewrite is implemented. 
//Fix for single page - the same name in different template. The same name but different staff ID.
function abcfsl_db_post_id_by_pretty( $tplateID, $staffName, $multi='' ) {

    if( empty( $staffName ) ) { return 0; }

    $postID = null;
    global $wpdb;

    if( empty( $multi ) ){
        $postID = $wpdb->get_var( $wpdb->prepare(
            "SELECT pm.post_id
            FROM $wpdb->postmeta pm
            JOIN $wpdb->posts p ON  pm.post_id = p.ID
            WHERE p.post_parent = %d
            AND p.post_status = 'publish'
            AND pm.meta_key = '_pretty'
            AND pm.meta_value = %s;", $tplateID, $staffName ) );
    }
    else{
        $postID = $wpdb->get_var( $wpdb->prepare(
            "SELECT pm.post_id
            FROM $wpdb->postmeta pm
            JOIN $wpdb->posts p ON  pm.post_id = p.ID
            WHERE p.post_status = 'publish'
            AND pm.meta_key = '_pretty'
            AND pm.meta_value = %s;", $staffName ) );
    }

    //get_var() function returns null when there are no results.
    if( is_null($postID) ) { return 0; }
    return $postID;   
}
//== ==========================================================
function abcfsl_db_post_id_by_pretty_name( $prettyPermalink ) {

    if( empty( $prettyPermalink ) ) { return 0; }

    global $wpdb;
    $postID = $wpdb->get_var( $wpdb->prepare(
        "SELECT pm.post_id
        FROM $wpdb->postmeta pm
        JOIN $wpdb->posts p ON  pm.post_id = p.ID
        WHERE p.post_status = 'publish'
        AND pm.meta_key = '_pretty'
        AND pm.meta_value = %s;", $prettyPermalink ) );      

    //error_log( print_r( $postID, true) );       

    if( is_null($postID) ) { return 0; }
    return $postID;
}

// Yoast SEO. Page title filter. PRETTY
function abcfsl_db_spg_title_by_pretty( $prettyPermalink ) {

    if( empty( $prettyPermalink )) { return ''; }

    $postID = abcfsl_db_post_id_by_pretty_name( $prettyPermalink );
    if( is_null($postID) || $postID == 0 ) { return ''; }

    global $wpdb;
    $sPgTitle = $wpdb->get_var( $wpdb->prepare(
            "SELECT meta_value
            FROM $wpdb->postmeta
            WHERE meta_key = '_sPgTitle'
            AND post_id = %d;", $postID ) );

    return $sPgTitle;
}

function abcfsl_db_spg_img_url_by_pretty( $prettyPermalink ) {

    if( empty( $prettyPermalink )) { return ''; }

    $postID = abcfsl_db_post_id_by_pretty_name( $prettyPermalink );
    if( is_null($postID) || $postID == 0 ) { return ''; }

    global $wpdb;
    $sPgTitle = $wpdb->get_var( $wpdb->prepare(
            "SELECT meta_value
            FROM $wpdb->postmeta
            WHERE meta_key = '_imgUrlL'
            AND post_id = %d;", $postID ) );

    return $sPgTitle;
}
//--------------------
function abcfsl_db_spg_title_by_post_id( $postID ) {

    global $wpdb;
    $sPgTitle = $wpdb->get_var( $wpdb->prepare(
            "SELECT meta_value
            FROM $wpdb->postmeta
            WHERE meta_key = '_sPgTitle'
            AND post_id = %d;", $postID ) );

    return $sPgTitle;
}

function abcfsl_db_img_by_post_id( $postID ) {

    if( is_null($postID) || $postID == 0 ) { return ''; }

    //_imgUrlL _imgUrlS

    global $wpdb;
    $imgUrl = $wpdb->get_var( $wpdb->prepare(
            "SELECT meta_value
            FROM $wpdb->postmeta
            WHERE meta_key = '_imgUrlL'
            AND post_id = %d;", $postID ) );

    return $imgUrl;
}


//===================================================

//Single staff member shortcode
function abcfsl_db_staff_member( $staffID ) {

    global $wpdb;
    $postID = $wpdb->get_col( $wpdb->prepare(
        "SELECT ID
        FROM $wpdb->posts
        WHERE ID = %d
        AND post_status = 'publish'", $staffID ));

    return $postID;
}

function abcfsl_db_staff_members_hidden( $parentID ) {

    global $wpdb;
    return  $wpdb->get_col( $wpdb->prepare(
            "SELECT ID
            FROM $wpdb->posts p
            JOIN $wpdb->postmeta pm
            ON pm.post_id =  p.ID
            WHERE p.post_parent = %d
            AND p.post_status = 'publish'
            AND pm.meta_key = '_hideSMember'
            AND pm.meta_value = 1", $parentID ));
}

//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

//Not used yet
function abcfsl_db_staff_members_expired( $parentID ) {

    global $wpdb;

    $postIDs = $wpdb->get_col( $wpdb->prepare(
            "SELECT ID
            FROM $wpdb->posts p
            JOIN $wpdb->postmeta pm
            ON pm.post_id =  p.ID
            WHERE p.post_parent = %d
            AND p.post_status = 'publish'
            AND pm.meta_key = '_expireDT'
            AND pm.meta_value = 1", $parentID ));

    return $postIDs;
}

// ISOTOPE ???
function abcfsl_db_post_cat_slugs( $postID ) {

    global $wpdb;
    $slugs = $wpdb->get_col( $wpdb->prepare(
    "SELECT t.slug
    FROM $wpdb->term_relationships tr
    JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
    JOIN $wpdb->terms t ON tt.term_id  = t.term_id
    WHERE tr.object_id = %d
    AND tt.taxonomy = 'tax_staff_member_cat';", $postID ));

    return $slugs;
}

// ISOTOPE ???
function abcfsl_db_posts_cat_slugs_NOT_USED( $parentID ) {

    global $wpdb;
    $slugs = $wpdb->get_results( $wpdb->prepare(
        "SELECT p.ID, t.slug
        FROM $wpdb->posts p
        JOIN $wpdb->term_relationships tr ON p.ID = tr.object_id
        JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
        JOIN $wpdb->terms t ON tt.term_id = t.term_id
        WHERE p.post_parent = %d
        AND tt.taxonomy = 'tax_staff_member_cat'
        ORDER BY p.ID", $parentID ));

    return $slugs;
}

function abcfsl_db_posts_cat_slugs( $postID ) {

    global $wpdb;

    $slugs = $wpdb->get_col( $wpdb->prepare(
    "SELECT t.slug
    FROM $wpdb->term_relationships tr
    JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
    JOIN $wpdb->terms t ON tt.term_id  = t.term_id
    WHERE tr.object_id = %d
    AND tt.taxonomy = 'tax_staff_member_cat';", $postID ));

    return $slugs;
}

//Not used yet
function abcfsl_db_posts_sortTxt( $parentID ) {

    global $wpdb;
    $sortTxt = $wpdb->get_results( $wpdb->prepare(
            "SELECT pm.post_id, pm.meta_value
            FROM $wpdb->posts p
            JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
            WHERE p.post_parent = %d
            AND pm.meta_key = '_sortTxt'", $parentID ));

    return $sortTxt;
}

//== GROUPS - START ===================================== 
//== GRPABC. Multidimensional array array of StaffID - Slug. Duplicates not removed.
function abcfsl_db_groups_staff_ids_slugs_abc( $parentID, $grpID, $slugsIN ) {

    $grpOptns = get_post_custom( $grpID );
    $metaKey = abcfsl_db_group_by_field( $grpOptns );
    if( empty( $metaKey ) ) { return  array(); }

    if( $metaKey == '_sortTxtST' ){ $metaKey = '_sortTxt'; }
    if( $metaKey == 'postTitlePT' ){ $metaKey = 'postTitle'; }
    $query = '';
    
    global $wpdb;
    if( $metaKey == 'postTitle' ) {
        $query = "SELECT p.ID staffID, LEFT( p.post_title, 1 ) slug 
            FROM $wpdb->posts p
            WHERE p.post_parent = {$parentID}
            AND p.post_status = 'publish'
            AND LEFT( p.post_title, 1 ) IN ( {$slugsIN} );";   
    }
    else {
        $query = "SELECT pm.post_id staffID, LEFT( pm.meta_value, 1 ) slug 
        FROM $wpdb->postmeta pm
        JOIN $wpdb->posts p ON pm.post_id = p.ID
        WHERE p.post_parent = {$parentID}
        AND p.post_status = 'publish'
        AND pm.meta_key = '{$metaKey}' 
        AND LEFT( pm.meta_value, 1 ) IN ( {$slugsIN} );";
    }

    //An associative array.
    $results = $wpdb->get_results( $query, ARRAY_A );
    return $results;   
} 

//== GRPTXT. Multidimensional array array of StaffID - Slug. Duplicates not removed.
function abcfsl_db_groups_staff_ids_slugs_txt( $parentID, $grpID, $slugsIN ) {

    $grpOptns = get_post_custom( $grpID );
    $metaKey = abcfsl_db_group_by_field( $grpOptns );
    if( empty( $metaKey ) ) { return  array(); }

    global $wpdb;
    $query = "SELECT pm.post_id staffID, pm.meta_value slug
        FROM $wpdb->postmeta pm
        JOIN $wpdb->posts p ON pm.post_id = p.ID
        WHERE p.post_parent = {$parentID}
        AND p.post_status = 'publish'
        AND pm.meta_key = '{$metaKey}' 
        AND pm.meta_value IN ( {$slugsIN} );";

    //An associative array.
    $results = $wpdb->get_results( $query, ARRAY_A );
    return $results;
}  

//Staff ID - slug. Duplicate IDs not removed IDs.
function abcfsl_db_groups_staff_ids_slugs_cat( $parentID, $slugsIN ) {

    global $wpdb;

    $query = "
    SELECT tr.object_id staffID, t.slug
    FROM $wpdb->term_taxonomy tt
    JOIN $wpdb->terms t ON  tt.term_id = t.term_id
    JOIN $wpdb->term_relationships tr ON  tt.term_taxonomy_id = tr.term_taxonomy_id
    JOIN $wpdb->posts p ON p.ID = tr.object_id
    WHERE p.post_parent = {$parentID}
    AND tt.taxonomy = 'tax_staff_member_cat'
    AND t.slug IN ( $slugsIN );    
    ";

    //An associative array.
    $results = $wpdb->get_results( $query, ARRAY_A );
    return $results;
  }

// Slugs > Category name pairs. IN - comma delimited slug names;
function abcfsl_db_groups_cat_slug_name_pairs( $slugsIN ) {
    global $wpdb;

    $query = "
    SELECT t.slug, t.name
    FROM $wpdb->term_taxonomy tt
    JOIN $wpdb->terms t ON  tt.term_id = t.term_id
    WHERE tt.taxonomy = 'tax_staff_member_cat'
    AND t.slug IN ( $slugsIN );
    ";

    $results = $wpdb->get_results( $query );
    return $results;
}

//What field to use for meta_key DB parameter
function abcfsl_db_group_by_field( $grpOptns ){

    $grpFieldID = isset( $grpOptns['_grpFieldID'] ) ?  $grpOptns['_grpFieldID'][0] : '';
    $grpFieldType = isset( $grpOptns['_grpFieldType'] ) ? $grpOptns['_grpFieldType'][0] : '';
    if( empty( $grpFieldType ) ) { $grpFieldID = ''; }
    return $grpFieldType . $grpFieldID;
}
//== GROUPS - END =======================================

function abcfsl_db_get_post_title( $staffID ) {

  if( empty( $staffID ) ) { return ''; }

  global $wpdb;
  $postTitle = $wpdb->get_var( $wpdb->prepare(
      "SELECT post_title
      FROM $wpdb->posts
      WHERE ID = %d;", $staffID ) ); 

    //get_var() function returns null when there are no results.
    return $postTitle;
}

//In the future replace it by: abcfsl_db_staff_ids_sorted_all_or_cat
function abcfsl_db_staff_ids_no_menu( $parentID, $scodeCat, $dSortOrder ) {

    $orderPar['dSortOrder'] = $dSortOrder;
    $orderPar['cSort'] = '';
    $orderPar['cSortOrder'] = '';
    
    return abcfsl_db_staff_ids_sorted_all_or_cat( $parentID, $scodeCat, $orderPar );
}

//Used by abcfsls_db_mf_MFP_NEW ?????? // SLSN
function abcfsl_db_staff_ids_sorted_all_or_cat( $parentID, $scodeCat, $orderPar ) {

    $outIDs = abcfsl_db_staff_ids_sorted_all( $parentID, $orderPar );

    if( !empty( $scodeCat ) ) {
        //Staff IDs, filtered by shordcode categories. NOT sorted.
        $catsIDs = abcfsl_db_staff_ids_not_sorted_cats( $parentID, $scodeCat );

        //Return only included in categories
        return array_intersect( $outIDs, $catsIDs );
    }
    //All staff members, sorted
    return $outIDs;
}

//============================================================
function abcfsl_db_cbo_vcard_tplates( $slTplateID, $postType ) {

    $custPostType = 'cpt_staff_lst_vcard';
    switch ( $postType ) {
        case 'VC':
            $custPostType = 'cpt_staff_lst_vcard';
            break;
        case 'QR':
            $custPostType = 'cpt_staff_lst_qrcode';;
            break;                       
        default:
            break;
    }
        
    global $wpdb;
    $vcTplates[0] = ' - - - ';
    $dbRows = $wpdb->get_results( $wpdb->prepare( 
        "SELECT ID, post_title 
        FROM $wpdb->posts p
        JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
        WHERE p.post_type = %s 
        AND p.post_status = 'publish'
        AND  pm.meta_key = '_slTplateID'
        AND pm.meta_value =  %d
        ORDER BY p.post_title", $custPostType, $slTplateID ));
    if ( $dbRows ) { 
        foreach ( $dbRows as $row ) { 
            $vcTplates[$row->ID] = $row->post_title;
        } 
    }
    return $vcTplates;
    }



// function abcfsl_db_cbo_vcard_tplates_OLD( $slTplateID ) {
    
//     global $wpdb;
//     $vcTplates[0] = ' - - - ';
//     $dbRows = $wpdb->get_results( "SELECT ID, post_title 
//         FROM $wpdb->posts
//         WHERE post_type = 'cpt_staff_lst_vcard' AND post_status = 'publish'
//         ORDER BY post_title" );
//     if ( $dbRows ) { 
//         foreach ( $dbRows as $row ) { 
//             $vcTplates[$row->ID] = $row->post_title;
//         } 
//     }
//     return $vcTplates;
// }

// function abcfsl_db_cbo_qrcode_tplates_OLD( $slTplateID ) {

// // SELECT *
// // FROM wp_posts p
// // JOIN wp_postmeta pm ON p.ID = pm.post_id
// // WHERE p.post_type = 'cpt_staff_lst_qrcode'
// // AND  pm.meta_key = '_slTplateID'
// // AND pm.meta_value = 8826;

// // $sortTxt = $wpdb->get_results( $wpdb->prepare(
// //     "SELECT pm.post_id, pm.meta_value
// //     FROM $wpdb->posts p
// //     JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
// //     WHERE p.post_parent = %d
// //     AND pm.meta_key = '_sortTxt'", $parentID ));
    
//     global $wpdb;
//     $vcTplates[0] = ' - - - ';
//     $dbRows = $wpdb->get_results( $wpdb->prepare( 
//         "SELECT ID, post_title 
//         FROM $wpdb->posts p
//         JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
//         WHERE p.post_type = 'cpt_staff_lst_qrcode' 
//         AND p.post_status = 'publish'
//         AND  pm.meta_key = '_slTplateID'
//         AND pm.meta_value =  %d
//         ORDER BY p.post_title", $slTplateID ));
//     if ( $dbRows ) { 
//         foreach ( $dbRows as $row ) { 
//             $vcTplates[$row->ID] = $row->post_title;
//         } 
//     }
//     return $vcTplates;
// }