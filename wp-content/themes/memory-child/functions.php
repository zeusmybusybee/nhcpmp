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

function load_select2_assets() {
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

// for filtering access in artifacts
add_action('pre_get_posts', function ($query) {

    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    // Only Book archive
    if (!is_post_type_archive('artifacts')) {
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


// Force 404 on empty search results for Articles & Books archives
function articles_books_search_404()
{
    if (
        ! is_admin() &&
        is_search() &&
        is_main_query() &&
        is_post_type_archive(['articles', 'book', 'ph-heraldry-registry', 'artifacts'])
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

// Fetch Regions
add_action('wp_ajax_get_regions', 'get_regions_callback');
add_action('wp_ajax_nopriv_get_regions', 'get_regions_callback');
function get_regions_callback()
{
    $options = [];
    $response = wp_remote_get("https://philippine-datasets-api.nowcraft.ing/api/regions");

    if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
        $regions = json_decode(wp_remote_retrieve_body($response), true);
        if (isset($regions['data']) && is_array($regions['data'])) {
            foreach ($regions['data'] as $r) {
                if (!empty($r['psgc_code']) && !empty($r['name'])) {
                    // Keep 10 digits as string
                    $code = str_pad((string)$r['psgc_code'], 10, '0', STR_PAD_LEFT);
                    $options[$code] = $r['name'];
                }
            }
        }
    }

    wp_send_json($options);
}

// Fetch Provinces by Region
add_action('wp_ajax_get_provinces', 'get_provinces_callback');
add_action('wp_ajax_nopriv_get_provinces', 'get_provinces_callback');
function get_provinces_callback() {
    $region_code = sanitize_text_field($_POST['region'] ?? '');

    // Force region code to 10 digits (PSGC format)
    while (strlen($region_code) < 10) {
        $region_code .= '0';
    }

    $options = [];

    if ($region_code) {
        $response = wp_remote_get("https://philippine-datasets-api.nowcraft.ing/api/regions/{$region_code}");

        if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
            $body = json_decode(wp_remote_retrieve_body($response), true);

            // ✅ Provinces are inside this key
            if (!empty($body['provinces']) && is_array($body['provinces'])) {

                foreach ($body['provinces'] as $province) {
                    $props = $province['properties'] ?? [];

                    if (!empty($props['psgc_code']) && !empty($props['name'])) {
                        $options[$props['psgc_code']] = $props['name'];
                    }
                }
            }
        }
    }

    wp_send_json($options);
}



add_action('wp_ajax_get_municipalities', 'get_municipalities_callback');
add_action('wp_ajax_nopriv_get_municipalities', 'get_municipalities_callback');

function get_municipalities_callback() {

    $province_code = sanitize_text_field($_POST['province'] ?? '');

    // Force 10-digit PSGC
    while (strlen($province_code) < 10) {
        $province_code .= '0';
    }

    $options = [];

    if ($province_code) {
        $response = wp_remote_get("https://philippine-datasets-api.nowcraft.ing/api/provinces/{$province_code}");

        if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
            $body = json_decode(wp_remote_retrieve_body($response), true);

            /** ✅ Municipalities */
            if (!empty($body['municipalities'])) {
                foreach ($body['municipalities'] as $m) {
                    $props = $m['properties'] ?? [];
                    if (!empty($props['psgc_code']) && !empty($props['name'])) {
                        $options[$props['psgc_code']] = $props['name'];
                    }
                }
            }

            /** ✅ Cities (highly urbanized / component cities) */
            if (!empty($body['cities'])) {
                foreach ($body['cities'] as $c) {
                    $props = $c['properties'] ?? [];
                    if (!empty($props['psgc_code']) && !empty($props['name'])) {
                        $options[$props['psgc_code']] = $props['name'];
                    }
                }
            }
        }
    }

    wp_send_json($options);
}

add_action('acf/input/admin_footer', function () { ?>
<script>
(function($){

    const fields = {
        region: 'acf[field_6989834fad150]',
        province: 'acf[field_69898380ad151]',
        municipality: 'acf[field_6989839ead152]'
    };

    function force10Digits(code){
        code = String(code || '');
        while(code.length < 10){
            code += '0';
        }
        return code;
    }

    function populateSelect(fieldName, ajaxAction, paramKey, paramValue, placeholder, selectedValue = null){
        const $field = $('select[name="'+fieldName+'"]');
        if(!$field.length) return;

        $field.html('<option value="">Loading...</option>');

        const data = { action: ajaxAction };
        if(paramKey && paramValue) data[paramKey] = paramValue;

        $.post(ajaxurl, data, function(response){
            $field.html('<option value="">'+placeholder+'</option>');

            $.each(response, function(value, label){
                $field.append('<option value="'+value+'">'+label+'</option>');
            });

            if(selectedValue){
                $field.val(force10Digits(selectedValue));
            }
        });
    }

    /** REGION → PROVINCE */
    $(document).on('change', 'select[name="'+fields.region+'"]', function(){
        let regionCode = $(this).val();

        if(!regionCode){
            $('select[name="'+fields.province+'"]').html('<option value="">Select Region first</option>');
            $('select[name="'+fields.municipality+'"]').html('<option value="">Select Province first</option>');
            return;
        }

        regionCode = force10Digits(regionCode);
        $(this).val(regionCode);

        populateSelect(
            fields.province,
            'get_provinces',
            'region',
            regionCode,
            'Select Province'
        );

        $('select[name="'+fields.municipality+'"]').html('<option value="">Select Province first</option>');
    });

    /** PROVINCE → MUNICIPALITY */
    $(document).on('change', 'select[name="'+fields.province+'"]', function(){
        let provinceCode = $(this).val();

        if(!provinceCode){
            $('select[name="'+fields.municipality+'"]').html('<option value="">Select Province first</option>');
            return;
        }

        provinceCode = force10Digits(provinceCode);
        $(this).val(provinceCode);

        populateSelect(
            fields.municipality,
            'get_municipalities',
            'province',
            provinceCode,
            'Select Municipality'
        );
    });

    /** PREPOPULATE ON EDIT */
    $(document).ready(function(){

        const savedRegion       = $('select[name="'+fields.region+'"]').val();
        const savedProvince     = $('select[name="'+fields.province+'"]').val();
        const savedMunicipality = $('select[name="'+fields.municipality+'"]').val();

        if(savedRegion){
            const regionCode = force10Digits(savedRegion);

            populateSelect(
                fields.province,
                'get_provinces',
                'region',
                regionCode,
                'Select Province',
                savedProvince
            );
        }

        if(savedProvince){
            const provinceCode = force10Digits(savedProvince);

            populateSelect(
                fields.municipality,
                'get_municipalities',
                'province',
                provinceCode,
                'Select Municipality',
                savedMunicipality
            );
        }
    });

})(jQuery);
</script>
<?php });

