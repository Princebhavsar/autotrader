<?php

if ( ! isset( $content_width) ) {
	$content_width = 660;
}

function tranquilwp_setup() {

	add_theme_support('post-thumbnails');

	add_theme_support('automatic-feed-links');
	add_theme_support('title-tag');

	// Register Custom Navigation Walker
	require_once('wp_bootstrap_navwalker.php');

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'tranquilwp' ),
		'footer' => __( 'Footer Menu', 'tranquilwp' ),
		) );
}

add_action('after_setup_theme', 'tranquilwp_setup');

function tranquil_scripts() {

	/* add styles */
	wp_enqueue_style( 'bootstrap-core', get_template_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style( 'custom', get_template_directory_uri() . '/style.css');

	/* add styles */
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), true );
	if ( is_singular() ) wp_enqueue_script('comment-reply');	
}



add_action('wp_enqueue_scripts', 'tranquil_scripts');

function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


/**
 * Register our sidebars and widgetized areas.
 *
 */
function arphabet_widgets_init() {

	register_sidebar( array(
		'name'          => 'Sidebar',
		'id'            => 'sidebar_blog',
		'before_widget' => '<div class="sidebar-module">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
		) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );


function featureText() {

	if ( is_front_page() ) {
		the_field('feature_text');
	} elseif ( is_home() || is_single() ) {
		_e('Tranquil Spa Official Blog');
	} elseif ( is_archive() ) {
		_e('Tranquil Spa Official Blog');
		_e('<br>');

		single_term_title('Browsing: ');

		if ( is_month() ) {
			$monthNum = get_query_var('monthnum');
			$month = date("F", mktime(0, 0, 0, $monthNum));
			$year = get_query_var('year');

			echo 'Post from ' . $month .' '.$year;
		}

	} elseif (  is_page_template('page-news.php') 
		|| is_page_template('page-about.php') 
		|| is_page_template('page-contact.php') ) {
		bloginfo('name');
		_e('<br>');
		the_title();

	} elseif (  is_404() ) {
		_e('Whoops, were a little lost');

	} elseif ( is_search() ) {
		_e('Tranquil Spa Official Blog');
		_e('<br>');

		printf(('Search results for: %s'), get_search_query() );
	}

}

$args = array(
	//'width'         => 980,
	//'height'        => 60,
	'default-image' => get_template_directory_uri() . '/images/bg_main.jpg',
	'uploads' => true,
	);

add_theme_support( 'custom-header', $args );

?>