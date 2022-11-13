<?php
function abcfsl_cnt_date_field_SLDTE( $par ){

    $dteYMD = $par['dteYMD'];
    if( abcfl_html_isblank( $dteYMD ) ) { return ''; }

    $dteYMD = abcfsl_cnt_date_formated( $dteYMD, $par['dtFormat'] );

    if( abcfl_html_isblank($par['lblTxt'] ) ) { 

        $par['lineTxt']  = $dteYMD;
        return abcfsl_cnt_field_T( $par ); 
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

function abcfsl_cnt_date_formated( $dteYMD, $dtFormat ){

    //ISO-8601 rules for displaying temporal data (https://xkcd.com/1179/). 
    //This is “yyyy-mm-dd” with the dashes, not slashes. The reasons are simple; this string format sorts correctly. 

    $out = $dteYMD;
    if( empty( $dtFormat ) ) { return $out; }
    if( empty( $dteYMD ) ) { return $out; }
    if( strlen( $dteYMD ) < 10 ) { return $out; }

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
        case 'D/M':
            $out = date('d/m', strtotime( $dteYMD ) );
            break;
        case 'D.M':
            $out = date('d.m', strtotime( $dteYMD ) );
            break;                        
        case 'D-M':
            $out = date('d-m', strtotime( $dteYMD ) );
            break;
        case 'M/D':
            $out = date('m/d', strtotime( $dteYMD ) );
            break;
        case 'M.D':
            $out = date('m.d', strtotime( $dteYMD ) );
            break;
        case 'M-D':
            $out = date('m-d', strtotime( $dteYMD ) );
            break;
        case 'MD-E':
            $out = abcfsl_cnt_date_txt_e( $dteYMD, 'MD-E' );
            break;
        case 'DM-E':
            $out = abcfsl_cnt_date_txt_e( $dteYMD, 'DM-E' );
            break;
        case 'DM,Y-E':
            $out = abcfsl_cnt_date_txt_e( $dteYMD, 'DM,Y-E' );
            break;
        case 'DMY-E':
            $out = abcfsl_cnt_date_txt_e( $dteYMD, 'DMY-E' );
            break;            
        case 'MD':
            $out = abcfsl_cnt_date_txt_cust( $dteYMD, 'MD', 'm' );
            break;
        case 'DM':
            $out = abcfsl_cnt_date_txt_cust( $dteYMD, 'DM', 'm' );
            break;
        case 'DM,Y':
            $out = abcfsl_cnt_date_txt_cust( $dteYMD, 'DM,Y', 'm' );
            break;
        case 'DMY':
            $out = abcfsl_cnt_date_txt_cust( $dteYMD, 'DMY', 'm' );

        case 'MD-S':
            $out = abcfsl_cnt_date_txt_cust( $dteYMD, 'MD', 'mA' );
            break;
        case 'DM-S':
            $out = abcfsl_cnt_date_txt_cust( $dteYMD, 'DM', 'mA' );
            break;
        case 'DM,Y-S':
            $out = abcfsl_cnt_date_txt_cust( $dteYMD, 'DM,Y', 'mA' );
            break;
        case 'DMY-S':
            $out = abcfsl_cnt_date_txt_cust( $dteYMD, 'DMY', 'mA' );
            break;                         
        default:
            break;
    }
    return $out;
}

//------------------------------------------------------------
//English month names
function abcfsl_cnt_date_txt_e( $dteYMD, $dtFormat ){ 

    $mName = abcfsl_cnt_date_month_name_e( $dteYMD );
    $dName = substr( $dteYMD, 8 );
    $yName = substr( $dteYMD, 0, 4 );
    $out = '';

    switch ( $dtFormat ) {
        case 'MD-E':
            $out  = $mName . ' ' . $dName;
            break;
        case 'DM-E':
            $out  = $dName . ' ' . $mName;
            break;
        case 'DM,Y-E':
            $out  = $dName . ' ' . $mName . ', ' . $yName;
            break;
        case 'DMY-E':
            $out  = $dName . ' ' . $mName . ' ' . $yName;
            break; 
        default:
            break;
        }         
    return  $out;   
}

function abcfsl_cnt_date_month_name_e( $dteYMD ){

    $mNumber = 'm' . ltrim( substr( $dteYMD, 5, 2 ), '0' );
    $mName['m1'] = 'January';
    $mName['m2'] = 'February';
    $mName['m3'] = 'March';
    $mName['m4'] = 'April';
    $mName['m5'] = 'May';
    $mName['m6'] = 'June';
    $mName['m7'] = 'July';
    $mName['m8'] = 'August';
    $mName['m9'] = 'September';
    $mName['m10'] = 'October';
    $mName['m11'] = 'November';
    $mName['m12'] = 'December';

    $out = '';
    if (array_key_exists( $mNumber, $mName ) ) {  $out = $mName[$mNumber]; }
    return $out;
}
//--------------------------------------------------------------
//Custom month names
function abcfsl_cnt_date_txt_cust( $dteYMD, $dtFormat, $mPfix ){

    //$dteYMD = '2009-02-17';
    $mName = abcfsl_cnt_date_month_name_cust( $dteYMD, $mPfix );
    $dName = substr( $dteYMD, 8 );
    $yName = substr( $dteYMD, 0, 4 );
    $out = '';

    switch ( $dtFormat ) {
        case 'MD':
            $out  = $mName . ' ' . $dName;
            break;
        case 'DM':
            $out  = $dName . ' ' . $mName;
            break;
        case 'DM,Y':
            $out  = $dName . ' ' . $mName . ', ' . $yName;
            break;
        case 'DMY':
            $out  = $dName . ' ' . $mName . ' ' . $yName;
            break; 
        default:
            break;
        } 
        
    return  $out; 
}

function abcfsl_cnt_date_month_name_cust( $dteYMD, $mPfix ){

    //$dteYMD = '2009-02-17';
    $mNumber = $mPfix . ltrim( substr( $dteYMD, 5, 2 ), '0' );

    $optnName = 'abcfsl_month_names';
    $monthsSaved = get_option( $optnName );

    if( empty( $monthsSaved ) || !$monthsSaved ){ 
        $monthsSaved = abcfsl_cnt_date_month_name_defaults(); 
    }
    else{
        $monthsSaved = wp_parse_args(  $monthsSaved, abcfsl_cnt_date_month_name_defaults() );
    }

    $out = '';
    if ( array_key_exists( $mNumber, $monthsSaved ) ) {  
        $out = $monthsSaved[$mNumber]; 
    }
    return $out;
}

function abcfsl_cnt_date_month_name_defaults() {

    $months['m1'] = '01'; 
    $months['m2'] = '02'; 
    $months['m3'] = '03'; 
    $months['m4'] = '04'; 
    $months['m5'] = '05'; 
    $months['m6'] = '06'; 
    $months['m7'] = '07'; 
    $months['m8'] = '08'; 
    $months['m9'] = '09'; 
    $months['m10'] = '10'; 
    $months['m11'] = '11'; 
    $months['m12'] = '12';
    $months['mA1'] = '01'; 
    $months['mA2'] = '02'; 
    $months['mA3'] = '03'; 
    $months['mA4'] = '04'; 
    $months['mA5'] = '05'; 
    $months['mA6'] = '06'; 
    $months['mA7'] = '07'; 
    $months['mA8'] = '08'; 
    $months['mA9'] = '09'; 
    $months['mA10'] = '10'; 
    $months['mA11'] = '11'; 
    $months['mA12'] = '12';
    
    return $months;
}