<?php
function abcfsl_mbox_tplate_css( $tplateOptns, $clsPfix ){

  echo  abcfl_html_tag('div','','inside hidden');
  //echo  abcfl_html_tag('div','','inside');

    $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '0';
    $lstLayoutH = isset( $tplateOptns['_lstLayoutH'] ) ? esc_attr( $tplateOptns['_lstLayoutH'][0] ) : $lstLayout;

    $lstItemCls = isset( $tplateOptns['_lstItemCls'] ) ? esc_attr( $tplateOptns['_lstItemCls'][0] ) : '';
    $lstItemStyle = isset( $tplateOptns['_lstItemStyle'] ) ? esc_attr( $tplateOptns['_lstItemStyle'][0] ) : '';

    $imgBorder = isset( $tplateOptns['_imgBorder'] ) ? esc_attr( $tplateOptns['_imgBorder'][0] ) : 'D';
    $imgCenter = isset( $tplateOptns['_imgCenter'] ) ? esc_attr( $tplateOptns['_imgCenter'][0] ) : 'Y';
    $lstImgCls = isset( $tplateOptns['_lstImgCls'] ) ? esc_attr( $tplateOptns['_lstImgCls'][0] ) : '';
    $lstImgStyle = isset( $tplateOptns['_lstImgStyle'] ) ? esc_attr( $tplateOptns['_lstImgStyle'][0] ) : '';

    $lstTxtCntrCls = isset( $tplateOptns['_lstTxtCntrCls'] ) ? esc_attr( $tplateOptns['_lstTxtCntrCls'][0] ) : $clsPfix . 'PadLPc5';
    $lstTxtCntrStyle = isset( $tplateOptns['_lstTxtCntrStyle'] ) ? esc_attr( $tplateOptns['_lstTxtCntrStyle'][0] ) : '';
    //$addMaxW = isset( $tplateOptns['_addMaxW'] ) ? esc_attr( $tplateOptns['_addMaxW'][0] ) : 'N';

    switch ($lstLayoutH) {
        case 1:
            abcfsl_mbox_tplate_css_item_cntr_list( $lstItemCls, $lstItemStyle );
            //abcfsl_mbox_tplate_css_img_cntr( $imgBorder, $imgCenter, $lstImgCls, $lstImgStyle, 'staff-list-img-cntr.png', true );
            abcfsl_mbox_tplate_css_txt_cntr_list( $lstTxtCntrCls, $lstTxtCntrStyle );
            break;
        default:
            break;
    }
    //abcfsl_mbox_tplate_css_single_style( $spgCntrW, $spgCntrTM, $spgCntrCls, $spgCntrStyle);
    echo abcfl_html_tag_end('div');
}

//== LIST ===========================================================================
//LIST Item Container.
function abcfsl_mbox_tplate_css_item_cntr_list( $lstItemCls, $lstItemStyle ){
    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL, 'list-item-container.png', abcfsl_txta(301), '', '' );
    abcfsl_autil_class_and_style( 'lstItemCls', $lstItemCls, 'lstItemStyle', $lstItemStyle, '', false );
}

//LIST - Text Container.
function abcfsl_mbox_tplate_css_txt_cntr_list( $txtCntrCls, $txtCntrStyle ){
    echo abcfl_input_hline('2');
    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL, 'grid-b-text-container.png', abcfsl_txta(251), '', '' );
    abcfsl_autil_class_and_style( 'lstTxtCntrCls', $txtCntrCls, 'lstTxtCntrStyle', $txtCntrStyle, '', false, '', '', '', 252);
}
//== GENERIC ==============================================================


function abcfsl_mbox_tplate_css_vaid( $vAid ){

    $cboYN = abcfsl_cbo_yn();
    echo abcfl_input_cbo('lstVAid', '', $cboYN, $vAid, abcfsl_txta(248), abcfsl_txta(249), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}


