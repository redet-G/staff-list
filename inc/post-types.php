<?php
//--  COMMON POST TYPES  --------------------------------------
if ( ! defined( 'ABSPATH' ) ) {exit;}

//-- Staff Template --------------------------------
function abcfsl_post_types_args_st( $slug ) {

    $args = array(
        'labels'        => abcfsl_post_types_lbls_st(),
        'description'   => '',
        'public'        => true,
        'hierarchical'  => false,
        'supports'      => array( 'title' ),
        'has_archive'   => false,
        'show_ui'       => true,
        'show_in_menu'  => $slug
    );
    return $args;
}

function abcfsl_post_types_lbls_st() {
    $lbls = array(
        'menu_name'	         => 'Menu Staff',
        'name'               => 'Staff Templates', //Staff Templates, Admin table header 
        'add_new'            => __('Add Template', 'staff-list'),
        'add_new_item'       => 'Staff Template', //Staff Template, New record
        'edit_item'          => 'Staff Template', //Staff Template, Edit record
        'all_items'          =>  'Staff Templates', //Menu - Main label
    );
    return $lbls;
}

//== GROUPS =====================================
function abcfsl_post_types_group( $slug ) {

    $args = array(
            'labels'        => abcfsl_post_types_group_lbls(),
            'description'   => '',
            'public'        => false,
            'hierarchical'  => false,
            'supports'      => array( 'title' ),
            'has_archive'   => false,
            'show_ui'       => true,
            'show_in_menu'  => $slug
    );
    return $args;
}

function abcfsl_post_types_group_lbls() {

    $lbls = array(
        'name'               => 'Groups', //Admin table header
        'add_new'            => __('Add Template', 'staff-list'),
        'add_new_item'       => 'Grouping Template', //New record
        'edit_item'          => 'Grouping Template', //Edit record
        'all_items'          => 'Groups', //Menu - Main label
    );
    return $lbls;
}

// == Staff Categories taxonomy ==========================================
function abcfsl_tax_category_args() {
//Taxonomy capabilities include: assign_terms, edit_terms, manage_terms (displays the taxonomy in the admin navigation), delete_terms.
    $args = array(
        'labels' => abcfsl_tax_category_lbls(),
        'public'  => false,
        'show_ui' => true,
        'hierarchical' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'show_in_nav_menus' => false,
        'show_in_menu'  => false,
        'rewrite' => array( 'slug' => 'staff_category' ),
        'capabilities' => array(
            'manage_terms'  => 'manage_staff_categories' ,
            'edit_terms'    => 'manage_staff_categories',
            'delete_terms'  => 'manage_staff_categories',
            'assign_terms'  => 'assign_staff_categories'
        )
    );
    return $args;
}

function abcfsl_tax_category_lbls() {
    $lbls = array(
            'name'              => __('Staff Categories', 'staff-list'), //Categories Main screen + Staff member category selection + Staff Members Table Header. 
            'add_new_item'      => __('Add Category', 'staff-list'), // Add staff category. Category screen + buttom
            'edit_item'         => __('Edit Category', 'staff-list'), //Edit category screen
            'update_item'        => __('Edit Category', 'staff-list'),       
            'all_items'         => __('Staff Categories', 'staff-list')  //Staff member category selection. only Tab All
        );
    return $lbls;
}

//-- Category Menu --------------------------------
function abcfsl_post_types_args_cm( $slug ) {
    $args = array(
        'labels'        => abcfsl_post_types_lbls_cm(),
        'description'   => '',
        'public'        => false,
        'hierarchical'  => false,
        'supports'      => array( 'title' ),
        'has_archive'   => false,
        'show_ui'       => true,
        'show_in_menu'  => $slug
    );
    return $args;
}

function abcfsl_post_types_lbls_cm() {
    $lbls = array(
        'name'               => 'Category Menus', //Category Menus, Admin table header
        'add_new'            => __( 'Add Menu', 'staff-list'),
        'add_new_item'       => 'Category Menu', //Category Menu New record
        'edit_item'          => 'Category Menu', //Category Menu Edit record
        'all_items'          => 'Category Menus' //Menu - Main label no POT
    );
    return $lbls;
}

//--AZ Menu --------------------------------------
function abcfsl_post_types_args_azm( $slug ) {
    $args = array(
        'labels'        => abcfsl_post_types_lbls_azm(),
        'description'   => '',
        'public'        => false,
        'hierarchical'  => false,
        'supports'      => array( 'title' ),
        'has_archive'   => false,
        'show_ui'       => true,
        'show_in_menu'  => $slug
    );
    return $args;
}

function abcfsl_post_types_lbls_azm() {
    $lbls = array(
        'name'               => 'AZ Menus', //AZ Menus, Admin table header
        'add_new'            => __( 'Add Menu', 'staff-list'),
        'add_new_item'       => 'AZ Menu', //AZ Menu Menu New record
        'edit_item'          => 'AZ Menu', //AZ Menu Menu Edit record
        'all_items'          => 'AZ Menus' //Menu - Main label
    );
    return $lbls;
}