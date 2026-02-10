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
/* .single-overflow:before {
    content: '';
    width: 100%;
    background: #ffffff2b;
    position: absolute;
    height: 25%;
    left: 0;
    max-width: 1154px;
    top: 201px;
} */
</style>
<div class="container single-overflow">
  <div class="row justify-content-between">
    <!-- left column -->
    <div class="col-md-7 left-column">
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
    <div class="col-md-4">
      <div class="p-3 ">
            <form method="get"
                action="<?php echo esc_url(get_post_type_archive_link('artifacts')); ?>"
                class="p-4">

                <div class="row g-4 border rounded mb-5">
                    <!-- Always target book -->
                    <input type="hidden" name="post_type" value="book">

                    <!-- SEARCH (only one) -->
                    <div class="input-group" style="margin-top:0;">
                        <input
                            type="search"
                            class="form-control border-0"
                            name="s"
                            placeholder="Search books..."
                            value="<?php echo esc_attr($_GET['s'] ?? ''); ?>">
                        <button class="button" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>


                <div class="row g-4 border rounded p-4 bg-body-tertiary text-white">

                    <!-- FILTER BY -->
                    <div class="col-6">
                        <h6 class="mb-3 fw-bold text-white ">Location</h6>

                        <?php $filter = $_GET['filter'] ?? ''; ?>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="filter" value="title"
                                <?php checked($filter, 'nhcp_central'); ?>>
                            <label class="form-check-label">NHCP Central</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="filter" value="author"
                                <?php checked($filter, 'metro-manila'); ?>>
                            <label class="form-check-label">Metro Manila</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="filter" value="publisher"
                                <?php checked($filter, 'central_luzon'); ?>>
                            <label class="form-check-label">Central Luzon</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="filter" value="keyword"
                                <?php checked($filter, 'southern_luzon'); ?>>
                            <label class="form-check-label">Southern Luzon</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="filter" value="year"
                                <?php checked($filter, 'inter_regional'); ?>>
                            <label class="form-check-label">Inter-regional</label>
                        </div>
                    </div>

                    <!-- SORT BY -->
                    <div class="col-6">
                        <h6 class="mb-3 fw-bold text-white">Sort by:</h6>

                        <?php $orderby = $_GET['orderby'] ?? ''; ?>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="orderby" value="relevance"
                                <?php checked($orderby, 'relevance'); ?>>
                            <label class="form-check-label">Most relevant</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="orderby" value="title-asc"
                                <?php checked($orderby, 'title-asc'); ?>>
                            <label class="form-check-label">A–Z</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="orderby" value="title-desc"
                                <?php checked($orderby, 'title-desc'); ?>>
                            <label class="form-check-label">Z–A</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="orderby" value="date-desc"
                                <?php checked($orderby, 'date-desc'); ?>>
                            <label class="form-check-label">Newest</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="orderby" value="date-asc"
                                <?php checked($orderby, 'date-asc'); ?>>
                            <label class="form-check-label">Oldest</label>
                        </div>
                    </div>

                    <!-- LEVEL OF ACCESS -->
                    <div class="col-12 mt-4">
                        <h6 class="mb-3 fw-bold text-white">Type of Artifact</h6>

                        <?php $access = $_GET['level_of_access'] ?? ''; ?>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="level_of_access" value="document"
                                        <?php checked($access, 'document'); ?>>
                                    <label class="form-check-label">Document</label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="level_of_access" value="personal_items"
                                        <?php checked($access, 'personal_items'); ?>>
                                    <label class="form-check-label">Personal Items</label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="level_of_access" value="clothing_jewelry"
                                        <?php checked($access, 'clothing_jewelry'); ?>>
                                    <label class="form-check-label">Clothing / Jewelry</label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="level_of_access" value="vehicle_transportation"
                                        <?php checked($access, 'vehicle_transportation'); ?>>
                                    <label class="form-check-label">Vehicle / Transportation</label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="level_of_access" value="photos_videos"
                                        <?php checked($access, 'photos_videos'); ?>>
                                    <label class="form-check-label">Photos / Videos</label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="level_of_access" value="sculpture"
                                        <?php checked($access, 'sculpture'); ?>>
                                    <label class="form-check-label">Sculpture</label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="level_of_access" value="painting"
                                        <?php checked($access, 'painting'); ?>>
                                    <label class="form-check-label">Paintings</label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="level_of_access" value="tools"
                                        <?php checked($access, 'tools'); ?>>
                                    <label class="form-check-label">Tools</label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="level_of_access" value="furnitures"
                                        <?php checked($access, 'furnitures'); ?>>
                                    <label class="form-check-label">Furnitures</label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="level_of_access" value="others"
                                        <?php checked($access, 'others'); ?>>
                                    <label class="form-check-label">Others</label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 mt-4">
                        <h6 class="mb-3 fw-bold text-white">Filter by:</h6>
                        <div class="container p-3 bg-dark text-light">
                        <label class="form-label">Filter by:</label>

                        <select class="form-select mb-4" aria-label="Personages select">
                            <option selected>Personages</option>
                            <option value="1">Personage 1</option>
                            <option value="2">Personage 2</option>
                            <option value="3">Personage 3</option>
                        </select>

                        <select class="form-select mt-2" aria-label="Collection select">
                            <option selected>Collection</option>
                            <option value="a">Collection A</option>
                            <option value="b">Collection B</option>
                            <option value="c">Collection C</option>
                        </select>
                        </div>

              



                    </div>

                    <!-- APPLY BUTTON -->
                    <div class="col-12 mt-4">
                        <button type="submit"
                            class="btn w-100 fw-bold"
                            style="background-color:#6b4a1f;color:white;">
                            Apply Filters
                        </button>
                    </div>

                </div>





            </form>

            <div class="sidebar_article text-white">
                <?php get_template_part('partials/sidebar-welcome'); ?>
                <?php get_template_part('partials/sidebar-location-info'); ?>

            </div>



      </div>
    </div>
  </div>
</div>

