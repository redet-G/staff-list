<?php
if ( ! defined( 'ABSPATH' ) ) {exit;}
class ABCFSL_MBox_CAT_Menu {

    public function __construct() {
        add_action( 'add_meta_boxes_cpt_staff_lst_menu', array( $this, 'add_meta_box' ) );
        add_action( 'save_post_cpt_staff_lst_menu', array( $this, 'save_post' ) );
    }

    public function add_meta_box() {
        add_meta_box(
            'abcfsl_mbox_cat_menu',
            abcfsl_txta(9),
            array( $this, 'display_mbox' ),
            'cpt_staff_lst_menu',
            'normal',
            'high'
        );
    }

    public function display_mbox() {
        abcfsl_mbox_menu_cat_tabs();
    }

    public function save_post( $postID ) {

        $obj = ABCFSL_Main();
        $slug = $obj->pluginSlug;

        //Exit if user doesn't have permission to save
        if (!$this->user_can_save( $postID, $slug . '_nonce', $slug ) ) {  return; }

        //----------------------------------
	$old = get_post_meta($postID, '_catSlugs', true);
	$new = array();

        $slugs = $_POST['catSlug'];
        $count = count( $slugs );

    // SANITAZE   
    for ( $i = 0; $i < $count; $i++ ) {
        if ( $slugs[$i] != '' ) {
            $new[$i]['catSlug'] = sanitize_title( $slugs[$i] );
            //$new[$i]['catSlug'] = $slugs[$i] ; 
        }
	}

	if ( !empty( $new ) && $new != $old ){
		update_post_meta( $postID, '_catSlugs', $new );
    }

	if ( empty($new) && $old ){
		delete_post_meta( $postID, '_catSlugs', $old );
    }

        abcfl_mbsave_save_txt($postID, 'fPageUrl', '_fPageUrl');
        //----------------------------------

        //----------------------------------
        abcfl_mbsave_save_urlraw($postID, 'fPageUrl', '_fPageUrl');
        abcfl_mbsave_save_txt($postID, 'defaultFTxt', '_defaultFTxt');
        abcfl_mbsave_save_chekbox($postID, 'showAllLast', '_showAllLast');
        abcfl_mbsave_save_txt($postID, 'noDataMsg', '_noDataMsg');

        abcfl_mbsave_save_cbo( $postID, 'fCols', '_fCols', '2');
        abcfl_mbsave_save_css_size( $postID, 'fCntrW', '_fCntrW');
        abcfl_mbsave_save_cbo( $postID, 'fCntrCenter', '_fCntrCenter', 'Y');
        abcfl_mbsave_save_cbo( $postID, 'fItemsCenter', '_fItemsCenter', 'Y');
        abcfl_mbsave_save_cbo( $postID, 'fItemsCntrMT', '_fItemsCntrMT', 'N');
        abcfl_mbsave_save_cbo( $postID, 'fItemsCntrMB', '_fItemsCntrMB', 'N');

        abcfl_mbsave_save_cbo( $postID, 'fItemMLR', '_fItemMLR' , '10');
        abcfl_mbsave_save_cbo( $postID, 'fItemFont', '_fItemFont' , 'D');
        abcfl_mbsave_save_cbo( $postID, 'fItemColor', '_fItemColor' , 'N');
        abcfl_mbsave_save_cbo( $postID, 'fItemHlight', '_fItemHlight' , 'N');
        abcfl_mbsave_save_cbo( $postID, 'upCase', '_upCase', 'N');

        //abcfl_mbsave_save_txt($postID, 'fItemCls', '_fItemCls');
        //abcfl_mbsave_save_txt($postID, 'fItemStyle', '_fItemStyle');
    }

    private function user_can_save( $postID, $nonceAction, $nonceID ) {

        if ( !current_user_can('edit_pages', $postID) ) { return false; };

        $is_autosave = wp_is_post_autosave( $postID );
        $is_revision = wp_is_post_revision( $postID );
        $is_valid_nonce = ( isset( $_POST[ $nonceAction ] ) && wp_verify_nonce( $_POST[ $nonceAction ], $nonceID ) );

        return ! ( $is_autosave || $is_revision ) && $is_valid_nonce;
    }

}

//    [catSlug] => Array
//        (
//            [0] => poludniowe
//            [1] => polnocne
//            [2] =>
//        )
//
//    [menuItemTxt] => Array
//        (
//            [0] => Menu Item Caption
//            [1] =>
//        )
//
//    [catPgURL] => Array
//        (
//            [0] => https://www.google.com/
//            [1] =>
//        )
//
//[catSlug] => Array
//        (
//            [0] => poludniowe
//            [1] => polnocne
//            [2] =>
//        )

//[catPg] => Array
//    (
//        [txt] => Array
//            (
//                [0] => cc1
//                [1] => cc2
//                [2] =>
//            )
//
//        [url] => Array
//            (
//                [0] => uu1
//                [1] => uu2
//                [2] =>
//            )
//
//    )
//
//