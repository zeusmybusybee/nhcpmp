<?php get_header(); ?>

<div class="container my-5">

    <div class="row">

        <!-- LEFT: RESULTS -->
        <div class="col-lg-8">
            <div class="row g-4">
                <?php while (have_posts()) : the_post(); ?>
                    <div class="col-lg-4 col-md-6">

                        <div class="card h-100 border-0 shadow-sm text-center p-4">

                            <!-- Thumbnail -->
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="mb-3">
                                    <?php the_post_thumbnail(
                                        'medium',
                                        ['class' => 'img-fluid mx-auto d-block']
                                    ); ?>
                                </div>
                            <?php endif; ?>

                            <!-- TITLE -->
                            <h6 class="fw-semibold mb-2">
                                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                    <?php the_title(); ?>
                                </a>
                            </h6>

                            <!-- META -->
                            <div class="text-muted small mt-auto">
                                <?php if ($location = get_field('location')) : ?>
                                    <div>Location: <?php echo esc_html($location); ?></div>
                                <?php endif; ?>
                                <div>Category: Book</div>
                            </div>

                        </div>

                    </div>
                <?php endwhile; ?>
            </div>
        </div>



        <!-- RIGHT: SIDEBAR -->
        <div class="col-lg-4">

            <form method="get"
                action="<?php echo esc_url(get_post_type_archive_link('book')); ?>"
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


                <div class="row g-4 border rounded p-4 bg-body-tertiary">

                    <!-- LEFT COLUMN -->
                    <div class="col-6">
                        <h6 class="section-title">Heraldic Items:</h6>

                        <label class="circle-option">
                            <input type="radio" name="heraldic_items">
                            <span></span> Medals & Ribbons
                        </label>

                        <label class="circle-option">
                            <input type="radio" name="heraldic_items">
                            <span></span> Pins
                        </label>

                        <label class="circle-option">
                            <input type="radio" name="heraldic_items">
                            <span></span> Trophies
                        </label>

                        <label class="circle-option">
                            <input type="radio" name="heraldic_items">
                            <span></span> Souvenirs
                        </label>

                        <label class="circle-option">
                            <input type="radio" name="heraldic_items">
                            <span></span> Others
                        </label>
                    </div>

                    <!-- RIGHT COLUMN -->
                    <div class="col-6">
                        <h6 class="section-title">Sort by:</h6>

                        <label class="circle-option">
                            <input type="radio" name="sort_by">
                            <span></span> Most relevant
                        </label>

                        <label class="circle-option">
                            <input type="radio" name="sort_by">
                            <span></span> A–Z
                        </label>

                        <label class="circle-option">
                            <input type="radio" name="sort_by">
                            <span></span> Z–A
                        </label>

                        <label class="circle-option">
                            <input type="radio" name="sort_by">
                            <span></span> Newest
                        </label>

                        <label class="circle-option">
                            <input type="radio" name="sort_by">
                            <span></span> Oldest
                        </label>
                    </div>

                    <!-- SEALS / LOGOS -->
                    <div class="col-12 mt-4">
                        <h6 class="section-title">Seals/Logos</h6>

                        <label class="circle-option">
                            <input type="radio" name="seals_logos">
                            <span></span> Judiciary/Legislative
                        </label>

                        <label class="circle-option">
                            <input type="radio" name="seals_logos">
                            <span></span> National Government Agencies (NGA)
                        </label>

                        <label class="circle-option">
                            <input type="radio" name="seals_logos">
                            <span></span> Local Government Unit (LGU)
                        </label>

                        <label class="circle-option">
                            <input type="radio" name="seals_logos">
                            <span></span> Government-Owned Controlled Corporation
                        </label>

                        <label class="circle-option">
                            <input type="radio" name="seals_logos">
                            <span></span> Military
                        </label>

                        <label class="circle-option">
                            <input type="radio" name="seals_logos">
                            <span></span> State Universities and Colleges (SUC)
                        </label>

                        <label class="circle-option">
                            <input type="radio" name="seals_logos">
                            <span></span> Others
                        </label>
                    </div>

                    <!-- FILTER BY DROPDOWNS -->
                    <div class="col-12 mt-4">
                        <h6 class="section-title">Filter by:</h6>

                        <select class="filter-select">
                            <option selected disabled>Region</option>
                        </select>

                        <select class="filter-select mt-2">
                            <option selected disabled>Province</option>
                        </select>
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

<?php get_footer(); ?>

<style>
</style>