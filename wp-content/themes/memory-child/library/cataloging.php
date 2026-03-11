<?php
/*** Template Name: Cataloging */
get_header('archiving');
?>

<section>
    <div class="main-content">
        <?php include get_theme_file_path('partials/sidebar-library.php'); ?>
        <?php include get_theme_file_path('partials/navbar-library.php'); ?>
        <div class="main-body">
            <div class="main-body__content">
                <div class="main-body__container">
                    <div class="main-body__content--header">
                        <h3>Cataloging </h3>
                        <div class="watermark library">

                        </div>
                    </div>

                    <div class="tab">
                        <div class="tab__btn">
                            <button class="tablinks active" onclick="openTab(event, 'Audio-Visuals')">
                                Audio-Visuals
                            </button>
                            <button class="tablinks" onclick="openTab(event, 'Books-and-Manuscripts')">
                                Books and Manuscripts
                            </button>
                            <button class="tablinks" onclick="openTab(event, 'Academic-Courseworks')">
                                Academic Courseworks
                            </button>
                            <button class="tablinks" onclick="openTab(event, 'Audio-Recordings')">
                                Audio Recordings
                            </button>
                            <button class="tablinks" onclick="openTab(event, 'E-Resources')">
                                E-Resources
                            </button>
                            <button class="tablinks" onclick="openTab(event, 'Serial-cataloging')">
                                Serial Cataloging
                            </button>
                            <button class="tablinks" onclick="openTab(event, 'Video-Recordings')">
                                Video Recordings
                            </button>
                            <button class="tablinks" onclick="openTab(event, 'Web-Sites')">
                                Web Sites
                            </button>
                        </div>
                        <div id="Audio-Visuals" class="tabcontent" style="display:block">
                            <?php include_once 'cataloging/cataloging-audio-visuals.php'; ?>
                        </div>
                        <div id="Books-and-Manuscripts" class="tabcontent" style="display:none">
                            <?php include_once 'cataloging/cataloging-books-and-manuscripts.php'; ?>
                        </div>
                        <div id="Academic-Courseworks" class="tabcontent" style="display:none">
                            <?php include_once 'cataloging/cataloging-academic-courseworks.php'; ?>
                        </div>
                        <div id="Audio-Recordings" class="tabcontent" style="display:none">
                            <?php include_once 'cataloging/cataloging-audio-recordings.php'; ?>
                        </div>
                        <div id="E-Resources" class="tabcontent" style="display:none">
                            <?php include_once 'cataloging/cataloging-e-resources.php'; ?>
                        </div>

                        <div id="Serial-cataloging" class="tabcontent" style="display:none">
                            <?php include_once 'cataloging/cataloging-serial.php'; ?>
                        </div>
                        <div id="Video-Recordings" class="tabcontent" style="display:none">
                            <?php include_once 'cataloging/cataloging-video-recordings.php'; ?>
                        </div>
                        <div id="Web-Sites" class="tabcontent" style="display:none">
                            <?php include_once 'cataloging/cataloging-website.php'; ?>
                        </div>
                    </div>
                </div>
                <?php include get_theme_file_path("partials/footer.php"); ?>
            </div>
        </div>
    </div>

</section>


<?php get_footer('archiving'); ?>