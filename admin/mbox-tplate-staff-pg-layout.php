<?php
//== Add template screen. Pro version =============================================
function abcfsl_mbox_tplate_staff_pg_layout_add_template_p( $lstLayout ){

    $cboTplateLayout = abcfsl_cbo_staff_pg_layout();
    echo abcfl_input_cbo( 'lstLayout', '', $cboTplateLayout, $lstLayout, abcfsl_txta(213), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_icon_cntr( ABCFSL_ICONS_URL, 'staff-list-layouts-plus-isotope-pro.png', 'abcflMTop30 abcflMLeft10' );
    echo abcfl_input_hlp_url( abcfsl_txta(11), abcfsl_aurl(25), 'abcflFontS18 abcflFontW400 abcflMTop20 abcflMLeft10' );
    echo abcfl_input_hlp_url( abcfsl_txta(451), abcfsl_aurl(59), 'abcflFontS18 abcflFontW400 abcflMTop10 abcflMLeft10' );
}

//== Add template screen.Free version =============================================
function abcfsl_mbox_tplate_staff_pg_layout_add_template_f( $lstLayout ){

    $cboTplateLayout = abcfsl_cbo_staff_pg_layout_f();
    echo abcfl_input_cbo('lstLayout', '',$cboTplateLayout, $lstLayout, abcfsl_txta(213), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_icon_cntr( ABCFSL_ICONS_URL, 'staff-list-layouts-plus-isotope-free.png', 'abcflMTop20 abcflMLeft10' );
    echo abcfl_input_hlp_url( abcfsl_txta(11), abcfsl_aurl(25), 'abcflFontS18 abcflFontW400 abcflMTop5 abcflMLeft20' );
    echo abcfl_input_hlp_url( abcfsl_txta(451), abcfsl_aurl(59), 'abcflFontS18 abcflFontW400 abcflMTop10 abcflMLeft20' );
}

//=== Staff Page Layout  ===========================
//LIST 
function abcfsl_mbox_tplate_staff_pg_layout_list( $tplateOptns, $layoutOptns, $icon ){

    $lstCntrW = $layoutOptns['lstCntrW'];
    $lstCntrCls = $layoutOptns['lstCntrCls'];
    $lstCntrStyle = $layoutOptns['lstCntrStyle'];    
    $lstACenter = $layoutOptns['lstACenter'];
    $lstCntrTM = $layoutOptns['lstCntrTM'];

    $lstCols = isset( $tplateOptns['_lstCols'] ) ?  $tplateOptns['_lstCols'][0] : '6';
    $cboCols = abcfsl_cbo_list_columns();
    $cboCntrTM = abcfsl_cbo_txt_margin_top();
    $lblIL = abcfl_input_lbl_hlp( ABCFSL_ICONS_URL, abcfsl_txta_r(253), abcfsl_aurl(63) );
    //------------------------------------------------------
    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL,  $icon, abcfsl_txta(215), abcfsl_txta(116), abcfsl_aurl(26) );

    echo abcfl_input_cbo('lstCols', '', $cboCols, $lstCols, $lblIL, '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('lstCntrW', '', $lstCntrW, abcfsl_txta(48), abcfsl_txta(260), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo('lstCntrTM', '', $cboCntrTM, $lstCntrTM, abcfsl_txta(15), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    abcfsl_util_center_yn( 'lstACenter', $lstACenter );

    //abcfsl_autil_css_section_class_style( 'lstCntrCls', $lstCntrCls, 'lstCntrStyle', $lstCntrStyle, '', '1' );
    abcfsl_mbox_tplate_staff_pg_layout_class_and_style( $tplateOptns, 'lstCntrCls', 'lstCntrStyle', 1 );

    abcfsl_util_mbox_no_data( $tplateOptns, true );
}

//LIST 
function abcfsl_mbox_tplate_staff_pg_layout_list_i( $tplateOptns, $layoutOptns, $icon ){

    $lstCntrW = $layoutOptns['lstCntrW'];
    $lstCntrCls = $layoutOptns['lstCntrCls'];
    $lstCntrStyle = $layoutOptns['lstCntrStyle'];    
    $lstACenter = $layoutOptns['lstACenter'];
    $lstCntrTM = $layoutOptns['lstCntrTM'];

    $lstCols = isset( $tplateOptns['_lstCols'] ) ?  $tplateOptns['_lstCols'][0] : '6';
    $cboCols = abcfsl_cbo_list_columns();
    $cboCntrTM = abcfsl_cbo_txt_margin_top();
    $lblIL = abcfl_input_lbl_hlp( ABCFSL_ICONS_URL, abcfsl_txta_r(253), abcfsl_aurl(63) );
    //------------------------------------------------------
    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL,  $icon, abcfsl_txta(215). ' ' . abcfsl_txta(192), abcfsl_txta(116), abcfsl_aurl(59) );

    echo abcfl_input_cbo('lstCols', '', $cboCols, $lstCols, $lblIL, '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('lstCntrW', '', $lstCntrW, abcfsl_txta(48), abcfsl_txta(260), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo('lstCntrTM', '', $cboCntrTM, $lstCntrTM, abcfsl_txta(15), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    abcfsl_util_center_yn( 'lstACenter', $lstACenter );

    //abcfsl_autil_css_section_class_style( 'lstCntrCls', $lstCntrCls, 'lstCntrStyle', $lstCntrStyle, '', '1' );
    abcfsl_mbox_tplate_staff_pg_layout_class_and_style( $tplateOptns, 'lstCntrCls', 'lstCntrStyle', 1 );

    abcfsl_util_mbox_no_data( $tplateOptns, true );
}

//===============================================================================

function abcfsl_mbox_tplate_staff_pg_layout_class_and_style( $tplateOptns, $fieldIDCustCls, $fieldIDCustStyle, $hlineWidthBT ) {

    // 'lstCntrCls'; 'lstCntrStyle';

    $par['fieldIDCustCls'] = $fieldIDCustCls;
    $par['fieldIDCustStyle'] = $fieldIDCustStyle;

    $par['fCustCls'] = $fieldIDCustCls;
    $par['fCustStyle'] = $fieldIDCustStyle;
    $par['urlCls'] = 2; 
    $par['urlStyle'] = 24; 
    $par['showHdr'] = false;
    $par['hlineShow'] = true;
    $par['hlineWidthBT'] = $hlineWidthBT;

    abcfsl_autil_custom_class_and_style( $tplateOptns, $par );
}

function abcfsl_mbox_tplate_staff_pg_layout_two_dropdowns( $tplateOptns, $fieldID1, $fieldID2, $cbo1, $cbo2, $lbl1, $lbl2, $hlineWidthBT ) {

    $par['fieldID1'] = $fieldID1;
    $par['fieldID2'] = $fieldID2;
    $par['cbo1'] = $cbo1;
    $par['cbo2'] = $cbo2;
    $par['lbl1'] = $lbl1; 
    $par['lbl2'] = $lbl2; 
    $par['hlp1'] = 0; 
    $par['hlp2'] = 0; 
    $par['url1'] = 0; 
    $par['url2'] = 0; 
    $par['hlpTxt'] = 0;
    $par['hlpTxtR'] = false;
    $par['showHdr'] = false;
    $par['hlineShow'] = true;
    $par['hlineWidthBT'] = $hlineWidthBT;

    abcfsl_autil_two_dropdowns( $tplateOptns, $par );
}


    
