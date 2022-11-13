<?php
//Not used for links to single page anymore. Standard hyperlink fields only. Handles NT prefix.
//Hyperlinks don't have new tab options yet.
function abcfsl_spg_a_tag_parts( $itemOptns, $staffID, $sPageUrl, $F ){

    $aTagParts['hrefUrl'] = '';
    $aTagParts['hrefTxt'] = '';
    $aTagParts['target'] = '';

    //echo abcfl_input_checkbox('lnkNT_' . $F,  '', $lnkNT, abcfsl_txta(143), '', '', '', 'abcflFldCntr', '', '', '' );

    //Takes all field types. Returns empty if no URL
    $itemUrl = isset( $itemOptns['_url_' . $F] ) ? esc_attr( $itemOptns['_url_' . $F][0] ) : '';
    if( abcfl_html_isblank( $itemUrl ) ) { return $aTagParts; }

    // Splits into URL and target if NT prefix
    $splitUrl = abcfsl_util_get_url_and_target( $itemUrl ); 

    $itemTxt = isset( $itemOptns['_urlTxt_' . $F] ) ? esc_attr( $itemOptns['_urlTxt_' . $F][0] ) : '';
    if( abcfl_html_isblank( $itemTxt ) ) { $itemTxt = $splitUrl['hrefUrl']; }

    $aTagParts['hrefTxt'] = $itemTxt;
    $aTagParts['hrefUrl'] = $splitUrl['hrefUrl'];    
    $aTagParts['target'] = $splitUrl['target'];

    return $aTagParts;
}

//=== SPTL SINGLE PAGE LINK START ====================================================
function abcfsl_spg_a_tag_lnk_parts( $parLP, $itemOptns, $isImgLink ){

    $lnkParts['imgID'] = 0;
    $lnkParts['href'] = '';
    $lnkParts['target'] = '';
    $lnkParts['onclick'] = '';
    $lnkParts['args'] = '';

    //== If no hyperlink - exit =========================================
    $parLP = abcfsl_spg_a_tag_get_lnk_parts( $parLP, $itemOptns, $isImgLink );
    if( !$parLP['showLnk'] ) { return $lnkParts; }
    //=========================================================================

    // Hybrid = ST, SPGHYB. Custom = SPGCUST, SPCUST.
    switch ( $parLP['sPgLnkShow'] ) {
        case 'ST':
        case 'SPHYB':     
            $lnkParts = abcfsl_spg_a_tag_lnk_parts_hybrid( $parLP, $itemOptns, $isImgLink );
            break; 
        case 'SPGCUST':
        case 'SPCUST':    
            $lnkParts = abcfsl_spg_a_tag_lnk_parts_custom( $parLP, $itemOptns, $isImgLink );
            break;                       
        default:
            $lnkParts = abcfsl_spg_a_tag_lnk_parts_ugly_pretty( $parLP, $itemOptns, $isImgLink );
            break;
    }
    return $lnkParts;
}  

function abcfsl_spg_a_tag_get_lnk_parts( $parLP, $itemOptns, $isImgLink ){

    // Single Page Options (template). Link parts.
    // $parLP['staffID']
    // $parLP['sPageUrl']
    // $parLP['sPgLnkShow'] Show Link N, Y, ...
    // $parLP['sPgLnkNT'] Open in a new tab or window.
    // $parLP['lineTxt'] Text of text link.
    // $parLP['imgLnkLDefault'] Add link to staff image (image hyperlink).
    $parLP['showLnk'] = false; 

    //== No hyperlink - exit=====================================================
    //--- No link to single page (Show Link cbo) -----------------------------
    if(  $parLP['sPgLnkShow'] == 'N' ) { return $parLP; }

    //--- No link to single page (Staff member option) -----------------------
    $hideSPgLnk = isset( $itemOptns['_hideSPgLnk'] ) ? $itemOptns['_hideSPgLnk'][0] : '0';
    if( $hideSPgLnk == 1 ) { return  $parLP; }

    if( $isImgLink ){
        // Template option. Add link to staff image (image hyperlink).
        if( $parLP['imgLnkLDefault'] != 1 ) { return $parLP; }
    }
    else {
        //-- Link Text can't be blank: sPgLnkTxt --------------------------
        if( abcfl_html_isblank( $parLP['lineTxt'] ) ) {  return $parLP;  }
    }

    if(  $parLP['sPgLnkShow'] == 'Y' ) {
        if( abcfl_html_isblank( $parLP['sPageUrl'] ) ) { return $parLP; }   
    }
    //=========================================================================
    $parLP['showLnk'] = true; 
    $parLP['custURL'] = '';
    $parLP['imgLnkL'] = isset( $itemOptns['_imgLnkL'] ) ? esc_attr( $itemOptns['_imgLnkL'][0] ) : '';
    $parLP['target'] = ''; 
    
    $parLP = abcfsl_spg_a_tag_img_custom_url_validator( $parLP );
    //-------------------------------------------------------------
    return $parLP;

    // [staffID] => 8854
    // [sPageUrl] => 
    // [sPgLnkShow] => SPHYB
    // [sPgLnkNT] => 1
    // [lineTxt] => Single Page
    // [imgLnkLDefault] => 1
    // [showLnk] => 1
    // [target] => _blank
    // [custURL] => https://Custom_URL
    // [imgLnkL] => https://Custom_URL
} 

// Check content of staff member field: imgLnkL (Custom URL)
function abcfsl_spg_a_tag_img_custom_url_validator( $parLP ){

    // imgLnkL = Custom URL = Staff member,  can be: Empty, SP, NT, NT SP, Full URL, NT Full URL. Custom URL overwrites template options    
    $imgLnkL = $parLP['imgLnkL'];
    if( $parLP['sPgLnkNT'] == 1 ) { $parLP['target'] = '_blank'; } 

    // Page type
    $showLink = $parLP['sPgLnkShow'];
    if( $showLink == 'ST') { $showLink = 'SPHYB'; }
    if( $showLink == 'SPGCUST') { $showLink = 'SPCUST'; }
    //---------------------------------------------------------------
    if( $showLink == 'Y' || $showLink == 'SPHYB') { 

        if( empty( $imgLnkL ) ) { return $parLP; } 
        if( $imgLnkL == 'SP' ) { return $parLP; }

        if( $imgLnkL == 'NT' ) { 
            $parLP['target'] = '_blank';
            return $parLP;
        }

        if( $imgLnkL == 'NT SP' ) { 
            $parLP['target'] = '_blank';
            return $parLP;
        }  

        $prefixNT = substr( $imgLnkL, 0, 3 );
        if( $prefixNT == 'NT ' ) { 
            $parLP['target'] = '_blank';
            $parLP['custURL'] = substr( $imgLnkL, 3 );
            return $parLP;
        }

        $parLP['sPageUrl'] = '';
        $parLP['custURL'] = $imgLnkL;
        return $parLP;
    } 

    if( $showLink == 'SPCUST' ) { 

        // Custom URL required.
        if( empty( $imgLnkL ) ) { return $parLP; } 
        if( $imgLnkL == 'SP' ) { return $parLP; }
        if( $imgLnkL == 'NT' ) { return $parLP; }
        if( $imgLnkL == 'NT SP' ) { return $parLP; }  

        $prefixNT = substr( $imgLnkL, 0, 3 );
        if( $prefixNT == 'NT ' ) { 
            $parLP['target'] = '_blank';
            $parLP['custURL'] = substr( $imgLnkL, 3 );
            return $parLP;
        }
        
        $parLP['custURL'] = $imgLnkL;
        return $parLP;
    } 
    return $parLP;
}

//=== SPTL SINGLE PAGE LINK END  ==========================================================

function abcfsl_spg_a_tag_lnk_parts_ugly_pretty( $parLP, $itemOptns, $isImgLink ){

    if( !empty( $parLP['custURL'] ) ) { 
        return abcfsl_spg_a_tag_img_lnk_parts_builder( $parLP['custURL'],  $parLP['target'], $itemOptns, $isImgLink  );  
    }

    $pretty = isset( $itemOptns['_pretty'] ) ? esc_attr( $itemOptns['_pretty'][0] ) : '';    
    $sPageUrl = abcfsl_spg_a_tag_url_ugly_pretty( $parLP['staffID'], $parLP['sPageUrl'], $pretty );

    return abcfsl_spg_a_tag_img_lnk_parts_builder( $sPageUrl,  $parLP['target'], $itemOptns, $isImgLink );    
}

// Hyperlink to hybrid page. 
function abcfsl_spg_a_tag_lnk_parts_hybrid( $parLP, $itemOptns, $isImgLink ){

    if( !empty( $parLP['custURL'] ) ) { 
        return abcfsl_spg_a_tag_img_lnk_parts_builder( $parLP['custURL'],  $parLP['target'], $itemOptns, $isImgLink  );  
    }
    
    // Hybrid page has to have custom URL or single page URL.
    if( empty( $parLP['sPageUrl'] ) ) { 
        return abcfsl_spg_a_tag_img_lnk_parts_builder( $parLP['sPageUrl'],  $parLP['target'], $itemOptns, $isImgLink  );
    }

    $pretty = isset( $itemOptns['_pretty'] ) ? esc_attr( $itemOptns['_pretty'][0] ) : '';
    $sPageUrl = '';
    
    if( empty( $pretty ) ) {  
        $sPageUrl = abcfl_html_url( array( 'smid' => $parLP['staffID'] ), $parLP['sPageUrl'] ); 
    }
    else{
        $sPageUrl = trailingslashit( trailingslashit( $parLP['sPageUrl'] ) . $pretty );  
    }
    
    return abcfsl_spg_a_tag_img_lnk_parts_builder( $sPageUrl,  $parLP['target'], $itemOptns, $isImgLink  ); 
}

function abcfsl_spg_a_tag_lnk_parts_custom( $parLP, $itemOptns, $isImgLink ){

    return abcfsl_spg_a_tag_img_lnk_parts_builder( $parLP['custURL'],  $parLP['target'], $itemOptns, $isImgLink  );    
}

function abcfsl_spg_a_tag_img_lnk_parts_builder( $hrefUrl, $target, $itemOptns, $isImgLink ){  

    //if( $isImgLink ){ $lnkParts['imgID'] = abcfsl_spg_a_tag_img_lnk_id( isset( $itemOptns['_imgID'] ) ? esc_attr( $itemOptns['_imgID'][0] ) : 0 ); }

    $lnkParts['href'] = $hrefUrl;
    $lnkParts['target'] = $target;
    $lnkParts['onclick'] = abcfsl_spg_a_tag_lnk_onclick( isset( $itemOptns['_imgLnkClick'] ) ? esc_attr( $itemOptns['_imgLnkClick'][0] ) : '' );
    $lnkParts['args'] = abcfsl_spg_a_tag_lnk_args(isset( $itemOptns['_imgLnkArgs'] ) ? esc_attr( $itemOptns['_imgLnkArgs'][0] ) : '');
  
    return $lnkParts;
}

//Pretty or smid.
function abcfsl_spg_a_tag_url_ugly_pretty( $staffID, $sPageUrl, $pretty ){

    if( abcfsl_spg_a_tag_is_single_pretty( $sPageUrl, $pretty ) ) { 
        return trailingslashit( trailingslashit( $sPageUrl ) . $pretty ); 
    } 
    return abcfl_html_url( array('smid' => $staffID), $sPageUrl );
}

//=== SPTL IMAGE LINK END ==========================================================

function abcfsl_spg_a_tag_lnk_onclick( $imgLnkClick ){
    //Check mix of double and single quotes. Return empty if true; ???
    return $imgLnkClick;
}

function abcfsl_spg_a_tag_lnk_args( $lnkArgs ){
    //Convert HTML entities to characters. Double quotes only;
    if(!empty($lnkArgs)){ $lnkArgs = html_entity_decode($lnkArgs, ENT_COMPAT); }
    return $lnkArgs;
}

//== PRETTY PERMALINKS START ===========================
// NOT LOCAL  Used by Staff Search. TRUE if single page URL is ready for pretty permalink.
function abcfsl_spg_a_tag_is_single_pretty( $sPageUrl, $pretty ){

    if( empty( $pretty ) ) { return false; }
    if( strlen( $sPageUrl ) < 10 ) { return false; }

    $sPageUrl = rtrim( $sPageUrl, '/' );

    if( substr($sPageUrl, -3) == 'bio' ) { return true; }
    if( substr($sPageUrl, -7) == 'profile' ) { return true; }
    if( substr($sPageUrl, -6) == 'profil' ) { return true; }
    if( substr($sPageUrl, -7) == 'profilo' ) { return true; }
    if( substr($sPageUrl, -6) == 'perfil' ) { return true; }
    
    //Custom permalinks plugin.
    $out = false;
    if( function_exists( 'abcfslcp_is_single_pretty' )){
       $out = abcfslcp_is_single_pretty( $sPageUrl );
    }

    return $out;
}

//Return StaffID for single page. By staff ID or pretty. Called from  abcfsl_cnt_spage
function abcfsl_spg_a_tag_staff_member_id ( $scodeArgs ){
    
    $staffID = 0;

    // Hybrid page parameter
    $staffID = (int)$scodeArgs['staff-id'];
    if( $staffID > 0 ){ return $staffID; }
    //------------------------------------
    $staffID = (int)$scodeArgs['smid'];
    if( $staffID > 0) { return $staffID; }
    //------------------------------------
    $tplateID = $scodeArgs['id'];
    //------------------------------------
    // Hybrid page parameter
    $staffNameSP = $scodeArgs['staff-name-sp'];
    if( !empty( $staffNameSP ) ){
        $staffID = abcfsl_db_staff_id_by_tplate_and_pretty( $tplateID, $staffNameSP );
        if( $staffID > 0) { return $staffID; }
    }
    //------------------------------------
    // Pretty permalink rewrite
    $staffName = $scodeArgs['staff-name'];    
    if( empty( $staffName ) ) { return 0; }
    //------------------------------------
    if ( substr( $staffName, 0, 6 ) == '?smid=' ){ 
        return (int) substr( $staffName, 6 ); 
    }
    $staffID = abcfsl_db_post_id_by_pretty( $tplateID, $staffName );

    // if( strlen( $staffName ) >= 6 ){
    //     if ( substr( $staffName, 0, 6 ) == '?smid=' ){ return (int) substr( $staffName, 6 ); }
    //     $staffID = abcfsl_db_post_id_by_pretty( $tplateID, $staffName );
    // }
    // if( !empty( $staffName ) & strlen( $staffName ) > 6 ){
    //     if ( substr($staffName, 0, 6) == '?smid=' ){ return (int) substr( $staffName, 6 ); }
    //     $staffID = abcfsl_db_post_id_by_pretty( $tplateID, $staffName );
    // }
    return $staffID;
}
//== PRETTY PERMALINKS END ===============================

//Used by struct-data. Check and modify !!!!!!!!!
function abcfsl_spg_a_tag_url_selector_legacy( $staffID, $lnkUrl, $sPageUrl, $pretty ){

    $out['hrefUrl'] = '';
    $out['target'] = '';
    $out['isSP'] = false;
    if( abcfl_html_isblank( $lnkUrl ) ) { return $out;}

    if( $lnkUrl == 'NT SP' ) {
        $lnkUrl = 'SP';
        $out['target'] = '_blank';
    }

    if( $lnkUrl == 'SP' ) {
        $out['isSP'] = true;
    }

    //if($lnkUrl == 'SP') {
    if($out['isSP']) {
        //If single page url is blank return empty sting.
        if( abcfl_html_isblank( $sPageUrl ) ) { return $out; }        

        if( abcfsl_spg_a_tag_is_single_pretty( $sPageUrl, $pretty ) ) {
            $out['hrefUrl'] = trailingslashit( trailingslashit( $sPageUrl ) . $pretty ) ;
            return $out;
        }
        else {
            //Add staff member ID single page url.
            $out['hrefUrl'] = abcfl_html_url( array('smid' => $staffID), $sPageUrl );
            return $out;
        }
    }
    
    $splitUrl = abcfsl_util_get_url_and_target( $lnkUrl );
    $out['hrefUrl'] = $splitUrl['hrefUrl'];
    $out['target'] =  $splitUrl['target'];
    return $out;
}