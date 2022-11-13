<?php
//=== IMAGES START ======================================
//IMAGE container.
// 1. abcfsl_cnt_list_item_cntr;
// 3. abcfsl_cnt_grid_item
function abcfsl_cnt_txt_img_field_IMGCAP( $par, $itemOptns ){

    return abcfsl_cnt_txt_field_img_fig( $par, $itemOptns );
}

function abcfsl_cnt_txt_img_field_IMGHLNK( $par, $itemOptns ){

    $F = $par['F'];
    $imgLnk = isset( $itemOptns['_imgLnk_' . $F] ) ? esc_attr( $itemOptns['_imgLnk_' . $F][0] ) : '';
    $imgLnkAttr = isset( $itemOptns['_imgLnkAttr_' . $F] ) ? esc_attr( $itemOptns['_imgLnkAttr_' . $F][0] ) : '';
    $imgLnkClick = isset( $itemOptns['_imgLnkClick_' . $F] ) ? esc_attr( $itemOptns['_imgLnkClick_' . $F][0] ) : ''; 

    //figure section.
    $figCntr = abcfsl_cnt_txt_field_img_fig( $par, $itemOptns );
    if( empty( $imgLnk ) ) { return $figCntr; }

    $lnkParts = abcfsl_util_get_url_and_target( $imgLnk );
    $href = $lnkParts['hrefUrl'];
    $target = $lnkParts['target'];

    return abcfl_html_a_tag_simple( $href, $figCntr, $target, '', $imgLnkClick, $imgLnkAttr );
    
    //<a href="https://abcfolio.com/" onclick="Link onClick JS99" rel="nofollow" cal="none">figure</a>
}

//OUT: figure section.
function abcfsl_cnt_txt_field_img_fig( $par, $itemOptns ){

    $F = $par['F'];
    $imgUrl = isset( $itemOptns['_imgUrl_' . $F] ) ? esc_attr( $itemOptns['_imgUrl_' . $F][0] ) : '';
    if( empty( $imgUrl ) ) { return ''; }

    $imgAlt = isset( $itemOptns['_imgAlt_' . $F] ) ? esc_attr( $itemOptns['_imgAlt_' . $F][0] ) : ''; 
    $captionTxt = isset( $itemOptns['_txt_' . $F] ) ? esc_attr( $itemOptns['_txt_' . $F][0] ) : '';

    $figureMarginT = $par['tagMarginT'];
    $capMarginT = $par['capMarginT'];
    $capFont = $par['tagFont'];
    $figCustomCls = $par['tagCustomCls'];
    $imgCustomCls = $par['lblCls'];
    $capCustomCls = $par['txtCls'];
    $isSingle = $par['isSingle'];
    $clsPfix = $par['clsPfix'];

    $figureCls =  abcfsl_util_field_tag_cls_bldr( $figureMarginT, '', $figCustomCls, $isSingle, $clsPfix );
    $imgCls = abcfsl_util_pg_type_cls_bldr( $imgCustomCls, $isSingle );
    $capCls =  abcfsl_util_field_tag_cls_bldr( $capMarginT, $capFont, $capCustomCls, $isSingle, $clsPfix );

    $imgTag = abcfl_html_img_tag_resp( '', $imgUrl, $imgAlt, '', $imgCls, '');
    //---------------------------------------------------
    $figS = abcfl_html_tag( 'figure', '', $figureCls, '' );
    $figE = abcfl_html_tag_end( 'figure' );
    $capS = abcfl_html_tag( 'figcaption', '', $capCls, '' );
    $capE = abcfl_html_tag_end( 'figcaption' );
    $capTag = '';

    if( !abcfl_html_isblank( $captionTxt ) ) {
        $capTag =  $capS . $captionTxt  . $capE;
    }    
    return $figS . $imgTag  . $capTag . $figE;

// <figure>
//   <img src="../html/pic_trulli.jpg" alt="Trulli" style="width:100%">
//   <figcaption>Fig.1 - Trulli, Puglia, Italy.</figcaption>
// </figure>
}
//=== IMAGES END ======================================
