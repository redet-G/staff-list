<?php
if ( ! defined( 'ABSPATH' ) ) {exit;}
class ABCFSL_MBox_List {

    public function __construct() {
        add_action( 'add_meta_boxes_cpt_staff_lst', array( $this, 'add_meta_box' ) );
        add_action( 'save_post_cpt_staff_lst', array( $this, 'save_post' ) );
    }

    public function add_meta_box() {
        add_meta_box(
            'abcfsl_mbox_staff_lst',
            abcfsl_txta(19),
            array( $this, 'display_mbox_optns' ),
            'cpt_staff_lst',
            'normal',
            'high'
        );
        add_meta_box(
            'abcfsl_mbox_staff_lst_F1',
            abcfsl_txta(217),
            array( $this, 'display_mbox_fields' ),
            'cpt_staff_lst',
            'normal',
            'default'
        );
    }

    //public function display_mbox_lst_optns() { abcfsl_mbox_tplate_tabs(); }

    public function display_mbox_optns() {
        abcfsl_mbox_tplate_optns();
    }

    public function display_mbox_fields() {
        abcfsl_mbox_tplate_fields();
    }

    public function save_post( $postID ) {

        $obj = ABCFSL_Main();
        $slug = $obj->pluginSlug;

        //Exit if user doesn't have permission to save
        if (!$this->user_can_save( $postID, $slug . '_nonce', $slug ) ) {
            return;
        }  

    //echo"<pre>", print_r( $_POST, true ), "</pre>"; die; 
    //error_log( print_r( $sortTypeOld . ' --- ' . $sortTypeNew, true) ); 

        //Save data.---------------------------------------------
        //New record.
        $lstLayoutH = ( isset( $_POST['lstLayoutH']) ? esc_attr( $_POST['lstLayoutH'] ) : '0' );
        $lstLayout = ( isset( $_POST['lstLayout' ]) ? esc_attr( $_POST['lstLayout' ] ) : $lstLayoutH ); 
        $sortTypeDefault = isset( $_POST['sortType'] ) ? $_POST['sortType'] : '';      

        if ($lstLayout == '0' ){ return; }
        if ($lstLayoutH == '0'){
            abcfl_mbsave_save_cbo( $postID, 'lstLayout', '_lstLayout', '0');
            abcfl_mbsave_save_field( $postID, '_lstLayoutH', $lstLayout);
            if( empty( $sortTypeDefault ) ) { abcfl_mbsave_save_txt_value( $postID, '_sortType', 'P', '' );  }
            return;
        }

        abcfl_mbsave_save_chekbox($postID, 'showAllStaff', '_showAllStaff');

        abcfl_mbsave_save_cbo( $postID, 'lstCols', '_lstCols', '6');
        abcfl_mbsave_save_cbo( $postID, 'gridColsXX', '_gridColsXX', '2');
        abcfl_mbsave_save_cbo( $postID, 'gridCols', '_gridCols', '2');
        abcfl_mbsave_save_cbo( $postID, 'gridColsLG', '_gridColsLG', '1');
        abcfl_mbsave_save_cbo( $postID, 'gridColsMD', '_gridColsMD', '1');
        abcfl_mbsave_save_cbo( $postID, 'gridColsSM', '_gridColsSM', '1');    

        //Legacy grid margins and padding. Delete data on save. Data is copied to custom CSS when form opens and saved as CSS.
        //abcfl_mbsave_save_txt( $postID, 'itemMarginL', '_itemMarginL');
        //abcfl_mbsave_save_txt( $postID, 'itemMarginB', '_itemMarginB');

        //New version of grid margins and padding
        abcfl_mbsave_save_cbo( $postID, 'itemPadLR', '_itemPadLR' , 'Pc1');
        abcfl_mbsave_save_cbo( $postID, 'itemMarginBN', '_itemMarginBN' , '40');
        abcfl_mbsave_save_cbo( $postID, 'itemMarginB', '_itemMarginB' , '');

        abcfl_mbsave_save_cbo( $postID, 'lstVAid', '_vAid', '');

        abcfl_mbsave_save_txt($postID, 'lstItemCls', '_lstItemCls');
        abcfl_mbsave_save_txt($postID, 'lstItemStyle', '_lstItemStyle');
        abcfl_mbsave_save_txt($postID, 'innerCntrCls', '_innerCntrCls');
        abcfl_mbsave_save_txt($postID, 'innerCntrStyle', '_innerCntrStyle');

        //abcfl_mbsave_save_txt($postID, 'gridItemCls', '_gridItemCls');
        //abcfl_mbsave_save_txt($postID, 'gridItemStyle', '_gridItemStyle');

        // -- Image ------------------------
        $this->save_img( $postID );
        $this->save_pholder_imgs( $_POST, $postID );
        $this->save_social( $postID );
        $this->save_pagination( $postID );

        //---------------------------------
        abcfl_mbsave_save_txt($postID, 'lstTxtCntrCls', '_lstTxtCntrCls');
        abcfl_mbsave_save_txt($postID, 'lstTxtCntrStyle', '_lstTxtCntrStyle');
        abcfl_mbsave_save_cbo( $postID, 'addMaxW', '_addMaxW', 'N');

        abcfl_mbsave_save_txt($postID, 'lstCntrW', '_lstCntrW');
        abcfl_mbsave_save_cbo( $postID, 'lstACenter', '_lstACenter', 'Y');
        abcfl_mbsave_save_txt($postID, 'lstCntrTM', '_lstCntrTM');
        abcfl_mbsave_save_txt($postID, 'lstCntrCls', '_lstCntrCls');
        abcfl_mbsave_save_txt($postID, 'lstCntrStyle', '_lstCntrStyle');

        abcfl_mbsave_save_txt($postID, 'sPageUrl', '_sPageUrl');

        // -- UB START ------------------------
        abcfl_mbsave_save_txt( $postID, 'headerTxt', '_headerTxt');
        abcfl_mbsave_save_cbo( $postID, 'headerTag', '_headerTag' , 'div');
        abcfl_mbsave_save_cbo( $postID, 'headerFont', '_headerFont' , '');
        abcfl_mbsave_save_cbo( $postID, 'headerMarginT', '_headerMarginT' , '');
        abcfl_mbsave_save_txt( $postID, 'headerCls', '_headerCls');

        abcfl_mbsave_save_cbo( $postID, 'noDataMsgTag', '_noDataMsgTag' , 'div');
        abcfl_mbsave_save_cbo( $postID, 'noDataMsgFont', '_noDataMsgFont' , '');
        abcfl_mbsave_save_cbo( $postID, 'noDataMsgMarginT', '_noDataMsgMarginT' , '');
        abcfl_mbsave_save_txt( $postID, 'noDataMsgCls', '_noDataMsgCls');
        // -- UB END ------------------------

        // -- Single Page text Link ------------------------
        abcfl_mbsave_save_cbo( $postID,'sPgLnkShow', '_sPgLnkShow', 'N');
        abcfl_mbsave_save_txt($postID, 'sPageUrl', '_sPageUrl');
        abcfl_mbsave_save_txt($postID, 'sPgLnkTxt', '_sPgLnkTxt');
        abcfl_mbsave_save_chekbox($postID, 'sPgLnkNT', '_sPgLnkNT');
        abcfl_mbsave_save_cbo( $postID, 'sPgLnkTag', '_sPgLnkTag', 'div');
        abcfl_mbsave_save_cbo( $postID, 'sPgLnkFont', '_sPgLnkFont', 'D');
        abcfl_mbsave_save_cbo( $postID, 'sPgLnkMarginT', '_sPgLnkMarginT', 'N');
        abcfl_mbsave_save_txt($postID, 'sPgLnkCls', '_sPgLnkCls');
        abcfl_mbsave_save_txt($postID, 'sPgLnkStyle', '_sPgLnkStyle');

        abcfl_mbsave_save_chekbox($postID, 'sPgDefaultImgUrl', '_sPgDefaultImgUrl'); 
        abcfl_mbsave_save_chekbox($postID, 'imgLnkLDefault', '_imgLnkLDefault');
        abcfl_mbsave_save_chekbox($postID, 'headerHide', '_headerHide');

        //--MENU ------------------------------------------------
        //Deprecated. Keep until 2020.
        abcfl_mbsave_save_cbo( $postID,'tplateMenuID', '_tplateMenuID', '0');
        //Staff Page Layout tab.
        abcfl_mbsave_save_txt($postID, 'noDataMsg', '_noDataMsg');

        //-- Social -------------------
        $showSocial = isset( $_POST['showSocial'] ) ?  $_POST['showSocial'] : 'N';
        $showSocialOn = isset( $_POST['showSocialOn'] ) ? $_POST['showSocialOn'] : 'Y';
        abcfsl_autil_s_field_to_field_order( $postID, $showSocial, $showSocialOn, 'SL' );
        abcfl_mbsave_save_chekbox($postID, 'socialNT', '_socialNT');


        //----------------------------- ????????????????????
        $showPgLnk = isset( $_POST['sPgLnkShow'] ) ? $_POST['sPgLnkShow'] : 'N';
        abcfsl_autil_s_field_to_field_order( $postID, $showPgLnk, 'L', 'SPTL' );

        // -- Single Layout ------------------------
        abcfl_mbsave_save_cbo( $postID, 'spgCols', '_spgCols', '1');
        abcfl_mbsave_save_cbo( $postID, 'spgMMarginT', '_spgMMarginT', '');

        abcfl_mbsave_save_cbo( $postID, 'spgVAid', '_spgVAid', 'N');
        abcfl_mbsave_save_txt($postID, 'spgCntrW', '_spgCntrW');
        abcfl_mbsave_save_cbo( $postID, 'spgACenter', '_spgACenter', 'Y');
        abcfl_mbsave_save_txt($postID, 'spgCntrCls', '_spgCntrCls');

        abcfl_mbsave_save_txt($postID, 'spgCClsT', '_spgCClsT');
        abcfl_mbsave_save_txt($postID, 'spgCClsM', '_spgCClsM');
        abcfl_mbsave_save_txt($postID, 'spgCClsB', '_spgCClsB');
        abcfl_mbsave_save_txt($postID, 'spgMICls', '_spgMICls');
        abcfl_mbsave_save_txt($postID, 'spgMIStyle', '_spgMIStyle');
        abcfl_mbsave_save_txt($postID, 'spgMTCls', '_spgMTCls');
        abcfl_mbsave_save_txt($postID, 'spgMTStyle', '_spgMTStyle');

        //-- Structured Data Type -------------------------
        abcfl_mbsave_save_txt($postID, 'sdType', '_sdType');
        abcfl_mbsave_save_txt($postID, 'sdEmbededProperty', '_sdEmbededProperty');
        abcfl_mbsave_save_txt($postID, 'sdEmbed1Type', '_sdEmbed1Type');
        abcfl_mbsave_save_txt($postID, 'sdEmbed1Value', '_sdEmbed1Value');
        abcfl_mbsave_save_txt($postID, 'sdEmbed2Type', '_sdEmbed2Type');
        abcfl_mbsave_save_txt($postID, 'sdEmbed2Value', '_sdEmbed2Value');

        abcfl_mbsave_save_txt($postID, 'sdPropertySPTL', '_sdPropertySPTL');

        // ISOTOPE OK
        //abcfl_mbsave_save_cbo( $postID,'imgsLoaded', '_imgsLoaded', 0);
        //$this->save_excluded_slugs_isotope( $postID );

        //------------------------------------------------------------
        $this->save_sort_mp_order( $postID );
        $this->update_menu_order( $postID );
        //---------------------------------------------------

        //FIELDS_50
        //for ( $i = 1; $i <= 40; $i++ ) { $this->save_input_field( $postID, 'F' . $i ); }
        for ( $i = 1; $i <= 50; $i++ ) { $this->save_input_field( $postID, 'F' . $i ); }
    }

    //Update staff order if records sorted by Sort Text.
    private function update_menu_order( $tplateID ) {

        $sortTypeOld = get_post_meta( $tplateID, '_sortType', true );

        //Manual or Sort Text Field.
        $sortTypeNew = ( isset( $_POST['sortType'] ) ? esc_attr( $_POST['sortType'] ) : 'P' );
        
        abcfl_mbsave_save_cbo($tplateID, 'sortType', '_sortType', '');
        abcfl_mbsave_save_cbo($tplateID, 'sortTxtInputType', '_sortTxtInputType', 'T');
        abcfl_mbsave_save_cbo($tplateID, 'sortFieldF', '_sortFieldF', '');    

        if( $sortTypeOld != $sortTypeNew ) { 
            abcfsl_dba_update_menu_order( $tplateID, $sortTypeNew ); 
        }
    }

    //Multipart field. SortText input helper.
    private function save_sort_mp_order( $postID ) {

        $value = isset( $_POST['sortMPOrder'] ) ? esc_attr( $_POST['sortMPOrder'] ) : '';

        if( empty( $value ) ) {
            abcfl_mbsave_save_txt( $postID, 'sortMPOrder', '_sortMPOrder' );
            return;
        }

        //Remove white spaces
        $value = rtrim( $value, ',' );
        $value = preg_replace('/\s+/', '', $value);
        $value = strtoupper($value);
        $fixedValue = preg_replace('[^0-9\,]', '', $value);

        if( empty( $fixedValue ) ) {
            abcfl_mbsave_save_txt( $postID, 'sortMPOrder', '_sortMPOrder' );
            return;
        }

        abcfl_mbsave_save_txt_value( $postID, '_sortMPOrder', $fixedValue,  '');
     }

    //STXT Static text - Linked Fields.
    private function save_static_txt_fs( $postID, $F ) {

        $value = isset( $_POST['statTxtFs_' . $F] ) ? esc_attr( $_POST['statTxtFs_' . $F] ) : '';

        if( empty( $value ) ) {
            abcfl_mbsave_save_txt($postID, 'statTxtFs_' . $F, '_statTxtFs_' . $F);
            return;
        }

        //Remove white spaces
        //$value = str_replace(' ', '', $value);
        $value = rtrim( $value, ',' );
        $value = preg_replace('/\s+/', '', $value);
        $value = strtoupper($value);

        //^[F0-9,]*$
        $fixedValue = preg_replace('/[^F0-9,]/', '', $value);

        if( empty( $fixedValue ) ) {
            abcfl_mbsave_save_txt($postID, 'statTxtFs_' . $F, '_statTxtFs_' . $F);
            return;
        }

        abcfl_mbsave_save_field( $postID, '_statTxtFs_' . $F, $fixedValue);
    }

    private function save_excluded_slugs( $postID, $F ) {

        $value = isset( $_POST['excludedSlugs_' . $F] ) ? esc_attr( $_POST['excludedSlugs_' . $F] ) : '';

        if( empty( $value ) ) {
            abcfl_mbsave_save_txt( $postID, '_excludedSlugs_' . $F, '_excludedSlugs_' . $F );
            return;
        }

        //Remove white spaces
        $value = rtrim( $value, ',' );
        $value = preg_replace('/\s+/', '', $value);
        $value = strtolower($value);

        $fixedValue = mb_strtolower( $value, 'UTF-8' );
        //$fixedValue = sanitize_title( $value );

        if( empty( $fixedValue ) ) {
            abcfl_mbsave_save_txt($postID, 'excludedSlugs_' . $F, 'excludedSlugs_' . $F);
            return;
        }
        abcfl_mbsave_save_field( $postID, '_excludedSlugs_' . $F, $fixedValue);
    }

    // private function save_excluded_slugs_isotope( $postID ) {

    //     $value = ( isset( $_POST['excludedSlugsIsotope']) ? esc_attr( $_POST['excludedSlugsIsotope'] ) : '' );

    //     if( empty( $value ) ) {
    //         abcfl_mbsave_save_txt( $postID, 'excludedSlugsIsotope', '_excludedSlugsIsotope' );
    //         return;
    //     }

    //     //Remove white spaces
    //     $value = rtrim( $value, ',' );
    //     $value = preg_replace('/\s+/', '', $value);
    //     $value = strtolower($value);

    //     $fixedValue = mb_strtolower( $value, 'UTF-8' );
    //     //$fixedValue = sanitize_title( $value );

    //     if( empty( $fixedValue ) ) {
    //         abcfl_mbsave_save_txt( $postID, 'excludedSlugsIsotope', '_excludedSlugsIsotope' );
    //         return;
    //     }
    //     abcfl_mbsave_save_field( $postID, '_excludedSlugsIsotope', $fixedValue);
    // }

    private function save_img( $postID ) {

        abcfl_mbsave_save_cbo( $postID, 'imgCntrMLR', '_imgCntrMLR', '');
        abcfl_mbsave_save_cbo( $postID, 'imgBorder', '_imgBorder', 'D');        
        abcfl_mbsave_save_cbo( $postID, 'imgCircle', '_imgCircle', '');
        abcfl_mbsave_save_txt( $postID, 'imgAttr', '_imgAttr', '');
        abcfl_mbsave_save_cbo( $postID, 'imgHover', '_imgHover', '');
        abcfl_mbsave_save_cbo( $postID, 'imgDS', '_imgDS', '');
        abcfl_mbsave_save_txt($postID, 'overTxtT1', '_overTxtT1');
        abcfl_mbsave_save_txt($postID, 'overTxtT2', '_overTxtT2');
        abcfl_mbsave_save_cbo( $postID, 'overFont1', '_overFont1', 'D');
        abcfl_mbsave_save_cbo( $postID, 'overFont2', '_overFont2', 'D');
        abcfl_mbsave_save_cbo( $postID, 'overTM', '_overTM', 'N');

        abcfl_mbsave_save_txt($postID, 'lstImgCls', '_lstImgCls');
        abcfl_mbsave_save_txt($postID, 'lstImgStyle', '_lstImgStyle');

        abcfl_mbsave_save_chekbox($postID, 'pImgDefault', '_pImgDefault');
//        abcfl_mbsave_save_txt($postID, 'pImgIDL', '_pImgIDL');
//        abcfl_mbsave_save_txt($postID, 'pImgIDS', '_pImgUrlS');
//        abcfl_mbsave_save_txt($postID, 'pImgUrlL', '_pImgUrlL');
//        abcfl_mbsave_save_txt($postID, 'pImgUrlS', '_pImgUrlS');
    }

    private function save_pholder_imgs( $post, $postID ) {

        $imgUrlL = ( isset( $post['pImgUrlL']) ? esc_attr( $post['pImgUrlL' ] ) : '' );
        $imgUrlS = ( isset( $post['pImgUrlS']) ? esc_attr( $post['pImgUrlS' ] ) : '' );

        $imgIDL = 0;
        if( empty( $imgUrlL  )){
            abcfl_mbsave_save_txt_value( $postID, '_pImgUrlL', '',  '');
            abcfl_mbsave_save_txt_value( $postID, '_pImgIDL', 0,  '');
        }
        else{
            $imgIDL = abcfsl_mbox_item_img_id_by_url( $imgUrlL );

            abcfl_mbsave_save_txt_value( $postID, '_pImgUrlL', $imgUrlL,  '');
            abcfl_mbsave_save_txt_value( $postID, '_pImgIDL', $imgIDL,  '');
        }

        if( empty( $imgUrlS  )){
            abcfl_mbsave_save_txt_value( $postID, '_pImgUrlS', '',  '');
            abcfl_mbsave_save_txt_value( $postID, '_pImgIDS', 0,  '');
            return;
        }
        else{
            $imgIDS = abcfsl_mbox_item_img_id_by_url( $imgUrlS );

            abcfl_mbsave_save_txt_value( $postID, '_pImgUrlS', $imgUrlS,  '');
            abcfl_mbsave_save_txt_value( $postID, '_pImgIDS', $imgIDS,  '');
        }
    }

    private function save_social( $postID ) {

        abcfl_mbsave_save_cbo( $postID,'showSocial', '_showSocial', 'N');
        abcfl_mbsave_save_cbo( $postID,'showSocialOn', '_showSocialOn', 'Y');
        abcfl_mbsave_save_cbo( $postID,'socialSource', '_socialSource', '32-70');
        abcfl_mbsave_save_txt( $postID,'socialCntrLbl', '_socialCntrLbl');
        abcfl_mbsave_save_txt( $postID,'socialCntrHlp', '_socialCntrHlp');
        abcfl_mbsave_save_txt( $postID,'socialCntrCls', '_socialCntrCls');
        abcfl_mbsave_save_txt( $postID,'socialCntrStyle', '_socialCntrStyle');
        abcfl_mbsave_save_cbo( $postID,'socialTM', '_socialTM', 'N');

        abcfl_mbsave_save_txt( $postID,'social1', '_social1');
        abcfl_mbsave_save_txt( $postID,'social2', '_social2');
        abcfl_mbsave_save_txt( $postID,'social3', '_social3');
        abcfl_mbsave_save_txt( $postID,'social4', '_social4');
        abcfl_mbsave_save_txt( $postID,'social5', '_social5');
        abcfl_mbsave_save_txt( $postID,'social6', '_social6');

        abcfl_mbsave_save_txt( $postID,'social1Alt', '_social1Alt');
        abcfl_mbsave_save_txt( $postID,'social2Alt', '_social2Alt');
        abcfl_mbsave_save_txt( $postID,'social3Alt', '_social3Alt');
        abcfl_mbsave_save_txt( $postID,'social4Alt', '_social4Alt');
        abcfl_mbsave_save_txt( $postID,'social5Alt', '_social5Alt');
        abcfl_mbsave_save_txt( $postID,'social6Alt', '_social6Alt');
    }

    private function save_pagination( $postID ) {

        abcfl_mbsave_save_int( $postID, 'pgnationPgQty', '_pgnationPgQty');
        abcfl_mbsave_save_int( $postID, 'pgnationPgsToShow', '_pgnationPgsToShow');
        abcfl_mbsave_save_cbo( $postID, 'pgnationSize', '_pgnationSize', 'MD');
        abcfl_mbsave_save_cbo( $postID, 'pgnationJustify', '_pgnationJustify', 'E');
        abcfl_mbsave_save_cbo( $postID, 'pgnationTB', '_pgnationTB', 'B');
        abcfl_mbsave_save_cbo( $postID, 'pgnationColor', '_pgnationColor', 'G');

        abcfl_mbsave_save_cbo( $postID, 'pgnationTTM', '_pgnationTTM', '');
        abcfl_mbsave_save_cbo( $postID, 'pgnationTBM', '_pgnationTBM', '');
        abcfl_mbsave_save_cbo( $postID, 'pgnationBTM', '_pgnationBTM', '');
        abcfl_mbsave_save_cbo( $postID, 'pgnationBBM', '_pgnationBBM', '');

        abcfl_mbsave_save_txt($postID, 'pgnationCls', '_pgnationCls');
        abcfl_mbsave_save_txt($postID, 'pgnationStyle', '_pgnationStyle');
    }

    private function save_input_field( $postID, $F ) {

        //New field type not selected.
        $fieldTypeH = ( isset( $_POST['fieldTypeH_' . $F ]) ? esc_attr( $_POST['fieldTypeH_' . $F ] ) : 'N' );
        $fieldType = ( isset( $_POST['fieldType_' . $F ]) ? esc_attr( $_POST['fieldType_' . $F ] ) : $fieldTypeH );

        if ( $fieldType == 'N' ){ return 0; }

        //Add new field. Hidden field type not set. Field type is selected.
        if ($fieldTypeH == 'N'){
            //Add new field.
            abcfl_mbsave_save_cbo( $postID, 'fieldType_' . $F, '_fieldType_' . $F, 'N');
            abcfl_mbsave_save_field( $postID, '_fieldTypeH_' . $F, $fieldType);
            abcfsl_autil_f_field_to_field_order( $postID, 'N', 'L', $F );
            return 0;
        }

        // -- Delete field ------------------------------------
        $hideDelete = ( isset( $_POST['hideDelete_' . $F ]) ? esc_attr( $_POST['hideDelete_' . $F ] ) : 'N' );
        if($hideDelete == 'D'){
            $this->delete_tplate_field( $postID, $F );
            return 0;
        }

        //-----------------------------------------------------
        //Add a new field to the sort fields array.
        //$showField = ( isset( $_POST['showField_' . $F ]) ? esc_attr( $_POST['showField_' . $F ] ) : 'L' );
        //abcfsl_autil_f_field_to_field_order( $postID, $hideDelete, $showField, $F );
        //---------------------------------------------------

        // -- Checkbox Locked --------------------------------
        abcfl_mbsave_save_chekbox( $postID, 'fieldLocked_' . $F, '_fieldLocked_' . $F );
        if ( isset( $_POST['fieldLocked_' . $F ] ) ){
            return;
        }

        //-----------------------------------------------------
        //Add a new field to the sort fields array.
        $showField = ( isset( $_POST['showField_' . $F ]) ? esc_attr( $_POST['showField_' . $F ] ) : 'L' );
        abcfsl_autil_f_field_to_field_order( $postID, $hideDelete, $showField, $F );
        //---------------------------------------------------

        //---------------------------------------------------
        //Data input and display on page type options . Staff or Staff + Single or Single only. 
        abcfl_mbsave_save_cbo( $postID, 'showField_' . $F, '_showField_' . $F, 'L');
        
        
        //Hide = Keep data, don't display field on the front end.
        abcfl_mbsave_save_cbo( $postID, 'hideDelete_' . $F, '_hideDelete_' . $F, 'N');
        abcfl_mbsave_save_cbo( $postID, 'dtFormat_' . $F, '_dtFormat_' . $F, '');

        //abcfl_mbsave_save_chekbox($postID, 'lineLocked_' . $F, '_fieldLocked_' . $F);
        //abcfl_mbsave_save_chekbox($postID, 'fieldLocked_' . $F, '_fieldLocked_' . $F);
        abcfl_mbsave_save_chekbox($postID, 'noAutop_' . $F, '_noAutop_' . $F);


        abcfl_mbsave_save_cbo( $postID,'fieldCntrSPg_' . $F, '_fieldCntrSPg_' . $F, 'M');
        //-----------------------------------------------------
        abcfl_mbsave_save_cbo( $postID,'tagType_' . $F, '_tagType_' . $F, 'div');
        abcfl_mbsave_save_cbo( $postID,'tagFont_' . $F, '_tagFont_' . $F, 'D');
        abcfl_mbsave_save_cbo( $postID,'tagMarginT_' . $F, '_tagMarginT_' . $F, 'D');
        abcfl_mbsave_save_cbo( $postID,'captionMarginT_' . $F, '_captionMarginT_' . $F, 'D');

        abcfl_mbsave_save_cbo( $postID,'tagTypeSPg_' . $F, '_tagTypeSPg_' . $F, '');
        abcfl_mbsave_save_cbo( $postID,'tagFontSPg_' . $F, '_tagFontSPg_' . $F, '');
        abcfl_mbsave_save_cbo( $postID,'tagMarginTSPg_' . $F, '_tagMarginTSPg_' . $F, '');
        abcfl_mbsave_save_cbo( $postID,'captionMarginTSPg_' . $F, '_captionMarginTSPg_' . $F, '');

        //Static label above
        abcfl_mbsave_save_cbo( $postID,'lblTag_' . $F, '_lblTag_' . $F, 'div');
        abcfl_mbsave_save_cbo( $postID,'lblFont_' . $F, '_lblFont_' . $F, '');
        abcfl_mbsave_save_cbo( $postID,'lblMarginT_' . $F, '_lblMarginT_' . $F, '');
        abcfl_mbsave_save_cbo( $postID,'lblTagSPg_' . $F, '_lblTagSPg_' . $F, '');
        abcfl_mbsave_save_cbo( $postID,'lblFontSPg_' . $F, '_lblFontSPg_' . $F, '');
        abcfl_mbsave_save_cbo( $postID,'lblMarginTSPg_' . $F, '_lblMarginTSPg_' . $F, '');

        abcfl_mbsave_save_cbo( $postID,'txtTag_' . $F, '_txtTag_' . $F, 'div');
        abcfl_mbsave_save_cbo( $postID,'txtFont_' . $F, '_txtFont_' . $F, '');
        abcfl_mbsave_save_cbo( $postID,'txtMarginT_' . $F, '_txtMarginT_' . $F, '');
        abcfl_mbsave_save_cbo( $postID,'txtTagSPg_' . $F, '_txtTagSPg_' . $F, '');
        abcfl_mbsave_save_cbo( $postID,'txtFontSPg_' . $F, '_txtFontSPg_' . $F, '');
        abcfl_mbsave_save_cbo( $postID,'txtMarginTSPg_' . $F, '_txtMarginTSPg_' . $F, '');
        
        abcfl_mbsave_save_txt($postID, 'tagCls_' . $F, '_tagCls_' . $F);
        abcfl_mbsave_save_txt($postID, 'tagStyle_' . $F, '_tagStyle_' . $F);

        //--- STXT --------------------------------------------
        abcfl_mbsave_save_txt_html($postID, 'statTxt_' . $F, '_statTxt_' . $F);
        $this->save_static_txt_fs( $postID, $F );

        //-- Staff Categories ------------------------------
        $this->save_excluded_slugs( $postID, $F );

        //-----------------------------------------------------
        // Static label.
        abcfl_mbsave_save_txt($postID, 'lblTxt_' . $F, '_lblTxt_' . $F);
        abcfl_mbsave_save_txt($postID, 'lblTag_' . $F, '_lblTag_' . $F);
        abcfl_mbsave_save_txt($postID, 'lblCls_' . $F, '_lblCls_' . $F);
        abcfl_mbsave_save_txt($postID, 'lblStyle_' . $F, '_lblStyle_' . $F);
        //-----------------------------------------------------
        abcfl_mbsave_save_txt($postID, 'txtCls_' . $F, '_txtCls_' . $F);
        abcfl_mbsave_save_txt($postID, 'txtStyle_' . $F, '_txtStyle_' . $F);
        //-----------------------------------------------------
        abcfl_mbsave_save_txt($postID, 'lnkCls_' . $F, '_lnkCls_' . $F);
        abcfl_mbsave_save_txt($postID, 'lnkStyle_' . $F, '_lnkStyle_' . $F);

        //-- MP ---------------------------------------------------
        abcfl_mbsave_save_cbo( $postID,'orderLP1_' . $F, '_orderLP1_' . $F, '0');
        abcfl_mbsave_save_txt($postID, 'pfixLP1_' . $F, '_pfixLP1_' . $F);
        abcfl_mbsave_save_txt($postID, 'sfixLP1_' . $F, '_sfixLP1_' . $F);
        abcfl_mbsave_save_cbo( $postID,'orderSP1_' . $F, '_orderSP1_' . $F, '0');
        abcfl_mbsave_save_txt($postID, 'pfixSP1_' . $F, '_pfixSP1_' . $F);
        abcfl_mbsave_save_txt($postID, 'sfixSP1_' . $F, '_sfixSP1_' . $F);

        abcfl_mbsave_save_cbo( $postID,'orderLP2_' . $F, '_orderLP2_' . $F, '0');
        abcfl_mbsave_save_txt($postID, 'pfixLP2_' . $F, '_pfixLP2_' . $F);
        abcfl_mbsave_save_txt($postID, 'sfixLP2_' . $F, '_sfixLP2_' . $F);
        abcfl_mbsave_save_cbo( $postID,'orderSP2_' . $F, '_orderSP2_' . $F, '0');
        abcfl_mbsave_save_txt($postID, 'pfixSP2_' . $F, '_pfixSP2_' . $F);
        abcfl_mbsave_save_txt($postID, 'sfixSP2_' . $F, '_sfixSP2_' . $F);        

        abcfl_mbsave_save_cbo( $postID,'orderLP3_' . $F, '_orderLP3_' . $F, '0');
        abcfl_mbsave_save_txt($postID, 'pfixLP3_' . $F, '_pfixLP3_' . $F);
        abcfl_mbsave_save_txt($postID, 'sfixLP3_' . $F, '_sfixLP3_' . $F);
        abcfl_mbsave_save_cbo( $postID,'orderSP3_' . $F, '_orderSP3_' . $F, '0');
        abcfl_mbsave_save_txt($postID, 'pfixSP3_' . $F, '_pfixSP3_' . $F);
        abcfl_mbsave_save_txt($postID, 'sfixSP3_' . $F, '_sfixSP3_' . $F);

        abcfl_mbsave_save_cbo( $postID,'orderLP4_' . $F, '_orderLP4_' . $F, '0');
        abcfl_mbsave_save_txt($postID, 'pfixLP4_' . $F, '_pfixLP4_' . $F);
        abcfl_mbsave_save_txt($postID, 'sfixLP4_' . $F, '_sfixLP4_' . $F);
        abcfl_mbsave_save_cbo( $postID,'orderSP4_' . $F, '_orderSP4_' . $F, '0');
        abcfl_mbsave_save_txt($postID, 'pfixSP4_' . $F, '_pfixSP4_' . $F);
        abcfl_mbsave_save_txt($postID, 'sfixSP4_' . $F, '_sfixSP4_' . $F);

        abcfl_mbsave_save_cbo( $postID,'orderLP5_' . $F, '_orderLP5_' . $F, '0');
        abcfl_mbsave_save_txt($postID, 'pfixLP5_' . $F, '_pfixLP5_' . $F);
        abcfl_mbsave_save_txt($postID, 'sfixLP5_' . $F, '_sfixLP5_' . $F);
        abcfl_mbsave_save_cbo( $postID,'orderSP5_' . $F, '_orderSP5_' . $F, '0');
        abcfl_mbsave_save_txt($postID, 'pfixSP5_' . $F, '_pfixSP5_' . $F);
        abcfl_mbsave_save_txt($postID, 'sfixSP5_' . $F, '_sfixSP5_' . $F);
        abcfl_mbsave_save_chekbox( $postID, 'sPgLnkMP_' . $F, '_sPgLnkMP_' . $F);

        //-- Input field labels -------------------------------
        abcfl_mbsave_save_txt($postID, 'inputLbl_' . $F, '_inputLbl_' . $F);
        abcfl_mbsave_save_txt($postID, 'inputHlp_' . $F, '_inputHlp_' . $F);

        abcfl_mbsave_save_txt($postID, 'inputLblAdr1_' . $F, '_inputLblAdr1_' . $F);
        abcfl_mbsave_save_txt($postID, 'inputLblAdr2_' . $F, '_inputLblAdr2_' . $F);
        abcfl_mbsave_save_txt($postID, 'inputLblAdr3_' . $F, '_inputLblAdr3_' . $F);
        abcfl_mbsave_save_txt($postID, 'inputLblAdr4_' . $F, '_inputLblAdr4_' . $F);
        abcfl_mbsave_save_txt($postID, 'inputLblAdr5_' . $F, '_inputLblAdr5_' . $F);
        abcfl_mbsave_save_txt($postID, 'inputLblAdr6_' . $F, '_inputLblAdr6_' . $F);

        abcfl_mbsave_save_txt($postID, 'inputLblP1_' . $F, '_inputLblP1_' . $F);
        abcfl_mbsave_save_txt($postID, 'inputLblP2_' . $F, '_inputLblP2_' . $F);
        abcfl_mbsave_save_txt($postID, 'inputLblP3_' . $F, '_inputLblP3_' . $F);
        abcfl_mbsave_save_txt($postID, 'inputLblP4_' . $F, '_inputLblP4_' . $F);
        abcfl_mbsave_save_txt($postID, 'inputLblP5_' . $F, '_inputLblP5_' . $F);

        abcfl_mbsave_save_txt($postID, 'lnkLblLbl_' . $F, '_lnkLblLbl_' . $F);
        abcfl_mbsave_save_txt($postID, 'lnkLblHlp_' . $F, '_lnkLblHlp_' . $F);
        abcfl_mbsave_save_txt($postID, 'lnkUrlLbl_' . $F, '_lnkUrlLbl_' . $F);
        abcfl_mbsave_save_txt($postID, 'lnkUrlHlp_' . $F, '_lnkUrlHlp_' . $F);

        abcfl_mbsave_save_txt($postID, 'imgUrlLbl_' . $F, '_imgUrlLbl_' . $F);
        abcfl_mbsave_save_txt($postID, 'imgUrlHlp_' . $F, '_imgUrlHlp_' . $F); 

        abcfl_mbsave_save_txt($postID, 'imgAltLbl_' . $F, '_imgAltLbl_' . $F);
        abcfl_mbsave_save_txt($postID, 'imgAltHlp_' . $F, '_imgAltHlp_' . $F);
        abcfl_mbsave_save_txt($postID, 'imgLnkLbl_' . $F, '_imgLnkLbl_' . $F);
        abcfl_mbsave_save_txt($postID, 'imgLnkHlp_' . $F, '_imgLnkHlp_' . $F);
        abcfl_mbsave_save_txt($postID, 'imgLnkAttrLbl_' . $F, '_imgLnkAttrLbl_' . $F);
        abcfl_mbsave_save_txt($postID, 'imgLnkAttrHlp_' . $F, '_imgLnkAttrHlp_' . $F);
        abcfl_mbsave_save_txt($postID, 'imgLnkClickLbl_' . $F, '_imgLnkClickLbl_' . $F);
        abcfl_mbsave_save_txt($postID, 'imgLnkClickHlp_' . $F, '_imgLnkClickHlp_' . $F); 
        //-- DATE --------------------------
        //abcfl_mbsave_save_txt($postID, 'dteDisplayLbl_' . $F, '_dteDisplayLbl_' . $F); not implemented
        abcfl_mbsave_save_txt($postID, 'dteDisplayHlp_' . $F, '_dteDisplayHlp_' . $F); 
        //-- ICONS -------------------------
        abcfl_mbsave_save_txt($postID, 'iconOnCls_' . $F, '_iconOnCls_' . $F);
        abcfl_mbsave_save_txt($postID, 'iconOffCls_' . $F, '_iconOffCls_' . $F);
        abcfl_mbsave_save_txt($postID, 'iconOnStyle_' . $F, '_iconOnStyle_' . $F);
        abcfl_mbsave_save_txt($postID, 'iconOffStyle_' . $F, '_iconOffStyle_' . $F);
        abcfl_mbsave_save_cbo( $postID,'iconMaxQty_' . $F, '_iconMaxQty_' . $F, '');
        //-- ICON LINKS -------------------------
        abcfl_mbsave_save_cbo( $postID,'iconML_' . $F, '_iconML_' . $F, '');
        abcfl_mbsave_save_cbo( $postID,'iconType_' . $F, '_iconType_' . $F, '');
        abcfl_mbsave_save_chekbox( $postID, 'lnkNT_' . $F, '_lnkNT_' . $F );
        abcfl_mbsave_save_chekbox( $postID, 'lnkDload_' . $F, '_lnkDload_' . $F );

        abcfl_mbsave_save_txt($postID, 'icon1Name_' . $F, '_icon1Name_' . $F);
        abcfl_mbsave_save_txt($postID, 'icon1Cls_' . $F, '_icon1Cls_' . $F);
        abcfl_mbsave_save_txt($postID, 'icon1Style_' . $F, '_icon1Style_' . $F);

        abcfl_mbsave_save_txt($postID, 'icon2Name_' . $F, '_icon2Name_' . $F);
        abcfl_mbsave_save_txt($postID, 'icon2Cls_' . $F, '_icon2Cls_' . $F);
        abcfl_mbsave_save_txt($postID, 'icon2Style_' . $F, '_icon2Style_' . $F);

        abcfl_mbsave_save_txt($postID, 'icon3Name_' . $F, '_icon3Name_' . $F);
        abcfl_mbsave_save_txt($postID, 'icon3Cls_' . $F, '_icon3Cls_' . $F);
        abcfl_mbsave_save_txt($postID, 'icon3Style_' . $F, '_icon3Style_' . $F);

        abcfl_mbsave_save_txt($postID, 'icon4Name_' . $F, '_icon4Name_' . $F);
        abcfl_mbsave_save_txt($postID, 'icon4Cls_' . $F, '_icon4Cls_' . $F);
        abcfl_mbsave_save_txt($postID, 'icon4Style_' . $F, '_icon4Style_' . $F);

        abcfl_mbsave_save_txt($postID, 'icon5Name_' . $F, '_icon5Name_' . $F);
        abcfl_mbsave_save_txt($postID, 'icon5Cls_' . $F, '_icon5Cls_' . $F);
        abcfl_mbsave_save_txt($postID, 'icon5Style_' . $F, '_icon5Style_' . $F);

        abcfl_mbsave_save_txt($postID, 'icon6Name_' . $F, '_icon6Name_' . $F);
        abcfl_mbsave_save_txt($postID, 'icon6Cls_' . $F, '_icon6Cls_' . $F);
        abcfl_mbsave_save_txt($postID, 'icon6Style_' . $F, '_icon6Style_' . $F);
        //-- Show email as text ------------------------------
        abcfl_mbsave_save_chekbox($postID, 'showAsTxt_' . $F, '_showAsTxt_' . $F);        
        abcfl_mbsave_save_txt($postID, 'sdProperty_' . $F, '_sdProperty_' . $F);

        abcfl_mbsave_save_cbo( $postID,'cbomQty_' . $F, '_cbomQty_' . $F, '1');
        abcfl_mbsave_save_cbo( $postID,'cbomSort_' . $F, '_cbomSort_' . $F, 'N');
        abcfl_mbsave_save_txt($postID, 'cbomSortLocale_' . $F, '_cbomSortLocale_' . $F);

        //-- vCard---------------------------------------------------------
        abcfl_mbsave_save_cbo( $postID,'vcTplateID_' . $F, '_vcTplateID_' . $F, '0');
        abcfl_mbsave_save_txt($postID, 'statAlt_' . $F, '_statAlt_' . $F);

        abcfl_mbsave_save_txt($postID, 'inputLblDynCap_' . $F, '_inputLblDynCap_' . $F);
        abcfl_mbsave_save_txt($postID, 'inputLblStatAlt_' . $F, '_inputLblStatAlt_' . $F);
        abcfl_mbsave_save_txt($postID, 'inputLblDynAlt_' . $F, '_inputLblDynAlt_' . $F);        

        $this->save_dropdown_item( $postID, $F, $fieldType ) ;
        $this->save_checkbox_items( $postID, $F, $fieldType );
    }

    private function save_dropdown_item( $postID, $F, $fieldType ) {

        $isCBO = false;
        //$isCHECK = false;
        switch ( $fieldType ) {
            case 'CBO':
            case 'LBLCBO':
            case 'CBOM':
                $isCBO = true;
                break;            
            default:
                break;
        }

        if( !$isCBO ) { return; }
        
        //---------------------------------------------
        if( $isCBO ) {
            abcfl_mbsave_save_txt($postID, 'cboFirstValue_' . $F, '_cboFirstValue_' . $F);
            abcfl_mbsave_save_txt($postID, 'cboFirstTxt_' . $F, '_cboFirstTxt_' . $F);
        }

        $metaKey = '_cboValues_' . $F;
        $cboValuesPost = 'cboValues_' . $F;
        //----------------------------------
        $old = get_post_meta( $postID, $metaKey, true );
        if ( empty( $old ) ){ $old = array(); }
        $new = array();
    
        $listItems = $_POST[$cboValuesPost];
        $count = count( $listItems );
    
        for ( $i = 0; $i < $count; $i++ ) {
            if ( $listItems[$i] != '' ) {
                    $new[$i] = esc_attr( preg_replace( '/\s+/', ' ', trim( $listItems[$i] ) ) );  
            }
        }

        $new = array_unique( $new ); 
        if ( $new === $old ){ return; }

        if ( !empty( $new ) ){ 
            update_post_meta( $postID, $metaKey, $new );
            return;
        }
    
        if ( empty( $new ) ){
            delete_post_meta( $postID, $metaKey );
        }      
    }

    private function save_checkbox_items( $postID, $F, $fieldType ) {

        if( $fieldType != 'CHECKG' ) { return; }

        $metaKey = '_cboValues_' . $F;
        $cboValuesPost = 'cboValues_' . $F;
        //----------------------------------
        $old = get_post_meta( $postID, $metaKey, true );
        if ( empty( $old ) ){ $old = array(); }
        $new = array();
    
        $listItems = $_POST[$cboValuesPost];
        $count = count( $listItems );
        if( $count > 12 ) { $count = 12; }
    
        for ( $i = 0; $i < $count; $i++ ) {
            if ( $listItems[$i] != '' ) {
                    $new[$i] = esc_attr( preg_replace( '/\s+/', ' ', trim( $listItems[$i] ) ) );  
            }
        }

        $new = array_unique( $new ); 
        if ( $new === $old ){ return; }

        if ( !empty( $new ) ){ 
            update_post_meta( $postID, $metaKey, $new );
            return;
        }
    
        if ( empty( $new ) ){
            delete_post_meta( $postID, $metaKey );
        }      
    }

    //==================================================
    private function delete_tplate_field( $postID, $F ) {

        delete_post_meta( $postID, '_fieldType_' . $F );
        delete_post_meta( $postID, '_fieldTypeH_' . $F );
        delete_post_meta( $postID, '_showField_' . $F );
        //delete_post_meta( $postID, 'hideDelete_' . $F );
        delete_post_meta( $postID, '_hideDelete_' . $F );
        delete_post_meta( $postID, '_fieldLocked_' . $F );
        delete_post_meta( $postID, '_fieldCntrSPg_' . $F );

        delete_post_meta( $postID, '_showAll_' . $F );
        delete_post_meta( $postID, '_noAutop_' . $F );
        delete_post_meta( $postID, '_tagTypeL_' . $F );
        delete_post_meta( $postID, '_tagType_' . $F );
        delete_post_meta( $postID, '_tagFont_' . $F );
        delete_post_meta( $postID, '_tagMarginT_' . $F );
        delete_post_meta( $postID, '_captionMarginT_' . $F );

        delete_post_meta( $postID, '_tagTypeSPg_' . $F );
        delete_post_meta( $postID, '_tagFontSPg_' . $F );
        delete_post_meta( $postID, '_tagMarginTSPg_' . $F );
        delete_post_meta( $postID, '_captionMarginTSPg_' . $F );

        delete_post_meta( $postID, '_lblType_' . $F );
        delete_post_meta( $postID, '_lblFont_' . $F );
        delete_post_meta( $postID, '_lblMarginT_' . $F );
        delete_post_meta( $postID, '_lblTypeSPg_' . $F );
        delete_post_meta( $postID, '_lblFontSPg_' . $F );
        delete_post_meta( $postID, '_lblMarginTSPg_' . $F );        
        
        delete_post_meta( $postID, '_tagCls_' . $F );
        delete_post_meta( $postID, '_tagStyle_' . $F );
        delete_post_meta( $postID, '_lblTxt_' . $F );
        delete_post_meta( $postID, '_lblTag_' . $F );

        delete_post_meta( $postID, '_lblCls_' . $F );
        delete_post_meta( $postID, '_lblStyle_' . $F );
        delete_post_meta( $postID, '_txtCls_' . $F );
        delete_post_meta( $postID, '_txtStyle_' . $F );

        delete_post_meta( $postID, '_lnkCls_' . $F );
        delete_post_meta( $postID, '_lnkStyle_' . $F );

        delete_post_meta( $postID, '_inputLbl_' . $F );
        delete_post_meta( $postID, '_inputHlp_' . $F );
        delete_post_meta( $postID, '_inputLblAdr1_' . $F );
        delete_post_meta( $postID, '_inputLblAdr2_' . $F );
        delete_post_meta( $postID, '_inputLblAdr3_' . $F );
        delete_post_meta( $postID, '_inputLblAdr4_' . $F );
        delete_post_meta( $postID, '_inputLblAdr5_' . $F );
        delete_post_meta( $postID, '_inputLblAdr6_' . $F );

        delete_post_meta( $postID, '_lnkLblLbl_' . $F );
        delete_post_meta( $postID, '_lnkLblHlp_' . $F );
        delete_post_meta( $postID, '_lnkUrlLbl_' . $F );
        delete_post_meta( $postID, '_lnkUrlHlp_' . $F );
        delete_post_meta( $postID, '_imgUrlLbl_' . $F );
        delete_post_meta( $postID, '_imgUrlHlp_' . $F );
        delete_post_meta( $postID, '_imgAltLbl_' . $F );
        delete_post_meta( $postID, '_imgAltHlp_' . $F );
        delete_post_meta( $postID, '_imgLnkLbl_' . $F );
        delete_post_meta( $postID, '_imgLnkHlp_' . $F );
        delete_post_meta( $postID, '_imgLnkAttrLbl_' . $F );
        delete_post_meta( $postID, '_imgLnkAttrHlp_' . $F );
        delete_post_meta( $postID, '_imgLnkClickLbl_' . $F );
        delete_post_meta( $postID, '_imgLnkClickHlp_' . $F ); 
        //-- DATE -------------------------
        //delete_post_meta( $postID, '_dteDisplayLbl_' . $F );  not implemented
        delete_post_meta( $postID, '_dteDisplayHlp_' . $F );
        //-- ICONS -------------------------
        delete_post_meta( $postID, '_iconOnCls_' . $F );
        delete_post_meta( $postID, '_iconOffCls_' . $F );
        delete_post_meta( $postID, '_iconOnStyle_' . $F );
        delete_post_meta( $postID, '_iconOffStyle_' . $F );   
        delete_post_meta( $postID, '_iconMaxQty_' . $F );
    //-- ICON LINKS -------------------------
        delete_post_meta( $postID, '_iconML_' . $F );
        delete_post_meta( $postID, '_iconType_' . $F );
        delete_post_meta( $postID, '_lnkNT_' . $F );
        delete_post_meta( $postID, '_lnkDload_' . $F );    
             
        delete_post_meta( $postID, '_icon1Name_' . $F );
        delete_post_meta( $postID, '_icon1Cls_' . $F );
        delete_post_meta( $postID, '_icon1Style_' . $F );
        delete_post_meta( $postID, '_icon2Name_' . $F );
        delete_post_meta( $postID, '_icon2Cls_' . $F );
        delete_post_meta( $postID, '_icon2Style_' . $F );
        delete_post_meta( $postID, '_icon3Name_' . $F );
        delete_post_meta( $postID, '_icon3Cls_' . $F );
        delete_post_meta( $postID, '_icon3Style_' . $F );
        delete_post_meta( $postID, '_icon4Name_' . $F );
        delete_post_meta( $postID, '_icon4Cls_' . $F );
        delete_post_meta( $postID, '_icon4Style_' . $F );
        delete_post_meta( $postID, '_icon5Name_' . $F );
        delete_post_meta( $postID, '_icon5Cls_' . $F );
        delete_post_meta( $postID, '_icon5Style_' . $F );
        delete_post_meta( $postID, '_icon6Name_' . $F );
        delete_post_meta( $postID, '_icon6Cls_' . $F );
        delete_post_meta( $postID, '_icon6Style_' . $F );
        //-- MP -------------------------
        delete_post_meta( $postID, '_inputLblP1_' . $F );
        delete_post_meta( $postID, '_orderLP1_' . $F );
        delete_post_meta( $postID, '_pfixLP1_' . $F );
        delete_post_meta( $postID, '_sfixLP1_' . $F );
        delete_post_meta( $postID, '_orderSP1_' . $F );
        delete_post_meta( $postID, '_pfixSP1_' . $F );
        delete_post_meta( $postID, '_sfixSP1_' . $F );

        delete_post_meta( $postID, '_inputLblP2_' . $F );
        delete_post_meta( $postID, '_orderLP2_' . $F );
        delete_post_meta( $postID, '_pfixLP2_' . $F );
        delete_post_meta( $postID, '_sfixLP2_' . $F );
        delete_post_meta( $postID, '_orderSP2_' . $F );
        delete_post_meta( $postID, '_pfixSP2_' . $F );
        delete_post_meta( $postID, '_sfixSP2_' . $F );

        delete_post_meta( $postID, '_inputLblP3_' . $F );
        delete_post_meta( $postID, '_orderLP3_' . $F );
        delete_post_meta( $postID, '_pfixLP3_' . $F );
        delete_post_meta( $postID, '_sfixLP3_' . $F );
        delete_post_meta( $postID, '_orderSP3_' . $F );
        delete_post_meta( $postID, '_pfixSP3_' . $F );
        delete_post_meta( $postID, '_sfixSP3_' . $F );

        delete_post_meta( $postID, '_inputLblP4_' . $F );        
        delete_post_meta( $postID, '_orderLP4_' . $F );
        delete_post_meta( $postID, '_pfixLP4_' . $F );
        delete_post_meta( $postID, '_sfixLP4_' . $F );
        delete_post_meta( $postID, '_orderSP4_' . $F );
        delete_post_meta( $postID, '_pfixSP4_' . $F );
        delete_post_meta( $postID, '_sfixSP4_' . $F );

        delete_post_meta( $postID, '_inputLblP5_' . $F );        
        delete_post_meta( $postID, '_orderLP5_' . $F );
        delete_post_meta( $postID, '_pfixLP5_' . $F );
        delete_post_meta( $postID, '_sfixLP5_' . $F );
        delete_post_meta( $postID, '_orderSP5_' . $F );
        delete_post_meta( $postID, '_pfixSP5_' . $F );
        delete_post_meta( $postID, '_sfixSP5_' . $F );
        delete_post_meta( $postID, '_sPgLnkMP_' . $F );
        //------------------------------------------------------
        delete_post_meta( $postID, '_sdProperty_' . $F );

        delete_post_meta( $postID, '_cboValues_' . $F );
        delete_post_meta( $postID, '_cboFirstValue_' . $F );
        delete_post_meta( $postID, '_cboFirstTxt_' . $F );
        delete_post_meta( $postID, '_cbomQty_' . $F );
        delete_post_meta( $postID, '_cbomSort_' . $F );
        delete_post_meta( $postID, '_cbomSortLocale_' . $F );

        delete_post_meta( $postID, '_statTxt_' . $F );
        delete_post_meta( $postID, '_statTxtFs_' . $F );
        delete_post_meta( $postID, '_showAsTxt_' . $F );
        delete_post_meta( $postID, '_excludedSlugs_' . $F ); 

        delete_post_meta( $postID, '_vcTplateID_' . $F );
        delete_post_meta( $postID, '_statAlt_' . $F );
        delete_post_meta( $postID, '_inputLblDynCap_' . $F );
        delete_post_meta( $postID, '_inputLblStatAlt_' . $F );
        delete_post_meta( $postID, '_inputLblDynAlt_' . $F );

        abcfsl_autil_delete_field_from_field_order( $postID, $F, '_fieldOrder' );
        abcfsl_autil_delete_field_from_field_order( $postID, $F, '_fieldOrderS' );            
    }

    private function user_can_save( $postID, $nonceAction, $nonceID ) {

        $is_autosave = wp_is_post_autosave( $postID );
        $is_revision = wp_is_post_revision( $postID );
        $is_valid_nonce = ( isset( $_POST[ $nonceAction ] ) && wp_verify_nonce( $_POST[ $nonceAction ], $nonceID ) );

        return ! ( $is_autosave || $is_revision ) && $is_valid_nonce;
    }

    
}