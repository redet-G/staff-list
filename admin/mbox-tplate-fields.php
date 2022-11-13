<?php

function abcfsl_mbox_tplate_fields(){

    $optns = abcfsl_mbox_tplate_fields_tplate_optns();
    $tplateOptns = $optns['tplateOptns'];

    //Template has to have Layout selected.
    $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '0';
    $lstLayoutH = isset( $tplateOptns['_lstLayoutH'] ) ? esc_attr( $tplateOptns['_lstLayoutH'][0] ) : $lstLayout;
    if($lstLayoutH == '0') {return;}

    $obj = ABCFSL_Main();
    $slug = $obj->pluginSlug;
    $clsPfix = $obj->prefix;

    abcfsl_v_tabs_manager_div_s( '2', $slug ); //---Manager START
        abcfsl_mbox_tplate_fields_render_nav_tabs( $tplateOptns );
        abcfsl_mbox_tplate_fields_render_cnt( $tplateOptns );
    echo abcfl_html_tag_end( 'div' ); //---Manager END

    //wp_nonce_field( $slug, $slug . '_nonce' );
}

function abcfsl_mbox_tplate_fields_render_nav_tabs( $tplateOptns ){

    echo abcfl_html_tag( 'ul', '', 'abcflVTabsNavCntr' );

        echo abcfsl_v_tabs_render_nav_tab( 'abcflVTabsTabActive', abcfsl_mbox_tplate_fields_lbl( $tplateOptns, 'F1' ) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_mbox_tplate_fields_lbl( $tplateOptns, 'F2' ) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_mbox_tplate_fields_lbl( $tplateOptns, 'F3' ) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_mbox_tplate_fields_lbl( $tplateOptns, 'F4' ) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_mbox_tplate_fields_lbl( $tplateOptns, 'F5' ) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_mbox_tplate_fields_lbl( $tplateOptns, 'F6' ) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_mbox_tplate_fields_lbl( $tplateOptns, 'F7' ) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_mbox_tplate_fields_lbl( $tplateOptns, 'F8' ) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_mbox_tplate_fields_lbl( $tplateOptns, 'F9' ) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_mbox_tplate_fields_lbl( $tplateOptns, 'F10' ) );

    echo abcfl_html_tag_end( 'ul' );

}

function abcfsl_mbox_tplate_fields_render_cnt( $tplateOptns ){  

    echo abcfl_html_tag( 'div', 'abcfsl_VTabsCntCntr_2', 'abcflVTabsCntCntr' ); //---Content START

    $i = 0;
    for ($i = 1; $i <= 10; ++$i) {
        abcfsl_mbox_tplate_field($tplateOptns, 'F' . $i);
    }

    echo abcfl_html_tag_end( 'div' ); //---Content END
}

function abcfsl_mbox_tplate_fields_lbl( $tplateOptns, $F ){

    $lbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0]  ) : '';

    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_lnkLblLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkLblLbl_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_lnkUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlLbl_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_inputLblP1_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP1_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_inputLblP2_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP2_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_inputLblP3_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP3_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_inputLblP4_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP4_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : ''; }

    return $F . '&nbsp;&nbsp;' . $lbl;
}


function abcfsl_mbox_tplate_fields_tplate_optns(){

    global $post;
    $postID = $post->ID;
    $tplateOptns = get_post_custom( $postID );

    $obj = ABCFSL_Main();
    //$pluginSlug = $obj->pluginSlug;

    return array(
        'postID' => $post->ID,
        'tplateOptns' => $tplateOptns,
        'pluginSlug' => $obj->pluginSlug
    );
}













