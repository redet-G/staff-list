<?php
//-- PG Paginator START ---------------------------------------
//Returns staff IDs and count. IDs are filtered and sorted. 
//Used for all layouts and all filter options. Not used by other plugins
//Called from cnt-... functions.
function abcfsl_paginator_post_ids( $optns, $menu, $filters ){

    // [tplateID] => 8826
    // [parentID] => 8826
    // [pfix] => abcfsl
    // [ajax] => 0
    // [random] => 
    // [scodeOrder] => 
    // [dSortOrder] => 
    // [dSort] => 
    // [cSort] => 
    // [cSortOrder] => 
    // [scodeCat] => 
    // [scodeCatExcl] => 
    // [top] => 
    // [hiddenFields] => 0
    // [privateFields] => 0
    // [hiddenRecords] => 2
    // [staffID] => 0
    // [grpID] => 0
    // [grpType] => 
    // [sortType] => P
    // [pageNo] => 
    // [pgnationPgQty] => 0
    //$par['filtersEmpty'] = true; ???????

    $optnsDefaults['pageNo'] =  0;
    $optnsDefaults['pgnationPgQty'] =  0;
    $optnsDefaults['random'] = false;
    $optnsDefaults['top'] = 0;
    //$optnsDefaults['filtersEmpty'] = true;

    $optnsFix = wp_parse_args( $optns, $optnsDefaults );  

    $staffID = $optnsFix['staffID'];
    $top = $optnsFix['top'];
    $pgnationPgQty = $optnsFix['pgnationPgQty'];
    $postIDs = array();

    // Returns array.
    $out['postIDs'] = array();
    $out['totalQty'] = 0;

    if( $staffID > 0 ){
        $postIDs = abcfsl_db_staff_member( $staffID );
        $out['postIDs'] = $postIDs;
        $out['totalQty'] = count( $postIDs );
        return $out;
    }
 
    //Used for all layouts and all filter options. Returns array of postIDs filtered and sorted.
    $postIDs = abcfsl_db_staff_member_ids( $optnsFix, $menu, $filters );

    $totalQty = count( $postIDs );
    if( $totalQty == 0 ) { return $out; }
    $out['totalQty'] = $totalQty;

    if( $optnsFix['random'] ){
        shuffle( $postIDs );
        if( $top > 0 ) { $postIDs = array_slice( $postIDs, 0, $top ); }
        $out['postIDs'] = $postIDs;
        return $out;
    }
    // TOP no pagination if top used.
    if( $top > 0 ) { 
        $postIDs = array_slice( $postIDs, 0, $top ); 
        $out['postIDs'] = $postIDs;
        return $out;
    }

    // if( !empty( $optnsFix['datePlus'] ) ) { 
    //     $out['postIDs'] = $postIDs;
    //     return $out;
    // }

    //-- If pagination, return subset of records. Otherwise, return all. ------------
    if( $totalQty <= $pgnationPgQty ) {
        $out['postIDs'] = $postIDs;
        return $out;
    }

    $out['postIDs'] = abcfsl_util_page_post_ids( $postIDs, $optnsFix['pageNo'], $pgnationPgQty );
    return $out;
}

// Uncaught TypeError: Unsupported operand types: string * string in /inc/paginator.php:95 
function abcfsl_util_page_post_ids( $postIDs, $pageNo, $pgnationPgQty ){

    if( $pgnationPgQty == 0 ) { return $postIDs; }
    if( empty( $pageNo ) ) { $pageNo = 0; }
    if( $pageNo == 0 && $pgnationPgQty > 0 ) { $pageNo = 1;}
    $start = ( $pageNo * $pgnationPgQty ) - $pgnationPgQty;
    $outPostIDs = array_slice( $postIDs, $start, $pgnationPgQty, true );

    return $outPostIDs;
}

//--- Pagination control HTML. Container + content. --------------------------------------------------------------
function abcfsl_paginator_cnt( $tplateOptns, $totalQty, $pageNo, $pfix, $ajax ){

    $pgQty = isset( $tplateOptns['_pgnationPgQty'] ) ? $tplateOptns['_pgnationPgQty'][0] : 0;

    if( $totalQty == 0 || $pgQty == 0 ) { return ''; }
    if( $pgQty >= $totalQty ) { return ''; }
    //-------------------------------------
    $par['totalQty'] = $totalQty;
    $par['pgQty'] = $pgQty;
    $par['currentPage'] = $pageNo;
    $par['maxPgsToShow'] = isset( $tplateOptns['_pgnationPgsToShow'] ) ? $tplateOptns['_pgnationPgsToShow'][0] : '10';
    $par['pgnationSize'] = isset( $tplateOptns['_pgnationSize'] ) ? $tplateOptns['_pgnationSize'][0] : 'MD';
    $par['justify'] = isset( $tplateOptns['_pgnationJustify'] ) ? $tplateOptns['_pgnationJustify'][0] : 'E';
    $par['pgnationColor'] = isset( $tplateOptns['_pgnationColor'] ) ? $tplateOptns['_pgnationColor'][0] : 'G';
    $par['urlPattern'] = abcfsl_paginator_pg_url();
    $par['pfix'] = $pfix;
    $par['ajax'] = $ajax;

    $paginator = new ABCFSL_Paginator( $par );

    //Top location
    $pgnationTTM = isset( $tplateOptns['_pgnationTTM'] ) ? $tplateOptns['_pgnationTTM'][0] : '';
    $pgnationTBM = isset( $tplateOptns['_pgnationTBM'] ) ? $tplateOptns['_pgnationTBM'][0] : '';

    //Bottom location
    $pgnationBTM = isset( $tplateOptns['_pgnationBTM'] ) ? $tplateOptns['_pgnationBTM'][0] : '';
    $pgnationBBM = isset( $tplateOptns['_pgnationBBM'] ) ? $tplateOptns['_pgnationBBM'][0] : '';

    $pgnationCls = isset( $tplateOptns['_pgnationCls'] ) ? esc_attr( $tplateOptns['_pgnationCls'][0] ) : '';
    $pgnationStyle = isset( $tplateOptns['_pgnationStyle'] ) ? esc_attr( $tplateOptns['_pgnationStyle'][0] ) : '';

    $pgnationTB = isset( $tplateOptns['_pgnationTB'] ) ? $tplateOptns['_pgnationTB'][0] : 'B';

    $pgnCntHTML = '';

    //No top-bottom pagination. Only top or bottom.
    switch ( $pgnationTB ){
       case 'T':
           $pgnCntHTML = abcfsl_util_paginator_cntr_HTML( $paginator, $pgnationTTM, $pgnationTBM, $pgnationCls, $pgnationStyle, $pfix, 'T' );
           break;
       case 'B':
           $pgnCntHTML = abcfsl_util_paginator_cntr_HTML( $paginator, $pgnationBTM, $pgnationBBM, $pgnationCls, $pgnationStyle, $pfix, 'B' );
           break;
       case 'TB':
           //$out['T'] = abcfsl_util_paginator_cntr_HTML( $paginator, $pgnationTTM, $pgnationTBM, $pgnationCls, $pgnationStyle, $pfix, 'T' );
           $pgnCntHTML = abcfsl_util_paginator_cntr_HTML( $paginator, $pgnationBTM, $pgnationBBM, $pgnationCls, $pgnationStyle, $pfix, 'B' );
           break;
       default:
           break;
   }
    return $pgnCntHTML;
}

function abcfsl_util_paginator_cntr_HTML( $paginator, $tm, $bm, $customCls, $customStyle, $pfix, $tb ){

    $style = abcfl_css_mtrbl( $tm, '', $bm, '' );
    $style = trim($style . ' ' . $customStyle);
    $cls = trim( $pfix . 'PaginationCntr'. $tb . ' ' . $customCls );
    $div = abcfsl_cnt_generic_div_simple( $cls, $style );
    return $div['cntrS'] .  $paginator . $div['cntrE'];
}

//Page URL for paginator. Remove 'pagename' query var.
 function abcfsl_paginator_pg_url( ){

    $staffCat = ( get_query_var('staff-category') ) ? get_query_var('staff-category' ) : false;
    $staffAZ = ( get_query_var('staff-az') ) ? get_query_var( 'staff-az' ) : false;

    $permalink = trailingslashit(untrailingslashit( get_permalink() ));

    //'page' => '(:num)',
    $newURL = add_query_arg( array(
        'staff-category' => $staffCat,
        'staff-az' => $staffAZ,
        'staff-page-no' => '(:num)'
    ), $permalink );

    return $newURL;
 }
 //-- Paginator END ---------------------------------------
 //===DEPRECATED==========================================
 function abcfsl_paginator_post_ids_defaults(){

    $par['pageNo'] =  0;
    $par['pgnationPgQty'] =  0;
    $par['random'] = false;
    $par['top'] = '';
    $par['filtersEmpty'] = true;
    
    return $par;
}