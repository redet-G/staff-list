<?php
/*
 * ADDED AJAX
 * Called from cnt.php.
 * Used for all types of menus and filters.
 * Returns array menu : HTML, menu options and qry parameters OR qry parameters.
 */
//==== abcfsl_cnt_menu_from_staff_shortcode ==== abcfsl_cnt_menu_parts_from_staff_shortcode ====================================================
function abcfsl_cnt_menu_parts( $menuNo, $scodeArgs, $filters, $ajaxMFP, $ajax, $menuParts ){

   // Menu option selected: Menu or Shortcode.
   $menuPar['menuType'] = substr( $menuNo, 0, 3 );
   $menuPar['menuID'] = substr( $menuNo, 4 );

   // Tplate:  A, B, C, L, AI, BI, CI, LI. Add I suffix to menus when used on isotope pages.
   $menuTypeFixed = abcfsl_cnt_menu_type_by_tplate_type( $menuPar['menuType'], $scodeArgs['tplate'] );

   $menuPar['menuType'] = $menuTypeFixed;
   $menuParts['menuID'] = $menuPar['menuID'];
   $menuParts['menuType'] = $menuTypeFixed;
   $menuParts['pfixSL'] = $scodeArgs['prefix'];

   //Menu ID and Type is always set in shortcode (menu No).
   switch ( $menuTypeFixed ) {
       case 'CAT':
       case 'AZM':
            global $post;
            $menuPar['pageURL'] = abcfsl_cnt_menu_pageURL( $post->ID, $ajax );
            return abcfsl_cnt_menu_builder( $scodeArgs, $menuPar ); 
        case 'CATI':          
            $menuParts = abcfsl_cnt_menu_cat_i_builder( $menuParts );
            break;
        case 'MTF':
            $menuParts = abcfsl_cnt_filter_html( $menuParts, $filters, $scodeArgs, $ajaxMFP, $ajax );
            break;
        case 'MTFI':
            $menuParts = abcfsl_cnt_mtf_i_builder( $menuParts ); 
            break;          
       case 'MFP':
            //WHY abcfslt ????????????????????????
            if ( function_exists( 'abcfslt_cnt_frm_builder_MFP' ) ){  
                return abcfslt_cnt_frm_builder_MFP( $menuParts, $filters, $ajaxMFP, $ajax );
            }
            if ( function_exists( 'abcfsls_cnt_filter_html' ) ){  
                return abcfsls_cnt_filter_html( $menuParts, $filters, 'abcfsl', $ajaxMFP, $ajax );
            }
           return $menuParts;
        default:
           break;
   }

   return $menuParts;
}
//=======================================================
function abcfsl_cnt_menu_type_by_tplate_type( $scodeMenuType, $scodeTplate ){

    $menuTypeSuffix = '';

    switch ( $scodeTplate ) {
        case 'AI':
            $menuTypeSuffix = 'I'; 
            break;     
        case 'BI':
            $menuTypeSuffix = 'I'; 
            break; 
        case 'CI':
            $menuTypeSuffix = 'I'; 
            break; 
        case 'LI':
            $menuTypeSuffix = 'I'; 
            break;            
         default:
            break;
    }

    switch ( $scodeMenuType ) {
        case 'CAT':
            $scodeMenuType = $scodeMenuType . $menuTypeSuffix;
            break;       
        case 'MTF':
            $scodeMenuType = $scodeMenuType . $menuTypeSuffix;
            break;
         default:
            break;
    }
    return $scodeMenuType;
}

function abcfsl_cnt_menu_pageURL( $postID, $ajax ){
    if( $ajax > 0 ) { return ''; }
    return get_permalink( $postID );
}
//====================================================================================
//Retuns array: Menu wrap with items + menu parameters
function abcfsl_cnt_menu_builder( $scodeArgs, $menuPar ){

    $pfix = $scodeArgs['prefix'];
    $menuID = $menuPar['menuID'];
    $menuType = $menuPar['menuType'];
    $pageURL = $menuPar['pageURL'];
    $qryFilter = '';

    // AJAX ------------------------
    //Ajax Menu have to use shortcode arg: menu-id. Otherwise it's no Ajax
    $scodeAjax = $scodeArgs['ajax'];
    $scodeMenuID = $scodeArgs['menu-id'];
    if( empty( $scodeMenuID ) ) { $scodeAjax = 0;}

    switch ( $menuType ) {
        case 'CAT':
            $qryFilter = $scodeArgs['staff-category'];
            break;
        case 'AZM':
            $qryFilter = $scodeArgs['staff-az'];
            break;
        default:
            break;
    }

    $menuOptns = get_post_custom( $menuID );
    $fCntrW = isset( $menuOptns['_fCntrW'] ) ? esc_attr( $menuOptns['_fCntrW'][0] ) : '';
    $fCntrCenter = isset( $menuOptns['_fCntrCenter'] ) ? esc_attr( $menuOptns['_fCntrCenter'][0] ) : 'Y';

    // TODO check if used?
    $fCntrCls = isset( $menuOptns['_fCntrCls'] ) ? esc_attr( $menuOptns['_fCntrCls'][0] ) : '';
    $fCntrStyle = isset( $menuOptns['_fCntrStyle'] ) ? esc_attr( $menuOptns['_fCntrStyle'][0] ) : '';

    //Plugin container CSS
    $cntrStyle = abcfl_css_w_responsive( $fCntrW, $fCntrW ) . $fCntrStyle;
    $centerCls = abcfsl_util_center_cls( $fCntrCenter, $pfix );
    $clsFItemsCntrMT = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemsCntrMT'] ) ? esc_attr( $menuOptns['_fItemsCntrMT'][0] ) : 'N', 'MT', $pfix );
    $clsFItemsCntrMB = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemsCntrMB'] ) ? esc_attr( $menuOptns['_fItemsCntrMB'][0] ) : 'N', 'MB', $pfix );
    $clsFtemMLR = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemMLR'] ) ? esc_attr( $menuOptns['_fItemMLR'][0] ) : '10', 'FItemMLR', $pfix );

    //Menu container -----------------
    $cntCntrCls = ltrim( trim( $centerCls . ' ' . $clsFtemMLR . ' ' . $clsFItemsCntrMB . ' ' . $clsFItemsCntrMT ) );
    $div = abcfsl_cnt_menu_generic_div($pfix, 'FiltersCntr', $cntCntrCls, $cntrStyle);

    // AJAX ------------------------
    $menu = abcfsl_cnt_menu_items_cntr( $menuType, $qryFilter, $menuID, $menuOptns, '', '', $pfix, $pageURL, $scodeAjax );
    $menu['menuItemsHTML'] = $div['cntrS'] . $menu['menuItemsHTML'] . $div['cntrE'];

    return $menu;
}

//Called from abcfsl_cnt_menu_builder
//Retuns array: Menu container DIV + UL + Items AND parameters.
function abcfsl_cnt_menu_items_cntr( $menuType, $qryFilter, $menuID, $menuOptns, $baseCls, $customCls, $pfix, $pageURL, $scodeAjax){

    $ulCls = '';
    $menu = array();
    $itemsHTML = '';
    $ulID = $pfix . 'Filters';
    if( !empty($menuType) ) { $ulID = $pfix . $menuType; }
    //AJAX
    if( !empty($menuType) && $scodeAjax > 0 ) { $ulID = $pfix . 'Ajax' . $menuType . '_' . $scodeAjax; }

    $clsFItemColor = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemColor'] ) ? esc_attr( $menuOptns['_fItemColor'][0] ) : 'D', 'FItemColor', $pfix );
    $clsFiltersCntr = trim ( $pfix . 'FItemsCntr_' . $menuID . ' ' . $pfix . 'FItemsCntr ' . $clsFItemColor . ' ' . $customCls );
    $fItemsCenter = isset( $menuOptns['_fItemsCenter'] ) ? esc_attr( $menuOptns['_fItemsCenter'][0] ) : 'Y';
    if($fItemsCenter == 'Y') { $ulCls = $pfix . 'TxtCenter'; }

    //Div, filters container.
    $divFiltersCntr = abcfsl_cnt_menu_generic_div( $pfix, $baseCls, $clsFiltersCntr, '' );

    switch ( $menuType ) {
        case 'CAT':
            $menu = abcfsl_cnt_menu_cat_items( $qryFilter, $menuID, $menuOptns, $pfix, $pageURL, $scodeAjax );
            break;
        case 'AZM':
            $menu = abcfsl_cnt_menu_az_items( $qryFilter, $menuOptns, $pfix, $pageURL, $scodeAjax );
            break;
        default:
            break;
    }
    $menu['menuID'] = $menuID;
    $menu['menuItemsHTML'] = $divFiltersCntr['cntrS'] . abcfl_html_tag( 'ul', $ulID, $ulCls ) . $menu['menuItemsHTML'] . abcfl_html_tag_end( 'ul'). $divFiltersCntr['cntrE'];
    return $menu;
}

//==============================================================
//Concatinate class name: prefix + BaseName + Value. Return empty if N or C. Return default if. 
function abcfsl_cnt_menu_cls_name_nc_bldr( $optnValue, $clsBaseName, $pfix ){

    if( $optnValue == 'N' ){ return ''; }
    if( $optnValue == 'C' ){ return ''; }
    if( $optnValue == 'D' ) { return ''; }
    if( empty( $optnValue) ) { return ''; }
    return ' ' . $pfix . $clsBaseName . $optnValue;
}

// generic DIV
function abcfsl_cnt_menu_generic_div( $pfix, $baseCls, $customCls, $customStyle ){

    $cntrCls = abcfsl_cnt_menu_class_bldr( $pfix, $baseCls, $customCls );

    $div['cntrS'] = abcfl_html_tag( 'div', '', $cntrCls, $customStyle );
    $div['cntrE'] = abcfl_html_tag_end( 'div');

    return $div;
}

function abcfsl_cnt_menu_class_bldr( $pfix, $baseCls, $customCls ){

    $cntrBaseCls = '';
    if( !empty( $baseCls ) ){ $cntrBaseCls = $pfix . $baseCls; }

    return  trim( $cntrBaseCls . ' ' . $customCls );
}

function abcfsl_cnt_menu_standard_div( $pfix, $baseCls, $customCls, $customStyle, $id='', $microdata='' ){

    $cntrCls = abcfsl_cnt_menu_class_bldr( $pfix, $baseCls, $customCls );

    //abcfl_html_tag( $element, $id, $cls='', $style='', $microdata='' )
    $div['cntrS'] = abcfl_html_tag( 'div', $id, $cntrCls, $customStyle, $microdata );
    $div['cntrE'] = abcfl_html_tag_end( 'div');

    return $div;
}

// DEPRECATED but Keep it for backward compatibility. Not supported. No documentation.
// Called from shortcode. Returns  menu HTML. Not linked to a page. 
// Creates independent menu (for sidebar?)
function abcfsl_cnt_menu_from_menu_shortcode( $scodeArgs ){

    //[abcf-staff-menu menu-id="CAT-7399"]
    //[abcf-staff-grid-a id="7395" master="6336" menu-id="CAT-7399" menu-scode="1"]

    $menuNo = $scodeArgs['menu-id'];
    $ajax = $scodeArgs['ajax'];

    $menu = abcfsl_util_menu_defaults();
    if( !abcfsl_util_menu_has_menu( $menuNo ) ) { return $menu; }

    $menuPar['menuType'] = substr( $menuNo, 0, 3 );
    $menuPar['menuID'] = substr( $menuNo, 4 );
    $scodeMenuType = $menuPar['menuType']; 

    global $post;
    $postID  = $post->ID;

    //Menu ID and Type is always set in shortcode (menu No). Disregard Template MenuID if selected.
    switch ( $scodeMenuType ) {
        case 'CAT':
        case 'AZM':
            $menuPar['pageURL'] = abcfsl_cnt_menu_pageURL( $postID, $ajax );
            $menu = abcfsl_cnt_menu_builder( $scodeArgs, $menuPar );        
        default:
            break;
    } 
    return $menu;
}