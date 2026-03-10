<?php

/*** Template Name: Add Format Management */
acf_form_head();
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
                        <div class="main-body__breadcrumb--list">/div>
                        </div>
                        <div class="main-body__area">
                            <div class="main-body__area--row">
                                <div class="main-body__area--form">
                                    <div class="main-body__area--title">
                                        <div class="title">
                                            <h3>Add New Format</h3>
                                        </div>
                                    </div>
                                    <div class="item-form-area">
                                        <!-- <form id="post" class="acf-form" action="" method="post"> -->
                                        <?php
                                        acf_form(array(
                                            'post_id' => 'new_post',
                                            'post_title' => true,
                                            'post_content' => true,
                                            'updated_message' => __("New Format  is successfully submitted.", 'acf'),
                                            'new_post' => array(
                                                'post_type' => 'format',
                                                'post_status' => 'publish',
                                            ),
                                            'submit_value' => 'Add Format Type',
                                        ));
                                        ?>
                                    </div>
                                </div>
                                <div class="main-body__area--collection">

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include get_theme_file_path('partials/footer.php'); ?>
                </div>
            </div>
        </div>
</section>



<?php get_footer('archiving'); ?>