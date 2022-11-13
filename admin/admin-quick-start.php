<?php
/*
 * Admin tab: Quick Start.
 * Creates QS posts: template + items.
 */
function abcfsl_admin_quick_start() {

    $obj = ABCFSL_Main();
    $slug = $obj->pluginSlug;

    $tplateLayout = '1';
    $tplateName = '';
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(80), abcfsl_aurl(0), 'abcflFontWP abcflFontS16 abcflFontW600 abcflMTop30' );

    //== UPDATE START =======================================
    if ( isset($_POST['btnAddDefaultPosts']) ){
        check_admin_referer( $slug . '_nonce' );

        $tplateName = (isset( $_POST['tplateName'] ) ? esc_attr($_POST['tplateName']) : '');
        $insertStatus = abcfsl_admin_quick_start_add_records( $tplateLayout, $tplateName );

        $defaults = array( 'errorMsg' => 'M', 'outTplate' => 'T', 'outItem1' => '1', 'outItem2' => '2', 'outItem3' => '3' );
        $out = wp_parse_args( $insertStatus, $defaults );

        //Return status messages.
        if($insertStatus['status'] == 'KO') {
            abcfl_autil_msg_err( $out['errorMsg'], false );
        }
        else{
            abcfl_autil_msg_ok();
            echo abcfl_html_tag_cls('div', 'abcflMTop10 abcflMLeft30');
            echo abcfl_input_info_lbl( 'Created', '', 16, 'SB');

            echo abcfsl_admin_quick_print_item( $out['outTplate'], 'Template: ' );
            echo abcfsl_admin_quick_print_item( $out['outItem1'] );
            echo abcfsl_admin_quick_print_item( $out['outItem2'] );
            echo abcfsl_admin_quick_print_item( $out['outItem3'] );

            echo abcfl_input_hline('2', '20', '50P');
            echo abcfl_html_tag_end('div');

        }
    }
    //== UPDATE END =======================================

    $lbl = abcfl_input_lbl_hlp( ABCFSL_ICONS_URL, abcfsl_txta(17), abcfsl_aurl(10) );

    echo abcfl_html_form( 'frm-mm-defaults', '');
    wp_nonce_field($slug . '_nonce');

    //-- Main Cntr START --------------------
    echo abcfl_html_tag_cls('div', 'abcflMTop20 abcflMLeft30');

    echo abcfl_input_txt('tplateName', '', $tplateName, $lbl, '', '30%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_input_hline('2', '20', '50P');
    echo abcfl_html_tag('div','', 'submit' );
    echo abcfl_input_btn( 'btnAddDefaultPosts', 'btnAddDefaultPosts', 'submit', abcfsl_txta(241), 'button-primary abcficBtnWide' );

    echo abcfl_input_hlp_url ( abcfsl_txta(11), abcfsl_aurl(10), 'abcflFontWP abcflFontS16 abcflMTop20' );

    //-- ENDs: Button, Main Cntr, Form,  ------------
    echo abcfl_html_tag_ends('div,div,form');


}

function abcfsl_admin_quick_print_item( $item, $lbl='Staff Member: ' ){

    return abcfl_html_tag_cls( 'div', 'abcflMTop10 abcflFontWP abcflFontS14' ) .
        abcfl_html_tag_cls( 'span', 'abcflFontW600' ) . $lbl . abcfl_html_tag_end('span') .
        abcfl_html_tag_cls( 'span', 'abcflFontW400' ) . $item .
    abcfl_html_tag_ends('span,div');

}

function abcfsl_admin_quick_start_add_records( $tplateLayout, $tplateName ) {

    $tplateTitle = sanitize_text_field( $tplateName );
    if( empty( $tplateTitle ) ) { $tplateTitle = 'Quick Start'; }

    $cptTtplate = 'cpt_staff_lst';
    $cptItem = 'cpt_staff_lst_item';
    $errMsgInsertFailed = 'Error: Demo records insert failed!';

    $insertStatus['status'] = 'OK';
    $insertStatus['errorMsg'] = '';
    $sufix = '';

    //--CHECK CUSTOM POST TYPES ------------------------------------
    $outPostType = abcfsl_admin_quick_start_check_post_type( $cptTtplate );
    if( !$outPostType ) {
        $insertStatus['status'] = 'KO';
        $insertStatus['errorMsg'] = 'Error: Custom post type doesn\'t exist: ' . $cptTtplate;
        return $insertStatus;
    }

    $outPostType = abcfsl_admin_quick_start_check_post_type( $cptItem );
    if( !$outPostType ) {
        $insertStatus['status'] = 'KO';
        $insertStatus['errorMsg'] = 'Error: Custom post type doesn\'t exist: ' . $cptItem;
        return $insertStatus;
    }
    //---------------------------------------------

    //-- CREATE TEMPLATE --------------------------
    //Check if custom post type with the same name already exists. If so append suffix
    $pgExists = abcfsl_admin_quick_start_check_post_title( $cptTtplate, $tplateTitle );
    if( $pgExists ){
        $sufix = rand( 1 , 100 );
        $tplateTitle .= ' ' . $sufix;
    }

    $errTplate = 'Error: Staff Template Demo not created.';
    $outTplate = abcfsl_admin_quick_start_create_template( $cptTtplate, $tplateTitle, $tplateLayout, $errTplate );
    if( empty( $outTplate ) ) {
        $insertStatus['status'] = 'KO';
        $insertStatus['errorMsg'] = $errMsgInsertFailed;
        $insertStatus['outTplate'] = $errTplate;
        return $insertStatus;
    }
    if( $outTplate['status'] == 'KO' ) {
        $insertStatus['status'] = 'KO';
        $insertStatus['errorMsg'] = $errMsgInsertFailed;
        $insertStatus['outTplate'] = $outTplate['outTplate'];
        return $insertStatus;
    }

    $insertStatus['outTplate'] = $outTplate['outTplate'];

    //-- CREATE ITEMS --------------------------
    $par['tplateID'] = $outTplate['tplateID'];
    $par['sufix'] = $sufix;
    $par['cptItem'] = $cptItem;
    $par['errorMsg'] = 'Error: Staff Member Demo not created.';
    $par['errMsgInsertFailed'] = $errMsgInsertFailed;

    //------------------------------------------------

    //$data = abcfsl_admin_quick_start_profile_staff_1();
    $par['recordNo'] = '1';
    $insertStatus = abcfsl_admin_quick_start_item_bldr( abcfsl_admin_quick_start_profile_staff_1(), $par, $insertStatus);
    if( $insertStatus['status'] != 'OK' ) { return $insertStatus; }
    //------------------------------------------------
    $par['recordNo'] = '2';
    $insertStatus = abcfsl_admin_quick_start_item_bldr( abcfsl_admin_quick_start_profile_staff_2(), $par, $insertStatus);
    if( $insertStatus['status'] != 'OK' ) { return $insertStatus; }
    //------------------------------------------------
    $par['recordNo'] = '3';
    $insertStatus = abcfsl_admin_quick_start_item_bldr( abcfsl_admin_quick_start_profile_staff_3(), $par, $insertStatus);
    if( $insertStatus['status'] != 'OK' ) { return $insertStatus; }
    //------------------------------------------------

    return $insertStatus;
}

//======================================================================
function abcfsl_admin_quick_start_create_template( $postType, $tplateTitle, $tplateLayout, $errTplate ) {

    $postData = array (
        'comment_status'    => 'closed',
        'ping_status'       => 'closed',
        'post_title'        => $tplateTitle,
        'post_status'       => 'publish',
        'post_type'         => $postType,
    );

    $postID = wp_insert_post( $postData );

    $out['status'] = 'KO';
    $out['outTplate'] = $errTplate;
    $out['tplateID'] = 0;

    if ( is_wp_error( $postID ) ) {
        $out['status'] = 'KO';
        $out['outTplate'] = $postID->get_error_message();
        return $out;
    }
    if ( !$postID ) {
        $out['status'] = 'KO';
        $out['outTplate'] = $errTplate;
        return $out;
    }

    // insert post meta
    add_post_meta($postID, '_lstLayout', $tplateLayout);
    add_post_meta($postID, '_lstLayoutH', $tplateLayout);


    add_post_meta($postID, '_lstCols', '5');
    add_post_meta($postID, '_tagType_F1', 'h3');

    add_post_meta($postID, '_spgCntrW', '90%');
    //add_post_meta($postID, '_itemMarginB', '1');

    add_post_meta($postID, '_spgCols', '5');
    add_post_meta($postID, '_spgImgCls', 'abcfslImgCenter abcfslImgBorder1');
    add_post_meta($postID, '_spgCntrCls', 'abcfslMB200');

    add_post_meta($postID, '_tagTypeSPg_F1', 'h3');
    add_post_meta($postID, '_tagFontSPg_F1', 'D');
    add_post_meta($postID, '_tagMarginTSPg_F1', 'D');

    //Name - Multipart
    add_post_meta($postID, '_fieldType_F1', 'MP');
    add_post_meta($postID, '_fieldTypeH_F1', 'MP');
    add_post_meta($postID, '_showField_F1', 'Y');
    add_post_meta($postID, '_inputLblP1_F1', 'First Name');
    add_post_meta($postID, '_inputLblP2_F1', 'Last Name');
    add_post_meta($postID, '_orderLP1_F1', '2');
    add_post_meta($postID, '_orderLP2_F1', '1');
    add_post_meta($postID, '_orderSP1_F1', '1');
    add_post_meta($postID, '_orderSP2_F1', '2');

    //Position - Text
    add_post_meta($postID, '_fieldType_F2', 'T');
    add_post_meta($postID, '_fieldTypeH_F2', 'T');
    add_post_meta($postID, '_showField_F2', 'Y');
    add_post_meta($postID, '_tagType_F2', 'div');
    add_post_meta($postID, '_tagFont_F2', '14');
    add_post_meta($postID, '_tagMarginT_F2', '10');
    add_post_meta($postID, '_inputLbl_F2', 'Position');

    //Department - Text
    add_post_meta($postID, '_fieldType_F3', 'T');
    add_post_meta($postID, '_fieldTypeH_F3', 'T');
    add_post_meta($postID, '_showField_F3', 'Y');
    add_post_meta($postID, '_tagType_F3', 'div');
    add_post_meta($postID, '_tagFont_F3', '14');
    add_post_meta($postID, '_tagMarginT_F3', '10');
    add_post_meta($postID, '_inputLbl_F3', 'Department');

    //Phone -
    add_post_meta($postID, '_fieldType_F4', 'LT');
    add_post_meta($postID, '_fieldTypeH_F4', 'LT');
    add_post_meta($postID, '_showField_F4', 'Y');
    add_post_meta($postID, '_tagType_F4', 'div');
    add_post_meta($postID, '_tagFont_F4', '14');
    add_post_meta($postID, '_tagMarginT_F4', '10');
    add_post_meta($postID, '_lblTxt_F4', 'Phone: ');
    add_post_meta($postID, '_inputLbl_F4', 'Phone');
    add_post_meta($postID, '_inputHlp_F4', 'Enter office phone number.');

    //Email
    add_post_meta($postID, '_fieldType_F5', 'EM');
    add_post_meta($postID, '_fieldTypeH_F5', 'EM');
    add_post_meta($postID, '_showField_F5', 'Y');
    add_post_meta($postID, '_tagType_F5', 'div');
    add_post_meta($postID, '_tagFont_F5', '14');
    add_post_meta($postID, '_tagMarginT_F5', '10');
    add_post_meta($postID, '_lnkLblLbl_F5', 'Email Link Text');
    add_post_meta($postID, '_lnkLblHlp_F5', 'Enter email address or any other text.');
    add_post_meta($postID, '_lnkUrlLbl_F5', 'Email Address');
    add_post_meta($postID, '_lnkUrlHlp_F5', 'Enter email address.');

    //Bio - Paragraph
    add_post_meta($postID, '_fieldType_F6', 'PT');
    add_post_meta($postID, '_fieldTypeH_F6', 'PT');
    add_post_meta($postID, '_showField_F6', 'S');
    add_post_meta($postID, '_tagType_F6', 'div');
    add_post_meta($postID, '_tagFont_F6', '16');
    add_post_meta($postID, '_tagMarginT_F6', '30');
    add_post_meta($postID, '_fieldCntrSPg_F6', 'B');
    add_post_meta($postID, '_inputLbl_F6', 'Staff Profile');

    //Single page link
    add_post_meta($postID, '_sPgLnkShow', 'Y');
    add_post_meta($postID, '_sPgLnkTxt', 'Profile');
    add_post_meta($postID, '_sPgLnkFont', '16');
    add_post_meta($postID, '_sPgLnkMarginT', '15');

    $out['status'] = 'OK';
    $out['outTplate'] = $tplateTitle;
    $out['tplateID'] = $postID;

    abcfsl_autil_add_new_field_to_field_order( $postID, 'N', 'Y', 'F1' );
    abcfsl_autil_add_new_field_to_field_order( $postID, 'N', 'Y', 'F2' );
    abcfsl_autil_add_new_field_to_field_order( $postID, 'N', 'Y', 'F3' );
    abcfsl_autil_add_new_field_to_field_order( $postID, 'N', 'Y', 'F4' );
    abcfsl_autil_add_new_field_to_field_order( $postID, 'N', 'Y', 'F5' );
    abcfsl_autil_add_new_field_to_field_order( $postID, 'N', 'S', 'F6' );
    abcfsl_autil_add_new_field_to_field_order( $postID, 'Y', 'L', 'SPTL' );

    return $out;
}

function abcfsl_admin_quick_start_item_bldr( $data, $par, $insertStatus){

    $par['title'] = sanitize_text_field( 'QS ' . $par['sufix'] . ' - ' . $data['fName'] . ' ' . $data['lName'] );

    $out = abcfsl_admin_quick_start_create_item( $data, $par );

    if( empty( $out ) ) {
        $insertStatus['status'] = 'KO';
        $insertStatus['errorMsg'] = $par['errMsgInsertFailed'];
        return $insertStatus;
    }

    if( $out['status'] == 'KO' ) {
        $insertStatus['status'] = 'KO';
        $insertStatus['errorMsg'] = $par['errMsgInsertFailed'];
        $insertStatus['outItem' . $par['recordNo']] = $out['itemTitle'];
        return $insertStatus;
    }

    $insertStatus['outItem' . $par['recordNo']] = $out['itemTitle'];

    return $insertStatus;

}

function abcfsl_admin_quick_start_create_item( $data, $par ) {

    $postData = array (
        'comment_status'    => 'closed',
        'ping_status'       => 'closed',
        'post_title'        => $par['title'],
        'post_status'       => 'publish',
        'post_type'         => $par['cptItem'],
        'post_parent'       => $par['tplateID']
    );

    $out['status'] = 'KO';
    $out['outItem'] = '';
    $out['itemID'] = 0;

    $postID = wp_insert_post( $postData );

    if ( is_wp_error( $postID ) ) {
        $out['status'] = 'KO';
        $out['outItem'] = $postID->get_error_message();
        return $out;
    }
    if (!$postID) {
        $out['status'] = 'KO';
        $out['outItem'] = $par['errorMsg'];
        return $out;
    }

    $recordNo = $par['recordNo'];
    $src = trailingslashit( ABCFSL_PLUGIN_URL ) . 'images/staff-member-'. $recordNo . '.jpg';

    // Add post meta
    add_post_meta($postID, '_imgIDL', '0');
    add_post_meta($postID, '_imgUrlL', $src);
    add_post_meta($postID, '_imgLnkL', 'SP');
    add_post_meta($postID, '_imgIDS', '0');
    add_post_meta($postID, '_imgUrlS', 'SP');
    add_post_meta($postID, '_sortTxt', $data['fName'] . $data['lName']);

    //---------------------
    add_post_meta($postID, '_mp1_F1', $data['fName']);
    add_post_meta($postID, '_mp2_F1', $data['lName']);
    add_post_meta($postID, '_txt_F2', $data['position']);
    add_post_meta($postID, '_txt_F3', $data['department']);
    add_post_meta($postID, '_txt_F4', $data['phone']);
    add_post_meta($postID, '_urlTxt_F5', $data['emailTxt']);
    add_post_meta($postID, '_url_F5', $data['emailAddress']);
    add_post_meta($postID, '_txt_F6', $data['profile']);
    //---------------------

    $out['status'] = 'OK';
    $out['itemTitle'] = $par['title'];
    $out['itemID'] = $postID;

    return $out;

}

function abcfsl_admin_quick_start_check_post_type( $postType ) {

    if ( post_type_exists( $postType ) ) {
        return true;
    }
    return false;
}

function abcfsl_admin_quick_start_check_post_title( $postType, $pgTitle ) {

    $out = false;
    $pg = get_page_by_title( $pgTitle, 'OBJECT', $postType );
    if ($pg !== null) { $out = true; }
    return $out;
}

//== Members Data ===============================================================
function abcfsl_admin_quick_start_profile_staff_1(){

    $data['fName'] = 'Stephanie';
    $data['lName'] = 'More';
    $data['position'] = 'Assistant Principal';
    $data['department'] = 'Administration'; //Latin & World History Logic and Drama Physics and Chemistry Chemistry & Physical Science
    $data['phone'] = '123-5555-2323';
    $data['emailTxt'] = 'Email';
    $data['emailAddress'] = 'myemail@mydomain.com';
    $data['profile'] = abcfsl_admin_quick_start_profile_txt();

    return $data;
}

function abcfsl_admin_quick_start_profile_staff_2(){

    $data['fName'] = 'Michael';
    $data['lName'] = 'Gordon';
    $data['position'] = 'Language Arts Teacher';
    $data['department'] = 'Latin & World History';
    $data['phone'] = '123-2828-2828';
    $data['emailTxt'] = 'Email';
    $data['emailAddress'] = 'myemail@mydomain.com';
    $data['profile'] = abcfsl_admin_quick_start_profile_txt();

    return $data;
}

function abcfsl_admin_quick_start_profile_staff_3(){

    $data['fName'] = 'Laura';
    $data['lName'] = 'Taylor';
    $data['position'] = 'Chemistry Teacher';
    $data['department'] = 'Physics and Chemistry';
    $data['phone'] = '989-6667-6262';
    $data['emailTxt'] = 'Email';
    $data['emailAddress'] = 'myemail@mydomain.com';
    $data['profile'] = abcfsl_admin_quick_start_profile_txt();

    return $data;
}

function abcfsl_admin_quick_start_profile_txt(){

    return 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ' .
            'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ' .
            'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. ' .
            'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum';
}



