<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Memory
 */

get_header();
?>
<style>
.custom-tabs {
  border-bottom: none;
}

.custom-tabs .nav-link {
  background-color: #6b4a1e; /* brown */
  color: #fff;
  border: 1px solid #fff;
  border-radius: 0;
  padding: 15px 10px;
  text-align: center;
  width: 100%;
}

.custom-tabs .nav-link:hover {
  background-color: #5a3e18;
}

.custom-tabs .nav-link.active {
  background-color: #8b5e2b;
  color: #fff;
  border-color: #fff;
}

</style>
        <!-- custom content -->
            <?php if ( have_rows('pages_section') ) : ?>
    <?php while ( have_rows('pages_section') ) : the_row(); ?>

        <?php if ( get_row_layout() === 'two_column_with_images' ) : ?>

            <section class="py-5">
                <div class="container">
                    <div class="row align-items-center">

                        <!-- TEXT COLUMN -->
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <div class="text-muted">
                                <?php the_sub_field('content'); ?>
                            </div>
                        </div>

                        <!-- IMAGE COLUMN -->
                        <div class="col-lg-6 text-center">
                            <?php 
                                $thumbnail_url = get_sub_field('thumbnails');
                                if ( $thumbnail_url ) :
                            ?>
                                <img 
                                    src="<?php echo esc_url($thumbnail_url); ?>"
                                    alt=""
                                    class="img-fluid"
                                >
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </section>

        <?php endif; ?>

           <?php if ( get_row_layout() === 'tabs' ) : ?>

            <section class="custom-tab">
                <div class="container my-5">

                    <!-- TAB NAV -->
                    <ul class="nav nav-tabs custom-tabs" role="tablist">
                        <?php if ( have_rows('tabs_item') ) : ?>
                            <?php $i = 0; ?>
                            <?php while ( have_rows('tabs_item') ) : the_row(); ?>
                                <li class="nav-item flex-fill" role="presentation">
                                    <button
                                        class="nav-link <?php echo $i === 0 ? 'active' : ''; ?>"
                                        data-bs-toggle="tab"
                                        data-bs-target="#tab-<?php echo $i; ?>"
                                        type="button"
                                        role="tab"
                                    >
                                        <?php the_sub_field('title'); ?>
                                    </button>
                                </li>
                                <?php $i++; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </ul>

                    <!-- TAB CONTENT -->
                        <div class="container">
                    <div class="tab-content pt-4">
                  
                        <?php if ( have_rows('tabs_item') ) : ?>
                            <?php $i = 0; ?>
                            <?php while ( have_rows('tabs_item') ) : the_row(); ?>
                                <div
                                    class="tab-pane fade <?php echo $i === 0 ? 'show active' : ''; ?>"
                                    id="tab-<?php echo $i; ?>"
                                    role="tabpanel"
                                >
                                    <?php the_sub_field('content'); ?>
                                </div>
                                <?php $i++; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                      </div>
                    </div>

                </div>
            </section>

        <?php endif; ?>

    <?php endwhile; ?>
<?php endif; ?>


<?php
get_footer();
