<?php
/**
 * The template for displaying all layout posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Memory
 */

get_header();
?>
<div class="main-content">
	<?php

	get_template_part( 'template-parts/single/default' );

	get_sidebar();
	?>
</div>
<?php
get_footer();
