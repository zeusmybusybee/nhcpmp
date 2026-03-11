<!-- RIGHT: SIDEBAR -->
<div class=" archive-right-col archive-right ">
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
                            'date-desc' => 'Newest to Oldest',
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

                <select name="region" class="form-select mb-2">
                    <option value="">Region</option>

                    <?php
                    $regions = get_terms([
                        'taxonomy' => 'regions',
                        'hide_empty' => false
                    ]);

                    $current_region = $_GET['region'] ?? '';

                    if (!empty($regions) && !is_wp_error($regions)) {
                        foreach ($regions as $region) {

                            echo '<option value="' . esc_attr($region->slug) . '" ' . selected($current_region, $region->slug, false) . '>';
                            echo esc_html($region->name) . ' (' . $region->count . ')';
                            echo '</option>';
                        }
                    }
                    ?>

                </select>

                <select name="province" class="form-select mb-2 d-none">
                    <option value="">Province</option>

                    <?php
                    $provinces = get_terms([
                        'taxonomy' => 'provinces',
                        'hide_empty' => false
                    ]);

                    $current_province = $_GET['province'] ?? '';

                    if (!empty($provinces) && !is_wp_error($provinces)) {
                        foreach ($provinces as $province) {

                            echo '<option value="' . esc_attr($province->slug) . '" ' . selected($current_province, $province->slug, false) . '>';
                            echo esc_html($province->name) . ' (' . $province->count . ')';
                            echo '</option>';
                        }
                    }
                    ?>

                </select>
                <!-- CITY -->

                <select name="city" class="form-select mb-2 d-none">
                    <option value="">City / Municipality</option>

                    <?php
                    $cities = get_terms([
                        'taxonomy' => 'citymunicipality',
                        'hide_empty' => false
                    ]);

                    $current_city = $_GET['city'] ?? '';

                    if (!empty($cities) && !is_wp_error($cities)) {
                        foreach ($cities as $city) {

                            echo '<option value="' . esc_attr($city->slug) . '" ' . selected($current_city, $city->slug, false) . '>';
                            echo esc_html($city->name) . ' (' . $city->count . ')';
                            echo '</option>';
                        }
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

                    // Get all posts
                    $all_posts = get_posts([
                        'post_type'      => 'historical-sites',
                        'posts_per_page' => -1,
                        'post_status'    => 'publish',
                        'fields'         => 'ids',
                    ]);

                    // Count posts per update
                    $updates_counts = [];

                    foreach ($all_posts as $post_id) {
                        $update_value = get_field('updates', $post_id);

                        if ($update_value) {
                            if (!isset($updates_counts[$update_value])) {
                                $updates_counts[$update_value] = 0;
                            }
                            $updates_counts[$update_value]++;
                        }
                    }

                    $current_update = $_GET['update_filter'] ?? '';
                ?>

                    <select name="update_filter" class="form-select mb-2">
                        <option value="">Updates</option>

                        <?php foreach ($updates_field['choices'] as $value => $label): ?>
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

                    // Get all posts
                    $all_posts = get_posts([
                        'post_type'      => 'historical-sites',
                        'posts_per_page' => -1,
                        'post_status'    => 'publish',
                        'fields'         => 'ids',
                    ]);

                    // Count posts per marker series
                    $series_counts = [];

                    foreach ($all_posts as $post_id) {
                        $series = get_field('marker_series', $post_id);

                        if ($series) {
                            if (!isset($series_counts[$series])) {
                                $series_counts[$series] = 0;
                            }
                            $series_counts[$series]++;
                        }
                    }

                    $current_series = $_GET['marker_filter'] ?? '';
                ?>

                    <select name="marker_filter" class="form-select mb-2">
                        <option value="">Marker Series</option>

                        <?php foreach ($series_field['choices'] as $value => $label): ?>
                            <option value="<?php echo esc_attr($value); ?>" <?php selected($current_series, $value); ?>>
                                <?php echo esc_html($label); ?> (<?php echo $series_counts[$value] ?? 0; ?>)
                            </option>
                        <?php endforeach; ?>

                    </select>

                <?php endif; ?>

                <?php
                $updates_field = acf_get_field('marker_updates');

                if ($updates_field && !empty($updates_field['choices'])) :

                    // Get all posts
                    $all_posts = get_posts([
                        'post_type'      => 'historical-sites',
                        'posts_per_page' => -1,
                        'post_status'    => 'publish',
                        'fields'         => 'ids',
                    ]);

                    // Count posts per marker update
                    $updates_counts = [];

                    foreach ($all_posts as $post_id) {
                        $update = get_field('marker_updates', $post_id);

                        if ($update) {
                            if (!isset($updates_counts[$update])) {
                                $updates_counts[$update] = 0;
                            }
                            $updates_counts[$update]++;
                        }
                    }

                    $current_update = $_GET['marker_filter'] ?? '';
                ?>

                    <select name="marker_filter" class="form-select mb-2">
                        <option value="">Marker Updates</option>

                        <?php foreach ($updates_field['choices'] as $value => $label): ?>
                            <option value="<?php echo esc_attr($value); ?>" <?php selected($current_update, $value); ?>>
                                <?php echo esc_html($label); ?> (<?php echo $updates_counts[$value] ?? 0; ?>)
                            </option>
                        <?php endforeach; ?>

                    </select>

                <?php endif; ?>


                <?php
                $declarations_field = acf_get_field('group_declarations');

                if ($declarations_field && !empty($declarations_field['choices'])) :

                    // Get all posts
                    $all_posts = get_posts([
                        'post_type'      => 'historical-sites',
                        'posts_per_page' => -1,
                        'post_status'    => 'publish',
                        'fields'         => 'ids',
                    ]);

                    // Count posts per group declaration
                    $declarations_counts = [];

                    foreach ($all_posts as $post_id) {
                        $declaration = get_field('group_declarations', $post_id);

                        if ($declaration) {
                            if (!isset($declarations_counts[$declaration])) {
                                $declarations_counts[$declaration] = 0;
                            }
                            $declarations_counts[$declaration]++;
                        }
                    }

                    $current_declaration = $_GET['declaration_filter'] ?? '';
                ?>

                    <select name="declaration_filter" class="form-select mb-2">
                        <option value="">Group Declarations</option>

                        <?php foreach ($declarations_field['choices'] as $value => $label): ?>
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




        <div class="sidebar_article archive-hide">
            <?php
            $terms = get_terms([
                'taxonomy'   => 'level_status',
                'hide_empty' => false,
            ]);
            ?>
            <div class="my-5">
                <div class="registry-box text-center border">
                    <h3 class="fw-bold mb-4">REGISTRY IN NUMBERS</h3>

                    <div class="row g-4 justify-content-center">

                        <?php foreach ($terms as $term) : ?>

                            <?php
                            // Custom colors per term slug
                            $colors = [
                                'level-i'  => 'bg-success success-hover',
                                'level-ii' => 'bg-warning warning-hover',
                                'delisted' => 'bg-brown  brown-hover',
                                'removed'  => 'bg-danger danger-hover',
                            ];

                            $bg_class = isset($colors[$term->slug]) ? $colors[$term->slug] : 'bg-primary  primary-hover';

                            // Custom filter link
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