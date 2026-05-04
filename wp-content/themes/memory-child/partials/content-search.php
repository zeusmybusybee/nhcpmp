<article class="card mb-4 shadow-sm">
    <div class="card-body p-0">
        <div class="row g-0"> <!-- No gutters for a seamless look -->
            
            <!-- COLUMN 1: Image and Buttons (col-md-4) -->
            <div class="col-md-4 bg-light d-flex flex-column">
                <div class="search-result__cover p-3 flex-grow-1 text-center">
                    <div class="mb-3 overflow-hidden  bg-white" style="height: 250px;">
                        <?php 
                        $image = get_field('cover_image');
                        if (!empty($image)){ ?>
                            <img src="<?php echo esc_url($image['url']); ?>" 
                                 alt="<?php echo esc_attr($image['alt']); ?>" 
                                 class="img-fluid w-100 h-100" 
                                 style="object-fit: cover;">
                        <?php } else { ?>
                            <img src="<?php echo site_url(); ?>/wp-content/uploads/2023/04/nhcp_logoo.png" 
                                 alt="Collection Image" 
                                 class="img-fluid p-4 h-100" 
                                 style="object-fit: contain;">
                        <?php } ?>
                    </div>

                    <!-- Buttons Section -->
                    <div class="d-grid gap-2">
                        
                        
                        <?php 
                        $post = get_the_ID();
                        $pdf = get_field('file_content');
                        $level = get_field('level');
                        $file_content_limit = get_field('file_content_limit');
                        
                        if ($pdf): 
                            // Logic for Level 1, 2, 3, 4
                            if ($level == 'level_1') {
                                if (have_rows('file_content', $post)) {
                                    while (have_rows('file_content', $post)) {
                                        the_row();
                                        $file_level1 = get_sub_field('add__new_files');
                                        echo '<a class="download-btn_'.$post.' d-none" href="'.$file_level1['url'].'" download></a>';
                                    }
                                }
                                ?>
                                <div style="display: none;"><?php echo do_shortcode('[real3dflipbook pdf="'.$pdf['url'].'" deeplinkingprefix="item'.$post.'_"]'); ?></div>
                                <a id="views-btn_<?php echo $post ?>" class="btn btn-primary _df_button" data-postid="<?php echo $post; ?>" href="#item<?php echo $post; ?>_1">
                                    <i class="fas fa-eye me-1"></i> View Item
                                </a>
                                <button id="download-btn_<?php echo $post ?>" class="btn btn-outline-success" data-postid="<?php echo $post; ?>">
                                    <i class="fas fa-download me-1"></i> Download Item
                                </button>
                            
                            <?php } elseif ($level == 'level_2' || $level == 'level_4') { 
                                if (!is_user_logged_in() && $level == 'level_4') { ?>
                                    <div class="alert alert-warning py-2 small">Please log in to view.</div>
                                    <a href="<?php echo site_url('/login'); ?>" class="btn btn-sm btn-dark">Login</a>
                                <?php } else { ?>
                                    <div style="display: none;"><?php echo do_shortcode('[real3dflipbook pdf="'.$pdf['url'].'" deeplinkingprefix="item'.$post.'_"]'); ?></div>
                                    <a id="views-btn_<?php echo $post ?>" class="btn btn-primary _df_button" data-postid="<?php echo $post; ?>" href="#item<?php echo $post; ?>_1">View Item</a>
                                <?php } ?>

                            <?php } elseif ($level == 'level_3') { 
                                if (is_user_logged_in()) {
                                    $display_file = get_field('file_full') ?: get_field('file_content_limit');
                                    ?>
                                    <div style="display: none;"><?php echo do_shortcode('[real3dflipbook pdf="'.$display_file['url'].'" deeplinkingprefix="item'.$post.'_"]'); ?></div>
                                    <a id="views-btn_<?php echo $post ?>" class="btn btn-primary _df_button" href="#item<?php echo $post; ?>_1">View Item</a>
                                    <?php if(get_field('redirected_url')) : ?>
                                        <a href="<?php echo get_field('redirected_url'); ?>" target="_blank" class="btn btn-warning">Buy Item</a>
                                    <?php endif; ?>
                                <?php } else { 
                                    if ($file_content_limit) { ?>
                                        <div style="display: none;"><?php echo do_shortcode('[real3dflipbook pdf="'.$file_content_limit['url'].'" deeplinkingprefix="item'.$post.'_"]'); ?></div>
                                        <a id="views-btn_<?php echo $post ?>" class="btn btn-primary _df_button" href="#item<?php echo $post; ?>_1">View Preview</a>
                                    <?php }
                                }
                            } ?>
                        <?php endif; ?>
                        
                        <!-- Floating Controls for Flipbook (Hidden by default) -->
                        <div class="fake_close_btn btn btn-danger btn-sm mt-2" style="display:none;">
                            <i class="fas fa-times"></i> Close Viewer
                        </div>
                    </div>
                </div>
            </div>

            <!-- COLUMN 2: Info (col-md-8) -->
            <div class="col-md-8 col-8 search-item">
                <div class="p-4">
                    <h4 class="h4 card-title text-primary mb-3"><?php the_title(); ?></h4>
                    
                    <?php if (get_post_type() !== 'historical-sites') : ?>
                    <div class="search-result__info--body">
                        <?php if ($level == 'level_3'): ?>
                            <p class="mb-1"><span class="fw-bold text-muted small uppercase">On Sale:</span> 
                            <?php echo get_field('on_sale') ? '<span class="badge bg-success">Yes</span>' : 'No'; ?></p>
                        <?php endif; ?>

                        <p class="text-secondary font-monospace mb-2" style="font-size: 0.9rem;">
                            <?php echo get_field("call_number"); ?>
                        </p>

                        <div class="mb-3">
                            <p><strong>Description:</strong></p>
                            <p class="card-text">
                                <?php 
                                if(get_field("description")) {
                                    echo get_field("description");
                                } elseif(get_field("bm_publisher")) {
                                    echo get_field("bm_place_of_publication") . ' : ' . get_field("bm_publisher") . ', ' . get_field("bm_date_of_publication");
                                } ?>
                            </p>
                        </div>

                        <!-- Metadata Badges -->
                        <div class="d-flex flex-wrap gap-3 mb-3 border-top pt-3">
                            <div class="c_meduim"><i class="fas fa-eye text-muted"></i> No. of Views:  <strong><?php echo get_field('no_of_views') ?: 0; ?></strong></div>
                            <?php if($level == 'level_1'): ?>
                                <div class="c_meduim"><i class="fas fa-download text-muted"></i> No. of Downloads:  <strong><?php echo get_field('no_of_downloads') ?: 0; ?></strong></div>
                            <?php endif; ?>
                        </div>

                        <!-- Collapsible "See More" -->
                        <button class="btn btn-link btn-sm p-0 text-decoration-none see-more" type="button" data-bs-toggle="collapse" data-bs-target="#reveal_<?php echo $post; ?>">
                            See More Details <i class="fas fa-chevron-down ms-1"></i>
                        </button>

                        <div class="collapse mt-3" id="reveal_<?php echo $post; ?>">
                            <div class="card card-body bg-light border-0 py-2 see-more-show-item">
                                <p class="mb-1 small"><strong>Accession Number:</strong> <?php echo get_field("accession_number"); ?></p>
                                <p class="mb-1 small"><strong>Format:</strong> 
                                    <?php 
                                    $format_id = get_field("format_attribute");
                                    echo $format_id ? get_the_title($format_id) : 'N/A'; 
                                    ?>
                                </p>
                                <p class="mb-0 small"><strong>Subject:</strong> 
                                    <?php 
                                    $subject_fields = ['access_point_tropical', 'bm_access_point_tropical', 'ac_subject_keywords', 'ar_access_point_tropical', 'er_subject', 's_subject', 'vr_access_point_topical', 'ws_access_point_topical'];
                                    foreach ($subject_fields as $sf) {
                                        $terms = get_field($sf);
                                        if ($terms) {
                                            foreach ($terms as $term) {
                                                echo '<span class="badge bg-secondary me-1">' . esc_html($term->name) . '</span>';
                                            }
                                        }
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                        <?php else : ?>
                        
                     <div class="full-content">
                            <div class="details">

                                <?php if (get_field('citymunicipality_hidden_text') || get_field('province_hidden_text')) : ?>
                                    <div>
                                        <strong>Location:</strong>
                                        <?php the_field('citymunicipality_hidden_text'); ?>,
                                        <?php the_field('province_hidden_text'); ?>
                                    </div>
                                <?php endif; ?>

                                <?php
                                $terms = get_the_terms(get_the_ID(), 'registry_category');
                                if ($terms && !is_wp_error($terms)) :
                                ?>
                                    <div>
                                        <strong>Category:</strong>
                                        <?php echo esc_html($terms[0]->name); ?>
                                    </div>
                                <?php endif; ?>

                                <?php
                                $type_field = get_field_object('type');
                                $type_value = get_field('type');
                                if ($type_value):
                                    $type_label = $type_field['choices'][$type_value] ?? $type_value;
                                ?>
                                    <div><strong>Type:</strong> <?php echo esc_html($type_label); ?></div>
                                <?php endif; ?>

                                <?php
                                $status_field = get_field_object('status');
                                $status_value = get_field('status');
                                if ($status_value):
                                    $status_label = $status_field['choices'][$status_value] ?? $status_value;
                                ?>
                                    <div><strong>Status:</strong> <?php echo esc_html($status_label); ?></div>
                                <?php endif; ?>

                                <?php if (get_field('cultural_property')): ?>
                                    <div><?php echo esc_html(get_field('cultural_property')); ?></div>
                                <?php endif; ?>


                                <?php if (get_field('legal_basis')): ?>
                                    <div><strong>Legal basis:</strong> <?php echo esc_html(get_field('legal_basis')); ?></div>
                                <?php endif; ?>

                                <?php
                                $year_found = get_field('year_found');
                                $date_text = get_field('date_text');

                                if ($year_found): ?>
                                    <div>
                                        <strong>
                                            <?php echo $date_text ? esc_html($date_text) : 'Marker Date'; ?>:
                                        </strong>
                                        <?php echo esc_html($year_found); ?>
                                    </div>
                                <?php endif; ?>


                                <?php
                                $installed_by = get_field('installed_by');
                                $removed_label = get_field('removed_by_label');
                                ?>

                                <div>
                                    <strong>
                                        <?php echo $removed_label ? esc_html($removed_label) : 'Installed By:'; ?>
                                    </strong>
                                    <?php echo esc_html($installed_by); ?>
                                </div>
                                
                                <a id="views-btn_<?php the_ID(); ?>" class="view-btn-search" href="<?php echo esc_url(get_permalink()); ?>">
                        View Item
                    </a>
                            </div>
                        </div>

                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
    </div>
</article>

<script>
$(document).ready(function() {
    var postId = <?php echo json_encode($post); ?>;
    var rowCount = <?php echo json_encode($row ?? 0); ?>;
    var isProcessing = false;

    // Download Logic
    $('#download-btn_' + postId).click(function() {
        if (isProcessing) return;
        isProcessing = true;

        var links = $('.download-btn_' + postId).slice(0, rowCount);
        downloadSequentially(links, 0);

        $.ajax({
            type: "POST",
            url: "<?php echo esc_url( home_url( '/' ) ); ?>ajax-page",
            data: { post_id: postId, file_id: postId },
            complete: function() { isProcessing = false; }
        });
    });

    function downloadSequentially(links, index) {
        if (index < links.length) {
            var link = $(links[index]).attr('href');
            var a = document.createElement('a');
            a.href = link;
            a.download = '';
            document.body.appendChild(a);
            a.click();
            setTimeout(function() {
                document.body.removeChild(a);
                downloadSequentially(links, index + 1);
            }, 500);
        }
    }

    // View Logic (Analytics)
    $('#views-btn_' + postId).click(function() {
        $.ajax({
            type: "POST",
            url: "<?php echo esc_url( home_url( '/' ) ); ?>ajax-page",
            data: { view_postid: postId }
        });
        
        // Show close button after delay
        setTimeout(function() {
            $('.fake_close_btn').fadeIn();
        }, 5000);
    });

    $('.fake_close_btn').click(function() {
        $('.df-lightbox-close').click();
        $(this).hide();
    });
});
</script>