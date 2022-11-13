<?php
//ALL CONTENT HTML. 
//Called from a shortcode. Used by all layouts.
//Calls individual layouts, menus, pagination.
//Adds AJAX script when ajax parameter is set. 
function abcfsl_cnt_html( $scodeArgs ){

    $pageNo = $scodeArgs['page'];
    $pfix = $scodeArgs['prefix'];
    $ajax = $scodeArgs['ajax'];
    $staffID = $scodeArgs['staff-id'];
    $searchForm = $scodeArgs['search-form'];
    $scodeMenuID = $scodeArgs['menu-id'];
    // Menu not linked to a page. Keep for backward compatibility. Deprecated ???????
    $menuScode = $scodeArgs['menu-scode'];
    $scodeTplate = $scodeArgs['tplate'];

    // GRPCAT GRPTXT GRPABC -------------------------
    $grpParts = abcfsl_util_scode_group_parts( $scodeArgs['group-id'] );
    $grpID = $grpParts['id'];
    $grpType = $grpParts['type'];
    //------------------------------------

    // Parent ID = source of staff member IDs. Parent ID can be template ID or master ID. Template ID is always used for options.
    $tplateID = $scodeArgs['id'];
    $parentID = $tplateID;
    if( $scodeArgs['master'] > 0 ){ $parentID = $scodeArgs['master']; }
    //=============================================================
    $tplateOptns = get_post_custom( $tplateID );
    $tplateOptns['slTplateID'] = $tplateID;

    // Field STFFCAT. Add excluded subcategories
    $tplateOptns = abcfsl_util_fix_cat_excluded_slugs( $tplateOptns );

    // Staff list container (wrap).  
    $lstCntrW = isset( $tplateOptns['_lstCntrW'] ) ? esc_attr( $tplateOptns['_lstCntrW'][0] ) : '';
    $lstACenter = isset( $tplateOptns['_lstACenter'] ) ? esc_attr( $tplateOptns['_lstACenter'][0] ) : 'Y';
    $lstCntrCls = isset( $tplateOptns['_lstCntrCls'] ) ? esc_attr( $tplateOptns['_lstCntrCls'][0] ) : '';
    $lstCntrTM = isset( $tplateOptns['_lstCntrTM'] ) ? esc_attr( $tplateOptns['_lstCntrTM'][0] ) : '';
    $lstCntrStyle = isset( $tplateOptns['_lstCntrStyle'] ) ? esc_attr( $tplateOptns['_lstCntrStyle'][0] ) : '';
    $pgnationPgQty = isset( $tplateOptns['_pgnationPgQty'] ) ? $tplateOptns['_pgnationPgQty'][0] : 0;
    $pgnationTB = isset( $tplateOptns['_pgnationTB'] ) ? $tplateOptns['_pgnationTB'][0] : 'B';
    $pgnationColor = isset( $tplateOptns['_pgnationColor'] ) ? $tplateOptns['_pgnationColor'][0] : 'G';
    $sortType = isset( $tplateOptns['_sortType'] ) ? $tplateOptns['_sortType'][0] : 'T';
    $noDataMsgT = isset( $tplateOptns['_noDataMsg'] ) ? esc_attr( $tplateOptns['_noDataMsg'][0] ) : '';
    //------------------------------------------------
    
    $menuNo = $scodeMenuID;
    $hasMenu = abcfsl_util_menu_has_menu( $menuNo );

    // Check when and how used ??????????????????????? Filters not used for Isotope.
    $hasFilters = abcfsl_util_menu_has_filters( $menuNo );

    //-- MULTIFILTER START -------------------------------------
    $btn = '';
    $frmType = '';
    $filtersEmpty = true;
    $filters = abcfsl_util_filters_defaults();

    if( $hasFilters ){
        $filters = abcfsl_cnt_filter_post( $menuNo );
        $filtersEmpty = abcfsl_cnt_filters_empty( $filters );
        $btn = $filters['btn'];
        $frmType = $filters['frmType'];
        if( !empty( $searchForm ) ) { $frmType = $searchForm; }
    }
    //-- MULTIFILTER END -------------------------------------

    // No paging if there are any search criteria present.  Not used for Isotope.
    $pgnationPgQtyAjax = $pgnationPgQty;
    if( !$filtersEmpty ) {
        $pgnationPgQty = 0;
        $pageNo = 0;
        $tplateOptns['_pgnationPgQty'][0] = 0;
    }

    //-- AJAX -------------------------------------
    $ajaxMenu = false;
    $ajaxMFP = false;

    if( $ajax > 0 ) { 
        $ajaxMenu = true;  
        $ajaxMFP = true;
    }

    //------------------------------------------------
    //?????????
    //$lstImgCls = isset( $tplateOptns['_lstImgCls'] ) ? esc_attr( $tplateOptns['_lstImgCls'][0] ) : $pfix . 'ImgCenter';
    //$tplateOptns['_lstImgCls'] = array($lstImgCls);

    //-- Plugin container --------------------------------------------
    $cntCntrStyle = abcfl_css_w_responsive( $lstCntrW, $lstCntrW ) . $lstCntrStyle;
    $centerCls = abcfsl_util_center_cls( $lstACenter, $pfix );
    $cntrMarginT = abcfsl_util_cls_name_nc_bldr( $lstCntrTM, 'MT', $pfix );
    //$cntCntrCustomCls = $lstCntrCls . $cntrMarginT . $centerCls . ' SL_' . $scodeTplate . '_slv' . $scodeArgs['pversion'];
    $cntCntrCustomCls = $lstCntrCls . $cntrMarginT . $centerCls . ' slv' . $scodeArgs['pversion'] . '_t' . $tplateID . '_' . $scodeTplate;
    $gridCntr = abcfsl_cnt_generic_div( $pfix, 'GridCntr', $cntCntrCustomCls, $cntCntrStyle, '', $tplateID, 'Y', false);

    //-- MENU START -------------------------------------
    // Returns array: menu HTML, menu options and qry parameters OR qry parameters.
    // Menu HTML + menu options. Not search criteria. // MULTIFILTER
    $menuParts = abcfsl_util_menu_defaults();
    $menuParts['noDataMsgT'] = $noDataMsgT;
    if( $hasMenu ) {
        $menuParts['tplateID'] = $tplateID;
        $menuParts['imgsLoaded'] = $scodeArgs['images-loaded'];
        $menuParts = abcfsl_cnt_menu_parts( $menuNo, $scodeArgs, $filters, $ajaxMFP, $ajax, $menuParts ); 
    }

    // Menu HTML.
    $menuItemsHTML = $menuParts['menuItemsHTML'];
    if( $menuScode == 1 ) { $menuItemsHTML = ''; }
    $menuParts['menuItemsHTML'] = '';
    
    $jsIsotope = $menuParts['jsIsotope'];
    $menuParts['jsIsotope'] = '';
    
    $menuSlugs = $menuParts['menuSlugs'];
    $menuParts['menuSlugs'] = '';
    //-- MENU END -------------------------------------

    //---OPTIONS START ------------------------------------
    $optns['tplateID'] = $tplateID;
    $optns['parentID'] = $parentID;
    $optns['pfix'] =  $pfix;
    $optns['ajax'] = $ajax;
    $optns['random'] = $scodeArgs['random'];
    $optns['scodeOrder'] = strtoupper($scodeArgs['order']);
    $optns['dSortOrder'] = strtoupper($scodeArgs['d-sort-order']); 
    $optns['dSort'] =  strtoupper($scodeArgs['d-sort']);
    $optns['cSort'] =  strtoupper($scodeArgs['c-sort']);
    $optns['cSortOrder'] = strtoupper($scodeArgs['c-sort-order']);
    $optns['scodeCat'] = $scodeArgs['category']; 
    $optns['scodeCatExcl'] = $scodeArgs['category-exclude']; 
    $optns['top'] = $scodeArgs['top'];
    $optns['hiddenFields'] = $scodeArgs['hidden-fields'];
    $optns['privateFields'] = $scodeArgs['private-fields'];
    $optns['hiddenRecords'] = $scodeArgs['hidden-records'];
    $optns['keepDups'] = $scodeArgs['keep-dups'];
    $optns['staffID'] = $staffID;
    $optns['grpID'] = $grpID;
    $optns['grpType'] = $grpType;
    $optns['sortType'] = $sortType;
    
    //$optns['datePlus'] = $scodeArgs['date-plus'];
    //-- PG -------------------
    $optns['pageNo'] = $pageNo;
    $optns['pgnationPgQty'] =  $pgnationPgQty;
    //---OPTIONS END ------------------------------------
    
    $cntParts = abcfsl_util_pg_cnt_parts_defaults( $noDataMsgT, $menuParts['noDataMsg'] );    
    // ['itemsHTML'] = No data msg.
    // [ldjsonSD] => 
    // [totalQty] => 0
    // [pgnCnt] => 

    // -- SFORM SEARCH FORM --------------------------------------
    $showRecords = true;
    if( $btn == 'reset' && $frmType == 'SF' ) { $showRecords = false; }

    if( $filtersEmpty ) {
        if( $btn == 'search' && $frmType == 'SF' ) { $showRecords = false; }
    }
    //--------------------------------------------------------
        // $defaultParts = abcfsl_util_pg_cnt_parts_defaults( $noDataMsgT, $menu['noDataMsg'] );
        // $out = abcfsl_paginator_post_ids( $optns, $menu, $filters );
        // $totalQty = $out['totalQty'];
        // if( $totalQty == 0 ) { return $defaultParts; }
        // $postIDs = $out['postIDs'];
    //--------------------------------------------------------

    // Returns cntParts. jsIsotope; menuItemsHTML; Filtered grid based on menu options.
    if( $showRecords ) {
        switch ( $scodeTplate ) {
            case 'A' :
                $cntParts = abcfsl_cnt_grid_a( $tplateOptns, $optns, $menuParts, $filters );
                break;
            case 'B' :
                $cntParts = abcfsl_cnt_grid_b( $tplateOptns, $optns, $menuParts, $filters );
                break;
            case 'C' :
                $cntParts = abcfsl_cnt_grid_c( $tplateOptns, $optns, $menuParts, $filters );
                break;                
            case 'L' :
                $cntParts = abcfsl_cnt_list( $tplateOptns, $optns, $menuParts, $filters );
                break;
            case 'AI' :
                $cntParts = abcfsl_cnt_grid_ai( $tplateOptns, $optns, $menuParts, $menuSlugs );
                break;
            case 'BI' :
                $cntParts = abcfsl_cnt_grid_bi( $tplateOptns, $optns, $menuParts, $menuSlugs );
                break;
            case 'CI' :
                $cntParts = abcfsl_cnt_grid_ci( $tplateOptns, $optns, $menuParts, $menuSlugs );
                break;  
            case 'LI' :
                $cntParts = abcfsl_cnt_list_i( $tplateOptns, $optns, $menuParts,  $menuSlugs );
                break;                               
            default:
                break;
        }
    }

    // $cntParts
    // ['itemsHTML'] = content.
    // [ldjsonSD] => 
    // [totalQty] => 0
    // [pgnCnt] => 

    //== AJAX START ==================================
    if( $staffID > 0 ) { $ajax = 0;}

    $jsAjax = '';
    $ajaxItemsS = '';
    $ajaxDivE = '';
    $ajaxSdS = '';
    $ajaxPgnS = '';
    $ajaxLoader = '';

    // === Page number container ====================
    $pgnCnt = $cntParts['pgnCnt'];
    $pgnT = '';
    $pgnB = '';

    if ( $pgnationTB == 'T' ){ $pgnT = $pgnCnt; }
    else { $pgnB = $pgnCnt; }
    //==============================================

    $ajaxPar['ajax'] = $ajax;
    $ajaxPar['tplateID'] = $tplateID;
    $ajaxPar['parentID'] = $parentID;
    $ajaxPar['pfix'] = $pfix;
    $ajaxPar['scodeArgs'] = $scodeArgs;
    $ajaxPar['scodeMenuID'] = $scodeMenuID;
    $ajaxPar['pgnationPgQty'] = $pgnationPgQtyAjax;
    $ajaxPar['menu'] = $menuParts;
    $ajaxPar['filters'] = $filters;
    //$ajaxPar['filtersEmpty'] = $filtersEmpty;
    $ajaxPar['sortType'] = $sortType;
    $ajaxPar['grpID'] = $grpID;
    $ajaxPar['grpType'] = $grpType;
    $ajaxPar['pgnationColor'] = $pgnationColor;
    $ajaxPar['ajaxMenu'] = $ajaxMenu;
    $ajaxPar['ajaxMFP'] = $ajaxMFP;

    if( $ajax > 0 ) {
        $jsPar = abcfsl_js_params( $ajaxPar );
        $jsAjax = abcfsl_cnt_js_ajax( $jsPar );

        $ajaxItemsS = abcfl_html_tag( 'div', '', $jsPar['clsItemsCntr'], '' );
        $ajaxSdS = abcfl_html_tag( 'div', '', $jsPar['clsSDCntr'], '' );
        $ajaxPgnS = abcfl_html_tag( 'div', $jsPar['clsPgnCntr'], '', '' );
        $ajaxDivE = abcfl_html_tag_end( 'div' );

        if(!empty( $pgnT )) { $pgnT = $ajaxPgnS . $pgnT . $ajaxDivE; }
        if(!empty( $pgnB )) { $pgnB = $ajaxPgnS . $pgnB . $ajaxDivE; }

        //Ajax pagination container for ALL last.
        if( empty( $pgnT )  &&  empty( $pgnB ) ) { 
            if( $pgnationPgQtyAjax > 0 ) {
                if ( $pgnationTB == 'T' ){   
                    $pgnT = $ajaxPgnS . $ajaxDivE;                  
                }
                else { 
                    $pgnB = $ajaxPgnS . $ajaxDivE;
                 }
            }
         }

        $ajaxLoader = abcfsl_util_ajax_loader( 'ajax-loader-bert-gray.gif', $ajax, $pfix );
    }
    //== AJAX END ==================================

    //Render page
    $cntHTML = $jsIsotope .
            $menuItemsHTML .
            $gridCntr['cntrS'] .
            $pgnT .
            $ajaxLoader .
            $ajaxItemsS .
            $cntParts['itemsHTML'] .
            $ajaxDivE .
            $pgnB .
            $gridCntr['cntrE']; 
            
    //Structured data
    $jsonLdSD = $ajaxSdS . $cntParts['ldjsonSD'] .  $ajaxDivE;

    return $jsAjax . $cntHTML . $jsonLdSD;
}

//===== ???????????????? =============================================================
function abcfsl_cnt_generic_div( $pfix, $baseCls, $customCls, $customStyle, $divID, $itemID, $addItemCls, $isSingle ){

    $cntrCls = abcfsl_cnt_class_bldr( $pfix, $baseCls, $customCls, $isSingle, $addItemCls, $itemID );

    $div['cntrS'] = abcfl_html_tag( 'div', $divID, $cntrCls, $customStyle );
    $div['cntrE'] = abcfl_html_tag_end( 'div');

    return $div;
}

function abcfsl_cnt_generic_div_simple( $customCls, $customStyle, $divID='' ){
    return abcfsl_cnt_generic_div( '', '', $customCls, $customStyle, $divID, '', 'N', false );
}

function abcfsl_cnt_simple_div( $id, $cls, $style ){

    $div['cntrS'] = abcfl_html_tag( 'div', $id, $cls, $style );
    $div['cntrE'] = abcfl_html_tag_end( 'div');

    return $div;
}

//Returns classes
function abcfsl_cnt_class_bldr( $pfix, $baseCls, $customCls, $isSingle=false, $addItemCls='N', $itemID='0' ){

    $cntrBaseCls = '';
    if( !empty( $baseCls ) ){ $cntrBaseCls = $pfix . $baseCls; }
    $custCls = abcfsl_util_pg_type_cls_bldr( $customCls, $isSingle );

    $itemCls = '';
    if($addItemCls == 'Y'){ $itemCls = ' ' . $cntrBaseCls . '_' . $itemID; }

    return  trim( $cntrBaseCls . ' ' . $custCls . $itemCls );
}

function abcfsl_cnt_item_inner_cntr( $custCls, $custStyle, $itemCustCls, $itemID ){

    $out['cntrS'] = '';
    $out['cntrE'] = '';
    if ( empty( $custCls ) && empty( $custStyle ) && empty( $itemCustCls ) ) { return $out; } 

    $iID = '';
    $custCls = trim($custCls . ' ' . $itemCustCls);
    if ( !empty( $itemCustCls ) ){ $iID = $itemID; }

    $out['cntrS'] = abcfl_html_tag( 'div', $iID, $custCls, $custStyle );
    $out['cntrE'] = abcfl_html_tag_end( 'div');
    return $out;
}

function abcfsl_cnt_item_cntr( $custCls, $custStyle, $requiredCls, $itemID, $itemCustCls ){

    $iID = '';
    if ( !empty( $custCls ) ){ $custCls = ' ' . $custCls; }
    if( !empty( $itemCustCls ) ) { 
        $itemCustCls = ' ' . $itemCustCls; 
        $iID = $itemID;
    }
    
    $divCls = $requiredCls . $custCls . $itemCustCls . ' abcfClrFix';
    //Item container DIV
    $div['itemCntrS'] = abcfl_html_tag( 'div', $iID, $divCls , $custStyle );
    $div['itemCntrE'] = abcfl_html_tag_end( 'div');
    return $div;
}

function abcfsl_cnt_filters_empty( $filters ){

    //Array ( [1] => * [2] => * [3] => [4] => [5] => [6] => [btn] => search [frmType] => ) 
    //Check only first 6 items.
    $empty = true;
    for ($x = 1; $x <= 6; $x++) {        
        if( !empty( $filters[$x] ) ){ 
            if( $filters[$x] == '*' ) { continue; }           
            $empty = false;
            break;
        }
    }
    return $empty;
}

//== ISOTOPE ==========================================================
// In: Indexed array of menu (or MTF) slugs.
// Out: String. Category slugs of idividual staff member. To be used as classes. 
function abcfsl_cnt_cat_slugs_for_isotope_item_cntr( $postID, $menuSlugs ){

    $slugs = '';
    if ( empty( $menuSlugs ) ) { return $slugs; }

    $terms = abcfsl_db_posts_cat_slugs( $postID );
    if ( empty( $terms ) ) { return $slugs; }
    
    // Get single array of matched slugs. Remove not included in menu. . 
    $matchedSlugs = array_intersect( $terms, $menuSlugs );

    // Output: space delimited string of category slugs of single staff member.
    foreach ( $matchedSlugs as $matchedSlug ) {
            $slugs .= ' ' . $matchedSlug;
    }

    return $slugs;

    // menuSlugs = indexed array of menu (or MTF) slugs.
    // terms = indexed array of category slugs of single staff member.
    // [0] => administrators
    // [1] => team
    // [2] => schamburg    
}

function abcfsl_cnt_parts_isotope( $totalQty, $itemsHTML, $itemsSD ){

    $cntParts['itemsHTML'] = $itemsHTML;
    $cntParts['totalQty'] = $totalQty;
    $cntParts['ldjsonSD'] = abcfsl_struct_data( $itemsSD );
    $cntParts['pgnCnt'] = '';

   return $cntParts;
}

// $menuParts:
//
// [menuID] => 8962
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
// [noDataMsg] => No Records Found menu
// [pfixSL] => abcfsl
// [searchBtnName] => mfSearchBtn
// [resetBtnName] => mfResetBtn
// [jsIsotope] => 
// [menuSlugs] => Array
//     (
//         [0] => evergreen
//         [1] => loop
//         [2] => roselle
//     )

// [errorTerms] => 