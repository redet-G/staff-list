<?php
function abcfsl_mbox_group_items( $grpID, $grpOptns, $grpType ) {

    $grpItems = '';
    //GRPCAT GRPTXT GRPABC
    switch ( $grpType ) {
        case 'GRPCAT':                    
            abcfsl_mbox_group_items_html( $grpType, $grpID, $grpOptns, 340, 78, 96 );             
            break;
        case 'GRPTXT':
            abcfsl_mbox_group_items_html( $grpType, $grpID, $grpOptns, 341, 79, 361 ); 
            break;
        case 'GRPABC':
            abcfsl_mbox_group_items_html( $grpType, $grpID, $grpOptns, 342, 75, 362 ); 
            break;                               
        default:
            abcfsl_mbox_group_items_group_type_select( $grpType );
            break;
    }
}

function abcfsl_mbox_group_items_html( $grpType, $grpID, $grpOptns, $txtIDSectTitleHlp, $txtIDSectTitleUrl, $txtIDHdr ) {

    echo  abcfl_html_tag('div','CN2','inside hidden abcflFadeIn');
        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta( $txtIDSectTitleHlp ),  abcfsl_aurl( $txtIDSectTitleUrl ) );
        $grpSlugs = get_post_meta( $grpID, '_grpSlugs', true );

        abcfsl_mbox_group_items_slugs_hdr( $txtIDHdr );
        abcfsl_mbox_group_items_slugs( $grpSlugs );

        if( $grpType != 'GRPCAT' ){
            abcfsl_mbox_group_items_search_fields( $grpOptns );
        }
    echo abcfl_html_tag_end('div');
}

function abcfsl_mbox_group_items_slugs_hdr( $txtIDHdr ) {
    echo abcfl_input_hline('1');
    echo abcfl_input_info_lbl(abcfsl_txta_r( $txtIDHdr ), 'abcflMTop10 abcflMBottom10', 14, 'SB');
}

function abcfsl_mbox_group_items_slugs( $grpSlugs ) {

    $tbl = abcfl_html_tag( 'table', 'slTblCatSlugs', '', 'width:50%;' );
    $tbl .= abcfl_html_tag_blank('thead');
    $tbl .= abcfl_html_tag_blank('tr');
    $tbl .= abcfl_html_tag( 'th', '', '', '' );
    $tbl .=  abcfl_html_tag_end( 'th' );
    $tbl .= abcfl_html_tag_with_content( '', 'th', '', 'abcflFontW400 abcflTxtLeft', 'width:80%;' );
    $tbl .= abcfl_html_tag( 'th', '', '', '' );
    $tbl .=  abcfl_html_tag_ends( 'th,tr,thead' );
    echo $tbl;    

    if ( $grpSlugs ) {
        foreach ( $grpSlugs as $field ) {
            $fieldValue = '';
            if($field['grpSlugs'] != '') { $fieldValue = esc_attr( $field['grpSlugs'] ); }
            echo abcfsl_mbox_group_items_slug_row( $fieldValue );
        }
    }
	else {
            // Blank one
            echo abcfsl_mbox_group_items_slug_row( '' );
    }
    // empty hidden one for jQuery
    echo abcfsl_mbox_group_items_slug_row( '', 'slTrEmptyRowSlug screen-reader-text' );
    echo abcfl_html_tag_ends( 'tbody,table' );
    echo abcfl_html_tag_with_content('<a id="slBtnAddRowSlug" class="button" href="#"><span class="abcflFontW700 abcflFontS20">+</span></a>', 'p', '', '', '' );
}

function abcfsl_mbox_group_items_slug_row( $fieldValue, $cls='' ){

    $row = abcfl_html_tag( 'tr', '', $cls);
    $row .= abcfl_html_tag_with_content('<a class="button slBtnRemoveRowSlug" href="#">X</a>', 'td', '', '', '' );
    $row .= abcfl_html_tag( 'td', '', '');
    $row .= abcfl_html_input_text( 'grpSlugs'. '[]', $fieldValue, $size='100%');
    $row .= abcfl_html_tag_end( 'td' );
    $row .= abcfl_html_tag( 'td', '', 'slTdSortHandleSlug' );
    $row .= abcfl_html_img_tag('', ABCFSL_PLUGIN_URL . 'images/move-icon.png', 'Move Icon', '', 24, 24);
    $row .= abcfl_html_tag_end( 'td' );
    $row .= abcfl_html_tag_end( 'tr' );

    return $row;
}

//-- ADD NEW Group. --------------------
function abcfsl_mbox_group_items_group_type_select( $grpType ){

    echo  abcfl_html_tag('div','','inside');
        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(343),  abcfsl_aurl(74));
        $cboGrpType = abcfsl_cbo_group_type();
        echo abcfl_input_cbo('grpType', '', $cboGrpType, $grpType, '', '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_html_tag_end('div');
}

function abcfsl_mbox_group_items_search_fields( $grpOptns ) {

    $grpFieldID = isset( $grpOptns['_grpFieldID'] ) ? $grpOptns['_grpFieldID'][0] : '';
    $grpFieldType = isset( $grpOptns['_grpFieldType'] ) ? $grpOptns['_grpFieldType'][0] : '_sortTxt';

    //$cboFieldID = abcfsl_cbo_field_id();
    //$cboFieldType = abcfsl_cbo_az_filed_type();

    $cboFieldID = abcfsl_cbo_field_id();
    $cboFieldType = abcfsl_cbo_az_filed_type_pt();
    

    //'mp1_F8'
    echo abcfl_input_hline('2', 15);
    echo abcfl_input_info_lbl( abcfsl_txta(363), 'abcflMTop10', 16, 'SB');
    echo abcfl_input_cbo_strings( 'grpFieldID', '', $cboFieldID, $grpFieldID, abcfsl_txta_r(291), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings( 'grpFieldType', '', $cboFieldType, $grpFieldType, abcfsl_txta_r(222), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}