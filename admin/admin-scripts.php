<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'admin_enqueue_scripts', 'abcfsl_enq_admin_css', 10 );
add_action( 'admin_enqueue_scripts', 'abcfsl_enq_admin_js' );

//==ADMIN======================================================
//Admin CSS
function abcfsl_enq_admin_css() {

    $obj = ABCFSL_Main();
    $ver = $obj->pluginVersion;

    wp_register_style('abcfsl-admin-l', ABCFSL_PLUGIN_URL . 'library/abcfl-admin.css', $ver, 'all');
    wp_register_style('abcfsl-admin', ABCFSL_PLUGIN_URL . 'css/admin.css', $ver, 'all');
    wp_enqueue_style('abcfsl-admin-l');
    wp_enqueue_style('abcfsl-admin');
}

//Admin JS
function abcfsl_enq_admin_js() {

    global $typenow;
    $obj = ABCFSL_Main();
    $ver = $obj->pluginVersion;
    $slug = $obj->pluginSlug;

    wp_register_script( 'abcfsl_vtabs_sl', ABCFSL_PLUGIN_URL . 'js/vtabs-sl.js', array( 'jquery' ), $ver, true );
    wp_enqueue_script('abcfsl_vtabs_sl');

    if( $typenow == 'cpt_staff_lst_menu' || $typenow == 'cpt_staff_mfilter' || $typenow == 'cpt_staff_is_menu' || 'cpt_staff_grps' ) {
        wp_register_script( 'abcfsl_cat_menu_items', ABCFSL_PLUGIN_URL .'js/cat-menu-items.js', array('jquery', 'common', 'jquery-ui-core', 'jquery-ui-draggable', 'jquery-ui-droppable', 'jquery-ui-sortable', 'jquery-ui-mouse'), $ver, true );
        wp_enqueue_script( 'abcfsl_cat_menu_items' );
    }

    if( $typenow == 'cpt_staff_mfilter' || $typenow == 'cpt_staff_lst' ) {
        wp_register_script( 'abcfsl_filter_items', ABCFSL_PLUGIN_URL .'js/filter-items.js', array('jquery', 'common', 'jquery-ui-core', 'jquery-ui-draggable', 'jquery-ui-droppable', 'jquery-ui-sortable', 'jquery-ui-mouse'), $ver, true );
        wp_enqueue_script( 'abcfsl_filter_items' );
    }

    if( $typenow == 'cpt_staff_lst' ) {
        wp_register_script( 'abcfsl_sort_fields', ABCFSL_PLUGIN_URL .'js/sort-fields.js', array('jquery', 'common', 'jquery-ui-core', 'jquery-ui-draggable', 'jquery-ui-droppable', 'jquery-ui-sortable', 'jquery-ui-mouse'), $ver, true );
        wp_localize_script( 'abcfsl_sort_fields', 'abcfslVars', array('ajaxNonce' => wp_create_nonce($slug)));
        wp_enqueue_script( 'abcfsl_sort_fields' );

        wp_register_script( 'abcfsl_sort_items', ABCFSL_PLUGIN_URL . 'js/sort-items.js', array( 'jquery', 'jquery-ui-sortable' ), $ver, true );
        wp_localize_script( 'abcfsl_sort_items', 'abcfslVars', array('ajaxNonce' => wp_create_nonce($slug)));
        wp_enqueue_script( 'abcfsl_sort_items' );
    }

   //--Images Selection -----------------------------
    if( $typenow == 'cpt_staff_lst_item' ) {
        wp_enqueue_media();
        wp_register_script( 'abcfsl_img_selector', ABCFSL_PLUGIN_URL . 'js/imgSelector.js', array( 'jquery' ) );
        wp_localize_script( 'abcfsl_img_selector', 'abcfslIS', array(
                'title' => __( 'Choose Image', 'staff-list' ),
                'button' => __( 'Choose Image', 'staff-list' ),
                'btnImg' => '#btnImg',
                'imgUrl' => '#imgUrl',
                'imgID' => '#imgID',
            )
        );
        wp_enqueue_script('abcfsl_img_selector');
    }

    if( $typenow == 'cpt_staff_lst' ) {
        wp_enqueue_media();
        wp_register_script( 'abcfsl_p_img_selector', ABCFSL_PLUGIN_URL . 'js/imgSelector.js', array( 'jquery' ) );
        wp_localize_script( 'abcfsl_p_img_selector', 'abcfslIS', array(
                'title' => __( 'Choose Image', 'staff-list' ),
                'button' => __( 'Choose Image', 'staff-list' ),
                'btnImg' => '#btnPImg',
                'imgUrl' => '#pImgUrl',
                'imgID' => '#pImgID'
            )
        );
        wp_enqueue_script('abcfsl_p_img_selector');
    }
}