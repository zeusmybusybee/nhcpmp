<?php get_header(); ?>
<style>
    img#nrhss-main-image {
        min-width: 300px;
    }

    .details > div {
        margin-bottom: 20px;
        font-size: 18px;
    }
</style>

<div class="container my-5">
    <div class="row">
        <div class="col-md-8">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class('mb-5'); ?>>

                        <?php $gallery = get_field('nrhss_gallery'); ?>

                        <!-- TOP SECTION -->
                        <div class="row mb-5 align-items-start">

                            <!-- LEFT : IMAGE + GALLERY -->
                            <div class="col-lg-6">

                                <div class="nrhss-media-wrapper">

                                    <!-- MAIN IMAGE -->
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="nrhss-featured mb-3">
                                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>"
                                                class="img-fluid rounded shadow-sm"
                                                id="nrhss-main-image">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>


                            <!-- RIGHT : DETAILS CARD -->
                            <div class="col-lg-6">
                                <div class="card shadow-sm border-0 p-4">

                                    <div class="details">

                                        <?php
                                        $region = get_field('region');
                                        $province = get_field('province_text');
                                        $city = get_field('city_text');

                                        if ($region):

                                            $region_field = get_field_object('region');
                                        ?>
                                            <div><strong>Region:</strong> <?php echo esc_html($region_field['choices'][$region] ?? $region); ?></div>
                                            <div><strong>Province:</strong> <?php echo esc_html($province); ?></div>
                                            <div><strong>City/Municipality:</strong> <?php echo esc_html($city); ?></div>
                                        <?php endif; ?>

                                        <?php
                                        $marker = get_field('seals_logos');
                                        if ($marker):
                                            $field = get_field_object('seals_logos');
                                            $labels = [];
                                            foreach ($marker as $value) {
                                                $labels[] = $field['choices'][$value];
                                            }
                                        ?>
                                            <div><strong>Category:</strong> <?php echo esc_html(implode(', ', $labels)); ?></div>
                                        <?php endif; ?>


                                        <?php if (get_field('year_approved')): ?>
                                            <div><strong>Year Approved:</strong> <?php echo esc_html(get_field('year_approved')); ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- BUTTON -->
                                    <?php if ($pdf = get_field('pdf')) : ?>
                                        <a href="<?php echo esc_url($pdf['url']); ?>"
                                            class="btn btn-success w-100 mt-4"
                                            target="_blank">
                                            View PDF
                                        </a>
                                    <?php endif; ?>

                                </div>
                            </div>

                        </div>


                        <!-- TITLE -->
                        <h1 class="mb-3"><?php the_title(); ?></h1>

                        <!-- CONTENT -->
                        <div class="content mb-5">
                            <?php the_content(); ?>
                        </div>


                        <!-- TAGS -->
                        <?php
                        $tags = get_the_terms(get_the_ID(), 'post_tag');
                        if ($tags && !is_wp_error($tags)) :
                        ?>
                            <div class="content list_tags mb-5">
                                <strong>Tags:</strong>
                                <?php foreach ($tags as $tag) : ?>
                                    <a href="<?php echo esc_url(get_term_link($tag)); ?>" class="badge bg-secondary me-1">
                                        <?php echo esc_html($tag->name); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                    </article>

            <?php endwhile;
            endif; ?>




            <!-- OTHER POSTS (SAME CPT, EXCLUDE CURRENT) -->
            <?php
            $current_id = get_the_ID();
            // echo $current_id;

            $args = [
                'post_type'      => 'ph-heraldry-registry',
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

                    <h3 class="mb-4">Other related resources</h3>

                    <div class="row g-4">
                        <?php while ($other_posts->have_posts()) : $other_posts->the_post(); ?>
                            <div class="d-flex gap-3 mb-4 p-5 bg-body-secondary rounded">
                                .
                                <!-- Thumbnail -->
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="flex-shrink-0" style="width:200px; height:140px; overflow:hidden;">
                                        <?php the_post_thumbnail('thumbnail', ['class' => 'img-fluid h-100 w-200 object-fit-cover']); ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Content -->
                                <div class="flex-grow-1">
                                    <h6 class="size_title">
                                        <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                            <?php the_title(); ?>
                                        </a>
                                    </h6>
                                    <p class="mb-0 text-muted article-excerpt">
                                        <?php echo wp_trim_words(get_the_excerpt(), 100); ?>
                                    </p>
                                    <div class="d-flex justify-content-between mt-5">
                                        <div class="location">

                                            <?php
                                            $region = get_field('region');
                                            $province = get_field('province_text');
                                            $city = get_field('city_text');

                                            if ($region):
                                                echo '<strong>Location:</strong> ';
                                                $region_field = get_field_object('region');
                                                echo esc_html($region_field['choices'][$region] ?? $region);
                                            endif;

                                            if ($province):
                                                echo ', ' . esc_html($province) . ',';
                                            endif;

                                            if ($city):
                                                echo esc_html($city);
                                            endif;
                                            ?>
                                        </div>
                                        <div class="category">
                                            <?php
                                            $marker = get_field('seals_logos');
                                            if ($marker):
                                                $field = get_field_object('seals_logos');
                                                $labels = [];
                                                foreach ($marker as $value) {
                                                    $labels[] = $field['choices'][$value];
                                                }
                                                echo '<strong>Category:</strong> ' . esc_html(implode(', ', $labels));
                                            endif;
                                            ?>
                                        </div>
                                    </div>
                                </div>

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
            <?php get_template_part('partials/siderbar-singlepage-heraldry'); ?>

            <!-- SIDEBAR CONTENT -->
            <div class="sidebar_article mt-4">
                <?php get_template_part('partials/sidebar-welcome'); ?>
                <?php get_template_part('partials/sidebar-location-info'); ?>
            </div>
        </div>

    </div>
</div>

<?php get_footer(); ?>