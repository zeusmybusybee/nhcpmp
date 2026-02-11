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
 div#content {
    background: #fff;
}
</style>
<div class="container single-overflow">
  <div class="row justify-content-between ">
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
                test
            </div>
           
    </div>
     <div>
                <h2 class="text-dark"><?php echo get_the_title(); ?></h2>
               <div class="post-content text-dark">
                    <?php the_content(); ?>
                </div>
            </div>
            <h2 class="mb-4 text-dark">Related Artifacts</h2>
            <div class="row g-4">

            <?php
            $args = [
                'post_type'      => 'foundation-of-towns',
                'posts_per_page' => 6, // 6 posts
                'post_status'    => 'publish',
                'orderby'        => 'date',
            ];

            $artifacts = new WP_Query($args);

            if ($artifacts->have_posts()) :
                while ($artifacts->have_posts()) : $artifacts->the_post(); ?>
                    <div class="col-md-10">
                    <div class=" h-100 d-flex">
                    <div class="col-4">
                        <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium', ['class' => 'card-img-top']); ?>
                        </a>
                        <?php endif; ?>
                    </div>
                    <div class="col-9">
                        <div class="card-body">
                        <div class="card-title">
                            <a href="<?php the_permalink(); ?>" class="text-decoration-none  text-dark">
                            <h3 class="mb-2 mt-0"><?php the_title(); ?></h3>
                                <?php echo wp_trim_words( get_the_content(), 40, '...' ); ?>
                                
                            </a>
                            <div>
                                <span>Category: Book</span></br>
                          
                            <span>Category: 
                                    <?php 
                                    $terms = get_the_terms(get_the_ID(), 'foundation-of-towns-category');
                                    if ($terms && !is_wp_error($terms)) {
                                        $term_names = wp_list_pluck($terms, 'name'); // gets all term names
                                        echo esc_html(implode(', ', $term_names)); // join with comma
                                    } else {
                                        echo 'Uncategorized';
                                    }

                                    ?>
                                    </span></br>
                                        <span>
                                    Year Founded: 
                                    <?php
                                    $year_founded = get_field('year_founded'); // ACF field
                                    if ($year_founded) {
                                        echo esc_html($year_founded);
                                    } else {
                                        echo 'N/A';
                                    }
                                    ?>
                                </span>
                            
                            </div>
                                 
                        </div>
                        </div>     
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

                        <!-- RIGHT: SIDEBAR -->
        <div class="col-lg-4">

            <form method="get"
                action="<?php echo esc_url(get_post_type_archive_link('foundation-of-towns')); ?>"
                class="p-4">

                <div class="row g-4 border rounded mb-5">
                    <!-- Always target foundation of town -->
                    <input type="hidden" name="post_type" value="foundation-of-towns">

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


                <div class="row g-4 border rounded p-4 bg-body-tertiary">

                    <!-- SORT BY -->
                    <div class="col-10">
                        <h6 class="mb-3 fw-bold">Sort by:</h6>

                        <?php $orderby = $_GET['orderby'] ?? ''; ?>
                        <div class="d-flex flex-wrap gap-4">
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
                    </div>

                      <div class="col-12 mt-4">
                    <h6 class="fw-bold text-dark">Filter by Time:</h6>

                    <div class="container p-3 text-light">

                        <!-- Era -->
                 <select name="era" class="form-select">
                        <!-- Unang placeholder option -->
                        <option value="">Era</option>

                        <?php
                        global $wpdb;

                        $results = $wpdb->get_col(
                            "SELECT meta_value
                            FROM $wpdb->postmeta
                            WHERE meta_key = 'era'"
                        );

                        $eras = [];

                        foreach ($results as $row) {
                            $values = maybe_unserialize($row);
                            if (is_array($values)) {
                                foreach ($values as $val) {
                                    $eras[] = $val;
                                }
                            } else {
                                $eras[] = $values;
                            }
                        }

                        $eras = array_unique($eras);
                        sort($eras);

                        foreach ($eras as $era) : ?>
                            <option value="<?php echo esc_attr($era); ?>">
                                <?php echo esc_html($era); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>


                        <!-- Year -->
                        <select name="year" class="form-select mt-2">
                            <option value="">Select Year</option>
                            <?php 
                            $years = $wpdb->get_col("
                                SELECT DISTINCT YEAR(post_date) 
                                FROM $wpdb->posts
                                WHERE post_type = 'foundation-of-towns'
                                AND post_status = 'publish'
                                ORDER BY post_date DESC
                            ");
                            foreach ($years as $year) : ?>
                                <option value="<?php echo esc_attr($year); ?>">
                                    <?php echo esc_html($year); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                    </div> <!-- /.container -->
                </div> <!-- /.col -->


                      <div class="col-12 mt-4">
                        <h6 class="fw-bold text-dark">Filter by place:</h6>

                        <div class="container p-3  text-light">
                          <select name="region" id="region" class="form-select">
                            <option value="">Select Region</option>
                        </select>
                           <select name="province" id="province" class="form-select mt-3" disabled>
                            <option value="">Select Province</option>
                        </select>
                          <select name="city" id="city" class="form-select mt-3" disabled>
                            <option value="">Select City/Municipality</option>
                        </select>

                        </div> <!-- ✅ ito yung kulang -->
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

            <div class="sidebar_article">
                <?php get_template_part('partials/sidebar-welcome'); ?>
                <?php get_template_part('partials/sidebar-location-info'); ?>

            </div>

        </div>
      
  </div>
</div>

