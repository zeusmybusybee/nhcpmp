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
	h1 {
  font-size: 48px; /* 2.25rem */
}
nav#site-navigation {
    width: unset;
}
.main-navigation {
    flex: unset;
}
.site-branding img {
    filter: sepia(1) saturate(5) hue-rotate(20deg);
    width: 100%;
    max-width: 424px;
    height: auto;
}
.header-top .container {
    align-items: center;
    justify-content: space-between;
}
.main-navigation li a {
    font-size: 18px;
    text-transform: none;
    font-weight: 400;
    margin: 0 34px;
}
h2 {
  font-size: 44px; /* 1.875rem */
}
.site-branding {
    width: auto;
    text-align: left;
}
.hero p {
    line-height: 1.6;
    margin-bottom: 1.75rem;
    width: 80%;
    margin: 30px  auto 40px;
}
.home .search-box {
    display: flex;
    border: 1px solid var(--brown);
    border-radius: 4px;
    overflow: hidden;
    width: 70%;
    margin: auto;
}
.hero-inner h1{
font-weight: 500;
}
.home div#content {
    background: #F7F7F7;
}
.card {
    background: #f2f2f2;
    border-radius: 8px;
    padding: 4rem 3rem 1rem;
    position: relative;
    overflow: hidden;
}
/* title color */
.navy h3 { color: #2c2f6c; }
.red h3 { color: #c7373f; }
.purple h3 { color: #8e2f8f; }
.green h3{ color: #4f7f3f; }
.teal h3 { color: #1fa3a3; }
.orange h3 { color: #d87434; }
.darkgreen h3 { color: #0f5c2e; }
.gold h3 { color: #c7ad2a; }

input[type=submit]:hover, button[type=submit]:hover {
    background: unset;
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
					<img src="http://localhost/nhcpmp/wp-content/uploads/2026/02/nmp-logo.png" alt="Site Logo">
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

				<?php echo do_shortcode('[menu_search]'); ?>


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
	<div id="content" class="site-content">
<?php endif; ?>
