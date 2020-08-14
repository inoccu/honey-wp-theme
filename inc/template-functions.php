<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Honey
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function honey_body_classes( $classes ) {
	$classes[] = 'container';
	
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'honey_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function honey_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'honey_pingback_header' );

function honey_enqueue_scripts() {
	wp_enqueue_style( 'bootstrap.css', get_template_directory_uri() . '/css/bootstrap.css', array(), '4.5.0' );
	//wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.5.1.slim.min.js', array(), '3.5.1', true );
	wp_enqueue_script( 'popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', array('jquery'), '1.16.0', true );
	wp_enqueue_script( 'bootstrap.js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery', 'popper'), '4.5.0', true );
}
add_action( 'wp_enqueue_scripts', 'honey_enqueue_scripts' );