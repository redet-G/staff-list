<?php
//IMAGE container.
// 1. abcfsl_cnt_list_item_cntr; abcfsl_cnt_spage_img_cntr
// 3. abcfsl_cnt_grid_item
function abcfsl_cnt_img_cntr( $tplateOptns, $itemOptns, $par ){

    $pgLayout = $par['pgLayout'];
    //Staff member ID
    $itemID = $par['itemID'];
    $colL = $par['colL'];
    $pfix = $par['clsPfix'];
    $isSingle = $par['isSingle'];
    $custCls = $par['custCls'];

    $imgOptns = abcfsl_cnt_img_options( $tplateOptns, $itemOptns, $par );

    $imgCntr['cntrS'] = '';
    $imgCntr['cntrE'] = '';
    $imgCntrCustCls = $imgOptns['imgHover'];

    //PRO ---
    // ISOTOPE
    //Image container. Used for all layouts + Single page.
    //Has all hover classes. List 1; Grid A 3; Grid B 2; Single 100;
    switch ( $pgLayout ) {
        case 1:
            $imgCntr = abcfsl_cnt_img_list_img_cntr( $colL, $imgCntrCustCls, '', $pfix );
            break;
        case 2:
            $imgCntr = abcfsl_cnt_img_grid_b_img_cntr( $colL, $imgCntrCustCls, '', $pfix );
            break;
        case 3:
            $imgCntr = abcfsl_cnt_img_grid_a_img_cntr( $pfix, 'ImgCntrGridA', $imgCntrCustCls, '', '', $itemID, 'N', $isSingle );
            break;
        case 100:
            $imgCntr = abcfsl_cnt_img_single_pg_img_cntr( $colL, $custCls, $pfix );
            break;            
        case 200:
            $imgCntr = abcfsl_cnt_img_igrid_a_img_cntr( $pfix, 'ImgCntrIGridA', $imgCntrCustCls, '', '', $itemID, 'N', $isSingle );
            break;
        case 201:
            $imgCntr = abcfsl_cnt_img_igrid_b_img_cntr( $colL, $imgCntrCustCls, '', $pfix, '' );
            break;
        default:
            break;
    }

    //Img container
    return $imgCntr['cntrS'] . $imgOptns['imgATag'] . $imgOptns['overATag'] . $imgCntr['cntrE'];
}
//=======================================================================
function abcfsl_cnt_img_tag( $tplateOptns, $itemOptns, $isSingle, $pgLayout, $pfix ){

    //$imgCenter = isset( $tplateOptns['_imgCenter'] ) ? esc_attr( $tplateOptns['_imgCenter'][0] ) : 'Y';
    $imgHover = isset( $tplateOptns['_imgHover'] ) ? $tplateOptns['_imgHover'][0]  : '';
    $imgCircle = isset( $tplateOptns['_imgCircle'] ) ? $tplateOptns['_imgCircle'][0] : '';
    $imgDS = isset( $tplateOptns['_imgDS'] ) ? $tplateOptns['_imgDS'][0] : '';
    $imgCls = isset( $tplateOptns['_lstImgCls'] ) ? esc_attr( $tplateOptns['_lstImgCls'][0] ) : '';
    $imgBorder = isset( $tplateOptns['_imgBorder'] ) ? esc_attr( $tplateOptns['_imgBorder'][0] ) : 'D';
    $imgStyle = isset( $tplateOptns['_lstImgStyle'] ) ? esc_attr( $tplateOptns['_lstImgStyle'][0] ) : '';
    $imgAttr = isset( $tplateOptns['_imgAttr'] ) ? esc_attr( $tplateOptns['_imgAttr'][0] ) : '';


    //Image Custom Class
    $lstImgCls = abcfsl_util_pg_type_cls_bldr( $imgCls, $isSingle );
    $imgBorderCls = abcfsl_util_cls_name_nc_bldr( $imgBorder, 'ImgBorder', $pfix );
    $clsImgDS =  abcfsl_util_cls_bldr( $imgDS, $pfix );
    $clsCircle = abcfsl_cnt_img_circle( $imgCircle, $isSingle, $pfix );

    //$fluid = '';
    //if( $imgHover == 'overlay' && $pgLayout != 100 ){ $fluid = $pfix . 'ImgFluid '; }

    //Custom classes and style added to an image tag NOT an image container.
    //$imgClasses = trim( $fluid . $imgBorderCls . ' ' . $clsImgDS. ' ' . $lstImgCls . $clsCircle );
    $imgClasses = trim( $imgBorderCls . ' ' . $clsImgDS. ' ' . $lstImgCls . $clsCircle );
    //--------------------------------------------------------------------

    $imgUrl = isset( $itemOptns['_imgUrlL'] ) ? esc_attr( $itemOptns['_imgUrlL'][0] ) : '';
    $imgAttrL = isset( $itemOptns['_imgAttrL'] ) ? esc_attr( $itemOptns['_imgAttrL'][0] ) : '';

    if( empty( $imgUrl ) ){
        $placeholder = abcfsl_img_placeholder( $tplateOptns, $isSingle );
        $imgUrl = $placeholder['imgUrl'];
        if( empty( $imgUrl ) ){ return ''; }
    }
    //------------------------------------------------------
    //If ALT is empty. We'll try to get it from media library by image ID.
    //$imgIDL = isset( $itemOptns['_imgIDL'] ) ? $itemOptns['_imgIDL'][0] : 0;
    //$imgIDL = '0'; //???????????????????
    $imgAlt = isset( $itemOptns['_imgAlt'] ) ? esc_attr( $itemOptns['_imgAlt'][0] ) : '';
    // DEPRECATED LIB
    //$alt = abcfsl_img_alt( $imgIDL, $imgUrl, $imgAlt );
    $lPgImgAttr = abcfsl_cnt_img_attr_l( $imgAttr, $imgAttrL );

    //$imgAttr = 'loading="lazy"';
    return abcfl_html_img_tag_resp( '', $imgUrl, $imgAlt, '', $imgClasses, $imgStyle, $lPgImgAttr);
}

function abcfsl_cnt_img_attr_l( $imgAttr, $imgAttrL ){
    if( !empty( $imgAttrL ) ) { return $imgAttrL; }
    return $imgAttr;
}

function abcfsl_cnt_img_options( $tplateOptns, $itemOptns, $par ){

    $pgLayout = $par['pgLayout'];
    //staff member ID
    //$itemID = $par['itemID'];
    $pfix = $par['clsPfix'];
    $sPageUrl = $par['sPageUrl'];
    $isSingle = $par['isSingle'];

    //Single page Url or Url entered in text field. ????????
    $imgHover = isset( $tplateOptns['_imgHover'] ) ? $tplateOptns['_imgHover'][0]  : '';
    $imgCntrMLR = isset( $tplateOptns['_imgCntrMLR'] ) ? $tplateOptns['_imgCntrMLR'][0] : '';
    //$imgLnkL = isset( $itemOptns['_imgLnkL'] ) ? esc_attr( $itemOptns['_imgLnkL'][0] ) : '';

    $imgTag = abcfsl_cnt_img_tag( $tplateOptns, $itemOptns, $isSingle, $pgLayout, $pfix );

    // Single Page Options. Link parts
    $parLP['staffID'] = $par['itemID'];
    $parLP['sPageUrl'] = $sPageUrl;
    $parLP['sPgLnkShow'] = isset( $tplateOptns['_sPgLnkShow'] ) ? $tplateOptns['_sPgLnkShow'][0] : 'N';
    $parLP['sPgLnkNT'] = isset( $tplateOptns['_sPgLnkNT'] ) ? $tplateOptns['_sPgLnkNT'][0] : 0;
    $parLP['lineTxt'] = '';
    $parLP['imgLnkLDefault'] = isset( $tplateOptns['_imgLnkLDefault'] ) ? $tplateOptns['_imgLnkLDefault'][0] : 0;
    
    $lnkParts = abcfsl_spg_a_tag_lnk_parts( $parLP, $itemOptns, true );
//------------------------------------------------------------
    // O=Overlay, S=Single, N=Normal
    $imgLayout = 'N';
    if( $imgHover == 'overlay' ) { $imgLayout = 'O'; }
    if( $isSingle ) { $imgLayout = 'S'; }

    $out['imgHover'] = '';
    $out['imgATag'] = '';
    $out['overATag'] = '';

    switch ( $imgLayout ) {
        case 'N':
            $out = abcfsl_cnt_img_imgATag( $imgHover, $imgTag, $lnkParts, $pfix );
            break;
        case 'O':
            $out = abcfsl_cnt_img_overATag( $tplateOptns, $itemOptns, $imgHover, $imgTag, $lnkParts, $pfix );
            break;
        case 'S':
            $out['imgATag'] = $imgTag;
            break;
        default:
            break;
    }

    //$clsImgCntrMLR = abcfsl_util_cls_bldr( $imgCntrMLR, $pfix );
    $out['imgHover'] = trim($out['imgHover'] . ' ' . abcfsl_util_cls_bldr( 'MLRPc' . $imgCntrMLR, $pfix ));

    return $out;
}

function abcfsl_cnt_img_imgATag( $imgHover, $imgTag, $lnkParts, $pfix ){

    $out['imgHover'] = abcfsl_util_cls_bldr( $imgHover, $pfix );

    $out['imgATag'] = abcfl_html_a_tag_img( $lnkParts['href'], $imgTag, $lnkParts['target'], '', '', $lnkParts['onclick'], $lnkParts['args'] );
    $out['overATag'] = '';

    return $out;
}

function abcfsl_cnt_img_overATag( $tplateOptns, $itemOptns, $imgHover, $imgTag, $lnkParts, $pfix ){

    $overlayCntr = abcfsl_cnt_img_over_txt_cntr( $tplateOptns, $itemOptns, $pfix );

    $hrefUrl = $lnkParts['href'];

    if( empty( $overlayCntr ) || empty( $hrefUrl ) ) {
        return abcfsl_cnt_img_imgATag( $imgHover, $imgTag, $lnkParts, $pfix );
    }

    $out['imgHover'] = $pfix . 'Overlay';
    $out['imgATag'] = $imgTag;
    $out['overATag'] = abcfl_html_a_tag_nb( $lnkParts['href'], $overlayCntr, $lnkParts['target'], '', '', '', $lnkParts['onclick'], $lnkParts['args'] );

    return $out;
}

function abcfsl_cnt_img_over_txt_cntr( $tplateOptns, $itemOptns, $pfix ){

    $overTxtT1 = isset( $tplateOptns['_overTxtT1'] ) ? esc_attr( $tplateOptns['_overTxtT1'][0] ) : '';
    $overTxtT2 = isset( $tplateOptns['_overTxtT2'] ) ? esc_attr( $tplateOptns['_overTxtT2'][0] ) : '';
    $overTxtI1 = isset( $itemOptns['_overTxtI1'] ) ? esc_attr( $itemOptns['_overTxtI1'][0] ) : '';
    $overTxtI2 = isset( $itemOptns['_overTxtI2'] ) ? esc_attr( $itemOptns['_overTxtI2'][0] ) : '';

    $imgCircle = isset( $tplateOptns['_imgCircle'] ) ? $tplateOptns['_imgCircle'][0] : '';
    $clsCircle = abcfsl_cnt_img_circle( $imgCircle, false, $pfix );

    $overTxt1 = $overTxtI1;
    if( empty ( $overTxtI1 ) ) { $overTxt1 = $overTxtT1; }
    $overTxt2 = $overTxtI2;
    if( empty ( $overTxtI2 ) ) { $overTxt2 = $overTxtT2; }
    if( empty ( $overTxt1 ) && empty ( $overTxt2 ) ) { return ''; }

    //--Text Classes -------------------------
    $overFont1 = isset( $tplateOptns['_overFont1'] ) ? esc_attr( $tplateOptns['_overFont1'][0] ) : 'D';
    $overFont2 = isset( $tplateOptns['_overFont2'] ) ? esc_attr( $tplateOptns['_overFont2'][0] ) : 'D';
    $overTM = isset( $tplateOptns['_overTM'] ) ? esc_attr( $tplateOptns['_overTM'][0] ) : 'N';

    //Font Size. Class name or empty string if Default or Custom selected.
    $overTxt1Cls = abcfsl_util_cls_name_nc_bldr( $overFont1, 'F', $pfix );

    //Top margin. Class name or empty string if Default or Custom selected.
    $overTxt2Cls = ltrim ( abcfsl_util_cls_name_nc_bldr( $overTM, 'PadT', $pfix ) . ' ' . abcfsl_util_cls_name_nc_bldr( $overFont2, 'F', $pfix )  );
    $overWrapCls = $pfix . 'Mask ' . $pfix . 'FlexCenter ' . $pfix . 'WhiteText' . $clsCircle;
    //--------------------------------------

    $divE = abcfl_html_tag_end( 'div');
    $txt1Cntr = '';
    if( !empty( $overTxt1 )) {
        $txt1Cntr = abcfl_html_tag( 'div', '', $overTxt1Cls, '' ) . $overTxt1 . $divE;
    }

    $txt2Cntr = '';
    if( !empty( $overTxt2 )) {
        $txt2Cntr = abcfl_html_tag( 'div', '', $overTxt2Cls, '' ) . $overTxt2 . $divE;
    }

    //anchorTxt
    return abcfl_html_tag( 'div', '', $overWrapCls, '' ) . $txt1Cntr . $txt2Cntr . $divE;
}

//============================================================================
//List. Image container.
function abcfsl_cnt_img_list_img_cntr( $colL, $customCls, $customStyle, $pfix ){

    $colCls = $pfix . 'LstCol ' . $pfix . 'LstCol-' . $colL . ' ' . $pfix . 'ImgColLst';

    $imgColS = abcfl_html_tag( 'div', '', $colCls, '' );
    $imgCntrS = abcfl_html_tag( 'div', '', trim( $pfix . 'ImgCntrLst ' . $customCls ), $customStyle );

    $div['cntrS'] = $imgColS . $imgCntrS;
    $div['cntrE'] = abcfl_html_tag_ends( 'div,div');
    return $div;
}

//Grid A. Image container.
function abcfsl_cnt_img_grid_a_img_cntr( $pfix, $baseCls, $customCls, $customStyle, $divID, $itemID, $addItemCls, $isSingle ){

    $cntrCls = abcfsl_cnt_class_bldr( $pfix, $baseCls, $customCls, $isSingle, $addItemCls, $itemID );

    $div['cntrS'] = abcfl_html_tag( 'div', $divID, $cntrCls, $customStyle );
    $div['cntrE'] = abcfl_html_tag_end( 'div');

    return $div;
}

//Grid B. Image container.
function abcfsl_cnt_img_grid_b_img_cntr( $colL, $customCls, $customStyle, $pfix ){


    $colCls = $pfix . 'LstCol ' . $pfix . 'LstCol-' . $colL . ' ' . $pfix . 'ImgColGridB';

    $imgColS = abcfl_html_tag( 'div', '', $colCls, '' );
    $imgCntrS = abcfl_html_tag( 'div', '', trim( $pfix . 'ImgCntrGridB ' . $customCls ), $customStyle );

    $div['cntrS'] = $imgColS . $imgCntrS;
    $div['cntrE'] = abcfl_html_tag_ends( 'div,div');
    return $div;
}

//$imgCntr = abcfsl_cnt_img_i_a_img_cntr_div( $colL, $pfix, 'LstImg', $imgCntrCustCls, '' );
function abcfsl_cnt_img_igrid_a_img_cntr( $pfix, $baseCls, $customCls, $customStyle, $divID, $itemID, $addItemCls, $isSingle ){

    $cntrCls = abcfsl_cnt_class_bldr( $pfix, $baseCls, $customCls, $isSingle, $addItemCls, $itemID );

    $div['cntrS'] = abcfl_html_tag( 'div', $divID, $cntrCls, $customStyle );
    $div['cntrE'] = abcfl_html_tag_end( 'div');

    return $div;
}

function abcfsl_cnt_img_igrid_b_img_cntr( $colL, $customCls, $customStyle, $pfix ){

    $colCls = $pfix . 'LstCol ' . $pfix . 'LstCol-' . $colL . ' ' . $pfix . 'ImgColIGridB';

    $imgColS = abcfl_html_tag( 'div', '', $colCls, '' );
    $imgCntrS = abcfl_html_tag( 'div', '', trim( $pfix . 'ImgCntrIGridB ' . $customCls ), $customStyle );

    $div['cntrS'] = $imgColS . $imgCntrS;
    $div['cntrE'] = abcfl_html_tag_ends( 'div,div');
    return $div;
}

function abcfsl_cnt_img_single_pg_img_cntr( $colL, $customCls, $pfix ){

    //'SPgImg',
    //abcfslSPgImgCol
    $colCls = $pfix . 'LstCol ' . $pfix . 'LstCol-' . $colL . ' ' . $pfix . 'ImgColSPg';

    $imgColS = abcfl_html_tag( 'div', '', $colCls, '' );
    $imgCntrS = abcfl_html_tag( 'div', '', trim( $pfix . 'ImgCntrSPg ' . $customCls ), '' );

    $div['cntrS'] = $imgColS . $imgCntrS;
    $div['cntrE'] = abcfl_html_tag_ends( 'div,div');
    return $div;
}

//--------------------------------------------------
function abcfsl_cnt_img_circle( $imgCircle, $isSingle, $pfix ){

    $clsCircle = '';
    if( $isSingle ) {
        if( $imgCircle == 'S' || $imgCircle == 'Y' ) { $clsCircle = ' ' . $pfix . 'RoundedCircle'; }
    }
    else{
        if( $imgCircle == 'L' || $imgCircle == 'Y' ) { $clsCircle = ' ' . $pfix . 'RoundedCircle'; }
    }

    return $clsCircle;
}



//######################################################################
//List, Grid B. Image container div.
//function abcfsl_cnt_img_i_a_img_cntr_div( $colSize, $pfix, $colBaseCls, $customCls, $customStyle ){
//
//    $colCls = ' ' . $pfix . $colBaseCls . 'Col';
//    if( !empty($customCls) ){ $customCls = ' ' . $customCls; }
//
//    $cls = 'ILstCol';
//    $colCls = $pfix . $cls . ' ' . $pfix . $cls . '-' . $colSize . $colCls;
//
//    $colS = abcfl_html_tag( 'div', '', $colCls, '' );
//    $cntrS = abcfl_html_tag( 'div', '', $pfix . $colBaseCls . 'Cntr' . $customCls, $customStyle );
//
//    $div['cntrS'] = $colS . $cntrS;
//    $div['cntrE'] = abcfl_html_tag_ends( 'div,div');
//
//    return $div;
//}

//$imgCntr = abcfsl_cnt_img_i_a_img_cntr_div( $colL, $pfix, 'LstImg', $imgCntrCustCls, '' );
//function abcfsl_cnt_img_i_a_img_cntr( $colL, $customCls, $customStyle, $pfix ){
//
//    $colCls = $pfix . 'LstCol ' . $pfix . 'LstCol-' . $colL . ' ' . $pfix . 'ImgColGridIB';
//
//    $imgColS = abcfl_html_tag( 'div', '', $colCls, '' );
//    $imgCntrS = abcfl_html_tag( 'div', '', trim( $pfix . 'ImgCntrIGridA ' . $customCls ), $customStyle );
//
//    $div['cntrS'] = $imgColS . $imgCntrS;
//    $div['cntrE'] = abcfl_html_tag_ends( 'div,div');
//    return $div;
//}