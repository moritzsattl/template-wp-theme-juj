<?php

add_action( 'init', 'my_init' );
function my_init() {
	add_theme_support( 'title-tag' );
}

function wps_scripts() {
	/* Css */
	wp_enqueue_style( 
		'app', 
		get_template_directory_uri() . '/dist/app.css', 
		array(),
		'1.0.0.1'
	);

	wp_enqueue_style( 
		'bootstrap', 
		get_template_directory_uri() . '/dist/bootstrap.min.css', 
		array(),
		'1.0.0.1'
	);

	/* JS */
	wp_enqueue_script(
		'script',
		get_template_directory_uri() . '/dist/script.js',
		array( 'jquery' ),
		false
	);
}
add_action(
	'wp_enqueue_scripts',
	'wps_scripts'
);

/***********
 ** Fonts **
 ***********/
function google_fonts() {
    //wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'google_fonts' );

/***********
 ** Menus **
 ***********/
function wpb_custom_menu() {
	register_nav_menu('main-menu',__( 'Main Menu' ));
	register_nav_menu('footer-menu',__( 'Footer Menu' ));
}
add_action( 'init', 'wpb_custom_menu' );


/******************************
 ** Responsive Images Plugin **
 ******************************/
add_filter('rwd_image_sizes', 'my_rwd_image_sizes');
function my_rwd_image_sizes( $image_sizes ) 
{
	return include get_stylesheet_directory() . '/rwd-image-sizes.php';
}

/******************
 ** ACF - BLOCKS **
 ******************/
add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {
	if( function_exists('acf_register_block_type') ) {

		// acf_register_block_type(array(
		// 	'name'              => 'Event Kalender',
		// 	'title'             => __('Event Kalender'),
		// 	'description'       => __('Event Kalender'),
		// 	'render_template'   => 'template-parts/event-calendar/event-calendar.php',
		// 	'category'          => 'formatting',
		// 	'icon'              => 'admin-comments',
		// 	'keywords'          => array( 'testimonial', 'quote' ),
		// ));

	}
}

/* Allow uploads from SVG */
add_filter('upload_mimes', 'allow_svg_upload');
function allow_svg_upload($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}


/*****************************/
/*     Kunden Post Type      */
/*****************************/
function my_register_post_type() {
	//************** Herausforderung ***************//
	register_post_type( 'kunde', array(
		'labels' => array(
			'name' => __( 'Kunden', 'rhc' ),
			'singular_name' => __( 'Kunde', 'rhc' ),
			'edit_item' => __( 'Kunde bearbeiten', 'rhc' ),
			'update_item' => __( 'Kunde aktualisieren', 'rhc' ),
			'add_new_item' => __( 'Neuer Kunde', 'rhc' ),
		),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array( 'slug' => 'kunden' ),
		'show_in_rest' => true,
		'menu_position' => 2,
		'menu_icon' => 'dashicons-buddicons-buddypress-logo',
		'supports' => array( 'title', 'custom-fields', 'revisions' ),
	) );
}
add_action( 'init', 'my_register_post_type' );