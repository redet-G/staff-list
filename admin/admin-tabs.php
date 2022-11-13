<?php
/*
 * Admin tabs: Defaults, Lisense and Help.
 */
function abcfsl_admin_tabs() {

    $getParams = abcfsl_admin_tabs_defaults( $_GET );
    $basePg = 'admin.php?page=' . $getParams['page'];
    $currentTab = $getParams['tab'];

    $tabs = array(
        'tabHelp' => abcfsl_txta(1),
        'tabDefaultTplate' => abcfsl_txta(33),
        'tabQuickStart' => abcfsl_txta(78)
        );
    $links = array();

   //Tab links
   foreach( $tabs as $tab => $name ) {

        $href =  $basePg . '&amp;tab=' . $tab;
        if ( $tab == $currentTab ) {
            $links[] = abcfl_html_a_tag( $href, $name, '', 'nav-tab abcfkapNavTab nav-tab-active abcfkapNavTabActive' );
        }
        else {
            $links[] = abcfl_html_a_tag( $href, $name, '', 'nav-tab abcfkapNavTab');
        }
    }

    echo  abcfl_html_tag('div', '', 'wrap' );
    echo abcfl_html_tag( 'h2', '', 'nav-tab-wrapper' );

    foreach ( $links as $link ){ echo $link; }
    echo abcfl_html_tag_ends('h2,div');

    switch ( $currentTab ) {
        case 'tabHelp' :
            abcfsl_admin_tab_help();
            break;
        case 'tabQuickStart' :
            abcfsl_admin_quick_start();
            break;
        case 'tabDefaultTplate' :
            abcfsl_admin_default_tplate();
            break;
        default:
            abcfsl_admin_tab_help();
            break;
   }
}
//--------------------------------------------------
function abcfsl_admin_tabs_defaults( $get ) {

    //$optns = $_GET;
    if(!$get){ $get = array();}
    $defaults = array(
        'page' => 'abcfsl-admin-tabs',
        'tab' => 'tabHelp'
     );

    return wp_parse_args( $get, $defaults );
}