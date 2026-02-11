<?php get_header(); ?>

<div class="container py-5">

    <div class="row">

        <!-- LEFT: RESULTS -->
        <div class="col-lg-8">
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
                action="<?php echo esc_url(get_post_type_archive_link('foundation-of-towns')); ?>"
                class="p-4">

                <div class="row g-4 border rounded mb-5">
                    <!-- Always target foundation of town -->
                    <input type="hidden" name="post_type" value="foundation-of-towns">

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

                    <!-- SORT BY -->
                    <div class="col-10">
                        <h6 class="mb-3 fw-bold">Sort by:</h6>

                        <?php $orderby = $_GET['orderby'] ?? ''; ?>
                        <div class="d-flex flex-wrap gap-4">
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
                    </div>

                      <div class="col-12 mt-4">
                    <h6 class="fw-bold text-dark">Filter by Time:</h6>

                    <div class="container p-3 text-light">

                        <!-- Era -->
                 <select name="era" class="form-select">
                        <!-- Unang placeholder option -->
                        <option value="">Era</option>

                        <?php
                        global $wpdb;

                        $results = $wpdb->get_col(
                            "SELECT meta_value
                            FROM $wpdb->postmeta
                            WHERE meta_key = 'era'"
                        );

                        $eras = [];

                        foreach ($results as $row) {
                            $values = maybe_unserialize($row);
                            if (is_array($values)) {
                                foreach ($values as $val) {
                                    $eras[] = $val;
                                }
                            } else {
                                $eras[] = $values;
                            }
                        }

                        $eras = array_unique($eras);
                        sort($eras);

                        foreach ($eras as $era) : ?>
                            <option value="<?php echo esc_attr($era); ?>">
                                <?php echo esc_html($era); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>


                        <!-- Year -->
                        <select name="year" class="form-select mt-2">
                            <option value="">Select Year</option>
                            <?php 
                            $years = $wpdb->get_col("
                                SELECT DISTINCT YEAR(post_date) 
                                FROM $wpdb->posts
                                WHERE post_type = 'foundation-of-towns'
                                AND post_status = 'publish'
                                ORDER BY post_date DESC
                            ");
                            foreach ($years as $year) : ?>
                                <option value="<?php echo esc_attr($year); ?>">
                                    <?php echo esc_html($year); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                    </div> <!-- /.container -->
                </div> <!-- /.col -->


                      <div class="col-12 mt-4">
                        <h6 class="fw-bold text-dark">Filter by place:</h6>

                        <div class="container p-3  text-light">
                          <select name="region" id="region" class="form-select">
                            <option value="">Select Region</option>
                        </select>
                           <select name="province" id="province" class="form-select mt-3" disabled>
                            <option value="">Select Province</option>
                        </select>
                          <select name="city" id="city" class="form-select mt-3" disabled>
                            <option value="">Select City/Municipality</option>
                        </select>

                        </div> <!-- ✅ ito yung kulang -->
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