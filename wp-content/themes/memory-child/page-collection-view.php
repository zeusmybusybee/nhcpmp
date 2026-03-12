<?php
/*** Template Name: Collection View */
get_header();
?>

<?php
$term_id = urldecode($_GET['term'] ?? '');
$post_id = urldecode($_GET['id'] ?? '');
?>

<style>
    .dwnld-btn a {
        display: flex;
        align-items: center;
        justify-content: center;
        max-width: 200px;
        width: 100%;
        height: 50px;
        font-size: 16px;
        background-color: #3ec562;
        color: #ffffff;
        border: none;
        border-radius: 10px;
        transition: 0.3s ease-in;
        margin: 20px auto;
    }

    .fake_close_btn {
        text-align: center;
    }

    .collection-view__grid {
        display: block;
        width: 90%;
        margin: 0 auto;
    }

    .collection-view {
        max-width: 800px;
        margin: 2rem auto;
        font-family: Arial, sans-serif;
    }

    .collection-view__banner {
        text-align: center;
        margin-bottom: 2rem;
    }

    .collection-view__banner--title {
        font-size: 1.8rem;
        color: #704b10;
    }

    .collection-view__row {
        border: 1px solid #ccc;
        padding: 1rem;
        border-radius: 6px;
        background: #fff;
    }

    .collection-view__img img {
        width: 100%;
        height: auto;
        object-fit: cover;
        border-radius: 4px;
    }

    .collection-view__info {
        flex: 1;
    }

    .collection-view__info--row {
        display: flex;
        padding: 6px 0;
        border-bottom: 1px dotted #ccc;
    }

    .collection-view__info--label {
        width: 150px;
        font-weight: 600;
        color: #444;
    }

    .collection-view__info--desc {
        flex: 1;
        color: #222;
    }

    .collection-view__info a {
        color: #0d6efd;
        text-decoration: none;
    }

    .collection-view__info a:hover {
        text-decoration: underline;
    }

    @media screen and (max-width: 900px) {
        .collection-view__grid {
            width: 70%;
        }
    }

    @media screen and (max-width: 768px) {
        .collection-view__grid {
            width: 85%;
        }
    }
</style>


<section>
    <div class="collection-view">

        <div class="collection-view__banner">
            <div class="collection-view__banner--title">
                <h1>
                    <?php
                    $term = get_term($term_id);
                    if ($term && !is_wp_error($term)) {
                        echo esc_html($term->name);
                    }
                    ?>
                </h1>
            </div>
        </div>

        <div class="collection-view__container">

            <?php
            $args = array(
                'post_type' => 'item',
                'p'         => $post_id,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'collection_management',
                        'field'    => 'term_id',
                        'terms'    => $term_id,
                    ),
                ),
            );

            $custom_query = new WP_Query($args);

            if ($custom_query->have_posts()) :
            ?>

                <div class="collection-view__grid">

                    <?php while ($custom_query->have_posts()) : $custom_query->the_post();

                        // Initialize variables
                        $level     = get_field('level');
                        $file_url  = '';
                        $filename  = '';

                        // Handle file_content if exists
                        if (have_rows('file_content')) {
                            while (have_rows('file_content')) {
                                the_row();
                                $file_level = get_sub_field('add__new_files');
                                if ($file_level) {
                                    $file_url  = $file_level['url'] ?? '';
                                    $filename  = $file_level['filename'] ?? '';
                                }
                            }
                        }
                    ?>

                        <div class="collection-view__row">
                            <!-- IMAGE -->
                            <div class="collection-view__img">
                                <?php
                                $image = get_field('cover_image');
                                if (!empty($image)) : ?>
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                <?php else : ?>
                                    <img src="<?php echo esc_url(site_url('/wp-content/uploads/2023/04/nhcp_logoo.png')); ?>"
                                        alt="Collection Image" style="object-fit: contain; padding: 50px; background: #234d8d; height: 300px;">
                                <?php endif; ?>
                            </div>

                            <!-- INFO -->
                            <div class="collection-view__info">

                                <!-- Title -->
                                <div class="collection-view__info--row">
                                    <div class="collection-view__info--label">Title :</div>
                                    <div class="collection-view__info--desc"><?php the_title(); ?></div>
                                </div>

                                <!-- Description -->
                                <div class="collection-view__info--row">
                                    <div class="collection-view__info--label">Description :</div>
                                    <div class="collection-view__info--desc">
                                        <?php echo esc_html(get_field('description', get_the_ID())); ?>
                                    </div>
                                </div>

                                <!-- Creator -->
                                <div class="collection-view__info--row">
                                    <div class="collection-view__info--label">Creator :</div>
                                    <div class="collection-view__info--desc"><?php the_field('creator'); ?></div>
                                </div>

                                <!-- Publisher -->
                                <div class="collection-view__info--row">
                                    <div class="collection-view__info--label">Publisher :</div>
                                    <div class="collection-view__info--desc"><?php echo esc_html(get_field('publisher', get_the_ID())); ?></div>
                                </div>

                                <!-- No. of Downloads (level 1 only) -->
                                <?php if ($level === 'level_1') : ?>
                                    <div class="collection-view__info--row">
                                        <div class="collection-view__info--label">No. of Download :</div>
                                        <div class="collection-view__info--desc">
                                            <?php echo esc_html(get_field('no_of_downloads') ?? 0); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- No. of Views -->
                                <?php if ($file_url) : ?>
                                    <div class="collection-view__info--row">
                                        <div class="collection-view__info--label">No. of Views :</div>
                                        <div class="collection-view__info--desc">
                                            <?php echo esc_html(get_field('no_of_views') ?? 0); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Date -->
                                <div class="collection-view__info--row">
                                    <div class="collection-view__info--label">Date :</div>
                                    <div class="collection-view__info--desc"><?php echo esc_html(get_field('date', get_the_ID())); ?></div>
                                </div>

                                <!-- Format -->
                                <div class="collection-view__info--row">
                                    <div class="collection-view__info--label">Format :</div>
                                    <div class="collection-view__info--desc"><?php echo esc_html(get_field('format_attribute', get_the_ID())); ?></div>
                                </div>

                                <!-- Level -->
                                <div class="collection-view__info--row">
                                    <div class="collection-view__info--label">Level :</div>
                                    <div class="collection-view__info--desc">
                                        <?php
                                        $level_obj = get_field_object('level', get_the_ID());
                                        if ($level_obj) {
                                            $value = $level_obj['value'];
                                            $label = $level_obj['choices'][$value] ?? '';
                                            echo esc_html($label);
                                        }
                                        ?>
                                    </div>
                                </div>

                                <!-- Collection -->
                                <div class="collection-view__info--row">
                                    <div class="collection-view__info--label">Collection :</div>
                                    <div class="collection-view__info--desc">
                                        <?php
                                        $term_field = get_field('choose_category', get_the_ID());
                                        if ($term_field) {
                                            $term_id  = $term_field->term_id;
                                            $taxonomy = 'collection_management';
                                            $separator = ' &rarr; ';
                                            $parents = get_term_parents_list($term_id, $taxonomy, array('separator' => $separator, 'link' => false, 'format' => 'name'));
                                            $parents = substr($parents, 0, strrpos($parents, $separator));
                                            echo esc_html($parents);
                                        }
                                        ?>
                                    </div>
                                </div>

                                <!-- File / Access -->
                                <div class="collection-view__info--row">
                                    <div class="collection-view__info--label">File :</div>
                                    <div class="collection-view__info--desc">

                                        <?php
                                        $this_id = get_the_ID();

                                        if ($level === 'level_1' && $file_url) : ?>
                                            <div class="dwnld-btn">
                                                <a href="<?php echo esc_url($file_url); ?>" download>Download Items</a>
                                            </div>
                                            <?php if (wp_check_filetype($filename)['ext'] === 'pdf') : ?>
                                                <div style="display: none;"><?php echo do_shortcode('[real3dflipbook pdf="' . esc_url($file_url) . '" deeplinkingprefix="item' . $this_id . '_"]'); ?></div>
                                                <a id="views-btn_<?php echo $this_id; ?>" href="#item<?php echo $this_id; ?>_1" class="_df_button readbtn-subscriber">View Item</a>
                                            <?php endif; ?>

                                        <?php elseif (in_array($level, ['level_2', 'level_3', 'level_4'])) : ?>

                                            <?php if (is_user_logged_in()) : ?>
                                                <?php
                                                if (have_rows('file_content')) :
                                                    while (have_rows('file_content')) : the_row();
                                                        $file = get_sub_field('add__new_files');
                                                        if ($file) :
                                                            $pdf_url = $file['url'];
                                                            if (wp_check_filetype($file['filename'])['ext'] === 'pdf') :
                                                ?>
                                                                <div style="display: none;"><?php echo do_shortcode('[real3dflipbook pdf="' . esc_url($pdf_url) . '" deeplinkingprefix="item' . $this_id . '_"]'); ?></div>
                                                                <a id="views-btn_<?php echo $this_id; ?>" href="#item<?php echo $this_id; ?>_1" class="_df_button readbtn-subscriber">View Item</a>
                                                            <?php else : ?>
                                                                <button type="button" class="btn btn-primary" onclick="viewPDF('<?php echo esc_js(get_the_title()); ?>', '<?php echo esc_url($pdf_url); ?>')">View Item</button>
                                        <?php
                                                            endif;
                                                        endif;
                                                    endwhile;
                                                endif;
                                            else :
                                                echo 'Please log in to view the PDF File. <a href="' . esc_url(site_url('/login')) . '">Login</a>';
                                            endif;

                                        endif;
                                        ?>

                                    </div>
                                </div>

                            </div>

                        </div>

                    <?php endwhile; ?>

                </div>

            <?php endif;
            wp_reset_postdata(); ?>

        </div>

    </div>
</section>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<style>
    .modal-footer button {
        background: #2f78cf;
        background-color: #2f78cf;
        color: #fff;
        padding: 6px 12px;
        border-color: #2f78cf;
        border-top: none;
    }

    .modal-footer button:hover,
    .modal-footer button:active,
    .modal-footer button:focus {
        background: #97c9ec !important;
        background-color: #97c9ec !important;
        border-color: #97c9ec !important;
        border-top: none;
    }
</style>

<div class="container">
    <!-- Modal -->
    <div class="modal modal-lg fade" id="myModal" role="dialog" style="width: 100%; padding-right: 0!important;">
        <div class="modal-dialog" style="width: 90%; max-width: 100%;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="mod-title" class="modal-title" style="font-weight: bold;"></h4>
                </div>
                <div class="modal-body" style="height: 80vh;overflow-y: auto; padding: 0; background: #323639;">
                    <iframe id="mod-pdfviewer" src="" width="100%" height="99%"></iframe>
                </div>
                <!--<div class="modal-footer">-->
                <!--    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                <!--</div>-->
            </div>
        </div>
    </div>
</div>

<script>
    function viewPDF(title, pdf) {
        document.getElementById("mod-title").innerHTML = title;
        document.getElementById("mod-pdfviewer").src = pdf;
    }
</script>
<!---->
<script>
    var btn_view = document.querySelector('._df_button');
    var btn_dl = document.querySelector('.dwnld-btn');
    var btn_close = document.querySelector('.dwnld-btn');
    var isProcessing = false;
    $(document).ready(function() {
        $('#download-btn_<?php echo json_encode($this_id) ?>').click(function() {
            var num_rows = <?php echo json_encode($row) ?>;
            var links = $('.download-btn_<?php echo json_encode($this_id) ?>[href$=".pdf"], .download-btn_<?php echo json_encode($this_id) ?>[href$=".jpg"], .download-btn_<?php echo json_encode($this_id) ?>[href$=".jpeg"], .download-btn_<?php echo json_encode($this_id) ?>[href$=".png"], .download-btn_<?php echo json_encode($this_id) ?>[href$=".gif"]').slice(0, num_rows);
            downloadSequentially(links, 0);

            if (isProcessing) {
                return; // If already processing, ignore the click event
            }
            isProcessing = true;
            var fileId = $(this).attr("data-postid");
            var currentTime = <?= json_encode($post_date) ?>;
            var post_id = $(this).attr("data-postid");
            console.log(post_id);
            $.ajax({
                type: "POST",
                url: "<?php echo esc_url(home_url('/')); ?>ajax-page",
                data: {
                    post_id: post_id,
                    file_id: fileId,
                    time: currentTime
                },
                success: function(response) {
                    console.log(response);

                },
                complete: function() {
                    isProcessing = false; // Set the flag to false after the request is completed
                }
            });
        });

        function downloadSequentially(links, index) {
            if (index < links.length) {
                var link = $(links[index]).attr('href');
                var a = document.createElement('a');
                a.href = link;
                a.target = '_blank';
                a.download = '';
                document.body.appendChild(a);
                a.click();
                setTimeout(function() {
                    document.body.removeChild(a);
                    downloadSequentially(links, index + 1);
                }, 500); // adjust the delay time as needed
            }
        }
        $('.fake_close_btn').click(function() {
            console.log('click');
            $('.df-lightbox-close').click();
            btn_dl.style.display = 'none';
            btn_close.style.display = 'none';

        });

        //  no of views counter
        $('#views-btn_<?php echo json_encode($this_id) ?>').click(function() {
            var view_postid = $(this).attr("data-postid");
            console.log(view_postid);
            $.ajax({
                type: "POST",
                url: "<?php echo esc_url(home_url('/')); ?>ajax-page",
                data: {
                    view_postid: view_postid
                },
                success: function(response) {
                    console.log(response);

                }
            });
        });

    });
</script>
<script>
    var btn_view = document.querySelector('._df_button');
    var btn_dl = document.querySelector('.dwnld-btn');
    var btn_close = document.querySelector('.fake_close_btn');
    btn_view.addEventListener('click', function() {
        setTimeout(function() {
            btn_dl.style.display = 'block';
            btn_close.style.display = 'block';
            console.log('collection-view');
        }, 15000);

    });
</script>
<?php get_footer(); ?>