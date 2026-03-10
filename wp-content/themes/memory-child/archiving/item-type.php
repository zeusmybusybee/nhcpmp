<?php

/*** Template Name: Item Type Management */
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
                        <h3>Item Type Management </h3>
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
                                    <a href="<?php echo site_url('/add-item-type'); ?>">Add</a>
                                </div>
                            </div>

                        </div>
                        <div class="table__content">
                            <?php
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            $arg_item_type = array(
                                'post_type' => 'item_type',
                                'post_status' => 'publish',
                                'posts_per_page' => -1,
                                'paged' => $paged,
                            );
                            $item_type_query = new WP_Query($arg_item_type);
                            ?>
                            <table id="table_item_type" class="display">
                                <thead>
                                    <tr>
                                        <th>Type Name</th>
                                        <th> Description</th>
                                        <th>Total Items</th>
                                        <th> Action</th>
                                    </tr>
                                </thead>
                                <?php if ($item_type_query->have_posts()) { ?>

                                    <tbody>
                                        <?php while ($item_type_query->have_posts()) {
                                            $item_type_query->the_post(); ?>
                                            <tr>
                                                <td> <?php the_title(); ?></td>
                                                <td> <?php echo wp_trim_words(get_the_content(), 12, '...'); ?></td>
                                                <td> <?php
                                                        $item_type_title = get_the_title();
                                                        $arg_item = array(
                                                            'post_type' => 'item',
                                                            'meta_query' => array(
                                                                'relation' => 'AND',
                                                                array(
                                                                    'key' => 'type',
                                                                    'value' => $item_type_title,
                                                                    'compare' => 'LIKE',
                                                                ),
                                                            ),
                                                        );
                                                        $arr_posts_item = new WP_Query($arg_item);
                                                        $count_item_type = $arr_posts_item->found_posts;
                                                        echo $count_item_type;
                                                        ?>
                                                </td>
                                                <td class="actions">
                                                    <div class="table__content--body action">
                                                        <a href="<?php the_permalink(); ?>" target="_new" class="preview"><i class="fa-solid fa-magnifying-glass"></i> Preview</a>
                                                        <a href="<?php echo get_delete_post_link(); ?>" class="delete" onclick="return confirm('Are you sure you wanna delete this?')">Delete</a>
                                                        <a href="<?php echo site_url('/edit-item-type'); ?>?post=<?php the_ID(); ?>" target="_new" class="edit">Edit</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php

                                        }
                                        ?>
                                    </tbody>

                                <?php

                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                <?php include get_theme_file_path('partials/footer.php'); ?>
            </div>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // $('#table_item_type').DataTable();
        $('#table_item_type').dataTable({
            language: {
                searchPlaceholder: "Search Item Type",
                search: "",
                "paginate": {
                    "previous": "<",
                    "next": ">",
                }

            }
        });
    });
</script>


<?php get_footer('archiving'); ?>