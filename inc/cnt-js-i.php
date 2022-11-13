<?php
function abcfsl_cnt_js_i_cat_menu( $parM ){

    $jsPar = wp_parse_args( $parM, abcfsl_cnt_js_i_par_defaults());
    $clsPfix = $jsPar['clsPfix'];

    $itemsCntrID = abcfsl_cnt_js_i_var_items_cntr( $jsPar['tplateID'], $clsPfix );
    $noDataAlertID = abcfsl_cnt_js_i_var_no_data_alert( $jsPar['tplateID'] );
    $filterCntrCls = $clsPfix . 'FItemsCntr';
    $itemCntrCls = $clsPfix . 'GCol';
    $clsActive = $jsPar['clsFItemHlight'];

    $scriptWrapSE = abcfsl_cnt_js_i_script_wrap_parts();
    //============================================================= 
    $out =  $scriptWrapSE['scriptS1'];
    $out .= $scriptWrapSE['scriptS2'];

    $out .= 'var $gridItemsCntr =  $("div#' . $itemsCntrID . '"),' .  "\r\n";
    $out .= '$noDataAlert =  $("div#' . $noDataAlertID . '");' .  "\r\n";

    $out .= abcfsl_cnt_js_i_isotope_options();
    $out .= abcfsl_cnt_js_i_images_loaded( $jsPar['imgsLoaded'] );

    $out .= '$(".' . $filterCntrCls . ' ul li a").click(function(){' .  "\r\n";
    $out .= '$(".' . $filterCntrCls . ' ul li a").removeClass("' . $clsActive . '");' .  "\r\n";
    $out .= '$(this).addClass("' . $clsActive . '");' .  "\r\n";
    $out .= 'var fSelector =  $(this).attr("data-filter");' .  "\r\n";

    //$out .= 'console.log(fSelector);' .  "\r\n";

    $out .= '$gridItemsCntr.isotope({' .  "\r\n";
    $out .= 'filter: fSelector' .  "\r\n";
    $out .= '});' .  "\r\n";

    $out .= abcfsl_cnt_js_i_no_data_alert( $jsPar['noDataMsg'] );

    $out .= 'return false;' .  "\r\n";
    $out .= '});' .  "\r\n";
    $out .= $scriptWrapSE['scriptE1'];
    $out .= $scriptWrapSE['scriptE2'];
    $out .= $scriptWrapSE['scriptE3'];
    $out .= $scriptWrapSE['scriptE4'];

    return $out;
}

function abcfsl_cnt_js_i_mtf( $parMTF ){
    
    $jsPar = wp_parse_args( $parMTF, abcfsl_cnt_js_i_par_defaults());
    $clsPfix = $jsPar['clsPfix'];  

    $itemsCntrID = abcfsl_cnt_js_i_var_items_cntr( $jsPar['tplateID'], $clsPfix );
    $noDataAlertID = abcfsl_cnt_js_i_var_no_data_alert( $jsPar['tplateID'] );
    $mtfCntrID = 'mtfCntr_' . $jsPar['menuID'];

    $scriptWrapSE = abcfsl_cnt_js_i_script_wrap_parts();
    //============================================================= 
    $out =  $scriptWrapSE['scriptS1'];
    $out .= $scriptWrapSE['scriptS2'];

    $out .= 'var $gridItemsCntr =  $("div#' . $itemsCntrID . '"),' .  "\r\n";
    $out .= '$noDataAlert =  $("div#' . $noDataAlertID . '"),' .  "\r\n";
    $out .= '$cboSelect = $("div#' . $mtfCntrID . ' select");' .  "\r\n";

    $out .= 'filters = {};'.  "\r\n";;

    $out .= abcfsl_cnt_js_i_isotope_options();
    $out .= abcfsl_cnt_js_i_images_loaded( $jsPar['imgsLoaded'] );
    
    $out .= '$cboSelect.change(function () {' .  "\r\n";
    $out .= 'var $this = $(this);' .  "\r\n";
    $out .= 'var $optionSet = $this;' .  "\r\n";
    $out .= 'var iDFGrp = $optionSet.attr("data-filter-group");' .  "\r\n";
    $out .= 'filters[iDFGrp] = $this.find("option:selected").attr("data-filter-value");' .  "\r\n";

    $out .= 'var isoFilters = [];' .  "\r\n";
    $out .= 'for (var prop in filters) {' .  "\r\n";
    $out .= 'isoFilters.push(filters[prop])' .  "\r\n";
    $out .= '}' .  "\r\n";
    $out .= 'var fSelector = isoFilters.join("");' .  "\r\n";

    //$out .= 'console.log(fSelector);' .  "\r\n";

    $out .= '$gridItemsCntr.isotope({' .  "\r\n";
    $out .= 'filter: fSelector' .  "\r\n";
    $out .= '});' .  "\r\n";

    $out .= abcfsl_cnt_js_i_no_data_alert( $jsPar['noDataMsg'] );

    $out .= 'return false;' .  "\r\n";
    $out .= '});' .  "\r\n";
    $out .= $scriptWrapSE['scriptE1'];
    $out .= $scriptWrapSE['scriptE2'];
    $out .= $scriptWrapSE['scriptE3'];
    $out .= $scriptWrapSE['scriptE4'];

    return $out;
}

//======================================================
function abcfsl_cnt_js_i_var_items_cntr( $tplateID, $clsPfix ){
    return $clsPfix . 'GridItemsCntr_' . $tplateID;
}

function abcfsl_cnt_js_i_var_no_data_alert( $tplateID ){
    return 'noDataAlert_' . $tplateID;
}

// Add Script: Images Loaded.  0. No; 1. When images start loading. (Default); 2.After all images are loaded.
function abcfsl_cnt_js_i_images_loaded( $imgsLoaded ){
    $out = '';
    if ( $imgsLoaded == 1) {
            $out = '$gridItemsCntr.imagesLoaded().progress( function() { $gridItemsCntr.isotope("layout"); });' .  "\r\n";
    }    
    return $out;
}

function abcfsl_cnt_js_i_isotope_options(){
    $out = '$gridItemsCntr.isotope({' .  "\r\n";
    $out .= 'itemSelector: ".abcfslGCol",' .  "\r\n";
    $out .= 'percentPosition: true,' .  "\r\n";
    $out .= 'layoutMode: "fitRows"' .  "\r\n";
    $out .= '});' .  "\r\n";
    return $out;
}

function abcfsl_cnt_js_i_no_data_alert( $noDataMsg ){

    if( empty( $noDataMsg ) ) { return '';}

    $out = 'if ($gridItemsCntr.data("isotope").filteredItems.length === 0) {' .  "\r\n";
    $out .= '$noDataAlert.fadeIn("slow");' .  "\r\n";
    $out .= '} else {' .  "\r\n";
    $out .= '$noDataAlert.fadeOut("fast");' .  "\r\n";
    $out .= '}' .  "\r\n";
    return $out;
}

function abcfsl_cnt_js_i_par_defaults(){
 
    $out['clsPfix'] = '';
    $out['tplateID'] = 0;
    $out['menuID'] = 0;
    $out['clsFItemHlight'] = '';
    $out['imgsLoaded'] = 0;
    $out['firstSlug'] = '';
    $out['noDataMsg'] = '';
    return $out;
}

// JS script. Start - end sections.
function abcfsl_cnt_js_i_script_wrap_parts(){
    $out['scriptS1'] =  "\r\n";
    $out['scriptS2'] = '<script type="text/javascript">jQuery(document).ready(function($) {' .  "\r\n";
    $out['scriptE1'] =  '';
    $out['scriptE2'] = '});<';
    $out['scriptE3'] = '/script>';
    $out['scriptE4'] = "\r\n";
    return $out;
}