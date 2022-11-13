<?php
function abcfsl_mbox_tplate_spg_layout( $tplateOptns, $layout ){

    echo  abcfl_html_tag('div','CN4','inside hidden abcflFadeIn');

        $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '0';
        $lstLayoutH = isset( $tplateOptns['_lstLayoutH'] ) ? esc_attr( $tplateOptns['_lstLayoutH'][0] ) : $lstLayout;
        $spgCols = isset( $tplateOptns['_spgCols'] ) ? esc_attr( $tplateOptns['_spgCols'][0] ) : '6';
        $spgMMarginT = isset( $tplateOptns['_spgMMarginT'] ) ? esc_attr( $tplateOptns['_spgMMarginT'][0] ) : 'N';

        $spgCntrW = isset( $tplateOptns['_spgCntrW'] ) ? esc_attr( $tplateOptns['_spgCntrW'][0] ) : '';
        $spgACenter = isset( $tplateOptns['_spgACenter'] ) ? esc_attr( $tplateOptns['_spgACenter'][0] ) : 'Y';
        $spgMICls = isset( $tplateOptns['_spgMICls'] ) ? esc_attr( $tplateOptns['_spgMICls'][0] ) : '';
        $spgMTCls = isset( $tplateOptns['_spgMTCls'] ) ? esc_attr( $tplateOptns['_spgMTCls'][0] ) : '';

        $spgCntrCls = isset( $tplateOptns['_spgCntrCls'] ) ? esc_attr( $tplateOptns['_spgCntrCls'][0] ) : '';
        $spgCClsT = isset( $tplateOptns['_spgCClsT'] ) ? esc_attr( $tplateOptns['_spgCClsT'][0] ) : '';
        $spgCClsM = isset( $tplateOptns['_spgCClsM'] ) ? esc_attr( $tplateOptns['_spgCClsM'][0] ) : '';
        $spgCClsB = isset( $tplateOptns['_spgCClsB'] ) ? esc_attr( $tplateOptns['_spgCClsB'][0] ) : '';      

       //-- ADD NEW Record Screen. Display only Add New Layout cbo ------------------------
        if( $lstLayoutH == '0' ){
            echo abcfl_html_tag_end('div');
            return;
        }

        // $layout 100, $layout 200 = Grid C
        abcfsl_mbox_tplate_spg_layout_cntr( $spgCntrW, $spgACenter, $layout ); 
        if( $layout == 100 ) { 
            abcfsl_mbox_tplate_spg_layout_cntr_m( $spgCols, $spgMMarginT, $spgMICls, $spgMTCls, $tplateOptns ); 
        }
        //abcfsl_mbox_tplate_spg_layout_css( $spgCntrCls, $spgCClsT, $spgCClsM, $spgCClsB );

        abcfsl_mbox_tplate_spg_layout_css( $tplateOptns );


    echo abcfl_html_tag_end('div');
}

//sPg Container
function abcfsl_mbox_tplate_spg_layout_cntr( $spgCntrW, $spgACenter, $layout ){

    $png = 'staff-single-pg.png';
    if( $layout == 200 ) { $png = 'staff-single-pg-no-img.png'; }

    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL, $png, abcfsl_txta(69)  . ' ' . abcfsl_txta(13), abcfsl_txta(322), abcfsl_aurl(9) );
    echo abcfl_input_txt('spgCntrW', '', $spgCntrW, abcfsl_txta(48), abcfsl_txta(260), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    abcfsl_util_center_yn( 'spgACenter', $spgACenter );
}

//Middle section with image.
function abcfsl_mbox_tplate_spg_layout_cntr_m( $spgCols, $spgMMarginT, $spgMICls, $spgMTCls, $tplateOptns ){

    $cboCols = abcfsl_cbo_list_columns();
    $cboTM = abcfsl_cbo_margin_top_social();
    $lblIL = abcfl_input_lbl_hlp( ABCFSL_ICONS_URL, abcfsl_txta_r(253), abcfsl_aurl(64) );

    echo abcfl_input_hline('2');
    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL, 'staff-single-pg-m.png', abcfsl_txta(145), '', abcfsl_aurl(9) );

    echo abcfl_input_cbo('spgCols', '',$cboCols, $spgCols, $lblIL, '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo('spgMMarginT', '',$cboTM, $spgMMarginT, abcfsl_txta(15), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    //Image custom class
    abcfsl_mbox_tplate_spg_layout_m_css( $spgMICls, $spgMTCls );
    abcfsl_mbox_tplate_spg_layout_m_txt_cntr_class_and_style( $tplateOptns );
}

//Custom CSS. 
function abcfsl_mbox_tplate_spg_layout_css( $tplateOptns ){

    // echo abcfl_input_hline('2', '20');
    // echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(367), abcfsl_aurl(2) );
    // echo abcfl_input_info_lbl( abcfsl_txta(374), 'abcflMTop5', '14');

    // echo abcfl_input_txt( 'spgCntrCls', '', $spgCntrCls, abcfsl_txta(400), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    // echo abcfl_input_txt( 'spgCClsT', '', $spgCClsT, abcfsl_txta(285), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    // echo abcfl_input_txt( 'spgCClsM', '', $spgCClsM, abcfsl_txta(145), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    // echo abcfl_input_txt( 'spgCClsB', '', $spgCClsB, abcfsl_txta(315), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );

    $par1['cls1'] = 'spgCntrCls';
    $par1['cls2'] = 'spgCClsT';
    $par1['lbl1'] = 400;
    $par1['lbl2'] = 285;
    $par1['showHdr'] = true;
    $par1['hlineShow'] = true;

    $par2['cls1'] = 'spgCClsM';
    $par2['cls2'] = 'spgCClsB';
    $par2['lbl1'] = 145;
    $par2['lbl2'] = 315;
    $par2['showHdr'] = false;
    $par2['hlineShow'] = false;

    abcfsl_mbox_tplate_spg_layout_custom_css( $tplateOptns, $par1 );
    abcfsl_mbox_tplate_spg_layout_custom_css( $tplateOptns, $par2 );
}

// Middle section L and R containers, custom CSS
function abcfsl_mbox_tplate_spg_layout_m_css( $spgMICls, $spgMTCls ){   
    echo abcfl_input_txt( 'spgMICls', '', $spgMICls, abcfsl_txta(367) . ' - '. abcfsl_txta(401), abcfsl_txta(374), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );   
    //echo abcfl_input_txt( 'spgMTCls', '', $spgMTCls, abcfsl_txta(367) . ' - '. abcfsl_txta(251), abcfsl_txta(252), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' ); 
}

function abcfsl_mbox_tplate_spg_layout_m_txt_cntr_class_and_style( $tplateOptns ) {

    $par['fieldIDCustCls'] = 'spgMTCls';
    $par['fieldIDCustStyle'] = 'spgMTStyle';
    $par['fCustCls'] = 'spgMTCls';
    $par['fCustStyle'] = 'spgMTStyle';
    $par['lblCls'] = 439;
    $par['lblStyle'] = 440;
    $par['hlpCls'] = 252; 
    $par['urlCls'] = 2; 
    $par['urlStyle'] = 24; 
    $par['showHdr'] = false;
    $par['hlineShow'] = false;
    $par['hlineWidthBT'] = 2;

    abcfsl_autil_custom_class_and_style( $tplateOptns, $par );
}

//  Custom classes. 4 inputs, 2 rows of 2 columns.
function abcfsl_mbox_tplate_spg_layout_custom_css( $tplateOptns, $parIn ) {

    $par['fieldIDCustCls'] = $parIn['cls1'];
    $par['fieldIDCustStyle'] = $parIn['cls2'];
    $par['fCustCls'] =  $parIn['cls1'];
    $par['fCustStyle'] = $parIn['cls2']; 
    $par['lblCls'] = $parIn['lbl1'];
    $par['lblStyle'] = $parIn['lbl2'];

    $par['showHdr'] = $parIn['showHdr'];
    $par['hlineShow'] = $parIn['hlineShow'];
    $par['hdrLbl'] = 367;
    $par['hdrURL'] = 2;
    $par['hdrInfoLbl'] = 374;

    abcfsl_autil_custom_class_and_style( $tplateOptns, $par );
}


