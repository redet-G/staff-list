<?php
// Template Options, navigation tabs container.
function abcfsl_v_tabs_optns_cntr_start(){
    echo abcfl_html_tag( 'div', 'abcfslVTCNWrapID', 'abcflVTabsMgr' );
}

// F fields, navigation tabs container.
function abcfsl_v_tabs_fields_wrap_start(){
    echo abcfl_html_tag( 'div', 'abcfslVTFWrapID', 'abcflVTabsMgr' );
}

function abcfsl_v_tabs_grp_optns_cntr_start(){
    echo abcfl_html_tag( 'div', 'abcfslGrpOptns_VTabsCntrID', 'abcflVTabsMgr' );
}

function abcfsl_v_tabs_mtf_optns_cntr_start(){
    echo abcfl_html_tag( 'div', 'abcfslMTFOptns_VTabsCntrID', 'abcflVTabsMgr' );
}

function abcfsl_v_tabs_cat_menus_cntr_start(){
    echo abcfl_html_tag( 'div', 'abcfslCatMenusOptns_VTabsCntrID', 'abcflVTabsMgr' );
}

function abcfsl_v_tabs_az_menus_cntr_start(){
    echo abcfl_html_tag( 'div', 'abcfslAZMenusOptns_VTabsCntrID', 'abcflVTabsMgr' );
}
//========================================================================

//F field tab (LI). 
function abcfsl_v_tabs_render_field_tab( $tplateOptns, $fieldNo ){

    $liCls = '';
    if( $fieldNo == 1 ) { $liCls = 'abcflVTabsTabActive'; }

    //LI ID
    $fieldNo = 'F' . $fieldNo;
    $fieldLbl =  abcfsl_v_tabs_f_fields_lbl( $tplateOptns, $fieldNo );

    $out = abcfl_html_tag( 'li', $fieldNo, $liCls );
        $out .= abcfl_html_a_tag( '#', $fieldLbl, '', '' );
    $out .= abcfl_html_tag_end( 'li' );
    
    return $out;
}

//Replacement for abcfsl_v_tabs_render_nav_tab
function abcfsl_v_tabs_render_optns_tab( $fieldNo, $fieldLbl, $liCls='' ){

    $out = abcfl_html_tag( 'li', $fieldNo, $liCls );
        $out .= abcfl_html_a_tag( '#', $fieldLbl, '', '' );
    $out .= abcfl_html_tag_end( 'li' );
    
    return $out;
}

// Input fields sidebar.
function abcfsl_v_tabs_f_fields_lbl( $tplateOptns, $F ){

    $lbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : ''; 
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_imgUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_imgUrlLbl_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_lnkLblLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkLblLbl_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_lnkUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlLbl_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_inputLblP1_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP1_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_inputLblP2_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP2_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_inputLblP3_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP3_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_inputLblP4_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP4_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : ''; }

    $fieldTypeH = isset( $tplateOptns['_fieldTypeH_' . $F] ) ? esc_attr( $tplateOptns['_fieldTypeH_' . $F][0] ) : 'N';
    if( $fieldTypeH == 'QRIMGCAP64STA' || $fieldTypeH == 'QRIMGCAP64DYN' ) { $lbl = ''; }

    if( empty( $lbl ) ) {
        //if ( $fieldTypeH == 'N' ||  $fieldTypeH == 'SH' ){ return $F; }
        if ( $fieldTypeH == 'N' ){ return $F; }
        $cboFieldType = abcfsl_cbo_field_type();
        $lbl = $cboFieldType[$fieldTypeH];
    }
    return $F . '.&nbsp;' . $lbl;
}

//########################## OLDER FUNCTIONS DEPRECATED ??????????? ##################################
function abcfsl_v_tabs_manager_div_s( $mgrID ){

    //---Manager START
    echo abcfl_html_tag( 'div', 'abcfsl_VTabsMgr_' . $mgrID, 'abcflVTabsMgr' );
    //abcfl_html_tag_cls('div', 'abcflClr', true);
}

// Older version used for multifilter and groups
function abcfsl_v_tabs_render_nav_tab( $cls, $lbl1, $lbl2='', $url='#'){

    $lbl1 = abcfl_html_tag_with_content( $lbl1, 'span', '');
    $lbl2 = abcfl_html_tag_with_content( $lbl2, 'span', '');

    $lbl = trim( $lbl1 . ' ' . $lbl2 );

    $out = abcfl_html_tag( 'li', '', $cls );
        $out .= abcfl_html_a_tag( $url, $lbl, '', '' );
    $out .= abcfl_html_tag_end( 'li' );

    return $out;
}

//Used for F fields tabs
function abcfsl_v_tabs_tab_builder( $tplateOptns, $fieldNo ){    
    return abcfsl_v_tabs_render_nav_tab_field( '', abcfsl_mbox_tplate_fields_lbl( $tplateOptns, 'F' . $fieldNo ) );
}

function abcfsl_v_tabs_render_nav_tab_field( $cls, $lbl1, $lbl2='', $url='#'){

    //<li class="nav-item"><a href="#sectionA" class="nav-link active" data-toggle="tab">Section A</a></li>
    //<li class="abcflVTabsTabActive"><a href="#"><span>F1&nbsp;&nbsp;Name</span></a></li>
    //<li><a href="#"><span>F3&nbsp;&nbsp;Department:</span></a></li>

    //abcfl_html_a_tag( $href, $lnkTxt, $target='', $cls='',      $style='', $spanStyle='', $blankTag=true, $onclickJS='', $args='' )

    $lbl1 = abcfl_html_tag_with_content( $lbl1, 'span', '');
    $lbl2 = abcfl_html_tag_with_content( $lbl2, 'span', '');

    $lbl = trim( $lbl1 . ' ' . $lbl2 );

    $out = abcfl_html_tag( 'li', '', $cls );
        $out .= abcfl_html_a_tag( $url, $lbl, '', '', '', '', true, '', 'data-toggle="tab"');
    $out .= abcfl_html_tag_end( 'li' );
    return $out;
}

