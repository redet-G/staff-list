<?php
function abcfsl_mbox_tplate_tabs(){

    $obj = ABCFSL_Main();
    $slug = $obj->pluginSlug;
    $pfix = $obj->prefix;

    global $post;
    $tplateID = $post->ID;
    $tplateOptns = get_post_custom( $tplateID );

    //$lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '0';
    //$layout = isset( $tplateOptns['_lstLayoutH'] ) ? esc_attr( $tplateOptns['_lstLayoutH'][0] ) : $lstLayout; 

    abcfsl_v_tabs_optns_cntr_start(); //---Manager START
        abcfsl_mbox_tplate_tabs_render_tabs_default();
        abcfsl_mbox_tplate_tabs_render_cnt_default(  $tplateID, $tplateOptns, $pfix, $slug );
    echo abcfl_html_tag_end( 'div' ); //---Manager END

    wp_nonce_field( $slug, $slug . '_nonce' );
}