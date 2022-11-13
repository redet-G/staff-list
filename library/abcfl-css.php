<?php
/**
 * CSS builders
 * Version 1.2.7
 *
 * 1.2.4 Fixed abcfl_css_w.
 * 1.2.5 Fixed abcfl_css_mb
 * 1.2.6 abcfl_css_pad_t
 * 1.2.7 cleanup
*/
//================================================
//IN: CSS size OR CSS size + units. Example: 15, 15px, 15%
//OUT: CSS size + units. Example: 15px, 15%, 15em, 0
//OUT: If no units provided returns px
//OUT: If 'in' is blank returns default value.
if ( !function_exists( 'abcfl_css_valid_size' ) ){
    function abcfl_css_valid_size( $in, $defaultOut='' ) {

        if(abcfl_html_isblank($in)) { return $defaultOut; }
        if( $in == '0' ) { return '0'; }

        $units = preg_replace('/[0-9]+/', '', $in);
        $w = intval(preg_replace('/[^0-9]+/', '', $in), 10);

        switch ($units){
        case 'px':
        case '%':
        case 'em':
        case 'rem':
            break;
        default:
            $units = 'px';
            break;
        }

        if( !is_int($w) ) { return ''; }
        if( $w == '0' ) { return '0'; }
        return $w . $units;
    }
}
//====WxH============================================
if ( !function_exists( 'abcfl_css_wh' ) ){
    function abcfl_css_wh($w, $h, $maxW=false, $maxH=false){
        return abcfl_css_w($w, $maxW) . abcfl_css_h($h, $maxH);
    }
}
if ( !function_exists( 'abcfl_css_w' ) ){
    function abcfl_css_w($in, $max){
        if(abcfl_html_isblank($in)) { return ''; }
        $out = abcfl_css_valid_size( $in );
        $property = 'width:';
        if($max){ $property = 'max-width:'; }
        return $property . $out . ';';
    }
}

if ( !function_exists( 'abcfl_css_h' ) ){
    function abcfl_css_h($in, $max){
        if(abcfl_html_isblank($in)) { return''; }
        $out = abcfl_css_valid_size( $in );
        $property = 'height:';
        if($max){ $property = 'max-height:'; }
        return $property . $out . ';';
    }
}

if ( !function_exists( 'abcfl_css_w_responsive' ) ){
    function abcfl_css_w_responsive($w, $max){
        if(abcfl_html_isblank($w)) { return ''; }
        $w = abcfl_css_valid_size( $w );
        $max = abcfl_css_valid_size( $max );
        return 'width:' . $w . '; max-width:' . $max . ';';
    }
}

//=======MARGINS============================================
//abcfl_css_m_trbl2($itemTM, $itemLRM, '', $itemLRM );

if ( !function_exists( 'abcfl_css_mtrbl' ) ){
    function abcfl_css_mtrbl($t, $r, $b, $l ){
        return abcfl_css_mt($t). abcfl_css_mr($r). abcfl_css_mb($b) . abcfl_css_ml($l);
    }
}

if ( !function_exists( 'abcfl_css_mtl' ) ){
    function abcfl_css_mtl($t, $l){ return abcfl_css_mt($t) . abcfl_css_ml($l); }
}

if ( !function_exists( 'abcfl_css_mtlr' ) ){
    function abcfl_css_mtlr($t, $l, $r){ return abcfl_css_mt($t) . abcfl_css_ml($l) . abcfl_css_mr($r);}
}

//1.2.3
if ( !function_exists( 'abcfl_css_mt' ) ){
    function abcfl_css_mt($in){
        if(abcfl_html_isblank($in)) { return''; }
        return 'margin-top:'. abcfl_css_valid_size($in) . ';';
    }
}

if ( !function_exists( 'abcfl_css_mr' ) ){
    function abcfl_css_mr($in){
        if(abcfl_html_isblank($in)) { return''; }
        return 'margin-right:'. abcfl_css_valid_size($in) . ';';
    }
}

//1.2.3
if ( !function_exists( 'abcfl_css_mb' ) ){
    function abcfl_css_mb($in){
        if(abcfl_html_isblank($in)) { return''; }
        return 'margin-bottom:'. abcfl_css_valid_size($in) . ';';
    }
}

//1.2.3
if ( !function_exists( 'abcfl_css_ml' ) ){
    function abcfl_css_ml($in){
        if(abcfl_html_isblank($in)) { return''; }
        return 'margin-left:'. abcfl_css_valid_size($in) . ';';
    }
}
//=======PADDING============================================
if ( !function_exists( 'abcfl_css_pad_t' ) ){
    function abcfl_css_pad_t($t){
        return abcfl_css_pad($t, 'top');
    }
}

if ( !function_exists( 'abcfl_css_ptrbl' ) ){
    function abcfl_css_ptrbl($t, $r, $b, $l){
        return abcfl_css_pad($t, 'top') . abcfl_css_pad($r, 'right') . abcfl_css_pad($b, 'bottom') . abcfl_css_pad($l, 'left');
    }
}

if ( !function_exists( 'abcfl_css_ptl' ) ){
    function abcfl_css_ptl($t, $l){ return abcfl_css_pad($t, 'top') . abcfl_css_pad($l, 'left'); }
}

if ( !function_exists( 'abcfl_css_pad' ) ){
    function abcfl_css_pad($value, $side){
        if(abcfl_html_isblank($value)) { return ''; }
        $s = 'padding-' . $side . ':';
        //minus value
        if(substr($value,0,1) == '-'){ $s = 'margin-' . $side . ':'; }
        return $s. abcfl_css_valid_size($value) . ';';
    }
}
//===HELPERS================================================
if ( !function_exists( 'abcfl_css_class_tag' ) ){
    function abcfl_css_class_tag( $cls ){
        if(abcfl_html_isblank($cls)) {return '';}
        return ' class="' . $cls . '"';
    }
}
if ( !function_exists( 'abcfl_css_style_tag' ) ){
    function abcfl_css_style_tag($style) {
       if(abcfl_html_isblank($style)) {return '';}
       return ' style="' . $style . '" ';
   }
}
