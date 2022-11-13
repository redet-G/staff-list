<?php
function abcfsl_mbox_groups_tabs(){

    $obj = ABCFSL_Main();
    $slug = $obj->pluginSlug;
    $pfix = $obj->prefix;

    global $post;
    $postID = $post->ID;
    $grpOptns = get_post_custom( $postID );
    $grpType = isset( $grpOptns['_grpType'] ) ? $grpOptns['_grpType'][0] : '';    

    //---Manager START
    //abcfsl_v_tabs_optns_cntr_start();
    abcfsl_v_tabs_grp_optns_cntr_start();
    abcfsl_mbox_groups_tabs_render_nav_tabs();
    abcfsl_mbox_groups_tabs_render_cntr_start(); //---Manager END

        //GRPCAT GRPTXT GRPABC
        switch ( $grpType ) {
                case 'GRPCAT':                    
                    abcfsl_mbox_groups_layout( $grpOptns );
                    abcfsl_mbox_group_items( $postID, $grpOptns, $grpType );                                        
                    abcfsl_mbox_shortcode_group( $postID, $grpType );             
                    break;
                case 'GRPTXT':
                    abcfsl_mbox_groups_layout( $grpOptns );
                    abcfsl_mbox_group_items( $postID, $grpOptns, $grpType );                     
                    abcfsl_mbox_shortcode_group( $postID, $grpType ); 
                    break;
                case 'GRPABC':
                    abcfsl_mbox_groups_layout( $grpOptns );
                    abcfsl_mbox_group_items( $postID, $grpOptns, $grpType );
                    abcfsl_mbox_shortcode_group( $postID, $grpType ); 
                    break;                               
                default:
                    abcfsl_mbox_group_items( $postID, $grpOptns, $grpType );
                    break;
        }
        echo abcfl_html_tag_end( 'div' ); //---Manager END
        abcfsl_mbox_groups_tabs_render_cntr_end();

    wp_nonce_field( $slug, $slug . '_nonce' );
}

function abcfsl_mbox_groups_tabs_render_nav_tabs( ){

    echo abcfl_html_tag( 'ul', '', 'abcflVTabsNavCntr' );
        echo abcfsl_v_tabs_render_optns_tab( 'CN1', abcfsl_txta(13), 'abcflVTabsTabActive' );
        echo abcfsl_v_tabs_render_optns_tab( 'CN2', abcfsl_txta(45) );
        echo abcfsl_v_tabs_render_optns_tab( 'CN3', abcfsl_txta(3) );
    echo abcfl_html_tag_end( 'ul' );
}

function abcfsl_mbox_groups_tabs_render_cntr_start(){
     //---Content START
    //echo abcfl_html_tag( 'div', 'abcfslVTCNCntCntrID', 'abcflVTabsCntCntr' );
    echo abcfl_html_tag( 'div', 'abcfslGrpOptns_CntCntrID', 'abcflVTabsCntCntr' );
}

function abcfsl_mbox_groups_tabs_render_cntr_end(){
    echo abcfl_html_tag_end( 'div' ); //---Content END
}