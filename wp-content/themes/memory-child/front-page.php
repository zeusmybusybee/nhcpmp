<?php
get_header();

?>
<div id="primary">


  <div id="content" class="site-content">

    <?php
    /* ================================
 * Static background classes
 * ================================ */
    $background_keys = [
      'books',
      'artifacts',
      'heraldry',
      'sites',
      'towns',
      'av',
    ];
    ?>

    <?php if (have_rows('homepage_settings')) : ?>
      <?php while (have_rows('homepage_settings')) : the_row(); ?>

        <?php if (get_row_layout() === 'hero_banner') : ?>

          <section class="hero hero-banner ">
            <div class="container-fluid">
              <div class="row justify-content-center text-center">
                <div class="col-lg-9">

                  <?php if (get_sub_field('hero_logo_image')) : ?>
                    <div class="mb-3">
                      <img
                        src="<?php echo esc_url(get_sub_field('hero_logo_image')); ?>"
                        alt="<?php echo esc_attr(get_sub_field('hero_title')); ?>">
                    </div>
                  <?php endif; ?>

                  <?php if (get_sub_field('hero_title')) : ?>
                    <h1 class="mb-3 mt-0 fw-medium text-brown">
                      <?php the_sub_field('hero_title'); ?>
                    </h1>
                  <?php endif; ?>

                  <?php if (get_sub_field('hero_description')) : ?>
                    <p class="mb-4 text-muted mt-5 w-75 m-auto">
                      <?php the_sub_field('hero_description'); ?>
                    </p>
                  <?php endif; ?>

                  <form class="hero-search d-flex mx-auto mt-5">
                    <input
                      type="text"
                      class="hero-input"
                      placeholder="Search the National Memory Project">
                    <button type="submit" class="hero-btn">
                      Search
                    </button>
                  </form>

                  <div class="container mt-5">
                    <div class="scroll-wrapper d-flex align-items-center justify-content-center">
                      <div class="arrow-hover">
                        <div class="scroll-text">Scroll down</div>
                        <div class="icon">
                          <?php include get_stylesheet_directory() . '/assets/svg/triangle-down.svg'; ?>

                        </div>

                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </section>

        <?php endif; ?>


        <?php if (get_row_layout() === 'collection') : ?>
          <section class="collections">

            <?php
            $i = 0; // counter for static classes
            ?>

            <?php if (have_rows('collection_item')) : ?>
              <?php while (have_rows('collection_item')) : the_row(); ?>

                <?php
                $bg_class = $background_keys[$i] ?? 'books';
                $bg_img   = get_sub_field('background'); // IMAGE URL (ACF)

                $title = get_sub_field('title');
                $desc  = get_sub_field('description');
                $btn   = get_sub_field('button_link');

                $i++;
                ?>

                <div class="collection-card <?php echo esc_attr($bg_class); ?>"
                  style="background-image: url('<?php echo esc_url($bg_img); ?>');">

                  <div class="collection-content">
                    <?php if ($title) : ?>
                      <h2><?php echo esc_html($title); ?></h2>
                    <?php endif; ?>

                    <?php if ($desc) : ?>
                      <p><?php echo esc_html($desc); ?></p>
                    <?php endif; ?>

                    <?php if ($btn) : ?>
                      <a href="<?php echo esc_url($btn); ?>" class="btn">
                        Explore
                      </a>
                    <?php endif; ?>
                  </div>

                </div>

              <?php endwhile; ?>
            <?php endif; ?>

          </section>
        <?php endif; ?>





      <?php endwhile; ?>
    <?php endif; ?>
    <?php get_template_part('partials/featured-collection'); ?>



  </div>


</div><!-- #primary -->

<?php get_footer(); ?>