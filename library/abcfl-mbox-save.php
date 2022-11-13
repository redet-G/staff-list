<?php
/**
 * Save metabox data. Version 115
 * 
 * 112 abcfl_mbsave_save_allowed_tags - added br
 * 113 Added: abcfl_mbsave_save_tinymce . No esc_attr
 * 114 Updated: abcfl_mbsave_int_or_empty
*  115 Added: abcfl_mbsave_save_int_max
*/

// HTML Allow to save some of HTML tags b,br,em,i,strong
if ( !function_exists( 'abcfl_mbsave_save_txt_html' ) ){
function abcfl_mbsave_save_txt_html( $postID, $field_id, $metaKey ) {

    $allowedTags = abcfl_mbsave_save_allowed_tags();

    $newValue = ( isset( $_POST[$field_id] ) ? wp_kses( $_POST[$field_id], $allowedTags )  : '' );
    abcfl_mbsave_save_field( $postID, $metaKey, $newValue);
}
}

if ( !function_exists( 'abcfl_mbsave_save_allowed_tags' ) ){
function abcfl_mbsave_save_allowed_tags() {

    $allowedTags = array(
        'a' => array(
                'class' => array(),
                'href'  => array(),
                'rel'   => array(),
                'title' => array()
        ),
        'abbr' => array(
                'title' => array(),
        ),
        'b' => array(),
        'blockquote' => array(
                'cite'  => array(),
        ),
        'br' => array(),
        'cite' => array(
                'title' => array(),
        ),
        'code' => array(),
        'del' => array(
                'datetime' => array(),
                'title' => array(),
        ),
        'dd' => array(),
        'div' => array(
                'class' => array(),
                'title' => array(),
                'style' => array(),
        ),
        'dl' => array(),
        'dt' => array(),
        'em' => array(),
        'h1' => array(),
        'h2' => array(),
        'h3' => array(),
        'h4' => array(),
        'h5' => array(),
        'h6' => array(),
        'i' => array(),
        'img' => array(
                'alt'    => array(),
                'class'  => array(),
                'height' => array(),
                'src'    => array(),
                'width'  => array(),
        ),
        'li' => array(
                'class' => array(),
        ),
        'ol' => array(
                'class' => array(),
        ),
        'p' => array(
                'class' => array(),
        ),
        'q' => array(
                'cite' => array(),
                'title' => array(),
        ),
        'span' => array(
                'class' => array(),
                'title' => array(),
                'style' => array(),
        ),
        'strike' => array(),
        'strong' => array(),
        'ul' => array(
                'class' => array(),
        ),
        'iframe' => array(
                'src'             => array(),
                'height'          => array(),
                'width'           => array(),
                'frameborder'     => array(),
                'allowfullscreen' => array()
        )
    );

    return $allowedTags;

}
}

// HTML Allow to save HTML tags
if ( !function_exists( 'abcfl_mbsave_save_txt_post_html' ) ){
function abcfl_mbsave_save_txt_post_html( $postID, $field_id, $metaKey) {
    $newValue = ( isset( $_POST[$field_id] ) ? wp_kses_post( $_POST[$field_id] )  : '' );
    abcfl_mbsave_save_field( $postID, $metaKey, $newValue);
}
}
if ( !function_exists( 'abcfl_mbsave_save_chekbox' ) ){
    function abcfl_mbsave_save_chekbox( $postID, $field_id, $metaKey) {
        $newValue = '';
        if (isset( $_POST[$field_id])) { $newValue = '1'; }
        abcfl_mbsave_save_field( $postID, $metaKey, $newValue);
    }
}

//No esc_attr. tinymce' => true
if ( !function_exists( 'abcfl_mbsave_save_tinymce' ) ){
    function abcfl_mbsave_save_tinymce( $postID, $field_id, $metaKey) {
            $newValue = ( isset( $_POST[$field_id] ) ? $_POST[$field_id] : '' );
            abcfl_mbsave_save_field( $postID, $metaKey, $newValue);
}}

//Works only if tinymce' => false
if ( !function_exists( 'abcfl_mbsave_save_txt_editor' ) ){
function abcfl_mbsave_save_txt_editor( $postID, $field_id, $metaKey) {
        $newValue = ( isset( $_POST[$field_id] ) ? esc_attr( $_POST[$field_id] ) : '' );
        abcfl_mbsave_save_field( $postID, $metaKey, $newValue);
}}

if ( !function_exists( 'abcfl_mbsave_save_txt' ) ){
    //Save text field
    function abcfl_mbsave_save_txt( $postID, $field_id, $metaKey) {

        $newValue = ( isset( $_POST[$field_id] ) ? esc_attr( $_POST[$field_id] ) : '' );
        abcfl_mbsave_save_field( $postID, $metaKey, $newValue);
}}

if ( !function_exists( 'abcfl_mbsave_save_txt_sanitize_title' ) ){
    //Save text field
    function abcfl_mbsave_save_txt_sanitize_title( $postID, $field_id, $metaKey) {
        $newValue = ( isset( $_POST[$field_id] ) ? esc_attr( $_POST[$field_id] ) : '' );
        abcfl_mbsave_save_field( $postID, $metaKey, sanitize_title($newValue));
}}

if ( !function_exists( 'abcfl_mbsave_save_urlraw' ) ){
    function abcfl_mbsave_save_urlraw( $postID, $field_id, $metaKey) {

        $newValue = ( isset( $_POST[$field_id] ) ? esc_url_raw( $_POST[$field_id] ) : '' );
        abcfl_mbsave_save_field( $postID, $metaKey, $newValue);
    }
}
if ( !function_exists( 'abcfl_mbsave_save_css_size' ) ){
    //Save CSS size. Remove px since it is an default unit.
    function abcfl_mbsave_save_css_size( $postID, $field_id, $metaKey) {

        $newValue = ( isset( $_POST[$field_id] ) ? esc_attr( $_POST[$field_id] ) : '' );
        $newValueFixed = str_replace(array(' ', ';', 'px'), '', $newValue);
        abcfl_mbsave_save_field( $postID, $metaKey, $newValueFixed);
    }
}
if ( !function_exists( 'abcfl_mbsave_save_int' ) ){
    function abcfl_mbsave_save_int( $postID, $field_id, $metaKey) {

        $newValue = ( isset( $_POST[$field_id] ) ? $_POST[$field_id] : '' );
        $newValueInt = abcfl_mbsave_int_or_empty($newValue);
        abcfl_mbsave_save_field( $postID, $metaKey, $newValueInt);
    }
}
if ( !function_exists( 'abcfl_mbsave_save_decimal' ) ){
    function abcfl_mbsave_save_decimal( $postID, $field_id, $metaKey) {

        $newValue = ( isset( $_POST[$field_id] ) ? $_POST[$field_id] : '' );
        $newValueInt = abcfl_mbsave_fix_decimal($newValue);
        abcfl_mbsave_save_field( $postID, $metaKey, $newValueInt);
    }
}
if ( !function_exists( 'abcfl_mbsave_save_cbo' ) ){
    //Save drop-down selection
    function abcfl_mbsave_save_cbo( $postID,  $field_id, $metaKey, $default, $saveDefault = false) {
        $newValue = ( isset( $_POST[$field_id] ) ? $_POST[$field_id] : $default );
        if($newValue == $default && !$saveDefault) { $newValue = ''; }
        abcfl_mbsave_save_field( $postID, $metaKey, $newValue);
    }
}
//-------------------------------------------------------------
if ( !function_exists( 'abcfl_mbsave_save_txt_value' ) ){
    function abcfl_mbsave_save_txt_value( $postID, $metaKey, $newValue,  $default) {
        if( $newValue == $default ) { $newValue = ''; }
        abcfl_mbsave_save_field( $postID, $metaKey, $newValue);
}}
//============================================================================================
if ( !function_exists( 'abcfl_mbsave_save_field' ) ){
    //Save form field
    function abcfl_mbsave_save_field( $postID, $metaKey, $newValue){
        $newValue = trim($newValue);
        $oldValue = get_post_meta( $postID, $metaKey, true );
        if ( $newValue && '' == $oldValue ) { add_post_meta( $postID, $metaKey, $newValue, true ); }
        elseif ( $newValue != '' && $newValue != $oldValue ) { update_post_meta( $postID, $metaKey, $newValue ); }
        elseif ( '' == $newValue && isset($oldValue) ) { delete_post_meta( $postID, $metaKey, $oldValue );}
    }
}

if ( !function_exists( 'abcfl_mbsave_int_or_empty' ) ){
    //Get integer or empty string
    function abcfl_mbsave_int_or_empty( $in, $default='') {
        if(abcfl_html_isblank($in)){ return $default; }
        if($in == '0'){return $in;}
        //$int = intval($in);
        $int = absint( $in );
        if($int == 0){return $default;}
        return $int;
    }
}

if ( !function_exists( 'abcfl_mbsave_int_or_zero' ) ){
    function abcfl_mbsave_int_or_zero( $in, $default=0) {
        if(abcfl_html_isblank($in)){ return $default; }
        if($in == 0){return $in;}
        $int = intval($in);
        if($int == 0){return $default;}
        return $int;
    }
}
if ( !function_exists( 'abcfl_mbsave_fix_decimal' ) ){
    function abcfl_mbsave_fix_decimal( $in ) {
        $out = str_replace(' ', '', $in);
        $out = str_replace('%', '', $out);
        return str_replace(',', '.', $out);
    }
}
//------------------ v115 --------------------------------
if ( !function_exists( 'abcfl_mbsave_save_int_max' ) ){
    function abcfl_mbsave_save_int_max( $postID, $field_id, $metaKey, $max, $default) {

        $newValue = ( isset( $_POST[$field_id] ) ? $_POST[$field_id] : '' );
        $newValueInt = abcfl_mbsave_absint_max( $newValue, $max, $default);
        abcfl_mbsave_save_field( $postID, $metaKey, $newValueInt);
    }
}

if ( !function_exists( 'abcfl_mbsave_absint_max' ) ){
    function abcfl_mbsave_absint_max( $in, $max, $default) {
        
        $int = absint( $in );
        if( $int == 0 ) { return $default; }
        if( $int > $max ) { return $max; }
        return $int;
    }
}