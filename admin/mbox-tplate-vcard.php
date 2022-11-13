<?php

// === VCARDHL ==============================
function abcfsl_mbox_tplate_vcardhl( $tplateOptns, $F, $lblTxt, $inputLbl, $inputHlp, $showField, $hideDelete, $fieldCntrSPg ){

    if( !abcfsl_util_vcard_plugin_installed() ) {
        $cls = 'abcflFontWP abcflFontS18 abcflFontW600 abcflMTop10 abcflRed';
        echo abcfl_input_sec_title( abcfsl_txta(416), $cls );
        abcfsl_mbox_tplate_field_hide_delete( $hideDelete, $F );
        return;
    }

    $vcTplateID = isset( $tplateOptns['_vcTplateID_' . $F] ) ?  $tplateOptns['_vcTplateID_' . $F][0] : 0;
    $slTplateID = isset( $tplateOptns['slTplateID'] ) ? $tplateOptns['slTplateID'] : 0;

    abcfsl_mbox_tplate_vcard_tplates( $slTplateID, $vcTplateID, $F );
    abcfsl_mbox_tplate_field_input_static_lbl( $lblTxt, $F, 259, '', true );            
    //abcfsl_mbox_tplate_field_section_hdr_input_field_default();
    //abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 208, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );
    echo abcfsl_mbox_autil_input_txt_help_link( 'inputLbl_', $F, $inputLbl, 208, 282, 33 );
    //------------------------------------------------
    abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
    abcfsl_mbox_tplate_field_field_style_compact_default( $tplateOptns, $F );

}

function abcfsl_mbox_tplate_vcard_tplates( $slTplateID, $vcTplateID, $F ){

    $cbo = abcfsl_db_cbo_vcard_tplates( $slTplateID, 'VC' );

    //echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(320), abcfsl_aurl(13) );
    echo abcfl_input_cbo('vcTplateID_' . $F, '', $cbo, $vcTplateID, abcfsl_txta_r(410), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}  

// VCARD
function abcfsl_mbox_tplate_vcard( $tplateOptns, $F, $lblTxt, $inputLbl, $inputHlp, $showField, $hideDelete, $fieldCntrSPg ){

        $cls = 'abcflFontWP abcflFontS18 abcflFontW600 abcflMTop10 abcflRed';
        $txt = 'Discontinued field.';
        echo abcfl_input_sec_title( $txt, $cls );
        abcfsl_mbox_tplate_field_hide_delete( $hideDelete, $F );
}

function abcfsl_mbox_tplate_QRIMGCAP64STA( $tplateOptns, $F ){

    $hideDelete = isset( $tplateOptns['_hideDelete_' . $F] ) ? esc_attr( $tplateOptns['_hideDelete_' . $F][0] ) : 'N';
    
    if( !abcfsl_util_vcard_plugin_installed() ) {
        $cls = 'abcflFontWP abcflFontS18 abcflFontW600 abcflMTop10 abcflRed';
        echo abcfl_input_sec_title( abcfsl_txta(416), $cls );
        abcfsl_mbox_tplate_field_hide_delete( $hideDelete, $F );
        return;
    }

    $slTplateID = isset( $tplateOptns['slTplateID'] ) ? $tplateOptns['slTplateID'] : 0;
    $statCaption = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '';
    $statAlt = isset( $tplateOptns['_statAlt_' . $F] ) ? esc_attr( $tplateOptns['_statAlt_' . $F][0] ) : '';

    $inputLblStatCap = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
    $inputLblDynCap = isset( $tplateOptns['_inputLblDynCap_' . $F] ) ? esc_attr( $tplateOptns['_inputLblDynCap_' . $F][0] ) : '';
    $inputLblStatAlt = isset( $tplateOptns['_inputLblStatAlt_' . $F] ) ? esc_attr( $tplateOptns['_inputLblStatAlt_' . $F][0] ) : '';
    $inputLblDynAlt = isset( $tplateOptns['_inputLblDynAlt_' . $F] ) ? esc_attr( $tplateOptns['_inputLblDynAlt_' . $F][0] ) : '';

    $inputHlp = isset( $tplateOptns['_inputHlp_' . $F] ) ? esc_attr( $tplateOptns['_inputHlp_' . $F][0] ) : '';

    $showField = isset( $tplateOptns['_showField_' . $F] ) ? $tplateOptns['_showField_' . $F][0] : 'L';
    $fieldCntrSPg = isset( $tplateOptns['_fieldCntrSPg_' . $F] ) ? esc_attr( $tplateOptns['_fieldCntrSPg_' . $F][0] ) : 'M';

    $vcTplateID = isset( $tplateOptns['_vcTplateID_' . $F] ) ?  $tplateOptns['_vcTplateID_' . $F][0] : 0;
    //---------------------------------------------------------------------------------------------
    abcfsl_mbox_tplate_vcard_qrcode_tplates( $slTplateID, $vcTplateID, $F ); 
    abcfsl_mbox_tplate_field_input_txt( 'lblTxt_', $F, $statCaption, 443, 270 );
    abcfsl_mbox_tplate_field_input_txt( 'statAlt_', $F, $statAlt, 444, 270 );
    //--------------------------------------------------------------------------------------------- 
    echo abcfl_input_hline('2', '20');
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(319), abcfsl_aurl(33) );  
    echo abcfsl_mbox_autil_input_txt( 'inputLbl_', $F, $inputLblStatCap, 443, 282 );
    echo abcfsl_mbox_autil_input_txt( 'inputLblDynCap_', $F, $inputLblDynCap, 445, 282 );
    echo abcfsl_mbox_autil_input_txt( 'inputLblStatAlt_', $F, $inputLblStatAlt, 444, 282 );
    echo abcfsl_mbox_autil_input_txt( 'inputLblDynAlt_', $F, $inputLblDynAlt, 446, 282 );
    echo abcfsl_mbox_autil_input_txt( 'inputHlp_', $F, $inputHlp, 162, 257 );
    //------------------------------------------------
    abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );    
}

//============================================================================

function abcfsl_mbox_tplate_vcard_qrcode_tplates( $slTplateID, $vcTplateID, $F ){

    $cbo = abcfsl_db_cbo_vcard_tplates( $slTplateID, 'QR' );
 
    //echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(320), abcfsl_aurl(13) );
    echo abcfl_input_cbo('vcTplateID_' . $F, '', $cbo, $vcTplateID, abcfsl_txta_r(410), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//### DISCONTINUED DELETE LATER ######################################################
function abcfsl_mbox_tplate_qrhl64sta( $tplateOptns, $F ){

    $hideDelete = isset( $tplateOptns['_hideDelete_' . $F] ) ? esc_attr( $tplateOptns['_hideDelete_' . $F][0] ) : 'N';
    
    if( !abcfsl_util_vcard_plugin_installed() ) {
        $cls = 'abcflFontWP abcflFontS18 abcflFontW600 abcflMTop10 abcflRed';
        echo abcfl_input_sec_title( abcfsl_txta(416), $cls );
        abcfsl_mbox_tplate_field_hide_delete( $hideDelete, $F );
        return;
    }

    $slTplateID = isset( $tplateOptns['slTplateID'] ) ? $tplateOptns['slTplateID'] : 0;
    $lblTxt = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '';
    $inputLbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
    $inputHlp = isset( $tplateOptns['_inputHlp_' . $F] ) ? esc_attr( $tplateOptns['_inputHlp_' . $F][0] ) : '';
    $lnkNT = isset( $tplateOptns['_lnkNT_' . $F] ) ? $tplateOptns['_lnkNT_' . $F][0] : '0';

    $showField = isset( $tplateOptns['_showField_' . $F] ) ? $tplateOptns['_showField_' . $F][0] : 'L';
    $fieldCntrSPg = isset( $tplateOptns['_fieldCntrSPg_' . $F] ) ? esc_attr( $tplateOptns['_fieldCntrSPg_' . $F][0] ) : 'M';

    $vcTplateID = isset( $tplateOptns['_vcTplateID_' . $F] ) ?  $tplateOptns['_vcTplateID_' . $F][0] : 0;

    abcfsl_mbox_tplate_vcard_qrcode_tplates( $slTplateID, $vcTplateID, $F );
    abcfsl_mbox_tplate_field_input_static_lbl( $lblTxt, $F, 259, '', true );            
    echo abcfsl_mbox_autil_input_txt_help_link( 'inputLbl_', $F, $inputLbl, 208, 282, 33 );
    echo abcfl_input_checkbox('lnkNT_'. $F,  '', $lnkNT, abcfsl_txta(143), '', '', '', 'abcflFldCntr', '', '', '' );

    //------------------------------------------------
    abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
    abcfsl_mbox_tplate_field_field_style_compact_default( $tplateOptns, $F );
}

function abcfsl_mbox_tplate_qrhl64dyn( $tplateOptns, $F ){

    $hideDelete = isset( $tplateOptns['_hideDelete_' . $F] ) ? esc_attr( $tplateOptns['_hideDelete_' . $F][0] ) : 'N';

    if( !abcfsl_util_vcard_plugin_installed() ) {
        $cls = 'abcflFontWP abcflFontS18 abcflFontW600 abcflMTop10 abcflRed';
        echo abcfl_input_sec_title( abcfsl_txta(416), $cls );
        abcfsl_mbox_tplate_field_hide_delete( $hideDelete, $F );
        return;
    }

    $slTplateID = isset( $tplateOptns['slTplateID'] ) ? $tplateOptns['slTplateID'] : 0;
    $lblTxt = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '';
    $inputLbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
    $inputHlp = isset( $tplateOptns['_inputHlp_' . $F] ) ? esc_attr( $tplateOptns['_inputHlp_' . $F][0] ) : '';
    $lnkNT = isset( $tplateOptns['_lnkNT_' . $F] ) ? $tplateOptns['_lnkNT_' . $F][0] : '0';

    $showField = isset( $tplateOptns['_showField_' . $F] ) ? $tplateOptns['_showField_' . $F][0] : 'L';
    $fieldCntrSPg = isset( $tplateOptns['_fieldCntrSPg_' . $F] ) ? esc_attr( $tplateOptns['_fieldCntrSPg_' . $F][0] ) : 'M';

    $vcTplateID = isset( $tplateOptns['_vcTplateID_' . $F] ) ?  $tplateOptns['_vcTplateID_' . $F][0] : 0;

    abcfsl_mbox_tplate_vcard_qrcode_tplates( $slTplateID, $vcTplateID, $F );
    abcfsl_mbox_tplate_field_input_static_lbl( $lblTxt, $F, 259, '', true );            
    echo abcfsl_mbox_autil_input_txt_help_link( 'inputLbl_', $F, $inputLbl, 208, 282, 33 );
    echo abcfl_input_checkbox('lnkNT_'. $F,  '', $lnkNT, abcfsl_txta(143), '', '', '', 'abcflFldCntr', '', '', '' );

    //------------------------------------------------
    abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
    abcfsl_mbox_tplate_field_field_style_compact_default( $tplateOptns, $F );
}