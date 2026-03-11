<?php
/*** Template Name: Reports */
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
                        <h3>Reports </h3>
                        <div class="watermark library">
                            <!-- <img src="<?php //echo THEME_DIR; ?>/assets/img/rare-materials.png" alt="Rare Materials Icon"> -->
                        </div>
                    </div>

                    <div class="tab">
                        <div class="tab__btn">
               
                            <button class="tablinks active" onclick="openTab(event, 'bibliography-generation')">
                                Bibiliography Generation
                            </button>
                            <button class="tablinks" id='autoTriggerModal'  onclick="openTab(event, 'collection-development')">
                                Collection Development
                            </button>
                            <button class="tablinks" onclick="openTab(event, 'resources-status')">
                                Resources Status
                            </button>
                             <button class="tablinks" onclick="openTab(event, 'list-of-overdues')">
                                List of Overdues
                            </button>
                             <button class="tablinks" onclick="openTab(event, 'payment-list')">
                                Payment List
                            </button>
                              <button class="tablinks" onclick="openTab(event, 'patron-master-list')">
                                Patron Master List
                            </button>
                             <button class="tablinks" onclick="openTab(event, 'Serial')">
                                Serial
                            </button>


                        </div>
                   
                        <div id="bibliography-generation" class="tabcontent" style="display:block">
                            <?php include_once 'reports/reports-bibliography-generation.php';?>
                        </div>
                        <div id="collection-development" class="tabcontent" style="display:none">
                            <?php include_once 'reports/reports-collection-development-data-generation.php';?>
                        </div>
                        <div id="resources-status" class="tabcontent" style="display:none">
                            <?php include_once 'reports/reports-resources-status.php';?>
                        </div>
                         <div id="list-of-overdues" class="tabcontent" style="display:none">
                            <?php include_once 'reports/reports-list-of-overdues.php';?>
                        </div>
                          <div id="payment-list" class="tabcontent" style="display:none">
                            <?php include_once 'reports/reports-payment-list.php';?>
                        </div>
                        <div id="patron-master-list" class="tabcontent" style="display:none">
                            <?php include_once 'reports/reports-patron-master-list.php';?>
                        </div>
                         <div id="Serial" class="tabcontent" style="display:none">
                            <?php include_once 'reports/reports-serial-list.php';?>
                        </div>
                    </div>
                </div>
                <?php include get_theme_file_path("partials/footer.php");?>
            </div>
        </div>
    </div>
</section>

<?php get_footer('archiving'); ?>;