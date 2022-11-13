<?php
//Field options for a single field F+P
function abcfsl_mbox_tplate_field( $tplateOptns, $F ){

    if( $F == 'F1' ) { 
        echo  abcfl_html_tag('div',$F ,'inside'); 
    }
    else { 
        echo  abcfl_html_tag( 'div',$F ,'inside hidden abcflFadeIn' ); 
    }  

    $fieldType = isset( $tplateOptns['_fieldType_' . $F] ) ? $tplateOptns['_fieldType_' . $F][0] : 'N';
    $fieldTypeH = isset( $tplateOptns['_fieldTypeH_' . $F] ) ? $tplateOptns['_fieldTypeH_' . $F][0] : $fieldType;

    //-- Field type not selected. Display only Add New Field cbo -----------------------
    if ( $fieldTypeH == 'N' ){
        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL,  $F,'', 'abcflFontWP abcflFontS20 abcflFontW600 abcflMTop10 abcflBlue' );
        abcfsl_mbox_tplate_field_add_field_cbo( $fieldTypeH, $F );
        echo abcfl_html_tag_end('div');
        return;
    }

    //?????????????????????
    $showField = isset( $tplateOptns['_showField_' . $F] ) ? esc_attr( $tplateOptns['_showField_' . $F][0] ) : 'L';
    $hideDelete = isset( $tplateOptns['_hideDelete_' . $F] ) ? esc_attr( $tplateOptns['_hideDelete_' . $F][0] ) : 'N';
    $fieldLocked = isset( $tplateOptns['_fieldLocked_' . $F] ) ? esc_attr( $tplateOptns['_fieldLocked_' . $F][0] ) : '0';
    $showAsTxt = isset( $tplateOptns['_showAsTxt_' . $F] ) ? esc_attr( $tplateOptns['_showAsTxt_' . $F][0] ) : '0';

    $noAutop = isset( $tplateOptns['_noAutop_' . $F] ) ? $tplateOptns['_noAutop_' . $F][0] : '0';

    //Line container
    $tagType = isset( $tplateOptns['_tagType_' . $F] ) ? esc_attr( $tplateOptns['_tagType_' . $F][0] ) : 'div';
    $tagFont = isset( $tplateOptns['_tagFont_' . $F] ) ? esc_attr( $tplateOptns['_tagFont_' . $F][0] ) : 'D';
    $tagMarginT = isset( $tplateOptns['_tagMarginT_' . $F] ) ? esc_attr( $tplateOptns['_tagMarginT_' . $F][0] ) : 'N';
    $captionMarginT = isset( $tplateOptns['_captionMarginT_' . $F] ) ? esc_attr( $tplateOptns['_captionMarginT_' . $F][0] ) : '';
    
    $tagCls = isset( $tplateOptns['_tagCls_' . $F] ) ? esc_attr( $tplateOptns['_tagCls_' . $F][0] ) : '';
    $tagStyle = isset( $tplateOptns['_tagStyle_' . $F] ) ? esc_attr( $tplateOptns['_tagStyle_' . $F][0] ) : '';

    $fieldCntrSPg = isset( $tplateOptns['_fieldCntrSPg_' . $F] ) ? esc_attr( $tplateOptns['_fieldCntrSPg_' . $F][0] ) : 'M';
    $tagTypeSPg = isset( $tplateOptns['_tagTypeSPg_' . $F] ) ? esc_attr( $tplateOptns['_tagTypeSPg_' . $F][0] ) : '';
    $tagFontSPg = isset( $tplateOptns['_tagFontSPg_' . $F] ) ? esc_attr( $tplateOptns['_tagFontSPg_' . $F][0] ) : '';
    $tagMarginTSPg = isset( $tplateOptns['_tagMarginTSPg_' . $F] ) ? esc_attr( $tplateOptns['_tagMarginTSPg_' . $F][0] ) : '';
    $captionMarginTSPg = isset( $tplateOptns['_captionMarginTSPg_' . $F] ) ? $tplateOptns['_captionMarginTSPg_' . $F][0] : '';

    $dtFormat = isset( $tplateOptns['_dtFormat_' . $F] ) ? $tplateOptns['_dtFormat_' . $F][0] : '';
    //Static Label
    $lblTxt = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '';   
    //STXT Static text field type.
    $statTxt  = isset( $tplateOptns['_statTxt_' . $F] ) ? esc_attr( $tplateOptns['_statTxt_' . $F][0] ) : '';
    //Comma delimited list of fields linked to static text field.
    $statTxtFs  = isset( $tplateOptns['_statTxtFs_' . $F] ) ? esc_attr( $tplateOptns['_statTxtFs_' . $F][0] ) : '';

    $lnkNT = isset( $tplateOptns['_lnkNT_' . $F] ) ? $tplateOptns['_lnkNT_' . $F][0] : '0';
    $lnkDload = isset( $tplateOptns['_lnkDload_' . $F] ) ? $tplateOptns['_lnkDload_' . $F][0] : '0';

    $cbomQty  = isset( $tplateOptns['_cbomQty_' . $F] ) ? $tplateOptns['_cbomQty_' . $F][0] : '1';
    $cbomSort  = isset( $tplateOptns['_cbomSort_' . $F] ) ? $tplateOptns['_cbomSort_' . $F][0] : 'N';
    $cbomSortLocale = isset( $tplateOptns['_cbomSortLocale_' . $F] ) ? esc_attr($tplateOptns['_cbomSortLocale_' . $F][0] ) : '';

    //Static Label + Text (span). Label section style
    //$lblTag = isset( $tplateOptns['_lblTag_' . $F] ) ? esc_attr( $tplateOptns['_lblTag_' . $F][0] ) : 'div';
    $lblCls = isset( $tplateOptns['_lblCls_' . $F] ) ? esc_attr( $tplateOptns['_lblCls_' . $F][0] ) : '';
    $lblStyle = isset( $tplateOptns['_lblStyle_' . $F] ) ? esc_attr( $tplateOptns['_lblStyle_' . $F][0] ) : '';

    //Static Label + Text (span). Text section style
    $txtCls = isset( $tplateOptns['_txtCls_' . $F] ) ? esc_attr( $tplateOptns['_txtCls_' . $F][0] ) : '';
    $txtStyle = isset( $tplateOptns['_txtStyle_' . $F] ) ? esc_attr( $tplateOptns['_txtStyle_' . $F][0] ) : '';

    //Input field label & description
    $inputLbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
    $inputHlp = isset( $tplateOptns['_inputHlp_' . $F] ) ? esc_attr( $tplateOptns['_inputHlp_' . $F][0] ) : '';
    $dteDisplayHlp = isset( $tplateOptns['_dteDisplayHlp_' . $F] ) ? esc_attr( $tplateOptns['_dteDisplayHlp_' . $F][0] ) : '';

    $inputLinkLblLbl = isset( $tplateOptns['_lnkLblLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkLblLbl_' . $F][0] ) : '';
    $inputLinkLblHlp = isset( $tplateOptns['_lnkLblHlp_' . $F] ) ? esc_attr( $tplateOptns['_lnkLblHlp_' . $F][0] ) : '';
    $inputLinkUrlLbl = isset( $tplateOptns['_lnkUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlLbl_' . $F][0] ) : '';
    $inputLinkUrlHlp = isset( $tplateOptns['_lnkUrlHlp_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlHlp_' . $F][0] ) : '';

    $imgUrlLbl = isset( $tplateOptns['_imgUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_imgUrlLbl_' . $F][0] ) : '';
    $imgUrlHlp = isset( $tplateOptns['_imgUrlHlp_' . $F] ) ? esc_attr( $tplateOptns['_imgUrlHlp_' . $F][0] ) : '';
    $imgAltLbl = isset( $tplateOptns['_imgAltLbl_' . $F] ) ? esc_attr( $tplateOptns['_imgAltLbl_' . $F][0] ) : '';
    $imgAltHlp = isset( $tplateOptns['_imgAltHlp_' . $F] ) ? esc_attr( $tplateOptns['_imgAltHlp_' . $F][0] ) : '';  

    $imgLnkLbl = isset( $tplateOptns['_imgLnkLbl_' . $F] ) ? esc_attr( $tplateOptns['_imgLnkLbl_' . $F][0] ) : '';
    $imgLnkHlp = isset( $tplateOptns['_imgLnkHlp_' . $F] ) ? esc_attr( $tplateOptns['_imgLnkHlp_' . $F][0] ) : '';
    $imgLnkAttrLbl = isset( $tplateOptns['_imgLnkAttrLbl_' . $F] ) ? esc_attr( $tplateOptns['_imgLnkAttrLbl_' . $F][0] ) : '';
    $imgLnkAttrHlp = isset( $tplateOptns['_imgLnkAttrHlp_' . $F] ) ? esc_attr( $tplateOptns['_imgLnkAttrHlp_' . $F][0] ) : '';
    $imgLnkClickLbl = isset( $tplateOptns['_imgLnkClickLbl_' . $F] ) ? esc_attr( $tplateOptns['_imgLnkClickLbl_' . $F][0] ) : '';
    $imgLnkClickHlp = isset( $tplateOptns['_imgLnkClickHlp_' . $F] ) ? esc_attr( $tplateOptns['_imgLnkClickHlp_' . $F][0] ) : ''; 

    //PRO ---  TODO Add class and style ?
    $lnkCls = isset( $tplateOptns['_lnkCls _' . $F] ) ? esc_attr( $tplateOptns['_lnkCls_' . $F][0] ) : '';
    $lnkStyle = isset( $tplateOptns['_lnkStyle_' . $F] ) ? esc_attr( $tplateOptns['_lnkStyle_' . $F][0] ) : '';

    //?????????????????????????????????
    //$socialIconsL = isset( $tplateOptns['_socialIconsL_' . $F] ) ? esc_attr( $tplateOptns['_socialIconsL_' . $F][0] ) : 'N';
    //$socialC1 = isset( $tplateOptns['_socialC1_' . $F] ) ? esc_attr( $tplateOptns['_socialC1_' . $F][0] ) : '';

    $sdProperty = isset( $tplateOptns['_sdProperty_' . $F] ) ? esc_attr( $tplateOptns['_sdProperty_' . $F][0] ) : '';
    $excludedSlugs = isset( $tplateOptns['_excludedSlugs_' . $F] ) ? esc_attr( $tplateOptns['_excludedSlugs_' . $F][0] ) : '';
    //====================================================
    //Field name & hidden Field Type
    abcfsl_mbox_tplate_field_number_and_datatype( $fieldTypeH, $F );
    abcfsl_mbox_tplate_field_lock( $fieldLocked, $F );

    //Generic single input. Can be used to replace 
    //abcfsl_mbox_tplate_field_txt_input_custom can be used to replace abcfsl_mbox_tplate_field_input_static_lbl or others.

    //Field type (hidden value).
    switch ( $fieldTypeH ){  
        case 'STXT': //Static Text
            echo abcfl_input_hline('2', '20');
            abcfsl_mbox_tplate_field_input_txt( 'inputLbl_', $F, $inputLbl, 208, 282, true );
            abcfsl_mbox_tplate_field_input_STXT( $statTxt, $statTxtFs, $F );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style_compact_default( $tplateOptns, $F );
            //----------------------------------
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;
        case 'MP':
            abcfsl_mbox_tplate_field_section_hdr( 1, 125);
            abcfsl_mbox_tplate_field_mp( $tplateOptns, $F );
            //----------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style_compact_MP( $tplateOptns, $F );           
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;
        case 'T':
            abcfsl_mbox_tplate_field_section_hdr_input_field_default();
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 208, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style_compact_default( $tplateOptns, $F );
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;
        case 'PT':
            abcfsl_mbox_tplate_field_section_hdr_input_field_default();
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 208, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style_compact_default( $tplateOptns, $F );
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;
        case 'LT': //Static Label + Text
            echo abcfl_input_hline('2', '20');
            abcfsl_mbox_tplate_field_input_static_lbl( $lblTxt, $F, 275, 293, true );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_section_hdr_input_field_default();
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 208, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );         
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style_compact_static_lbl( $tplateOptns, $F );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;
        case 'LTABOVE': //Static Label (above) + Text
        case 'PTABOVE': 
            echo abcfl_input_hline('2', '20');
            abcfsl_mbox_tplate_field_input_static_lbl( $lblTxt, $F, 275, 704, true );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_section_hdr_input_field_default();
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 208, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );         
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style_compact_static_lbl_above( $tplateOptns, $F );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;
        case 'H': //Hyperlink
            abcfsl_mbox_tplate_field_section_hdr_input_field_default();
            echo abcfl_input_info_lbl(abcfsl_txta(230), 'abcflMTop5', 13);
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLinkLblLbl, $inputLinkLblHlp, $F, 205, 282, 245, 257, true, 'lnkLblLbl_', 'lnkLblHlp_' );
            echo abcfl_input_hline('1', '20');
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLinkUrlLbl, $inputLinkUrlHlp, $F, 302, 282, 317, 257, true, 'lnkUrlLbl_', 'lnkUrlHlp_' );
            echo abcfl_input_hline('2', '20');
            abcfsl_mbox_tplate_field_hyperlink_optns( $lnkNT, $lnkDload, $F );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style_compact_default( $tplateOptns, $F );
            //----------------------------------            
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;
        case 'TH': //Static text + Hyperlink
            echo abcfl_input_hline('2', '20');
            abcfsl_mbox_tplate_field_input_static_lbl( $lblTxt, $F, 182, 264, true );
            abcfsl_mbox_tplate_field_hyperlink_optns( $lnkNT, $lnkDload, $F );
            //----------------------------------
            abcfsl_mbox_tplate_field_section_hdr_input_field_default();
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLinkUrlLbl, $inputLinkUrlHlp, $F, 208, 282, 209, 257, true, 'lnkUrlLbl_', 'lnkUrlHlp_' );
            //----------------------------------          
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style_compact_default( $tplateOptns, $F );
            //----------------------------------
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;
        case 'EM': //Email
            abcfsl_mbox_tplate_field_section_hdr_input_field_default();
            echo abcfl_input_info_lbl(abcfsl_txta(200), 'abcflMTop5', 13);
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLinkLblLbl, $inputLinkLblHlp, $F, 205, 282, 245, 257, true, 'lnkLblLbl_', 'lnkLblHlp_' );
            echo abcfl_input_hline('1', '20');
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLinkUrlLbl, $inputLinkUrlHlp, $F, 300, 282, 318, 257, true, 'lnkUrlLbl_', 'lnkUrlHlp_' );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_show_as_txt( $showAsTxt, $F );
            abcfsl_mbox_tplate_field_field_style_compact_default( $tplateOptns, $F );
            //----------------------------------            
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;
        case 'STXEM': //Email with static text
            echo abcfl_input_hline('2', '20');
            abcfsl_mbox_tplate_field_input_static_lbl( $lblTxt, $F, 182, 339, true );
            //------------------------------------------------
            //abcfsl_mbox_tplate_field_section_hdr( 33, 208 );
            abcfsl_mbox_tplate_field_section_hdr_input_field_default();
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLinkUrlLbl, $inputLinkUrlHlp, $F, 300, 282, 318, 257, true, 'lnkUrlLbl_', 'lnkUrlHlp_' );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style_compact_default( $tplateOptns, $F );
            //----------------------------------            
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;  
        case 'SLFONE': //Static label + Phone.
            echo abcfl_input_hline('2', '20');
            abcfsl_mbox_tplate_field_input( $lblTxt, $F, abcfsl_txta( 275 ), abcfsl_txta( 293 ), true );
            //------------------------------------------------
            //abcfsl_mbox_tplate_field_section_hdr( 33 );
            abcfsl_mbox_tplate_field_section_hdr_input_field_default();
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLinkLblLbl, $inputLinkLblHlp, $F, 383, 282, 209, 257, true, 'lnkLblLbl_', 'lnkLblHlp_' );
            echo abcfl_input_hline('1', '20');
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLinkUrlLbl, $inputLinkUrlHlp, $F, 382, 282, 209, 257, true, 'lnkUrlLbl_', 'lnkUrlHlp_' );          
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style_compact_static_lbl( $tplateOptns, $F );          
            //------------------------------------------------
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;  
        case 'FONE': // Phone.
            //------------------------------------------------
            //abcfsl_mbox_tplate_field_section_hdr( 33 );
            abcfsl_mbox_tplate_field_section_hdr_input_field_default();
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLinkLblLbl, $inputLinkLblHlp, $F, 383, 282, 209, 257, true, 'lnkLblLbl_', 'lnkLblHlp_' );
            echo abcfl_input_hline('1', '20');
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLinkUrlLbl, $inputLinkUrlHlp, $F, 382, 282, 209, 257, true, 'lnkUrlLbl_', 'lnkUrlHlp_' );          
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style_compact_default( $tplateOptns, $F );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;                                      
        case 'CE': //WP Text editor
            //abcfsl_mbox_tplate_field_section_hdr( 33 );
            abcfsl_mbox_tplate_field_section_hdr_input_field_default();
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 208, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_noautop( $noAutop, $F );
            abcfsl_mbox_tplate_field_field_style_compact_default( $tplateOptns, $F );        
            //----------------------------------            
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;
        case 'HL': // Horizontal Line
            //abcfsl_mbox_tplate_field_section_hdr( 33 );
            abcfsl_mbox_tplate_field_section_hdr_input_field_default();
            abcfsl_mbox_tplate_field_input_txt( 'inputLbl_', $F, $inputLbl, 208, 282, true );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_autil_css_section_tag_class_style_compact( $tplateOptns, $F );
            //abcfsl_autil_css_section_tag_class_style( $tagCls, $tagStyle, $F );
            break;
        case 'SC': // Shortcode
            //abcfsl_mbox_tplate_field_section_hdr( 33 );
            abcfsl_mbox_tplate_field_section_hdr_input_field_default();
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 208, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            //---------------------------------
            abcfsl_mbox_tplate_field_cntr_style_scode( $tplateOptns, $F );
            break;
        case 'CBO': // Dropdown
            //abcfsl_mbox_tplate_field_section_hdr( 33 );
            abcfsl_mbox_tplate_field_section_hdr_input_field_default();
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 208, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_section_hdr( 0, 193 );
            abcfsl_mbox_tplate_cbo_items( $tplateOptns, $F );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style_compact_default( $tplateOptns, $F );
            //----------------------------------
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break; 
        case 'LBLCBO': //Static label + Dropdown
            //-- Static label --------------------------------
            echo abcfl_input_hline('2', '20');
            abcfsl_mbox_tplate_field_input_static_lbl( $lblTxt, $F, 275, 293 );        
            //------------------------------------------------
            //abcfsl_mbox_tplate_field_section_hdr( 33, 208 );
            abcfsl_mbox_tplate_field_section_hdr_input_field_default();
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 208, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_section_hdr( 0, 193 );
            abcfsl_mbox_tplate_cbo_items( $tplateOptns, $F );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style_compact_static_lbl( $tplateOptns, $F );
            //----------------------------------
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;
        case 'CBOM': //Static Label + Drop-Down Group
            //------------------------------------------------
            //abcfsl_mbox_tplate_field_section_hdr( 33, 208 );
            abcfsl_mbox_tplate_field_section_hdr_input_field_default();
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 208, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );
            //-- Static label --------------------------------
            abcfsl_mbox_tplate_field_section_hdr( 81, 125 );
            abcfsl_mbox_tplate_field_input_static_lbl( $lblTxt, $F, 275, 293 );  
            abcfsl_mbox_tplate_field_cbom_qty( $cbomQty, $F, 366 );  
            abcfsl_util_yn( 'cbomSort_', $F, $cbomSort, 370, 0 );
            abcfsl_mbox_tplate_field_input_txt( 'cbomSortLocale_', $F, $cbomSortLocale, 371, 0 );              
            //------------------------------------------------
            abcfsl_mbox_tplate_field_section_hdr( 80, 193 );
            abcfsl_mbox_tplate_cbo_items( $tplateOptns, $F );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style_compact_static_lbl( $tplateOptns, $F );
            //----------------------------------
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;
        case 'CHECKG': //Static Label + Checkbox Group
            //abcfsl_mbox_tplate_field_section_hdr( 33, 208 );
            abcfsl_mbox_tplate_field_section_hdr_input_field_default();
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 208, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );
            //-- Static label --------------------------------
            abcfsl_mbox_tplate_field_section_hdr( 85, 275 );
            abcfsl_mbox_tplate_field_input_static_lbl( $lblTxt, $F, 0, 372 );               
            //------------------------------------------------
            abcfsl_mbox_tplate_field_section_hdr( 84, 376 );
            abcfsl_mbox_tplate_checkbox_items( $tplateOptns, $F );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );

            abcfsl_mbox_tplate_field_field_style_compact_static_lbl( $tplateOptns, $F );
            //----------------------------------
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break; 
        case 'IMGCAP': //Image + caption
            //------------------------------------------------
            abcfsl_mbox_tplate_field_section_hdr_input_field_default();
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $imgUrlLbl, $imgUrlHlp, $F, 312, 282, 209, 257, true, 'imgUrlLbl_', 'imgUrlHlp_' );
            echo abcfl_input_hline('1', '20'); //Caption           
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 25, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );  
            echo abcfl_input_hline('1', '20');  //ALT          
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $imgAltLbl, $imgAltHlp, $F, 186, 282, 209, 257, true, 'imgAltLbl_', 'imgAltHlp_' );                     
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_img_style( $tplateOptns, $F );
            abcfsl_mbox_tplate_field_img_style_spg( $tplateOptns, $F );            
            //----------------------------------
            abcfsl_autil_field_img_custom_classes( $tagCls, $lblCls, $txtCls, $F, 2 );          
            break;              
        case 'IMGHLNK': // Image Hyperlink + Caption
            //------------------------------------------------
            //abcfsl_mbox_tplate_field_section_hdr( 33 );
            abcfsl_mbox_tplate_field_section_hdr_input_field_default();
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $imgUrlLbl, $imgUrlHlp, $F, 312, 282, 209, 257, true, 'imgUrlLbl_', 'imgUrlHlp_' );
            echo abcfl_input_hline('1', '20'); //Caption           
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 25, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );  
            echo abcfl_input_hline('1', '20');  //ALT          
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $imgAltLbl, $imgAltHlp, $F, 186, 282, 209, 257, true, 'imgAltLbl_', 'imgAltHlp_' );  
            echo abcfl_input_hline('1', '20');          
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $imgLnkLbl, $imgLnkHlp, $F, 261, 282, 209, 257, true, 'imgLnkLbl_', 'imgLnkHlp_' );
            echo abcfl_input_hline('1', '20');           
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $imgLnkAttrLbl, $imgLnkAttrHlp, $F, 198, 282, 209, 257, true, 'imgLnkAttrLbl_', 'imgLnkAttrHlp_' );
            echo abcfl_input_hline('1', '20');            
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $imgLnkClickLbl, $imgLnkClickHlp, $F, 199, 282, 209, 257, true, 'imgLnkClickLbl_', 'imgLnkClickHlp_' );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_img_style( $tplateOptns, $F );
            abcfsl_mbox_tplate_field_img_style_spg( $tplateOptns, $F ); 
            //----------------------------------
            abcfsl_autil_field_img_custom_classes( $tagCls, $lblCls, $txtCls, $F, 2 );           
            break; 
        case 'SLDTE': //Static Lbl + Date
            echo abcfl_input_hline('2', '20');            
            abcfsl_mbox_tplate_field_txt_input_custom( $lblTxt, $F, 275, 293, 16 );
            abcfsl_mbox_tplate_field_date_format( $dtFormat, $F );    
            //------------------------------------------------
            //abcfsl_mbox_tplate_field_section_hdr( 33 );
            abcfsl_mbox_tplate_field_section_hdr_input_field_default();
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 208, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );    
            abcfsl_mbox_tplate_field_inputs_desc( $dteDisplayHlp, $F, 395, 394, 'dteDisplayHlp_' );
            //------------------------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style_compact_static_lbl( $tplateOptns, $F );          
            //------------------------------------------------
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );
            break;
        case 'STARR': 
            //abcfsl_mbox_tplate_field_section_hdr( 33, 208 );
            abcfsl_mbox_tplate_field_section_hdr_input_field_default();
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 208, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );     
            //------------------------------------------------              
            abcfsl_mbox_tplate_icons_optns_STARR( $tplateOptns, $F ); 
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );   
            //abcfsl_mbox_tplate_icons_style( $tplateOptns, $F ); 
            abcfsl_mbox_tplate_field_cntr_style_scode( $tplateOptns, $F );
            break;  
        case 'ICONLNK': 
            //abcfsl_mbox_tplate_field_section_hdr( 33, 208 );
            abcfsl_mbox_tplate_field_section_hdr_input_field_default();
            abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, 208, 282, 209, 257, true, 'inputLbl_', 'inputHlp_' );     
            //------------------------------------------------ 
            abcfsl_mbox_tplate_icons_optns_ICONLNK( $tplateOptns, $F ); 
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );   
            //abcfsl_mbox_tplate_icons_style( $tplateOptns, $F ); 
            abcfsl_mbox_tplate_field_cntr_style_scode( $tplateOptns, $F );
            break;
        case 'ICONLNKCAP': 
            echo abcfl_input_hline('2', '20');
            break;
        case 'STFFCAT': 
            echo abcfl_input_hline('2', '20');
            echo abcfsl_mbox_autil_input_txt( 'lblTxt_', $F, $lblTxt, 275, 0 );
            echo abcfsl_mbox_autil_input_txt_help_link( 'inputLbl_', $F, $inputLbl, 208, 282, 33 );
            echo abcfsl_mbox_autil_input_txt_help_link( 'excludedSlugs_', $F, $excludedSlugs, 505, 0, 18 );
            //----------------------------------
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );
            abcfsl_mbox_tplate_field_field_style_compact_static_lbl( $tplateOptns, $F );
            //----------------------------------
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );   
            break;
        case 'POSTTITLE':  
            echo abcfl_input_hline('2', '20');          
            echo abcfsl_mbox_autil_input_txt( 'inputLbl_', $F, $inputLbl, 209, 0 ); 
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );

            abcfsl_mbox_tplate_field_field_style_compact_default( $tplateOptns, $F );
            //----------------------------------
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );   
            break; 
        case 'SORTTXT':  
            echo abcfl_input_hline('2', '20');          
            echo abcfsl_mbox_autil_input_txt( 'inputLbl_', $F, $inputLbl, 209, 0 ); 
            abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F );

            abcfsl_mbox_tplate_field_field_style_compact_default( $tplateOptns, $F );
            //----------------------------------
            abcfsl_mbox_tplate_field_sd_property( $sdProperty, $F );   
            break;             
        case 'LBLEMAIL': 
            echo abcfl_input_hline('2', '20');
            break;
        case 'VCARDHL':    
            echo abcfl_input_hline('2', '20');
            abcfsl_mbox_tplate_vcardhl( $tplateOptns, $F, $lblTxt, $inputLbl, $inputHlp, $showField, $hideDelete, $fieldCntrSPg );
            break;
        case 'VCARD':    
            echo abcfl_input_hline('2', '20');
            abcfsl_mbox_tplate_vcard( $tplateOptns, $F, $lblTxt, $inputLbl, $inputHlp, $showField, $hideDelete, $fieldCntrSPg );
            break;                                            
        case 'ADDRST':
            echo abcfl_input_hline('2', '20');
            abcfsl_mbox_tplate_addrst( $tplateOptns, $F, $lblTxt, $inputLbl, $inputHlp, $showField, $hideDelete, $fieldCntrSPg );
            break;
        case 'ADDR':
            echo abcfl_input_hline('2', '20');
            abcfsl_mbox_tplate_addr( $tplateOptns, $F, $lblTxt, $inputLbl, $inputHlp, $showField, $hideDelete, $fieldCntrSPg, $sdProperty );
            break; 
        case 'QRIMGCAP64STA': // QRCode Image base64 + Caption Static
            echo abcfl_input_hline('2', '20');
            abcfsl_mbox_tplate_QRIMGCAP64STA( $tplateOptns, $F );
            abcfsl_mbox_tplate_field_img_style( $tplateOptns, $F );
            abcfsl_mbox_tplate_field_img_style_spg( $tplateOptns, $F  );
            abcfsl_autil_field_img_custom_classes( $tagCls, $lblCls, $txtCls, $F, 2 ); 
            break;
        case 'QRIMGCAP64DYN': // Dynamic QRCode Image base64 + Caption
            echo abcfl_input_hline('2', '20');
            abcfsl_mbox_tplate_QRIMGCAP64STA( $tplateOptns, $F );
            abcfsl_mbox_tplate_field_img_style( $tplateOptns, $F );
            abcfsl_mbox_tplate_field_img_style_spg( $tplateOptns, $F );
            abcfsl_autil_field_img_custom_classes( $tagCls, $lblCls, $txtCls, $F, 2 ); 
            break;             
        case 'QRHL64STA':    
            echo abcfl_input_hline('2', '20');
            abcfsl_mbox_tplate_qrhl64sta( $tplateOptns, $F );
            break; 
        case 'QRHL64DYN':    
            echo abcfl_input_hline('2', '20');
            abcfsl_mbox_tplate_qrhl64dyn( $tplateOptns, $F );
            break;                                            
        default:
            break;
    }

    echo abcfl_html_tag_end('div');

    // case 'SH': //Single Page Hyperlink DISCONTINUED
    //     abcfsl_mbox_tplate_field_section_hdr( 23 );
    //     abcfsl_mbox_tplate_field_input_static_lbl( $lblTxt, $F, 259, 127 );
    //     abcfsl_mbox_tplate_field_hide_delete( $hideDelete, $F );
    //     break; 
}

//== SECTION HEADERS ==================================================
//Add new field
function abcfsl_mbox_tplate_field_add_field_cbo( $fieldTypeH, $F ){

    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(320), abcfsl_aurl(13) );
    $cboLineType = abcfsl_cbo_add_new_field();

    echo abcfl_input_cbo('fieldType_' . $F, '',$cboLineType, $fieldTypeH, abcfsl_txta(222), abcfsl_txta(212), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//Field number and datatype
function abcfsl_mbox_tplate_field_number_and_datatype( $fieldTypeH, $F ){

    if( $fieldTypeH == 'SH' ) { return; }

    $cboLineType = abcfsl_cbo_field_type();
    $fieldType = $cboLineType[$fieldTypeH];
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL,  $F. '.&nbsp;&nbsp;' . $fieldType, abcfsl_aurl_f( $fieldTypeH ), 'abcflFontWP abcflFontS20 abcflFontW600 abcflMTop10 abcflBlue' );
    echo abcfl_input_hidden( '', 'fieldTypeH_' . $F, $fieldTypeH );
}

//== FIELDS =========================================================
function abcfsl_mbox_tplate_field_lock( $fieldLocked, $F ){

    $clsBoxlbl = '';
    $boxLbl = abcfsl_txta(296);
    if( $fieldLocked == '1' ){
        $clsBoxlbl = 'abcflRed';
        $boxLbl = abcfsl_txta(297);
    }
    echo abcfl_input_checkbox('fieldLocked_'. $F,  '', $fieldLocked, $boxLbl, '', '', '', 'abcflFldCntr', '', '', $clsBoxlbl );
}

function abcfsl_mbox_tplate_field_show_field( $showField, $hideDelete, $F ){

    $cboShowField = abcfsl_cbo_show_field();
    abcfsl_mbox_tplate_field_hide_delete( $hideDelete, $F );
    echo abcfl_input_cbo('showField_' . $F, '',$cboShowField, $showField, abcfsl_txta_r(72), abcfsl_txta(233), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    
}

function abcfsl_mbox_tplate_field_hide_delete( $hideDelete, $F ){

    $cboHideDelete = abcfsl_cbo_hide_delete();
    echo abcfl_input_cbo('hideDelete_' . $F, '',$cboHideDelete, $hideDelete, abcfsl_txta_r(71), abcfsl_txta(134), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//Field container type
function abcfsl_mbox_tplate_field_field_cntr_type( $tagType, $F, $typeL='tagType_'){

    $cboTxtCntr = abcfsl_cbo_tag_type();
    echo abcfl_input_cbo($typeL . $F, '',$cboTxtCntr, $tagType, abcfsl_txta_r(287), abcfsl_txta(279), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfsl_mbox_tplate_field_date_format( $dtFormat, $F ){
    //abcfl_input_date
    $cboDt= abcfsl_cbo_date_format();
    $lbl = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(395), abcfsl_aurl(15), 'abcflFontWP abcflFontS13 abcflFontW400' );
    echo abcfl_input_cbo('dtFormat_' . $F, '',$cboDt, $dtFormat,  $lbl, '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//==INPUT FIELDS =====================================================
//Single input. Replace with: abcfsl_mbox_tplate_field_input_txt
function abcfsl_mbox_tplate_field_input( $value, $F, $lblTxt, $helpTxt, $required=false ){
    if( $required ) { $lblTxt = abcfsl_txta_txt_r( $lblTxt ); }    
    echo abcfl_input_txt('lblTxt_' . $F, '', $value, $lblTxt, $helpTxt, '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//Single input.  $fldID = XXX_ Example: lblTxt_
function abcfsl_mbox_tplate_field_input_txt( $fldID, $F, $fldValue, $lblID, $helpID, $required=false ){
    $lbl = abcfsl_txta( $lblID );
    if( $required ) { $lbl = abcfsl_txta_r( $lblID ); }
    echo abcfl_input_txt( $fldID . $F, '', $fldValue, $lbl, abcfsl_txta( $helpID ), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//Static label.
function abcfsl_mbox_tplate_field_input_static_lbl( $inputData, $F, $lblID, $helpID, $required=false ){
    $lbl = abcfsl_txta($lblID);
    if( $required ) { $lbl = abcfsl_txta_r($lblID); }
    echo abcfl_input_txt('lblTxt_' . $F, '', $inputData, $lbl, abcfsl_txta( $helpID ), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}
//=================================================================================
function abcfsl_mbox_tplate_field_txt_input_custom( $inputData, $F, $lblID, $helpID, $docID=0, $inputID='', $required=false ){
    if( empty( $inputID ) ) { $inputID = 'lblTxt_'; }
    $lbl = abcfsl_txta( $lblID );
    if( $required ) { $lbl = abcfsl_txta_r($lblID); }
    $lbl = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, $lbl, abcfsl_aurl( $docID ), 'abcflFontWP abcflFontS13 abcflFontW400' );
    echo abcfl_input_txt( $inputID . $F, '', $inputData, $lbl, abcfsl_txta( $helpID ), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//Two fields: Field label +  Field description
function abcfsl_mbox_tplate_field_inputs_lbl_desc( $inputLbl, $inputHlp, $F, $name1, $help1, $name2, $help2, $reqired, $lbl='inputLbl_', $hlp='inputHlp_'){
    
    $lblName1 = abcfsl_txta( $name1 );
    if ( $reqired ) {  $lblName1 = abcfsl_txta_r( $name1 ); }    
    echo abcfl_input_txt( $lbl . $F, '', $inputLbl, $lblName1, abcfsl_txta( $help1 ), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    if( !empty( $name2 ) ) {
        echo abcfl_input_txt($hlp . $F, '', $inputHlp, abcfsl_txta( $name2 ), abcfsl_txta( $help2 ), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    }
}

//Single field: Field description
function abcfsl_mbox_tplate_field_inputs_desc( $inputHlp, $F, $name2, $help2, $hlp='inputHlp_'){
    
    echo abcfl_input_txt( $hlp . $F, '', $inputHlp, abcfsl_txta( $name2 ), abcfsl_txta( $help2 ), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfsl_mbox_tplate_field_input_STXT( $statTxt, $statTxtFs, $F ){

    $lblFs = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(185), abcfsl_aurl(53), 'abcflFontWP abcflFontS13 abcflFontW400' );

    echo abcfl_input_txtarea('statTxt_' . $F, '', $statTxt, abcfsl_txta_r(182), abcfsl_txta(221), '50%', '2', '', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('statTxtFs_' . $F, '', $statTxtFs, $lblFs, '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//Fonts
function abcfsl_mbox_tplate_field_font( $fieldName, $fielValue, $F, $help=247, $lbl=47 ){
    $cbo = abcfsl_cbo_font_size();
    echo abcfl_input_cbo_strings( $fieldName . $F, '', $cbo, $fielValue, abcfsl_txta( $lbl ), abcfsl_txta( $help ), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//Top margin.
function abcfsl_mbox_tpate_field_margin_t( $fieldName, $fielValue, $F, $help=0, $lbl=15 ){
    $cbo = abcfsl_cbo_txt_margin_top();
    echo abcfl_input_cbo_strings($fieldName . $F, '', $cbo, $fielValue, abcfsl_txta( $lbl ), abcfsl_txta( $help ), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfsl_mbox_tplate_field_cntr_spg( $fielValue, $F ){
    $cbo = abcfsl_cbo_field_cntr_spg();
    $lbl = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(140), abcfsl_aurl(9), 'abcflFontWP abcflFontS13 abcflFontW400' );
    echo abcfl_input_cbo_strings('fieldCntrSPg_' . $F, '', $cbo, $fielValue, $lbl, abcfsl_txta(148), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfsl_mbox_tplate_field_show_as_txt( $showAsTxt, $F ){
    echo abcfl_input_checkbox('showAsTxt_' . $F,  '', $showAsTxt, abcfsl_txta(328), '', '', '', 'abcflMTop10', '', '', '' );
}

//Section header + optional help link (?) Default text 'Field Labels'
function abcfsl_mbox_tplate_field_section_hdr( $aurl, $txta=319, $hline=true){
    if( $hline ) { echo abcfl_input_hline('2', '20'); }
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta($txta), abcfsl_aurl($aurl) );
}

// Header: Input Fileld Labels. + help hyperlink.
function abcfsl_mbox_tplate_field_section_hdr_input_field_default( $hline=true ){
    if( $hline ) { echo abcfl_input_hline('2', '20'); }
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(319), abcfsl_aurl(33) );
    //echo abcfl_input_info_lbl( abcfsl_txta(807), 'abcflMTop5', 13 );
}

function abcfsl_mbox_tplate_field_cbom_qty( $cbomQty, $F, $txtID, $xtaID=0 ){

    $cboQty = abcfsl_cbo_list_grid_columns_12();
    echo abcfl_input_cbo( 'cbomQty_' . $F, '', $cboQty, $cbomQty, abcfsl_txta_r($txtID), abcfsl_txta(0), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfsl_util_yn( $fldID, $F, $fielValue, $lblID, $helpID ){
    $cboYN = abcfsl_cbo_yn();
    echo abcfl_input_cbo( $fldID . $F, '', $cboYN, $fielValue, abcfsl_txta( $lblID ), abcfsl_txta( $helpID ), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl' );
}

function abcfsl_mbox_tplate_field_noautop( $noAutop, $F ){ 
    echo abcfl_input_checkbox('noAutop_' . $F, '', $noAutop, abcfsl_txta(380), '', '', '', 'abcflFldCntr', '', '', '' );
}

function abcfsl_mbox_tplate_field_display_optns( $showField, $hideDelete, $fieldCntrSPg, $F ){
 
    abcfsl_mbox_tplate_field_section_hdr( 5, 286 );
    abcfsl_mbox_tplate_field_show_field( $showField, $hideDelete, $F );
    abcfsl_mbox_tplate_field_cntr_spg( $fieldCntrSPg, $F );
}

function abcfsl_mbox_tplate_field_hyperlink_optns( $lnkNT, $lnkDload, $F ){ 
    echo abcfl_input_checkbox('lnkNT_' . $F,  '', $lnkNT, abcfsl_txta(143), '', '', '', 'abcflFldCntr abcflMTop15', '', '', '' );
    echo abcfl_input_checkbox('lnkDload_' . $F,  '', $lnkDload, abcfsl_txta(431), '', '', '', 'abcflFldCntr abcflMTop15', '', '', '' );
}

//============================================================
// Most common set of styles: Field Style, Field Style - Single Page, CSS Class, CSS Style. Default field names.
function abcfsl_mbox_tplate_field_field_style_compact_default( $tplateOptns, $F ){

    abcfsl_mbox_tplate_field_field_style_compact( $tplateOptns, $F );
    abcfsl_mbox_tplate_field_field_style_spg_compact( $tplateOptns, $F );
    abcfsl_autil_css_section_tag_class_style_compact( $tplateOptns, $F );
}

function abcfsl_mbox_tplate_field_field_style_compact_MP( $tplateOptns, $F ){

    abcfsl_mbox_tplate_field_field_style_compact( $tplateOptns, $F );
    echo abcfsl_mbox_tplate_field_MP_spglnk( $tplateOptns, $F );
    abcfsl_mbox_tplate_field_field_style_spg_compact( $tplateOptns, $F );
    abcfsl_autil_css_section_tag_class_style_compact( $tplateOptns, $F );
}

function  abcfsl_mbox_tplate_field_MP_spglnk( $tplateOptns, $F ){
    $sPgLnkMP = isset( $tplateOptns['_sPgLnkMP_' . $F] ) ? $tplateOptns['_sPgLnkMP_' . $F][0] : '0';
    return abcfl_input_checkbox_with_help_icon( 'sPgLnkMP_' . $F, $sPgLnkMP, abcfsl_txta(453), ABCFSL_ICONS_URL, abcfsl_aurl(90), 'abcflFldCntr abcflMTop15', 'abcflFontS14');
}

//Fields with static label
function abcfsl_mbox_tplate_field_field_style_compact_static_lbl( $tplateOptns, $F ){

    abcfsl_mbox_tplate_field_field_style_compact( $tplateOptns, $F );
    abcfsl_mbox_tplate_field_field_style_spg_compact( $tplateOptns, $F );
    abcfsl_mbox_tplate_field_custom_styles_cntr_lbl_txt( $tplateOptns, $F );
}

//Fields with static label above
function abcfsl_mbox_tplate_field_field_style_compact_static_lbl_above( $tplateOptns, $F ){

    abcfsl_mbox_tplate_field_static_lbl_style_compact( $tplateOptns, $F );
    abcfsl_mbox_tplate_field_static_lbl_style_spg_compact( $tplateOptns, $F );

    abcfsl_mbox_tplate_field_txt_style_compact( $tplateOptns, $F );
    abcfsl_mbox_tplate_field_txt_style_spg_compact( $tplateOptns, $F );

    abcfsl_mbox_tplate_field_custom_styles_cntr_lbl_txt( $tplateOptns, $F );
}
//==================================================================
function abcfsl_mbox_tplate_field_field_style_compact( $tplateOptns, $F ){

    $par['F'] = $F;
    $par['showCustCSS'] = 0;

    //abcfsl_mbox_tplate_field_section_hdr( 14, 139 );
    abcfsl_autil_field_style_inputs_bldr( $tplateOptns, $par );
}

function abcfsl_mbox_tplate_field_field_style_spg_compact( $tplateOptns, $F ){

    $par['F'] = $F;
    $par['showCustCSS'] = 0;
    $par['fTag'] = 'tagTypeSPg';
    $par['fFont'] = 'tagFontSPg';
    $par['fMarginT'] = 'tagMarginTSPg';
    $par['hdrLbl'] = 130;
    $par['hdrURL'] = 45;
    
    //abcfsl_mbox_tplate_field_section_hdr( 14, 139 );
    abcfsl_autil_field_style_inputs_bldr( $tplateOptns, $par );
}
//-------------------
function abcfsl_mbox_tplate_field_static_lbl_style_compact( $tplateOptns, $F ){

    $par['F'] = $F;
    $par['hdrLbl'] = 803;
    $par['showCustCSS'] = 0;
    $par['fTag'] = 'lblTag';
    $par['fFont'] = 'lblFont';
    $par['fMarginT'] = 'lblMarginT';

    //abcfsl_mbox_tplate_field_section_hdr( 14, 139 );
    abcfsl_autil_field_style_inputs_bldr( $tplateOptns, $par );
}

function abcfsl_mbox_tplate_field_static_lbl_style_spg_compact( $tplateOptns, $F ){

    $par['F'] = $F;
    $par['showCustCSS'] = 0;
    $par['fTag'] = 'lblTagSPg';
    $par['fFont'] = 'lblFontSPg';
    $par['fMarginT'] = 'lblMarginTSPg';
    $par['hdrLbl'] = 702;
    $par['hdrURL'] = 45;
    
    //abcfsl_mbox_tplate_field_section_hdr( 14, 139 );
    abcfsl_autil_field_style_inputs_bldr( $tplateOptns, $par );
}
//-------------------
function abcfsl_mbox_tplate_field_txt_style_compact( $tplateOptns, $F ){

    $par['F'] = $F;
    $par['hdrLbl'] = 804;
    $par['showCustCSS'] = 0;

    $par['fTag'] = 'txtTag';
    $par['fFont'] = 'txtFont';
    $par['fMarginT'] = 'txtMarginT';

    //abcfsl_mbox_tplate_field_section_hdr( 14, 139 );
    abcfsl_autil_field_style_inputs_bldr( $tplateOptns, $par );
}

function abcfsl_mbox_tplate_field_txt_style_spg_compact( $tplateOptns, $F ){

    $par['F'] = $F;
    $par['showCustCSS'] = 0;
    $par['fTag'] = 'txtTagSPg';
    $par['fFont'] = 'txtFontSPg';
    $par['fMarginT'] = 'txtMarginTSPg';
    $par['hdrLbl'] = 703;
    $par['hdrURL'] = 45;
    
    //abcfsl_mbox_tplate_field_section_hdr( 14, 139 );
    abcfsl_autil_field_style_inputs_bldr( $tplateOptns, $par );
}

//===================================================================
//Class and style section for default field styles (no static label)
function abcfsl_autil_css_section_tag_class_style_compact( $tplateOptns, $F ) {

    //tagCls_F3 tagStyle_F3
    $par['F'] = $F;
    $par['urlCls'] = 2; //2
    $par['urlStyle'] = 24; //24
    $par['showHdr'] = false;

    //$defaults['fCustCls'] = 'tagCls';
    //$defaults['fCustStyle'] = 'tagStyle';
    //$defaults['lblCls'] = abcfl_style_inputs_txt_id( 'cust_cls' ); //323;
    //$defaults['lblStyle'] = abcfl_style_inputs_txt_id( 'cust_style' ); //289;
    //$defaults['hlpCls'] = ''; // 223
    //$defaults['hlpStyle'] = ''; // 224
    // $defaults['urlCls'] = 0; //2
    // $defaults['urlStyle'] = 0; //24
    // $defaults['hlpTxt'] = '';
    // $defaults['hlpTxtR'] = false;
    // $defaults['F'] = '';
   
    abcfsl_autil_custom_class_and_style( $tplateOptns, $par );

    // $lblCls = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(323), abcfsl_aurl(2), 'abcflFontWP abcflFontS13 abcflFontW400' );
    // $lblStyle = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(289), abcfsl_aurl(24), 'abcflFontWP abcflFontS13 abcflFontW400' );

    // echo abcfl_input_hline( '2' );
    // echo abcfl_input_txt( 'tagCls_' . $F, '', $clsValue, $lblCls, abcfsl_txta(223), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    // echo abcfl_input_txt( 'tagStyle_' . $F, '', $styleValue, $lblStyle, abcfsl_txta(224), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
} 

function abcfsl_autil_css_section_tag_class_style_compact_no_hline( $tplateOptns, $F ) {

    $par['F'] = $F;
    $par['urlCls'] = 2; 
    $par['urlStyle'] = 24; 
    $par['showHdr'] = false;
    $par['hlineShow'] = false;
   
    abcfsl_autil_custom_class_and_style( $tplateOptns, $par );
} 
   
//Field Container style
function abcfsl_autil_css_section_class_style_compact_field_cntr( $tplateOptns, $F ) {

    $par['F'] = $F;
    $par['urlCls'] = 2; 
    $par['urlStyle'] = 24; 
    $par['showHdr'] = true;
    $par['hdrLbl'] = 211;
    $par['hdrURL'] = 0;
   
    abcfsl_autil_custom_class_and_style( $tplateOptns, $par );

    //Field Container style
    //abcfsl_autil_css_section_hdr_class_style( 'tagCls_', $tagCls, 'tagStyle_', $tagStyle, $F, 211, 0, '2' );
} 

//Static label style
function abcfsl_autil_css_section_class_style_compact_static_lbl( $tplateOptns, $F ) {

    $par['F'] = $F;
    $par['urlCls'] = 2; 
    $par['urlStyle'] = 24; 
    $par['showHdr'] = true;
    $par['hdrLbl'] = 226;
    $par['hdrURL'] = 0;
    $par['fCustCls'] = 'lblCls';
    $par['fCustStyle'] = 'lblStyle';
   
    abcfsl_autil_custom_class_and_style( $tplateOptns, $par );

    //Static label style
    // abcfsl_autil_css_section_hdr_class_style( 'lblCls_', $lblCls, 'lblStyle_', $lblStyle, $F, 226, 0, '2', 0, 0, 0, 0 );
} 

//Text  style
function abcfsl_autil_css_section_class_style_compact_field_txt( $tplateOptns, $F ) {

    $par['F'] = $F;
    $par['urlCls'] = 2; 
    $par['urlStyle'] = 24; 
    $par['showHdr'] = true;
    $par['hdrLbl'] = 81;
    $par['hdrURL'] = 0;
    $par['fCustCls'] = 'txtCls';
    $par['fCustStyle'] = 'txtStyle';
   
    abcfsl_autil_custom_class_and_style( $tplateOptns, $par );

    //Text  style
    // abcfsl_autil_css_section_hdr_class_style( 'txtCls_', $txtCls, 'txtStyle_', $txtStyle, $F, 81, 0, '2', 0, 0, 0, 0 );
} 

//============================================================

function abcfsl_mbox_tplate_field_field_style( $tagType, $tagFont, $tagMarginT, $F ){

    abcfsl_mbox_tplate_field_section_hdr( 14, 139 );
    abcfsl_mbox_tplate_field_field_cntr_type( $tagType, $F, 'tagType_' );
    abcfsl_mbox_tplate_field_font( 'tagFont_', $tagFont, $F );
    abcfsl_mbox_tpate_field_margin_t( 'tagMarginT_', $tagMarginT, $F );
}

function abcfsl_mbox_tplate_field_field_style_spg( $tagTypeSPg, $tagFontSPg, $tagMarginTSPg, $F ){

    abcfsl_mbox_tplate_field_section_hdr( 45, 130 );
    abcfsl_mbox_tplate_field_field_cntr_type( $tagTypeSPg, $F, 'tagTypeSPg_' );
    abcfsl_mbox_tplate_field_font( 'tagFontSPg_', $tagFontSPg, $F );
    abcfsl_mbox_tpate_field_margin_t( 'tagMarginTSPg_', $tagMarginTSPg, $F );
}

function abcfsl_mbox_tplate_field_img_style2( $tagFont, $tagMarginT, $captionMarginT, $F ){

    abcfsl_mbox_tplate_field_section_hdr( 14, 139 );
    abcfsl_mbox_tpate_field_margin_t( 'tagMarginT_', $tagMarginT, $F, 0, 391 );
    abcfsl_mbox_tplate_field_font( 'tagFont_', $tagFont, $F, 0, 392 );
    abcfsl_mbox_tpate_field_margin_t( 'captionMarginT_', $captionMarginT, $F, 0, 393 );
}

function abcfsl_mbox_tplate_field_img_style_spg2( $tagFontSPg, $tagMarginTSPg, $captionMarginTSPg, $F ){

    abcfsl_mbox_tplate_field_section_hdr( 45, 130 );
    abcfsl_mbox_tpate_field_margin_t( 'tagMarginTSPg_', $tagMarginTSPg, $F, 0, 391 );
    abcfsl_mbox_tplate_field_font( 'tagFontSPg_', $tagFontSPg, $F, 0, 392 );
    abcfsl_mbox_tpate_field_margin_t( 'captionMarginTSPg_', $captionMarginTSPg, $F, 0, 393 );
}

function abcfsl_mbox_tplate_field_cntr_style_scode( $tplateOptns, $F ){

    $tagCls = isset( $tplateOptns['_tagCls_' . $F] ) ? esc_attr( $tplateOptns['_tagCls_' . $F][0] ) : '';
    $tagMarginT = isset( $tplateOptns['_tagMarginT_' . $F] ) ? esc_attr( $tplateOptns['_tagMarginT_' . $F][0] ) : 'N';
    $tagMarginTSPg = isset( $tplateOptns['_tagMarginTSPg_' . $F] ) ? esc_attr( $tplateOptns['_tagMarginTSPg_' . $F][0] ) : '';
    //----------------------------------------------------
    $flexCntrS50 = abcfl_html_tag( 'div', '', 'abcflFGCntr abcflFGCntr50' );
    $flex2ColS = abcfl_html_tag( 'div', '', 'abcflFG2Col' );
    $divE = abcfl_html_tag_end( 'div'); 

    $cbo = abcfsl_cbo_txt_margin_top();
    //-------------------------------------------------------- 
    abcfsl_mbox_tplate_field_section_hdr( 73, 368 );

    $mT = abcfl_input_cbo_strings( 'tagMarginT_' . $F, '', $cbo, $tagMarginT, abcfsl_txta(806), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $mTSpg = abcfl_input_cbo_strings( 'tagMarginTSPg_' . $F, '', $cbo, $tagMarginTSPg, abcfsl_txta(708), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl'); 
    echo $flexCntrS50 . $flex2ColS . $mT . $divE . $flex2ColS . $mTSpg . abcfl_html_tag_ends( 'div,div' );

    abcfsl_autil_css_section_tag_class_style_compact_no_hline( $tplateOptns, $F );
}

// -- Field Container style parameters ----------------------------------
function abcfsl_mbox_tplate_field_custom_styles_cntr_lbl_txt( $tplateOptns, $F ) {

    $par['F'] = $F;
    $par['urlCls'] = 0; 
    $par['urlStyle'] = 0; 
    $par['showHdr'] = true;
    $par['hdrLbl'] = 709;
    $par['hdrURL'] = 2;
    $par['lblCls'] = 800;
    $par['lblStyle'] = 211;

    //Custom class & style 2 columns. Can have header and hline.
    abcfsl_autil_custom_class_and_style( $tplateOptns, $par );

    $par['hlineShow'] = false;
    $par['showHdr'] = false;
    $par['lblCls'] = 801;
    $par['lblStyle'] = 226;
    $par['fCustCls'] = 'lblCls';
    $par['fCustStyle'] = 'lblStyle';

    abcfsl_autil_custom_class_and_style( $tplateOptns, $par );

    $par['lblCls'] = 802;
    $par['lblStyle'] = 81;
    $par['fCustCls'] = 'txtCls';
    $par['fCustStyle'] = 'txtStyle';

    abcfsl_autil_custom_class_and_style( $tplateOptns, $par );
} 
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
function abcfsl_mbox_tplate_field_img_style_OLD( $tagFont, $tagMarginT, $captionMarginT, $F ){

    abcfsl_mbox_tplate_field_section_hdr( 14, 139 );
    abcfsl_mbox_tpate_field_margin_t( 'tagMarginT_', $tagMarginT, $F, 0, 391 );
    abcfsl_mbox_tplate_field_font( 'tagFont_', $tagFont, $F, 0, 392 );
    abcfsl_mbox_tpate_field_margin_t( 'captionMarginT_', $captionMarginT, $F, 0, 393 );
}

function abcfsl_mbox_tplate_field_img_style_spg_OLD( $tagFontSPg, $tagMarginTSPg, $captionMarginTSPg, $F ){

    abcfsl_mbox_tplate_field_section_hdr( 45, 130 );
    abcfsl_mbox_tpate_field_margin_t( 'tagMarginTSPg_', $tagMarginTSPg, $F, 0, 391 );
    abcfsl_mbox_tplate_field_font( 'tagFontSPg_', $tagFontSPg, $F, 0, 392 );
    abcfsl_mbox_tpate_field_margin_t( 'captionMarginTSPg_', $captionMarginTSPg, $F, 0, 393 );
}

function abcfsl_mbox_tplate_field_img_style( $tplateOptns, $F ){

    $par['F'] = $F;
    $par['showCustCSS'] = 0;
    $par['hdrLbl'] = 139;
    $par['hdrURL'] = 14;
    
    abcfsl_autil_field_style_inputs_bldr_img_cap( $tplateOptns, $par );
}

function abcfsl_mbox_tplate_field_img_style_spg( $tplateOptns, $F ){

    $par['F'] = $F;
    $par['showCustCSS'] = 0;
    $par['fTagMarginTop'] = 'tagMarginTSPg'; 
    $par['fFont'] = 'tagFontSPg';
    $par['fCaptionMarginT'] = 'captionMarginTSPg';
    $par['hdrLbl'] = 130;
    $par['hdrURL'] = 45;
    
    abcfsl_autil_field_style_inputs_bldr_img_cap( $tplateOptns, $par );
}

// Field style inputs - image + caption. Container type = figure
function abcfsl_autil_field_style_inputs_bldr_img_cap( $tplateOptns, $par ) {

    $defaults['fTagMarginTop'] = 'tagMarginT';
    $defaults['fFont'] = 'tagFont';
    $defaults['fCaptionMarginT'] = 'captionMarginT';
    $defaults['hlineShow'] = true;
    $defaults['showHdr'] = true;
    $defaults['F'] = '';

    $par = array_merge( $defaults, $par );
    //-----------------------------------------------
    $F = $par['F'];
    if( !empty( $F ) ) {
        $par['fTagMarginTop'] = $par['fTagMarginTop'] . '_' . $F;
        $par['fFont'] = $par['fFont'] . '_' . $F;
        $par['fCaptionMarginT'] = $par['fCaptionMarginT'] . '_' . $F;
    }
    //------------------------------------------------
    $flexCntr = abcfl_html_tag( 'div', '', 'abcflFGCntr abcflFGCntr50' );
    $flex2ColS = abcfl_html_tag( 'div', '', 'abcflFG2Col' ); 
    $flex3ColS = abcfl_html_tag( 'div', '', 'abcflFG3Col' );  
    $divE = abcfl_html_tag_end( 'div'); 
    //------------------------------------------------
    $dataTag = isset( $tplateOptns['_' . $par['fTagMarginTop']] ) ? $tplateOptns['_' . $par['fTagMarginTop']][0] : '';
    $dataFont = isset( $tplateOptns['_' . $par['fFont']] ) ? $tplateOptns['_' . $par['fFont']][0] : '';

    $dataMarginT = isset( $tplateOptns['_' . $par['fCaptionMarginT']] ) ? $tplateOptns['_' . $par['fCaptionMarginT']][0] : '';

    $cboFont = abcfsl_cbo_font_size();
    $cboMarginT  = abcfsl_cbo_txt_margin_top();

    $fieldTagMarginT = abcfl_input_cbo( $par['fTagMarginTop'], '', $cboMarginT, $dataTag, abcfsl_txta(391), abcfsl_txta(0), '100%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    $fieldFont = abcfl_input_cbo_strings( $par['fFont'], '', $cboFont, $dataFont, abcfsl_txta(392), abcfsl_txta(0), '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    
    //==  Render inputs  =====================
    abcfsl_autil_section_hline( $par );
    abcfsl_autil_section_hdr( $par );
    //----------------------------------------
    echo $flexCntr . $flex2ColS . $fieldTagMarginT . $divE . $flex2ColS . $fieldFont . abcfl_html_tag_ends( 'div,div' );
    echo abcfl_input_cbo_strings( $par['fCaptionMarginT'], '', $cboMarginT, $dataMarginT, abcfsl_txta(393), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');

}

