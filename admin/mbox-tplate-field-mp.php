<?php
function abcfsl_mbox_tplate_field_mp( $tplateOptns, $F ){

    $inputLblP1 = isset( $tplateOptns['_inputLblP1_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP1_' . $F][0] ) : '';
    $inputLblP2 = isset( $tplateOptns['_inputLblP2_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP2_' . $F][0] ) : '';
    $inputLblP3 = isset( $tplateOptns['_inputLblP3_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP3_' . $F][0] ) : '';
    $inputLblP4 = isset( $tplateOptns['_inputLblP4_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP4_' . $F][0] ) : '';
    $inputLblP5 = isset( $tplateOptns['_inputLblP5_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP5_' . $F][0] ) : '';
    
    $orderLP1 = isset( $tplateOptns['_orderLP1_' . $F] ) ?  $tplateOptns['_orderLP1_' . $F][0] : '0';
    $orderLP2 = isset( $tplateOptns['_orderLP2_' . $F] ) ?  $tplateOptns['_orderLP2_' . $F][0] : '0';
    $orderLP3 = isset( $tplateOptns['_orderLP3_' . $F] ) ?  $tplateOptns['_orderLP3_' . $F][0] : '0';
    $orderLP4 = isset( $tplateOptns['_orderLP4_' . $F] ) ?  $tplateOptns['_orderLP4_' . $F][0] : '0';
    $orderLP5 = isset( $tplateOptns['_orderLP5_' . $F] ) ?  $tplateOptns['_orderLP5_' . $F][0] : '0';

    $orderSP1 = isset( $tplateOptns['_orderSP1_' . $F] ) ?  $tplateOptns['_orderSP1_' . $F][0] : '0';
    $orderSP2 = isset( $tplateOptns['_orderSP2_' . $F] ) ?  $tplateOptns['_orderSP2_' . $F][0] : '0';
    $orderSP3 = isset( $tplateOptns['_orderSP3_' . $F] ) ?  $tplateOptns['_orderSP3_' . $F][0] : '0';
    $orderSP4 = isset( $tplateOptns['_orderSP4_' . $F] ) ?  $tplateOptns['_orderSP4_' . $F][0] : '0';
    $orderSP5 = isset( $tplateOptns['_orderSP5_' . $F] ) ?  $tplateOptns['_orderSP5_' . $F][0] : '0';

    $sfixLP1 = isset( $tplateOptns['_sfixLP1_' . $F] ) ? esc_attr( $tplateOptns['_sfixLP1_' . $F][0] ) : '';
    $sfixLP2 = isset( $tplateOptns['_sfixLP2_' . $F] ) ? esc_attr( $tplateOptns['_sfixLP2_' . $F][0] ) : '';
    $sfixLP3 = isset( $tplateOptns['_sfixLP3_' . $F] ) ? esc_attr( $tplateOptns['_sfixLP3_' . $F][0] ) : '';
    $sfixLP4 = isset( $tplateOptns['_sfixLP4_' . $F] ) ? esc_attr( $tplateOptns['_sfixLP4_' . $F][0] ) : '';
    $sfixLP5 = isset( $tplateOptns['_sfixLP5_' . $F] ) ? esc_attr( $tplateOptns['_sfixLP5_' . $F][0] ) : '';

    $sfixSP1 = isset( $tplateOptns['_sfixSP1_' . $F] ) ? esc_attr( $tplateOptns['_sfixSP1_' . $F][0] ) : '';
    $sfixSP2 = isset( $tplateOptns['_sfixSP2_' . $F] ) ? esc_attr( $tplateOptns['_sfixSP2_' . $F][0] ) : '';
    $sfixSP3 = isset( $tplateOptns['_sfixSP3_' . $F] ) ? esc_attr( $tplateOptns['_sfixSP3_' . $F][0] ) : '';
    $sfixSP4 = isset( $tplateOptns['_sfixSP4_' . $F] ) ? esc_attr( $tplateOptns['_sfixSP4_' . $F][0] ) : '';
    $sfixSP5 = isset( $tplateOptns['_sfixSP5_' . $F] ) ? esc_attr( $tplateOptns['_sfixSP5_' . $F][0] ) : '';

    $pfixLP1 = isset( $tplateOptns['_pfixLP1_' . $F] ) ? esc_attr( $tplateOptns['_pfixLP1_' . $F][0] ) : '';
    $pfixLP2 = isset( $tplateOptns['_pfixLP2_' . $F] ) ? esc_attr( $tplateOptns['_pfixLP2_' . $F][0] ) : '';
    $pfixLP3 = isset( $tplateOptns['_pfixLP3_' . $F] ) ? esc_attr( $tplateOptns['_pfixLP3_' . $F][0] ) : '';
    $pfixLP4 = isset( $tplateOptns['_pfixLP4_' . $F] ) ? esc_attr( $tplateOptns['_pfixLP4_' . $F][0] ) : '';
    $pfixLP5 = isset( $tplateOptns['_pfixLP5_' . $F] ) ? esc_attr( $tplateOptns['_pfixLP5_' . $F][0] ) : '';

    $pfixSP1 = isset( $tplateOptns['_pfixSP1_' . $F] ) ? esc_attr( $tplateOptns['_pfixSP1_' . $F][0] ) : '';
    $pfixSP2 = isset( $tplateOptns['_pfixSP2_' . $F] ) ? esc_attr( $tplateOptns['_pfixSP2_' . $F][0] ) : '';
    $pfixSP3 = isset( $tplateOptns['_pfixSP3_' . $F] ) ? esc_attr( $tplateOptns['_pfixSP3_' . $F][0] ) : '';
    $pfixSP4 = isset( $tplateOptns['_pfixSP4_' . $F] ) ? esc_attr( $tplateOptns['_pfixSP4_' . $F][0] ) : '';
    $pfixSP5 = isset( $tplateOptns['_pfixSP5_' . $F] ) ? esc_attr( $tplateOptns['_pfixSP5_' . $F][0] ) : '';

    $inputHlp = isset( $tplateOptns['_inputHlp_' . $F] ) ? esc_attr( $tplateOptns['_inputHlp_' . $F][0] ) : '';
    //-----------------------------------------------------------------------------------------

    echo abcfsl_mbox_tplate_field_MP_fields( '1', $F, $inputLblP1, $orderLP1, $sfixLP1, $orderSP1, $sfixSP1, $pfixLP1, $pfixSP1 );
    echo abcfsl_mbox_tplate_field_MP_fields( '2', $F, $inputLblP2, $orderLP2, $sfixLP2, $orderSP2, $sfixSP2, $pfixLP2, $pfixSP2 );
    echo abcfsl_mbox_tplate_field_MP_fields( '3', $F, $inputLblP3, $orderLP3, $sfixLP3, $orderSP3, $sfixSP3, $pfixLP3, $pfixSP3 );
    echo abcfsl_mbox_tplate_field_MP_fields( '4', $F, $inputLblP4, $orderLP4, $sfixLP4, $orderSP4, $sfixSP4, $pfixLP4, $pfixSP4 );
    echo abcfsl_mbox_tplate_field_MP_fields( '5', $F, $inputLblP5, $orderLP5, $sfixLP5, $orderSP5, $sfixSP5, $pfixLP5, $pfixSP5 );
    
    //echo abcfl_input_info_lbl(abcfsl_txta(126), 'abcflMTop10', '12', 'N');
    echo abcfl_input_txt('inputHlp_' . $F, '', $inputHlp, abcfsl_txta(209), abcfsl_txta(257), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//== Render MP field.
function  abcfsl_mbox_tplate_field_MP_fields( $partNo, $F, $inputLbl, $orderLP, $sfixLP, $orderSP, $sfixSP, $pfixLP, $pfixSP ){   

    $divE = abcfl_html_tag_end( 'div');
    $cbo123 = abcfsl_cbo_0_5();  

    $out = abcfl_html_tag( 'div', '', 'abcflMPFrmGrpWrap' );
    //-----------------------------
    $out .= abcfl_html_tag( 'div', '', 'abcflMPFrmGrp' );
    $out .= abcfl_input_lbl( 'inputLblP' . $partNo . '_' . $F, $partNo . '. ' . abcfsl_txta(208) );
    $out .= abcfl_input_txt_simple('inputLblP' . $partNo . '_' . $F, '', $inputLbl, 'abcflMPInputFL');
    $out .= $divE;
    //-----------------------------
    $out .= abcfl_html_tag( 'div', '', 'abcflMPFrmGrp' );
    $out .= abcfl_input_lbl( 'pfixLP' . $partNo . '_' . $F, $partNo . '. ' . abcfsl_txta(124) ); //
    $out .= abcfl_input_txt_simple('pfixLP' . $partNo . '_' . $F, '', $pfixLP, 'abcflMPPfixLP');
    $out .= abcfl_input_txt_simple('sfixLP' . $partNo . '_' . $F, '', $sfixLP, 'abcflMPPfixSP');
    $out .= $divE;
    //-- Single Page - Prefix/Suffix ---------------------------
    $out .= abcfl_html_tag( 'div', '', 'abcflMPFrmGrp' );
    $out .= abcfl_input_lbl( 'pfixSP' . $partNo . '_' . $F, $partNo . '. ' . abcfsl_txta(334) ); 
    $out .= abcfl_input_txt_simple('pfixSP' . $partNo . '_' . $F, '', $pfixSP, 'abcflMPPfixLP');
    $out .= abcfl_input_txt_simple('sfixSP' . $partNo . '_' . $F, '', $sfixSP, 'abcflMPPfixSP');
    $out .= $divE;    
    //-- Field Order - Staff Page/Single Page-------------------------
    $out .= abcfl_html_tag( 'div', '', 'abcflMPFrmGrp' );
    $out .= abcfl_input_lbl( 'orderLP' . $partNo . '_' . $F, $partNo . '. ' . abcfsl_txta(336) ); 
    $out .= abcfl_input_cbo_simple('orderLP' . $partNo . '_' . $F, '', $cbo123,  $orderLP, 'abcflMPOrderLP');
    $out .= abcfl_input_cbo_simple('orderSP' . $partNo . '_' . $F, '', $cbo123,  $orderSP, 'abcflMPOrderSP');
    $out .= $divE;
    //-----------------------------
    $out .= $divE;

    return $out;
}