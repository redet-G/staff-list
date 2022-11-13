<?php
/**
 * Admin menu
*/
if (!class_exists("ABCFSL_Admin_Menu")) {

    class ABCFSL_Admin_Menu {

        function __construct() {
            add_action( 'admin_menu', array (&$this, 'add_menu') );
        }

        function add_menu() {

            $slug = 'edit.php?post_type=cpt_staff_lst_item';

            $capability = 'edit_pages';
            //add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );dashicons-format-gallery
            add_menu_page('Staff List', 'Staff List', $capability, $slug, '', 'dashicons-groups', 81);

            //add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
            add_submenu_page( $slug, abcfsl_txta(12), abcfsl_txta(12), $capability, 'abcfsl-admin-tabs', array (&$this, 'load_page'));
        }

//        function add_menu() {
//
//            $slug = 'edit.php?post_type=cpt_staff_lst_item';
//            $capEditor = 'edit_pages';
//
//            //add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
//            add_submenu_page( $slug, abcfsl_txta(12), abcfsl_txta(12), $capEditor, 'abcfsl-admin-tabs', array (&$this, 'load_page'));
//        }

        function load_page() {

            switch ($_GET['page']){
                case 'abcfsl-admin-tabs' :
                    abcfsl_admin_tabs();
                    break;
                default:
                    break;
            }
        }
}
}

$abcfrfs = new ABCFSL_Admin_Menu();
