<style>
    .img-fluid {
        width:220px;
    }
</style>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <div class="col-lg-12 col-md-12">

            <div class="card h-100 border-0 shadow-sm text-center p-4 d-flex flex-row gap-4">
                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">

                    <!-- Thumbnail -->
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="mb-3">
                            <?php the_post_thumbnail(
                                'small',
                                ['class' => 'img-fluid mx-auto d-block']
                            ); ?>
                        </div>
                    <?php endif; ?>


                    <div class="one_line">
                        <!-- TITLE -->
                        <h3 class="fw-semibold mb-2 ph-heraldy-title pb-3">
                            <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                        <!-- META -->


                        <?php if (have_rows('collection')) : ?>

                            <?php $row_count = count(get_field('collection')); ?>

                            <div class="row">
                                <?php while (have_rows('collection')) : the_row(); ?>
                                    <?php
                                    $file = get_sub_field('file');
                                    $name = get_sub_field('name');
                                    $col_class = ($row_count > 3) ? 'col-md-6' : 'col-12';
                                    ?>

                                    <div class="<?php echo $col_class; ?> mb-3">
                                        <div class="card text-start px-2 py-2"
                                            style="background: #A7A7A7; font-size: 20px; font-weight: 800; font-family:Ysabeau;">

                                            <?php
                                            echo $file
                                                ? '<a style="color: #fff; text-decoration:none;" href="' . esc_url($file['url']) . '" target="_blank">' . esc_html($name ? $name : $file['title']) . '</a>'
                                                : '';
                                            ?>
                                        </div>
                                    </div>

                                <?php endwhile; ?>
                            </div>

                        <?php endif; ?>


                    </div>

                </a>
            </div>

        </div>
    <?php endwhile; ?>

<?php else : ?>
    <div class="col-12 text-center py-5">
        <h4>No items found matching your search or filters.</h4>
        <p>Please try a different search term or filter.</p>
    </div>
<?php endif; ?>