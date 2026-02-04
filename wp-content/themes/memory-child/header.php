<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Memory
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">


	<?php wp_head(); ?>
</head>
<style>
	.site-header{
		display: block;
	}
	.site-branding {
    width: 20%;
    text-align: left;
}
.header-top .container {
    align-items: center;
}
nav#site-navigation {
    width: 70%;
}
.header-top:before {
	display:none;
}
.menu-search-form {
    position: relative;
    display: inline-block;
}

.menu-search-form input[type="search"] {
    padding: 5px 40px 5px 15px; /* extra space sa right para sa icon */
    border: 2px solid #8b5e3c;
    border-radius: 25px;
    outline: none;
    font-size: 14px;
    width: 420px;
}

.menu-search-form input[type="search"]:focus {
    border-color: #5a3d2a;
}

/* Button icon sa loob ng input */
.menu-search-form button {
    position: absolute;
    right: 5px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    font-size: 16px;
    color: #8b5e3c;
}

.menu-search-form button:focus {
    outline: none;
}
h1, h2, h3 {
 font-family: 'Manrope', sans-serif;
  font-weight: 600;
}
</style>
<?php $body_class = array_values( get_body_class() ); ?>
<body
	class="<?php echo esc_attr( implode( ' ', $body_class ) ); ?>"
	data-amp-bind-class="<?php echo esc_attr( sprintf( 'navMenuToggledOn ? %1$s.concat( "slideout-sidebar-open" ) : %1$s', wp_json_encode( $body_class ) ) ); ?>"
>
<?php wp_body_open(); ?>
	<div id="page" class="site">
		<span
			class="page-overlay"
			role="button"
			tabindex="-1"
			<?php if ( memory_is_amp() ) : ?>
				on="tap:AMP.setState({navMenuToggledOn: false})"
			<?php endif; ?>
		></span>
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'memory' ); ?></a>
		<header id="masthead" class="site-header">
			<div id="header-top" class="header-top is-sticky">
			<div class="container">

				<!-- LOGO (LEFT) -->
				<div class="site-branding">
				<a href="<?php echo home_url(); ?>">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Site Logo">
				</a>
				</div>

				<!-- MENU (RIGHT) -->
				<nav id="site-navigation" class="main-navigation">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
							)
						);
						?>
					</nav><!-- #site-navigation -->

			</div>
			</div>

			</div>

		</header><!-- #masthead -->

<?php
// Display featured posts and header subscription on the homepage.
if ( is_front_page() ) :

	if ( memory_is_amp() ) {
		get_template_part( 'template-parts/slider/slider-amp' );
	} else {
		get_template_part( 'template-parts/slider/slider-1' );
	}

	$memory_header_subscribe_text   = get_theme_mod( 'subscribe_text', __( 'Subscribe to our newsletter and get latest news and updates!', 'memory' ) );
	$memory_header_subscribe_button = get_theme_mod( 'subscribe_button', __( 'Subscribe', 'memory' ) );
	$memory_header_subscribe        = '[jetpack_subscription_form subscribe_text="' . esc_html( $memory_header_subscribe_text ) . '" subscribe_button="' . esc_html( $memory_header_subscribe_button ) . '"]';
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'subscriptions' ) ) :
		?>
		<div class="header-subscription" >
			<div class="container">
				<?php
				echo do_shortcode( $memory_header_subscribe );
				?>
			</div>
		</div>
	<?php endif; ?>

<?php endif; ?>

<?php get_template_part( 'template-parts/page-header' ); ?>

<?php if ( is_home() || is_search() || is_archive() ) : ?>
	<div id="content" class="site-content">
<?php else : ?>
	<div id="content" class="site-content container">
<?php endif; ?>
