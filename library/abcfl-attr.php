<?php
/**
 * Microdata attributes
 * Microdata vocabulary supported is Schema.org.
 *
 * Version 1.0.3
 */

/* Attributes for major structural elements. */
add_filter( 'abcfl_attr_body',    'abcfl_attr_body',    5    );
add_filter( 'abcfl_attr_header',  'abcfl_attr_header',  5    );
add_filter( 'abcfl_attr_footer',  'abcfl_attr_footer',  5    );
add_filter( 'abcfl_attr_content', 'abcfl_attr_content', 5    );
add_filter( 'abcfl_attr_sidebar', 'abcfl_attr_sidebar', 5, 2 );
add_filter( 'abcfl_attr_menu',    'abcfl_attr_menu',    5, 2 );

/* Header attributes. */
add_filter( 'abcfl_attr_branding',         'abcfl_attr_branding',         5 );
add_filter( 'abcfl_attr_site-title',       'abcfl_attr_site_title',       5 );
add_filter( 'abcfl_attr_site-description', 'abcfl_attr_site_description', 5 );

/* Loop attributes. */
add_filter( 'abcfl_attr_loop-meta',        'abcfl_attr_loop_meta',        5 );
add_filter( 'abcfl_attr_loop-title',       'abcfl_attr_loop_title',       5 );
add_filter( 'abcfl_attr_loop-description', 'abcfl_attr_loop_description', 5 );

/* Post-specific attributes. */
add_filter( 'abcfl_attr_post',            'abcfl_attr_post',            5    );
add_filter( 'abcfl_attr_entry',           'abcfl_attr_post',            5    ); // Alternate for "post".
add_filter( 'abcfl_attr_entry-title',     'abcfl_attr_entry_title',     5    );
add_filter( 'abcfl_attr_entry-author',    'abcfl_attr_entry_author',    5    );
add_filter( 'abcfl_attr_entry-published', 'abcfl_attr_entry_published', 5    );
add_filter( 'abcfl_attr_entry-content',   'abcfl_attr_entry_content',   5    );
add_filter( 'abcfl_attr_entry-summary',   'abcfl_attr_entry_summary',   5    );
add_filter( 'abcfl_attr_entry-terms',     'abcfl_attr_entry_terms',     5, 2 );

/* Comment specific attributes. */
add_filter( 'abcfl_attr_comment',           'abcfl_attr_comment',           5 );
add_filter( 'abcfl_attr_comment-author',    'abcfl_attr_comment_author',    5 );
add_filter( 'abcfl_attr_comment-published', 'abcfl_attr_comment_published', 5 );
add_filter( 'abcfl_attr_comment-permalink', 'abcfl_attr_comment_permalink', 5 );
add_filter( 'abcfl_attr_comment-content',   'abcfl_attr_comment_content',   5 );


if ( !function_exists( 'abcfl_attr' ) ){
    //Echo . Returns microdata string
    function abcfl_attr( $slug, $args = array() ) {
            echo abcfl_get_attr( $slug, $args );
    }
}

//Returns only microdata string
if ( !function_exists( 'abcfl_get_attr' ) ){

    function abcfl_get_attr( $slug, $args = array() ) {

        $out    = '';
        $attr   = apply_filters( "abcfl_attr_{$slug}", $args );

        if ( empty( $attr ) ) {return $out;}

        foreach ( $attr as $name => $value ){
            $out .= !empty( $value ) ? sprintf( ' %s="%s"', esc_html( $name ), esc_attr( $value ) ) : esc_html( " {$name}" );
        }
            return trim( $out );
    }
}

 //Returns array of class, ID and microdata as string
if ( !function_exists( 'abcfl_get_attr_parts' ) ){

    function abcfl_get_attr_parts( $slug, $args = array() ) {

        $microdata = '';
        $attr = apply_filters( "abcfl_attr_{$slug}", $args );
        if ( empty( $attr ) ) {return '';}

        $d['id']    = '';
        $d['class'] = '';
        $d['dir'] = '';
        $d['itemscope'] = '';
        $d['itemtype'] = '';
        $d['itemprop']  = '';
        $parts = wp_parse_args($attr , $d );

        $mdata = $parts;
        unset($mdata['id']);
        unset($mdata['class']);

        //Remove blanks
        $mdata = array_filter($mdata);

        foreach ( $mdata as $name => $value ){
            $microdata .= !empty( $value ) ? sprintf( ' %s="%s"', esc_html( $name ), esc_attr( $value ) ) : esc_html( " {$name}" );
        }

        $out['id']    = $parts['id'];
        $out['class'] = $parts['class'];
        $out['microdata'] = trim($microdata);
        return $out;
    }
}
//========================================================================
/* === Structural === */

if ( !function_exists( 'abcfl_attr_body' ) ){
   //<body> element attributes.
   function abcfl_attr_body( $attr ) {

        $d['class'] = join( ' ', get_body_class() );
        $d['dir']       = is_rtl() ? 'rtl' : 'ltr';
        $d['itemscope'] = 'itemscope';
        $d['itemtype']  = 'http://schema.org/WebPage';

        return wp_parse_args($attr , $d );
   }
}
if ( !function_exists( 'abcfl_attr_header' ) ){
    //Page <header> element attributes.
    function abcfl_attr_header( $attr ) {

        //$attr['id']        = 'header';
        $d['id']       = '';
        $d['class']    = '';
        $attr['role']      = 'banner';
        $attr['itemscope'] = 'itemscope';
        $attr['itemtype']  = 'http://schema.org/WPHeader';

        return wp_parse_args($attr , $d );
    }
}
if ( !function_exists( 'abcfl_attr_footer' ) ){
    // Page <footer> element attributes.
    function abcfl_attr_footer( $attr ) {

        $attr['id']        = 'footer';
        $attr['role']      = 'contentinfo';
        $attr['itemscope'] = 'itemscope';
        $attr['itemtype']  = 'http://schema.org/WPFooter';

        return $attr;
    }
}

// Main content container of the page attributes.
if ( !function_exists( 'abcfl_attr_content' ) ){
    function abcfl_attr_content( $attr ) {

        $d['id']       = 'content';
        $d['class']    = 'content';
        $d['role']     = 'main';
        $d['itemprop'] = 'mainContentOfPage';

        if ( is_singular( 'post' ) || is_home() || is_archive() ) {
                $attr['itemscope'] = '';
                $attr['itemtype']  = 'http://schema.org/Blog';
        }

        elseif ( is_search() ) {
                $attr['itemscope'] = 'itemscope';
                $attr['itemtype']  = 'http://schema.org/SearchResultsPage';
        }

        return wp_parse_args($attr , $d );
    }
}

//Nav menu attributes.
if ( !function_exists( 'abcfl_attr_menu' ) ){
    function abcfl_attr_menu( $attr ) {

        $context = $attr['context'];
        if ( !empty( $context ) ){ $attr['id'] = "menu-{$context}";}

        $d['class']      = 'menu';
        $d['role']       = 'navigation';

        if ( !empty( $context ) ) {
                /* Translators: The %s is the menu name. This is used for the 'aria-label' attribute. */
                $attr['aria-label'] = esc_attr( sprintf( _x( '%s Menu', 'nav menu aria label', 'hybrid-core' ), hybrid_get_menu_location_name($context)));
        }

        $attr['itemscope']  = 'itemscope';
        $attr['itemtype']   = 'http://schema.org/SiteNavigationElement';

        return wp_parse_args($attr , $d );
    }
}

if ( !function_exists( 'abcfl_attr_sidebar' ) ){
function abcfl_attr_sidebar( $attr ) {

    $context = $attr['context'];
    if ( !empty( $context ) ){ $attr['id'] = "sidebar-{$context}"; }

    $d['class'] = 'sidebar';
    $d['role']      = 'complementary';
    $d['itemscope'] = 'itemscope';
    $d['itemtype']  = 'http://schema.org/WPSideBar';

    if ( !empty( $context ) ) {
            /* Translators: The %s is the sidebar name. This is used for the 'aria-label' attribute. */
            $attr['aria-label'] = esc_attr( sprintf( _x( '%s Sidebar', 'sidebar aria label', 'hybrid-core' ), hybrid_get_sidebar_name( $context ) ) );
    }

    return wp_parse_args($attr , $d );
}}



/* === HEADER === */

//Site title attributes.
if ( !function_exists( 'abcfl_attr_site_title' ) ){
    function abcfl_attr_site_title( $attr ) {

        $attr['id']       = 'site-title';
        $attr['itemprop'] = 'headline';

        return $attr;
    }
}

//Site description attributes.
if ( !function_exists( 'abcfl_attr_site_description' ) ){
    function abcfl_attr_site_description( $attr ) {

            $attr['id']       = 'site-description';
            $attr['itemprop'] = 'description';

            return $attr;
    }
}

/* === POSTS === */

//Post <article> element attributes.
if ( !function_exists( 'abcfl_attr_post' ) ){
    function abcfl_attr_post( $attr ) {

        $post = get_post();

        /* Make sure we have a real post first. */
        if ( !empty( $post ) ) {

                $attr['id']        = 'post-' . get_the_ID();
                $attr['class']     = join( ' ', get_post_class() );
                $attr['itemscope'] = 'itemscope';

                if ( 'post' === get_post_type() ) {

                        $attr['itemtype']  = 'http://schema.org/BlogPosting';
                        $attr['itemprop']  = 'blogPost';
                }

                elseif ( 'attachment' === get_post_type() && wp_attachment_is_image() ) {

                        $attr['itemtype'] = 'http://schema.org/ImageObject';
                }

                elseif ( 'attachment' === get_post_type() && abcfl_attachment_is_audio() ) {

                        $attr['itemtype'] = 'http://schema.org/AudioObject';
                }

                elseif ( 'attachment' === get_post_type() && abcfl_attachment_is_video() ) {

                        $attr['itemtype'] = 'http://schema.org/VideoObject';
                }

                else {
                        $attr['itemtype']  = 'http://schema.org/CreativeWork';
                }

        } else {

                $attr['id']    = 'post-0';
                $attr['class'] = join( ' ', get_post_class() );
                $attr['itemscope'] = '';
                $attr['itemtype'] = '';
                $attr['itemprop']  = 'blogPost';
        }

        return $attr;
    }
}

//Post author attributes.
if ( !function_exists( 'abcfl_attr_entry_author' ) ){
    function abcfl_attr_entry_author( $attr ) {

        $attr['class']     = 'entry-author';
        $attr['itemprop']  = 'author';
        $attr['itemscope'] = 'itemscope';
        $attr['itemtype']  = 'http://schema.org/Person';

        return $attr;
    }
}

//Post title attributes.
if ( !function_exists( 'abcfl_attr_entry_title' ) ){
    function abcfl_attr_entry_title( $attr ) {

	$attr['class']    = 'entry-title';
	$attr['itemprop'] = 'headline';

	return $attr;
    }
}

//Post time/published attributes.
if ( !function_exists( 'abcfl_attr_entry_published' ) ){
    function abcfl_attr_entry_published( $attr ) {

	$attr['class']    = 'entry-published updated';
	$attr['datetime'] = get_the_time( 'Y-m-d\TH:i:sP' );

	/* Translators: Post date/time "title" attribute. */
	$attr['title']  = get_the_time( _x( 'l, F j, Y, g:i a', 'post time format', 'hybrid-core' ) );

	return $attr;
    }
}

//Post content (not excerpt) attributes.
if ( !function_exists( 'abcfl_attr_entry_content' ) ){
    function abcfl_attr_entry_content( $attr ) {

	//$attr['class'] = 'entry-content';

        if ( 'post' === get_post_type() ){ $attr['itemprop'] = 'articleBody';}
        else { $attr['itemprop'] = 'text'; }

	return $attr;
    }
}

//Post summary/excerpt attributes.
if ( !function_exists( 'abcfl_attr_entry_summary' ) ){
    function abcfl_attr_entry_summary( $attr ) {

	$attr['class']    = 'entry-summary';
	$attr['itemprop'] = 'description';

	return $attr;
    }
}

//Post terms (tags, categories, etc.) attributes.
if ( !function_exists( 'abcfl_attr_entry_terms' ) ){
    function abcfl_attr_entry_terms( $attr, $context ) {

	if ( !empty( $context ) ) {

		$attr['class'] = 'entry-terms ' . sanitize_html_class( $context );

                if ( 'category' === $context ) { $attr['itemprop'] = 'articleSection'; }
                else if ( 'post_tag' === $context ) { $attr['itemprop'] = 'keywords'; }
	}

	return $attr;
    }
}
if ( !function_exists( '' ) ){

}

//#######################################################################




/* === header === */

/**
 * Branding (usually a wrapper for title and tagline) attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @return array
 */
if ( !function_exists( 'abcfl_attr_branding' ) ){
function abcfl_attr_branding( $attr ) {

	$attr['id'] = 'branding';

	return $attr;
}}

/* === loop === */

/**
 * Loop meta attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
if ( !function_exists( 'abcfl_attr_loop_meta' ) ){
function abcfl_attr_loop_meta( $attr ) {

	$attr['class']     = 'loop-meta';
	$attr['itemscope'] = 'itemscope';
	$attr['itemtype']  = 'http://schema.org/WebPageElement';

	return $attr;
}}

/**
 * Loop title attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
if ( !function_exists( 'abcfl_attr_loop_title' ) ){
function abcfl_attr_loop_title( $attr ) {

	$attr['class']     = 'loop-title';
	$attr['itemprop']  = 'headline';

	return $attr;
}}

/**
 * Loop description attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
if ( !function_exists( 'abcfl_attr_loop_description' ) ){
function abcfl_attr_loop_description( $attr ) {

	$attr['class']     = 'loop-description';
	$attr['itemprop']  = 'text';

	return $attr;
}}

/* === posts === */

