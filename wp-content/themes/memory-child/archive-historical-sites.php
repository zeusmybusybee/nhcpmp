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
                                        $location = get_field('location');
                                        if ($location) :
                                            if (is_array($location)) {
                                                $location = array_map(function ($item) {
                                                    return is_object($item) ? $item->name : $item;
                                                }, $location);
                                                $location = implode(', ', $location);
                                            }
                                        ?>
                                            <div>
                                                <strong class="meta-label">Location:</strong>
                                                <span><?php echo esc_html($location); ?></span>
                                            </div>
                                        <?php endif; ?>

                                        <?php
                                        $terms = get_the_terms(get_the_ID(), 'registry_category');
                                        if ($terms && !is_wp_error($terms)) :
                                        ?>
                                            <div>
                                                <strong class="meta-label">Category:</strong>
                                                <span>
                                                    <?php
                                                    $term_names = wp_list_pluck($terms, 'name');
                                                    echo esc_html(implode(', ', $term_names));
                                                    ?>
                                                </span>
                                            </div>
                                        <?php endif; ?>

                                        <?php
                                        $terms = get_the_terms(get_the_ID(), 'level_status');
                                        if ($terms && !is_wp_error($terms)) :
                                        ?>
                                            <div>
                                                <strong class="meta-label">Level & Status:</strong>
                                                <span>
                                                    <?php
                                                    $term_names = wp_list_pluck($terms, 'name');
                                                    echo esc_html(implode(', ', $term_names));
                                                    ?>
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

                    <!-- FILTER BY -->
                    <div class="col-12 mb-3">
                        <h6 class="mb-3 fw-bold">Filter by Status</h6>


                        <?php
                        $current = $_GET['level_status'] ?? '';

                        $terms = get_terms([
                            'taxonomy'   => 'level_status',
                            'hide_empty' => false,
                        ]);
                        ?>

                        <select name="level_status" class="form-select mb-2">
                            <option value="">-Select-</option>

                            <?php if (!is_wp_error($terms) && !empty($terms)): ?>
                                <?php foreach ($terms as $term): ?>

                                    <option value="<?php echo esc_attr($term->slug); ?>" <?php selected($current, $term->slug); ?>>
                                        <?php echo esc_html($term->name); ?> (<?php echo $term->count; ?>)
                                    </option>

                                <?php endforeach; ?>
                            <?php endif; ?>

                        </select>


                        <?php
                        // Get terms from the 'registry_category' taxonomy
                        $terms = get_terms([
                            'taxonomy' => 'registry_category',
                            'hide_empty' => false,
                        ]);

                        $current = $_GET['registry_category'] ?? '';
                        ?>

                        <select name="registry_category" class="form-select">
                            <option value="">-Select-</option>

                            <?php if (!is_wp_error($terms) && !empty($terms)): ?>
                                <?php foreach ($terms as $term): ?>

                                    <option value="<?php echo esc_attr($term->slug); ?>" <?php selected($current, $term->slug); ?>>
                                        <?php echo esc_html($term->name); ?> (<?php echo $term->count; ?>)
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

                        <select name="province" class="form-select mb-2">
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

                        <select name="city" class="form-select mb-2">
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
                        $field = get_field_object('m_dates');

                        if ($field && isset($field['choices'])) :
                            // Get all choices
                            $choices = $field['choices'];

                            // Sort keys (year values) descending
                            krsort($choices);

                        ?>
                            <select name="year_filter" class="form-select mb-2">
                                <option value="">Year</option>
                                <?php foreach ($choices as $value => $label): ?>
                                    <option value="<?php echo esc_attr($value); ?>">
                                        <?php echo esc_html($label); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif; ?>

                        <select name="orderby" class="form-select">
                            <option value="date-desc" <?php selected($_GET['orderby'] ?? '', 'date-desc'); ?>>
                                Newest to Oldest
                            </option>
                            <option value="date-asc" <?php selected($_GET['orderby'] ?? '', 'date-asc'); ?>>
                                Oldest to Newest
                            </option>
                        </select>
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



    </div>
</div>

<?php get_footer(); ?>