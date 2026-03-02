<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <div class="col-lg-12 col-md-12">

            <div class="card h-100 border-0 shadow-sm text-center p-4">
                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">

                    <!-- Thumbnail -->
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="mb-3">
                            <?php the_post_thumbnail(
                                'small',
                                ['class' => 'img-fluid mx-auto d-block']
                            ); ?>
                        </div>
                    <?php endif; ?>

                    <!-- TITLE -->
                    <h3 class="fw-semibold mb-2 ph-heraldy-title">
                        <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                            <?php the_title(); ?>
                        </a>
                    </h3>

                    <!-- META -->
                    <div class="text-muted small mt-4 text-start meta-ph-heraldy">
                        <?php if ($region = get_field('region')) :   $region_field = get_field_object('region'); ?>
                            <div>Location: <?php echo esc_html($region_field['choices'][$region] ?? $region); ?> <?php echo esc_html(get_field('province_text')); ?>, <?php echo esc_html(get_field('city_text')); ?></div>
                        <?php endif; ?>
                        <?php
                        $seals_logos = get_field('seals_logos'); // returns array of slugs, e.g. ['suc','military']

                        if (!empty($seals_logos) && is_array($seals_logos)):

                            // Map ACF slugs to labels (same as your filter options)
                            $seals_labels = [
                                'judiciary' => 'Judiciary/Legislative',
                                'nga'       => 'National Government Agencies (NGA)',
                                'lgu'       => 'Local Government Unit (LGU)',
                                'gocc'      => 'Government-Owned Controlled Corporation',
                                'military'  => 'Military',
                                'suc'       => 'State University and College (SUC)',
                                'others'    => 'Others',
                            ];

                            $output_labels = [];
                            foreach ($seals_logos as $slug) {
                                if (isset($seals_labels[$slug])) {
                                    $output_labels[] = $seals_labels[$slug];
                                }
                            }

                            echo '<div>Category: ' . esc_html(implode(', ', $output_labels)) . '</div>';

                        endif;
                        ?>
                        <div><?php if (get_field('year_approved')): echo 'Year Approved:' . get_field('year_approved');
                                endif; ?></div>
                    </div>
                </a>
            </div>

        </div>
    <?php endwhile; ?>

<?php else : ?>
    <div class="col-12 text-center py-5">
        <h4>No items found matching your search or filters.</h4>
        <p>Please try a different search term or filter.</p>
    </div>
<?php endif; ?>