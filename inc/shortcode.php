<?php
/**
 * Process shortcode
*/
if ( ! defined( 'ABSPATH' ) ) {exit;}

add_shortcode( 'abcf-staff-list', 'abcfsl_scode_add_list' );
add_shortcode( 'abcf-staff-single', 'abcfsl_scode_add_single' );;

function abcfsl_scode_add_list( $scodeArgs ) {
    return abcfsl_cnt_list( abcfsl_scode_args( $scodeArgs ) );
}

function abcfsl_scode_add_single( $scodeArgs ) {

    $args = shortcode_atts( abcfsl_scode_defaults(), $scodeArgs );
    $staffMemberID = ( get_query_var('smid') ) ? get_query_var('smid' ) : 0;
    $args['smid'] =  $staffMemberID;
    $args['staff-name'] = get_query_var('staff-name');

    return abcfsl_cnt_spage($args);
}

function abcfsl_scode_defaults() {

    $obj = ABCFSL_Main();
    $ver = str_replace('.', '' , $obj->pluginVersion);
    $prefix = $obj->prefix;

    return array( 'id' => '0', 'template' => '', 'pversion' => $ver, 'prefix' => $prefix, 'staff-id' => '0',
        'smid' => '0', 'staff-name' => '', 'random' => false );
}

function abcfsl_scode_args( $scodeArgs ) {

    $args = shortcode_atts( abcfsl_scode_defaults(), $scodeArgs );
    if( $args['random'] == '1' ) { $args['random'] = true;}
    return $args;
}

//-- Shortcode builders -------------------------------------------
function abcfsl_scode_build_scode_OLD( $esc = true ) {

    global $post;
    $tplateID = $post->ID;

    $scodeL = '[abcf-staff-list' . ' id="' . $tplateID . '"]';
    $scodeLR = '[abcf-staff-list' . ' id="' . $tplateID . '" random="1"]';
    $scodeSP = '[abcf-staff-single' . ' id="' . $tplateID . '"]';

    if($esc){
        $scodeL = esc_attr( $scodeL );
        $scodeLR = esc_attr( $scodeLR );
        $scodeSP = esc_attr( $scodeSP );
    }
    $scodes['scodeL'] = $scodeL;
    $scodes['scodeLR'] = $scodeLR;
    $scodes['scodeSP'] = $scodeSP;
    return $scodes;
}

function abcfsl_scode_build_scode( $layoutNo, $tplateID ) {

    $scode = '[abcf-staff-list' . ' id="' . $tplateID . '"]';
    // ISOTOPE OK
    switch ( $layoutNo ) {
        case 10:
            $scode = '[abcf-staff-single' . ' id="' . $tplateID . '"]';
            break;
        default:
            break;
    }

    return esc_attr( $scode );
}
