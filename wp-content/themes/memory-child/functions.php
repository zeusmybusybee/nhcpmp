<?php
// Shortcode para sa menu search
function my_menu_search_shortcode()
{
    ob_start();
?>
    <form role="search" method="get" class="menu-search-form" action="<?php echo home_url('/'); ?>">
        <input type="search" name="s" placeholder="Search the National Memory Project" />
        <button type="submit" aria-label="Search"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
<?php
    return ob_get_clean();
}
add_shortcode('menu_search', 'my_menu_search_shortcode');

// Enable shortcode sa menu items
add_filter('wp_nav_menu_items', 'do_shortcode');

//link css
// Enqueue footer CSS for child theme
function memory_child_footer_styles()
{
    // Make sure this runs only on the front-end
    if (! is_admin()) {
        wp_enqueue_style(
            'memory-child-footer', // Handle
            get_stylesheet_directory_uri() . '/assets/css/footer.css', // Path to your CSS file
            array(), // Dependencies
            '1.0' // Version
        );
    }
}
add_action('wp_enqueue_scripts', 'memory_child_footer_styles');
//links script footer
function custom_footer_script()
{
    // Only load on the front-end
    if (!is_admin()) {
        wp_enqueue_script(
            'script', // Handle
            get_stylesheet_directory_uri() . '/assets/js/script.js', // Path to your JS file
            array(), // Dependencies (like 'jquery')
            '1.0', // Version
            true // Load in footer
        );
    }
}
add_action('wp_enqueue_scripts', 'custom_footer_script');

// bootstrap 
function enqueue_bootstrap()
{
    // Bootstrap CSS
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', array(), '5.3.2');

    // Optional: Your theme's main CSS should load after Bootstrap
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri(), array('bootstrap-css'));

    // Bootstrap JS Bundle (includes Popper)
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.2', true);
}
add_action('wp_enqueue_scripts', 'enqueue_bootstrap');

// fontawesome 
function enqueue_fontawesome()
{
    // Font Awesome CSS
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css', array(), '6.4.2');
}
add_action('wp_enqueue_scripts', 'enqueue_fontawesome');

//footer menu 
function register_footer_menu() {
    register_nav_menu('footer-menu', __('Footer Menu'));
}
add_action('after_setup_theme', 'register_footer_menu');
