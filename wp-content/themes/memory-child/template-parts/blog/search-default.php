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
                        echo '<img src="' . get_template_directory_uri() . '/images/placeholder.png" class="img-fluid" alt="No image">';
                    }
                    ?>
                    <a id="views-btn_147314" class="_df_button readbtn-subscriber view-btn-search" data-postid="147314" href="#item147314_1">View Item</a>
                </div>

                <div class="col-8 search-item">
                    <h4><?php the_title(); ?></h4>

                    <!-- Excerpt always visible -->
                    <p> <strong>Description : </strong><?php the_excerpt(); ?></p>
                    <div class="no-views"><strong>No. of Views: 0</strong> </div>
                    <!-- Hidden full content -->
                    <div class="full-content" id="<?php echo $collapse_id; ?>" style="display:none;">
                        <p><?php the_content(); ?></p>

                    </div>

                    <!-- Toggle button -->
                    <button class="btn btn-sm btn-outline-primary see-more-btn" data-target="#<?php echo $collapse_id; ?>">
                        See More
                    </button>
                </div>
            </div>
        <?php endwhile; ?>

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