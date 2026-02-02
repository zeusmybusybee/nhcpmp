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

	<?php wp_head(); ?>
</head>

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

			<div id="header-top" class="header-top">
				<div class="container">

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

					<?php gt_searchform_modal(); ?>

					<button id="site-navigation-open" class="menu-toggle" aria-controls="sidebar-menu" aria-expanded="false">
						<span class="menu-text"><?php esc_html_e( 'Menu', 'memory' ); ?></span>
					</button>
				</div>
			</div>
			<div class="header-branding">
				<div class="site-branding">

				<?php the_custom_logo(); ?>

				<?php if ( is_front_page() ) : ?>
					<h1 class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</h1>
				<?php else : ?>
					<h3 class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</h3>
				<?php endif; ?>

					<?php
					$memory_description = get_bloginfo( 'description', 'display' );
					if ( $memory_description ) :
						?>
					<div class="site-description">
						<?php echo esc_html( $memory_description ); /* WPCS: xss ok. */ ?>
					</div>
					<?php endif; ?>
				</div><!-- .site-branding -->

				<?php if ( function_exists( 'jetpack_social_menu' ) ) : ?>
					<?php jetpack_social_menu(); ?>
				<?php endif; ?>
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
