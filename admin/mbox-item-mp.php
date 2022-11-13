<?php
//Multipart.
function abcfsl_mbox_item_text_MP( $tplateOptns, $itemOptns, $F, $showField ){

    if($showField == 0) { return ''; }
    //return '';

    // All data is entered on Staff Page screen. Fields are not disabled on staff page even when used only on single.
    // All fields are disabled on Single Page. 
    $inputHlp = isset( $tplateOptns['_inputHlp_' . $F] ) ? esc_attr( $tplateOptns['_inputHlp_' . $F][0] ) : '';

    $mp1 = isset( $itemOptns['_mp1_' . $F] ) ? esc_attr( $itemOptns['_mp1_' . $F][0] ) : '';
    $mp2 = isset( $itemOptns['_mp2_' . $F] ) ? esc_attr( $itemOptns['_mp2_' . $F][0] ) : '';
    $mp3 = isset( $itemOptns['_mp3_' . $F] ) ? esc_attr( $itemOptns['_mp3_' . $F][0] ) : '';
    $mp4 = isset( $itemOptns['_mp4_' . $F] ) ? esc_attr( $itemOptns['_mp4_' . $F][0] ) : '';
    $mp5 = isset( $itemOptns['_mp5_' . $F] ) ? esc_attr( $itemOptns['_mp5_' . $F][0] ) : '';

    $inputLblP1 = abcfsl_mbox_item_text_line_number( $F , isset( $tplateOptns['_inputLblP1_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP1_' . $F][0] ) : '' );
    $inputLblP2 = abcfsl_mbox_item_text_line_number( $F , isset( $tplateOptns['_inputLblP2_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP2_' . $F][0] ) : '' );
    $inputLblP3 = abcfsl_mbox_item_text_line_number( $F , isset( $tplateOptns['_inputLblP3_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP3_' . $F][0] ) : '' );
    $inputLblP4 = abcfsl_mbox_item_text_line_number( $F , isset( $tplateOptns['_inputLblP4_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP4_' . $F][0] ) : '' );
    $inputLblP5 = abcfsl_mbox_item_text_line_number( $F , isset( $tplateOptns['_inputLblP5_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP5_' . $F][0] ) : '' );

    $orderLP1 = isset( $tplateOptns['_orderLP1_' . $F] ) ? $tplateOptns['_orderLP1_' . $F][0] : '0';
    $orderLP2 = isset( $tplateOptns['_orderLP2_' . $F] ) ? $tplateOptns['_orderLP2_' . $F][0] : '0';
    $orderLP3 = isset( $tplateOptns['_orderLP3_' . $F] ) ? $tplateOptns['_orderLP3_' . $F][0] : '0';
    $orderLP4 = isset( $tplateOptns['_orderLP4_' . $F] ) ? $tplateOptns['_orderLP4_' . $F][0] : '0';
    $orderLP5 = isset( $tplateOptns['_orderLP5_' . $F] ) ? $tplateOptns['_orderLP5_' . $F][0] : '0';

    $orderSP1 = isset( $tplateOptns['_orderSP1_' . $F] ) ? $tplateOptns['_orderSP1_' . $F][0] : '0';
    $orderSP2 = isset( $tplateOptns['_orderSP2_' . $F] ) ? $tplateOptns['_orderSP2_' . $F][0] : '0';
    $orderSP3 = isset( $tplateOptns['_orderSP3_' . $F] ) ? $tplateOptns['_orderSP3_' . $F][0] : '0';
    $orderSP4 = isset( $tplateOptns['_orderSP4_' . $F] ) ? $tplateOptns['_orderSP4_' . $F][0] : '0';
    $orderSP5 = isset( $tplateOptns['_orderSP5_' . $F] ) ? $tplateOptns['_orderSP5_' . $F][0] : '0';

    $isReadOnly1 = false;
    $isReadOnly2 = false;
    $isReadOnly3 = false;
    $isReadOnly4 = false;
    $isReadOnly5 = false;

    if( $orderSP1 == 0  && $orderLP1 == 0 ) { $isReadOnly1 = true; }
    if( $orderSP2 == 0  && $orderLP2 == 0 ) { $isReadOnly2 = true; }
    if( $orderSP3 == 0  && $orderLP3 == 0 ) { $isReadOnly3 = true; }
    if( $orderSP4 == 0  && $orderLP4 == 0 ) { $isReadOnly4 = true; }
    if( $orderSP5 == 0  && $orderLP5 == 0 ) { $isReadOnly5 = true; }

    //Inputs. Displayed always. Some may be read only.
    $f1 = abcfsl_mbox_item_multi_field_section( $isReadOnly1, '1', $mp1, $inputLblP1, $F, $showField);
    $f2 = abcfsl_mbox_item_multi_field_section( $isReadOnly2, '2', $mp2, $inputLblP2, $F, $showField);
    $f3 = abcfsl_mbox_item_multi_field_section( $isReadOnly3, '3', $mp3, $inputLblP3, $F, $showField);
    $f4 = abcfsl_mbox_item_multi_field_section( $isReadOnly4, '4', $mp4, $inputLblP4, $F, $showField);
    $f5 = abcfsl_mbox_item_multi_field_section( $isReadOnly5, '5', $mp5, $inputLblP5, $F, $showField);

    echo abcfsl_mbox_item_input_five_fields( $f1, $f2, $f3, $f4, $f5 );

    if( $showField != 2 ) { echo abcfl_input_hlp_lbl( $inputHlp , 'abcflMTop5'); }
}

function abcfsl_mbox_item_multi_field_section( $isReadOnly, $p, $mp, $inputLbl, $F, $showField){

    // All fields are disabled on Single Page. 
    if( $showField == 2 ) { $isReadOnly = true; }

    if( $isReadOnly ){
        return  abcfl_input_txt_readonly('ro_mp' . $p . '_' . $F, '', $mp, $inputLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    }
    else{
        return  abcfl_input_txt('mp' . $p . '_' . $F, '', $mp, $inputLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    }
}

function abcfsl_mbox_item_input_five_fields( $f1, $f2, $f3, $f4, $f5 ){

    $cntrS = abcfl_html_tag( 'div', '', 'abcflGridRow abcflGridGroup' );
    $cntrS1 = abcfl_html_tag( 'div', '', 'abcflGridCol abcflGridCol_1_of_5' );
    $cntrS2 = abcfl_html_tag( 'div', '', 'abcflGridCol abcflGridCol_1_of_5 abcflPLeft5' );
    $divE = abcfl_html_tag_end( 'div');

    //$clr = abcfl_html_tag_cls( 'div',  'abcflClr', true );
    $clr = '';

    $out = $cntrS .
           $cntrS1 . $f1 . $divE .
           $cntrS2 . $f2 . $divE .
           $cntrS2 . $f3 . $divE .
           $cntrS2 . $f4 . $divE .
           $cntrS2 . $f5 . $divE .
           $clr. $divE;

    return $out;
}

// function abcfsl_mbox_item_multi_field_section( $order, $p, $mp, $inputLbl, $F){

//     if( $order == 0 ){
//         return  abcfl_input_txt_readonly('ro_mp' . $p . '_' . $F, '', $mp, $inputLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
//     }
//     else{
//         return  abcfl_input_txt('mp' . $p . '_' . $F, '', $mp, $inputLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
//     }
// }


    // if( $orderSP1 != 0 ) { $orderLP1 = 1; }
    // if( $orderSP2 != 0 ) { $orderLP2 = 1; }
    // if( $orderSP3 != 0 ) { $orderLP3 = 1; }
    // if( $orderSP4 != 0 ) { $orderLP4 = 1; }
    // if( $orderSP5 != 0 ) { $orderLP5 = 1; }

    // $f1 = abcfsl_mbox_item_multi_field_section( $orderLP1, '1', $mp1, $inputLblP1, $F);
    // $f2 = abcfsl_mbox_item_multi_field_section( $orderLP2, '2', $mp2, $inputLblP2, $F);
    // $f3 = abcfsl_mbox_item_multi_field_section( $orderLP3, '3', $mp3, $inputLblP3, $F);
    // $f4 = abcfsl_mbox_item_multi_field_section( $orderLP4, '4', $mp4, $inputLblP4, $F);
    // $f5 = abcfsl_mbox_item_multi_field_section( $orderLP5, '5', $mp5, $inputLblP5, $F);

    // // All fields are disabled on Single Page. 
    // if( $showField == 2 ) {
    //     $f1 = abcfsl_mbox_item_multi_field_section( 0, '1', $mp1, $inputLblP1, $F);
    //     $f2 = abcfsl_mbox_item_multi_field_section( 0, '2', $mp2, $inputLblP2, $F);
    //     $f3 = abcfsl_mbox_item_multi_field_section( 0, '3', $mp3, $inputLblP3, $F);
    //     $f4 = abcfsl_mbox_item_multi_field_section( 0, '4', $mp4, $inputLblP4, $F);
    //     $f5 = abcfsl_mbox_item_multi_field_section( 0, '5', $mp5, $inputLblP5, $F);
    // }
