<?php
// ADDR
function abcfsl_mbox_tplate_addr( $tplateOptns, $F, $lblTxt, $inputLbl, $inputHlp, $showField, $hideDelete, $fieldCntrSPg, $sdProperty ){

    abcfsl_mbox_tplate_field_input_static_lbl( $lblTxt, $F, 275, '', false );            
    abcfsl_mbox_tplate_addr_lbls( $tplateOptns, $F, $inputLbl, $inputHlp );
    //------------------------------------------------
    abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
    abcfsl_mbox_tplate_field_field_style_compact_static_lbl_above( $tplateOptns, $F );
    //------------------------------------------------
    abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
}

function abcfsl_mbox_tplate_addr_lbls( $tplateOptns, $F, $inputLbl, $inputHlp ){
        
        $adr1 = isset( $tplateOptns['_inputLblAdr1_' . $F] ) ? esc_attr( $tplateOptns['_inputLblAdr1_' . $F][0] ) : abcfsl_txta(417);
        $adr2 = isset( $tplateOptns['_inputLblAdr2_' . $F] ) ? esc_attr( $tplateOptns['_inputLblAdr2_' . $F][0] ) : abcfsl_txta(427);
        $adr3 = isset( $tplateOptns['_inputLblAdr3_' . $F] ) ? esc_attr( $tplateOptns['_inputLblAdr3_' . $F][0] ) : abcfsl_txta(426);
        $adr4 = isset( $tplateOptns['_inputLblAdr4_' . $F] ) ? esc_attr( $tplateOptns['_inputLblAdr4_' . $F][0] ) : abcfsl_txta(423);
        $adr5 = isset( $tplateOptns['_inputLblAdr5_' . $F] ) ? esc_attr( $tplateOptns['_inputLblAdr5_' . $F][0] ) : abcfsl_txta(424);
        $adr6 = isset( $tplateOptns['_inputLblAdr6_' . $F] ) ? esc_attr( $tplateOptns['_inputLblAdr6_' . $F][0] ) : abcfsl_txta(425);

        //------------------------------------------------
        $flexCntr = abcfl_html_tag( 'div', '', 'abcflFGCntr abcflFGCntr50' );
        $flex2ColS = abcfl_html_tag( 'div', '', 'abcflFG2Col' );   
        $divE = abcfl_html_tag_end( 'div'); 
        //------------------------------------------------    
        $adr1 = abcfl_input_txt('inputLblAdr1_' . $F, '', $adr1, abcfsl_txta_r(417), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $adr2 = abcfl_input_txt('inputLblAdr2_' . $F, '', $adr2, abcfsl_txta_r(418), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $adrCity = abcfl_input_txt('inputLblAdr3_' . $F, '', $adr3, abcfsl_txta_r(419), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $adrState = abcfl_input_txt('inputLblAdr4_' . $F, '', $adr4, abcfsl_txta_r(420), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $adrZip = abcfl_input_txt('inputLblAdr5_' . $F, '', $adr5, abcfsl_txta_r(421), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $adrCountry = abcfl_input_txt('inputLblAdr6_' . $F, '', $adr6, abcfsl_txta_r(422), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        //--------------------------------------------------------------------------------
        echo abcfl_input_hline('2', '20');
        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(319), abcfsl_aurl(87) );
        echo abcfl_input_txt( 'inputLbl_' . $F, '', $inputLbl, abcfsl_txta_r(208), abcfsl_txta(282), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo $flexCntr . $flex2ColS . $adr1 . $divE . $flex2ColS . $adr2 . abcfl_html_tag_ends( 'div,div' );
        echo $flexCntr . $flex2ColS . $adrCity . $divE . $flex2ColS . $adrState . abcfl_html_tag_ends( 'div,div' );
        echo $flexCntr . $flex2ColS . $adrZip . $divE . $flex2ColS . $adrCountry . abcfl_html_tag_ends( 'div,div' );

        echo abcfl_input_txt( 'inputHlp_' . $F, '', $inputHlp, abcfsl_txta(209), abcfsl_txta(257), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    }

//==========================================================
function abcfsl_mbox_tplate_addrst( $tplateOptns, $F, $lblTxt, $inputLbl, $inputHlp, $showField, $hideDelete, $fieldCntrSPg ){
    abcfsl_mbox_tplate_field_input_static_lbl( $lblTxt, $F, 275, '', true );            

}