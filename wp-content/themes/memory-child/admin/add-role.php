<?php

/*** Template Name: Add User Role */
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
                                        <h3>Add New User Role</h3>
                                    </div>
                                </div>
                                <div class="user">
                                    <div class="user__add">
                                        <?php
                                        if (isset($_POST['add_role'])) {
                                            $role_name = $_POST['role_name'];
                                            $role_display_name = $_POST['role_display_name'];
                                            add_role($role_name, $role_display_name);
                                            echo '<p>Role ' . $role_name . ' with display name ' . $role_display_name . ' added successfully!</p>';
                                        }
                                        ?>
                                        <form action="" method="post">
                                            <div class="user__add--row">
                                                <div class="user__add--field">
                                                    <div class="user__add--label">
                                                        <label for="role_name">Role Name:</label>
                                                    </div>
                                                    <div class="user__add--input">
                                                        <input type="text" id="role_name" name="role_name">
                                                    </div>
                                                </div>
                                                <div class="user__add--field">
                                                    <div class="user__add--label">
                                                        <label for="role_display_name">Role Display Name:</label>
                                                    </div>
                                                    <div class="user__add--input">
                                                        <input type="text" id="role_display_name"
                                                            name="role_display_name">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="user__add--btn">
                                                <input type="submit" name="add_role" value="Add Role">
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