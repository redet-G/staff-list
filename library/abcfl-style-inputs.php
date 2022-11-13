<?php
/**
 * Style section Input builders
 * Version 001
 */

 // 323 Custom CSS Class
 // 289 Custom Inline Style
 // 139 Field Style
 // 14 hdrURL

 function abcfl_style_inputs_txt_id( $lbl, $suffix='' ) {

    $txtID = 0;
    switch ( $lbl ){ 
        case 'cust_cls':
            $txtID = 323;
            break;
        case 'cust_style':
            $txtID = 289;
            break;
        case 'field_style':
            $txtID = 139;
            break; 
        case 'help_cls':
            $txtID = 223;
            break; 
        case 'help_style':
            $txtID = 224;
            break;                        
        default:
            break;       
    }
    if( !empty( $suffix) ) { $txtID = $txtID . ',' . $suffix; }
    return $txtID;
 }

//Section Field Style.
function abcfl_style_inputs_bldr( $tplateOptns, $par ) {

    $defaults['fTag'] = 'tagType';
    $defaults['fFont'] = 'tagFont';
    $defaults['fMarginT'] = 'tagMarginT';
    $defaults['showCustCSS'] = 1;
    $defaults['hlineShow'] = true;
    $defaults['showHdr'] = true;
    $defaults['F'] = '';

    $par = array_merge( $defaults, $par );

    //echo"<pre>", print_r( $par, true ), "</pre>";
    //-----------------------------------------------
    $F = $par['F'];
    if( !empty( $F ) ) {
        $par['fTag'] = $par['fTag'] . '_' . $F;
        $par['fFont'] = $par['fFont'] . '_' . $F;
        $par['fMarginT'] = $par['fMarginT'] . '_' . $F;
    }
    //------------------------------------------------
    $flexCntr = abcfl_html_tag( 'div', '', 'abcflFGCntr abcflFGCntr50' );
    $flex2ColS = abcfl_html_tag( 'div', '', 'abcflFG2Col' );   
    $divE = abcfl_html_tag_end( 'div'); 
    //------------------------------------------------
    $dataTag = isset( $tplateOptns['_' . $par['fTag']] ) ? $tplateOptns['_' . $par['fTag']][0] : 'div';
    $dataFont = isset( $tplateOptns['_' . $par['fFont']] ) ? $tplateOptns['_' . $par['fFont']][0] : '';
    $dataMarginT = isset( $tplateOptns['_' . $par['fMarginT']] ) ? $tplateOptns['_' . $par['fMarginT']][0] : '';

    $cboTag = abcfsl_cbo_tag_type();
    $cboFont = abcfsl_cbo_font_size();
    $cboMarginT  = abcfsl_cbo_txt_margin_top();

    $fieldTag = abcfl_input_cbo( $par['fTag'], '', $cboTag, $dataTag, abcfsl_txta(287), abcfsl_txta(279), '100%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    $fieldFont = abcfl_input_cbo_strings( $par['fFont'], '', $cboFont, $dataFont, abcfsl_txta(47), abcfsl_txta(247), '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    
    //==  Render inputs  =====================
    abcfl_style_inputs_hline( $par );
    abcfl_style_inputs_hdr( $par );
    //----------------------------------------
    echo $flexCntr . $flex2ColS . $fieldTag . $divE . $flex2ColS . $fieldFont . abcfl_html_tag_ends( 'div,div' );
    echo abcfl_input_cbo_strings( $par['fMarginT'], '', $cboMarginT, $dataMarginT, abcfsl_txta(15), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    //No custom CSS header when CSS added to field style options.
    $par['hlineShow'] = false;
    $par['showHdr'] = false;
    
    switch ( $par['showCustCSS'] ){ 
        case 1:
            abcfl_style_inputs_cls_style( $tplateOptns, $par );
            break;
        case 2:
            abcfl_style_inputs_cls( $tplateOptns, $par );
            break;
        case 3:
            abcfl_style_inputs_style( $tplateOptns, $par );
            break; 
        default:
            break;       
    }
}

//Custom class & style 2 columns. Can have header and hline.
function abcfl_style_inputs_cls_style( $tplateOptns, $par ){        

    $defaults['fCustCls'] = 'tagCls';
    $defaults['fCustStyle'] = 'tagStyle';
    $defaults['lblCls'] = abcfl_style_inputs_txt_id( 'cust_cls' ); //323;
    $defaults['lblStyle'] = abcfl_style_inputs_txt_id( 'cust_style' ); //289;
    $defaults['hlpCls'] = 0; // 223
    $defaults['hlpStyle'] = 0; // 224
    $defaults['urlCls'] = 0; //2
    $defaults['urlStyle'] = 0; //24
    $defaults['hlpTxt'] = 0;
    $defaults['hlpTxtR'] = false;
    $defaults['F'] = '';
    
    $par = array_merge( $defaults, $par );
    //-------------------------------------------------------
    $F = $par['F'];
    if( !empty( $F ) ) {
        $par['fCustCls'] = $par['fCustCls'] . '_' . $F;
        $par['fCustStyle'] = $par['fCustStyle'] . '_' . $F;
    }
    //-----------------------------------------------------
    $helpClasses = 'abcflFontWP abcflFontS13 abcflFontW400';
    $lblClsTxt = abcfsl_txta( $par['lblCls'] );
    $lblStyleTxt = abcfsl_txta( $par['lblStyle'] );
    $hlpClsTxt = +( $par['hlpCls'] );
    $hlpStyleTxt = abcfsl_txta( $par['hlpStyle'] );

    $urlCls = abcfslub_aurl( $par['urlCls'] );
    $urlStyle = abcfslub_aurl( $par['urlStyle'] );

    if( $par['urlCls'] > 0 ) {
        $lblClsTxt = abcfl_input_sec_title_hlp( ABCFSLUB_ICONS_URL, $lblClsTxt, $urlCls, $helpClasses );

        if( $par['urlStyle'] == 0 ) {
            $lblStyleTxt = abcfl_input_sec_title_hlp_blank( ABCFSLUB_ICONS_URL, $lblStyleTxt, $helpClasses );
        }
    }

    if( $par['urlStyle'] > 0 ) {
        $lblStyleTxt = abcfl_input_sec_title_hlp( ABCFSLUB_ICONS_URL, $lblStyleTxt, $urlStyle, $helpClasses );

        if( $par['urlCls'] == 0 ) {
            $lblClsTxt = abcfl_input_sec_title_hlp_blank( ABCFSLUB_ICONS_URL, $lblClsTxt, $helpClasses );
        }
    }
    //---------------------------------------
    $dataCls = isset( $tplateOptns['_' . $par['fCustCls']] ) ? esc_attr( $tplateOptns['_' . $par['fCustCls']][0] ) : ''; 
    $dataStyle = isset( $tplateOptns['_' . $par['fCustStyle']] ) ? esc_attr( $tplateOptns['_' . $par['fCustStyle']][0] ) : '';
    //------------------------------------------------------------
    $inputClass = abcfl_input_txt( $par['fCustCls'], '', $dataCls, $lblClsTxt,  $hlpClsTxt, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    $inputStyle = abcfl_input_txt( $par['fCustStyle'], '', $dataStyle,  $lblStyleTxt, $hlpStyleTxt, '100%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    //------------------------------------------------------------
    $flexCntr = abcfl_html_tag( 'div', '', 'abcflFGCntr abcflFGCntr50' );
    $flex2ColS = abcfl_html_tag( 'div', '', 'abcflFG2Col' );   
    $divE = abcfl_html_tag_end( 'div');
    
    //===============================================
    abcfl_style_inputs_hline( $par ); 
    abcfl_style_inputs_hdr( $par );

    echo $flexCntr . $flex2ColS . $inputClass . $divE . $flex2ColS . $inputStyle . abcfl_html_tag_ends( 'div,div' );

    if( !empty( $par['hlpTxt'] ) ) {
        $lblTxt = abcfsl_txta( $par['hlpTxt'] );
        if( $par['hlpTxtR'] ) { $lblTxt = abcfslub_txta_r( $par['hlpTxt'] ); }
        echo abcfl_input_info_lbl( $lblTxt, 'abcflMTop5', 12 );
    }
}

//Custom class. Can have header and hline.
function abcfl_style_inputs_cls( $tplateOptns, $par ){    

    $defaults['fCustCls'] = 'tagCls';
    $defaults['lblCls'] = abcfl_style_inputs_txt_id( 'cust_cls' );
    $defaults['hlpCls'] = 0;
    $defaults['urlCls'] = 0; 
    $defaults['F'] = '';

    $par = array_merge( $defaults, $par );
    //-------------------------------------------------------
    $F = $par['F'];
    if( !empty( $F ) ) { 
        $par['fCustCls'] = $par['fCustCls'] . '_' . $F; 
    }

    $lblClsTxt = abcfsl_txta( $par['lblCls'] );
    $hlpClsTxt = abcfsl_txta( $par['hlpCls'] );
    $urlCls = abcfslub_aurl( $par['urlCls'] );

    if( $par['urlCls'] > 0 ) { 
        $lblClsTxt = abcfl_input_sec_title_hlp( ABCFSLUB_ICONS_URL, $lblClsTxt, $urlCls, 'abcflFontWP abcflFontS13 abcflFontW400' ); 
    }
    //---------------------------------------
    $dataCls = isset( $tplateOptns['_' . $par['fCustCls']] ) ? esc_attr( $tplateOptns['_' . $par['fCustCls']][0] ) : ''; 

    //=======================================
    abcfl_style_inputs_hline( $par ); 
    abcfl_style_inputs_hdr( $par );
    echo abcfl_input_txt( $par['fCustCls'], '', $dataCls, $lblClsTxt,  $hlpClsTxt, '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
}

//Custom style. Can have header and hline.
function abcfl_style_inputs_style( $tplateOptns, $par ){    

    $defaults['fCustStyle'] = 'tagStyle';
    $defaults['lblStyle'] = abcfl_style_inputs_txt_id( 'cust_style' );
    $defaults['hlpStyle'] = 0;
    $defaults['urlStyle'] = 0;
    $defaults['F'] = '';

    $par = array_merge( $defaults, $par );
    //-------------------------------------------------------
    $F = $par['F'];
    if( !empty( $F ) ) { $par['fCustStyle'] = $par['fCustStyle'] . '_' . $F; }

    $lblStyleTxt = abcfsl_txta( $par['lblStyle'] );
    $hlpStyleTxt = abcfsl_txta( $par['hlpStyle'] );    
    $urlStyle = abcfslub_aurl( $par['urlStyle'] );

    if( $par['urlStyle'] > 0 ) { 
        $lblStyleTxt = abcfl_input_sec_title_hlp( ABCFSLUB_ICONS_URL, $lblStyleTxt, $urlStyle, 'abcflFontWP abcflFontS13 abcflFontW400' ); 
    }
    //---------------------------------------
    $dataStyle = isset( $tplateOptns['_' . $par['fCustStyle']] ) ? esc_attr( $tplateOptns['_' . $par['fCustStyle']][0] ) : ''; 

    //===================================
    abcfl_style_inputs_hline( $par ); 
    abcfl_style_inputs_hdr( $par );
    echo abcfl_input_txt( $par['fCustStyle'], '', $dataStyle, $lblStyleTxt, $hlpStyleTxt, '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
}

function abcfl_style_inputs_hdr( $par ){

    $defaults['hdrLbl'] = abcfl_style_inputs_txt_id( 'field_style' ); //139;
    $defaults['hdrURL'] = 14;
    $defaults['showHdr'] = true;
    $defaults['lblUB'] = false;
    $defaults['urlUB'] = false;
    $defaults['infoLblUB'] = false;
    $defaults['hdrCustCls'] = '';
    $defaults['hdrInfoLbl'] = 0;

    $par = array_merge( $defaults, $par );

    if( !$par['showHdr'] ) { return '';}
    //-----------------------------------
    $lbl = abcfsl_txta( $par['hdrLbl'] );

    //?????????????????????????????????????????????
    //if( $par['lblUB']) { $lbl = abcfsl_txta( $par['hdrLbl'] ); }
    if( $par['lblUB']) { $lbl = abcfsl_txta( $par['hdrLbl'] ); }

    $url = abcfslub_aurl( $par['hdrURL'] );
    if( $par['urlUB']) { $url = abcfslub_aurl( $par['hdrURL'] ); }

    $clsCust = $par['hdrCustCls'];

    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, $lbl, $url, $clsCust );

    if( $par['hdrInfoLbl'] > 0 ) { 
        $lblTxt =  abcfsl_txta( $par['hdrInfoLbl'] );        
        if( $par['infoLblUB'] ) { $lblTxt = abcfsl_txta( $par['hdrInfoLbl'] ); }
        echo abcfl_input_info_lbl( abcfsl_txta( $lblTxt ), 'abcflMTop5', '14') ;
    }    
}

//Display horizontal line.
function abcfl_style_inputs_hline( $par ){

    $defaults['hlineShow'] = true;
    $defaults['hlineWidthBT'] = 2;
    $defaults['hlineMarginT'] = 20;
    $defaults['hlineColor'] = '';
    $defaults['hlineCustomCls'] = '';
    $par = array_merge( $defaults, $par );

    if( $par['hlineShow'] ) { echo abcfl_input_hline( $par['hlineWidthBT'], $par['hlineMarginT'] ); }    
}