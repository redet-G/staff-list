<?php
//Before print delete.
add_filter( 'wp_insert_post_data','abcfsl_autil_untrash_tplate', 10, 2 );

//Don't delete a template it has Staff Members.
function abcfsl_autil_untrash_tplate($data, $postarr ){

    $out = abcfsl_autil_post_type ( $data['post_type'] );
    if( $out == 1){
        switch ( $data['post_status'] ) {
        case 'trash' :
            if( abcfsl_dba_chidren_qty( $postarr['ID'] ) > 0 ){
                wp_die(abcfsl_txta(327) );
                exit;
            }
            break;
        default:
            break;
        }
    }
    return $data;
}
//==============================================================

//Called from staff-list. remove_permalink , remove_post_edit_links
function abcfsl_autil_post_type ( $postType ){
    $out = 0;

    switch ($postType) {
        case 'cpt_staff_lst':
            $out = 1;
            break;
        case 'cpt_staff_lst_item':
            $out = 2;
            break;
        case 'cpt_staff_lst_filter':
            $out = 2;
            break;
        default:
            break;
    }

    return $out;
}

//-----------------------------------------------------
//Check for plugin updates
function abcfsl_autil_filter_update_checks($queryArgs) {

    $key = abcfl_autil_get_licence_key('abcfsl_optns');
    if ( !empty($key) ) { $queryArgs['license_key'] = $key; }
    return $queryArgs;
}

//Field data input. Show on Staff or Staff + Single or Single only. Can be disabled if Staff + Single.
function abcfsl_autil_show_field_for_data_input( $showFieldOn, $isSingle ){

    //0=No; 1=Yes; 2=Yes, Disabled; Y-Staff+Single; L-Staff; S-Single;

    $out = 0;
    switch ( $showFieldOn ) {
        case 'Y':
            if( $isSingle ){ $out = 2; }
            else { $out = 1; }
            break;
        case 'L':
            if( $isSingle ){ $out = 0; }
            else { $out = 1; }
            break;
        case 'S':
            if( $isSingle ){ $out = 1; }
            else { $out = 0; }
            break;
        default:
            break;
    }

    return $out;
}

//== UPDATE FIELD ORDER - START ===================================================
//Field order. Add or remove field. Called from save template. Executed in class mbox tplate.
function abcfsl_autil_f_field_to_field_order( $tplateID, $hideDelete, $showOn, $F ){

    //Fx fields. hideDelete = N, H, D
    $metaFieldL = '_fieldOrder';
    $metaFieldS = '_fieldOrderS';
    
    //Delete from both field orders.
    if( $hideDelete == 'D' ) {
        abcfsl_autil_delete_field_from_field_order( $tplateID, $F, $metaFieldL );
        abcfsl_autil_delete_field_from_field_order( $tplateID, $F, $metaFieldS );
        return;
    }

    //Show On Y, L, S
    switch ( $showOn ) {
        case 'Y':
            abcfsl_autil_update_field_order( $tplateID, $F, $metaFieldL );
            abcfsl_autil_update_field_order( $tplateID, $F, $metaFieldS );
            break;
        case 'L':
            abcfsl_autil_update_field_order( $tplateID, $F, $metaFieldL );
            abcfsl_autil_delete_field_from_field_order( $tplateID, $F, $metaFieldS );
            break;
        case 'S':
            abcfsl_autil_update_field_order( $tplateID, $F, $metaFieldS );
            abcfsl_autil_delete_field_from_field_order( $tplateID, $F, $metaFieldL );
            break;
        default:
            break;
    }
}

function abcfsl_autil_s_field_to_field_order( $tplateID, $ShowLink, $showOn, $F ){

    $metaFieldL = '_fieldOrder';
    $metaFieldS = '_fieldOrderS';

    //SPTL or 'SL' fields. ShowLink = N, Y, H
    if( $ShowLink == 'N' ) {
        abcfsl_autil_delete_field_from_field_order( $tplateID, $F, $metaFieldL );
        abcfsl_autil_delete_field_from_field_order( $tplateID, $F, $metaFieldS );
        return;
    }
    //Show On Y, L, S
    switch ( $showOn ) {
        case 'Y':
            abcfsl_autil_update_field_order( $tplateID, $F, $metaFieldL );
            abcfsl_autil_update_field_order( $tplateID, $F, $metaFieldS );
            break;
        case 'L':
            abcfsl_autil_update_field_order( $tplateID, $F, $metaFieldL );
            abcfsl_autil_delete_field_from_field_order( $tplateID, $F, $metaFieldS );
            break;
        case 'S':
            abcfsl_autil_update_field_order( $tplateID, $F, $metaFieldS );
            abcfsl_autil_delete_field_from_field_order( $tplateID, $F, $metaFieldL );
            break;
        default:
            break;
    }
}
//----------------------------------------------------

//Add new field to: _fieldOrder. If field already exists exit with no updates.
function abcfsl_autil_update_field_order( $tplateID, $F, $metaField ){

    //If single is true, an empty string is returned.
    $fieldOrderA = get_post_meta( $tplateID, $metaField, true );

    $metaExists = true;
    //Check if new meta field exists. Empty or populated.
    if( empty( $fieldOrderA ) ){  $metaExists = false; }

    //There is already metadata. Update it
    if( $metaExists ){
        abcfsl_autil_update_meta_field_order_N( $tplateID, $fieldOrderA, $F, $metaField );
        return;
    }

    //No meta. Add a new meta + new field.
    abcfsl_autil_add_meta_and_field_order_N( $tplateID, $F, $metaField );   
}

//Meta field exists. Update it.
function abcfsl_autil_update_meta_field_order_N( $tplateID, $fieldOrderA, $F, $metaField ){

    //Check if field is already in an array. If so exit.
    if ( in_array( $F, $fieldOrderA ) ) {
        return;
    }
    //FIELDS_50  Field order can be higher than 40 or 50
    for ( $i = 1; $i <= 50; $i++ ) {
        //Add new field to first available key and exit.
        if( !isset( $fieldOrderA[$i] ) ){
           $fieldOrderA[$i] = $F;
           update_post_meta( $tplateID, $metaField, $fieldOrderA );
           return;
        }
    }
}

//No meta exists. Add a new meta + new field.
function abcfsl_autil_add_meta_and_field_order_N( $tplateID, $F, $metaField ){

    $metaValue[1] = $F;
    update_post_meta( $tplateID, $metaField, $metaValue );
}

//Delete F field from sort order
function abcfsl_autil_delete_field_from_field_order( $tplateID, $F, $metaField ){

    if( empty( $F ) ){ return; }

    $fieldOrderA = get_post_meta( $tplateID, $metaField, true );

    if( empty( $fieldOrderA ) ){ return; }
    
    if ( ( $key = array_search( $F, $fieldOrderA ) ) !== false ) {
        unset( $fieldOrderA[$key] );
    }

    array_unshift( $fieldOrderA,'' );
    unset( $fieldOrderA[0] );

    update_post_meta( $tplateID, $metaField, $fieldOrderA );
}

//Get fieldOrder meta. Convert saved meta to array.
function abcfsl_autil_field_order_saved( $tplateID, $isSingle ){

    $fieldOrderA = array();

    if( $isSingle ){
        $fieldOrderA = get_post_meta( $tplateID, '_fieldOrderS', true );
    }
    else {
        $fieldOrderA = get_post_meta( $tplateID, '_fieldOrder', true );
    }

    if( empty( $fieldOrderA ) )  { return array(); }

    if( count( array_unique( $fieldOrderA ) ) < count( $fieldOrderA ) ){
        $fieldOrderU = array_unique( $fieldOrderA );
        $fieldOrderA = array_combine( range( 1, count( $fieldOrderU ) ), array_values( $fieldOrderU ) );
    }

    //[1] => F1 [2] => F4 [3] => F5
    return $fieldOrderA;
}
//== UPDATE FIELD ORDER - END =================================

function abcfsl_util_center_yn( $fieldName, $aCenter, $lbl=83, $hlp=295 ){
    $cboYN = abcfsl_cbo_yn();
    echo abcfl_input_cbo( $fieldName, '',$cboYN, $aCenter, abcfsl_txta($lbl), abcfsl_txta($hlp), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl' );
}

// No data message metabox. Used by staff template and menus.
function abcfsl_util_mbox_no_data( $optns, $hline=false ){

    //$tplateOptns or $menuOptns
    $noDataMsg = isset( $optns['_noDataMsg'] ) ? esc_attr( $optns['_noDataMsg'][0] ) : '';
    if ( $hline ) { echo abcfl_input_hline('1', 20); }
    echo abcfl_input_txt( 'noDataMsg', '', $noDataMsg, abcfsl_txta(168), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
}

//=== CSS INPUTS START =================================================================

//-- CLASS & STYLE ---------------------------------------------------------------
//Class and style. Hline, Header, Optional custom labels and help.
function abcfsl_autil_css_section_hdr_class_style( $clsName, $clsValue, $styleName, $styleValue, $F, $hdrID, $hdrURL, $hline='', $clsHelpID=223, $styleHelpID=224, $clsDocsID=2, $styleDocsID=24 ){ 
    
    $lblCls = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(323), abcfsl_aurl( $clsDocsID ), 'abcflFontWP abcflFontS13 abcflFontW400' );
    $lblStyle = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(289), abcfsl_aurl( $styleDocsID ), 'abcflFontWP abcflFontS13 abcflFontW400' );

    if( !empty( $hline ) ) { echo abcfl_input_hline( $hline ); }
    if( !empty( $hdrID ) ) {
        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta( $hdrID ), abcfsl_aurl( $hdrURL ) );
    }

    echo abcfl_input_txt( $clsName . $F, '', $clsValue, $lblCls, abcfsl_txta( $clsHelpID ), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    echo abcfl_input_txt( $styleName . $F, '', $styleValue, $lblStyle, abcfsl_txta( $styleHelpID ), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
}

//Generic class and style. Optional Hline. Ho Header. 
function abcfsl_autil_css_section_class_style( $clsName, $clsValue, $styleName, $styleValue, $F, $hline='' ){    

    //? Icon is added to labels.
    $lblCls = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(323), abcfsl_aurl(2), 'abcflFontWP abcflFontS13 abcflFontW400' );
    $lblStyle = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(289), abcfsl_aurl(24), 'abcflFontWP abcflFontS13 abcflFontW400' );

    if( !empty( $hline ) ) { echo abcfl_input_hline( $hline ); }

    echo abcfl_input_txt( $clsName . $F, '', $clsValue, $lblCls, abcfsl_txta(223), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    echo abcfl_input_txt( $styleName . $F, '', $styleValue, $lblStyle, abcfsl_txta(224), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
}

// TAG class and style. Fixed Hline 2.
function abcfsl_autil_css_section_tag_class_style( $clsValue, $styleValue, $F ){    

    $lblCls = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(323), abcfsl_aurl(2), 'abcflFontWP abcflFontS13 abcflFontW400' );
    $lblStyle = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(289), abcfsl_aurl(24), 'abcflFontWP abcflFontS13 abcflFontW400' );

    echo abcfl_input_hline( '2' );
    echo abcfl_input_txt( 'tagCls_' . $F, '', $clsValue, $lblCls, abcfsl_txta(223), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    echo abcfl_input_txt( 'tagStyle_' . $F, '', $styleValue, $lblStyle, abcfsl_txta(224), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
}

//-- CLASS ONLY ---------------------------------------------------------------
//TAG class. Default Hline 2. Header with custom docs URL. 
function abcfsl_autil_css_section_single( $tagValue, $F, $hdrURLID ){

    echo abcfl_input_hline('2', '20');
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(367), abcfsl_aurl( $hdrURLID ) );
    echo abcfl_input_txt( 'tagCls_' . $F, '', $tagValue, abcfsl_txta(368), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
}

//Generic class. Optional Hline. Ho Header. Docs icon with default URL. 
function abcfsl_autil_css_section_class( $clsName, $clsValue, $F, $hline='' ){    

    $lblCls = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(323), abcfsl_aurl(2), 'abcflFontWP abcflFontS13 abcflFontW400' );
    if( !empty( $hline ) ) { echo abcfl_input_hline( $hline ); }
    echo abcfl_input_txt( $clsName . $F, '', $clsValue, $lblCls, abcfsl_txta(223), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
}

//Class only. Optional Hline. Ho Header. Label standard. Custom docs URL. Custom help or no help.
function abcfsl_autil_css_section_class_custom_help( $clsName, $clsValue, $urlID, $helpID, $F, $hline='' ){    

    $lblCls = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(323), abcfsl_aurl( $urlID ), 'abcflFontWP abcflFontS13 abcflFontW400' );
    if( !empty( $hline ) ) { echo abcfl_input_hline( $hline ); }
    echo abcfl_input_txt( $clsName . $F, '', $clsValue, $lblCls, abcfsl_txta( $helpID ), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
}

//Image CSS. Figure, Image, Caption
function abcfsl_autil_field_img_custom_classes( $tagValue, $lblValue, $txtValue, $F, $hdrURLID ){

    echo abcfl_input_hline('2', '20');
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(367), abcfsl_aurl( $hdrURLID ) );
    echo abcfl_input_info_lbl( abcfsl_txta(374), 'abcflMTop5', '14');

    echo abcfl_input_txt( 'tagCls_' . $F, '', $tagValue, abcfsl_txta(368), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    echo abcfl_input_txt( 'lblCls_' . $F, '', $lblValue, abcfsl_txta(27), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    echo abcfl_input_txt( 'txtCls_' . $F, '', $txtValue, abcfsl_txta(25), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
}

//Custom CSS: Container, Label, Field content
function abcfsl_autil_css_section_cntr_lbl_txt( $tagValue, $lblValue, $txtValue, $F, $hdrURLID ){

    echo abcfl_input_hline('2', '20');
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(367), abcfsl_aurl( $hdrURLID ) );
    echo abcfl_input_info_lbl( abcfsl_txta(374), 'abcflMTop5', '14');

    echo abcfl_input_txt( 'tagCls_' . $F, '', $tagValue, abcfsl_txta(368), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    echo abcfl_input_txt( 'lblCls_' . $F, '', $lblValue, abcfsl_txta(208), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    echo abcfl_input_txt( 'txtCls_' . $F, '', $txtValue, abcfsl_txta(369), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
}
//=== CSS INPUTS END =================================================================

//== CBOM SORT START ===========================================
function abcfsl_autil_save_delimited( $postArray ){

    if( empty( $postArray ) ) { return ''; }
    return html_entity_decode( implode(', ', $postArray ) );
}

//IN-array from POST. OUT- comma delimited string, sorted or not.
function abcfsl_autil_save_sorted_delimited( $postArray, $sortYN, $locale ){

    if( empty( $postArray ) ) { return ''; }

    $sortedArray = $postArray;
    if( $sortYN == 'Y' ){
        $sortedArray = abcfsl_autil_sort_array_locale( $postArray, $locale );
    }

    return html_entity_decode( implode(', ', $sortedArray ) );
}

//IN array; OUT sorted array
function abcfsl_autil_sort_array_locale( $toSort, $locale ){

    if ( !is_array( $toSort ) ) { return array(); }  

    if ( empty( $locale ) ) { 
        natcasesort($toSort);
        return $toSort;
    }  
    //---------------------------------------
    //locale en_US, en_CA, en_GB, fr_FR, or de_AT
    if (class_exists('Collator')) {
	    $coll = new \Collator( $locale );
        $coll->sort( $toSort );
    }
    else { 
        natcasesort($toSort);
        return $toSort;
     }
    
    return $toSort;
}

function abcfsl_autil_value_by_key( $key, $arrayIn ){
    
    $out = '';
    if ( array_key_exists( $key, $arrayIn ) ) { 
        $out =  $arrayIn[$key]; 
    }
    return $out;
}

//================================================
function  abcfsl_autil_db_versions() {

    global $wp_version;
    $dbVersion = abcfsl_dba_get_version();

    if( empty( $dbVersion ) ) {
        global $wpdb;
        if ( empty( $wpdb->use_mysqli ) ) {
            $dbVersion = mysql_get_server_info();
        } else {
            $dbVersion = mysqli_get_server_info( $wpdb->dbh );
        }
    }

    $out['dbVersion'] = $dbVersion;    
    $out['wpVersion'] = $wp_version;

    return $out;   
}

function abcfsl_autil_system_versions(){
    
    $versionInfo = abcfsl_autil_db_versions(); 

    $hLine = abcfl_input_hline('2', '40', '50Pc');
    $divS = abcfl_html_tag_cls( 'div', 'abcflMTop20 abcflFontS20' );
    $divE = abcfl_html_tag_end( 'div' );

    $dbLbl = abcfl_html_tag_with_content(  abcfsl_txta( 386, ': ' ), 'span', '', '');
    $wpLbl = abcfl_html_tag_with_content(  abcfsl_txta( 387, ': ' ), 'span', '', '');
    $dbVersion = abcfl_html_tag_with_content( $versionInfo['dbVersion'], 'span', '', 'abcflFontW600 abcflPLeft10');
    $wpVersion = abcfl_html_tag_with_content( $versionInfo['wpVersion'], 'span', '', 'abcflFontW600 abcflPLeft10');

    return  $hLine. $divS . $dbLbl . $dbVersion . $divE .  $divS . $wpLbl . $wpVersion . $divE;
}

//=== INPUTS ========================================================================
// Text input + Help ? + Optional required. 
function abcfsl_mbox_autil_input_txt_help_link( $inputID, $F, $inputData, $lblID, $helpID, $docsID, $required=false, $width='50%' ){

    $lbl = abcfsl_txta( $lblID );
    if( $required ) { $lbl = abcfsl_txta_r( $lblID ); }
    $lbl = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, $lbl, abcfsl_aurl( $docsID ), 'abcflFontWP abcflFontS13 abcflFontW400' );
    return abcfl_input_txt( $inputID . $F, '', $inputData, $lbl, abcfsl_txta( $helpID ), $width, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

// Text input. Optional required. 
function abcfsl_mbox_autil_input_txt( $inputID, $F, $inputData, $lblID, $helpID, $required=false, $width='50%' ){
    $lbl = abcfsl_txta( $lblID );
    if( $required ) { $lbl = abcfsl_txta_r( $lblID ); }
    return abcfl_input_txt( $inputID . $F, '', $inputData, $lbl, abcfsl_txta( $helpID ), $width, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfsl_mbox_autil_input_two_fields( $dataL, $dataR, $cntrW, $colL ){

    $clsCntr = 'abcflFGCntr';
    $clsColS1 = 'abcflFG2Col';
    $clsColS2 = 'abcflFG2Col';
    
    switch ( $cntrW ) {
        case 50:
            $flexCntr = 'abcflFGCntr abcflFGCntr50';
            break;
        case 30:
            $flexCntr = 'abcflFGCntr abcflFGCntr30';
            break;
        default:
            break;
    }

    switch ( $colL ) {
        case 65:
            $clsColS1 = 'abcflFG65P';
            $clsColS2 = 'abcflFG33P';
            break;
        case 70:
            $clsColS1 = 'abcflFG70P';
            $clsColS2 = 'abcflFG28P';
            break;
        case 80:
            $clsColS1 = 'abcflFG80P';
            $clsColS2 = 'abcflFG18P';
            break; 
        case 18:
            $clsColS1 = 'abcflFG18P';
            $clsColS2 = 'abcflFG80P';
            break;                       
        default:
            break;
    }

    $flexCntrS = abcfl_html_tag( 'div', '', $clsCntr );
    $clsColS1 = abcfl_html_tag( 'div', '', $clsColS1 ); 
    $clsColS2 = abcfl_html_tag( 'div', '', $clsColS2 );    
    $divE1 = abcfl_html_tag_end( 'div');
    $divE2 = abcfl_html_tag_ends( 'div,div' );

    return $flexCntrS . $clsColS1 . $dataL . $divE1 . $clsColS2 . $dataR . $divE2;
}

function abcfsl_mbox_autil_input_three_fields( $data1, $data2, $data3, $w1, $w2, $w3, $cntrW ){

    $flexCntr = 'abcflFGCntr';
    
    switch ( $cntrW ) {
        case 50:
            $flexCntr = 'abcflFGCntr abcflFGCntr50';
            break;
        default:
            break;
    }

    // abcflFG80P abcflFG70P abcflFG65P abcflFG33P abcflFG28P abcflFG18P abcflFG16P

    $flexCntrS = abcfl_html_tag( 'div', '', $flexCntr );
    $divS1 = abcfl_html_tag( 'div', '', 'abcflFG' . $w1 . 'P' ); 
    $divS2 = abcfl_html_tag( 'div', '', 'abcflFG' . $w2 . 'P' );
    $divS3 = abcfl_html_tag( 'div', '', 'abcflFG' . $w3 . 'P' );     
    $divE = abcfl_html_tag_end( 'div');

    return $flexCntrS . $divS1 . $data1 . $divE . $divS2 . $data2 . $divE . $divS3 . $data3 . $divE . $divE;
}

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function abcfl_style_inputs_txt_id( $lbl, $suffix='' ) {

    $txtID = 0;
    switch ( $lbl ){ 
        case 'cust_cls':
            $txtID = 323;
            break;
        case 'cust_style':
            $txtID = 289;
            break;
        case 'field_style':
            $txtID = 139;
            break;             
        case 'help_cls':
            $txtID = 223;
            break; 
        case 'help_style':
            $txtID = 224;
            break;                        
        default:
            break;       
    }
    if( !empty( $suffix) ) { $txtID = $txtID . ',' . $suffix; }
    return $txtID;
 }

// Input Fields. Section Field Style.
function abcfsl_autil_field_style_inputs_bldr( $tplateOptns, $par ) {

    $defaults['fTag'] = 'tagType';
    $defaults['fFont'] = 'tagFont';
    $defaults['fMarginT'] = 'tagMarginT';
    //$defaults['fMarginT2'] = '';
    //$defaults['fMarginT3'] = '';
    $defaults['showCustCSS'] = 1;
    $defaults['hlineShow'] = true;
    $defaults['showHdr'] = true;
    $defaults['F'] = '';

    $par = array_merge( $defaults, $par );
    //-----------------------------------------------
    $F = $par['F'];
    if( !empty( $F ) ) {
        $par['fTag'] = $par['fTag'] . '_' . $F;
        $par['fFont'] = $par['fFont'] . '_' . $F;
        $par['fMarginT'] = $par['fMarginT'] . '_' . $F;
    }
    //------------------------------------------------
    $flexCntr = abcfl_html_tag( 'div', '', 'abcflFGCntr abcflFGCntr50' );
    $flex2ColS = abcfl_html_tag( 'div', '', 'abcflFG2Col' ); 
    $flex3ColS = abcfl_html_tag( 'div', '', 'abcflFG3Col' );  
    $divE = abcfl_html_tag_end( 'div'); 
    //------------------------------------------------
    $dataTag = isset( $tplateOptns['_' . $par['fTag']] ) ? $tplateOptns['_' . $par['fTag']][0] : 'div';
    $dataFont = isset( $tplateOptns['_' . $par['fFont']] ) ? $tplateOptns['_' . $par['fFont']][0] : '';

    $dataMarginT = isset( $tplateOptns['_' . $par['fMarginT']] ) ? $tplateOptns['_' . $par['fMarginT']][0] : '';
    //$dataMarginT2 = isset( $tplateOptns['_' . $par['fMarginT2']] ) ? $tplateOptns['_' . $par['fMarginT2']][0] : '';
    //$dataMarginT3 = isset( $tplateOptns['_' . $par['fMarginT3']] ) ? $tplateOptns['_' . $par['fMarginT3']][0] : '';

    $cboTag = abcfsl_cbo_tag_type();
    $cboFont = abcfsl_cbo_font_size();
    $cboMarginT  = abcfsl_cbo_txt_margin_top();

    $fieldTag = abcfl_input_cbo( $par['fTag'], '', $cboTag, $dataTag, abcfsl_txta_r(287), abcfsl_txta(279), '100%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    $fieldFont = abcfl_input_cbo_strings( $par['fFont'], '', $cboFont, $dataFont, abcfsl_txta(47), abcfsl_txta(247), '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    //$fieldMarginT = abcfl_input_cbo_strings( $par['fMarginT'], '', $cboMarginT, $dataMarginT, abcfsl_txta(15) . ' 1', '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    //$fieldMarginT2 = abcfl_input_cbo_strings( $par['fMarginT2'], '', $cboMarginT, $dataMarginT2, abcfsl_txta(15). ' 2', '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    //$fieldMarginT3 = abcfl_input_cbo_strings( $par['fMarginT3'], '', $cboMarginT, $dataMarginT3, abcfsl_txta(15). ' 3', '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    
    //==  Render inputs  =====================
    abcfsl_autil_section_hline( $par );
    abcfsl_autil_section_hdr( $par );
    //----------------------------------------
    echo $flexCntr . $flex2ColS . $fieldTag . $divE . $flex2ColS . $fieldFont . abcfl_html_tag_ends( 'div,div' );
    echo abcfl_input_cbo_strings( $par['fMarginT'], '', $cboMarginT, $dataMarginT, abcfsl_txta(15), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    // if( empty( $par['fMarginT2'] . $par['fMarginT3'] ) ){
    //     echo abcfl_input_cbo_strings( $par['fMarginT'], '', $cboMarginT, $dataMarginT, abcfsl_txta(15), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    // }

    // if( !empty( $par['fMarginT2'] ) && empty( $par['fMarginT3'] ) ){
    //     echo $flexCntr . $flex2ColS . $fieldMarginT . $divE . $flex2ColS . $fieldMarginT2 . abcfl_html_tag_ends( 'div,div' );
    // }

    // if( !empty( $par['fMarginT2'] ) && !empty( $par['fMarginT3'] ) ){
    //     echo $flexCntr . $flex3ColS . $fieldMarginT . $divE . $flex3ColS . $fieldMarginT2 . $divE . $flex3ColS . $fieldMarginT3 . abcfl_html_tag_ends( 'div,div' );
    // }

    //No custom CSS header when CSS added to field style options.
    $par['hlineShow'] = false;
    $par['showHdr'] = false;
    
    switch ( $par['showCustCSS'] ){ 
        case 1:
            abcfsl_autil_custom_class_and_style( $tplateOptns, $par );
            break;
        case 2:
            abcfsl_autil_css_custom_class( $tplateOptns, $par );
            break;
        case 3:
            abcfsl_autil_css_custom_style( $tplateOptns, $par );
            break; 
        default:
            break;       
    }
}

// 2 columns. Custom class & style. Can have header and hline.
function abcfsl_autil_custom_class_and_style( $tplateOptns, $par ){        

    $defaults['fCustCls'] = 'tagCls';
    $defaults['fCustStyle'] = 'tagStyle';
    $defaults['lblCls'] = abcfl_style_inputs_txt_id( 'cust_cls' ); //323;
    $defaults['lblStyle'] = abcfl_style_inputs_txt_id( 'cust_style' ); //289;
    $defaults['hlpCls'] = ''; // 223
    $defaults['hlpStyle'] = ''; // 224
    $defaults['urlCls'] = 0; //2
    $defaults['urlStyle'] = 0; //24
    $defaults['hlpTxt'] = '';
    $defaults['hlpTxtR'] = false;
    $defaults['F'] = '';
    $defaults['defaultCustCls'] = '';
    
    $par = array_merge( $defaults, $par );
    //-------------------------------------------------------
    $F = $par['F'];
    if( !empty( $F ) ) {
        $par['fCustCls'] = $par['fCustCls'] . '_' . $F;
        $par['fCustStyle'] = $par['fCustStyle'] . '_' . $F;
    }
    //-----------------------------------------------------
    $helpClasses = 'abcflFontWP abcflFontS13 abcflFontW400';
    $lblClsTxt = abcfsl_txta( $par['lblCls'] );
    $lblStyleTxt = abcfsl_txta( $par['lblStyle'] );
    $hlpClsTxt = abcfsl_txta( $par['hlpCls'] );
    $hlpStyleTxt = abcfsl_txta( $par['hlpStyle'] );

    $urlCls = abcfsl_aurl( $par['urlCls'] );
    $urlStyle = abcfsl_aurl( $par['urlStyle'] );

    if( $par['urlCls'] > 0 ) {
        $lblClsTxt = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, $lblClsTxt, $urlCls, $helpClasses );

        if( $par['urlStyle'] == 0 ) {
            $lblStyleTxt = abcfl_input_sec_title_hlp_blank( ABCFSL_ICONS_URL, $lblStyleTxt, $helpClasses );
        }
    }

    if( $par['urlStyle'] > 0 ) {
        $lblStyleTxt = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, $lblStyleTxt, $urlStyle, $helpClasses );

        if( $par['urlCls'] == 0 ) {
            $lblClsTxt = abcfl_input_sec_title_hlp_blank( ABCFSL_ICONS_URL, $lblClsTxt, $helpClasses );
        }
    }
    //---------------------------------------
    $dataCls = isset( $tplateOptns['_' . $par['fCustCls']] ) ? esc_attr( $tplateOptns['_' . $par['fCustCls']][0] ) : ''; 
    $dataStyle = isset( $tplateOptns['_' . $par['fCustStyle']] ) ? esc_attr( $tplateOptns['_' . $par['fCustStyle']][0] ) : '';
    //------------------------------------------------------------
    $inputClass = abcfl_input_txt( $par['fCustCls'], '', $dataCls, $lblClsTxt,  $hlpClsTxt, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    $inputStyle = abcfl_input_txt( $par['fCustStyle'], '', $dataStyle,  $lblStyleTxt, $hlpStyleTxt, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    //------------------------------------------------------------
    $flexCntr = abcfl_html_tag( 'div', '', 'abcflFGCntr abcflFGCntr50' );
    $flex2ColS = abcfl_html_tag( 'div', '', 'abcflFG2Col' );   
    $divE = abcfl_html_tag_end( 'div');
    
    //===============================================
    abcfsl_autil_section_hline( $par ); 
    abcfsl_autil_section_hdr( $par );

    echo $flexCntr . $flex2ColS . $inputClass . $divE . $flex2ColS . $inputStyle . abcfl_html_tag_ends( 'div,div' );

    if( !empty( $par['hlpTxt'] ) ) {
        $lblTxt = abcfsl_txta( $par['hlpTxt'] );
        if( $par['hlpTxtR'] ) { $lblTxt = abcfsl_txta_r( $par['hlpTxt'] ); }
        echo abcfl_input_info_lbl( $lblTxt, 'abcflMTop5', 12 );
    }
}

//Custom class. Can have header and hline.
function abcfsl_autil_css_custom_class( $tplateOptns, $par ){    

    $defaults['fCustCls'] = 'tagCls';
    $defaults['lblCls'] = abcfl_style_inputs_txt_id( 'cust_cls' );
    $defaults['hlpCls'] = '';
    $defaults['urlCls'] = 0; 
    $defaults['F'] = '';

    $par = array_merge( $defaults, $par );
    //-------------------------------------------------------
    $F = $par['F'];
    if( !empty( $F ) ) { 
        $par['fCustCls'] = $par['fCustCls'] . '_' . $F; 
    }

    $lblClsTxt = abcfsl_txta( $par['lblCls'] );
    $hlpClsTxt = abcfsl_txta( $par['hlpCls'] );
    $urlCls = abcfsl_aurl( $par['urlCls'] );

    if( $par['urlCls'] > 0 ) { 
        $lblClsTxt = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, $lblClsTxt, $urlCls, 'abcflFontWP abcflFontS13 abcflFontW400' ); 
    }
    //---------------------------------------
    $dataCls = isset( $tplateOptns['_' . $par['fCustCls']] ) ? esc_attr( $tplateOptns['_' . $par['fCustCls']][0] ) : ''; 

    //=======================================
    abcfsl_autil_section_hline( $par ); 
    abcfsl_autil_section_hdr( $par );
    echo abcfl_input_txt( $par['fCustCls'], '', $dataCls, $lblClsTxt,  $hlpClsTxt, '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
}

// Field Custom style. Can have header and hline.
function abcfsl_autil_css_custom_style( $tplateOptns, $par ){    

    $defaults['fCustStyle'] = 'tagStyle';
    $defaults['lblStyle'] = abcfl_style_inputs_txt_id( 'cust_style' );
    $defaults['hlpStyle'] = '';
    $defaults['urlStyle'] = '';
    $defaults['F'] = '';

    $par = array_merge( $defaults, $par );
    //-------------------------------------------------------
    $F = $par['F'];
    if( !empty( $F ) ) { $par['fCustStyle'] = $par['fCustStyle'] . '_' . $F; }

    $lblStyleTxt = abcfsl_txta( $par['lblStyle'] );
    $hlpStyleTxt = abcfsl_txta( $par['hlpStyle'] );    
    $urlStyle = abcfsl_aurl( $par['urlStyle'] );

    if( $par['urlStyle'] > 0 ) { 
        $lblStyleTxt = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, $lblStyleTxt, $urlStyle, 'abcflFontWP abcflFontS13 abcflFontW400' ); 
    }
    //---------------------------------------
    $dataStyle = isset( $tplateOptns['_' . $par['fCustStyle']] ) ? esc_attr( $tplateOptns['_' . $par['fCustStyle']][0] ) : ''; 

    //===================================
    abcfsl_autil_section_hline( $par ); 
    abcfsl_autil_section_hdr( $par );
    echo abcfl_input_txt( $par['fCustStyle'], '', $dataStyle, $lblStyleTxt, $hlpStyleTxt, '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
}

function abcfsl_autil_section_hdr( $par ){

    // Txt admin Number if not default.
    $defaults['hdrLbl'] = abcfl_style_inputs_txt_id( 'field_style' ); 
    $defaults['hdrURL'] = 14;
    $defaults['showHdr'] = true;
    $defaults['infoLblUB'] = false;
    $defaults['hdrCustCls'] = '';
    $defaults['hdrInfoLbl'] = 0;
    
    // ????????????????????????????
    $defaults['lblUB'] = false;
    $defaults['urlUB'] = false;

    $par = array_merge( $defaults, $par );

    // No header
    if( !$par['showHdr'] ) { return '';}
    //-----------------------------------
    $lbl = abcfsl_txta( $par['hdrLbl'] );
    $url = abcfsl_aurl( $par['hdrURL'] );

    // ???????????????????????????????
    //if( $par['lblUB']) { $lbl = abcfsl_txta( $par['hdrLbl'] ); }
    //if( $par['urlUB']) { $url = abcfsl_aurl( $par['hdrURL'] ); }

    // Optional section label style. Default: abcflFontWP abcflFontS16 abcflFontW600 abcflMTop5
    $clsCust = $par['hdrCustCls'];

    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, $lbl, $url, $clsCust );

    // Help lbl. Under section title.
    if( $par['hdrInfoLbl'] > 0 ) { 
        $lblTxt =  abcfsl_txta( $par['hdrInfoLbl'] );        
        //if( $par['infoLblUB'] ) { $lblTxt = abcfsl_txta( $par['hdrInfoLbl'] ); }
        //echo abcfl_input_info_lbl( abcfsl_txta( $lblTxt ), 'abcflMTop5', '14') ;
        echo abcfl_input_info_lbl( $lblTxt, 'abcflMTop5', '14') ;
    }    
}

//Display horizontal line.
function abcfsl_autil_section_hline( $par ){

    $defaults['hlineShow'] = true;
    $defaults['hlineWidthBT'] = 2;
    $defaults['hlineMarginT'] = 20;
    $defaults['hlineColor'] = '';
    $defaults['hlineCustomCls'] = '';
    $par = array_merge( $defaults, $par );

    if( $par['hlineShow'] ) { echo abcfl_input_hline( $par['hlineWidthBT'], $par['hlineMarginT'] ); }    
}

//F number + lbl. For standalone multi part fields or parameter for abcfl_input_txt. 
function abcfsl_autil_input_field_number( $F, $inputLbl, $marginT='' ){
    // 0,2,5,10,15,20
    $mT = '';    
    if( !empty( $marginT ) ) { $mT = 'abcflPTop' . $marginT; }
    return '<div class="' .  trim('abcflFontWPSB abcflFontS13 ' . $mT ) . '">' . $F . '.&nbsp' . $inputLbl . '</div>';
}

//===========================================================================

// Two dropdowns. Can have header and hline.
function abcfsl_autil_two_dropdowns( $tplateOptns, $par ){  

    $defaults['fieldID1'] = '';
    $defaults['fieldID2'] = '';
    $defaults['cbo1'] = '';
    $defaults['cbo2'] = '';
    $defaults['lbl1'] = 0; 
    $defaults['lbl2'] = 0; 
    $defaults['hlp1'] = 0; 
    $defaults['hlp2'] = 0; 
    $defaults['url1'] = 0; 
    $defaults['url2'] = 0; 
    $defaults['hlpTxt'] = 0;
    $defaults['hlpTxtR'] = false;
    
    $par = array_merge( $defaults, $par );
    //-----------------------------------------------------
    $helpClasses = 'abcflFontWP abcflFontS13 abcflFontW400';
    $lbl1Txt = abcfsl_txta( $par['lbl1'] );
    $lbl2Txt = abcfsl_txta( $par['lbl2'] );
    $hlp1Txt = abcfsl_txta( $par['hlp1'] );
    $hlp2Txt = abcfsl_txta( $par['hlp2'] );

    $url1 = abcfsl_aurl( $par['url1'] );
    $url2 = abcfsl_aurl( $par['url2'] );

    if( $par['url1'] > 0 ) {
        $lbl1Txt = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, $lbl1Txt, $url1, $helpClasses );

        if( $par['url2'] == 0 ) {
            $lbl2Txt = abcfl_input_sec_title_hlp_blank( ABCFSL_ICONS_URL, $lbl2Txt, $helpClasses );
        }
    }

    if( $par['url2'] > 0 ) {
        $lbl2Txt = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, $lbl2Txt, $url2, $helpClasses );

        if( $par['url1'] == 0 ) {
            $lbl1Txt = abcfl_input_sec_title_hlp_blank( ABCFSL_ICONS_URL, $lbl1Txt, $helpClasses );
        }
    }

    $data1 = isset( $tplateOptns['_' . $par['fieldID1']] ) ? $tplateOptns['_' . $par['fieldID1']][0] : ''; 
    $data2 = isset( $tplateOptns['_' . $par['fieldID2']] ) ? $tplateOptns['_' . $par['fieldID2']][0] : '';

    $input1 = abcfl_input_cbo_strings( $par['fieldID1'], '', $par['cbo1'], $data1, $lbl1Txt, $hlp1Txt, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $input2 = abcfl_input_cbo_strings( $par['fieldID2'], '',  $par['cbo2'], $data2, $lbl2Txt, $hlp2Txt, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    //------------------------------------------------------------
    $flexCntr = abcfl_html_tag( 'div', '', 'abcflFGCntr abcflFGCntr50' );
    $flex2ColS = abcfl_html_tag( 'div', '', 'abcflFG2Col' );   
    $divE = abcfl_html_tag_end( 'div');    
    //===============================================
    abcfsl_autil_section_hline( $par ); 
    abcfsl_autil_section_hdr( $par );

    echo $flexCntr . $flex2ColS . $input1 . $divE . $flex2ColS . $input2 . abcfl_html_tag_ends( 'div,div' );

    if( !empty( $par['hlpTxt'] ) ) {
        $lblTxt = abcfsl_txta( $par['hlpTxt'] );
        if( $par['hlpTxtR'] ) { $lblTxt = abcfsl_txta_r( $par['hlpTxt'] ); }
        echo abcfl_input_info_lbl( $lblTxt, 'abcflMTop5', 12 );
    }
}

// Two dropdowns. Can have header and hline.
function abcfsl_autil_dropdown_txt( $tplateOptns, $par ){  

    $defaults['fieldID1'] = '';
    $defaults['fieldID2'] = '';
    $defaults['cbo1'] = '';
    $defaults['lbl1'] = 0; 
    $defaults['lbl2'] = 0; 
    $defaults['hlp1'] = 0; 
    $defaults['hlp2'] = 0; 
    $defaults['url1'] = 0; 
    $defaults['url2'] = 0; 
    $defaults['hlpTxt'] = 0;
    $defaults['hlpTxtR'] = false;
    $defaults['txtDropdown'] = false;
    
    $par = array_merge( $defaults, $par );

    //-----------------------------------------------------
    $helpClasses = 'abcflFontWP abcflFontS13 abcflFontW400';
    $lbl1Txt = abcfsl_txta( $par['lbl1'] );
    $lbl2Txt = abcfsl_txta( $par['lbl2'] );
    $hlp1Txt = abcfsl_txta( $par['hlp1'] );
    $hlp2Txt = abcfsl_txta( $par['hlp2'] );

    $url1 = abcfsl_aurl( $par['url1'] );
    $url2 = abcfsl_aurl( $par['url2'] );

    if( $par['url1'] > 0 ) {
        $lbl1Txt = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, $lbl1Txt, $url1, $helpClasses );

        if( $par['url2'] == 0 ) {
            $lbl2Txt = abcfl_input_sec_title_hlp_blank( ABCFSL_ICONS_URL, $lbl2Txt, $helpClasses );
        }
    }

    if( $par['url2'] > 0 ) {
        $lbl2Txt = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, $lbl2Txt, $url2, $helpClasses );

        if( $par['url1'] == 0 ) {
            $lbl1Txt = abcfl_input_sec_title_hlp_blank( ABCFSL_ICONS_URL, $lbl1Txt, $helpClasses );
        }
    }

    $data1 = isset( $tplateOptns['_' . $par['fieldID1']] ) ? $tplateOptns['_' . $par['fieldID1']][0] : ''; 
    $data2 = isset( $tplateOptns['_' . $par['fieldID2']] ) ? $tplateOptns['_' . $par['fieldID2']][0] : '';

    $input1 =  abcfl_input_cbo_strings( $par['fieldID1'], '', $par['cbo1'], $data1, $lbl1Txt, $hlp1Txt, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $input2 = abcfl_input_txt( $par['fieldID2'], '', $data2,  $lbl2Txt, $hlp2Txt, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    //------------------------------------------------------------
    $flexCntr = abcfl_html_tag( 'div', '', 'abcflFGCntr abcflFGCntr50' );
    $flex2ColS = abcfl_html_tag( 'div', '', 'abcflFG2Col' );   
    $divE = abcfl_html_tag_end( 'div');    
    //===============================================
    abcfsl_autil_section_hline( $par ); 
    abcfsl_autil_section_hdr( $par );

    if( !$par['txtDropdown'] ) {
        echo $flexCntr . $flex2ColS . $input1 . $divE . $flex2ColS . $input2 . abcfl_html_tag_ends( 'div,div' );
    }
    else{
        echo $flexCntr . $flex2ColS . $input2 . $divE . $flex2ColS . $input1 . abcfl_html_tag_ends( 'div,div' );
    }

    if( !empty( $par['hlpTxt'] ) ) {
        $lblTxt = abcfsl_txta( $par['hlpTxt'] );
        if( $par['hlpTxtR'] ) { $lblTxt = abcfsl_txta_r( $par['hlpTxt'] ); }
        echo abcfl_input_info_lbl( $lblTxt, 'abcflMTop5', 12 );
    }
}