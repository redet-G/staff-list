<?php
//Static label + Date. Data entry screen.
function abcfsl_mbox_item_date_SLDTE( $tplateOptns, $itemOptns, $F, $showField ){

    if($showField == 0) { return ''; }

    $staticTxt = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '';
    $inputLbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
    $inputHlp = isset( $tplateOptns['_inputHlp_' . $F] ) ? esc_attr( $tplateOptns['_inputHlp_' . $F][0] ) : '';
    $dteDisplayHlp = isset( $tplateOptns['_dteDisplayHlp_' . $F] ) ? esc_attr( $tplateOptns['_dteDisplayHlp_' . $F][0] ) : '';
    $dtFormat = isset( $tplateOptns['_dtFormat_' . $F] ) ? $tplateOptns['_dtFormat_' . $F][0] : '';

    // Meta key field.
    $dteYMD = isset( $itemOptns['_dteYMD_' . $F] ) ?  $itemOptns['_dteYMD_' . $F][0] : '';
    $dteFormatted = abcfsl_cnt_date_formated( $dteYMD, $dtFormat );

    $staticLblFieldNo = abcfsl_mbox_item_text_line_number( $F, $inputLbl . ' (' . abcfsl_txta(182) . ')' );
    $inputLbl = abcfsl_mbox_item_text_line_number( $F , $inputLbl );

    //----------------------------------------------------
    $flexCntrS = abcfl_html_tag( 'div', '', 'abcflFGCntr' );
    $flex4ColS = abcfl_html_tag( 'div', '', 'abcflFG4Col' );
    $divE = abcfl_html_tag_end( 'div');     

    $staticLbl_ro = abcfl_input_txt_readonly('ro_lblTxt_' . $F, '', $staticTxt, $staticLblFieldNo, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $dteYMD_input = abcfl_input_date('dteYMD_' . $F, '', $dteYMD, $inputLbl, $inputHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $dteDisplayedAs_ro = abcfl_input_txt_readonly('ro_dteOut_' . $F, '', $dteFormatted, $inputLbl, $dteDisplayHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $dteSavedAs_ro = abcfl_input_txt_readonly('ro_dteSaved_' . $F, '', $dteYMD, $inputLbl, abcfsl_txta(454), '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    
    //-- READ ONLY -----------
    if( $showField == 2 ) {
        echo $flexCntrS . 
        $flex4ColS . $staticLbl_ro . $divE . 
        $flex4ColS . $dteDisplayedAs_ro . $divE . 
        $flex4ColS . $dteDisplayedAs_ro . $divE .
        $flex4ColS . $dteSavedAs_ro .  
        abcfl_html_tag_ends( 'div,div');
        return ;        
     }

    //----------------------------------------------------
    echo $flexCntrS . 
    $flex4ColS . $staticLbl_ro . $divE . 
    $flex4ColS . $dteYMD_input . $divE . 
    $flex4ColS . $dteDisplayedAs_ro . $divE .
    $flex4ColS . $dteSavedAs_ro .  
    abcfl_html_tag_ends( 'div,div');
}