<?php
/**
 * Search form modal.
 *
 * @package Gt Addons
 */

/**
 * Add search form modal.
 */
function gt_searchform_modal() {
	?>

<div class="header__search">
	<a
		href="#" class="search-toggle"
		role="button" tabindex="0"
		<?php if ( memory_is_amp() ) : ?>
			on="tap:page.toggleClass( class='gt-search-active' )"
		<?php endif; ?>
	><i class="fa fa-search"></i></a>

	<div class="search-popup">
		<div
			class="search-popup-bg"
			role="button"
			tabindex="0"
			<?php if ( memory_is_amp() ) : ?>
				on="tap:page.toggleClass( class='gt-search-active', force=false )"
			<?php endif; ?>
		></div>

		<?php get_search_form(); ?>
	</div>
</div>

	<?php
}
