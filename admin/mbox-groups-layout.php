<?php
function abcfsl_mbox_groups_layout( $grpOptns ) {

    echo  abcfl_html_tag('div','CN1','inside');
        abcfsl_mbox_groups_layout_cntr( $grpOptns);
        abcfsl_mbox_groups_layout_item( $grpOptns );
        abcfsl_mbox_groups_layout_item_hline( $grpOptns );
    echo abcfl_html_tag_end('div');
}

//Group container
function abcfsl_mbox_groups_layout_cntr( $grpOptns ){

    $grpCntrMT = isset( $grpOptns['_grpCntrMT'] ) ? $grpOptns['_grpCntrMT'][0] : 'N';
    $grpCntrMB = isset( $grpOptns['_grpCntrMB'] ) ? $grpOptns['_grpCntrMB'][0] : 'N';
    $grpCntrCustCls = isset( $grpOptns['_grpCntrCustCls'] ) ? esc_attr( $grpOptns['_grpCntrCustCls'][0] ) : '';

    abcfsl_mbox_tplate_field_section_hdr( 77, 364, false);

    echo abcfsl_mbox_groups_layout_margin_t( 'grpCntrMT', $grpCntrMT, 0, 15 );
    echo abcfsl_mbox_groups_layout_margin_t( 'grpCntrMB', $grpCntrMB, 0, 89 );
    abcfsl_autil_css_section_class( 'grpCntrCustCls', $grpCntrCustCls, '' );
}

//=== Group name ===
function abcfsl_mbox_groups_layout_item( $grpOptns ){

    $grpItemML = isset( $grpOptns['_grpItemML'] ) ? $grpOptns['_grpItemML'][0] : '';
    $grpFontSize = isset( $grpOptns['_grpFontSize'] ) ? $grpOptns['_grpFontSize'][0] : 'D';
    $grpFontColor = isset( $grpOptns['_grpFontColor'] ) ? $grpOptns['_grpFontColor'][0] : 'D';
    $upCase = isset( $grpOptns['_upCase'] ) ? $grpOptns['_upCase'][0] : 'N';
    $grpNameCustCls = isset( $grpOptns['_grpNameCustCls'] ) ? esc_attr( $grpOptns['_grpNameCustCls'][0] ) : '';

    abcfsl_mbox_tplate_field_section_hdr( 0, 365);

    $cboFontColor = abcfsl_cbo_filter_font_color();
    $cboYN = abcfsl_cbo_yn();
    $cboFont = abcfsl_cbo_font_size();
    $cboGrpItemML = abcfsl_cbo_menu_margin_left();

    echo abcfl_input_cbo_strings( 'grpItemML', '', $cboGrpItemML, $grpItemML, abcfsl_txta(16), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings( 'grpFontSize', '', $cboFont, $grpFontSize, abcfsl_txta(47), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings( 'grpFontColor', '', $cboFontColor, $grpFontColor, abcfsl_txta(91), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings( 'upCase', '', $cboYN, $upCase, abcfsl_txta(93), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    abcfsl_autil_css_section_class( 'grpNameCustCls', $grpNameCustCls, '' );
}

function abcfsl_mbox_groups_layout_item_hline( $grpOptns ){

    $grpHLine = isset( $grpOptns['_grpHLine'] ) ? esc_attr( $grpOptns['_grpHLine'][0] ) : '';    
    abcfsl_mbox_tplate_field_section_hdr( 72, 324);
    abcfsl_autil_css_section_class_custom_help( 'grpHLine', $grpHLine, 39, 0, '' );
}

//Top margin.
function abcfsl_mbox_groups_layout_margin_t( $fieldName, $fielValue, $help=0, $lbl=15 ){
    $cboMarginTop = abcfsl_cbo_menu_margins_tb();
    echo abcfl_input_cbo_strings($fieldName, '', $cboMarginTop, $fielValue, abcfsl_txta( $lbl ), abcfsl_txta( $help ), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}


