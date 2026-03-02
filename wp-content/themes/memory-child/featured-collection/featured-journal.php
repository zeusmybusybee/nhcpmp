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

                    <!-- TITLE -->
                    <h3 class="fw-semibold mb-2 ph-heraldy-title">
                        <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                            <?php the_title(); ?>
                        </a>
                    </h3>

                    <!-- META -->
                    <div class="text-muted small mt-4 text-start meta-ph-heraldy">

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