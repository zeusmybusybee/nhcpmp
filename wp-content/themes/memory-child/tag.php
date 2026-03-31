<?php get_header(); ?>

<style>
    .tag {
        background: #F7F7F7;
    }

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

    .feature-item-list img {
        margin: 0;
        border-radius: 15px;
        width: 100%;
        object-fit: cover;
        height: clamp(185px, 25vw, 356px);
    }
</style>

<div class="container py-5">

    <div class="row">

        <?php
        $current_tag = get_queried_object();

        $args = array(
            'post_type' => 'item',
            'posts_per_page' => 10,
            'tag_id' => $current_tag->term_id
        );

        $query = new WP_Query($args);
        ?>

        <!-- LEFT RESULTS -->
        <div class="col-lg-8 ph-featured-left-col">

            <div class="d-flex justify-content-between align-items-center mb-3 total-result p-4 mb-4">
                <h4 class="mb-0 mt-0" style="color:#704b10">
                    Top <?php echo $query->found_posts; ?> results for <?php single_tag_title(); ?>
                </h4>
                <div class="pagination-nav">
                    <?php echo do_shortcode('[custom_pagination]'); ?>
                </div>
            </div>

            <div class="row g-4">

                <?php if ($query->have_posts()) : ?>
                    <?php while ($query->have_posts()) : $query->the_post(); ?>

                        <div class="col-lg-4 col-md-6">

                            <div class="card h-100 border-0 shadow-sm text-center p-4 feature-item-list">

                                <a href="<?php echo esc_url(site_url('/collection-view/?id=' . get_the_ID())); ?>" class="text-decoration-none text-dark">

                                    <?php
                                    $cover_image = get_field('cover_image', get_the_ID());

                                    // Default to featured image
                                    $img_src = get_stylesheet_directory_uri() . '/assets/images/featured-img.png';
                                    $img_alt = 'Default Image';

                                    // If ACF image exists
                                    if (!empty($cover_image)) {
                                        // If 'small' size exists, use it; otherwise use the main image
                                        if (isset($cover_image['sizes']['small'])) {
                                            $img_src = $cover_image['sizes']['small'];
                                        } elseif (isset($cover_image['url'])) {
                                            $img_src = $cover_image['url'];
                                        }

                                        // Set alt text
                                        $img_alt = $cover_image['alt'] ?? get_the_title();
                                    }
                                    ?>

                                    <img src="<?php echo esc_url($img_src); ?>"
                                        alt="<?php echo esc_attr($img_alt); ?>"
                                        class="img-fluid mx-auto d-block mb-3">

                                </a>

                                <h3 class="fw-semibold mb-2 ph-featured-title">

                                    <a href="<?php echo site_url('/collection-view/?id=' . get_the_ID()); ?>" class="text-decoration-none text-dark">
                                        <?php the_title(); ?>
                                    </a>

                                </h3>

                                <div class="text-muted small mt-4 text-start meta-ph-heraldy">

                                    <?php
                                    $region = get_field('region');

                                    if ($region):

                                        $region_field = get_field_object('region');
                                    ?>

                                        <div>
                                            Location:
                                            <?php echo esc_html($region_field['choices'][$region] ?? $region); ?>
                                            <?php echo esc_html(get_field('province_text')); ?>,
                                            <?php echo esc_html(get_field('city_text')); ?>
                                        </div>

                                    <?php endif; ?>


                                    <?php

                                    $seals_logos = get_field('seals_logos');

                                    if (!empty($seals_logos) && is_array($seals_logos)):

                                        $seals_labels = [

                                            'judiciary' => 'Judiciary/Legislative',
                                            'nga' => 'National Government Agencies (NGA)',
                                            'lgu' => 'Local Government Unit (LGU)',
                                            'gocc' => 'Government-Owned Controlled Corporation',
                                            'military' => 'Military',
                                            'suc' => 'State University and College (SUC)',
                                            'others' => 'Others'

                                        ];

                                        $output_labels = [];

                                        foreach ($seals_logos as $slug) {

                                            if (isset($seals_labels[$slug])) {

                                                $output_labels[] = $seals_labels[$slug];
                                            }
                                        }

                                    ?>

                                        <div>
                                            Category:
                                            <?php echo esc_html(implode(', ', $output_labels)); ?>
                                        </div>

                                    <?php endif; ?>


                                    <?php if (get_field('year_approved')): ?>

                                        <div>
                                            Year Approved:
                                            <?php echo esc_html(get_field('year_approved')); ?>
                                        </div>

                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>

                    <?php endwhile; ?>

                <?php else : ?>

                    <div class="col-12 text-center py-5">
                        <h4>No items found.</h4>
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

<hr class="mt-5 w-75 m-auto" />
<?php get_template_part('partials/featured-collection'); ?>
<?php wp_reset_postdata(); ?>

<?php get_footer(); ?>