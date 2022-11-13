<?php
function abcfsl_aurl( $id ) {

    $d = 'https://abcfolio.com/';
    $sld = 'https://abcfolio.com/wordpress-plugin-staff-list/documentation/';
    //DONE MENUS
    //Staff List Customization
    //Staff List Fields
    //Staff List Filters and Menus
    //Staff List Groups
    //Staff List Images
    //Staff List Member
    //Staff List SEO
    //Staff List Single Page
    //Staff List Template

    switch ($id){
        case 0:
            $out = '';
            break;
        case 1: 
            $out = '';
            break;
        case 2: 
            $out = $sld . 'custom-css-classes/';
            break;
        case 3: 
            $out = $sld . 'filters-and-menus/';
            break;
        case 4: 
            $out = $sld . 'staff-template-single-page-options/';            
            break;
        case 5: 
            $out = $sld . 'input-fields-field-display-options/';
            break;
        case 6:             
            $out = $sld . 'staff-template-image-defaults/'; 
            break;
        case 7:
            $out = $sld . 'staff-template-social-icons/#how-to-activate-social-icons'; 
            break;
        case 8:
            $out = $sld . 'social-media-icons/#how-to-add-custom-icon';
            break;
        case 9:
            $out = $sld . 'single-page-layouts/';
            break;
        case 10:
            $out = $sld . 'quick-start/';
            break;
        case 11:
            $out = $d . 'wordpress-plugin-staff-list/';
            break;
        case 12:
            $out = $sld . 'create-single-page/';
            break;
        case 13:
            $out = $sld . 'input-fields-add-field/';
            break;
        case 14:
            $out = $sld . 'customization/#staff-template-built-in-formatting';
            break;
        case 15:            
            $out = $sld . 'field-type-static-label-and-date/#date-display-format';
            break;
        case 16:            
            $out = $sld . 'field-type-static-label-and-date/#date-static-label';
            break;
        case 17:            
            $out = $sld . 'staff-list-layout-grid-c/';
            break;
        case 18:            
            $out = $sld . 'field-type-staff-categories/#excluded-slugs';
            break;
        case 19:            
            $out = $sld . 'field-type-icon-font-with-links/#icon-options'; 
            break;
        case 20:            
            $out = $sld . 'field-type-icon-font-star-rating/#icon-options'; 
            break;
        case 21:            
            $out = $sld . 'field-type-static-label-and-date/#month-names';
            break;
        case 22:
            $out = $sld . 'create-single-page/#single-page-blank';
            break;
        case 23:
            $out = $sld . 'links-to-single-page/';
            break;
        case 24:
            $out = $sld . 'custom-css-styles/';
            break;
        case 25:
            $out = $sld . 'staff-list-layouts/';
            break;
        case 26:
            $out = $sld . 'staff-list-layout-list/';
            break;
        case 27:
            $out = $sld . 'staff-list-layout-grid-a/';
            break;
        case 28:
            $out = $sld . 'staff-list-layout-grid-b/';
            break;
        case 29:
            $out = $sld . 'single-page/';
            break;
        case 30:
            $out = $sld . 'staff-list-layout-grid-b/#grid-b-item-container';
            break;
        case 31:
            $out = $sld . 'staff-order/';
            break;
        case 32:
            $out = $d . 'quality-wordpress-plugins-support-registration/';
            break;
        case 33:            
            $out = $sld . 'input-fields-field-labels/';
            break;
        case 34:
            $out = $sld . 'categories-menu/';
            break;
        case 35:
            $out = $sld . 'az-menu/';
            break;
        case 36:
            $out = $sld . 'multi-filter/';
            break;
        case 37:
            $out = $sld . 'add-menu-to-page/';
            break;
        case 38:
            $out = $sld . 'pagination/';
            break;
        case 39:
            $out = $sld . 'custom-css-horizontal-line/';
            break;
        case 40:
            $out = $sld . 'circular-images/';
            break;
        case 41:
            $out = $sld . 'images/';
            break;
        case 42:
            $out = $sld . 'image-overlay/';
            break;
        case 43:
            $out = $sld . 'image-options/';
            break;
        case 44:
            $out = $sld . 'image-placeholders/';
            break;
        case 45:   
            $out = $sld .  'customization/#staff-template-field-style-single-page';        
            break;
        case 46:
            $out = $sld . 'structured-data/';
            break;
        case 47:            
            $out = $sld . 'create-single-page/#single-page-shortcode';
            break;
        case 48:            
            $out = $sld . 'staff-member/#select-staff-member-template';
            break;
        case 49:
            $out = $sld . 'images-alt-tag/';
            break;
//------------------------------
        case 50:
            $out = $sld . 'staff-page-images/';
            break;
        case 51:
            $out = $d . 'wordpress-plugin-registration/';
            break;
        case 52:
            $out = $d . 'abcfolio-plugins-instalation-and-updates/#license-key';
            break;
        case 53:
            $out = $sld . 'field-type-static-text/#staff-template-linked-fields';
            break;
        case 54:
            $out = $sld . 'staff-list-page/#create-and-publish-staff-list-page';
            break;
        case 55:
            $out = $sld . 'shortcodes/#shortcode-category-filter';
            break;
        case 56:
            $out = $sld . 'shortcodes/#shortcode-options';
            break;
        case 57:
            $out = $sld . 'create-single-page/#paste-single-page-url';
            break;
        case 58:
            $out = $sld . 'create-single-page/#copy-single-page-shortcode';
            break;
        case 59:
            $out = $sld . 'staff-list-isotope/';
            break;
//------------------------------
        case 60:
            $out = $sld . 'single-page-pretty-permalinks/#permalink-spg-name';
            break;
        case 61:            
            $out = $sld . 'custom-css-alignment/#center-text';
            break;
        case 62:
            $out = $sld . 'image-options/#animations';
            break;
        case 63:
            $out = $sld . 'staff-list-layout-list/#left-right-columns';
            break;
        case 64:
            $out = $sld . 'single-page-layout/#left-right-columns';
            break;
        case 65:
            $out = $sld . 'image-overlay/#overlay-image-width';
            break;
        case 66:
            $out = $sld . 'image-links/';
            break;
        case 67:
            $out = $sld . 'single-page-images/';
            break;
        case 68:
            $out = $d . 'staff-list-plugin-getting-started/';
            break;            
        case 69:  
            $out = $sld . 'image-options/#image-margins';          
            break;
//------------------------------
        case 70:
            $out = $sld . 'image-options/#drop-shadow';
            break;
        case 71:
            $out = $sld . 'sort-text-data-entry/';
            break;
        case 72:
            $out = $sld . 'groups-layout-options/#horizontal-line';
            break;            
        case 73:
            $out = $sld . 'customization/';
            break; 
        case 74:
            $out = $sld . 'groups/';
            break; 
        case 75:
            $out = $sld . 'group-by-first-letter-a-z/';
            break; 
        case 76:
            $out = $sld . 'groups-shortcode-parameter/';
            break; 
        case 77:
            $out = $sld . 'groups-layout-options/';
            break;
        case 78:
            $out = $sld . 'group-by-categories/';
            break; 
        case 79:
            $out = $sld . 'group-by-text/';
            break; 
//------------------------------                
        case 80:
            $out = $sld . 'field-type-drop-down-group/#create-drop-down-list';
            break; 
        case 81:
            $out = $sld . 'field-type-drop-down-group/#drop-down-options';
            break;
        case 82:
            $out = $sld . 'field-type-drop-down-group/#custom-css';
            break; 
        case 83:
            $out = $d . 'image-options/#image-attributes'; 
            break; 
        case 84:
            $out = $sld . 'field-type-checkbox-group/#checkbox-values';
            break; 
        case 85:
            $out = $sld . 'field-type-checkbox-group/#static-label';
            break; 
        case 86:
            $out = $sld . 'field-type-checkbox-group/#custom-css';
            break; 
        case 87:
            $out = $d . 'field-type-address/#field-labels';
            break;  
        case 88:
            $out = $sld . 'image-options/#image-border';
            break; 
        case 89:
            $out = $sld . 'shortcodes/'; 
            break;
//------------------------------         
        case 90:
            $out = $sld . 'field-type-name-multipart/#multipart-field-single-page-link';
            break; 
        case 91:
            $out = $sld . 'staff-page-containers/#staff-page-containers-list';
            break; 
        case 92:
            $out = $d .'staff-page-containers/#staff-page-containers-grid-b'; 
            break; 
        case 93:
            $out = $d . 'staff-page-containers/#staff-page-containers-grid-a';
            break; 
        case 94:
            $out = $d . 'staff-page-containers/#staff-page-containers-grid-c';
            break;    
        case 95:
            $out = $sld . 'admin-plugin-updates/';
            break; 
        case 96:
            $out = $sld . 'admin-default-template/';
            break; 
        case 97:
            $out = $sld . 'admin-template-converter/';
            break; 
        case 98:
            $out = $sld . 'admin-months/';
        break; 
        case 99:
            $out = $d . 'admin-license-key/';
            break; 
//------------------------------                        
        case 100:
            $out = $sld . 'changelog/';
        break;    
        case 101:
        $out = $d . '';
        break;                                             

        default:
            $out = '';
            break;
    }
    return $out;
}

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
        case 'LTABOVE':
            $out = $sld . 'field-type-static-label-above-and-text/';
            break; 
        case 'PTABOVE':
            $out = $sld . 'field-type-static-label-above-and-paragraph-text/';
            break;                        
        case 'H':
            $out = $sld . 'field-type-hyperlink/';
            break;
        case 'TH':
            $out = $sld . 'field-type-hyperlink-with-static-text/';
            break;
        case 'EM':
            $out = $sld . 'field-type-email/';
            break;            
        case 'IMGCAP': 
            $out = $sld . 'field-type-image-with-caption/';
            break; 
        case 'IMGHLNK': 
            $out = $sld . 'field-type-image-hyperlink';
            break; 
        case 'SLDTE': 
            $out = $sld . 'field-type-static-label-and-date/';
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
        case 'STXEM':
            $out = $sld . 'field-type-email-with-static-text/';
            break;
        case 'SLFONE':
            $out = $sld . 'field-type-phone-and-static-label/';
            break;  
        case 'FONE':
            $out = $sld . 'field-type-phone/';
            break;  
        case 'STARR': 
            $out = $sld . 'field-type-icon-font-star-rating/';
            break;  
        case 'ICONLNK': 
            $out = $sld . 'field-type-icon-font-with-links/';
            break; 
        case 'STFFCAT': 
            $out = $sld . 'field-type-staff-categories/';
            break; 
        case 'POSTTITLE': 
            $out = $sld . 'field-type-post-title/';
            break;  
        case 'SORTTXT': 
            $out = $sld . 'field-type-sort-text/';
            break; 
        case 'VCARDHL': 
            $out = $sld . 'field-type-vcard-hyperlink/';
            break;    
        case 'QRHL64STA': 
            $out = $sld . 'field-type-qr-code-hyperlink-base64-static/';
            break; 
        case 'QRHL64DYN': 
            $out = $sld . 'field-type-qr-code-hyperlink-base64-dynamic/'; 
            break; 
        case 'QRIMGCAP64STA': 
            $out = $sld . 'field-type-qr-code-image-base64-static/';
            break;
        case 'QRIMGCAP64DYN': 
            $out = $sld . 'field-type-qr-code-image-base64-dynamic/';
            break;                                                  
        case 'ADDRST': 
            $out = $sld . 'field-type-static-address/';
            break;
        case 'ADDR': 
            $out = $sld . 'field-type-address/';
            break;          
                        
        default:
            $out = '';
            break;
    }
    return $out;
}

