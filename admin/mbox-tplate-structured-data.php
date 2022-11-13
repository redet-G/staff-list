<?php
function abcfsl_mbox_tplate_structured_data( $tplateOptns ) {

    //$sPageUrl = isset( $tplateOptns['_sPageUrl'] ) ? esc_attr( $tplateOptns['_sPageUrl'][0] ) : '';

    echo  abcfl_html_tag('div','CN11','inside  hidden');

        $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? $tplateOptns['_lstLayout'][0] : '0';
        $lstLayoutH = isset( $tplateOptns['_lstLayoutH'] ) ? $tplateOptns['_lstLayoutH'][0] : $lstLayout;
        if($lstLayoutH == '0'){
            echo abcfl_html_tag_end('div');
            return;
        }

        $sdType = isset( $tplateOptns['_sdType'] ) ? esc_attr( $tplateOptns['_sdType'][0] ) : '';

        //@id reference
        //$sdIDRProperty = isset( $tplateOptns['_sdIDRProperty'] ) ? esc_attr( $tplateOptns['_sdIDRProperty'][0] ) : '';
        //$sdIDRValue = isset( $tplateOptns['_sdIDRValue'] ) ? esc_attr( $tplateOptns['_sdIDRValue'][0] ) : '';

        $sdEmbededProperty = isset( $tplateOptns['_sdEmbededProperty'] ) ? esc_attr( $tplateOptns['_sdEmbededProperty'][0] ) : '';
        $sdEmbed1Type = isset( $tplateOptns['_sdEmbed1Type'] ) ? esc_attr( $tplateOptns['_sdEmbed1Type'][0] ) : '';
        $sdEmbed1Value = isset( $tplateOptns['_sdEmbed1Value'] ) ? esc_attr( $tplateOptns['_sdEmbed1Value'][0] ) : '';
        $sdEmbed2Type = isset( $tplateOptns['_sdEmbed2Type'] ) ? esc_attr( $tplateOptns['_sdEmbed2Type'][0] ) : '';
        $sdEmbed2Value = isset( $tplateOptns['_sdEmbed2Value'] ) ? esc_attr( $tplateOptns['_sdEmbed2Value'][0] ) : '';

        abcfsl_mbox_tplate_field_section_hdr( 46, 180, false);

        $lblType = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(181, ' (schema.org)'), 0, 'abcflFontWP abcflFontS12 abcflFontW400' );
        echo abcfl_input_txt('sdType', '', $sdType, $lblType, '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');

        abcfsl_mbox_tplate_field_section_hdr( 0, 184, true);


        echo abcfl_input_txt('sdEmbededProperty', '', $sdEmbededProperty, abcfsl_txta(184) . ' ' . abcfsl_txta(179), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_txt('sdEmbed1Type', '', $sdEmbed1Type, abcfsl_txta(179) . ' 1', '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_txt('sdEmbed1Value', '', $sdEmbed1Value, abcfsl_txta(183) . ' 1', '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_txt('sdEmbed2Type', '', $sdEmbed2Type, abcfsl_txta(179) . ' 2', '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_txt('sdEmbed2Value', '', $sdEmbed2Value, abcfsl_txta(183) . ' 2', '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');


    echo abcfl_html_tag_end('div');
}

//_sdProperty_
function abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F ){
    $lbl = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(179, ' (schema.org)'), '', 'abcflFontWP abcflFontS12 abcflFontW400' );

    abcfsl_mbox_tplate_field_section_hdr( 46, 180);
    echo abcfl_input_txt('sdProperty_' . $F, '', $sdProperty, $lbl, '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//_sdProperty_
function abcfsl_mbox_tplate_spg_optns_sd_property( $sdPropertySPTL ){
    $lbl = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(179, ' (schema.org)'), '', 'abcflFontWP abcflFontS12 abcflFontW400' );

    abcfsl_mbox_tplate_field_section_hdr( 46, 180);
    echo abcfl_input_txt('sdPropertySPTL', '', $sdPropertySPTL, $lbl, '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}


