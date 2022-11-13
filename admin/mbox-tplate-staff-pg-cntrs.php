<?php
function abcfsl_mbox_tplate_staff_pg_cntrs( $tplateOptns, $clsPfix ){

  echo  abcfl_html_tag('div','CN2','inside hidden abcflFadeIn');

    $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '0';
    $lstLayoutH = isset( $tplateOptns['_lstLayoutH'] ) ? esc_attr( $tplateOptns['_lstLayoutH'][0] ) : $lstLayout;

    $lstCols = isset( $tplateOptns['_lstCols'] ) ? esc_attr( $tplateOptns['_lstCols'][0] ) : '6';
    $itemPadLR = isset( $tplateOptns['_itemPadLR'] ) ? esc_attr( $tplateOptns['_itemPadLR'][0] ) : 'Pc1';
    $itemMarginBN = isset( $tplateOptns['_itemMarginBN'] ) ? esc_attr( $tplateOptns['_itemMarginBN'][0] ) : '40';
    $innerCntrCls = isset( $tplateOptns['_innerCntrCls'] ) ? esc_attr( $tplateOptns['_innerCntrCls'][0] ) : '';
    $innerCntrStyle = isset( $tplateOptns['_innerCntrStyle'] ) ? esc_attr( $tplateOptns['_innerCntrStyle'][0] ) : '';
    $addMaxW = isset( $tplateOptns['_addMaxW'] ) ? esc_attr( $tplateOptns['_addMaxW'][0] ) : 'N';

    
    //$defaultTCC = $clsPfix . 'PadLPc5';
    //if( $lstLayoutH == 3 ) { $defaultTCC = '';}

    //Text container custom CSS
    //$lstTxtCntrCls = isset( $tplateOptns['_lstTxtCntrCls'] ) ? esc_attr( $tplateOptns['_lstTxtCntrCls'][0] ) : $defaultTCC;
    //$lstTxtCntrStyle = isset( $tplateOptns['_lstTxtCntrStyle'] ) ? esc_attr( $tplateOptns['_lstTxtCntrStyle'][0] ) : '';
    //$lstItemCls = isset( $tplateOptns['_lstItemCls'] ) ? esc_attr( $tplateOptns['_lstItemCls'][0] ) : '';
    //$lstItemStyle = isset( $tplateOptns['_lstItemStyle'] ) ? esc_attr( $tplateOptns['_lstItemStyle'][0] ) : '';

    // 1=List; 2=Grid B; 3=Grid A; 4=GridC; 200=Grid AI; ; 201=Grid BI; 202=Grid CI; 203=List LI;
    switch ($lstLayoutH) {
        case 1:
            abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_list( $tplateOptns );
            abcfsl_mbox_tplate_staff_pg_cntrs_txt_cntr_list( $tplateOptns );
            break;
        case 2:
            abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_grid_b( $tplateOptns, $lstCols, $itemPadLR, $itemMarginBN );
            abcfsl_mbox_tplate_staff_pg_cntrs_txt_cntr_list( $tplateOptns );
            break;
        case 3:
            abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_grid_a( $tplateOptns, $itemPadLR, $itemMarginBN );
            abcfsl_mbox_tplate_staff_pg_cntrs_inner_cntr( $tplateOptns );
            abcfsl_mbox_tplate_staff_pg_cntrs_txt_cntr_grid_a( $tplateOptns, $addMaxW );
            break;
        case 4:
            abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_grid_c( $tplateOptns, $itemPadLR, $itemMarginBN );
            break;            
        case 200: 
            abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_grid_a( $tplateOptns, $itemPadLR, $itemMarginBN );
            abcfsl_mbox_tplate_staff_pg_cntrs_inner_cntr( $tplateOptns );
            abcfsl_mbox_tplate_staff_pg_cntrs_txt_cntr_grid_a( $tplateOptns, $addMaxW );
            break;
        case 201:
            abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_grid_b( $tplateOptns, $lstCols, $itemPadLR, $itemMarginBN );
            abcfsl_mbox_tplate_staff_pg_cntrs_txt_cntr_list( $tplateOptns );
            break;
        case 202:
            abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_grid_c( $tplateOptns, $itemPadLR, $itemMarginBN );
            break;
        case 203:
            abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_list( $tplateOptns );
            abcfsl_mbox_tplate_staff_pg_cntrs_txt_cntr_list( $tplateOptns );            
        default:
            break;
    }
    echo abcfl_html_tag_end('div');
}

//== LIST ===========================================================================
//LIST Item Container.
function abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_list( $tplateOptns ){
    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL, 'list-item-container.png', abcfsl_txta(301), '', abcfsl_aurl(91) );
    abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_class_and_style( $tplateOptns );
}

//== GRID B ===================================================================
function abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_grid_b( $tplateOptns, $lstCols, $itemPadLR, $itemMarginBN ){

    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL, 'grid-b-item-container.png', abcfsl_txta(301), '' ,abcfsl_aurl(92) );

    $lblIL = abcfl_input_lbl_hlp( ABCFSL_ICONS_URL, abcfsl_txta_r(253), abcfsl_aurl(30) );

    echo abcfl_input_cbo('lstCols', '', abcfsl_cbo_list_columns(), $lstCols, $lblIL, '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings('itemPadLR', '', abcfsl_cbo_list_grid_pad_lr(), $itemPadLR, abcfsl_txta_r(119), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings('itemMarginBN', '', abcfsl_cbo_list_grid_item_bottom_margin(), $itemMarginBN, abcfsl_txta_r(120), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_class_and_style( $tplateOptns );
}

//LIST - Text Container.
function abcfsl_mbox_tplate_staff_pg_cntrs_txt_cntr_list( $tplateOptns ){
    echo abcfl_input_hline('2');
    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL, 'grid-b-text-container.png', abcfsl_txta(251), '', '' );
    abcfsl_mbox_tplate_staff_pg_cntrs_class_and_style( $tplateOptns, 'lstTxtCntrCls', 'lstTxtCntrStyle', 252 );
}

//== GRID A===========================================================================
//GRID Item Container.
function abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_grid_a( $tplateOptns, $itemPadLR, $itemMarginBN ){

    $cboItemMB = abcfsl_cbo_margin_bottom_margin();
    $cboItemPadLR = abcfsl_cbo_pad_lr();

    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL, 'grid-a-item-container.png', abcfsl_txta(301), '', abcfsl_aurl(93) );
    echo abcfl_input_cbo_strings('itemPadLR', '', $cboItemPadLR, $itemPadLR, abcfsl_txta_r(75), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings('itemMarginBN', '', $cboItemMB, $itemMarginBN, abcfsl_txta_r(89), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_class_and_style( $tplateOptns );
}

//GRI A - Text Container
function abcfsl_mbox_tplate_staff_pg_cntrs_txt_cntr_grid_a( $tplateOptns, $addMaxW ){

    $cboYN = abcfsl_cbo_yn();

    echo abcfl_input_hline('2');
    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL, 'grid-a-text-container.png', abcfsl_txta(251), '', '' );
    echo abcfl_input_cbo_strings('addMaxW', '',$cboYN, $addMaxW, abcfsl_txta(278), abcfsl_txta(309), '50%',  '', '', 'abcflFldCntr', 'abcflFldLbl');
    abcfsl_mbox_tplate_staff_pg_cntrs_class_and_style( $tplateOptns, 'lstTxtCntrCls', 'lstTxtCntrStyle' );
    echo abcfl_input_lbl_hlp( ABCFSL_ICONS_URL, abcfsl_txta(452), abcfsl_aurl(61) );
}

function abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_grid_c( $tplateOptns, $itemPadLR, $itemMarginBN ){

    $cboItemMB = abcfsl_cbo_margin_bottom_margin();
    $cboItemPadLR = abcfsl_cbo_pad_lr();

    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL, 'grid-c-item-container.png', abcfsl_txta(301), '', abcfsl_aurl(94) );
    echo abcfl_input_cbo_strings('itemPadLR', '', $cboItemPadLR, $itemPadLR, abcfsl_txta_r(75), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings('itemMarginBN', '', $cboItemMB, $itemMarginBN, abcfsl_txta_r(89), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    // TODO Input removed defaults to 40px

    //abcfsl_autil_css_section_class( 'lstItemCls', $lstItemCls, '' );
    abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_class_and_style( $tplateOptns );
}

//================================================================
//Inner Container.
function abcfsl_mbox_tplate_staff_pg_cntrs_inner_cntr( $tplateOptns ){

    echo abcfl_input_hline('2');
    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL, 'grid-a-item-inner-container.png', abcfsl_txta(31), '', '' );
    //abcfsl_autil_css_section_class_style( 'innerCntrCls', $cls, 'innerCntrStyle', $style, '' );
    abcfsl_mbox_tplate_staff_pg_cntrs_class_and_style( $tplateOptns, 'innerCntrCls', 'innerCntrStyle' );
}

function abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_class_and_style( $tplateOptns ) {

    $par['fieldIDCustCls'] = 'lstItemCls';
    $par['fieldIDCustStyle'] = 'lstItemStyle';
    $par['fCustCls'] = 'lstItemCls';
    $par['fCustStyle'] = 'lstItemStyle';
    $par['hlpCls'] = '223'; 
    $par['urlCls'] = 2; 
    $par['urlStyle'] = 24; 
    $par['showHdr'] = false;
    $par['hlineShow'] = false;
    $par['hlineWidthBT'] = 0;

    abcfsl_autil_custom_class_and_style( $tplateOptns, $par );
}

function abcfsl_mbox_tplate_staff_pg_cntrs_class_and_style( $tplateOptns, $fieldCls, $fieldStyle, $hlpClsID=223 ) {

    $par['fieldIDCustCls'] = $fieldCls;
    $par['fieldIDCustStyle'] = $fieldStyle;
    $par['fCustCls'] = $fieldCls;
    $par['fCustStyle'] = $fieldStyle;
    $par['hlpCls'] = $hlpClsID; 
    $par['urlCls'] = 2; 
    $par['urlStyle'] = 24; 
    $par['showHdr'] = false;
    $par['hlineShow'] = false;
    $par['hlineWidthBT'] = 0;

    abcfsl_autil_custom_class_and_style( $tplateOptns, $par );
}

//======================================================================================================================
// ISOTOPE OK
// function abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_grid_ia( $itemPadLR, $itemMarginBN, $lstItemCls, $lstItemStyle ){

//     $cboItemMB = abcfsl_cbo_margin_bottom_margin();
//     $cboItemPadLR = abcfsl_cbo_pad_lr_isotope();

//     abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL, 'grid-a-item-container.png', abcfsl_txta(301), '', '' );
//     echo abcfl_input_cbo_strings('itemPadLR', '', $cboItemPadLR, $itemPadLR, abcfsl_txta_r(75), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
//     echo abcfl_input_cbo_strings('itemMarginBN', '', $cboItemMB, $itemMarginBN, abcfsl_txta_r(89), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
//     abcfsl_autil_css_section_class_style( 'lstItemCls', $lstItemCls, 'lstItemStyle', $lstItemStyle, '' );
// }

// function abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_grid_ib( $lstCols, $itemPadLR, $itemMarginBN, $lstItemCls, $lstItemStyle ){

//     abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL, 'grid-b-item-container.png', abcfsl_txta(301), '', abcfsl_aurl(30) );

//     $lblIL = abcfl_input_lbl_hlp( ABCFSL_ICONS_URL, abcfsl_txta_r(253), abcfsl_aurl(30) );

//     echo abcfl_input_cbo('lstCols', '', abcfsl_cbo_list_columns(), $lstCols, $lblIL, '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
//     echo abcfl_input_cbo_strings('itemPadLR', '', abcfsl_cbo_list_grid_pad_lr(), $itemPadLR, abcfsl_txta_r(119), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
//     echo abcfl_input_cbo_strings('itemMarginBN', '', abcfsl_cbo_list_grid_item_bottom_margin(), $itemMarginBN, abcfsl_txta_r(120), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');

//     abcfsl_autil_css_section_class_style( 'lstItemCls', $lstItemCls, 'lstItemStyle', $lstItemStyle, '' );
// }
