<?php get_header(); ?>

<div class="container py-5">

    <div class="row">

        <!-- LEFT: RESULTS -->
        <div class="col-lg-8">
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
                    <?php the_posts_pagination(['type' => 'list']); ?>
                </div>
            </div>
            <div class="row g-4">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="col-lg-4 col-md-6">
                            <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                <div class="card h-100 border-0 shadow-sm text-center p-4">

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
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="mb-3">
                                            <?php the_post_thumbnail(
                                                'small',
                                                ['class' => 'img-fluid mx-auto d-block']
                                            ); ?>
                                        </div>
                                    <?php endif; ?>

                                    <!-- TITLE -->
                                    <h6 class="fw-semibold mb-2">
                                        <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                            <?php the_title(); ?>
                                        </a>
                                    </h6>

                                    <!-- META -->
                                    <div class="text-muted small mt-auto text-start">
                                        <?php if ($regions = get_field('regions')) : ?>
                                            <div>Location: <?php echo esc_html($regions); ?> <?php echo esc_html(get_field('province_municipality')); ?></div>
                                        <?php endif; ?>
                                        <div><?php if (get_field('year_found')): echo 'Year Found:' . get_field('year_found');
                                                endif; ?></div>
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
        <div class="col-lg-4">
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
                        <input type="search" name="s" class="form-control border-0" placeholder="Search historical sites..."
                            value="<?php echo esc_attr($search_term); ?>">
                        <button class="button" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </div>

                <!-- FILTERS -->
                <div class="row g-4 border rounded p-4 bg-body-tertiary">

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

            </form>

        </div>



    </div>
</div>

<?php get_footer(); ?>