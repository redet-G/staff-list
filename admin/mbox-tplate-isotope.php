<?php
function abcfsl_mbox_tplate_isotope_optns( $tplateOptns ){

    echo  abcfl_html_tag('div','CN7','inside hidden abcflFadeIn');

        $imgsLoaded = isset( $tplateOptns['_imgsLoaded'] ) ? $tplateOptns['_imgsLoaded'][0]  : 0;
        $excludedSlugsIsotope = isset( $tplateOptns['_excludedSlugsIsotope'] ) ? esc_attr( $tplateOptns['_excludedSlugsIsotope'][0] ) : '';

        $cboImgsLoaded = abcfsl_cbo_images_loaded();
        //-----------------------------------------------------------------
        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL,  abcfsl_txta(192) . ' ' . abcfsl_txta(9), abcfsl_aurl(7) );

        echo abcfl_input_cbo('imgsLoaded', '',$cboImgsLoaded, $imgsLoaded, abcfsl_txta(136), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_txt('excludedSlugsIsotope', '', $excludedSlugsIsotope, abcfsl_txta(505), abcfsl_txta(0), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_html_tag_end('div');
}
