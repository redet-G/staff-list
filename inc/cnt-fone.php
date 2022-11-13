<?php

function abcfsl_cnt_fone_field_SLFONE( $par ){

    $lblTxt = $par['lblTxt'];

    if ( abcfl_html_isblank( $lblTxt ) ) { return abcfsl_cnt_fone_field_FONE( $par ); }

    $url = $par['url'];
    if( empty( $url ) ){ return ''; } 
    
    $urlTxt = $par['urlTxt'];
    if( empty( $urlTxt ) ){ return ''; }

    $staticLbl = html_entity_decode( $lblTxt );

    $tapAction = $par['tapAction'];
    if ( empty( $tapAction ) ) { $tapAction = 'tel:'; }
    $url = $tapAction . $url;

    $tagCls = abcfsl_util_pg_type_cls_bldr( $par['tagCls'], $par['isSingle'] );
    $lblCls = abcfsl_util_pg_type_cls_bldr( $par['lblCls'], $par['isSingle'] );
    $txtCls = abcfsl_util_pg_type_cls_bldr( $par['txtCls'], $par['isSingle'] );

    $cntrS = abcfl_html_tag( $par['tagType'], '', $tagCls . $par['fieldTypeF'], $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);

    $spanLblS = abcfl_html_tag( 'span', '', $lblCls, $par['lblStyle']  );
    $spanTxtS = abcfl_html_tag( 'span', '', $txtCls, $par['txtStyle'] );
    $spanE = abcfl_html_tag_end('span');
    //----------------------------------------

    $link = abcfl_html_a_tag( $url, $urlTxt, '', $par['lnkCls'], '', '', false );

    return $cntrS . $spanLblS .$staticLbl . '&nbsp;' . $spanE . $spanTxtS . $link . $spanE . $cntrE;
}

function abcfsl_cnt_fone_field_FONE( $par ){

    $url = $par['url'];
    if( empty( $url ) ){ return ''; } 
    
    $urlTxt = $par['urlTxt'];
    if( empty( $urlTxt ) ){ return ''; }

    $tapAction = $par['tapAction'];
    if ( empty( $tapAction ) ) { $tapAction = 'tel:'; }
    $url = $tapAction . $url;

    $tagCls = abcfsl_util_pg_type_cls_bldr( $par['tagCls'] . $par['fieldTypeF'], $par['isSingle'] );
    $cntrS = abcfl_html_tag( $par['tagType'], '', $tagCls, $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);
    //----------------------------------------

    $link = abcfl_html_a_tag( $url, $urlTxt, '', $par['lnkCls'], '', '', false ); 
    
    return $cntrS . $link . $cntrE;
}