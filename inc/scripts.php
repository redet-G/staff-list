<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'wp_enqueue_scripts', 'abcfsl_scripts_enq', 21 );

function abcfsl_scripts_enq() {

    $obj = ABCFSL_Main();
    $ver = $obj->pluginVersion;

    abcfsl_scripts_enq_css( $ver );
    abcfsl_register_js_isotope_scripts( $ver );
}

function abcfsl_scripts_enq_css( $ver ) {
    wp_register_style('abcfsl-staff-list', ABCFSL_PLUGIN_URL . 'css/staff-list.css', array(), $ver, 'all');
    wp_enqueue_style('abcfsl-staff-list');
}

function abcfsl_register_js_isotope_scripts( $ver ) {
    wp_register_script( 'abcfsl_imagesloaded', ABCFSL_PLUGIN_URL .'js/imagesloaded.pkgd.min.js', array('jquery'), $ver, true );
    wp_register_script( 'abcfsl_isotope', ABCFSL_PLUGIN_URL .'js/isotope.pkgd.min.js', array('jquery'), $ver, true );
}