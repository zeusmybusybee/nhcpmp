<?php
/*** Template Name: Edit User */
// acf_form_head();
ob_start();
get_header('archiving');
if (!function_exists('get_editable_roles')) {
    require_once ABSPATH . 'wp-admin/includes/user.php';
}
?>

<section>
    <div class="main-content">

        <?php include get_theme_file_path('partials/sidebar.php');?>
        <?php include get_theme_file_path('partials/navbar.php');?>
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
                                        <h3>Edit User</h3>
                                    </div>
                                </div>
                                <div class="user">

                                    <?php

if (!isset($_GET['user_id'])) {
    wp_die('User ID not provided.');
}
$user_id = intval($_GET['user_id']);
$user = get_userdata($user_id);

if (!$user) {
    wp_die('User not found.');
}

if (isset($_POST['submit']) && isset($_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'], 'edit_user_' . $user_id)) {
    if (!current_user_can('edit_users')) {
        wp_die('You do not have sufficient permissions to edit users.');
    }

    $userdata = array(
        'ID' => $user_id,
        'user_email' => sanitize_email($_POST['email']),
        'first_name' => sanitize_text_field($_POST['first_name']),
        'last_name' => sanitize_text_field($_POST['last_name']),
        'nickname' => sanitize_text_field($_POST['nickname']),
        'role' => sanitize_text_field($_POST['user_role']),
        'username' => sanitize_text_field($_POST['username']),
    );

    $user_id = wp_update_user($userdata);

    if (is_wp_error($user_id)) {
        wp_die('Error updating user.');
    }

    wp_redirect(add_query_arg(array('user_id' => $user_id, 'updated' => true), get_permalink()));

    ob_end_flush();
    exit;
}

if (isset($_GET['updated'])) {
    echo '<p class="successful">User updated successfully.</p>';
}
?>

                                    <div class="user__add">
                                        <form method="post">
                                            <?php wp_nonce_field('edit_user_' . $user_id);?>
                                            <div class="user__add--row">
                                                <div class="user__add--field">
                                                    <div class="user__add--label">
                                                        <label for="first_name">First Name:</label>
                                                    </div>
                                                    <div class="user__add--input">
                                                        <input type="text" id="first_name" name="first_name"
                                                            value="<?php echo esc_attr($user->first_name); ?>">
                                                    </div>
                                                </div>
                                                <div class="user__add--field">
                                                    <div class="user__add--label">
                                                        <label for="last_name">Last Name:</label>
                                                    </div>
                                                    <div class="user__add--input">
                                                        <input type="text" id="last_name" name="last_name"
                                                            value="<?php echo esc_attr($user->last_name); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="user__add--row">
                                                <div class="user__add--field">
                                                    <div class="user__add--label">
                                                        <label for="username">Nickname:</label>
                                                    </div>
                                                    <div class="user__add--input">
                                                        <input type="text" id="nickname" name="nickname"
                                                            value="<?php echo esc_attr($user->nickname); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="user__add--row">
                                                <div class="user__add--field">
                                                    <div class="user__add--label">
                                                        <label for="user_role">Role:</label>
                                                    </div>
                                                    <div class="user__add--input">
                                                        <select name="user_role" id="user_role">
                                                            <option value="<?php echo implode(', ', $user->roles); ?>">
                                                                <?php echo implode(', ', $user->roles); ?></option>
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
                                                            <?php endforeach;?>
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="user__add--field">
                                                <div class="user__add--label">
                                                    <label for="email">Email:</label>
                                                </div>
                                                <div class="user__add--input">
                                                    <input type="email" id="email" name="email"
                                                        value="<?php echo esc_attr($user->user_email); ?>">
                                                </div>
                                            </div>

                                            <div class="user__add--btn">
                                                <input type="submit" name="submit" value="Update">
                                            </div>
                                        </form>
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

<?php get_footer('archiving');?>