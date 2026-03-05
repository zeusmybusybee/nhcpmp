<?php

/**
 * Display page header.
 *
 * @package memory
 */

if (is_front_page()) {
    return;
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

    .history-archive-header {
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
$archive_class = 'default-bg-header'; // default class

if (is_tag()) {
    $current_tag = get_queried_object(); // WP_Term object
    $tag_slug = $current_tag->slug;

    switch ($tag_slug) {
        case 'local-history':
            $archive_class = 'history-archive-header';
            break;
        case 'philippine-revolution':
            $archive_class = 'revolution-archive-header';
            break;
        case 'women':
            $archive_class = 'women-archive-header';
            break;
        case 'philippine-muslim-history-heritage':
            $archive_class = 'muslim-archive-header';
            break;
        case 'nhcp-publication':
            $archive_class = 'publication-archive-header';
            break;
        case 'jose-rizal':
            $archive_class = 'rizal-archive-header';
            break;
        default:
            $archive_class = 'default-bg-header';
    }
}
?>
<div class="page-header <?php echo $archive_class ?? ''; ?>">
    <div class="container">
        <div class="header-inner">
            <div class="page-header-title">
                <h1><?php single_tag_title(); ?></h1>

            
            </div>

        </div>
    </div>
</div>
</div>