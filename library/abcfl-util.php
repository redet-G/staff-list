<?php
/**
 * Version 1.3.4
 * 
 * 134 abcfl_util_starts_with, abcfl_util_ends_with
*/

//===  MESSAGES  =========================================================
if ( !function_exists( 'abcfl_util_div_err_msg' ) ){
    function abcfl_util_div_err_msg($msg1, $msg2=''){

        if(!abcfl_html_isblank($msg1)){ $msg1 = '<p>' . $msg1 . '</p>'; }
        if(!abcfl_html_isblank($msg2)){ $msg2 = '<p>' . $msg2 . '</p>'; }

        $msg = $msg1 . $msg2;
        if(abcfl_html_isblank($msg)){ return; }
        echo ('<div class="abcfDivErrMsg">' . $msg . '</div>');
    }
}

if ( !function_exists( 'abcfl_util_msg_ok' ) ){
    function abcfl_util_msg_ok() {
        echo '<div class="wrap"><div id="abcfalOK" class="updated" style="line-height: 250%;">&nbsp; OK &nbsp;</div></div>';
    }
}

if ( !function_exists( 'abcfl_util_msg_info' ) ){
    function abcfl_util_msg_info($txt) { echo '<div class="wrap"><div class="updated fade" id="message"><p>' . $txt . '</p></div></div>' . "\n"; }
}

if ( !function_exists( 'abcfl_util_msg_err' ) ){
    function abcfl_util_msg_err($txt) { echo '<div class="wrap"><div class="error" id="error"><p>' . $txt . '</p></div></div>'; }
}
//---------------------------------------------------------
if ( !function_exists( 'abcfl_util_starts_with' ) ){
function abcfl_util_starts_with ( $str, $startStr ) { 
    $len = strlen($startStr); 
    return (substr( $str, 0, $len ) === $startStr); 
} }

if ( !function_exists( 'abcfl_util_ends_with' ) ){
function abcfl_util_ends_with( $str, $endStr ) 
{ 
    $len = strlen( $endStr ); 
    if ($len == 0) { 
        return true; 
    } 
    return ( substr( $str, -$len ) === $endStr ); 
} }

