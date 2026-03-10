<?php
/*** Template Name: Collection Management */
ob_start();
get_header('archiving');
?>

<section>
    <div class="main-content">
        <?php include get_theme_file_path('partials/sidebar.php');?>
        <?php include get_theme_file_path('partials/navbar.php');?>
        <div class="main-body">
            <div class="main-body__content">
                <div class="main-body__container">
                    <div class="main-body__content--header">
                        <h3>Collection Management </h3>
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
                            $parent_categories = get_terms($args);?>
                            <table id="table_collection" class="display">
                                <thead>
                                    <tr>
                                        <th> Title</th>
                                        <th> Contributors</th>
                                        <th> Total Number of Items</th>
                                        <th> Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php foreach ($parent_categories as $parent_category) {?>
                                    <tr>
                                        <td> <?php echo $parent_category->name; ?></td>
                                        <td>
                                            <?php echo $parent_category->description; ?>
                                        </td>
                                        <td>
                                            <?php echo $parent_category->count; ?>
                                        </td>
                                        <td class="actions">
                                            <div class="table__content--body action">
                                                <a href="<?php echo get_term_link($parent_category); ?>" target="_new" class="preview">Preview</a>
                                                <form action="" method="post">
                                                    <input type="hidden" name="term_id" value="<?php echo $parent_category->term_id; ?>">
                                                    <input class="delete" type="submit" name="delete_term" value="Delete" onclick="return confirm('Are you sure you wanna delete this?')">
                                                </form>
                                                <a href="<?php echo site_url('/edit-collection'); ?>?term=<?php echo $parent_category->term_id; ?>" target="_new" class="edit">Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
}
?>
                                </tbody>

                            </table>
                            <?php

if (isset($_POST['delete_term'])) {
    $term_id = intval($_POST['term_id']);
    $termdelete = wp_delete_term($term_id, 'collection_management');
    if (!is_wp_error($termdelete)) {
        // Redirect to desired page
        wp_redirect(site_url('/collection/'));
        exit;
    }
}
ob_end_flush();
?>

                            <!-- <?php
$args = array(
    'taxonomy' => 'collection_management',
    'parent' => 0,
    'hide_empty' => false,
);
$parent_categories = get_terms($args);

foreach ($parent_categories as $parent_category) {
    echo '<div class="category-item">';
    echo '<a href="' . get_term_link($parent_category) . '">' . $parent_category->name . '</a>';
    echo '<a href="' . get_edit_term_link($parent_category->term_id, 'collection_management') . '">Edit</a>';
    echo '<form action="" method="post">';
    echo '<input type="hidden" name="term_id" value="' . $parent_category->term_id . '">';
    echo '<input type="submit" name="delete_term" value="Delete">';
    echo '</form>';
    echo '</div>';
}

if (isset($_POST['delete_term'])) {
    $term_id = intval($_POST['term_id']);
    wp_delete_term($term_id, 'collection_management');
}
?> -->

                        </div>


                    </div>
                </div>
                <?php include get_theme_file_path('partials/footer.php');?>
            </div>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script type='text/javascript'>
$(document).ready(function() {
    // $('#table_item_type').DataTable();
    $('#table_collection').dataTable({
        language: {
            searchPlaceholder: "Search Collection",
            search: "",
            "paginate": {
                "previous": "<",
                "next": ">",
            }
        },
        paginate: {
            next: '<img src="/lib/dataTables/images/sort_both.png"/>',

        }
    });
});
</script>
<?php get_footer('archiving');?>