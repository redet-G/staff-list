<?php
//Retuns array. Menu wrap with items + menu parameters
function abcfsl_cnt_menu_i_builder( $scodeArgs, $menuPar ){

    $clsPfix = $scodeArgs['prefix'];
    $menuID = $menuPar['menuID'];
    $menuType = $menuPar['menuType'];
    $pageURL = $menuPar['pageURL'];
    $qryFilter = '';

    $parM['clsPfix'] = $clsPfix;
    $parM['tplateID'] = $scodeArgs['id'];
    //$parM['clsFItemHligh'] = abcfrggcl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemHlight'] ) ? esc_attr( $menuOptns['_fItemHlight'][0] ) : 'N', 'FActive', $clsPfix );
    $parM['windowLoad'] = 0;
    $parM['imgsLoaded'] = isset( $tplateOptns['_imgsLoaded'] ) ? $tplateOptns['_imgsLoaded'][0] : 1;
    //$parM['firstSlug'] = $firstSlug;
    //$scodeMaster = $scodeArgs['master'];

    //error_log( print_r( $menuType, true) );

    // AJAX Isotope doesn't use ajax option ------------------------
    $scodeAjax = 0;

    switch ( $menuType ) {
        case 'CATI':
            $qryFilter = $scodeArgs['staff-category'];
            break;
        case 'AZMI':
            $qryFilter = $scodeArgs['staff-az'];
            break;
        default:
            return abcfsl_util_menu_defaults();
    }

    $menuOptns = get_post_custom( $menuID );
    $fCntrW = isset( $menuOptns['_fCntrW'] ) ? esc_attr( $menuOptns['_fCntrW'][0] ) : '';
    $fCntrCenter = isset( $menuOptns['_fCntrCenter'] ) ? esc_attr( $menuOptns['_fCntrCenter'][0] ) : 'Y';

    // TODO check if used?
    $fCntrCls = isset( $menuOptns['_fCntrCls'] ) ? esc_attr( $menuOptns['_fCntrCls'][0] ) : '';
    $fCntrStyle = isset( $menuOptns['_fCntrStyle'] ) ? esc_attr( $menuOptns['_fCntrStyle'][0] ) : '';

    //Plugin container CSS
    $cntrStyle = abcfl_css_w_responsive( $fCntrW, $fCntrW ) . $fCntrStyle;
    $centerCls = abcfsl_util_center_cls( $fCntrCenter, $clsPfix );
    $clsFItemsCntrMT = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemsCntrMT'] ) ? esc_attr( $menuOptns['_fItemsCntrMT'][0] ) : 'N', 'MT', $clsPfix );
    $clsFItemsCntrMB = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemsCntrMB'] ) ? esc_attr( $menuOptns['_fItemsCntrMB'][0] ) : 'N', 'MB', $clsPfix );
    $clsFtemMLR = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemMLR'] ) ? esc_attr( $menuOptns['_fItemMLR'][0] ) : '10', 'FItemMLR', $clsPfix );

    //Menu container -----------------
    $cntCntrCls = ltrim( trim( $centerCls . ' ' . $clsFtemMLR . ' ' . $clsFItemsCntrMB . ' ' . $clsFItemsCntrMT ) );
    $div = abcfsl_cnt_menu_generic_div($clsPfix, 'FiltersCntr', $cntCntrCls, $cntrStyle);

    // AJAX ------------------------;
    $menu = abcfsl_cnt_menu_i_items_cntr( $menuType, $qryFilter, $menuID, $menuOptns, '', '', $clsPfix, $pageURL, $scodeAjax );
    $menu['menuItemsHTML'] = $div['cntrS'] . $menu['menuItemsHTML'] . $div['cntrE'];

    $menu['jsIsotope'] = abcfsl_cnt_js_i_isotope( $parM );

    return $menu;
}

//Called from abcfsl_cnt_menu_builder. Retuns array: Menu container DIV + UL + Items AND parameters.
function abcfsl_cnt_menu_i_items_cntr( $menuType, $qryFilter, $menuID, $menuOptns, $baseCls, $customCls, $clsPfix, $pageURL, $scodeAjax){

    $ulCls = '';
    $menu = array();
    $itemsHTML = '';
    $ulID = $clsPfix . 'Filters';
    if( !empty($menuType) ) { $ulID = $clsPfix . $menuType; }

    $clsFItemColor = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemColor'] ) ? esc_attr( $menuOptns['_fItemColor'][0] ) : 'D', 'FItemColor', $clsPfix );
    $clsFiltersCntr = trim ( $clsPfix . 'FItemsCntr_' . $menuID . ' ' . $clsPfix . 'FItemsCntr ' . $clsFItemColor . ' ' . $customCls );
    $fItemsCenter = isset( $menuOptns['_fItemsCenter'] ) ? esc_attr( $menuOptns['_fItemsCenter'][0] ) : 'Y';
    if($fItemsCenter == 'Y') { $ulCls = $clsPfix . 'TxtCenter'; }

    //Div, filters container.
    $divFiltersCntr = abcfsl_cnt_menu_generic_div( $clsPfix, $baseCls, $clsFiltersCntr, '' );

    switch ( $menuType ) {
        case 'CATI':
            $menu = abcfsl_cnt_menu_cat_i_items( $qryFilter, $menuID, $menuOptns, $clsPfix, $pageURL, $menuType );
            break;
        case 'AZM':
            $menu = abcfsl_cnt_menu_az_items( $qryFilter, $menuOptns, $clsPfix, $pageURL, $scodeAjax );
            break;
        default:
            break;
    }
    $menu['menuID'] = $menuID;
    $menu['menuItemsHTML'] = $divFiltersCntr['cntrS'] . abcfl_html_tag( 'ul', $ulID, $ulCls ) . $menu['menuItemsHTML'] . abcfl_html_tag_end( 'ul'). $divFiltersCntr['cntrE'];
    return $menu;
}

//==============================================================
// //Concatinate class name: prefix + BaseName + Value. Return empty if N or C. Return default if. 
// function abcfsl_cnt_menu_cls_name_nc_bldr( $optnValue, $clsBaseName, $clsPfix ){

//     if( $optnValue == 'N' ){ return ''; }
//     if( $optnValue == 'C' ){ return ''; }
//     if( $optnValue == 'D' ) { return ''; }
//     if( empty( $optnValue) ) { return ''; }
//     return ' ' . $clsPfix . $clsBaseName . $optnValue;
// }

// // generic DIV
// function abcfsl_cnt_menu_generic_div( $clsPfix, $baseCls, $customCls, $customStyle ){

//     $cntrCls = abcfsl_cnt_menu_class_bldr( $clsPfix, $baseCls, $customCls );

//     $div['cntrS'] = abcfl_html_tag( 'div', '', $cntrCls, $customStyle );
//     $div['cntrE'] = abcfl_html_tag_end( 'div');

//     return $div;
// }

// function abcfsl_cnt_menu_class_bldr( $clsPfix, $baseCls, $customCls ){

//     $cntrBaseCls = '';
//     if( !empty( $baseCls ) ){ $cntrBaseCls = $clsPfix . $baseCls; }

//     return  trim( $cntrBaseCls . ' ' . $customCls );
// }

// function abcfsl_cnt_menu_standard_div( $clsPfix, $baseCls, $customCls, $customStyle, $id='', $microdata='' ){

//     $cntrCls = abcfsl_cnt_menu_class_bldr( $clsPfix, $baseCls, $customCls );

//     //abcfl_html_tag( $element, $id, $cls='', $style='', $microdata='' )
//     $div['cntrS'] = abcfl_html_tag( 'div', $id, $cntrCls, $customStyle, $microdata );
//     $div['cntrE'] = abcfl_html_tag_end( 'div');

//     return $div;
// }
