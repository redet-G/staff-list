<?php
//Retuns array menuParts. Menu wrap + menu items + menu parameters + js. Called from cnt-menu
function abcfsl_cnt_menu_cat_i_builder( $menuParts ){

    $clsPfix = $menuParts['pfixSL'];

    $jsIsotopePar['clsPfix'] = $clsPfix;
    $jsIsotopePar['tplateID'] = $menuParts['tplateID'];
    $jsIsotopePar['menuID'] = $menuParts['menuID'];
    $jsIsotopePar['imgsLoaded'] = $menuParts['imgsLoaded'];

    //--- Menu options ---------------------------------------------
    $menuOptns = get_post_custom( $menuParts['menuID'] );

    $fCntrW = isset( $menuOptns['_fCntrW'] ) ? esc_attr( $menuOptns['_fCntrW'][0] ) : '';
    $fCntrCenter = isset( $menuOptns['_fCntrCenter'] ) ? esc_attr( $menuOptns['_fCntrCenter'][0] ) : 'Y';
    // Not added yet
    $fCntrCls = isset( $menuOptns['_fCntrCls'] ) ? esc_attr( $menuOptns['_fCntrCls'][0] ) : '';
    $fCntrStyle = isset( $menuOptns['_fCntrStyle'] ) ? esc_attr( $menuOptns['_fCntrStyle'][0] ) : '';

    //Plugin container CSS
    $cntrStyle = abcfl_css_w_responsive( $fCntrW, $fCntrW ) . $fCntrStyle;
    $centerCls = abcfsl_util_center_cls( $fCntrCenter, $clsPfix );
    $clsFItemsCntrMT = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemsCntrMT'] ) ? esc_attr( $menuOptns['_fItemsCntrMT'][0] ) : 'N', 'MT', $clsPfix );
    $clsFItemsCntrMB = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemsCntrMB'] ) ? esc_attr( $menuOptns['_fItemsCntrMB'][0] ) : 'N', 'MB', $clsPfix );
    $clsFtemMLR = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemMLR'] ) ? esc_attr( $menuOptns['_fItemMLR'][0] ) : '10', 'FItemMLR', $clsPfix );

    //$menuParts['noDataMsg'] = isset( $menuOptns['_noDataMsg'] ) ? esc_attr( $menuOptns['_noDataMsg'][0] ) : '';

    $noDataMsgM = isset( $menuOptns['_noDataMsg'] ) ? esc_attr( $menuOptns['_noDataMsg'][0] ) : '';
    $noDataMsg = abcfsl_util_no_data_alert( $menuParts['noDataMsgT'], $noDataMsgM );
    $menuParts['noDataMsg']  = $noDataMsg;
    $jsIsotopePar['noDataMsg'] = $noDataMsg;

    $clsFItemHlight = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemHlight'] ) ? esc_attr( $menuOptns['_fItemHlight'][0] ) : 'N', 'FActive', $clsPfix );
    $jsIsotopePar['clsFItemHlight'] = $clsFItemHlight;

    //-- Menu container -----------------
    $cntCntrCls = ltrim( trim( $centerCls . ' ' . $clsFtemMLR . ' ' . $clsFItemsCntrMB . ' ' . $clsFItemsCntrMT ) );
    $divMenuCntr = abcfsl_cnt_menu_generic_div( $clsPfix, 'FiltersCntr', $cntCntrCls, $cntrStyle );

    // ------------------------;
    $menuParts = abcfsl_cnt_menu_cat_i_items_cntr(  $menuOptns, '', '', $clsPfix, $menuParts );

    // Menu wrapper + menu items.
    $menuParts['menuItemsHTML'] = $divMenuCntr['cntrS'] . $menuParts['menuItemsHTML'] . $divMenuCntr['cntrE'];
    $menuParts['jsIsotope'] = abcfsl_cnt_js_i_cat_menu( $jsIsotopePar );

    return $menuParts;
}

// Retuns array: Menu container DIV + UL + Items AND parameters.
function abcfsl_cnt_menu_cat_i_items_cntr( $menuOptns, $baseCls, $customCls, $clsPfix, $menuParts ){

    $ulCls = '';
    $itemsHTML = '';
    $ulID = $clsPfix . $menuParts['menuType'];

    $clsFItemColor = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemColor'] ) ? esc_attr( $menuOptns['_fItemColor'][0] ) : 'D', 'FItemColor', $clsPfix );
    $clsFiltersCntr = trim ( $clsPfix . 'FItemsCntr_' . $menuParts['menuID'] . ' ' . $clsPfix . 'FItemsCntr ' . $clsFItemColor . ' ' . $customCls );
    $fItemsCenter = isset( $menuOptns['_fItemsCenter'] ) ? esc_attr( $menuOptns['_fItemsCenter'][0] ) : 'Y';
    if($fItemsCenter == 'Y') { $ulCls = $clsPfix . 'TxtCenter'; }

    //Div, filters container.
    $divFiltersCntr = abcfsl_cnt_menu_generic_div( $clsPfix, $baseCls, $clsFiltersCntr, '' );

    // Menu items
    $menuParts = abcfsl_cnt_menu_cat_i_items( $menuOptns, $menuParts );

    // Add cntr wrapper to menu items.
    $menuParts['menuItemsHTML'] = $divFiltersCntr['cntrS'] . abcfl_html_tag( 'ul', $ulID, $ulCls ) . $menuParts['menuItemsHTML'] . abcfl_html_tag_end( 'ul'). $divFiltersCntr['cntrE'];
    return $menuParts;
}


function abcfsl_cnt_menu_cat_i_items( $menuOptns, $menuParts ){

    $clsPfix = $menuParts['pfixSL'];
    
    //--- Associative array: slug => category name -------------------------------
    $termsStaffCats = abcfsl_util_staff_categories_all();

    if ( $termsStaffCats['error'] ) {
        $menuParts['menuItemsHTML'] = $termsStaffCats['terms'];
        return $menuParts;
    }

    // All staff categories (terms). Multidimensional array to associative array: slug - category name. [evergreen] => Evergreen
    $slugCatName = array();
    foreach ( $termsStaffCats['terms'] as $termItem) {
        $slugCatName[$termItem->slug] = $termItem->name;
    }

    // First item. Reqired. Defaults to All if left empty.
    $firstItemTxt = isset( $menuOptns['_defaultFTxt'] ) ? esc_attr( $menuOptns['_defaultFTxt'][0] ) : 'All';

    // Slugs saved as menu items (multidimensional array). Also used by staff page.
    $menuCatSlugs = get_post_meta( $menuParts['menuID'], '_catSlugs', true );

    $clsFItemFont = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemFont'] ) ? esc_attr( $menuOptns['_fItemFont'][0] ) : 'D', 'F', $clsPfix );
    $clsFItemHlight = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemHlight'] ) ? esc_attr( $menuOptns['_fItemHlight'][0] ) : 'N', 'FActive', $clsPfix );
    $upCase = isset( $menuOptns['_upCase'] ) ? $menuOptns['_upCase'][0] : 'N';
    //------------------------------------------------------------

    // ----------------------------------------------------
    $parCI['firstItemTxt'] = $firstItemTxt;
    $parCI['noSlug'] = false;
    $parCI['upCase'] = $upCase;
    $parCI['clsFItemFont'] = $clsFItemFont;    
    $parCI['clsFItemHlight'] = $clsFItemHlight;
    $parCI['clsPfix'] = $clsPfix;
    $parCI['catSlug'] = '';
    $parCI['catName'] = '';
    //----------------------------------------------------------

    // First menu item: Show all. 
    $menuItemsHTML = abcfsl_cnt_menu_cat_i_all( $parCI );

    if ( !$menuCatSlugs ){
        $menuParts['menuItemsHTML'] = $menuItemsHTML;
        return $menuParts;
    }    
    //------------------------------------------------

    // Multidimensional to indexed.
    $menuCatSlugs = array_column( $menuCatSlugs, 'catSlug' );

    // Other menu items.
    foreach ( $menuCatSlugs as $catSlug ) {
        
        $dataFilterCatSlug = ''; 
        $catName = ''; 
        $noSlug = false;

        if( empty( $catSlug ) ){ continue; }

        if( isset( $slugCatName[$catSlug] ) ){
            $catName = $slugCatName[$catSlug];
            $dataFilterCatSlug = '.' . $catSlug;
        }
        else{
            $catName = abcfsl_txt(2);
            $noSlug = true;
        }

        $parCI['catName'] = $catName;
        $parCI['catSlug'] = $catSlug;
        $parCI['dataFilterCatSlug'] = $dataFilterCatSlug;
        $parCI['noSlug'] = $noSlug;

        $menuItemsHTML .= abcfsl_cnt_menu_cat_i_item( $parCI );
    }

    $menuParts['menuItemsHTML'] = $menuItemsHTML;
    $menuParts['menuSlugs'] = $menuCatSlugs;

    return $menuParts;
}

function abcfsl_cnt_menu_cat_i_all( $parCI ){

    $parCI['catSlug'] = '*';
    $parCI['dataFilterCatSlug'] = '*';
    $parCI['catName'] = $parCI['firstItemTxt'];
    return abcfsl_cnt_menu_cat_i_item( $parCI, true );
}


//Menu item. Single LI element with data-filter.
function abcfsl_cnt_menu_cat_i_item( $parCI, $isFirst=false ){

    //Slug doesn't exist.
    if( $parCI['noSlug'] ) { return $parCI['catName']; }

    $clsActive = '';
    if( $isFirst ){ $clsActive = $parCI['clsFItemHlight']; }

    $clsATag = trim(  $clsActive . abcfsl_util_upper_cls( $parCI['upCase'], $parCI['clsPfix'] ) . ' ' . $parCI['clsFItemFont'] );
    $aTag = abcfl_html_a_tag('#', $parCI['catName'], '', $clsATag, '', '', true, '', 'data-filter="' . $parCI['dataFilterCatSlug'] . '"');

    return abcfl_html_tag_with_content( $aTag, 'li', '');
}

//-- scodeArgs -------------------------
// [id] => 9170
// [pversion] => 387
// [prefix] => abcfsl
// [category] => 
// [category-exclude] => 
// [random] => 
// [top] => 
// [master] => 
// [staff-az] => 
// [staff-category] => 
// [smid] => 0
// [staff-id] => 0
// [staff-name] => 
// [staff-name-sp] => 
// [page] => 
// [menu-id] => CAT-8962
// [ajax] => 0
// [group-id] => 
// [search-form] => 
// [multi-template] => 
// [d-sort] => 
// [d-sort-order] => 
// [order] => 
// [c-sort] => 
// [c-sort-order] => 
// [hidden-fields] => 0
// [hidden-records] => 0
// [private-fields] => 0
// [keep-dups] => 0
// [images-loaded] => 0
// [debug-spg] => 0
// [tplate] => AI

// menuParts
//[menuID] => 8962
// [pageURL] => 
// [first] => 
// [qryFilter] => 
// [menuType] => CATI
// [filterField] => 
// [filterType] => 
// [filter1Type] => 
// [filter2Type] => 
// [filter3Type] => 
// [filter4Type] => 
// [filter5Type] => 
// [filter6Type] => 
// [filter1Field] => 
// [filter2Field] => 
// [filter3Field] => 
// [filter4Field] => 
// [filter5Field] => 
// [filter6Field] => 
// [minLen] => Array
//     (
//         [1] => 3
//         [2] => 3
//         [3] => 3
//         [4] => 3
//         [5] => 3
//         [6] => 3
//     )

// [menuItemsHTML] => 
// [noDataMsg] => 
// [pfixSL] => abcfsl
// [searchBtnName] => mfSearchBtn
// [resetBtnName] => mfResetBtn
// [jsIsotope] => 
// [menuSlugsAr] => Array
//     (
//     )

// [errorTerms] => 