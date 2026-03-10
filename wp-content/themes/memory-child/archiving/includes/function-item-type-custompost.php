<?php

/**
 * ITEM TYPE CUSTOM POST TYPE
 */
function item_type_custom_post_type()
{
    register_post_type('item_type',
        array(
            'rewrite' => array('slug' => 'item-types'),
            'labels' => array(
                'name' => 'Item Type Management',
                'singular_name' => 'Item Type',
                'add_new_item' => 'Add New Item Type',
                'edit_item' => 'Edit Item Type',
            ),
            'menu-icon' => 'dashicons-clipboard',
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title', 'thumbnail', 'editor', 'excerpt', 'comments',
            ),
            'taxonomies' => array('category', 'post_tag'),
            'show_in_menu' => 'archiving',
        )
    );
}
add_action('init', 'item_type_custom_post_type');

/**
 * Item Type custom pagination
 */

if (!function_exists('item_type_pagination')):
    function item_type_pagination()
{
        global $wp_query;

        $big = 999999999; // need an unlikely integer

        echo paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'prev_text' => __('<'),
            'next_text' => __('>'),
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
        ));
    }
endif;