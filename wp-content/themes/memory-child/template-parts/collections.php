<?php

/*** Template Name: Collections */
get_header();
?>

<style>
    .collections__banner--title h1 {
        color: #fff;
        margin-bottom: 0;
        text-align: center;
    }

    span.page-numbers.current {
        color: #fff !important;
    }

    .collections__banner--title h2 {
        color: #fff;
        margin-top: 10px;
        text-align: center;
    }

    /* SEARCH NAVIGATION */
    .searchresults {
        margin-top: 35px;
        width: 100%;
        text-align: center;
    }

    .searchresults .page-numbers {
        padding: 10px;
        font-weight: 700;
        border-radius: 4px;
        color: #232426;
        font-family: 'Poppins';
        font-size: 18px;

        -webkit-transition: all 0.35s ease;
        -moz-transition: all 0.35s ease;
        -o-transition: all 0.35s ease;
        transition: all 0.35s ease;
    }

    .page-template-collections {
        background-color: #F7F7F7;
    }

    .searchresults .page-numbers:hover {
        text-decoration: none;
        color: #2f78cf;

        -webkit-transition: all 0.35s ease;
        -moz-transition: all 0.35s ease;
        -o-transition: all 0.35s ease;
        transition: all 0.35s ease;
    }

    .searchresults .page-numbers.current {
        color: #2f78cf;
    }

    .dwnld-btn {
        position: fixed;
        top: 45px;
        left: 20px;
        display: none;
        padding: 5px;
        background: #4bbd4b;
        border-radius: 5px;
    }

    .fake_close_btn {
        text-align: center;
        width: 30px;
        height: 30px;
        color: #fff;
    }

    .fake_close_btn:hover,
    .fake_close_btn:active {
        background: #000;
        border-radius: 20px;
        width: 30px;
        height: 30px;
    }

    /* new */
    .collection-box {
        padding: 10px 20px;
    }

    .sub-collection-box {
        padding: 10px;
    }

    .post-content {
        text-align: center;
    }

    .collection-title {
        font-size: 16px;
        font-weight: 800;
    }

    .collection-container a {
        font-size: 16px;
        font-weight: 800;
        text-decoration: none !important;
        color: #fff !important;
    }

    ul#collection-lists .dot-fix {
        padding: 10px;
    }
</style>

<?php
$ptermid = isset($_GET['ptermid']) ? $_GET['ptermid'] : null;
$ctermid = isset($_GET['ctermid']) ? $_GET['ctermid'] : null;
?>


<div class="container">

    <div class="row">

        <!-- LEFT: RESULTS -->
        <div class="col-lg-8 archive-left">
            <?php get_template_part('partials/total-result'); ?>
            <!-- Top Bar: Results Count & Pagination -->
            <!-- bottom Bar: Results Count & Pagination -->
            <div class="d-flex justify-content-between align-items-center mb-4 top-result">

                <!-- LEFT -->
                <?php get_template_part('partials/result-perpage'); ?>

                <!-- CENTER -->


                <!-- RIGHT -->
                <div class="pagination-nav">
                    <?php echo do_shortcode('[custom_pagination]'); ?>
                </div>

            </div>
            <?php if (!empty($_GET['ptermid']) && empty($_GET['ctermid'])) { ?>

                <?php
                $term_id = $_GET['ptermid'];
                $taxonomy_name = 'collection_management';
                $terms = get_term_children($term_id, $taxonomy_name);
                if (!empty($terms) && !is_wp_error($terms)) { ?>
                    <div class="singles-collection__subs">
                        <style>
                            .collection-container {
                                margin-left: -50px;
                            }

                            #collection-lists {
                                margin-top: 0;
                                /*margin-left: -25px;*/
                                list-style: none;
                            }

                            #collection-lists .list {
                                display: inherit;
                                padding-left: 25px;
                            }

                            .dot {
                                font-size: 7px;
                            }

                            .dot-fix {
                                display: flex;
                                align-items: center;
                                gap: 5px;
                            }
                        </style>
                        <div class="collection-container">

                            <?php
                            $term_id = $_GET['ptermid'];
                            function display_subcategories($parent_id)
                            {
                                $args = array(
                                    'taxonomy' => 'collection_management',
                                    'parent' => $parent_id,
                                    'hide_empty' => false,
                                );
                                $subcategories = get_terms($args);

                                if (!empty($subcategories)) { ?>
                                    <ul id="collection-lists">
                                        <?php foreach ($subcategories as $subcategory) { ?>
                                            <li class="gap-4 mb-4 rounded" style="background: #A7A7A7;">
                                                <div class="list">
                                                    <p class="dot-fix"><a href="<?php echo site_url() . '/contributed-collections/?ptermid=' . $subcategory->term_id; ?>"><?php echo $subcategory->name; ?></a></p>
                                                    <?php display_subcategories($subcategory->term_id); ?>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>

                            <?php }
                            display_subcategories($term_id); ?>
                        </div>
                    </div>
        </div>

        <!-- RIGHT: RESULTS -->
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

        <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                    $data = new WP_Query(array(
                        'post_type' => 'item',
                        'paged' => $paged,
                        'meta_query'    => array(
                            'relation'      => 'AND',
                            array(
                                'key'       => 'choose_category',
                                'value'     => $_GET['ptermid'],
                                'compare'   => '=',
                            ),
                        ),
                    ));

                    if ($data->have_posts()) : ?>
            <div class="col-wrapper">
                <?php while ($data->have_posts()) : $data->the_post(); ?>
                    <?php $cover_image = get_field('cover_image'); ?>

                    <div class="journal__container--list">
                        <div class="list-row row">
                            <div class="col-4 list-img">
                                <?php if ($cover_image) { ?>
                                    <img
                                        src="<?php echo esc_url($cover_image['url']); ?>"
                                        class="img-fluid d-block books-default-image"

                                        alt="Cover Image">
                                <?php } else { ?>
                                    <img
                                        src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/single-book-img.png"
                                        class="img-fluid d-block books-default-image"
                                        alt="Default Image">
                                <?php } ?>
                            </div>
                            <div class="col-7 ms-4">
                                <div class="d-flex gap-2 mb-2 flex-wrap">
                                    <?php
                                    $access = get_field('level');
                                    $availability = get_field('availability');

                                    $access_map = [
                                        'level_1'      => ['label' => 'Level 1',    'class' => 'badge-open'],
                                        'level_2'   => ['label' => 'Level 2',        'class' => 'badge-viewing'],
                                        'level_3'   => ['label' => 'Level 3',        'class' => 'badge-limited'],
                                        'level_4' => ['label' => 'Level 4',     'class' => 'badge-exclusive'],
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
                                    <?php $pdf = get_field('file_content');
                                    $cover_image = get_field('cover_image'); ?>
                                    <?php
                                    $access = get_field('level');
                                    $file_limit = get_field('file_content_limit');
                                    $can_view = false;

                                    // Level 1 → public
                                    if ($access === 'level_1'  || $access === 'level_2') {
                                        $can_view = true;
                                    }
                                    // Level 4 → administrators only
                                    elseif (
                                        in_array($access, ['level_4']) &&
                                        (current_user_can('level_4_user') || current_user_can('administrator'))
                                    ) {
                                        $can_view = true;
                                    }
                                    ?>

                                    <?php if ($can_view) : ?>
                                        <?php if (!empty($pdf['url'])) : ?>
                                            <div class="my-flipbook-button">
                                                <?php echo do_shortcode('[real3dflipbook pdf="' . $pdf['url'] . '" mode="lightbox" thumb="View PDF"]'); ?>
                                            </div>
                                        <?php else : ?>
                                            <?php while (have_rows('file_content')) : the_row(); ?>
                                                <?php $file = get_sub_field('add__new_files'); ?>
                                                <div class="my-flipbook-button">
                                                    <?php echo do_shortcode('[real3dflipbook pdf="' . $file['url'] . '" mode="lightbox" thumb="View PDF"]'); ?>
                                                </div>

                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    <?php elseif (in_array($access, ['level_3']) && $level == 'level_3') : ?>
                                        <?php if (!empty($file_limit['url'])) : ?>
                                            <div class="my-flipbook-button mt-3">
                                                <?php echo do_shortcode('[real3dflipbook pdf="' . $file_limit['url'] . '" mode="lightbox" thumb="View Limited PDF"]'); ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <div class="d-flex gap-4 mb-4 book-post-item bg-body-tertiary rounded p-4">
                                            <div class="flex-grow-1">
                                                <h2 class="books-title fw-semibold">
                                                    <?php the_title(); ?>
                                                </h2>
                                                <p class="text-muted mb-0">
                                                    Please Login to view the content of this book.
                                                </p>
                                                <a class="btn btn-primary" href="<?php echo home_url(); ?>/login">Login</a>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                </div>

                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>

                <div class="searchresults">
                    <?php
                        $total_pages = $data->max_num_pages;
                        if ($total_pages > 1) {

                            $big = 99999;
                            echo paginate_links(array(
                                'format' => '?paged=%#%',
                                'current' => $paged,
                                'total' => $total_pages,
                                'prev_text'    => __('« prev'),
                                'next_text'    => __('next »'),
                            ));
                        }
                    ?>
                </div>
            </div>
        <?php else : ?>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    <?php } else { ?>
        <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                    $data = new WP_Query(array(
                        'post_type' => 'item',
                        'paged' => $paged,
                        'meta_query'    => array(
                            'relation'      => 'AND',
                            array(
                                'key'       => 'choose_category',
                                'value'     => $_GET['ptermid'],
                                'compare'   => '=',
                            ),
                        ),
                    ));

                    if ($data->have_posts()) : ?>
            <div class="col-wrapper">
                <?php while ($data->have_posts()) : $data->the_post(); ?>
                    <?php
                            $this_id = get_the_ID();
                            $level = get_field('level');
                            $cover_image = get_field('cover_image');
                    ?>
                    <div class="journal__container--list">
                        <div class="list-row row">
                            <div class="col-4 list-img">
                                <?php if ($cover_image) { ?>
                                    <img
                                        src="<?php echo esc_url($cover_image['url']); ?>"
                                        class="img-fluid d-block books-default-image"

                                        alt="Cover Image">
                                <?php } else { ?>
                                    <img
                                        src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/single-book-img.png"
                                        class="img-fluid d-block books-default-image"
                                        alt="Default Image">
                                <?php } ?>
                            </div>
                            <div class="col-7 ms-4">
                                <div class="d-flex gap-2 mb-2 flex-wrap">
                                    <?php
                                    $access = get_field('level');
                                    $availability = get_field('availability');

                                    $access_map = [
                                        'level_1'      => ['label' => 'Level 1',    'class' => 'badge-open'],
                                        'level_2'   => ['label' => 'Level 2',        'class' => 'badge-viewing'],
                                        'level_3'   => ['label' => 'Level 3',        'class' => 'badge-limited'],
                                        'level_4' => ['label' => 'Level 4',     'class' => 'badge-exclusive'],
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
                                    <?php $pdf = get_field('file_content');
                                    $cover_image = get_field('cover_image'); ?>
                                    <?php
                                    $access = get_field('level');
                                    $file_limit = get_field('file_content_limit');
                                    $can_view = false;

                                    // Level 1 → public
                                    if ($access === 'level_1'  || $access === 'level_2') {
                                        $can_view = true;
                                    }
                                    // Level 4 → administrators only
                                    elseif (
                                        in_array($access, ['level_4']) &&
                                        (current_user_can('level_4_user') || current_user_can('administrator'))
                                    ) {
                                        $can_view = true;
                                    }
                                    ?>

                                    <?php if ($can_view) : ?>
                                        <?php if (!empty($pdf['url'])) : ?>
                                            <div class="my-flipbook-button">
                                                <?php echo do_shortcode('[real3dflipbook pdf="' . $pdf['url'] . '" mode="lightbox" thumb="View PDF"]'); ?>
                                            </div>
                                        <?php else : ?>
                                            <?php while (have_rows('file_content')) : the_row(); ?>
                                                <?php $file = get_sub_field('add__new_files'); ?>
                                                <div class="my-flipbook-button">
                                                    <?php echo do_shortcode('[real3dflipbook pdf="' . $file['url'] . '" mode="lightbox" thumb="View PDF"]'); ?>
                                                </div>

                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    <?php elseif (in_array($access, ['level_3']) && $level == 'level_3') : ?>
                                        <?php if (!empty($file_limit['url'])) : ?>
                                            <div class="my-flipbook-button mt-3">
                                                <?php echo do_shortcode('[real3dflipbook pdf="' . $file_limit['url'] . '" mode="lightbox" thumb="View Limited PDF"]'); ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <div class="d-flex gap-4 mb-4 book-post-item bg-body-tertiary rounded p-4">
                                            <div class="flex-grow-1">
                                                <h2 class="books-title fw-semibold">
                                                    <?php the_title(); ?>
                                                </h2>
                                                <p class="text-muted mb-0">
                                                    Please Login to view the content of this book.
                                                </p>
                                                <a class="btn btn-primary" href="<?php echo home_url(); ?>/login">Login</a>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                </div>

                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>

                <div class="searchresults">
                    <?php
                        $total_pages = $data->max_num_pages;
                        if ($total_pages > 1) {

                            $big = 99999;
                            echo paginate_links(array(
                                'format' => '?paged=%#%',
                                'current' => $paged,
                                'total' => $total_pages,
                                'prev_text'    => __('« prev'),
                                'next_text'    => __('next »'),
                            ));
                        }
                    ?>
                </div>
            </div>
        <?php else : ?>
            <div style="text-align: center; font-size: 18px; padding: 150px 0 70px;">
                It seems we can’t find what you’re looking for.
            </div>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    <?php } ?>



<?php } else if (!empty($_GET['ptermid']) && !empty($_GET['ctermid'])) { ?>

    <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                $data = new WP_Query(array(
                    'post_type' => 'item',
                    'paged' => $paged,
                    'meta_query'    => array(
                        'relation'      => 'AND',
                        array(
                            'key'       => 'choose_category',
                            'value'     => $_GET['ctermid'],
                            'compare'   => '=',
                        ),
                    ),
                ));

                if ($data->have_posts()) : ?>
        <div class="col-wrapper">

            <?php while ($data->have_posts()) : $data->the_post(); ?>
                <?php $cover_image = get_field('cover_image'); ?>

                <div class="journal__container--list">
                    <div class="list-row row">
                        <div class="col-4 list-img">
                            <?php if ($cover_image) { ?>
                                <img
                                    src="<?php echo esc_url($cover_image['url']); ?>"
                                    class="img-fluid d-block books-default-image"

                                    alt="Cover Image">
                            <?php } else { ?>
                                <img
                                    src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/single-book-img.png"
                                    class="img-fluid d-block books-default-image"
                                    alt="Default Image">
                            <?php } ?>
                        </div>
                        <div class="col-7 ms-4">
                            <div class="d-flex gap-2 mb-2 flex-wrap">
                                <?php
                                $access = get_field('level');
                                $availability = get_field('availability');

                                $access_map = [
                                    'level_1'      => ['label' => 'Level 1',    'class' => 'badge-open'],
                                    'level_2'   => ['label' => 'Level 2',        'class' => 'badge-viewing'],
                                    'level_3'   => ['label' => 'Level 3',        'class' => 'badge-limited'],
                                    'level_4' => ['label' => 'Level 4',     'class' => 'badge-exclusive'],
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
                                <?php $pdf = get_field('file_content');
                                $cover_image = get_field('cover_image'); ?>
                                <?php
                                $access = get_field('level');
                                $file_limit = get_field('file_content_limit');
                                $can_view = false;

                                // Level 1 → public
                                if ($access === 'level_1'  || $access === 'level_2') {
                                    $can_view = true;
                                }
                                // Level 4 → administrators only
                                elseif (
                                    in_array($access, ['level_4']) &&
                                    (current_user_can('level_4_user') || current_user_can('administrator'))
                                ) {
                                    $can_view = true;
                                }
                                ?>

                                <?php if ($can_view) : ?>
                                    <?php if (!empty($pdf['url'])) : ?>
                                        <div class="my-flipbook-button">
                                            <?php echo do_shortcode('[real3dflipbook pdf="' . $pdf['url'] . '" mode="lightbox" thumb="View PDF"]'); ?>
                                        </div>
                                    <?php else : ?>
                                        <?php while (have_rows('file_content')) : the_row(); ?>
                                            <?php $file = get_sub_field('add__new_files'); ?>
                                            <div class="my-flipbook-button">
                                                <?php echo do_shortcode('[real3dflipbook pdf="' . $file['url'] . '" mode="lightbox" thumb="View PDF"]'); ?>
                                            </div>

                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                <?php elseif (in_array($access, ['level_3']) && $level == 'level_3') : ?>
                                    <?php if (!empty($file_limit['url'])) : ?>
                                        <div class="my-flipbook-button mt-3">
                                            <?php echo do_shortcode('[real3dflipbook pdf="' . $file_limit['url'] . '" mode="lightbox" thumb="View Limited PDF"]'); ?>
                                        </div>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <div class="d-flex gap-4 mb-4 book-post-item bg-body-tertiary rounded p-4">
                                        <div class="flex-grow-1">
                                            <h2 class="books-title fw-semibold">
                                                <?php the_title(); ?>
                                            </h2>
                                            <p class="text-muted mb-0">
                                                Please Login to view the content of this book.
                                            </p>
                                            <a class="btn btn-primary" href="<?php echo home_url(); ?>/login">Login</a>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>

                        </div>
                    </div>
                </div>

            <?php endwhile; ?>

            <div class="searchresults">
                <?php
                    $total_pages = $data->max_num_pages;
                    if ($total_pages > 1) {

                        $big = 99999;
                        echo paginate_links(array(
                            'format' => '?paged=%#%',
                            'current' => $paged,
                            'total' => $total_pages,
                            'prev_text'    => __('« prev'),
                            'next_text'    => __('next »'),
                        ));
                    }
                ?>
            </div>
        </div>
    <?php else : ?>
        <div style="text-align: center; font-size: 18px; padding: 150px 0 70px;">
            It seems we can’t find what you’re looking for.
        </div>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>

<?php } else { ?>


    <?php
                $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                $per_page = 10;
                $total = wp_count_terms('collection_management', array(
                    'parent'    => 0
                ));
                $offset = (($paged - 1) * $per_page);

                $jobs = get_terms(array(
                    'taxonomy'   => 'collection_management',
                    'number'     => $per_page,
                    'offset'     => $offset,
                    'parent' => 0,
                    'hide_empty' => false,
                ));
    ?>


    <div class="row">


        <!-- here design loop happen here  -->
        <?php foreach ($jobs as $job) { ?>
            <div class="col-lg-6">
                <a class="text-decoration-none text-dark" href="<?php echo site_url() . '/contributed-collections/?ptermid=' . $job->term_id; ?>">
                    <div class="d-flex gap-4 mb-4 collection-box rounded text-white collection-title" style="background: #A7A7A7;">
                        <?php echo $job->name; ?>
                    </div>
                </a>
            </div>
        <?php } ?>
        <!-- here design end  loop happen here-->
    </div>
    <div class="searchresults">
        <?php
                $big = 99999;
                echo paginate_links(array(
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '?paged=%#%',
                    'current' => $paged,
                    'total' => ceil(($total) / $per_page)
                ));
        ?>
    </div>
<?php } ?>
    </div>

    <div class="col-lg-4">
        
    </div>

</div>
</div>
<hr class="mt-5 w-75 m-auto" />
<?php get_template_part('partials/featured-collection'); ?>
<script>
    var btn_view = document.querySelector('.list-pdf__item');
    var btn_dl = document.querySelector('.dwnld-btn');
    var btn_close = document.querySelector('.fake_close_btn');
    var isProcessing = false;
    $(document).ready(function() {
        if (window.jQuery) {
            console.log('jQuery is loaded');
        } else {
            console.log('jQuery is NOT loaded');
        }
        $('.dwnld-btn').click(function() {
            console.log('click dl');
            var num_rows = <?php echo json_encode($row) ?>;
            var links = $('.download-btn_<?php echo json_encode($this_id) ?>[href$=".pdf"], .download-btn_<?php echo json_encode($this_id) ?>[href$=".jpg"], .download-btn_<?php echo json_encode($this_id) ?>[href$=".jpeg"], .download-btn_<?php echo json_encode($this_id) ?>[href$=".png"], .download-btn_<?php echo json_encode($this_id) ?>[href$=".gif"]').slice(0, num_rows);
            downloadSequentially(links, 0);

            if (isProcessing) {
                return; // If already processing, ignore the click event
            }
            isProcessing = true;
            var fileId = $(this).attr("data-postid");
            var currentTime = <?= json_encode($post_date) ?>;
            var post_id = $(this).attr("data-postid");
            console.log(post_id);
            $.ajax({
                type: "POST",
                url: "<?php echo esc_url(home_url('/')); ?>ajax-page",
                data: {
                    post_id: post_id,
                    file_id: fileId,
                    time: currentTime
                },
                success: function(response) {
                    console.log(response);

                },
                complete: function() {
                    isProcessing = false; // Set the flag to false after the request is completed
                }
            });
        });

        function downloadSequentially(links, index) {
            if (index < links.length) {
                var link = $(links[index]).attr('href');
                var a = document.createElement('a');
                a.href = link;
                a.target = '_blank';
                a.download = '';
                document.body.appendChild(a);
                a.click();
                setTimeout(function() {
                    document.body.removeChild(a);
                    downloadSequentially(links, index + 1);
                }, 500); // adjust the delay time as needed
            }
        }
        $('.fake_close_btn').click(function() {
            console.log('click');
            $('.df-lightbox-close').click();
            btn_dl.style.display = 'none';
            btn_close.style.display = 'none';

        });

    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var btn_view = document.querySelector('.list-pdf__item');
        var btn_dl = document.querySelector('.dwnld-btn');
        var btn_close = document.querySelector('.fake_close_btn');
        const listDataElements = document.querySelectorAll('.list-pdf__item');
        //  var flipbookclose = document.querySelector('.flipbook-icon-times');
        // Loop through each element and attach an onclick event handler
        listDataElements.forEach(function(element) {

            element.addEventListener('click', function() {
                const level = this.getAttribute("levels");
                setTimeout(function() {

                    console.log(level);
                    if (level === 'level_1') {
                        btn_dl.style.display = 'block';
                        btn_close.style.display = 'block';
                        //   flipbookclose.style.display = 'none';
                    } else {
                        btn_dl.style.display = 'none';
                        btn_close.style.display = 'block';
                    }
                }, 15000);


                console.log('collection');
                var view_postid = $(this).attr("data-postid");
                console.log(view_postid);
                $.ajax({
                    type: "POST",
                    url: "<?php echo esc_url(home_url('/')); ?>ajax-page",
                    data: {
                        view_postid: view_postid
                    },
                    success: function(response) {
                        console.log(response);

                    }
                });

            });
        });
    });
</script>
</section>

<?php get_footer();
