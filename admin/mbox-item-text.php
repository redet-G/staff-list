<?php
// Data entry screen, input field builder.  
function abcfsl_mbox_item_text( $staffID, $itemOptns, $tplateOptns, $isSingle, $divID) {

    $itemOptns['staffID'] = $staffID;

    //Single is a second tab. Set it to hidden.
    if( $isSingle ){
        echo  abcfl_html_tag('div', $divID, 'inside  hidden abcflFadeIn');
    }
    else {
        echo  abcfl_html_tag('div', $divID, 'inside');
        abcfsl_mbox_item_text_sort_txt( $itemOptns );
    }

    //New record. Template not selected yet.
    if( empty( $tplateOptns ) ){ 
        //echo abcfl_input_info_lbl( abcfsl_txta(244), 'abcflMTop15', '16', 'SB'); 

        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(609), abcfsl_aurl(48), 'abcflFontWP abcflFontS16 abcflFontW600 abcflMTop20');

        echo abcfl_html_tag_end('div');
        return;
    }    

    //Get template fields in field order.
    $fieldOrder = abcfsl_util_field_order( $tplateOptns, $isSingle );

    $fieldsQty = 0;
    foreach ( $fieldOrder as $order => $F ) {
        $showField = abcfsl_mbox_item_text_line_bldr( $staffID, $tplateOptns, $itemOptns, $F, $isSingle );
        $fieldsQty = $fieldsQty + $showField;
    }

    //Message: Template has no fields
    if( $fieldsQty == 0 ){ echo abcfl_input_info_lbl( abcfsl_txta(214), 'abcflMTop15', '16', 'SB'); }

    echo abcfl_html_tag_end('div');
}

function abcfsl_mbox_item_text_sort_txt( $itemOptns ){

    $sortTxt = isset( $itemOptns['_sortTxt'] ) ? esc_attr( $itemOptns['_sortTxt'][0] ) : '';

    $lblST = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(61), abcfsl_aurl(31), 'abcflFontWP abcflFontS13 abcflFontW600' );

    echo abcfl_input_txt('sortTxt', '', $sortTxt,  $lblST, '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_hline('3', '10');
}

//Render and ECHO a single input field.
function abcfsl_mbox_item_text_line_bldr( $staffID, $tplateOptns, $itemOptns, $F, $isSingle ){

    $fieldType = isset( $tplateOptns['_fieldType_' . $F] ) ? esc_attr( $tplateOptns['_fieldType_' . $F][0] ) :'N';
    $showFieldOn = isset( $tplateOptns['_showField_' . $F] ) ? esc_attr( $tplateOptns['_showField_' . $F][0] ) : 'L';

    if( $F == 'SPTL' ) {
        $fieldType = 'SPTL';
        $showFieldOn = 'L';
    }

    //0=No; 1=Yes; 2=Disabled; Data input. Show on Staff or Staff + Single or Single only. Disabled on Single if Staff + Single.
    $showField = abcfsl_autil_show_field_for_data_input( $showFieldOn, $isSingle );

    //--- RENDER FIELD + DATA ----------------------------------------
    switch ( $fieldType ){
        case 'T':
        case 'SC':
            abcfsl_mbox_item_text_T( $tplateOptns, $itemOptns, $F, $showField );
            break;
        case 'MP':
            abcfsl_mbox_item_text_MP( $tplateOptns, $itemOptns, $F, $showField );
            break;
        case 'PT':
            abcfsl_mbox_item_text_PT( $tplateOptns, $itemOptns, $F, $showField );
            break;
        case 'LT':
            abcfsl_mbox_item_text_LT( $tplateOptns, $itemOptns, $F, $showField );
            break;
        case 'LTABOVE':
            abcfsl_mbox_item_text_LT( $tplateOptns, $itemOptns, $F, $showField );
            break;
        case 'PTABOVE':
            abcfsl_mbox_item_text_PTABOVE( $tplateOptns, $itemOptns, $F, $showField );
            break;                         
        case 'STXT':
            abcfsl_mbox_item_text_STXT( $tplateOptns, $itemOptns, $F, $showField );
            break;
        case 'H':
            abcfsl_mbox_item_text_H( $tplateOptns, $itemOptns, $F, $showField);
            break;
        case 'TH':
            abcfsl_mbox_item_text_TH( $tplateOptns, $itemOptns, $F, $showField);
            break;
        case 'EM':
            abcfsl_mbox_item_text_EM( $tplateOptns, $itemOptns, $F, $showField);
            break;
        case 'STXEM':
            abcfsl_mbox_item_text_STXEM( $tplateOptns, $itemOptns, $F, $showField);
            break;  
        case 'SLFONE':
            abcfsl_mbox_item_fone_SLFONE( $tplateOptns, $itemOptns, $F, $showField);
            break; 
        case 'FONE':
            abcfsl_mbox_item_fone_FONE( $tplateOptns, $itemOptns, $F, $showField);
            break;                          
        case 'CE':
            abcfsl_mbox_item_text_WPE( $tplateOptns, $itemOptns, $F, $showField);
            break;                     
        case 'HL': //PRO
            abcfsl_mbox_item_text_HL( $tplateOptns, $F, $showField );
            break;
        case 'SPTL': //Single Page Text Link
            abcfsl_mbox_item_text_SPTL( $tplateOptns );
            break;
        case 'CBO':
            abcfsl_mbox_item_cbo_CBO( $tplateOptns, $itemOptns, $F, $showField);
            break;
        case 'LBLCBO':
            abcfsl_mbox_item_cbo_LBLCBO( $tplateOptns, $itemOptns, $F, $showField);
            break;               
        case 'CBOM':  
            abcfsl_mbox_item_cbo_CBOM( $tplateOptns, $itemOptns, $F, $showField );
            break;            
        case 'CHECKG': 
            abcfsl_mbox_item_cbo_CHCKG( $tplateOptns, $itemOptns, $F, $showField );
            break; 
        case 'IMGCAP': //image with caption
            abcfsl_mbox_item_img_IMGCAP( $tplateOptns, $itemOptns, $F, $showField );
            break;
        case 'IMGHLNK': //image hyperlink with caption
            abcfsl_mbox_item_img_IMGHLNK( $tplateOptns, $itemOptns, $F, $showField );
            break;  
        case 'SLDTE': //Static lbl + date
            abcfsl_mbox_item_date_SLDTE( $tplateOptns, $itemOptns, $F, $showField );
            break; 
        case 'STFFCAT': 
            abcfsl_mbox_item_cats_STFFCAT( $staffID, $tplateOptns, $itemOptns, $F, $showField );
            break; 
        case 'VCARDHL':
            abcfsl_mbox_item_VCARDHL( $tplateOptns, $itemOptns, $F, $showField );
            break; 
        case 'QRHL64STA':
            abcfsl_mbox_item_QRHL64STA( $tplateOptns, $itemOptns, $F, $showField );
            break; 
        case 'QRHL64DYN':
            abcfsl_mbox_item_QRHL64DYN( $tplateOptns, $itemOptns, $F, $showField );
            break;             
        case 'QRIMGCAP64STA':
            abcfsl_mbox_item_QRIMGCAP64STA( $tplateOptns, $itemOptns, $F, $showField );
            break; 
        case 'QRIMGCAP64DYN':
            abcfsl_mbox_item_QRIMGCAP64DYN( $tplateOptns, $itemOptns, $F, $showField );
            break;      
        case 'ADDRST':
            abcfsl_mbox_item_ADDRST( $tplateOptns, $itemOptns, $F, $showField );
            break;
        case 'ADDR':
            abcfsl_mbox_item_ADDR( $tplateOptns, $itemOptns, $F, $showField );
            break;                       
       default:
            break;
    }
    return $showField;

    //case 'SH': //Single Page Hyperlink deprecated
        //abcfsl_mbox_item_text_SH( $tplateOptns, $F, $showField );
    //break;
}

//===================================================================
//Static label + Email
function abcfsl_mbox_item_text_STXEM( $tplateOptns, $itemOptns, $F, $showField ){

    if($showField == 0) { return ''; }

    // Text to display as static label. Staff member has only field number
    $staticTxt = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '';
    $linkUrlLbl = isset( $tplateOptns['_lnkUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlLbl_' . $F][0] ) : '';
    $linkUrlHlp = isset( $tplateOptns['_lnkUrlHlp_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlHlp_' . $F][0] ) : '';

    // Static label
    //$urlTxt = isset( $itemOptns['_urlTxt_' . $F] ) ? esc_attr( $itemOptns['_urlTxt_' . $F][0] ) : '';
    $url = isset( $itemOptns['_url_' . $F] ) ? esc_attr( $itemOptns['_url_' . $F][0] ) : '';

    // Date entry screen. Field label.
    //$linkLblLbl = abcfsl_mbox_item_text_line_number( $F , $linkLblLbl );

    $staticTxtFieldLbl = abcfsl_mbox_item_text_line_number( $F , '' );
    $linkUrlLbl = abcfsl_mbox_item_text_line_number( $F , $linkUrlLbl );

    $dataL = '';
    $dataR = '';
    if($showField == 2) {
        $dataL = abcfl_input_txt_readonly('ro_staticTxt_' . $F, '', $staticTxt, $staticTxtFieldLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $dataR = abcfl_input_txt_readonly('ro_url_' . $F, '', $url, $linkUrlLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    }
    else{
        $dataL = abcfl_input_txt_readonly('staticTxt_' . $F, '', $staticTxt, $staticTxtFieldLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $dataR = abcfl_input_txt('url_' . $F, '', $url, $linkUrlLbl, $linkUrlHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    }
    echo abcfsl_mbox_item_input_two_fields( $dataL, $dataR );    
}



//Horizontal line TODO ?????
function abcfsl_mbox_item_text_HL( $tplateOptns, $F, $showField){

    if($showField == 0) { return ''; }

    $inputLbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : 'Horizontal Line';
    echo abcfl_input_info_lbl( abcfsl_mbox_item_text_line_number( $F , $inputLbl ) , 'abcflMTop15');
    echo abcfl_input_hline('2', 5);
}

//Text.
function abcfsl_mbox_item_text_T( $tplateOptns, $itemOptns, $F, $showField ){

    if($showField == 0) { return ''; }

    $txt = isset( $itemOptns['_txt_' . $F] ) ? esc_attr( $itemOptns['_txt_' . $F][0] ) : '';
    $inputLbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
    $inputHlp = isset( $tplateOptns['_inputHlp_' . $F] ) ? esc_attr( $tplateOptns['_inputHlp_' . $F][0] ) : '';
    $lbl = abcfsl_mbox_item_text_line_number( $F , $inputLbl );

    if($showField == 2) {
        echo abcfl_input_txt_readonly('ro_txt_' . $F, '', $txt, $lbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    }
    else{
        echo abcfl_input_txt('txt_' . $F, '', $txt, $lbl, $inputHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    }
}

//Static Text.
function abcfsl_mbox_item_text_STXT( $tplateOptns, $itemOptns, $F, $showField ){

    if($showField == 0) { return ''; }

    $txt = isset( $tplateOptns['_statTxt_' . $F] ) ? esc_attr( $tplateOptns['_statTxt_' . $F][0] ) : '';
    $inputLbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
    $lbl = abcfsl_mbox_item_text_line_number( $F , $inputLbl );

    echo abcfl_input_txt_readonly('ro_txt_' . $F, '', $txt, $lbl, '', '100%', '8', '', 'abcflFldCntr', 'abcflFldLbl');
}

//Paragraph Text.
function abcfsl_mbox_item_text_PT( $tplateOptns, $itemOptns, $F, $showField ){

    if($showField == 0) { return ''; }

    // HTML ??????????????
    //$lineTxt = isset( $itemOptns['_txt_' . $F] ) ? esc_textarea( $itemOptns['_txt_' . $F][0] ) : '';
    $txt = isset( $itemOptns['_txt_' . $F] ) ? esc_attr( $itemOptns['_txt_' . $F][0] ) : '';

    $inputLbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
    $inputHlp = isset( $tplateOptns['_inputHlp_' . $F] ) ? esc_attr( $tplateOptns['_inputHlp_' . $F][0] ) : '';
    $lbl = abcfsl_mbox_item_text_line_number( $F , $inputLbl );
    //$inputHlp = $inputHlp . ' ' . abcfsl_txta(221);

    if($showField == 2) {
        echo abcfl_input_txtarea_readonly('ro_txt_' . $F, '', $txt, $lbl, '', '100%', '8', '', 'abcflFldCntr', 'abcflFldLbl');
    }
    else{
        echo abcfl_input_txtarea('txt_' . $F, '', $txt, $lbl, $inputHlp . ' ' . abcfsl_txta(221), '100%', '10', '', '', '', 'abcflFldCntr', 'abcflFldLbl');
    }
}

//Static label(above) + Paragraph Text.
function abcfsl_mbox_item_text_PTABOVE( $tplateOptns, $itemOptns, $F, $showField ){

    if($showField == 0) { return ''; }

    $staticLbl = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '';
    $txt = isset( $itemOptns['_txt_' . $F] ) ? esc_attr( $itemOptns['_txt_' . $F][0] ) : '';

    $inputLbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
    $inputHlp = isset( $tplateOptns['_inputHlp_' . $F] ) ? esc_attr( $tplateOptns['_inputHlp_' . $F][0] ) : '';
    $lbl = abcfsl_mbox_item_text_line_number( $F , $inputLbl ) . '<div>' . $staticLbl . '</div>';

    if($showField == 2) {
        echo abcfl_input_txtarea_readonly('ro_txt_' . $F, '', $txt, $lbl, '', '100%', '8', '', 'abcflFldCntr', 'abcflFldLbl');
    }
    else{
        echo abcfl_input_txtarea('txt_' . $F, '', $txt, $lbl, $inputHlp . ' ' . abcfsl_txta(221), '100%', '10', '', '', '', 'abcflFldCntr', 'abcflFldLbl');
    }
}

//Static label + Text. Static label(above) + Text. 
function abcfsl_mbox_item_text_LT( $tplateOptns, $itemOptns, $F, $showField ){

    if($showField == 0) { return ''; }

    $lblTx = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '';
    $lineTxt = isset( $itemOptns['_txt_' . $F] ) ? esc_attr( $itemOptns['_txt_' . $F][0] ) : '';
    $inputLbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
    $inputHlp = isset( $tplateOptns['_inputHlp_' . $F] ) ? esc_attr( $tplateOptns['_inputHlp_' . $F][0] ) : '';

    $inputLbl = abcfsl_mbox_item_text_line_number( $F , $inputLbl );
    $staticLbl = abcfsl_mbox_item_text_line_number( $F , '' );

    //echo abcfl_input_txt('txt_' . $F, '', $lineTxt, $inputLbl, $inputHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl abcflFontW700');

    $dataL = '';
    $dataR = '';
    if($showField == 2) {
        $dataL = abcfl_input_txt_readonly('ro_staticTxt_' . $F, '', $lblTx, $staticLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $dataR = abcfl_input_txt_readonly('ro_txt_' . $F, '', $lineTxt, $inputLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    }
    else{
        $dataL = abcfl_input_txt_readonly('staticTxt_' . $F, '', $lblTx, $staticLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $dataR = abcfl_input_txt('txt_' . $F, '', $lineTxt, $inputLbl, $inputHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    }
    echo abcfsl_mbox_item_input_two_fields( $dataL, $dataR );
}

//Hyperlinlk.
function abcfsl_mbox_item_text_H( $tplateOptns, $itemOptns, $F, $showField ){

    if($showField == 0) { return ''; }

    $linkLblLbl = isset( $tplateOptns['_lnkLblLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkLblLbl_' . $F][0] ) : '';
    $linkLblHlp = isset( $tplateOptns['_lnkLblHlp_' . $F] ) ? esc_attr( $tplateOptns['_lnkLblHlp_' . $F][0] ) : '';
    $linkUrlLbl = isset( $tplateOptns['_lnkUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlLbl_' . $F][0] ) : '';
    $linkUrlHlp = isset( $tplateOptns['_lnkUrlHlp_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlHlp_' . $F][0] ) : '';

    $urlTxt = isset( $itemOptns['_urlTxt_' . $F] ) ? esc_attr( $itemOptns['_urlTxt_' . $F][0] ) : '';
    $url = isset( $itemOptns['_url_' . $F] ) ? esc_attr( $itemOptns['_url_' . $F][0] ) : '';

    $linkLblLbl = abcfsl_mbox_item_text_line_number( $F , $linkLblLbl );
    $linkUrlLbl = abcfsl_mbox_item_text_line_number( $F , $linkUrlLbl );


    $dataL = '';
    $dataR = '';
    if($showField == 2) {
        $dataL = abcfl_input_txt_readonly('ro_urlTxt_' . $F, '', $urlTxt, $linkLblLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $dataR = abcfl_input_txt_readonly('ro_url_' . $F, '', $url, $linkUrlLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    }
    else{
        $dataL = abcfl_input_txt('urlTxt_' . $F, '', $urlTxt, $linkLblLbl, $linkLblHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $dataR = abcfl_input_txt('url_' . $F, '', $url, $linkUrlLbl, $linkUrlHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    }
    echo abcfsl_mbox_item_input_two_fields( $dataL, $dataR );
}

//Static link text + Hyperlinlk.
function abcfsl_mbox_item_text_TH( $tplateOptns, $itemOptns, $F, $showField ){

    if($showField == 0) { return ''; }

    $linkUrlLbl = isset( $tplateOptns['_lnkUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlLbl_' . $F][0] ) : '';
    $linkUrlHlp = isset( $tplateOptns['_lnkUrlHlp_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlHlp_' . $F][0] ) : '';
    $lblTx = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '';
    $url = isset( $itemOptns['_url_' . $F] ) ? esc_attr( $itemOptns['_url_' . $F][0] ) : '';

    $linkUrlLbl = abcfsl_mbox_item_text_line_number( $F , $linkUrlLbl );
    $staticLbl = abcfsl_mbox_item_text_line_number( $F , '' );

    $dataL = '';
    $dataR = '';
    if($showField == 2) {
        $dataL = abcfl_input_txt_readonly('ro_staticTxt_' . $F, '', $lblTx, $staticLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $dataR = abcfl_input_txt_readonly('ro_url_' . $F, '', $url, $linkUrlLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    }
    else{
        $dataL = abcfl_input_txt_readonly('staticTxt_' . $F, '', $lblTx, $staticLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $dataR = abcfl_input_txt('url_' . $F, '', $url, $linkUrlLbl, $linkUrlHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    }
    echo abcfsl_mbox_item_input_two_fields( $dataL, $dataR );

}

// deprecated
function abcfsl_mbox_item_text_SH( $tplateOptns, $F, $showField ){

    if($showField == 0) { return ''; }
    $lblTx = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '';
    echo abcfl_input_txt_readonly('ro_txt_' . $F, '', $lblTx, '', '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//Static label + Hyperlinlk.
function abcfsl_mbox_item_text_LH( $tplateOptns, $itemOptns, $F, $showField){

    if($showField == 0) { return ''; }

    $linkLblLbl = isset( $tplateOptns['_lnkLblLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkLblLbl_' . $F][0] ) : '';
    $linkLblHlp = isset( $tplateOptns['_lnkLblHlp_' . $F] ) ? esc_attr( $tplateOptns['_lnkLblHlp_' . $F][0] ) : '';
    $linkUrlLbl = isset( $tplateOptns['_lnkUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlLbl_' . $F][0] ) : '';
    $linkUrlHlp = isset( $tplateOptns['_lnkUrlHlp_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlHlp_' . $F][0] ) : '';

    $urlTxt = isset( $itemOptns['_urlTxt_' . $F] ) ? esc_attr( $itemOptns['_urlTxt_' . $F][0] ) : '';
    $url = isset( $itemOptns['_url_' . $F] ) ? esc_attr( $itemOptns['_url_' . $F][0] ) : '';

    $linkLblLbl = abcfsl_mbox_item_text_line_number( $F , $linkLblLbl );
    $linkUrlLbl = abcfsl_mbox_item_text_line_number( $F , $linkUrlLbl );

    $dataL = '';
    $dataR = '';
    if($showField == 2) {
        $dataL = abcfl_input_txt_readonly('ro_urlTxt_' . $F, '', $urlTxt, $linkLblLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $dataR = abcfl_input_txt_readonly('ro_url_' . $F, '', $url, $linkUrlLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    }
    else{
        $dataL = abcfl_input_txt('urlTxt_' . $F, '', $urlTxt, $linkLblLbl, $linkLblHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $dataR = abcfl_input_txt('url_' . $F, '', $url, $linkUrlLbl, $linkUrlHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    }
    echo abcfsl_mbox_item_input_two_fields( $dataL, $dataR );

}

//Email
function abcfsl_mbox_item_text_EM( $tplateOptns, $itemOptns, $F, $showField){

    if($showField == 0) { return ''; }

    $linkLblLbl = isset( $tplateOptns['_lnkLblLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkLblLbl_' . $F][0] ) : '';
    $linkLblHlp = isset( $tplateOptns['_lnkLblHlp_' . $F] ) ? esc_attr( $tplateOptns['_lnkLblHlp_' . $F][0] ) : '';
    $linkUrlLbl = isset( $tplateOptns['_lnkUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlLbl_' . $F][0] ) : '';
    $linkUrlHlp = isset( $tplateOptns['_lnkUrlHlp_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlHlp_' . $F][0] ) : '';

    $urlTxt = isset( $itemOptns['_urlTxt_' . $F] ) ? esc_attr( $itemOptns['_urlTxt_' . $F][0] ) : '';
    $url = isset( $itemOptns['_url_' . $F] ) ? esc_attr( $itemOptns['_url_' . $F][0] ) : '';

    $linkLblLbl = abcfsl_mbox_item_text_line_number( $F , $linkLblLbl );
    $linkUrlLbl = abcfsl_mbox_item_text_line_number( $F , $linkUrlLbl );

    $dataL = '';
    $dataR = '';
    if($showField == 2) {
        $dataL = abcfl_input_txt_readonly('ro_urlTxt_' . $F, '', $urlTxt, $linkLblLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $dataR = abcfl_input_txt_readonly('ro_url_' . $F, '', $url, $linkUrlLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    }
    else{
        $dataL = abcfl_input_txt('urlTxt_' . $F, '', $urlTxt, $linkLblLbl, $linkLblHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $dataR = abcfl_input_txt('url_' . $F, '', $url, $linkUrlLbl, $linkUrlHlp, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    }
    echo abcfsl_mbox_item_input_two_fields( $dataL, $dataR );
}

//WordPress Text Editor.
function abcfsl_mbox_item_text_WPE( $tplateOptns, $itemOptns, $F, $showField){

    if($showField == 0) { return ''; }

    $inputLbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
    $inputHlp = isset( $tplateOptns['_inputHlp_' . $F] ) ? esc_attr( $tplateOptns['_inputHlp_' . $F][0] ) : '';

    $inputLbl = abcfsl_mbox_item_text_line_number( $F , $inputLbl );


    $content = isset( $itemOptns['_editorCnt_' . $F] ) ? ( $itemOptns['_editorCnt_' . $F][0] ) : '';

    if($showField == 2) {

        $txt = substr(esc_attr( $content ), 0, 120) . ' ...';
        echo abcfl_input_txt_readonly('ro_txt_' . $F, '', $txt, $inputLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    }
    else{

        echo abcfl_input_hlp_lbl($inputLbl, 'abcflMTop15 abcflFontW700', 12);
        echo abcfl_input_hlp_lbl($inputHlp);

        // TODO
        //apply_filters('the_content', $page -> post_content);
        //esc_textarea( $text )
        //http://wordpress.stackexchange.com/questions/49901/post-custom-metabox-textarea-using-wp-editor
        //https://pupungbp.com/add-rich-tinymce-editor-custom-field-wordpress/

        // Add WP Editor       
        $editorName = 'editorCnt_' . $F;
        
        wp_editor( $content, $editorName, array(
            'wpautop'       => true,
            'media_buttons' => false,
            'textarea_name' => $editorName,
            'textarea_rows' => 10,
            'teeny' => false,
            'quicktags' => true,
            'tinymce' => true
        ) );
    }
}

function abcfsl_mbox_item_text_SPTL( $tplateOptns ){

    $sPgLnkShow = isset( $tplateOptns['_sPgLnkShow'] ) ? $tplateOptns['_sPgLnkShow'][0] : 'N';
    if( $sPgLnkShow == 'N' ) { return ''; }

    $sPgLnkTxt = isset( $tplateOptns['_sPgLnkTxt'] ) ? esc_attr( $tplateOptns['_sPgLnkTxt'][0] ) : '';
    // Hide textbox when text link is empty.
    if( empty( $sPgLnkTxt ) ) { return; }

    $lbl = abcfsl_mbox_item_text_line_number( '', abcfsl_txta(74) );
    echo abcfl_input_txt_readonly('ro_txt_sPgLnkTxt', '', $sPgLnkTxt, $lbl, '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl  abcflFontW700');
}

//===================================================================================
function abcfsl_mbox_item_text_line_number( $F, $inputLbl, $suffix='' ){

    $dot = '&nbsp';
    if( !empty( $F ) ) { $dot = '.&nbsp'; }

    if( empty( $suffix ) ){ return '<div class="abcflFontWPSB abcflFontS13">' . $F . $dot . $inputLbl . '</div>';  }

    return '<span class="abcflFontWPSB abcflFontS13">' . $F . $dot . $inputLbl . '</span><span>' . $suffix . '</span>';
}

function abcfsl_mbox_item_input_four_fields( $f1, $f2, $f3, $f4 ){

    $cntrS = abcfl_html_tag( 'div', '', 'abcflGridRow abcflGridGroup' );
    $cntrS1 = abcfl_html_tag( 'div', '', 'abcflGridCol abcflGridCol_1_of_4' );
    $cntrS2 = abcfl_html_tag( 'div', '', 'abcflGridCol abcflGridCol_1_of_4 abcflPLeft10' );
    $divE = abcfl_html_tag_end( 'div');

    //$clr = abcfl_html_tag_cls( 'div',  'abcflClr', true );
    $clr = '';

    $out = $cntrS .
           $cntrS1 . $f1 . $divE .
           $cntrS2 . $f2 . $divE .
           $cntrS2 . $f3 . $divE .
           $cntrS2 . $f4 . $divE .
           $clr. $divE;

    return $out;
}

function abcfsl_mbox_item_input_two_fields( $dataL, $dataR ){

    $fieldsCntrS = abcfl_html_tag( 'div', '', 'abcflGridRow abcflGridGroup' );
    $fieldCntrS1 = abcfl_html_tag( 'div', '', 'abcflGridCol abcflGridCol_1_of_3' );
    $fieldCntrS2 = abcfl_html_tag( 'div', '', 'abcflGridCol abcflGridCol_2_of_3 abcflPLeft20' );
    $divE = abcfl_html_tag_end( 'div');

    //$clr = abcfl_html_tag_cls( 'div',  'abcflClr', true );
    $clr = '';

    $out = $fieldsCntrS . $fieldCntrS1 . $dataL . $divE . $fieldCntrS2 . $dataR . $divE . $clr. $divE;

    return $out;
}