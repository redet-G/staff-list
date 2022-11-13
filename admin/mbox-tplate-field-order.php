<?php
//Before print delete.
function abcfsl_mbox_tplate_field_order( $tplateID, $tplateOptns, $isSingle, $divID ){

    echo  abcfl_html_tag('div', $divID,'inside hidden abcflFadeIn');

        $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '0';
        $lstLayoutH = isset( $tplateOptns['_lstLayoutH'] ) ? esc_attr( $tplateOptns['_lstLayoutH'][0] ) : $lstLayout;
        if($lstLayoutH == '0'){
            echo abcfl_html_tag_end('div');
            return;
        }
        //Sort fields container
        $out = abcfsl_tplate_field_order_sort_cntr( $tplateID, $tplateOptns, $isSingle );
        echo $out['msg'];
        echo $out['sortCntr'];

    echo abcfl_html_tag_end('div');
}
//-------------------------------------------------------------------------------------
//Render sort fields container
function abcfsl_tplate_field_order_sort_cntr( $tplateID, $tplateOptns, $isSingle ){

    $items = '';
    $fieldsQty = 0;
    $sortSuffix = 'L';
    if( $isSingle ) { $sortSuffix = 'S'; }

    //[1] => F1; [2] => F4; [3] => F5; [8] => SL
    $fieldOrder = abcfsl_autil_field_order_saved( $tplateID, $isSingle );

    foreach ( $fieldOrder as $order => $F ) {

        $lineName = isset( $tplateOptns['_lnkUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlLbl_' . $F][0] ) : '';
        $lineName = isset( $tplateOptns['_lnkLblLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkLblLbl_' . $F][0] ) : $lineName;
        $lineName = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : $lineName;
        $lineName = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : $lineName;
        //$lineName = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : $lineName;

        if( empty( $lineName )){
            $lineName = isset( $tplateOptns['_inputLblP1_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP1_' . $F][0] ) : '';
            $lineName = trim($lineName . ' ' . (isset( $tplateOptns['_inputLblP2_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP2_' . $F][0] ) : ''));
        }

        // TODO SL
        //Hidden field. Fileld type. N = field not selected yet.
        $fieldTypeH = isset( $tplateOptns['_fieldTypeH_' . $F] ) ? $tplateOptns['_fieldTypeH_' . $F][0] : 'N';
        $fieldType = $fieldTypeH; //??????????????????
        $showField = $fieldTypeH;
        $showOn = isset( $tplateOptns['_showField_' . $F] ) ? $tplateOptns['_showField_' . $F][0] : 'L';

        if( $F == 'SL' ){
            $showField = isset( $tplateOptns['_showSocial'] ) ? $tplateOptns['_showSocial'][0] : 'N';
            $fieldType = 'SL';
            $showOn = isset( $tplateOptns['_showSocialOn'] ) ? $tplateOptns['_showSocialOn'][0] : 'Y';
        }

        if( $F == 'SPTL' ){
            $showField = isset( $tplateOptns['_sPgLnkShow'] ) ? $tplateOptns['_sPgLnkShow'][0] : 'N';
            $lineName = isset( $tplateOptns['_sPgLnkTxt'] ) ? $tplateOptns['_sPgLnkTxt'][0] : '';

            // Don't add if Link Text is empty.
            if( empty( $lineName ) ) { $showField = 'N'; }

            $fieldType = 'SPTL';
            $fieldTypeH = 'SPTL';
            $showOn = 'L';
        }

        $addToList = abcfsl_tplate_field_order_show_field( $showOn, $showField, $isSingle );

        if( $addToList ){
            $items .= abcfsl_tplate_field_order_li( $F, $order, $fieldTypeH, $fieldType, $lineName );
            $fieldsQty++;
        }
    }
    
    $out['msg'] = abcfl_input_info_lbl(abcfsl_txta(214), 'abcflMTop15 abcflMBottom15', 16, 'SB');
    $out['sortCntr'] = '';

    if( $fieldsQty > 0 ){
        $out['msg'] = abcfl_input_info_lbl(abcfsl_txta(255), 'abcflMTop15 abcflMBottom15', 14, 'SB');
        $out['sortCntr'] = abcfsl_tplate_field_order_cntr($tplateID, $sortSuffix, $items);
    }
    return $out;
}

//Check if field should be included in sort fields container
function abcfsl_tplate_field_order_show_field( $showOn, $showField, $isSingle ){

    //$showField: N = field is not selected.
    //$showField: N = showSocial, sPgLnkSho
    //Hidden fields are added to sort fields container.
    if( $showField == 'N' ){ return false; }

    $out = false;
    switch ( $showOn ) {
    case 'Y':
        $out = true;
        break;
    case 'L':
        if( !$isSingle ){ $out = true; }
        break;
    case 'S':
        if($isSingle ){ $out = true; }
        break;
    default:
        break;
    }

    return $out;
}

//LI buider.
function abcfsl_tplate_field_order_li( $F, $order, $fieldTypeH, $selectedFieldType, $lineName ){

        $clsLi = 'sortable-item';
        $idLi = $F;

        $clsSort = 'abcflFontFVS12';
        if( $fieldTypeH != 'N' ){ $clsSort = 'abcflFontFVS12 abcflFontW700'; }

        $clsName = 'abcflPLeft10 abcflFontFVS12';

        $lineNumber = $order . ' - '. $idLi . '&nbsp;';
        $fieldType = abcfsl_tplate_field_order_field_type( $selectedFieldType );

        $liS = abcfl_html_tag('li',  $idLi, $clsLi );
        $spanSort = abcfl_html_tag( 'span', '', $clsSort) .$lineNumber . '</span>';
        $spanName = abcfl_html_tag( 'span', '', $clsName) . $lineName . '</span>';
        $spanFieldType = abcfl_html_tag( 'span', '', 'abcflPLeft10') . $fieldType . '</span>';

        return $liS . $spanSort . $spanName . $spanFieldType. '</li>';
}

function abcfsl_tplate_field_order_cntr( $tplateID, $sortSuffix, $items ){

    $divID = 'fieldsSortCntr' . $sortSuffix;
    $divCls = 'abcflWidth60Pc';
    $divS = abcfl_html_tag( 'div', $divID, $divCls );
    $divE = '</div>';

    $ulCls = 'sortable-list ui-sortable';
    $ulID = 'ul' . $sortSuffix . '_' . $tplateID;
    $ulS = abcfl_html_tag( 'ul', $ulID, $ulCls );

    return $divS . $ulS . $items . '</ul>' . $divE;
}

//Labels displayed next to field names on sort screen.
function abcfsl_tplate_field_order_field_type( $selectedFieldType ){

    $out = '';
    $fieldType = '';
    if( $selectedFieldType != 'N '){
        switch ($selectedFieldType) {
            case 'MITEMTXT':
                $fieldType = 'Milestone Item Text';
                break;
            case 'MITEMDTS':
                $fieldType = 'Milestone Item Dates';
                break;
            case 'SL':
                $fieldType = 'Social Icons';
                break;
            case 'SPTL':
                $fieldType = 'Single Page Text Link';
                break;
            case 'T':
                $fieldType = 'Txt';
                break;
            case 'MP':
                $fieldType = 'Name - Multipart';
                break;
             case 'LT':
                $fieldType = 'Static Lbl (inline) + Txt';
                break;
            case 'LTABOVE':
                $fieldType = 'Static Lbl (above) + Txt';
                break; 
            case 'PTABOVE':
                $fieldType = 'Static Lbl (above) + Paragraph';
                break;                               
             case 'STXT':
                $fieldType = 'Static Txt';
                break;
            case 'H':
                $fieldType = 'Link';
                break;
            case 'TH':
                $fieldType = 'Static Txt + Link';
                break;
            case 'CE':
                $fieldType = 'Txt Editor';
                break;
            case 'EM':
                $fieldType = 'Email';
                break;
            case 'STXEM':
                $fieldType = 'Email - Static Txt';
                break;                
            case 'PT':
                $fieldType = 'Paragraph';
                break;
            case 'SC':
                $fieldType = 'Shortcode';
                break;
            case 'CBO':
                $fieldType = 'Drop-down';
                break;
            case 'LBLCBO':
                $fieldType = 'Static Lbl + Drop-down';
                break; 
            case 'SLFONE':
                $fieldType = 'Static Lbl + Phone';
                break;
            case 'FONE':
                $fieldType = 'Phone';
                break;                                                             
            case 'HL':
                $fieldType = 'Horizontal Line';
                break;
            case 'CBOM':
                $fieldType = 'Drop-Down Group';
                break;            
            case 'CHECKG':
                $fieldType = 'Checkbox Group';
                break;               
            case 'IMGCAP':
                $fieldType = abcfsl_txta(449);
                break; 
            case 'IMGHLNK':
                $fieldType = abcfsl_txta(448);
                break; 
            case 'SLDTE':
                $fieldType = abcfsl_txta(390);
                break; 
            case 'STARR':
                $fieldType = 'Icon Font - Star Rating';
                break;  
            case 'ICONLNK':
                $fieldType = 'Icon Font with Links';
                break; 
            case 'STFFCAT':
                $fieldType = 'Staff Categories';
                break; 
            case 'POSTTITLE':
                $fieldType = abcfsl_txta(384);
                break; 
            case 'SORTTXT':
                $fieldType = abcfsl_txta(61);
                break; 
            case 'VCARDHL':
                $fieldType = 'vCard Hyperlink';
                break;
            case 'QRHL64STA':
                $fieldType = 'QR Code Hyperlink - Base64 Static';
                break;
            case 'QRHL64DYN':
                $fieldType = 'QR Code Hyperlink - Base64 Dynamic';
                break; 
            case 'QRIMGCAP64STA':
                $fieldType = abcfsl_txta(441);
                break;  
            case 'QRIMGCAP64DYN':
                $fieldType = abcfsl_txta(447);
                break;                                             
            case 'ADDRST':
                $fieldType = 'Address Static';
                break;
            case 'ADDR':
                $fieldType = 'Address';
                break;                                                                                                      
            default:
                break;
        }
        $out = '[' . $fieldType . ']';
    }
    return $out;

    // case 'SH':
    //     $fieldType = 'Single Page Link';
    //     break;
}

