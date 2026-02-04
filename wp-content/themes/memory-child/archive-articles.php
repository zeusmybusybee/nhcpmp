<?php get_header(); ?>
<div class="container my-5">
    <?php if ( have_posts() ) : ?>
        <div class="row d-flex flex-column">
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="col-md-12 mb-4">
                    <div class="card h-100">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail('medium', ['class' => 'card-img-top']); ?>
                        <?php endif; ?>

                        <div class="card-body">
                            <h5 class="card-title"><?php the_title(); ?></h5>
                            <p class="card-text"><?php the_excerpt(); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                                View
                            </a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <?php the_posts_pagination(); ?>

    <?php else : ?>
        <p>No posts found.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
