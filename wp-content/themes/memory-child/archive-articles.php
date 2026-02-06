<?php get_header(); ?>

<div class="container py-5">

    <div class="row">

        <!-- LEFT: RESULTS -->
        <div class="col-lg-8">

            <?php if (have_posts()) : ?>

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

                <!-- Posts Loop -->
                <?php while (have_posts()) : the_post(); ?>
                    <div class="d-flex gap-3 mb-4 p-5 bg-body-tertiary">

                        <!-- Thumbnail -->
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="flex-shrink-0" style="width:100px; height:140px; overflow:hidden;">
                                <?php the_post_thumbnail('thumbnail', ['class' => 'img-fluid h-100 w-100 object-fit-cover']); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Content -->
                        <div class="flex-grow-1">
                            <h6 class="size_title">
                                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                    <?php the_title(); ?>
                                </a>
                            </h6>

                            <small class="text-muted d-block mb-2 date-article">
                                <?php echo get_the_date('F j, Y'); ?>
                            </small>

                            <p class="mb-0 text-muted article-excerpt">
                                <?php echo wp_trim_words(get_the_excerpt(), 100); ?>
                            </p>
                        </div>

                    </div>
                <?php endwhile; ?>

                <!-- Bottom Pagination -->
                <div class="d-flex justify-content-center mt-5">
                    <?php the_posts_pagination(['type' => 'list']); ?>
                </div>

            <?php else : ?>
                <p class="text-muted">No posts found.</p>
            <?php endif; ?>

        </div>

        <!-- RIGHT: SIDEBAR -->
        <div class="col-lg-4">

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
                    <div class="col-6">
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
                    <div class="col-6">
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
                            class="btn w-100 mt-4 fw-bold"
                            style="background-color:#6b4a1f;color:white;">
                            Apply Filters
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