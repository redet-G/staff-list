<?php
//List Items builder.
function abcfsl_cnt_list_i( $tplateOptns, $optns, $menuParts, $menuSlugs ){

    //$optns contain also shortcode parameters
    $clsPfix = $optns['pfix'];
    $lstItemDefaultCls = $clsPfix . 'PadBMB30';
    $colL = isset( $tplateOptns['_lstCols'] ) ? esc_attr( $tplateOptns['_lstCols'][0] ) : '6';
    $colR = (12 - $colL);
    $noDataMsgT = isset( $tplateOptns['_noDataMsg'] ) ? esc_attr( $tplateOptns['_noDataMsg'][0] ) : '';

    //== PAGINATOR ==========================================
    // Returns staff IDs and count. IDs are filtered and sorted. Used alawas, paginator or not.
    $filters = [];
    $out = abcfsl_paginator_post_ids( $optns, $menuParts, $filters );
    $totalQty = $out['totalQty'];

    if( $totalQty == 0 ) { return abcfsl_util_pg_cnt_parts_defaults( $noDataMsgT, $menuParts['noDataMsg'] ); }

    $postIDs = $out['postIDs'];
    //================================================
    $itemPar['pfix'] = $clsPfix;
    $itemPar['tplateID'] = $optns['tplateID'];
    $itemPar['parentID'] = $optns['parentID'];
    $itemPar['itemCntrCustomCls'] = isset( $tplateOptns['_lstItemCls'] ) ? esc_attr( $tplateOptns['_lstItemCls'][0] ) : '';
    $itemPar['itemCntrCustomStyle'] = isset( $tplateOptns['_lstItemStyle'] ) ? esc_attr( $tplateOptns['_lstItemStyle'][0] ) : '';
    $itemPar['sPageUrl'] = isset( $tplateOptns['_sPageUrl'] ) ? esc_attr( $tplateOptns['_sPageUrl'][0] ) : '';
    $itemPar['colL'] = $colL;
    $itemPar['colR'] = $colR;  
    $itemPar['fieldOrder'] = abcfsl_util_field_order( $tplateOptns, false );  

    $itemPar['hiddenFields'] =  $optns['hiddenFields'];
    $itemPar['privateFields'] =  $optns['privateFields'];
    $itemPar['menuSlugs'] = $menuSlugs;
    //=============================================

    $divNoDataAlert = abcfsl_util_div_no_data_alert( $menuParts['noDataMsg'], $optns['tplateID'], $clsPfix );
    $allItems = abcfsl_cnt_list_i_items_cntr_and_content( $postIDs, $tplateOptns, $itemPar );

    $itemsHTML = $divNoDataAlert . $allItems['itemsHTML']; 
    $itemsSD = $allItems['sdProperties']; 

    $cntParts = abcfsl_cnt_parts_isotope( $totalQty, $itemsHTML, $itemsSD );
    return $cntParts;
}

// All items. Container, HTML, SD structured data. 
function abcfsl_cnt_list_i_items_cntr_and_content( $postIDs, $tplateOptns, $itemPar ){   

    $itemsHTML = '';
    $sdProperties  = array();

    foreach ( $postIDs as $staffMemberID ) {
        $outItem = abcfsl_cnt_list_i_item_cntr_and_content( $staffMemberID, $tplateOptns, $itemPar  );
        $itemsHTML .= $outItem['itemCntr'];
        $sdProperties[] = $outItem['sdProperties']; //SDATA
    } 
    
    $gridItemsCntrID = $itemPar['pfix'] . 'GridItemsCntr_' . $itemPar['tplateID'];
    $gridItemsCntrCls = $itemPar['pfix'] . 'GridItemsCntr';
    $gridItemsCntrSE = abcfl_html_element_parts( 'div', $gridItemsCntrID, $gridItemsCntrCls, '');

    $out['itemsHTML'] = $gridItemsCntrSE['tagS'] . $itemsHTML . $gridItemsCntrSE['tagE'];;
    $out['sdProperties'] =  $sdProperties;

    return $out;
}

// List Item. Container + content + sdProperties (image left, text right).
function abcfsl_cnt_list_i_item_cntr_and_content( $staffMemberID, $tplateOptns, $itemPar ){  
    
    $itemOptns = get_post_custom( $staffMemberID );

    $itemPar['itemCntrCustomClsSM'] = isset( $itemOptns['_itemCustCls'] ) ? esc_attr( $itemOptns['_itemCustCls'][0] ) : '';    
    // DIV Item container start-end. 
    $itemCntrSE = abcfsl_cnt_list_i_item_cntr_se(  $itemPar, $itemPar['pfix'], $staffMemberID  );

    $par['pgLayout'] = 1;
    $par['itemID'] = $staffMemberID;
    $par['colL'] = $itemPar['colL'];
    $par['colR'] = $itemPar['colR'];

    $par['clsPfix'] = $itemPar['pfix'];
    $par['sPageUrl'] = $itemPar['sPageUrl'];
    $par['isSingle'] = false;
    $par['center'] = 'Center575';
    $par['txtCntrCls'] = 'TxtCntrLst';
    $par['colWrapBaseCls'] = 'TxtColLst';
    $par['custCls'] = '';

    $par['hiddenFields'] =  $itemPar['hiddenFields'];
    $par['privateFields'] =  $itemPar['privateFields'];
    $par['keepDups'] = 0;

    $imgCntr = abcfsl_cnt_img_cntr( $tplateOptns, $itemOptns, $par );
    $txtSection = abcfsl_cnt_txt_cntr( $tplateOptns, $itemOptns, $par, $itemPar['fieldOrder'] );

    //SDATA
    $out['itemCntr'] = $itemCntrSE['tagS'] . $imgCntr . $txtSection . $itemCntrSE['tagE'];
    $out['sdProperties'] = abcfsl_struct_data_item_grid( $tplateOptns, $itemOptns, $staffMemberID, $itemPar['fieldOrder'] );

    return $out;
}

// Return item container div. Has classes and category slugs.
function abcfsl_cnt_list_i_item_cntr_se(  $itemPar, $clsPfix, $staffMemberID  ){

    // Get valid slugs for this staff member.
    $itemSlugs = abcfsl_cnt_cat_slugs_for_isotope_item_cntr( $staffMemberID, $itemPar['menuSlugs'] );

    $itemID = '';
    $requiredCls = $clsPfix . 'GCol ' . $clsPfix . 'ItemCntrLst';
    $style = $itemPar['itemCntrCustomStyle'];
    $microdata = '';
    //------------------------------------------------------
    // Template custom class. 
    $itemCntrCustomCls = $itemPar['itemCntrCustomCls'];
    // Staff member custom class.
    $itemCntrCustomClsSM = $itemPar['itemCntrCustomClsSM'];
    if( empty( $itemCntrCustomCls ) ){ $itemCntrCustomCls = $itemCntrCustomClsSM; }

    // If template and custom classes are empty use default class.
    if( empty( $itemCntrCustomCls ) ){ 
        $itemCntrDefaultCls = $clsPfix . 'PadBMB30';
        $itemCntrCustomCls = $itemCntrDefaultCls; 
    }

    $cls = $requiredCls . ' ' . $itemCntrCustomCls . $itemSlugs . ' abcfClrFix';
    //------------------------------------------------------

    return abcfl_html_element_parts( 'div', $itemID, $cls, $style, $microdata );
}