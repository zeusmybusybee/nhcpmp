<?php
/**
 * Memory Theme Customizer
 *
 * @package Memory
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function memory_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	$wp_customize->register_control_type( 'GT_Customize_Link_Control' );

	// Remove header image section.
	$wp_customize->remove_section( 'header_image' );

	// Remove color section default.
	$wp_customize->remove_section( 'colors' );

	// Remove Display Site Title and Tagline.
	$wp_customize->remove_control( 'display_header_text' );

	// Documentation Link.
	$theme = wp_get_theme();
	$slug  = $theme->template;
	$utm   = '?utm_source=WordPress&utm_medium=link&utm_campaign=' . $slug;
	$wp_customize->add_section(
		new GT_Customize_Link_Control(
			$wp_customize,
			'link-pro',
			array(
				'section_type' => 'pro',
				'title'        => esc_html__( 'Ready For More?', 'memory' ),
				'pro_text'     => esc_html__( 'Upgrade To PRO', 'memory' ),
				'pro_url'      => 'https://gretathemes.com/wordpress-themes/'. $slug .'/'. $utm .'', 'memory',
				'type'       => 'gt-link',
				'capability' => 'edit_theme_options',
				'priority'     => 99999999,
			)
		)
	);

	$wp_customize->add_section(
		new GT_Customize_Link_Control(
			$wp_customize,
			'link-doc',
			array(
				'section_type' => 'doc',
				'label'      => esc_html( 'Need help setting up your site?', 'memory' ),
				'priority'   => 0,
				'capability' => 'edit_theme_options',
				'type'       => 'gt-link',
				'url'        => esc_url( 'https://gretathemes.com/docs/'. $slug .'/'. $utm .'', 'memory' ),
			)
		)
	);

	// Site Title.
	$wp_customize->add_setting(
		'site_title',
		array(
			'default'           => true,
			'sanitize_callback' => 'gt_sanitize_checkbox',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'site_title',
		array(
			'label'   => esc_html__( 'Site Title', 'memory' ),
			'section' => 'title_tagline',
			'type'    => 'checkbox',
		)
	);

	// Site Description.
	$wp_customize->add_setting(
		'site_description',
		array(
			'default'           => true,
			'sanitize_callback' => 'gt_sanitize_checkbox',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'site_description',
		array(
			'label'   => esc_html__( 'Site Description', 'memory' ),
			'section' => 'title_tagline',
			'type'    => 'checkbox',
		)
	);

	// Add theme options panel.
	$wp_customize->add_panel(
		'memory',
		array(
			'title' => esc_html__( 'Theme Options', 'memory' ),
		)
	);

	/**
	 * Featured Content (Slider).
	 */
	$slider = $wp_customize->get_section( 'featured_content' );
	if ( $slider ) {
		$slider->panel    = 'memory';
		$slider->priority = 20;
	}

	/**
	 * Homepage Settings
	 */

	$wp_customize->add_section(
		'home',
		array(
			'title'    => esc_html__( 'Homepage Settings', 'memory' ),
			'panel'    => 'memory',
			'priority' => 30,
		)
	);

	// Email newsletter.
	$wp_customize->add_setting(
		'newsletter_heading',
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new GT_Customize_Heading_Control(
			$wp_customize,
			'newsletter_heading',
			array(
				'label'   => esc_html__( 'Newsletter', 'memory' ),
				'section' => 'home',
			)
		)
	);

	// Subscribe text.
	$wp_customize->add_setting(
		'subscribe_text',
		array(
			'default'           => esc_html__( 'Subscribe to our newsletter and get latest news and updates!', 'memory' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'subscribe_text',
		array(
			'label'   => esc_html__( 'Subscribe Text', 'memory' ),
			'section' => 'home',
			'type'    => 'text',
		)
	);

	// Subscribe button.
	$wp_customize->add_setting(
		'subscribe_button',
		array(
			'default'           => esc_html__( 'Subscribe', 'memory' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'subscribe_button',
		array(
			'label'   => esc_html__( 'Subscribe Button', 'memory' ),
			'section' => 'home',
			'type'    => 'text',
		)
	);

	// Layout.
	$wp_customize->add_setting(
		'layout_heading',
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new GT_Customize_Heading_Control(
			$wp_customize,
			'layout_heading',
			array(
				'label'   => esc_html__( 'Layout', 'memory' ),
				'section' => 'home',
			)
		)
	);

	// Layout style.
	$wp_customize->add_setting(
		'blog_style',
		array(
			'default'           => 'grid',
			'sanitize_callback' => 'gt_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'blog_style',
		array(
			'type'    => 'radio',
			'section' => 'home',
			'label'   => esc_html__( 'Layout Style', 'memory' ),
			'choices' => array(
				'list' => esc_html__( 'List', 'memory' ),
				'grid' => esc_html__( 'Grid', 'memory' ),
			),
		)
	);

	/**
	 * Single Post Settings
	 */
	$wp_customize->add_section(
		'single',
		array(
			'title'    => esc_html__( 'Post Settings', 'memory' ),
			'panel'    => 'memory',
			'priority' => 30,
		)
	);

	$wp_customize->add_setting(
		'hide_featured_image',
		array(
			'default'           => 'show-ft',
			'sanitize_callback' => 'gt_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'hide_featured_image',
		array(
			'type'        => 'radio',
			'section'     => 'single',
			'label'       => esc_html__( 'Hide Featured Image', 'memory' ),
			'description' => esc_html__( 'Hide featured image in single.', 'memory' ),
			'choices'     => array(
				'show-ft' => esc_html__( 'No', 'memory' ),
				'hide-ft' => esc_html__( 'Yes', 'memory' ),
			),
		)
	);

	/**
	 * Footer
	 */
	$wp_customize->add_section(
		'footer',
		array(
			'title'    => esc_html__( 'Footer Settings', 'memory' ),
			'panel'    => 'memory',
			'priority' => 40,
		)
	);

	// Show Logo.
	$wp_customize->add_setting(
		'ft_show_logo',
		array(
			'default'           => true,
			'sanitize_callback' => 'gt_sanitize_checkbox',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'ft_show_logo',
		array(
			'label'   => esc_html__( 'Show Logo', 'memory' ),
			'section' => 'footer',
			'type'    => 'checkbox',
		)
	);

	// Footer Title.
	$wp_customize->add_setting(
		'ft_site_title',
		array(
			'default'           => true,
			'sanitize_callback' => 'gt_sanitize_checkbox',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'ft_site_title',
		array(
			'label'   => esc_html__( 'Site Title', 'memory' ),
			'section' => 'footer',
			'type'    => 'checkbox',
		)
	);

	// Footer Description.
	$wp_customize->add_setting(
		'ft_site_description',
		array(
			'default'           => true,
			'sanitize_callback' => 'gt_sanitize_checkbox',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'ft_site_description',
		array(
			'label'   => esc_html__( 'Site Description', 'memory' ),
			'section' => 'footer',
			'type'    => 'checkbox',
		)
	);

	// Subscribe title.
	$wp_customize->add_setting(
		'footer_subscribe_title',
		array(
			'default'           => esc_html__( 'Newsletter Subscription', 'memory' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'footer_subscribe_title',
		array(
			'label'   => esc_html__( 'Subscribe Title', 'memory' ),
			'section' => 'footer',
			'type'    => 'text',
		)
	);

	// Subscribe text.
	$wp_customize->add_setting(
		'footer_subscribe_text',
		array(
			'default'           => esc_html__( 'Enter your email address to subscribe to this blog and receive notifications of new posts by email.', 'memory' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'footer_subscribe_text',
		array(
			'label'   => esc_html__( 'Subscribe Text', 'memory' ),
			'section' => 'footer',
			'type'    => 'text',
		)
	);
}

// Priority 20: after some controls are registered.
add_action( 'customize_register', 'memory_customize_register', 20 );

/**
 * Render the site title for the selective refresh partial.
 */
function memory_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 */
function memory_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function memory_customize_preview_js() {
	wp_enqueue_script( 'memory-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'memory_customize_preview_js' );

/**
 * Enqueue script for customizer controls.
 */
function memory_customize_controls_js() {
	wp_enqueue_script( 'memory-customize-controls', get_template_directory_uri() . '/js/customize-controls.js', array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'memory_customize_controls_js' );
