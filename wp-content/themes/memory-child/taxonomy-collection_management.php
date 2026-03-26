<?php
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
                            <div class="main-body__area--full">
                                <div class="main-body__area--title">
                                    <?php
                                    // $taxonomy_object = get_queried_object();
                                    // $taxonomy = $taxonomy_object->taxonomy;
                                    $term = get_queried_object(); ?>
                                    <h3>
                                        <a href="<?php echo site_url('collections/?ptermid=' . $term->term_id); ?>" target="_new">
                                            <?php
                                            $term_namess = $term->name;
                                            echo $term->name;
                                            ?>
                                        </a>
                                    </h3>
                                </div>

                                <div class="singles-collection">
                                    <div class="singles-collection__header">
                                        <p><span>Contributors : </span> <?php echo $term->description; ?> </p>
                                    </div>
                                </div>
                                <div class="singles-collection__subs">

                                    <?php

                                    $term_id = $term->term_id;

                                    // Display the subcategories in a hierarchical view
                                    function display_subcategories($parent_id)
                                    {
                                        $args = array(
                                            'taxonomy' => 'collection_management',
                                            'parent' => $parent_id,
                                            'hide_empty' => false,
                                        );
                                        $subcategories = get_terms($args);

                                    ?>

                                        <?php
                                        if (!empty($subcategories)) { ?>


                                            <ul>
                                                <?php foreach ($subcategories as $subcategory) { ?>
                                                    <li>
                                                        <div class="list">
                                                            <p> <?php echo $subcategory->name; ?></p>
                                                            <div class="action-btn">
                                                                <a href="<?php echo site_url('/edit-collection'); ?>?term=<?php echo $subcategory->term_id; ?>"
                                                                    class="edit">Edit</a>
                                                                <form action="" method="post">
                                                                    <input type="hidden" name="term_id"
                                                                        value="<?php echo $subcategory->term_id; ?>">
                                                                    <input class="delete" type="submit" name="delete_term"
                                                                        value="Delete"
                                                                        onclick="return confirm('Are you sure you wanna delete this?')">
                                                                </form>
                                                            </div>


                                                            <?php

                                                            if (isset($_POST['delete_term'])) {
                                                                $subcat_id = intval($_POST['term_id']);
                                                                $termdelete = wp_delete_term($subcat_id, 'collection_management');
                                                                if (!is_wp_error($termdelete)) {
                                                                    // Redirect to desired page
                                                                    wp_redirect(site_url('/collection/'));
                                                                    exit;
                                                                }
                                                            }
                                                            ?>
                                                            <?php display_subcategories($subcategory->term_id); ?>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            </ul>

                                        <?php } ?>
                                    <?php
                                    }
                                    display_subcategories($term_id);

                                    ?>

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
<script>
    $(document).ready(function() {
        $(".edit").click(function() {
            console.log("Tap Open");
            $(this).parent().next(".popup").addClass("open");
        });
        $(".close").click(function(e) {
            e.preventDefault();
            console.log("Tap Close");
            $(".popup").removeClass("open");
        });
    });
</script>
<?php get_footer('archiving'); ?>