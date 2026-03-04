<style>
    .breadcrumbs_container {
        margin-bottom: 20px;
        font-size: 14px;
    }

    .breadcrumb-nav a {
        text-decoration: none;
        color: #0073aa;
    }

    .breadcrumb-nav a:hover {
        text-decoration: underline;
    }

    .breadcrumb-back {
        font-weight: 600;
        margin-right: 5px;
    }
</style>
<div class="breadcrumbs_container mb-4">
    <nav class="breadcrumb-nav">

        <!-- Back Button -->
        <a href="javascript:history.back()" class="breadcrumb-back">← Back</a>

        <span> / </span>

        <!-- Home -->
        <a href="<?php echo home_url(); ?>">Home</a>

        <span> / </span>

        <!-- Archive Title -->
        <span><?php post_type_archive_title(); ?></span>

    </nav>
</div>