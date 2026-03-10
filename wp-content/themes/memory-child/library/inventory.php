<?php
/*** Template Name: Inventory */
acf_form_head();
get_header();
?>

<section>
    <div class="main-content">
        <?php include get_theme_file_path('partials/sidebar.php');?>
        <?php include get_theme_file_path('partials/navbar.php');?>
        <div class="main-body">
            <div class="main-body__content">
                <div class="main-body__container">
                    <div class="main-body__content--header">
                        <h3>Inventory </h3>
                        <div class="watermark library">
                            <!--<img src="<?php //echo THEME_DIR; ?>/assets/img/rare-materials.png" alt="Rare Materials Icon"> -->
                        </div>
                    </div>

                    <div class="tab">
                        <div class="tab__btn">
                            <button class="tablinks active" onclick="openTab(event, 'Inventory')">
                                Inventory
                            </button>
                        </div>
                        
                        <div id="Inventory" class="tabcontent" style="display:block">
                            <?php include_once 'inventory/inventory-list.php';?>
                        </div>
                        
                    </div>
                </div>
                <?php include get_theme_file_path("partials/footer.php");?>
            </div>
        </div>
    </div>
</section>


<?php get_footer();?>