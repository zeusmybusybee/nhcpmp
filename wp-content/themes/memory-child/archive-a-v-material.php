<?php get_header(); ?>
<style>
    div#content {
        background: #000;
    }

    input::placeholder {
        color: #fff !important;
    }

    input.form-control.border-0 {
        color: #fff;
    }

    .button {
        color: #fff !important;
    }
</style>

<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <?php $is_search = isset($_GET['s']) && ! empty($_GET['s']); ?>
            <?php if ($is_search) : ?>

                <?php
                $search_query = new WP_Query([
                    'post_type'      => 'a-v-material',
                    'posts_per_page' => 12,
                    's'              => sanitize_text_field($_GET['s']),
                ]);
                ?>

                <?php if ($search_query->have_posts()) : ?>

                    <h3 class="text-white mb-4">
                        Search results for "<?php echo esc_html($_GET['s']); ?>"
                    </h3>

                    <div class="row g-4 mb-5">
                        <?php while ($search_query->have_posts()) : $search_query->the_post(); ?>

                            <div class="col-12 col-md-4">
                                <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                    <div class="card bg-darken border-0 h-100">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium_large', [
                                                'class' => 'card-img-top object-fit-cover'
                                            ]); ?>
                                        <?php endif; ?>
                                        <div class="card-body bg-darken p-2">
                                            <h2 class="card-title text-white mb-0">
                                                <?php the_title(); ?>
                                            </h2>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        <?php endwhile; ?>
                    </div>

                <?php else : ?>
                    <p class="text-white">No results found.</p>
                <?php endif; ?>

                <?php wp_reset_postdata(); ?>

            <?php else : ?>

                <?php
                $categories = get_categories([
                    'hide_empty' => true,
                ]);

                foreach ($categories as $category) :

                    $args = [
                        'post_type'      => get_post_type(),
                        'posts_per_page' => 6,
                        'cat'            => $category->term_id,
                    ];

                    $query = new WP_Query($args);

                    if ($query->have_posts()) :
                ?>
                        <!-- CATEGORY HEADER -->
                        <div class="d-flex align-items-center justify-content-between mb-3 text-white">
                            <h3 class="mb-0" style="color:#fff;">
                                <?php echo esc_html($category->name); ?>
                            </h3>

                            <div class="d-flex align-items-center gap-2">
                                <small>
                                    Top <?php echo esc_html($query->post_count); ?> results for
                                    <?php echo esc_html($category->name); ?>
                                </small>

                                <select class="form-select form-select-sm" style="width:auto;">
                                    <option selected>10</option>
                                    <option>25</option>
                                    <option>50</option>
                                </select>
                            </div>
                        </div>

                        <!-- POSTS GRID -->
                        <div class="row g-4 mb-5">

                            <?php while ($query->have_posts()) : $query->the_post(); ?>

                                <div class="col-12 col-md-4">
                                    <a href="<?php the_permalink(); ?>" class="text-decoration-none">

                                        <div class="card bg-darken border-0 h-100">

                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php the_post_thumbnail('medium_large', [
                                                    'class' => 'card-img-top object-fit-cover'
                                                ]); ?>
                                            <?php endif; ?>

                                            <div class="card-body bg-darken p-2">
                                                <h2 class="card-title text-white mb-0 texting_title">
                                                    <?php the_title(); ?>
                                                </h2>
                                            </div>

                                        </div>
                                    </a>
                                </div>

                            <?php endwhile; ?>

                        </div>

                <?php
                    endif;
                    wp_reset_postdata();
                endforeach;
                ?>

            <?php endif; ?>
        </div>


        <div class="col-md-4">
            <form method="get"
                action="<?php echo esc_url(get_post_type_archive_link('a-v-material')); ?>"
                class="p-4">

                <div class="row g-4 border rounded mb-5">
                    <!-- Always target Articles -->
                    <input type="hidden" name="post_type" value="a-v-material">

                    <!-- SEARCH (only one) -->
                    <div class="input-group" style="margin-top:0;">
                        <input
                            type="search"
                            class="form-control border-0"
                            name="s"
                            placeholder="Search articles..."
                            value="<?php echo esc_attr($_GET['s'] ?? ''); ?>">
                        <button class="button" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>


                <div class="row g-4 d-flex justify-content-center">
                    <div class="p-4 rounded"
                        style="background-color:#3f3f3f; width:480px; color:#e0e0e0;">

                        <div class="row">
                            <!-- FILTER BY -->
                            <div class="col-6">
                                <p class="fw-semibold mb-3">Filter by:</p>

                                <?php $current_filters = $_GET['filter'] ?? []; ?>

                                <?php
                                $filters = [
                                    'title'     => 'Title',
                                    'author'    => 'Author',
                                    'publisher' => 'Publisher',
                                    'keyword'   => 'Subject/Keyword',
                                    'year'      => 'Year',
                                ];

                                foreach ($filters as $value => $label) :
                                ?>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input"
                                            type="checkbox"
                                            name="filter[]"
                                            value="<?= esc_attr($value); ?>"
                                            <?= in_array($value, $current_filters) ? 'checked' : ''; ?>>
                                        <label class="form-check-label"><?= esc_html($label); ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- SORT BY -->
                            <div class="col-6">
                                <p class="fw-semibold mb-3">Sort by:</p>

                                <?php $current_order = $_GET['orderby'] ?? []; ?>

                                <?php
                                $sorts = [
                                    'relevance' => 'Most relevant',
                                    'az'        => 'A–Z',
                                    'za'        => 'Z–A',
                                    'newest'    => 'Newest',
                                    'oldest'    => 'Oldest',
                                ];

                                foreach ($sorts as $value => $label) :
                                ?>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input"
                                            type="checkbox"
                                            name="orderby[]"
                                            value="<?= esc_attr($value); ?>"
                                            <?= in_array($value, $current_order) ? 'checked' : ''; ?>>
                                        <label class="form-check-label"><?= esc_html($label); ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <button type="submit"
                                class="btn px-5 fw-semibold"
                                style="background-color:#7a4f1d; color:#fff;">
                                Apply Filters
                            </button>
                        </div>
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

<style>
    h2.nm-sidebar-title,
    .nm-sidebar-content,
    .nm-sidebar-card p,
    .nm-sidebar-card a
     {
        color: #fff;
    }
    .nm-sidebar-card {
        background: #3f3f3f!important;
        border:none!important;
    }
    .nm-sidebar-icon {
        background: #fff!important;
    }
    .nm-sidebar-icon i {
        color: #000!important;
    }
</style>

<?php get_footer(); ?>