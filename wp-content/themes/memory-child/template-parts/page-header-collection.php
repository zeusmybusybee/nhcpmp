<?php

/**
 * Display page header.
 *
 * @package memory
 */

if (is_front_page()) {
    return;
}
$title       = '';
$description = '';

if (is_singular()) {
    $post_type_obj = get_post_type_object(get_post_type());

    if ($post_type_obj) {
        if (get_post_type() === 'page') {
            $title = get_the_title(); // actual page title
            $description = ''; // you can leave it empty or add custom description if needed
        } else {
            $title = $post_type_obj->labels->name; // post type name
            $description = $post_type_obj->description ?? '';
        }
    }
} elseif (is_post_type_archive()) {
    $title       = post_type_archive_title('', false);
    $description = get_the_archive_description();
} elseif (is_archive()) {
    $title       = get_the_archive_title();
    $description = get_the_archive_description();
} elseif (is_page()) {
    $title = get_the_title();
} else {
    $title = get_bloginfo('name');
}
?>

<style>
    /* Secondary collections menu */
    .collections-nav {
        background: #fff;
        border-top: 2px solid #e5e5e5;
    }

    .collections-nav ul {
        display: flex;
        justify-content: center;
        gap: 50px;
        padding: 16px 0;
        margin: 0;
        list-style: none;
    }

    .collections-nav a {
        color: #6b4a1f;
        text-decoration: none;
        position: relative;
        padding-bottom: 6px;
        transition: color 0.2s ease;
        font-size: 20px;
        font-weight: 300;
    }

    .collections-nav a:hover {
        color: #3f2a12;
    }

    .collections-nav a.active {
        font-weight: 600;
        color: #3f2a12;
    }

    .collections-nav a.active::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 2px;
        background: #6b4a1f;
    }

    .local-hitory-archive-header {
        background: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/local-history.png') center/cover no-repeat !important;
        padding: 10px 0;
    }

    .revolution-archive-header {
        background: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/revolution.png') center/cover no-repeat !important;
        padding: 10px 0;
    }

    .contributed-archive-header {
        background: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/contributed.png') center/cover no-repeat !important;
        padding: 10px 0;
    }

    .women-archive-header {
        background: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/women.png') center/cover no-repeat !important;
        padding: 10px 0;
    }

    .muslim-archive-header {
        background: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/muslim.png') center/cover no-repeat !important;
        padding: 10px 0;
    }

    .publication-archive-header {
        background: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/publication.png') center/cover no-repeat !important;
        padding: 10px 0;
    }

    .rizal-archive-header {
        background: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/rizal.png') center/cover no-repeat !important;
        padding: 10px 0;
    }

    .default-bg-header {
        background: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/deafault.png') center/cover no-repeat !important;
        padding: 10px 0;
    }

    .default-bg-header::before {
        content: "";
        position: absolute;
        inset: 0;
        background: rgb(112 75 16 / 79%);
        /* same color with opacity */
        z-index: 0;
    }

    .default-bg-header .header-inner {
        position: relative;
        z-index: 1;
        /* para laging nasa ibabaw yung content */
        padding: 15px 0 0 !important;
    }

    .header-inner h1 {
        font-weight: 800 !important;
    }

    /* Mobile */
    @media (max-width: 768px) {
        .collections-nav ul {
            overflow-x: auto;
            justify-content: flex-start;
            gap: 24px;
            padding: 12px 16px;
            white-space: nowrap;
        }
    }
</style>


<?php
global $wp;

$post_types = ['rizal-collection', 'artifacts', 'ph-heraldry-registry', 'historical-sites', 'a-v-material', 'foundation-of-towns'];

if (is_post_type_archive($post_types) || is_singular($post_types)) : ?>

    <nav class="collections-nav">
        <div class="container">

            <?php
            // Desktop Menu
            wp_nav_menu([
                'menu'        => 'Auxiliary Menu',
                'container'   => false,
                'menu_class'  => 'nav justify-content-center py-3',
                'menu_id'     => false,
                'fallback_cb' => false,
            ]);
            ?>

            <?php
            /**
             * Detect current post type PROPERLY
             */
            if (is_singular()) {
                $current_post_type = get_post_type();
            } elseif (is_post_type_archive()) {
                $queried_object = get_queried_object();
                $current_post_type = isset($queried_object->name) ? $queried_object->name : '';
            } else {
                $current_post_type = '';
            }

            $menu_items = wp_get_nav_menu_items('Auxiliary Menu');

            if ($menu_items) :
            ?>

                <select class="collections-dropdown">

                    <?php foreach ($menu_items as $item) :

                        $selected = '';

                        // Match archive menu items correctly
                        if (
                            $item->type === 'post_type_archive' &&
                            $item->object === $current_post_type
                        ) {
                            $selected = 'selected';
                        }

                        // Add spacing if submenu
                        $prefix = '';
                        if ($item->menu_item_parent != 0) {
                            $prefix = '— '; // pwede mo dagdagan ng space or dash
                        }

                    ?>
                        <option value="<?php echo esc_url($item->url); ?>" <?php echo $selected; ?>>
                            <?php echo esc_html($prefix . $item->title); ?>
                        </option>
                    <?php endforeach; ?>

                </select>

            <?php endif; ?>

        </div>
    </nav>

<?php endif; ?>

<?php
$archive_class = '';

if (is_post_type_archive('local-history') || is_singular('local-history')) {
    $archive_class = 'local-hitory-archive-header';
} elseif (is_post_type_archive('revolution') || is_singular('revolution')) {
    $archive_class = 'revolution-archive-header';
} elseif (is_post_type_archive('contributed') || is_singular('contributed')) {
    $archive_class = 'contributed-archive-header';
} elseif (is_post_type_archive('women-in-philippines') || is_singular('women-in-philippines')) {
    $archive_class = 'women-archive-header';
} elseif (is_post_type_archive('philippine-muslim') || is_singular('philippine-muslim')) {
    $archive_class = 'muslim-archive-header';
} elseif (is_post_type_archive('nhcp-publications') || is_singular('nhcp-publications')) {
    $archive_class = 'publication-archive-header';
} elseif (is_post_type_archive('rizal-collection') || is_singular('rizal-collection')) {
    $archive_class = 'rizal-archive-header';
} else {
    $archive_class = 'default-bg-header';
}
?>

<div class="page-header <?php echo $archive_class ?? ''; ?>">
    <div class="container">
        <div class="header-inner">

            <ul class="breadcrumbs">
                <li class="breadcrumbs-item">
                    <a class="home" href="<?php echo home_url(); ?>">Home</a>
                </li>

                <?php if ($parent_link) : ?>
                    <li class="breadcrumbs-item">
                        <i class="icofont icofont-caret-right"></i>
                        <a href="<?php echo $parent_link; ?>">
                            <?php echo $parent_name; ?>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="breadcrumbs-item">
                    <i class="icofont icofont-caret-right"></i>
                    <span class="last-item"><?php echo $title; ?></span>
                </li>
            </ul>

            <div class="page-header-title">
                <h1><?php echo $title; ?></h1>

                <?php if ($description) : ?>
                    <h2 class="entry-description"><?php echo $description; ?></h2>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>
</div>