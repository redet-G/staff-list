<?php
function abcfsl_mbox_item_social( $itemOptns, $tplateOptns ){

    //$hasSocial = isset( $tplateOptns['_hasSocial'] ) ? esc_attr( $tplateOptns['_hasSocial'][0] ) : 'N';
    //$socialSource = isset( $tplateOptns['_socialSource'] ) ? esc_attr( $tplateOptns['_socialSource'][0] ) : '32-70';
    $showSocial = isset( $tplateOptns['_showSocial'] ) ? $tplateOptns['_showSocial'][0] : 'N';
    $social1 = isset( $tplateOptns['_social1'] ) ? esc_attr( $tplateOptns['_social1'][0] ) : '';
    $social2 = isset( $tplateOptns['_social2'] ) ? esc_attr( $tplateOptns['_social2'][0] ) : '';
    $social3 = isset( $tplateOptns['_social3'] ) ? esc_attr( $tplateOptns['_social3'][0] ) : '';

    if( $social1 == '' ) { $social1 = abcfsl_txta(79,' 1'); } else { $social1 = abcfsl_txta(79,' 1 - ') . $social1; }
    if( $social2 == '' ) { $social2 = abcfsl_txta(79,' 2'); } else { $social2 = abcfsl_txta(79,' 2 - ') . $social2; }
    if( $social3 == '' ) { $social3 = abcfsl_txta(79,' 3'); } else { $social3 = abcfsl_txta(79,' 3 - ') . $social3; }

    $socialCntrLbl = isset( $tplateOptns['_socialCntrLbl'] ) ? esc_attr( $tplateOptns['_socialCntrLbl'][0] ) : abcfsl_txta(54);
    $socialCntrHlp= isset( $tplateOptns['_socialCntrHlp'] ) ? esc_attr( $tplateOptns['_socialCntrHlp'][0] ) : abcfsl_txta(219);

    $fbookUrl = isset( $itemOptns['_fbookUrl'] ) ? esc_attr( $itemOptns['_fbookUrl'][0] ) : '';
    $googlePlusUrl = isset( $itemOptns['_googlePlusUrl'] ) ? esc_attr( $itemOptns['_googlePlusUrl'][0] ) : '';
    $twitUrl = isset( $itemOptns['_twitUrl'] ) ? esc_attr( $itemOptns['_twitUrl'][0] ) : '';
    $likedUrl = isset( $itemOptns['_likedUrl'] ) ? esc_attr( $itemOptns['_likedUrl'][0] ) : '';
    //$instaUrl = isset( $itemOptns['_instaUrl'] ) ? esc_attr( $itemOptns['_instaUrl'][0] ) : '';
    $emailUrl = isset( $itemOptns['_emailUrl'] ) ? esc_attr( $itemOptns['_emailUrl'][0] ) : '';

    $socialC1Url = isset( $itemOptns['_socialC1Url'] ) ? esc_attr( $itemOptns['_socialC1Url'][0] ) : '';
    $socialC2Url = isset( $itemOptns['_socialC2Url'] ) ? esc_attr( $itemOptns['_socialC2Url'][0] ) : '';
    $socialC3Url = isset( $itemOptns['_socialC3Url'] ) ? esc_attr( $itemOptns['_socialC3Url'][0] ) : '';

    echo  abcfl_html_tag('div','','inside hidden');

    if ( $showSocial == 'N' ){
        //echo abcfl_input_info_lbl(abcfsl_txta(207), 'abcflMTop20', '14', 'SB');
        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(207), abcfsl_aurl(7) );
        echo abcfl_html_tag_end('div');
        return;

        //$socialCntrLbl = '';
        //$socialCntrHlp = '';
    }

    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, $socialCntrLbl, abcfsl_aurl(7) );

    //echo abcfl_input_info_lbl($socialCntrLbl, 'abcflMTop15', '14', 'SB');
    echo abcfl_input_info_lbl($socialCntrHlp, 'abcflMTop5', '12');

    echo abcfl_input_txt('fbookUrl', '', $fbookUrl, 'Facebook', '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('googlePlusUrl', '', $googlePlusUrl, 'Google+', '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('twitUrl', '', $twitUrl, 'Twitter', '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('likedUrl', '', $likedUrl, 'LinkedIn', '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    //echo abcfl_input_txt('instaUrl', '', $instaUrl, 'Instagram', '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('emailUrl', '', $emailUrl, 'Email', '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_input_txt('socialC1Url', '', $socialC1Url, $social1, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('socialC2Url', '', $socialC2Url, $social2, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('socialC3Url', '', $socialC3Url, $social3, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_html_tag_end('div');
}
