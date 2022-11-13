<?php
function abcfsl_mbox_item_img_IMGCAP( $tplateOptns, $itemOptns, $F, $showField ){

    if($showField == 0) { return ''; }

    $imgUrlLbl = isset( $tplateOptns['_imgUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_imgUrlLbl_' . $F][0] ) : '';
    $imgUrlHlp = isset( $tplateOptns['_imgUrlHlp_' . $F] ) ? esc_attr( $tplateOptns['_imgUrlHlp_' . $F][0] ) : '';
    $captionLbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
    $captionHlp = isset( $tplateOptns['_inputHlp_' . $F] ) ? esc_attr( $tplateOptns['_inputHlp_' . $F][0] ) : '';
    $imgAltLbl = isset( $tplateOptns['_imgAltLbl_' . $F] ) ? esc_attr( $tplateOptns['_imgAltLbl_' . $F][0] ) : '';
    $imgAltHlp = isset( $tplateOptns['_imgAltHlp_' . $F] ) ? esc_attr( $tplateOptns['_imgAltHlp_' . $F][0] ) : ''; 
     
    $captionTxt = isset( $itemOptns['_txt_' . $F] ) ? esc_attr( $itemOptns['_txt_' . $F][0] ) : '';
    $imgUrl = isset( $itemOptns['_imgUrl_' . $F] ) ? esc_attr( $itemOptns['_imgUrl_' . $F][0] ) : '';
    $imgAlt = isset( $itemOptns['_imgAlt_' . $F] ) ? esc_attr( $itemOptns['_imgAlt_' . $F][0] ) : '';   

    //---RENDER FIELD ---------------------------------------------------
    echo abcfl_input_hline('2', '10');
    echo abcfsl_mbox_item_img_field_row_select( $imgUrl, $imgUrlLbl, $imgUrlHlp, $F, $showField );
    echo abcfsl_mbox_item_img_field_row_caption( $captionTxt, $imgAlt, $captionLbl, $captionHlp, $imgAltLbl, $imgAltHlp, $F, $showField );
    echo abcfl_input_hline('2', '10');
}

function abcfsl_mbox_item_img_IMGHLNK( $tplateOptns, $itemOptns, $F, $showField ){

    if($showField == 0) { return ''; }
    $imgUrlLbl = isset( $tplateOptns['_imgUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_imgUrlLbl_' . $F][0] ) : '';
    $imgUrlHlp = isset( $tplateOptns['_imgUrlHlp_' . $F] ) ? esc_attr( $tplateOptns['_imgUrlHlp_' . $F][0] ) : '';
    $imgUrl = isset( $itemOptns['_imgUrl_' . $F] ) ? esc_attr( $itemOptns['_imgUrl_' . $F][0] ) : '';
    
    //---RENDER FIELD ----------------------
    echo abcfl_input_hline('2', '10');
    echo abcfsl_mbox_item_img_field_row_select( $imgUrl, $imgUrlLbl, $imgUrlHlp, $F, $showField );
    echo abcfsl_mbox_item_img_field_row_imghlnk( $tplateOptns, $itemOptns, $F, $showField );
    echo abcfl_input_hline('2', '10');
}

//=== IMAGE FIELD PARTS - START =======================================================
function abcfsl_mbox_item_img_field_row_imghlnk( $tplateOptns, $itemOptns, $F, $showField ){   
    
    $imgUrlLbl = isset( $tplateOptns['_imgUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_imgUrlLbl_' . $F][0] ) : '';
    $imgUrlHlp = isset( $tplateOptns['_imgUrlHlp_' . $F] ) ? esc_attr( $tplateOptns['_imgUrlHlp_' . $F][0] ) : '';
    $captionLbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
    $captionHlp = isset( $tplateOptns['_inputHlp_' . $F] ) ? esc_attr( $tplateOptns['_inputHlp_' . $F][0] ) : '';
    $imgLnkLbl = isset( $tplateOptns['_imgLnkLbl_' . $F] ) ? esc_attr( $tplateOptns['_imgLnkLbl_' . $F][0] ) : '';
    $imgLnkHlp = isset( $tplateOptns['_imgLnkHlp_' . $F] ) ? esc_attr( $tplateOptns['_imgLnkHlp_' . $F][0] ) : '';
    $imgAltLbl = isset( $tplateOptns['_imgAltLbl_' . $F] ) ? esc_attr( $tplateOptns['_imgAltLbl_' . $F][0] ) : '';
    $imgAltHlp = isset( $tplateOptns['_imgAltHlp_' . $F] ) ? esc_attr( $tplateOptns['_imgAltHlp_' . $F][0] ) : ''; 
    $imgLnkAttrLbl = isset( $tplateOptns['_imgLnkAttrLbl_' . $F] ) ? esc_attr( $tplateOptns['_imgLnkAttrLbl_' . $F][0] ) : '';
    $imgLnkAttrHlp = isset( $tplateOptns['_imgLnkAttrHlp_' . $F] ) ? esc_attr( $tplateOptns['_imgLnkAttrHlp_' . $F][0] ) : '';
    $imgLnkClickLbl = isset( $tplateOptns['_imgLnkClickLbl_' . $F] ) ? esc_attr( $tplateOptns['_imgLnkClickLbl_' . $F][0] ) : '';
    $imgLnkClickHlp = isset( $tplateOptns['_imgLnkClickHlp_' . $F] ) ? esc_attr( $tplateOptns['_imgLnkClickHlp_' . $F][0] ) : ''; 

    $imgUrl = isset( $itemOptns['_imgUrl_' . $F] ) ? esc_attr( $itemOptns['_imgUrl_' . $F][0] ) : '';
    $captionTxt = isset( $itemOptns['_txt_' . $F] ) ? esc_attr( $itemOptns['_txt_' . $F][0] ) : '';
    $imgAlt = isset( $itemOptns['_imgAlt_' . $F] ) ? esc_attr( $itemOptns['_imgAlt_' . $F][0] ) : '';  
    $imgLnk = isset( $itemOptns['_imgLnk_' . $F] ) ? esc_attr( $itemOptns['_imgLnk_' . $F][0] ) : '';
    $imgLnkAttr = isset( $itemOptns['_imgLnkAttr_' . $F] ) ? esc_attr( $itemOptns['_imgLnkAttr_' . $F][0] ) : '';
    $imgLnkClick = isset( $itemOptns['_imgLnkClick_' . $F] ) ? esc_attr( $itemOptns['_imgLnkClick_' . $F][0] ) : ''; 
    

    //----------------------------------------------------------------------
    $captionLbl = abcfsl_mbox_item_text_line_number( $F, $captionLbl );    
    $altLbl = abcfsl_mbox_item_text_line_number( $F, $imgAltLbl );
    $imgLnkLbl = abcfsl_mbox_item_text_line_number( $F , $imgLnkLbl );    
    $imgLnkAttrLbl = abcfsl_mbox_item_text_line_number( $F , $imgLnkAttrLbl );  
    $imgLnkClickLbl = abcfsl_mbox_item_text_line_number( $F , $imgLnkClickLbl );  
    $blank = '&nbsp;';

    if( $showField == 2 ) {
        $captionTxtF = abcfl_input_txt_readonly('ro_txt_' . $F, '', $captionTxt, $captionLbl, $captionHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $imgAltF = abcfl_input_txt_readonly('ro_imgAlt_' . $F, '', $imgAlt, $altLbl, $imgAltHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $imgLnkF = abcfl_input_txt_readonly('ro_imgLnk_' . $F, '', $imgLnk, $imgLnkLbl, $imgLnkHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $imgLnkArgsF = abcfl_input_txt_readonly('ro_imgLnkArgs_' . $F, '', $imgLnkAttr, $imgLnkAttrLbl, $imgLnkAttrHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $imgLnkClickF = abcfl_input_txt_readonly('ro_imgLnkClick_' . $F, '', $imgLnkClick, $imgLnkClickLbl, $imgLnkClickHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');

        return abcfsl_mbox_item_img_field_row_imghlnk_HTML( $imgLnkF, $captionTxtF, $imgAltF, $imgLnkArgsF, $imgLnkClickF );
    }  

    $captionTxtF = abcfl_input_txt('txt_' . $F, '', $captionTxt, $captionLbl, $captionHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $imgAltF = abcfl_input_txt('imgAlt_' . $F, '', $imgAlt, $altLbl, $imgAltHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $imgLnkF = abcfl_input_txt('imgLnk_' . $F, '', $imgLnk, $imgLnkLbl, $imgLnkHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $imgLnkArgsF = abcfl_input_txt('imgLnkAttr_' . $F, '', $imgLnkAttr, $imgLnkAttrLbl, $imgLnkAttrHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $imgLnkClickF = abcfl_input_txt('imgLnkClick_' . $F, '', $imgLnkClick, $imgLnkClickLbl, $imgLnkClickHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    return abcfsl_mbox_item_img_field_row_imghlnk_HTML( $imgLnkF, $captionTxtF, $imgAltF, $imgLnkArgsF, $imgLnkClickF );
}

function abcfsl_mbox_item_img_field_row_imghlnk_HTML( $imgLnkF, $captionTxtF, $imgAltF, $imgLnkArgsF, $imgLnkClickF ){ 

    $divE = abcfl_html_tag_end( 'div');
    $flexCntrS = abcfl_html_tag( 'div', '', 'abcflFGCntr' );
    $flex49S = abcfl_html_tag( 'div', '', 'abcflFG2Col13' );
    $flexFG33P = abcfl_html_tag( 'div', '', 'abcflFG33P' );
    $flex22S = abcfl_html_tag( 'div', '', 'abcflFG22P' );
    $flex16S = abcfl_html_tag( 'div', '', 'abcflFG16P' );

    return $flexCntrS . $flex22S . $imgLnkF . $divE . 
    $flex22S . $captionTxtF . $divE . 
    $flex22S . $imgAltF . $divE . 
    $flex16S . $imgLnkArgsF . $divE . 
    $flex16S . $imgLnkClickF .  
    abcfl_html_tag_ends( 'div,div');

}

function abcfsl_mbox_item_img_field_row_select(  $imgUrl, $imgUrlLbl, $imgUrlHlp, $F, $showField ){

    $divE = abcfl_html_tag_end( 'div');
    $flexCntrS = abcfl_html_tag( 'div', '', 'abcflFGCntr' );
    $flexFG10P = abcfl_html_tag( 'div', '', 'abcflFG8P' );
    $flexFG70P = abcfl_html_tag( 'div', '', 'abcflFG70P' );
    $flexFG20P = abcfl_html_tag( 'div', '', 'abcflFG20P' );

    $imgUrlLbl = abcfsl_mbox_item_text_line_number( $F , $imgUrlLbl );
    $imgTag = abcfl_html_img_tag_resp( '', $imgUrl, '', '', 'abcfFTypeImg' );

    if( $showField == 2 ) {
        $blank = '&nbsp;';
        $imgUrlF = abcfl_input_txt_readonly('ro_imgUrl_' . $F, '', $imgUrl, $imgUrlLbl, $imgUrlHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        return $flexCntrS . $flexFG10P . $imgTag . $divE . $flexFG70P . $imgUrlF . $divE . $flexFG20P . $blank .  abcfl_html_tag_ends( 'div,div');       
     }   

    $imgUrlF = abcfl_input_txt('imgUrl_' . $F, '', $imgUrl, $imgUrlLbl, $imgUrlHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $imgBtnF = abcfsl_mbox_item_img_select_btn( $F );

    return $flexCntrS . $flexFG10P . $imgTag . $divE . $flexFG70P . $imgUrlF . $divE . $flexFG20P . $imgBtnF . abcfl_html_tag_ends( 'div,div');
}

function abcfsl_mbox_item_img_field_row_caption( $captionTxt, $imgAlt, $captionLbl, $captionHlp, $imgAltLbl, $imgAltHlp, $F, $showField ){

    $divE = abcfl_html_tag_end( 'div');
    $flexCntrS = abcfl_html_tag( 'div', '', 'abcflFGCntr' );
    $flex49S = abcfl_html_tag( 'div', '', 'abcflFG2Col13' );
    $flexFG33P = abcfl_html_tag( 'div', '', 'abcflFG33P' );

    $captionLbl = abcfsl_mbox_item_text_line_number( $F, $captionLbl );    
    //$altLbl = abcfsl_mbox_item_text_line_number( $F , abcfsl_txta(186) );
    $altLbl = abcfsl_mbox_item_text_line_number( $F, $imgAltLbl );
    $blank = '&nbsp;';

    if( $showField == 2 ) {
        $captionTxtF = abcfl_input_txt_readonly('ro_txt_' . $F, '', $captionTxt, $captionLbl, $captionHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $imgAltF = abcfl_input_txt_readonly('ro_imgAlt_' . $F, '', $imgAlt, $altLbl, $imgAltHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        return $flexCntrS . $flexFG33P . $captionTxtF . $divE . $flexFG33P . $imgAltF . $divE . $flexFG33P . $blank . abcfl_html_tag_ends( 'div,div');     
     }  

    $captionTxtF = abcfl_input_txt('txt_' . $F, '', $captionTxt, $captionLbl, $captionHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $imgAltF = abcfl_input_txt('imgAlt_' . $F, '', $imgAlt, $altLbl, $imgAltHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    return $flexCntrS . $flexFG33P . $captionTxtF . $divE . $flexFG33P . $imgAltF . $divE . $flexFG33P . $blank . abcfl_html_tag_ends( 'div,div');
}

function abcfsl_mbox_item_img_select_btn( $F ){

    $divE = abcfl_html_tag_end( 'div');

    return abcfl_html_tag('div','','abcflFldCntr') . 
    abcfl_html_tag('div','','abcflFldLbl') . 
    abcfl_html_tag_with_content( '&nbsp;', 'div', '', 'abcflFontWPSB abcflFontS13' ) . 
    $divE . 
    abcfl_input_btn('abcfBtnImg' . $F, 'abcfBtnImg' . $F, 'button',  abcfsl_txta(263), 'button' ) .  
    $divE;

    //return $imgBtnF;
}
//=== IMAGE FIELD PARTS - END =======================================================

//===============================================================
function abcfsl_mbox_item_img( $itemOptns, $tplateOptns ){

    $imgIDL = isset( $itemOptns['_imgIDL'] ) ? esc_attr( $itemOptns['_imgIDL'][0] ) : 0;
    $imgUrlL = isset( $itemOptns['_imgUrlL'] ) ? esc_attr( $itemOptns['_imgUrlL'][0] ) : '';
    $imgLnkL = isset( $itemOptns['_imgLnkL'] ) ? esc_attr( $itemOptns['_imgLnkL'][0] ) : '';
    $imgAlt = isset( $itemOptns['_imgAlt'] ) ? esc_attr( $itemOptns['_imgAlt'][0] ) : '';
    $imgAttrL = isset( $itemOptns['_imgAttrL'] ) ? esc_attr( $itemOptns['_imgAttrL'][0] ) : '';


    $imgLnkArgs = isset( $itemOptns['_imgLnkArgs'] ) ? esc_attr( $itemOptns['_imgLnkArgs'][0] ) : '';
    $imgLnkClick = isset( $itemOptns['_imgLnkClick'] ) ? esc_attr( $itemOptns['_imgLnkClick'][0] ) : '';

    $overTxtI1 = isset( $itemOptns['_overTxtI1'] ) ? esc_attr( $itemOptns['_overTxtI1'][0] ) : '';
    $overTxtI2 = isset( $itemOptns['_overTxtI2'] ) ? esc_attr( $itemOptns['_overTxtI2'][0] ) : '';

    $sPgLnkTxt = isset( $tplateOptns['_sPgLnkTxt'] ) ? esc_attr( $tplateOptns['_sPgLnkTxt'][0] ) : '';
    $sPgLnkShow = isset( $tplateOptns['_sPgLnkShow'] ) ? $tplateOptns['_sPgLnkShow'][0] : 'N';
    $sPgLnkNT = isset( $tplateOptns['_sPgLnkNT'] ) ? $tplateOptns['_sPgLnkNT'][0] : '0';
    $imgLnkLDefault = isset( $tplateOptns['_imgLnkLDefault'] ) ? $tplateOptns['_imgLnkLDefault'][0] : '0';

    //=====================================================================
    echo  abcfl_html_tag('div','CN3','inside hidden abcflFadeIn');

    //-- IMG L START --------------------------------
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(310), abcfsl_aurl(50) );
    echo abcfl_html_img_tag('', $imgUrlL, '', '', 100, '', 'abcflMTop10');

    echo abcfl_html_tag('div','', 'abcflFlexCntr' );
        echo abcfl_input_txt('imgUrlL', '', $imgUrlL, abcfsl_txta(312), '', '100%', '', '', 'abcflFldCntr abcflWidth80Pc', 'abcflFldLbl');
        echo abcfl_input_txt_dr('readonly', true, 'imgIDL', '', $imgIDL, abcfsl_txta(35), '', '100%', '', '', 'abcflFldCntr abcflWidth20Pc', 'abcflFldLbl');
    echo abcfl_html_tag_end('div');

    echo  abcfl_html_tag('div','','abcflPTop10');
        echo abcfl_input_btn('btnImgL', 'btnImgL', 'button',  abcfsl_txta(263), 'button' );
    echo abcfl_html_tag_end('div');

    //----------------------------------------------------------

    $lblAlt = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(186), abcfsl_aurl(49), 'abcflFontWP abcflFontS13 abcflFontW400' );
    //echo abcfl_input_txt( 'imgAlt', '', $imgAlt, $lbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl' );

    $lblAttr = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(438), abcfsl_aurl(83), 'abcflFontWP abcflFontS13 abcflFontW400' );

    $dataL = abcfl_input_txt('imgAlt', '', $imgAlt, $lblAlt, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $dataR = abcfl_input_txt('imgAttrL', '', $imgAttrL, $lblAttr, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfsl_mbox_autil_input_two_fields( $dataL, $dataR, 100, 50 );

    //-- IMG L END -----------------------------------------------

    //-- IMG SPG ------------------------------
    abcfsl_mbox_item_img_spg_img_cntr ( $itemOptns, $tplateOptns );

    //-- IMG LINK -----------------------------------------------------------
    abcfsl_mbox_item_img_link_cntr( $imgLnkL, $sPgLnkNT, $imgLnkLDefault, $imgLnkArgs, $imgLnkClick, $sPgLnkShow, $sPgLnkTxt );

    //-- OVERLAY ----------------------------------
    echo abcfsl_mbox_item_img_overlay_txt( $overTxtI1, $overTxtI2 );

    echo abcfl_html_tag_end('div');
}

//== IMG ID ====================================================
function abcfsl_mbox_item_img_id( $imgUrl ){

    if( empty( $imgUrl ) ){ return 0; }

    $imageID = abcfsl_mbox_item_img_id_by_url( $imgUrl );
    return $imageID;
}

//Get image ID by different methods. If not found return 0.
function abcfsl_mbox_item_img_id_by_url( $imgUrl ){

    $imageID = abcfsl_mbox_item_img_id_by_guid( $imgUrl );
    if( $imageID > 0 ) { return $imageID; }

    $imageID = abcfsl_mbox_item_img_attachment_url_to_postid( $imgUrl );
    if( $imageID > 0 ) { return $imageID; }
    //return $imageID;

    $imageID = abcfsl_mbox_item_img_relative( $imgUrl );
    //if( $imageID > 0 ) { return $imageID; }
    return $imageID;

    //return $imgIDLS;

}

function abcfsl_mbox_item_img_id_by_guid( $imgUrl ){

    global $wpdb;

    //Full size image.
    $imageID = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $imgUrl ));
    if( $imageID > 0 ) { return $imageID; }

    // If the URL is auto-generated thumbnail, remove the sizes and get the URL of the original image
    $url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $imgUrl );
    $imageID = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $url ));

    return $imageID;
}

function abcfsl_mbox_item_img_attachment_url_to_postid( $imgUrl ) {

    //Return (int). The found post ID, or 0 on failure.
    $imageID = attachment_url_to_postid( $imgUrl );
    if( $imageID > 0 ) { return $imageID; }

    $url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $imgUrl );
    return attachment_url_to_postid( $url );
}

function abcfsl_mbox_item_img_relative( $imgUrl ) {

    //http://localhost:8080/blog
    $siteURL = get_site_url();

    $url = ltrim( $imgUrl, '/\\' );

    $fullURL = trailingslashit( $siteURL ) . $url;

    $imageID = abcfsl_mbox_item_img_attachment_url_to_postid( $fullURL );
    return $imageID;
}

//=========================================
function abcfsl_mbox_item_img_overlay_txt( $overTxtI1, $overTxtI2){

    echo abcfl_input_hline('2');
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(273) . ' ' . abcfsl_txta(9), abcfsl_aurl(42) );

    $dataL = abcfl_input_txt( 'overTxtI1', '', $overTxtI1, abcfsl_txta(43)  . ' 1', '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    $dataR = abcfl_input_txt( 'overTxtI2', '', $overTxtI2,  abcfsl_txta(43) . ' 2', '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    echo abcfsl_mbox_autil_input_two_fields( $dataL, $dataR, 100, 50 );
}

// NEW. Image link container
function abcfsl_mbox_item_img_link_cntr( $imgLnkL, $sPgLnkNT, $imgLnkLDefault, $imgLnkArgs, $imgLnkClick, $sPgLnkShow, $sPgLnkTxt ){

    $lnkTplateOptns = abcfsl_mbox_item_img_link_ro_values ( $imgLnkLDefault, $sPgLnkNT, $sPgLnkShow, $sPgLnkTxt );

    echo abcfl_input_hline('2');
    //echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(261), abcfsl_aurl(66) );
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(142), abcfsl_aurl(23) );
    //---------------------------------------------------------

    $roImgLnkTpltOptns = abcfl_input_txt_readonly('ro_imgLnkTpltOptns', '', $lnkTplateOptns['imgLnkOptns'], abcfsl_txta(22), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $roTxtLnkTpltOptns = abcfl_input_txt_readonly('ro_txtLnkTpltOptns', '', $lnkTplateOptns['txtLnkOptns'], abcfsl_txta(43), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $imgLnkL = abcfl_input_txt('imgLnkL', '', $imgLnkL, abcfsl_txta(20). ' URL', '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    
    $dataL = abcfl_input_txt('imgLnkArgs', '', $imgLnkArgs, abcfsl_txta(198), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $dataR = abcfl_input_txt('imgLnkClick', '', $imgLnkClick, abcfsl_txta(199), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfsl_mbox_autil_input_three_fields( $roImgLnkTpltOptns, $roTxtLnkTpltOptns, $imgLnkL, 16, 16, 65, 100 );
    echo abcfl_input_info_lbl( abcfsl_txta(262), 'abcflMTop5 abcflFldHlpUnder', 14 );
    echo abcfsl_mbox_autil_input_two_fields( $dataL, $dataR, 100, 50 );

}

// Populate ro_imgLnkL based on template options.
function abcfsl_mbox_item_img_link_ro_values ( $imgLnkLDefault, $sPgLnkNT, $sPgLnkShow, $sPgLnkTxt ){

    // sPgLnkShow: N, S, ST, SPHYB SPGCUST SPCUST.
    // imgLnkLDefault = Link staff image to Single Page (image hyperlink).  
    // sPgLnkNT = Open in a new tab or window.

    $out['imgLnkOptns'] = '';
    $out['txtLnkOptns'] = '';

    if( $sPgLnkShow == 'N' ) { return $out; }
    //-----------------------------------------------
    if( $sPgLnkShow == 'ST') { $sPgLnkShow = 'SPHYB'; }
    if( $sPgLnkShow == 'SPGCUST') { $sPgLnkShow = 'SPCUST'; }
    //-----------------------------------------------
    $pfix = '';
    if( $sPgLnkNT == 1 ) { $pfix = 'NT '; }

    if( $sPgLnkShow == 'Y' ) { 
        if( $imgLnkLDefault == 1 ) { 
            $out['imgLnkOptns'] = $pfix . 'SP';
        }
        if( !empty( $sPgLnkTxt ) ) { 
            $out['txtLnkOptns'] = $pfix . 'SP ' . $sPgLnkTxt;
        } 
        return $out;         
    }

    if( $sPgLnkShow == 'SPHYB' ) { 
        if( $imgLnkLDefault == 1 ) { 
            $out['imgLnkOptns'] = $pfix . 'HYBRID';
        }
        if( !empty( $sPgLnkTxt ) ) { 
            $out['txtLnkOptns'] = $pfix . 'HYBRID ' . $sPgLnkTxt;
        } 
        return $out;         
    }

    if( $sPgLnkShow == 'SPCUST' ) { 
        if( $imgLnkLDefault == 1 ) { 
            $out['imgLnkOptns'] = $pfix  . 'CUSTOM';
        }
        if( !empty( $sPgLnkTxt ) ) { 
            $out['txtLnkOptns'] = $pfix  . 'CUSTOM ' . $sPgLnkTxt;
        } 
        return $out;         
    }
    return $out; 
}

// SP image container.
function abcfsl_mbox_item_img_spg_img_cntr ( $itemOptns, $tplateOptns ){

    $imgS = abcfsl_mbox_item_img_spg_img_tag_url( $tplateOptns, $itemOptns );

    $imgTag = $imgS['imgTag'];
    $imgUrlS = $imgS['imgUrl'];

    $imgIDS = isset( $itemOptns['_imgIDS'] ) ? esc_attr( $itemOptns['_imgIDS'][0] ) : 0;

    //-- IMG START SP ------------------------------
    echo abcfl_input_hline('2');
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(311), abcfsl_aurl(67) );

    echo abcfl_html_img_tag('', $imgTag, '', '', 100, '', 'abcflMTop10');

    echo abcfl_html_tag('div','', 'abcflFlexCntr' );
        echo abcfl_input_txt('imgUrlS', '', $imgUrlS, abcfsl_txta(312), abcfsl_txta(284), '100%', '', '', 'abcflFldCntr abcflWidth80Pc', 'abcflFldLbl');
        echo abcfl_input_txt_dr('readonly', true, 'imgIDS', '', $imgIDS, abcfsl_txta(35), '', '100%', '', '', 'abcflFldCntr abcflWidth20Pc', 'abcflFldLbl');
    echo abcfl_html_tag_end('div');

    echo  abcfl_html_tag('div','','abcflPTop10');
        echo abcfl_input_btn('btnImgS', 'btnImgS', 'button',  abcfsl_txta(263), 'button' );
    echo abcfl_html_tag_end('div');
}

// SP image. Show thumb only when custom URL
function abcfsl_mbox_item_img_spg_img_tag_url( $tplateOptns, $itemOptns ){

    $imgUrlS = isset( $itemOptns['_imgUrlS'] ) ? esc_attr( $itemOptns['_imgUrlS'][0] ) : '';
    $sPgDefaultImgUrl = isset( $tplateOptns['_sPgDefaultImgUrl'] ) ? $tplateOptns['_sPgDefaultImgUrl'][0] : '0';

    // Display saved values. They may be owerwritten with global setting (sPgDefaultImgUrl) when page is rendered.
    // Thumbnail
    $out['imgTag'] = $imgUrlS;
    // URL field
    $out['imgUrl'] = $imgUrlS;

    if( $imgUrlS == 'SP' ) { $out['imgTag'] = ''; }

    return $out;    
}

// function abcfsl_mbox_item_text_IMGHLNK_OLD( $tplateOptns, $itemOptns, $F, $showField ){

//     if($showField == 0) { return ''; }

//     $imgUrlLbl = isset( $tplateOptns['_imgUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_imgUrlLbl_' . $F][0] ) : '';
//     $imgUrlHlp = isset( $tplateOptns['_imgUrlHlp_' . $F] ) ? esc_attr( $tplateOptns['_imgUrlHlp_' . $F][0] ) : '';
//     $captionLbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
//     $aptionHlp = isset( $tplateOptns['_inputHlp_' . $F] ) ? esc_attr( $tplateOptns['_inputHlp_' . $F][0] ) : '';
     
//     $captionTxt = isset( $itemOptns['_txt_' . $F] ) ? esc_attr( $itemOptns['_txt_' . $F][0] ) : '';
//     $imgUrl = isset( $itemOptns['_imgUrl_' . $F] ) ? esc_attr( $itemOptns['_imgUrl_' . $F][0] ) : '';
//     $imgAlt = isset( $itemOptns['_imgAlt_' . $F] ) ? esc_attr( $itemOptns['_imgAlt_' . $F][0] ) : '';

//     //$imgHLnk = isset( $itemOptns['_url_' . $F] ) ? esc_attr( $itemOptns['_url_' . $F][0] ) : '';
    
//     $imgUrlLbl = abcfsl_mbox_item_text_line_number( $F , $imgUrlLbl );
//     $captionLbl = abcfsl_mbox_item_text_line_number( $F , $captionLbl );    
//     $altLbl = abcfsl_mbox_item_text_line_number( $F , abcfsl_txta(186) );

//     //$imgHLnk = abcfsl_mbox_item_text_line_number( '' , 'ID' );
//     //$urlLbl = abcfsl_mbox_item_text_line_number( '' , '' );

//     //----------------------------------------------------
//     $flexCntrS = abcfl_html_tag( 'div', '', 'abcflFGCntr' );
//     $flex3ColS = abcfl_html_tag( 'div', '', 'abcflFG3Col' );
//     $flexImgUrlS = abcfl_html_tag( 'div', '', 'abcflFG70P' );
//     $flexImgIDS = abcfl_html_tag( 'div', '', 'abcflFG8P' );
//     $flexImgBtnS = abcfl_html_tag( 'div', '', 'abcflFG20P' );
//     $flex49S = abcfl_html_tag( 'div', '', 'abcflFG2Col13' );
//     $divE = abcfl_html_tag_end( 'div');     

//     //-- READ ONLY ---------
//     if( $showField == 2 ) {
//         $urlTxtRO = abcfl_input_txt_readonly('ro_urlTxt_' . $F, '', $captionTxt, $imgUrlLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
//         $urlRO = abcfl_input_txt_readonly('ro_url_' . $F, '', $url, $captionLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
//         echo $flexCntrS . $flexImgUrlS . $staticLblRO . $divE . $flexImgIDS . $urlRO . $divE . $flexImgBtnS . $urlTxtRO . abcfl_html_tag_ends( 'div,div');
//         return ;        
//      }


//      //$url = abcfl_input_txt('url_' . $F, '', $url, $captionLbl, $aptionHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
//      //$url = abcfl_input_txt('url_' . $F, '', '', $urlLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
//      $url = '&nbsp;';
//      $imgUrlF = abcfl_input_txt('imgUrl_' . $F, '', $imgUrl, $imgUrlLbl, $imgUrlHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
//      //$imgIDF = abcfl_input_txt_readonly('ro_imgID_' . $F, '', $imgID, $imgIDLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
//      $imgBtnF = abcfsl_mbox_item_img_select_btn( $F );

//      $captionTxtF = abcfl_input_txt('txt_' . $F, '', $captionTxt, $captionLbl, $aptionHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
//      $imgAltF = abcfl_input_txt('imgAlt_' . $F, '', $imgAlt, $altLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');

//      $imgTag = abcfl_html_img_tag_resp( '', $imgUrl, '', '', 'abcfFTypeImg' );

//      //---RENDER FIELD ---------------------------------------------------
//      echo abcfl_input_hline('2', '10');
//      echo $flexCntrS . $flexImgIDS . $imgTag . $divE . $flexImgUrlS . $imgUrlF . $divE . $flexImgBtnS . $imgBtnF . abcfl_html_tag_ends( 'div,div');
//      echo $flexCntrS . $flex49S . $captionTxtF . $divE . $flex49S . $imgAltF . $divE . $flex49S . $url . abcfl_html_tag_ends( 'div,div');
//      echo abcfl_input_hline('2', '10');
// }