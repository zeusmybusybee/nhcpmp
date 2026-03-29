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
                                        <div class="item-form-area">
                                            <div class="single-area">
                                                <div class="single-area__row">
                                                    <div class="single-area__row--label">
                                                        Title
                                                    </div>
                                                    <div class="single-area__row--info">
                                                        <?php the_title(); ?>
                                                    </div>
                                                </div>
                                                <div class="single-area__row">
                                                    <div class="single-area__row--label">
                                                        Subject
                                                    </div>
                                                    <div class="single-area__row--info">
                                                        <?php
                                                        $terms = get_field('subject');
                                                        if ($terms): ?>
                                                            <?php foreach ($terms as $term): ?>
                                                                <span><?php echo esc_html($term->name); ?></span>,
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="single-area__row">
                                                    <div class="single-area__row--label">
                                                        Description
                                                    </div>
                                                    <div class="single-area__row--info">
                                                        <?php the_field('description'); ?>
                                                    </div>
                                                </div>
                                                <div class="single-area__row">
                                                    <div class="single-area__row--label">
                                                        Creator
                                                    </div>
                                                    <div class="single-area__row--info">
                                                        <?php the_field('creator'); ?>
                                                    </div>
                                                </div>
                                                <div class="single-area__row">
                                                    <div class="single-area__row--label">
                                                        Source
                                                    </div>
                                                    <div class="single-area__row--info">
                                                        <?php the_field('source'); ?>
                                                    </div>
                                                </div>

                                                <div class="single-area__row">
                                                    <div class="single-area__row--label">
                                                        Publisher
                                                    </div>
                                                    <div class="single-area__row--info">
                                                        <?php the_field('publisher'); ?>
                                                    </div>
                                                </div>

                                                <div class="single-area__row">
                                                    <div class="single-area__row--label">
                                                        Date
                                                    </div>
                                                    <div class="single-area__row--info">
                                                        <?php the_field('date'); ?>
                                                    </div>
                                                </div>

                                                <div class="single-area__row">
                                                    <div class="single-area__row--label">
                                                        Contributor
                                                    </div>
                                                    <div class="single-area__row--info">
                                                        <?php the_field('contributor'); ?>
                                                    </div>
                                                </div>

                                                <div class="single-area__row">
                                                    <div class="single-area__row--label">
                                                        Rights
                                                    </div>
                                                    <div class="single-area__row--info">
                                                        <?php the_field('rights'); ?>
                                                    </div>
                                                </div>

                                                <div class="single-area__row">
                                                    <div class="single-area__row--label">
                                                        Relation
                                                    </div>
                                                    <div class="single-area__row--info">
                                                        <?php the_field('relation'); ?>
                                                    </div>
                                                </div>

                                                <div class="single-area__row">
                                                    <div class="single-area__row--label">
                                                        Format
                                                    </div>
                                                    <div class="single-area__row--info">
                                                        <?php the_field('format'); ?>
                                                    </div>
                                                </div>

                                                <div class="single-area__row">
                                                    <div class="single-area__row--label">
                                                        Language
                                                    </div>
                                                    <div class="single-area__row--info">
                                                        <?php the_field('language'); ?>
                                                    </div>
                                                </div>

                                                <div class="single-area__row">
                                                    <div class="single-area__row--label">
                                                        Type
                                                    </div>
                                                    <div class="single-area__row--info">
                                                        <?php the_field('type'); ?>
                                                    </div>
                                                </div>

                                                <div class="single-area__row">
                                                    <div class="single-area__row--label">
                                                        Identifier
                                                    </div>
                                                    <div class="single-area__row--info">
                                                        <?php the_field('identifier'); ?>
                                                    </div>
                                                </div>

                                                <div class="single-area__row">
                                                    <div class="single-area__row--label">
                                                        Coverage
                                                    </div>
                                                    <div class="single-area__row--info">
                                                        <?php the_field('coverage'); ?>
                                                    </div>
                                                </div>


                                                <div class="single-area__row">
                                                    <div class="single-area__row--label">
                                                        Level
                                                    </div>
                                                    <div class="single-area__row--info">
                                                        <?php
                                                        $level = get_field_object('level');
                                                        $value = $level['value'];
                                                        $label = $level['choices'][$value];
                                                        ?>
                                                        <?php echo esc_html($label); ?></span>

                                                    </div>
                                                </div>

                                                <div class="single-area__row">
                                                    <div class="single-area__row--label">
                                                        File
                                                    </div>
                                                    <div class="single-area__row--info">
                                                        <?php
                                                        if (have_rows('file_content')) {
                                                            while (have_rows('file_content')) {
                                                                the_row();
                                                                $file = get_sub_field('add__new_files');
                                                        ?>
                                                                <div>
                                                                    <a
                                                                        href="<?php echo $file['url']; ?>"><?php echo $file['title']; ?></a>
                                                                </div>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                        <?php
                                                        $file_limit = get_field('file_content_limit');
                                                        if ($file_limit): ?>
                                                            <a
                                                                href="<?php echo $file_limit['url']; ?>"><?php echo $file_limit['title']; ?></a>
                                                        <?php endif; ?>

                                                    </div>
                                                </div>

                                                <div class="single-area__row">
                                                    <div class="single-area__row--label">
                                                        Collection Management
                                                    </div>
                                                    <div class="single-area__row--info">
                                                        <?php
                                                        $term = get_field('choose_category');
                                                        if ($term): ?>
                                                            <?php
                                                            $term_id = $term->term_id;
                                                            ?>
                                                            <?php
                                                            $taxonomy = 'collection_management'; // replace with your taxonomy name
                                                            $separator = ' &rarr; ';

                                                            $term = get_term($term_id, $taxonomy);
                                                            $parents = get_term_parents_list($term_id, $taxonomy, array('separator' => $separator, 'link' => false, 'format' => 'name'));
                                                            // remove the separator and the last character from the string
                                                            $parents = substr($parents, 0, strrpos($parents, $separator));
                                                            echo $parents;
                                                            ?>

                                                        <?php endif; ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table__header" style="margin-top: 25px; justify-content: end; padding-bottom: 0;">
                                            <div class="viewall-area">
                                                <a href="<?php echo site_url() . '/edit-item/?post=' . get_the_id(); ?>">Edit</a>
                                            </div>
                                        </div>
                                    </div>
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

<?php else : ?>

    <?php get_header(); ?>
    <style>
        body.single-item {
            background-color: #F7F7F7;
        }
    </style>
    <div class="main-content">
        <?php

        get_template_part('template-parts/content-single-book-default');

        ?>
    </div>
    <?php get_footer(); ?>

<?php endif; ?>