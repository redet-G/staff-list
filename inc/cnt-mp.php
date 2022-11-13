<?php
//Before print delete.
//Returns MP content + container. 
//Called from cnt.php.

//== MP FIELD START ========================================== 
function abcfsl_cnt_MP( $par, $tplateOptns, $itemOptns ){

    $spanMP = '';
    $F = $par['F'];
    $masterF = $par['masterF'];
    if( $masterF == '' ){ $masterF = $F; }

    //-----------------------------------------------------------
    $addSpan = true;
    // Get field content. Each part enclosed in span tags.
    $spanMP = abcfsl_cnt_MP_field( $tplateOptns, $itemOptns, $F, $masterF, $par['isSingle'], $addSpan );
    if( abcfl_html_isblank( $spanMP ) ) { return ''; }
    //-----------------------------------------------------------

    // Checkbox Create link to single page.
    $sPgLnkMP = isset( $tplateOptns['_sPgLnkMP_' . $F] ) ? $tplateOptns['_sPgLnkMP_' . $F][0] :'0';
    if( $sPgLnkMP == 1 ) { 
        $spanMP = abcfsl_cnt_MP_SPTL( $par, $itemOptns, $spanMP );
    }
    //-----------------------------------------------------------

    $cntrS = abcfl_html_tag( $par['tagType'], '', $par['tagCls'] . $par['fieldTypeF'], $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);

    return $cntrS . $spanMP . $cntrE;

//<div class="abcfslMT15  abcfslF18_6 lstMP1">
//<span class="abcfslMP2">Ashworth, </span>
//<span class="abcfslMP1">Jessica </span>
//<span class="abcfslMP3">Title </span>
//<span class="abcfslMP4">Super </span>
//</div>
}

// Hyperlink to single page
function abcfsl_cnt_MP_SPTL( $par, $itemOptns, $spanMP ){

    // Staff member option
    $hideSPgLnk = isset( $itemOptns['_hideSPgLnk'] ) ? $itemOptns['_hideSPgLnk'][0] : '0';
    if( $hideSPgLnk == 1 ) { return $spanMP; }
    //-------------------------------------------------
    // Single Page Options. Link parts.
    $parLP['staffID'] = $par['itemID'];
    $parLP['sPageUrl'] = $par['sPageUrl'];
    // Template option: Show Link.
    $parLP['sPgLnkShow'] = $par['sPgLnkShow']; 
    $parLP['sPgLnkNT'] = $par['sPgLnkNT']; 
    $parLP['lineTxt'] = $spanMP;
    $parLP['imgLnkLDefault'] = 0;

    //-------------------------------------------------
    $isImgLink = false;
    $lnkParts = abcfsl_spg_a_tag_lnk_parts( $parLP, $itemOptns, $isImgLink );
    if( empty( $lnkParts['href'] ) ) {  return $spanMP; }
    //-------------------------------------------------

    $aTag = abcfl_html_a_tag_nb( $lnkParts['href'], $spanMP, $lnkParts['target'], $par['lnkCls'], $par['lnkStyle'], '', $lnkParts['onclick'], $lnkParts['args'] );
    return $aTag;
}

//Render MP parts enclosed in spans (display) or just parts (structular data).
function abcfsl_cnt_MP_field( $tplateOptns, $itemOptns, $F, $masterF, $isSingle, $addSpan ){

    $mp1 = isset( $itemOptns['_mp1_' . $masterF] ) ? esc_attr( $itemOptns['_mp1_' . $masterF][0] ) : '';
    $mp2 = isset( $itemOptns['_mp2_' . $masterF] ) ? esc_attr( $itemOptns['_mp2_' . $masterF][0] ) : '';
    $mp3 = isset( $itemOptns['_mp3_' . $masterF] ) ? esc_attr( $itemOptns['_mp3_' . $masterF][0] ) : '';
    $mp4 = isset( $itemOptns['_mp4_' . $masterF] ) ? esc_attr( $itemOptns['_mp4_' . $masterF][0] ) : ''; 
    $mp5 = isset( $itemOptns['_mp5_' . $masterF] ) ? esc_attr( $itemOptns['_mp5_' . $masterF][0] ) : ''; 
    
    if( abcfl_html_isblank( $mp1 . $mp2 . $mp3 . $mp4 . $mp5 ) ) { return ''; }

    // Field data comes from master. Order of fields should come from F main template.

    $orderP1 = isset( $tplateOptns['_orderLP1_' . $F] ) ?  $tplateOptns['_orderLP1_' . $F][0] : '0';
    $orderP2 = isset( $tplateOptns['_orderLP2_' . $F] ) ?  $tplateOptns['_orderLP2_' . $F][0] : '0';
    $orderP3 = isset( $tplateOptns['_orderLP3_' . $F] ) ?  $tplateOptns['_orderLP3_' . $F][0] : '0';
    $orderP4 = isset( $tplateOptns['_orderLP4_' . $F] ) ?  $tplateOptns['_orderLP4_' . $F][0] : '0';
    $orderP5 = isset( $tplateOptns['_orderLP5_' . $F] ) ?  $tplateOptns['_orderLP5_' . $F][0] : '0';

    $sfixP1 = isset( $tplateOptns['_sfixLP1_' . $F] ) ? esc_attr( $tplateOptns['_sfixLP1_' . $F][0] ) : '';
    $sfixP2 = isset( $tplateOptns['_sfixLP2_' . $F] ) ? esc_attr( $tplateOptns['_sfixLP2_' . $F][0] ) : '';
    $sfixP3 = isset( $tplateOptns['_sfixLP3_' . $F] ) ? esc_attr( $tplateOptns['_sfixLP3_' . $F][0] ) : '';
    $sfixP4 = isset( $tplateOptns['_sfixLP4_' . $F] ) ? esc_attr( $tplateOptns['_sfixLP4_' . $F][0] ) : '';
    $sfixP5 = isset( $tplateOptns['_sfixLP5_' . $F] ) ? esc_attr( $tplateOptns['_sfixLP5_' . $F][0] ) : '';

    $pfixP1 = isset( $tplateOptns['_pfixLP1_' . $F] ) ? esc_attr( $tplateOptns['_pfixLP1_' . $F][0] ) : '';
    $pfixP2 = isset( $tplateOptns['_pfixLP2_' . $F] ) ? esc_attr( $tplateOptns['_pfixLP2_' . $F][0] ) : '';
    $pfixP3 = isset( $tplateOptns['_pfixLP3_' . $F] ) ? esc_attr( $tplateOptns['_pfixLP3_' . $F][0] ) : '';
    $pfixP4 = isset( $tplateOptns['_pfixLP4_' . $F] ) ? esc_attr( $tplateOptns['_pfixLP4_' . $F][0] ) : '';  
    $pfixP5 = isset( $tplateOptns['_pfixLP5_' . $F] ) ? esc_attr( $tplateOptns['_pfixLP5_' . $F][0] ) : '';       
    
    if( $isSingle ){
        $orderP1 = isset( $tplateOptns['_orderSP1_' . $F] ) ? $tplateOptns['_orderSP1_' . $F][0] : '0';
        $orderP2 = isset( $tplateOptns['_orderSP2_' . $F] ) ? $tplateOptns['_orderSP2_' . $F][0] : '0';
        $orderP3 = isset( $tplateOptns['_orderSP3_' . $F] ) ? $tplateOptns['_orderSP3_' . $F][0] : '0';
        $orderP4 = isset( $tplateOptns['_orderSP4_' . $F] ) ? $tplateOptns['_orderSP4_' . $F][0] : '0';
        $orderP5 = isset( $tplateOptns['_orderSP5_' . $F] ) ? $tplateOptns['_orderSP5_' . $F][0] : '0';

        $sfixP1 = isset( $tplateOptns['_sfixSP1_' . $F] ) ? esc_attr( $tplateOptns['_sfixSP1_' . $F][0] ) : '';
        $sfixP2 = isset( $tplateOptns['_sfixSP2_' . $F] ) ? esc_attr( $tplateOptns['_sfixSP2_' . $F][0] ) : '';
        $sfixP3 = isset( $tplateOptns['_sfixSP3_' . $F] ) ? esc_attr( $tplateOptns['_sfixSP3_' . $F][0] ) : '';
        $sfixP4 = isset( $tplateOptns['_sfixSP4_' . $F] ) ? esc_attr( $tplateOptns['_sfixSP4_' . $F][0] ) : '';
        $sfixP5 = isset( $tplateOptns['_sfixSP5_' . $F] ) ? esc_attr( $tplateOptns['_sfixSP5_' . $F][0] ) : '';
        
        $pfixP1 = isset( $tplateOptns['_pfixSP1_' . $F] ) ? esc_attr( $tplateOptns['_pfixSP1_' . $F][0] ) : '';
        $pfixP2 = isset( $tplateOptns['_pfixSP2_' . $F] ) ? esc_attr( $tplateOptns['_pfixSP2_' . $F][0] ) : '';
        $pfixP3 = isset( $tplateOptns['_pfixSP3_' . $F] ) ? esc_attr( $tplateOptns['_pfixSP3_' . $F][0] ) : '';
        $pfixP4 = isset( $tplateOptns['_pfixSP4_' . $F] ) ? esc_attr( $tplateOptns['_pfixSP4_' . $F][0] ) : '';
        $pfixP5 = isset( $tplateOptns['_pfixSP5_' . $F] ) ? esc_attr( $tplateOptns['_pfixSP5_' . $F][0] ) : '';
    }

    $nameParts = array();
    if( abcfsl_cnt_MP_field_not_empty( $orderP1, $mp1 ) ) { $nameParts[1] = abcfsl_cnt_MP_field_array( $orderP1, $mp1, $pfixP1, $sfixP1, 'MP1' ); }
    if( abcfsl_cnt_MP_field_not_empty( $orderP2, $mp2 ) ) { $nameParts[2] = abcfsl_cnt_MP_field_array( $orderP2, $mp2, $pfixP2, $sfixP2, 'MP2' ); }
    if( abcfsl_cnt_MP_field_not_empty( $orderP3, $mp3 ) ) { $nameParts[3] = abcfsl_cnt_MP_field_array( $orderP3, $mp3, $pfixP3, $sfixP3, 'MP3' ); }
    if( abcfsl_cnt_MP_field_not_empty( $orderP4, $mp4 ) ) { $nameParts[4] = abcfsl_cnt_MP_field_array( $orderP4, $mp4, $pfixP4, $sfixP4, 'MP4' ); }
    if( abcfsl_cnt_MP_field_not_empty( $orderP5, $mp5 ) ) { $nameParts[5] = abcfsl_cnt_MP_field_array( $orderP5, $mp5, $pfixP5, $sfixP5, 'MP5' ); }

    //Rendered on the page. All parts are in span tag.
    if( $addSpan ){
        return abcfsl_cnt_MP_name_builder_spans( $nameParts );
    }

    //Structural data output - no spans.
    return abcfsl_cnt_MP_name_builder_struct_txt( $nameParts );
}

function abcfsl_cnt_MP_name_builder_struct_txt( $nameParts ){

    //Reorder arrays of field parts by field order.    
    usort( $nameParts, 'abcfsl_cnt_MP_fields_fix_sort' );

    $structTxt = '';
    foreach ( $nameParts as $values ) {
        foreach ($values as $key => $value) {
            switch ( $key ){
                case 'mp':
                    $structTxt .= $value . ' '; 
                    break;
                default:
                    break;
            }
        }
    }
    return $structTxt;
}

function abcfsl_cnt_MP_name_builder_spans( $nameParts ){

    // [1] => Array
    //     (
    //         [pfix] => 
    //         [mp] => Jan
    //         [sfix] => 
    //         [order] => 1
    //         [part] => MP1
    //     )

    //Reorder arrays of field parts by field order.    
    usort( $nameParts, 'abcfsl_cnt_MP_fields_fix_sort' );

    $partsQty = count( $nameParts );

    $partTxt = '';
    $spans = '';
    $i = 0;
    $partNo = '';
    $pfix = '';
    //Multidimensional associative array
    $partsArray = array();
    //associative array index
    $arrayIdx = 0;
    foreach ( $nameParts as $values ) {
        $arrayIdx++;
        foreach ($values as $key => $value) {
            switch ( $key ){
                case 'pfix':                    
                    $pfix = $value;
                    $i++;
                    break;
                case 'mp':
                    $partTxt .= $value;
                    $i++;
                    break;
                case 'sfix':
                    // Hide suffix if rendered as last part.
                    if( $arrayIdx < $partsQty ) { $partTxt .= $value; }                
                    //$partTxt .= $value;
                    $i++;
                    break;
                case 'part':
                    $partNo = $value;
                    $i++;
                    break;
                default:
                    break;
            }

            if( $i == 4 ){
                $partsArray = abcfsl_cnt_MP_prefix( $partsArray, $pfix, $arrayIdx, $partNo, $partTxt );
                $partTxt = '';
                $partNo = '';
                $pfix = '';
                $i = 0;
            }
        }
    }

    foreach ( $partsArray as $partArray ) {
        $spans .= '<span class="abcfslSpan' . $partArray['partNo'] . '">' . $partArray['txt'] . ' </span>';
    }
    return $spans;
}

//Add or move prefix.
function abcfsl_cnt_MP_prefix( $partsArray, $pfix, $arrayIdx, $partNo, $partTxt ){

    if( abcfl_html_isblank( $pfix ) ) { 
        $partsArray[$arrayIdx]['partNo'] = $partNo;
        $partsArray[$arrayIdx]['txt'] = $partTxt;
        return $partsArray;
    }

    $pfix = abcfsl_cnt_MP_prefix_space( $pfix );

    if ( $arrayIdx == 1 ) { 
        $partsArray[$arrayIdx]['partNo'] = $partNo;
        $partsArray[$arrayIdx]['txt'] = $pfix . $partTxt;
        return $partsArray;
    }    

    $moveTo = $arrayIdx -1;
    $partsArray[$moveTo]['txt'] = $partsArray[$moveTo]['txt'] . $pfix;
    $partsArray[$arrayIdx]['partNo'] = $partNo;
    $partsArray[$arrayIdx]['txt'] = $partTxt;
    
    return $partsArray;

    // $xarray[1]['partNo'] = 'MP1';
    // $xarray[1]['txt'] = 'Ashworth,';
    // $xarray[2]['partNo'] = 'MP1';
    // $xarray[2]['txt'] = 'Jessica;';
}

//Add nbsp before prefix to have leading or trailing space.
function abcfsl_cnt_MP_prefix_space( $pfix ){

    if( abcfl_util_starts_with ( $pfix, 'nbsp ' ) ){
        $pfix = ' ' . substr( $pfix, 5 );
        return $pfix;
    }

    if( abcfl_util_ends_with ( $pfix, ' nbsp' ) ){
        $pfix = substr($pfix, 0, -5) . ' ';
        return $pfix;
    }
    return $pfix;
}

function abcfsl_cnt_MP_field_not_empty( $order, $mp ){
    if( $order != 0 && !abcfl_html_isblank( $mp ) ){
        return true;
    }
    return false;
}

function abcfsl_cnt_MP_field_array( $order, $mp, $pfix, $sfix, $part ){
    return array(        
        'pfix' => $pfix,
        'mp' => $mp,         
        'sfix' => $sfix, 
        'order' => $order,         
        'part' => $part 
    );
}

function abcfsl_cnt_MP_fields_fix_sort( $a, $b ){
    return $a['order'] - $b['order'];
}