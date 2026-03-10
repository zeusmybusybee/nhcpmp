<?php
/*** Template Name: User Role */
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
                    <div class="main-body__content--header">
                        <h3>Role Management </h3>
                        <div class="watermark">
                            <img src="" alt="Notif Icon">
                        </div>
                    </div>

                    <div class="table">
                        <div class="table__header">
                            <div class="table__header--browse">
                                <div class="browse">
                                    <p>Browse Role</p>
                                    <span>More than 1000+ Browse Role</span>
                                </div>
                                <div class="button">
                                    <a href="<?php echo site_url('/add-role'); ?>">Add</a>
                                </div>
                            </div>
                        </div>

                        <div class="table__content">
                            <?php
if (isset($_POST['delete_role'])) {
    $role_name = $_POST['role_slug'];
    remove_role($role_name);
    // echo '<p>Role ' . $role_name . ' deleted successfully!</p>';
}
?>
                            <table id="table_role" class="display">
                                <thead>
                                    <tr>
                                        <th>Role Display</th>
                                        <th>Role Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
$roles = get_editable_roles();
$excluded_roles = array('author', 'contributor', 'editor', 'subscriber');
foreach ($roles as $slug => $role):
    if (in_array($slug, $excluded_roles)) {
        continue;
    }
    ?>
                                    <tr>
                                        <td>
                                            <?php echo $role['name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $slug; ?>
                                        </td>
                                        <td class="actions">
                                            <div class="table__content--body action">
                                                <a class="edit"
                                                    href="<?php echo site_url('/edit-role'); ?>?role=<?php echo $slug; ?>">Edit</a>
                                                <form method="post">
                                                    <input type="hidden" name="role_slug" value="<?php echo $slug; ?>">
                                                    <input type="submit" name="delete_role" value="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this role?');">
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php include get_theme_file_path('partials/footer.php');?>
            </div>
        </div>
    </div>
</section>





<?php get_footer('archiving');?>