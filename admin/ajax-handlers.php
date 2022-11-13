<?php
add_action( 'wp_ajax_update_field_order_l', 'abcfsl_ajax_update_field_order_l' );
add_action( 'wp_ajax_update_field_order_s', 'abcfsl_ajax_update_field_order_s' );

function abcfsl_ajax_update_field_order_l() {

    if(!$_POST){
        $out = array( 'error' => true, 'error_msg' => 'Error: POST is missing.');
        wp_send_json( $out );
        die();
    }

    $defaults = array(
        'order' => array('L_0'),
        'postid' => 'ulL_0'
     );

    $post = wp_parse_args( $_POST, $defaults );
    $order = $post['order'];
    $postID = str_ireplace( 'ulL_', '', $post['postid'] );

    if($order[0] == 'L_0'){
        $out = array( 'error' => true, 'error_msg' => 'Error: Order is missing.');
        wp_send_json( $out );
        die();
    }

    $fieldOrder = 0;
    $fields = array();

    foreach( $order as $F ) {
        $fieldOrder ++;
        $fields[$fieldOrder] = $F;
    }

    //A passed array will be serialized into a string.
    if(!empty($fields)){
        // Array has duplicates
        if(count(array_unique($fields)) < count($fields)){
            $fieldsU = array_unique($fields);
            $fields = array_combine(range(1, count($fieldsU)), array_values($fieldsU));
        }

//        wp_send_json( $fields );
//        die();
        update_post_meta( $postID, '_fieldOrder', $fields );
    }

    die();
}
function abcfsl_ajax_update_field_order_s() {

    if(!$_POST){
        $out = array( 'error' => true, 'error_msg' => 'Error: POST is missing.');
        wp_send_json( $out );
        die();
    }

    $defaults = array(
        'order' => array('L_0'),
        'postid' => 'ulS_0'
     );

    $post = wp_parse_args( $_POST, $defaults );
    $order = $post['order'];
    $postID = str_ireplace( 'ulS_', '', $post['postid'] );

    if($order[0] == 'L_0'){
        $out = array( 'error' => true, 'error_msg' => 'Error: Order is missing.');
        wp_send_json( $out );
        die();
    }

    $fieldOrder = 0;
    $fields = array();

    foreach( $order as $F ) {
        $fieldOrder ++;
        $fields[$fieldOrder] = $F;
    }

    //A passed array will be serialized into a string.
    if(!empty($fields)){
        // Array has duplicates
        if(count(array_unique($fields))<count($fields)){
            $fieldsU = array_unique($fields);
            $fields = array_combine(range(1, count($fieldsU)), array_values($fieldsU));
        }
        update_post_meta( $postID, '_fieldOrderS', $fields );
    }

    die();
}

//----------------------------------------------------------------
add_action( 'wp_ajax_update_list_order', 'abcfsl_ajax_update_list_order' );

function abcfsl_ajax_update_list_order() {

// TODO
//    if( !isset( $_POST['abcstaffNonce'] ) || !wp_verify_nonce($_POST['abcstaffNonce'], 'abcstaff') ){
//        $out = array( 'error' => true, 'msg' => 'Error: Permissions check failed');
//        //echo $out;
//        wp_send_json( $out );
//        die();
//    }

    if(!$_POST){
        $out = array( 'error' => true, 'error_msg' => 'Error: POST is missing.');
        wp_send_json( $out );
        die();
    }

    $defaults = array(
        'order' => array('post_0')
     );

    $post = wp_parse_args( $_POST, $defaults );
    $order = $post['order'];

    if($order[0] == 'post_0'){
        $out = array( 'error' => true, 'error_msg' => 'Error: Order is missing.');
        wp_send_json( $out );
        die();
    }
//
//    if($order[0] != 'post_0'){
//        $out = array( $order );
//        wp_send_json( $out );
//        die();
//    }

    $postID = 0;
    $menuOrder = 0;

    foreach( $order as $post_id ) {
        $postID  = intval( str_ireplace( 'item_', '', $post_id ) );
        $menuOrder ++;
        wp_update_post( array( 'ID' => $postID, 'menu_order' => $menuOrder ) );
    }

    die();
}