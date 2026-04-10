<div class="archive-right-col archive-right ">
    <?php
    // Get current filter values
    $heraldric_items_selected = $_GET['heraldric_items'] ?? [];
    $seals_selected          = $_GET['seals_logos'] ?? [];
    $sort_by                 = $_GET['sort_by'] ?? '';
    $search_term             = $_GET['s'] ?? '';
    ?>

    <form method="get"
        action="<?php echo esc_url(get_post_type_archive_link('historical-sites')); ?>"
        class="p-4">

        <!-- SEARCH -->
        <div class="row g-4 border rounded mb-5">
            <div class="input-group">
                <input type="search" name="s" class="form-control border-0" placeholder="Search this Database..."
                    value="<?php echo esc_attr($search_term); ?>">
                <button class="button" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </div>
        <!-- APPLIED FILTERS SUMMARY -->
        <?php
        // Get current filter values
        $level_status      = $_GET['level_status'] ?? '';
        $registry_category = $_GET['registry_category'] ?? '';
        $region            = $_GET['region'] ?? '';
        $province          = $_GET['province'] ?? '';
        $city              = $_GET['city'] ?? '';
        $year_filter       = $_GET['year_filter'] ?? '';
        $orderby           = $_GET['orderby'] ?? '';
        $search_term       = $_GET['s'] ?? '';
        ?>

        <?php if ($level_status || $registry_category || $region || $province || $city || $year_filter || $orderby || $search_term): ?>
            <div class="row  applied-filters">
                <strong>Applied Filters:</strong>
                <ul class="mb-0 list-unstyled">

                    <?php if ($level_status) : ?>
                        <li>Status: <?php echo esc_html(ucfirst(str_replace('-', ' ', $level_status))); ?></li>
                    <?php endif; ?>

                    <?php if ($registry_category) : ?>
                        <li>Category: <?php echo esc_html(ucfirst(str_replace('-', ' ', $registry_category))); ?></li>
                    <?php endif; ?>

                    <?php if ($region) : ?>
                        <li>Region: <?php echo esc_html($region); ?></li>
                    <?php endif; ?>

                    <?php if ($province) : ?>
                        <li>Province: <?php echo esc_html($province); ?></li>
                    <?php endif; ?>

                    <?php if ($city) : ?>
                        <li>City/Municipality: <?php echo esc_html($city); ?></li>
                    <?php endif; ?>

                    <?php if ($year_filter) : ?>
                        <li>Year: <?php echo esc_html($year_filter); ?></li>
                    <?php endif; ?>

                    <?php if ($orderby) :

                        $sort_labels = [
                            'title' => 'A - Z',
                            'title-desc' => 'Z - A ',
                            'date' => 'Newest to Oldest',
                            'date-asc'  => 'Oldest to Newest',
                        ];

                        $sort_text = $sort_labels[$orderby] ?? $orderby;

                    ?>
                        <li>Sort: <?php echo esc_html($sort_text); ?></li>
                    <?php endif; ?>

                    <?php if ($search_term) : ?>
                        <li>Search: <?php echo esc_html($search_term); ?></li>
                    <?php endif; ?>

                </ul>

                <button class="box">
                    <a href="<?php echo esc_url(get_post_type_archive_link('historical-sites')); ?>" class="btn btn-sm btn-secondary mt-2">Clear All</a>
                </button>
            </div>
        <?php endif; ?>



        <!-- FILTERS -->
        <div class=" g-4 border rounded p-4 bg-body-tertiary">
            <div class="col-11 archive-right-col">
                <h6 class="mb-3 fw-bold">Sort by:</h6>

                <?php
                $current_order = $_GET['orderby'] ?? 'relevance';
                ?>
                <div class="d-flex justify-content-between text-center">

                    <div class="form-check d-flex  align-items-center">
                        <input class="form-check-input mb-2" type="radio" name="orderby" value="title"
                            <?php checked($current_order, 'title'); ?>>
                        <label class="form-check-label">A - Z</label>
                    </div>
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input mb-2" type="radio" name="orderby" value="title-desc"
                            <?php checked($current_order, 'title-desc'); ?>>
                        <label class="form-check-label">Z - A</label>
                    </div>
                    <div class="form-check d-flex  align-items-center">
                        <input class="form-check-input mb-2" type="radio" name="orderby" value="date"
                            <?php checked($current_order, 'date'); ?>>
                        <label class="form-check-label">Newest</label>
                    </div>

                    <div class="form-check d-flex  align-items-center">
                        <input class="form-check-input mb-2" type="radio" name="orderby" value="date-asc"
                            <?php checked($current_order, 'date-asc'); ?>>
                        <label class="form-check-label">Oldest</label>
                    </div>

                </div>

            </div>

            <!-- FILTER BY -->
            <div class="col-12 mb-3">

                <?php
                // Current selections
                $current_status = $_GET['level_status'] ?? '';
                $current_category = $_GET['registry_category'] ?? '';
                $current_type = $_GET['type'] ?? '';

                // Custom order for status
                $custom_order = ['level-i', 'level-ii', 'presumption-removed', 'delisted'];

                // Get Status terms
                $status_terms = get_terms([
                    'taxonomy' => 'level_status',
                    'hide_empty' => false,
                ]);
                ?>

                <!-- Status Dropdown -->
                <h6 class="mb-3 fw-bold">Filter by Status</h6>
                <select name="level_status" id="level_status" class="form-select mb-2">
                    <option value="">-Status-</option>
                    <?php
                    if (!is_wp_error($status_terms) && !empty($status_terms)) {
                        $terms_by_slug = [];

                        foreach ($status_terms as $term) {
                            $terms_by_slug[$term->slug] = $term;
                        }

                        foreach ($custom_order as $slug) {
                            if (isset($terms_by_slug[$slug])) {
                                $term = $terms_by_slug[$slug];
                    ?>
                                <option value="<?php echo esc_attr($term->slug); ?>" <?php selected($current_status, $term->slug); ?>>
                                    <?php echo esc_html($term->name); ?> (<?php echo $term->count; ?>)
                                </option>
                    <?php
                            }
                        }
                    }
                    ?>
                </select>

                <?php
                $post_type = 'historical-sites'; // replace with your actual post type
                $taxonomy  = 'registry_category';

                // 🔹 Optional custom labels
                $custom_labels = [
                    // LEVEL I
                    'national-historical-landmark' => 'National Historical Landmark',
                    'national-historical-site'      => 'National Historical Site',
                    'national-monument'             => 'National Monument',
                    'national-shrine'               => 'National Shrine',
                    'unesco-world-heritage-site'    => 'UNESCO World Heritage Site',

                    // LEVEL II
                    'association-institution-organization' => 'Association / Institution / Organization',
                    'buildings-structures'                 => 'Buildings / Structures',
                    'heritage-house'                       => 'Heritage House',
                    'heritage-zone-historic-center'       => 'Heritage Zone / Historic Center',
                    'personages'                           => 'Personages',
                    'sites-events'                         => 'Sites / Events',
                ];

                // 🔹 Level I slugs
                $levelI_slugs = array_keys(array_slice($custom_labels, 0, 5)); // first 5 are Level I

                // Get all terms
                $terms = get_terms([
                    'taxonomy'   => $taxonomy,
                    'hide_empty' => false, // get all terms
                ]);

                $filtered_terms = [];
                foreach ($terms as $term) {
                    $slug = $term->slug;

                    if (in_array($slug, $levelI_slugs)) {
                        // Level I → only include if has posts
                        $query = new WP_Query([
                            'post_type'      => $post_type,
                            'tax_query'      => [
                                [
                                    'taxonomy' => $taxonomy,
                                    'field'    => 'slug',
                                    'terms'    => $slug,
                                ],
                            ],
                            'posts_per_page' => 1,
                        ]);
                        if ($query->have_posts()) {
                            $filtered_terms[] = $term;
                        }
                        wp_reset_postdata();
                    } else {
                        // Level II → always include
                        $filtered_terms[] = $term;
                    }
                }

                // 🔹 Selected category from URL
                $selected_category = isset($_GET['registry_category']) ? sanitize_text_field($_GET['registry_category']) : '';
                ?>

                <!-- Category Dropdown -->
                <select name="registry_category" id="registry_category" class="form-select mb-2">
                    <option value="">-Category-</option>
                    <?php foreach ($filtered_terms as $term): ?>
                        <?php
                        $slug  = $term->slug;
                        $label = isset($custom_labels[$slug]) ? $custom_labels[$slug] : $term->name;
                        $selected = ($slug === $selected_category) ? 'selected' : '';
                        ?>
                        <option value="<?php echo esc_attr($slug); ?>" <?php echo $selected; ?>>
                            <?php echo esc_html($label); ?> (<?php echo $term->count; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>


                <?php
                $post_type = 'historical-sites';
                $taxonomy  = 'labels';

                // Kunin lahat ng terms sa taxonomy
                $terms = get_terms(array(
                    'taxonomy' => $taxonomy,
                    'hide_empty' => true, // true para i-display lang yung may posts
                ));

                // Filter terms para lang sa post type
                $filtered_terms = array();
                foreach ($terms as $term) {
                    $query = new WP_Query(array(
                        'post_type' => $post_type,
                        'tax_query' => array(
                            array(
                                'taxonomy' => $taxonomy,
                                'field'    => 'slug',
                                'terms'    => $term->slug,
                            ),
                        ),
                        'posts_per_page' => -1, // kunin lahat para mabilang
                        'fields' => 'ids'
                    ));

                    if ($query->have_posts()) {
                        // ✅ dito mo ilalagay yung count
                        $term->custom_count = $query->post_count;

                        $filtered_terms[] = $term;
                    }

                    wp_reset_postdata();
                }
                ?>

                <?php
                $selected_type = isset($_GET['labels']) ? sanitize_text_field($_GET['labels']) : '';

                // Custom labels
                $levelI_labels = [
                    "bank" => "Bank*",
                    "battle-site-2" => "Battle Site*",
                    "belfry" => "Belfry*",
                    "buildings-structures" => "Buildings/Structures*",
                    "capitol-building" => "Capitol Building*",
                    "cemetery" => "Cemetery*",
                    "clubhouse" => "Clubhouse*",
                    "convent" => "Convent*",
                    "declaration-marker" => "Declaration Marker*",
                    "fortification" => "Fortification*",
                    "garden" => "Garden",
                    "historic-center" => "Historic Center*",
                    "hotel" => "Hotel",
                    "house-of-worship" => "House of Worship*",
                    "house" => "House*",
                    "kampanaryo-ng-jaro" => "Kampanaryo ng Jaro*",
                    "lighthouse" => "Lighthouse*",
                    "memorial" => "Memorial*",
                    "monument" => "Monument*",
                    "nhcp-museum" => "NHCP Museum*",
                    "penitentiary" => "Penitentiary*",
                    "plaza" => "Plaza*",
                    "prison-cell" => "Prison Cell*",
                    "school" => "School",
                    "site-of-important-event" => "Site of an Important Event*",
                    "site" => "Site*",
                    "university" => "University*",
                    "watchtower" => "Watchtower*",

                    // LEVEL II
                    "aquarium" => "Aquarium",
                    "battle-site" => "Battle Site",
                    "beach" => "Beach",
                    "belfry" => "Belfry",
                    "biographical-marker" => "Biographical Marker",
                    "bridge" => "Bridge",
                    "capitol-building" => "Capitol Building",
                    "cathedral" => "Cathedral",
                    "cemetery" => "Cemetery",
                    "convent" => "Convent",
                    "dam" => "Dam",
                    "fortification" => "Fortification",
                    "foundation-site" => "Foundation Site",
                    "fountain" => "Fountain",
                    "gabaldon-school" => "Gabaldon School",
                    "gateway" => "Gateway",
                    "golf-course" => "Golf Course",
                    "group-of-houses" => "Group of Houses",
                    "hospital" => "Hospital",
                    "house" => "House",
                    "house-of-worship" => "House of Worship",
                    "lighthouse" => "Lighthouse",
                    "memorare" => "Memorare",
                    "memorial" => "Memorial",
                    "military-camp" => "Military Camp",
                    "military-structure" => "Military Structure",
                    "monument" => "Monument",
                    "museum" => "Museum",
                    "office-building" => "Office Building",
                    "plaza" => "Plaza",
                    "polvorin" => "Polvorin",
                    "post-office" => "Post Office",
                    "prison" => "Prison",
                    "private-company" => "Private Company",
                    "private-institution" => "Private Institution",
                    "ranch" => "Ranch",
                    "restaurant" => "Restaurant",
                    "retreat-house" => "Retreat House",
                    "ridge" => "Ridge",
                    "rizal-monuments" => "Rizal monuments",
                    "room" => "Room",
                    "ruins" => "Ruins",
                    "school" => "School",
                    "seminary" => "Seminary",
                    "simbahan-ng-canaman" => "Simbahan ng Canaman",
                    "site" => "Site",
                    "site-of-an-important-event" => "Site of an Important Event",
                    "tomas-pinpin" => "Tomas Pinpin",
                    "town-city-hall" => "Town/City Hall",
                    "trading-house" => "Trading house",
                    "train-station" => "Train Station",
                    "university" => "University",
                    "watchtower" => "Watchtower"
                ];
                ?>
                <select name="labels" id="type" class="form-select mb-2">
                    <option value="">-Type-</option>

                    <?php foreach ($filtered_terms as $term): ?>
                        <?php
                        $slug = $term->slug;
                        $label = isset($levelI_labels[$slug]) ? $levelI_labels[$slug] : $term->name;
                        $count = isset($term->custom_count) ? $term->custom_count : 0;

                        $selected = ($slug === $selected_type) ? 'selected' : '';
                        ?>

                        <option value="<?php echo esc_attr($slug); ?>"
                            data-key="<?php echo esc_attr($slug); ?>"
                            <?php echo $selected; ?>>
                            <?php echo esc_html($label . ' (' . $count . ')'); ?>
                        </option>

                    <?php endforeach; ?>
                </select>
            </div>

            <!-- FILTER BY PLACE -->
            <div class="col-12 mb-3">
                <h6 class="mb-3 fw-bold">Filter by Place</h6>

                <?php
                // 👉 Kunin selected value (important)
                $selected_region = $_GET['acf']['region_for_historic'] ?? '';

                // 👉 Static regions list
                $regions = [
                    'BARMM (Bangsamoro Autonomous Region)',
                    'CAR (Cordillera Administrative Region)',
                    'NCR (National Capital Region)',
                    'Negros Island Region (NIR)',
                    'Region I (Ilocos Region)',
                    'Region II (Cagayan Valley)',
                    'Region III (Central Luzon)',
                    'Region IV-A (CALABARZON)',
                    'Region IV-B (MIMAROPA)',
                    'Region V (Bicol Region)',
                    'Region VI (Western Visayas)',
                    'Region VII (Central Visayas)',
                    'Region VIII (Eastern Visayas)',
                    'Region IX (Zamboanga Peninsula)',
                    'Region X (Northern Mindanao)',
                    'Region XI (Davao Region)',
                    'Region XII (SOCCSKSARGEN)',
                    'Region XIII (Caraga)',
                ];

                // 👉 DB connection
                global $wpdb;
                $meta_key = 'region_for_historic';

                // 👉 Query para sa counts
                $results = $wpdb->get_results(
                    $wpdb->prepare(
                        "
            SELECT pm.meta_value, COUNT(*) as count
            FROM {$wpdb->postmeta} pm
            INNER JOIN {$wpdb->posts} p ON pm.post_id = p.ID
            WHERE pm.meta_key = %s
            AND p.post_status = 'publish'
            AND p.post_type = 'historical-sites'
            GROUP BY pm.meta_value
            ",
                        $meta_key
                    ),
                    OBJECT_K
                );
                ?>

                <select id="acf-region" name="acf[region_for_historic]" class="form-select mb-2">
                    <option value="">Select Region</option>

                    <?php
                    foreach ($regions as $region) {

                        $count = 0;

                        // 👉 compute count per region
                        if ($results) {
                            foreach ($results as $meta_value => $row) {

                                $value = maybe_unserialize($meta_value);

                                if (is_array($value) && in_array($region, $value)) {
                                    $count += $row->count;
                                } elseif ($value === $region) {
                                    $count += $row->count;
                                }
                            }
                        }

                        // 👉 retain selected
                        $selected = ($selected_region === $region) ? 'selected="selected"' : '';

                        echo '<option value="' . esc_attr($region) . '" ' . $selected . '>'
                            . esc_html($region . ' (' . $count . ')')
                            . '</option>';
                    }
                    ?>
                </select>


                <?php
                $selected_province = $_GET['acf']['field_69b646224193d'] ?? '';
                $selected_city     = $_GET['acf']['field_69b6462d4193e'] ?? '';
                ?>
                <select id="acf-province"
                    name="acf[field_69b646224193d]"
                    class="form-select mb-2"
                    data-selected="<?php echo esc_attr($selected_province); ?>">
                    <option value="">Select Province</option>
                </select>

                <select id="acf-city"
                    name="acf[field_69b6462d4193e]"
                    class="form-select mb-2"
                    data-selected="<?php echo esc_attr($selected_city); ?>">
                    <option value="">Select City / Municipality</option>
                </select>
                <!-- INTERNATIONAL -->
                <select name="international_for_historic" class="form-select mb-2">
                    <option value="">Select International</option>
                    <?php
                    $internationals = $wpdb->get_col("
                            SELECT DISTINCT meta_value
                            FROM $wpdb->postmeta
                            WHERE meta_key = 'international_for_historic'
                              AND meta_value != ''
                            ORDER BY meta_value ASC
                        ");

                    $current_international = $_GET['international_for_historic'] ?? '';

                    foreach ($internationals as $international) {
                        $count = $wpdb->get_var($wpdb->prepare("
                                SELECT COUNT(*) 
                                FROM $wpdb->postmeta 
                                WHERE meta_key = 'international_for_historic' 
                                  AND meta_value = %s
                            ", $international));

                        echo '<option value="' . esc_attr($international) . '" ' . selected($current_international, $international, false) . '>';
                        echo esc_html($international . " ($count)");
                        echo '</option>';
                    }
                    ?>
                </select>

                <!-- <select id="region" name="region" class="form-select mb-2">
                            <option value="">Region</option>
                        </select>

                        <select id="province" name="province" class="form-select mb-2">
                            <option value="">Province</option>
                        </select>

                        <select id="city" name="city" class="form-select mb-2">
                            <option value="">City / Municipality</option>
                        </select> -->
            </div>

            <!-- FILTER BY TIME -->
            <div class="col-12">
                <h6 class="mb-3 fw-bold">Filter by Time</h6>


                <?php
                // YEAR FILTER
                $field = get_field_object('m_dates');

                if ($field && isset($field['choices']) && is_array($field['choices'])) :
                    $choices = $field['choices'];
                    krsort($choices);

                    $all_posts = get_posts([
                        'post_type'      => 'historical-sites',
                        'posts_per_page' => -1,
                        'post_status'    => 'publish',
                        'fields'         => 'ids',
                    ]);

                    $year_counts = [];
                    foreach ($all_posts as $post_id) {
                        $years = get_field('m_dates', $post_id);
                        if ($years && is_array($years)) {
                            foreach ($years as $year) {
                                if (!isset($year_counts[$year])) {
                                    $year_counts[$year] = 0;
                                }
                                $year_counts[$year]++;
                            }
                        }
                    }

                    $current_year = $_GET['year_filter'] ?? '';
                ?>

                    <!-- YEAR DROPDOWN -->
                    <select name="year_filter" class="form-select mb-2">
                        <option value="">Year</option>
                        <?php foreach ($choices as $value => $label): ?>
                            <option value="<?php echo esc_attr($value); ?>" <?php selected($current_year, $value); ?>>
                                <?php echo esc_html($label); ?> (<?php echo $year_counts[$value] ?? 0; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>

                <?php endif; ?>



                <?php
                $updates_field = acf_get_field('updates');

                if ($updates_field && !empty($updates_field['choices'])) :

                    $all_posts = get_posts([
                        'post_type'      => 'historical-sites',
                        'posts_per_page' => -1,
                        'post_status'    => 'publish',
                        'fields'         => 'ids',
                    ]);

                    $updates_counts = [];

                    // initialize choices except Select Status
                    foreach ($updates_field['choices'] as $value => $label) {
                        if ($value === 'Select Status') continue;
                        $updates_counts[$value] = 0;
                    }

                    foreach ($all_posts as $post_id) {
                        $update_value = get_field('updates', $post_id);

                        if ($update_value && isset($updates_counts[$update_value])) {
                            $updates_counts[$update_value]++;
                        }
                    }

                    $current_update = $_GET['update_filter'] ?? '';
                ?>

                    <select name="update_filter" class="form-select mb-2">
                        <option value="">Updates</option>

                        <?php foreach ($updates_field['choices'] as $value => $label): ?>

                            <?php if ($value === 'Select Status') continue; ?>

                            <option value="<?php echo esc_attr($value); ?>" <?php selected($current_update, $value); ?>>
                                <?php echo esc_html($label); ?> (<?php echo $updates_counts[$value] ?? 0; ?>)
                            </option>

                        <?php endforeach; ?>

                    </select>

                <?php endif; ?>
            </div>



            <div class="col-12">
                <h6 class="mb-3 fw-bold">Other Features</h6>

                <?php
                $series_field = acf_get_field('marker_series');

                if ($series_field && !empty($series_field['choices'])) :

                    // âœ… ALWAYS get ALL posts (not affected by filters)
                    $all_posts = get_posts([
                        'post_type'        => 'historical-sites',
                        'posts_per_page'   => -1,
                        'post_status'      => 'publish',
                        'fields'           => 'ids',
                        'suppress_filters' => true // ðŸ”¥ important fix
                    ]);

                    $series_counts = [];

                    // Initialize choices
                    foreach ($series_field['choices'] as $value => $label) {
                        if ($label === 'Select Status') continue;
                        $series_counts[$value] = 0;
                    }

                    // âœ… CORRECT counting for multiple ACF field
                    foreach ($all_posts as $post_id) {
                        $series = get_field('marker_series', $post_id);

                        if ($series) {
                            if (is_array($series)) {
                                foreach ($series as $s) {
                                    if (isset($series_counts[$s])) {
                                        $series_counts[$s]++;
                                    }
                                }
                            } else {
                                if (isset($series_counts[$series])) {
                                    $series_counts[$series]++;
                                }
                            }
                        }
                    }

                    // Frontend = SINGLE select only
                    $current_series = $_GET['marker_series'] ?? '';
                ?>

                    <select name="marker_series" class="form-select mb-2">
                        <option value="">Marker Series</option>

                        <?php foreach ($series_field['choices'] as $value => $label): ?>
                            <?php if ($label === 'Select Status') continue; ?>

                            <option value="<?php echo esc_attr($value); ?>"
                                <?php selected($current_series, $value); ?>>
                                <?php echo esc_html($label); ?> (<?php echo $series_counts[$value] ?? 0; ?>)
                            </option>

                        <?php endforeach; ?>
                    </select>

                <?php endif; ?>
                <?php
                // Get ACF field
                $updates_field = acf_get_field('marker_updates');

                if ($updates_field && !empty($updates_field['choices'])) :

                    // Find the placeholder key by label match (e.g. label contains 'Select Status')
                    $placeholder_key = '';
                    foreach ($updates_field['choices'] as $value => $label) {
                        if (stripos($label, 'select status') !== false) {
                            $placeholder_key = $value;
                            break;
                        }
                    }

                    // Get all posts
                    $all_posts = get_posts([
                        'post_type'      => 'historical-sites',
                        'posts_per_page' => -1,
                        'post_status'    => 'publish',
                        'fields'         => 'ids',
                    ]);

                    // Initialize counts skipping placeholder key
                    $updates_counts = [];
                    foreach ($updates_field['choices'] as $value => $label) {
                        if (trim($value) === $placeholder_key) continue;
                        $updates_counts[$value] = 0;
                    }

                    // Count posts by update value, skipping placeholder
                    foreach ($all_posts as $post_id) {
                        $update = get_field('marker_updates', $post_id);

                        if (!$update || trim($update) === $placeholder_key) continue;

                        if (isset($updates_counts[$update])) {
                            $updates_counts[$update]++;
                        }
                    }

                    $current_update = $_GET['marker_updates'] ?? '';

                ?>

                    <select name="marker_updates" class="form-select mb-2">
                        <option value="">Marker Updates</option>

                        <?php foreach ($updates_field['choices'] as $value => $label): ?>
                            <?php if (trim($value) === $placeholder_key) continue; ?>
                            <option value="<?php echo esc_attr($value); ?>" <?php selected($current_update, $value); ?>>
                                <?php echo esc_html($label); ?> (<?php echo $updates_counts[$value] ?? 0; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>

                <?php endif; ?>

                <?php
                $declarations_field = acf_get_field('group_declarations');

                if ($declarations_field && !empty($declarations_field['choices'])) :

                    // Detect placeholder key (if any), e.g. label contains 'Select'
                    $placeholder_key = '';
                    foreach ($declarations_field['choices'] as $value => $label) {
                        if (stripos($label, 'select') !== false) {
                            $placeholder_key = $value;
                            break;
                        }
                    }

                    // Get all posts
                    $all_posts = get_posts([
                        'post_type'      => 'historical-sites',
                        'posts_per_page' => -1,
                        'post_status'    => 'publish',
                        'fields'         => 'ids',
                    ]);

                    // Initialize counts skipping placeholder
                    $declarations_counts = [];
                    foreach ($declarations_field['choices'] as $value => $label) {
                        if (trim($value) === $placeholder_key) continue;
                        $declarations_counts[$value] = 0;
                    }

                    // Count posts by declaration value, skipping placeholder
                    foreach ($all_posts as $post_id) {
                        $declaration = get_field('group_declarations', $post_id);

                        if (!$declaration || trim($declaration) === $placeholder_key) continue;

                        if (isset($declarations_counts[$declaration])) {
                            $declarations_counts[$declaration]++;
                        }
                    }

                    $current_declaration = $_GET['declaration_filter'] ?? '';
                ?>

                    <select name="declaration_filter" class="form-select mb-2">
                        <option value="">Group Declarations</option>

                        <?php foreach ($declarations_field['choices'] as $value => $label): ?>
                            <?php if (trim($value) === $placeholder_key) continue; ?>
                            <option value="<?php echo esc_attr($value); ?>" <?php selected($current_declaration, $value); ?>>
                                <?php echo esc_html($label); ?> (<?php echo $declarations_counts[$value] ?? 0; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>

                <?php endif; ?>

            </div>


            <!-- BUTTON -->
            <div class="col-12">
                <button type="submit"
                    class="btn w-100  fw-bold archive-filter-btn"
                    style="background-color:#6b4a1f;color:white;">
                    Search
                </button>
            </div>
        </div>




        <div class="sidebar_article archive-hide show-mobile-only">
            <?php
            // Define your custom order
            $custom_order = ['level-i', 'level-ii', 'presumption-removed', 'delisted'];

            // Fetch all terms
            $all_terms = get_terms([
                'taxonomy'   => 'level_status',
                'hide_empty' => false,
            ]);

            // Create a map of slug => term
            $terms_map = [];
            foreach ($all_terms as $term) {
                $terms_map[$term->slug] = $term;
            }

            // Build the final ordered array
            $terms_in_order = [];

            // First, add terms in custom order if they exist
            foreach ($custom_order as $slug) {
                if (isset($terms_map[$slug])) {
                    $terms_in_order[] = $terms_map[$slug];
                    unset($terms_map[$slug]); // remove so remaining terms can be sorted later
                }
            }

            // Add remaining terms alphabetically
            if (!empty($terms_map)) {
                usort($terms_map, function ($a, $b) {
                    return strcasecmp($a->name, $b->name);
                });
                $terms_in_order = array_merge($terms_in_order, $terms_map);
            }

            // Colors per term slug
            $colors = [
                'level-i'             => 'bg-success success-hover',
                'level-ii'            => 'bg-warning warning-hover',
                'delisted'            => 'bg-brown brown-hover',
                'removed'             => 'bg-danger danger-hover',
                'presumption-removed' => 'bg-danger danger-hover',
            ];
            ?>

            <div class="my-5">
                <div class="registry-box text-center border">
                    <h3 class="fw-bold mb-4">REGISTRY IN NUMBERS</h3>

                    <div class="row g-4 justify-content-center">

                        <?php foreach ($terms_in_order as $term) :
                            $bg_class = isset($colors[$term->slug]) ? $colors[$term->slug] : 'bg-primary primary-hover';

                            // Grab current URL parameters
                            $current_params = $_GET;

                            // Replace level_status with current term
                            $current_params['level_status'] = $term->slug;

                            // Build full URL with all existing filters
                            $filter_link = add_query_arg($current_params, home_url('/historical-sites/'));
                        ?>

                            <div class="col-md-5 col-6">
                                <a href="<?php echo esc_url($filter_link); ?>" class="text-decoration-none">
                                    <div class="stat-card <?php echo $bg_class; ?>">
                                        <div class="stat-number">
                                            <?php echo $term->count; ?>
                                        </div>
                                        <div class="stat-label">
                                            <?php echo strtoupper($term->name); ?>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        <?php endforeach; ?>

                    </div>
                </div>
            </div>

            <?php get_template_part('partials/sidebar-welcome'); ?>
            <?php get_template_part('partials/sidebar-location-info'); ?>
        </div>


    </form>

</div>



</div>