<?php

/*** Template Name: Add User */
acf_form_head();
get_header('archiving');
if (!function_exists('get_editable_roles')) {
    require_once ABSPATH . 'wp-admin/includes/user.php';
}
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
                                        <h3>Add New User</h3>
                                    </div>
                                </div>
                                <div class="user">
                                    <?php
                                    if (isset($_POST['submit'])) {
                                        // Sanitize user inputs
                                        $username = sanitize_text_field($_POST['username']);
                                        $email = sanitize_email($_POST['email']);
                                        $password = sanitize_text_field($_POST['password']);
                                        $first_name = sanitize_text_field($_POST['first_name']);
                                        $user_role = sanitize_text_field($_POST['user_role']);
                                        $last_name = sanitize_text_field($_POST['last_name']);
                                        $nickname = sanitize_text_field($_POST['nickname']);

                                        // Prepare user data
                                        $userdata = array(
                                            'user_login' => $username,
                                            'user_email' => $email,
                                            'user_pass' => $password,
                                            'first_name' => $first_name,
                                            'last_name' => $last_name,
                                            'nickname' => $nickname,
                                            'role' => $user_role,
                                        );

                                        // Insert new user
                                        $user_id = wp_insert_user($userdata);

                                        if (is_wp_error($user_id)) {
                                            echo '<p class="error">Error: ' . $user_id->get_error_message() . '</p>';
                                        } else {
                                            // Send password to user email
                                            $subject = 'Your username and password for ' . get_bloginfo('name');
                                            $message = 'Username: ' . $username . "\n\n";
                                            $message .= 'Password: ' . $password . "\n\n";
                                            $message .= 'You can log in at ' . wp_login_url() . "\n\n";
                                            $headers = array('Content-Type: text/plain');

                                            wp_mail($email, $subject, $message, $headers);

                                            echo '<p class="successful">User created successfully.</p>';
                                        }
                                    }
                                    ?>
                                    <div class="user__add">
                                        <form action="" method="post">
                                            <div class="user__add--row">
                                                <div class="user__add--field">
                                                    <div class="user__add--label">
                                                        <label for="first_name">First Name:</label>
                                                    </div>
                                                    <div class="user__add--input">
                                                        <input type="text" name="first_name" id="first_name">
                                                    </div>
                                                </div>
                                                <div class="user__add--field">
                                                    <div class="user__add--label">
                                                        <label for="last_name">Last Name:</label>
                                                    </div>
                                                    <div class="user__add--input">
                                                        <input type="text" name="last_name" id="last_name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="user__add--row">
                                                <div class="user__add--field">
                                                    <div class="user__add--label">
                                                        <label for="username">Username:</label>
                                                    </div>
                                                    <div class="user__add--input">
                                                        <input type="text" name="username" id="username" required>
                                                    </div>
                                                </div>
                                                <div class="user__add--field">
                                                    <div class="user__add--label">
                                                        <label for="username">Nickname:</label>
                                                    </div>
                                                    <div class="user__add--input">
                                                        <input type="text" name="nickname" id="nickname" required>
                                                    </div>
                                                </div>
                                                <div class="user__add--field">
                                                    <div class="user__add--label">
                                                        <label for="user_role">Role:</label>
                                                    </div>
                                                    <div class="user__add--input">
                                                        <select name="user_role" id="user_role">
                                                            <?php
                                                            $roles = get_editable_roles();
                                                            $excluded_roles = array('author', 'contributor', 'editor', 'subscriber');
                                                            foreach ($roles as $slug => $role):
                                                                if (in_array($slug, $excluded_roles)) {
                                                                    continue;
                                                                }
                                                            ?>
                                                                <option value="<?php echo $slug; ?>">
                                                                    <?php echo $role['name']; ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="user__add--field">
                                                <div class="user__add--label">
                                                    <label for="email">Email:</label>
                                                </div>
                                                <div class="user__add--input">
                                                    <input type="email" name="email" id="email" required>
                                                </div>
                                            </div>
                                            <div class="user__add--field">
                                                <div class="user__add--label">
                                                    <label for="password">Password:</label>
                                                </div>
                                                <div class="user__add--input">
                                                    <input type="password" name="password" id="password" required>
                                                </div>
                                            </div>
                                            <div class="user__add--btn">
                                                <input type="submit" name="submit" value="Submit">
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