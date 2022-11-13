<?php
// function abcfsl_mbox_tplate_fields_tplate_optns(){

//     global $post;
//     $postID = $post->ID;
//     $tplateOptns = get_post_custom( $postID );
//     $tplateOptns['slTplateID'] = $postID;
//     $obj = ABCFSL_Main();

//     return array(
//         'postID' => $post->ID,
//         'tplateOptns' => $tplateOptns,
//         'pluginSlug' => $obj->pluginSlug
//     );
// }

function abcfsl_mbox_tplate_fields(){

    //$optns = abcfsl_mbox_tplate_fields_tplate_optns();
    //$tplateOptns = $optns['tplateOptns']; 

    global $post;
    $postID = $post->ID;
    $tplateOptns = get_post_custom( $postID );
    $tplateOptns['slTplateID'] = $postID;

    //Template has to have Layout selected.
    $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '0';
    $lstLayoutH = isset( $tplateOptns['_lstLayoutH'] ) ? esc_attr( $tplateOptns['_lstLayoutH'][0] ) : $lstLayout;
    if($lstLayoutH == '0') {return;}

    // $obj = ABCFSL_Main();
    // $slug = $obj->pluginSlug;
    // $clsPfix = $obj->prefix;

    abcfsl_v_tabs_fields_wrap_start(); //---Manager START
        abcfsl_mbox_tplate_fields_render_nav_tabs( $tplateOptns );
        abcfsl_mbox_tplate_fields_render_cnt( $tplateOptns );
    echo abcfl_html_tag_end( 'div' ); //---Manager END

    //wp_nonce_field( $slug, $slug . '_nonce' );
}

//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// FIELDS_10
function abcfsl_mbox_tplate_fields_render_nav_tabs( $tplateOptns ){

    echo abcfl_html_tag( 'ul', '', 'abcflVTabsNavCntr' );
        for ($i = 1; $i <= 10; ++$i) { echo abcfsl_v_tabs_render_field_tab( $tplateOptns, $i ); }        
    echo abcfl_html_tag_end( 'ul' );
}

function abcfsl_mbox_tplate_fields_render_cnt( $tplateOptns ){

    //FIELDS_50 FIELDS_10
    echo abcfl_html_tag( 'div', 'abcfslVTFCntCntrID', 'abcflVTabsCntCntr' ); //---Content START
        $i = 0;
        for ($i = 1; $i <= 10; ++$i) {
            abcfsl_mbox_tplate_field( $tplateOptns, 'F' . $i );
        }
    echo abcfl_html_tag_end( 'div' ); //---Content END
}

function abcfsl_mbox_tplate_fields_lbl( $tplateOptns, $F ){

    $lbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : ''; 
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_lnkLblLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkLblLbl_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_lnkUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlLbl_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_inputLblP1_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP1_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_inputLblP2_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP2_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_inputLblP3_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP3_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_inputLblP4_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP4_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : ''; }

    return $F . '&nbsp;&nbsp;' . $lbl;
}