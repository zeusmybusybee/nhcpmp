<?php get_header(); ?>
<style>
    .post-type-archive-articles div#content {
        background: #fff;
    }

    .articles-archive-single h2 {
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

    .articles-archive-single .article-date {
        font-size: 18px;
        font-weight: 300;
        margin: 20px 0 40px;
    }

    .articles-archive-single h2.articles-title {
        font-size: 40px;
        line-height: 50px;
        margin: 0;
        color: #68471F;
    }
</style>

<div class="container py-5 articles-archive-single">

    <div class="row">

        <!-- LEFT: RESULTS -->
        <div class="col-lg-8">
            <section>
                <div class="container">
                    <div class="row ">
                        <h2 class="articles-title fw-semibold ">
                            <?php the_title(); ?>
                        </h2>
                        <!-- date-->
                        <?php if ($date = get_field('date')) : ?>
                            <div class="article-date mb-5"><?php echo esc_html($date); ?></div>
                        <?php endif; ?>
                        <!-- TEXT COLUMN -->
                        <div class="col-lg-6 mb-4 mb-lg-0 mt-5">
                            <div class="text-muted">
                                <?php
                                the_content(); // default WordPress content
                                ?>
                            </div>
                        </div>

                        <!-- IMAGE COLUMN -->
                        <div class="col-lg-6 text-center">
                            <?php
                            if (has_post_thumbnail()) :
                                the_post_thumbnail('large', ['class' => 'img-fluid', 'alt' => get_the_title()]);
                            else : ?>
                                <img
                                    src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/default-thumbnail.jpg"
                                    alt="Default Image"
                                    class="img-fluid">
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </section>
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
                    <div class="button_container">
                        <button type="submit"
                            class="btn w-100 mt-4 fw-bold  archive-filter-btn"
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

<?php get_footer(); ?>

<style>
</style>