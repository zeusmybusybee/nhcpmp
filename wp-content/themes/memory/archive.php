<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package memory
 */

get_header();

$memory_blog_style = get_theme_mod( 'blog_style', 'grid' );

// Grid.
if ( 'grid' === $memory_blog_style ) {
	get_template_part( 'template-parts/blog/grid-two-column-sidebar' );
} else {
	get_template_part( 'template-parts/blog/list' );
}

get_footer();
