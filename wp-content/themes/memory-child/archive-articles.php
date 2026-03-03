<?php get_header(); ?>
<style>
    .post-type-archive-articles div#content {
        background: #fff;
    }

    .articles-archive h2 {
        margin: 10px 0;
        font-size: 25px;
        line-height: 30px;
        color: #333;
    }

    .archive-right-col .form-check-label {
        font-size: 0.95rem;
        cursor: pointer;
        margin-bottom: 0;
        font-size: 18px;
        font-family: 'Ysabeau', sans-serif;
        color: #704B10;
    }

    .archive-right-col .form-check-input[type=radio] {
        border-radius: 62%;
        padding: 8px;
        border-color: #704B10;
        margin-right: 10px;
    }

    .article-date {
        font-size: 18px;
        font-weight: 300;
        margin: 20px 0 20px;
    }
</style>

<div class="container py-5 articles-archive">

    <div class="row">

        <!-- LEFT: RESULTS -->
        <div class="col-lg-8 archive-left">
            <?php
            global $wp_query;


            ?>

            <div class="d-flex justify-content-between align-items-center mb-3 total-result  p-4 mb-3">
                <h4 class="mb-0 mt-0" style="color:#704b10">
                    Top <?php echo $wp_query->post_count;  ?> results for All Items
                </h4>
            </div>
            <!-- Top Bar: Results Count & Pagination -->
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


                <!-- RIGHT -->
                <div class="pagination-nav">
                    <?php echo do_shortcode('[custom_pagination]'); ?>
                </div>

            </div>
            <?php while (have_posts()) : the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                    <div class="d-flex gap-4 mb-4 book-post-item bg-body-tertiary rounded">

                        <!-- Thumbnail -->
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="flex-shrink-0 col-3 text-center p-0">
                                <?php the_post_thumbnail(
                                    'medium',
                                    ['class' => 'img-fluid rounded']
                                ); ?>
                            </div>
                        <?php else : ?>
                            <img
                                src=" <?php echo get_stylesheet_directory_uri(); ?>/assets/images/books-default.png"
                                class="img-fluid d-block books-default-image"
                                alt="Default Image">
                        <?php endif; ?>

                        <!-- DETAILS COLUMN -->
                        <div class="flex-grow-1 d-flex flex-column col-8 p-0">

                            <!-- TITLE -->
                            <h2 class="books-title fw-semibold ">
                                <?php the_title(); ?>
                            </h2>

                            <!-- date-->
                            <?php if ($date = get_field('date')) : ?>
                                <div class="article-date"><?php echo esc_html($date); ?></div>
                            <?php endif; ?>

                            <!-- DESCRIPTION -->
                            <p class="text-muted mb-3 books-content">
                                <?php
                                $excerpt = get_the_excerpt();

                                if (! empty($excerpt)) {
                                    echo $excerpt;
                                } else {
                                    echo 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.';
                                }
                                ?>
                            </p>

                        </div>
                    </div>
                </a>
            <?php endwhile; ?>
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
                <div class="text-center  mt-4">
                    <a href="#top" class="back-to-top-text">Back to Top</a>
                </div>

                <!-- RIGHT -->
                <div class="pagination-nav">
                    <?php echo do_shortcode('[custom_pagination]'); ?>
                </div>

            </div>

        </div>

        <!-- RIGHT: SIDEBAR -->
        <div class="col-lg-4 archive-right-col archive-right">

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
                    <div class="button_container">
                        <button type="submit"
                            class="btn w-100 mt-4 fw-bold  archive-filter-btn"
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