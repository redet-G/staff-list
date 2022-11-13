<?php

//Categories menu. Rename to abcfsl_mbox_menu_cat_items_cat ???????
function abcfsl_mbox_menu_cat_items( $menuID, $menuOptns ) {

    //echo  abcfl_html_tag('div','','inside hidden');
    echo  abcfl_html_tag('div','CN2','inside hidden abcflFadeIn');

        abcfsl_mbox_menu_cat_items_all( $menuOptns );

        $slugs = get_post_meta( $menuID, '_catSlugs', true );
        abcfsl_mbox_menu_cat_items_slugs_hdr();
        abcfsl_mbox_menu_cat_items_slugs( $slugs );
        abcfsl_util_mbox_no_data( $menuOptns, true );

    echo abcfl_html_tag_end('div');
}

function abcfsl_mbox_menu_cat_items_all( $menuOptns ) {

    $defaultFTxt = isset( $menuOptns['_defaultFTxt'] ) ? esc_attr( $menuOptns['_defaultFTxt'][0] ) : '';
    $showAllLast = isset( $menuOptns['_showAllLast'] ) ? $menuOptns['_showAllLast'][0] : '0';

    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(276),  abcfsl_aurl(34));

    echo abcfl_input_txt('defaultFTxt', '', $defaultFTxt, abcfsl_txta(95), abcfsl_txta(111), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_checkbox('showAllLast',  '', $showAllLast, abcfsl_txta(137), '', '', '', 'abcflFldCntr', '', '', '' );
}

function abcfsl_mbox_menu_cat_items_slugs_hdr() {
    echo abcfl_input_hline('1');
    echo abcfl_input_info_lbl(abcfsl_txta( 45 ), 'abcflMTop10', 16, 'SB');
    echo abcfl_input_info_lbl(abcfsl_txta(114), 'abcflMTop5 abcflMBottom20', 14, 'SB');
}

function abcfsl_mbox_menu_cat_items_slugs( $slugs, $filterNo='' ) {

    $tbl = abcfl_html_tag( 'table', 'slTblCatSlugs', '', 'width:50%;' );
    $tbl .= abcfl_html_tag_blank('thead');
    $tbl .= abcfl_html_tag_blank('tr');
    $tbl .= abcfl_html_tag( 'th', '', '', '' );
    $tbl .=  abcfl_html_tag_end( 'th' );
    $tbl .= abcfl_html_tag_with_content( abcfsl_txta_r(96), 'th', '', 'abcflFontW400 abcflTxtLeft', 'width:80%;' );
    $tbl .= abcfl_html_tag( 'th', '', '', '' );
    $tbl .=  abcfl_html_tag_ends( 'th,tr,thead' );

    echo $tbl;

    if ( $slugs ) {
        foreach ( $slugs as $field ) {
            $fieldValue = '';
            if($field['catSlug' . $filterNo] != '') { $fieldValue = esc_attr( $field['catSlug' . $filterNo] ); }
            echo abcfsl_mbox_menu_cat_items_slug_row( $fieldValue, $filterNo );
        }
    }
	else {
            // show a blank one
            echo abcfsl_mbox_menu_cat_items_slug_row( '', $filterNo );

    }
    // empty hidden one for jQuery
    echo abcfsl_mbox_menu_cat_items_slug_row( '', $filterNo, 'slTrEmptyRowSlug screen-reader-text' );
    echo abcfl_html_tag_ends( 'tbody,table' );
    echo abcfl_html_tag_with_content('<a id="slBtnAddRowSlug" class="button" href="#"><span class="abcflFontW700 abcflFontS20">+</span></a>', 'p', '', '', '' );
}

function abcfsl_mbox_menu_cat_items_slug_row( $fieldValue, $filterNo, $cls='' ){

    $row = abcfl_html_tag( 'tr', '', $cls);
    $row .= abcfl_html_tag_with_content('<a class="button slBtnRemoveRowSlug" href="#">X</a>', 'td', '', '', '' );
    $row .= abcfl_html_tag( 'td', '', '');
    $row .= abcfl_html_input_text( 'catSlug'. $filterNo . '[]', $fieldValue, $size='100%');
    $row .= abcfl_html_tag_end( 'td' );
    $row .= abcfl_html_tag( 'td', '', 'slTdSortHandleSlug' );
    $row .= abcfl_html_img_tag('', ABCFSL_PLUGIN_URL . 'images/move-icon.png', 'Move Icon', '', 24, 24);
    $row .= abcfl_html_tag_end( 'td' );
    $row .= abcfl_html_tag_end( 'tr' );

    return $row;
}


