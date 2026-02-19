<?php get_header(); ?>
<style>
    .historic-images img {
        margin: 0;

        width: 100%;
        object-fit: cover;
        height: clamp(185px, 25vw, 372px);
    }

    .post-type-archive-historical-sites div#content {
        background: #ffff;
    }

    .historic-content h3 {
        font-size: 20px;
        font-weight: 400 !important;
    }

    .historic-link-item {
        position: relative;
    }

    .historic-link-item span.access-badge {
        padding: initial;
        padding: 6px 45px;
        position: absolute;
        top: -10px;
        border-radius: 10px;
    }

    .total-result {
        background: #FAFAFA;
    }

    .historic-content {
        padding: 35px 15px !important;
        background: #FAFAFA;
    }

    select.form-select.mb-2 {
        background: #707070;
        color: #fff;
    }

    .historic-right-col .form-select {
        background: #707070;
        color: #fff;
        padding: 10px;
        font-size: 14px;
    }

    .historic-right-col h6 {
        font-size: 16px;
        color: #6b4a1f;
    }

    .historic-right-col button {
        border-radius: 10px;
        border: unset;
    }

    .historic-right-col input,
    .historic-right-col input::placeholder {
        font-weight: 700;
        font-size: 16px;
        color: #A01515 !important;
    }

    .historic-right-col .sidebar_article .nm-sidebar-card {
        margin: 20px 0;
    }

    .registry-box {
        border-radius: 15px;
        padding: 40px 20px;
        background-color: #f8f9fa;
    }

    .stat-card {
        border-radius: 15px;
        color: white;
        text-align: center;
        padding: 30px 10px;
        font-weight: bold;
    }

    .stat-number {
        font-size: 36px;
        font-weight: 800;
    }

    .stat-label {
        font-size: 14px;
        letter-spacing: 1px;
    }

    .bg-level1 {
        background-color: #39b54a;
    }

    .bg-level2 {
        background-color: #c9b225;
    }

    .bg-delisted {
        background-color: #b87300;
    }

    .bg-removed {
        background-color: #9e1b1b;
    }

    .historic-metadata div {
        font-size: 15px;
        margin-bottom: 10px;
    }
</style>
<div class="container py-5">

    <div class="row">

        <!-- LEFT: RESULTS -->
        <div class="col-lg-8">
            <?php
            global $wp_query;


            ?>

            <div class="d-flex justify-content-between align-items-center mb-3 total-result  p-4 mb-3">
                <h4 class="mb-0 mt-0" style="color:#704b10">
                    Top <?php echo $wp_query->post_count;  ?> results for All artifacts
                </h4>
            </div>
            <!-- Top Bar: Results Count & Pagination -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center gap-2">
                    <small>Top <?php echo $wp_query->post_count; ?> results for <?php single_cat_title(); ?></small>
                    <select class="form-select form-select-sm" style="width: auto;">
                        <option selected>10</option>
                        <option>25</option>
                        <option>50</option>
                    </select>
                </div>
                <div class="pagination-nav">
                    <?php echo do_shortcode('[custom_pagination]'); ?>
                </div>
            </div>
            <div class="row g-5">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="col-lg-6 col-md-6">
                            <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark historic-link-item">
                                <div class="card h-100 border-0 shadow-sm text-start p-4 historic-content">

                                    <div class="d-flex gap-2 mb-2 flex-wrap">
                                        <?php
                                        $status = get_field('status');

                                        $status_map = [
                                            'level_1'      => ['label' => 'Level I',    'class' => 'badge-open'],
                                            'level_2'   => ['label' => 'Level II',        'class' => 'badge-viewing'],
                                            'delisted'   => ['label' => 'Delisted',        'class' => 'badge-limited'],
                                            'removed' => ['label' => 'Removed',     'class' => 'badge-exclusive'],
                                        ];

                                        ?>

                                        <?php if ($status && isset($status_map[$status])) : ?>
                                            <span class="access-badge <?php echo esc_attr($status_map[$status]['class']); ?>">
                                                <?php echo esc_html($status_map[$status]['label']); ?>
                                            </span>
                                        <?php endif; ?>
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
                                                src="<?php echo home_url('/wp-content/uploads/2023/06/Simbahan-ng-Tayabas-1-1.jpg'); ?>"
                                                class="img-fluid mx-auto d-block"
                                                alt="Default Image">
                                        <?php endif; ?>
                                    </div>


                                    <!-- TITLE -->
                                    <h3 class="fw-semibold mb-2">
                                        <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>

                                    <!-- META -->
                                    <div class="text-muted small  text-start mt-5 historic-metadata">

                                        <?php if ($regions = get_field('regions')) : ?>
                                            <div>
                                                Location: <?php echo esc_html($regions); ?>
                                                <?php echo esc_html(get_field('province_municipality')); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($year = get_field('year_found')) : ?>
                                            <div>
                                                Year Found: <?php echo esc_html($year); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php
                                        $terms = get_the_terms(get_the_ID(), 'registry_category');
                                        if ($terms && !is_wp_error($terms)) :
                                        ?>
                                            <div>
                                                Category:
                                                <?php
                                                $term_names = wp_list_pluck($terms, 'name');
                                                echo esc_html(implode(', ', $term_names));
                                                ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php
                                        $terms = get_the_terms(get_the_ID(), 'level_status');
                                        if ($terms && !is_wp_error($terms)) :
                                        ?>
                                            <div>
                                                Category:
                                                <?php
                                                $term_names = wp_list_pluck($terms, 'name');
                                                echo esc_html(implode(', ', $term_names));
                                                ?>
                                            </div>
                                        <?php endif; ?>

                                    </div>


                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>

                <?php else : ?>
                    <div class="col-12 text-center py-5">
                        <h4>No items found matching your search or filters.</h4>
                        <p>Please try a different search term or filter.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- RIGHT: SIDEBAR -->
        <div class="col-lg-4 historic-right-col">
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

                <!-- FILTERS -->
                <div class=" g-4 border rounded p-4 bg-body-tertiary">

                    <!-- FILTER BY -->
                    <div class="col-12 mb-3">
                        <h6 class="mb-3 fw-bold">Filter by Status</h6>

                        <select name="status" class="form-select mb-2">
                            <option value="">-Select-</option>
                            <option value="level_1" <?php selected($_GET['status'] ?? '', 'level_1'); ?>>Level I</option>
                            <option value="level_2" <?php selected($_GET['status'] ?? '', 'level_2'); ?>>Level II</option>
                            <option value="delisted" <?php selected($_GET['status'] ?? '', 'delisted'); ?>>Delisted</option>
                            <option value="removed" <?php selected($_GET['status'] ?? '', 'removed'); ?>>Removed</option>
                        </select>

                        <select name="marker_category" class="form-select">
                            <option value="">-Select-</option>
                            <option value="structures" <?php selected($_GET['marker_category'] ?? '', 'structures'); ?>>Structures</option>
                            <option value="buildings" <?php selected($_GET['marker_category'] ?? '', 'buildings'); ?>>Buildings</option>
                        </select>
                    </div>

                    <!-- FILTER BY PLACE -->
                    <div class="col-12 mb-3">
                        <h6 class="mb-3 fw-bold">Filter by Place</h6>

                        <select id="region" name="region" class="form-select mb-2">
                            <option value="">Region</option>
                        </select>

                        <select id="province" name="province" class="form-select mb-2">
                            <option value="">Province</option>
                        </select>

                        <select id="city" name="city" class="form-select mb-2">
                            <option value="">City / Municipality</option>
                        </select>
                    </div>


                    <!-- FILTER BY TIME -->
                    <div class="col-12">
                        <h6 class="mb-3 fw-bold">Filter by Time</h6>

                        <select name="year_filter" class="form-select mb-2">
                            <option value="">Year</option>
                        </select>

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
                            class="btn w-100 mt-4 fw-bold"
                            style="background-color:#6b4a1f;color:white;">
                            Apply Filters
                        </button>
                    </div>
                </div>


                <?php
                $terms = get_terms([
                    'taxonomy'   => 'level_status',
                    'hide_empty' => false,
                ]);
                ?>

                <div class=" my-5">
                    <div class="registry-box text-center border">
                        <h3 class="fw-bold mb-4">REGISTRY IN NUMBERS</h3>

                        <div class="row g-4 justify-content-center">

                            <?php foreach ($terms as $term) : ?>

                                <?php
                                // Custom colors per term slug
                                $colors = [
                                    'level-i'  => 'bg-success',
                                    'level-ii' => 'bg-warning',
                                    'delisted' => 'bg-brown',
                                    'removed'  => 'bg-danger',
                                ];

                                $bg_class = isset($colors[$term->slug]) ? $colors[$term->slug] : 'bg-primary';
                                ?>

                                <div class="col-md-5 col-6">
                                    <div class="stat-card <?php echo $bg_class; ?>">
                                        <div class="stat-number">
                                            <?php echo $term->count; ?>
                                        </div>
                                        <div class="stat-label">
                                            <?php echo strtoupper($term->name); ?>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>


                <div class="sidebar_article">
                    <?php get_template_part('partials/sidebar-welcome'); ?>
                    <?php get_template_part('partials/sidebar-location-info'); ?>

                </div>

            </form>

        </div>



    </div>
</div>

<?php get_footer(); ?>