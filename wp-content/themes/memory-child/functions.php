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

function custom_admin_css() {
    echo '<style>
        .d-none { display: none !important; }
    </style>';
}
add_action('admin_head', 'custom_admin_css');


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

    $post_types = array('foundation-of-towns', 'historical-sites', 'ph-heraldry-registry');

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
});

// Populate province choices dynamically
add_filter('acf/load_field/name=province', function($field){

    $selected_region = null;

    // If form is being submitted
    if(isset($_POST['acf'])){
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
add_action('acf/save_post', function($post_id) {

    // Avoid autosave
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    $acf = $_POST['acf'] ?? [];

    // Check if province field is submitted
    if(isset($acf['field_698c19c39f79b'])){ // replace with your province field key
        $selected_province_code = $acf['field_698c19c39f79b'];

        // Get province list from ph-proxy
        $response = wp_remote_get(get_stylesheet_directory_uri() . '/ph-proxy.php?endpoint=provinces');
        if(!is_wp_error($response)){
            $body = json_decode(wp_remote_retrieve_body($response), true);
            $province_name = '';

            if(!empty($body['data'])){
                foreach($body['data'] as $province){
                    if($province['psgc_code'] == $selected_province_code){
                        $province_name = $province['name'];
                        break;
                    }
                }
            }

            // Update hidden field with province name
            if($province_name){
                update_field('province_text', $province_name, $post_id); // your hidden field
            }
        }
    }

}, 20);


add_filter('acf/load_field/name=region', function($field){

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
add_filter('acf/load_field/name=city', function($field){

    $selected_province = null;

    // During save
    if(isset($_POST['acf'])){
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
add_action('acf/save_post', function($post_id) {

    // Make sure we are not in autosave
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // Get submitted ACF values
    $acf = $_POST['acf'] ?? [];

    // Check if city field is set
    if(isset($acf['field_698c19ca9f79c'])){ // replace with your actual city field key
        $selected_city_code = $acf['field_698c19ca9f79c'];

        // Get the city name from your ph-proxy.php or from $_POST choices
        $response = wp_remote_get(get_stylesheet_directory_uri() . '/ph-proxy.php?endpoint=localities');
        if(!is_wp_error($response)){
            $body = json_decode(wp_remote_retrieve_body($response), true);
            $city_name = '';

            if(!empty($body['data'])){
                foreach($body['data'] as $city){
                    if($city['psgc_code'] == $selected_city_code){
                        $city_name = $city['name'];
                        break;
                    }
                }
            }

            // Update hidden field
            if($city_name){
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

        // FILTER: Status (assuming it's a meta field)
        if (!empty($_GET['status'])) {
            $status = sanitize_text_field($_GET['status']);
            $meta_query[] = [
                'key'     => 'status', // meta key in ACF
                'value'   => $status,
                'compare' => '='
            ];
        }

        // FILTER: Marker Category (ACF meta field)
        if (!empty($_GET['marker_category'])) {
            $marker_category = sanitize_text_field($_GET['marker_category']);

            // Add to meta_query
            $meta_query[] = [
                'key'     => 'marker_category', // The exact ACF field name
                'value'   => $marker_category,
                'compare' => '=' // Exact match
            ];
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

        // FILTER: International
        if (!empty($_GET['international'])) {
            $international = sanitize_text_field($_GET['international']);
            $meta_query[] = [
                'key'     => 'international',
                'value'   => $international,
                'compare' => '='
            ];
        }

        // FILTER: Year
        if (!empty($_GET['year_filter'])) {
            $year = intval($_GET['year_filter']);
            $meta_query[] = [
                'key'     => 'year', // meta field storing the year
                'value'   => $year,
                'compare' => '='
            ];
        }

        // SEARCH
        if (!empty($_GET['s'])) {
            $query->set('s', sanitize_text_field($_GET['s']));
        }

        // SORTING
        if (!empty($_GET['orderby'])) {
            switch ($_GET['orderby']) {
                case 'date-desc':
                    $query->set('orderby', 'date');
                    $query->set('order', 'DESC');
                    break;
                case 'date-asc':
                    $query->set('orderby', 'date');
                    $query->set('order', 'ASC');
                    break;
                default:
                    $query->set('orderby', 'date');
                    $query->set('order', 'DESC');
                    break;
            }
        }

        // Apply all meta queries if any
        if (!empty($meta_query)) {
            $query->set('meta_query', $meta_query);
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


// Force 404 on empty search results for Articles & Books archives
function articles_books_search_404()
{
    if (
        ! is_admin() &&
        is_search() &&
        is_main_query() &&
        is_post_type_archive(['articles', 'book', 'ph-heraldry-registry', 'artifacts','historical-sites','a-v-material','foundation-of-towns'])
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




// add_action('acf/init', 'bulk_copy_first_content_to_post_content');

// function bulk_copy_first_content_to_post_content()
// {
//     $args = [
//         'post_type'      => 'historical-sites',
//         'posts_per_page' => -1,
//         'post_status'    => 'publish',
//         'fields'         => 'ids',
//     ];
//     $posts = get_posts($args);

//     foreach ($posts as $post_id) {
//         // Get the outer repeater
//         $date_rows = get_field('date_content', $post_id);

//         if ($date_rows && is_array($date_rows)) {
//             $first_date_row = $date_rows[0]; // Take first row of date_content

//             if (!empty($first_date_row['content']) && is_array($first_date_row['content'])) {
//                 $first_content_row = $first_date_row['content'][0]; // First row of content repeater

//                 if (!empty($first_content_row['first_content'])) {
//                     $first_content = $first_content_row['first_content'];

//                     wp_update_post([
//                         'ID'           => $post_id,
//                         'post_content' => $first_content,
//                     ]);
//                 }
//             }
//         }
//     }
// }

add_filter('acf/load_field/name=marker_by_date', function ($field) {

    // Kunin lahat ng choices mula sa m_dates checkbox
    $checkbox_field = get_field_object('m_dates'); // name or key
    if ($checkbox_field && isset($checkbox_field['choices'])) {
        $field['choices'] = $checkbox_field['choices'];
    }

    return $field;
});

add_filter('acf/load_value/name=marker_by_date', function ($value, $post_id, $field) {
    $checked = get_field('m_dates', $post_id);
    if ($checked) {
        return $checked;
    }
    return $value;
}, 10, 3);
