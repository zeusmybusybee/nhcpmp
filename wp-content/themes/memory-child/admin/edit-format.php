<?php

/*** Template Name: Edit Format */
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
                        <div class="main-body__breadcrumb--list"></div>
                    </div>
                    <div class="main-body__area">
                        <div class="main-body__area--row">
                            <div class="main-body__area--form">
                                <div class="main-body__area--title">
                                    <div class="title">
                                        <h3>Edit Format</h3>

                                    </div>
                                </div>
                                <div class="item-form-area">
                                    <?php $post_id = $_GET["post"]; ?>

                                    <?php acf_form(array(
                                        'post_id' => $post_id, //Variable that you'll get from the URL
                                        'post_title' => true,
                                        'post_content' => true,
                                        'submit_value' => 'Update Format',
                                        'return' => '%post_url%', //Returns to the original post
                                    )); ?>
                                </div>
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