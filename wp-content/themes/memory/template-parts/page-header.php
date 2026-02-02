<?php
/**
 * Display page header.
 *
 * @package memory
 */

if ( is_front_page() ) {
	return;
}
?>

<div class="page-header">
	<div class="container">
		<div class="header-inner">
			<?php memory_breadcrumbs(); ?>
		</div>
	</div>
</div>
