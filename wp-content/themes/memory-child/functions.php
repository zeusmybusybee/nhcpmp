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

//link footer css
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
//link archives css
function memory_child_archives_styles()
{
    // Make sure this runs only on the front-end
    if (! is_admin()) {
        wp_enqueue_style(
            'memory-child-archives', // Handle
            get_stylesheet_directory_uri() . '/assets/css/archives.css', // Path to your CSS file
            array(), // Dependencies
            '1.0' // Version
        );
    }
}
add_action('wp_enqueue_scripts', 'memory_child_archives_styles');
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

add_action('wp_enqueue_scripts', 'memory_child_front_page_styles');
//link front-page css
function memory_child_front_page_styles()
{
    // Make sure this runs only on the front-end
    if (! is_admin()) {
        wp_enqueue_style(
            'memory-front-page', // Handle
            get_stylesheet_directory_uri() . '/assets/css/front-page.css', // Path to your CSS file
            array(), // Dependencies
            '1.0' // Version
        );
    }
}

add_action('wp_enqueue_scripts', 'memory_child_contact_page_styles');
//link front-page css
function memory_child_contact_page_styles()
{
    // Make sure this runs only on the front-end
    if (! is_admin()) {
        wp_enqueue_style(
            'memory-contact-page', // Handle
            get_stylesheet_directory_uri() . '/assets/css/contact.css', // Path to your CSS file
            array(), // Dependencies
            '1.0' // Version
        );
    }
}

add_action('wp_enqueue_scripts', 'memory_child_pages_page_styles');
//link front-page css
function memory_child_pages_page_styles()
{
    // Make sure this runs only on the front-end
    if (! is_admin()) {
        wp_enqueue_style(
            'memory_child_pages_page_styles', // Handle
            get_stylesheet_directory_uri() . '/assets/css/pages.css', // Path to your CSS file
            array(), // Dependencies
            '1.0' // Version
        );
    }
}

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
function register_footer_menu()
{
    register_nav_menu('footer-menu', __('Footer Menu'));
}
add_action('after_setup_theme', 'register_footer_menu');

// filter function 
add_action('pre_get_posts', function ($query) {

    // Frontend only
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    // ONLY archive-articles
    if (!is_post_type_archive('articles')) {
        return;
    }

    /* SORTING */
    if (!empty($_GET['orderby'])) {

        switch ($_GET['orderby']) {
            case 'title':
                $query->set('orderby', 'title');
                $query->set('order', 'ASC');
                break;

            case 'date':
                $query->set('orderby', 'date');
                $query->set('order', 'DESC');
                break;

            case 'date-asc':
                $query->set('orderby', 'date');
                $query->set('order', 'ASC');
                break;
        }
    }

    /* FILTERING */
    if (!empty($_GET['filter']) && !empty($_GET['s'])) {

        switch ($_GET['filter']) {

            case 'title':
                $query->set('search_columns', ['post_title']);
                break;

            case 'author':
                $query->set('search_columns', ['post_author']);
                break;

            case 'keyword':
                $query->set('search_columns', ['post_title', 'post_content']);
                break;

            case 'year':
                if (is_numeric($_GET['s'])) {
                    $query->set('date_query', [
                        [
                            'year' => intval($_GET['s']),
                        ]
                    ]);
                }
                break;

            case 'publisher':
                // Example ACF field
                $query->set('meta_query', [
                    [
                        'key'     => 'publisher',
                        'value'   => sanitize_text_field($_GET['s']),
                        'compare' => 'LIKE',
                    ]
                ]);
                break;
        }
    }
});
// for filtering access in books
add_action('pre_get_posts', function ($query) {

    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    // Only Book archive
    if (!is_post_type_archive('book')) {
        return;
    }

    $meta_query = [];

    if (!empty($_GET['level_of_access'])) {
        $meta_query[] = [
            'key'   => 'level_of_access',
            'value' => sanitize_text_field($_GET['level_of_access']),
        ];
    }

    if (!empty($_GET['availability'])) {
        $meta_query[] = [
            'key'   => 'availability',
            'value' => sanitize_text_field($_GET['availability']),
        ];
    }

    if (!empty($meta_query)) {
        $query->set('meta_query', $meta_query);
    }
    if (!empty($_GET['orderby'])) {

        switch ($_GET['orderby']) {

            case 'title-asc':
                $query->set('orderby', 'title');
                $query->set('order', 'ASC');
                break;

            case 'title-desc':
                $query->set('orderby', 'title');
                $query->set('order', 'DESC');
                break;

            case 'date-asc':
                $query->set('orderby', 'date');
                $query->set('order', 'ASC');
                break;

            case 'date-desc':
                $query->set('orderby', 'date');
                $query->set('order', 'DESC');
                break;

            case 'relevance':
            default:
                // WordPress default relevance (only applies when searching)
                if ($query->is_search()) {
                    $query->set('orderby', 'relevance');
                }
                break;
        }
    }
});
// search by meta fields 
add_filter('posts_search', function ($search, $query) {
    global $wpdb;

    if (
        is_admin() ||
        !$query->is_main_query() ||
        !$query->is_search() ||
        !is_post_type_archive('book')
    ) {
        return $search;
    }

    $search_term = $query->get('s');

    if (empty($search_term)) {
        return $search;
    }

    $like = '%' . $wpdb->esc_like($search_term) . '%';

    // Meta fields to search
    $meta_keys = [
        'call_number',
        'location',
        'level_of_access',
        'availability',
        'book_type',
        'year', // only if you store year as ACF
    ];

    $meta_search_sql = [];

    foreach ($meta_keys as $key) {
        $meta_search_sql[] = $wpdb->prepare(
            "(pm.meta_key = %s AND pm.meta_value LIKE %s)",
            $key,
            $like
        );
    }

    $meta_search_sql = implode(' OR ', $meta_search_sql);

    // Extend default search (title/content) with meta search
    $search = "
        AND (
            {$wpdb->posts}.post_title LIKE %s
            OR {$wpdb->posts}.post_content LIKE %s
            OR {$wpdb->posts}.ID IN (
                SELECT pm.post_id
                FROM {$wpdb->postmeta} pm
                WHERE {$meta_search_sql}
            )
        )
    ";

    return $wpdb->prepare($search, $like, $like);
}, 10, 2);



// Force 404 on empty search results for Articles & Books archives
function articles_books_search_404()
{
    if (
        ! is_admin() &&
        is_search() &&
        is_main_query() &&
        is_post_type_archive(['articles', 'book'])
    ) {
        global $wp_query;

        if (! $wp_query->have_posts()) {
            $wp_query->set_404();
            status_header(404);
            nocache_headers();
        }
    }
}
add_action('template_redirect', 'articles_books_search_404');

