<?php
// ADDR
function abcfsl_mbox_item_ADDR( $tplateOptns, $itemOptns, $F, $showField ){

    //var_dump($itemOptns); //_adr5_F17
    if($showField == 0) { return ''; }
 
    $adr1 = isset( $itemOptns['_adr1_' . $F] ) ? esc_attr( $itemOptns['_adr1_' . $F][0] ) : '';
    $adr2 = isset( $itemOptns['_adr2_' . $F] ) ? esc_attr( $itemOptns['_adr2_' . $F][0] ) : '';
    $adr3 = isset( $itemOptns['_adr3_' . $F] ) ? esc_attr( $itemOptns['_adr3_' . $F][0] ) : '';
    $adr4 = isset( $itemOptns['_adr4_' . $F] ) ? esc_attr( $itemOptns['_adr4_' . $F][0] ) : '';
    $adr5 = isset( $itemOptns['_adr5_' . $F] ) ? esc_attr( $itemOptns['_adr5_' . $F][0] ) : '';
    $adr6 = isset( $itemOptns['_adr6_' . $F] ) ? esc_attr( $itemOptns['_adr6_' . $F][0] ) : '';

    //$txt11 = isset( $itemOptns['_txt_' . $F] ) ? esc_attr( $itemOptns['_txt_' . $F][0] ) : '';

    $lblAdr1 = isset( $tplateOptns['_inputLblAdr1_' . $F] ) ? esc_attr( $tplateOptns['_inputLblAdr1_' . $F][0] ) : '';
    $lblAdr2 = isset( $tplateOptns['_inputLblAdr2_' . $F] ) ? esc_attr( $tplateOptns['_inputLblAdr2_' . $F][0] ) : '';
    $lblAdr3 = isset( $tplateOptns['_inputLblAdr3_' . $F] ) ? esc_attr( $tplateOptns['_inputLblAdr3_' . $F][0] ) : '';
    $lblAdr4 = isset( $tplateOptns['_inputLblAdr4_' . $F] ) ? esc_attr( $tplateOptns['_inputLblAdr4_' . $F][0] ) : '';
    $lblAdr5 = isset( $tplateOptns['_inputLblAdr5_' . $F] ) ? esc_attr( $tplateOptns['_inputLblAdr5_' . $F][0] ) : '';
    $lblAdr6 = isset( $tplateOptns['_inputLblAdr6_' . $F] ) ? esc_attr( $tplateOptns['_inputLblAdr6_' . $F][0] ) : '';

    //------------------------------------------------
    $flexCntr = abcfl_html_tag( 'div', '', 'abcflFGCntr abcflFGCntr100' );
    $flex2ColS = abcfl_html_tag( 'div', '', 'abcflFG2Col' );   
    $divE = abcfl_html_tag_end( 'div'); 
    //------------------------------------------------ 

    $adr1T = abcfl_input_txt('adr1_' . $F, '', $adr1, $lblAdr1, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $adr2T = abcfl_input_txt('adr2_' . $F, '', $adr2, $lblAdr2, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $adrCity = abcfl_input_txt('adr3_' . $F, '', $adr3, $lblAdr3, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $adrState = abcfl_input_txt('adr4_' . $F, '', $adr4, $lblAdr4, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $adrZip = abcfl_input_txt('adr5_' . $F, '', $adr5, $lblAdr5, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $adrCountry = abcfl_input_txt('adr6_' . $F, '', $adr6, $lblAdr6, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    
    // All fields are disabled on Single Page. 
    if( $showField == 2 ) { 
        $adr1T = abcfl_input_txt_readonly('ro_adr1_' . $F, '', $adr1, $lblAdr1, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $adr2T = abcfl_input_txt_readonly('ro_adr2_' . $F, '', $adr2, $lblAdr2, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $adrCity = abcfl_input_txt_readonly('ro_adr3_' . $F, '', $adr3, $lblAdr3, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $adrState = abcfl_input_txt_readonly('ro_adr4_' . $F, '', $adr4, $lblAdr4, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $adrZip = abcfl_input_txt_readonly('ro_adr5_' . $F, '', $adr5, $lblAdr5, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $adrCountry = abcfl_input_txt_readonly('ro_adr6_' . $F, '', $adr6, $lblAdr6, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
     }
    
    $inputLbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
    $inputHlp = isset( $tplateOptns['_inputHlp_' . $F] ) ? esc_attr( $tplateOptns['_inputHlp_' . $F][0] ) : '';

    //----------------------------------------------------------------
    echo abcfl_input_hline('1', '10');
    echo abcfsl_autil_input_field_number( $F, $inputLbl, 5 );
    echo abcfl_input_hlp_lbl( $inputHlp );

    echo $flexCntr . $flex2ColS . $adr1T . $divE . $flex2ColS . $adr2T . abcfl_html_tag_ends( 'div,div' );
    echo $flexCntr . $flex2ColS . $adrCity . $divE . $flex2ColS . $adrState . abcfl_html_tag_ends( 'div,div' );
    echo $flexCntr . $flex2ColS . $adrZip . $divE . $flex2ColS . $adrCountry . abcfl_html_tag_ends( 'div,div' );
    echo abcfl_input_hline('1', '10');
}

function abcfsl_mbox_item_ADDRST( $tplateOptns, $itemOptns, $F, $showField ){
}