<?php
// Shortcode para sa menu search
function my_menu_search_shortcode() {
    ob_start();
    ?>
    <form role="search" method="get" class="menu-search-form" action="<?php echo home_url('/'); ?>">
        <input type="search" name="s" placeholder="Search the National Memory Project" />
        <button type="submit" aria-label="Search">🔍</button>
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('menu_search', 'my_menu_search_shortcode');

// Enable shortcode sa menu items
add_filter('wp_nav_menu_items', 'do_shortcode');
