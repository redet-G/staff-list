<?php
// vCard read only.
function abcfsl_mbox_item_VCARDHL( $tplateOptns, $itemOptns, $F, $showField ){

    if($showField == 0) { return ''; }

    if( !abcfsl_util_vcard_plugin_installed() ) {         
        //vCard plugin not installed
        $cls = 'abcflFontWP abcflFontS18 abcflFontW600 abcflMTop10 abcflRed';
        echo abcfl_input_sec_title( abcfsl_txta(416), $cls );
        return '';         
    }

    $vcTplateID = isset( $tplateOptns['_vcTplateID_' . $F] ) ? $tplateOptns['_vcTplateID_' . $F][0] : '';
    $inputLbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
    $staticLbl = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '';
    $slTplateID = isset( $tplateOptns['slTplateID'] ) ? $tplateOptns['slTplateID'] : 0;
    //-----------------------------------------------------------------
    $lbl = abcfsl_mbox_item_vcard_lbl( $vcTplateID, $F, $inputLbl, $slTplateID );
    $hlpTxt = abcfsl_util_vcard_no_tplate( $vcTplateID, 'VC', $slTplateID );
    echo abcfl_input_txt_readonly('ro_vcTplateName_' . $F, '', $staticLbl, $lbl, $hlpTxt, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl', 'abcflRed');
    
}

//F label
function abcfsl_mbox_item_vcard_lbl( $vcTplateID, $F, $inputLbl, $slTplateID ){

    $cbo = abcfsl_db_cbo_vcard_tplates( $slTplateID, 'VC' );
    if ( array_key_exists( $vcTplateID, $cbo ) ) {
        $inputLbl = $inputLbl . ' - ' . $cbo[$vcTplateID];
    }

    return abcfsl_mbox_item_text_line_number( $F , $inputLbl );
}

//== QR CODE =======================================================================
function abcfsl_mbox_item_QRIMGCAP64STA( $tplateOptns, $itemOptns, $F, $showField ){

    if( $showField == 0 )  { return ''; }

    //-- Displays error message instead of field input.
    if( !abcfsl_util_vcard_plugin_installed() ) {         
        //vCard plugin not installed
        $cls = 'abcflFontWP abcflFontS18 abcflFontW600 abcflMTop10 abcflRed';
        echo abcfl_input_sec_title( abcfsl_txta(416), $cls );
        return '';         
    }

    // Static caption: lblTxt_  _lblTxt_
    // Static ALT: statAlt_  _statAlt_
    // Base64: _qrImgUri_
    // Dynamic caption: txt_  _txt_
    // Dynamic ALT: imgAlt_  _imgAlt_

    //== Template Optns ====================================================================
    //$vcTplateID = isset( $tplateOptns['_vcTplateID_' . $F] ) ? $tplateOptns['_vcTplateID_' . $F][0] : '';
    //$slTplateID = isset( $tplateOptns['slTplateID'] ) ? $tplateOptns['slTplateID'] : 0;
    $statCaption = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '';
    $statAlt = isset( $tplateOptns['_statAlt_' . $F] ) ? esc_attr( $tplateOptns['_statAlt_' . $F][0] ) : '';
    $inputHlp = isset( $tplateOptns['_inputHlp_' . $F] ) ? esc_attr( $tplateOptns['_inputHlp_' . $F][0] ) : '';
    
    //== Item Optns ==============================================================================
    $staffID = isset( $itemOptns['staffID'] ) ? $itemOptns['staffID'] : 0;
    //QRCode img URI.
    $qrImgUri = isset( $itemOptns['_qrImgUri_' . $F] ) ? esc_attr( $itemOptns['_qrImgUri_' . $F][0] ) : '';
    $saveQrErrorTxt = isset( $itemOptns['_qrErrorTxt_' . $F] ) ? esc_attr( $itemOptns['_qrErrorTxt_' . $F][0] ) : '';
    
    // Dynamic Caption and ALT
    $dynCaption = isset( $itemOptns['_txt_' . $F] ) ? esc_attr( $itemOptns['_txt_' . $F][0] ) : '';
    $dynAlt = isset( $itemOptns['_imgAlt_' . $F] ) ? esc_attr( $itemOptns['_imgAlt_' . $F][0] ) : '';

    //== Field lbl + Help under =====================================
    $inputLblStatCap = abcfsl_mbox_item_text_line_number( $F, isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '' );
    $inputLblDynCap = abcfsl_mbox_item_text_line_number( $F, isset( $tplateOptns['_inputLblDynCap_' . $F] ) ? esc_attr( $tplateOptns['_inputLblDynCap_' . $F][0] ) : '' );
    $inputLblStatAlt = abcfsl_mbox_item_text_line_number( $F, isset( $tplateOptns['_inputLblStatAlt_' . $F] ) ? esc_attr( $tplateOptns['_inputLblStatAlt_' . $F][0] ) : '' );
    $inputLblDynAlt = abcfsl_mbox_item_text_line_number( $F, isset( $tplateOptns['_inputLblDynAlt_' . $F] ) ? esc_attr( $tplateOptns['_inputLblDynAlt_' . $F][0] ) : '' );

    $inputLblBase64 = abcfsl_mbox_item_text_line_number( $F, abcfsl_txta(441) );

    //$hlpOptional = abcfsl_txta(270);
    $hlpOptional = '';
    
    //$hlpUnderCls = '';
    $errMsg = '';
    if( !empty( $saveQrErrorTxt ) ) { $errMsg = $saveQrErrorTxt . ' '; }

    if( !empty( $errMsg ) ) {
        $hlpUnder = $errMsg;
        $hlpUnderCls = 'abcflRed';
    }

    //---Field container (image + read only hyperlink static text -------------------
    //QR Code image preview.
    $aTag = '';
    if( !empty( $qrImgUri ) ) {
        $imgTag64 = abcfl_html_img_tag_resp( '', $qrImgUri, '', '', 'abcfFTypeImg' );
        
        // href = data 64. $href, $lnkTxt, $target
        $aTag = abcfl_html_a_tag_data( $qrImgUri, $imgTag64, '_blank' );

    //<a href="http://localhost:8080/blog/wp-content/uploads/qrcode_6854_23.png">
    //<img src="http://localhost:8080/blog/wp-content/uploads/qrcode_6854_23.png" class="abcfFTypeImg" alt="" itemprop="image">
    //</a>     
    }

    $captionStatTxt = abcfl_input_txt_readonly('ro_captionStat_' . $F, '', $statCaption, $inputLblStatCap, '', '100%', '', '', 'abcflFldCntrZ', 'abcflFldLbl', '');
    $altStatTxt = abcfl_input_txt_readonly('ro_altStat_' . $F, '', $statAlt, $inputLblStatAlt, '', '100%', '', '', 'abcflFldCntrZ', 'abcflFldLbl', '');
    $img64 = abcfl_input_txt_readonly('qrImgUri_' . $F, '', $qrImgUri, $inputLblBase64, '', '100%', '', '', 'abcflFldCntrZ', 'abcflFldLbl', '');
    $captionDynTxt =  abcfl_input_txt('txt_' . $F, '', $dynCaption, $inputLblDynCap, $hlpOptional, '100%', '', '', 'abcflFldCntrZ', 'abcflFldLbl');
    $altDynTxt =  abcfl_input_txt('imgAlt_' . $F, '', $dynAlt, $inputLblDynAlt, $hlpOptional, '100%', '', '', 'abcflFldCntrZ', 'abcflFldLbl');

    //--------------------------------------------------
    $flexCntrS = abcfl_html_tag( 'div', '', 'abcflFGCntrStart abcflFldCntr' );   
    $flex10 = abcfl_html_tag( 'div', '', 'abcflFG10P abcflPRight10' );
    $flex25 = abcfl_html_tag( 'div', '', 'abcflFG25P' );
    $flex252 = abcfl_html_tag( 'div', '', 'abcflFG25P abcflPLeft5' );
    $flex90 = abcfl_html_tag( 'div', '', 'abcflFG90P' );
    $divE = abcfl_html_tag_end( 'div');

    echo abcfl_input_hline('1', '10');
    echo $flexCntrS . $flex10 . $aTag . $divE . $flex90 . $img64 . $divE . abcfl_html_tag_end( 'div');
    echo $flexCntrS . $flex25 . $captionStatTxt . $divE . $flex252 . $captionDynTxt . $divE . $flex252 . $altStatTxt . $divE . $flex252 . $altDynTxt . $divE . abcfl_html_tag_end( 'div');
    echo abcfl_input_hlp_lbl( $inputHlp, 'abcflMTop10 abcflFldHlpUnder abcflFontS14' ); 
    echo abcfl_input_hline('1', '10');
}

function abcfsl_mbox_item_QRIMGCAP64DYN( $tplateOptns, $itemOptns, $F, $showField ){

    if( $showField == 0 )  { return ''; }

    //-- Displays error message instead of field input.
    if( !abcfsl_util_vcard_plugin_installed() ) {         
        //vCard plugin not installed
        $cls = 'abcflFontWP abcflFontS18 abcflFontW600 abcflMTop10 abcflRed';
        echo abcfl_input_sec_title( abcfsl_txta(416), $cls );
        return '';         
    }

    // Static caption: lblTxt_  _lblTxt_
    // Static ALT: statAlt_  _statAlt_
    // Base64: _qrImgUri_
    // Dynamic caption: txt_  _txt_
    // Dynamic ALT: imgAlt_  _imgAlt_

    //== Template Optns ====================================================================
    //$vcTplateID = isset( $tplateOptns['_vcTplateID_' . $F] ) ? $tplateOptns['_vcTplateID_' . $F][0] : '';
    //$slTplateID = isset( $tplateOptns['slTplateID'] ) ? $tplateOptns['slTplateID'] : 0;
    $statCaption = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '';
    $statAlt = isset( $tplateOptns['_statAlt_' . $F] ) ? esc_attr( $tplateOptns['_statAlt_' . $F][0] ) : '';
    $inputHlp = isset( $tplateOptns['_inputHlp_' . $F] ) ? esc_attr( $tplateOptns['_inputHlp_' . $F][0] ) : '';
    
    //== Item Optns ==============================================================================
    $staffID = isset( $itemOptns['staffID'] ) ? $itemOptns['staffID'] : 0;
    //QRCode img URI.
    $qrImgUri = isset( $itemOptns['_qrImgUri_' . $F] ) ? esc_attr( $itemOptns['_qrImgUri_' . $F][0] ) : '';
    $saveQrErrorTxt = isset( $itemOptns['_qrErrorTxt_' . $F] ) ? esc_attr( $itemOptns['_qrErrorTxt_' . $F][0] ) : '';
    
    // Dynamic Caption and ALT
    $dynCaption = isset( $itemOptns['_txt_' . $F] ) ? esc_attr( $itemOptns['_txt_' . $F][0] ) : '';
    $dynAlt = isset( $itemOptns['_imgAlt_' . $F] ) ? esc_attr( $itemOptns['_imgAlt_' . $F][0] ) : '';

    //== Field lbl + Help under =====================================
    $inputLblStatCap = abcfsl_mbox_item_text_line_number( $F, isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '' );
    $inputLblDynCap = abcfsl_mbox_item_text_line_number( $F, isset( $tplateOptns['_inputLblDynCap_' . $F] ) ? esc_attr( $tplateOptns['_inputLblDynCap_' . $F][0] ) : '' );
    $inputLblStatAlt = abcfsl_mbox_item_text_line_number( $F, isset( $tplateOptns['_inputLblStatAlt_' . $F] ) ? esc_attr( $tplateOptns['_inputLblStatAlt_' . $F][0] ) : '' );
    $inputLblDynAlt = abcfsl_mbox_item_text_line_number( $F, isset( $tplateOptns['_inputLblDynAlt_' . $F] ) ? esc_attr( $tplateOptns['_inputLblDynAlt_' . $F][0] ) : '' );

    $inputLblBase64 = abcfsl_mbox_item_text_line_number( $F, abcfsl_txta(447) );
    $hlpOptional = '';
    
    //$hlpUnderCls = '';
    $errMsg = '';
    if( !empty( $saveQrErrorTxt ) ) { $errMsg = $saveQrErrorTxt . ' '; }

    if( !empty( $errMsg ) ) {
        $hlpUnder = $errMsg;
        $hlpUnderCls = 'abcflRed';
    }

    //--- Field container (image + read only hyperlink static text -------------------
    //QR Code image preview.
    $aTag = '';
    if( !empty( $qrImgUri ) ) {
        $imgTag64 = abcfl_html_img_tag_resp( '', $qrImgUri, '', '', 'abcfFTypeImg' );
        $aTag = abcfl_html_a_tag_data( $qrImgUri, $imgTag64, '_blank' );

    //<a href="http://localhost:8080/blog/wp-content/uploads/qrcode_6854_23.png">
    //<img src="http://localhost:8080/blog/wp-content/uploads/qrcode_6854_23.png" class="abcfFTypeImg" alt="" itemprop="image">
    //</a>     
    }

    $captionStatTxt = abcfl_input_txt_readonly('ro_captionStat_' . $F, '', $statCaption, $inputLblStatCap, '', '100%', '', '', 'abcflFldCntrZ', 'abcflFldLbl', '');
    $altStatTxt = abcfl_input_txt_readonly('ro_altStat_' . $F, '', $statAlt, $inputLblStatAlt, '', '100%', '', '', 'abcflFldCntrZ', 'abcflFldLbl', '');
    $img64 = abcfl_input_txt_readonly('qrImgUri_' . $F, '', $qrImgUri, $inputLblBase64, '', '100%', '', '', 'abcflFldCntrZ', 'abcflFldLbl', '');
    $captionDynTxt =  abcfl_input_txt('txt_' . $F, '', $dynCaption, $inputLblDynCap, $hlpOptional, '100%', '', '', 'abcflFldCntrZ', 'abcflFldLbl');
    $altDynTxt =  abcfl_input_txt('imgAlt_' . $F, '', $dynAlt, $inputLblDynAlt, $hlpOptional, '100%', '', '', 'abcflFldCntrZ', 'abcflFldLbl');

    //--------------------------------------------------
    $flexCntrS = abcfl_html_tag( 'div', '', 'abcflFGCntrStart abcflFldCntr' );   
    $flex10 = abcfl_html_tag( 'div', '', 'abcflFG10P abcflPRight10' );
    $flex25 = abcfl_html_tag( 'div', '', 'abcflFG25P' );
    $flex252 = abcfl_html_tag( 'div', '', 'abcflFG25P abcflPLeft5' );
    $flex90 = abcfl_html_tag( 'div', '', 'abcflFG90P' );
    $divE = abcfl_html_tag_end( 'div');

    echo abcfl_input_hline('1', '10');
    echo $flexCntrS . $flex10 . $aTag . $divE . $flex90 . $img64 . $divE . abcfl_html_tag_end( 'div');
    echo $flexCntrS . $flex25 . $captionStatTxt . $divE . $flex252 . $captionDynTxt . $divE . $flex252 . $altStatTxt . $divE . $flex252 . $altDynTxt . $divE . abcfl_html_tag_end( 'div');
    echo abcfl_input_hlp_lbl( $inputHlp, 'abcflMTop10 abcflFldHlpUnder abcflFontS14' ); 
    echo abcfl_input_hline('1', '10');
}

//#############################################################################################################
function abcfsl_mbox_item_QRHL64STA( $tplateOptns, $itemOptns, $F, $showField ){

    if( $showField == 0 )  { return ''; }

    //-- Displays error message instead of field input.
    if( !abcfsl_util_vcard_plugin_installed() ) {         
        //vCard plugin not installed
        $cls = 'abcflFontWP abcflFontS18 abcflFontW600 abcflMTop10 abcflRed';
        echo abcfl_input_sec_title( abcfsl_txta(416), $cls );
        return '';         
    }
    //======================================================================
    //$vcTplateID = isset( $tplateOptns['_vcTplateID_' . $F] ) ? $tplateOptns['_vcTplateID_' . $F][0] : '';
    $inputLbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
    $staticLbl = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '';
    //$slTplateID = isset( $tplateOptns['slTplateID'] ) ? $tplateOptns['slTplateID'] : 0;
    //================================================================================
    $qrImgUri = isset( $itemOptns['_qrImgUri_' . $F] ) ? esc_attr( $itemOptns['_qrImgUri_' . $F][0] ) : '';
    $saveQrErrorTxt = isset( $itemOptns['_qrErrorTxt_' . $F] ) ? esc_attr( $itemOptns['_qrErrorTxt_' . $F][0] ) : '';
    $staffID = isset( $itemOptns['staffID'] ) ? $itemOptns['staffID'] : 0;

    //== Field lbl + Help under =====================================
    $lbl = abcfsl_mbox_item_text_line_number( $F, $inputLbl );
    $lblBase64 = abcfsl_mbox_item_text_line_number( $F, 'Image Base64' );

    //$hlpUnder = '';
    //$hlpUnderCls = '';
    $errMsg = '';

    if( !empty( $saveQrErrorTxt ) ) {
        $errMsg = $saveQrErrorTxt . ' ';
    }

    if( !empty( $errMsg ) ) {
        $hlpUnder = $errMsg;
        $hlpUnderCls = 'abcflRed';
    }

    //---Field container (image + read only hyperlink static text -------------------
    $aTag = '';
    if( !empty( $qrImgUri ) ) {
        $imgTag64 = abcfl_html_img_tag_resp( '', $qrImgUri, '', '', 'abcfFTypeImg' );
        $aTag = abcfl_html_a_tag_data( $qrImgUri, $imgTag64, '_blank' );

    //<a href="http://localhost:8080/blog/wp-content/uploads/qrcode_6854_23.png">
    //<img src="http://localhost:8080/blog/wp-content/uploads/qrcode_6854_23.png" class="abcfFTypeImg" alt="" itemprop="image">
    //</a>     
    }

    $hLinkTxt = abcfl_input_txt_readonly('ro_qrHlTxt64Sta_' . $F, '', $staticLbl, $lbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl', '');
    $img64 = abcfl_input_txt_readonly('qrImg64_' . $F, '', $qrImgUri, $lblBase64, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl', '');

    //--------------------------------------------------
    $flexCntrS = abcfl_html_tag( 'div', '', 'abcflFGCntrStart' );   
    $flexImg = abcfl_html_tag( 'div', '', 'abcflFG10P' );
    $flexHLinkTxt = abcfl_html_tag( 'div', '', 'abcflFG30P' );
    $flexImg64 = abcfl_html_tag( 'div', '', 'abcflFG60P abcflPLeft5' );
    $divE = abcfl_html_tag_end( 'div');

    echo $flexCntrS . $flexImg . $aTag . $divE . $flexHLinkTxt . $hLinkTxt . $divE . $flexImg64 . $img64 . abcfl_html_tag_ends( 'div,div');
}

function abcfsl_mbox_item_QRHL64DYN( $tplateOptns, $itemOptns, $F, $showField ){

    if( $showField == 0 )  { return ''; }

    //-- Displays error message instead of field input.
    if( !abcfsl_util_vcard_plugin_installed() ) {         
        //vCard plugin not installed
        $cls = 'abcflFontWP abcflFontS18 abcflFontW600 abcflMTop10 abcflRed';
        echo abcfl_input_sec_title( abcfsl_txta(416), $cls );
        return '';         
    }
    //======================================================================
    //$vcTplateID = isset( $tplateOptns['_vcTplateID_' . $F] ) ? $tplateOptns['_vcTplateID_' . $F][0] : '';
    $inputLbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
    $staticLbl = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '';
    $slTplateID = isset( $tplateOptns['slTplateID'] ) ? $tplateOptns['slTplateID'] : 0;
    //================================================================================
    $saveQrErrorTxt = isset( $itemOptns['_qrErrorTxt_' . $F] ) ? esc_attr( $itemOptns['_qrErrorTxt_' . $F][0] ) : '';
    $staffID = isset( $itemOptns['staffID'] ) ? $itemOptns['staffID'] : 0;

    $params['staffID'] = $staffID;
    $params['F'] = $F;
    $params['slTplateID'] = $slTplateID;
    //$params['saveImg'] = false;  
    
    $qrImgBuilder = new ABCFSL_QR_Img_Builder( $params );
    $qrImgBuilder->maybeCreateQRImgUri(); 

    $errTxt = $qrImgBuilder->getErrTxt();
    $qrImgUri = $qrImgBuilder->getImgUri(); 

    //== Field lbl + Help under =====================================
    $lbl = abcfsl_mbox_item_text_line_number( $F , $inputLbl );

    $hlpUnder = '';
    $hlpUnderCls = '';
    $errMsg = '';

    if( !empty( $saveQrErrorTxt ) ) {
        $errMsg = $saveQrErrorTxt . ' ';
    }

    if( !empty( $errTxt ) ) {
        if( $saveQrErrorTxt != $errTxt ) {
            $errMsg = $errMsg . $errTxt . ' ';
        }        
    }

    if( !empty( $errMsg ) ) {
        $hlpUnder = $errMsg;
        $hlpUnderCls = 'abcflRed';
    }

    //---Field container (image + read only hyperlink static text -------------------
    $aTag = '';
    if( !empty( $qrImgUri ) ) {
        $imgTag64 = abcfl_html_img_tag_resp( '', $qrImgUri, '', '', 'abcfFTypeImg' );
        $aTag = abcfl_html_a_tag_data( $qrImgUri, $imgTag64, '_blank' );
    }

    $hLinkTxt = abcfl_input_txt_readonly('ro_qrHlTxt64Dyn_' . $F, '', $staticLbl, $lbl, $hlpUnder, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl', $hlpUnderCls);

    //--------------------------------------------------
    $flexCntrS = abcfl_html_tag( 'div', '', 'abcflFGCntrStart' );   
    $flexImg = abcfl_html_tag( 'div', '', 'abcflFG10P' );
    $flexHLinkTxt = abcfl_html_tag( 'div', '', 'abcflFG90P' );
    $divE = abcfl_html_tag_end( 'div');

    echo $flexCntrS . $flexImg . $aTag . $divE . $flexHLinkTxt . $hLinkTxt . abcfl_html_tag_ends( 'div,div');

}