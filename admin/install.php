<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * Called on register_activation hook
 */
register_activation_hook( ABCFSL_PLUGIN_FILE, 'abcfsl_activate' );

/**
 * Fired when the plugin is activated. $network_wide =
 * TRUE if WPMU superadmin uses "Network Activate" action,
 * FALSE if WPMU is disabled or plugin is activated on an individual blog.
 */
function abcfsl_activate( $network_wide ) {

    if ( function_exists( 'is_multisite' ) && is_multisite() ) {

            if ( $network_wide ) {
                    // Get all blog ids
                    $blog_ids = abcfsl_db_wpmu_blogs();
                    foreach ( $blog_ids as $blog_id ) {
                            switch_to_blog( $blog_id );
                            abcfsl_install_single_activate();
                    }
                    restore_current_blog();
            }
            else{
                abcfsl_install_single_activate();
            }
    }
    else {
        abcfsl_install_single_activate();
    }
}

function abcfsl_install_single_activate() {
    abcfsl_install_create_tbls();
}

function abcfsl_install_create_tbls() {
}
