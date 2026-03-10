<?php
/*** Template Name: Single-Audio-Visual-Cataloging */
get_header();
?>

<section>
    <div class="main-content">
        <?php include get_theme_file_path('partials/sidebar.php');?>
        <?php include get_theme_file_path('partials/navbar.php');?>
        <div class="main-body">
            <div class="main-body__content">
                <div class="main-body__container">
                    <div class="main-body__breadcrumb">
                        <div class="main-body__breadcrumb--list"><?php get_breadcrumb();?></div>
                    </div>
                    <div class="main-body__area">
                        <div class="single-audio">
                            <div class="single-audio__row">
                                <div class="single-audio__img">
                                    <img src="<?php echo THEME_DIR; ?>/assets/img/img_single_catalogin.png" alt="">
                                </div>
                                <div class="single-audio__information">
                                    <div class="single-audio__information--category">
                                        AUDIO-VISUAL and SPECIAL MATERIAL DATA DISPLAY
                                    </div>
                                    <div class="single-audio__information--row">
                                        <div class="single-audio__information--label">
                                            Call number
                                        </div>
                                        <div class="single-audio__information--info">
                                            CD 314
                                        </div>
                                    </div>
                                    <div class="single-audio__information--row">
                                        <div class="single-audio__information--label">
                                            Title Details
                                        </div>
                                        <div class="single-audio__information--info">
                                            America is in the heart
                                        </div>
                                    </div>
                                    <div class="single-audio__information--row">
                                        <div class="single-audio__information--label">
                                            Descriptions
                                        </div>
                                        <div class="single-audio__information--info">
                                            [Place of publication not identified] : [publisher not identified], [date of
                                            publication not identified]
                                        </div>
                                    </div>
                                    <div class="single-audio__information--row">
                                        <div class="single-audio__information--label">
                                            No. of times borrowed
                                        </div>
                                        <div class="single-audio__information--info">
                                            0
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include get_theme_file_path("partials/footer.php");?>
            </div>
        </div>
    </div>
</section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>




<?php get_footer();?>