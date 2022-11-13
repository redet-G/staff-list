<?php
function abcfsl_mbox_item_cats_STFFCAT( $staffID, $tplateOptns, $itemOptns, $F, $showField ){

    if($showField == 0) { return ''; }

    $staticTxt = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '';
    $inputLbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
    $inputHlp = isset( $tplateOptns['_inputHlp_' . $F] ) ? esc_attr( $tplateOptns['_inputHlp_' . $F][0] ) : '';
    $excludedSlugs = isset( $tplateOptns['_excludedSlugs_' . $F] ) ? esc_attr( $tplateOptns['_excludedSlugs_' . $F][0] ) : '';

    $inputLbl = abcfsl_mbox_item_text_line_number( $F , $inputLbl );
    $staffMCats = abcfsl_cnt_cats_staff_member( $staffID, $excludedSlugs );

    $dataL = abcfl_input_txt_readonly('ro_lblTxt_' . $F, '', $staticTxt, $F, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $dataR = abcfl_input_txt_readonly('ro_txt_' . $F, '', $staffMCats, $inputLbl, $inputHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfsl_mbox_item_input_two_fields( $dataL, $dataR );
}