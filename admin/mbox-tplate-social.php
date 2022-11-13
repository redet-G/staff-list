<?php
function abcfsl_mbox_tplate_social( $tplateOptns ){

  echo  abcfl_html_tag('div','','inside hidden');

    $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '0';
    $lstLayoutH = isset( $tplateOptns['_lstLayoutH'] ) ? esc_attr( $tplateOptns['_lstLayoutH'][0] ) : $lstLayout;
    if($lstLayoutH == '0'){
        echo abcfl_html_tag_end('div');
        return;
    }
    
    $socialNT = isset( $tplateOptns['_socialLnkNT'] ) ? $tplateOptns['_socialLnkNT'][0] : 'N';
    $showSocial = isset( $tplateOptns['_showSocial'] ) ? $tplateOptns['_showSocial'][0] : 'N';
    $showSocialOn = isset( $tplateOptns['_showSocialOn'] ) ? esc_attr( $tplateOptns['_showSocialOn'][0] ) : 'Y';
    $socialSource = isset( $tplateOptns['_socialSource'] ) ? esc_attr( $tplateOptns['_socialSource'][0] ) : '32-70';
    $social1 = isset( $tplateOptns['_social1'] ) ? esc_attr( $tplateOptns['_social1'][0] ) : '';
    $social2 = isset( $tplateOptns['_social2'] ) ? esc_attr( $tplateOptns['_social2'][0] ) : '';
    $social3 = isset( $tplateOptns['_social3'] ) ? esc_attr( $tplateOptns['_social3'][0] ) : '';

    $socialCntrLbl = isset( $tplateOptns['_socialCntrLbl'] ) ? esc_attr( $tplateOptns['_socialCntrLbl'][0] ) : '';
    $socialCntrHlp= isset( $tplateOptns['_socialCntrHlp'] ) ? esc_attr( $tplateOptns['_socialCntrHlp'][0] ) : '';

    $cntrCls = isset( $tplateOptns['_socialCntrCls'] ) ? esc_attr( $tplateOptns['_socialCntrCls'][0] ) : '';
    $cntrStyle = isset( $tplateOptns['_socialCntrStyle'] ) ? esc_attr( $tplateOptns['_socialCntrStyle'][0] ) : '';
    $socialTM = isset( $tplateOptns['_socialTM'] ) ? esc_attr( $tplateOptns['_socialTM'][0] ) : 'N';

    abcfsl_mbox_tplate_social_items( $showSocial, $showSocialOn, $socialSource, $social1, $social2, $social3, $socialCntrLbl, $socialCntrHlp, $cntrCls, $cntrStyle, $socialTM );
    echo abcfl_html_tag_end('div');

}
function abcfsl_mbox_tplate_social_items( $showSocial, $showSocialOn, $socialSource, $social1, $social2, $social3, $socialCntrLbl, $socialCntrHlp, $cntrCls, $cntrStyle, $socialTM ){

    $cboSocialSize = abcfsl_cbo_social_icons();
    $cboShowSocial = abcfsl_cbo_show_social();
    $cboShowSocialOn = abcfsl_cbo_show_field();
    $cboTomM = abcfsl_cbo_margin_top_social();

    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(54), abcfsl_aurl(7) );

    echo abcfl_input_cbo('showSocial', '', $cboShowSocial, $showSocial,abcfsl_txta_r(53), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo('showSocialOn', '', $cboShowSocialOn, $showSocialOn, abcfsl_txta(72), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo('socialSource', '', $cboSocialSize, $socialSource, abcfsl_txta(55), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

    //---------------------
    echo abcfl_input_hline('2');
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(216), abcfsl_aurl(8) );
    echo abcfl_input_info_lbl(abcfsl_txta(236), 'abcflMTop5', '14');

    //echo abcfl_input_txt('social1', '', $social1, abcfsl_txta(62, ' 1'), abcfsl_txta(236), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('social1', '', $social1, '1', abcfsl_txta(0), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('social2', '', $social2, '2', abcfsl_txta(0), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('social3', '', $social3, '3', abcfsl_txta(0), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    //---------------------
    echo abcfl_input_hline('2');
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(239), '' );
    echo abcfl_input_info_lbl(abcfsl_txta(227), 'abcflMTop5', '14');

    echo abcfl_input_txt('socialCntrLbl', '', $socialCntrLbl, abcfsl_txta(29), abcfsl_txta(203), '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('socialCntrHlp', '', $socialCntrHlp, abcfsl_txta(1), abcfsl_txta(257), '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    //---------------------
    echo abcfl_input_hline('2');
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(238), '' );
    echo abcfl_input_cbo('socialTM', '', $cboTomM, $socialTM, abcfsl_txta(15), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

    abcfsl_autil_class_and_style( 'socialCntrCls', $cntrCls, 'socialCntrStyle', $cntrStyle, '', false );
}

