<?php get_header(); ?>

<style>
    div#content {
        background: #FFF;
    }

    .foundation-town img {
        margin: 0;
        border-radius: 15px;
        width: 100%;
        object-fit: cover;
        height: clamp(149px, 25vw, 61px);
    }

    .foundation-item {
        padding: 30px 10px;
    }

    .total-result {

        padding: 21px 10px;
        border-radius: 10px;
    }

    .archive-no-results-icon img {
        height: auto !important;
    }
</style>
<div class="container ">

    <div class="row">

        <!-- LEFT: RESULTS -->
        <div class="col-lg-8 foundation-town archive-left">
            <?php get_template_part('partials/total-result'); ?>


            <!-- Top Bar: Results Count & Pagination -->
            <div class="d-flex justify-content-between align-items-center mb-4 top-result">
                <?php get_template_part('partials/result-perpage'); ?>
                <div class="pagination-nav mt-4">
                    <?php echo do_shortcode('[custom_pagination]'); ?>
                </div>
            </div>
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <div class="position-relative d-flex gap-5 mb-4 foundation-item bg-body-tertiary rounded">

                        <!-- Invisible stretched link -->
                        <a href="<?php the_permalink(); ?>" class="stretched-link"></a>

                        <!-- Thumbnail -->
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="flex-shrink-0" style="width:120px;">
                                <?php the_post_thumbnail(
                                    'medium',
                                    ['class' => 'img-fluid rounded']
                                ); ?>
                            </div>
                        <?php endif; ?>

                        <!-- DETAILS COLUMN -->
                        <div class="flex-grow-1 d-flex flex-column">

                            <!-- TITLE -->
                            <h3 class="mt-0">
                                <?php the_title(); ?>
                            </h3>

                            <!-- DESCRIPTION -->
                            <p class="text-muted mb-5">
                                <?php echo wp_trim_words(get_the_excerpt(), 45); ?>
                            </p>

                            <!-- BOTTOM META -->
                            <div class="d-flex">
                                <div class="col-3 p-0">
                                    <div>Location</div>
                                    <div>Category</div>
                                    <div>Year Founded:</div>
                                </div>
                                <div class="col-3 p-0">
                                    <div><?php echo get_field('city_text') . ', ' . get_field('province_text'); ?></div>
                                    <div>
                                        <?php
                                        $terms = get_the_terms(get_the_ID(), 'foundation-of-towns-category');
                                        if ($terms && !is_wp_error($terms)) {
                                            $term_names = wp_list_pluck($terms, 'name');
                                            echo esc_html(implode(', ', $term_names));
                                        } else {
                                            echo 'Uncategorized';
                                        }
                                        ?>
                                    </div>
                                    <div>
                                        <?php
                                        $year_founded = get_field('year_founded');
                                        echo $year_founded ? esc_html($year_founded) : 'N/A';
                                        ?>
                                    </div>
                                </div>
                            </div>

                        </div>
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
            <!-- bottom Bar: Results Count & Pagination -->
            <div class="d-flex justify-content-between align-items-center mb-4 top-result">

                <!-- LEFT -->
                <div class="d-flex align-items-center gap-3">
                    <span>Results per page:</span>
                    <select class="form-select form-select-sm" style="width: auto;">
                        <option selected>10</option>
                        <option>25</option>
                        <option>50</option>
                    </select>
                </div>

                <!-- CENTER -->
                <div class="text-center">
                    <a href="#top" class="back-to-top-text">Back to Top</a>
                </div>

                <!-- RIGHT -->
                <div class="pagination-nav">
                    <?php echo do_shortcode('[custom_pagination]'); ?>
                </div>

            </div>

        </div>

        <!-- RIGHT: SIDEBAR -->
        <div class="col-lg-4 archive-right-col archive-right ">

            <form method="get"
                action="<?php echo esc_url(get_post_type_archive_link('foundation-of-towns')); ?>"
                class="p-4">


                <div class="row g-4 border rounded mb-5">
                    <!-- Always target Articles -->
                    <input type="hidden" name="post_type" value="foundation-of-towns">

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

                    <!-- SORT BY -->
                    <div class="col-10">
                        <h6 class="mb-3 fw-bold">Sort by:</h6>

                        <?php $orderby = $_GET['orderby'] ?? ''; ?>
                        <div class="d-flex flex-wrap gap-4">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="orderby" value="relevance"
                                    <?php checked($orderby, 'relevance'); ?>>
                                <label class="form-check-label">Most relevant</label>
                            </div>

                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="orderby" value="title-asc"
                                    <?php checked($orderby, 'title-asc'); ?>>
                                <label class="form-check-label">A–Z</label>
                            </div>

                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="orderby" value="title-desc"
                                    <?php checked($orderby, 'title-desc'); ?>>
                                <label class="form-check-label">Z–A</label>
                            </div>

                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="orderby" value="date-desc"
                                    <?php checked($orderby, 'date-desc'); ?>>
                                <label class="form-check-label">Newest</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="orderby" value="date-asc"
                                    <?php checked($orderby, 'date-asc'); ?>>
                                <label class="form-check-label">Oldest</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <h6 class="fw-bold text-dark">Filter by Time:</h6>

                        <div class="container p-3 text-light">

                            <!-- Period -->
                            <select name="period" class="form-select">
                            

                                <?php
                                $field = get_field_object('field_698bd6091d1a1'); // palitan mo ng field key

                                if ($field && !empty($field['choices'])) :
                                    foreach ($field['choices'] as $value => $label) :
                                ?>
                                        <option value="<?php echo esc_attr($value); ?>">
                                            <?php echo esc_html($label); ?>
                                        </option>
                                <?php endforeach;
                                endif; ?>

                            </select>
                            <!-- Year -->
                            <select name="year" class="form-select mt-2">
                                <option value="">Select Year</option>
                                <?php
                                $years = $wpdb->get_col("
                                SELECT DISTINCT YEAR(post_date) 
                                FROM $wpdb->posts
                                WHERE post_type = 'foundation-of-towns'
                                AND post_status = 'publish'
                                ORDER BY post_date DESC
                            ");
                                foreach ($years as $year) : ?>
                                    <option value="<?php echo esc_attr($year); ?>">
                                        <?php echo esc_html($year); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                        </div> <!-- /.container -->
                    </div> <!-- /.col -->


                    <div class="col-12 mt-4">
                        <h6 class="fw-bold text-dark">Filter by place:</h6>

                        <div class="container p-3  text-light">
                            <select name="region" id="region" class="form-select">
                                <option value="">Select Region</option>
                            </select>
                            <select name="province" id="province" class="form-select mt-3" disabled>
                                <option value="">Select Province</option>
                            </select>
                            <select name="city" id="city" class="form-select mt-3" disabled>
                                <option value="">Select City/Municipality</option>
                            </select>

                        </div> <!-- ✅ ito yung kulang -->
                    </div>


                    <!-- APPLY BUTTON -->
                    <div class="col-12 mt-4">
                        <button type="submit"
                            class="btn w-100 fw-bold archive-filter-btn"
                            style="background-color:#6b4a1f;color:white;">
                            Search
                        </button>
                    </div>

                </div>





            </form>

            <div class="sidebar_article archive-hide">
                <?php get_template_part('partials/sidebar-welcome'); ?>
                <?php get_template_part('partials/sidebar-location-info'); ?>

            </div>

        </div>


    </div>
</div>
<?php get_footer(); ?>

<style>
</style>