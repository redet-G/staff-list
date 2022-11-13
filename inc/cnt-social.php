<?php

function abcfsl_cnt_social_txt_field_SL( $par, $itemOptns, $tplateOptns ){

    //$itemID = $par['itemID'];
    $isSingle = $par['isSingle'];
    $clsPfix = $par['clsPfix'];

    $socialSource = isset( $tplateOptns['_socialSource'] ) ? esc_attr( $tplateOptns['_socialSource'][0] ) : '32-70';
    $social1 = isset( $tplateOptns['_social1'] ) ? esc_attr( $tplateOptns['_social1'][0] ) : '';
    $social2 = isset( $tplateOptns['_social2'] ) ? esc_attr( $tplateOptns['_social2'][0] ) : '';
    $social3 = isset( $tplateOptns['_social3'] ) ? esc_attr( $tplateOptns['_social3'][0] ) : '';
    $cntrCls = isset( $tplateOptns['_socialCntrCls'] ) ? esc_attr( $tplateOptns['_socialCntrCls'][0] ) : '';
    $cntrStyle = isset( $tplateOptns['_socialCntrStyle'] ) ? esc_attr( $tplateOptns['_socialCntrStyle'][0] ) : '';
    $socialTM = isset( $tplateOptns['_socialTM'] ) ? esc_attr( $tplateOptns['_socialTM'][0] ) : 'N';

    $fbookUrl = isset( $itemOptns['_fbookUrl'] ) ? esc_attr( $itemOptns['_fbookUrl'][0] ) : '';
    $googlePlusUrl = isset( $itemOptns['_googlePlusUrl'] ) ? esc_attr( $itemOptns['_googlePlusUrl'][0] ) : '';
    $twitUrl = isset( $itemOptns['_twitUrl'] ) ? esc_attr( $itemOptns['_twitUrl'][0] ) : '';
    $likedUrl = isset( $itemOptns['_likedUrl'] ) ? esc_attr( $itemOptns['_likedUrl'][0] ) : '';
    $emailUrl = isset( $itemOptns['_emailUrl'] ) ? esc_attr( $itemOptns['_emailUrl'][0] ) : '';
    $instaUrl = isset( $itemOptns['_instaUrl'] ) ? esc_attr( $itemOptns['_instaUrl'][0] ) : '';

    $socialC1Url = isset( $itemOptns['_socialC1Url'] ) ? esc_attr( $itemOptns['_socialC1Url'][0] ) : '';
    $socialC2Url = isset( $itemOptns['_socialC2Url'] ) ? esc_attr( $itemOptns['_socialC2Url'][0] ) : '';
    $socialC3Url = isset( $itemOptns['_socialC3Url'] ) ? esc_attr( $itemOptns['_socialC3Url'][0] ) : '';

    $iconBaseCls = 'MR10';
    $iconCustomCls = '';
    //$socialCntrBaseCls = '';

    $imgsFolderUrl = ABCFSL_PLUGIN_URL . 'images';
    if( $socialSource == 'C' ){
        $uploadDir = wp_upload_dir();
        $custom = 'abcfolio/staff-list';
        $baseURL = $uploadDir['baseurl'];
        $imgsFolderUrl = trailingslashit( $baseURL ) . $custom;
    }
    $imgsFolderUrl = trailingslashit( $imgsFolderUrl );

    $fbookCntr = abcfsl_cnt_social_icon_a_tag( 'facebook', 'Facebook', $fbookUrl, $socialSource, $imgsFolderUrl, $clsPfix, $iconBaseCls, $iconCustomCls, $isSingle );
    $googlePlusCntr = abcfsl_cnt_social_icon_a_tag( 'googleplus', 'Google+', $googlePlusUrl, $socialSource, $imgsFolderUrl, $clsPfix, $iconBaseCls, $iconCustomCls, $isSingle );
    $twitCntr = abcfsl_cnt_social_icon_a_tag( 'twitter', 'Twitter', $twitUrl, $socialSource, $imgsFolderUrl, $clsPfix, $iconBaseCls, $iconCustomCls, $isSingle );
    $linkedCntr = abcfsl_cnt_social_icon_a_tag( 'linkedin', 'LinkedIn', $likedUrl, $socialSource, $imgsFolderUrl, $clsPfix, $iconBaseCls, $iconCustomCls, $isSingle );
    //$instaCntr = abcfsl_cnt_social_icon_a_tag( 'instagram', 'Instagram', $instaUrl, $socialSource, $imgsFolderUrl, $clsPfix, $iconBaseCls, $iconCustomCls, $isSingle );
    $emailCntr = abcfsl_cnt_social_icon_a_tag( 'email', 'Email', $emailUrl, $socialSource, $imgsFolderUrl, $clsPfix, $iconBaseCls, $iconCustomCls, $isSingle );

    $c1Cntr = abcfsl_cnt_social_icon_a_tag( abcfsl_cnt_social_custom_icon_basename( $social1, '1' ), $social1, $socialC1Url, $socialSource, $imgsFolderUrl, $clsPfix, $iconBaseCls, $iconCustomCls, $isSingle );
    $c2Cntr = abcfsl_cnt_social_icon_a_tag( abcfsl_cnt_social_custom_icon_basename( $social2, '2'), $social2, $socialC2Url, $socialSource, $imgsFolderUrl, $clsPfix, $iconBaseCls, $iconCustomCls, $isSingle );
    $c3Cntr = abcfsl_cnt_social_icon_a_tag( abcfsl_cnt_social_custom_icon_basename( $social3, '3'), $social3, $socialC3Url, $socialSource, $imgsFolderUrl, $clsPfix, $iconBaseCls, $iconCustomCls, $isSingle );

    $socialCntr = abcfsl_cnt_social_cntr_cls( $socialTM, $cntrCls, $cntrStyle, $clsPfix, $isSingle );

    //$socialIcons = $fbookCntr . $googlePlusCntr . $twitCntr . $linkedCntr .  $c1Cntr . $c2Cntr . $c3Cntr . $emailCntr;
    //return $socialCntr['cntrS'] . $socialIcons . $socialCntr['cntrE'];

    return $socialCntr['cntrS'] . $fbookCntr . $googlePlusCntr . $twitCntr . $linkedCntr .  $c1Cntr . $c2Cntr . $c3Cntr . $emailCntr . $socialCntr['cntrE'];
}

function abcfsl_cnt_social_cntr_cls( $socialTM, $customCls, $cntrStyle, $clsPfix, $isSingle ){

    $clsTM = abcfsl_util_cls_name_ncd_bldr( $socialTM, 'MT', $clsPfix );
    $baseCls = trim ( 'SocialIconsA '  . $clsTM);
    return abcfsl_cnt_generic_div( $clsPfix, $baseCls, $customCls, $cntrStyle, '', '', '', 'N', $isSingle);
}
//========================================================================
//Single icon cntr $href
function abcfsl_cnt_social_icon_a_tag( $fileBaseName, $iconTitle, $href, $socialSource, $imgsFolderUrl, $clsPfix, $baseCls, $customCls, $isSingle ){

    if( empty( $href ) ){ return ''; }
    if( empty( $iconTitle ) ){ return ''; }
    if( empty( $fileBaseName ) ){ return ''; }

    $iconTitle = str_replace( '_', ' ', $iconTitle );

    $iconCls = '';
    $iconStyle = '';
    $aCls = abcfsl_cnt_class_bldr( $clsPfix, $baseCls, $customCls, $isSingle );

    $imgUrl = abcfsl_cnt_social_icon_url( $socialSource, $imgsFolderUrl, $fileBaseName);

     //( $imgID, $src, $alt, $title, $cls='', $style='', $args='', $itemprop='image' )
    $imgTag = abcfl_html_img_tag_resp('', $imgUrl, $iconTitle, $iconTitle, $iconCls, $iconStyle);

    $aTag['hrefUrl'] = $href;
    $aTag['target'] = '';

    //?????????????????????????????????????
    if( $fileBaseName == 'email' ){
        $aTag['hrefUrl'] = $url = 'mailto:' . $href;
    }
    else {
       $aTag = abcfsl_util_get_target( $href );
    }

    //abcfl_html_a_tag($href, $lnkTxt, $target='', $cls='', $style='', $spanStyle='', $blankTag=true, $onclickJS='', $args='')
    $imgATag = abcfl_html_a_tag( $aTag['hrefUrl'], $imgTag, $aTag['target'], $aCls, '', '', false );

    return $imgATag;
}
//==========================================================================

//Returns icon URL.
function abcfsl_cnt_social_icon_url( $socialSource, $imgsFolderUrl, $fileBaseName ){

    //Custom icons. $fileBaseName = name of the icon included with the plugin OR custom1, custom2...
    //$imgsFolderUrl uploads/abcfolio/staff-list
    if( $socialSource == 'C' ){ return $imgsFolderUrl . $fileBaseName . '.png';  }

    // SLSN
    //Icons included in the plugin. subfolder: 32; 488.... abcfsls_cbo_social_icons()
    $subfolder = trailingslashit( $socialSource );

    return $imgsFolderUrl . $subfolder . $fileBaseName . '.png';
}


//Figure out $fileBaseName from custom social icon name.
//In: Value of: Template Options > Social Icons > Custom Link 1, Custom Link 2...
//Out: fileBaseName of one of the default icons included in the plugin. OR social1, social2....
function abcfsl_cnt_social_custom_icon_basename( $iconTitle, $no ){

    if( empty( $iconTitle ) ){ return ''; }

    $iconTitleL = strtolower ( $iconTitle );
    if( $iconTitleL == 'google+' ) { $iconTitleL = 'googleplus'; }
    $fileBaseName = $iconTitleL;

    return $fileBaseName;
}

//Figure out $fileBaseName from custom social icon name.
//In: Value of: Template Options > Social Icons > Custom Link 1, Custom Link 2...
//Out: fileBaseName of one of the default icons included in the plugin. OR social1, social2....
function abcfsl_cnt_social_custom_icon_basename_OLD( $iconTitle, $no ){

    if( empty( $iconTitle ) ){ return ''; }

    $iconTitleL = strtolower ( $iconTitle );
    $fileBaseName = $iconTitleL;

    //Get filename of an icon included in the plugin or empty string.
    switch ( $iconTitleL ) {
        case 'email':
        case 'facebook':
        case 'googleplus':
        case 'linkedin':
        case 'twitter':
            break;
        case 'calendar':
        case 'dribbble':
        case 'googlescholar':
        case 'graduationcap':
        case 'home':
        case 'instagram':
        case 'link':
        case 'marker':
        case 'phone':
        case 'pinterest':
        case 'qq':
        case 'skype':
        case 'telegram':
        case 'tumblr':
        case 'vk':
        case 'whatsapp':
        case 'wordpress':
        case 'xing':
        case 'youtube':
        case 'vcard':
        case 'viadeo':
            break;
        case 'google+':
        $fileBaseName = 'googleplus';
            break;
        default:
            $fileBaseName = $iconTitle;
            break;
    }

    //???????????????????????
    //Custom icon file name: one of the default icons OR social1, social2....
    if( empty( $fileBaseName ) ){ $fileBaseName = 'social' . $no;}
    return $fileBaseName;
}



