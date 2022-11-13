<?php
function abcfsl_util_grid_cols_qty( $colsXX, $colsXL, $colsLG, $colsMD, $colsSM ){

    if( $colsXX == 0 ) { $colsXX = 2; }
    if( $colsXL == 0 ) { $colsXL = 2; }
    if( $colsLG == 0 ) { $colsLG = 1; }
    if( $colsMD == 0 ) { $colsMD = 1; }
    if( $colsSM == 0 ) { $colsSM = 1; }

    if( $colsXX < $colsXL ){ $colsXX = $colsXL; }

    if( $colsLG > $colsXL ){ $colsLG = $colsXL; }
    if( $colsMD > $colsLG ){ $colsMD = $colsLG; }
    if( $colsSM > $colsMD ){ $colsSM = $colsMD; }

    $colsQty['XX'] = $colsXX;
    $colsQty['XL'] = $colsXL;
    $colsQty['LG'] = $colsLG;
    $colsQty['MD'] = $colsMD;
    $colsQty['SM'] = $colsSM;

    return $colsQty;
}

//Get fieldOrder meta. Convert saved meta to array.
function abcfsl_util_field_order( $tplateOptns, $isSingle=false ){

    $fieldOrder = '';
    $fieldOrderA = array();

    if( $isSingle ){
        $fieldOrder = isset( $tplateOptns['_fieldOrderS'] ) ? $tplateOptns['_fieldOrderS'][0] : '';
        if(empty($fieldOrder)){
            $fieldOrder = isset( $tplateOptns['_fieldOrder'] ) ? $tplateOptns['_fieldOrder'][0] : '';
        }
    }
    else {
        $fieldOrder = isset( $tplateOptns['_fieldOrder'] ) ? $tplateOptns['_fieldOrder'][0] : '';
    }
//FIELDS_50
    if(empty($fieldOrder)){
        //for ( $i = 1; $i <= 40; $i++ ) { $fieldOrderA[$i] = 'F' . $i; }
        for ( $i = 1; $i <= 50; $i++ ) { $fieldOrderA[$i] = 'F' . $i; }
    }
    else{
        $fieldOrderA = unserialize( $fieldOrder );

        // Array has duplicates
        if(count(array_unique($fieldOrderA)) < count($fieldOrderA)){
            $fieldOrderU = array_unique($fieldOrderA);
            $fieldOrderA = array_combine(range(1, count($fieldOrderU)), array_values($fieldOrderU));
        }
    }
    //[1] => F1 [2] => F4 [3] => F5
    return $fieldOrderA;
}
//== CSS Class START =============================================
//OUT; tag with all . No spliting classes into staff and single.
function abcfsl_util_tag_base_attrs( $tag, $pfix, $baseCls, $customCls, $style, $id='' ){

    if( empty( $tag ) ){ return ''; }

    if( !empty( $baseCls ) ){ $baseCls = $pfix . $baseCls; }
    if( !empty( $customCls ) ){ $customCls = ' ' . $customCls; }

    $cls = $baseCls . $customCls;

    $div['cntrS'] = abcfl_html_tag( $tag, $id, $cls, $style );
    $div['cntrE'] = abcfl_html_tag_end( $tag );

    return $div;
}

//Field container classes. Output combines user selected options and custom class. Checks for staff or single prefixes. 
function abcfsl_util_field_tag_cls_bldr_staff_or_single( $tagFont, $marginT, $tagFontSPg, $marginTSPg, $tagCustCls, $isSingle, $pfix ){

    if( $isSingle ){
        return abcfsl_util_field_cntr_cls_bldr_single( $tagFontSPg, $marginTSPg, $tagCustCls, $pfix );
    }

    return abcfsl_util_field_cntr_cls_bldr_staff( $marginT, $tagFont, $tagCustCls, $pfix );
}

//Field container classes. Staff only, not single.
function abcfsl_util_field_cntr_cls_bldr_staff( $marginT, $tagFont, $tagCustCls, $pfix ){

    //Top margin. Class name or empty string if Default or Custom selected.
    $tagMarginT = abcfsl_util_cls_name_nc_bldr( $marginT, 'MT', $pfix );

    //Font Size. Class name or empty string if Default or Custom selected.
    $tagFont = abcfsl_util_cls_name_nc_bldr( $tagFont, 'F', $pfix );
    $optionsCls = trim( $tagMarginT . ' ' . $tagFont );

    if( empty( $tagCustCls ) ){ return $optionsCls; }
    //-------------------------------------
    //Field container custom classes. Get only staff classes (lst_ prefix) or no prefix. No single page classes (spg_ prefix).
    $fieldCntrCustCls= abcfsl_util_pg_type_cls_bldr( $tagCustCls, false );

    $mergedCls = abcfsl_util_merge_custom_cls( $optionsCls, $fieldCntrCustCls );
    return $mergedCls;
}

//Field container classes. Single.
function abcfsl_util_field_cntr_cls_bldr_single( $tagFontSPg, $marginTSPg, $tagCustCls, $pfix ){

    //Top margin. 
    $tagMarginT = abcfsl_util_cls_name_nc_bldr( $marginTSPg, 'MT', $pfix );

    //Font Size. Class name or empty string if Default or Custom selected.
    $tagFont = abcfsl_util_cls_name_nc_bldr( $tagFontSPg, 'F', $pfix );
    $optionsCls = trim( $tagMarginT . ' ' . $tagFont );

    if( empty( $tagCustCls ) ){ return $optionsCls; }
    //-------------------------------------
    //Field container custom classes. Get only single page classes (spg_ prefix)  or no prefix. 
    $fieldCntrCustCls= abcfsl_util_pg_type_cls_bldr( $tagCustCls, true );

    $mergedCls = abcfsl_util_merge_custom_cls( $optionsCls, $fieldCntrCustCls );
    return $mergedCls;
}

// OLDER VERSION. Field container classes. Missing:  Single Page options. ??????? CHECK WHERE USED
function abcfsl_util_field_tag_cls_bldr( $marginT, $tagFont, $tagCustCls, $isSingle, $pfix ){

    //Top margin. Class name or empty string if Default or Custom selected.
    $tagMarginT = abcfsl_util_cls_name_nc_bldr( $marginT, 'MT', $pfix );

    //Font Size. Class name or empty string if Default or Custom selected.
    $tagFont = abcfsl_util_cls_name_nc_bldr( $tagFont, 'F', $pfix );

    $optionsCls = trim($tagMarginT . ' ' . $tagFont);

    if( empty( $tagCustCls ) ){ return $optionsCls; }
    //-------------------------------------

    //Field container custom class. Get only staff list classes or single page classes.
    $fieldCntrCustCls= abcfsl_util_pg_type_cls_bldr( $tagCustCls, $isSingle );

    $mergedCls = abcfsl_util_merge_custom_cls( $optionsCls, $fieldCntrCustCls );
    return $mergedCls;
}

//Parse custom classes string. Returns string of classes: List, Single Page, Both. lst_ spg_
function abcfsl_util_pg_type_cls_bldr( $classes, $isSingle ){

    //Staff only class starts with: 'lst_'
    //Single Page only class starts with: 'spg_'
    $pgType = 'L';
    if( $isSingle ){ $pgType = 'S'; }

    $cls['clsLst'] = '';
    $cls['clsSpg'] = '';
    $cls['clsBoth'] = '';
    if(empty($classes)){ return '';}

    $hasLstCls = false;
    $hasSpgCls = false;

    if (strpos($classes,'lst_') !== false) { $hasLstCls = true; }
    if (strpos($classes,'spg_') !== false) { $hasSpgCls = true; }
    if(!$hasLstCls && !$hasSpgCls) { return $classes; }

    $inputFixed = preg_replace('/\s+/', ' ', $classes);
    $clsLst = '';
    $clsSpg = '';
    $clsBoth = '';

    $pieces = explode(' ', $inputFixed);

    foreach($pieces as $value){
        $prefix = substr($value, 0, 4);
        switch ($prefix){
        case 'lst_':
            $clsLst .= substr($value, 4) . ' ';
            break;
        case 'spg_':
            $clsSpg .= substr($value, 4) . ' ';
            break;
        default:
            $clsBoth .= $value . ' ';
            break;
        }
    }

    $out = '';
    switch ($pgType){
        case 'L':
            $out = trim($clsBoth . $clsLst);
            break;
        case 'S':
            $out = trim($clsBoth . $clsSpg);
            break;
        default:
            break;
    }
    return $out;
}

function abcfsl_util_class_name_bldr( $suffix, $clsBaseName, $pfix, $default='' ){

    if( empty( $suffix ) ) { return $default; }
    if( empty( $clsBaseName ) ) { return $default; }
    if( $suffix == 'C' ) { return $default; }

    return $pfix . $clsBaseName . $suffix;
}

//Used for CBO. Only suffix is saved to DB.
function abcfsl_util_class_basename_bldr( $suffix, $clsBaseName, $pfix ){
    if( empty( $suffix ) ) { return ''; }
    if( empty( $clsBaseName ) ) { return ''; }
    return $pfix . $clsBaseName . $suffix;
}

//Can be used with D-default, C-custom , N-none option
function abcfsls_util_cls_name_bldr_ncd( $clsBaseName, $suffix, $pfix, $default='' ){

    if( $suffix == 'N' || $suffix == 'C' ){ return ''; }
    if( $suffix == 'D' ) { return $default; }
    if( empty( $clsBaseName ) ) { return $default; }

    return $pfix . $clsBaseName . $suffix;
}

//Custom class handler. Append custom classes to staff list class names (if prefix slp). Replace if not. 
function abcfsl_util_merge_custom_cls( $cls, $custCls ){
    
    if( empty( $custCls ) ) { return $cls; }
    if( empty( $cls ) ) { return $custCls; }
    //Check for leading sls
    $left = strtolower( substr( $custCls, 0, 4 ) );
    if( $left == 'slp ' ) { 
        return trim( $cls . ' ' . substr( $custCls, 3 )); 
    }
    return trim( $cls . ' ' .  $custCls);;
}

function abcfsl_util_cls_bldr( $cls, $pfix ){
    if( empty( $cls) ) { return ''; }
    return $pfix . $cls;
}

//Replacement for abcfsl_util_cls_bldr
function abcfsl_util_cls_name_bldr( $pfix, $cls, $suffix='' ){
    if( empty( $cls) ) { return ''; }
    return $pfix . $cls . $suffix;
}

//Return class name or empty string. Used for cbos Class: None, Custom or Selected.
function abcfsl_util_cls_name_ncd_bldr( $suffix, $clsBaseName, $pfix, $default='' ){

    //abcfsl MT 10 = pfix clsBaseName suffix

    if( $suffix == 'N' || $suffix == 'C'|| $suffix == 'D' ){ return ''; }
    if( empty( $suffix ) ) { $suffix = $default; }
    if( empty( $suffix) ) { return ''; }
    return $pfix . $clsBaseName . $suffix;
}

//Return empty if N or C.
function abcfsl_util_cls_name_nc_bldr( $suffix, $clsBaseName, $pfix, $default='' ){

    if( $suffix == 'N' || $suffix == 'C' ){ return ''; }
    if( $suffix == 'D' ) { $suffix = $default; }
    if( empty( $suffix ) ) { $suffix = $default; }
    if( empty( $suffix) ) { return ''; }
    return ' ' . $pfix . $clsBaseName . $suffix;
}

function abcfsl_util_center_cls( $centerYN, $pfix ){
    $out = '';
    if( $centerYN == 'Y' ) { $out = ' ' . $pfix . 'MLRAuto'; }
    return $out;
}

function abcfsl_util_img_center_cls( $centerYN, $pfix ){
    $out = '';
    if( $centerYN == 'Y' ) { $out = ' ' . $pfix . 'ImgCenter'; }
    return $out;
}

function abcfsl_util_upper_cls( $upCase, $pfix ){
    $clsUpper = '';
    if( $upCase == 'Y' ) { $clsUpper = ' ' . $pfix . 'Upper' ; }
    return $clsUpper;
}

function abcfsl_util_lead_space( $in ){
    if( empty( $in ) ) { return ''; }
    return ' ' . $in;
}
//== CSS Class END =============================================
 //Categories or AZ menu. No data message.
 function abcfsl_util_no_data_alert( $noDataMsgT, $noDataMsgM ){

    // Menu no data text overwrites template text.
    if( empty( $noDataMsgM ) ) { $noDataMsgM = $noDataMsgT; } 
    return $noDataMsgM;
}

 //Categories or AZ menu. No data message div.
 function abcfsl_util_no_data_msg_div( $noDataMsg, $totalQty ){

    if( $totalQty > 0 ) { return '';}
    if( empty( $noDataMsg ) ) { return '';}

    $div = abcfsl_cnt_generic_div_simple( 'abcfslFS16 abcfslFW600 abcfslMLRAuto abcfslPadT5 abcfslTxtCenter', '' );
    return  $div['cntrS'] .  $noDataMsg . $div['cntrE'];
}

function abcfsl_util_div_no_data_alert( $noDataMsg, $tplateID, $clsPfix ){

    //$noDataMsg = abcfsl_util_no_data_alert( $noDataMsgT, $noDataMsgM );
    if( empty( $noDataMsg ) ) { return '';}

    
    //abcfl_html_tag_with_content( $cnt, $tag, $id, $cls='', $style='', $microdata='', $empty=false
    $id = 'noDataAlert_' . $tplateID;
    $customStyle = '';
    $customCls = '';
    $baseCls = 'abcfslFS16 abcfslFW600 abcfslMLRAuto abcfslPadT5 abcfslTxtCenter abcfslDisplayN';
    
    $cntrCls = abcfsl_cnt_menu_class_bldr( $clsPfix, $baseCls, $customCls );

    return abcfl_html_tag_with_content( $noDataMsg, 'div', $id, $cntrCls, $customStyle );
}

function abcfsl_util_pg_cnt_parts_defaults( $noDataMsgT, $noDataMsgM ){

    $noDataMsg = abcfsl_util_no_data_alert( $noDataMsgT, $noDataMsgM );

    $cntParts['itemsHTML'] = abcfsl_util_no_data_msg_div( $noDataMsg, 0 );
    $cntParts['ldjsonSD'] = '';
    $cntParts['totalQty'] = 0;
    $cntParts['pgnCnt'] = '';

   return $cntParts;
}

function abcfsl_util_pg_cnt_parts( $tplateOptns, $totalQty, $pageNo, $itemsHTML, $itemsSD, $pfix, $ajax, $top=0 ){

    $cntParts['itemsHTML'] = $itemsHTML;
    $cntParts['totalQty'] = $totalQty;
    $cntParts['ldjsonSD'] = abcfsl_struct_data( $itemsSD );
    $cntParts['pgnCnt'] = '';
    
    // For random options
    if( $top == 0 ){
        $cntParts['pgnCnt'] = abcfsl_paginator_cnt( $tplateOptns, $totalQty, $pageNo, $pfix, $ajax );
    }

   return $cntParts;
}

function abcfsl_util_imgs_folder_url( $socIconSize ){

    $imgsFolderUrl = ABCFSL_PLUGIN_URL . 'images';
    if( $socIconSize == 'C' ){
        $uploadDir = wp_upload_dir();
        $custom = 'abcfolio/staff-list';
        $baseURL = $uploadDir['baseurl'];
        $imgsFolderUrl = trailingslashit( $baseURL ) . $custom;
    }
    return trailingslashit( $imgsFolderUrl );
}

function abcfsl_util_ajax_loader( $imgFileName, $ajax, $pfix ){

    $imgsFolderUrl = ABCFSL_PLUGIN_URL . 'images';
    $imgURL = trailingslashit( $imgsFolderUrl ) . $imgFileName;

    $loaderS = abcfl_html_tag( 'div', $pfix . 'AjaxLoader_' . $ajax, '', '' );
    $img = abcfl_html_img_tag_resp( '', $imgURL, 'Loading...', '', $pfix . 'AjaxLoaderImg');
    return $loaderS . $img . abcfl_html_tag_end( 'div' );
}

//Get parts of shortcode option. Example: CAT-199
function abcfsl_util_scode_menu_parts( $scodeNo ){

    $scodParts['type'] = '';
    $scodParts['id'] = 0;

    if( $scodeNo == '0' || empty( $scodeNo ) ){ return $scodParts; }
    if( strlen( $scodeNo ) < 5 ) { return $scodParts; }

    $scodParts['type'] = substr( $scodeNo, 0, 3 );
    $scodParts['id'] = substr( $scodeNo, 4 );

    return $scodParts;
}

// GRPCAT GRPTXT GRPABC
function abcfsl_util_scode_group_parts( $scodeNo ){

    $scodParts['type'] = '';
    $scodParts['id'] = 0;

    if( $scodeNo == '0' || empty( $scodeNo ) ){ return $scodParts; }
    if( strlen( $scodeNo ) < 8 ) { return $scodParts; }

    $scodParts['type'] = substr( $scodeNo, 0, 6 );
    $scodParts['id'] = substr( $scodeNo, 7 );

    return $scodParts;
}

//Array has no values. edited from: if ($element === "")
function abcfsl_util_is_array_empty( $array ) {

    foreach ( $array as $element ) {
      if ( !empty( $element ) ){ 
        return false;
      }
    }
    return true;
}

function abcfsl_util_current_dt( $type='mysql', $gmt = 0, $outDiv=false ) {

    $dt = current_time( $type, $gmt = 0 );

    if ( $outDiv) {
        return abcfl_html_tag_with_content( $dt, 'div', 'xx' );
    } else {
        return $dt;
    }
}

//=== MENU =============================================
function abcfsl_util_menu_has_menu( $menuNo ){

    if( $menuNo == '0' || empty( $menuNo ) ){ return false; }
    if( strlen( $menuNo ) < 5 ) { return false; } 
    return true;
 }

// Check menu type. Return false if CAT or AZM. 
function abcfsl_util_menu_has_filters( $menuNo ){

    if( !abcfsl_util_menu_has_menu( $menuNo ) ) { return false; }

    $menuType = substr( $menuNo, 0, 3 );    
    if( $menuType == 'MTF' || $menuType == 'MFP' ){ return true; }    

    return false;
}

function abcfsl_util_staff_categories_all(){

    $out['error'] = false;
    $out['terms'] = '';

    $terms = get_terms( array( 'taxonomy' => 'tax_staff_member_cat', 'hide_empty' => false ) );  
    $out['terms'] = $terms;

    if ( is_wp_error( $terms ) ) {
        $out['error'] = true;
        $out['terms'] = abcfsl_txt(3);
    }

    return $out;

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
}
 
 function abcfsl_util_menu_defaults(){
 
     $minLen[1] = '3';
     $minLen[2] = '3';
     $minLen[3] = '3';
     $minLen[4] = '3';
     $minLen[5] = '3';
     $minLen[6] = '3';
 
     $menu['menuID'] = '';
     $menu['tplateID'] = '';
     $menu['pageURL'] = '';
     $menu['pfixSL'] = '';
     $menu['menuType'] = 'NONE';
 
     $menu['first'] = '';
     $menu['qryFilter'] = '';     
 
     $menu['filterField'] = '';
     $menu['filterType'] = '';
 
     $menu['filter1Type'] = '';
     $menu['filter2Type'] = '';
     $menu['filter3Type'] = '';
     $menu['filter4Type'] = '';
     $menu['filter5Type'] = '';
     $menu['filter6Type'] = '';
 
     $menu['filter1Field'] = '';
     $menu['filter2Field'] = '';
     $menu['filter3Field'] = '';
     $menu['filter4Field'] = '';
     $menu['filter5Field'] = '';
     $menu['filter6Field'] = '';
 
     $menu['minLen'] = $minLen;
 
    $menu['menuItemsHTML'] = '';
    $menu['noDataMsg'] = '';
    $menu['noDataMsgT'] = '';
    $menu['imgsLoaded'] = 0;  

    $menu['searchBtnName'] = 'mfSearchBtn';
    $menu['resetBtnName'] = 'mfResetBtn';
    $menu['jsIsotope'] = '';
    $menu['menuSlugs'] = [];
    $menu['errorTerms'] = false;
 
     return $menu;
 }

 function abcfsl_util_filters_defaults(){
     $filters[1] = '';
     $filters[2] = '';
     $filters[3] = '';
     $filters[4] = '';
     $filters[5] = '';
     $filters[6] = '';
     $filters['btn'] = '';
     $filters['frmType'] = '';
 
     return $filters;
 }

 function abcfsl_util_scode_defaults() {

    $obj = ABCFSL_Main();
    $ver = str_replace('.', '' , $obj->pluginVersion);
    $prefix = $obj->prefix;

    //SCMENUID 'date-plus' => '',
    //'order' => 'ASC',
    //'c-sort-order' => 'ASC'
    return array( 'id' => '0',
        'pversion' => $ver,
        'prefix' => $prefix,
        'category' => '',
        'category-exclude' => '',
        'random' => false,
        'top' => '0',
        'master' => '',        
        'staff-az' => '',
        'staff-category' => '',
        'smid' => '0',
        'staff-id' => '0',
        'staff-name' => '',
        'staff-name-sp' => '',
        'page' => '',        
        'menu-id' => '',
        'menu-scode' => '',
        'ajax' => '0',
        'group-id' => '',
        'search-form' => '', 
        'multi-template' => '',
        'd-sort' => '',
        'd-sort-order' => '',
        'order' => '',
        'c-sort' => '',
        'c-sort-order' => '',
        'hidden-fields' => '0',
        'hidden-records' => '0',
        'private-fields' => '0',
        'keep-dups' => '0',
        'images-loaded' => 0,
        'debug-spg' => '0'
   );
}

function abcfsl_util_is_active_bday(){
    if( is_plugin_active( 'abcfolio-staff-list-birthday/staff-list-birthday.php' ) ) {
        return true;
    }
    return false;
}


function abcfsl_util_par_args_builder( $argsIn ){

    $argsOut = '';
    if( $argsIn['lnkDload'] ==  1){
        $argsOut = 'download';
    }
    
    return $argsOut;

    //if ( array_key_exists( 'lnkDload', $argsIn ) ) {}
}


//==============================================================
// == Get: url + link text + target ================
// Standard hyperlink fields only. Handles NT prefix. Hyperlinks don't have new tab options yet.
// Replacement for: abcfsl_spg_a_tag_parts
function abcfsl_util_a_tag_parts( $par, $F ){

    $aTagParts['hrefUrl'] = '';
    $aTagParts['hrefTxt'] = '';
    $aTagParts['target'] = '';

    $itemUrl = $par['url'];
    $itemTxt = $par['urlTxt']; 
    $lnkNT = $par['lnkNT'];

    // Returns empty if no URL
    if( abcfl_html_isblank( $itemUrl ) ) { return $aTagParts; }
    //------------------------------------------------------------------
    // Splits URL input string into URL and target if NT prefix.
    $splitUrl = abcfsl_util_get_url_and_target( $itemUrl ); 
    if( $lnkNT == '1' ) { $splitUrl['target'] = '_blank'; }
    //-------------------------------------------------------------------------
    if( abcfl_html_isblank( $itemTxt ) ) { $itemTxt = $splitUrl['hrefUrl']; }

    $aTagParts['hrefTxt'] = $itemTxt;
    $aTagParts['hrefUrl'] = $splitUrl['hrefUrl'];    
    $aTagParts['target'] = $splitUrl['target'];
    
    return $aTagParts;
}

//Convert NT to _blank. 
function abcfsl_util_get_url_and_target( $url ){

    $out['hrefUrl'] = $url;
    $out['target'] = '';

    if( abcfl_html_isblank( $url ) ) { return $out; }
    if(strlen($url) < 4) { return $out; }   

    $doubleNT = substr( $url, 0, 5 );
    if( $doubleNT == 'NT NT' ) { 
        $out['hrefUrl'] = trim( substr( $url, 5 ) ); 
        $out['target'] = '_blank';
        return $out;
    }

    $doubleNT = substr( $url, 0, 4 );
    if( $doubleNT == 'NTNT' ) { 
        $out['hrefUrl'] = trim( substr( $url, 4 ) ); 
        $out['target'] = '_blank';
        return $out;
    }

    $targetNT = substr( $url, 0, 2 );
    if( $targetNT == 'NT' ) {
        $out['hrefUrl'] = trim( substr( $url, 2 ) );
        $out['target'] = '_blank';
    }
    return $out;
}
//=====================================================================

// In: all parameters are ready. Out: DIV parts with class and style added.
function abcfsl_util_div_id_cls_style( $divID, $divCls, $divStyle ){

    $div['cntrS'] = abcfl_html_tag( 'div', $divID, $divCls, $divStyle );
    $div['cntrE'] = abcfl_html_tag_end( 'div');
    return $div;
}

//=== EXCLUDED CATEGORIES START ========================================

// Field STFFCAT. Append subcategories to excludedSlugs (if not included).
function abcfsl_util_fix_cat_excluded_slugs( $tplateOptns ){

    for ( $i = 1; $i <= 50; $i++ ) {
        $F = 'F' . $i;
        $fieldType = isset( $tplateOptns['_fieldType_' . $F] ) ? $tplateOptns['_fieldType_' . $F][0]:'';

        if( $fieldType == 'STFFCAT' ) { 
            $excludedSlugs = isset( $tplateOptns['_excludedSlugs_' . $F] ) ? esc_attr( $tplateOptns['_excludedSlugs_' . $F][0] ) : '';
            $excludedAll = abcfsl_util_add_subcats_to_excluded( $excludedSlugs );
            if( !empty( $excludedAll ) ) {
                $tplateOptns['_excludedSlugs_' . $F][0] = $excludedAll;
            }
         }
    }

    return $tplateOptns;
}

//Add subcategories to excluded if missing.
function abcfsl_util_add_subcats_to_excluded( $excludedSlugs ){

    if( empty( $excludedSlugs ) ) { return ''; }

    //String to array
    $excludedSaved = explode (',', $excludedSlugs);
    $excludedSaved = array_map( 'trim', $excludedSaved );

    $excludedAll = $excludedSaved;

    //Get excluded categories IDs
    $getTermsArgs = array(
        'taxonomy' => 'tax_staff_member_cat',
        'slug' => $excludedSaved,
        'fields'   => 'ids',
        'hide_empty' => false
    );

    $excludedIDs = get_terms ( $getTermsArgs );

    //-- Get subcategories if any ------------------------
    foreach( $excludedIDs as $excludedID ) {

        $slugArgs = array(
            'taxonomy' => 'tax_staff_member_cat',
            'parent' => $excludedID,
            'fields'   => 'slugs',
            'hide_empty' => false
        );

        $subcategorySlugs = get_terms ( $slugArgs );
        $excludedAll = array_merge( $excludedAll, $subcategorySlugs );
    }

    //Remove duplicate values
    $excludedAll = array_unique( $excludedAll );   
    //$areEqual = array_diff($excludedAll, $excludedSaved) === array_diff($excludedSaved, $excludedAll);
    $areEqual = ( $excludedSaved == $excludedAll );

    if( $areEqual ){ return ''; }    
    return implode (",", $excludedAll);
}

//=== FOR DEBUG shortcode spgURL START ==========================
function abcfsl_util_debug_spg( $scodeArgs ){

    //debug-spg 1-4.
    $debugSPg = $scodeArgs['debug-spg'];
    if( $debugSPg == 0 ) { return; }

    if( $debugSPg == 1 ){
        $spgURLVars = abcfsl_util_spg_url_vars( $scodeArgs );
        echo"<pre>", print_r( $spgURLVars, true ), "</pre>";
        return;
    }

    if( $debugSPg == 2 ){
        $spgURLVars = abcfsl_util_spg_url_vars( $scodeArgs );
        echo"<pre>", print_r( $spgURLVars, true ), "</pre>";

        $qryVars = abcfsl_util_spg_qry_vars();
        echo"<pre>", print_r( $qryVars, true ), "</pre>";
        return;
    } 
    
    if( $debugSPg == 3 ){
        $spgURLVars = abcfsl_util_spg_url_vars( $scodeArgs );
        error_log( print_r( $spgURLVars, true) );
        return;
    }

    if( $debugSPg == 4 ){
        $spgURLVars = abcfsl_util_spg_url_vars( $scodeArgs );
        error_log( print_r( $spgURLVars, true) );

        $qryVars = abcfsl_util_spg_qry_vars();
        error_log( print_r( $qryVars, true) );
    }   
}

function abcfsl_util_spg_url_vars( $scodeArgs ){

    $pgName = ( get_query_var('pagename') ) ? get_query_var('pagename' ) : '';    
    $name = ( get_query_var('name') ) ? get_query_var('name' ) : '';
    $smid = ( get_query_var('smid') ) ? get_query_var('smid' ) : '';
    $staffName = ( get_query_var('staff-name') ) ? get_query_var('staff-name' ) : '';
    $pgURL = abcfsl_current_page_url();
    $staffID = abcfsl_spg_a_tag_staff_member_id ( $scodeArgs );

    $out['pagename'] = $pgName;
    $out['name'] = $name;
    $out['smid'] = $smid;
    $out['staff-name'] = $staffName;
    $out['pgURL'] = $pgURL;
    $out['staffID'] = $staffID;

    return $out;

// [pagename] => profilo
// [smid] => 7376
// [name] => profilo
// http://localhost:8080/blog/profilo?smid=7376

// [pagename] => profilo
// [staff-name] => Alvarado
// [name] => profilo
// http://localhost:8080/blog/profilo/Alvarado    

}

//Get current page URL
function abcfsl_current_page_url() {
    global $wp;
    return add_query_arg( $_SERVER['QUERY_STRING'], '', home_url( $wp->request ) );

    //$current_url = home_url( add_query_arg( array(), $wp->request ) );
}

//View all WP query variables
function abcfsl_util_spg_qry_vars(){
    global $wp_query;
    return $wp_query->query_vars;
}
//=== FOR DEBUG END  ==========================

// vCARD
function abcfsl_util_vcard_plugin_installed(){
    if(  class_exists( 'ABCF_Staff_VCard' ) ) { return true; }
    return false;
}

function abcfsl_util_get_current_url() {
    return home_url( $_SERVER['REQUEST_URI'] );
}

//-- Called from abcfsl_cnt_txt_field
function abcfsl_util_hide_hidden_field( $fieldType, $hideField, $hiddenFields ){

    if( $fieldType == 'N' ) { return true; }
    if( $hiddenFields == '1' ) { return false; }
    if( $hideField != 'N' ) { return true; }

    return false;    
}

function abcfsl_util_hide_private_field( $fieldType, $privateField, $privateFields ){

    if( $fieldType == 'N' ) { return true; }
    if( $privateFields == '1' ) { return false; }
    if( $privateField == '1' ) { return true; }

    return false;    
}

//Help under
function abcfsl_util_vcard_no_tplate( $vcTplateID, $postType, $slTplateID ){

    // vCard template not selected
    if( empty( $vcTplateID ) ) { return abcfsl_txta(429); }

    $cbo = abcfsl_db_cbo_vcard_tplates( $slTplateID, $postType );

    //vCard template not found
    if ( !array_key_exists( $vcTplateID, $cbo ) ) { 
        return abcfsl_txta(430); 
    }
    return '';
}