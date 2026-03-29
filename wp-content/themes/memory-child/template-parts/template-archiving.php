<?php
/* Template Name: Archiving */
get_header();
?>
<style>
    h2.books-title {
        font-size: 25px;
        margin: 15px 0;
    }

    .page-template-template-archiving {
        background-color: #F7F7F7;
    }

    .books-filter h5 {
        color: #704B10;
    }

    .books-filter div label {
        font-size: 18px;
        font-family: 'Ysabeau', sans-serif;
        color: #704B10;
    }

    .books-filter .form-check-input[type=radio] {
        border-radius: 62%;
        padding: 8px;
        border-color: #704B10;
        margin-right: 10px;
    }
</style>
<?php
$paged = get_query_var('paged') ? get_query_var('paged') : 1;

// GET TYPE FROM URL
$type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : '';

// DEFAULT POST TYPES (ALL)
$post_types = array(
    'item',
    'item_type',
    'sub-collection',
    'serial',
    'audio-visual',
    'book-manuscript',
    'academic-courseworks',
    'audio-recordings',
    'e-resources',
    'website'
);

// IF FILTERED → override
if (!empty($type) && in_array($type, $post_types)) {
    $post_types = array($type);
}

// BASE QUERY
$args = array(
    'post_type' => $post_types,
    'posts_per_page' => 10,
    'paged' => $paged,
);

if (!empty($_GET['level'])) {
    $args['meta_query'][] = array(
        'key' => 'level',
        'value' => sanitize_text_field($_GET['level']),
        'compare' => '='
    );
}

if (!empty($_GET['availability'])) {
    $args['meta_query'][] = array(
        'key' => 'availability',
        'value' => sanitize_text_field($_GET['availability']),
        'compare' => '='
    );
}

if (!empty($_GET['orderby'])) {
    switch ($_GET['orderby']) {
        case 'title-asc':
            $args['orderby'] = 'title';
            $args['order'] = 'ASC';
            break;
        case 'title-desc':
            $args['orderby'] = 'title';
            $args['order'] = 'DESC';
            break;
        case 'date-asc':
            $args['orderby'] = 'date';
            $args['order'] = 'ASC';
            break;
        case 'date-desc':
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
            break;
    }
}

$query = new WP_Query($args);
?>
<div class="container">

    <div class="row">

        <!-- LEFT: RESULTS -->
        <div class="col-lg-8 archive-left">

            <?php get_template_part('partials/total-result'); ?>
            <!-- Top Bar: Results Count & Pagination -->
            <!-- bottom Bar: Results Count & Pagination -->
            <div class="d-flex justify-content-between align-items-center mb-4 top-result">

                <!-- LEFT -->
                <?php get_template_part('partials/result-perpage'); ?>

                <!-- CENTER -->


                <!-- RIGHT -->
                <div class="pagination-nav">
                    <?php if ($query->max_num_pages > 1) :
                        $current = max(1, get_query_var('paged'));
                        $total = $query->max_num_pages;
                    ?>
                        <nav class="custom-pagination">
                            <div class="pagination-inner">

                                <!-- PREV -->
                                <div class="pagination-prev"
                                    style="display:inline-block;margin-right:10px;cursor:pointer;opacity: <?php echo $current <= 1 ? '0.5' : '1'; ?>;">
                                    <i class="fa-solid fa-angles-left"></i> prev
                                </div>

                                <!-- INPUT -->
                                <div class="pagination-info" style="display:inline-block;">
                                    Page
                                    <input type="number"
                                        class="custom-page-input"
                                        min="1"
                                        max="<?php echo $total; ?>"
                                        value="<?php echo $current; ?>"
                                        style="width:60px;text-align:center;">
                                    of <?php echo $total; ?>
                                </div>

                                <!-- NEXT -->
                                <div class="pagination-next"
                                    style="display:inline-block;margin-left:10px;cursor:pointer;opacity: <?php echo $current >= $total ? '0.5' : '1'; ?>;">
                                    next <i class="fa-solid fa-angles-right"></i>
                                </div>

                            </div>
                        </nav>
                    <?php endif; ?>
                </div>

            </div>
            <?php if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post(); ?>
                    <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                        <div class="d-flex gap-4 mb-4 book-post-item bg-body-tertiary rounded">

                            <!-- Thumbnail -->
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="flex-shrink-0 col-3 text-center">
                                    <?php the_post_thumbnail(
                                        'medium',
                                        ['class' => 'img-fluid rounded']
                                    ); ?>
                                </div>
                            <?php else : ?>
                                <img
                                    src=" <?php echo get_stylesheet_directory_uri(); ?>/assets/images/books-default.png"
                                    class="img-fluid d-block books-default-image"
                                    alt="Default Image">
                            <?php endif; ?>

                            <!-- DETAILS COLUMN -->
                            <div class="flex-grow-1 d-flex flex-column col-8">

                                <!-- BADGES -->
                                <div class="d-flex gap-2 mb-2 flex-wrap">
                                    <?php
                                    $access = get_field('level');
                                    $availability = get_field('availability');

                                    $access_map = [
                                        'level_1'      => ['label' => 'Level 1',    'class' => 'badge-open'],
                                        'level_2'   => ['label' => 'Level 2',        'class' => 'badge-viewing'],
                                        'level_3'   => ['label' => 'Level 3',        'class' => 'badge-limited'],
                                        'level_4' => ['label' => 'Level 4',      'class' => 'badge-exclusive'],
                                    ];

                                    $availability_map = [
                                        'digital' => ['label' => 'Available in Digital File', 'class' => 'badge-digital'],
                                        'library' => ['label' => 'Available in NHCP',         'class' => 'badge-library'],
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
                                <h2 class="books-title fw-semibold ">
                                    <?php the_title(); ?>
                                </h2>

                                <!-- CALL NUMBER -->
                                <?php if ($call_number = get_field('call_number')) : ?>
                                    <small class="text-muted fst-italic mb-2 d-block">
                                        Call Number: <?php echo esc_html($call_number); ?>
                                    </small>
                                <?php endif; ?>

                                <!-- DESCRIPTION -->
                                <p class="text-muted mb-3 books-content">
                                    <?php
                                    $excerpt = get_the_excerpt();

                                    if (! empty($excerpt)) {
                                        echo wp_trim_words($excerpt, 45);
                                    } else {
                                        echo 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.';
                                    }
                                    ?>
                                </p>

                                <!-- BOTTOM META -->
                                <div class="d-flex justify-content-between mt-auto text-muted small">
                                    <?php if ($location = get_field('location')) : ?>
                                        <span>Location: <?php echo esc_html($location); ?></span>
                                    <?php endif; ?>

                                    <span>Category: Book</span>
                                </div>

                            </div>
                        </div>
                    </a>

                <?php endwhile; ?>
            <?php else : ?>

                <div class="d-flex align-items-center mb-5 mt-4">

                    <div class="archive-no-results-icon col-3">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/404-img.png" alt="404">
                    </div>
                    <div class="col-9">
                        <h2>We're still gathering memories.</h2>

                        <p class="archive-subtext">
                            It looks like nothing was found at this location. Maybe try one of the links below or a search?
                        </p>

                        <a href="javascript:history.back()" class="archive-back">
                            Back to previous
                        </a>
                    </div>

                </div>

            <?php endif; ?>
            <?php wp_reset_postdata(); ?>

            <!-- bottom Bar: Results Count & Pagination -->
            <div class="d-flex justify-content-between align-items-center mb-4 top-result">

                <!-- LEFT -->
                <?php get_template_part('partials/result-perpage'); ?>

                <!-- CENTER -->
                <div class="text-center mt-5">
                    <a href="#top" class="back-to-top-text">Back to Top</a>
                </div>

                <!-- RIGHT -->
                <div class="pagination-nav">
                    <?php if ($query->max_num_pages > 1) :
                        $current = max(1, get_query_var('paged'));
                        $total = $query->max_num_pages;
                    ?>
                        <nav class="custom-pagination">
                            <div class="pagination-inner">

                                <!-- PREV -->
                                <div class="pagination-prev"
                                    style="display:inline-block;margin-right:10px;cursor:pointer;opacity: <?php echo $current <= 1 ? '0.5' : '1'; ?>;">
                                    <i class="fa-solid fa-angles-left"></i> prev
                                </div>

                                <!-- INPUT -->
                                <div class="pagination-info" style="display:inline-block;">
                                    Page
                                    <input type="number"
                                        class="custom-page-input"
                                        min="1"
                                        max="<?php echo $total; ?>"
                                        value="<?php echo $current; ?>"
                                        style="width:60px;text-align:center;">
                                    of <?php echo $total; ?>
                                </div>

                                <!-- NEXT -->
                                <div class="pagination-next"
                                    style="display:inline-block;margin-left:10px;cursor:pointer;opacity: <?php echo $current >= $total ? '0.5' : '1'; ?>;">
                                    next <i class="fa-solid fa-angles-right"></i>
                                </div>

                            </div>
                        </nav>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <div class="col-lg-4 archive-right-col archive-right">

            <?php
            // $search_action = is_post_type_archive('book') ? get_post_type_archive_link('book') : home_url('/');
            ?>

            <form method="get"
                id="searchForm"
                action="<?php echo esc_url(home_url('/archiving/')); ?>"
                class="p-4">

                <div class="row g-4 border rounded mb-5">

                    <div class="input-group" style="margin-top:0;">

                        <input
                            type="search"
                            class="form-control border-0"
                            name="s"
                            placeholder="Search..."
                            value="<?php echo esc_attr(get_search_query()); ?>">

                        <select name="search_type" id="search_type" class="form-select border-0" style="max-width:200px;">
                            <option value="">-Select-</option>
                            <option value="items">Item</option>
                            <option value="item_types">Item Type</option>
                            <option value="sub_collections">Sub Collection</option>
                            <option value="serial">Serial</option>
                            <option value="audio-visuals">Audio-Visual</option>
                            <option value="books-manuscripts">Book (Manuscript)</option>
                            <option value="academic-coursework">Academic Courseworks</option>
                            <option value="audio-recording">Audio Recordings</option>
                            <option value="e-resource">E-Resources</option>
                            <option value="websites">Website</option>
                        </select>

                        <button class="button" type="submit">
                            <i class="fas fa-search"></i>
                        </button>

                    </div>

                </div>


                <div class="row g-4 border rounded p-4 bg-body-tertiary">

                    <!-- FILTER BY -->
                    <div class="col-6 books-filter">
                        <h5 class="mb-3 fw-bold ">Filter by:</h5>

                        <?php $filter = $_GET['filter'] ?? ''; ?>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="filter" value="title"
                                <?php checked($filter, 'title'); ?>>
                            <label class="form-check-label">Title</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="filter" value="author"
                                <?php checked($filter, 'author'); ?>>
                            <label class="form-check-label">Author</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="filter" value="publisher"
                                <?php checked($filter, 'publisher'); ?>>
                            <label class="form-check-label">Publisher</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="filter" value="keyword"
                                <?php checked($filter, 'keyword'); ?>>
                            <label class="form-check-label">Subject / Keyword</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="filter" value="year"
                                <?php checked($filter, 'year'); ?>>
                            <label class="form-check-label">Year</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="filter" value="isbn"
                                <?php checked($filter, 'isbn'); ?>>
                            <label class="form-check-label">ISBN / ISSN</label>
                        </div>
                    </div>

                    <!-- SORT BY -->
                    <div class="col-6 books-filter">
                        <h5 class="mb-3 fw-bold ">Sort by:</h5>

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
                    <div class="col-6 mt-4 books-filter">
                        <h5 class="mb-3 fw-bold">Level of Access</h5>

                        <?php $access = $_GET['level'] ?? ''; ?>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="level" value="level_1"
                                <?php checked($access, 'level_1'); ?>>
                            <label class="form-check-label">Level 1</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="level" value="level_2"
                                <?php checked($access, 'level_2'); ?>>
                            <label class="form-check-label">Level 2</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="level" value="level_3"
                                <?php checked($access, 'level_3'); ?>>
                            <label class="form-check-label">Level 3</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="level" value="level_4"
                                <?php checked($access, 'level_4'); ?>>
                            <label class="form-check-label">Level 4</label>
                        </div>
                    </div>

                    <!-- AVAILABILITY -->
                    <div class="col-6 mt-4 books-filter">
                        <h5 class="mb-3 fw-bold ">Availability:</h5>

                        <?php $availability = $_GET['availability'] ?? ''; ?>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="availability" value="digital"
                                <?php checked($availability, 'digital'); ?>>
                            <label class="form-check-label">Digital File</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="availability" value="library"
                                <?php checked($availability, 'library'); ?>>
                            <label class="form-check-label">NHCP Library</label>
                        </div>
                    </div>

                    <!-- APPLY BUTTON -->
                    <div class="col-12 mt-4">
                        <button type="submit"
                            class="btn w-100 fw-bold archive-filter-btn"
                            style="background-color:#6b4a1f;color:white;">
                            Search
                        </button>
                    </div>

                </div>





            </form>

            <div class="sidebar_article archive-hide">
                <?php get_template_part('partials/sidebar-welcome'); ?>
                <?php get_template_part('partials/sidebar-location-info'); ?>

            </div>

        </div>


    </div>
</div>
<script>
    document.getElementById('searchForm').addEventListener('submit', function(e) {

        let type = document.getElementById('search_type').value;
        let baseUrl = "<?php echo home_url(); ?>";

        if (type === 'items') {
            this.action = baseUrl + '/items/';
        } else if (type === 'item_types') {
            this.action = baseUrl + '/item-types/';
        } else if (type === 'sub_collections') {
            this.action = baseUrl + '/sub-collections/';
        } else if (type === 'serial') {
            this.action = baseUrl + '/serial/';
        } else if (type === 'audio-visuals') {
            this.action = baseUrl + '/audio-visuals/';
        } else if (type === 'books-manuscripts') {
            this.action = baseUrl + '/books-manuscripts/';
        } else if (type === 'academic-coursework') {
            this.action = baseUrl + '/academic-coursework/';
        } else if (type === 'audio-recording') {
            this.action = baseUrl + '/audio-recording/';
        } else if (type === 'e-resource') {
            this.action = baseUrl + '/e-resource/';
        } else if (type === 'websites') {
            this.action = baseUrl + '/websites/';
        } else {
            this.action = baseUrl + '/archiving/';
        }

    });
</script>
<script>
    (function($) {

        function goToPage(page, maxPages) {
            if (page < 1) page = 1;
            if (page > maxPages) page = maxPages;

            var url = new URL(window.location.href);
            url.searchParams.set('paged', page);
            window.location.href = url.toString();
        }

        $(document).on('click', '.pagination-prev', function() {
            var input = $(this).closest('.pagination-inner').find('.custom-page-input');
            var currentPage = parseInt(input.val()) || 1;
            var maxPages = parseInt(input.attr('max'));
            if (currentPage > 1) goToPage(currentPage - 1, maxPages);
        });

        $(document).on('click', '.pagination-next', function() {
            var input = $(this).closest('.pagination-inner').find('.custom-page-input');
            var currentPage = parseInt(input.val()) || 1;
            var maxPages = parseInt(input.attr('max'));
            if (currentPage < maxPages) goToPage(currentPage + 1, maxPages);
        });

        $(document).on('change', '.custom-page-input', function() {
            var page = parseInt($(this).val());
            var maxPages = parseInt($(this).attr('max'));
            if (!isNaN(page)) goToPage(page, maxPages);
        });

    })(jQuery);
</script>
<?php get_footer(); ?>