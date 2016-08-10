<?php
/**
 * Pro Version Upgrade Section
 *
 * Registers Upgrade Section for the Pro Version of the theme
 *
 * @package test
 */

/**
 * Adds pro version description and CTA button
 *
 * @param object $wp_customize / Customizer Object.
 */
function test_customize_register_upgrade_settings( $wp_customize ) {

	// Add Upgrade / More Features Section.
	$wp_customize->add_section( 'test_section_upgrade', array(
		'title'    => esc_html__( 'More Features', 'test' ),
		'priority' => 70,
		'panel' => 'test_options_panel',
		)
	);

	// Add custom Upgrade Content control.
	$wp_customize->add_setting( 'test_theme_options[upgrade]', array(
		'default'           => '',
		'type'           	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control( new test_Customize_Upgrade_Control(
		$wp_customize, 'test_theme_options[upgrade]', array(
		'section' => 'test_section_upgrade',
		'settings' => 'test_theme_options[upgrade]',
		'priority' => 1,
		)
	) );

}
add_action( 'customize_register', 'test_customize_register_upgrade_settings' );
