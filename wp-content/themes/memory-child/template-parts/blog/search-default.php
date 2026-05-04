<?php get_header(); ?>
<style>
    .search-results {
        background: #F7F7F7;
    }

    .search-item h4 {
        font-size: 30px;
        color: #8b5e3c !important;
        margin: 10px 0 25px;
    }

    .c_meduim {
        font-size: 18px;
        margin-right: 19px;
    }

    .pagination .current,
    .pagination a:hover {
        background: #8b5e3c;
        color: #fff;
        border-radius: 100%;
    }

    .see-more {
        font-size: 17px;
        color: #3ec562;
    }

    .see-more-show-item p {
        font-size: 18px;
    }

    .view-btn-search {
        display: flex;
        font-family: 'Poppins';
        align-items: center;
        justify-content: center;
        max-width: 200px;
        width: 100%;
        height: 40px;
        font-size: 18px;
        background-color: #3ec562;
        color: #ffffff !important;
        border: none;
        border-radius: 10px;
        transition: 0.3s ease-in;
        margin: 20px 0;
        text-decoration: none;
    }

    .btn-primary {
        color: #fff !important;
    }

    .btn-primary:hover,
    .btn-primary:active,
    .btn-primary:focus {

        background: var(--main-color) !important;
    }
</style>




<section class="py-5"> <!-- Nagdagdag ng padding top/bottom -->
    <div class="container">
        <div class="row">
            <div class="col-12">

                <!-- Header Section -->
                <div class="search-header mb-4 pb-3 border-bottom">
                    <h2>Search Results for: <?php echo get_search_query(); ?></h2>

                    <?php
                    $s = get_search_query();
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                    $allsearch = new WP_Query(array(
                        's' => $s,
                        'post_type' => 'any',
                        'posts_per_page' => 10,
                        'paged' => $paged
                    ));

                    $total_posts = $allsearch->found_posts;
                    echo "<p class='text-muted'>Total results found: <span class='badge bg-secondary'>{$total_posts}</span></p>";
                    ?>
                </div>

                <!-- Body Section -->
                <div class="search-body">
                    <?php if ($allsearch->have_posts()): ?>
                        <div class="row g-4"> <!-- Bootstrap Grid with gap -->
                            <?php
                            while ($allsearch->have_posts()): $allsearch->the_post();

                                // Sanitize GET parameters
                                $searched = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
                                $filter = isset($_GET['f']) ? sanitize_text_field($_GET['f']) : '';

                                // Wrapper para sa bawat result para maging responsive (col-md-6 o col-12)
                                echo '<div class="col-12">';

                                if ($filter) {
                                    if ($filter === "Publisher" && str_contains(strtolower(get_field('publisher')), strtolower($searched))) {
                                        include 'your-publisher-template.php';
                                    } elseif ($filter === "Title" && str_contains(strtolower(get_the_title()), strtolower($searched))) {
                                        include 'your-title-template.php';
                                    } elseif ($filter === "Subject" && (str_contains(strtolower(get_field('access_point_tropical')), strtolower($searched)))) {
                                        include 'your-subject-template.php';
                                    } elseif ($filter === "Creator" && (str_contains(strtolower(get_field('creator')), strtolower($searched)))) {
                                        include 'your-creator-template.php';
                                    } else {
                                        get_template_part('partials/content', 'search');
                                    }
                                } else {
                                    get_template_part('partials/content', 'search');
                                }

                                echo '</div>'; // Close col-12
                            endwhile;
                            ?>
                        </div>

                        <!-- Pagination Section -->
                        <div class="mt-5 d-flex justify-content-center">
                            <nav aria-label="Search results pages">
                                <?php
                                // Siguraduhin na ang function na ito ay nag-ooutput ng Bootstrap compatible na HTML
                                custom_numeric_posts_nav($allsearch);
                                ?>
                            </nav>
                        </div>

                    <?php else: ?>
                        <div class="alert alert-info py-5 text-center">
                            <?php get_template_part('partials/content', 'none'); ?>
                        </div>
                    <?php endif;
                    wp_reset_postdata(); ?>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Tinanggal ang inline <style> dahil mas mainam gamitin ang Bootstrap classes -->
<style>
    /* Custom tweak para sa pagination kung ang function mo ay hindi default bootstrap */
    .navigation ul {
        display: flex;
        list-style: none;
        gap: 10px;
        padding-left: 0;
    }

    .navigation ul li a {
        text-decoration: none;
        color: #232426;
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        padding: 8px 16px;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .navigation ul li.active a,
    .navigation ul li a:hover {
        background-color: #2f78cf;
        color: white;
        border-color: #2f78cf;
    }
</style>

<style>
    .open {
        margin-top: 10px;
        margin-bottom: 10px;
        background: #eee;
        padding: 10px;
        cursor: pointer;
        font-size: 16px;
        color: #000000;
        text-align: center;
        transition: .3s ease;
        font-family: 'Poppins';
    }

    .open:hover {
        transition: .3s ease;
        background: #2f78cf;
        color: #fff;
    }

    .search-result__info--row {
        display: flex;
        justify-content: space-between;
        gap: 30px;
        border-bottom: 1px solid #eee;
    }

    .search-result__info--desc {
        flex-basis: 50%;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .search-result__info--desc p {
        margin: 0;
    }

    .reveal {
        display: none;
    }

    .reveal.is-active {
        display: block;
    }

    .search-result__cover--btn {
        max-width: 100%;
        font-size: 14px;
        line-height: 1.2;
        text-align: center;

    }

    .search-result__cover--btn a {
        display: flex;
        align-items: center;
        justify-content: center;
        max-width: 200px;
        width: 100%;
        height: 50px;
        font-size: 18px;
        background-color: #3ec562;
        color: #ffffff;
        border: none;
        border-radius: 10px;
        transition: 0.3s ease-in;
        margin: 20px auto;

    }

    .search-result__cover--btn ._df_button {
        display: flex;
        font-family: 'Poppins';
        align-items: center;
        justify-content: center;
        max-width: 200px;
        width: 100%;
        height: 50px;
        font-size: 18px;
        background-color: #3ec562;
        color: #ffffff;
        border: none;
        border-radius: 10px;
        transition: 0.3s ease-in;
        margin: 20px auto;

    }

    .searchresults {
        text-align: center;
    }
</style>

<script>
    var $ = jQuery;
    $('.open').click(function(e) {
        e.preventDefault();
        var currentIsActive = $(this).hasClass('is-active');
        $(this).parent('.search-result__info--body').find('> *').removeClass('is-active');
        if (currentIsActive != 1) {
            $(this).addClass('is-active');
            $(this).next('.reveal').addClass('is-active');
        }
    });
</script>

<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>-->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->

<style>
    .modal-footer button {
        background: #2f78cf;
        background-color: #2f78cf;
        color: #fff;
        padding: 6px 12px;
        border-color: #2f78cf;
        border-top: none;
    }

    .modal-footer button:hover,
    .modal-footer button:active,
    .modal-footer button:focus {
        background: #97c9ec !important;
        background-color: #97c9ec !important;
        border-color: #97c9ec !important;
        border-top: none;
    }
</style>

<div class="container">
    <!-- Modal -->
    <div class="modal modal-lg fade" id="myModal" role="dialog" style="width: 100%; padding-right: 0!important;">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <iframe src="<?php echo site_url('/login-employee'); ?>" style="width: 100%; height: 500px" scrolling="no"></iframe>
                    <!--<?php wp_login_form(); ?>-->
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>-->
                    <button type="button" class="btn btn-default" onClick="refreshPage()">Ok</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#myModal').modal({
        backdrop: 'static',
        keyboard: true,
        show: false
    });

    function refreshPage() {
        window.location.reload();
    }
</script>
<?php get_footer(); ?>