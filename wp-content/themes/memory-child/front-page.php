<?php
get_header(); 

?>
<style>

.hero {
    padding: 7rem 2rem 13rem;
}
section.hero h1 {
    color: #6b4a1e;
    font-weight: 400 !important;
    font-size: 48px;
}
.hero-search {
  max-width: 900px;
  border: 1px solid #c9b9a6;
  border-radius: 6px;
  overflow: hidden;
}
section.hero img {
    width: 100%;
    height: auto;
    max-width: 159px;
     filter: sepia(100%) saturate(300%) brightness(70%) hue-rotate(-15deg);
}
.hero-search .hero-input {
  flex: 1;
  border: none;
  padding: 18px 24px;
  font-size: 18px;
  outline: none;
  color: #555;
  padding: 16px 10px 14px;
}

.hero-input::placeholder {
  color: #bfbfbf;
  font-style: italic;
}

form.hero-search .hero-btn {
  background-color: #6b4a1e; /* brown */
  color: #fff;
  border: none;
  padding: 0 32px;
  font-size: 18px;
  font-weight: 600;
  cursor: pointer;
}

.hero-btn:hover {
  background-color: #5a3e18;
}


.scroll-wrapper {
    background: #f8f9fa;
    position: absolute;
       bottom: -108px;
    left: 50%;
    transform: translateX(-50%);
}

.arrow-hover {
  position: relative;
  cursor: pointer;
  color: #dc3545;
}

.scroll-text {
  position: absolute;
  bottom: 75%;          /* nasa taas ng arrow */
  left: 50%;
  transform: translateX(-50%) translateY(5px);
  opacity: 0;
  font-size: 14px;
  white-space: nowrap;
  transition: opacity 0.3s ease, transform 0.3s ease;
  font-size: 18px;
    font-weight: 400;
}

/* hover sa arrow */
.arrow-hover:hover .scroll-text {
  opacity: 1;
  transform: translateX(-50%) translateY(-5px);
}

.scroll-wrapper i.fa-solid {
    font-size: 60px;
    color: #6b4a1e;
}

/* featured collection */
.card {
    background: #f2f2f2;
    border-radius: 8px;
    padding: 7rem 3rem 2rem;
    position: relative;
    overflow: hidden;
}
.card::before {
    content: "";
    height: 50px;
    width: 100%;
    position: absolute;
    top: 0;
    left: 0;
}
.collections-grid img {
    width: 100%;
    margin: auto;
    max-width: 62px;
    position: absolute;
    top: -10px;
    filter: brightness(0) invert(1);
}

.featured-collections {
    /* padding: 1.5rem 1rem; */
    padding: 10rem 2rem;
}
section.featured-collections h2 {
    margin-bottom: 50px;
}
</style>
<div id="primary" >


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

<?php if ( have_rows('homepage_settings') ) : ?>
  <?php while ( have_rows('homepage_settings') ) : the_row(); ?>

  <?php if ( get_row_layout() === 'hero_banner' ) : ?>

      <section class="hero">
        <div class="container-fluid">
          <div class="row justify-content-center text-center">
            <div class="col-lg-8">

              <?php if ( get_sub_field('hero_logo_image') ) : ?>
                <div class="mb-3">
                  <img 
                    src="<?php echo esc_url( get_sub_field('hero_logo_image') ); ?>" 
                    alt="<?php echo esc_attr( get_sub_field('hero_title') ); ?>">
                </div>
              <?php endif; ?>

              <?php if ( get_sub_field('hero_title') ) : ?>
                <h1 class="mb-3 mt-0 fw-medium text-brown">
                  <?php the_sub_field('hero_title'); ?>
                </h1>
              <?php endif; ?>

              <?php if ( get_sub_field('hero_description') ) : ?>
                <p class="mb-4 text-muted mt-5 w-75 m-auto">
                  <?php the_sub_field('hero_description'); ?>
                </p>
              <?php endif; ?>

              <form class="hero-search d-flex mx-auto mt-5">
                <input
                  type="text"
                  class="hero-input"
                  placeholder="Search the National Memory Project"
                >
                <button type="submit" class="hero-btn">
                  Search
                </button>
              </form>

              <div class="container mt-5">
                <div class="scroll-wrapper d-flex align-items-center justify-content-center">
                  <div class="arrow-hover">
                    <div class="scroll-text">Scroll down</div>
                    <i class="fa-solid fa-caret-down"></i>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </section>

    <?php endif; ?>


    <?php if ( get_row_layout() === 'collection' ) : ?>
      <section class="collections">

        <?php
          $i = 0; // counter for static classes
        ?>

        <?php if ( have_rows('collection_item') ) : ?>
          <?php while ( have_rows('collection_item') ) : the_row(); ?>

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
                <?php if ( $title ) : ?>
                  <h2><?php echo esc_html($title); ?></h2>
                <?php endif; ?>

                <?php if ( $desc ) : ?>
                  <p><?php echo esc_html($desc); ?></p>
                <?php endif; ?>

                <?php if ( $btn ) : ?>
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


    
    <?php if (get_row_layout() === 'featured_collections') : ?>
      <section class="featured-collections">
        <div class="container">
          <h2 class="mt-0">Featured Collections</h2>

          <div class="collections-grid mt-5">

            <?php if (have_rows('featured_collections_item')) : ?>

              <?php
              $classes = [
                'navy',
                'red',
                'purple',
                'green',
                'teal',
                'orange',
                'darkgreen',
                'gold'
              ];
              $i = 0;
              ?>

              <?php while (have_rows('featured_collections_item')) : the_row(); 
                $title = get_sub_field('title');
                $description = get_sub_field('description');
                $card_class = $classes[$i] ?? 'navy';
              ?>

                <article class="card <?php echo esc_attr($card_class); ?>">
                  <img 
                    src="http://localhost/nhcpmp/wp-content/uploads/2026/02/about-1.png" 
                    alt="Featured Collection">

                  <?php if ($title) : ?>
                    <h3><?php echo esc_html($title); ?></h3>
                  <?php endif; ?>

                  <?php if ($description) : ?>
                    <p><?php echo esc_html($description); ?></p>
                  <?php endif; ?>
                </article>

              <?php 
                $i++;
              endwhile; ?>

            <?php endif; ?>

          </div>
        </div>
      </section>
    <?php endif; ?>


  <?php endwhile; ?>
<?php endif; ?>





    </div>


</div><!-- #primary -->

<?php get_footer(); ?>