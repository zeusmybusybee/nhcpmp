<?php

/*** Template Name: Edit Role */
// acf_form_head();
ob_start();
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
                                        <h3>Edit Role</h3>
                                    </div>
                                </div>
                                <div class="user">
                                    <?php
                                    $role_slug = $_GET['role'];
                                    $role = get_role($role_slug);

                                    if (isset($_POST['update_role'])) {
                                        $role->name = $_POST['role_name'];
                                        add_role($role_slug, $role->capabilities);
                                        wp_redirect(get_site_url() . '/role/');
                                        exit;
                                    }
                                    ?>

                                    <div class="user__add">
                                        <form method="post">
                                            <div class="user__add--row">
                                                <div class="user__add--field">
                                                    <div class="user__add--label">
                                                        <label for="role_slug">Role Slug:</label>
                                                    </div>
                                                    <div class="user__add--input">
                                                        <input type="text" id="role_slug" name="role_slug"
                                                            value="<?php echo $role_slug; ?>" disabled />
                                                    </div>
                                                </div>
                                                <div class="user__add--field">
                                                    <div class="user__add--label">
                                                        <label for="role_name">Role Name:</label>
                                                    </div>
                                                    <div class="user__add--input">
                                                        <input type="text" id="role_name" name="role_name"
                                                            value="<?php echo $role->name; ?>" />
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="user__add--btn">
                                                <input type="submit" name="update_role" value="Update Role">
                                            </div>
                                        </form>
                                    </div>

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