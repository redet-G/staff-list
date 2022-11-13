<?php
function abcfsl_mbox_item_optns( $itemOptns, $tplateOptns ){

    $hideSMember = isset( $itemOptns['_hideSMember'] ) ? esc_attr( $itemOptns['_hideSMember'][0] ) : '0';
    $hideSPgLnk = isset( $itemOptns['_hideSPgLnk'] ) ? $itemOptns['_hideSPgLnk'][0] : '0';
    $pretty = isset( $itemOptns['_pretty'] ) ? esc_attr( $itemOptns['_pretty'][0] ) : '';
    $sPgTitle = isset( $itemOptns['_sPgTitle'] ) ? esc_attr( $itemOptns['_sPgTitle'][0] ) : '';

    $itemCustCls = isset( $itemOptns['_itemCustCls'] ) ? esc_attr( $itemOptns['_itemCustCls'][0] ) : '';

    echo  abcfl_html_tag('div','CN5','inside hidden abcflFadeIn');
        echo abcfl_input_checkbox('hideSMember',  '', $hideSMember, abcfsl_txta(153), '', '', '', '', '', '', '' );
        echo abcfl_input_checkbox('hideSPgLnk',  '', $hideSPgLnk, abcfsl_txta(308), '', '', '', 'abcflMTop10', '', '', '' );
        //----------------------------------------------------
        echo abcfl_input_hline('1', '10');
        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(303), abcfsl_aurl(60) );
        echo abcfl_input_txt('pretty', '', $pretty,  abcfsl_txta(231), abcfsl_txta(270) . ' ' . abcfsl_txta(232), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        //Html Head Title
        echo abcfl_input_txt('sPgTitle', '', $sPgTitle,  abcfsl_txta(77), abcfsl_txta(270), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        //----------------------------------------------------
        echo abcfl_input_hline('1', '10');
        abcfsl_mbox_tplate_field_section_hdr( 0, 367, false);
        echo abcfl_input_txt('itemCustCls', '', $itemCustCls,  abcfsl_txta(301), abcfsl_txta(270), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_html_tag_end('div');
}

