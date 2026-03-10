<?php
/*** Template Name: Indexing */
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
                        <h3>Indexing </h3>
                        <div class="watermark library">
                            <img src="<?php echo THEME_DIR; ?>/assets/img/indexing.png" alt="Indexing Icon">
                        </div>
                    </div>

                    <div class="tab">
                        <div class="tab__btn">
                            <button class="tablinks active" onclick="openTab(event, 'Analytic')">
                                Analytic
                            </button>
                            <button class="tablinks" onclick="openTab(event, 'Periodical')">
                                Periodical
                            </button>
                            <button class="tablinks" onclick="openTab(event, 'Vertical-Files')">
                                Vertical Files
                            </button>
                            <button class="tablinks" onclick="openTab(event, 'Cases')">
                                Cases
                            </button>

                        </div>
                        <div id="Analytic" class="tabcontent" style="display:block">
                            <?php include_once 'indexing/indexing-analytic.php';?>
                        </div>
                        <div id="Periodical" class="tabcontent" style="display:none">
                            <?php include_once 'indexing/indexing-periodical.php';?>
                        </div>
                        <div id="Vertical-Files" class="tabcontent" style="display:none">
                            <?php include_once 'indexing/indexing-vertical-files.php';?>
                        </div>
                        <div id="Cases" class="tabcontent" style="display:none">
                            <?php include_once 'indexing/indexing-cases.php';?>
                        </div>
                    </div>
                </div>
                <?php include get_theme_file_path("partials/footer.php");?>
            </div>
        </div>
    </div>
</section>






<?php get_footer();?>