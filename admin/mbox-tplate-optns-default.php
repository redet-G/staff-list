<?php
//=== TABS == L, A, B layouts ===============================
function abcfsl_mbox_tplate_optns_default_render_tabs(){
    
    echo abcfl_html_tag( 'ul', '', 'abcflVTabsNavCntr' );
        //staff_pg_layout
        echo abcfsl_v_tabs_render_optns_tab( 'CN1', abcfsl_txta(344), 'abcflVTabsTabActive' );
        //staff_pg_cntrs
        echo abcfsl_v_tabs_render_optns_tab( 'CN2', abcfsl_txta(345) );
        //img
        echo abcfsl_v_tabs_render_optns_tab( 'CN3', abcfsl_txta(228) );
        //spg_layout
        echo abcfsl_v_tabs_render_optns_tab( 'CN4', abcfsl_txta(346) );
        //spg_optns
        echo abcfsl_v_tabs_render_optns_tab( 'CN5', abcfsl_txta(347) );
        //icons_social
        echo abcfsl_v_tabs_render_optns_tab( 'CN6', abcfsl_txta(59) );
        //pgnt
        echo abcfsl_v_tabs_render_optns_tab( 'CN7', abcfsl_txta(100) );
        //field_order
        echo abcfsl_v_tabs_render_optns_tab( 'CN8', abcfsl_txta(64) );
        //field_order
        echo abcfsl_v_tabs_render_optns_tab( 'CN9', abcfsl_txta(348) );
        //staff_order
        echo abcfsl_v_tabs_render_optns_tab( 'CN10', abcfsl_txta(280) );
        //structured_data
        echo abcfsl_v_tabs_render_optns_tab( 'CN11', abcfsl_txta(58) );
        //shortcod  
        echo abcfsl_v_tabs_render_optns_tab( 'CN12', abcfsl_txta(170) );
        echo abcfl_html_tag_end( 'ul' );
}

//=== TABS CONTENT =============================================================
function abcfsl_mbox_tplate_optns_default_render_cnt(  $tplateID, $tplateOptns, $pfix, $slug ){

    echo abcfl_html_tag( 'div', 'abcfslVTCNCntCntrID', 'abcflVTabsCntCntr' ); //---Content START
        abcfsl_mbox_tplate_staff_pg_layout( $tplateOptns );
        abcfsl_mbox_tplate_staff_pg_cntrs( $tplateOptns, $pfix );
        abcfsl_mbox_tplate_img( $tplateOptns, $pfix );
        abcfsl_mbox_tplate_spg_layout( $tplateOptns, 100 );
        abcfsl_mbox_tplate_spg_optns( $tplateID, $tplateOptns, $slug );
        abcfsl_mbox_tplate_icons_social( $tplateOptns );
        abcfsl_mbox_tplate_pgnt( $tplateOptns );
        abcfsl_mbox_tplate_field_order( $tplateID, $tplateOptns, false, 'CN8' );
        abcfsl_mbox_tplate_field_order( $tplateID, $tplateOptns, true, 'CN9' );
        abcfsl_mbox_tplate_staff_order( $tplateID, $tplateOptns );
        abcfsl_mbox_tplate_structured_data( $tplateOptns );
        abcfsl_mbox_tplate_shortcode( $tplateID, $tplateOptns );
    echo abcfl_html_tag_end( 'div' ); //---Content END
}