<?php
//TEXT FIELD BUILDER. Renders single text field, container + content.
// Called from: 
// abcfsl_cnt_txt_cntr
// abcfsl_cnt_txt_cntr_grid_a
// abcfsl_cnt_spage_txt_sections. Some of tplateOptns values are changed to single page values!
function abcfsl_cnt_txt_field( $itemOptns, $tplateOptns, $F, $fieldPar ){

    $showFieldOn = '';
    $showField = true;
    $fieldType = 'N';
    $sPgLnkShow = isset( $tplateOptns['_sPgLnkShow'] ) ? $tplateOptns['_sPgLnkShow'][0] : 'N';

    $itemID = $fieldPar['itemID'];
    $sPageUrl = $fieldPar['sPageUrl'];
    $isSingle = $fieldPar['isSingle'];
    $pfix = $fieldPar['clsPfix'];
    $hiddenFields = $fieldPar['hiddenFields'];
    $privateFields = $fieldPar['privateFields'];

     //Quit if field is not selected or hidden. //$F = F9 or SPTL
    switch ( $F ){
        case 'SL': //Social
            $showSocial = isset( $tplateOptns['_showSocial'] ) ? esc_attr( $tplateOptns['_showSocial'][0] ) : 'N';
            if( $showSocial != 'Y' ) { return ''; }

            $showFieldOn = isset( $tplateOptns['_showSocialOn'] ) ? esc_attr( $tplateOptns['_showSocialOn'][0] ) : 'Y';
            $fieldType = 'SL';
            break;
        case 'SPTL': // Single Page Text link
            //$sPgLnkShow = isset( $tplateOptns['_sPgLnkShow'] ) ? $tplateOptns['_sPgLnkShow'][0] : 'N';
            if( $sPgLnkShow == 'N' ) { return ''; }
            $showFieldOn = 'L';
            $fieldType = 'SPTL';
            break;
       default:
            $fieldType = isset( $tplateOptns['_fieldType_' . $F] ) ? esc_attr( $tplateOptns['_fieldType_' . $F][0] ) :'N';
            $hideField = isset( $tplateOptns['_hideDelete_' . $F] ) ? esc_attr( $tplateOptns['_hideDelete_' . $F][0] ) : 'N';
            $privateField = isset( $tplateOptns['_privateField_' . $F] ) ? esc_attr( $tplateOptns['_privateField_' . $F][0] ) : '0';
            
            //$hiddenFields = 0;
            //if( $fieldType == 'N' || $hideField != 'N' ) { return ''; }            
            if( abcfsl_util_hide_hidden_field( $fieldType, $hideField, $hiddenFields ) ){ return ''; }
            if( abcfsl_util_hide_private_field( $fieldType, $privateField, $privateFields ) ){ return ''; }

            $showFieldOn = isset( $tplateOptns['_showField_' . $F] ) ? esc_attr( $tplateOptns['_showField_' . $F][0] ) : 'L';
            break;
    }
    //-----------------------------------------------------
    // ADDRST
    //------------------------------------------------------
    //Quit if field is not selected or hidden.
    switch ( $showFieldOn ){
        case 'L': //List only
            if( $isSingle ){ $showField = false; }
            break;
        case 'S': //Single page only
            if( !$isSingle ){ $showField = false; }
            break;
       default:
            break;
    }
    if( !$showField ){ return ''; }
    //=================================================
    $tagCls = '';

    $tagType = '';
    $tagFont = '';
    $marginT = '';

    $tagTypeSPg = '';  
    $tagFontSPg = '';
    $marginTSPg = '';

    $lblTag = '';
    $lblFont = '';
    $lblMarginT = '';
    $lblTagSPg = '';  
    $lblFontSPg = '';
    $lblMarginTSPg = '';

    $txtTag = '';
    $txtFont = '';
    $txtMarginT = '';
    $txtTagSPg = '';  
    $txtFontSPg = '';
    $txtMarginTSPg = '';

    $tagCustomCls = '';
    $tagStyle = '';
    $lblCls = '';
    $lblStyle = '';
    $txtCls = '';
    $txtStyle = '';

    //$newTab = '';
    $lnkNT = '';
    $imgLnkLDefault = '0';
    $sPgLnkNT = '0';
    $lnkDload = '0';
    
    $aTagParts['hrefUrl'] = '';
    $aTagParts['hrefTxt'] = '';
    $aTagParts['target'] = '';
    $onclick = '';
    $args = '';

    switch ( $F ){
        // Single Page Options
        case 'SPTL':
            $lineTxt = isset( $tplateOptns['_sPgLnkTxt'] ) ? esc_attr( $tplateOptns['_sPgLnkTxt'][0] ) : '';
            $imgLnkLDefault = isset( $tplateOptns['_imgLnkLDefault'] ) ? $tplateOptns['_imgLnkLDefault'][0] : 0;
            $sPgLnkNT = isset( $tplateOptns['_sPgLnkNT'] ) ? $tplateOptns['_sPgLnkNT'][0] : 0;

            $tagType = isset( $tplateOptns['_sPgLnkTag'] ) ? $tplateOptns['_sPgLnkTag'][0] : 'div';
            $tagCustomCls = isset( $tplateOptns['_sPgLnkCls'] ) ? esc_attr( $tplateOptns['_sPgLnkCls'][0] ) : '';
            $tagStyle = isset( $tplateOptns['_sPgLnkStyle'] ) ? esc_attr( $tplateOptns['_sPgLnkStyle'][0] ) : '';
            //$tagStyle = '';
            $marginT = isset( $tplateOptns['_sPgLnkMarginT'] ) ? $tplateOptns['_sPgLnkMarginT'][0] : 'N';
            $tagFont = isset( $tplateOptns['_sPgLnkFont'] ) ? $tplateOptns['_sPgLnkFont'][0] : 'D';
            break;
       default:
            $tagType = isset( $tplateOptns['_tagType_' . $F] ) ? esc_attr( $tplateOptns['_tagType_' . $F][0] ) : 'div';            
            $tagFont = isset( $tplateOptns['_tagFont_' . $F] ) ? esc_attr( $tplateOptns['_tagFont_' . $F][0] ) : 'D';
            $marginT = isset( $tplateOptns['_tagMarginT_' . $F] ) ? esc_attr( $tplateOptns['_tagMarginT_' . $F][0] ) : 'N';

            //spg tag type will always default to div. Staff setting will be disregarded. Font and margins will be used if spg values are not set.
            $tagTypeSPg = isset( $tplateOptns['_tagTypeSPg_' . $F] ) ? esc_attr( $tplateOptns['_tagTypeSPg_' . $F][0] ) : 'div';
            $tagFontSPg = isset( $tplateOptns['_tagFontSPg_' . $F] ) ? esc_attr( $tplateOptns['_tagFontSPg_' . $F][0] ) : '';
            $marginTSPg = isset( $tplateOptns['_tagMarginTSPg_' . $F] ) ? esc_attr( $tplateOptns['_tagMarginTSPg_' . $F][0] ) : '';

            $lblTag = isset( $tplateOptns['_lblTag_' . $F] ) ? esc_attr( $tplateOptns['_lblTag_' . $F][0] ) : 'div';            
            $lblFont = isset( $tplateOptns['_lblFont_' . $F] ) ? esc_attr( $tplateOptns['_lblFont_' . $F][0] ) : '';
            $lblMarginT = isset( $tplateOptns['_lblMarginT_' . $F] ) ? esc_attr( $tplateOptns['_lblMarginT_' . $F][0] ) : '';

            $lblTagSPg = isset( $tplateOptns['_lblTagSPg_' . $F] ) ? esc_attr( $tplateOptns['_lblTagSPg_' . $F][0] ) : 'div';
            $lblFontSPg = isset( $tplateOptns['_lblFontSPg_' . $F] ) ? esc_attr( $tplateOptns['_lblFontSPg_' . $F][0] ) : '';
            $lblMarginTSPg = isset( $tplateOptns['_lblMarginTSPg_' . $F] ) ? esc_attr( $tplateOptns['_lblMarginTSPg_' . $F][0] ) : '';

            $txtTag = isset( $tplateOptns['_txtTag_' . $F] ) ? esc_attr( $tplateOptns['_txtTag_' . $F][0] ) : 'div';            
            $txtFont = isset( $tplateOptns['_txtFont_' . $F] ) ? esc_attr( $tplateOptns['_txtFont_' . $F][0] ) : '';
            $txtMarginT = isset( $tplateOptns['_txtMarginT_' . $F] ) ? esc_attr( $tplateOptns['_txtMarginT_' . $F][0] ) : '';

            $txtTagSPg = isset( $tplateOptns['_txtTagSPg_' . $F] ) ? esc_attr( $tplateOptns['_txtTagSPg_' . $F][0] ) : 'div';
            $txtFontSPg = isset( $tplateOptns['_txtFontSPg_' . $F] ) ? esc_attr( $tplateOptns['_txtFontSPg_' . $F][0] ) : '';
            $txtMarginTSPg = isset( $tplateOptns['_txtMarginTSPg_' . $F] ) ? esc_attr( $tplateOptns['_txtMarginTSPg_' . $F][0] ) : '';            

            $tagCustomCls = isset( $tplateOptns['_tagCls_' . $F] ) ? esc_attr( $tplateOptns['_tagCls_' . $F][0] ) : '';
            $tagStyle = isset( $tplateOptns['_tagStyle_' . $F] ) ? esc_attr( $tplateOptns['_tagStyle_' . $F][0] ) : '';            
            $lblCls = isset( $tplateOptns['_lblCls_' . $F] ) ? esc_attr( $tplateOptns['_lblCls_' . $F][0] ) : '';
            $lblStyle = isset( $tplateOptns['_lblStyle_' . $F] ) ? esc_attr( $tplateOptns['_lblStyle_' . $F][0] ) : '';
            $txtCls = isset( $tplateOptns['_txtCls_' . $F] ) ? esc_attr( $tplateOptns['_txtCls_' . $F][0] ) : '';
            $txtStyle = isset( $tplateOptns['_txtStyle_' . $F] ) ? esc_attr( $tplateOptns['_txtStyle_' . $F][0] ) : '';

            // HTML
            $lineTxt = isset( $itemOptns['_txt_' . $F] ) ? $itemOptns['_txt_' . $F][0]  : '';   
            
            //+++ NEW TAB +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            $lnkNT = isset( $tplateOptns['_lnkNT_' . $F] ) ? $tplateOptns['_lnkNT_' . $F][0] : '0';
            //if( $lnkNT == '1' ) { $lnkNT = '_blank'; } NOT USED

            //Get href parts: url + link text + target (lnkNT). Returns empty if no URL            
            //$aTagParts = abcfsl_spg_a_tag_parts( $itemOptns, $itemID, $sPageUrl, $F ); REPLACED
            $aTagPar['url'] = isset( $itemOptns['_url_' . $F] ) ? esc_attr( $itemOptns['_url_' . $F][0] ) : '';
            $aTagPar['urlTxt'] = isset( $itemOptns['_urlTxt_' . $F] ) ? esc_attr( $itemOptns['_urlTxt_' . $F][0] ) : '';
            $aTagPar['lnkNT'] = $lnkNT;
            $aTagParts = abcfsl_util_a_tag_parts( $aTagPar, $F ); 

            $argsIn['lnkDload'] = isset( $tplateOptns['_lnkDload_' . $F] ) ? $tplateOptns['_lnkDload_' . $F][0] : '0';
            //String to be used for args
            $args = abcfsl_util_par_args_builder( $argsIn );

            break;
    }

    //-- Field container classes -------------------
    //$tagCls =  abcfsl_util_field_tag_cls_bldr( $marginT, $tagFont, $tagCustomCls, $isSingle, $pfix );
    $tagCls =  abcfsl_util_field_tag_cls_bldr_staff_or_single( $tagFont, $marginT, $tagFontSPg, $marginTSPg, $tagCustomCls, $isSingle, $pfix );
    $lblAboveCls = abcfsl_cnt_txt_field_cls_above( $fieldType,  $lblFont, $lblMarginT, $lblFontSPg, $lblMarginTSPg, $lblCls, $isSingle, $pfix );
    $txtAboveCls = abcfsl_cnt_txt_field_cls_above( $fieldType, $txtFont, $txtMarginT, $txtFontSPg, $txtMarginTSPg, $txtCls, $isSingle, $pfix );

    //------------------------------------------------------------
    //'locale' => isset( $tplateOptns['_locale_' . $F] ) ? esc_attr( $tplateOptns['_locale_' . $F][0] ) : '',
    //fieldTypeF  = field type and F number.
    $par = array(
        'F' => $F,
        'masterF' => '',
        'fieldType' => $fieldType,
        'fieldTypeF' => ' ' . $fieldType . '-' . $F,            
        
        'tagFont' => $tagFont, 
        'tagMarginT' => $marginT, 
        'tagCustomCls' => $tagCustomCls,

        'tagType' => $tagType,
        'lblTag' => $lblTag,
        'txtTag' => $txtTag,
        'tagCls' => $tagCls,        
        'lblAboveCls' => $lblAboveCls,        
        'txtAboveCls' => $txtAboveCls,        
        'capMarginT' => isset( $tplateOptns['_captionMarginT_' . $F] ) ? $tplateOptns['_captionMarginT_' . $F][0] : 'N',
        'lblCls' => isset( $tplateOptns['_lblCls_' . $F] ) ? esc_attr( $tplateOptns['_lblCls_' . $F][0] ) : '',
        'txtCls' => isset( $tplateOptns['_txtCls_' . $F] ) ? esc_attr( $tplateOptns['_txtCls_' . $F][0] ) : '',
        'tagStyle' => $tagStyle,
        'lnkCls' => isset( $tplateOptns['_lnkCls _' . $F] ) ? esc_attr( $tplateOptns['_lnkCls_' . $F][0] ) : '',
        'lnkStyle' => isset( $tplateOptns['_lnkStyle_' . $F] ) ? esc_attr( $tplateOptns['_lnkStyle_' . $F][0] ) : '',               
        'lblStyle' => isset( $tplateOptns['_lblStyle_' . $F] ) ? esc_attr( $tplateOptns['_lblStyle_' . $F][0] ) : '',        
        'txtStyle' => isset( $tplateOptns['_txtStyle_' . $F] ) ? esc_attr( $tplateOptns['_txtStyle_' . $F][0] ) : '',
        'showAsTxt' => isset( $tplateOptns['_showAsTxt_' . $F] ) ? esc_attr( $tplateOptns['_showAsTxt_' . $F][0] ) : '0',
        'cbomLayout' => isset( $tplateOptns['_cbomLayout_' . $F] ) ? $tplateOptns['_cbomLayout_' . $F][0] : 'R',

        'sortTxt'  => isset( $itemOptns['_sortTxt'] ) ? esc_attr( $itemOptns['_sortTxt'][0] ) : '', 
        'dteYMD'  => isset( $itemOptns['_dteYMD_' . $F] ) ?  $itemOptns['_dteYMD_' . $F][0] : '', 
        'dtFormat'  => isset( $tplateOptns['_dtFormat_' . $F] ) ? $tplateOptns['_dtFormat_' . $F][0] : '',

        'lblTxt' => isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '', 
        'url' => isset( $itemOptns['_url_' . $F] ) ? esc_attr( $itemOptns['_url_' . $F][0] ) : '',
        'urlTxt' => isset( $itemOptns['_urlTxt_' . $F] ) ? esc_attr( $itemOptns['_urlTxt_' . $F][0] ) : '',
        'tapAction' => isset( $itemOptns['_tapAction_' . $F] ) ? esc_attr( $itemOptns['_tapAction_' . $F][0] ) : '',

        'sPgLnkShow' => $sPgLnkShow,
        'lnkNT' => $lnkNT,
        'imgLnkLDefault' => $imgLnkLDefault,
        'sPgLnkNT' => $sPgLnkNT,
        'lineTxt'  => $lineTxt,        
        'hrefUrl' => $aTagParts['hrefUrl'],
        'hrefTxt' => $aTagParts['hrefTxt'],
        'target' => $aTagParts['target'],
        //'lnkDload' => $par['lnkDload'] = isset( $tplateOptns['_lnkDload_' . $F] ) ? $tplateOptns['_lnkDload_' . $F][0] : '0',

        'cbom' => isset( $itemOptns['_cbom_' . $F] ) ?  $itemOptns['_cbom_' . $F][0]  : '', 
        'checkg' => isset( $itemOptns['_checkg_' . $F] ) ?  $itemOptns['_checkg_' . $F][0]  : '',       
        'cbomSort' => isset( $tplateOptns['_cbomSort_' . $F] ) ? $tplateOptns['_cbomSort_' . $F][0] : 'N',
        'cbomSortLocale' => isset( $tplateOptns['_cbomSortLocale_' . $F] ) ? $tplateOptns['_cbomSortLocale_' . $F][0] : '',        
        'sPageUrl' => $sPageUrl,
        'itemID'  => $itemID,
        'isSingle'  => $isSingle,
        'clsPfix'  => $pfix,
        'statTxt'  => isset( $tplateOptns['_statTxt_' . $F] ) ? $tplateOptns['_statTxt_' . $F][0] : '',
        'statTxtFs'  => isset( $tplateOptns['_statTxtFs_' . $F] ) ? $tplateOptns['_statTxtFs_' . $F][0] : '',
        'onclick' => $onclick,
        'args' => $args
    );

    $editorCnt  = isset( $itemOptns['_editorCnt_' . $F] ) ? esc_attr( $itemOptns['_editorCnt_' . $F][0] ) : '';
    $noAutop = isset( $tplateOptns['_noAutop_' . $F] ) ? $tplateOptns['_noAutop_' . $F][0] : '';
    $excludedSlugs = isset( $tplateOptns['_excludedSlugs_' . $F] ) ? esc_attr( $tplateOptns['_excludedSlugs_' . $F][0] ) : '';

    $out = '';
    switch ( $fieldType ){
        case 'T': //Text
        case 'PT': //Paragraph Text
        case 'CBO':
            $out = abcfsl_cnt_field_T( $par );
            break;
        case 'LT': //Static Lbl + Text
        case 'LBLCBO': //Drop-Down List + Static Label
            $out = abcfsl_cnt_field_LT( $par );
            break;
        case 'LTABOVE': //Static Label (above) + Text
        case 'PTABOVE': 
            $out = abcfsl_cnt_field_LTABOVE( $par );
            break;            
        case 'STXT': //Static Text
            $out = abcfsl_cnt_field_STXT( $par, $tplateOptns, $itemOptns, $F );
            break;
        case 'H': //Hyperlink
            $out = abcfsl_cnt_field_H( $par );
            break;
        case 'TH': //Static Text + Hyperlink
            $out = abcfsl_cnt_field_TH( $par );
            break;
        case 'EM': //Email
            $out = abcfsl_cnt_field_EM( $par );
            break;
        case 'STXEM': //Email with static text
            $out = abcfsl_cnt_field_STXEM( $par );
            break;
        case 'SLFONE': //Phone with static text
            $out = abcfsl_cnt_fone_field_SLFONE( $par );
            break;
        case 'FONE': //Phone
            $out = abcfsl_cnt_fone_field_FONE( $par );
            break;                                    
         case 'MP': //Multipart
            $out = abcfsl_cnt_MP( $par, $tplateOptns, $itemOptns );            
            break;
        case 'CE': //HTML
            $out = abcfsl_cnt_field_WPE( $par, $editorCnt, $noAutop );
            break;
        case 'HL': //Horizontal Line
            $out = abcfsl_cnt_field_HL( $par['tagCls'], $par['tagStyle'], $pfix );
            break;
        case 'SC': //Shortcode
            $out = abcfsl_cnt_field_SC( $par );
            break;
        case 'SPTL':  //Single Page Text Link
            $out = abcfsl_cnt_field_SPTL( $par, $itemOptns );
            break;
        case 'SL': //Social Links
            $out = abcfsl_cnt_icons_field_SL( $par, $itemOptns, $tplateOptns );
            break;
        case 'IMGCAP': //image with caption
            $out = abcfsl_cnt_txt_img_field_IMGCAP( $par, $itemOptns );
            break;
        case 'IMGHLNK': //image hyperlink with caption
            $out = abcfsl_cnt_txt_img_field_IMGHLNK( $par, $itemOptns );
            break;
        case 'SLDTE': //Static lbl + date
            $out = abcfsl_cnt_date_field_SLDTE( $par, $itemOptns );
            break;            
        case 'CBOM': //Multiple Drop-downs.    
            $out = abcfsl_cnt_field_CBOM( $par );
            break;            
        case 'CHECKG': //Checkbox group.
            $out = abcfsl_cnt_field_CHECKG( $par );
            break; 
        case 'STARR': 
            $out = abcfsl_cnt_icons_field_STARR( $par, $tplateOptns, $itemOptns, $F );
            break; 
        case 'ICONLNK': 
            $out = abcfsl_cnt_icons_field_ICONLNK( $par, $tplateOptns, $itemOptns );
            break;  
        case 'STFFCAT': 
            $out = abcfsl_cnt_cats_field_STFFCAT( $par, $excludedSlugs );
            break; 
        case 'POSTTITLE':             
            $out = abcfsl_cnt_field_POSTTITLE( $par );
            break; 
        case 'SORTTXT':             
            $out = abcfsl_cnt_field_SORTTXT( $par );
            break; 
        case 'VCARDHL': 
            $out = abcfsl_cnt_field_VCARDHL( $par, $tplateOptns, $itemOptns );
            break;
        case 'QRIMGCAP64STA': 
            $out = abcfsl_cnt_vcard_QRIMGCAP64STA( $par, $tplateOptns, $itemOptns );
            break; 
        case 'QRIMGCAP64DYN': 
            $out = abcfsl_cnt_vcard_QRIMGCAP64DYN( $par, $tplateOptns, $itemOptns );
            break;             
        case 'ADDRST': 
            $out = abcfsl_cnt_ADDRST( $par, $tplateOptns, $itemOptns );
            break; 
        case 'ADDR': 
            $out = abcfsl_cnt_ADDR( $par, $tplateOptns, $itemOptns );
            break;
        case 'QRHL64STA': 
            $out = abcfsl_cnt_field_QRHL64STA( $par, $tplateOptns, $itemOptns );
            break;
        case 'QRHL64DYN': 
            $out = abcfsl_cnt_field_QRHL64DYN( $par, $tplateOptns, $itemOptns );
            break;                                                                                                                                       
       default:
            break;
    }

    return $out;
}

function abcfsl_cnt_txt_field_cls_above( $fieldType, $font, $marginT, $fontSPg, $marginTSPg, $cls, $isSingle, $pfix ){

    $out = '';
    switch ( $fieldType ){
        case 'LTABOVE':
        case 'PTABOVE':            
        case 'ADDRST':
        case 'ADDR':         
            $out =  abcfsl_util_field_tag_cls_bldr_staff_or_single( $font, $marginT, $fontSPg, $marginTSPg, $cls, $isSingle, $pfix );
            break;
        default:
            break; 
    }    
    return $out;
}