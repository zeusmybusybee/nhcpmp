<?php get_header(); ?>

<div class="container my-5">

    <div class="row">

        <!-- LEFT: RESULTS -->
        <div class="col-lg-8">

            <?php while (have_posts()) : the_post(); ?>
                <div class="d-flex gap-4 mb-4 p-4 bg-body-tertiary rounded">

                    <!-- Thumbnail -->
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="flex-shrink-0" style="width:120px;">
                            <?php the_post_thumbnail(
                                'medium',
                                ['class' => 'img-fluid rounded']
                            ); ?>
                        </div>
                    <?php endif; ?>

                    <!-- DETAILS COLUMN -->
                    <div class="flex-grow-1 d-flex flex-column">

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

                        <!-- TITLE -->
                        <h5 class="mb-1">
                            <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark fw-semibold">
                                <?php the_title(); ?>
                            </a>
                        </h5>

                        <!-- CALL NUMBER -->
                        <?php if ($call_number = get_field('call_number')) : ?>
                            <small class="text-muted fst-italic mb-2 d-block">
                                Call Number: <?php echo esc_html($call_number); ?>
                            </small>
                        <?php endif; ?>

                        <!-- DESCRIPTION -->
                        <p class="text-muted mb-3">
                            <?php echo wp_trim_words(get_the_excerpt(), 45); ?>
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
            <?php endwhile; ?>


        </div>

        <!-- RIGHT: SIDEBAR -->
        <div class="col-lg-4">

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
                    <div class="col-6">
                        <h6 class="mb-3 fw-bold">Filter by:</h6>

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
                    <div class="col-6">
                        <h6 class="mb-3 fw-bold">Sort by:</h6>

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
                    <div class="col-6 mt-4">
                        <h6 class="mb-3 fw-bold">Level of Access</h6>

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
                    <div class="col-6 mt-4">
                        <h6 class="mb-3 fw-bold">Availability:</h6>

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
                            class="btn w-100 fw-bold"
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