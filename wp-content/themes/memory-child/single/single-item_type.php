<?php
$user = wp_get_current_user();

if (in_array('library', (array) $user->roles)) : ?>
    <?php

    get_header('archiving');
    ?>

    <section>
        <div class="main-content">

            <?php include get_theme_file_path('partials/sidebar.php'); ?>
            <?php include get_theme_file_path('partials/navbar.php'); ?>
            <div class="main-body">
                <div class="main-body__content">
                    <div class="main-body__container">
                        <div class="main-body__breadcrumb">
                            <div class="main-body__breadcrumb--list"></div>
                        </div>
                        <div class="main-body__area">

                            <?php
                            while (have_posts()) {
                                the_post();
                            ?>
                                <div class="main-body__area--row">
                                    <div class="main-body__area--full">
                                        <div class="main-body__area--title">
                                            <h3><?php the_title(); ?></h3>
                                        </div>
                                        <div class="main-body__area--description">
                                            <?php the_content(); ?>
                                        </div>

                                    </div>
                                </div>

                                <div class="table__header" style="margin-top: 25px; justify-content: end; padding-bottom: 0;">
                                    <div class="viewall-area">
                                        <a href="<?php echo site_url() . '/edit-item-type/?post=' . get_the_id(); ?>">Edit</a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php include get_theme_file_path('partials/footer.php'); ?>
                </div>
            </div>
        </div>
    </section>


    <?php get_footer('archiving'); ?>

    <?php get_header(); ?>
    <div class="main-content">
        <?php

        get_template_part('template-parts/content-single-book-default');

        // get_sidebar();
        ?>
    </div>
    <?php get_footer('archiving'); ?>
<?php else : ?>
    <?php get_header(); ?>
    <div class="main-content">
        <?php

        get_template_part('template-parts/content-single-book-default');

        // get_sidebar();
        ?>
    </div>
    <?php get_footer(); ?>

<?php endif; ?>