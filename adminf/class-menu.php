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
            //$capSCE = 'staff_categories_editor';
            $capEditor = 'edit_pages';

            //57-Staff Categories; 12-Admin;

            //add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );   
            add_submenu_page( $slug, abcfsl_txta(57), abcfsl_txta(57), $capEditor, 'edit-tags.php?taxonomy=tax_staff_member_cat&post_type=cpt_staff_lst_item' );
            add_submenu_page( $slug, abcfsl_txta(12), abcfsl_txta(12), $capEditor, 'abcfsl-admin-tabs', array (&$this, 'load_page'));

        }

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