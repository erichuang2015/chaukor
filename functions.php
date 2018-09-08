<?php

/* should be set for a proper Wordpress theme*/

if ( ! isset( $content_width ) ) {
	
	$content_width = 777;
	
}


/**
 * Proper way to enqueue scripts and styles
 *  wp_enqueue_script( $handle, $source, $dependencies, $version,
 */


function chaukor_theme_scripts() {
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'tether', '//cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/js/tether.min.js' );
	wp_enqueue_style( 'bootstrap', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css' );
	wp_enqueue_script( 'font-awesome', 'https://use.fontawesome.com/releases/v5.3.0/js/all.js' );
	wp_enqueue_script( 'webfontloader', 'https://cdnjs.cloudflare.com/ajax/libs/webfont/1.6.28/webfontloader.js' );
	wp_enqueue_script( 'bootstrapjs', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/js/bootstrap.min.js', array('jquery') );
	wp_enqueue_style( 'core',  get_stylesheet_directory_uri(). '/style.css' );	
}

add_action( 'wp_enqueue_scripts', 'chaukor_theme_scripts' );

$bgargs = array(
	'default-color' => 'ffffff',
);

add_theme_support( "title-tag" );
add_theme_support( 'automatic-feed-links' );
add_theme_support( "post-thumbnails" );


add_theme_support( 'infinite-scroll', array(
    'container' => 'blocktainer',
	'footer' => 'footer',
	'render' => 'render_function'
) );

function render_function() {
    get_template_part('content');
}



/* register main navigation */

function register_mainmenu() {
	
	register_nav_menu('header-menu',__( 'Header Menu', 'chaukor' ));
	
}

add_action( 'init', 'register_mainmenu' );

// Register Custom Navigation Walker
require_once('libs/wp-bootstrap-navwalker.php');


// Bootstrap navigation
function bootstrap_nav()
{
	wp_nav_menu( array(
            'theme_location'    => 'header-menu',
            'depth'             => 2,
            'container'         => 'false',
            'menu_class'        => 'nav navbar-nav ml-auto w-100 justify-content-end',
            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
            'walker'            => new wp_bootstrap_navwalker())
    );
}


/* shoutout to WPBeginner -> http://www.wpbeginner.com/wp-themes/how-to-add-numeric-pagination-in-your-wordpress-theme/ */
function chaukor_pagination_numeric_posts_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="pagination"><ul class="mx-auto">' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link('<i class="fa fa-chevron-left" aria-hidden="true"></i>') );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, get_pagenum_link( 1, true ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li class="pagination-dash">-</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, get_pagenum_link( $link, 1, true ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li class="pagination-dash">-</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, get_pagenum_link( $max, 1, true ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link('<i class="fa fa-chevron-right" aria-hidden="true"></i>') );

	echo '</ul></div>' . "\n";
}

/* sanitize checkbox as was asked by the theme checker */
function chaukor_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/* sanitize select/inputs/radios as was asked by the theme checker */
function chaukor_sanitize_select( $input, $setting ) {
	
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
function chaukor_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'settings_section_chaukor',
        array(
            'title' =>  __('Chaukor Settings', 'chaukor'),
            'description' => __('Tweak chaukor to your liking.', 'chaukor'),
            'priority' => 55,
        )
    );

    $wp_customize->add_section(
        'settings_section_chaukor_labs',
        array(
            'title' =>  __('chaukor Labs', 'chaukor'),
            'description' => __('Experimental chaukor Labs features.', 'chaukor'),
            'priority' => 200,
        )
    );

	$wp_customize->add_setting(
		'display_featured_content',
		array(
			'default' => 'showfeatured',
			'sanitize_callback' => 'chaukor_sanitize_select',
		)
	);

	$wp_customize->add_setting(
		'show_author_section',
		array(
			'default' => 'showauthor',
			'sanitize_callback' => 'chaukor_sanitize_select',
		)
	);

	$wp_customize->add_setting(
		'theme_preset',
		array(
			'default' => 'default',
			'sanitize_callback' => 'chaukor_sanitize_select',
		)
	);

	$wp_customize->add_control( 'show_author_section', array(
		'label' => __('Show Author section', 'chaukor'),
		'section' => 'settings_section_chaukor',
		'type' => 'radio',
		'choices' => array(
			'showauthor' => __('Show Author section', 'chaukor'),
			'hideauthor' => __('Hide Author section', 'chaukor'),
		),
	) );

	$wp_customize->add_control( 'theme_preset', array(
		'label' => __('Theme preset', 'chaukor'),
		'section' => 'settings_section_chaukor_labs',
		'type' => 'radio',
		'choices' => array(
			'default' => __('Chaukor (default)', 'chaukor'),
		),
	) );

	}

add_action( 'customize_register', 'chaukor_customizer' );



function change_logo_class( $html ) {

    $html = str_replace( 'custom-logo', 'brand-logo', $html );

    return $html;
}

/**
 * add custom site logo (to header)
 */

function chaukor_setup() {
	
	
	add_theme_support( 'custom-logo', array(
	'height'      => 64,
	'width'       => 64,
	'flex-width' => true,
	'header-text' => array( 'site-title', 'site-description' ),
	) );
}

add_action( 'after_setup_theme', 'chaukor_setup' );
add_filter( 'get_custom_logo', 'change_logo_class' );

load_theme_textdomain( 'chaukor', get_template_directory().'/languages' );

?>
