<style>
    .breadcrumbs_container {

        font-size: 14px;
    }

    .breadcrumb-nav a {
        text-decoration: none;
        color: #0073aa;
    }

    .breadcrumb-nav a:hover {
        text-decoration: underline;
    }

    nav.breadcrumb-nav {
        margin-top: 14px;
    }

    nav.breadcrumb-nav a,
    nav.breadcrumb-nav span {
        font-size: 18px;
        font-weight: 300;
        color: #fff;
    }

    nav.breadcrumb-nav i {
        font-size: 10px;
    }
</style>
<div class="breadcrumbs_container ">
    <nav class="breadcrumb-nav">

        <!-- Home -->
        <a href="<?php echo home_url(); ?>">Home</a>

        <span> <i class="fa-solid fa-angles-right"></i> </span>

        <!-- Archive Title -->
        <span><?php post_type_archive_title(); ?></span>

    </nav>
</div>