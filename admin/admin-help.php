<?php
function abcfsl_admin_tab_help( ) {

    echo abcfl_html_tag_cls('div', 'abcflMTop30 abcflPLeft20');

    echo abcfl_input_hlp_url( 'Quick Start', abcfsl_aurl(10), 'abcflFontS20 abcflFontW600 abcflMTop30 abcflPLeft20' );

    echo abcfl_input_hlp_url( abcfsl_txta(11), abcfsl_aurl(11), 'abcflFontS20 abcflFontW600 abcflMTop30 abcflPLeft20' );

    echo abcfl_input_hlp_url( abcfsl_txta(24), 'https://wordpress.org/support/plugin/staff-list', 'abcflFontS20 abcflFontW600 abcflMTop30 abcflPLeft20' );


    echo abcfl_html_tag_end('div');

}
