<?php
/*** Template Name: Settings Page */
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
                        <h3>Settings </h3>
                        <div class="watermark library">
                          <!--  <img src="<?php // echo THEME_DIR; ?>/assets/img/rare-materials.png" alt="Rare Materials Icon"> -->
                        </div>
                    </div>

                    <div class="tab">
                        <div class="tab__btn">
                            <button class="tablinks active" onclick="openTab(event, 'group-setting')">
                                Group/Policy Settings
                            </button>
                            <button class="tablinks" onclick="openTab(event, 'patron')">
                                Patron
                            </button>
                      
                           

                        </div>
                        <div id="group-setting" class="tabcontent" style="display:block">
                            <?php include_once 'settings/settings-group-policy.php';?>
                        </div>
                        <div id="patron" class="tabcontent" style="display:none">
                            <?php include_once 'rare-materials/rare-materials-patron.php';?>
                        </div>
                    
                      
                    </div>
                </div>
                <?php include get_theme_file_path("partials/footer.php");?>
            </div>
        </div>
    </div>
</section>


<?php get_footer('archiving');?>