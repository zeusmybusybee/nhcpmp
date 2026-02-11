<?php
/**
 * Template part for content posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package memory
 */

$memory_hide_featured_image = get_theme_mod( 'hide_featured_image', 'show-ft' );
?>
<style>
     input::placeholder {
        color: #fff !important;
    }

    input.form-control.border-0 {
        color: #fff;
    }

    .button {
        color: #fff !important;
    }
    .single-artifacts div#content{
        background:#000;
    }
    .single-artifacts input.form-control.border-0 {
    background: transparent;
    color: #fff;
}
 .single-artifacts .bg-body-tertiary {
    --bs-bg-opacity: 1;
    background-color: rgb(248 249 250 / 26%) !important;
}
 .single-artifacts  input.form-control.border-0 {
    font-size: 19px;
    color: #fff !important;
    opacity: 1;
}
.total-result{
        background: #ffffff42;
    padding: 21px 10px;
    border-radius: 10px;
}
.single-artifacts span.select2.select2-container.select2-container--default {
    margin-top: 10px;
}

    .post-type-archive-artifacts div#content{
        background:#000;
    }
    .artifacts-pages input.form-control.border-0 {
    background: transparent;
    color: #fff;
}
 .artifacts-pages  .bg-body-tertiary {
    --bs-bg-opacity: 1;
    background-color: rgb(248 249 250 / 26%) !important;
}
 .single-overflow  input.form-control.border-0 {
    font-size: 19px;
    color: #fff !important;
    opacity: 1;
}
.total-result{
        background: #ffffff42;
    padding: 21px 10px;
    border-radius: 10px;
}
.single-overflows span.select2.select2-container.select2-container--default {
    margin-top: 10px;
}
.single-overflow h2,
.single-overflow p,
.single-overflow a{
    color:#fff;
}
.single-overflow label.circle-option {
    color: #fff;
}
.single-overflow .circle-option span {
    border: 2px solid #fff;
    background:#fff;
}
</style>
<div class="container single-overflow">
  <div class="row justify-content-between">
    <!-- left column -->
    <div class="col-md-8 left-column">
        <div class="d-flex gap-4">
            <div class="col-5">
               <?php
                    if ( 'show-ft' === $memory_hide_featured_image ) {
                        echo '<div class="entry-media">';
                        the_post_thumbnail( 'memory-thumbnails-2' );
                        echo '</div>';
                    }
                    ?>
            </div>
            <div class="col-8">
               <h2 class="text-white"><?php echo get_the_title(); ?></h2>
               <div class="post-content text-white">
                    <?php the_content(); ?>
                </div>

            </div>
    </div>
            <h2 class="mb-4 text-white">Related Artifacts</h2>
            <div class="row g-4">

            <?php
            $args = [
                'post_type'      => 'artifacts',
                'posts_per_page' => 6, // 6 posts
                'post_status'    => 'publish',
                'orderby'        => 'date',
            ];

            $artifacts = new WP_Query($args);

            if ($artifacts->have_posts()) :
                while ($artifacts->have_posts()) : $artifacts->the_post(); ?>
                    <div class="col-md-4">
                    <div class=" h-100">
                        <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium', ['class' => 'card-img-top']); ?>
                        </a>
                        <?php endif; ?>
                        <div class="card-body">
                        <h5 class="card-title">
                            <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark text-white">
                            <?php the_title(); ?>
                            </a>
                        </h5>
                        </div>
                    </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <p>No artifacts found.</p>
            <?php endif; ?>

            </div>


        
    </div>

    <!-- right column -->
         <!-- RIGHT: SIDEBAR -->
        <div class="col-lg-3">

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
                <h6 class="mb-3 fw-bold text-white">Filter by:</h6>

                <div class="container p-3 bg-dark text-light">
                    <label class="form-label">Filter by:</label>

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

