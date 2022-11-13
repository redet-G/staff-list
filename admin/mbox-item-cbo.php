<?php

function abcfsl_mbox_item_cbo_CBO( $tplateOptns, $itemOptns, $F, $showField ){

    if($showField == 0) { return ''; }
    echo abcfsl_mbox_item_cbo_CBO_field( $tplateOptns, $itemOptns, $F, $showField );   
}

function abcfsl_mbox_item_cbo_LBLCBO( $tplateOptns, $itemOptns, $F, $showField ){

    $lblTx = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '';
    $staticLbl = abcfsl_mbox_item_text_line_number( $F , '' );

    $cbo = abcfsl_mbox_item_cbo_CBO_field( $tplateOptns, $itemOptns, $F, $showField );

    $dataL = '';
    $dataR = '';
    if($showField == 2) {
        $dataL = abcfl_input_txt_readonly('ro_staticTxt_' . $F, '', $lblTx, $staticLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $dataR = $cbo;
    }
    else{
        $dataL = abcfl_input_txt_readonly('staticTxt_' . $F, '', $lblTx, $staticLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        $dataR = $cbo;
    }

    echo abcfsl_mbox_item_input_two_fields( $dataL, $dataR ); 
}

//==========================================================
function abcfsl_mbox_item_cbo_CBO_field( $tplateOptns, $itemOptns, $F, $showField ){

    if($showField == 0) { return ''; }

    $txt = isset( $itemOptns['_txt_' . $F] ) ? esc_attr( $itemOptns['_txt_' . $F][0] ) : '';
    $inputLbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
    $inputHlp = isset( $tplateOptns['_inputHlp_' . $F] ) ? esc_attr( $tplateOptns['_inputHlp_' . $F][0] ) : '';
    $lblTxt = abcfsl_mbox_item_text_line_number( $F , $inputLbl );

    $cboValues = isset( $tplateOptns['_cboValues_' . $F] ) ? $tplateOptns['_cboValues_' . $F][0] : '';
    $cboFirstValue = isset( $tplateOptns['_cboFirstValue_' . $F] ) ?  esc_attr( $tplateOptns['_cboFirstValue_' . $F][0] ) : '';
    $cboFirstTxt = isset( $tplateOptns['_cboFirstTxt_' . $F] ) ?  esc_attr( $tplateOptns['_cboFirstTxt_' . $F][0] ) : '';

    //$cboValues: a:2:{i:0;s:9:"drodown-2";i:1;s:9:"drodown-1";}
    //$cboValuesU: Array
    //     [0] => drodown-2
    //     [1] => drodown-1

    $cboValuesU = array();
    $cboItems = array();
    if( !empty( $cboValues ) ) { $cboItems =  unserialize( $cboValues ); }

    $cboAllItems[$cboFirstValue] = $cboFirstTxt;
    foreach ( $cboItems as $value ) {  $cboAllItems[esc_attr($value)] =  esc_attr($value); }

    if($showField == 2) {
        return abcfl_input_txt_readonly('ro_txt_' . $F, '', $txt, $lblTxt, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    }

    return abcfl_input_cbo( 'txt_' . $F, 
        '', 
        $cboAllItems, 
        $txt, 
        $lblTxt, 
        $inputHlp, 
        '100%', 
        false, 
        '', 
        '', 
        'abcflFldCntr', 
        'abcflFldLbl', '');
    //$fldID, $fldName, $values, $selected, $lblTxt='', $hlpTxt='', $size='', $isInt=true, $cls='', $style='',  $clsCntr='', $clsLbl='', $clsHlpUnder=''     
}
//== CBOM START ======================================================
function abcfsl_mbox_item_cbo_CBOM( $tplateOptns, $itemOptns, $F, $showField ){

    if($showField == 0) { return ''; }

    $cbomQty  = isset( $tplateOptns['_cbomQty_' . $F] ) ? $tplateOptns['_cbomQty_' . $F][0] : '1';
    $inputLbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
    $inputHlp = isset( $tplateOptns['_inputHlp_' . $F] ) ? esc_attr( $tplateOptns['_inputHlp_' . $F][0] ) : '';
    $staticLblTx = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '';
    
    //Data for rendering all dropdowns. Comes from staff template field.
    $cboValues = isset( $tplateOptns['_cboValues_' . $F] ) ? $tplateOptns['_cboValues_' . $F][0] : '';
    $cboFirstValue = isset( $tplateOptns['_cboFirstValue_' . $F] ) ?  esc_attr( $tplateOptns['_cboFirstValue_' . $F][0] ) : '';
    $cboFirstTxt = isset( $tplateOptns['_cboFirstTxt_' . $F] ) ?  esc_attr( $tplateOptns['_cboFirstTxt_' . $F][0] ) : '';

    $cbomSort  = isset( $tplateOptns['_cbomSort_' . $F] ) ? $tplateOptns['_cbomSort_' . $F][0] : 'N';
    $cbomSortLocale = isset( $tplateOptns['_cbomSortLocale_' . $F] ) ? $tplateOptns['_cbomSortLocale_' . $F][0] : '';

    //Saved dropdown values
    $cbomSaved = isset( $itemOptns['_cbom_' . $F] ) ?  $itemOptns['_cbom_' . $F][0]  : '';
    $savedIdxArray = array();
 
    if( !empty( $cbomSaved ) ) { 
        $savedIdxArray = array_map('trim', explode( ',' ,$cbomSaved ));
    }

    $fieldsCntrS = abcfl_html_tag( 'div', '', 'abcflFGCntr' );
    $col2_13_S = abcfl_html_tag( 'div', '', 'abcflFG2Col13' );
    $col2_23_S = abcfl_html_tag( 'div', '', 'abcflFG2Col23' );
    $divE = abcfl_html_tag_end( 'div'); 

    //-- READ ONLY -------------------------------------------------------
    $fieldLbl = abcfsl_mbox_item_text_line_number( $F , $inputLbl );
    $staticLbl = abcfsl_mbox_item_text_line_number( $F, abcfsl_txta(275) );    

    $staticLblRO = abcfl_input_txt_readonly('ro_txt_' . $F, '', $staticLblTx, $staticLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $cbomRO = abcfl_input_txt_readonly('ro_txt_' . $F, '', $cbomSaved, $fieldLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    $fieldSortedRO = $fieldsCntrS . $col2_13_S . $staticLblRO . $divE . $col2_23_S . $cbomRO . abcfl_html_tag_ends( 'div,div');

    if( $showField == 2 ) {
        echo $fieldSortedRO;
        return;        
     }
    //-------------------------------------------------------
    //Dropdown builder.     
    $cboValuesU = array();
    if( !empty( $cboValues ) ) { $cboValuesU =  unserialize( $cboValues ); }

    $cboAllItems[$cboFirstValue] = $cboFirstTxt;
    foreach ( $cboValuesU as $value ) {  
        $cboAllItems[$value] =  $value; 
    }
    //----------------------------------------------------
    $dropdownsRow = '';
    $dropdownsAll = '';
    $colQty = 4;
    $renderedQty = 0;
    $cboOrder = 1;
    $cboSelected = '';

    //Create dropdowns
    for ( $i = 0; $i < $cbomQty; $i++ ) {

        $cboSelected = abcfsl_mbox_item_cbo_value_by_key_or_first( $i, $savedIdxArray, $cboFirstValue );     
        $dropdownsRow .= abcfsl_mbox_item_cbo_lblcbom_field(  $cboAllItems, $cboSelected, $F, $cboOrder );
        $renderedQty++;
        $cboOrder++;

        if( $renderedQty ==  $colQty ){
            $dropdownsAll.= $fieldsCntrS . $dropdownsRow . $divE;
            $dropdownsRow = '';
            $renderedQty = 0;
        }
    }

    if( $renderedQty <  $colQty ){
        $dropdownsAll.= $fieldsCntrS . $dropdownsRow . $divE;
    }

    //--Render output ---------------------
    echo abcfl_input_hline('1', '10');
    echo $fieldSortedRO;
    echo  $dropdownsAll;  
    echo abcfl_input_hlp_lbl( $inputHlp, 'abcflMTop10 abcflFldHlpUnder abcflFontS14' );    
    echo abcfl_input_hline('1', '10');
}

//Get array value by key
function abcfsl_mbox_item_cbo_value_by_key_or_first( $key, $savedIdxArray, $cboFirstValue ){
    
    $out = $cboFirstValue;
    if ( array_key_exists( $key, $savedIdxArray ) ) { 
        $out =  $savedIdxArray[$key]; 
    }
    return $out;
}

//CBO
function abcfsl_mbox_item_cbo_lblcbom_field( $cboAllItems, $cboSelected, $F, $cboOrder ){

    $fieldCntrS = abcfl_html_tag( 'div', '', 'abcflFG4Col' );
    $divE = abcfl_html_tag_end( 'div'); 

    $cboSelected = esc_attr( $cboSelected );
    $cbo =  abcfl_input_cbo( 'cbom_' . $F . '[]', 
        '', 
        $cboAllItems, 
        $cboSelected, 
        $cboOrder, 
        '', 
        '100%', 
        false, 
        '', 
        '', 
        'abcflFldCntr5', 
        'abcflFldLbl1', '');

        return $fieldCntrS . $cbo . $divE;   
}
//== CBOM END =============================================

//== CHECKG START =============================================
function abcfsl_mbox_item_cbo_CHCKG( $tplateOptns, $itemOptns, $F, $showField ){

    if($showField == 0) { return ''; }

    $inputLbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
    $inputHlp = isset( $tplateOptns['_inputHlp_' . $F] ) ? esc_attr( $tplateOptns['_inputHlp_' . $F][0] ) : '';
    $staticLblTx = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '';
    
    //Template checkbox group values. Serialized. 
    $tplateCheckValues = isset( $tplateOptns['_cboValues_' . $F] ) ? $tplateOptns['_cboValues_' . $F][0] : '';
    //Saved checkbox group values
    $checkSaved = isset( $itemOptns['_checkg_' . $F] ) ?  $itemOptns['_checkg_' . $F][0]  : '';

    $savedIdxArray = array();
    $savedAssocArray = array();
    $tplateIdxArray = array(); 

    //Template checkbox group values to indexed array.
    if( !empty( $tplateCheckValues ) ) { $tplateIdxArray =  unserialize( $tplateCheckValues ); }
    $tplateIdxArray = array_unique( $tplateIdxArray ); 
    $cbomQty  = count( $tplateIdxArray );
    
    //Saved checkbox group values to associative array.
    if( !empty( $checkSaved ) ) { 
        $savedIdxArray = array_map('trim', explode( ',' ,$checkSaved ));
        $savedIdxArray = array_unique( $savedIdxArray ); 

        //Indexed to associative array.
        foreach ( $savedIdxArray as $value ) {  
            $savedAssocArray[$value] =  $value; 
        }
    }

    $fieldsCntrS = abcfl_html_tag( 'div', '', 'abcflFGCntr' );
    $checkGrpRowS = abcfl_html_tag( 'div', '', 'abcflFGCntr abcflMTop10' );
    $checkGrpCntrS = abcfl_html_tag( 'div', '', 'abcflMTop10' );
    $col2_13_S = abcfl_html_tag( 'div', '', 'abcflFG2Col13' );
    $col2_23_S = abcfl_html_tag( 'div', '', 'abcflFG2Col23' );
    $divE = abcfl_html_tag_end( 'div'); 
    //$blankDiv = abcfl_html_tag_cls('div', 'abcflFG4Col', true);

    //-- READ ONLY -------------------------------------------------------
    $fieldLbl = abcfsl_mbox_item_text_line_number( $F , $inputLbl );
    $staticLbl = abcfsl_mbox_item_text_line_number( $F, abcfsl_txta(275) );    

    $staticLblRO = abcfl_input_txt_readonly('ro_txt_' . $F, '', $staticLblTx, $staticLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $savedRO = abcfl_input_txt_readonly('ro_txt_' . $F, '', $checkSaved, $fieldLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    $fieldsRO = $fieldsCntrS . $col2_13_S . $staticLblRO . $divE . $col2_23_S . $savedRO . abcfl_html_tag_ends( 'div,div');

    if( $showField == 2 ) {
        echo $fieldsRO;
        return;        
     }

    //----------------------------------------------------
    $checkRow = '';
    $checkAll = '';
    $colQty = 4;
    $renderedQty = 0;
    $checkedValue = '';

    //Create dropdowns
    for ( $i = 0; $i < $cbomQty; $i++ ) {

        $checkValue = abcfsl_autil_value_by_key( $i, $tplateIdxArray );
        $checkedValue = abcfsl_autil_value_by_key( $checkValue, $savedAssocArray );
        $checkRow .= abcfsl_mbox_item_cbo_check_field( $checkValue, $checkedValue, $F, $i );

        $renderedQty++;

        if( $renderedQty ==  $colQty ){
            $checkAll .= $checkGrpRowS . $checkRow . $divE;
            $checkRow = '';
            $renderedQty = 0;
        }
    }

    if( $renderedQty <  $colQty ){
        $missingCols = abcfsl_mbox_item_cbo_missing_cols( $colQty, $renderedQty );
        $checkAll .= $checkGrpRowS . $checkRow . $missingCols . $divE;
    }

    //--Render output ---------------------
    echo abcfl_input_hline('1', '10');;
    echo $fieldsRO;
    echo $checkGrpCntrS . $checkAll . $divE;
    //echo $checkAll;  
    echo abcfl_input_hlp_lbl( $inputHlp, 'abcflMTop10 abcflFldHlpUnder abcflFontS14' );    
    echo abcfl_input_hline('1', '10');

}

function abcfsl_mbox_item_cbo_check_field( $checkValue, $savedValue, $F, $i){

    $check =  abcfl_input_checkbox_grp( 
        'checkg_' . $F . '[' . $i . ']', 
        '', 
        $checkValue, 
        $savedValue, 
        $checkValue, 
        'abcflFG4Col', 
        '',       
        'abcflFontS14'
    );

    return $check;   
}

function abcfsl_mbox_item_cbo_missing_cols( $colQty, $renderedQty ){

    $missingCols = $colQty - $renderedQty;
    $blankDiv = abcfl_html_tag_cls('div', 'abcflFG4Col', true);

    $out = '';
    switch ($missingCols){

        case 1:
            $out = $blankDiv;
            break;
        case 2:
            $out = $blankDiv . $blankDiv;
            break;  
        case 3:
            $out = $blankDiv . $blankDiv . $blankDiv;
            break;
        case 4:
            $out = $blankDiv . $blankDiv . $blankDiv . $blankDiv;
            break;                            
       default:
            break;
    }
    return $out;

}
//== CHECKG END =============================================
function abcfsl_mbox_item_cbo_STARR( $tplateOptns, $itemOptns, $F, $showField ){

    if($showField == 0) { return ''; }

    $iconMaxQty = isset( $tplateOptns['_iconMaxQty_' . $F] ) ? $tplateOptns['_iconMaxQty_' . $F][0] : '';
    $inputLbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
    $inputHlp = isset( $tplateOptns['_inputHlp_' . $F] ) ? esc_attr( $tplateOptns['_inputHlp_' . $F][0] ) : '';
    $lblTxt = abcfsl_mbox_item_text_line_number( $F , $inputLbl );

    $rating = isset( $itemOptns['_txt_' . $F] ) ? esc_attr( $itemOptns['_txt_' . $F][0] ) : '';

    if($showField == 2) {
        $out = abcfl_input_txt_readonly('ro_txt_' . $F, '', $rating, $lblTxt, '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo $out; 
        return;
    }

    $cboItems = array();
    for ($x = 0; $x <= $iconMaxQty; $x++) {
        $cboItems[$x] = $x;
    } 

    $out = abcfl_input_cbo( 'txt_' . $F, 
        '', 
        $cboItems, 
        $rating, 
        $lblTxt, 
        $inputHlp, 
        '50%', 
        false, 
        '', 
        '', 
        'abcflFldCntr', 
        'abcflFldLbl', '');

    echo $out;       
}

