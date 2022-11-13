<?php
// vCARD
function abcfsl_cnt_field_VCARDHL( $par, $tplateOptns, $itemOptns ){

    //echo"<pre>", print_r( $tplateOptns, true ), "</pre>"; 
    //$tplateOptns['slTplateID']

    // vCard plugin not installed.
    if( !abcfsl_util_vcard_plugin_installed() ) { return ''; }

    $F = $par['F'];
    $staffID = $par['itemID'];

    if( empty( $staffID ) ) { return ''; }
    if( empty( $F ) ) { return ''; }

    // Check if vCard template selected.
    $vcTplateID = isset( $tplateOptns['_vcTplateID_' . $F] ) ?  $tplateOptns['_vcTplateID_' . $F][0] : 0;
    if( empty( $vcTplateID ) ) { return ''; }

    $slTplateID = isset( $tplateOptns['slTplateID'] ) ? $tplateOptns['slTplateID'] : 0;
    // Check if vCard template exists.
    $cbo = abcfsl_db_cbo_vcard_tplates( $slTplateID, 'VC' );
    if ( !array_key_exists( $vcTplateID, $cbo ) ) { return ''; }
    //========================================================
    $currentPg = abcfsl_util_get_current_url();

    //http://xxxxx/?smid=8691-7&vctid=8747&staff-cp=vcard    
    $vCardDloadURL = add_query_arg( array(
        'smid' => $staffID . '-' . substr($F, 1),
        'vctid' => $vcTplateID,
        'staff-cp' => 'vcard'
    ), $currentPg );

    $cntrS = abcfl_html_tag( $par['tagType'], '', $par['tagCls'] . $par['fieldTypeF'], $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);

    $aTag = abcfl_html_a_tag_nb( $vCardDloadURL, $par['lblTxt'], '', $par['lnkCls'], $par['lnkStyle'], '', '', '' );
    return $cntrS . $aTag . $cntrE;
}

function abcfsl_cnt_field_VCARD( $par, $tplateOptns, $itemOptns ){
    return '';
}
// == QR Code ============================================================   
function abcfsl_cnt_vcard_QRIMGCAP64DYN( $par, $tplateOptns, $itemOptns ){ 

    if( !abcfsl_util_vcard_plugin_installed() ) { return ''; }

    $F = $par['F'];
    if( empty( $F ) ) { return ''; }

    $staffID = $par['itemID'];
    if( empty( $staffID ) ) { return ''; }

    $saveQrErrorTxt = isset( $itemOptns['_qrErrorTxt_' . $F] ) ? esc_attr( $itemOptns['_qrErrorTxt_' . $F][0] ) : '';
    if( !empty( $saveQrErrorTxt ) ) { return ''; }

    //-------------------------------------------------
    $vcTplateID = isset( $tplateOptns['_vcTplateID_' . $F] ) ? $tplateOptns['_vcTplateID_' . $F][0] : '';
    $slTplateID = isset( $tplateOptns['slTplateID'] ) ? $tplateOptns['slTplateID'] : 0;

    // Check if vCard template exists.
    $cbo = abcfsl_db_cbo_vcard_tplates( $slTplateID, 'QR' );
    if ( !array_key_exists( $vcTplateID, $cbo ) ) { return ''; }
    //-----------------------------------------------------------
    $imgBldrPar['staffID'] = $staffID;
    $imgBldrPar['F'] = $F;
    $imgBldrPar['slTplateID'] = $slTplateID;

    $qrImgBuilder = new ABCFSL_QR_Img_Builder( $imgBldrPar ); 
    $qrImgBuilder->maybeCreateQRImgUri(); 

    $errTxt = $qrImgBuilder->getErrTxt();
    $qrImgUri = $qrImgBuilder->getImgUri(); 

    if( !empty( $errTxt ) ) { return ''; }    
    if( empty( $qrImgUri ) ) { return ''; }
    //--------------------------------------------------------------
    $statCaption = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '';
    $statAlt = isset( $tplateOptns['_statAlt_' . $F] ) ? esc_attr( $tplateOptns['_statAlt_' . $F][0] ) : '';
    $dynCaption = isset( $itemOptns['_txt_' . $F] ) ? esc_attr( $itemOptns['_txt_' . $F][0] ) : '';
    $dynAlt = isset( $itemOptns['_imgAlt_' . $F] ) ? esc_attr( $itemOptns['_imgAlt_' . $F][0] ) : '';

    $par['imgAlt'] =  abcfsl_cnt_vcard_qr_caption( $statAlt, $dynAlt );
    $par['captionTxt'] = abcfsl_cnt_vcard_qr_caption( $statCaption, $dynCaption );

    return abcfsl_cnt_vcard_qr_img( $par, $qrImgUri );
}

function abcfsl_cnt_vcard_QRIMGCAP64STA( $par, $tplateOptns, $itemOptns ){

    $F = $par['F'];
    if( empty( $F ) ) { return ''; }

    $staffID = $par['itemID'];
    if( empty( $staffID ) ) { return ''; }
    //---------------------------------------------------------------
    $qrImgUri = isset( $itemOptns['_qrImgUri_' . $F] ) ? esc_attr( $itemOptns['_qrImgUri_' . $F][0] ) : '';
    if( empty( $qrImgUri ) ) { return ''; }
    //--------------------------------------------------------------
    $statCaption = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '';
    $statAlt = isset( $tplateOptns['_statAlt_' . $F] ) ? esc_attr( $tplateOptns['_statAlt_' . $F][0] ) : '';
    $dynCaption = isset( $itemOptns['_txt_' . $F] ) ? esc_attr( $itemOptns['_txt_' . $F][0] ) : '';
    $dynAlt = isset( $itemOptns['_imgAlt_' . $F] ) ? esc_attr( $itemOptns['_imgAlt_' . $F][0] ) : '';

    $par['imgAlt'] =  abcfsl_cnt_vcard_qr_caption( $statAlt, $dynAlt );
    $par['captionTxt'] = abcfsl_cnt_vcard_qr_caption( $statCaption, $dynCaption );

    return abcfsl_cnt_vcard_qr_img( $par, $qrImgUri );
}

function abcfsl_cnt_vcard_qr_caption( $stat, $dyn ){
    if( !empty( $dyn ) ) { return $dyn; }
    if( !empty( $stat ) ) { return $stat; }
    return '';   
}

function abcfsl_cnt_vcard_qr_img( $par, $qrImgUri ){

    $imgAlt = $par['imgAlt'];
    $captionTxt = $par['captionTxt'];
    $figureMarginT = $par['tagMarginT'];
    $figCustomCls = $par['tagCustomCls'];
    $imgCustomCls = $par['lblCls'];    
    $isSingle = $par['isSingle'];
    $clsPfix = $par['clsPfix'];

    $imgCls = abcfsl_util_pg_type_cls_bldr( $imgCustomCls, $isSingle );
    $figureCls =  abcfsl_util_field_tag_cls_bldr( $figureMarginT, '', $figCustomCls, $isSingle, $clsPfix );
    $imgTag = abcfl_html_img_tag( '', $qrImgUri, $imgAlt, '', $imgCls, '');

    //-- Return div + image if no caption ------------------------------------
    if( abcfl_html_isblank( $captionTxt ) ) {  return abcfl_html_tag( 'div', '', $figureCls, '' ) . $imgTag . abcfl_html_tag_end( 'div' );  }
    //------------------------------------------------------
    $capMarginT = $par['capMarginT'];
    $capFont = $par['tagFont'];
    $capCustomCls = $par['txtCls'];
    $capCls =  abcfsl_util_field_tag_cls_bldr( $capMarginT, $capFont, $capCustomCls, $isSingle, $clsPfix );

    $figS = abcfl_html_tag( 'figure', '', $figureCls, '' );
    $figE = abcfl_html_tag_end( 'figure' );
    $capS = abcfl_html_tag( 'figcaption', '', $capCls, '' );
    $capE = abcfl_html_tag_end( 'figcaption' );
  
    return $figS . $imgTag  .$capS . $captionTxt  . $capE . $figE;

// <figure>
//   <img src="../html/pic_trulli.jpg" alt="Trulli" style="width:100%">
//   <figcaption>Fig.1 - Trulli, Puglia, Italy.</figcaption>
// </figure>
}
//############################################################################################################# 

// Discontinued
function abcfsl_cnt_field_QRHL64STA( $par, $tplateOptns, $itemOptns ){

    $F = $par['F'];
    if( empty( $F ) ) { return ''; }

    $staffID = $par['itemID'];
    if( empty( $staffID ) ) { return ''; }
    //---------------------------------------------------------------
    $qrImgUri = isset( $itemOptns['_qrImgUri_' . $F] ) ? esc_attr( $itemOptns['_qrImgUri_' . $F][0] ) : '';
    if( empty( $qrImgUri ) ) { return ''; }

    //========================================================
    $cntrS = abcfl_html_tag( $par['tagType'], '', $par['tagCls'] . $par['fieldTypeF'], $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);

    $aTag = abcfl_html_a_tag_data( $qrImgUri, $par['lblTxt'], $par['lnkNT'], $par['lnkCls'], $par['lnkStyle'], '', '', '' );
    return $cntrS . $aTag . $cntrE;
}

// Discontinued
function abcfsl_cnt_field_QRHL64DYN( $par, $tplateOptns, $itemOptns ){

    //return '';
    //-- Displays error message instead of field input.
    if( !abcfsl_util_vcard_plugin_installed() ) { return ''; }

    $F = $par['F'];
    if( empty( $F ) ) { return ''; }

    $staffID = $par['itemID'];
    if( empty( $staffID ) ) { return ''; }

    $saveQrErrorTxt = isset( $itemOptns['_qrErrorTxt_' . $F] ) ? esc_attr( $itemOptns['_qrErrorTxt_' . $F][0] ) : '';
    if( !empty( $saveQrErrorTxt ) ) { return ''; }

    //-------------------------------------------------
    $vcTplateID = isset( $tplateOptns['_vcTplateID_' . $F] ) ? $tplateOptns['_vcTplateID_' . $F][0] : '';
    $slTplateID = isset( $tplateOptns['slTplateID'] ) ? $tplateOptns['slTplateID'] : 0;

    // Check if vCard template exists.
    $cbo = abcfsl_db_cbo_vcard_tplates( $slTplateID, 'QR' );
    if ( !array_key_exists( $vcTplateID, $cbo ) ) { return ''; }

    //================================================================================
    $params['staffID'] = $staffID;
    $params['F'] = $F;
    $params['slTplateID'] = $slTplateID;
    //$params['saveImg'] = false; 

    $qrImgBuilder = new ABCFSL_QR_Img_Builder( $params ); 
    $qrImgBuilder->maybeCreateQRImgUri(); 

    $errTxt = $qrImgBuilder->getErrTxt();
    $qrImgUri = $qrImgBuilder->getImgUri(); 

    if( !empty( $errTxt ) ) { return ''; }    
    if( empty( $qrImgUri ) ) { return ''; }

    //========================================================
    $cntrS = abcfl_html_tag( $par['tagType'], '', $par['tagCls'] . $par['fieldTypeF'], $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);

    $aTag = abcfl_html_a_tag_data( $qrImgUri, $par['lblTxt'], $par['lnkNT'], $par['lnkCls'], $par['lnkStyle'], '', '', '' );
    return $cntrS . $aTag . $cntrE;
}