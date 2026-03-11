<?php
/*** Template Name: Edit Collection Management */
ob_start();
get_header('archiving');
?>

<section>
    <div class="main-content">

        <?php include get_theme_file_path('partials/sidebar.php');?>
        <?php include get_theme_file_path('partials/navbar.php');?>
        <?php $post_id = $_GET["post"];?>
        <div class="main-body">
            <div class="main-body__content">
                <div class="main-body__container">
                    <div class="main-body__breadcrumb">
                        <div class="main-body__breadcrumb--list"></div>
                    </div>
                    <div class="main-body__area">
                        <div class="main-body__area--row">
                            <div class="main-body__area--form addcollection">
                                <div class="main-body__area--title">
                                    <div class="title">
                                        <h3>Edit Collection</h3>
                                        <p>
                                            Edit Collection Information
                                        </p>
                                    </div>
                                </div>
                                <div class="item-form-area">
                                    <?php
$term_id = $_GET["term"];
$term = get_term($term_id, 'collection_management');

if (isset($_POST['update_term'])) {
    $term_name = sanitize_text_field($_POST['term_name']);
    $term_description = $_POST['term_description'];
    $term_parent = $_POST['term_parent'];

    $term_update = wp_update_term($term_id, 'collection_management', array(
        'name' => $term_name,
        'description' => $term_description,
        'parent' => $term_parent
    ));

    if (is_wp_error($term_update)) {
        // Handle the error.
    } else {
        // Update successful.
        $term = get_term($term_update['term_id'], 'collection_management');
        wp_redirect(site_url('/edit-collection/?term='.$term_id));
        exit;
    }
}
ob_end_flush();
?>
                                    <div class="collection">
                                        <div class="collection__form">
                                            <form action="" method="post">
                                                <div class="collection__form--field">
                                                    <label for="term_name">Name </label>
                                                    <input type="text" id="term_name" name="term_name"
                                                        value="<?php echo $term->name; ?>">
                                                </div>
                                                <div class="collection__form--field">
                                                    <label for="term_description">Contributors </label>
                                                    <input type="text" id="term_description" name="term_description"
                                                        value="<?php echo $term->description; ?>">
                                                </div>
                                                <div class="collection__form--field">
                                                    <label for="term_description">Parent </label>
                                                    <?php
                                                    $taxonomyName = "collection_management";
                                                    $parent_terms = get_terms( $taxonomyName, array( 'parent' => 0, 'orderby' => 'slug', 'hide_empty' => false ) );
                                                    echo '<select id="term_parent" name="term_parent">';
                                                    echo '<option>-- Please select --</option>';    
                                                    foreach ( $parent_terms as $pterm ) {
                                                        if($term->parent == $pterm->term_id){
                                                            echo '<option value="'.$pterm->term_id.'" selected>' . $pterm->name . '</option>';    
                                                        } else {
                                                            echo '<option value="'.$pterm->term_id.'">' . $pterm->name . '</option>';
                                                        }
                                                        
                                                        $subs1 = get_terms( $taxonomyName, array( 'parent' => $pterm->term_id, 'orderby' => 'slug', 'hide_empty' => false ) );
                                                        foreach ( $subs1 as $term1 ) {
                                                            if($term->parent == $term1->term_id){
                                                                echo '<option value="'.$term1->term_id.'" selected>asd' . $term1->name . '</option>';    
                                                            } else {
                                                                echo '<option value="'.$term1->term_id.'">&nbsp;&nbsp; - ' . $term1->name . '</option>';
                                                            }
                                                               
                                                            $subs2 = get_terms( $taxonomyName, array( 'parent' => $term1->term_id, 'orderby' => 'slug', 'hide_empty' => false ) );
                                                            foreach ( $subs2 as $term2 ) {
                                                                if($term->parent == $term2->term_id){
                                                                    echo '<option value="'.$term2->term_id.'" selected>' . $term2->name . '</option>';    
                                                                } else {
                                                                    echo '<option value="'.$term2->term_id.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-- ' . $term2->name . '</option>--';
                                                                }
                                                            }
                                                        }
                                                    }
                                                    echo '</select>';
                                                    ?>
                                                </div>
                                                <div class="collection__form--btn">
                                                    <input type="submit" name="update_term" value="Update">
                                                </div>
                                            </form>
                                            
                                            <div class="table__header" style="margin-top: -48px; justify-content: end; padding-bottom: 0;">
                                                <div class="viewall-area">
                                                    <a href="<?php echo home_url(add_query_arg(array(), $wp->request)).'/?term='.$_GET["term"]; ?>">Reset</a>
                                                </div>
                                            </div>
                                        </div>
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