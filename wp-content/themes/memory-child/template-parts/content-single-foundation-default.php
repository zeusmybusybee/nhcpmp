<?php

/**
 * Template part for content posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package memory
 */

$memory_hide_featured_image = get_theme_mod('hide_featured_image', 'show-ft');
?>
<style>
    div#content {
        background: #fff;
    }

    .single-top-content {
        padding: 35px 20px;
    }

    .single-top-content button {
        padding: 9px 60px;
        font-size: 14px;
        font-weight: 300;
        text-transform: none;
    }

    .single-item .entry-media img {
        margin: 0;
        border-radius: 15px;
        width: 100%;
        object-fit: cover;
        height: clamp(185px, 25vw, 494px);
    }

    .single-item {
        background: #FAFAFA !important;
        width: 100% !important;
        position: relative;
    }

    .single-foundation-town h2 {
        margin: 0;
    }

    .single-foundation-info div {
        font-size: 20px;
        font-weight: 400;
        font-style: italic;
    }

 
</style>
<div class="container single-foundation-town">
    <div class="row justify-content-between ">
        <!-- left column -->
        <!-- left column -->
        <div class="col-md-8 left-column  ">
            <div class="d-flex gap-4 c_bg-lightgray pt-5 pl-4 pr-4 pb-5 single-item rounded flex-wrap">
                <div class="col-4">
                    <?php
                    if ('show-ft' === $memory_hide_featured_image) {

                        if (has_post_thumbnail()) {
                            echo '<div class="entry-media rounded">';
                            the_post_thumbnail('memory-thumbnails-2');
                            echo '</div>';
                        } else {
                    ?>
                            <img
                                src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/single-book-img.png"
                                class="img-fluid d-block books-default-image"
                                alt="Default Image">
                    <?php
                        }
                    }
                    ?>
                </div>
                <div class="col-7">
                    <!-- BOTTOM META -->
                    <div class="col-11 bg-white p-5">
                        <div class="d-flex mt-3 mb-5">
                            <div class="col-7 p-0 single-foundation-info">
                                <div>Region</div>
                                <div>Province</div>
                                <div>City/Municipality:</div>
                                <div>Category</div>
                                <div>Year Approved</div>
                            </div>
                            <div class="col-7 p-0 single-foundation-info">
                                <div>
                                    NCR
                                </div>
                                <div>
                                    <?php echo  get_field('province_text'); ?>
                                </div>
                                <div>
                                    <?php echo get_field('city_text') ?>
                                </div>
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
                        <button type="button" class="btn btn-custom-green mt-5">View PDF</button>
                    </div>
                </div>
                <div class="container my-5">
                    <div class="row align-items-start gap-5 books-single-content">

                        <!-- Left Side (Description Box) -->
                        <div class="col-md-9 mb-4">
                            <div class="  p-4 h-100">
                                <h2 class="text-dark"><?php echo get_the_title(); ?></h2>
                                <p class="mb-0">
                                    <em>
                                        <?php the_content(); ?>
                                    </em>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <h2 class="mb-4 text-dark">Other related resources</h2>
            <div class="row g-4">

                <?php
                $args = [
                    'post_type'      => 'foundation-of-towns',
                    'posts_per_page' => 6, // 6 posts
                    'post_status'    => 'publish',
                    'orderby'        => 'date',
                ];

                $artifacts = new WP_Query($args);

                if ($artifacts->have_posts()) :
                    while ($artifacts->have_posts()) : $artifacts->the_post(); ?>
                        <div class="col-md-12">
                            <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark d-block">
                                <div class="h-100 d-flex bg-body-tertiary rounded p-5 hover-card">

                                    <div class="col-3 text-center">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium', ['class' => 'img-fluid rounded']); ?>
                                        <?php else : ?>
                                            <img
                                                src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/books-default.png"
                                                class="img-fluid d-block books-default-image"
                                                alt="Default Image">
                                        <?php endif; ?>

                                    </div>

                                    <div class="col-8">
                                        <div class="card-body p-0">
                                            <!-- BADGES -->

                                            <h3 class="mb-2 mt-4"><?php the_title(); ?></h3>

                                            <?php
                                            $content = get_the_content();

                                            if (! empty($content)) {
                                                echo wp_trim_words($content, 45);
                                            } else {
                                                echo 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.';
                                            }
                                            ?>


                                            <!-- BOTTOM META -->
                                            <div class="d-flex justify-content-between text-muted small mt-5">
                                                <?php if ($location = get_field('location')) : ?>
                                                    <span>Location: <?php echo esc_html($location); ?></span>
                                                <?php endif; ?>

                                                <span>Category: Book</span>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </a>
                        </div>

                    <?php endwhile;
                    wp_reset_postdata();
                else : ?>
                    <p>No artifacts found.</p>
                <?php endif; ?>

            </div>




        </div>

        <!-- RIGHT: SIDEBAR -->
        <div class="col-lg-4 archive-right-col">

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

                            <!-- Era -->
                            <select name="era" class="form-select">
                                <!-- Unang placeholder option -->
                                <option value="">Era</option>

                                <?php
                                global $wpdb;

                                $results = $wpdb->get_col(
                                    "SELECT meta_value
                            FROM $wpdb->postmeta
                            WHERE meta_key = 'era'"
                                );

                                $eras = [];

                                foreach ($results as $row) {
                                    $values = maybe_unserialize($row);
                                    if (is_array($values)) {
                                        foreach ($values as $val) {
                                            $eras[] = $val;
                                        }
                                    } else {
                                        $eras[] = $values;
                                    }
                                }

                                $eras = array_unique($eras);
                                sort($eras);

                                foreach ($eras as $era) : ?>
                                    <option value="<?php echo esc_attr($era); ?>">
                                        <?php echo esc_html($era); ?>
                                    </option>
                                <?php endforeach; ?>
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

            <div class="sidebar_article">
                <?php get_template_part('partials/sidebar-welcome'); ?>
                <?php get_template_part('partials/sidebar-location-info'); ?>

            </div>

        </div>

    </div>
</div>