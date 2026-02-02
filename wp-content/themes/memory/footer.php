<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Memory
 */

?>

</div><!-- #content -->

<?php
$memory_default_image = get_template_directory_uri() . '/images/background-subscription.png';

$memory_footer_subscribe_title = get_theme_mod( 'footer_subscribe_title', __( 'Newsletter Subscription', 'memory' ) );
$memory_footer_subscribe_text  = get_theme_mod( 'footer_subscribe_text', __( 'Enter your email address to subscribe to this blog and receive notifications of new posts by email.', 'memory' ) );
$memory_footer_subscribe       = '[jetpack_subscription_form title="' . esc_html( $memory_footer_subscribe_title ) . '" subscribe_text="' . esc_html( $memory_footer_subscribe_text ) . '" subscribe_button="&#xefb4;"]';
?>

<?php
if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'subscriptions' ) ) :
	?>
	<div class="footer-subscription" style="background-image: url( <?php echo esc_url( $memory_default_image ); ?> )">
		<div class="container">
			<?php echo do_shortcode( $memory_footer_subscribe ); ?>
		</div>
	</div>
<?php endif; ?>

<footer id="colophon" class="site-footer">
	<div class="container">
		<div class="footer-branding">
			<?php
			$memory_ft_show_logo = get_theme_mod( 'ft_show_logo' );

			if ( $memory_ft_show_logo ) {
				the_custom_logo();
			}
			?>

			<h3 class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			</h3>

			<?php
			$memory_description = get_bloginfo( 'description', 'display' );
			if ( $memory_description ) :
				?>
				<div class="site-description">
					<?php echo esc_html( $memory_description ); /* WPCS: xss ok. */ ?>
				</div>
			<?php endif; ?>
		</div><!-- .footer-branding -->

		<?php if ( function_exists( 'jetpack_social_menu' ) ) : ?>
			<?php jetpack_social_menu(); ?>
		<?php endif; ?>

	</div>

	<a href="#" class="scroll-to-top"><?php esc_html_e( 'Back to top', 'memory' ); ?><i class="icofont-rounded-up"></i></a>
	<div class="site-info">

		<div class="container">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'memory' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'memory' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
			<?php
			printf(
				/* translators: %1$s: Theme name, %2$s: Theme author. */
				esc_html__( 'Theme: %1$s by %2$s.', 'memory' ),
				'Memory',
				'<a href="' . esc_url( __( 'https://gretathemes.com/', 'memory' ) ) . '" rel="designer">GretaThemes</a>'
			);
			?>
		</div>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php gt_slideout_sidebar(); ?>

<?php wp_footer(); ?>

</body>
</html>
