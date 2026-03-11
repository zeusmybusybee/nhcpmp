<?php

function archiving_admin_menu()
{
    add_menu_page(
        'Archiving',
        'Archiving',
        'read',
        'archiving',
        '', // Callback, leave empty
        'dashicons-admin-post',
        5// Position
    );
}

add_action('admin_menu', 'archiving_admin_menu');

function item_custom_post_type()
{
    register_post_type('item',
        array(
            'rewrite' => array('slug' => 'items'),
            'labels' => array(
                'name' => 'Item Management',
                'singular_name' => 'Item',
                'add_new_item' => 'Add New Item',
                'edit_item' => 'Edit Item',
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
    
    register_post_type('ip_addresses',
        array(
            'rewrite' => array('slug' => 'ip_address'),
            'labels' => array(
                'name' => 'IP Addresses',
                'singular_name' => 'IP Addresses',
                'add_new_item' => 'Add New IP Addresses',
                'edit_item' => 'Edit IP Addresses',
            ),
            'menu-icon' => 'dashicons-clipboard',
            'public' => true,
            'has_archive' => false,
            'supports' => array( 'title' ),
        )
    );
}
add_action('init', 'item_custom_post_type');

/**
 * Populate Select Field to a post Type
 */

function acf_load_sample_field($field_item_type)
{
    $field_item_type['choices'] = get_post_type_values('item_type');
    return $field_item_type;
}
add_filter('acf/load_field/name=type', 'acf_load_sample_field');

function get_post_type_values($post_type)
{
    $values = array();
    $defaults = array(
        'post_type' => $post_type,
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    );
    $query = new WP_Query($defaults);
    if ($query->found_posts > 0) {
        foreach ($query->posts as $post) {
            $values[get_the_title($post->ID)] = get_the_title($post->ID);
        }
    }
    return $values;
}

/**
 * Populate Select Field to a post Collection
 */

function acf_load_collection_field($field)
{
    $field['choices'] = get_collection_post_type_values('collection');
    return $field;
}
add_filter('acf/load_field/name=collection', 'acf_load_collection_field');

function get_collection_post_type_values($post_type)
{
    $values_collection = array();
    $defaults = array(
        'post_type' => $post_type,
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    );
    $query = new WP_Query($defaults);
    if ($query->found_posts > 0) {
        foreach ($query->posts as $post) {
            $values_collection[get_the_title($post->ID)] = get_the_title($post->ID);
        }
    }
    return $values_collection;
}

/**
 * Item custom pagination
 */

if (!function_exists('item_pagination')):
    function item_pagination()
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

/**
 * Populate Select Field to a post Sub Collection
 */

function acf_load_sub_collection_field($field_subcollection)
{
    $field_subcollection['choices'] = get_subcollection_post_type_values('sub-collection');
    return $field_subcollection;
}
add_filter('acf/load_field/name=item_sub_collection', 'acf_load_sub_collection_field');

function get_subcollection_post_type_values($post_type_subcollection)
{
    $values_subcollection = array();
    $defaults_subcollection = array(
        'post_type' => $post_type_subcollection,
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    );
    $query_subcollection = new WP_Query($defaults_subcollection);
    if ($query_subcollection->found_posts > 0) {
        foreach ($query_subcollection->posts as $post) {
            $values_subcollection[get_the_title($post->ID)] = get_the_title($post->ID);

        }
    }
    return $values_subcollection;
    // return $values_subcollectionid;
}