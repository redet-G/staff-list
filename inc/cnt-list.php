<?php
//List Items builder.
function abcfsl_cnt_list( $tplateOptns, $optns, $menuParts, $filters ){

    //$optns contain also shortcode parameters
    $pfix = $optns['pfix'];
    $grpID = $optns['grpID'];
    $grpType = $optns['grpType'];   
    //$parentID = $optns['tplateID']; 
    $parentID = $optns['parentID'];
    //$tplateOptns['slTplateID'] = $parentID;

    $lstItemDefaultCls = $pfix . 'PadBMB30';

    $colL = isset( $tplateOptns['_lstCols'] ) ? esc_attr( $tplateOptns['_lstCols'][0] ) : '6';
    $colR = (12 - $colL);
    //$lstItemCustomCls = isset( $tplateOptns['_lstItemCls'] ) ? esc_attr( $tplateOptns['_lstItemCls'][0] ) : $lstItemDefaultCls;
    //$lstItemStyle = isset( $tplateOptns['_lstItemStyle'] ) ? esc_attr( $tplateOptns['_lstItemStyle'][0] ) : '';
    //$sPageUrl = isset( $tplateOptns['_sPageUrl'] ) ? esc_attr( $tplateOptns['_sPageUrl'][0] ) : '';
    $noDataMsgT = isset( $tplateOptns['_noDataMsg'] ) ? esc_attr( $tplateOptns['_noDataMsg'][0] ) : '';

    //== PG ==============================================
    $defaultParts = abcfsl_util_pg_cnt_parts_defaults( $noDataMsgT, $menuParts['noDataMsg'] );

    //Get staff members IDs. Used always, paginator or not.
    $out = abcfsl_paginator_post_ids( $optns, $menuParts, $filters );
    $totalQty = $out['totalQty'];
    if( $totalQty == 0 ) { return $defaultParts; }
    $postIDs = $out['postIDs'];
    //================================================
    $itemPar['pfix'] = $pfix;
    $itemPar['parentID'] = $parentID;
    $itemPar['grpID'] = $grpID;
    $itemPar['lstItemCustomCls'] = isset( $tplateOptns['_lstItemCls'] ) ? esc_attr( $tplateOptns['_lstItemCls'][0] ) : $lstItemDefaultCls;
    $itemPar['lstItemStyle'] = isset( $tplateOptns['_lstItemStyle'] ) ? esc_attr( $tplateOptns['_lstItemStyle'][0] ) : '';
    $itemPar['sPageUrl'] = isset( $tplateOptns['_sPageUrl'] ) ? esc_attr( $tplateOptns['_sPageUrl'][0] ) : '';
    $itemPar['colL'] = $colL;
    $itemPar['colR'] = $colR;  
    $itemPar['fieldOrder'] = abcfsl_util_field_order( $tplateOptns, false );  

    $itemPar['hiddenFields'] =  $optns['hiddenFields'];
    $itemPar['privateFields'] =  $optns['privateFields'];
    $itemPar['keepDups'] = $optns['keepDups'];
    //================================================

    $itemsHTML  = '';
    $itemsSD  = array(); //SDATA

    if ( $grpID > 0 ) {              
        $groupsData = abcfsl_cnt_groups_all_groups_all_parts( 'L', $grpType, $postIDs, $tplateOptns, $itemPar, '', '' );
        $itemsHTML = $groupsData['itemsHTML'];
        $itemsSD = $groupsData['sdProperties']; //SDATA                  
    }
    else{     
        $gridData = abcfsl_cnt_list_all_parts( $postIDs, $tplateOptns, $itemPar );
        $itemsHTML = $gridData['itemsHTML'];
        $itemsSD = $gridData['sdProperties']; 
    }

    $outParts = abcfsl_util_pg_cnt_parts( $tplateOptns, $totalQty, $optns['pageNo'], $itemsHTML, $itemsSD, $pfix, $optns['ajax'], $optns['top'] );
    return $outParts;
}

//List. No groups. HTML + SD structured data. 
function abcfsl_cnt_list_all_parts( $postIDs, $tplateOptns, $itemPar ){    

    $out['itemsHTML'] = '';
    $out['sdProperties'] = array();
    $itemsHTML = '';
    $sdProperties  = array();

    foreach ( $postIDs as $itemID ) {
        $outItems = abcfsl_cnt_list_item_cntr( $itemID, $tplateOptns, $itemPar );
        $itemsHTML .= $outItems['itemCntr'];
        $sdProperties[] = $outItems['sdProperties']; //SDATA
    }    

    $out['itemsHTML'] = $itemsHTML;
    $out['sdProperties'] =  $sdProperties;

    return $out;
}

//-- LIST ITEM ---------------------------------------------
//List Item container: image left, text right.
function abcfsl_cnt_list_item_cntr( $itemID, $tplateOptns, $itemPar ){  
    
    $pfix = $itemPar['pfix'];
    $lstItemCustomCls = $itemPar['lstItemCustomCls'];
    $lstItemStyle = $itemPar['lstItemStyle'];

    $itemOptns = get_post_custom( $itemID );
    $itemCustCls = isset( $itemOptns['_itemCustCls'] ) ? esc_attr( $itemOptns['_itemCustCls'][0] ) : '';

    $itemCntr = abcfsl_cnt_item_cntr( $lstItemCustomCls, $lstItemStyle, $pfix . 'ItemCntrLst', $itemID, $itemCustCls );

    $par['pgLayout'] = 1;
    $par['itemID'] = $itemID;
    $par['colL'] = $itemPar['colL'];
    $par['colR'] = $itemPar['colR'];

    $par['hiddenFields'] =  $itemPar['hiddenFields'];
    $par['privateFields'] =  $itemPar['privateFields'];
    $par['keepDups'] = $itemPar['keepDups'];

    $par['clsPfix'] = $pfix;
    $par['sPageUrl'] = $itemPar['sPageUrl'];
    $par['isSingle'] = false;
    $par['center'] = 'Center575';
    $par['txtCntrCls'] = 'TxtCntrLst';
    $par['colWrapBaseCls'] = 'TxtColLst';
    $par['custCls'] = '';

    $fieldOrder = $itemPar['fieldOrder'];

    $imgCntr = abcfsl_cnt_img_cntr( $tplateOptns, $itemOptns, $par );
    $txtSection = abcfsl_cnt_txt_cntr( $tplateOptns, $itemOptns, $par, $fieldOrder );

    //SDATA
    $out['itemCntr'] = $itemCntr['itemCntrS'] . $imgCntr . $txtSection . $itemCntr['itemCntrE'];
    $out['sdProperties'] = abcfsl_struct_data_item_grid( $tplateOptns, $itemOptns, $itemID, $fieldOrder );

    return $out;
}

//=========================================================
//== LIST - GROUPS - START ==============================
//LIST - CAT. ALL groups. Header + HTML + SD.
function abcfsl_cnt_list_all_groups_all_parts_cat( $staffIDs, $tplateOptns, $itemPar ){

    $outGroup = array();
    $itemsHTML = '';
    $sdProperties  = array();
    $groupSDProperties = array();

    $groupsData['itemsHTML'] = '';
    $groupsData['itemsSD'] = array();
    //-----------------------------  
    $groupsData = abcfsl_cnt_groups_data_categories( $staffIDs, $itemPar['grpID'], $itemPar['parentID'], $itemPar['keepDups'] );
    //Slug > Category name pairs. Included only saved slugs. [faculty] => Faculty
    $slugNamePairs = $groupsData['slugNamePairs'];
    //Staff IDs grouped by slugs. Includes none group.
    $groupedIDs = $groupsData['groupedIDs'];
    //-----------------------------    

    //Slug > Category name pairs. Included only saved slugs. [faculty] => Faculty
    foreach ( $slugNamePairs as $slug => $grpName  ) {

        if (array_key_exists( $slug, $groupedIDs ))  { 
                $groupIDs = $groupedIDs[$slug];
                $outGroup = abcfsl_cnt_list_single_group_all_parts( $groupIDs, $grpName, $tplateOptns, $itemPar );
                $itemsHTML .= $outGroup['itemsHTML'];
            
                $groupSDProperties = $outGroup['groupSDProperties'];
                foreach ($groupSDProperties as $value) {
                    $sdProperties[] = $value;
                    //$itemsSD[] = $value;
                } 
        } 
    }

    $groupsData['itemsHTML'] = $itemsHTML;
    $groupsData['sdProperties'] = $sdProperties;

    return $groupsData;
}

//LIST - TXT. ALL groups. Header + HTML + SD.
function abcfsl_cnt_list_all_groups_all_parts_txt( $grpType, $postIDs, $tplateOptns, $itemPar ){

    $parentID = $itemPar['parentID'];
    $grpID = $itemPar['grpID'];

    $outGroup = array();
    $itemsHTML = '';
    $sdProperties  = array();
    $groupSDProperties = array();

    $groupsData['itemsHTML'] = '';
    $groupsData['itemsSD'] = array();
    //-----------------------------  
    $groupsData = abcfsl_cnt_groups_data_txt( $grpType, $postIDs, $grpID, $parentID, $tplateOptns, $itemPar );
    //Slug > Category name pairs. Included only saved slugs. [faculty] => Faculty
    $grpNames = $groupsData['grpNames'];
    //Staff IDs grouped by slugs. Includes none group.
    $groupedIDs = $groupsData['groupedIDs'];
    //-----------------------------  
    
    //Slug > Category name pairs. Included only saved slugs. [faculty] => Faculty
    foreach ( $grpNames as $grpName  ) {        

        if ( array_key_exists( $grpName, $groupedIDs ) )  { 
                $groupIDs = $groupedIDs[$grpName];
                $outGroup = abcfsl_cnt_list_single_group_all_parts( $groupIDs, $grpName, $tplateOptns, $itemPar );
                $itemsHTML .= $outGroup['itemsHTML'];
            
                $groupSDProperties = $outGroup['groupSDProperties'];
                foreach ($groupSDProperties as $value) {
                    $sdProperties[] = $value;
                    //$itemsSD[] = $value;
                } 
        } 
    }

    $groupsData['itemsHTML'] = $itemsHTML;
    $groupsData['sdProperties'] = $sdProperties;

    return $groupsData;    
}

//LIST. Single group. Header + HTML + SD.                 
function abcfsl_cnt_list_single_group_all_parts( $groupIDs, $grpName, $tplateOptns, $itemPar ){

    $itemsHTML = '';
    $itemsSD  = array(); //SDATA
    $outGroup = [];
    $outItem = '';
    $grpID = $itemPar['grpID'];
    $pfix = $itemPar['pfix'];
    //Group container
    $grpCntrS = abcfl_html_tag( 'div', '', $pfix . 'GrpCntr', '' );

    //[0] => 6371
    foreach ( $groupIDs as $itemID ) {
        //$out = abcfsl_cnt_list_item_cntr( $itemID, $groupIDs, $tplateOptns, $itemPar );
        $out = abcfsl_cnt_list_item_cntr( $itemID, $tplateOptns, $itemPar );
        $itemsHTML .= $out['itemCntr'];
        $itemsSD[] = $out['sdProperties']; //SDATA
    }

    //Group container
    $itemsHTML = $grpCntrS . $itemsHTML . abcfl_html_tag_end( 'div');
    $grpHeader = abcfsl_cnt_groups_grp_header( $grpID, $grpName, $pfix );

    $outGroup['itemsHTML'] = $grpHeader . $itemsHTML;    
    //Array of sdProperties.
    $outGroup['groupSDProperties'] = $itemsSD;

    return $outGroup;
}
//== LIST - GROUPS - END ========================================
//===============================================================
