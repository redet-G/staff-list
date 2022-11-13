<?php
function abcfsl_mbox_tplate_img( $tplateOptns, $clsPfix ){

  echo  abcfl_html_tag('div','CN3','inside hidden abcflFadeIn');

    $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '0';
    $lstLayoutH = isset( $tplateOptns['_lstLayoutH'] ) ? esc_attr( $tplateOptns['_lstLayoutH'][0] ) : $lstLayout;

    //==GRID C GRID D =====================================
    switch ( $lstLayoutH ) {
        case 4:
        case 5:    
            echo abcfl_html_tag_end('div');
            return;
    }

    //========================================================
    $lstImgCls = isset( $tplateOptns['_lstImgCls'] ) ? esc_attr( $tplateOptns['_lstImgCls'][0] ) : '';
    $lstImgStyle = isset( $tplateOptns['_lstImgStyle'] ) ? esc_attr( $tplateOptns['_lstImgStyle'][0] ) : '';

    //$overTxtT1, overTxtT2, $overFont1, $overFont2, $overTM
    $overTxtT1 = isset( $tplateOptns['_overTxtT1'] ) ? esc_attr( $tplateOptns['_overTxtT1'][0] ) : '';
    $overTxtT2 = isset( $tplateOptns['_overTxtT2'] ) ? esc_attr( $tplateOptns['_overTxtT2'][0] ) : '';
    $overFont1 = isset( $tplateOptns['_overFont1'] ) ? $tplateOptns['_overFont1'][0] : 'D';
    $overFont2 = isset( $tplateOptns['_overFont2'] ) ? $tplateOptns['_overFont2'][0] : 'D';
    $overTM = isset( $tplateOptns['_overTM'] ) ? $tplateOptns['_overTM'][0] : 'N';

    //Use the same image on SP
    $sPgDefaultImgUrl = isset( $tplateOptns['_sPgDefaultImgUrl'] ) ? $tplateOptns['_sPgDefaultImgUrl'][0] : '0';

    $parImgCntr['imgCntrMLR'] = isset( $tplateOptns['_imgCntrMLR'] ) ? $tplateOptns['_imgCntrMLR'][0] : '';
    $parImgCntr['imgBorder'] = isset( $tplateOptns['_imgBorder'] ) ? $tplateOptns['_imgBorder'][0] : 'D';
    $parImgCntr['imgHover'] = isset( $tplateOptns['_imgHover'] ) ? esc_attr( $tplateOptns['_imgHover'][0] ) : '';
    $parImgCntr['imgDS'] = isset( $tplateOptns['_imgDS'] ) ? esc_attr( $tplateOptns['_imgDS'][0] ) : '';
    $parImgCntr['imgCircle'] = isset( $tplateOptns['_imgCircle'] ) ? $tplateOptns['_imgCircle'][0] : '';
    $parImgCntr['imgAttr'] = isset( $tplateOptns['_imgAttr'] ) ? esc_attr( $tplateOptns['_imgAttr'][0] ) : '';

    $imgCenter = '';
    // lstLayoutH: 1=List; 2=Grid B; 3=Grid A; 4=GridC; 200=Grid AI; ; 201=Grid BI; 202=Grid CI; 203=List LI;
    switch ( $lstLayoutH ) {
        case 1:
        case 203:    
            abcfsl_mbox_tplate_img_cntr_top( $parImgCntr, 'tplate-img-cntr-list.png' );
            abcfsl_mbox_tplate_img_optns( $tplateOptns, $parImgCntr );
            abcfsl_mbox_tplate_img_sp_default( $sPgDefaultImgUrl );
            abcfsl_mbox_tplate_img_overlay_optns_NEW ( $tplateOptns );
            abcfsl_mbox_tplate_img_class_and_style( $tplateOptns );            
            abcfsl_mbox_tplate_pholder( $tplateOptns );  
            break;
        case 2:
        case 201:    
            abcfsl_mbox_tplate_img_cntr_top( $parImgCntr, 'tplate-img-cntr-grid-b.png' );
            abcfsl_mbox_tplate_img_optns( $tplateOptns, $parImgCntr );
            abcfsl_mbox_tplate_img_sp_default( $sPgDefaultImgUrl );
            abcfsl_mbox_tplate_img_overlay_optns_NEW ( $tplateOptns ); 
            abcfsl_mbox_tplate_img_class_and_style( $tplateOptns );
            abcfsl_mbox_tplate_pholder( $tplateOptns );           
            break;
        case 3:
        case 200:    
            abcfsl_mbox_tplate_img_cntr_top( $parImgCntr, 'tplate-img-cntr-grid-a.png' );
            abcfsl_mbox_tplate_img_optns( $tplateOptns, $parImgCntr );
            abcfsl_mbox_tplate_img_sp_default( $sPgDefaultImgUrl );
            abcfsl_mbox_tplate_img_overlay_optns_NEW ( $tplateOptns ); 
            abcfsl_mbox_tplate_img_class_and_style( $tplateOptns );
            abcfsl_mbox_tplate_pholder( $tplateOptns );         
            break;
        default:
            break;
    }
    echo abcfl_html_tag_end('div');
}

//==SP defaults ==========================================================
function abcfsl_mbox_tplate_img_sp_default( $sPgDefaultImgUrl ){
    echo abcfl_input_checkbox('sPgDefaultImgUrl',  '', $sPgDefaultImgUrl, abcfsl_txta(377), '', '', '', 'abcflFldCntr abcflMTop20', '', '', '' );
}    
//============================================================        

//===============================================================================
function abcfsl_mbox_tplate_img_overlay_optns( $overTxtT1, $overTxtT2, $overFont1, $overFont2, $overTM){

    echo abcfl_input_hline('2', '20');
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(273) . ' ' . abcfsl_txta(9), abcfsl_aurl(42) );

    $cboF = abcfsl_cbo_font_size();
    $cboTM = abcfsl_cbo_txt_overlay_padding_top();

    echo abcfl_input_txt( 'overTxtT1', '', $overTxtT1, abcfsl_txta(43)  . ' 1', '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    echo abcfl_input_cbo_strings('overFont1', '', $cboF, $overFont1, abcfsl_txta(47), abcfsl_txta(247), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_hline('1');
    echo abcfl_input_txt( 'overTxtT2', '', $overTxtT2,  abcfsl_txta(43) . ' 2', '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    echo abcfl_input_cbo_strings('overFont2', '', $cboF, $overFont2, abcfsl_txta(47), abcfsl_txta(247), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings('overTM', '', $cboTM, $overTM, abcfsl_txta(15), abcfsl_txta(0), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//== PLACEHOLDER START ===================================
function abcfsl_mbox_tplate_pholder( $tplateOptns ){

    $pImgDefault = isset( $tplateOptns['_pImgDefault'] ) ? $tplateOptns['_pImgDefault'][0] : '0';
    $pImgIDL = isset( $tplateOptns['_pImgIDL'] ) ? esc_attr( $tplateOptns['_pImgIDL'][0] ) : 0;
    $pImgIDS = isset( $tplateOptns['_pImgIDS'] ) ? esc_attr( $tplateOptns['_pImgIDS'][0] ) : 0;
    $pImgUrlL = isset( $tplateOptns['_pImgUrlL'] ) ? esc_attr( $tplateOptns['_pImgUrlL'][0] ) : '';
    $pImgUrlS = isset( $tplateOptns['_pImgUrlS'] ) ? esc_attr( $tplateOptns['_pImgUrlS'][0] ) : '';

    if( empty( $pImgUrlL ) ){ $pImgIDL = 0; }
    if( empty( $pImgUrlS ) ){ $pImgIDS = 0; }
    //======================================================

    echo abcfl_input_hline('2');
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(172), abcfsl_aurl(44) );

    echo abcfl_input_checkbox('pImgDefault',  '', $pImgDefault, abcfsl_txta(173), '', '', '', 'abcflFldCntr', '', '', '' );

    //-- Custom Placeholders ------------------------------------------------
    echo abcfl_input_hline('1');
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(177), abcfsl_aurl(0) );

    //-- Image: Staff Page ------------------------------------------------
    echo abcfl_html_img_tag('', $pImgUrlL, '', '', 100, '', 'abcflMTop15');

    //-- imgUrlL itemImgUrl -----------------------------------------------
    echo abcfl_html_tag_cls('div', 'abcflFloatsCntr');
    echo abcfl_input_txt('pImgUrlL', '', $pImgUrlL, abcfsl_txta(68) . ' ' . abcfsl_txta(312), '', '100%', '', '', 'abcflFloatL abcflWidth89Pc', 'abcflFldLbl');
    echo abcfl_input_txt_dr('readonly', true, 'pImgIDL', '', $pImgIDL, abcfsl_txta(35), '', '100%', '', '', 'abcflFloatL abcflWidth10Pc', 'abcflFldLbl');
    echo abcfl_html_tag_cls('div', 'abcflClr', true);
    echo abcfl_html_tag_end('div');

    echo  abcfl_html_tag('div','','abcflPTop10');
        echo abcfl_input_btn('btnPImgL', 'btnPImgL', 'button',  abcfsl_txta(263), 'button' );
    echo abcfl_html_tag_end('div');

    //-- Image: Single Page ------------------------------------------------
    echo abcfl_html_img_tag('', $pImgUrlS, '', '', 100, '', 'abcflMTop15');

    echo abcfl_html_tag_cls('div', 'abcflFloatsCntr');
    echo abcfl_input_txt('pImgUrlS', '', $pImgUrlS, abcfsl_txta(69) . ' ' . abcfsl_txta(312), '', '100%', '', '', 'abcflFloatL abcflWidth90Pc', 'abcflFldLbl');
    echo abcfl_input_txt_dr('readonly', true, 'pImgIDS', '', $pImgIDS, abcfsl_txta(35), '', '100%', '', '', 'abcflFloatL abcflWidth10Pc', 'abcflFldLbl');
    echo abcfl_html_tag_cls('div', 'abcflClr', true);
    echo abcfl_html_tag_end('div');

    echo  abcfl_html_tag('div','','abcflPTop10');
        echo abcfl_input_btn('btnPImgS', 'btnPImgS', 'button',  abcfsl_txta(263), 'button' );
    echo abcfl_html_tag_end('div');
}

//-- PLACEHOLDER END ---------------------------------------
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function abcfsl_mbox_tplate_img_cntr_top( $parImgCntr, $icon ){ 
    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL , $icon, abcfsl_txta(2), '', abcfsl_aurl(43) );
}

//Image Style.
function abcfsl_mbox_tplate_img_optns( $tplateOptns, $parImgCntr ){  

    $par['fieldID1'] = 'imgCntrMLR'; 
    $par['fieldID2'] = 'imgBorder';
    $par['cbo1'] = abcfsl_cbo_img_margin_lr();
    $par['cbo2'] = abcfsl_cbo_img_border();
    $par['lbl1'] = 197; 
    $par['lbl2'] = 40; 
    $par['hlp1'] = 0; 
    $par['hlp2'] = 228; 
    $par['url1'] = 69;
    $par['url2'] = 88; 
    $par['hlpTxt'] = 0;
    $par['hlpTxtR'] = false;
    $par['showHdr'] = false;
    $par['hlineShow'] = false;
    $par['hlineWidthBT'] = 0;

    abcfsl_autil_two_dropdowns( $tplateOptns, $par );

    //---------------------------------------------------
    $par['fieldID1'] = 'imgHover';
    $par['fieldID2'] = 'imgDS';    
    $par['cbo2'] = abcfsl_cbo_drop_shadow();
    $par['cbo1'] = abcfsl_cbo_hover();
    $par['lbl2'] = 246; 
    $par['lbl1'] = 265; 
    $par['hlp1'] = 0; 
    $par['hlp2'] = 0;    
    $par['url1'] = 62;
    $par['url2'] = 70;  
    $par['hlpTxt'] = 0;
    $par['hlpTxtR'] = false;
    $par['showHdr'] = false;
    $par['hlineShow'] = false;
    $par['hlineWidthBT'] = 0;

    abcfsl_autil_two_dropdowns( $tplateOptns, $par );

    //---------------------------------------------------
    $par['fieldID1'] = 'imgCircle';
    $par['fieldID2'] = 'imgAttr';
    $par['cbo1'] = abcfsl_cbo_img_circle();
    $par['lbl1'] = 175; 
    $par['lbl2'] = 438; 
    $par['hlp1'] = 0; 
    $par['hlp2'] = 0; 
    $par['url1'] = 40; 
    $par['url2'] = 83; 
    $par['hlpTxt'] = 0;
    $par['hlpTxtR'] = false;
    $par['showHdr'] = false;
    $par['hlineShow'] = false;
    $par['hlineWidthBT'] = 0;
    //$par['txtDropdown'] = true;

    abcfsl_autil_dropdown_txt( $tplateOptns, $par );
}

function abcfsl_mbox_tplate_img_overlay_optns_NEW( $tplateOptns ){

    $cboF = abcfsl_cbo_font_size();
    $cboTM = abcfsl_cbo_txt_overlay_padding_top();
    $overTM = isset( $tplateOptns['_overTM'] ) ? $tplateOptns['_overTM'][0] : 'N';

    $par['fieldID1'] = 'overFont1';
    $par['fieldID2'] = 'overTxtT1';
    $par['cbo1'] = $cboF;
    $par['lbl1'] = 47; 
    $par['lbl2'] = 354; 
    $par['hlp1'] = 247; 
    $par['hlp2'] = 0; 
    $par['url1'] = 0; 
    $par['url2'] = 0; 
    $par['hlpTxt'] = 0;
    $par['hlpTxtR'] = false;

    $par['hdrLbl'] = 353; 
    $par['hdrURL'] = 42;
    $par['showHdr'] = true;
    $par['hlineShow'] = true;
    $par['hlineWidthBT'] = 2;
    $par['txtDropdown'] = true;

    abcfsl_autil_dropdown_txt( $tplateOptns, $par );

    $par2['fieldID1'] = 'overFont2';
    $par2['fieldID2'] = 'overTxtT2';
    $par2['cbo1'] = $cboF;
    $par2['lbl1'] = 47; 
    $par2['lbl2'] = 355; 
    $par2['hlp1'] = 247; 
    $par2['hlp2'] = 0; 
    $par2['url1'] = 0; 
    $par2['url2'] = 0; 
    $par2['hlpTxt'] = 0;
    $par2['hlpTxtR'] = false;
    $par2['showHdr'] = false;
    $par2['hlineShow'] = false;
    $par2['hlineWidthBT'] = 0;
    $par2['txtDropdown'] = true;

    abcfsl_autil_dropdown_txt( $tplateOptns, $par2 );

    echo abcfl_input_cbo_strings('overTM', '', $cboTM, $overTM, abcfsl_txta(356), '', '50%', '', '', 'abcflFldCntr abcflMTop2', 'abcflFldLbl');
}

function abcfsl_mbox_tplate_img_class_and_style( $tplateOptns ) {

    //abcfsl_mbox_tplate_staff_pg_layout_class_and_style( $tplateOptns, 'lstImgCls', 'lstImgStyle', 2 );

    $par['fieldIDCustCls'] = 'lstImgCls';
    $par['fieldIDCustStyle'] = 'lstImgStyle';
    $par['fCustCls'] = 'lstImgCls';
    $par['fCustStyle'] = 'lstImgStyle';
    $par['urlCls'] = 2; 
    $par['urlStyle'] = 24; 
    $par['showHdr'] = false;
    $par['hlineShow'] = true;
    $par['hlineWidthBT'] = 2;

    abcfsl_autil_custom_class_and_style( $tplateOptns, $par );
}
//### DEPRECATED ????? ###############################################
//== IMAGE STYLE  START ==============================================================
// Image Style. Multiple parameters replaced with array. 
function abcfsl_mbox_tplate_img_img_cntr_par( $imgPar ){

    $defaults['imgCntrMLR'] = '';
    $defaults['imgBorder'] = '';
    $defaults['icon'] = '';;
    $defaults['imgHover'] = ''; 
    $defaults['imgDS'] = '';
    $defaults['imgCircle'] = '';
    $par = array_merge( $defaults, $imgPar );

    $imgCntrMLR = $imgPar['imgCntrMLR'];
    $imgBorder = $imgPar['imgBorder']; 
    $icon = $imgPar['icon']; 
    $imgHover = $imgPar['imgHover']; 
    $imgDS = $imgPar['imgDS']; 
    $imgCircle = $imgPar['imgCircle'];
    
    $cboImgBorder = abcfsl_cbo_img_border();
    $cboImgMarginLR = abcfsl_cbo_img_margin_lr();

    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL , $icon, abcfsl_txta(2), '', abcfsl_aurl(41) );

    $lblImgLR = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(197), abcfsl_aurl(65), 'abcflFontWP abcflFontS13 abcflFontW400' );

    echo abcfl_input_cbo_strings('imgCntrMLR', '', $cboImgMarginLR, $imgCntrMLR, $lblImgLR, '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings('imgBorder', '', $cboImgBorder, $imgBorder, abcfsl_txta(40), abcfsl_txta(228), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    abcfsl_mbox_tplate_img_drop_shadow( $imgDS );
    abcfsl_mbox_tplate_img_img_hover( $imgHover );
    abcfsl_mbox_tplate_img_circle( $imgCircle );
}

//Image Style.
function abcfsl_mbox_tplate_img_img_cntr( $parImgCntr, $icon ){    

    $cboImgBorder = abcfsl_cbo_img_border();
    $cboImgMarginLR = abcfsl_cbo_img_margin_lr();

    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL , $icon, abcfsl_txta(2), '', abcfsl_aurl(41) );
    $lblImgLR = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(197), abcfsl_aurl(65), 'abcflFontWP abcflFontS13 abcflFontW400' );

    echo abcfl_input_cbo_strings('imgCntrMLR', '', $cboImgMarginLR, $parImgCntr['imgCntrMLR'], $lblImgLR, '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings('imgBorder', '', $cboImgBorder, $parImgCntr['imgBorder'], abcfsl_txta(40), abcfsl_txta(228), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    abcfsl_mbox_tplate_img_drop_shadow( $parImgCntr['imgDS'] );

    // HOVER ANIMATIONS
    abcfsl_mbox_tplate_img_img_hover( $parImgCntr['imgHover'] );
    abcfsl_mbox_tplate_img_circle( $parImgCntr['imgCircle'] );

    $lblAttr = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(438), abcfsl_aurl(83), 'abcflFontWP abcflFontS13 abcflFontW400' );
    echo abcfl_input_txt( 'imgAttr', '', $parImgCntr['imgAttr'],  $lblAttr, '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
}

function abcfsl_mbox_tplate_img_circle( $imgCircle ){
    $lbl = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(175), abcfsl_aurl(40), 'abcflFontWP abcflFontS13 abcflFontW400' );
    $cboCircle = abcfsl_cbo_img_circle();
    echo abcfl_input_cbo('imgCircle', '', $cboCircle, $imgCircle, $lbl, '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfsl_mbox_tplate_img_img_hover( $imgHover ){
    $lbl = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(265), abcfsl_aurl(62), 'abcflFontWP abcflFontS13 abcflFontW400' );
    $cboHover = abcfsl_cbo_hover();
    echo abcfl_input_cbo('imgHover', '', $cboHover, $imgHover, $lbl, '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfsl_mbox_tplate_img_drop_shadow( $imgDS ){
    $cboDS = abcfsl_cbo_drop_shadow();
    echo abcfl_input_cbo('imgDS', '', $cboDS, $imgDS, abcfsl_txta(246), abcfsl_txta(0), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}
//== IMAGE STYLE END  ===========================================