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
    .single-book div#content {
        background: #fff;
    }

    .single-artifacts input.form-control.border-0 {
        background: transparent;
        color: #fff;
    }

    .single-artifacts .bg-body-tertiary {
        --bs-bg-opacity: 1;
        background-color: rgb(248 249 250 / 26%) !important;
    }

    .single-artifacts input.form-control.border-0 {
        font-size: 19px;
        color: #fff !important;
        opacity: 1;
    }

    .total-result {
        background: #ffffff42;
        padding: 21px 10px;
        border-radius: 10px;
    }

    .single-artifacts span.select2.select2-container.select2-container--default {
        margin-top: 10px;
    }


    .artifacts-pages input.form-control.border-0 {
        background: transparent;
        color: #fff;
    }

    .artifacts-pages .bg-body-tertiary {
        --bs-bg-opacity: 1;
        background-color: rgb(248 249 250 / 26%) !important;
    }

    .single-books input.form-control.border-0 {
        font-size: 19px;
        color: #fff !important;
        opacity: 1;
    }

    .total-result {
        background: #ffffff42;
        padding: 21px 10px;
        border-radius: 10px;
    }

    .single-bookss span.select2.select2-container.select2-container--default {
        margin-top: 10px;
    }


    .single-books label.circle-option {
        color: #fff;
    }

    .single-books .circle-option span {
        border: 2px solid #fff;
        background: #fff;
    }

    .related-artifacts img {
        margin: 0;
        border-radius: 15px;
        width: 100%;
        object-fit: cover;
        height: clamp(185px, 25vw, 372px);
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

    .single-item::before {
        content: '';
        background: #FAFAFA !important;
        width: 100%;
        height: 100%;
        position: absolute;
        left: -255px;
        top: 0;
    }

    .label-item {
        margin-top: 30px;
    }

    .label-item.col-10 ul li {
        font-size: 18px;
        color: #000;
    }

    .single-books h2.main-title {
        font-size: 40px;
        margin: 30px 0;
        font-weight: 800;
        line-height: 50px;
    }

    .single-books .post-content a {
        padding: 10px 68px;
        font-size: 20px;
        border-radius: 10px !important;
        font-weight: 800;
        line-height: 22px;
        text-transform: none;
        font-family: 'Ysabeau', sans-serif !important;
        background-color: #1ED84F;
        border: none;
        margin-top: 40px;
    }

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

    .books-single-content h2 {
        margin: 0 0 15px;
    }
</style>
<div class="container single-books">
    <div class="row justify-content-between">
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
                    <div class="d-flex gap-2 mb-2 flex-wrap">
                        <?php
                        $access = get_field('level_of_access');
                        $availability = get_field('availability');

                        $access_map = [
                            'open'      => ['label' => 'Open Access',    'class' => 'badge-open'],
                            'viewing'   => ['label' => 'Viewing',        'class' => 'badge-viewing'],
                            'limited'   => ['label' => 'Limited',        'class' => 'badge-limited'],
                            'exclusive' => ['label' => 'Exclusive',     'class' => 'badge-exclusive'],
                        ];

                        $availability_map = [
                            'digital' => ['label' => 'Available in Digital File', 'class' => 'badge-digital'],
                            'library' => ['label' => 'Available in NHCP',        'class' => 'badge-library'],
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
                    <h2 class="text-dark main-title"><?php echo get_the_title(); ?></h2>
                    <div class="post-content text-dark">

                        <a href="<?php echo esc_url($pdf['url']); ?>"
                            class="btn btn-success"
                            target="_blank">
                            View PDF
                        </a>

                    </div>

                </div>
                <div class="container my-5">
                    <div class="row align-items-start gap-5 books-single-content ">

                        <!-- Left Side (Description Box) -->
                        <div class="col-md-5 mb-4">
                            <div class="  p-4 h-100">
                                <p class="mb-0">
                                    <em>
                                        <?php the_content(); ?>
                                    </em>
                                </p>
                            </div>
                        </div>

                        <!-- Right Side (Details List) -->
                        <div class="col-md-5">
                            <div class="">
                                <div class="card-body">
                                    <ul class="">
                                        <li class="list-group-item">Title</li>
                                        <li class="list-group-item">Description</li>
                                        <li class="list-group-item">Author/Creator/Proponent/Artist</li>
                                        <li class="list-group-item">Date Created/Published</li>
                                        <li class="list-group-item">Type of Artifact</li>
                                        <li class="list-group-item">Location</li>
                                        <li class="list-group-item">Collection Series</li>
                                        <li class="list-group-item">Number of Views</li>
                                        <li class="list-group-item">Subject / Keyword</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <h2 class="mb-4 text-dark">Other related resources</h2>
            <div class="row g-4">

                <?php
                $args = [
                    'post_type'      => 'book',
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
                                            <div class="d-flex gap-2 mb-2 flex-wrap">
                                                <?php
                                                $access = get_field('level_of_access');
                                                $availability = get_field('availability');

                                                $access_map = [
                                                    'open'      => ['label' => 'Open Access',    'class' => 'badge-open'],
                                                    'viewing'   => ['label' => 'Viewing',        'class' => 'badge-viewing'],
                                                    'limited'   => ['label' => 'Limited',        'class' => 'badge-limited'],
                                                    'exclusive' => ['label' => 'Exclusive',     'class' => 'badge-exclusive'],
                                                ];

                                                $availability_map = [
                                                    'digital' => ['label' => 'Available in Digital File', 'class' => 'badge-digital'],
                                                    'library' => ['label' => 'Available in NHCP',        'class' => 'badge-library'],
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

        <!-- right column -->
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

                        <?php $access = $_GET['level_of_access'] ?? ''; ?>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="level_of_access" value="open"
                                <?php checked($access, 'open'); ?>>
                            <label class="form-check-label">Open Access</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="level_of_access" value="viewing"
                                <?php checked($access, 'viewing'); ?>>
                            <label class="form-check-label">Viewing Access</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="level_of_access" value="limited"
                                <?php checked($access, 'limited'); ?>>
                            <label class="form-check-label">Limited Access</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="level_of_access" value="exclusive"
                                <?php checked($access, 'exclusive'); ?>>
                            <label class="form-check-label">Exclusive Access</label>
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