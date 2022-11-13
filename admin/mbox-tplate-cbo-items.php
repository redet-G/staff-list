<?php

function abcfsl_mbox_tplate_checkbox_items( $tplateOptns, $F ) {

    $cboValues = isset( $tplateOptns['_cboValues_' . $F] ) ? $tplateOptns['_cboValues_' . $F][0] : '';
    $cboValuesU = unserialize( $cboValues );
    
    echo abcfl_html_tag_cls( 'div', 'abcflFldCntr', false );
    abcfsl_mbox_tplate_cbo_items_option_values( $cboValuesU, $F );
    echo abcfl_html_tag_end( 'div' );
}

function abcfsl_mbox_tplate_cbo_items( $tplateOptns, $F ) {

    $cboValues = isset( $tplateOptns['_cboValues_' . $F] ) ? $tplateOptns['_cboValues_' . $F][0] : '';
    $cboFirstValue = isset( $tplateOptns['_cboFirstValue_' . $F] ) ? $tplateOptns['_cboFirstValue_' . $F][0] : '';
    $cboFirstTxt = isset( $tplateOptns['_cboFirstTxt_' . $F] ) ? $tplateOptns['_cboFirstTxt_' . $F][0] : '';
 
    //$cboValues: a:2:{i:0;s:9:"drodown-2";i:1;s:9:"drodown-1";}
    //$cboValuesU: Array
    //     [0] => drodown-2
    //     [1] => drodown-1
    $cboValuesU = unserialize( $cboValues );

    abcfsl_mbox_tplate_field_input_txt( 'cboFirstTxt_', $F, $cboFirstTxt, 272, 0 );
    abcfsl_mbox_tplate_field_input_txt( 'cboFirstValue_', $F, $cboFirstValue,  269, 0 );
    
    echo abcfl_html_tag_cls( 'div', 'abcflFldCntr', false );
    abcfsl_mbox_tplate_cbo_items_option_values( $cboValuesU, $F );
    echo abcfl_html_tag_end( 'div' );
}

function abcfsl_mbox_tplate_cbo_items_option_values( $cboValues, $F ) {

    $tblHead = abcfl_html_tag( 'table', 'slsTblCatSlugs' . $F, 'slsTblCatSlugs', 'width:50%;');
    $tblHead .= abcfl_html_tag_blank('thead');
    $tblHead .= abcfl_html_tag_blank('tr');
    $tblHead .= abcfl_html_tag_cls( 'th', 'abcflWidth10Pc', true ); 
    $tblHead .= abcfl_html_tag_cls( 'th', 'abcflWidth80Pc', true ); 
    $tblHead .= abcfl_html_tag_cls( 'th', 'abcflWidth10Pc', true ); 
    $tblHead .=  abcfl_html_tag_ends( 'tr,thead' );
    echo $tblHead;

    //Tbl rows
    if ( $cboValues ) {
        foreach ( $cboValues as $value ) {
            if( $value != '' ) { 
                echo abcfsl_mbox_tplate_cbo_items_option_row( $value, $F ); 
            }
        }
    }
	else {
            // show a blank one
            echo abcfsl_mbox_tplate_cbo_items_option_row( '', $F );
    }

    // empty hidden one for jQuery
    echo abcfsl_mbox_tplate_cbo_items_option_row( '', $F, 'screen-reader-text slsTrEmptyRowSlug' . $F );
    echo abcfl_html_tag_ends( 'tbody,table' );
    echo abcfl_html_tag_with_content('<a id="slsBtnAddRowSlug' . $F . '" class="button slsBtnAddRowSlug" data-id="' . $F .
    '" href="#"><span class="abcflFontW700 abcflFontS20">+</span></a>', 'p', '', '', '');
}

function abcfsl_mbox_tplate_cbo_items_option_row( $fieldValue, $F, $cls='' ){

    //<input name="cboValueF9[]" value="" style="width:100%;" type="text">

    $row = abcfl_html_tag( 'tr', '', $cls);
    $row .= abcfl_html_tag_with_content('<a class="button slsBtnRemoveRowSlug" href="#">X</a>', 'td', '', '', '' );
    $row .= abcfl_html_tag( 'td', '', '');
    $row .= abcfl_html_input_text( 'cboValues_'. $F . '[]', $fieldValue, $size='100%');
    $row .= abcfl_html_tag_end( 'td' );
    $row .= abcfl_html_tag( 'td', '', 'slsTdSortHandleSlug' );
    $row .= abcfl_html_img_tag('', ABCFSL_PLUGIN_URL . 'images/move-icon.png', 'Move Icon', '', 24, 24);
    $row .= abcfl_html_tag_end( 'td' );
    $row .= abcfl_html_tag_end( 'tr' );

    return $row;
}