<?php get_header(); ?>
<div class="container ">

    <div class="row">

        <!-- LEFT: RESULTS -->
        <div class="col-lg-8 archive-left">

            <?php get_template_part('partials/total-result'); ?>


            <!-- Top Bar: Results Count & Pagination -->
            <div class="d-flex justify-content-between align-items-center mb-4 top-result">
                <!-- LEFT -->
                <?php get_template_part('partials/result-perpage'); ?>

                <div class="pagination-nav">
                    <?php echo do_shortcode('[custom_pagination]'); ?>
                </div>
            </div>
            <div class="row g-5 mt-4">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="col-lg-6 col-md-6">
                            <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark historic-link-item">
                                <div class="card h-100 border-0 shadow-sm text-start p-4 historic-content">

                                    <!-- Badges -->
                                    <div class="d-flex gap-2 mb-2 flex-wrap">
                                        <?php
                                        $terms = get_the_terms(get_the_ID(), 'level_status');
                                        if ($terms && !is_wp_error($terms)) :
                                            $status_map = [
                                                'level-i'  => ['label' => 'Level I',    'class' => 'badge-open'],
                                                'level-ii' => ['label' => 'Level II',   'class' => 'badge-viewing'],
                                                'delisted' => ['label' => 'Delisted',   'class' => 'badge-limited'],
                                                'removed'  => ['label' => 'Removed',    'class' => 'badge-exclusive'],
                                            ];

                                            foreach ($terms as $term) :
                                                if ($term && isset($status_map[$term->slug])) :
                                        ?>
                                                    <span class="access-badge <?php echo esc_attr($status_map[$term->slug]['class']); ?>">
                                                        <?php echo esc_html($status_map[$term->slug]['label']); ?>
                                                    </span>
                                        <?php
                                                endif;
                                            endforeach;
                                        else :
                                            echo 'No terms found for this post or terms are not active.';
                                        endif;
                                        ?>
                                    </div>

                                    <!-- Thumbnail -->
                                    <div class="mb-3 historic-images">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail(
                                                'small',
                                                ['class' => 'img-fluid mx-auto d-block']
                                            ); ?>
                                        <?php else : ?>
                                            <img
                                                src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/temp-logo.png"
                                                class="img-fluid mx-auto d-block default-image"
                                                alt="Default Image">
                                        <?php endif; ?>
                                    </div>

                                    <!-- TITLE -->
                                    <h3 class="fw-semibold mb-2">
                                        <?php the_title(); ?>
                                    </h3>

                                    <!-- META -->
                                    <div class="text-muted small text-start mt-5 historic-metadata">
                                        <?php
                                        $international = get_field('international_for_historic');
                                        $province = get_field('province_for_historic');
                                        $city = get_field('city_and_municipality_for_historic');

                                        $location_parts = [];

                                        // priority sa international
                                        if ($international) {
                                            $location_parts[] = $international;
                                        } else {
                                            if ($city) {
                                                $location_parts[] = $city;
                                            }

                                            if ($province) {
                                                $location_parts[] = $province;
                                            }
                                        }

                                        if (!empty($location_parts)) :
                                        ?>
                                            <div>
                                                <strong class="meta-label">Location:</strong>
                                                <span><?php echo esc_html(implode(', ', $location_parts)); ?></span>
                                            </div>
                                        <?php endif; ?>

                                        <?php
                                        $category = get_field('category'); // ACF field

                                        if ($category) :
                                        ?>
                                            <div>
                                                <strong class="meta-label">Category:</strong>
                                                <span><?php echo esc_html($category); ?></span>
                                            </div>
                                        <?php endif; ?>

                                        <?php
                                        $years = get_field('m_dates');

                                        if ($years && !empty($years)) :
                                            // Get the first year as default
                                            $default_year = $years[0];
                                        ?>
                                            <div>
                                                <strong class="meta-label">Year: </strong>
                                                <span>
                                                    <?php echo esc_html($default_year); ?>
                                                </span>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>

                <?php else : ?>
                    <div class="d-flex align-items-center mb-5 mt-4">

                        <div class="archive-no-results-icon col-3">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/404-img.png" alt="404">
                        </div>
                        <div class="col-9 ">
                            <h2>We're still gathering memories.</h2>

                            <p class="archive-subtext">
                                It looks like nothing was found at this location. Maybe try one of the links below or a search?
                            </p>

                            <a href="javascript:history.back()" class="archive-back">
                                Back to previous
                            </a>
                        </div>

                    </div>
                <?php endif; ?>
            </div>
            <!-- bottom Bar: Results Count & Pagination -->
            <div class="d-flex justify-content-between align-items-center mb-4 top-result">

                <!-- LEFT -->
                <?php get_template_part('partials/result-perpage'); ?>

                <!-- CENTER -->
                <div class="text-center mt-4">
                    <a href="#top" class="back-to-top-text ">Back to Top</a>
                </div>

                <!-- RIGHT -->
                <div class="pagination-nav">
                    <?php echo do_shortcode('[custom_pagination]'); ?>
                </div>

            </div>
        </div>

        <!-- RIGHT: SIDEBAR -->
        <div class="col-lg-4 archive-right-col archive-right ">
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
                                <label class="form-check-label">A–Z</label>
                            </div>
                            <div class="form-check d-flex align-items-center">
                                <input class="form-check-input mb-2" type="radio" name="orderby" value="title-desc"
                                    <?php checked($current_order, 'title-desc'); ?>>
                                <label class="form-check-label">Z–A</label>
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
                        <h6 class="mb-3 fw-bold">Filter by Status</h6>

                        <?php
                        $current = $_GET['level_status'] ?? '';

                        $custom_order = [
                            'level-i',
                            'level-ii',
                            'presumption-removed',
                            'delisted'
                        ];

                        $terms = get_terms([
                            'taxonomy'   => 'level_status',
                            'hide_empty' => false,
                        ]);
                        ?>

                        <select name="level_status" id="level_status" class="form-select mb-2">
                            <option value="">-Status-</option>

                            <?php
                            if (!is_wp_error($terms) && !empty($terms)) {

                                $terms_by_slug = [];

                                foreach ($terms as $term) {
                                    $terms_by_slug[$term->slug] = $term;
                                }

                                foreach ($custom_order as $slug) {

                                    if (isset($terms_by_slug[$slug])) {

                                        $term = $terms_by_slug[$slug];
                            ?>
                                        <option value="<?php echo esc_attr($term->slug); ?>" <?php selected($current, $term->slug); ?>>
                                            <?php echo esc_html($term->name); ?> (<?php echo $term->count; ?>)
                                        </option>
                            <?php
                                    }
                                }
                            }
                            ?>

                        </select>


                        <?php
                        $terms = get_terms([
                            'taxonomy' => 'registry_category',
                            'hide_empty' => false,
                        ]);

                        $current = $_GET['registry_category'] ?? '';
                        ?>

                        <select name="registry_category" id="registry_category" class="form-select">
                            <option value="">-Category-</option>

                            <?php if (!is_wp_error($terms) && !empty($terms)): ?>
                                <?php foreach ($terms as $term): ?>

                                    <option value="<?php echo esc_attr($term->slug); ?>" <?php selected($current, $term->slug); ?>>
                                        <?php echo esc_html($term->name); ?> (<?php echo $term->count; ?>)
                                    </option>

                                <?php endforeach; ?>
                            <?php endif; ?>

                        </select>

                        <?php
                        global $wpdb;

                        $field_name = 'type';
                        $current = $_GET['type'] ?? '';

                        $results = $wpdb->get_results("
                        SELECT meta_value, COUNT(*) as total
                        FROM {$wpdb->postmeta}
                        WHERE meta_key = '{$field_name}'
                        AND meta_value != ''
                        GROUP BY meta_value
                        ORDER BY meta_value ASC
                    ");
                        ?>

                        <select name="type" id="type" class="form-select mb-2 mt-2">
                            <option value="">-Type-</option>

                            <?php if ($results): ?>
                                <?php foreach ($results as $row): ?>

                                    <option value="<?php echo esc_attr($row->meta_value); ?>" <?php selected($current, $row->meta_value); ?>>
                                        <?php echo esc_html($row->meta_value); ?> (<?php echo $row->total; ?>)
                                    </option>

                                <?php endforeach; ?>
                            <?php endif; ?>

                        </select>
                    </div>

                    <!-- FILTER BY PLACE -->
                    <div class="col-12 mb-3">
                        <h6 class="mb-3 fw-bold">Filter by Place</h6>

                        <!-- REGION -->
                        <select name="region_for_historic" class="form-select mb-2">
                            <option value="">Region</option>

                            <?php
                            global $wpdb;

                            $regions = $wpdb->get_col("
                            SELECT DISTINCT meta_value 
                            FROM $wpdb->postmeta 
                            WHERE meta_key = 'region_for_historic'
                              AND meta_value != ''
                            ORDER BY meta_value ASC
                        ");

                            $current_region = $_GET['region_for_historic'] ?? '';

                            foreach ($regions as $region) {
                                // Count how many posts have this region
                                $count = $wpdb->get_var($wpdb->prepare("
                                SELECT COUNT(*) 
                                FROM $wpdb->postmeta 
                                WHERE meta_key = 'region_for_historic' 
                                  AND meta_value = %s
                            ", $region));

                                echo '<option value="' . esc_attr($region) . '" ' . selected($current_region, $region, false) . '>';
                                echo esc_html($region . " ($count)");
                                echo '</option>';
                            }
                            ?>
                        </select>

                        <!-- PROVINCE -->
                        <select name="province_for_historic" class="form-select mb-2">
                            <option value="">Select Province</option>
                            <?php
                            $provinces = $wpdb->get_col("
                            SELECT DISTINCT meta_value
                            FROM $wpdb->postmeta
                            WHERE meta_key = 'province_for_historic'
                              AND meta_value != ''
                            ORDER BY meta_value ASC
                        ");

                            $current_province = $_GET['province_for_historic'] ?? '';

                            foreach ($provinces as $province) {
                                $count = $wpdb->get_var($wpdb->prepare("
                                SELECT COUNT(*) 
                                FROM $wpdb->postmeta 
                                WHERE meta_key = 'province_for_historic' 
                                  AND meta_value = %s
                            ", $province));

                                echo '<option value="' . esc_attr($province) . '" ' . selected($current_province, $province, false) . '>';
                                echo esc_html($province . " ($count)");
                                echo '</option>';
                            }
                            ?>
                        </select>

                        <!-- CITY -->
                        <select name="city_and_municipality_for_historic" class="form-select mb-2">
                            <option value="">Select City / Municipality</option>
                            <?php
                            $cities = $wpdb->get_col("
                            SELECT DISTINCT meta_value
                            FROM $wpdb->postmeta
                            WHERE meta_key = 'city_and_municipality_for_historic'
                              AND meta_value != ''
                            ORDER BY meta_value ASC
                        ");

                            $current_city = $_GET['city_and_municipality_for_historic'] ?? '';

                            foreach ($cities as $city) {
                                $count = $wpdb->get_var($wpdb->prepare("
                                SELECT COUNT(*) 
                                FROM $wpdb->postmeta 
                                WHERE meta_key = 'city_and_municipality_for_historic' 
                                  AND meta_value = %s
                            ", $city));

                                echo '<option value="' . esc_attr($city) . '" ' . selected($current_city, $city, false) . '>';
                                echo esc_html($city . " ($count)");
                                echo '</option>';
                            }
                            ?>
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

                            // ✅ ALWAYS get ALL posts (not affected by filters)
                            $all_posts = get_posts([
                                'post_type'        => 'historical-sites',
                                'posts_per_page'   => -1,
                                'post_status'      => 'publish',
                                'fields'           => 'ids',
                                'suppress_filters' => true // 🔥 important fix
                            ]);

                            $series_counts = [];

                            // Initialize choices
                            foreach ($series_field['choices'] as $value => $label) {
                                if ($label === 'Select Status') continue;
                                $series_counts[$value] = 0;
                            }

                            // ✅ CORRECT counting for multiple ACF field
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
                                    $filter_link = home_url('/historical-sites/?s=&level_status=' . $term->slug . '&registry_category=&region=&province=&city=&location=&year_filter=&orderby=date-desc');
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
    <div id="show-mobile-only"></div>
</div>

<?php get_footer(); ?>
