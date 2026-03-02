<style>
    .single-a-v-material .site-content {
        background: #000 !important;
    }
</style>
<?php get_header(); ?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-12">



            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class('mb-5'); ?>>



                        <?php
                        $gallery = get_field('nrhss_gallery');
                        ?>

                        <div class="nrhss-media-wrapper mb-4">

                            <!-- MAIN IMAGE -->
                            <div class="nrhss-featured">
                                <?php if (has_post_thumbnail()) :
                                    $featured_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                                ?>
                                    <img
                                        src="<?php echo esc_url($featured_url); ?>"
                                        class="nrhss-featured-img"
                                        id="nrhss-main-image">
                                <?php endif; ?>
                            </div>

                            <!-- THUMBNAILS -->
                            <?php if ($gallery) : ?>
                                <div class="nrhss-gallery">
                                    <?php foreach ($gallery as $index => $image) : ?>
                                        <img
                                            src="<?php echo esc_url($image['sizes']['thumbnail']); ?>"
                                            data-full="<?php echo esc_url($image['sizes']['large']); ?>"
                                            class="nrhss-thumb <?php echo $index === 0 ? 'active' : ''; ?>">
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                        </div>

                        <div class="content mb-5">
                            <h1 class="mb-3 mt-3" style="color:#fff;"><?php the_title(); ?></h1>
                        </div>

                    </article>

            <?php endwhile;
            endif; ?>
        </div>
    </div>
    <style>
        /* av materials */
        .object-fit-cover {
            object-fit: cover;
        }

        .card {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.03);
        }

        .card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .card:hover::after {
            opacity: 1;
        }

        .bg-darken {
            background: #000;
        }

        .texting_title {
            font-size: 18px;
            font-style: italic;
            font-weight: 500;
        }

        .card:hover {
            border: none !important;
        }
    </style>
    <?php get_footer(); ?>