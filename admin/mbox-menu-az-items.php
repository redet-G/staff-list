<?php
function abcfsl_mbox_menu_az_items( $tplateID, $menuOptns ) {

    //echo  abcfl_html_tag('div','','inside  hidden');
    echo  abcfl_html_tag('div','CN2','inside hidden abcflFadeIn');

        abcfsl_mbox_menu_az_items_all( $menuOptns );
        abcfsl_mbox_menu_az_items_search_fields( $menuOptns );
        abcfsl_util_mbox_no_data( $menuOptns, true );

    echo abcfl_html_tag_end('div');
}

function abcfsl_mbox_menu_az_items_all( $menuOptns ) {

        $defaultFTxt = isset( $menuOptns['_defaultFTxt'] ) ? esc_attr( $menuOptns['_defaultFTxt'][0] ) : '';
        $showAllLast = isset( $menuOptns['_showAllLast'] ) ? $menuOptns['_showAllLast'][0] : '0';
        $azItems = isset( $menuOptns['_azItems'] ) ? esc_attr( $menuOptns['_azItems'][0] ) : '';

        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(113),  abcfsl_aurl(35));

        //'mp1_F8'
        echo abcfl_input_txt('defaultFTxt', '', $defaultFTxt, abcfsl_txta(95), abcfsl_txta(270) . ' ' . abcfsl_txta(111), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_checkbox('showAllLast',  '', $showAllLast, abcfsl_txta(137), '', '', '', 'abcflFldCntr', '', '', '' );
        echo abcfl_input_hline('1');
        echo abcfl_input_txt('azItems', '', $azItems, abcfsl_txta(131), abcfsl_txta(117), '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfsl_mbox_menu_az_items_search_fields( $menuOptns, $filterNo='' ) {

        $azFieldID = isset( $menuOptns['_azFieldID' . $filterNo] ) ? $menuOptns['_azFieldID' . $filterNo][0] : '';
        $azFieldType = isset( $menuOptns['_azFieldType' . $filterNo] ) ? $menuOptns['_azFieldType' . $filterNo][0] : '_sortTxt';

        $cboFieldID = abcfsl_cbo_field_id();
        //Includes post title
        $cboFieldType = abcfsl_cbo_az_filed_type_pt();

        //'mp1_F8'
        echo abcfl_input_hline('2', 15);
        echo abcfl_input_info_lbl( abcfsl_txta(129), 'abcflMTop10', 16, 'SB');
        echo abcfl_input_info_lbl( abcfsl_txta(133) . ' ' . abcfsl_txta(176), 'abcflMTop5', 13, 'N');
        echo abcfl_input_cbo_strings( 'azFieldID' . $filterNo, '', $cboFieldID, $azFieldID, abcfsl_txta_r(291), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo_strings( 'azFieldType' . $filterNo, '', $cboFieldType, $azFieldType, abcfsl_txta_r(222), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}