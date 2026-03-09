<?php
get_header();
?>


<style>
    .book-img {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
    }

    div#content {
        background: #fff;
        margin: 2rem 0 6rem;
    }

    .meta-item {
        border-bottom: 1px dotted #999;
        padding: 10px 0;
    }

    .meta-label {
        font-weight: 600;
        color: #444;
    }

    .highlight {
        background: #8fb1d1;
        padding: 3px 6px;
        border-radius: 3px;
    }

    .card.shadow.collection-view {
        width: 54%;
        margin: auto;
    }
</style>

<div class="container mt-4">
    <div class="card shadow collection-view">

        <!-- IMAGE -->
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/zigzag-icon.png" class="book-img" alt="Book Cover">

        <div class="card-body">

            <div class="meta-item row">
                <div class="col-md-3 meta-label">Title :</div>
                <div class="col-md-9">
                    Proceedings of the series of seminar workshops and exhibits on oral and local history the centennial goes to the barrios vol. 2
                </div>
            </div>

            <div class="meta-item row">
                <div class="col-md-3 meta-label">Description :</div>
                <div class="col-md-9"></div>
            </div>

            <div class="meta-item row">
                <div class="col-md-3 meta-label">Creator :</div>
                <div class="col-md-9"></div>
            </div>

            <div class="meta-item row">
                <div class="col-md-3 meta-label">Publisher :</div>
                <div class="col-md-9">Manila: NHI, PHA and NCC</div>
            </div>

            <div class="meta-item row">
                <div class="col-md-3 meta-label highlight">No. of Views :</div>
                <div class="col-md-9">18</div>
            </div>

            <div class="meta-item row">
                <div class="col-md-3 meta-label">Date :</div>
                <div class="col-md-9">1998</div>
            </div>

            <div class="meta-item row">
                <div class="col-md-3 meta-label">Format :</div>
                <div class="col-md-9">1449</div>
            </div>

            <div class="meta-item row">
                <div class="col-md-3 meta-label">Level :</div>
                <div class="col-md-9">Level 2</div>
            </div>

            <div class="meta-item row">
                <div class="col-md-3 meta-label">Collection :</div>
                <div class="col-md-9"></div>
            </div>

            <div class="meta-item row">
                <div class="col-md-3 meta-label">File :</div>
                <div class="col-md-9">
                    <a href="#" class="text-primary fw-semibold">View Item</a>
                </div>
            </div>

        </div>
    </div>
</div>

<?php get_footer(); ?>