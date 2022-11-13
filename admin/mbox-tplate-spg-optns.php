<?php
function abcfsl_mbox_tplate_spg_optns( $tplateID, $tplateOptns, $slug ){

    $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '0';
    $lstLayoutH = isset( $tplateOptns['_lstLayoutH'] ) ? esc_attr( $tplateOptns['_lstLayoutH'][0] ) : $lstLayout;

    $sPageUrl = isset( $tplateOptns['_sPageUrl'] ) ? esc_attr( $tplateOptns['_sPageUrl'][0] ) : '';
    $sPgLnkTxt = isset( $tplateOptns['_sPgLnkTxt'] ) ? esc_attr( $tplateOptns['_sPgLnkTxt'][0] ) : '';
    $sPgLnkNT = isset( $tplateOptns['_sPgLnkNT'] ) ? $tplateOptns['_sPgLnkNT'][0] : '0';
    $imgLnkLDefault = isset( $tplateOptns['_imgLnkLDefault'] ) ? $tplateOptns['_imgLnkLDefault'][0] : '0';
    $sPgLnkShow = isset( $tplateOptns['_sPgLnkShow'] ) ? $tplateOptns['_sPgLnkShow'][0] : 'N';
    $sPgLnkTag = isset( $tplateOptns['_sPgLnkTag'] ) ? $tplateOptns['_sPgLnkTag'][0] : 'div';
    $sPgLnkFont = isset( $tplateOptns['_sPgLnkFont'] ) ? $tplateOptns['_sPgLnkFont'][0] : 'D';
    $sPgLnkMarginT = isset( $tplateOptns['_sPgLnkMarginT'] ) ? $tplateOptns['_sPgLnkMarginT'][0] : 'N';
    $sPgLnkCls = isset( $tplateOptns['_sPgLnkCls'] ) ? esc_attr( $tplateOptns['_sPgLnkCls'][0] ) : '';
    $sPgLnkStyle = isset( $tplateOptns['_sPgLnkStyle'] ) ? esc_attr( $tplateOptns['_sPgLnkStyle'][0] ) : '';

    $sdPropertySPTL = isset( $tplateOptns['_sdPropertySPTL'] ) ? esc_attr( $tplateOptns['_sdPropertySPTL'][0] ) : '';

    $scode = abcfsl_scode_build_scode( 10, $tplateID );
    $cboTag = abcfsl_cbo_tag_type();
    $cboFont = abcfsl_cbo_font_size();
    $cboMarginT  = abcfsl_cbo_txt_margin_top();
    $cboSPgLnkShow = abcfsl_cbo_spg_lnk_show();

    // Remove later. Fix for cbo value changes.
    if( $sPgLnkShow == 'ST') { $sPgLnkShow = 'SPHYB'; }
    if( $sPgLnkShow == 'SPGCUST') { $sPgLnkShow = 'SPCUST'; }

    echo  abcfl_html_tag('div','CN5','inside hidden abcflFadeIn');

        //-- ADD NEW Record Screen. Display only Add New Layout cbo ------------------------
        if($lstLayoutH == '0'){
            echo abcfl_html_tag_end('div');
            return;
        }

        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(705), abcfsl_aurl(4) );
        //-------------------------------------------
        $lblSPgScode = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(69) . ' ' . abcfsl_txta(3), abcfsl_aurl(58), 'abcflFontWP abcflFontS13 abcflFontW400' );
        echo abcfl_input_txt_readonly('scode', '', $scode , $lblSPgScode , '', '50%', 'regular-text code abcflFontW700', '', 'abcflFldCntr abcflShortcode', 'abcflFldLbl');

        $lblSPgUrl = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(271), abcfsl_aurl(57), 'abcflFontWP abcflFontS13 abcflFontW400' );
        echo abcfl_input_txt('sPageUrl', '', $sPageUrl, $lblSPgUrl, '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');

        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(326), abcfsl_aurl(12), 'abcflFontWP abcflFontS16 abcflMTop10');
        //echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(389), abcfsl_aurl(22), 'abcflFontWP abcflFontS16  abcflMTop5');

        //-- Single Page Hyperlink -----------------------------------------
        echo abcfl_input_hline('2', '20');
        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(142), abcfsl_aurl(23) );
        //echo abcfl_input_info_lbl( abcfsl_txta(142), 'abcflMTop5', 12 );
        echo abcfl_input_cbo('sPgLnkShow', '', $cboSPgLnkShow, $sPgLnkShow, abcfsl_txta_r(147), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_txt( 'sPgLnkTxt', '', $sPgLnkTxt, abcfsl_txta(259), abcfsl_txta(127), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        
        //Not for Grid C
        if( $lstLayoutH != 4 ) {
            echo abcfl_input_checkbox('imgLnkLDefault',  '', $imgLnkLDefault, abcfsl_txta(378), '', '', '', 'abcflFldCntr', '', '', '' );
        }

        echo abcfl_input_checkbox('sPgLnkNT',  '', $sPgLnkNT, abcfsl_txta(143), '', '', '', 'abcflFldCntr abcflMTop15', '', '', '' );
        
        //---------------------------------
        echo abcfl_input_hline('2', '20');
        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(141), '' );
        //echo abcfl_input_cbo( 'sPgLnkTag', '', $cboTag, $sPgLnkTag, abcfsl_txta_r(287), abcfsl_txta(279), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        //echo abcfl_input_cbo_strings( 'sPgLnkFont', '', $cboFont, $sPgLnkFont, abcfsl_txta(47), abcfsl_txta(247), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        //echo abcfl_input_cbo_strings( 'sPgLnkMarginT', '', $cboMarginT , $sPgLnkMarginT, abcfsl_txta(15), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        //---------------------------------
        //abcfsl_autil_css_section_class( 'sPgLnkCls', $sPgLnkCls, '' );

        $par['fTag'] = 'sPgLnkTag';
        $par['fFont'] = 'sPgLnkFont';
        $par['fMarginT'] = 'sPgLnkMarginT';
        $par['fCustCls'] = 'sPgLnkCls';
        $par['fCustStyle'] = 'sPgLnkStyle';
        $par['hlineShow'] = false;
        $par['showHdr'] = false;
   
        abcfsl_autil_field_style_inputs_bldr( $tplateOptns, $par );
        //abcfsl_autil_custom_class_and_style( $tplateOptns, $par );

        abcfsl_mbox_tplate_spg_optns_sd_property( $sdPropertySPTL );

    echo abcfl_html_tag_end('div');
}


