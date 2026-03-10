<?php

/*** Template Name: Format */
get_header('archiving');

?>


<section>
    <div class="main-content">
        <?php include get_theme_file_path('partials/sidebar.php'); ?>
        <?php include get_theme_file_path('partials/navbar.php'); ?>
        <div class="main-body">
            <div class="main-body__content">
                <div class="main-body__container">
                    <div class="main-body__content--header">
                        <h3>Format Management </h3>
                        <div class="watermark">
                            <img src="" alt="Notif Icon">
                        </div>
                    </div>

                    <div class="table">
                        <div class="table__header">
                            <div class="table__header--browse">
                                <div class="browse">
                                    <p>Browse Format</p>
                                    <span>More than 1000+ Browse Role</span>
                                </div>
                                <div class="button">
                                    <a href="<?php echo site_url('/add-format'); ?>">Add</a>
                                </div>
                            </div>
                        </div>

                        <div class="table__content">
                            <?php
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            $arg_item = array(
                                'post_type' => 'format',
                                'post_status' => 'publish',
                                'posts_per_page' => -1,
                                'paged' => $paged,
                            );
                            $arg_query = new WP_Query($arg_item);
                            ?>
                            <table id="table_format" class="display">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php if ($arg_query->have_posts()) { ?>
                                    <tbody>
                                        <?php while ($arg_query->have_posts()) {
                                            $arg_query->the_post(); ?>
                                            <tr>
                                                <td>
                                                    <?php the_title(); ?>
                                                </td>
                                                <td>
                                                    <?php echo wp_trim_words(get_the_content(), 20, '...'); ?>
                                                </td>
                                                <td class="actions">
                                                    <div class="table__content--body action">
                                                        <a href="<?php the_permalink(); ?>" class="preview">Preview</a>
                                                        <a href="<?php echo get_delete_post_link(); ?>" class="delete"
                                                            onclick="return confirm('Are you sure you wanna delete this?')">Delete</a>
                                                        <a href="<?php echo site_url('/edit-format'); ?>?post=<?php the_ID(); ?>"
                                                            class="edit">Edit</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                <?php include get_theme_file_path('partials/footer.php'); ?>
            </div>
        </div>
    </div>
</section>





<?php get_footer('archiving'); ?>