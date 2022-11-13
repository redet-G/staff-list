<?php
function abcfsl_mbox_tplate_staff( $tplateOptns ){

    echo  abcfl_html_tag('div','','inside');
    $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '0';
    $lstLayoutH = isset( $tplateOptns['_lstLayoutH'] ) ? esc_attr( $tplateOptns['_lstLayoutH'][0] ) : $lstLayout;

    $lstCntrW = isset( $tplateOptns['_lstCntrW'] ) ? esc_attr( $tplateOptns['_lstCntrW'][0] ) : '';
    $lstACenter = isset( $tplateOptns['_lstACenter'] ) ? esc_attr( $tplateOptns['_lstACenter'][0] ) : 'Y';
    //$lstCntrTM = isset( $tplateOptns['_lstCntrTM'] ) ? esc_attr( $tplateOptns['_lstCntrTM'][0] ) : '';
    $lstCntrCls = isset( $tplateOptns['_lstCntrCls'] ) ? esc_attr( $tplateOptns['_lstCntrCls'][0] ) : '';
    $lstCntrStyle = isset( $tplateOptns['_lstCntrStyle'] ) ? esc_attr( $tplateOptns['_lstCntrStyle'][0] ) : '';

    //-- ADD NEW Record Screen. Display only Add New Field cbo --------------------
    if($lstLayoutH == '0'){
        abcfsl_mbox_tplate_staff_list_layout( $lstLayout );
        echo abcfl_html_tag_end('div');
        return;
    }

    $lstCols = isset( $tplateOptns['_lstCols'] ) ? esc_attr( $tplateOptns['_lstCols'][0] ) : '6';
    $vAid = isset( $tplateOptns['_vAid'] ) ? esc_attr( $tplateOptns['_vAid'][0] ) : 'N';

    //---------------------------
    echo abcfl_input_hidden( '', 'lstLayoutH', $lstLayoutH );

    switch ($lstLayoutH) {
        case 1:
            abcfsl_mbox_tplate_staff_list( $lstCols, $lstCntrW, $lstCntrCls, $lstCntrStyle, 'layout-list.png', $lstACenter, $vAid );
            break;
        case 2:
            abcfsl_mbox_tplate_staff_grid_b();
            break;
        case 3:
            abcfsl_mbox_tplate_staff_grid_a();
            break;
        default:
            break;
    }
    echo abcfl_html_tag_end('div');
}

//=====================================================================
//Layout selection: Rows or Grid
function abcfsl_mbox_tplate_staff_list_layout( $lstLayout ){

    $cboLstLayout = abcfsl_cbo_staff_pg_layout();
    echo abcfl_input_cbo('lstLayout', '',$cboLstLayout, $lstLayout, abcfsl_txta(213), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_icon_cntr( ABCFSL_ICONS_URL, 'staff-list-layouts-free.png', 'abcflMTop20 abcflMLeft10' );
    echo abcfl_input_hlp_url( abcfsl_txta(11), abcfsl_aurl(25), 'abcflFontS20 abcflFontW600 abcflMTop20' );
}

//GRID A Content Container Style
function abcfsl_mbox_tplate_staff_grid_a(){
}

//GRID B Content Container Style
function abcfsl_mbox_tplate_staff_grid_b(){

}

//LIST Content Container Style
function abcfsl_mbox_tplate_staff_list( $lstCols, $lstCntrW, $lstCntrCls, $lstCntrStyle, $icon, $lstACenter, $vAid ){

    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL, $icon, abcfsl_txta(215), abcfsl_txta(116), abcfsl_aurl(26) );

    $cboCols = abcfsl_cbo_list_columns();
    echo abcfl_input_cbo('lstCols', '', $cboCols, $lstCols, abcfsl_txta_r(253), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('lstCntrW', '', $lstCntrW, abcfsl_txta(48), abcfsl_txta(260), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    abcfsl_util_center_yn( 'lstACenter', $lstACenter );

    abcfsl_autil_class_and_style( 'lstCntrCls', $lstCntrCls, 'lstCntrStyle', $lstCntrStyle, '', false, '1' );
    abcfsl_mbox_tplate_css_vaid( $vAid );
}

