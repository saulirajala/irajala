<?php

namespace App;

/**
 * Theme customizer
 */
add_action( 'customize_register', function ( \WP_Customize_Manager $wp_customize ) {
	// Add postMessage support
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->selective_refresh->add_partial( 'blogname', [
		'selector'        => '.brand',
		'render_callback' => function () {
			bloginfo( 'name' );
		}
	] );
} );

/**
 * Customizer JS
 */
add_action( 'customize_preview_init', function () {
	wp_enqueue_script( 'sage/customizer.js', asset_path( 'scripts/customizer.js' ), [ 'customize-preview' ], null, true );
} );

/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 object $cmb CMB2 object
 *
 * @return bool             True if metabox should show
 */
function ir_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template
	if ( $cmb->object_id !== get_option( 'page_on_front' ) ) {
		return false;
	}

	return true;
}

/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function ir_register_metabox() {

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb = new_cmb2_box( array(
		'id'           => 'ir_metabox',
		'title'        => esc_html__( 'Test Metabox', 'cmb2' ),
		'object_types' => array( 'page' ), // Post type
		'show_on_cb'   => 'App\\ir_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
		// 'classes'    => 'extra-class', // Extra cmb2-wrap classes
		// 'classes_cb' => 'yourprefix_add_some_classes', // Add classes through a callback.
	) );

	$cmb->add_field( array(
		'name'    => 'Hero image',
		'desc'    => 'Upload an image for bottom layer',
		'id'      => 'hero__image',
		'type'    => 'file',
		// Optional:
		'options' => array(
			'url' => false, // Hide the text input for the url
		),
		'text'    => array(
			'add_upload_file_text' => 'Upload image' // Change upload button text. Default: "Add or Upload File"
		),
	) );
	$cmb->add_field( array(
		'name'    => 'Hero image - layer 1',
		'desc'    => 'Upload an image for middle layer',
		'id'      => 'hero__image__layer-1',
		'type'    => 'file',
		// Optional:
		'options' => array(
			'url' => false, // Hide the text input for the url
		),
		'text'    => array(
			'add_upload_file_text' => 'Add File' // Change upload button text. Default: "Add or Upload File"
		),
	) );
	$cmb->add_field( array(
		'name'    => 'Hero image - layer 2',
		'desc'    => 'Upload an image for top layer',
		'id'      => 'hero__image__layer-2',
		'type'    => 'file',
		// Optional:
		'options' => array(
			'url' => false, // Hide the text input for the url
		),
		'text'    => array(
			'add_upload_file_text' => 'Add File' // Change upload button text. Default: "Add or Upload File"
		),
	) );

}

add_action( 'cmb2_admin_init', 'App\\ir_register_metabox' );