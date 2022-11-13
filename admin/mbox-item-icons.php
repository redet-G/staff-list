<?php
function abcfsl_mbox_item_icons_tab( $itemOptns, $tplateOptns ){

    $showSocial = isset( $tplateOptns['_showSocial'] ) ? $tplateOptns['_showSocial'][0] : 'N';

    echo  abcfl_html_tag('div','CN4','inside hidden abcflFadeIn');
    //-- FONT ICONS -------------------------
    abcfsl_mbox_item_icons_font_fields( $tplateOptns, $itemOptns );
    //----------------------------------------
    if ( $showSocial == 'N' ){
        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(207), abcfsl_aurl(7) );
        echo abcfl_html_tag_end('div');
        return;
    }
    //-- SOCIAL ICONS ------------------------
    abcfsl_mbox_item_icons_social( $itemOptns, $tplateOptns );
    //----------------------------------------
    echo abcfl_html_tag_end('div');
}

//==== SOCIAL ICONS START ============================================
function abcfsl_mbox_item_icons_social( $itemOptns, $tplateOptns ){

    $social1 = isset( $tplateOptns['_social1'] ) ? esc_attr( $tplateOptns['_social1'][0] ) : abcfsl_txta(79,' 1 ');
    $social2 = isset( $tplateOptns['_social2'] ) ? esc_attr( $tplateOptns['_social2'][0] ) : abcfsl_txta(79,' 2 ');
    $social3 = isset( $tplateOptns['_social3'] ) ? esc_attr( $tplateOptns['_social3'][0] ) : abcfsl_txta(79,' 3 ');
    $social4 = isset( $tplateOptns['_social4'] ) ? esc_attr( $tplateOptns['_social4'][0] ) : abcfsl_txta(79,' 4 ');
    $social5 = isset( $tplateOptns['_social5'] ) ? esc_attr( $tplateOptns['_social5'][0] ) : abcfsl_txta(79,' 5 ');
    $social6 = isset( $tplateOptns['_social6'] ) ? esc_attr( $tplateOptns['_social6'][0] ) : abcfsl_txta(79,' 6 ');

    $socialCntrLbl = isset( $tplateOptns['_socialCntrLbl'] ) ? esc_attr( $tplateOptns['_socialCntrLbl'][0] ) : abcfsl_txta(54);
    $socialCntrHlp= isset( $tplateOptns['_socialCntrHlp'] ) ? esc_attr( $tplateOptns['_socialCntrHlp'][0] ) : abcfsl_txta(219);

    $fbookUrl = isset( $itemOptns['_fbookUrl'] ) ? esc_attr( $itemOptns['_fbookUrl'][0] ) : '';
    //$googlePlusUrl = isset( $itemOptns['_googlePlusUrl'] ) ? esc_attr( $itemOptns['_googlePlusUrl'][0] ) : '';
    $twitUrl = isset( $itemOptns['_twitUrl'] ) ? esc_attr( $itemOptns['_twitUrl'][0] ) : '';
    $likedUrl = isset( $itemOptns['_likedUrl'] ) ? esc_attr( $itemOptns['_likedUrl'][0] ) : '';
    $emailUrl = isset( $itemOptns['_emailUrl'] ) ? esc_attr( $itemOptns['_emailUrl'][0] ) : '';

    $socialC1Url = isset( $itemOptns['_socialC1Url'] ) ? esc_attr( $itemOptns['_socialC1Url'][0] ) : '';
    $socialC2Url = isset( $itemOptns['_socialC2Url'] ) ? esc_attr( $itemOptns['_socialC2Url'][0] ) : '';
    $socialC3Url = isset( $itemOptns['_socialC3Url'] ) ? esc_attr( $itemOptns['_socialC3Url'][0] ) : '';
    $socialC4Url = isset( $itemOptns['_socialC4Url'] ) ? esc_attr( $itemOptns['_socialC4Url'][0] ) : '';
    $socialC5Url = isset( $itemOptns['_socialC5Url'] ) ? esc_attr( $itemOptns['_socialC5Url'][0] ) : '';
    $socialC6Url = isset( $itemOptns['_socialC6Url'] ) ? esc_attr( $itemOptns['_socialC6Url'][0] ) : '';
    //----------------------------------------------------
    $flexCntr = abcfl_html_tag( 'div', '', 'abcflFGCntr' );
    $flex3ColS = abcfl_html_tag( 'div', '', 'abcflFG3Col' );
    $flex4ColS = abcfl_html_tag( 'div', '', 'abcflFG4Col' );      
    $divE = abcfl_html_tag_end( 'div');
    $divEs = abcfl_html_tag_ends( 'div,div' ); 

    //-------------------------------------------------------- 
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, $socialCntrLbl, abcfsl_aurl(7) );
    echo abcfl_input_info_lbl($socialCntrHlp, 'abcflMTop5', '12');

    $iF = abcfl_input_txt('fbookUrl', '', $fbookUrl, 'Facebook', '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $iT = abcfl_input_txt('twitUrl', '', $twitUrl, 'Twitter', '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $iL = abcfl_input_txt('likedUrl', '', $likedUrl, 'LinkedIn', '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $iE = abcfl_input_txt('emailUrl', '', $emailUrl, 'Email', '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    $i1 = abcfl_input_txt('socialC1Url', '', $socialC1Url, $social1, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $i2 = abcfl_input_txt('socialC2Url', '', $socialC2Url, $social2, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $i3 = abcfl_input_txt('socialC3Url', '', $socialC3Url, $social3, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $i4 = abcfl_input_txt('socialC4Url', '', $socialC4Url, $social4, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $i5 = abcfl_input_txt('socialC5Url', '', $socialC5Url, $social5, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $i6 = abcfl_input_txt('socialC6Url', '', $socialC6Url, $social6, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo $flexCntr . $flex4ColS . $iF . $divE . $flex4ColS . $iT . $divE . $flex4ColS . $iL . $divE . $flex4ColS . $iE . $divEs;
    echo $flexCntr . $flex3ColS . $i1 . $divE . $flex3ColS . $i2 . $divE . $flex3ColS . $i3 . $divEs;
    echo $flexCntr . $flex3ColS . $i4 . $divE . $flex3ColS . $i5 . $divE . $flex3ColS . $i6 . $divEs;
}
//==== SOCIAL ICONS END ============================================

//==== ICONLNK START ============================================
function abcfsl_mbox_item_icons_font_fields( $tplateOptns, $itemOptns ){
    //$F = $x;
    $F = '';
    $fieldType = '';
    //FIELDS_50
    //for ($x = 1; $x <= 50; $x++) {
    for ($x = 1; $x <= 40; $x++) {
        $F = 'F' . $x;
        $fieldType = isset( $tplateOptns['_fieldType_' . $F] ) ? esc_attr( $tplateOptns['_fieldType_' . $F][0] ) :'';
        abcfsl_mbox_item_icons_font_field( $fieldType, $tplateOptns, $itemOptns, $F );
    } 
}

function abcfsl_mbox_item_icons_font_field( $fieldType, $tplateOptns, $itemOptns, $F ){

    switch ( $fieldType ) {
        case 'ICONLNK': 
            abcfsl_mbox_item_icons_field_ICONLNK( $tplateOptns, $itemOptns, $F );
            break; 
        case 'STARR':
            abcfsl_mbox_item_icons_field_STARR( $tplateOptns, $itemOptns, $F );
            break;            
        default:
            break;
    }
}

function abcfsl_mbox_item_icons_field_ICONLNK( $tplateOptns, $itemOptns, $F ){ 

    $inputLbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
    $inputHlp = isset( $tplateOptns['_inputHlp_' . $F] ) ? esc_attr( $tplateOptns['_inputHlp_' . $F][0] ) : '';

    $icon1Name = isset( $tplateOptns['_icon1Name_' . $F] ) ? $tplateOptns['_icon1Name_' . $F][0] : '';
    $icon2Name = isset( $tplateOptns['_icon2Name_' . $F] ) ? $tplateOptns['_icon2Name_' . $F][0] : '';
    $icon3Name = isset( $tplateOptns['_icon3Name_' . $F] ) ? $tplateOptns['_icon3Name_' . $F][0] : '';
    $icon4Name = isset( $tplateOptns['_icon4Name_' . $F] ) ? $tplateOptns['_icon4Name_' . $F][0] : '';
    $icon5Name = isset( $tplateOptns['_icon5Name_' . $F] ) ? $tplateOptns['_icon5Name_' . $F][0] : '';
    $icon6Name = isset( $tplateOptns['_icon6Name_' . $F] ) ? $tplateOptns['_icon6Name_' . $F][0] : '';

    $icon1Url = isset( $itemOptns['_icon1Url_' . $F] ) ? $itemOptns['_icon1Url_' . $F][0] : '';    
    $icon2Url = isset( $itemOptns['_icon2Url_' . $F] ) ? $itemOptns['_icon2Url_' . $F][0] : '';     
    $icon3Url = isset( $itemOptns['_icon3Url_' . $F] ) ? $itemOptns['_icon3Url_' . $F][0] : '';  
    $icon4Url = isset( $itemOptns['_icon4Url_' . $F] ) ? $itemOptns['_icon4Url_' . $F][0] : '';
    $icon5Url = isset( $itemOptns['_icon5Url_' . $F] ) ? $itemOptns['_icon5Url_' . $F][0] : '';  
    $icon6Url = isset( $itemOptns['_icon6Url_' . $F] ) ? $itemOptns['_icon6Url_' . $F][0] : ''; 

    //=========================================================
    echo abcfl_input_hlp_lbl(  $F . '. ' . $inputLbl, 'abcflMTop10', 14, 'SB' );
    echo abcfl_input_hlp_lbl( $inputHlp, '', 13 );

    echo abcfsl_mbox_item_icons_iconlnk_input( $icon1Name, $icon1Url, $F, '1' );
    echo abcfsl_mbox_item_icons_iconlnk_input( $icon2Name, $icon2Url, $F, '2' );
    echo abcfsl_mbox_item_icons_iconlnk_input( $icon3Name, $icon3Url, $F, '3' );
    echo abcfsl_mbox_item_icons_iconlnk_input( $icon4Name, $icon4Url, $F, '4' );
    echo abcfsl_mbox_item_icons_iconlnk_input( $icon5Name, $icon5Url, $F, '5' );
    echo abcfsl_mbox_item_icons_iconlnk_input( $icon6Name, $icon6Url, $F, '6' );

    echo abcfl_input_hline('3', 20);
}

function abcfsl_mbox_item_icons_iconlnk_input( $nameData, $urlData, $F, $ID ){

    if( empty( $nameData ) && empty( $urlData ) ) { return ''; }

    $inputName = 'ro_icon' . $ID . 'Name_' . $F;
    $inputUrl = 'icon' . $ID . 'Url_' . $F;
    $iName =  abcfl_input_txt_readonly( $inputName, '', $nameData, '', '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $iUrl =  abcfl_input_txt( $inputUrl, '', $urlData, '', '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    //----------------------------------------------------
    $flexCntr = abcfl_html_tag( 'div', '', 'abcflFGCntr' );
    $flexG2Col13 = abcfl_html_tag( 'div', '', 'abcflFG2Col13' );
    $flexG2Col23 = abcfl_html_tag( 'div', '', 'abcflFG2Col23' ); 
    $divE = abcfl_html_tag_end( 'div'); 
    //--------------------------------------------------------     

    return $flexCntr . $flexG2Col13 . $iName . $divE . $flexG2Col23 . $iUrl . abcfl_html_tag_ends( 'div,div' );
}
//==== ICONLNK END ===========================================================

//==== STAR RATING START =================================================
function abcfsl_mbox_item_icons_field_STARR( $tplateOptns, $itemOptns, $F ){

    //if($showField == 0) { return ''; }

    $iconMaxQty = isset( $tplateOptns['_iconMaxQty_' . $F] ) ? $tplateOptns['_iconMaxQty_' . $F][0] : '';
    $inputLbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
    $inputHlp = isset( $tplateOptns['_inputHlp_' . $F] ) ? esc_attr( $tplateOptns['_inputHlp_' . $F][0] ) : '';
    $lblTxt = abcfsl_mbox_item_text_line_number( $F , $inputLbl );

    $rating = isset( $itemOptns['_txt_' . $F] ) ? esc_attr( $itemOptns['_txt_' . $F][0] ) : '';

    // if($showField == 2) {
    //     $out = abcfl_input_txt_readonly('ro_txt_' . $F, '', $rating, $lblTxt, '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    //     echo $out; 
    //     return;
    // }

    $cboItems = array();
    for ($x = 0; $x <= $iconMaxQty; $x++) {
        $cboItems[$x] = $x;
    } 

    $out = abcfl_input_cbo( 'txt_' . $F, 
        '', 
        $cboItems, 
        $rating, 
        $lblTxt, 
        $inputHlp, 
        '50%', 
        false, 
        '', 
        '', 
        'abcflFldCntr', 
        'abcflFldLbl', '');

    echo $out;  
    echo abcfl_input_hline('3', 20);     
}
//==== STAR RATING END =================================================


    // //----------------------------------------------------
    // $flexCntr = abcfl_html_tag( 'div', '', 'abcflFGCntr' );
    // $flexCntr50 = abcfl_html_tag( 'div', '', 'abcflFGCntr abcflFGCntr50' );
    // $flexG2Col = abcfl_html_tag( 'div', '', 'abcflFG2Col' );  
    // $flexG2Col13 = abcfl_html_tag( 'div', '', 'abcflFG2Col13' );
    // $flexG2Col23 = abcfl_html_tag( 'div', '', 'abcflFG2Col23' );  
    // $divE = abcfl_html_tag_end( 'div'); 
    // //-------------------------------------------------------- 

    