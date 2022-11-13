<?php
/*
 * Version 008
 * Admin OK, Info, Error messages.
 * License section
 * 003 edit_pages
 * 004 abcfl_autil_pg_license_n
 * 005 added legacy code
 * 007 Changed messages and links. abcfl_autil_pg_license_n
 * 008 Updated abcfl_autil_pg_license_n
 */

//== ADMIN MESSAGES WP STYLE ==============================================
if ( !function_exists( 'abcfl_autil_msg_err' ) ){
function abcfl_autil_msg_err( $msg, $die=true ){
    echo abcfl_html_tag('div','', 'notice notice-error' );
    echo abcfl_html_tag_with_content( $msg, 'p', '' );
    echo abcfl_html_tag_end('div');
    if( $die ){ die; }
}}

if ( !function_exists( 'abcfl_autil_msg_ok' ) ){
function abcfl_autil_msg_ok( $msg='OK', $die=false ){
    echo abcfl_html_tag('div','', 'notice notice-success is-dismissible' );
    echo abcfl_html_tag_with_content( $msg, 'p', '' );
    echo abcfl_html_tag_end('div');
    if( $die ){ die; }
}}

if ( !function_exists( 'abcfl_autil_msg_info' ) ){
function abcfl_autil_msg_info( $msg, $die=false ){
    echo abcfl_html_tag('div','abcflInfo', 'abcflNotice abcflNoticeInfo' );
    echo abcfl_html_tag_with_content( $msg, 'p', '' );
    echo abcfl_html_tag_end('div');
    if( $die ){ die; }
}}

//== LICENCE START ========================================================

//Replacement for abcfl_autil_pg_license
if ( !function_exists( 'abcfl_autil_pg_license_n' ) ){
    function abcfl_autil_pg_license_n( $optnName, $pluginName='' ) {
    
        abcfl_autil_user_can( 'admin' );
    
        // if check_admin_referer() fails it will print a "Are you sure you want to do this?" page and die.
        if ( isset($_POST['btnAddLicense']) ){
    
            check_admin_referer( $optnName );
            $licenseKey = (isset( $_POST['licenseKey'] ) ? esc_attr($_POST['licenseKey']) : '');
            abcfl_autil_add_licence_key($licenseKey, $optnName);
            abcfl_autil_msg_ok();
        }
        $key = abcfl_autil_get_licence_key($optnName);
    
        echo  abcfl_html_tag('div','', 'wrap' );
            echo abcfl_html_tag('h2', '');
            echo 'License Key' . $pluginName;
            echo abcfl_html_tag_end('h2');
        abcfl_html_div_clr();
        echo abcfl_html_form( 'frmLicense', 'frmLicense' );
            wp_nonce_field($optnName);
            echo abcfl_input_txt('licenseKey', '', $key, '', '', '50%', 'abcflLicenseKey', '', 'abcflFldCntr', 'abcflFldLbl');
            echo  abcfl_html_tag('div','', 'submit' );
            echo abcfl_input_btn( 'btnAddLicense', 'btnAddLicense', 'submit', 'Activate Key', 'button-primary abcficBtnWide' );
        echo abcfl_html_tag_ends('div,form,div');
        echo abcfl_input_hline( '2', '20', '50Pc' );
        echo abcfl_input_hlp_url( 'License Key Request', 'https://abcfolio.com/wordpress-plugin-registration/', 'abcflFontS16 abcflFontW400 abcflMTop20' );
        echo abcfl_html_tag('p', '');
            echo __( 'The license key is required for automatic updates.', 'staff-list' );
        echo abcfl_html_tag_end('p');
        echo abcfl_html_tag('p', '', 'abcflFontS16');
            echo 'Lost your key? No problem. <a href="https://abcfolio.com/quality-wordpress-plugins-support-registration/">Contact us to get your License Key.</a>';
        echo abcfl_html_tag_ends('p,div');
    }
    }

if ( !function_exists( 'abcfl_autil_pg_license' ) ){
    function abcfl_autil_pg_license( $optnName, $pluginName='' ) {
        abcfl_autil_pg_license_n( $optnName, $pluginName='' );    
    }
}

if ( !function_exists( 'abcfl_autil_add_licence_key' ) ){
function abcfl_autil_add_licence_key($key, $optnName){

    $optns = abcfl_autil_saved_optns($optnName);
    $key = abcfl_autil_fix_key(trim($key));
    $optns['license_key'] = strtoupper($key) ;
    update_option( $optnName, $optns );
    //update_option( 'abcfkap_optns', $optns );
}
}

//Legacy ------------------
if ( !function_exists( 'abcfl_util_get_licence_key' ) ){
function abcfl_util_get_licence_key($optnName){

    $optns = abcfl_autil_saved_optns($optnName);
    return $optns['license_key'];
}
}
//------------------------------------------------------------
if ( !function_exists( 'abcfl_autil_get_licence_key' ) ){
function abcfl_autil_get_licence_key($optnName){

    $optns = abcfl_autil_saved_optns( $optnName );
    return $optns['license_key'];
}
}

if ( !function_exists( 'abcfl_autil_saved_optns' ) ){
function abcfl_autil_saved_optns($optnName) {

    $defaults = array( 'license_key' => '' );
    return wp_parse_args(get_option( $optnName, array() ), $defaults );
}
}

if ( !function_exists( 'abcfl_autil_fix_key' ) ){
//Remove everything except -, a-z, A-Z and 0-9:
function abcfl_autil_fix_key($str) { return preg_replace("/[^a-zA-Z0-9-]+/", "", $str); }
}

if ( !function_exists( 'abcfl_autil_permission_check' ) ){
//Check if user is an admin
function abcfl_autil_permission_check() {

    $msg = __( 'Sorry, you are not allowed to access this page.' );

    if ( !current_user_can('edit_pages')){
        echo abcfl_autil_msg_err( $msg, true );
    }
}
}

if ( !function_exists( 'abcfl_autil_user_can' ) ){
//Check if user is an admin
function abcfl_autil_user_can( $usr ) {

    $out = false;
    $msg = __( 'Sorry, you are not allowed to access this page.' );
    //$msg = __( 'Sorry, you are not allowed to edit this item.' );

    switch ($usr) {
        case 'editor':
            $out = current_user_can('edit_pages');
            $msg = $msg . ' Only administrators and editors.';
            break;
        case 'admin':
            $out = current_user_can('create_users');
            $msg = $msg . ' Only administrators.';
            break;
        default:
            break;
    }

    if ( !$out ){
        return abcfl_autil_msg_err($msg, true);
    }
}
}

//== LICENCE END ===============================================================