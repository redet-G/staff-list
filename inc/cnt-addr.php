<?php
// vCARD
function abcfsl_cnt_ADDR( $par, $tplateOptns, $itemOptns ){

    $F = $par['F'];
    $clsPfix = $par['clsPfix'];

    //-----------------------------------------------------------
    $adr1 = isset( $itemOptns['_adr1_' . $F] ) ? esc_attr( $itemOptns['_adr1_' . $F][0] ) : '';
    $adr2 = isset( $itemOptns['_adr2_' . $F] ) ? esc_attr( $itemOptns['_adr2_' . $F][0] ) : '';
    $adr3 = isset( $itemOptns['_adr3_' . $F] ) ? esc_attr( $itemOptns['_adr3_' . $F][0] ) : '';
    $adr4 = isset( $itemOptns['_adr4_' . $F] ) ? esc_attr( $itemOptns['_adr4_' . $F][0] ) : ''; 
    $adr5 = isset( $itemOptns['_adr5_' . $F] ) ? esc_attr( $itemOptns['_adr5_' . $F][0] ) : '';
    $adr6 = isset( $itemOptns['_adr6_' . $F] ) ? esc_attr( $itemOptns['_adr6_' . $F][0] ) : '';

    if( abcfl_html_isblank( $adr1 . $adr2 . $adr3 . $adr4 . $adr5 . $adr6 ) ) { return ''; }
    //-----------------------------------------------------------
           
    $lblTxt = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '';

    $cntrLbl = abcfsl_cnt_ADDR_lbl( $par, $lblTxt, $F );
    $cntrTxt = abcfsl_cnt_ADDR_txt( $par, $adr1, $adr2, $adr3, $adr4, $adr5, $adr6, $F );

    $cntrS = abcfl_html_tag( 'div', 'adrCntr_' . $F, $clsPfix . 'AdrCntr', '' );
    $cntrE = abcfl_html_tag_end( 'div');

    return $cntrS . $cntrLbl . $cntrTxt . $cntrE;  

    //<div itemprop="address" itemscope="itemscope" itemtype="http://schema.org/PostalAddress">
    //     <h3>Visiting address:</h3>
    //     <div itemprop="streetAddress">Avenue Josse Goffin 158</div>
    //     <div>
    //         <span itemprop="postalCode">B-1082 Brussels,</span>
    //         <span itemprop="addressCountry">Belgium</span>
    //     </div>
    // </div>  
}

function abcfsl_cnt_ADDR_lbl( $par, $lblTxt, $F ){

    if( abcfl_html_isblank( $lblTxt ) ) { return ''; }

    // lblTag lblAboveCls lblStyle
    $cntrS = abcfl_html_tag( $par['lblTag'], '', $par['lblAboveCls'], $par['lblStyle'] );
    $cntrE = abcfl_html_tag_end( $par['lblTag']);

    return $cntrS . $lblTxt . $cntrE;
}

function abcfsl_cnt_ADDR_txt( $par, $adr1, $adr2, $adr3, $adr4, $adr5, $adr6, $F ){

    //'txtTag txtAboveCls' txtTag' txtStyle
    $cntrS = abcfl_html_tag( $par['txtTag'], '', $par['txtAboveCls'], $par['txtStyle'] );
    $cntrE = abcfl_html_tag_end( $par['txtTag']);

    $adrL1 = abcfsl_cnt_ADDR_l1( $adr1, $adr2, $F );
    $adrL2 = abcfsl_cnt_ADDR_l2( $adr3, $adr4, $adr5, $adr6, $F );

    return $cntrS . $adrL1 . $adrL2 . $cntrE;

    //     <div itemprop="streetAddress">Avenue Josse Goffin 158</div>
    //     <div>
    //         <span itemprop="postalCode">B-1082 Brussels,</span>
    //         <span itemprop="addressCountry">Belgium</span>
    //     </div>
}

function abcfsl_cnt_ADDR_l1( $adr1, $adr2, $F ){

    //  <div itemprop="streetAddress">Avenue Josse Goffin 158</div>

    if( abcfl_html_isblank( $adr1 . $adr2 ) ) { return ''; }
    $adr = trim( $adr1 . ' ' . $adr2);

    $cntrS = abcfl_html_tag( 'div', 'adrL1_' . $F, 'adrL1' );
    $cntrE = abcfl_html_tag_end( 'div');

    return $cntrS . $adr . $cntrE;
}

function abcfsl_cnt_ADDR_l2( $adr3, $adr4, $adr5, $adr6, $F ){

    //     <div>
    //         <span itemprop="postalCode">B-1082 Brussels,</span>
    //         <span itemprop="addressCountry">Belgium</span>
    //     </div>

    if( abcfl_html_isblank( $adr3 . $adr4 . $adr5 . $adr6 ) ) { return ''; }

    $contryPrefix = '';
    if( !abcfl_html_isblank( $adr6 ) ) { $contryPrefix = ','; }
    if( abcfl_html_isblank( $adr3 . $adr4 . $adr5 ) ) { $contryPrefix = ''; }
    
    $span3 = '';
    $span4 = '';
    $span5 = '';
    $span6 = '';

    if( !abcfl_html_isblank( $adr3 ) ) { $span3 = '<span class="adrL2_1">' . $adr3 . ' </span>'; }
    if( !abcfl_html_isblank( $adr4 ) ) { $span4 = '<span class="adrL2_2">' . $adr4 . ' </span>'; }
    if( !abcfl_html_isblank( $adr5 ) ) { $span5 = '<span class="adrL2_3">' . $adr5 . ' </span>'; }
    if( !abcfl_html_isblank( $adr6 ) ) { $span5 = '<span class="adrL2_3">' . $adr5 . $contryPrefix . ' </span>'; }    
    if( !abcfl_html_isblank( $adr6 ) ) { $span6 = '<span class="adrL2_4">' . $adr6 . '</span>'; }

    $cntrS = abcfl_html_tag( 'div', 'adrL2_' . $F, 'adrL2' );
    $cntrE = abcfl_html_tag_end( 'div');

    $adr = trim( $span3 . $span4 . $span5 . $span6);

    return $cntrS . $adr . $cntrE;
}