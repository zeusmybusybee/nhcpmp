<?php
/*** Template Name: Add Archives */
acf_form_head();
get_header();
?>

<section>
    <div class="main-content">

        <?php include get_theme_file_path('partials/sidebar.php');?>
        <?php include get_theme_file_path('partials/navbar.php');?>
        <div class="main-body">
            <div class="main-body__content">
                <div class="main-body__container">
                    <div class="main-body__breadcrumb">
                        <div class="main-body__breadcrumb--list"><?php get_breadcrumb();?></div>
                    </div>
                    <?php if($_GET['updated']){ ?>
                        <div class="table__header" style="margin-top: 25px; padding-bottom: 0;">
                            <div class="viewall-area">
                                <a href="<?php echo get_permalink($_GET['updated']); ?>">View Newly Added</a>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="main-body__area">
                        <div class="catalog">
                            <div class="catalog__add">
                                <div class="catalog__add--title">
                                    <h3>
                                        Archival Material Description Module
                                    </h3>
                                </div>
                                <div class="catalog__add--content">
                                    <?php
acf_form(array(
    'post_id' => 'new_post',
    'post_title' => true,
    'post_content' => false,
    'field_groups' => array(
        'group_63ce1a4ecfeab',
    ),
    'updated_message' => __("New Archive is successfully submitted.", 'acf'),
    'new_post' => array(
        'post_type' => 'archive',
        'post_status' => 'publish',
    ),
    'submit_value' => 'Submit',
    'return' =>  '?updated=%post_id%'
));
?>
                                    
                                    <div class="table__header" style="margin-top: -48px; justify-content: end; padding-bottom: 0;">
                                        <div class="viewall-area">
                                            <a href="<?php echo home_url(add_query_arg(array(), $wp->request)); ?>">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <?php include get_theme_file_path('partials/footer.php');?>
            </div>
        </div>
    </div>
</section>

<?php get_footer();?>