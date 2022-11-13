<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$dataL = '';
$dataR = '';
 $fieldsCntrS = abcfl_html_tag( 'div', '', 'abcfslGridRow abcfClrFix' );
 $fieldCntrS = abcfl_html_tag( 'div', '', 'abcfslGridCol abcfslGridCol_2 abcfslPadLRPc1 abcfslMB40' );
 $divE = abcfl_html_tag_end( 'div');


return  $fieldsCntrS . $fieldCntrS . $dataL . $divE . $fieldCntrS . $fieldCntrS . $divE . $divE;

//<div class="abcfslGridRow abcfClrFix">
//<div class="abcfslGridCol abcfslGridCol_2 abcfslPadLRPc1 abcfslMB40">
//</div>
//<div class="abcfslGridCol abcfslGridCol_2 abcfslPadLRPc1 abcfslMB40">
//</div>
//</div>