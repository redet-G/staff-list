<?php
/**
 * Custom post types setup
*/
if ( ! defined( 'ABSPATH' ) ) {exit;}

add_action( 'init', 'abcfsl_register_tax_category', 10);
add_action( 'init', 'abcfsl_register_post_types', 100 );
//----------------------------------------
function abcfsl_register_post_types() {

    $slug = 'edit.php?post_type=cpt_staff_lst_item';
    register_post_type( 'cpt_staff_lst_item', abcfsl_post_types_args_sm() );

    //Located in inc.
    register_post_type( 'cpt_staff_lst', abcfsl_post_types_args_st( $slug ) );
    register_post_type( 'cpt_staff_grps', abcfsl_post_types_group( $slug ) );
    register_post_type( 'cpt_staff_lst_menu', abcfsl_post_types_args_cm( $slug ) );
    register_post_type( 'cpt_staff_az_menu', abcfsl_post_types_args_azm( $slug ) );
}

function abcfsl_register_tax_category() {
    register_taxonomy( 'tax_staff_member_cat', array( 'cpt_staff_lst_item'), abcfsl_tax_category_args() );
    add_action('created_tax_staff_member_cat', 'abcfsl_register_roles_category',10,1);
    abcfsl_register_roles_category();
}

function abcfsl_register_roles_category()
{
    // create a new role for each category and assign a capability to edit them

    // get all the categories and create capabilities
    $categories = get_terms(['taxonomy' => 'tax_staff_member_cat','hide_empty' => false,]);
    foreach ($categories as $category) {
        $capability =  'manage_staff_profile_for_' . $category->slug;
        add_role('staff_profile_manager_for_' . $category->slug, 'Staff Profile Manager for ' . $category->name,[
            $capability => true,
            'assign_staff_categories'=>true,
            'delete_staff_member'=>true,
            'delete_staff_members'=>true,
            'delete_private_staff_members'=>true,
            'delete_published_staff_members'=>true,
            'delete_published_staff_members'=>true,
            'delete_private_staff_members'=>true,
            'edit_private_staff_members'=>true,
            'edit_published_staff_members'=>true,
            'edit_staff_member'=>true,
            'edit_staff_members'=>true,
            'publish_staff_members'=>true,
            'publish_staff_members'=>true,
            'read_private_staff_members'=>true,
            'read_staff_member'=>true,
            'read_staff_members'=>true,
            'read'=>true]);

        $admin = get_role( 'administrator' );
        $editor = get_role( 'editor' );

        if ( ! is_null( $admin ) ) {
            $admin->add_cap( $capability );
            $admin->add_cap( 'staff_profile_act_as_admin' );
        }
        if ( ! is_null( $editor ) ) {
            $editor->add_cap( $capability);
            $admin->add_cap( 'staff_profile_act_as_admin' );
        }


    }
}

//-- Staff Member ---------------------------------------------
function abcfsl_post_types_args_sm() {

    $args = array(
        'labels'        => abcfsl_post_types_lbls_sm(),
        'description'   => '',
        'taxonomies'    => array( 'tax_staff_lst_grp' ),
        'public'        => true,
    'exclude_from_search'   => true,
    'publicly_queryable'   => false,
    'show_in_nav_menus'   => false,
    'show_ui'       => true,
        'hierarchical'  => false,
        'supports'      => array( 'title' ),
        'has_archive'   => false,
        'show_in_menu'  => true,
        'menu_icon'   => 'dashicons-groups',
        'menu_position' => 81,
        'capability_type' => 'staff_member',
        'map_meta_cap' => true
    );
    return $args;
}

function abcfsl_post_types_lbls_sm() {
    $lbls = array(
            'menu_name' => 'Staff List',
            'name'               => __('Staff Members', 'staff-list'), //Staff Members Admin table header
            'add_new'            => __('Add New', 'staff-list'),
            'add_new_item'       => __('Staff Member', 'staff-list'), //Staff Member, New record
            'edit_item'          => __('Staff Member', 'staff-list'), //Staff Member, Edit  record
            'all_items'          => __('Staff Members', 'staff-list') //Staff Members Main menu label
    );
    return $lbls;
}