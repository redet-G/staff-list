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

        add_meta_box('abcfsl_staff_member_tax_category','Category', array($this,'staff_member_category'),
            $post->post_type,
            'normal',
            'default');


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

    public function display_staff_member()
    {
        abcfsl_mbox_item_tabs();
    }

    public function staff_member_category($post,$box ){

        $defaults = array( 'taxonomy' => 'tax_staff_member_cat' );
        if ( ! isset( $box['args'] ) || ! is_array( $box['args'] ) ) {
            $args = array();
        } else {
            $args = $box['args'];
        }
        $parsed_args = wp_parse_args( $args, $defaults );
        $tax_name    = esc_attr( $parsed_args['taxonomy'] );
        $taxonomy    = get_taxonomy( 'tax_staff_member_cat');
        ?>
        <div id="taxonomy-<?php echo $tax_name; ?>" class="categorydiv">
            <ul id="<?php echo $tax_name; ?>-tabs" class="category-tabs">
                <li class="tabs"><a href="#<?php echo $tax_name; ?>-all"><?php echo $taxonomy->labels->all_items; ?></a></li>
                <li class="hide-if-no-js"><a href="#<?php echo $tax_name; ?>-pop"><?php echo esc_html( $taxonomy->labels->most_used ); ?></a></li>
            </ul>

            <div id="<?php echo $tax_name; ?>-pop" class="tabs-panel" style="display: none;">
                <ul id="<?php echo $tax_name; ?>checklist-pop" class="categorychecklist form-no-clear" >
                    <?php $popular_ids = $this->staff_member_popular_terms_checklist( $tax_name ); ?>
                </ul>
            </div>

            <div id="<?php echo $tax_name; ?>-all" class="tabs-panel">
                <?php
                $name = ( 'category' === $tax_name ) ? 'post_category' : 'tax_input[' . $tax_name . ']';
                // Allows for an empty term set to be sent. 0 is an invalid term ID and will be ignored by empty() checks.
                echo "<input type='hidden' name='{$name}[]' value='0' />";
                ?>
                <ul id="<?php echo $tax_name; ?>checklist" data-wp-lists="list:<?php echo $tax_name; ?>" class="categorychecklist form-no-clear">
                    <?php
                    $this->staff_member_terms_checklist(
                        $post->ID,
                        array(
                            'taxonomy'     => $tax_name,
                            'popular_cats' => $popular_ids,
                        )
                    );
                    ?>
                </ul>
            </div>
            <?php if ( current_user_can( $taxonomy->cap->edit_terms ) ) : ?>
                <div id="<?php echo $tax_name; ?>-adder" class="wp-hidden-children">
                    <a id="<?php echo $tax_name; ?>-add-toggle" href="#<?php echo $tax_name; ?>-add" class="hide-if-no-js taxonomy-add-new">
                        <?php
                        /* translators: %s: Add New taxonomy label. */
                        printf( __( '+ %s' ), $taxonomy->labels->add_new_item );
                        ?>
                    </a>
                    <p id="<?php echo $tax_name; ?>-add" class="category-add wp-hidden-child">
                        <label class="screen-reader-text" for="new<?php echo $tax_name; ?>"><?php echo $taxonomy->labels->add_new_item; ?></label>
                        <input type="text" name="new<?php echo $tax_name; ?>" id="new<?php echo $tax_name; ?>" class="form-required form-input-tip" value="<?php echo esc_attr( $taxonomy->labels->new_item_name ); ?>" aria-required="true" />
                        <label class="screen-reader-text" for="new<?php echo $tax_name; ?>_parent">
                            <?php echo $taxonomy->labels->parent_item_colon; ?>
                        </label>
                        <?php
                        $parent_dropdown_args = array(
                            'taxonomy'         => $tax_name,
                            'hide_empty'       => 0,
                            'name'             => 'new' . $tax_name . '_parent',
                            'orderby'          => 'name',
                            'hierarchical'     => 1,
                            'show_option_none' => '&mdash; ' . $taxonomy->labels->parent_item . ' &mdash;',
                        );

                        /**
                         * Filters the arguments for the taxonomy parent dropdown on the Post Edit page.
                         *
                         * @since 4.4.0
                         *
                         * @param array $parent_dropdown_args {
                         *     Optional. Array of arguments to generate parent dropdown.
                         *
                         *     @type string   $taxonomy         Name of the taxonomy to retrieve.
                         *     @type bool     $hide_if_empty    True to skip generating markup if no
                         *                                      categories are found. Default 0.
                         *     @type string   $name             Value for the 'name' attribute
                         *                                      of the select element.
                         *                                      Default "new{$tax_name}_parent".
                         *     @type string   $orderby          Which column to use for ordering
                         *                                      terms. Default 'name'.
                         *     @type bool|int $hierarchical     Whether to traverse the taxonomy
                         *                                      hierarchy. Default 1.
                         *     @type string   $show_option_none Text to display for the "none" option.
                         *                                      Default "&mdash; {$parent} &mdash;",
                         *                                      where `$parent` is 'parent_item'
                         *                                      taxonomy label.
                         * }
                         */
                        $parent_dropdown_args = apply_filters( 'post_edit_category_parent_dropdown_args', $parent_dropdown_args );

                        wp_dropdown_categories( $parent_dropdown_args );
                        ?>
                        <input type="button" id="<?php echo $tax_name; ?>-add-submit" data-wp-lists="add:<?php echo $tax_name; ?>checklist:<?php echo $tax_name; ?>-add" class="button category-add-submit" value="<?php echo esc_attr( $taxonomy->labels->add_new_item ); ?>" />
                        <?php wp_nonce_field( 'add-' . $tax_name, '_ajax_nonce-add-' . $tax_name, false ); ?>
                        <span id="<?php echo $tax_name; ?>-ajax-response"></span>
                    </p>
                </div>
            <?php endif; ?>
        </div>
        <?php
    }


    function staff_member_terms_checklist( $post_id = 0, $args = array() ) {
        $defaults = array(
            'descendants_and_self' => 0,
            'selected_cats'        => false,
            'popular_cats'         => false,
            'walker'               => null,
            'taxonomy'             => 'category',
            'checked_ontop'        => true,
            'echo'                 => true,
        );

        /**
         * Filters the taxonomy terms checklist arguments.
         *
         * @since 3.4.0
         *
         * @see wp_terms_checklist()
         *
         * @param array|string $args    An array or string of arguments.
         * @param int          $post_id The post ID.
         */
        $params = apply_filters( 'wp_terms_checklist_args', $args, $post_id );

        $parsed_args = wp_parse_args( $params, $defaults );

        if ( empty( $parsed_args['walker'] ) || ! ( $parsed_args['walker'] instanceof Walker ) ) {
            $walker = new Walker_Category_Checklist;
        } else {
            $walker = $parsed_args['walker'];
        }

        $taxonomy             = $parsed_args['taxonomy'];
        $descendants_and_self = (int) $parsed_args['descendants_and_self'];

        $args = array( 'taxonomy' => $taxonomy );

        $tax              = get_taxonomy( $taxonomy );
        $args['disabled'] = ! current_user_can( $tax->cap->assign_terms );

        $args['list_only'] = ! empty( $parsed_args['list_only'] );

        if ( is_array( $parsed_args['selected_cats'] ) ) {
            $args['selected_cats'] = array_map( 'intval', $parsed_args['selected_cats'] );
        } elseif ( $post_id ) {
            $args['selected_cats'] = wp_get_object_terms( $post_id, $taxonomy, array_merge( $args, array( 'fields' => 'ids' ) ) );
        } else {
            $args['selected_cats'] = array();
        }

        if ( is_array( $parsed_args['popular_cats'] ) ) {
            $args['popular_cats'] = array_map( 'intval', $parsed_args['popular_cats'] );
        } else {
            $args['popular_cats'] = get_terms(
                array(
                    'taxonomy'     => $taxonomy,
                    'fields'       => 'ids',
                    'orderby'      => 'count',
                    'order'        => 'DESC',
                    'number'       => 10,
                    'hierarchical' => false,
                )
            );
        }

        if ( $descendants_and_self ) {
            $categories = (array) get_terms(
                array(
                    'taxonomy'     => $taxonomy,
                    'child_of'     => $descendants_and_self,
                    'hierarchical' => 0,
                    'hide_empty'   => 0,
                )
            );
            $self       = get_term( $descendants_and_self, $taxonomy );
            array_unshift( $categories, $self );
        } else {
            $categories = (array) get_terms(
                array(
                    'taxonomy' => $taxonomy,
                    'get'      => 'all',
                )
            );
        }

        // check if category is printable check privilege
        $newCat = [];
        foreach($categories as $cat){
            if(current_user_can('manage_staff_profile_for_'.$cat->slug)){
                $newCat[] = $cat;
            }
        }
        $categories = $newCat;
        $output = '';

        if ( $parsed_args['checked_ontop'] ) {
            // Post-process $categories rather than adding an exclude to the get_terms() query
            // to keep the query the same across all posts (for any query cache).
            $checked_categories = array();
            $keys               = array_keys( $categories );

            foreach ( $keys as $k ) {
                if ( in_array( $categories[ $k ]->term_id, $args['selected_cats'], true ) ) {
                    $checked_categories[] = $categories[ $k ];
                    unset( $categories[ $k ] );
                }
            }

            // Put checked categories on top.
            $output .= $walker->walk( $checked_categories, 0, $args );
        }
        // Then the rest of them.
        $output .= $walker->walk( $categories, 0, $args );

        if ( $parsed_args['echo'] ) {
            echo $output;
        }

        return $output;
    }


    function staff_member_popular_terms_checklist( $taxonomy, $default_term = 0, $number = 10, $display = true ) {
        $post = get_post();

        if ( $post && $post->ID ) {
            $checked_terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );
        } else {
            $checked_terms = array();
        }

        $terms = get_terms(
            array(
                'taxonomy'     => $taxonomy,
                'orderby'      => 'count',
                'order'        => 'DESC',
                'number'       => $number,
                'hierarchical' => false,
            )
        );

        $tax = get_taxonomy( $taxonomy );

        $popular_ids = array();
        error_log(json_encode(wp_get_current_user()->roles));
        foreach ( (array) $terms as $term ) {
            if(!current_user_can('manage_staff_profile_for_'.$term->slug))
                continue;
            $popular_ids[] = $term->term_id;
            error_log('manage_staff_profile_for_'.$term->slug);
            if ( ! $display ) { // Hack for Ajax use.
                continue;
            }

            $id      = "popular-$taxonomy-$term->term_id";
            $checked = in_array( $term->term_id, $checked_terms, true ) ? 'checked="checked"' : '';
            ?>

            <li id="<?php echo $id; ?>" class="popular-category">
                <label class="selectit">
                    <input id="in-<?php echo $id; ?>" type="checkbox" <?php echo $checked; ?> value="<?php echo (int) $term->term_id; ?>" <?php disabled( ! current_user_can( $tax->cap->assign_terms ) ); ?> />
                    <?php
                    /** This filter is documented in wp-includes/category-template.php */
                    echo esc_html( apply_filters( 'the_category', $term->name, '', '' ) );
                    ?>
                </label>
            </li>

            <?php
        }
        return $popular_ids;
    }
    //meta box Select Template
    public function staff_templates_cbo( $post ) {

        $tplateID = $post->post_parent;
        if( $tplateID == 0 ) { $tplateID = get_option( 'sl_default_tplate_id', 0 ); }

        $cboTplates = abcfsl_dba_cbo_tplates( abcfsl_txta(244) );
        echo abcfl_input_cbo('parent_id', 'parent_id', $cboTplates, $tplateID, '', abcfsl_txta(267), '100%', true, 'widefat');
    }

    public function save_post( $postID ) {
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