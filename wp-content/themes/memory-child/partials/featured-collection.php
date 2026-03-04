<?php
$frontpage_id = get_option('page_on_front');

if (have_rows('homepage_settings', $frontpage_id)) :
    while (have_rows('homepage_settings', $frontpage_id)) : the_row();

        if (get_row_layout() === 'featured_collections') :

            if (have_rows('featured_collections_item')) :
                $classes = ['navy', 'red', 'purple', 'green', 'darkgreen', 'teal', 'orange', 'gold'];
                $i = 0;
?>
                <section class="featured-collections">
                    <div class="container">
                        <h2 class="mt-0">Featured Collections</h2>

                        <div class="collections-grid mt-5">
                            <?php while (have_rows('featured_collections_item')) : the_row();

                                $title       = get_sub_field('title');
                                $description = get_sub_field('description');
                                $url         = get_sub_field('featured_link'); // TEXT FIELD
                                $card_class  = $classes[$i] ?? 'navy';
                            ?>

                                <?php if ($url) : ?>
                                    <a href="<?php echo esc_url($url); ?>"
                                        class="card <?php echo esc_attr($card_class); ?>">
                                    <?php else : ?>
                                        <article class="card <?php echo esc_attr($card_class); ?>">
                                        <?php endif; ?>

                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/zigzag-icon.png" alt="Featured Collection">

                                        <?php if ($title) : ?>
                                            <h3><?php echo esc_html($title); ?></h3>
                                        <?php endif; ?>

                                        <?php if ($description) : ?>
                                            <p><?php echo esc_html($description); ?></p>
                                        <?php endif; ?>

                                        <?php if ($url) : ?>
                                    </a>
                                <?php else : ?>
                                    </article>
                                <?php endif; ?>

                            <?php
                                $i++;
                            endwhile; ?>
                        </div>
                    </div>
                </section>
<?php
            endif;

        endif;

    endwhile;
endif;
?>