<?php get_header(); ?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-8">



            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <!-- SINGLE CONTENT -->
                    <article id="post-<?php the_ID(); ?>" <?php post_class('mb-5'); ?>>

                        <h1 class="mb-3"><?php the_title(); ?></h1>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="mb-4">
                                <?php the_post_thumbnail('large', ['class' => 'img-fluid']); ?>
                            </div>
                        <?php endif; ?>

                        <div class="content mb-5">
                            <?php the_content(); ?>
                            1231232
                        </div>

                    </article>

            <?php endwhile;
            endif; ?>

            <!-- OTHER POSTS (SAME CPT, EXCLUDE CURRENT) -->
            <?php
            $current_id = get_the_ID();
            echo $current_id;

            $args = [
                'post_type'      => 'historical-sites',
                'posts_per_page' => 6, // change if needed
                'post__not_in'   => [$current_id],
                'orderby'        => 'date',
                'order'          => 'DESC',
                'post_status'    => 'publish',
            ];

            $other_posts = new WP_Query($args);
            ?>

            <?php if ($other_posts->have_posts()) : ?>
                <section class="other-posts mt-5">

                    <h3 class="mb-4">Other Entries</h3>

                    <div class="row g-4">
                        <?php while ($other_posts->have_posts()) : $other_posts->the_post(); ?>
                            <div class="col-lg-4 col-md-6">
                                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                    <div class="card h-100 border-0 shadow-sm text-center p-4">

                                        <div class="d-flex gap-2 mb-2 flex-wrap">
                                            <?php
                                            $status = get_field('status');

                                            $status_map = [
                                                'level_1'      => ['label' => 'Level I',    'class' => 'badge-open'],
                                                'level_2'   => ['label' => 'Level II',        'class' => 'badge-viewing'],
                                                'delisted'   => ['label' => 'Delisted',        'class' => 'badge-limited'],
                                                'removed' => ['label' => 'Removed',     'class' => 'badge-exclusive'],
                                            ];

                                            ?>

                                            <?php if ($status && isset($status_map[$status])) : ?>
                                                <span class="access-badge <?php echo esc_attr($status_map[$status]['class']); ?>">
                                                    <?php echo esc_html($status_map[$status]['label']); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Thumbnail -->
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="mb-3">
                                                <?php the_post_thumbnail(
                                                    'small',
                                                    ['class' => 'img-fluid mx-auto d-block']
                                                ); ?>
                                            </div>
                                        <?php endif; ?>

                                        <!-- TITLE -->
                                        <h6 class="fw-semibold mb-2">
                                            <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                                <?php the_title(); ?>
                                            </a>
                                        </h6>

                                        <!-- META -->
                                        <div class="text-muted small mt-auto text-start">
                                            <?php if ($regions = get_field('regions')) : ?>
                                                <div>Location: <?php echo esc_html($regions); ?> <?php echo esc_html(get_field('province_municipality')); ?></div>
                                            <?php endif; ?>
                                            <div><?php if (get_field('year_found')): echo 'Year Found:' . get_field('year_found');
                                                    endif; ?></div>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </section>
            <?php else : ?>
                <p>No historical site found.</p>
            <?php endif; ?>

            <?php wp_reset_postdata(); ?>
        </div>
        <div class="col-lg-4">
            <?php get_template_part('partials/sidebar-singlepage-historical'); ?>

        </div>

    </div>
</div>

<?php get_footer(); ?>