<?php
if ( ! defined( 'ABSPATH' ) ) {exit;}
class ABCFSL_MBox_Groups {

    public function __construct() {
        add_action( 'add_meta_boxes_cpt_staff_grps', array( $this, 'add_meta_box' ) );
        add_action( 'save_post_cpt_staff_grps', array( $this, 'save_post' ) );
    }

    public function add_meta_box() {
        add_meta_box(
            'abcfsl_mbox_staff_grps',
            abcfsl_txta(9),
            array( $this, 'display_mbox' ),
            'cpt_staff_grps',
            'normal',
            'high'
        );
    }

    public function display_mbox() {
        abcfsl_mbox_groups_tabs();
    }

    public function save_post( $postID ) {

        $obj = ABCFSL_Main();
        $slug = $obj->pluginSlug;

        //Exit if user doesn't have permission to save
        if (!$this->user_can_save( $postID, $slug . '_nonce', $slug ) ) {  return; }
        
        //New record. GRPCAT GRPTXT GRPABC
        $grpTypePost = ( isset( $_POST['grpType' ]) ? $_POST['grpType' ] : '' );

        if ( !empty( $grpTypePost ) ){
            abcfl_mbsave_save_field( $postID, '_grpType', $grpTypePost);
            return;
        }
        
        $grpType = get_post_meta( $postID, '_grpType', true );
        if ( empty( $grpType ) ){
            $grpType = 'GRPCAT';
            abcfl_mbsave_save_field( $postID, '_grpType', $grpType);
            $grpType = get_post_meta( $postID, '_grpType', true );
        }
        if ( empty( $grpType ) ){ return;  }
        
        //--------------------------------------------
        $this->save_group_options( $postID, $grpType );
        //----------------------------------
        abcfl_mbsave_save_cbo( $postID, 'grpCntrMT', '_grpCntrMT', '');
        abcfl_mbsave_save_cbo( $postID, 'grpCntrMB', '_grpCntrMB', '');
        abcfl_mbsave_save_txt($postID, 'grpCntrCustCls', '_grpCntrCustCls');
        abcfl_mbsave_save_cbo( $postID, 'grpItemML', '_grpItemML', '');       
        abcfl_mbsave_save_cbo( $postID, 'grpFontSize', '_grpFontSize', '');
        abcfl_mbsave_save_cbo( $postID, 'grpFontColor', '_grpFontColor', '');
        abcfl_mbsave_save_cbo( $postID, 'upCase', '_upCase', '');        
        abcfl_mbsave_save_txt($postID, 'grpNameCustCls', '_grpNameCustCls');
        abcfl_mbsave_save_txt($postID, 'grpHLine', '_grpHLine');        
    }

    //======================================================
    private function save_group_options( $postID, $grpType ) {

        //GRPCAT GRPTXT GRPABC
       switch ( $grpType ) {
            case 'GRPCAT':
                $this->save_grp_items_cat( $postID, $grpType );
                break;
            case 'GRPTXT':
                $this->save_grp_items_cat( $postID, $grpType );
                $this->save_grp_field_id( $postID );
                break;
            case 'GRPABC':
                $this->save_grp_items_cat( $postID, $grpType ); 
                $this->save_grp_field_id( $postID );   
            default:
                break;
        }
    }

    private function save_grp_items_cat( $postID, $grpType ) {

        $old = get_post_meta( $postID, '_grpSlugs', true );
        $new = array();

        $slugs = $_POST['grpSlugs'];
        $count = count( $slugs );

        for ( $i = 0; $i < $count; $i++ ) {
            if ( $slugs[$i] != '' ) {
                if( $grpType == 'GRPCAT' ){
                    $new[$i]['grpSlugs'] = sanitize_title( $slugs[$i] );
                }
                else{
                    $new[$i]['grpSlugs'] = esc_html( $slugs[$i] ); 
                }
            }
        }

        if ( !empty( $new ) && $new != $old ){
                update_post_meta( $postID, '_grpSlugs', $new );
        }

        if ( empty($new) && $old ){
                delete_post_meta( $postID, '_grpSlugs', $old );
        }
    }

    private function save_grp_field_id( $postID ) {
        abcfl_mbsave_save_cbo( $postID, 'grpFieldID', '_grpFieldID', '');
        abcfl_mbsave_save_cbo( $postID, 'grpFieldType', '_grpFieldType', '');
    }

    private function user_can_save( $postID, $nonceAction, $nonceID ) {

        if ( !current_user_can('edit_pages', $postID) ) { return false; };

        $is_autosave = wp_is_post_autosave( $postID );
        $is_revision = wp_is_post_revision( $postID );
        $is_valid_nonce = ( isset( $_POST[ $nonceAction ] ) && wp_verify_nonce( $_POST[ $nonceAction ], $nonceID ) );

        return ! ( $is_autosave || $is_revision ) && $is_valid_nonce;
    }

}
