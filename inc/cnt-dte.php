<?php
function abcfsl_cnt_dte_field_SLDTE( $par ){

    $dteYMD = $par['dteYMD'];
    if( abcfl_html_isblank( $dteYMD ) ) { return ''; }

    $dteYMD = abcfsl_cnt_dte_formated( $dteYMD, $par['dtFormat'] );

    if( abcfl_html_isblank($par['lblTxt'] ) ) { 

        $par['lineTxt']  = $dteYMD;
        return abcfsl_cnt_txt_field_T( $par ); 
    }

    $tagCls = abcfsl_util_pg_type_cls_bldr( $par['tagCls'], $par['isSingle'] );
    $lblCls = abcfsl_util_pg_type_cls_bldr( $par['lblCls'], $par['isSingle'] );
    $txtCls = abcfsl_util_pg_type_cls_bldr( $par['txtCls'], $par['isSingle'] );

    $cntrS = abcfl_html_tag( $par['tagType'], '', $tagCls, '' );
    $cntrE = abcfl_html_tag_end( $par['tagType']);

    $spanLblS = abcfl_html_tag( 'span', '', $lblCls, ''  );
    $spanTxtS = abcfl_html_tag( 'span', '', $txtCls, '' );

    $spanE = abcfl_html_tag_end('span');

    return $cntrS . $spanLblS . html_entity_decode( $par['lblTxt'] ) . '&nbsp;' . $spanE . $spanTxtS . html_entity_decode($dteYMD) . $spanE . $cntrE;
}

function abcfsl_cnt_dte_formated( $dteYMD, $dtFormat ){

    $out = $dteYMD;
    if( empty( $dtFormat ) ) { return $out; }

    switch ( $dtFormat ) {
        case 'D/M/Y':
            $out = implode('/', array_reverse(explode('-', $dteYMD)));
            break;
        case 'D.M.Y':
            $out = implode('.', array_reverse(explode('-', $dteYMD)));
            break;
        case 'D-M-Y':
            $out = implode('-', array_reverse(explode('-', $dteYMD)));
            break;             
        case 'M/D/Y':
            $out  = date('m/d/Y', strtotime( $dteYMD ) );
            break; 
        case 'M.D.Y':
            $out  = date('m.d.Y', strtotime( $dteYMD ) );
            break;  
        case 'M-D-Y':
            $out  = date('m-d-Y', strtotime( $dteYMD ) );
            break;  
        case 'Y/M/D':
            $out = implode( '/', explode( '-', $dteYMD ) );
            break;           
        case 'Y.M.D':
            $out = implode( '.', explode( '-', $dteYMD ) );
            break;          
        default:
            break;
    }

    return $out;
}