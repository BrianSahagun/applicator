<?php // Applicator: Customizer
// From Twenty Seventeen Theme

function applicator_func_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'applicator_func_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'applicator_func_customize_partial_blogdescription',
	) );

	/**
	 * Custom colors.
	 */
	$wp_customize->add_setting( 'colorscheme', array(
		'default'           => 'light',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'applicator_func_sanitize_colorscheme',
	) );

	$wp_customize->add_setting( 'colorscheme_hue', array(
		'default'           => 250,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint', // The hue is stored as a positive integer.
	) );

	$wp_customize->add_control( 'colorscheme', array(
		'type'    => 'radio',
		'label'    => __( 'Color Scheme', 'applicator' ),
		'choices'  => array(
			'light'  => __( 'Light', 'applicator' ),
			'dark'   => __( 'Dark', 'applicator' ),
			'custom' => __( 'Custom', 'applicator' ),
		),
		'section'  => 'colors',
		'priority' => 5,
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'colorscheme_hue', array(
		'mode' => 'hue',
		'section'  => 'colors',
		'priority' => 6,
	) ) );
}
add_action( 'customize_register', 'applicator_func_customize_register' );

/**
 * Sanitize the colorscheme.
 */
function applicator_func_sanitize_colorscheme( $input ) {
	$valid = array( 'light', 'dark', 'custom' );

	if ( in_array( $input, $valid ) ) {
		return $input;
	}

	return 'light';
}

// Render the site title for the selective refresh partial.
function applicator_func_customize_partial_blogname() {
	bloginfo( 'name' );
}

// Render the site tagline for the selective refresh partial.
function applicator_func_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

// Bind JS handlers to instantly live-preview changes.
function applicator_func_customize_preview_js() {
	wp_enqueue_script( 'apl-script-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'applicator_func_customize_preview_js' );

// Load dynamic logic for the customizer controls area.
function applicator_func_panels_js() {
	wp_enqueue_script( 'apl-script-customize-controls', get_theme_file_uri( '/assets/js/customize-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'applicator_func_panels_js' );