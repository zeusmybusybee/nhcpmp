<style>
    .featured-collection-archive div#content {
        background: #fff;
    }

    .ph-featured-left-col .card {
        background: #FAFAFA;
    }

    .ph-featured-title {
        font-size: 20px;
        text-align: left;
        font-weight: 500;
        margin: 10px 0;
        line-height: 30px;
    }

    .meta-ph-heraldy div {
        font-size: 15px;
    }
</style>
<div class="container py-5">

    <div class="row">

        <!-- LEFT: RESULTS -->
        <div class="col-lg-8 ph-featured-left-col">
            <?php
            global $wp_query;


            ?>

            <div class="d-flex justify-content-between align-items-center mb-3 total-result  p-4 mb-4">
                <h4 class="mb-0 mt-0" style="color:#704b10">
                    Top <?php echo $wp_query->post_count;  ?> results for All heraldry
                </h4>
            </div>
            <!-- Top Bar: Results Count & Pagination -->
            <div class="d-flex justify-content-between align-items-center mb-4 top-result">
                <div class="d-flex align-items-center gap-3">
                    <meduim>Results per page:</meduim>
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
                                    <?php else : ?>
                                        <img
                                            src=" <?php echo get_stylesheet_directory_uri(); ?>/assets/images/featured-img.png"
                                            class="img-fluid d-block books-default-image"
                                            alt="Default Image">
                                    <?php endif; ?>


                                    <!-- TITLE -->
                                    <h3 class="fw-semibold mb-2 ph-featured-title ">
                                        <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>

                                    <!-- META -->
                                    <div class="text-muted small mt-4 text-start meta-ph-heraldy">
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
        <div class="col-lg-4 archive-right-col">

            <form method="get"
                action="<?php echo esc_url(get_post_type_archive_link('articles')); ?>"
                class="p-4">

                <div class="row g-4 border rounded mb-5">
                    <!-- Always target Articles -->
                    <input type="hidden" name="post_type" value="articles">

                    <!-- SEARCH (only one) -->
                    <div class="input-group" style="margin-top:0;">
                        <input
                            type="search"
                            class="form-control border-0"
                            name="s"
                            placeholder="Search articles..."
                            value="<?php echo esc_attr($_GET['s'] ?? ''); ?>">
                        <button class="button" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>


                <div class="row g-4 border rounded p-4 bg-body-tertiary">
                    <!-- FILTER BY -->
                    <div class="col-6 archive-right-col">
                        <h6 class="mb-3 fw-bold">Filter by:</h6>

                        <?php
                        $current_filter = $_GET['filter'] ?? '';
                        ?>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="filter" value="title"
                                <?php checked($current_filter, 'title'); ?>>
                            <label class="form-check-label">Title</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="filter" value="author"
                                <?php checked($current_filter, 'author'); ?>>
                            <label class="form-check-label">Author</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="filter" value="publisher"
                                <?php checked($current_filter, 'publisher'); ?>>
                            <label class="form-check-label">Publisher</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="filter" value="keyword"
                                <?php checked($current_filter, 'keyword'); ?>>
                            <label class="form-check-label">Subject / Keyword</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="filter" value="year"
                                <?php checked($current_filter, 'year'); ?>>
                            <label class="form-check-label">Year</label>
                        </div>
                    </div>

                    <!-- SORT BY -->
                    <div class="col-6 archive-right-col">
                        <h6 class="mb-3 fw-bold">Sort by:</h6>

                        <?php
                        $current_order = $_GET['orderby'] ?? 'relevance';
                        ?>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="orderby" value="relevance"
                                <?php checked($current_order, 'relevance'); ?>>
                            <label class="form-check-label">Most relevant</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="orderby" value="title"
                                <?php checked($current_order, 'title'); ?>>
                            <label class="form-check-label">A–Z</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="orderby" value="date"
                                <?php checked($current_order, 'date'); ?>>
                            <label class="form-check-label">Newest</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="orderby" value="date-asc"
                                <?php checked($current_order, 'date-asc'); ?>>
                            <label class="form-check-label">Oldest</label>
                        </div>
                    </div>

                    <!-- LEVEL OF ACCESS -->
                    <div class="col-6 archive-right-col mt-4">
                        <h6 class="mb-3 fw-bold">Level of Access:</h6>

                        <?php
                        $current_access = $_GET['access'] ?? '';
                        ?>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="access" value="open"
                                <?php checked($current_access, 'open'); ?>>
                            <label class="form-check-label">Open Access</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="access" value="viewing"
                                <?php checked($current_access, 'viewing'); ?>>
                            <label class="form-check-label">Viewing Access</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="access" value="limited"
                                <?php checked($current_access, 'limited'); ?>>
                            <label class="form-check-label">Limited Access</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="access" value="excluded"
                                <?php checked($current_access, 'excluded'); ?>>
                            <label class="form-check-label">Excluded Access</label>
                        </div>
                    </div>

                    <!-- AVAILABILITY -->
                    <div class="col-6 archive-right-col mt-4">
                        <h6 class="mb-3 fw-bold">Availability:</h6>

                        <?php
                        $current_availability = $_GET['availability'] ?? '';
                        ?>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="availability" value="catalogued"
                                <?php checked($current_availability, 'catalogued'); ?>>
                            <label class="form-check-label">Catalogued</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="availability" value="digital"
                                <?php checked($current_availability, 'digital'); ?>>
                            <label class="form-check-label">Digital File</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="availability" value="nhcp"
                                <?php checked($current_availability, 'nhcp'); ?>>
                            <label class="form-check-label">NHCP Library</label>
                        </div>
                    </div>

                    <div class="button_container col-12">
                        <button type="submit"
                            class="btn w-100 mt-4 fw-bold  archive-filter-btn"
                            style="background-color:#6b4a1f;color:white;">
                            Search
                        </button>
                    </div>
                </div>

            </form>

        </div>


    </div>
</div>