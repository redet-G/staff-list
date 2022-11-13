<?php
function abcfsl_aurl( $id ) {

    $d = 'https://abcfolio.com/';
    $sld = 'https://abcfolio.com/wordpress-plugin-staff-list/documentation/';

    // $out = $d . 'wordpress-plugin-staff-list-documentation-field-type-drop-down-group/';

    switch ($id){
        case 0:
            $out = '';
            break;
        case 1: 
            //$out = 'https://abcfolio.com/staff-list-staff-template-field-name-multipart/';
            $out = '';
            break;
        case 2: 
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-custom-styles-option/';
            $out = $sld . 'custom-css-classes/';
            break;
        case 3: 
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-documentation-filters-and-menus/';
            $out = $sld . 'filters-and-menus/';
            break;
        case 4: 
            //$out = 'https://abcfolio.com/staff-list-single-page-template-options/';
            $out = $sld . 'staff-template-single-page-options/';            
            break;
        case 5: 
            $out = $sld . 'input-fields-field-display-options/';
            break;
        case 6: 
            //$out = 'https://abcfolio.com/staff-list-staff-template-field-single-line-text/';
            $out = '';
            break;
        case 7:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-documentation-social-media-icons/';
            $out = $sld . 'social-media-icons/';
            break;
        case 8:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-documentation-social-media-icons/#custom-links';
            $out = $sld . 'social-media-icons/#custom-links';
            break;
        case 9:
            //$out = 'https://abcfolio.com/staff-list-single-page-layouts/';
            $out = $sld . 'single-page-layouts/';
            break;
        case 10:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-documentation-quick-start/';
            $out = $sld . 'quick-start/';
            break;
        case 11:
            $out = 'https://abcfolio.com/wordpress-plugin-staff-list/';
            break;
        case 12:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-create-single-page/';
            $out = $sld . 'create-single-page/';
            break;
        case 13:
            $out = $sld . 'input-fields-add-field/';
            break;
        case 14:
            //$out = 'https://abcfolio.com/staff-list-field-style/';
            $out = $sld . 'input-fields-field-style/';
            break;
        case 15:
            //$out = 'https://abcfolio.com/staff-list-staff-template-field-paragraph-text/';
            $out = '';
            break;
        case 16:
            //$out = 'https://abcfolio.com/staff-list-staff-template-field-static-label-and-text/';
            $out = '';
            break;
        case 17:
            //$out = 'https://abcfolio.com/staff-list-staff-template-field-hyperlink/';
            $out = '';
            break;
        case 18:
            //$out = 'https://abcfolio.com/staff-list-staff-template-field-hyperlink-with-static-text/';
            $out = '';
            break;
        case 19:
            //$out = 'https://abcfolio.com/staff-list-staff-template-field-email/';
            $out = '';
            break;
        case 20:
            //$out = 'https://abcfolio.com/staff-list-staff-template-field-text-editor/';
            $out = '';
            break;
        case 21:
            //$out = 'https://abcfolio.com/staff-list-staff-template-field-shortcode/';
            $out = '';
            break;
        case 22:
            $out = '';
            break;
        case 23:
            //$out = 'https://abcfolio.com/staff-list-staff-template-field-single-page-text-link/';
            $out = $sld . 'field-type-single-page-text-link/';
            break;
        case 24:
            //$out = 'https://abcfolio.com/staff-list-staff-template-field-horizontal-line/';
            $out = '';
            break;
        case 25:
            //$out = 'https://abcfolio.com/staff-list-layouts/';
            $out = $sld . 'staff-list-layouts/';
            break;
        case 26:
            //$out = 'https://abcfolio.com/staff-list-layout-list/';
            $out = $sld . 'staff-list-layout-list/';
            break;
        case 27:
            //$out = 'https://abcfolio.com/staff-list-layout-grid-a/';
            $out = $sld . 'staff-list-layout-grid-a/';
            break;
        case 28:
            //$out = 'https://abcfolio.com/staff-list-layout-grid-b/';
            $out = $sld . 'staff-list-layout-grid-b/';
            break;
        case 29:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-single-page/';
            $out = $sld . 'single-page/';
            break;
        case 30:
            //$out = 'https://abcfolio.com/staff-list-layout-grid-b/#grid-b-item-container';
            $out = $sld . 'staff-list-layout-grid-b/#grid-b-item-container';
            break;
        case 31:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-staff-template-staff-order/';
            $out = $sld . 'staff-order/';
            break;
        case 32:
            $out = 'https://abcfolio.com/quality-wordpress-plugins-support-registration/';
            break;
        case 33:            
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-field-labels/';
            $out = $sld . 'input-fields-field-labels/';
            break;
        case 34:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-categories-menu/';
            $out = $sld . 'categories-menu/';
            break;
        case 35:
            //$out = 'https://abcfolio.com/staff-list-az-menu/';
            $out = $sld . 'az-menu/';
            break;
        case 36:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-multi-filter/';
            $out = $sld . 'multi-filter/';
            break;
        case 37:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-add-menu-to-page/';
            $out = $sld . 'add-menu-to-page/';
            break;
        case 38:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-field-pagination/';
            $out = $sld . 'pagination/';
            break;
        case 39:
            //Deprecated
            $out = 'https://abcfolio.com/wordpress-plugin-staff-list-select-menu/';
            break;
        case 40:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-circular-images/';
            $out = $sld . 'circular-images/';
            break;
        case 41:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-images/';
            $out = $sld . 'images/';
            break;
        case 42:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-image-overlay/';
            $out = $sld . 'image-overlay/';
            break;
        case 43:
            //Animations on Hover abcfsl_mbox_tplate_img_img_hover ???????????????????????
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-staff-template-image-options/';
            $out = $sld . 'image-options/';
            break;
        case 44:
            //$out = 'https://abcfolio.com/staff-list-staff-template-image-placeholders/';
            $out = $sld . 'image-placeholders/';
            break;
        case 45:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-add-menu-shortcode/';
            break;
        case 46:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-structured-data/';
            $out = $sld . 'structured-data/';
            break;
        case 47:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-structured-data-item-type/';
            $out = '';
            break;
        case 48:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-structured-data-item-properties/';
            $out = '';
            break;
        case 49:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-images-alt-tag/';
            $out = $sld . 'images-alt-tag/';
            break;
//------------------------------
        case 50:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-staff-member-images/';
            $out = $sld . 'staff-page-images/';
            break;
        case 51:
            $out = 'https://abcfolio.com/wordpress-plugin-registration/';
            break;
        case 52:
            //$out = 'https://abcfolio.com/staff-list-staff-template-field-static-text/';
            break;
        case 53:
            //$out = 'https://abcfolio.com/staff-list-staff-template-field-static-text/#Linked-Fields';
            $out = $sld . 'field-type-hyperlink-with-static-text/#Linked-Fields';
            break;
        case 54:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-documentation-staff-list-page/#create-and-publish-staff-list-page';
            $out = $sld . 'staff-list-page/#create-and-publish-staff-list-page';
            break;
        case 55:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-documentation-staff-template-options-shortcodes/#Category-Filter';
            $out = $sld . 'shortcodes/#shortcode-category-filter';
            break;
        case 56:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-documentation-staff-template-options-shortcodes/#Shortcode-Options';
            $out = $sld . 'shortcodes/#shortcode-options';
            break;
        case 57:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-documentation-staff-template-options-staff-order/#sort-text-copy-from-single-line-text';
                //'https://abcfolio.com/wordpress-plugin-staff-list-staff-template-options/'
            break;
        case 58:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-documentation-staff-template-options-staff-order/#sort-text-copy-from-multipart-field';
            break;
        case 59:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-documentation-staff-template-options-staff-order/#sort-options';
            break;
//------------------------------
        case 60:
            //$out = 'https://abcfolio.com/staff-list-single-page-pretty-permalinks/#permalink-spg-name';
            $out = $sld . 'single-page-pretty-permalinks/#permalink-spg-name';
            break;
        case 61:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-structured-data-embedded-items/';
            $out = '';
            break;
        case 62:
            $out = '';
            break;
        case 63:
            //$out = 'https://abcfolio.com/staff-list-layout-list/#left-right-columns';
            $out = $sld . 'staff-list-layout-list/#left-right-columns';
            break;
        case 64:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-staff-template-single-page-layout/#left-right-columns';
            $out = $sld . 'single-page-layout/#left-right-columns';
            break;
        case 65:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-image-overlay/#overlay-image-width';
            $out = $sld . 'image-overlay/#overlay-image-width';
            break;
        case 66:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-image-links/';
            $out = $sld . 'image-links/';
            break;
        case 67:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-single-page-images/';
            $out = $sld . 'single-page-images/';
            break;
        case 68:
            $out = 'https://abcfolio.com/staff-list-plugin-getting-started/';
            break;            
        case 69:
            //$out = 'https://abcfolio.com/staff-list-staff-template-field-drop-down/';
            break;
//------------------------------
        case 70:
            //$out = 'https://abcfolio.com/staff-list-field-type-drop-down-list-and-static-label/';
            break;
        case 71:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-sort-text-data-entry/';
            $out = $sld . 'sort-text-data-entry/';
            break;
        case 72:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-documentation-groups-layout/#horizontal-line';
            $out = $sld . 'groups-layout-options/#horizontal-line';
            break;            
        case 73:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-customization/';
            $out = $sld . 'customization/';
            break; 
        case 74:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-documentation-groups/';
            $out = $sld . 'groups/';
            break; 
        case 75:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-documentation-group-by-first-letter/';
            $out = $sld . 'group-by-first-letter-a-z/';
            break; 
        case 76:
            //$out = 'https://abcfolio.com/wordpress-plugin-staff-list-documentation-groups-shortcode-parameter/';
            $out = $sld . 'groups-shortcode-parameter/';
            break; 
        case 77:
            //$out = $d . 'wordpress-plugin-staff-list-documentation-groups-layout/';
            $out = $sld . 'groups-layout-options/';
            break;
        case 78:
            //$out = $d . 'wordpress-plugin-staff-list-documentation-group-by-categories/';
            $out = $sld . 'group-by-categories/';
            break; 
        case 79:
            //$out = $d . 'wordpress-plugin-staff-list-documentation-group-by-text/';
            $out = $sld . 'group-by-text/';
            break; 
//------------------------------                
        case 80:
            //$out = $d . 'wordpress-plugin-staff-list-documentation-field-type-drop-down-group/#create-drop-down-list';
            $out = $sld . 'field-type-drop-down-group/#create-drop-down-list';
            break; 
        case 81:
            //$out = $d . 'wordpress-plugin-staff-list-documentation-field-type-drop-down-group/#drop-down-options';
            $out = $sld . 'field-type-drop-down-group/#drop-down-options';
            break;
        case 82:
            //$out = $d . 'wordpress-plugin-staff-list-documentation-field-type-drop-down-group/#custom-css';
            $out = $sld . 'field-type-drop-down-group/#custom-css';
            break; 
        case 83:
            $out = $d . '';
            break; 
        case 84:
            //$out = $d . 'wordpress-plugin-staff-list-documentation-field-type-checkbox-group/#checkbox-values';
            $out = $sld . 'field-type-checkbox-group/#checkbox-values';
            break; 
        case 85:
            //$out = $d . 'wordpress-plugin-staff-list-documentation-field-type-checkbox-group/#static-label';
            $out = $sld . 'field-type-checkbox-group/#static-label';
            break; 
        case 86:
            //$out = $d .'wordpress-plugin-staff-list-documentation-field-type-checkbox-group/#custom-css' ;
            $out = $sld . 'field-type-checkbox-group/#custom-css';
            break; 
        case 87:
        $out = $d . '';
        break;  
        case 88:
        $out = $d .'' ;
        break; 
        case 89:
        $out = $d . '';
        break; 
//------------------------------         
        case 90:
        $out = $d .'' ;
        break; 
        case 91:
        $out = $d . '';
        break; 
        case 92:
        $out = $d .'' ;
        break; 
        case 93:
        $out = $d . '';
        break;                                          

        default:
            $out = '';
            break;
    }
    return $out;
}

//https://abcfolio.com/wordpress-plugin-staff-list/documentation/field-type-shortcode/

function abcfsl_aurl_f( $fieldTypeH ) {

    $sld = 'https://abcfolio.com/wordpress-plugin-staff-list/documentation/';

    switch ($fieldTypeH){
        case 'STXT': 
            $out = $sld . 'field-type-static-text/';
            break;
        case 'MP':
            $out = $sld . 'field-type-name-multipart/';
            break;
        case 'T': 
            $out = $sld . 'field-type-single-line-text/';
            break;
        case 'PT':
            $out = $sld . 'field-type-paragraph-text/';
            break;
        case 'LT':
            $out = $sld . 'field-type-static-label-and-text/';
            break;
        case 'H':
            $out = $sld . 'field-type-hyperlink/';
            break;
        case 'TH':
            $out = $sld . 'field-type-hyperlink-with-static-text/';
            break;
        case 'SH':
            $out = '';
            break;
        case 'EM':
            $out = $sld . 'field-type-email/';
            break;
        case 'STXEM':
            $out = $sld . 'field-type-email-with-static-text/';
            break; 
        case 'IMGIC':
            $out = $sld . '';
            break;
        case 'CHECKG':
            $out = $sld . 'field-type-checkbox-group/';
            break;            
        case 'CBOM': 
            $out = $sld . 'field-type-drop-down-group/';
            break;                                 
        case 'CE':
            $out = $sld . 'field-type-text-editor/';
            break;
        case 'HL':
            $out = $sld . 'field-type-horizontal-line/';
            break;
        case 'SC':
            $out = $sld . 'field-type-shortcode/';
            break;
        case 'CBO':
            $out = $sld . 'field-type-drop-down/';
            break;
        case 'LBLCBO':
            $out = $sld . '-field-type-drop-down-and-static-label/';
            break;
        default:
            $out = '';
            break;
    }
    return $out;
}