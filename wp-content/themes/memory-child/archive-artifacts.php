<?php get_header(); ?>
<style>
    .artifacts-pages input::placeholder {
        color: #fff !important;
    }

    .artifacts-pages input.form-control.border-0 {
        color: #fff;
    }

    .artifacts-pages .button {
        color: #fff !important;
    }

    .post-type-archive-artifacts div#content {
        background: #000;
    }

    .artifacts-pages input.form-control.border-0 {
        background: transparent;
        color: #fff;
    }

    .artifacts-pages .bg-body-tertiary {
        --bs-bg-opacity: 1;
        background-color: rgb(248 249 250 / 26%) !important;
    }

    .artifacts-pages input.form-control.border-0 {
        font-size: 19px;
        color: #fff !important;
        opacity: 1;
    }

    .total-result {
        background: #ffffff42;
        padding: 21px 10px;
        border-radius: 10px;
    }

    .post-type-archive-artifacts span.select2.select2-container.select2-container--default {
        margin-top: 10px;
    }

    .artifacts-sidebar h2,
    .artifacts-sidebar p,
    .artifacts-sidebar a {
        color: #fff;
    }

    .artifacts-pages label.circle-option {
        color: #fff;
    }

    .artifacts-pages .circle-option span {
        border: 2px solid #fff;
        background: #fff;
    }

    .artifacts-pages img {
        margin: 0;
        border-radius: 15px;
        width: 100%;
        object-fit: cover;
        height: clamp(185px, 25vw, 372px);
    }

    .artifacts-pages .content h3 {
        font-weight: 300 !important;
        margin: 0;
    }
</style>

<div class="container my-5 artifacts-pages">

    <div class="row justify-content-between ">

        <!-- LEFT: RESULTS -->
        <div class="col-lg-8 content">
            <div class="row ">

                <?php
                global $wp_query;


                ?>

                <div class="d-flex justify-content-between align-items-center mb-3 total-result">
                    <h4 class="text-white mb-0 mt-0">
                        Top <?php echo $wp_query->post_count;  ?> results for All artifacts
                    </h4>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">



                </div>


                <!-- Top Bar: Results Count & Pagination -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center gap-2 text-white">
                        <meduim>Top <?php echo $wp_query->post_count; ?> results for <?php single_cat_title(); ?></meduim>
                        <select class="form-select form-select-md" style="width: 50px;">
                            <option selected>10</option>
                            <option>25</option>
                            <option>50</option>
                        </select>
                    </div>
                    <div class="pagination-nav">
                        <?php the_posts_pagination(['type' => 'list']); ?>
                    </div>
                </div>
                <div class="row g-4">
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <div class="col-lg-4 col-md-6">
                                <div class=" h-100 border-0 shadow-sm text-center">

                                    <!-- Thumbnail -->
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="mb-3">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail(
                                                    'small',
                                                    ['class' => 'img-fluid mx-auto d-block']
                                                ); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>


                                    <!-- TITLE -->
                                    <h3 class="fw-semibold mb-2 text-start">
                                        <a href="<?php the_permalink(); ?>" class="text-decoration-none text-white text-start">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>


                                </div>
                            </div>
                        <?php endwhile; ?>

                    <?php else : ?>
                        <div class="col-12 text-center py-5">
                            <h4>No items found matching your search or filters.</h4>
                            <p>Please try a different search term or filter.</p>
                        </div>
                    <?php endif; ?>
                </div>





            </div>
        </div>

        <!-- RIGHT: SIDEBAR -->
        <div class="col-lg-4">

            <?php
            // Get current filter values
            $location_items_selected = $_GET['location'] ?? [];
            $type_of_artifacts_selected     = $_GET['type_of_artifacts'] ?? [];
            $sort_by                 = $_GET['sort_by'] ?? '';
            $search_term             = $_GET['s'] ?? '';
            ?>

            <form method="get" action="<?php echo esc_url(get_post_type_archive_link('artifacts')); ?>" class="p-4">

                <!-- SEARCH -->
                <div class="row g-4 border rounded mb-5">
                    <div class="input-group">
                        <input type="search" name="s" class="form-control border-0" placeholder="Search items..."
                            value="<?php echo esc_attr($search_term); ?>">
                        <button class="button" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </div>

                <!-- APPLIED FILTERS SUMMARY -->
                <?php if (!empty($location_items_selected) || !empty($type_of_artifacts_selected) || !empty($sort_by) || !empty($search_term)): ?>
                    <div class="row g-4 border rounded mb-5">
                        <strong>Applied Filters:</strong>
                        <ul class="mb-0 list-unstyled">
                            <?php
                            foreach ($location_items_selected as $item) {
                                echo '<li>Heraldic Item: ' . esc_html($item) . '</li>';
                            }
                            foreach ($type_of_artifacts_selected as $seal) {
                                echo '<li>Seal/Logo: ' . esc_html($seal) . '</li>';
                            }
                            if ($sort_by) {
                                echo '<li>Sort: ' . esc_html($sort_by) . '</li>';
                            }
                            if ($search_term) {
                                echo '<li>Search: ' . esc_html($search_term) . '</li>';
                            }
                            ?>
                        </ul>
                        <button class="box">
                            <a href="<?php echo esc_url(get_post_type_archive_link('artifacts')); ?>" class="btn btn-sm btn-secondary mt-2">Clear All</a>
                        </button>
                    </div>
                <?php endif; ?>

                <div class="row g-4 border rounded p-4 bg-body-tertiary">

                    <!-- HERALDIC ITEMS -->
                    <div class="col-6 text-white ">
                        <h6 class="section-title text-white ">Location:</h6>
                        <?php
                        $items_options = [
                            'central'     => 'NHCP Central',
                            'manila'      => 'Metro Manila',
                            'central_luzon'  => 'Central Luzon',
                            'southern_luzon' => 'Southern Luzon',
                            'inter_regional'    => 'Inter-regional',
                        ];
                        foreach ($items_options as $slug => $label): ?>
                            <label class="circle-option">
                                <input type="checkbox" name="location[]" value="<?php echo esc_attr($slug); ?>"
                                    <?php checked(in_array($slug, (array) $location_items_selected)); ?>>
                                <span></span> <?php echo esc_html($label); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>

                    <!-- SORTING -->
                    <div class="col-6">
                        <h6 class="section-title text-white">Sort by:</h6>
                        <?php
                        $sort_options = [
                            'relevant' => 'Most relevant',
                            'az'       => 'A–Z',
                            'za'       => 'Z–A',
                            'newest'   => 'Newest',
                            'oldest'   => 'Oldest',
                        ];
                        foreach ($sort_options as $value => $label): ?>
                            <label class="circle-option">
                                <input type="radio" name="sort_by" value="<?php echo esc_attr($value); ?>"
                                    <?php checked($sort_by, $value); ?>>
                                <span></span> <?php echo esc_html($label); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>

                    <!-- SEALS / LOGOS -->
                    <div class="col-12 mt-4">
                        <h6 class="section-title text-white">Type of Artifact</h6>

                        <div class="row">
                            <?php
                            // Options array
                            $seals_options = [
                                'document' => 'Document',
                                'personal_items' => 'Personal Items',
                                'clothing_jewerly' => 'Clothing / Jewelry',
                                'vehicle_transportation' => 'Vehicle / Transportation',
                                'military' => 'Military',
                                'photos_videos' => 'Photos / Videos',
                                'sculpture' => 'Sculpture',
                                'paintings' => 'Paintings',
                                'tools' => 'Tools',
                                'furnitures' => 'Furnitures',
                                'others' => 'Others',
                            ];

                            // $type_of_artifacts_selected should be an array of selected values
                            foreach ($seals_options as $slug => $label): ?>
                                <div class="col-12 col-md-6">
                                    <label class="circle-option d-flex align-items-center mb-2">
                                        <input type="checkbox"
                                            name="type_of_artifacts[]"
                                            value="<?php echo esc_attr($slug); ?>"
                                            <?php checked(in_array($slug, (array) $type_of_artifacts_selected)); ?>>
                                        <span class="ms-2"></span>
                                        <?php echo esc_html($label); ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>


                    <div class="col-12 mt-4">
                        <h6 class="fw-bold text-white">Filter by:</h6>

                        <div class="container p-3  text-light">
                            <select name="personage" class="form-select">
                                <option value="">Personages</option>
                                <option value="1">Personage 1</option>
                                <option value="2">Personage 2</option>
                                <option value="3">Personage 3</option>
                            </select>

                            <select name="collection" class="form-select mt-2">
                                <option value="">Collection</option>
                                <option value="a">Collection A</option>
                                <option value="b">Collection B</option>
                                <option value="c">Collection C</option>
                            </select>
                        </div> <!-- ✅ ito yung kulang -->
                    </div>



                    <!-- APPLY BUTTON -->
                    <div class="col-12 mt-4">
                        <button type="submit" class="btn w-100 fw-bold" style="background-color:#6b4a1f;color:white;">
                            Apply Filters
                        </button>
                    </div>

                </div>

            </form>

            <div class="sidebar_article text-white artifacts-sidebar">
                <?php get_template_part('partials/sidebar-welcome'); ?>
                <?php get_template_part('partials/sidebar-location-info'); ?>

            </div>
        </div>



    </div>


</div>
<script>
    jQuery(document).ready(function($) {
        $('.form-select').select2();
    });
</script>
<?php get_footer(); ?>

<style>
</style>