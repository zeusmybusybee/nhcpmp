<?php
/**
 * Memory functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Memory
 */

if ( is_admin() ) {
	require_once get_template_directory() . '/inc/admin/class-tgm-plugin-activation.php';
	require_once get_template_directory() . '/inc/admin/plugins.php';
}

/**
 * Determine whether it is an AMP response.
 *
 * This function is used as a "Conditional Tag" in WordPress. It can only be used at the `wp` action or later.
 *
 * @link https://developer.wordpress.org/themes/references/list-of-conditional-tags/
 * @see is_amp_endpoint()
 *
 * @return bool Is AMP response.
 */
function memory_is_amp() {
	return function_exists( 'is_amp_endpoint' ) && is_amp_endpoint();
}

if ( ! function_exists( 'memory_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function memory_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Memory, use a find and replace
		 * to change 'memory' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'memory', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'memory-thumbnails-1', 627, 402, true );
		add_image_size( 'memory-thumbnails-2', 770, 450, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'memory' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Support Gutenberg.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'memory_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 110,
				'width'       => 278,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Post format.
		add_theme_support(
			'post-formats',
			array(
				'video',
				'quote',
				'gallery',
			)
		);

		// AMP.
		add_theme_support(
			'amp',
			array(
				'paired' => true,

				/*
				 * Configure mobile nav menu toggle, per <https://amp-wp.org/documentation/playbooks/toggling-hamburger-menus/>.
				 * The configuration here takes the place of the custom script in navigation.js, porting the functionality
				 * to use amp-bind instead; see <https://amp.dev/documentation/components/amp-bind/>.
				 */
				'nav_menu_toggle' => array(
					'nav_container_id'           => 'site-navigation',
					'nav_container_toggle_class' => 'toggled',
					'menu_button_id'             => 'site-navigation-open',
					// @todo It would be nice if the AMP_Nav_Menu_Toggle_Sanitizer had a body_toggle_class instead of needing to manually add a bound class in header.php.
				),

				/*
				 * Configure nav submenu toggles, per <https://amp-wp.org/documentation/playbooks/navigation-sub-menu-buttons/>.
				 * Note that Noto Simple does not make use of such buttons, using an older pattern used in core themes like
				 * Twenty Thirteen where a user must tap once on the parent nav menu item once to cause the submenu to appear;
				 * the user can then either tap on the parent nav menu item again to navigate to that page, or they can click
				 * on one of the revealed submenu items. In Twenty Fifteen, this pattern for mobile submenu navigation has been
				 * replaced by a more accessible method of adding submenu toggle buttons next to each parent item, allowing
				 * navigation to a parent nav menu item link without having to tap it twice. Because Noto Simple does not use
				 * these buttons, the style.css in the child theme has additional CSS to style the submenu toggle buttons when
				 * they appear on not just mobile but any touch interface.
				 */
				'nav_menu_dropdown' => array(
					'sub_menu_button_class'        => 'dropToggle fa',
					'sub_menu_button_toggle_class' => 'is-toggled',
				),
			)
		);

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add a color palette to the editor Gutenberg.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Strong cyan', 'memory' ),
					'slug'  => 'strong-cyan',
					'color' => '#00a6b6',
				),
				array(
					'name'  => __( 'Vivid red', 'memory' ),
					'slug'  => 'vivid-red',
					'color' => '#e11e2f',
				),
				array(
					'name'  => __( 'Slightly desaturated pink', 'memory' ),
					'slug'  => 'slightly-desaturated-pink',
					'color' => '#cc95b5',
				),
				array(
					'name'  => __( 'Vivid blue', 'memory' ),
					'slug'  => 'vivid-blue',
					'color' => '#1991f0',
				),
				array(
					'name'  => __( 'strong chartreuse green', 'memory' ),
					'slug'  => 'strong-chartreuse-green',
					'color' => '#6ca53a',
				),
				array(
					'name'  => __( 'slightly desaturated orange', 'memory' ),
					'slug'  => 'slightly-desaturated-orange',
					'color' => '#c9a978',
				),
				array(
					'name'  => __( 'very light blue', 'memory' ),
					'slug'  => 'very-light-blue',
					'color' => '#7076fe',
				),
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'memory_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function memory_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'memory_content_width', 770 );
}
add_action( 'after_setup_theme', 'memory_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function memory_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'memory' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'memory' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'memory' ),
			'id'            => 'footer',
			'description'   => esc_html__( 'Add widgets here.', 'memory' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'memory_widgets_init' );

/**
 * Remove Jetpack sharedaddy
 */
function memory_deregister_sharedaddy() {
	wp_deregister_style( 'sharedaddy' );
}
add_action( 'wp_print_styles', 'memory_deregister_sharedaddy' );

/**
 * Enqueue scripts and styles.
 */
function memory_scripts() {
	wp_enqueue_style( 'icofont', get_template_directory_uri() . '/css/icofont.css', '', '1.0.0' );
	if ( memory_is_amp() ) {
		wp_enqueue_style( 'memory', get_template_directory_uri() . '/style-amp.css', '', '1.1.4' );
	} else {
		wp_enqueue_style( 'memory', get_stylesheet_uri(), '', '1.1.4' );
	}

	if ( ! memory_is_amp() ) {
		wp_enqueue_script( 'memory-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0.0', true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'memory_scripts' );

/**
 * Load Gutenberg stylesheet.
 */
function memory_style_editor_gutenberg() {
	// Load the theme styles within Gutenberg.
	wp_enqueue_style( 'style-editor', get_theme_file_uri( '/style-editor.css' ), '', '1.0.0' );
}
add_action( 'enqueue_block_editor_assets', 'memory_style_editor_gutenberg' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Extras additions.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Require libraries.
 */
require get_template_directory() . '/lib/gt-addons.php';
require get_template_directory() . '/inc/gt-addons.php';

/**
 * Add breadcrumbs
 */
require get_template_directory() . '/inc/breadcrumbs.php';

/**
 * Dashboard.
 */
require get_template_directory() . '/inc/dashboard/class-memory-dashboard.php';
new Memory_Dashboard();

if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Shim for wp_body_open, ensuring backwards compatibility with versions of WordPress older than 5.2.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}
