<?php
/*** Template Name: Rare Material */
acf_form_head();
get_header('archiving');
?>

<section>
    <div class="main-content">
        <?php include get_theme_file_path('partials/sidebar-library.php');?>
        <?php include get_theme_file_path('partials/navbar-library.php');?>
        <div class="main-body">
            <div class="main-body__content">
                <div class="main-body__container">
                    <div class="main-body__content--header">
                        <h3>Rare Materials </h3>
                        <div class="watermark library">
                            <!-- <img src="<?php //echo THEME_DIR; ?>/assets/img/rare-materials.png" alt="Rare Materials Icon"> -->
                        </div>
                    </div>

                    <div class="tab">
                        <div class="tab__btn">
                            <button class="tablinks active" onclick="openTab(event, 'Archives')">
                                Archives
                            </button>
                            <button class="tablinks" onclick="openTab(event, 'Museum')">
                                Museum
                            </button>
                            <!--<button class="tablinks" onclick="openTab(event, 'Patron')">-->
                            <!--    Patron-->
                            <!--</button>-->
                            <button class="tablinks" onclick="openTab(event, 'Uploads')">
                                Uploads
                            </button>

                        </div>
                        <div id="Archives" class="tabcontent" style="display:block">
                            <?php include_once 'rare-materials/rare-materials-archives.php';?>
                        </div>
                        <div id="Museum" class="tabcontent" style="display:none">
                            <?php include_once 'rare-materials/rare-materials-museum.php';?>
                        </div>
                        <!--<div id="Patron" class="tabcontent" style="display:none">-->
                            <?php 
                            // include_once 'rare-materials/rare-materials-patron.php';
                            ?>
                        <!--</div>-->
                        <div id="Uploads" class="tabcontent" style="display:none">
                            <?php include_once 'rare-materials/rare-materials-uploads.php';?>
                        </div>
                    </div>
                </div>
                <?php include get_theme_file_path("partials/footer.php");?>
            </div>
        </div>
    </div>
</section>


<?php get_footer('archiving');?>