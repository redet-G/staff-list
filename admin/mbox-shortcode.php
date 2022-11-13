<?php
function abcfsl_mbox_shortcode_menu( $menuID, $menuType, $tabNo, $aurl=37 ) {

    //echo  abcfl_html_tag('div','','inside  hidden');
    echo  abcfl_html_tag('div','CN' . $tabNo,'inside hidden abcflFadeIn');
        $scode = abcfsl_mbox_shortcode_par_builder_menu( $menuID, $menuType );
        echo abcfl_input_txt_readonly('scode', '', $scode, abcfsl_txta(115),'', '50%', 'regular-text code abcflFontW700', '', 'abcflFldCntr abcflShortcode', 'abcflFldLbl');
        abcfsl_mbox_menu_shortcode_add_how_to( 196, $aurl );

    echo abcfl_html_tag_end('div');
}

function abcfsl_mbox_shortcode_group( $grpID, $grpType ) {

    echo  abcfl_html_tag('div','CN3','inside hidden abcflFadeIn');
        $scode = abcfsl_mbox_shortcode_par_builder_group( $grpID, $grpType );
        echo abcfl_input_txt_readonly('scode', '', $scode, abcfsl_txta(115),'', '50%', 'regular-text code abcflFontW700', '', 'abcflFldCntr abcflShortcode', 'abcflFldLbl');
        abcfsl_mbox_menu_shortcode_add_how_to( 373, 76 );

    echo abcfl_html_tag_end('div');
}

//-------------------------------------------------------------
function abcfsl_mbox_menu_shortcode_add_how_to( $txt, $aurl ) {

    echo abcfl_input_hline('1');
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta( $txt ), abcfsl_aurl( $aurl ), 'abcflFontWP abcflFontS16 abcflFontW600 abcflMTop20', '_blank', true);
}

function abcfsl_mbox_shortcode_par_builder_menu( $menuID, $menuType ) {

    $scode = 'menu-id="' . $menuType . $menuID . '"';
    $scode = esc_attr( $scode );
    return $scode;
}

function abcfsl_mbox_shortcode_par_builder_group ( $grpID, $grpType ) {

    $scode = 'group-id="' . $grpType  . '-' . $grpID . '"';
    $scode = esc_attr( $scode );
    return $scode;
}

// function abcfsl_mbox_menu_shortcode_par( $menuID, $menuType, $aurl=37 ) {

//     echo  abcfl_html_tag('div','','inside  hidden');
//         $scode = abcfsl_mbox_shortcode_par_builder_menu( $menuID, $menuType );

//         //echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(115), abcfsl_aurl(0) );

//         //$lbl = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(115), abcfsl_aurl(37), 'abcflFontWP abcflFontS13 abcflFontW400' );
//         echo abcfl_input_txt_readonly('scode', '', $scode, abcfsl_txta(115),'', '50%', 'regular-text code abcflFontW700', '', 'abcflFldCntr abcflShortcode', 'abcflFldLbl');
//         abcfsl_mbox_menu_shortcode_add_how_to( $aurl );

//     echo abcfl_html_tag_end('div');
// }


