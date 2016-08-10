<?php
/**
 * General Settings
 *
 * Register General section, settings and controls for Theme Customizer
 *
 * @package test
 */

/**
 * Adds all general settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function test_customize_register_general_settings( $wp_customize ) {

	// Add Section for Theme Options.
	$wp_customize->add_section( 'test_section_general', array(
		'title'    => esc_html__( 'General Settings', 'test' ),
		'priority' => 10,
		'panel' => 'test_options_panel',
		)
	);

	// Add Settings and Controls for Layout.
	$wp_customize->add_setting( 'test_theme_options[layout]', array(
		'default'           => 'right-sidebar',
		'type'           	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'test_sanitize_select',
		)
	);
	$wp_customize->add_control( 'test_theme_options[layout]', array(
		'label'    => esc_html__( 'Theme Layout', 'test' ),
		'section'  => 'test_section_general',
		'settings' => 'test_theme_options[layout]',
		'type'     => 'radio',
		'priority' => 1,
		'choices'  => array(
			'left-sidebar' => esc_html__( 'Left Sidebar', 'test' ),
			'right-sidebar' => esc_html__( 'Right Sidebar', 'test' ),
			),
		)
	);

	// Add Homepage Title.
	$wp_customize->add_setting( 'test_theme_options[blog_title]', array(
		'default'           => '',
		'type'           	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
		)
	);
	$wp_customize->add_control( 'test_theme_options[blog_title]', array(
		'label'    => esc_html__( 'Blog Title', 'test' ),
		'section'  => 'test_section_general',
		'settings' => 'test_theme_options[blog_title]',
		'type'     => 'text',
		'priority' => 3,
		)
	);

	// Add Homepage Title.
	$wp_customize->add_setting( 'test_theme_options[blog_description]', array(
		'default'           => '',
		'type'           	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
		)
	);
	$wp_customize->add_control( 'test_theme_options[blog_description]', array(
		'label'    => esc_html__( 'Blog Description', 'test' ),
		'section'  => 'test_section_general',
		'settings' => 'test_theme_options[blog_description]',
		'type'     => 'textarea',
		'priority' => 4,
		)
	);

}
add_action( 'customize_register', 'test_customize_register_general_settings' );
