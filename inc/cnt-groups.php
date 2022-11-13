<?php
// Main function to render groups. Called from each of the layouts.
// OUT: All groups + group headers + SD data.
function abcfsl_cnt_groups_all_groups_all_parts( $layout, $grpType, $staffIDs, $tplateOptns, $itemPar, $itemCntrDiv, $gridColsQty ){

    $out['itemsHTML'] = '';
    $out['sdProperties'] = array();
 
    //grpType = GRPCAT GRPTXT GRPABC
    switch ( $grpType . '_' . $layout ) {
        case 'GRPCAT_A':
            $out = abcfsl_cnt_grid_a_all_groups_all_parts_cat( $staffIDs, $tplateOptns, $itemPar, $itemCntrDiv );
            break;
        case 'GRPTXT_A':
        case 'GRPABC_A': 
            $out = abcfsl_cnt_grid_a_all_groups_all_parts_txt( $grpType, $staffIDs, $tplateOptns, $itemPar, $itemCntrDiv );           
            break;         
        case 'GRPCAT_B':
            $out = abcfsl_cnt_grid_b_all_groups_all_parts_cat( $staffIDs, $tplateOptns, $itemPar, $gridColsQty );
            break;
        case 'GRPTXT_B':
        case 'GRPABC_B': 
            $out = abcfsl_cnt_grid_b_all_groups_all_parts_txt( $grpType, $staffIDs, $tplateOptns, $itemPar, $gridColsQty );           
            break;
        case 'GRPCAT_L':
            $out = abcfsl_cnt_list_all_groups_all_parts_cat( $staffIDs, $tplateOptns, $itemPar );
            break;
        case 'GRPTXT_L':
        case 'GRPABC_L': 
            $out = abcfsl_cnt_list_all_groups_all_parts_txt( $grpType, $staffIDs, $tplateOptns, $itemPar );           
            break;
        default:
            break;
    }

    return $out;    
}

// used by all layouts.
function abcfsl_cnt_groups_grp_header( $grpID, $grpName, $pfix ){

    $grpOptns = get_post_custom( $grpID );
    
    $grpCntrMT = isset( $grpOptns['_grpCntrMT'] ) ? $grpOptns['_grpCntrMT'][0] : 'N';
    $grpCntrMB = isset( $grpOptns['_grpCntrMB'] ) ? $grpOptns['_grpCntrMB'][0] : 'N';
    $grpCntrCustCls = isset( $grpOptns['_grpCntrCustCls'] ) ? esc_attr( $grpOptns['_grpCntrCustCls'][0] ) : '';

    $grpItemML = isset( $grpOptns['_grpItemML'] ) ? $grpOptns['_grpItemML'][0] : 'N';
    $grpFontSize = isset( $grpOptns['_grpFontSize'] ) ? esc_attr( $grpOptns['_grpFontSize'][0] ) : 'D';
    $grpFontColor = isset( $grpOptns['_grpFontColor'] ) ? esc_attr( $grpOptns['_grpFontColor'][0] ) : 'D';
    $upCase = isset( $grpOptns['_upCase'] ) ? esc_attr( $grpOptns['_upCase'][0] ) : 'N';
    $grpNameCustCls = isset( $grpOptns['_grpNameCustCls'] ) ? esc_attr( $grpOptns['_grpNameCustCls'][0] ) : '';

    $grpHLine = isset( $grpOptns['_grpHLine'] ) ? esc_attr( $grpOptns['_grpHLine'][0] ) : '';

    //--------------------------------------------------
    $clsMT = abcfsls_util_cls_name_bldr_ncd( 'MT', $grpCntrMT, $pfix );
    $clsMB = abcfsls_util_cls_name_bldr_ncd( 'MB', $grpCntrMB, $pfix );
    $clsGrpCntr = abcfsl_util_merge_custom_cls( $clsMT . abcfsl_util_lead_space( $clsMB ), $grpCntrCustCls );
    

    //Group name div + content
    //if( !empty( $grpName) ) {
    $clsMl = abcfsls_util_cls_name_bldr_ncd( 'ML', $grpItemML, $pfix ); //abcfslMLPc2
    $clsFontSize = abcfsls_util_cls_name_bldr_ncd( 'F', $grpFontSize, $pfix );
    $clsFontColor = abcfsls_util_cls_name_bldr_ncd( 'Color', $grpFontColor, $pfix );
    $clsUpCase = abcfsl_util_upper_cls( $upCase, $pfix );
    $clsAll = $clsMl . abcfsl_util_lead_space( $clsFontSize ) . abcfsl_util_lead_space( $clsFontColor ) . abcfsl_util_lead_space( $clsUpCase );
    $clsGrpName = abcfsl_util_merge_custom_cls( $clsAll, $grpNameCustCls );
    //}

    $divGrpCntrS = abcfl_html_tag_cls( 'div', $clsGrpCntr );
    $divGrpName = abcfl_html_tag_with_content( $grpName, 'div', '',  $clsGrpName );
    
    $divGrpHLine = '';
    if( !empty( $grpHLine ) ) {
        $divGrpHLine = abcfl_html_tag_cls( 'div', $grpHLine, true );
    }
    $divGrpCntrE = abcfl_html_tag_end( 'div' );

    return $divGrpCntrS . $divGrpName . $divGrpHLine . $divGrpCntrE;
}

//== CATEGORIES - ALL LAYOUTS - START ========================================
//  Staff IDs grouped by category slugs. 
function abcfsl_cnt_groups_data_categories( $staffIDs, $grpID, $parentID, $keepDups ){

    //Slugs > Category name pairs. Included only saved slugs.
    $out['slugNamePairs'] = array();
     //Staff IDs grouped by slugs. Includes none group. 
    $out['groupedIDs'] = array();

    //-----------------------------
    // Comma delimited string for IN clause. $grpID = 7961;
    $slugsSaved = abcfsl_cnt_groups_saved_grp_values_to_in( $grpID );
    if( empty( $slugsSaved ) ) { return $out; }

    $slugsIN = $slugsSaved['slugsIN'];
    $slugsDistinct = $slugsSaved['slugsDistinct'];
    if( empty( $slugsIN ) ) { return $out; }

    //Multidimesional array. Dups not removed. Only saved slugs (slugsIN).
    $staffIDSlugMulti = abcfsl_cnt_groups_staff_ids_slugs( 'GRPCAT', $parentID, 0, $slugsIN );

    //Slugs > Category name pairs ( [faculty] => Faculty ). Included only saved slugs. Ordered by grouping template items.
    $slugNamePairs = abcfsl_cnt_groups_cat_slug_name_pairs( $slugsIN, $slugsDistinct );
    $out['slugNamePairs'] = $slugNamePairs;

    //$keepDups = '1';

    if( empty( $keepDups ) ) {  
        return abcfsl_cnt_groups_data_no_dups( $staffIDs, $staffIDSlugMulti, $out );
    } 
    
    return abcfsl_cnt_groups_data_categories_dups( $staffIDs, $staffIDSlugMulti, $out );
}

//Can handle dups
function abcfsl_cnt_groups_data_categories_dups( $staffIDs, $staffIDSlugMulti,  $out ){

    $staffIDSlug = array();
    $groupedIDs = array();
    $slug = '';

    //$staffIDs = filtered or unfiltered list. Can have duplicate IDs.
    //[1] => 8860
    //[3] => 8830

    foreach( $staffIDSlugMulti as $key => $arrItem ){
 
        if( abcfsl_cnt_groups_cat_is_valid_array( $arrItem ) ) {
            $staffID = $arrItem['staffID'];

            // Works with filters.
            if ( in_array( $staffID, $staffIDs ) ) {
                $staffIDSlug[$staffID] = $arrItem['slug'];
                $slug = abcfsl_cnt_groups_slug_for_id( $staffID, $staffIDSlug );
                $groupedIDs[$slug][] = $staffID;
            } 
        }
            
     }

     // OK. Doesn't work with filters
    // foreach( $staffIDSlugMulti as $key => $arrItem ){ 
    //     if( abcfsl_cnt_groups_cat_is_valid_array( $arrItem ) ) {
    //         $staffID = $arrItem['staffID'];
    //         $staffIDSlug[$staffID] = $arrItem['slug'];
    //         $slug = abcfsl_cnt_groups_slug_for_id( $staffID, $staffIDSlug );
    //         $groupedIDs[$slug][] = $staffID;
    //     }            
    //  }

    $out['groupedIDs'] = $groupedIDs;
    return $out;

    //== IN ===================================
    // Array
    // (
    // [0] => Array
    //     (
    //         [staffID] => 5908
    //         [slug] => administrators
    //     )

    // [1] => Array
    //     (
    //         [staffID] => 5909
    //         [slug] => administrators
    //     )

    // [17] => Array
    // (
    //     [staffID] => 7614
    //     [slug] => faculty

    //==  OUT ==================================================
    // Staff IDs grouped by slugs. Includes none group.
    // [groupedIDs] => Array(
    // [administrators] => Array
    //     (
    //         [0] => 6371
    //         [1] => 7340
    //     )
    // [faculty] => Array
    //     (
    //         [0] => 6337
    //         [1] => 7376
    //     )

}

function abcfsl_cnt_groups_cat_is_valid_array( $arrItem ) {

    //Single array in multidimensional array. Has to contain exactly 2 elements.
    //[staffID] => 8860
    //[slug] => faculty

    if( !is_array ( $arrItem ) ) { return false; }
    if ( array_key_exists('staffID', $arrItem) && array_key_exists( 'slug', $arrItem ) ) { return true; }
    
    return false;
}


//Slugs > Category names pairs. Included only reqested slugs.
function abcfsl_cnt_groups_cat_slug_name_pairs( $slugsIN, $slugsDistinct ) {

    //Slugs > Category names pairs from DB.
    $slugsNames = abcfsl_db_groups_cat_slug_name_pairs( $slugsIN );

    $slugNamePairs = array();
    $slugNamePairsSorted = array();
    $catName = '';

    foreach ($slugsNames as $value) {
        $slugNamePairs[$value->slug] = $value->name;       
    }

    foreach ( $slugsDistinct as $slug ) {
        $catName = abcfsl_cnt_groups_cat_name_for_slug( $slugNamePairs, $slug );
        if( !empty( $catName) ) {
            $slugNamePairsSorted[$slug] = $catName;
        }      
    }
    return $slugNamePairsSorted;
}

//Get slug for specific ID. 
function abcfsl_cnt_groups_cat_name_for_slug( $slugNamePairs, $slug ){
    $catName = '';
    if ( !empty( $slugNamePairs[$slug]) ) {
        $catName = $slugNamePairs[$slug];
    }
    return $catName;
}
//== CATEGORIES - ALL LAYOUTS - END  ========================================

//== AZ or TEXT - ALL LAYOUTS - START  ======================================
// Staff IDs grouped by slugs. 
function abcfsl_cnt_groups_data_txt( $grpType, $staffIDs, $grpID, $parentID, $tplateOptns, $itemPar ){
    
    //Slugs > Category name pairs. Included only saved slugs.
    //$out['slugNamePairs'] = array();
    $out['grpNames'] = array();
    //Staff IDs grouped by slugs. Includes none group. 
    $out['groupedIDs'] = array();
    //-----------------------------
    // Comma delimited string for IN clause.
    $slugsSaved = abcfsl_cnt_groups_saved_grp_values_to_in( $grpID );
    if( empty( $slugsSaved ) ) { 
        return $out; 
    }
    //--------------------------------------------
    $slugsIN = $slugsSaved['slugsIN'];
    $grpNames = $slugsSaved['slugsDistinct'];

    if( empty( $slugsIN ) ) { 
        return $out; 
    }
    //-----------------------------------------------
    $out['grpNames'] = $grpNames;

    // Only saved slugs (slugsIN). 
    $staffIDSlugMulti = abcfsl_cnt_groups_staff_ids_slugs( $grpType, $parentID, $grpID, $slugsIN );

    return abcfsl_cnt_groups_data_no_dups( $staffIDs, $staffIDSlugMulti, $out );    
}
//== AZ or TEXT - ALL LAYOUTS - END  ======================================

//=== UTILITIES START - USED BY ALL ===================================
// Data comes from DB. Can contain duplicates.
function abcfsl_cnt_groups_staff_ids_slugs( $grpType, $parentID, $grpID, $slugsIN  ) {

    // slugsIN: comma delimited string. Dups removed.  Used for SQL IN. 
    // 'team', 'administrators','coach','faculty'.
    // 'F','A','B','C','G','K','M','L','X','N','S','T','W'
    // $grpID is used to get meta_key value for text search.

    $results = array();

    switch ( $grpType ) {
        case 'GRPCAT':
            $results = abcfsl_db_groups_staff_ids_slugs_cat( $parentID, $slugsIN );
            break;
        case 'GRPTXT': 
            $results = abcfsl_db_groups_staff_ids_slugs_txt( $parentID, $grpID, $slugsIN );           
            break;
        case 'GRPABC': 
            $results = abcfsl_db_groups_staff_ids_slugs_abc( $parentID, $grpID, $slugsIN );          
            break;
        default:
            break;
    }

    //Multidimensional array, can contain duplicates. 
    return $results;

    //=== OUTPUT - DUPLICATES NOT REMOVED =========================
    // multidimensional array
    // [0] => Array
    //     (
    //         [staffID] => 5908
    //         [slug] => administrators
    //     )
    // [24] => Array
    // (
    //     [staffID] => 8857
    //     [slug] => faculty
    // )    
    //============================================================= 
}

// OUT - comma delimited, single quotes string for IN clause. Dupes removed.
// OUT - array of distict strings.
function abcfsl_cnt_groups_saved_grp_values_to_in( $grpTplateID ) {

    $slugs = array();
    
    //Get slugs from Grouping Template. Remove duplicates. Ordered by staff groups setup. Array of arrays
    $savedSlugs = get_post_meta( $grpTplateID, '_grpSlugs', true );
    if( empty( $savedSlugs )) { return array(); }

    foreach ($savedSlugs as $value) {
        $slugs[] = $value['grpSlugs'];        
    }
    $slugsDistinct = array_unique( $slugs );
    //----------------------------------------

    $slugsIN = "'" . implode( "','", $slugsDistinct ) . "'";

    $out['slugsIN'] = $slugsIN;
    $out['slugsDistinct'] = $slugsDistinct;

    return $out;
}

//Get slug for specific ID. 
function abcfsl_cnt_groups_slug_for_id( $staffID, $staffIDSlug ){

    $slug = 'none';
    if ( !empty( $staffIDSlug[$staffID]) ) {
        $slug = $staffIDSlug[$staffID];
    }
    return $slug;
}

//--- Remove duplicate IDs START -----------------------------------
function abcfsl_cnt_groups_data_no_dups( $staffIDs, $staffIDSlugMulti, $out ){

    $groupedIDs = array();

    // Remove duplicate staff IDs. Convert multidimensional array into Associative array. 
    $staffIDSlug = abcfsl_cnt_groups_remove_dups( $staffIDSlugMulti, 'staffID' );

    foreach ( $staffIDs as $staffID ) {
        $slug = abcfsl_cnt_groups_slug_for_id( $staffID, $staffIDSlug );
        $groupedIDs[$slug][] = $staffID;
    }

    $out['groupedIDs'] = $groupedIDs;
    return $out;

    // -- OUTPUT: Group names. ----------------
    //[0] => A
    //[1] => B

    // -- OUTPUT: Staff IDs grouped by slugs. Includes none group.
    // [A] => Array
    //     (
    //         [0] => 6371
    //         [1] => 7340
    //     )
    // [B] => Array
    //     (
    //         [0] => 6337
    //         [1] => 7376
    //     )     
}


//IN: multidimensiomal array, duplicate staffIDs.
//OUT: associative array, dups removed
function abcfsl_cnt_groups_remove_dups( $results, $keyname ){

    // Remove duplicate staff IDs. $keyname = staffID
    $resultsUnique = abcfsl_cnt_groups_unique_key( $results, $keyname );
    
    $staffIDSlug = array();
    //Convert multidimensional array into Associative array. 
    foreach ( $resultsUnique as $value ) {
        $staffIDSlug[$value['staffID']] = $value['slug']; 
    }
    //OUT: StaffID => meta_value or slug. [6337] => faculty
    return $staffIDSlug;
}

function abcfsl_cnt_groups_unique_key( $array, $keyname){

    $new_array = array();
    foreach($array as $key=>$value){
   
      if(!isset($new_array[$value[$keyname]])){
        $new_array[$value[$keyname]] = $value;
      }
   
    }
    $new_array = array_values($new_array);
    return $new_array;
}
//--- Remove duplicate IDs END -----------------------
//=== UTILITIES END ===================================