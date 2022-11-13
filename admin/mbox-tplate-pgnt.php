<?php
function abcfsl_mbox_tplate_pgnt( $tplateOptns ){

    echo  abcfl_html_tag('div','CN7','inside hidden abcflFadeIn');

        $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '0';
        $lstLayoutH = isset( $tplateOptns['_lstLayoutH'] ) ? esc_attr( $tplateOptns['_lstLayoutH'][0] ) : $lstLayout;
        if($lstLayoutH == '0'){
            echo abcfl_html_tag_end('div');
            return;
        }

        $pgnationPgQty = isset( $tplateOptns['_pgnationPgQty'] ) ? $tplateOptns['_pgnationPgQty'][0] : '';
        $pgnationPgsToShow = isset( $tplateOptns['_pgnationPgsToShow'] ) ? $tplateOptns['_pgnationPgsToShow'][0] : '10';
        $pgnationSize = isset( $tplateOptns['_pgnationSize'] ) ? $tplateOptns['_pgnationSize'][0] : 'MD';
        $pgnationJustify = isset( $tplateOptns['_pgnationJustify'] ) ? $tplateOptns['_pgnationJustify'][0] : 'E';
        $pgnationTB = isset( $tplateOptns['_pgnationTB'] ) ? $tplateOptns['_pgnationTB'][0] : 'B';
        if( $pgnationTB == 'TB' ) { $pgnationTB = 'B';}

        $pgnationColor = isset( $tplateOptns['_pgnationColor'] ) ? $tplateOptns['_pgnationColor'][0] : 'G';


        //Top location
        $pgnationTTM = isset( $tplateOptns['_pgnationTTM'] ) ? $tplateOptns['_pgnationTTM'][0] : '';
        $pgnationTBM = isset( $tplateOptns['_pgnationTBM'] ) ? $tplateOptns['_pgnationTBM'][0] : '';

        //Bottom location
        $pgnationBTM = isset( $tplateOptns['_pgnationBTM'] ) ? $tplateOptns['_pgnationBTM'][0] : '';
        $pgnationBBM = isset( $tplateOptns['_pgnationBBM'] ) ? $tplateOptns['_pgnationBBM'][0] : '';

        $pgnationCls = isset( $tplateOptns['_pgnationCls'] ) ? esc_attr( $tplateOptns['_pgnationCls'][0] ) : '';
        $pgnationStyle = isset( $tplateOptns['_pgnationStyle'] ) ? esc_attr( $tplateOptns['_pgnationStyle'][0] ) : '';

        $cboPgSize = abcfsl_cbo_pagination_size();
        $cboJustify = abcfsl_cbo_pagination_justify();
        $cboShow = abcfsl_cbo_pagination_show();
        $cboMTB = abcfsl_cbo_margin_t_b( false );

        $cboColors = abcfsl_cbo_pagination_colors();

        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(36), abcfsl_aurl(38) );

        echo abcfl_input_txt( 'pgnationPgQty', '', $pgnationPgQty, abcfsl_txta(37), abcfsl_txta(0), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );

        echo abcfl_input_txt( 'pgnationPgsToShow', '', $pgnationPgsToShow, abcfsl_txta(161), abcfsl_txta(7, ': 10.'), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
        echo abcfl_input_cbo('pgnationColor', '',$cboColors, $pgnationColor,  abcfsl_txta(149), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('pgnationSize', '',$cboPgSize, $pgnationSize, abcfsl_txta(132), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('pgnationJustify', '',$cboJustify, $pgnationJustify,  abcfsl_txta(163), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('pgnationTB', '',$cboShow, $pgnationTB,  abcfsl_txta(166), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');


        echo abcfl_input_hline('2');
        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(164) . ' ' . abcfsl_txta(166), abcfsl_aurl(0) );
        echo abcfl_input_cbo('pgnationTTM', '',$cboMTB, $pgnationTTM,  abcfsl_txta(15), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('pgnationTBM', '',$cboMTB, $pgnationTBM,  abcfsl_txta(89), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

        echo abcfl_input_hline('2');
        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(165) . ' ' . abcfsl_txta(166), abcfsl_aurl(0) );
        echo abcfl_input_cbo('pgnationBTM', '',$cboMTB, $pgnationBTM,  abcfsl_txta(15), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('pgnationBBM', '',$cboMTB, $pgnationBBM,  abcfsl_txta(89), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

        abcfsl_autil_css_section_class_style( 'pgnationCls', $pgnationCls, 'pgnationStyle', $pgnationStyle, '', '2' );

    echo abcfl_html_tag_end('div');
}