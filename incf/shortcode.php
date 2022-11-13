<?php
if ( ! defined( 'ABSPATH' ) ) {exit;}

add_shortcode( 'abcf-staff-list', 'abcfsl_scode_add_list' );
add_shortcode( 'abcf-staff-list-i', 'abcfsl_scode_add_list_i' );
add_shortcode( 'abcf-staff-single', 'abcfsl_scode_add_single' );
//==============================================
function abcfsl_scode_add_list_i( $scodeArgs ) {
    $args = abcfsl_scode_args( $scodeArgs );
    $args['tplate']= 'LI';
    $args['ajax']= '0';

    if( empty( $args['menu-id'] )) {
        return abcfsl_cnt_html( $args );
    }

    wp_enqueue_script( 'abcfsl_isotope' );
    if( $args['images-loaded'] > 0 ) { wp_enqueue_script( 'abcfsl_imagesloaded' ); }

    ob_start();
    $output = abcfsl_cnt_html( $args );
    ob_end_clean(); 
    return  $output;
}

function abcfsl_scode_add_list( $scodeArgs ) {
    $args = abcfsl_scode_args( $scodeArgs );
    $args['tplate']= 'L';
    $args['ajax']= '0';

    if( empty( $args['menu-id'] )) {
        return abcfsl_cnt_html( $args );
    }
    ob_start();
    $output = abcfsl_cnt_html( $args );
    ob_end_clean(); 
    return  $output;
}

//---------------------------------------------------------------

function abcfsl_scode_add_single( $scodeArgs ) {

    $args = shortcode_atts( abcfsl_util_scode_defaults(), $scodeArgs );
    $staffMemberID = ( get_query_var('smid') ) ? get_query_var('smid' ) : 0;
    $args['smid'] =  $staffMemberID;
    $args['staff-name'] = get_query_var('staff-name');

    //abcfsl_util_debug_spg( $args );

    return abcfsl_cnt_spage($args);
}

function abcfsl_scode_args( $scodeArgs ) {

    $args = shortcode_atts( abcfsl_util_scode_defaults(), $scodeArgs );
    if( $args['random'] == '1' ) { $args['random'] = true;}

    $staffAZ = (get_query_var('staff-az') ) ? get_query_var( 'staff-az' ) : '';
    $args['staff-az'] = $staffAZ;

    $staffCategory = (get_query_var('staff-category') ) ? get_query_var( 'staff-category' ) : '';
    $args['staff-category'] = $staffCategory;

    // PG ----
    //$staffPg = (get_query_var('page') ) ? get_query_var( 'page' ) : '';
    //$args['page'] = $staffPg;

    $staffPg = (get_query_var('staff-page-no') ) ? get_query_var( 'staff-page-no' ) : '0';
    $args['page'] = $staffPg;

    return $args;
}

//-- Shortcode builders -------------------------------------------
function abcfsl_scode_build_scode( $layoutNo, $tplateID ) {

    $scode = '[abcf-staff-list' . ' id="' . $tplateID . '"]';

    switch ( $layoutNo ) {
        case 10:
            $scode = '[abcf-staff-single' . ' id="' . $tplateID . '"]';
            break;
        case 203:
            $scode = '[abcf-staff-list-i' . ' id="' . $tplateID . '"]';
            break;             
        default:
            break;
    }
    return esc_attr( $scode );
}