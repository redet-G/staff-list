<?php
//Render Single Page content.
function abcfsl_cnt_spage( $scodeArgs ){

    $clsPfix = $scodeArgs['prefix'];
    $tplateID = $scodeArgs['id'];
    $pversion = $scodeArgs['pversion'];
    $staffID = abcfsl_spg_a_tag_staff_member_id ( $scodeArgs );

    //Both qry args are missing. Show blank page. 
    if( $staffID == 0 ) {  return '';  }
    //Pretty permalinks. No records.
    if( $staffID == -1 ) {  return '';  }

    //Check if post has been published ----
    $postStatus = get_post_status( $staffID );
    if( $postStatus != 'publish' ) { return ''; }

    //Why single page is blank.
    $itemOptns = get_post_custom( $staffID );
    if( empty( $itemOptns ) ) {  return ''; }

    $hideSMember = isset( $itemOptns['_hideSMember'] ) ? esc_attr( $itemOptns['_hideSMember'][0] ) : '0';
    $hideSPgLnk = isset( $itemOptns['_hideSPgLnk'] ) ? $itemOptns['_hideSPgLnk'][0] : '0';
    if( $hideSMember == 1 ) { return ''; }    
    if( $hideSPgLnk == 1 ) { return ''; }
     //-----------------------------------------
    $tplateOptns = get_post_custom( $tplateID );
    $tplateOptns['slTplateID'] = $tplateID;

    //Add excluded subcategories
    $tplateOptns = abcfsl_util_fix_cat_excluded_slugs( $tplateOptns );

     //==GRID C GRID D =====================================
    $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '1';

    $spgLayout = 'N';
    // 1=List; 2=Grid B; 3=Grid A; 4=GridC; 200=Grid AI; ; 201=Grid BI; 202=Grid CI; 203=List LI;
    switch ( $lstLayout ) {
        case 1:
        case 2:
        case 3: 
        case 200:
        case 201:
        case 203:               
            $spgLayout = 'IMG';
            break;
        case 4:
        case 202:        
            $spgLayout = 'NOIMG';
            break;    
        default:
            break;
    }

    if( $spgLayout == 'N' ) { return ''; }

    // Only checks if single page has image: url, template option or placeholder
    $hasImg = abcfsl_cnt_spage_has_img( $tplateOptns, $itemOptns, $spgLayout );
    
    // pl = single page layout. i=has image, ni=no image.   
    $pl = 'i';
    if( !$hasImg ) { 
        $spgLayout = 'NOIMG';
        $pl = 'ni'; 
    }

    //----------------------------------
    $spgCntrW = isset( $tplateOptns['_spgCntrW'] ) ? esc_attr( $tplateOptns['_spgCntrW'][0] ) : '';
    $spgACenter = isset( $tplateOptns['_spgACenter'] ) ? esc_attr( $tplateOptns['_spgACenter'][0] ) : 'Y';

    $spgCntrCls = isset( $tplateOptns['_spgCntrCls'] ) ? esc_attr( $tplateOptns['_spgCntrCls'][0] ) : '';
    //---------------------------------------------------------------    
    $cntrStyle = trim( abcfl_css_w_responsive( $spgCntrW, $spgCntrW ) ) ;
    $centerCls = abcfsl_util_center_cls( $spgACenter, $clsPfix );

    //Single Page container
    $spgCntrCustCls = trim( $centerCls . ' ' . $spgCntrCls );
    //$spgCntrCustCls = $centerCls;
    $spgCntrID = 'slv' . $pversion . '_t' . $tplateID . '_sm' . $staffID . '_spgl' . $pl;
    $spgCntr = abcfsl_util_tag_base_attrs( 'div', $clsPfix, 'SPgCntr', $spgCntrCustCls, $cntrStyle, $spgCntrID );

    $outItem['itemHTML'] = '';
    $outItem['itemSD'] = '';

    $itemPar['itemID'] = $staffID;
    $itemPar['clsPfix'] = $clsPfix;
    $itemPar['hiddenFields'] = $scodeArgs['hidden-fields'];
    $itemPar['privateFields'] = $scodeArgs['private-fields'];

    //Optional parameter 
    $fieldOrder = abcfsl_util_field_order( $tplateOptns, true );

    switch ( $spgLayout ) {
        case 'IMG':
            $outItem = abcfsl_cnt_spage_cnt_IMG( $tplateOptns, $itemOptns, $itemPar,  $fieldOrder );
            break;
        case 'NOIMG':
            $outItem = abcfsl_cnt_spage_cnt_NOIMG( $tplateOptns, $itemOptns, $itemPar,  $fieldOrder );
            break;            
        default:
            break;
    }

    //Return Grid container + all items. SDATA
    $cntHTML = $spgCntr['cntrS'] . $outItem['itemHTML'] . $spgCntr['cntrE'];
    $cntSD = abcfsl_struct_data( $outItem['itemSD'] );

    return $cntHTML . $cntSD;
}

//== IMG+TXT START ======================================================
// Updated
function abcfsl_cnt_spage_has_img( $tplateOptns, $itemOptns, $spgLayout ){

    if(  $spgLayout == 'NOIMG' )  { return false; }

    // Staff memmber, single page image URL.
    $imgUrlS = isset( $itemOptns['_imgUrlS'] ) ? esc_attr( $itemOptns['_imgUrlS'][0] ) : '';
    if( !empty( $imgUrlS ) ) { return true; }

    $sPgDefaultImgUrl = isset( $tplateOptns['_sPgDefaultImgUrl'] ) ? $tplateOptns['_sPgDefaultImgUrl'][0] : '0';
    if( $sPgDefaultImgUrl = 1 ){ return true; }

    // Check this function
    $placeholder = abcfsl_img_placeholder( $tplateOptns, true );
    if( empty( $placeholder['imgUrl'] ) ){ return false; }
    
    return false;
}

function abcfsl_cnt_spage_cnt_IMG( $tplateOptns, $itemOptns, $itemPar,  $fieldOrder ){    

    $colL = isset( $tplateOptns['_spgCols'] ) ? esc_attr( $tplateOptns['_spgCols'][0] ) : '6';

    $out['itemHTML'] = '';
    $out['itemSD'] = '';

    $staffID = $itemPar['itemID'];
    $clsPfix = $itemPar['clsPfix'];

    // spgMICls: Image container top margin
    // spgMTCls: Txt container top margin

    $imgCntr = abcfsl_cnt_spage_img_cntr( $staffID, $tplateOptns, $itemOptns, $colL, $clsPfix );
    $txtHTML = abcfsl_cnt_spage_txt_section_m( $itemOptns, $tplateOptns, $itemPar, $fieldOrder );

    //================================================
    $spgCClsT = isset( $tplateOptns['_spgCClsT'] ) ? esc_attr( $tplateOptns['_spgCClsT'][0] ) : '';
    $spgCClsM = isset( $tplateOptns['_spgCClsM'] ) ? esc_attr( $tplateOptns['_spgCClsM'][0] ) : '';
    $spgCClsB = isset( $tplateOptns['_spgCClsB'] ) ? esc_attr( $tplateOptns['_spgCClsB'][0] ) : '';
    $spgMMarginT = isset( $tplateOptns['_spgMMarginT'] ) ? esc_attr( $tplateOptns['_spgMMarginT'][0] ) : 'N';
    $baseClsM = abcfsl_cnt_spage_base_cls_m_cntr( $spgMMarginT, $clsPfix );

    $spgCntrT = abcfsl_util_tag_base_attrs( 'div', $clsPfix, '', $spgCClsT, '' );
    $spgCntrM = abcfsl_util_tag_base_attrs( 'div', $clsPfix, $baseClsM, $spgCClsM, '' );
    $spgCntrB = abcfsl_util_tag_base_attrs( 'div', $clsPfix, '', $spgCClsB, '' );

    if( !empty( $txtHTML['T'] ) ) { $txtHTML['T'] =  $spgCntrT['cntrS'] . $txtHTML['T'] . $spgCntrT['cntrE']; }

    if( !empty( $txtHTML['M'] ) || !empty( $imgCntr ) ) {
        $txtHTML['M'] =  $spgCntrM['cntrS'] . $imgCntr . $txtHTML['M'] . $spgCntrM['cntrE']; 
    }
    if( !empty( $txtHTML['B'] ) ) { $txtHTML['B'] =  $spgCntrB['cntrS'] . $txtHTML['B'] . $spgCntrB['cntrE']; }

   //SDATA
   $out['itemHTML'] = $txtHTML['T'] . $txtHTML['M'] . $txtHTML['B'];
   $out['itemSD'] = abcfsl_struct_data_item_single( $tplateOptns, $itemOptns, $fieldOrder );

   return $out;

}

function abcfsl_cnt_spage_base_cls_m_cntr( $marginT, $clsPfix ){
    $clsMT = abcfsl_util_cls_name_ncd_bldr( $marginT, 'MT', $clsPfix );
    return trim ( 'SPgCntrM abcfClrFix '  . $clsMT );
}

// Returns image container including image.
function abcfsl_cnt_spage_img_cntr( $staffID, $tplateOptns, $itemOptns, $colL, $clsPfix ){

    //_imgUrlL is used for single page images. Modify this value based on SP image settings.
    $itemOptns = abcfsl_cnt_spage_image_url_fixed( $tplateOptns, $itemOptns );

    $spgMICls = isset( $tplateOptns['_spgMICls'] ) ? esc_attr( $tplateOptns['_spgMICls'][0] ) : '';
    //-------------------------------------------------
    $par['pgLayout'] = 100;
    $par['itemID'] = $staffID;
    $par['colL'] = $colL;
    $par['clsPfix'] = $clsPfix;
    $par['sPageUrl'] = '';
    $par['isSingle'] = true;
    $par['custCls'] = $spgMICls;

    //Returns image container including image. 
    //Calls: abcfsl_cnt_img_options 
    //abcfsl_cnt_img_tag - main function to figure out what image to show on single page
    return abcfsl_cnt_img_cntr( $tplateOptns, $itemOptns, $par  );
}

// Modify itemOptns to render img container
function abcfsl_cnt_spage_image_url_fixed( $tplateOptns, $itemOptns ){

    //Not used for single page image.
    $itemOptns['_imgLnkL'][0] = ''; 

    //Use the L image on SP. 
    $sPgDefaultImgUrl = isset( $tplateOptns['_sPgDefaultImgUrl'] ) ? $tplateOptns['_sPgDefaultImgUrl'][0] : '0';

    // Disregard content of imgUrlS. imgUrlL will used for single page images. 
    // If L empty, L placeholder will show up. If L placeholder empty, show default placeholder.
    // If all above empty, nothing will display.
    if( $sPgDefaultImgUrl == '1' ) {
       return $itemOptns;
    }

    // Template default not set, or field has some value.
    $imgUrlS = isset( $itemOptns['_imgUrlS'] ) ? esc_attr( $itemOptns['_imgUrlS'][0] ) : '';

    if( !empty( $imgUrlS ) ) {
        // imgUrlL is used for single page.
        if( $imgUrlS == 'SP' ){ return $itemOptns; }
        
        // Some custom URL used. Update imgUrlL to imgUrlS
        $itemOptns['_imgIDL'][0] = isset( $itemOptns['_imgIDS'] ) ? esc_attr( $itemOptns['_imgIDS'][0] ) : 0;
        $itemOptns['_imgUrlL'][0] = $imgUrlS;
        return $itemOptns; 
    }

    // No global setting and no staff member entry. Placeholder will display if selected (template option)
    $itemOptns['_imgUrlL'][0] = '';  
    return $itemOptns;
}

// M text section for image + text. M container & M text fields. Updated to simplify custom class for text container.
function abcfsl_cnt_spage_txt_section_m( $itemOptns, $tplateOptns, $itemPar, $fieldOrder ){

    $colL = isset( $tplateOptns['_spgCols'] ) ? esc_attr( $tplateOptns['_spgCols'][0] ) : '6';
    $colR = (12 - $colL);

    // spgMTCls: Txt container top margin custom class
    $spgMTCls = isset( $tplateOptns['_spgMTCls'] ) ? esc_attr( $tplateOptns['_spgMTCls'][0] ) : '';

    $par['pfix'] = $itemPar['clsPfix'];
    $par['colR'] = $colR;
    $par['colCntrCls'] = 'TxtColSPg';
    $par['txtCntrCls'] = abcfsl_cnt_spage_md_section_txt_cntr_cls( $spgMTCls, $par['pfix'] );
    $par['center'] = 'Center575';
    $par['txtCntrStyle'] = isset( $tplateOptns['_spgMTStyle'] ) ? esc_attr( $tplateOptns['_spgMTStyle'][0] ) : '';

    $divMiddle = abcfsl_cnt_spage_txt_m_divs( $par );
    //-----------------------------------------------
    $outHTML = abcfsl_cnt_spage_txt_sections( $itemOptns, $tplateOptns, $itemPar, $fieldOrder );

    if( !empty( $outHTML['M'] ) ) { $outHTML['M'] =  $divMiddle['cntrS'] . $outHTML['M'] . $divMiddle['cntrE']; }
    return $outHTML;
}

// Text section divs. No content. Column div + Txt container div
function abcfsl_cnt_spage_txt_m_divs( $par ){

    $pfix = $par['pfix'];
    $txtCntrCls = $par['txtCntrCls'];;
    $txtCntrStyle = $par['txtCntrStyle'];
    $center = $par['center'];

    $colCntrCls = ' ' . $pfix . $par['colCntrCls'];
    $wrapClsBase = 'LstCol';

    if( !empty( $center ) ) { $center =  ' ' . $pfix . $par['center'];  }
    $clsTxtCntr = rtrim( $txtCntrCls  . $center );
    $clsColumnCntr = $pfix . $wrapClsBase . ' ' . $pfix . $wrapClsBase . '-' . $par['colR'] . $colCntrCls;

    $colCntrS = abcfl_html_tag( 'div', '', $clsColumnCntr, '' );
    $txtCntrS = abcfl_html_tag( 'div', '', $clsTxtCntr, $txtCntrStyle );

    $div['cntrS'] = $colCntrS . $txtCntrS;
    $div['cntrE'] = abcfl_html_tag_ends( 'div,div');

    return $div;
}

// Return default class if there is no custom one (Custom CSS - Text Container).
function abcfsl_cnt_spage_md_section_txt_cntr_cls( $spgMTCls, $pfix ){

    if( empty( $spgMTCls ) ) { 
        return ' ' . $pfix . 'PadLPc5';
     }
     return ' ' . $spgMTCls;
}
//== IMG+TXT END ======================================================

//=== NOIMG START ==============================================
function abcfsl_cnt_spage_cnt_NOIMG( $tplateOptns, $itemOptns, $itemPar,  $fieldOrder ) {   

    $out['itemHTML'] = '';
    $out['itemSD'] = '';

    $clsPfix = $itemPar['clsPfix'];
    $txtHTML = abcfsl_cnt_spage_txt_sections( $itemOptns, $tplateOptns, $itemPar, $fieldOrder );

    //---------------------------------------
    $spgCClsT = isset( $tplateOptns['_spgCClsT'] ) ? esc_attr( $tplateOptns['_spgCClsT'][0] ) : '';
    $spgCClsM = isset( $tplateOptns['_spgCClsM'] ) ? esc_attr( $tplateOptns['_spgCClsM'][0] ) : '';
    $spgCClsB = isset( $tplateOptns['_spgCClsB'] ) ? esc_attr( $tplateOptns['_spgCClsB'][0] ) : '';

    $spgCntrT = abcfsl_util_tag_base_attrs( 'div', $clsPfix, '', $spgCClsT, '' );
    $spgCntrM = abcfsl_util_tag_base_attrs( 'div', $clsPfix, '', $spgCClsM, '' );
    $spgCntrB = abcfsl_util_tag_base_attrs( 'div', $clsPfix, '', $spgCClsB, '' );

    // Add container divs if there is a content.
    if( !empty( $txtHTML['T'] ) ) { $txtHTML['T'] =  $spgCntrT['cntrS'] . $txtHTML['T'] . $spgCntrT['cntrE']; }
    if( !empty( $txtHTML['M'] ) ) { $txtHTML['M'] =  $spgCntrM['cntrS'] . $txtHTML['M'] . $spgCntrM['cntrE']; }
    if( !empty( $txtHTML['B'] ) ) { $txtHTML['B'] =  $spgCntrB['cntrS'] . $txtHTML['B'] . $spgCntrB['cntrE']; }

   $out['itemHTML'] = $txtHTML['T'] . $txtHTML['M'] . $txtHTML['B'];
   $out['itemSD'] = abcfsl_struct_data_item_single( $tplateOptns, $itemOptns, $fieldOrder );

   return $out;
}
//=== NOIMG END ==============================================

//SPg content divided by sections T,M,B.
function abcfsl_cnt_spage_txt_sections( $itemOptns, $tplateOptns, $fieldPar, $fieldOrder ){    

    $outHTML['T'] = '';
    $outHTML['M'] = '';
    $outHTML['B'] = '';

    // Template built-in styles for individual fields
    $spgFieldsStyle = abcfsl_cnt_spage_field_built_in_styles( $tplateOptns, $fieldOrder );

    // $staffID = itemID
    // $spgFieldsStyle = $tplateOptns
    $fieldPar['sPageUrl'] = '';
    $fieldPar['isSingle'] = true;

    foreach ( $fieldOrder as $F ) {
        $fieldCntrSPg = isset( $tplateOptns['_fieldCntrSPg_' . $F] ) ? esc_attr( $tplateOptns['_fieldCntrSPg_' . $F][0] ) : '';

        // abcfsl_cnt_txt_field( $itemOptns, $tplateOptns, $F, $fieldPar )
        switch ( $fieldCntrSPg ) {
            case 'M':
                $outHTML['M'] .= abcfsl_cnt_txt_field( $itemOptns, $spgFieldsStyle, $F, $fieldPar );
                break;
            case 'T':
                $outHTML['T'] .= abcfsl_cnt_txt_field( $itemOptns, $spgFieldsStyle, $F, $fieldPar );
                break;
            case 'B':
                $outHTML['B'] .= abcfsl_cnt_txt_field( $itemOptns, $spgFieldsStyle, $F, $fieldPar );
                break;
            default:
                $outHTML['M'] .= abcfsl_cnt_txt_field( $itemOptns, $spgFieldsStyle, $F, $fieldPar );
                break;
        }
    }
    return $outHTML;
}

//Replace built-in staff field styles with single page styling, if set.
function abcfsl_cnt_spage_field_built_in_styles( $tplateOptns, $fieldOrder ){

    foreach ( $fieldOrder as $F ) {
        $tagTypeSPg = isset( $tplateOptns['_tagTypeSPg_' . $F] ) ? esc_attr( $tplateOptns['_tagTypeSPg_' . $F][0] ) : '';
        $tagFontSPg = isset( $tplateOptns['_tagFontSPg_' . $F] ) ? esc_attr( $tplateOptns['_tagFontSPg_' . $F][0] ) : '';
        $tagMarginTSPg = isset( $tplateOptns['_tagMarginTSPg_' . $F] ) ? esc_attr( $tplateOptns['_tagMarginTSPg_' . $F][0] ) : '';
        $captionMarginTSpg = isset( $tplateOptns['_captionMarginTSPg_' . $F] ) ? esc_attr( $tplateOptns['_captionMarginTSPg_' . $F][0] ) : '';

        if( !empty( $tagTypeSPg ) ) { $tplateOptns['_tagType_' . $F][0] = $tagTypeSPg; }
        if( !empty( $tagFontSPg ) ) { $tplateOptns['_tagFont_' . $F][0] = $tagFontSPg; }
        if( !empty( $tagMarginTSPg ) ) { $tplateOptns['_tagMarginT_' . $F][0] = $tagMarginTSPg; }
        if( !empty( $captionMarginTSpg ) ) { $tplateOptns['_captionMarginT_' . $F][0] = $captionMarginTSpg; }
    }

    return $tplateOptns;
}

//##### DEPRECATED ##########################################################################
// function abcfsl_cnt_spage_txt_cntr_default_cls( $spgMTCls, $pfix ){
//     $out = '';
//     if( empty( $spgMTCls ) ) { $out = $pfix . 'PadLPc5'; }
//     return $out;
// }

// function abcfsl_cnt_spage_txt_m_divs( $par ){

//     //Replacement for: abcfsl_cnt_txt_cntr_divs( $par );
//     $pfix = $par['pfix'];
//     $txtCntrCls = $par['txtCntrCls'];
//     $txtCntrCustCls = $par['custCls'];
//     $txtCntrCustStyle = $par['custStyle'];
//     $center = $par['center'];

//     $colCntrCls = ' ' . $pfix . $par['colCntrCls'];
//     $wrapClsBase = 'LstCol';

//     //if( !empty( $txtCntrCls ) ) { $txtCntrCls =  ' ' . $pfix . $txtCntrCls;  }
//     if( !empty( $txtCntrCls ) ) { $txtCntrCls =  ' ' . $txtCntrCls; }
//     if( !empty( $center ) ) { $center =  ' ' . $pfix . $par['center'];  }
//     if( !empty( $txtCntrCustCls ) ) { $txtCntrCustCls =  ' ' . $pfix . $txtCntrCustCls;  }

//     $clsTxtCntr = rtrim( $txtCntrCls  . $txtCntrCustCls . $center );
//     $clsColumnCntr = $pfix . $wrapClsBase . ' ' . $pfix . $wrapClsBase . '-' . $par['colR'] . $colCntrCls;

//     $colCntrS = abcfl_html_tag( 'div', '', $clsColumnCntr, '' );
//     $txtCntrS = abcfl_html_tag( 'div', '', $clsTxtCntr, $txtCntrCustStyle );

//     $div['cntrS'] = $colCntrS . $txtCntrS;
//     $div['cntrE'] = abcfl_html_tag_ends( 'div,div');

//     return $div;
// }