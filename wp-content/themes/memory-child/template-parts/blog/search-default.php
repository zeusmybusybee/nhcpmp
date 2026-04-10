<?php get_header(); ?>
<style>
    .see-more-btn {
        width: 100%;
        border-radius: 0;
        background: #eee;
        border: none;
        font-size: 18px;
        text-transform: none;
        color: #000;
        font-weight: 300;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin: 40px 0;
        list-style: none;
        padding: 0;
    }

    .pagination a,
    .pagination span {
        display: inline-block;
        padding: 10px 15px;
        background-color: #eee;
        color: #000;
        border-radius: 5px;
        text-decoration: none;
        transition: 0.3s;
    }

    .pagination a:hover {
        background-color: #3ec5628a;
    }

    .pagination .current {
        background-color: #8b5e3c;
        font-weight: bold;
    }

    .search-no-results div#content {
        background-color: #fff !important;
    }

    .search-results {
        background-color: #f8f8f8 !important;
    }

    .search-img img {
        margin: 0;
        border-radius: 15px;
        width: 100%;
        object-fit: cover;
        height: clamp(185px, 25vw, 366px);
    }

    .full-content {
        /* font-size: 20px; */
        font-size: 18px;
    }

    .view-btn-search {
        display: flex;
        font-family: 'Poppins';
        align-items: center;
        justify-content: center;
        max-width: 200px;
        width: 100%;
        height: 50px;
        font-size: 18px;
        background-color: #3ec562;
        color: #ffffff;
        border: none;
        border-radius: 10px;
        transition: 0.3s ease-in;
        margin: 20px auto;
        text-decoration: none;
    }

    .no-result-section {
        margin: 50px 0 78px !important;
    }

    .search-result {
        border-top: 1px solid #dbdbdb;
        padding-top: 50px;
        padding-bottom: 50px;
        display: flex;
        justify-content: space-between;
        gap: 45px;
        margin: 0 !important;
    }

    .search-item h4 {
        font-size: 30px;
        color: #8b5e3c;
        margin: 10px 0 25px;
    }

    .no-views,
    .search-item p {
        font-size: 20px;
        margin-bottom: 13px;
    }

    .readbtn-subscriber {
        color: #fff !important;
    }

    .view-btn-search:hover {
        background-color: #3ec5628a;
    }

    @media (max-width: 768px) {
        .search-result {
            flex-direction: column;
        }

        .search-img {
            margin: auto;
            width: 100%;
            max-width: 700px;
        }

        .search-item {
            width: 100%;
            max-width: 100%;
        }

        .search-img img {
            height: auto;
        }
    }
</style>
<div class="container my-5">

    <?php if (have_posts()) : ?>
        <h2>Search Results for: <?php echo get_search_query(); ?></h2>
        <?php
        $count = 0;
        while (have_posts()) : the_post();
            $count++;
            $collapse_id = 'collapseContent' . $count;
        ?>
            <div class="search-result mb-4 d-flex gap-4">
                <div class="me-3 col-3 search-img">
                    <?php

                    if (has_post_thumbnail()) {
                        the_post_thumbnail('medium', ['class' => 'img-fluid']);
                    } else {
                        echo '<img src="' . get_stylesheet_directory_uri() . '/assets/images/temp-logo.png" class="img-fluid" alt="No image">';
                    }

                    ?>
                    <a id="views-btn_<?php the_ID(); ?>"
                        class="_df_button readbtn-subscriber view-btn-search"
                        data-postid="<?php the_ID(); ?>"
                        href="<?php echo esc_url(get_permalink()); ?>">
                        View Item
                    </a>
                </div>

                <div class="col-8 search-item">
                    <h4><?php the_title(); ?></h4>



                    <?php if (get_post_type() !== 'historical-sites') : ?>

                        <!-- Excerpt -->
                        <p><strong>Description :</strong> <?php the_excerpt(); ?></p>

                        <div class="no-views">
                            <strong>No. of Views: 0</strong>
                        </div>

                        <!-- Hidden full content -->
                        <div class="full-content" id="<?php echo $collapse_id; ?>" style="display:none;">
                            <p><?php the_content(); ?></p>
                        </div>

                        <!-- Toggle button -->
                        <button class="btn btn-sm btn-outline-primary see-more-btn" data-target="#<?php echo $collapse_id; ?>">
                            See More
                        </button>

                    <?php else : ?>
                        <div class="full-content">
                            <div class="details">

                                <?php if (get_field('citymunicipality_hidden_text') || get_field('province_hidden_text')) : ?>
                                    <div>
                                        <strong>Location:</strong>
                                        <?php the_field('citymunicipality_hidden_text'); ?>,
                                        <?php the_field('province_hidden_text'); ?>
                                    </div>
                                <?php endif; ?>

                                <?php
                                $terms = get_the_terms(get_the_ID(), 'registry_category');
                                if ($terms && !is_wp_error($terms)) :
                                ?>
                                    <div>
                                        <strong>Category:</strong>
                                        <?php echo esc_html($terms[0]->name); ?>
                                    </div>
                                <?php endif; ?>

                                <?php
                                $type_field = get_field_object('type');
                                $type_value = get_field('type');
                                if ($type_value):
                                    $type_label = $type_field['choices'][$type_value] ?? $type_value;
                                ?>
                                    <div><strong>Type:</strong> <?php echo esc_html($type_label); ?></div>
                                <?php endif; ?>

                                <?php
                                $status_field = get_field_object('status');
                                $status_value = get_field('status');
                                if ($status_value):
                                    $status_label = $status_field['choices'][$status_value] ?? $status_value;
                                ?>
                                    <div><strong>Status:</strong> <?php echo esc_html($status_label); ?></div>
                                <?php endif; ?>

                                <?php if (get_field('cultural_property')): ?>
                                    <div><?php echo esc_html(get_field('cultural_property')); ?></div>
                                <?php endif; ?>


                                <?php if (get_field('legal_basis')): ?>
                                    <div><strong>Legal basis:</strong> <?php echo esc_html(get_field('legal_basis')); ?></div>
                                <?php endif; ?>

                                <?php
                                $year_found = get_field('year_found');
                                $date_text = get_field('date_text');

                                if ($year_found): ?>
                                    <div>
                                        <strong>
                                            <?php echo $date_text ? esc_html($date_text) : 'Marker Date'; ?>:
                                        </strong>
                                        <?php echo esc_html($year_found); ?>
                                    </div>
                                <?php endif; ?>


                                <?php
                                $installed_by = get_field('installed_by');
                                $removed_label = get_field('removed_by_label');
                                ?>

                                <div>
                                    <strong>
                                        <?php echo $removed_label ? esc_html($removed_label) : 'Installed By:'; ?>
                                    </strong>
                                    <?php echo esc_html($installed_by); ?>
                                </div>
                            </div>
                        </div>

                    <?php endif; ?>

                </div>
            </div>
        <?php endwhile; ?>
        <?php
        the_posts_pagination(array(
            'mid_size'  => 2,
            'prev_text' => __('« Previous', 'textdomain'),
            'next_text' => __('Next »', 'textdomain'),
            'screen_reader_text' => ' ',
        ));
        ?>
    <?php else : ?>

        <div class="d-flex align-items-center mb-5 mt-4 no-result-section">

            <div class="archive-no-results-icon col-3">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/404-img.png" alt="404">
            </div>
            <div class="col-9">
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

<!-- jQuery toggle script -->
<script>
    jQuery(document).ready(function($) {
        $('.see-more-btn').click(function() {
            var target = $(this).data('target');
            $(target).slideToggle(300);

            // Toggle button text
            if ($(this).text() === 'See More') {
                $(this).text('See Less');
            } else {
                $(this).text('See More');
            }
        });
    });
</script>

<?php get_footer(); ?>