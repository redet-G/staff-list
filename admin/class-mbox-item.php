<?php
if ( ! defined( 'ABSPATH' ) ) {exit;}
class ABCFSL_MBox_Item {

    private $sortT = '';
    private $imgUtil;
    private $uploadDir = '';

    public function __construct() {
        add_action( 'add_meta_boxes_cpt_staff_lst_item', array( $this, 'add_meta_box' ) );
        add_action( 'save_post_cpt_staff_lst_item', array( $this, 'save_post' ) );     
    }

    public function add_meta_box($post) {

        add_meta_box(
            'abcfsl_staff_member',
            abcfsl_txta(268),
            array( $this, 'display_staff_member' ),
            $post->post_type,
            'normal',
            'default'
        );

        add_meta_box('abcfsl_staff_member_tax_category');

        add_meta_box(
            'abcfsl_staff_member_parent',
            abcfsl_txta(350),
            array( $this, 'staff_templates_cbo' ),
            $post->post_type,
            'side',
            'core'
        );
    }
//------------------------------------------------
    function remove_metabox() {
        remove_meta_box( 'wpseo_meta', 'cpt_img_txt_list', 'normal' );
    }

    public function display_staff_member() {
        abcfsl_mbox_item_tabs();
    }

    //meta box Select Template
    public function staff_templates_cbo( $post ) {

        $tplateID = $post->post_parent;
        if( $tplateID == 0 ) { $tplateID = get_option( 'sl_default_tplate_id', 0 ); }

        $cboTplates = abcfsl_dba_cbo_tplates( abcfsl_txta(244) );
        echo abcfl_input_cbo('parent_id', 'parent_id', $cboTplates, $tplateID, '', abcfsl_txta(267), '100%', true, 'widefat');
    }

    public function save_post( $postID ) {
        die('hahahahahahahaha');
        $obj = ABCFSL_Main();
        $slug = $obj->pluginSlug;

        //Exit if user doesn't have permission to save
        if (!$this->user_can_save( $postID, $slug . '_nonce', $slug ) ) {
            return;
        }

//echo"<pre>", print_r( $_POST, true ), "</pre>"; die; 

        //Checkbox Hide record --------------------------
        abcfl_mbsave_save_chekbox($postID, 'hideSMember', '_hideSMember');
        abcfl_mbsave_save_chekbox($postID, 'hideSPgLnk', '_hideSPgLnk');

        //abcfl_mbsave_save_txt_sanitize_title($postID, 'pretty', '_pretty');
        abcfl_mbsave_save_txt($postID, 'pretty', '_pretty');
        abcfl_mbsave_save_txt($postID, 'sPgTitle', '_sPgTitle');

        abcfl_mbsave_save_txt($postID, 'itemCustCls', '_itemCustCls');
        abcfl_mbsave_save_txt($postID, 'itmemCntrLCustCSS', '_itmemCntrLCustCSS');
        abcfl_mbsave_save_txt($postID, 'itmemCntrSCustCSS', '_itmemCntrLCustCSS');
        //------------------------------------------------
        $this->save_img_L( $postID );
        $this->save_img_S( $postID );
        abcfl_mbsave_save_txt($postID, 'imgLnkL', '_imgLnkL');
        abcfl_mbsave_save_txt($postID, 'imgLnkArgs', '_imgLnkArgs');
        abcfl_mbsave_save_txt($postID, 'imgLnkClick', '_imgLnkClick');

        abcfl_mbsave_save_txt($postID, 'overTxtI1', '_overTxtI1');
        abcfl_mbsave_save_txt($postID, 'overTxtI2', '_overTxtI2');

        //--SOCIAL ICONS -------------------------------
        abcfl_mbsave_save_txt($postID, 'fbookUrl', '_fbookUrl');
        abcfl_mbsave_save_txt($postID, 'googlePlusUrl', '_googlePlusUrl');
        abcfl_mbsave_save_txt($postID, 'twitUrl', '_twitUrl');
        abcfl_mbsave_save_txt($postID, 'likedUrl', '_likedUrl');
        abcfl_mbsave_save_txt($postID, 'emailUrl', '_emailUrl');
        abcfl_mbsave_save_txt($postID, 'socialC1Url', '_socialC1Url');
        abcfl_mbsave_save_txt($postID, 'socialC2Url', '_socialC2Url');
        abcfl_mbsave_save_txt($postID, 'socialC3Url', '_socialC3Url');
        abcfl_mbsave_save_txt($postID, 'socialC4Url', '_socialC4Url');
        abcfl_mbsave_save_txt($postID, 'socialC5Url', '_socialC5Url');
        abcfl_mbsave_save_txt($postID, 'socialC6Url', '_socialC6Url');
        //--------------------------------------

        $tplateID = isset( $_POST['parent_id'] ) ?  $_POST['parent_id'] : 0 ;
        $this->save_sort_txt( $postID, $tplateID );

        //$this->imgUtil = new ABCFVC_Img_Util();
        //$this->uploadDir = $this->imgUtil->getUploadDir();

        //FIELDS_50
        //--------------------------------------
        for ( $i = 1; $i <= 50; $i++ ) { 
            $this->save_item_field( $postID, 'F' . $i, $tplateID ); 
        }

        $this->update_menu_order();
    }

    //======================================
    private function save_item_field( $postID, $F, $tplateID ) {

        // Text and Paragraph fields
        abcfl_mbsave_save_txt_html( $postID, 'txt_' . $F, '_txt_' . $F );
        abcfl_mbsave_save_txt($postID, 'url_' . $F, '_url_' . $F);
        abcfl_mbsave_save_txt($postID, 'urlTxt_' . $F, '_urlTxt_' . $F);      
        abcfl_mbsave_save_txt($postID, 'imgUrl_' . $F, '_imgUrl_' . $F);
        abcfl_mbsave_save_txt($postID, 'imgAlt_' . $F, '_imgAlt_' . $F);        
        abcfl_mbsave_save_txt($postID, 'imgLnk_' . $F, '_imgLnk_' . $F);        
        abcfl_mbsave_save_txt($postID, 'imgLnkAttr_' . $F, '_imgLnkAttr_' . $F);
        abcfl_mbsave_save_txt($postID, 'imgLnkClick_' . $F, '_imgLnkClick_' . $F);
        abcfl_mbsave_save_txt($postID, 'dteYMD_' . $F, '_dteYMD_' . $F);  
        //abcfl_mbsave_save_txt($postID, 'captionDyn_' . $F, '_captionDyn_' . $F);  
             
        //abcfl_mbsave_save_txt_editor($postID, 'editorCnt_' . $F, '_editorCnt_' . $F); ??????
        abcfl_mbsave_save_tinymce( $postID, 'editorCnt_' . $F, '_editorCnt_' . $F );

        //Multipart field
        abcfl_mbsave_save_txt($postID, 'mp1_' . $F, '_mp1_' . $F);
        abcfl_mbsave_save_txt($postID, 'mp2_' . $F, '_mp2_' . $F);
        abcfl_mbsave_save_txt($postID, 'mp3_' . $F, '_mp3_' . $F);
        abcfl_mbsave_save_txt($postID, 'mp4_' . $F, '_mp4_' . $F);
        abcfl_mbsave_save_txt($postID, 'mp5_' . $F, '_mp5_' . $F);

        abcfl_mbsave_save_txt($postID, 'icon1Url_' . $F, '_icon1Url_' . $F);
        abcfl_mbsave_save_txt($postID, 'icon2Url_' . $F, '_icon2Url_' . $F);
        abcfl_mbsave_save_txt($postID, 'icon3Url_' . $F, '_icon3Url_' . $F);
        abcfl_mbsave_save_txt($postID, 'icon4Url_' . $F, '_icon4Url_' . $F);
        abcfl_mbsave_save_txt($postID, 'icon5Url_' . $F, '_icon5Url_' . $F);
        abcfl_mbsave_save_txt($postID, 'icon6Url_' . $F, '_icon6Url_' . $F);

        abcfl_mbsave_save_txt($postID, 'adr1_' . $F, '_adr1_' . $F);
        abcfl_mbsave_save_txt($postID, 'adr2_' . $F, '_adr2_' . $F);
        abcfl_mbsave_save_txt($postID, 'adr3_' . $F, '_adr3_' . $F);
        abcfl_mbsave_save_txt($postID, 'adr4_' . $F, '_adr4_' . $F);
        abcfl_mbsave_save_txt($postID, 'adr5_' . $F, '_adr5_' . $F);
        abcfl_mbsave_save_txt($postID, 'adr6_' . $F, '_adr6_' . $F);

        $this->abcfl_mbsave_save_cbom( $postID,  $F, $tplateID );
        $this->abcfl_mbsave_save_check( $postID,  $F, $tplateID );

        abcfl_mbsave_save_txt($postID, 'qrErrorTxt_' . $F, '_qrErrorTxt_' . $F);

        // QRHL64STA field. Create Code64 string and save it.
        if( array_key_exists( 'qrImg64_' . $F, $_POST ) ){
            $this->abcfl_mbsave_qr_code_img_64( $postID, $F , $tplateID);
        }

        if( array_key_exists( 'qrImgUri_' . $F, $_POST ) ){
            $this->abcfl_mbsave_qr_code_img_64( $postID, $F , $tplateID);
        }
    }

    //======================================
    // Create Code64 string and save it. Always recreate on save.
    private function abcfl_mbsave_qr_code_img_64( $postID, $F, $tplateID) {

        $params['staffID'] = $postID;
        $params['F'] = $F;
        $params['slTplateID'] = $tplateID;
        //$params['saveImg'] = false;    
    
        $qrImgBuilder = new ABCFSL_QR_Img_Builder( $params ); 
        $qrImgBuilder->maybeCreateQRImgUri(); 
    
        $errTxt = $qrImgBuilder->getErrTxt();
        $qrImgUri = $qrImgBuilder->getImgUri(); 

        // //---Image processing error ---------------------------------
        if( !empty( $errTxt ) ){
            abcfl_mbsave_save_field( $postID, '_qrErrorTxt_' . $F, $errTxt);
            abcfl_mbsave_save_field( $postID, '_qrImgUri_' . $F, '');
        }
        else{
            abcfl_mbsave_save_field( $postID, '_qrErrorTxt_' . $F, '');
            abcfl_mbsave_save_field( $postID, '_qrImgUri_' . $F, $qrImgUri);
        }
    }

    //===============================================================================
    private function abcfl_mbsave_save_check( $postID, $F , $tplateID) {

        $fieldType = get_post_meta( $tplateID, '_fieldType_' . $F, true );
        if( $fieldType != 'CHECKG' ) { return; }

        $fieldID = 'checkg_' . $F;
        $metaKey =  '_checkg_' . $F;
        $newCHECKs = ( isset( $_POST[$fieldID] ) ?  $_POST[$fieldID] : '' );      

        if ( empty($newCHECKs) ) { 
            delete_post_meta( $postID, $metaKey );
            return;
        }        

        if ( !is_array($newCHECKs) ) { 
            delete_post_meta( $postID, $metaKey );
            return;
        }               

        if (  abcfsl_util_is_array_empty( $newCHECKs ) ) { 
            delete_post_meta( $postID, $metaKey );
            return;
        } 

        //Remove empty elements;
        $newCHECKs = array_filter( $newCHECKs );
        $txtDelimited = abcfsl_autil_save_delimited( $newCHECKs );

        update_post_meta( $postID, $metaKey, $txtDelimited );
    }

    //======================================
    private function abcfl_mbsave_save_cbom( $postID, $F , $tplateID) {

        $fieldType = get_post_meta( $tplateID, '_fieldType_' . $F, true );
        if( $fieldType != 'CBOM' ) { return; }

        $fieldID = 'cbom_' . $F;
        $metaKey =  '_cbom_' . $F;
        $newCBOs = ( isset( $_POST[$fieldID] ) ?  $_POST[$fieldID] : '' );      

        if ( empty($newCBOs) ) { 
            delete_post_meta( $postID, $metaKey );
            return;
        }        

        if ( !is_array($newCBOs) ) { 
            delete_post_meta( $postID, $metaKey );
            return;
        }               

        if (  abcfsl_util_is_array_empty( $newCBOs ) ) { 
            delete_post_meta( $postID, $metaKey );
            return;
        } 

        $tplateOptns = $this->tplate_optns_sort_cbom( $F, $tplateID );
        $sortYN = $tplateOptns['cbomSort'];
        $locale = $tplateOptns['cbomSortLocale'];

        //Remove empty elements;
        $newCBOs = array_filter( $newCBOs );
        $txtDelimited = abcfsl_autil_save_sorted_delimited( $newCBOs, $sortYN, $locale );

        update_post_meta( $postID, $metaKey, $txtDelimited );
    }

    private function tplate_optns_sort_cbom( $F, $tplateID ){

        $out['cbomSort'] = 'N';
        $out['cbomSortLocale'] = '';
        if( $tplateID == 0 ) { return $out; }   

        $sortYN = get_post_meta( $tplateID, '_cbomSort_' . $F, true );        
        if( $sortYN == 'Y' ) { $out['cbomSort'] = 'Y'; }

        $out['cbomSortLocale'] = get_post_meta( $tplateID, '_cbomSortLocale_' . $F, true );

        return $out;  
    }

    //======================================
    private function save_sort_txt( $postID, $tplateID ) {

        if( $tplateID == 0 ) {
            abcfl_mbsave_save_txt( $postID, 'sortTxt', '_sortTxt' );
            return;
        }

        $tplateOptns = get_post_custom( $tplateID );
        $sortType = isset( $tplateOptns['_sortType'] ) ? $tplateOptns['_sortType'][0] : 'T';
        $this->sortT = $sortType;

        // -- Sort text has to be empty for copy from to work ----------------------------
        $sortTxt = ( isset( $_POST['sortTxt']) ? esc_attr( $_POST['sortTxt'] ) : '' );
        if( !empty( $sortTxt ) ) {
            abcfl_mbsave_save_txt( $postID, 'sortTxt', '_sortTxt' );
            return;
        }
        //---------------------------------------------------------------------------------
        $sortTxtInputType = isset( $tplateOptns['_sortTxtInputType'] ) ? $tplateOptns['_sortTxtInputType'][0] : '';
        $sortFieldF = isset( $tplateOptns['_sortFieldF'] ) ? $tplateOptns['_sortFieldF'][0] : '';
        $sortMPOrder = isset( $tplateOptns['_sortMPOrder'] ) ? esc_attr( $tplateOptns['_sortMPOrder'][0] ) : '';

        switch ( $sortTxtInputType ) {
            case 'SLT':
                $this->get_field_value_SLT( $postID, $sortFieldF );
                break;
            case 'MPF':
                $this->get_field_value_MPF( $postID, $sortFieldF, $sortMPOrder );
                break;
            case 'ADDRF':
                $this->get_field_value_ADDRF( $postID, $sortFieldF, $sortMPOrder );
                break;                
            default:
                abcfl_mbsave_save_txt( $postID, 'sortTxt', '_sortTxt' );
                break;
        }
    }

    private function get_field_value_SLT( $postID, $sortFieldF ) {

        if( empty( $sortFieldF ) ) {
            abcfl_mbsave_save_txt( $postID, 'sortTxt', '_sortTxt' );
            return;
        }
        $txt = isset( $_POST['txt_' . $sortFieldF]) ? esc_attr( $_POST['txt_' . $sortFieldF] ) : '';
        abcfl_mbsave_save_txt_value( $postID, '_sortTxt', $txt, '');
    }

    private function get_field_value_MPF( $postID, $sortFieldF, $sortMPOrder ) {

        //sortFieldF = template Field ID (F1...)
        if( empty( $sortFieldF ) || empty( $sortMPOrder ) ) {
            abcfl_mbsave_save_txt( $postID, 'sortTxt', '_sortTxt' );
            return;
        }

        if( strpos( $sortMPOrder, ',' ) === false ){
            $txt = isset( $_POST['mp' . $sortMPOrder . '_' . $sortFieldF]) ? esc_attr( $_POST['mp' . $sortMPOrder . '_' . $sortFieldF] ) : '';
            abcfl_mbsave_save_txt_value( $postID, '_sortTxt', $txt, '');
            return;
        }

        $txt = '';
        $mpOrder = explode( ',', $sortMPOrder );
        foreach ( $mpOrder as $value ) {
            $txt = trim($txt);
            $txt .= ' ';
            $txt .= isset( $_POST['mp' . $value . '_' . $sortFieldF]) ? esc_attr( $_POST['mp' . $value . '_' . $sortFieldF] ) : '';
        }

        abcfl_mbsave_save_txt_value( $postID, '_sortTxt', trim( $txt ), '');
    }

    private function get_field_value_ADDRF( $postID, $sortFieldF, $sortMPOrder ) {

        if( empty( $sortFieldF ) || empty( $sortMPOrder ) ) {
            abcfl_mbsave_save_txt( $postID, 'sortTxt', '_sortTxt' );
            return;
        }

        //mp1_F8
        if( strpos( $sortMPOrder, ',' ) === false ){
            $txt = isset( $_POST['adr' . $sortMPOrder . '_' . $sortFieldF]) ? esc_attr( $_POST['adr' . $sortMPOrder . '_' . $sortFieldF] ) : '';
            abcfl_mbsave_save_txt_value( $postID, '_sortTxt', $txt, '');
            return;
        }

        $txt = '';
        $mpOrder = explode( ',', $sortMPOrder );
        foreach ( $mpOrder as $value ) {
            $txt = trim($txt);
            $txt .= ' ';
            $txt .= isset( $_POST['adr' . $value . '_' . $sortFieldF]) ? esc_attr( $_POST['adr' . $value . '_' . $sortFieldF] ) : '';
        }

        abcfl_mbsave_save_txt_value( $postID, '_sortTxt', trim( $txt ), '');
    }

    //----------------------------------------------------------------
    private function save_img_alt( $postID, $imgID, $imgAlt ) {

        if( !empty( $imgAlt ) ) {
            abcfl_mbsave_save_txt($postID, 'imgAlt', '_imgAlt');
            return;
        }

        if( $imgID == 0 ){
            abcfl_mbsave_save_txt($postID, 'imgAlt', '_imgAlt');
            return;
        }

        $metaImgAlt = get_post_meta( $imgID, '_wp_attachment_image_alt', true);
        abcfl_mbsave_save_txt_value( $postID, '_imgAlt', $metaImgAlt,  '');
    }

    private function save_img_L( $postID ) {

        $imgUrlL = isset( $_POST['imgUrlL']) ? esc_attr( $_POST['imgUrlL' ] ) : '';
        $imgIDL = isset( $_POST['imgIDL']) ? $_POST['imgIDL' ] : 0 ;
        $imgAlt = isset( $_POST['imgAlt'] ) ? esc_attr( $_POST['imgAlt'] ) : '';
        $imgAttrL = isset( $_POST['imgAttrL'] ) ? esc_attr( $_POST['imgAttrL'] ) : '';

        $imgID = abcfsl_mbox_item_img_id( $imgUrlL );

        abcfl_mbsave_save_txt_value( $postID, '_imgUrlL', $imgUrlL,  '');
        abcfl_mbsave_save_txt_value( $postID, '_imgIDL', $imgID,  '');
        abcfl_mbsave_save_txt_value( $postID, '_imgAttrL', $imgAttrL,  '');

        $this->save_img_alt( $postID, $imgID, $imgAlt );
    }

    private function save_img_S( $postID ) {

        $imgUrlS = isset( $_POST['imgUrlS']) ? esc_attr( $_POST['imgUrlS' ] ) : '';
        $imgIDS = isset( $_POST['imgIDS']) ? $_POST['imgIDS' ] : 0;

        if( $imgUrlS == 'SP' ){
            abcfl_mbsave_save_txt_value( $postID, '_imgUrlS', 'SP',  '');
            abcfl_mbsave_save_txt_value( $postID, '_imgIDS', 0,  '');
            return;
        }

        $imgID = abcfsl_mbox_item_img_id( $imgUrlS );

        abcfl_mbsave_save_txt_value( $postID, '_imgUrlS', $imgUrlS,  '');
        abcfl_mbsave_save_txt_value( $postID, '_imgIDS', $imgID,  '');
    }

    //Update sort order.
    private function update_menu_order() {

        if( $this->sortT == 'M' ){ return; }
        if( $this->sortT == 'P' ){ return; }

        $parentID = ( isset( $_POST['post_parent'] ) ? esc_attr( $_POST['post_parent'] ) : 0 );
        if($parentID == 0){ return; }

        abcfsl_dba_update_menu_order( $parentID, $this->sortT );
    }

    private function user_can_save( $postID, $nonceAction, $nonceID ) {

        $is_autosave = wp_is_post_autosave( $postID );
        $is_revision = wp_is_post_revision( $postID );
        $is_valid_nonce = ( isset( $_POST[ $nonceAction ] ) && wp_verify_nonce( $_POST[ $nonceAction ], $nonceID ) );

        return ! ( $is_autosave || $is_revision ) && $is_valid_nonce;
    }
}