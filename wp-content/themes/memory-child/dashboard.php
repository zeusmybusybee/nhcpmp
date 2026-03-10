<?php

/*** Template Name: Dashboard */
get_header('archiving'); ?>

<section>
    <div class="main-content">
        <?php require_once "partials/sidebar.php"; ?>
        <?php require_once "partials/navbar.php"; ?>
        <div class="main-body">
            <div class="main-body__content">
                <div class="main-body__container">
                    <div class="main-body__content--header">
                        <h3>Welcome to the NHCP National Memory Project</h3>
                        <div class="watermark">
                            <img src="" alt="Notif Icon">
                        </div>
                    </div>



                    <?php if (current_user_can('library')) { ?>

                        <div class="dashboard">
                            <div class="dashboard__row">

                                <?php

                                $args = array(
                                    'post_type' => 'format',
                                    'posts_per_page' => -1,
                                    'orderby' => 'title',
                                    'order' => 'ASC',
                                );

                                $the_query = new WP_Query($args);

                                ?>
                                <?php if ($the_query->have_posts()): ?>

                                    <?php while ($the_query->have_posts()) : $the_query->the_post();
                                        $postid = get_the_ID(); ?>


                                        <?php
                                        $rowcount = $wpdb->get_var("SELECT COUNT(*) FROM wp_posts INNER JOIN wp_postmeta ON wp_postmeta.post_id = wp_posts.ID WHERE (post_type='books-manuscript' OR post_type='academic-courseworks' OR post_type='audio-recordings' OR post_type='audio-visual' OR post_type='e-resources' OR post_type='serial' OR post_type='video-recording' OR post_type='website' OR post_type='analytic-literature' OR post_type='cases' OR post_type='periodical-article' OR post_type='vertical-file' OR post_type='archive' OR post_type='museums' OR post_type='patrons') AND wp_postmeta.meta_key = 'format_attribute' AND wp_postmeta.meta_value= '$postid' AND post_status='publish'");

                                        if ($rowcount) { ?>

                                            <div class="dashboard__item">
                                                <div class="dashboard__item--title"><?php echo $format_title = get_the_title(); ?></div>
                                                <div class="dashboard__item--count">

                                                    <?php echo $rowcount; ?>
                                                </div>
                                                <div class="dashboard__item--watermark">
                                                    <img src="" alt="Watermark Item">
                                                </div>
                                            </div>
                                        <?php }


                                        ?>



                                    <?php endwhile; ?>

                                <?php endif; ?>




                            </div>
                        </div>

                    <?php } elseif (current_user_can('archiving')) { ?>



                        <div class="dashboard">
                            <div class="dashboard__row">

                                <?php

                                $args = array(
                                    'post_type' => 'format',
                                    'posts_per_page' => -1,
                                    'orderby' => 'title',
                                    'order' => 'ASC',
                                );

                                $the_query = new WP_Query($args);

                                ?>
                                <?php if ($the_query->have_posts()): ?>

                                    <?php while ($the_query->have_posts()) : $the_query->the_post();
                                        $postid = get_the_ID(); ?>


                                        <?php
                                        $rowcount = $wpdb->get_var("SELECT COUNT(*) FROM wp_posts INNER JOIN wp_postmeta ON wp_postmeta.post_id = wp_posts.ID WHERE (post_type='item') AND wp_postmeta.meta_key = 'format_attribute' AND wp_postmeta.meta_value= '$postid' AND post_status='publish'");
                                        if ($rowcount) {
                                        ?>
                                            <div class="dashboard__item">
                                                <div class="dashboard__item--title"><?php echo $format_title = get_the_title(); ?></div>
                                                <div class="dashboard__item--count">
                                                    <?php
                                                    echo $rowcount;

                                                    ?>
                                                </div>
                                                <div class="dashboard__item--watermark">
                                                    <img src="" alt="Watermark Item">
                                                </div>
                                            </div>




                                    <?php }
                                    endwhile; ?>

                                <?php endif; ?>




                            </div>
                        </div>


                    <?php } elseif (current_user_can('administrator')) { ?>


                        <div class="dashboard">
                            <div class="dashboard__row">

                                <?php

                                $args = array(
                                    'post_type' => 'format',
                                    'posts_per_page' => -1,
                                    'orderby' => 'title',
                                    'order' => 'ASC',
                                );

                                $the_query = new WP_Query($args);

                                ?>
                                <?php if ($the_query->have_posts()): ?>

                                    <?php while ($the_query->have_posts()) : $the_query->the_post();
                                        $postid = get_the_ID(); ?>


                                        <?php
                                        $rowcount = $wpdb->get_var("SELECT COUNT(*) FROM wp_posts INNER JOIN wp_postmeta ON wp_postmeta.post_id = wp_posts.ID WHERE (post_type='item' OR post_type='books-manuscript' OR post_type='academic-courseworks' OR post_type='audio-recordings' OR post_type='audio-visual' OR post_type='e-resources' OR post_type='serial' OR post_type='video-recording' OR post_type='website' OR post_type='analytic-literature' OR post_type='cases' OR post_type='periodical-article' OR post_type='vertical-file' OR post_type='archive' OR post_type='museums' OR post_type='patrons') AND wp_postmeta.meta_key = 'format_attribute' AND wp_postmeta.meta_value= '$postid' AND post_status='publish'");

                                        if ($rowcount) { ?>

                                            <div class="dashboard__item">
                                                <div class="dashboard__item--title"><?php echo $format_title = get_the_title(); ?></div>
                                                <div class="dashboard__item--count">

                                                    <?php echo $rowcount; ?>
                                                </div>
                                                <div class="dashboard__item--watermark">
                                                    <img src="" alt="Watermark Item">
                                                </div>
                                            </div>
                                        <?php }


                                        ?>



                                    <?php endwhile; ?>

                                <?php endif; ?>




                            </div>
                        </div>

                    <?php } elseif (current_user_can('employee')) { ?>

                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

                        <div class="table">
                            <form role="search" method="get" class="srch__form--area" action="<?php echo esc_url(home_url('/')); ?>">
                                <div class="srch__form--input">
                                    <span class="screen-reader-text"><?php _e('Search for:', 'textdomain'); ?></span>
                                    <input type="search" class="search-field" placeholder="<?php _e('Search in Catalogue', 'textdomain'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                                </div>
                                <div class="srch__form--btn">
                                    <input type="submit" value="<?php _e('Search', 'textdomain'); ?>" />
                                </div>
                            </form>
                        </div>

                        <div class="table">
                            <div class="main-body__area--title">
                                <div class="title">
                                    <h3><i class="fa fa-bullhorn" aria-hidden="true"></i> Announcements</h3>
                                </div>
                            </div>
                            <br>
                            <div class="user-announcement">
                                <?php
                                $args = array(
                                    'post_type' => 'announcements',
                                    'post_status' => 'publish',
                                    'posts_per_page' => 5,
                                    'orderby'   => array(
                                        'date' => 'DESC',
                                    )
                                );

                                $loop = new WP_Query($args);
                                if ($loop->have_posts()) :
                                    while ($loop->have_posts()) : $loop->the_post(); ?>
                                        <div class="announcement-container">
                                            <div class="announce-title">
                                                <strong><?php echo get_the_title(); ?></strong>
                                            </div>
                                            <div class="announce-date">
                                                <small><?php echo get_the_date(); ?></small>
                                            </div>
                                            <div class="announce-desc">
                                                <?php echo get_the_content(); ?>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                    <?php wp_reset_postdata(); ?>

                                <?php else : ?>
                                    <div style="text-align: center; font-size: 18px; padding: 150px 0 70px;">
                                        No announcements available
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                    <?php } ?>


                    <?php /* ?>
                    <div class="component">
                        <div class="component__start">
                            <div class="component__start--row">
                                <div class="component__start--desc">
                                    <div class="component__start--title">
                                        Start Now
                                    </div>
                                    <div class="component__start--info">
                                        <p>With our responsive themes and mobile and desktop apps, enjoy a seamless
                                            experience on any device so will your blog the best visitors.</p>
                                    </div>
                                    <div class="component__start--button">
                                        <a href="">Learn More</a>
                                    </div>
                                </div>
                                <div class="component__start--img">
                                    <img src="<?php echo THEME_DIR; ?>/assets/img/img_start.png" alt="Watermark Item">
                                </div>
                            </div>

                        </div>
                        <div class="component__notice">
                            <div class="component__notice--title">
                                Notice Board
                            </div>
                            <div class="component__notice--body">
                                <div class="component__notice--content">
                                    <div class="component__notice--icon">
                                        <img src="<?php echo THEME_DIR; ?>/assets/img/icon/ic_mail.svg"
                                            alt="Message Icon">
                                    </div>
                                    <div class="component__notice--info">
                                        Selena comments on your posts about Algorithm tasks
                                    </div>
                                </div>
                                <div class="component__notice--content">
                                    <div class="component__notice--icon">
                                        <img src="<?php echo THEME_DIR; ?>/assets/img/icon/ic_mail.svg"
                                            alt="Message Icon">
                                    </div>
                                    <div class="component__notice--info">
                                        Selena comments on your posts about Algorithm tasks
                                    </div>
                                </div>
                                <div class="component__notice--content">
                                    <div class="component__notice--icon">
                                        <img src="<?php echo THEME_DIR; ?>/assets/img/icon/ic_mail.svg"
                                            alt="Message Icon">
                                    </div>
                                    <div class="component__notice--info">
                                        Selena comments on your posts about Algorithm tasks
                                    </div>
                                </div>
                                <div class="component__notice--content">
                                    <div class="component__notice--icon">
                                        <img src="<?php echo THEME_DIR; ?>/assets/img/icon/ic_mail.svg"
                                            alt="Message Icon">
                                    </div>
                                    <div class="component__notice--info">
                                        Selena comments on your posts about Algorithm tasks
                                    </div>
                                </div>
                                <div class="component__notice--content">
                                    <div class="component__notice--icon">
                                        <img src="<?php echo THEME_DIR; ?>/assets/img/icon/ic_mail.svg"
                                            alt="Message Icon">
                                    </div>
                                    <div class="component__notice--info">
                                        Selena comments on your posts about Algorithm tasks
                                    </div>
                                </div>
                                <div class="component__notice--content">
                                    <div class="component__notice--icon">
                                        <img src="<?php echo THEME_DIR; ?>/assets/img/icon/ic_mail.svg"
                                            alt="Message Icon">
                                    </div>
                                    <div class="component__notice--info">
                                        Selena comments on your posts about Algorithm tasks
                                    </div>
                                </div>
                                <div class="component__notice--content">
                                    <div class="component__notice--icon">
                                        <img src="<?php echo THEME_DIR; ?>/assets/img/icon/ic_mail.svg"
                                            alt="Message Icon">
                                    </div>
                                    <div class="component__notice--info">
                                        Selena comments on your posts about Algorithm tasks
                                    </div>
                                </div>
                                <div class="component__notice--content">
                                    <div class="component__notice--icon">
                                        <img src="<?php echo THEME_DIR; ?>/assets/img/icon/ic_mail.svg"
                                            alt="Message Icon">
                                    </div>
                                    <div class="component__notice--info">
                                        Selena comments on your posts about Algorithm tasks
                                    </div>
                                </div>
                                <div class="component__notice--content">
                                    <div class="component__notice--icon">
                                        <img src="<?php echo THEME_DIR; ?>/assets/img/icon/ic_mail.svg"
                                            alt="Message Icon">
                                    </div>
                                    <div class="component__notice--info">
                                        Selena comments on your posts about Algorithm tasks
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php */ ?>


                </div>

                <?php require_once "partials/footer.php"; ?>
            </div>
        </div>
    </div>
</section>


<?php get_footer('archiving'); ?>