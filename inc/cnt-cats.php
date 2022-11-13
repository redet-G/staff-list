<?php
function abcfsl_cnt_cats_field_STFFCAT( $par, $excludedSlugs ){

    $staffID = $par['itemID'];

    $cats = abcfsl_cnt_cats_staff_member( $staffID, $excludedSlugs );
    if( abcfl_html_isblank( $cats ) ) { return ''; }
    //------------------------------
    $par['lineTxt'] = $cats;
    $staticTxt = $par['lblTxt'];

    if( abcfl_html_isblank( $staticTxt ) ) {   
        return abcfsl_cnt_field_T( $par ); 
    }

    return abcfsl_cnt_field_LT ( $par );
}

function abcfsl_cnt_cats_staff_member( $staffID, $excludedSlugs ){

    $staffMTerms = get_the_terms( $staffID, 'tax_staff_member_cat' );

    //Optimized way to get a comma separated list of terms.	
    //$term_obj_list = get_the_terms( $post->ID, 'taxonomy' );
    //$terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'));

    if ( !$staffMTerms ){ return ''; }
    if ( is_wp_error( $staffMTerms ) ){ return ''; }
    if( empty( $staffMTerms ) ) { return ''; }

    $staffMCats = array();
    foreach ( $staffMTerms as $term ) {
        $staffMCats[$term->slug] = $term->name;
    }

    $notExcluded = abcfsl_cnt_cats_not_excluded( $staffMCats, $excludedSlugs );
    if( empty( $notExcluded ) ) { return ''; }
    return implode (", ", $notExcluded);
}

function abcfsl_cnt_cats_not_excluded( $staffMCats, $excludedSlugs ){

    if( empty( $excludedSlugs ) ) { return $staffMCats; }

    $excluded = explode(',', $excludedSlugs);
    $excluded = array_map( 'trim' ,$excluded );
    foreach ( $excluded as $slug ) {
        unset( $staffMCats[$slug] );
    }
    return $staffMCats;  
}