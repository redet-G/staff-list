<?php
//-- IMAGE WxH START ----------------------------------
function abcfsl_img_wh( $imgID, $imgUrl ){

    $filename = basename($imgUrl);
    $meta = '';
    $imgWH['w'] = 0;
    $imgWH['h'] = 0;
    $imgWH['ok'] = false;

    //There always should be imgID. If not don't bother, return defaults.
    if($imgID > 0){ $meta = get_post_meta($imgID, '_wp_attachment_metadata'); }
    if( empty( $meta ) ) { return $imgWH; }

    $metaArray = isset( $meta ) ?  $meta[0] : '';
    if( empty($metaArray) ) { return $imgWH; }

    //Check original image (stored in different part of the array than other sizes. return sizes if image is an original
    $imgWH = abcfsl_img_large_wh( $metaArray, $filename );
    if($imgWH['ok']){ return $imgWH; }

    //Check if array has 'sizes' array
    if(!array_key_exists('sizes', $metaArray)) { return $imgWH; }

    $sizes = $metaArray['sizes'];

    $defaults = array( 'file' => '', 'width' => '0', 'height' => '0' );
    foreach ( $sizes as $size ) {
        $sizeFixed = shortcode_atts( $defaults, $size );

        $sizeFile = $sizeFixed['file'];
        if($sizeFile == $filename){
            $imgWH['w'] = $sizeFixed['width'];
            $imgWH['h'] = $sizeFixed['height'];
            if($imgWH['w'] > 0 && $imgWH['h'] > 0) { $imgWH['ok'] = true; }
            break;
        }
    }

    return $imgWH;

//$filename = basename($url);
//$parts=explode(“?”,$filename);
//$filename = $parts[0];
}

function abcfsl_img_large_wh( $metaArray, $filename ){

    $imgWH['w'] = 0;
    $imgWH['h'] = 0;
    $imgWH['ok'] = false;

    $defaults = array( 'file' => '', 'width' => '0', 'height' => '0' );
    $meta = shortcode_atts( $defaults, $metaArray );

    //File can have folders prefixes: 2015/12/image.jpg
    $large =  basename($meta['file']);

    if( $large == $filename){
        $imgWH['w'] = $meta['width'];
        $imgWH['h'] = $meta['height'];
        if($imgWH['w'] > 0 && $imgWH['h'] > 0) { $imgWH['ok'] = true; }
    }
    return $imgWH;
}

function abcfsl_img_id_by_url( $imgUrl ){

    if( empty( $imgUrl ) ) { return 0; }

    $imageID = abcfsl_img_id_by_guid( $imgUrl );
    if( $imageID > 0 ) { return $imageID; }

    $imageID = abcfsl_img_attachment_url_to_postid( $imgUrl );
    if( $imageID > 0 ) { return $imageID; }

    return 0;
}
//== IMAGE WxH END ==========================================
function abcfsl_img_alt_lib( $imgID, $imgUrl ){

    $imgAlt = '';
    if( $imgID > 0 ){
        $imgAlt = get_post_meta( $imgID, '_wp_attachment_image_alt', true );
        return $imgAlt;
    }

    $imgID = abcfsl_img_id_by_guid( $imgUrl );
    if( $imgID > 0 ){
        $imgAlt = get_post_meta($imgID, '_wp_attachment_image_alt', true);
        return $imgAlt;
    }

    $imgID = abcfsl_img_attachment_url_to_postid( $imgUrl );
    if( $imgID > 0 ){
        $imgAlt = get_post_meta($imgID, '_wp_attachment_image_alt', true);
    }

    return $imgAlt;
}

function abcfsl_img_id_by_guid( $imgUrl ){

    if( empty( $imgUrl ) ) { return 0; }

    global $wpdb;
    $imageID = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $imgUrl ));
    if( !empty( $imageID ) ) { return $imageID; }

    // If the URL is auto-generated thumbnail, remove the sizes and get the URL of the original image
    $url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $imgUrl );
    $imageID = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $url ));
    if( !empty( $imageID ) ) { return $imageID; }

    return 0;
}

function abcfsl_img_attachment_url_to_postid( $imgUrl ) {

    //Return (int). The found post ID, or 0 on failure.
    $imageID = attachment_url_to_postid( $imgUrl );
    if( $imageID > 0 ) { return $imageID; }

    $url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $imgUrl );
    return attachment_url_to_postid( $url );
}

function abcfsl_img_placeholder( $tplateOptns, $isSingle ){

    $out['imgUrl'] = '';
    $out['imgID'] = 0;

    $pImgDefault = isset( $tplateOptns['_pImgDefault'] ) ? $tplateOptns['_pImgDefault'][0] : '0';
    //Use the L image on SP. 
    $sPgDefaultImgUrl = isset( $tplateOptns['_sPgDefaultImgUrl'] ) ? $tplateOptns['_sPgDefaultImgUrl'][0] : '0';

    if( $pImgDefault == '1' ) {
        $out['imgUrl'] = ABCFSL_ICONS_URL . 'placeholder.png';
        return $out;
    }

    //Template option is set to use L image for single pages.
    if( $sPgDefaultImgUrl == '1' ) {
        $isSingle = false;
     }

    if( !$isSingle ) {
        $out['imgUrl'] = isset( $tplateOptns['_pImgUrlL'] ) ? esc_attr( $tplateOptns['_pImgUrlL'][0] ) : '';
        $out['imgID'] = isset( $tplateOptns['_pImgIDL'] ) ? $tplateOptns['_pImgIDL'][0]  : 0;
        return $out;
    }

    $out['imgUrl'] = isset( $tplateOptns['_pImgUrlS'] ) ? esc_attr( $tplateOptns['_pImgUrlS'][0] ) : '';
    $out['imgID'] = isset( $tplateOptns['_pImgIDS'] ) ? $tplateOptns['_pImgIDS'][0]  : 0;

    return $out;
}
// #############################################################
// DEPRECATED 
function abcfsl_img_alt( $imgID, $imgUrl, $imgAlt ){

    if( empty( $imgAlt ) ){ return ''; }

    // if( $imgAlt == 'LIB' ){ 
    //     return abcfsl_img_alt_lib( $imgID, $imgUrl ); 
    // }

    return $imgAlt;
}
