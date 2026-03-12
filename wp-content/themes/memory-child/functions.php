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

function custom_login_redirect($redirect_to, $request, $user)
{

    if (isset($user->roles) && is_array($user->roles)) {

        // roles na gusto mong i-redirect sa custom dashboard
        $allowed_roles = array('archiving', 'library');

        if (array_intersect($allowed_roles, $user->roles)) {
            return home_url('/dashboard');
        }

        // kung admin o ibang role
        return admin_url();
    }

    return home_url('/login?login=failed');
}

add_filter('login_redirect', 'custom_login_redirect', 10, 3);

// Redirect wp-admin to /login for non-logged-in users
function redirect_wp_admin_to_login()
{
    if (!is_user_logged_in() && strpos($_SERVER['REQUEST_URI'], '/wp-admin') !== false) {
        wp_redirect(home_url('/login')); // Redirect to /login page
        exit;
    }
}
add_action('init', 'redirect_wp_admin_to_login');

function custom_login_failed()
{
    wp_redirect(home_url('/login?login=failed'));
    exit;
}
add_action('wp_login_failed', 'custom_login_failed');

function custom_admin_css()
{
    echo '<style>
        .d-none { display: none !important; }
    </style>';
}
add_action('admin_head', 'custom_admin_css');

function hide_menu_for_level_users()
{

    if (current_user_can('level_3_user') || current_user_can('level_4_user')) {
        echo '<style>
        #menu-posts-articles,#menu-posts-artifacts,#menu-posts-foundation-of-towns,#menu-posts-contact-us,
        #menu-posts-featured-collections,#menu-posts-a-v-material,#menu-posts-local-history,#menu-posts-historical-sites,
        #menu-posts-ph-heraldry-registry,#menu-posts-serial,#menu-posts-video-recording,#menu-dashboard
        { display:none !important; }
        </style>';
    }
}
add_action('admin_head', 'hide_menu_for_level_users');


// Enable shortcode sa menu items
add_filter('wp_nav_menu_items', 'do_shortcode');

function load_select2_assets()
{
    wp_enqueue_style(
        'select2-css',
        'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
    );

    wp_enqueue_script('jquery');

    wp_enqueue_script(
        'select2-js',
        'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
        array('jquery'),
        null,
        true // 👈 footer
    );
}
add_action('wp_enqueue_scripts', 'load_select2_assets');


function memory_enqueue_role_styles()
{

    if (is_user_logged_in()) {

        $user = wp_get_current_user();
        $roles = (array) $user->roles;

        if (in_array('library', $roles) || in_array('archiving', $roles)) {

            wp_enqueue_style(
                'memory-style',
                get_stylesheet_directory_uri() . '/assets/css/style.css',
                array(),
                filemtime(get_stylesheet_directory() . '/assets/css/style.css')
            );

            // JavaScript
            wp_enqueue_script(
                'script', // Handle
                get_stylesheet_directory_uri() . '/assets/js/script-library.js', // Path to your JS file
                array(), // Dependencies (like 'jquery')
                '1.0', // Version
                true // Load in footer
            );
        }
    }
}

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

function enqueue_place_api_for_foundation()
{

    $post_types = array('foundation-of-towns', 'ph-heraldry-registry');

    if (is_post_type_archive($post_types) || is_singular($post_types)) {

        wp_enqueue_script(
            'place-api',
            get_stylesheet_directory_uri() . '/assets/js/place-api.js',
            array(),
            '1.0',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'enqueue_place_api_for_foundation');




add_action('acf/input/admin_enqueue_scripts', function () {
    $post_types = array('foundation-of-towns', 'ph-heraldry-registry');
    if (is_post_type_archive($post_types) || is_singular($post_types)) {
        wp_enqueue_script(
            'acf-location-script',
            get_stylesheet_directory_uri() . '/assets/js/acf-location.js',
            ['jquery'],
            '1.0',
            true
        );

        wp_localize_script('acf-location-script', 'acfLocation', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'proxy'    => get_stylesheet_directory_uri() . '/ph-proxy.php'
        ]);
    }
});

// Populate province choices dynamically
add_filter('acf/load_field/name=province', function ($field) {

    $selected_region = null;

    // If form is being submitted
    if (isset($_POST['acf'])) {
        $selected_region = $_POST['acf']['field_698c19c39f79b'] ?? null; // your region field key
    }

    // Fallback when editing existing post
    if (!$selected_region && isset($_GET['post'])) {
        $selected_region = get_field('region', $_GET['post']);
    }

    if (!$selected_region) return $field;

    $response = wp_remote_get(get_stylesheet_directory_uri() . '/ph-proxy.php?endpoint=provinces');

    if (is_wp_error($response)) return $field;

    $body = json_decode(wp_remote_retrieve_body($response), true);

    $field['choices'] = [];

    if (!empty($body['data'])) {
        foreach ($body['data'] as $province) {
            if ($province['region_code'] == $selected_region) {
                $field['choices'][$province['psgc_code']] = $province['name'];
            }
        }
    }

    return $field;
});

// Save selected province name into a hidden field
add_action('acf/save_post', function ($post_id) {

    // Avoid autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    $acf = $_POST['acf'] ?? [];

    // Check if province field is submitted
    if (isset($acf['field_698c19c39f79b'])) { // replace with your province field key
        $selected_province_code = $acf['field_698c19c39f79b'];

        // Get province list from ph-proxy
        $response = wp_remote_get(get_stylesheet_directory_uri() . '/ph-proxy.php?endpoint=provinces');
        if (!is_wp_error($response)) {
            $body = json_decode(wp_remote_retrieve_body($response), true);
            $province_name = '';

            if (!empty($body['data'])) {
                foreach ($body['data'] as $province) {
                    if ($province['psgc_code'] == $selected_province_code) {
                        $province_name = $province['name'];
                        break;
                    }
                }
            }

            // Update hidden field with province name
            if ($province_name) {
                update_field('province_text', $province_name, $post_id); // your hidden field
            }
        }
    }
}, 20);


add_filter('acf/load_field/name=region', function ($field) {

    $response = wp_remote_get(get_stylesheet_directory_uri() . '/ph-proxy.php?endpoint=regions');

    if (is_wp_error($response)) return $field;

    $body = json_decode(wp_remote_retrieve_body($response), true);

    $field['choices'] = [];

    if (!empty($body['data'])) {
        foreach ($body['data'] as $region) {
            $field['choices'][$region['psgc_code']] = $region['name'];
        }
    }

    return $field;
});




// Populate city choices dynamically (your existing code)
add_filter('acf/load_field/name=city', function ($field) {

    $selected_province = null;

    // During save
    if (isset($_POST['acf'])) {
        $selected_province = $_POST['acf']['field_698c19ca9f79c'] ?? null;
    }

    // When editing existing post
    if (!$selected_province && isset($_GET['post'])) {
        $selected_province = get_field('province', $_GET['post']);
    }

    if (!$selected_province) return $field;

    $response = wp_remote_get(get_stylesheet_directory_uri() . '/ph-proxy.php?endpoint=localities');

    if (is_wp_error($response)) return $field;

    $body = json_decode(wp_remote_retrieve_body($response), true);

    $field['choices'] = [];

    if (!empty($body['data'])) {
        foreach ($body['data'] as $city) {
            if ($city['province_code'] == $selected_province) {
                $field['choices'][$city['psgc_code']] = $city['name'];
            }
        }
    }

    return $field;
});

// Save the city name to hidden field "city_text"
add_action('acf/save_post', function ($post_id) {

    // Make sure we are not in autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // Get submitted ACF values
    $acf = $_POST['acf'] ?? [];

    // Check if city field is set
    if (isset($acf['field_698c19ca9f79c'])) { // replace with your actual city field key
        $selected_city_code = $acf['field_698c19ca9f79c'];

        // Get the city name from your ph-proxy.php or from $_POST choices
        $response = wp_remote_get(get_stylesheet_directory_uri() . '/ph-proxy.php?endpoint=localities');
        if (!is_wp_error($response)) {
            $body = json_decode(wp_remote_retrieve_body($response), true);
            $city_name = '';

            if (!empty($body['data'])) {
                foreach ($body['data'] as $city) {
                    if ($city['psgc_code'] == $selected_city_code) {
                        $city_name = $city['name'];
                        break;
                    }
                }
            }

            // Update hidden field
            if ($city_name) {
                update_field('city_text', $city_name, $post_id);
            }
        }
    }
}, 20);



// foundation-of-towns admin select option

// Add class to <li>
add_filter('nav_menu_css_class', function ($classes, $item, $args) {
    if ($args->theme_location === 'auxiliary_menu') {
        $classes[] = 'nav-item';
    }
    return $classes;
}, 10, 3);

// Add class to <a>
add_filter('nav_menu_link_attributes', function ($atts, $item, $args) {
    if ($args->theme_location === 'auxiliary_menu') {
        $atts['class'] = 'nav-link';
    }
    return $atts;
}, 10, 3);


add_action('pre_get_posts', function ($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('artifacts')) {

        $per_page = isset($_GET['per_page']) ? (int) $_GET['per_page'] : 10;
        $query->set('posts_per_page', $per_page);
    }
});

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

// filter function  article
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

    if (!empty($_GET['level'])) {
        $meta_query[] = [
            'key'   => 'level',
            'value' => sanitize_text_field($_GET['level']),
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

add_action('pre_get_posts', function ($query) {

    if (!is_admin() && $query->is_main_query() && $query->is_search()) {

        // All library post types
        $library_post_types = [
            'serial',
            'video-recording',
            'a-v-material',
            'audio-visual',
            'books-manuscript',
            'academic-courseworks',
            'audio-recordings',
            'e-resources',
            'website'
        ];

        $post_type = $query->get('post_type');

        if ($post_type === 'book') {
            // Books archive search → only books
            $query->set('post_type', 'book');
        } elseif (empty($post_type)) {
            // Global search → all library post types
            $query->set('post_type', $library_post_types);
        }
        // Else → keep other post types as is
    }

});
add_filter('posts_search', function ($search, $query) {
    global $wpdb;

    if (is_admin() || !$query->is_main_query() || !$query->is_search()) {
        return $search;
    }

    $post_types = (array) $query->get('post_type');
    if (empty($post_types)) {
        return $search;
    }

    $search_term = $query->get('s');
    if (empty($search_term)) {
        return $search;
    }

    $like = '%' . $wpdb->esc_like($search_term) . '%';

    $meta_keys = [
        'call_number',
        'location',
        'level',
        'availability',
        'book_type',
        'year'
    ];

    $meta_conditions = [];
    foreach ($meta_keys as $key) {
        $meta_conditions[] = $wpdb->prepare(
            "(pm.meta_key = %s AND pm.meta_value LIKE %s)",
            $key,
            $like
        );
    }

    $meta_sql = implode(' OR ', $meta_conditions);

    $search .= " OR {$wpdb->posts}.ID IN (
        SELECT pm.post_id
        FROM {$wpdb->postmeta} pm
        WHERE {$meta_sql}
    )";

    return $search;
}, 10, 2);

// Filtering ph-heraldry-registry CPT
function ph_heraldry_registry_filters($query)
{
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    if (is_post_type_archive('ph-heraldry-registry')) {

        $meta_query = [];

        // HERALDRIC ITEMS (ACF checkbox field)
        if (!empty($_GET['heraldric_items'])) {
            $heraldric_items = array_map('sanitize_text_field', (array) $_GET['heraldric_items']);
            $heraldric_query = ['relation' => 'OR'];
            foreach ($heraldric_items as $item) {
                $heraldric_query[] = [
                    'key'     => 'heraldric_items', // ACF field name
                    'value'   => '"' . $item . '"', // Quote for serialized array match
                    'compare' => 'LIKE',
                ];
            }
            $meta_query[] = $heraldric_query;
        }

        // SEALS / LOGOS (ACF checkbox field)
        if (!empty($_GET['seals_logos'])) {
            $seals_logos = array_map('sanitize_text_field', (array) $_GET['seals_logos']);
            $seals_query = ['relation' => 'OR'];
            foreach ($seals_logos as $seal) {
                $seals_query[] = [
                    'key'     => 'seals_logos', // ACF field name
                    'value'   => '"' . $seal . '"',
                    'compare' => 'LIKE',
                ];
            }
            $meta_query[] = $seals_query;
        }
        // REGION
        if (!empty($_GET['region'])) {
            $meta_query[] = [
                'key'     => 'region',
                'value'   => sanitize_text_field($_GET['region']),
                'compare' => '='
            ];
        }

        // PROVINCE
        if (!empty($_GET['province'])) {
            $meta_query[] = [
                'key'     => 'province',
                'value'   => sanitize_text_field($_GET['province']),
                'compare' => '='
            ];
        }

        // CITY / MUNICIPALITY
        if (!empty($_GET['city'])) {
            $meta_query[] = [
                'key'     => 'city',
                'value'   => sanitize_text_field($_GET['city']),
                'compare' => '='
            ];
        }

        if (!empty($meta_query)) {
            $query->set('meta_query', $meta_query);
        }

        // SEARCH
        if (!empty($_GET['s'])) {
            $query->set('s', sanitize_text_field($_GET['s']));
        }

        // SORTING
        if (!empty($_GET['sort_by'])) {
            switch ($_GET['sort_by']) {
                case 'az':
                    $query->set('orderby', 'title');
                    $query->set('order', 'ASC');
                    break;
                case 'za':
                    $query->set('orderby', 'title');
                    $query->set('order', 'DESC');
                    break;
                case 'newest':
                    $query->set('orderby', 'date');
                    $query->set('order', 'DESC');
                    break;
                case 'oldest':
                    $query->set('orderby', 'date');
                    $query->set('order', 'ASC');
                    break;
                case 'relevant':
                default:
                    $query->set('orderby', 'relevance'); // optional, default WP search
                    break;
            }
        }
    }
}
add_action('pre_get_posts', 'ph_heraldry_registry_filters');

// filter function historical sites
function ph_historical_sites_filters($query)
{
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    if (is_post_type_archive('historical-sites')) {

        $meta_query = [];
        $tax_query  = [];

        // FILTER: Status (taxonomy)
        if (!empty($_GET['level_status'])) {
            $status = sanitize_text_field($_GET['level_status']);
            $tax_query[] = [
                'taxonomy' => 'level_status',
                'field'    => 'slug',
                'terms'    => $status,
            ];
        }

        // FILTER: Marker Category (taxonomy)
        if (!empty($_GET['registry_category'])) {
            $marker_category = sanitize_text_field($_GET['registry_category']);
            $tax_query[] = [
                'taxonomy' => 'registry_category',
                'field'    => 'slug',
                'terms'    => $marker_category,
            ];
        }
        // REGION (taxonomy)
        if (!empty($_GET['region'])) {
            $region = sanitize_text_field($_GET['region']);

            $tax_query[] = [
                'taxonomy' => 'regions',
                'field'    => 'slug',
                'terms'    => $region,
            ];
        }

        // PROVINCE (taxonomy)
        if (!empty($_GET['province'])) {
            $province = sanitize_text_field($_GET['province']);

            $tax_query[] = [
                'taxonomy' => 'provinces',
                'field'    => 'slug',
                'terms'    => $province,
            ];
        }
        // TYPE (meta)
        if (!empty($_GET['type'])) {
            $type = sanitize_text_field($_GET['type']);
            $meta_query[] = [
                'key'     => 'type',
                'value'   => $type,
                'compare' => '=',
            ];
        }
        // CITY / MUNICIPALITY (taxonomy)
        if (!empty($_GET['city'])) {
            $city = sanitize_text_field($_GET['city']);

            $tax_query[] = [
                'taxonomy' => 'citymunicipality',
                'field'    => 'slug',
                'terms'    => $city,
            ];
        }

        // location 
        if (!empty($_GET['location'])) {
            $location = sanitize_text_field($_GET['location']);

            $meta_query[] = [
                'key'     => 'location',
                'value'   => $location,
                'compare' => 'LIKE'
            ];
        }
        // MARKER SERIES
        if (!empty($_GET['marker_series'])) {
            $meta_query[] = [
                'key'   => 'marker_series',
                'value' => sanitize_text_field($_GET['marker_series']),
                'compare' => '='
            ];
        }

        // MARKER UPDATES
        if (!empty($_GET['marker_updates'])) {
            $meta_query[] = [
                'key'   => 'marker_updates',
                'value' => sanitize_text_field($_GET['marker_updates']),
                'compare' => '='
            ];
        }
        // UPDATES (meta)
        if (!empty($_GET['update_filter'])) {
            $meta_query[] = [
                'key'     => 'updates',
                'value'   => sanitize_text_field($_GET['update_filter']),
                'compare' => '='
            ];
        }

        // GROUP DECLARATIONS
        if (!empty($_GET['declaration_filter'])) {
            $meta_query[] = [
                'key'   => 'group_declarations',
                'value' => sanitize_text_field($_GET['declaration_filter']),
                'compare' => '='
            ];
        }

        // INTERNATIONAL (meta)
        if (!empty($_GET['international'])) {
            $meta_query[] = [
                'key'     => 'international',
                'value'   => sanitize_text_field($_GET['international']),
                'compare' => '='
            ];
        }

        if (!empty($_GET['year_filter'])) {
            $year = sanitize_text_field($_GET['year_filter']);

            // Search within the serialized array for the exact year
            $meta_query[] = [
                'key'     => 'm_dates',
                'value'   => '"' . $year . '"',
                'compare' => 'LIKE'
            ];
        }
        // SEARCH
        if (!empty($_GET['s'])) {
            $query->set('s', sanitize_text_field($_GET['s']));
        }
        // SORTING

        if (!empty($_GET['orderby'])) {

            switch ($_GET['orderby']) {
                case 'title':
                    $query->set('orderby', 'title');
                    $query->set('order', 'ASC');  // A-Z
                    break;

                case 'title-desc':
                    $query->set('orderby', 'title');
                    $query->set('order', 'DESC'); // Z-A
                    break;

                case 'date':
                    $query->set('orderby', 'date');
                    $query->set('order', 'DESC'); // newest
                    break;

                case 'date-asc':
                    $query->set('orderby', 'date');
                    $query->set('order', 'ASC');  // oldest
                    break;

                default:
                    $query->set('orderby', 'date');
                    $query->set('order', 'DESC');
                    break;
            }
        }
        // Apply taxonomy queries if any
        if (!empty($tax_query)) {
            $query->set('tax_query', $tax_query);
        }

        // Apply meta queries if any
        if (!empty($meta_query)) {
            $query->set('meta_query', $meta_query);
        }


        // your filters here...

        // RESULTS PER PAGE
        if (!empty($_GET['posts_per_page'])) {
            $query->set('posts_per_page', intval($_GET['posts_per_page']));
        }
    }
}
add_action('pre_get_posts', 'ph_historical_sites_filters');



// Filtering artifacts CPT
function artifacts_registry_filters($query)
{
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    if (is_post_type_archive('artifacts')) {

        $meta_query = [];

        // HERALDRIC ITEMS (ACF checkbox field)
        if (!empty($_GET['location'])) {
            $location_items = array_map('sanitize_text_field', (array) $_GET['location']);
            $location_query = ['relation' => 'OR'];
            foreach ($location_items as $item) {
                $location_query[] = [
                    'key'     => 'location', // ACF field name
                    'value'   => '"' . $item . '"', // Quote for serialized array match
                    'compare' => 'LIKE',
                ];
            }
            $meta_query[] = $location_query;
        }

        // SEALS / LOGOS (ACF checkbox field)
        if (!empty($_GET['type_of_artifacts'])) {
            $type_of_artifacts = array_map('sanitize_text_field', (array) $_GET['type_of_artifacts']);
            $types_artifacts_query = ['relation' => 'OR'];
            foreach ($type_of_artifacts as $seal) {
                $types_artifacts_query[] = [
                    'key'     => 'type_of_artifacts', // ACF field name
                    'value'   => '"' . $seal . '"',
                    'compare' => 'LIKE',
                ];
            }
            $meta_query[] = $types_artifacts_query;
        }

        // PERSONAGE (ACF checkbox field)
        if (!empty($_GET['personage'])) {
            $personages = array_map('sanitize_text_field', (array) $_GET['personage']);
            $personages_query = ['relation' => 'OR'];
            foreach ($personages as $p) {
                $personages_query[] = [
                    'key'     => 'personages', // exact ACF field name
                    'value'   => '"' . $p . '"',
                    'compare' => 'LIKE',
                ];
            }
            $meta_query[] = $personages_query;
        }

        // COLLECTION (ACF checkbox field)
        if (!empty($_GET['collection'])) {
            $collections = array_map('sanitize_text_field', (array) $_GET['collection']);
            $collections_query = ['relation' => 'OR'];
            foreach ($collections as $c) {
                $collections_query[] = [
                    'key'     => 'collection', // exact ACF field name
                    'value'   => '"' . $c . '"',
                    'compare' => 'LIKE',
                ];
            }
            $meta_query[] = $collections_query;
        }


        if (!empty($meta_query)) {
            $query->set('meta_query', $meta_query);
        }

        // SEARCH
        if (!empty($_GET['s'])) {
            $query->set('s', sanitize_text_field($_GET['s']));
        }

        // SORTING
        if (!empty($_GET['sort_by'])) {
            switch ($_GET['sort_by']) {
                case 'az':
                    $query->set('orderby', 'title');
                    $query->set('order', 'ASC');
                    break;
                case 'za':
                    $query->set('orderby', 'title');
                    $query->set('order', 'DESC');
                    break;
                case 'newest':
                    $query->set('orderby', 'date');
                    $query->set('order', 'DESC');
                    break;
                case 'oldest':
                    $query->set('orderby', 'date');
                    $query->set('order', 'ASC');
                    break;
                case 'relevant':
                default:
                    $query->set('orderby', 'relevance'); // optional, default WP search
                    break;
            }
        }
    }
}
add_action('pre_get_posts', 'artifacts_registry_filters');

// Filtering foundation of town CPT
function town_foundation_registry_filters($query)
{
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    if (is_post_type_archive('foundation-of-towns')) {

        $meta_query = [];

        // PERSONAGE (ACF checkbox field)
        if (!empty($_GET['personage'])) {
            $personages = array_map('sanitize_text_field', (array) $_GET['personage']);
            $personages_query = ['relation' => 'OR'];
            foreach ($personages as $p) {
                $personages_query[] = [
                    'key'     => 'personages', // exact ACF field name
                    'value'   => '"' . $p . '"',
                    'compare' => 'LIKE',
                ];
            }
            $meta_query[] = $personages_query;
        }

        // ERA (ACF checkbox field)
        if (!empty($_GET['era'])) {
            $eras = array_map('sanitize_text_field', (array) $_GET['era']);

            $eras_query = ['relation' => 'OR'];

            foreach ($eras as $e) {
                $eras_query[] = [
                    'key'     => 'era', // exact ACF field name
                    'value'   => '"' . $e . '"',
                    'compare' => 'LIKE',
                ];
            }

            $meta_query[] = $eras_query;
        }
        // REGION FILTER
        if (!empty($_GET['region'])) {
            $meta_query[] = [
                'key'     => 'region',
                'value'   => sanitize_text_field($_GET['region']),
                'compare' => '='
            ];
        }

        if (!empty($_GET['province'])) {
            $meta_query[] = [
                'key'     => 'province',
                'value'   => sanitize_text_field($_GET['province']),
                'compare' => '='
            ];
        }

        if (!empty($_GET['city'])) {
            $meta_query[] = [
                'key'     => 'city',
                'value'   => sanitize_text_field($_GET['city']),
                'compare' => '='
            ];
        }



        if (!empty($meta_query)) {
            $query->set('meta_query', $meta_query);
        }

        // SEARCH
        if (!empty($_GET['s'])) {
            $query->set('s', sanitize_text_field($_GET['s']));
        }

        // SORTING
        if (!empty($_GET['sort_by'])) {
            switch ($_GET['sort_by']) {
                case 'az':
                    $query->set('orderby', 'title');
                    $query->set('order', 'ASC');
                    break;
                case 'za':
                    $query->set('orderby', 'title');
                    $query->set('order', 'DESC');
                    break;
                case 'newest':
                    $query->set('orderby', 'date');
                    $query->set('order', 'DESC');
                    break;
                case 'oldest':
                    $query->set('orderby', 'date');
                    $query->set('order', 'ASC');
                    break;
                case 'relevant':
                default:
                    $query->set('orderby', 'relevance'); // optional, default WP search
                    break;
            }
        }
    }
}
add_action('pre_get_posts', 'town_foundation_registry_filters');


function articles_books_search_404()
{
    if (
        !is_admin() &&
        is_search() &&
        is_main_query() &&
        is_post_type_archive(['articles', 'book', 'ph-heraldry-registry', 'artifacts', 'historical-sites', 'a-v-material', 'foundation-of-towns'])
    ) {
        global $wp_query;

        if (!$wp_query->have_posts()) {
            // wag na mag 404
            // archive page lang with "no results"
        }
    }
}
add_action('template_redirect', 'articles_books_search_404');
// av-materials
/**
 * Search ONLY post titles
 */
function search_by_title_only($search, $wp_query)
{
    global $wpdb;

    if (
        empty($search) ||
        ! $wp_query->is_search() ||
        is_admin()
    ) {
        return $search;
    }

    $q = $wp_query->query_vars;
    $search = '';

    if (! empty($q['s'])) {
        $search_terms = explode(' ', $q['s']);

        foreach ($search_terms as $term) {
            $term = esc_sql($wpdb->esc_like($term));
            $search .= " AND {$wpdb->posts}.post_title LIKE '%{$term}%'";
        }
    }

    return $search;
}
add_filter('posts_search', 'search_by_title_only', 10, 2);



function admin_login_error_message($message)
{
    if (isset($_GET['login']) && $_GET['login'] === 'failed') {
        $message = '<div class="error">Invalid username or password.</div>';
    }
    return $message;
}
add_filter('login_message', 'admin_login_error_message');


function custom_pagination_shortcode()
{
    global $wp_query;

    if ($wp_query->max_num_pages <= 1) return '';

    $current = max(1, get_query_var('paged'));
    $total   = $wp_query->max_num_pages;

    ob_start(); ?>

    <nav class="custom-pagination">
        <div class="pagination-inner">

            <div class="pagination-prev" id="pagination-prev"
                style="display:inline-block;margin-right:10px;cursor:pointer;opacity: <?php echo $current <= 1 ? '0.5' : '1'; ?>;">
                ‹ prev
            </div>

            <div class="pagination-info" style="display:inline-block;">
                Page
                <input
                    type="number"
                    id="custom-page-input"
                    min="1"
                    max="<?php echo $total; ?>"
                    value="<?php echo $current; ?>"
                    style="width:60px;text-align:center;">
                of <?php echo $total; ?>
            </div>

            <div class="pagination-next" id="pagination-next"
                style="display:inline-block;margin-left:10px;cursor:pointer;opacity: <?php echo $current >= $total ? '0.5' : '1'; ?>;">
                next ›
            </div>

        </div>
    </nav>

    <script>
        (function($) {

            var maxPages = <?php echo $total; ?>;

            function goToPage(page) {

                if (page < 1) page = 1;
                if (page > maxPages) page = maxPages;

                var url = new URL(window.location.href);
                url.searchParams.set('paged', page);

                window.location.href = url.toString();
            }

            // PREV
            $('#pagination-prev').on('click', function() {

                var inputVal = parseInt($('#custom-page-input').val());
                var currentPage = !isNaN(inputVal) ? inputVal : <?php echo $current; ?>;

                if (currentPage > 1) {
                    goToPage(currentPage - 1);
                }

            });

            // NEXT
            $('#pagination-next').on('click', function() {

                var inputVal = parseInt($('#custom-page-input').val());
                var currentPage = !isNaN(inputVal) ? inputVal : <?php echo $current; ?>;

                if (currentPage < maxPages) {
                    goToPage(currentPage + 1);
                }

            });

            // ENTER KEY
            $('#custom-page-input').on('keypress', function(e) {

                if (e.which === 13) {

                    var page = parseInt($(this).val());

                    if (!isNaN(page)) {
                        goToPage(page);
                    }

                }

            });

            // AUTO CHANGE
            $('#custom-page-input').on('change', function() {

                var page = parseInt($(this).val());

                if (!isNaN(page)) {
                    goToPage(page);
                }

            });

        })(jQuery);
    </script>

<?php
    return ob_get_clean();
}

add_shortcode('custom_pagination', 'custom_pagination_shortcode');







function add_featured_archive_body_class($classes)
{

    if (is_post_type_archive(['local-history', 'philippine-revolution', 'featured-collections'])) {
        $classes[] = 'featured-collection-archive';
    }

    return $classes;
}
add_filter('body_class', 'add_featured_archive_body_class');



function modify_book_archive_posts_per_page($query)
{
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('book')) {

        if (isset($_GET['posts_per_page']) && in_array($_GET['posts_per_page'], ['10', '25', '50'])) {
            $query->set('posts_per_page', intval($_GET['posts_per_page']));
        } else {
            $query->set('posts_per_page', 10); // default
        }
    }
}
add_action('pre_get_posts', 'modify_book_archive_posts_per_page');



function filter_by_title_like($where, $wp_query)
{
    global $wpdb;

    if ($search_term = $wp_query->get('title_like')) {
        $where .= $wpdb->prepare(
            " AND {$wpdb->posts}.post_title LIKE %s",
            '%' . $wpdb->esc_like($search_term) . '%'
        );
    }

    return $where;
}
add_filter('posts_where', 'filter_by_title_like', 10, 2);


function enable_tinymce_justify($buttons)
{
    array_push($buttons, 'alignjustify');
    return $buttons;
}
add_filter('mce_buttons_2', 'enable_tinymce_justify');

// library
require_once "archiving/includes/function-item-custompost.php";
require_once "archiving/includes/function-item-type-custompost.php";
require_once "archiving/includes/function-collection-custompost.php";
require_once "archiving/includes/function-subcollection-custompost.php";
require_once "library/functions/catalog-function.php";
require_once "library/functions/indexing-function.php";
require_once "library/functions/rare-materials-function.php";

function wpse66094_no_admin_access()
{
    $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : home_url('/');
    global $current_user;
    $user_roles = $current_user->roles;
    $user_role = array_shift($user_roles);
    if (($user_role === 'Level_3') || ($user_role === 'Level_4') || ($user_role === 'Archiving') || ($user_role === 'library')) {
        exit(wp_redirect($redirect));
    }
}
add_action('admin_init', 'wpse66094_no_admin_access', 100);

// hide buttons for downloads 
add_filter('body_class', function($classes) {
    if (is_user_logged_in()) {
        $user = wp_get_current_user();
        if (in_array('administrator', $user->roles) || in_array('level_4_user', $user->roles)) {
            $classes[] = 'hide-download-span';
        }
    }
    return $classes;
});
