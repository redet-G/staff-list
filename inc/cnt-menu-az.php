<?php
/*
 * Called from a shortcode
 * ADDED AJAX V-02 Before removing ALL last
 */

//Categories menu. Items HTML & menu parameters for DB.
function abcfsl_cnt_menu_az_items( $qryFilter, $menuOptns, $clsPfix, $pageURL, $ajaxMenu ){


    //defaultFTxt = All records label
    $defaultFTxt = isset( $menuOptns['_defaultFTxt'] ) ? esc_attr( $menuOptns['_defaultFTxt'][0] ) : '';
    $showAllLast = isset( $menuOptns['_showAllLast'] ) ? $menuOptns['_showAllLast'][0] : false;
    $azItems = isset( $menuOptns['_azItems'] ) ? esc_attr( $menuOptns['_azItems'][0] ) : '';
    $azFieldType = isset( $menuOptns['_azFieldType'] ) ? $menuOptns['_azFieldType'][0] : '';
    $azFieldID = isset( $menuOptns['_azFieldID'] ) ?  $menuOptns['_azFieldID'][0] : '';
    if($azFieldType == '' ) { $azFieldID = ''; }

    $clsFItemFont = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemFont'] ) ? esc_attr( $menuOptns['_fItemFont'][0] ) : 'D', 'F', $clsPfix );
    $clsFItemHligh = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemHlight'] ) ? esc_attr( $menuOptns['_fItemHlight'][0] ) : 'D', 'FActive', $clsPfix );
    $upCase = isset( $menuOptns['_upCase'] ) ? esc_attr( $menuOptns['_upCase'][0] ) : 'N';

    //$fItemCls = isset( $menuOptns['_fItemCls'] ) ? esc_attr( $menuOptns['_fItemCls'][0] ) : '';
    //$fItemStyle = isset( $menuOptns['_fItemStyle'] ) ? esc_attr( $menuOptns['_fItemStyle'][0] ) : '';

    //qryFilter = shortcode filter ( deprecated ???????? )
    $menu = abcfsl_util_menu_defaults();

    //qryFilter = URL parameter ?staff-az=B. Comming from shortcode
    $menu['qryFilter'] = $qryFilter;
    $menu['menuType'] = 'AZM';
    $menu['filterField'] = $azFieldType . $azFieldID;
    $menu['noDataMsg'] = isset( $menuOptns['_noDataMsg'] ) ? esc_attr( $menuOptns['_noDataMsg'][0] ) : '';
    //------------------------------------------------------------
    //$showAllLast = true; //Checkbox value
    $allFirst = false;
    $allLast = false;
    if( !abcfl_html_isblank( $defaultFTxt ) ) { 
        if( $showAllLast ) { 
            $allLast = true;
        }
        else{
            $allFirst = true;
        }
    }
    //------------------------------------------------------------
    $first = '';
    $menuItemsHTML  = '';
    $i = 1;
    if( $allFirst ) { $i++; }

    // AJAX ----------------------------------------------------
    $parAZ['pageURL'] = $pageURL;
    $parAZ['qryFilter'] = $qryFilter;
    $parAZ['filterBy'] = '';
    $parAZ['menuLbl'] = '';
    $parAZ['defaultFTxt'] = $defaultFTxt;
    $parAZ['upCase'] = $upCase;
    $parAZ['clsFItemFont'] = $clsFItemFont;
    $parAZ['clsFItemHligh'] = trim('fSelected ' . $clsFItemHligh);
    $parAZ['clsPfix'] = $clsPfix;
    $parAZ['ajaxMenu'] =  $ajaxMenu;
    //----------------------------------------------------------

    //Menu item: Show all.
    $menuItemsHTML .=  abcfsl_cnt_menu_az_all( 1, $allFirst, $parAZ, $first );
    
    if ( empty( $azItems ) ){
        $menu['menuItemsHTML'] = $menuItemsHTML;
        return $menu;
    }
    $azItemsArray = explode(',', $azItems);
    //--------------------------------------------
    foreach ( $azItemsArray as $value ) {

        $filterBy = trim($value);
        $parAZ['filterBy']  = $filterBy;
        $parAZ['menuLbl'] = $filterBy;

        if( $i == 1 ) {            
            //First item, not ALL.
            $first = trim($value);
            $menuItemsHTML .= abcfsl_cnt_menu_az_item( $parAZ, 2, $first );
        }
        else{
            $menuItemsHTML .= abcfsl_cnt_menu_az_item( $parAZ, 3, '' );
        }
        $i++;
    }
    //--------------------------------------------
    //Menu item: Show all.
    $menuItemsHTML .=  abcfsl_cnt_menu_az_all( 4, $allLast, $parAZ, $first );

    $menu['first'] = $first;
    $menu['menuItemsHTML'] = $menuItemsHTML;

    return $menu;
}

function abcfsl_cnt_menu_az_all( $itemType, $showAll, $parAZ, $first ){

    if( !$showAll ) { return ''; }
    $filterBy = '*';
    $parAZ['filterBy'] = '*';
    $parAZ['menuLbl'] = $parAZ['defaultFTxt'];
    return abcfsl_cnt_menu_az_item( $parAZ, $itemType, $first );
}

//Menu item. Single LI element with text hyperlink.
function abcfsl_cnt_menu_az_item( $parAZ, $itemType, $first ){    

    $pageURL = $parAZ['pageURL'];
    $qryFilter = $parAZ['qryFilter'];
    $clsFItemHligh = $parAZ['clsFItemHligh'];
    $upCase = $parAZ['upCase'];
    $clsPfix = $parAZ['clsPfix'];
    $clsFItemFont = $parAZ['clsFItemFont'];
    $menuLbl =  $parAZ['menuLbl'];
    $filterBy = $parAZ['filterBy'];
    $ajaxMenu = $parAZ['ajaxMenu'];

    $clsActive = '';
    switch ( $itemType ) {
        case 1:
            //ALL is a first menu item
            $pageURL = abcfl_html_url( array( 'staff-az' => $filterBy ), $pageURL );
            if( $qryFilter == '' ) { $clsActive = $clsFItemHligh;  break; }
            if( $qryFilter == '*' ) { $clsActive = $clsFItemHligh; }
            break;
        case 2:
            //First menu item, not ALL            
            $pageURL = abcfl_html_url( array( 'staff-az' => $first ), $pageURL );
            if( $qryFilter == $filterBy ) { $clsActive = $clsFItemHligh;  break; }
            if( $qryFilter == '' ) { $clsActive = $clsFItemHligh;  break; }
            if( $qryFilter == '*' ) { break; }
            break;
        case 3:
            //Other menu items
            if( $qryFilter == $filterBy ) { $clsActive = $clsFItemHligh; }
            $pageURL = abcfl_html_url( array( 'staff-az' => $filterBy ), $pageURL );
            break;
        case 4:
            //ALL is the last menu item
            if( $qryFilter == '*' ) { $clsActive = $clsFItemHligh; }
            $pageURL = abcfl_html_url( array( 'staff-az' => $filterBy ), $pageURL );
            break;    
        default:
            break;
    }

    $clsATag = trim( $clsActive . abcfsl_util_upper_cls( $upCase, $clsPfix ) . ' ' . $clsFItemFont );
    $aTag = abcfsl_cnt_menu_az_a_tag( $pageURL, $menuLbl, $filterBy, $clsATag, $ajaxMenu );

    return abcfl_html_tag_with_content( $aTag, 'li', '');
}

// AJAX -------------------------------------
function abcfsl_cnt_menu_az_a_tag( $pageURL, $menuLbl, $filterBy, $clsATag, $ajaxMenu ){
    if( $ajaxMenu ) {
        return abcfl_html_a_tag('#', $menuLbl, '', $clsATag, '', '', true, '', 'data-azm="' . $filterBy . '"');
    }
    return abcfl_html_a_tag( $pageURL, $menuLbl, '', $clsATag, '', '', false);
}
