<?php
//==== SOCIAL ICONS START ============================================
function abcfsl_mbox_tplate_icons_social( $tplateOptns ){

    $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '0';
    $lstLayoutH = isset( $tplateOptns['_lstLayoutH'] ) ? esc_attr( $tplateOptns['_lstLayoutH'][0] ) : $lstLayout;
    if($lstLayoutH == '0'){
        echo  abcfl_html_tag('div','CN6','inside hidden');
        echo abcfl_html_tag_end('div');
        return;
    }
    
    //------------------------------------------
    $showSocial = isset( $tplateOptns['_showSocial'] ) ? $tplateOptns['_showSocial'][0] : 'N';
    $showSocialOn = isset( $tplateOptns['_showSocialOn'] ) ? esc_attr( $tplateOptns['_showSocialOn'][0] ) : 'Y';
    $socialSource = isset( $tplateOptns['_socialSource'] ) ? esc_attr( $tplateOptns['_socialSource'][0] ) : '32-70';
    $socialNT = isset( $tplateOptns['_socialNT'] ) ? $tplateOptns['_socialNT'][0] : '0';

    $socialCntrLbl = isset( $tplateOptns['_socialCntrLbl'] ) ? esc_attr( $tplateOptns['_socialCntrLbl'][0] ) : '';
    $socialCntrHlp= isset( $tplateOptns['_socialCntrHlp'] ) ? esc_attr( $tplateOptns['_socialCntrHlp'][0] ) : '';

    $cntrCls = isset( $tplateOptns['_socialCntrCls'] ) ? esc_attr( $tplateOptns['_socialCntrCls'][0] ) : '';
    $cntrStyle = isset( $tplateOptns['_socialCntrStyle'] ) ? esc_attr( $tplateOptns['_socialCntrStyle'][0] ) : '';
    $socialTM = isset( $tplateOptns['_socialTM'] ) ? esc_attr( $tplateOptns['_socialTM'][0] ) : 'N';

    $cboSocialSize = abcfsl_cbo_social_icons();
    $cboShowSocial = abcfsl_cbo_show_social();
    $cboShowSocialOn = abcfsl_cbo_show_field();
    $cboTomM = abcfsl_cbo_margin_top_social();

    //===============================================
    echo  abcfl_html_tag('div','CN6','inside hidden');

        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(54), abcfsl_aurl(7) );

        echo abcfl_input_cbo('showSocial', '', $cboShowSocial, $showSocial,abcfsl_txta_r(53), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('showSocialOn', '', $cboShowSocialOn, $showSocialOn, abcfsl_txta(72), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('socialSource', '', $cboSocialSize, $socialSource, abcfsl_txta(55), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_checkbox('socialNT',  '', $socialNT, abcfsl_txta(143), '', '', '', 'abcflFldCntr', '', '', '' );
        //------------------------------------------
        abcfsl_mbox_tplate_icons_social_custom_items( $tplateOptns );
        //------------------------------------------
        echo abcfl_input_hline('2');
        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(239), '' );
        echo abcfl_input_info_lbl(abcfsl_txta(227), 'abcflMTop5', '14');

        echo abcfl_input_txt('socialCntrLbl', '', $socialCntrLbl, abcfsl_txta(29), abcfsl_txta(203), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_txt('socialCntrHlp', '', $socialCntrHlp, abcfsl_txta(1), abcfsl_txta(257), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');

            //------------------------------------------
        echo abcfl_input_hline('2');
        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(238), '' );
        echo abcfl_input_cbo('socialTM', '', $cboTomM, $socialTM, abcfsl_txta(15), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        abcfsl_autil_css_section_class_style( 'socialCntrCls', $cntrCls, 'socialCntrStyle', $cntrStyle, '' );
    
    echo abcfl_html_tag_end('div'); 
  }

function abcfsl_mbox_tplate_icons_social_custom_items( $tplateOptns ){

    $social1 = isset( $tplateOptns['_social1'] ) ? esc_attr( $tplateOptns['_social1'][0] ) : '';
    $social2 = isset( $tplateOptns['_social2'] ) ? esc_attr( $tplateOptns['_social2'][0] ) : '';
    $social3 = isset( $tplateOptns['_social3'] ) ? esc_attr( $tplateOptns['_social3'][0] ) : '';
    $social4 = isset( $tplateOptns['_social4'] ) ? esc_attr( $tplateOptns['_social4'][0] ) : '';
    $social5 = isset( $tplateOptns['_social5'] ) ? esc_attr( $tplateOptns['_social5'][0] ) : '';
    $social6 = isset( $tplateOptns['_social6'] ) ? esc_attr( $tplateOptns['_social6'][0] ) : ''; 

    $social1Alt = isset( $tplateOptns['_social1Alt'] ) ? esc_attr( $tplateOptns['_social1Alt'][0] ) : '';
    $social2Alt = isset( $tplateOptns['_social2Alt'] ) ? esc_attr( $tplateOptns['_social2Alt'][0] ) : '';
    $social3Alt = isset( $tplateOptns['_social3Alt'] ) ? esc_attr( $tplateOptns['_social3Alt'][0] ) : '';
    $social4Alt = isset( $tplateOptns['_social4Alt'] ) ? esc_attr( $tplateOptns['_social4Alt'][0] ) : '';
    $social5Alt = isset( $tplateOptns['_social5Alt'] ) ? esc_attr( $tplateOptns['_social5Alt'][0] ) : '';
    $social6Alt = isset( $tplateOptns['_social6Alt'] ) ? esc_attr( $tplateOptns['_social6Alt'][0] ) : '';
    //---------------------
    echo abcfl_input_hline('2');
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(216), abcfsl_aurl(8) );
    echo abcfl_input_info_lbl(abcfsl_txta(236), 'abcflMTop5', '14');

    $social1 = abcfl_input_txt('social1', '', $social1, '1 ' . abcfsl_txta(502), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $social2 = abcfl_input_txt('social2', '', $social2, '2 ' . abcfsl_txta(502), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $social3 = abcfl_input_txt('social3', '', $social3, '3 ' . abcfsl_txta(502), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $social4 = abcfl_input_txt('social4', '', $social4, '4 ' . abcfsl_txta(502), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $social5 = abcfl_input_txt('social5', '', $social5, '5 ' . abcfsl_txta(502), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $social6 = abcfl_input_txt('social6', '', $social6, '6 ' . abcfsl_txta(502), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    $social1Alt = abcfl_input_txt('social1Alt', '', $social1Alt, '1 Alt (' . abcfsl_txta(270) . ')', '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $social2Alt = abcfl_input_txt('social2Alt', '', $social2Alt, '2 Alt (' . abcfsl_txta(270) . ')', '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $social3Alt = abcfl_input_txt('social3Alt', '', $social3Alt, '3 Alt (' . abcfsl_txta(270) . ')', '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $social4Alt = abcfl_input_txt('social4Alt', '', $social4Alt, '4 Alt (' . abcfsl_txta(270) . ')', '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $social5Alt = abcfl_input_txt('social5Alt', '', $social5Alt, '5 Alt (' . abcfsl_txta(270) . ')', '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $social6Alt = abcfl_input_txt('social6Alt', '', $social6Alt, '6 Alt (' . abcfsl_txta(270) . ')', '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    //----------------------------------------------------
    $flexCntrS50 = abcfl_html_tag( 'div', '', 'abcflFGCntr abcflFGCntr50' );
    $flex2ColS = abcfl_html_tag( 'div', '', 'abcflFG2Col' );
    $divE = abcfl_html_tag_end( 'div'); 
    //--------------------------------------------------------
    echo $flexCntrS50 . $flex2ColS . $social1 . $divE . $flex2ColS . $social1Alt . abcfl_html_tag_ends( 'div,div' );
    echo $flexCntrS50 . $flex2ColS . $social2 . $divE . $flex2ColS . $social2Alt . abcfl_html_tag_ends( 'div,div' );
    echo $flexCntrS50 . $flex2ColS . $social3 . $divE . $flex2ColS . $social3Alt . abcfl_html_tag_ends( 'div,div' );
    echo $flexCntrS50 . $flex2ColS . $social4 . $divE . $flex2ColS . $social4Alt . abcfl_html_tag_ends( 'div,div' );
    echo $flexCntrS50 . $flex2ColS . $social5 . $divE . $flex2ColS . $social5Alt . abcfl_html_tag_ends( 'div,div' );
    echo $flexCntrS50 . $flex2ColS . $social6 . $divE . $flex2ColS . $social6Alt . abcfl_html_tag_ends( 'div,div' );       
}
//==== SOCIAL ICONS END ============================================

//==== STAR RATING START =================================================
function abcfsl_mbox_tplate_icons_optns_STARR( $tplateOptns, $F ){

    $tagType = isset( $tplateOptns['_tagType_' . $F] ) ? esc_attr( $tplateOptns['_tagType_' . $F][0] ) : ''; 
    $iconOnCls = isset( $tplateOptns['_iconOnCls_' . $F] ) ? $tplateOptns['_iconOnCls_' . $F][0] : '';
    $iconOffCls = isset( $tplateOptns['_iconOffCls_' . $F] ) ? $tplateOptns['_iconOffCls_' . $F][0] : '';
    $iconOnStyle = isset( $tplateOptns['_iconOnStyle_' . $F] ) ? $tplateOptns['_iconOnStyle_' . $F][0] : '';
    $iconOffStyle = isset( $tplateOptns['_iconOffStyle_' . $F] ) ? $tplateOptns['_iconOffStyle_' . $F][0] : '';
    $iconMaxQty = isset( $tplateOptns['_iconMaxQty_' . $F] ) ? $tplateOptns['_iconMaxQty_' . $F][0] : '';
    $iconType = isset( $tplateOptns['_iconType_' . $F] ) ? esc_attr( $tplateOptns['_tagType_' . $F][0] ) : ''; 
    //----------------------------------------------------
    $flexCntrS50 = abcfl_html_tag( 'div', '', 'abcflFGCntr abcflFGCntr50' );
    $flex2ColS = abcfl_html_tag( 'div', '', 'abcflFG2Col' );
    $flex3ColS = abcfl_html_tag( 'div', '', 'abcflFG3Col' ); 
    $divE = abcfl_html_tag_end( 'div'); 
    //--------------------------------------------------------    
    $cboTT = abcfsl_cbo_icon_tag();
    $cbo16 = abcfsl_cbo_1_6();
    $cboYN = abcfsl_cbo_yn();
    $cboIconType = abcfsl_cbo_icon_type();

    abcfsl_mbox_tplate_field_section_hdr( 20, 409 );
    $iTag = abcfl_input_cbo_strings( 'tagType_' . $F, '', $cboTT, $tagType, abcfsl_txta(403), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $maxQty = abcfl_input_cbo_strings( 'iconMaxQty_' . $F, '', $cbo16, $iconMaxQty, abcfsl_txta(404), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $iType = abcfl_input_cbo_strings( 'iconType_' . $F, '', $cboIconType, $iconType, abcfsl_txta(506), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $onCls = abcfl_input_txt( 'iconOnCls_' . $F, '', $iconOnCls, abcfsl_txta(405), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    $onStyle = abcfl_input_txt( 'iconOnStyle_' . $F, '', $iconOnStyle, abcfsl_txta(407), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    $offCls = abcfl_input_txt( 'iconOffCls_' . $F, '', $iconOffCls, abcfsl_txta(406), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    $offStyle = abcfl_input_txt( 'iconOffStyle_' . $F, '', $iconOffStyle, abcfsl_txta(408), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl' );

    echo $flexCntrS50 . $flex3ColS . $iTag . $divE . $flex3ColS . $maxQty . $divE . $flex3ColS . $iType . abcfl_html_tag_ends( 'div,div' );
    echo $flexCntrS50 . $flex2ColS . $onCls . $divE . $flex2ColS . $onStyle . abcfl_html_tag_ends( 'div,div' );
    echo $flexCntrS50 . $flex2ColS . $offCls . $divE . $flex2ColS . $offStyle . abcfl_html_tag_ends( 'div,div' );
}
//==== ICONLNK START ============================================
function abcfsl_mbox_tplate_icons_optns_ICONLNK( $tplateOptns, $F ){

    $tagType = isset( $tplateOptns['_tagType_' . $F] ) ? $tplateOptns['_tagType_' . $F][0] : ''; 
    $iconML = isset( $tplateOptns['_iconML_' . $F] ) ? $tplateOptns['_iconML_' . $F][0] : '';
    $iconType = isset( $tplateOptns['_iconType_' . $F] ) ? $tplateOptns['_iconType_' . $F][0] : ''; 
    $lnkNT = isset( $tplateOptns['_lnkNT_' . $F] ) ? $tplateOptns['_lnkNT_' . $F][0] : '0'; 
    
    $icon1Name = isset( $tplateOptns['_icon1Name_' . $F] ) ? $tplateOptns['_icon1Name_' . $F][0] : '';
    $icon1Cls = isset( $tplateOptns['_icon1Cls_' . $F] ) ? $tplateOptns['_icon1Cls_' . $F][0] : '';
    $icon1Style = isset( $tplateOptns['_icon1Style_' . $F] ) ? $tplateOptns['_icon1Style_' . $F][0] : '';

    $icon2Name = isset( $tplateOptns['_icon2Name_' . $F] ) ? $tplateOptns['_icon2Name_' . $F][0] : '';
    $icon2Cls = isset( $tplateOptns['_icon2Cls_' . $F] ) ? $tplateOptns['_icon2Cls_' . $F][0] : '';   
    $icon2Style = isset( $tplateOptns['_icon2Style_' . $F] ) ? $tplateOptns['_icon2Style_' . $F][0] : '';

    $icon3Name = isset( $tplateOptns['_icon3Name_' . $F] ) ? $tplateOptns['_icon3Name_' . $F][0] : '';
    $icon3Cls = isset( $tplateOptns['_icon3Cls_' . $F] ) ? $tplateOptns['_icon3Cls_' . $F][0] : '';   
    $icon3Style = isset( $tplateOptns['_icon3Style_' . $F] ) ? $tplateOptns['_icon3Style_' . $F][0] : '';    

    $icon4Name = isset( $tplateOptns['_icon4Name_' . $F] ) ? $tplateOptns['_icon4Name_' . $F][0] : '';
    $icon4Cls = isset( $tplateOptns['_icon4Cls_' . $F] ) ? $tplateOptns['_icon4Cls_' . $F][0] : '';
    $icon4Style = isset( $tplateOptns['_icon4Style_' . $F] ) ? $tplateOptns['_icon4Style_' . $F][0] : '';

    $icon5Name = isset( $tplateOptns['_icon5Name_' . $F] ) ? $tplateOptns['_icon5Name_' . $F][0] : '';
    $icon5Cls = isset( $tplateOptns['_icon5Cls_' . $F] ) ? $tplateOptns['_icon5Cls_' . $F][0] : '';   
    $icon5Style = isset( $tplateOptns['_icon5Style_' . $F] ) ? $tplateOptns['_icon5Style_' . $F][0] : '';

    $icon6Name = isset( $tplateOptns['_icon6Name_' . $F] ) ? $tplateOptns['_icon6Name_' . $F][0] : '';
    $icon6Cls = isset( $tplateOptns['_icon6Cls_' . $F] ) ? $tplateOptns['_icon6Cls_' . $F][0] : '';   
    $icon6Style = isset( $tplateOptns['_icon6Style_' . $F] ) ? $tplateOptns['_icon6Style_' . $F][0] : '';  

    //----------------------------------------------------  
    $flexCntrS50 = abcfl_html_tag( 'div', '', 'abcflFGCntr abcflFGCntr50' );       
    $flex3ColS = abcfl_html_tag( 'div', '', 'abcflFG3Col' );   
    $divE = abcfl_html_tag_end( 'div'); 
    //--------------------------------------------------------    
    $cboTT = abcfsl_cbo_icon_tag();
    $cboIconML = abcfsl_cbo_icon_margin();
    $cboIconType = abcfsl_cbo_icon_type();

    //--------------------------------------------------------
    abcfsl_mbox_tplate_field_section_hdr( 19, 409 );
    $iTag = abcfl_input_cbo_strings( 'tagType_' . $F, '', $cboTT, $tagType, abcfsl_txta(403), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $iML = abcfl_input_cbo_strings( 'iconML_' . $F, '', $cboIconML, $iconML, abcfsl_txta(504), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $iType = abcfl_input_cbo_strings( 'iconType_' . $F, '', $cboIconType, $iconType, abcfsl_txta(506), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_input_checkbox('lnkNT_' . $F,  '', $lnkNT, abcfsl_txta(143), '', '', '', 'abcflFldCntr', '', '', '' );

    echo $flexCntrS50 . $flex3ColS . $iTag . $divE . $flex3ColS . $iML . $divE . $flex3ColS . $iType . abcfl_html_tag_ends( 'div,div' );
    echo abcfl_input_hline('1', '20');
    abcfsl_mbox_tplate_icons_lnk_optns( '1', $icon1Name, $icon1Cls, $icon1Style, $F, true );
    abcfsl_mbox_tplate_icons_lnk_optns( '2', $icon2Name, $icon2Cls, $icon2Style, $F );
    abcfsl_mbox_tplate_icons_lnk_optns( '3', $icon3Name, $icon3Cls, $icon3Style, $F );
    abcfsl_mbox_tplate_icons_lnk_optns( '4', $icon4Name, $icon4Cls, $icon4Style, $F );
    abcfsl_mbox_tplate_icons_lnk_optns( '5', $icon5Name, $icon5Cls, $icon5Style, $F );
    abcfsl_mbox_tplate_icons_lnk_optns( '6', $icon6Name, $icon6Cls, $icon6Style, $F );
}

function abcfsl_mbox_tplate_icons_lnk_optns( $no, $iconName, $iconCls, $iconStyle, $F, $title=false ){

    $flexCntrS50 = abcfl_html_tag( 'div', '', 'abcflFGCntr abcflFGCntr50' );
    $flex3ColS = abcfl_html_tag( 'div', '', 'abcflFG3Col' );
    $divE = abcfl_html_tag_end( 'div');

    $titleName = '';
    $titleCls = '';
    $titleStyle = '';
    if( $title ){
        $titleName = abcfsl_txta(502);
        $titleCls = abcfsl_txta(501);
        $titleStyle = abcfsl_txta(503);
    }
    //--------------------------------------------------------
    $name = abcfl_input_txt( 'icon' . $no . 'Name_' . $F, '', $iconName, $titleName, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    $cls = abcfl_input_txt( 'icon' . $no . 'Cls_' . $F, '', $iconCls, $titleCls, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    $style = abcfl_input_txt( 'icon' . $no . 'Style_' . $F, '', $iconStyle, $titleStyle, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl' );

    echo $flexCntrS50 . $flex3ColS . $name . $divE . $flex3ColS . $cls . $divE . $flex3ColS . $style . abcfl_html_tag_ends( 'div,div' );
}

function abcfsl_mbox_tplate_icons_style( $tplateOptns, $F ){

    $tagCls = isset( $tplateOptns['_tagCls_' . $F] ) ? esc_attr( $tplateOptns['_tagCls_' . $F][0] ) : '';
    $tagMarginT = isset( $tplateOptns['_tagMarginT_' . $F] ) ? esc_attr( $tplateOptns['_tagMarginT_' . $F][0] ) : 'N';
    $tagMarginTSPg = isset( $tplateOptns['_tagMarginTSPg_' . $F] ) ? esc_attr( $tplateOptns['_tagMarginTSPg_' . $F][0] ) : '';
    //----------------------------------------------------
    $flexCntrS50 = abcfl_html_tag( 'div', '', 'abcflFGCntr abcflFGCntr50' );
    $flex2ColS = abcfl_html_tag( 'div', '', 'abcflFG2Col' );
    $divE = abcfl_html_tag_end( 'div'); 

    $cbo = abcfsl_cbo_txt_margin_top();
    $lbl = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(323), abcfsl_aurl(2), 'abcflFontWP abcflFontS13 abcflFontW400' );
    //-------------------------------------------------------- 
    abcfsl_mbox_tplate_field_section_hdr( 14, 368 );

    $mT = abcfl_input_cbo_strings( 'tagMarginT_' . $F, '', $cbo, $tagMarginT, abcfsl_txta(15) . ' - ' . abcfsl_txta(68), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $mTSpg = abcfl_input_cbo_strings( 'tagMarginTSPg_' . $F, '', $cbo, $tagMarginTSPg, abcfsl_txta(15) . ' - ' . abcfsl_txta(69), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl'); 
    echo $flexCntrS50 . $flex2ColS . $mT . $divE . $flex2ColS . $mTSpg . abcfl_html_tag_ends( 'div,div' );

    echo abcfl_input_txt( 'tagCls_' . $F, '', $tagCls, $lbl, abcfsl_txta(374), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
}