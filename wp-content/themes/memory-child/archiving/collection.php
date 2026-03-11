<?php

/*** Template Name: Collection Management */

ob_start();

/* DELETE TERM */
if (isset($_POST['delete_term'])) {

    $term_id = intval($_POST['term_id']);
    $delete = wp_delete_term($term_id, 'collection_management');

    if (!is_wp_error($delete)) {
        wp_redirect(site_url('/collection/'));
        exit;
    }
}

get_header('archiving');
?>

<section>
    <div class="main-content">

        <?php include get_theme_file_path('partials/sidebar.php'); ?>
        <?php include get_theme_file_path('partials/navbar.php'); ?>

        <div class="main-body">
            <div class="main-body__content">
                <div class="main-body__container">

                    <div class="main-body__content--header">
                        <h3>Collection Management</h3>

                        <div class="watermark">
                            <img src="" alt="Notif Icon">
                        </div>
                    </div>


                    <div class="table">

                        <div class="table__header">

                            <div class="table__header--browse">

                                <div class="browse">
                                    <p>Browse Items</p>
                                    <span>More than 1000+ Browse Items</span>
                                </div>

                                <div class="button">
                                    <a href="<?php echo site_url('/add-collection'); ?>">Add</a>
                                </div>

                            </div>

                        </div>


                        <div class="table__content">

                            <?php
                            $args = array(
                                'taxonomy' => 'collection_management',
                                'parent' => 0,
                                'hide_empty' => false,
                            );

                            $parent_categories = get_terms($args);
                            ?>

                            <table id="table_collection" class="display">

                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Contributors</th>
                                        <th>Total Number of Items</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php if (!is_wp_error($parent_categories) && !empty($parent_categories)) : ?>

                                        <?php foreach ($parent_categories as $parent_category) : ?>

                                            <tr>

                                                <td>
                                                    <?php echo esc_html($parent_category->name); ?>
                                                </td>

                                                <td>
                                                    <?php echo esc_html($parent_category->description); ?>
                                                </td>

                                                <td>
                                                    <?php echo esc_html($parent_category->count); ?>
                                                </td>

                                                <td class="actions">

                                                    <div class="table__content--body action">

                                                        <a href="<?php echo esc_url(get_term_link($parent_category)); ?>" target="_blank" class="preview">
                                                            Preview
                                                        </a>

                                                        <form action="" method="post" style="display:inline;">
                                                            <input type="hidden" name="term_id" value="<?php echo esc_attr($parent_category->term_id); ?>">

                                                            <input
                                                                class="delete"
                                                                type="submit"
                                                                name="delete_term"
                                                                value="Delete"
                                                                onclick="return confirm('Are you sure you wanna delete this?')">
                                                        </form>

                                                        <a href="<?php echo site_url('/edit-collection'); ?>?term=<?php echo esc_attr($parent_category->term_id); ?>" class="edit">
                                                            Edit
                                                        </a>

                                                    </div>

                                                </td>

                                            </tr>

                                        <?php endforeach; ?>

                                    <?php else : ?>

                                        <tr>
                                            <td>No collections found.</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                    <?php endif; ?>

                                </tbody>

                            </table>

                        </div>


                    </div>


                </div>

                <?php include get_theme_file_path('partials/footer.php'); ?>

            </div>
        </div>
    </div>

    </div>
</section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

<script>
    $(document).ready(function() {

        $('#table_collection').DataTable({

            language: {
                searchPlaceholder: "Search Collection",
                search: "",
                paginate: {
                    previous: "<",
                    next: ">"
                }
            }

        });

    });
</script>

<?php
ob_end_flush();
get_footer('archiving');
?>