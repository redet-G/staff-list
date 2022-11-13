<?php
function abcfsl_struct_data( $graphItems ){

    if ( ! is_array( $graphItems ) || empty( $graphItems ) ) { return ''; }

    //Remove null and empty values.
    $graphItems = array_filter( $graphItems );
    if( empty( $graphItems ) ){ return ''; }

    $ldJSON = [
        '@context' => 'https://schema.org',
        '@graph'   => $graphItems,
    ];

    $out =  "\r\n";
    $out .= '<script type="application/ld+json">' .  "\r\n";
    $out .= abcfl_html_json_out( $ldJSON );
    //$out .= ';' .  "\n";
    $out .= '<';
    $out .= '/script>';
    $out .=  "\r\n";

    return $out;
}

//Returns array
function abcfsl_struct_data_item_grid( $tplateOptns, $itemOptns, $staffID, $fieldOrder ){
    return abcfsl_struct_data_item_array ( $tplateOptns, $itemOptns, false, $staffID, $fieldOrder );
}

function abcfsl_struct_data_item_single( $tplateOptns, $itemOptns, $fieldOrder){
    return abcfsl_struct_data_item_array ( $tplateOptns, $itemOptns, true, '', $fieldOrder );
}

function abcfsl_struct_data_item_array ( $tplateOptns, $itemOptns, $isSingle, $staffID, $fieldOrder ){

    $sdType = isset( $tplateOptns['_sdType'] ) ? esc_attr( $tplateOptns['_sdType'][0] ) : '';
    if( empty( $sdType ) ){ return array(); }

    //$itemArray['@context'] = 'https://schema.org';
    $itemArray['@type'] = $sdType;
    $itemArray = abcfsl_struct_data_tplate_embed_options ( $tplateOptns, $itemArray );

    foreach ( $fieldOrder as $F ) {

        $out = abcfsl_struct_data_txt_field( $itemOptns, $tplateOptns, $F, $isSingle, $staffID );
        if( !$out['addItem'] ) { continue; }

        if( empty( $out['sdEmbededProperty'] ) ){
            $itemArray[$out['sdProperty']] = $out['sdValue'];
        }
        else{
            $itemArray[$out['sdProperty']][$out['sdEmbededProperty']] = $out['sdValue'];
        }
    }

    $imgUrl = abcfsl_struct_data_img_url( $itemOptns, $isSingle );
    $social = abcfsl_struct_data_social_items( $tplateOptns, $itemOptns );

    if( !empty( $social ) ){ $itemArray['sameAs'] = $social; }
    if( !empty( $imgUrl ) ){ $itemArray['image'] = $imgUrl; }

    return $itemArray;
}

//== TEMPLATE OPTIONS  ======================================
function abcfsl_struct_data_tplate_embed_options ( $tplateOptns, $itemArray ){

    $out['addItem'] = false;
    $out['sdProperty'] = '';

    $sdEmbededProperty = isset( $tplateOptns['_sdEmbededProperty'] ) ? esc_attr( $tplateOptns['_sdEmbededProperty'][0] ) : '';
    $sdEmbed1Type = isset( $tplateOptns['_sdEmbed1Type'] ) ? esc_attr( $tplateOptns['_sdEmbed1Type'][0] ) : '';
    $sdEmbed1Value = isset( $tplateOptns['_sdEmbed1Value'] ) ? esc_attr( $tplateOptns['_sdEmbed1Value'][0] ) : '';
    $sdEmbed2Type = isset( $tplateOptns['_sdEmbed2Type'] ) ? esc_attr( $tplateOptns['_sdEmbed2Type'][0] ) : '';
    $sdEmbed2Value = isset( $tplateOptns['_sdEmbed2Value'] ) ? esc_attr( $tplateOptns['_sdEmbed2Value'][0] ) : '';

    //First set of options has to have values. Other set is optional.
    if( empty( $sdEmbededProperty ) || empty( $sdEmbed1Type ) || empty( $sdEmbed1Value ) ) { return $itemArray; }

    $itemArray[$sdEmbededProperty][$sdEmbed1Type] = $sdEmbed1Value;
    if( !empty( $sdEmbededProperty ) && !empty( $sdEmbed1Type ) ) { $itemArray[$sdEmbededProperty][$sdEmbed2Type] = $sdEmbed2Value; }

    return $itemArray;
}

//== ITEMS =======================================
function abcfsl_struct_data_item_properties( $sdProperty ){

    $out['property'] = '';
    $out['embededProperty'] = '';

    if( empty( $sdProperty ) ){ return $out; }

    $pos = strpos( $sdProperty, '|');

    if($pos === false) {
        $out['property'] = $sdProperty;
    }
    else {
        $sdProperty = str_replace(' ', '', $sdProperty);
        $count = strlen($sdProperty) - strlen(str_replace(str_split('|'), '', $sdProperty));
        if( $count > 1 ) { return $out; }
        $properties = explode('|', $sdProperty);
        if( count($properties) != 2 ) { return $out; }

        $out['property'] = $properties[0];
        $out['embededProperty'] = $properties[1];
    }

    return $out;
}

function abcfsl_struct_data_img_url( $itemOptns, $isSingle ){

    $imgUrlL = isset( $itemOptns['_imgUrlL'] ) ? esc_attr( $itemOptns['_imgUrlL'][0] ) : '';
    if( !$isSingle ) { return $imgUrlL; }

    $imgUrlS = isset( $itemOptns['_imgUrlS'] ) ? esc_attr( $itemOptns['_imgUrlS'][0] ) : '';
    if( $imgUrlS == 'SP' ){ return $imgUrlL; }

    return $imgUrlS;
}

function abcfsl_struct_data_social_items( $tplateOptns, $itemOptns ){

    $sameAs = array();
    $showSocial = isset( $tplateOptns['_showSocial'] ) ? esc_attr( $tplateOptns['_showSocial'][0] ) : 'N';
    if( $showSocial != 'Y' ) { return $sameAs; }

    $fbookUrl = isset( $itemOptns['_fbookUrl'] ) ? esc_attr( $itemOptns['_fbookUrl'][0] ) : '';
    $twitUrl = isset( $itemOptns['_twitUrl'] ) ? esc_attr( $itemOptns['_twitUrl'][0] ) : '';
    $googlePlusUrl = isset( $itemOptns['_googlePlusUrl'] ) ? esc_attr( $itemOptns['_googlePlusUrl'][0] ) : '';
    $likedUrl = isset( $itemOptns['_likedUrl'] ) ? esc_attr( $itemOptns['_likedUrl'][0] ) : '';
    $socialC1Url = isset( $itemOptns['_socialC1Url'] ) ? esc_attr( $itemOptns['_socialC1Url'][0] ) : '';
    $socialC2Url = isset( $itemOptns['_socialC2Url'] ) ? esc_attr( $itemOptns['_socialC2Url'][0] ) : '';
    $socialC3Url = isset( $itemOptns['_socialC3Url'] ) ? esc_attr( $itemOptns['_socialC3Url'][0] ) : '';

    if( !empty( $fbookUrl ) ){ $sameAs[] =  abcfsl_struct_data_remove_nt( $fbookUrl ); }
    if( !empty( $twitUrl ) ){ $sameAs[] =  abcfsl_struct_data_remove_nt( $twitUrl ); }
    if( !empty( $googlePlusUrl ) ){ $sameAs[] =  abcfsl_struct_data_remove_nt( $googlePlusUrl ); }
    if( !empty( $likedUrl ) ){ $sameAs[] =  abcfsl_struct_data_remove_nt( $likedUrl ); }

    if( !empty( $socialC1Url ) ){
        $urlNT = abcfsl_struct_data_remove_nt( $socialC1Url );
        if( !empty( $urlNT )) {
            $urlTel = abcfsl_struct_data_remove_social_tel( $urlNT );
            if( !empty( $urlTel )) {
                $sameAs[] =  $urlTel;
            }
        }
    }

    if( !empty( $socialC2Url ) ){
        $urlNT = abcfsl_struct_data_remove_nt( $socialC2Url );
        if( !empty( $urlNT )) {
            $urlTel = abcfsl_struct_data_remove_social_tel( $urlNT );
            if( !empty( $urlTel )) {
                $sameAs[] =  $urlTel;
            }
        }
    }

    if( !empty( $socialC3Url ) ){
        $urlNT = abcfsl_struct_data_remove_nt( $socialC3Url );
        if( !empty( $urlNT )) {
            $urlTel = abcfsl_struct_data_remove_social_tel( $urlNT );
            if( !empty( $urlTel )) {
                $sameAs[] =  $urlTel;
            }
        }
    }
    //if( !empty( $socialC2Url ) ){ $sameAs[] =  abcfsl_struct_data_remove_nt( $socialC2Url ); }
    //if( !empty( $socialC3Url ) ){ $sameAs[] =  abcfsl_struct_data_remove_nt( $socialC3Url ); }

    return $sameAs;
}

function abcfsl_struct_data_add_field( $tplateOptns, $F, $isSingle ){

    $out['showField'] = false;
    $out['fieldType'] = '';
    $out['sdProperty'] = '';

     //Quit if field is not selected or hidden.
    switch ( $F ){
        case 'SL': //Social
            break;
        case 'SPTL': //Single Page Text link
            $out = abcfsl_struct_data_add_field_SPTL( $tplateOptns, $isSingle );
            break;
       default:
            $out = abcfsl_struct_data_add_field_F( $tplateOptns, $F, $isSingle );
            break;
    }

    return $out;
}

function abcfsl_struct_data_add_field_F( $tplateOptns, $F, $isSingle ){

    $out['showField'] = false;
    $out['fieldType'] = '';
    $out['sdProperty'] = '';
    $out['sdEmbededProperty'] = '';

   //Field not used foe structural data.
    $sdProperty = isset( $tplateOptns['_sdProperty_' . $F] ) ? esc_attr( $tplateOptns['_sdProperty_' . $F][0] ) : '';
    if( empty( $sdProperty ) ){ return $out; }

    $properties = abcfsl_struct_data_item_properties( $sdProperty );
    if( empty( $properties['property'] ) ){ return $out; }

    $fieldType = isset( $tplateOptns['_fieldType_' . $F] ) ? esc_attr( $tplateOptns['_fieldType_' . $F][0] ) :'N';
    $hideField = isset( $tplateOptns['_hideDelete_' . $F] ) ? esc_attr( $tplateOptns['_hideDelete_' . $F][0] ) : 'N';
    if( $fieldType == 'N' || $hideField != 'N' ) { return $out; }

    $showFieldOn = isset( $tplateOptns['_showField_' . $F] ) ? esc_attr( $tplateOptns['_showField_' . $F][0] ) : 'L';

    switch ( $showFieldOn ){
        case 'L': //List only
            if( $isSingle ){ return $out; }
            break;
        case 'S': //Single page only
            if( !$isSingle ){ return $out; }
            break;
       default:
            break;
    }

    $out['showField'] = true;
    $out['fieldType'] = $fieldType;
    $out['sdProperty'] =  $properties['property'];
    $out['sdEmbededProperty'] =  $properties['embededProperty'];

    return $out;
}

function abcfsl_struct_data_add_field_SPTL( $tplateOptns, $isSingle ){

    $out['showField'] = false;
    $out['fieldType'] = '';
    $out['sdProperty'] = '';
    $out['sdEmbededProperty'] = '';

    if( $isSingle ){ return $out; }

    //Field not selected for structural data.
    $sdProperty = isset( $tplateOptns['_sdPropertySPTL'] ) ? esc_attr( $tplateOptns['_sdPropertySPTL'][0] ) : '';
    if( empty( $sdProperty ) ){ return $out; }

    $properties = abcfsl_struct_data_item_properties( $sdProperty );
    if( empty( $properties['property'] ) ){ return $out; }

    $sPgLnkShow = isset( $tplateOptns['_sPgLnkShow'] ) ? esc_attr( $tplateOptns['_sPgLnkShow'][0] ) : 'N';
    if( $sPgLnkShow == 'N') { return $out; }

    $out['showField'] = true;
    $out['fieldType'] = 'SPTL';
    $out['sdProperty'] =  $properties['property'];
    $out['sdEmbededProperty'] =  $properties['embededProperty'];

    return $out;
}

//TEXT FIELD BUILDER. Renders single text fiel, dcontainer + content.
function abcfsl_struct_data_txt_field( $itemOptns, $tplateOptns, $F, $isSingle, $staffID ){

    $showField['showField'] = false;
    $showField['fieldType'] = '';
    $showField['sdProperty'] = '';
    $showField['sdEmbededProperty'] = '';

    $showField = abcfsl_struct_data_add_field( $tplateOptns, $F, $isSingle );

    $out['addItem'] = false;
    $out['sdProperty'] = '';
    $out['sdEmbededProperty'] = '';
    $out['sdValue'] = '';

    if( !$showField['showField'] ) { return $out;}

    $fieldType = $showField['fieldType'];
    $out['sdProperty'] = $showField['sdProperty'];
    $out['sdEmbededProperty'] = $showField['sdEmbededProperty'];

    //------------------------------------
    switch ($fieldType){
        case 'T': //Text
        case 'PT': //Paragraph Text
        case 'LT': //Lsbel + Text
        case 'CBO':
        case 'LBLCBO':        
            $out = abcfsl_struct_data_field_value_T( $itemOptns, $F, $out );
            break;
        case 'H': //Hyperlink
        case 'TH': //Static Text + Hyperlink
            $out = abcfsl_struct_data_field_value_H( $tplateOptns, $itemOptns, $F, $out );
            break;
        case 'EM': //Email
        case 'FONE':
        case 'SLFONE':             
            $out = abcfsl_struct_data_field_value_EM( $itemOptns, $F, $out );
            break;
         case 'MP': //Multipart
            $out = abcfsl_struct_data_field_value_MP( $tplateOptns, $itemOptns, $F, $isSingle, $out );
            break;
        case 'CE': //HTML
            $out = abcfsl_struct_data_field_value_WPE( $itemOptns, $F, $out );
            break;
        case 'SPTL':  //Single Page Text Link
            $out = abcfsl_struct_data_field_value_SPTL( $staffID, $tplateOptns, $itemOptns, $out );
            break;
        case 'POSTTITLE':
            $out = abcfsl_struct_data_field_value_POSTTITLE( $staffID, $out );  
            break; 
        case 'SORTTXT':
            $out = abcfsl_struct_data_field_value_SORTTXT( $staffID, $out );  
            break;            
        case 'FONE':
        case 'SLFONE':             
            $out = abcfsl_struct_data_field_value_FONE( $itemOptns, $F, $out );
            break;             
        case 'CHECKG':  
            $out = abcfsl_struct_data_field_value_CHECKG( $itemOptns, $F, $out );
            break;
        case 'CBOM':  
            $out = abcfsl_struct_data_field_value_CBOM( $itemOptns, $F, $out );
            break; 
        case 'SLDTE':  
            $out = abcfsl_struct_data_field_value_SLDTE( $tplateOptns, $staffID, $out );
            break;
        case 'STFFCAT':  
            $out = abcfsl_struct_data_field_value_STFFCAT( $tplateOptns, $staffID, $F, $out );
            break; 
        case 'STXEM':  
            $out = abcfsl_struct_data_field_value_STXEM( $itemOptns, $F, $out );
            break;  
        case 'STXT':  
            $out = abcfsl_struct_data_field_value_STXT( $tplateOptns, $F, $out );
            break;                                                                                                       
       default:
            break;
    }
    return $out;

    // 'ICONLNK'  => 'Icon Font with Links',  ??????         
    // 'IMGCAP'  => 'Image + Caption',   ???????         
    // 'IMGHLNK'  => 'Image Hyperlink + Caption', ???????
}

function abcfsl_struct_data_field_value_STXT( $tplateOptns, $F, $out ){

    $txt = isset( $tplateOptns['_statTxt_' . $F] ) ? esc_attr( $tplateOptns['_statTxt_' . $F][0] ) : '';
    if( empty( $txt )) { return $out; }

    $out['addItem'] = true;
    $out['sdValue'] = strip_tags( $txt );
    return $out;
}

function abcfsl_struct_data_field_value_STXEM( $itemOptns, $F, $out ){

    $itemUrl = isset( $itemOptns['_url_' . $F] ) ? esc_attr( $itemOptns['_url_' . $F][0] ) : '';
    if( empty( $itemUrl )) { return $out; }

    $out['addItem'] = true;
    $out['sdValue'] = $itemUrl;
    return $out;
}

function abcfsl_struct_data_field_value_STFFCAT( $tplateOptns, $staffID, $F, $out ){

    $excludedSlugs = isset( $tplateOptns['_excludedSlugs_' . $F] ) ? esc_attr( $tplateOptns['_excludedSlugs_' . $F][0] ) : '';

    $cats = abcfsl_cnt_cats_staff_member( $staffID, $excludedSlugs );
    if( empty( $cats ) ) { return $out; }

    $out['addItem'] = true;
    $out['sdValue'] = $cats;
    return $out;
}

function abcfsl_struct_data_field_value_SORTTXT( $staffID, $out ){

    $sortTxt = isset( $itemOptns['_sortTxt'] ) ? esc_attr( $itemOptns['_sortTxt'][0] ) : '';
    if( empty( $sortTxt )) { return $out; }

    $out['addItem'] = true;
    $out['sdValue'] = strip_tags( $sortTxt );
    return $out;
}

function abcfsl_struct_data_field_value_POSTTITLE( $staffID, $out ){

    //$post = get_post( $staffID ); 
    //$postTitle = $post->post_title;
    //$postTitle = esc_html( $postTitle );
    $postTitle = abcfsl_db_get_post_title( $staffID );
    if( empty( $postTitle ) ) { return $out; }

    $out['addItem'] = true;
    $out['sdValue'] = strip_tags( $postTitle );
    return $out;
}

function abcfsl_struct_data_field_value_FONE( $itemOptns, $F, $out ){

    $txt = isset( $itemOptns['_urlTxt_' . $F] ) ? esc_attr( $itemOptns['_urlTxt_' . $F][0] ) : '';
    if( empty( $txt ) ) { return $out; }

    $out['addItem'] = true;
    $out['sdValue'] = strip_tags( $txt );
    return $out;
}

function abcfsl_struct_data_field_value_CHECKG( $itemOptns, $F, $out ){

    $txt = isset( $itemOptns['_checkg_' . $F] ) ? esc_attr( $itemOptns['_checkg_' . $F][0] ) : '';
    if( empty( $txt ) ) { return $out; }

    $out['addItem'] = true;
    $out['sdValue'] = strip_tags( $txt );
    return $out;
}

function abcfsl_struct_data_field_value_CBOM( $itemOptns, $F, $out ){

    $txt = isset( $itemOptns['_cbom_' . $F] ) ? esc_attr( $itemOptns['_cbom_' . $F][0] ) : '';
    if( empty( $txt ) ) { return $out; }

    $out['addItem'] = true;
    $out['sdValue'] = strip_tags( $txt );
    return $out;
}

function abcfsl_struct_data_field_value_SLDTE( $itemOptns, $F, $out ){  

    $txt = isset( $itemOptns['_dteYMD_' . $F] ) ? esc_attr($itemOptns['_dteYMD_' . $F][0] ) : '';
    if( empty( $txt )) { return $out; }

    $out['addItem'] = true;
    $out['sdValue'] = strip_tags( $txt );
    return $out;
}

//------------------------------------------
function abcfsl_struct_data_field_value_SPTL( $staffID, $tplateOptns, $itemOptns, $out ){

    $sPageUrl = isset( $tplateOptns['_sPageUrl'] ) ? esc_attr( $tplateOptns['_sPageUrl'][0] ) : '';
    if( empty( $sPageUrl )) { return $out; }

    $pretty = isset( $itemOptns['_pretty'] ) ? esc_attr( $itemOptns['_pretty'][0] ) : '';
    //--------------------------------------------
    $urlSelector = abcfsl_spg_a_tag_url_selector_legacy( $staffID, 'SP', $sPageUrl, $pretty );
    $url = $urlSelector['hrefUrl'];
    if(empty($url) ) { return $out; }

    $out['addItem'] = true;
    $out['sdValue'] = $urlSelector['hrefUrl'];
    return $out;
}

function abcfsl_struct_data_field_value_T( $itemOptns, $F, $out ){

    $txt = isset( $itemOptns['_txt_' . $F] ) ? esc_attr($itemOptns['_txt_' . $F][0] ) : '';
    if( empty( $txt )) { return $out; }

    $out['addItem'] = true;
    $out['sdValue'] = strip_tags( $txt );
    return $out;
}

function abcfsl_struct_data_field_value_H( $tplateOptns, $itemOptns, $F, $out ){

    $itemUrl = isset( $itemOptns['_url_' . $F] ) ? esc_attr( $itemOptns['_url_' . $F][0] ) : '';
    if( empty( $itemUrl )) { return $out; }

    $urlNT = abcfsl_struct_data_remove_nt( $itemUrl );
    if( empty( $urlNT )) { return $out; }

    $urlSP = abcfsl_struct_data_sp( $urlNT,  $tplateOptns, $itemOptns );
    if( empty( $urlSP )) { return $out; }

    $urlTel = abcfsl_struct_data_remove_tel( $urlSP );
    if( empty( $urlSP )) { return $out; }

    $out['addItem'] = true;
    $out['sdValue'] = $urlTel;
    return $out;
}

function abcfsl_struct_data_field_value_EM( $itemOptns, $F, $out ){

    $itemUrl = isset( $itemOptns['_url_' . $F] ) ? esc_attr( $itemOptns['_url_' . $F][0] ) : '';
    if( empty( $itemUrl )) { return $out; }

    $out['addItem'] = true;
    $out['sdValue'] = $itemUrl;
    return $out;
}

function abcfsl_struct_data_field_value_WPE( $itemOptns, $F, $out ){

    $editorCnt = isset( $itemOptns['_editorCnt_' . $F] ) ? esc_attr( $itemOptns['_editorCnt_' . $F][0] ) : '';
    if(abcfl_html_isblank($editorCnt)) { return $out; }

    $cnt = html_entity_decode($editorCnt);

    //the_content ??????
    $out['addItem'] = true;
    //$out['sdValue'] = strip_tags( apply_filters('the_content', $cnt));
    $out['sdValue'] = strip_tags( apply_filters('abcfsl_cnt', $cnt));
    
    return $out;
}

//---MP builder START -------------------------------------------------------------
function abcfsl_struct_data_field_value_MP( $tplateOptns, $itemOptns, $F, $isSingle, $out ){

    $masterF = $F;
    $lineTxt = abcfsl_cnt_MP_field( $tplateOptns, $itemOptns, $F, $masterF, $isSingle, false );

    if( abcfl_html_isblank( $lineTxt ) ) { return $out; }

    $out['addItem'] = true;
    $out['sdValue'] = trim(strip_tags( $lineTxt ));
    return $out;
}
//---MP builder END -----------------------------------------------------

function abcfsl_struct_data_remove_nt( $url ){

    if( abcfl_html_isblank( $url ) ) { return $url; }
    if( strlen( $url) < 4 ) { return $url; }

    $targetNT = substr( $url, 0, 2 );
    if( $targetNT == 'NT' ) {
        return trim( substr( $url, 2 ) );
    }
    return $url;
}

function abcfsl_struct_data_remove_tel( $url ){

    if( abcfl_html_isblank( $url ) ) { return $url; }
    if( strlen( $url ) < 6) { return $url; }

    $tel = strtolower( substr( $url, 0, 4 ) );
    if( $tel == 'tel:' ) {
        return trim( substr( $url, 4 ) );
    }
    return $url;
}

function abcfsl_struct_data_remove_social_tel( $url ){

    if( abcfl_html_isblank( $url ) ) { return $url; }
    if( strlen( $url ) < 6) { return $url; }

    $tel = strtolower( substr( $url, 0, 4 ) );
    if( $tel == 'tel:' ) {  return ''; }
    return $url;
}

function abcfsl_struct_data_sp( $url,  $tplateOptns, $itemOptns ){

    if( $url != 'SP') { return $url; }

    $sPageUrl = isset( $tplateOptns['_sPageUrl'] ) ? esc_attr( $tplateOptns['_sPageUrl'][0] ) : '';
    if( empty( $sPageUrl )) { return $sPageUrl; }

    $pretty = isset( $itemOptns['_pretty'] ) ? esc_attr( $itemOptns['_pretty'][0] ) : '';
    //--------------------------------------------
    $urlSelector = abcfsl_spg_a_tag_url_selector_legacy( '', 'SP', $sPageUrl, $pretty );
    $hrefUrl = $urlSelector['hrefUrl'];
    return $hrefUrl;

}

//    $item['@context'] = 'http://schema.org';
//    $item['@type'] = $sdType;
//    $item['name'] = 'Jane Doe';
//    $item['jobTitle'] = 'Professor';
//    $item['telephone'] = '(425) 123-4567';
//    $item['url'] = 'http://www.janedoe.com';

// WPSEO_Schema
// "@context": "https://schema.org",
//     "@graph": [
//         {
//             "@type": "WebSite",
//             "@id": "http://localhost:8080/blog/#website",
//             "url": "http://localhost:8080/blog/",
//             "name": "Local website 8080",
//             "potentialAction": {
//                 "@type": "SearchAction",
//                 "target": "http://localhost:8080/blog/?s={search_term_string}",
//                 "query-input": "required name=search_term_string"
//             }
//         },
//         {
//             "@type": "WebPage",
//             "@id": "http://localhost:8080/blog/6336-rewrite-no-filter-2/#webpage",
//             "url": "http://localhost:8080/blog/6336-rewrite-no-filter-2/",
//             "inLanguage": "en-US",
//             "name": "6336 Template - No Ajax | in Cumming &amp; Alpharetta, GA",
//             "isPartOf": {
//                 "@id": "http://localhost:8080/blog/#website"
//             },
//             "datePublished": "2018-02-28T23:55:03+00:00",
//             "dateModified": "2019-08-21T12:40:11+00:00"
//         }
//     ]

// <script type="application/ld+json">
// [
//     {
//         "@context": "http:\/\/schema.org",
//         "@type": "Person",
//         "worksFor": {
//             "@type": "EducationalOrganization",
//             "name": "University of Wisconsin",
//             "department": "School of Nursing - HIDE"
//         },
//         "name": "Christine Alvarado 0",
//         "jobTitle": "Assistant  &lt;span class=&quot;kamFW600&quot;&gt;Professor&lt;\/span&gt;.",
//         "url": "http:\/\/localhost:8080\/blog\/profilo\/Alvarado\/",
//         "email": "alva@domaincom",
//         "sameAs": [
//             "https:\/\/www.facebook.com\/",
//             "https:\/\/www.linkedin.com\/christinea",
//             "http:\/\/www.mysite-alva-christineal.com\/",
//             "ttttttt"
//         ],
//         "image": "http:\/\/localhost:8080\/blog\/wp-content\/uploads\/2016\/11\/placeholder_250x300_12.jpg"
//     },
//     {
//         "@context": "http:\/\/schema.org",
//         "@type": "Person",
//         "worksFor": {
//             "@type": "EducationalOrganization",
//             "name": "University of Wisconsin",
//             "department": "Military"
//         },
//         "name": "Sta\u0144ko\u017c\u017aski",
//         "url": "http:\/\/localhost:8080\/blog\/profilo\/?smid=7408",
//         "image": "http:\/\/localhost:8080\/blog\/wp-content\/uploads\/2016\/11\/placeholder_250x300_01.jpg"
//     }
// ];
// </script>
//====================================================================================
// "@context": "https://schema.org",
//     "@graph": "[",
//     "0": {



