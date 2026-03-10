<?php

/*** Template Name: User */
get_header('archiving');
?>

<?php
require_once ABSPATH . 'wp-admin/includes/user.php';
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);
    if (!current_user_can('delete_users')) {
        wp_die('You do not have sufficient permissions to delete users.');
    }
    wp_delete_user($user_id);
}

$users = get_users();
?>

<section>
    <div class="main-content">
        <?php include get_theme_file_path('partials/sidebar.php'); ?>
        <?php include get_theme_file_path('partials/navbar.php'); ?>
        <div class="main-body">
            <div class="main-body__content">
                <div class="main-body__container">
                    <div class="main-body__content--header">
                        <h3>User Management </h3>
                        <div class="watermark">
                            <img src="" alt="Notif Icon">
                        </div>
                    </div>

                    <div class="table">
                        <div class="table__header">
                            <div class="table__header--browse">
                                <div class="browse">
                                    <p>Browse Users</p>
                                    <span>More than 1000+ Browse Users</span>
                                </div>
                                <div class="button">
                                    <a href="<?php echo site_url('/add-user'); ?>">Add</a>
                                </div>
                            </div>
                        </div>

                        <div class="table__content">
                            <table id="table_user" class="display">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user) { ?>

                                        <tr>
                                            <td>
                                                <?php echo esc_html($user->first_name); ?>
                                                <?php echo esc_html($user->last_name); ?>
                                            </td>
                                            <td>
                                                <?php echo esc_html($user->nickname); ?>

                                            </td>
                                            <td> <?php echo esc_html($user->user_email); ?></td>
                                            <td> </td>
                                            <td class="actions">
                                                <div class="table__content--body action">
                                                    <a href="<?php echo site_url('/user-profile'); ?>?user_id=<?php echo $user_id = $user->ID; ?>"
                                                        class="preview">Preview</a>
                                                    <a class="delete"
                                                        href="<?php echo add_query_arg(array('action' => 'delete', 'user_id' => $user->ID), get_permalink()); ?>"
                                                        onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                                                    <!-- <a class="edit"
                                                    href="<?php echo add_query_arg(array('action' => 'edit', 'user_id' => $user->ID), get_permalink()); ?>">Edit</a> -->
                                                    <a class="edit"
                                                        href="<?php echo site_url('/edit-user'); ?>?user_id=<?php echo $user_id = $user->ID; ?>">Edit</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
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