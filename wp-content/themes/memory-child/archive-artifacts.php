<?php get_header(); ?>
<style>
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
 .artifacts-pages   input.form-control.border-0 {
    font-size: 19px;
    color: #fff !important;
    opacity: 1;
}
.total-result{
        background: #ffffff42;
    padding: 21px 10px;
    border-radius: 10px;
}
.post-type-archive-artifacts span.select2.select2-container.select2-container--default {
    margin-top: 10px;
}
.artifacts-sidebar h2,
.artifacts-sidebar p,
.artifacts-sidebar a{
    color:#fff;
}
</style>

<div class="container my-5 artifacts-pages">

    <div class="row justify-content-between ">

        <!-- LEFT: RESULTS -->
         <div class="col-lg-8">
            <div class="row ">

        <?php
global $wp_query;

$per_page = get_query_var('posts_per_page');
$total    = $wp_query->found_posts;
$current  = max(1, get_query_var('paged'));
?>

<div class="d-flex justify-content-between align-items-center mb-3 total-result">
  <h4 class="text-white mb-0 mt-0">
    Top <?php echo esc_html($per_page); ?> results for All artifacts
  </h4>
</div>
<div class="d-flex justify-content-between align-items-center mb-3">
  <!-- Results per page -->
  <form method="get" class="d-flex align-items-center gap-2">
    <label class="text-white small mb-0">Results per page:</label>
    <select name="per_page" onchange="this.form.submit()" class="form-select-sm w-auto">
      <option value="10" <?php selected($_GET['per_page'] ?? 10, 10); ?>>10</option>
      <option value="20" <?php selected($_GET['per_page'] ?? 10, 20); ?>>20</option>
      <option value="50" <?php selected($_GET['per_page'] ?? 10, 50); ?>>50</option>
    </select>
  </form>

  
</div>



      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div class="col-4">

          <!-- THUMBNAIL -->
          <?php if (has_post_thumbnail()) : ?>
            <div class="artifact-thumb flex-shrink-0">
              <?php the_post_thumbnail('medium', [
                'class' => 'img-fluid rounded'
              ]); ?>
            </div>
          <?php endif; ?>

          <!-- DETAILS -->
          <div class="flex-grow-1 d-flex flex-column">

            <!-- BADGES -->
            <div class="d-flex gap-2 mb-2 flex-wrap">
              <?php
              $access = get_field('level_of_access');
              $availability = get_field('availability');

              $access_map = [
                'open'      => ['label' => 'Open Access', 'class' => 'badge-open'],
                'viewing'   => ['label' => 'Viewing', 'class' => 'badge-viewing'],
                'limited'   => ['label' => 'Limited', 'class' => 'badge-limited'],
                'exclusive' => ['label' => 'Exclusive', 'class' => 'badge-exclusive'],
              ];

              $availability_map = [
                'digital' => ['label' => 'Available in Digital File', 'class' => 'badge-digital'],
                'library' => ['label' => 'Available in NHCP', 'class' => 'badge-library'],
              ];
              ?>

              <?php if ($access && isset($access_map[$access])) : ?>
                <span class="access-badge <?php echo esc_attr($access_map[$access]['class']); ?>">
                  <?php echo esc_html($access_map[$access]['label']); ?>
                </span>
              <?php endif; ?>

              <?php if ($availability && isset($availability_map[$availability])) : ?>
                <span class="availability-badge <?php echo esc_attr($availability_map[$availability]['class']); ?>">
                  <?php echo esc_html($availability_map[$availability]['label']); ?>
                </span>
              <?php endif; ?>
            </div>

            <!-- TITLE -->
            <h5 class="mb-1">
              <a href="<?php the_permalink(); ?>" class="text-decoration-none fw-semibold text-white">
                <?php the_title(); ?>
              </a>
            </h5>
            <!-- META -->
 

          </div>
        </div>

      <?php endwhile; else : ?>

        <p>No artifacts found.</p>

      <?php endif; ?>
        </div>
    </div>

        <!-- RIGHT: SIDEBAR -->
        <div class="col-lg-3">

            <form method="get"
                action="<?php echo esc_url(get_post_type_archive_link('artifacts')); ?>"
                class="p-4">

                <div class="row g-4 border rounded mb-5">
                    <!-- Always target book -->
                    <input type="hidden" name="post_type" value="artifacts">

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

            <div class="sidebar_article text-white artifacts-sidebar">
                <?php get_template_part('partials/sidebar-welcome'); ?>
                <?php get_template_part('partials/sidebar-location-info'); ?>

            </div>

        </div>


    </div>
</div>
<script>
    jQuery(document).ready(function($){
    $('.form-select').select2();
    });
</script>
<?php get_footer(); ?>

<style>
</style>