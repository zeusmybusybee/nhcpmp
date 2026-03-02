<?php get_header(); ?>
<style>
    h2.books-title {
        font-size: 25px;
        margin: 15px 0;
    }

    .books-filter h5 {
        color: #704B10;
    }

    .books-filter div label {
        font-size: 18px;
        font-family: 'Ysabeau', sans-serif;
        color: #704B10;
    }

    .books-filter .form-check-input[type=radio] {
        border-radius: 62%;
        padding: 8px;
        border-color: #704B10;
        margin-right: 10px;
    }
</style>

<div class="container py-5">

    <div class="row">

        <!-- LEFT: RESULTS -->
        <div class="col-lg-8">
            <?php
            global $wp_query;


            ?>

            <div class="d-flex justify-content-between align-items-center mb-3 total-result  p-4 mb-3">
                <h4 class="mb-0 mt-0" style="color:#704b10">
                    Top <?php echo $wp_query->post_count;  ?> results for All Towns
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
                            <div class="flex-shrink-0 col-3 text-center">
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
                        <div class="flex-grow-1 d-flex flex-column col-8">

                            <!-- BADGES -->
                            <div class="d-flex gap-2 mb-2 flex-wrap">
                                <?php
                                $access = get_field('level');
                                $availability = get_field('availability');

                                $access_map = [
                                    'level_1'      => ['label' => 'Level 1',    'class' => 'badge-open'],
                                    'level_2'   => ['label' => 'Level 2',        'class' => 'badge-viewing'],
                                    'level_3'   => ['label' => 'Level 3',        'class' => 'badge-limited'],
                                    'level_4' => ['label' => 'Level 4',      'class' => 'badge-exclusive'],
                                ];

                                $availability_map = [
                                    'digital' => ['label' => 'Available in Digital File', 'class' => 'badge-digital'],
                                    'library' => ['label' => 'Available in NHCP',         'class' => 'badge-library'],
                                ];
                                ?>

                                <?php if ($access && isset($access_map[$access])) : ?>
                                    <span class="access-badge <?php echo esc_attr($access_map[$access]['class']); ?>">
                                        <?php echo esc_html($access_map[$access]['label']); ?>
                                    </span>
                                <?php endif; ?>

                                <?php if ($availability && isset($availability_map[$availability])) : ?>
                                    <span class="availability-badge <?php echo esc_attr($availability_map[$availability]['class']); ?>">
                                        <?php echo esc_html($availability_map[$availability]['label']); ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <!-- TITLE -->
                            <h2 class="books-title fw-semibold ">
                                <?php the_title(); ?>
                            </h2>

                            <!-- CALL NUMBER -->
                            <?php if ($call_number = get_field('call_number')) : ?>
                                <small class="text-muted fst-italic mb-2 d-block">
                                    Call Number: <?php echo esc_html($call_number); ?>
                                </small>
                            <?php endif; ?>

                            <!-- DESCRIPTION -->
                            <p class="text-muted mb-3 books-content">
                                <?php
                                $excerpt = get_the_excerpt();

                                if (! empty($excerpt)) {
                                    echo wp_trim_words($excerpt, 45);
                                } else {
                                    echo 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.';
                                }
                                ?>
                            </p>

                            <!-- BOTTOM META -->
                            <div class="d-flex justify-content-between mt-auto text-muted small">
                                <?php if ($location = get_field('location')) : ?>
                                    <span>Location: <?php echo esc_html($location); ?></span>
                                <?php endif; ?>

                                <span>Category: Book</span>
                            </div>

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
        <div class="col-lg-4 archive-right-col">

            <form method="get"
                action="<?php echo esc_url(get_post_type_archive_link('book')); ?>"
                class="p-4">

                <div class="row g-4 border rounded mb-5">
                    <!-- Always target book -->
                    <input type="hidden" name="post_type" value="book">

                    <!-- SEARCH (only one) -->
                    <div class="input-group" style="margin-top:0;">
                        <input
                            type="search"
                            class="form-control border-0"
                            name="s"
                            placeholder="Search books..."
                            value="<?php echo esc_attr($_GET['s'] ?? ''); ?>">
                        <button class="button" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>


                <div class="row g-4 border rounded p-4 bg-body-tertiary">

                    <!-- FILTER BY -->
                    <div class="col-6 books-filter">
                        <h5 class="mb-3 fw-bold ">Filter by:</h5>

                        <?php $filter = $_GET['filter'] ?? ''; ?>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="filter" value="title"
                                <?php checked($filter, 'title'); ?>>
                            <label class="form-check-label">Title</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="filter" value="author"
                                <?php checked($filter, 'author'); ?>>
                            <label class="form-check-label">Author</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="filter" value="publisher"
                                <?php checked($filter, 'publisher'); ?>>
                            <label class="form-check-label">Publisher</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="filter" value="keyword"
                                <?php checked($filter, 'keyword'); ?>>
                            <label class="form-check-label">Subject / Keyword</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="filter" value="year"
                                <?php checked($filter, 'year'); ?>>
                            <label class="form-check-label">Year</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="filter" value="isbn"
                                <?php checked($filter, 'isbn'); ?>>
                            <label class="form-check-label">ISBN / ISSN</label>
                        </div>
                    </div>

                    <!-- SORT BY -->
                    <div class="col-6 books-filter">
                        <h5 class="mb-3 fw-bold ">Sort by:</h5>

                        <?php $orderby = $_GET['orderby'] ?? ''; ?>

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

                    <!-- LEVEL OF ACCESS -->
                    <div class="col-6 mt-4 books-filter">
                        <h5 class="mb-3 fw-bold">Level of Access</h5>

                        <?php $access = $_GET['level'] ?? ''; ?>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="level" value="level_1"
                                <?php checked($access, 'level_1'); ?>>
                            <label class="form-check-label">Level 1</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="level" value="level_2"
                                <?php checked($access, 'level_2'); ?>>
                            <label class="form-check-label">Level 2</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="level" value="level_3"
                                <?php checked($access, 'level_3'); ?>>
                            <label class="form-check-label">Level 3</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="level" value="level_4"
                                <?php checked($access, 'level_4'); ?>>
                            <label class="form-check-label">Level 4</label>
                        </div>
                    </div>

                    <!-- AVAILABILITY -->
                    <div class="col-6 mt-4 books-filter">
                        <h5 class="mb-3 fw-bold ">Availability:</h5>

                        <?php $availability = $_GET['availability'] ?? ''; ?>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="availability" value="digital"
                                <?php checked($availability, 'digital'); ?>>
                            <label class="form-check-label">Digital File</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="availability" value="library"
                                <?php checked($availability, 'library'); ?>>
                            <label class="form-check-label">NHCP Library</label>
                        </div>
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

<?php get_footer(); ?>

<style>
</style>