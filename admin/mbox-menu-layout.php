<?php
function abcfsl_mbox_menu_layout( $tplateOptns ) {

    //echo  abcfl_html_tag('div','','inside');
    echo  abcfl_html_tag('div','CN1','inside');
        abcfsl_mbox_menu_layout_filters_cntr( $tplateOptns);
        abcfsl_mbox_menu_layout_filter_item( $tplateOptns );
    echo abcfl_html_tag_end('div');
}

//Filter items container
function abcfsl_mbox_menu_layout_filters_cntr( $tplateOptns ){

    $icon = 'menu-container.png';

    $fCntrW = isset( $tplateOptns['_fCntrW'] ) ? esc_attr( $tplateOptns['_fCntrW'][0] ) : '';
    $fCntrCenter = isset( $tplateOptns['_fCntrCenter'] ) ? esc_attr( $tplateOptns['_fCntrCenter'][0] ) : 'Y';
    $fItemsCenter = isset( $tplateOptns['_fItemsCenter'] ) ? esc_attr( $tplateOptns['_fItemsCenter'][0] ) : 'Y';
    $fItemsCntrMT = isset( $tplateOptns['_fItemsCntrMT'] ) ? esc_attr( $tplateOptns['_fItemsCntrMT'][0] ) : 'N';
    $fItemsCntrMB = isset( $tplateOptns['_fItemsCntrMB'] ) ? esc_attr( $tplateOptns['_fItemsCntrMB'][0] ) : 'N';

    // ADD
    //$fCntrCls = isset( $tplateOptns['_fCntrCls'] ) ? esc_attr( $tplateOptns['_fCntrCls'][0] ) : '';
    //$fCntrStyle = isset( $tplateOptns['_fCntrStyle'] ) ? esc_attr( $tplateOptns['_fCntrStyle'][0] ) : '';

    abcfsl_mbox_menu_layout_section_hdr( $icon , 88, 0, false );
    echo abcfl_input_txt('fCntrW', '', $fCntrW, abcfsl_txta(48), abcfsl_txta(260), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    abcfsl_util_center_yn( 'fCntrCenter', $fCntrCenter );
    abcfsl_util_center_yn( 'fItemsCenter', $fItemsCenter, 49,0 );

    echo abcfsl_mbox_menu_layout_margin_t( 'fItemsCntrMT', $fItemsCntrMT, 0, 15 );
    echo abcfsl_mbox_menu_layout_margin_t( 'fItemsCntrMB', $fItemsCntrMB, 0, 89 );
}

//Filter item
function abcfsl_mbox_menu_layout_filter_item( $tplateOptns ){

    //$fItemCls = isset( $tplateOptns['_fItemCls'] ) ? esc_attr( $tplateOptns['_fItemCls'][0] ) : '';
    //$fItemStyle = isset( $tplateOptns['_fItemStyle'] ) ? esc_attr( $tplateOptns['_fItemStyle'][0] ) : '';

    $fItemMLR = isset( $tplateOptns['_fItemMLR'] ) ? esc_attr( $tplateOptns['_fItemMLR'][0] ) : '10';
    $fItemFont = isset( $tplateOptns['_fItemFont'] ) ? esc_attr( $tplateOptns['_fItemFont'][0] ) : 'D';
    $fItemColor = isset( $tplateOptns['_fItemColor'] ) ? esc_attr( $tplateOptns['_fItemColor'][0] ) : 'D';
    $fItemHlight = isset( $tplateOptns['_fItemHlight'] ) ? esc_attr( $tplateOptns['_fItemHlight'][0] ) : 'N';
    $upCase = isset( $tplateOptns['_upCase'] ) ? esc_attr( $tplateOptns['_upCase'][0] ) : 'N';

    abcfsl_mbox_menu_layout_section_hdr( 'menu-item.png', 90, 0 );

    $cboFontColor = abcfsl_cbo_filter_font_color();
    $cboHlight = abcfsl_cbo_active_highlight();
    $cboYN = abcfsl_cbo_yn();
    $cboFont = abcfsl_cbo_font_size();
    $cboItemMLR = abcfsl_cbo_menu_item_margin_lr();

    echo abcfl_input_cbo_strings( 'fItemMLR', '', $cboItemMLR, $fItemMLR, abcfsl_txta(46), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings( 'fItemFont', '', $cboFont, $fItemFont, abcfsl_txta(47), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings('fItemColor', '', $cboFontColor, $fItemColor, abcfsl_txta(91), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings('fItemHlight', '', $cboHlight, $fItemHlight, abcfsl_txta(92), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings('upCase', '', $cboYN, $upCase, abcfsl_txta(93), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');

}

//Top margin.
function abcfsl_mbox_menu_layout_margin_t( $fieldName, $fielValue, $help=0, $lbl=15 ){

    $cboMarginTop = abcfsl_cbo_menu_margins_tb();
    echo abcfl_input_cbo_strings($fieldName, '', $cboMarginTop, $fielValue, abcfsl_txta( $lbl ), abcfsl_txta( $help ), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//Section header
function abcfsl_mbox_menu_layout_section_hdr( $iconName, $lblID, $helpID, $hline = true, $hlineH = '2' ){

    $src = ABCFSL_PLUGIN_URL . 'images/' . $iconName;

    if( $hline ){ echo abcfl_input_hline($hlineH); }

    echo abcfl_html_tag_cls(  'div', 'abcflPosRel', false );
    echo abcfl_html_tag( 'div', '', 'abcflFloatL abcflPTop2 abcflLineH1' );
        echo abcfl_html_img_tag('', $src, '', '');
    echo abcfl_html_tag_end('div');

    echo abcfl_html_tag( 'div', '', 'abcflFloatL abcflPLeft20' );
        echo abcfl_input_info_lbl(abcfsl_txta( $lblID ), 'abcflMTop10', 16, 'SB');
        echo abcfl_input_info_lbl(abcfsl_txta($helpID), 'abcflMTop5', 12, 'SB');
    echo abcfl_html_tag_end('div');

    echo abcfl_html_tag_cls(  'div', 'abcflClr', true );
    echo abcfl_html_tag_end('div');
}

