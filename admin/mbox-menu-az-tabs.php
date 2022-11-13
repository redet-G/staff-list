<?php
function abcfsl_mbox_menu_az_tabs(){

    //abcfsl_v_tabs_optns_cntr_start();
    abcfsl_v_tabs_az_menus_cntr_start();
        abcfsl_mbox_menu_az_tabs_render_nav_tabs();
        abcfsl_mbox_menu_az_tabs_render_cnt();
    echo abcfl_html_tag_end( 'div' ); //---Manager END

    $obj = ABCFSL_Main();
    $slug = $obj->pluginSlug;

    wp_nonce_field( $slug, $slug . '_nonce' );
}

function abcfsl_mbox_menu_az_tabs_render_nav_tabs( ){

    echo abcfl_html_tag( 'ul', '', 'abcflVTabsNavCntr' );
        echo abcfsl_v_tabs_render_optns_tab( 'CN1', abcfsl_txta(13), 'abcflVTabsTabActive' );
        echo abcfsl_v_tabs_render_optns_tab( 'CN2', abcfsl_txta(45) );
        echo abcfsl_v_tabs_render_optns_tab( 'CN3', abcfsl_txta(3) );
        
    echo abcfl_html_tag_end( 'ul' );
}

function abcfsl_mbox_menu_az_tabs_render_cnt( ){

    global $post;
    $menuID = $post->ID;
    $menuOptns = get_post_custom( $menuID );

    //---Content START
    //echo abcfl_html_tag( 'div', 'abcfslVTCNCntCntrID', 'abcflVTabsCntCntr' ); 
    echo abcfl_html_tag( 'div', 'abcfslAZMenusOptns_CntCntrID', 'abcflVTabsCntCntr' ); 

        abcfsl_mbox_menu_layout( $menuOptns );
        abcfsl_mbox_menu_az_items( $menuID, $menuOptns );
        abcfsl_mbox_shortcode_menu( $menuID, 'AZM-', '3' );

    echo abcfl_html_tag_end( 'div' ); //---Content END
}