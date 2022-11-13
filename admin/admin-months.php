<?php
function abcfsl_admin_months() {

    $obj = ABCFSL_Main();
    $slug = $obj->pluginSlug;

    $optnName = 'abcfsl_month_names';
    $monthsSaved = get_option( $optnName );
    //========================================
    if ( isset($_POST['btnSaveMonths']) ){
        check_admin_referer( $slug . '_nonce' );

        abcfsl_admin_months_save( $optnName, $_POST );
        $monthsSaved = get_option( $optnName );
        abcfl_autil_msg_ok();
    }
    //======================================== 
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(388), abcfsl_aurl(98), 'abcflFontWP abcflFontS18 abcflFontW600 abcflMLeft30 abcflMTop20');

    if( empty( $monthsSaved ) || !$monthsSaved ){ 
        $monthsSaved = abcfsl_admin_months_defaults(); 
    }
    else{
        $monthsSaved = wp_parse_args(  $monthsSaved, abcfsl_admin_months_defaults() );
    }

    //--Form Start ------------------------
    echo abcfl_html_form( 'frm_default_tplate', '');
    wp_nonce_field($slug . '_nonce');
    //-- Main Cntr DIV Start --------------
    echo abcfl_html_tag_cls('div', 'abcflMTop20 abcflMLeft30');

        abcfsl_admin_months_render_input_double( '1', $monthsSaved['m1'], $monthsSaved['mA1'] );
        abcfsl_admin_months_render_input_double( '2', $monthsSaved['m2'], $monthsSaved['mA2'] );
        abcfsl_admin_months_render_input_double( '3', $monthsSaved['m3'], $monthsSaved['mA3'] );
        abcfsl_admin_months_render_input_double( '4', $monthsSaved['m4'], $monthsSaved['mA4'] );
        abcfsl_admin_months_render_input_double( '5', $monthsSaved['m5'], $monthsSaved['mA5'] );
        abcfsl_admin_months_render_input_double( '6', $monthsSaved['m6'], $monthsSaved['mA6'] );
        abcfsl_admin_months_render_input_double( '7', $monthsSaved['m7'], $monthsSaved['mA7'] );
        abcfsl_admin_months_render_input_double( '8', $monthsSaved['m8'], $monthsSaved['mA8'] );
        abcfsl_admin_months_render_input_double( '9', $monthsSaved['m9'], $monthsSaved['mA9'] );
        abcfsl_admin_months_render_input_double( '10', $monthsSaved['m10'], $monthsSaved['mA10'] );
        abcfsl_admin_months_render_input_double( '11', $monthsSaved['m11'], $monthsSaved['mA11'] );
        abcfsl_admin_months_render_input_double( '12', $monthsSaved['m12'], $monthsSaved['mA12'] );

        echo abcfl_input_hline('2', '30', '50P');
        //-- Button DIV Start --------------------------
        echo abcfl_html_tag('div','', 'submit' );
        echo abcfl_input_btn( 'btnConvert', 'btnSaveMonths', 'submit', abcfsl_txta(34), 'button-primary abcficBtnWide' );

    //-- ENDs: Button, Main Cntr, Form,  ------------------------------------------------
    echo abcfl_html_tag_ends('div,div,form');    
}

function abcfsl_admin_months_render_input_double( $no, $saved, $savedA ) {

    //----------------------------------------------------
    $flexCntrS30 = abcfl_html_tag( 'div', '', 'abcflFGCntr abcflFGCntr30' );
    $flex2ColS = abcfl_html_tag( 'div', '', 'abcflFG2Col' );
    $divE = abcfl_html_tag_end( 'div'); 
    //-------------------------------------------------------- 

    $lbl = $no;
    $abbrLbl = $no;
    if ( $no == 1 ) { $abbrLbl = abcfsl_txta(150); }

    $inputID = 'month' . $no;
    $inputIDA = 'monthA' . $no;
    if ( $no < 10 ) { 
        $inputID = 'month0' . $no;
        $inputIDA = 'monthA0' . $no; 
    }

    $full =  abcfl_input_txt( $inputID, '', $saved, $lbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $abbr =  abcfl_input_txt( $inputIDA, '', $savedA, $abbrLbl, '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo $flexCntrS30 . $flex2ColS . $full . $divE . $flex2ColS . $abbr . abcfl_html_tag_ends( 'div,div' );
    
}

function abcfsl_admin_months_render_input( $no, $value ) {

    $mN = $no;
    if ( $mN < 10 ) { $mN = '0' . $no; }
    return abcfl_input_txt('month' . $mN, '', $value, $no, '', '30%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfsl_admin_months_save( $optnName, $post ) {

    $months = []; 
    $months = abcfsl_admin_months_add_item( $post, $months, '01', '1' );
    $months = abcfsl_admin_months_add_item( $post, $months, '02', '2' );
    $months = abcfsl_admin_months_add_item( $post, $months, '03', '3' );
    $months = abcfsl_admin_months_add_item( $post, $months, '04', '4' );
    $months = abcfsl_admin_months_add_item( $post, $months, '05', '5' );
    $months = abcfsl_admin_months_add_item( $post, $months, '06', '6' );
    $months = abcfsl_admin_months_add_item( $post, $months, '07', '7' );
    $months = abcfsl_admin_months_add_item( $post, $months, '08', '8' );
    $months = abcfsl_admin_months_add_item( $post, $months, '09', '9' );
    $months = abcfsl_admin_months_add_item( $post, $months, '10', '10' );
    $months = abcfsl_admin_months_add_item( $post, $months, '11', '11' );
    $months = abcfsl_admin_months_add_item( $post, $months, '12', '12' );

    $months = abcfsl_admin_months_add_item( $post, $months, 'A01', 'A1' );
    $months = abcfsl_admin_months_add_item( $post, $months, 'A02', 'A2' );
    $months = abcfsl_admin_months_add_item( $post, $months, 'A03', 'A3' );
    $months = abcfsl_admin_months_add_item( $post, $months, 'A04', 'A4' );
    $months = abcfsl_admin_months_add_item( $post, $months, 'A05', 'A5' );
    $months = abcfsl_admin_months_add_item( $post, $months, 'A06', 'A6' );
    $months = abcfsl_admin_months_add_item( $post, $months, 'A07', 'A7' );
    $months = abcfsl_admin_months_add_item( $post, $months, 'A08', 'A8' );
    $months = abcfsl_admin_months_add_item( $post, $months, 'A09', 'A9' );
    $months = abcfsl_admin_months_add_item( $post, $months, 'A10', 'A10' );
    $months = abcfsl_admin_months_add_item( $post, $months, 'A11', 'A11' );
    $months = abcfsl_admin_months_add_item( $post, $months, 'A12', 'A12' );

    if( empty( $months ) ) {
        delete_option( $optnName );
        return;
    }

    if ( get_option( $optnName ) !== false ) { 
        update_option( $optnName, $months );     
    } 
    else {
        $autoload = 'no';
        add_option( $optnName, $months, '', $autoload );
    }
}

function abcfsl_admin_months_add_item( $post, $months, $month, $m ) {

    if (array_key_exists( 'month' . $month, $post ) ) { 
        if( !empty( $post['month' . $month] )) {  
            $months['m' . $m] = $post['month' . $month]; 
        } 
    }
    return $months;
}

function abcfsl_admin_months_defaults() {
    $months['m1'] = ''; 
    $months['m2'] = ''; 
    $months['m3'] = ''; 
    $months['m4'] = ''; 
    $months['m5'] = ''; 
    $months['m6'] = ''; 
    $months['m7'] = ''; 
    $months['m8'] = ''; 
    $months['m9'] = ''; 
    $months['m10'] = ''; 
    $months['m11'] = ''; 
    $months['m12'] = '';
    $months['mA1'] = ''; 
    $months['mA2'] = ''; 
    $months['mA3'] = ''; 
    $months['mA4'] = ''; 
    $months['mA5'] = ''; 
    $months['mA6'] = ''; 
    $months['mA7'] = ''; 
    $months['mA8'] = ''; 
    $months['mA9'] = ''; 
    $months['mA10'] = ''; 
    $months['mA11'] = ''; 
    $months['mA12'] = '';
    return $months;
}