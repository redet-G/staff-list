<?php
//Static label + Phone. Data entry screen.
function abcfsl_mbox_item_fone_SLFONE( $tplateOptns, $itemOptns, $F, $showField ){

    if($showField == 0) { return ''; }

    $staticTxt = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '';
    $linkLblLbl = isset( $tplateOptns['_lnkLblLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkLblLbl_' . $F][0] ) : '';
    $linkLblHlp = isset( $tplateOptns['_lnkLblHlp_' . $F] ) ? esc_attr( $tplateOptns['_lnkLblHlp_' . $F][0] ) : '';
    $linkUrlLbl = isset( $tplateOptns['_lnkUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlLbl_' . $F][0] ) : '';
    $linkUrlHlp = isset( $tplateOptns['_lnkUrlHlp_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlHlp_' . $F][0] ) : '';

    $urlTxt = isset( $itemOptns['_urlTxt_' . $F] ) ? esc_attr( $itemOptns['_urlTxt_' . $F][0] ) : '';
    $url = isset( $itemOptns['_url_' . $F] ) ? esc_attr( $itemOptns['_url_' . $F][0] ) : '';

    $staticTxtFieldLbl = abcfsl_mbox_item_text_line_number( $F , '' );
    $linkLblLbl = abcfsl_mbox_item_text_line_number( $F , $linkLblLbl );
    $linkUrlLbl = abcfsl_mbox_item_text_line_number( $F , $linkUrlLbl );

    //----------------------------------------------------
    $flexCntrS = abcfl_html_tag( 'div', '', 'abcflFGCntr' );
    $flex3ColS = abcfl_html_tag( 'div', '', 'abcflFG3Col' );
    $divE = abcfl_html_tag_end( 'div');     

    $staticLblRO = abcfl_input_txt_readonly('ro_staticTxt_' . $F, '', $staticTxt, $staticTxtFieldLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    
    //-- READ ONLY ---------
    if( $showField == 2 ) {
        $urlTxtRO = abcfl_input_txt_readonly('ro_urlTxt_' . $F, '', $urlTxt, $linkLblLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $urlRO = abcfl_input_txt_readonly('ro_url_' . $F, '', $url, $linkUrlLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo $flexCntrS . $flex3ColS . $staticLblRO . $divE . $flex3ColS . $urlRO . $divE . $flex3ColS . $urlTxtRO . abcfl_html_tag_ends( 'div,div');
        return ;        
     }

     $urlTxt = abcfl_input_txt('urlTxt_' . $F, '', $urlTxt, $linkLblLbl, $linkLblHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
     $url = abcfl_input_txt('url_' . $F, '', $url, $linkUrlLbl, $linkUrlHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
     echo $flexCntrS . $flex3ColS . $staticLblRO . $divE . $flex3ColS . $urlTxt . $divE . $flex3ColS . $url . abcfl_html_tag_ends( 'div,div');
}

function abcfsl_mbox_item_fone_FONE( $tplateOptns, $itemOptns, $F, $showField ){

    if($showField == 0) { return ''; }

    $linkLblLbl = isset( $tplateOptns['_lnkLblLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkLblLbl_' . $F][0] ) : '';
    $linkLblHlp = isset( $tplateOptns['_lnkLblHlp_' . $F] ) ? esc_attr( $tplateOptns['_lnkLblHlp_' . $F][0] ) : '';
    $linkUrlLbl = isset( $tplateOptns['_lnkUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlLbl_' . $F][0] ) : '';
    $linkUrlHlp = isset( $tplateOptns['_lnkUrlHlp_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlHlp_' . $F][0] ) : '';

    $urlTxt = isset( $itemOptns['_urlTxt_' . $F] ) ? esc_attr( $itemOptns['_urlTxt_' . $F][0] ) : '';
    $url = isset( $itemOptns['_url_' . $F] ) ? esc_attr( $itemOptns['_url_' . $F][0] ) : '';

    $linkLblLbl = abcfsl_mbox_item_text_line_number( $F , $linkLblLbl );
    $linkUrlLbl = abcfsl_mbox_item_text_line_number( $F , $linkUrlLbl );

    //----------------------------------------------------
    $flexCntrS = abcfl_html_tag( 'div', '', 'abcflFGCntr' );
    $flex2ColS = abcfl_html_tag( 'div', '', 'abcflFG2Col' );
    $divE = abcfl_html_tag_end( 'div');     
    
    //-- READ ONLY ---------
    if( $showField == 2 ) {
        $urlTxtRO = abcfl_input_txt_readonly('ro_urlTxt_' . $F, '', $urlTxt, $linkLblLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $urlRO = abcfl_input_txt_readonly('ro_url_' . $F, '', $url, $linkUrlLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo $flexCntrS . $flex2ColS . $urlRO . $divE . $flex2ColS . $urlTxtRO . abcfl_html_tag_ends( 'div,div');
        return ;        
     }

     $urlTxt = abcfl_input_txt('urlTxt_' . $F, '', $urlTxt, $linkLblLbl, $linkLblHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
     $url = abcfl_input_txt('url_' . $F, '', $url, $linkUrlLbl, $linkUrlHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
     echo $flexCntrS . $flex2ColS . $urlTxt . $divE . $flex2ColS . $url . abcfl_html_tag_ends( 'div,div');
}
