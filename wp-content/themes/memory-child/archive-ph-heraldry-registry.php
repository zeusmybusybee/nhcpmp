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

                            <div class="card h-100 border-0 shadow-sm text-center p-4">
                                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">

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
                                        <?php if ($region = get_field('region')) :   $region_field = get_field_object('region'); ?>
                                            <div>Location: <?php echo esc_html($region_field['choices'][$region] ?? $region); ?> <?php echo esc_html(get_field('province_text')); ?>, <?php echo esc_html(get_field('city_text')); ?></div>
                                        <?php endif; ?>
                                        <?php
                                        $seals_logos = get_field('seals_logos'); // returns array of slugs, e.g. ['suc','military']

                                        if (!empty($seals_logos) && is_array($seals_logos)):

                                            // Map ACF slugs to labels (same as your filter options)
                                            $seals_labels = [
                                                'judiciary' => 'Judiciary/Legislative',
                                                'nga'       => 'National Government Agencies (NGA)',
                                                'lgu'       => 'Local Government Unit (LGU)',
                                                'gocc'      => 'Government-Owned Controlled Corporation',
                                                'military'  => 'Military',
                                                'suc'       => 'State University and College (SUC)',
                                                'others'    => 'Others',
                                            ];

                                            $output_labels = [];
                                            foreach ($seals_logos as $slug) {
                                                if (isset($seals_labels[$slug])) {
                                                    $output_labels[] = $seals_labels[$slug];
                                                }
                                            }

                                            echo '<div>Category: ' . esc_html(implode(', ', $output_labels)) . '</div>';

                                        endif;
                                        ?>
                                        <div><?php if (get_field('year_approved')): echo 'Year Approved:' . get_field('year_approved');
                                                endif; ?></div>
                                    </div>
                                </a>
                            </div>

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

            <form method="get" action="<?php echo esc_url(get_post_type_archive_link('ph-heraldry-registry')); ?>" class="p-4">

                <!-- SEARCH -->
                <div class="row g-4 border rounded mb-5">
                    <div class="input-group">
                        <input type="search" name="s" class="form-control border-0" placeholder="Search items..."
                            value="<?php echo esc_attr($search_term); ?>">
                        <button class="button" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </div>

                <!-- APPLIED FILTERS SUMMARY -->
                <?php if (!empty($heraldric_items_selected) || !empty($seals_selected) || !empty($sort_by) || !empty($search_term)): ?>
                    <div class="row g-4 border rounded mb-5">
                        <strong>Applied Filters:</strong>
                        <ul class="mb-0 list-unstyled">
                            <?php
                            foreach ($heraldric_items_selected as $item) {
                                echo '<li>Heraldic Item: ' . esc_html($item) . '</li>';
                            }
                            foreach ($seals_selected as $seal) {
                                echo '<li>Seal/Logo: ' . esc_html($seal) . '</li>';
                            }
                            if ($sort_by) {
                                echo '<li>Sort: ' . esc_html($sort_by) . '</li>';
                            }
                            if ($search_term) {
                                echo '<li>Search: ' . esc_html($search_term) . '</li>';
                            }
                            ?>
                        </ul>
                        <button class="box">
                            <a href="<?php echo esc_url(get_post_type_archive_link('ph-heraldry-registry')); ?>" class="btn btn-sm btn-secondary mt-2">Clear All</a>
                        </button>
                    </div>
                <?php endif; ?>

                <div class="row g-4 border rounded p-4 bg-body-tertiary">

                    <!-- HERALDIC ITEMS -->
                    <div class="col-6">
                        <h6 class="section-title">Heraldic Items:</h6>
                        <?php
                        $items_options = [
                            'medal'     => 'Medals & Ribbons',
                            'pins'      => 'Pins',
                            'trophies'  => 'Trophies',
                            'souvenirs' => 'Souvenirs',
                            'others'    => 'Others',
                        ];
                        foreach ($items_options as $slug => $label): ?>
                            <label class="circle-option">
                                <input type="checkbox" name="heraldric_items[]" value="<?php echo esc_attr($slug); ?>"
                                    <?php checked(in_array($slug, (array) $heraldric_items_selected)); ?>>
                                <span></span> <?php echo esc_html($label); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>

                    <!-- SORTING -->
                    <div class="col-6">
                        <h6 class="section-title">Sort by:</h6>
                        <?php
                        $sort_options = [
                            'relevant' => 'Most relevant',
                            'az'       => 'A–Z',
                            'za'       => 'Z–A',
                            'newest'   => 'Newest',
                            'oldest'   => 'Oldest',
                        ];
                        foreach ($sort_options as $value => $label): ?>
                            <label class="circle-option">
                                <input type="radio" name="sort_by" value="<?php echo esc_attr($value); ?>"
                                    <?php checked($sort_by, $value); ?>>
                                <span></span> <?php echo esc_html($label); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>

                    <!-- SEALS / LOGOS -->
                    <div class="col-12 mt-4">
                        <h6 class="section-title">Seals/Logos:</h6>
                        <?php
                        $seals_options = [
                            'judiciary' => 'Judiciary/Legislative',
                            'nga'       => 'National Government Agencies (NGA)',
                            'lgu'       => 'Local Government Unit (LGU)',
                            'gocc'      => 'Government-Owned Controlled Corporation',
                            'military'  => 'Military',
                            'suc'       => 'State Universities and Colleges (SUC)',
                            'others'    => 'Others',
                        ];
                        foreach ($seals_options as $slug => $label): ?>
                            <label class="circle-option">
                                <input type="checkbox" name="seals_logos[]" value="<?php echo esc_attr($slug); ?>"
                                    <?php checked(in_array($slug, (array) $seals_selected)); ?>>
                                <span></span> <?php echo esc_html($label); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>

                    <!-- FILTER BY PLACE -->
                    <div class="col-12 mb-3">
                        <h6 class="mb-3 fw-bold">Filter by Place</h6>

                        <select id="region" name="region" class="form-select mb-2">
                            <option value="">-Select Region-</option>
                        </select>

                        <select id="province" name="province" class="form-select mb-2">
                            <option value="">-Select Province-</option>
                        </select>

                        <select id="city" name="city" class="form-select mb-2">
                            <option value="">-Select City / Municipality-</option>
                        </select>
                    </div>

                    <!-- APPLY BUTTON -->
                    <div class="col-12 mt-4">
                        <button type="submit" class="btn w-100 fw-bold" style="background-color:#6b4a1f;color:white;">
                            Apply Filters
                        </button>
                    </div>

                </div>

            </form>

            <!-- SIDEBAR CONTENT -->
            <div class="sidebar_article mt-4">
                <?php get_template_part('partials/sidebar-welcome'); ?>
                <?php get_template_part('partials/sidebar-location-info'); ?>
            </div>

        </div>



    </div>
</div>

<?php get_footer(); ?>

<style>
</style>