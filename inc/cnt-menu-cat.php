<?php
/* V-02
 * ADDED AJAX V-02
 * Called from a shortcode.
 * CATEGORIES menu builder. Items HTML & menu parameters for DB.
 */

// $ajaxMenu
function abcfsl_cnt_menu_cat_items( $qryFilter, $menuID, $menuOptns, $clsPfix, $pageURL, $ajaxMenu ){

    $termCats = array();
    $category = '';
    $noSlugTxt = ' Slug doesn\'t exist: ';
    $noSlug = false;
    //----------------------------------
    $terms = get_terms( array(
        'taxonomy' => 'tax_staff_member_cat',
        'hide_empty' => false
    ) );
    
    $menu = abcfsl_util_menu_defaults();
    $menu['qryFilter'] = $qryFilter;
    $menu['menuType'] = 'CAT';
    $menu['noDataMsg'] = isset( $menuOptns['_noDataMsg'] ) ? esc_attr( $menuOptns['_noDataMsg'][0] ) : '';

    //From multidimensional array TERMS Create array: slug - category name
    foreach ($terms as $category) {
        $termCats[$category->slug] = $category->name;
    }

    //----------------------------------
    $defaultFTxt = isset( $menuOptns['_defaultFTxt'] ) ? esc_attr( $menuOptns['_defaultFTxt'][0] ) : '';
    $showAllLast = isset( $menuOptns['_showAllLast'] ) ? $menuOptns['_showAllLast'][0] : false;
    $menuCatSlugs = get_post_meta( $menuID, '_catSlugs', true );

    // $menuCatSlugs1 = isset( $menuOptns['_catSlugs'] ) ? $menuOptns['_catSlugs'][0] : '';
    // echo"<pre>", print_r( $menuCatSlugs1, true ), "</pre>";
    // $menuCatSlugs1 = unserialize( $menuCatSlugs1 );
    // echo"<pre>", print_r( $menuCatSlugs1, true ), "</pre>";
    // echo"<pre>", print_r( $menuCatSlugs, true ), "</pre>"; die;

    $clsFItemFont = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemFont'] ) ? esc_attr( $menuOptns['_fItemFont'][0] ) : 'D', 'F', $clsPfix );
    $clsFItemHligh = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemHlight'] ) ? esc_attr( $menuOptns['_fItemHlight'][0] ) : 'N', 'FActive', $clsPfix );
    $upCase = isset( $menuOptns['_upCase'] ) ? esc_attr( $menuOptns['_upCase'][0] ) : 'N';
    //------------------------------------------------------------
    //$showAllLast = true; //Checkbox value
    $allFirst = false;
    $allLast = false;
    if( !abcfl_html_isblank( $defaultFTxt ) ) { 
        //$hasShowAll = true; 
        if( $showAllLast ) { 
            $allLast = true;
        }
        else{
            $allFirst = true;
        }
    }

    $first = '';
    $menuItemsHTML  = '';
    $i = 1;
    if( $allFirst ) { $i++; }

    // AJAX ----------------------------------------------------
    $parCI['pageURL'] = $pageURL;
    $parCI['qryFilter'] = $qryFilter;
    $parCI['catSlug'] = '';
    //$parAZ['menuLbl'] = '';
    $parCI['category'] = '';
    $parCI['defaultFTxt'] = $defaultFTxt;
    $parCI['noSlug'] = $noSlug;
    $parCI['upCase'] = $upCase;
    $parCI['clsFItemFont'] = $clsFItemFont;    
    $parCI['clsFItemHligh'] = trim('fSelected ' . $clsFItemHligh);
    $parCI['clsPfix'] = $clsPfix;
    $parCI['ajaxMenu'] =  $ajaxMenu;
    //----------------------------------------------------------

    //Menu item: Show all. first
    $menuItemsHTML .=  abcfsl_cnt_menu_cat_all( 1, $allFirst, $parCI );

    if ( !$menuCatSlugs ){
        $menu['menuItemsHTML'] = $menuItemsHTML;
        return $menu;
    }

    //------------------------------------------------
    // SANITAZE 
    foreach ( $menuCatSlugs as $field ) {
        //$catSlug = $field['catSlug'];
        $catSlug = sanitize_title( $field['catSlug'] );

        if(isset( $termCats[$catSlug] ) ){
            $category = $termCats[$catSlug];
        }
        else {
            $category = $noSlugTxt . $catSlug;
            $noSlug = true;
        }

        $parCI['category'] = $category;
        $parCI['catSlug'] = $catSlug;
        $parCI['noSlug'] = $noSlug;

        if( $i == 1 ) {    
            $first = trim($catSlug);
            $menuItemsHTML .= abcfsl_cnt_menu_cat_item( $parCI, 2, $first );
        }
        else{
            $menuItemsHTML .= abcfsl_cnt_menu_cat_item( $parCI, 3, '' );
        }
        $i++;
    }

    //Menu item: Show all. last
    $menuItemsHTML .=  abcfsl_cnt_menu_cat_all( 4, $allLast, $parCI );

    $menu['first'] = $first;
    $menu['menuItemsHTML'] = $menuItemsHTML;
    return $menu;
}

function abcfsl_cnt_menu_cat_all( $itemType, $showAll, $parCI ){

    if( !$showAll ) {  return ''; }

    $parCI['catSlug'] = '*';
    $parCI['category'] = $parCI['defaultFTxt'];
    return abcfsl_cnt_menu_cat_item( $parCI, $itemType, '' );
}


//Menu item. Single LI element with text hyperlink.
function abcfsl_cnt_menu_cat_item( $parCI, $itemType, $first ){

    $pageURL = $parCI['pageURL'];
    $noSlug = $parCI['noSlug'];
    $qryFilter = $parCI['qryFilter'];
    $clsFItemHligh = $parCI['clsFItemHligh'];

    $upCase = $parCI['upCase'];
    $clsPfix = $parCI['clsPfix'];
    $clsFItemFont = $parCI['clsFItemFont'];
    $category = $parCI['category'];
    $catSlug = $parCI['catSlug'];
    $filterBy = $parCI['catSlug'];
    $ajaxMenu = $parCI['ajaxMenu'];

    //Slug doesn't exist.
    if( $noSlug ) { return $category; }

    //1 = All first;
    //2 = First menu item - category;
    //3 = Second and next menu items - category;
    //4 = All last
    $clsActive = '';
    switch ( $itemType ) {
        case 1:
            //ALL is a first menu item
            $pageURL = abcfl_html_url( array( 'staff-category' => $filterBy ), $pageURL );
            if( $qryFilter == '' ) { $clsActive = $clsFItemHligh;  break; }
            if( $qryFilter == '*' ) { $clsActive = $clsFItemHligh; }
            break;
        case 2:
            if( $qryFilter == $filterBy || $qryFilter == '' ) { $clsActive = $clsFItemHligh; }
            $pageURL = abcfl_html_url( array( 'staff-category' => $first ), $pageURL );
            break;
        case 3:
            if( $qryFilter == $filterBy ) { $clsActive = $clsFItemHligh; }
            $pageURL = abcfl_html_url( array( 'staff-category' => $filterBy ), $pageURL );
            break;
        case 4:
            //ALL is the last menu item
            if( $qryFilter == '*' ) { $clsActive = $clsFItemHligh; }
            $pageURL = abcfl_html_url( array( 'staff-category' => $filterBy ), $pageURL );
            break;               
        default:
            break;
    }

    $clsATag = trim(  $clsActive . abcfsl_util_upper_cls( $upCase, $clsPfix ) . ' ' . $clsFItemFont );
    $aTag = abcfsl_cnt_menu_cat_a_tag( $pageURL, $category, $catSlug, $clsATag,  $ajaxMenu );

    return abcfl_html_tag_with_content( $aTag, 'li', '');
}

// AJAX ------
function abcfsl_cnt_menu_cat_a_tag( $pageURL, $category, $catSlug, $clsATag,  $ajaxMenu ){
    if( $ajaxMenu ) {
        return abcfl_html_a_tag('#', $category, '', $clsATag, '', '', true, '', 'data-cat="' . $catSlug . '"');
    }
    return abcfl_html_a_tag( $pageURL, $category, '', $clsATag, '', '', false);
}

//[0] => WP_Term Object
//        (
//            [term_id] => 196
//            [name] => adam
//            [slug] => adam
//            [term_group] => 0
//            [term_taxonomy_id] => 197
//            [taxonomy] => tax_staff_member_cat
//            [description] =>
//            [parent] => 0
//            [count] => 1
//            [filter] => raw
//        )

//    $terms = get_terms( array(
//        'taxonomy' => 'tax_staff_member_cat',
//        'hide_empty' => true
//    ) );