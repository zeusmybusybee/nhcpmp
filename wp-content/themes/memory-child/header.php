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
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>




	<?php wp_head(); ?>
</head>
<?php $body_class = array_values(get_body_class()); ?>

<body
	class="<?php echo esc_attr(implode(' ', $body_class)); ?>"
	data-amp-bind-class="<?php echo esc_attr(sprintf('navMenuToggledOn ? %1$s.concat( "slideout-sidebar-open" ) : %1$s', wp_json_encode($body_class))); ?>">
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<span
			class="page-overlay"
			role="button"
			tabindex="-1"
			<?php if (memory_is_amp()) : ?>
			on="tap:AMP.setState({navMenuToggledOn: false})"
			<?php endif; ?>></span>
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'memory'); ?></a>
		<header id="masthead" class="site-header">
			<div id="header-top" class="">
				<div class="container">




					<!-- end of mobile toggle -->
					<div class="d-flex align-items-center justify-content-between pt-4 pb-2">

						<!-- LOGO (LEFT) -->
						<!-- LOGO (LEFT) -->
						<div class="site-branding">
							<a href="<?php echo esc_url(home_url('/')); ?>" class="d-inline-block">
								<?php
								if (function_exists('the_custom_logo') && has_custom_logo()) {
									the_custom_logo();
								} else {
									bloginfo('name'); // fallback kung walang logo
								}
								?>
							</a>
						</div>

						<!-- MENU (RIGHT) -->
						<nav id="site-navigation" class="main-navigation  section-hide">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu',
								)
							);
							?>
						</nav>

						<div class="section-hide"><?php echo do_shortcode('[menu_search]'); ?></div>
						<!-- mobile toggle -->
						<button id="toggleBtn" class="btn  m-3"><i class="fa-solid fa-bars"></i></button>

						<!-- Sidebar -->
						<div id="sidebar">
							<!-- Close button sa top-right -->
							<button id="closeBtn" class="btn btn-light btn-sm position-absolute top-0 end-0 m-2">&times;</button>
							<?php echo do_shortcode('[menu_search]'); ?>
							<nav id="site-navigation" class="main-navigation">
								<?php
								wp_nav_menu(
									array(
										'theme_location' => 'menu-1',
										'menu_id'        => 'primary-menu',
									)
								);
								?>
							</nav>
						</div>

						<!-- Overlay -->
						<div id="overlay"></div>
					</div>
				</div>
			</div>
		</header>


		<?php
		// Display featured posts and header subscription on the homepage.
		if (is_front_page()) :

			if (memory_is_amp()) {
				get_template_part('template-parts/slider/slider-amp');
			} else {
				get_template_part('template-parts/slider/slider-1');
			}

			$memory_header_subscribe_text   = get_theme_mod('subscribe_text', __('Subscribe to our newsletter and get latest news and updates!', 'memory'));
			$memory_header_subscribe_button = get_theme_mod('subscribe_button', __('Subscribe', 'memory'));
			$memory_header_subscribe        = '[jetpack_subscription_form subscribe_text="' . esc_html($memory_header_subscribe_text) . '" subscribe_button="' . esc_html($memory_header_subscribe_button) . '"]';
			if (class_exists('Jetpack')) :
		?>
				<div class="header-subscription">
					<div class="container">
						<?php
						echo do_shortcode($memory_header_subscribe);
						?>
					</div>
				</div>
			<?php endif; ?>

		<?php endif; ?>

		<?php
		$special_post_types = array('featured-collections', 'local-history', 'contributed', 'revolution', 'women-in-philippines', 'philippine-muslim', 'nhcp-publications', 'rizal-collection');

		// Single post
		$pt = get_post_type();

		// Archive page
		if (is_post_type_archive()) {
			$pt = get_query_var('post_type');
		}

		// Check
		if (in_array($pt, $special_post_types)) {
			get_template_part('template-parts/page-header-collection');
		} else {
			get_template_part('template-parts/page-header');
		}
		?>
		<?php if (is_home() || is_search() || is_archive()) : ?>
			<div id="content" class="site-content">
			<?php else : ?>
				<div id="content" class="site-content">
				<?php endif; ?>

				<script>
					const toggleBtn = document.getElementById('toggleBtn');
					const sidebar = document.getElementById('sidebar');
					const overlay = document.getElementById('overlay');
					const closeBtn = document.getElementById('closeBtn');

					toggleBtn.addEventListener('click', () => {
						sidebar.classList.toggle('show');
						overlay.classList.toggle('show');
					});

					overlay.addEventListener('click', () => {
						sidebar.classList.remove('show');
						overlay.classList.remove('show');
					});

					closeBtn.addEventListener('click', () => {
						sidebar.classList.remove('show');
						overlay.classList.remove('show');
					});
				</script>