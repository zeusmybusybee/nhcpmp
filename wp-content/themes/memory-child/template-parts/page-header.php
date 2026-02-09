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
<style>
    /* Secondary collections menu */
.collections-nav {
  background: #fff;
  border-top: 2px solid #e5e5e5;
}

.collections-nav ul {
  display: flex;
  justify-content: center;
  gap: 50px;
  padding: 16px 0;
  margin: 0;
  list-style: none;
}
.collections-nav a {
    color: #6b4a1f;
    text-decoration: none;
    position: relative;
    padding-bottom: 6px;
    transition: color 0.2s ease;
    font-size: 19px;
    font-weight: 400;
}

.collections-nav a:hover {
  color: #3f2a12;
}

.collections-nav a.active {
  font-weight: 600;
  color: #3f2a12;
}

.collections-nav a.active::after {
  content: "";
  position: absolute;
  left: 0;
  bottom: 0;
  width: 100%;
  height: 2px;
  background: #6b4a1f;
}

/* Mobile */
@media (max-width: 768px) {
  .collections-nav ul {
    overflow-x: auto;
    justify-content: flex-start;
    gap: 24px;
    padding: 12px 16px;
    white-space: nowrap;
  }
}

</style>


<?php if ( is_post_type_archive('book') ) : ?>

<nav class="collections-nav">
  <div class="container">
    <?php
      wp_nav_menu([
        'menu'        => 'Auxiliary Menu',
        'container'      => false,
        'menu_class'     => 'nav justify-content-center py-3',
        'menu_id'        => false,
        'fallback_cb'    => false,
        'add_li_class'   => 'nav-item', // (see note below)
        'link_class'     => 'nav-link', // (see note below)
      ]);
    ?>
  </div>
</nav>

<?php endif; ?>

<div class="page-header">
	<div class="container">
		<div class="header-inner">
			<?php memory_breadcrumbs(); ?>
		</div>
	</div>
</div>

