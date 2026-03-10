<?php

function rare_materials_admin_menu()
{
    add_menu_page(
        'Rare Materials',
        'Rare Materials',
        'read',
        'rare-materials',
        '', // Callback, leave empty
        'dashicons-admin-post',
        8// Position
    );
}

add_action('admin_menu', 'rare_materials_admin_menu');

function rare_material_archives_custom_post_type()
{
    register_post_type('archive',
        array(
            'rewrite' => array('slug' => 'archives'),
            'labels' => array(
                'name' => 'Archive',
                'singular_name' => 'Archive',
                'add_new_item' => 'Add New Archive',
                'edit_item' => 'Edit Archive',
            ),
            'menu-icon' => 'dashicons-clipboard',
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title', 'thumbnail', 'editor', 'excerpt', 'comments',
            ),
            'taxonomies' => array('post_tag'),
            'show_in_menu' => 'rare-materials',
        )
    );
}
add_action('init', 'rare_material_archives_custom_post_type');

function rare_material_museum_custom_post_type()
{
    register_post_type('museums',
        array(
            'rewrite' => array('slug' => 'museum'),
            'labels' => array(
                'name' => 'Museum',
                'singular_name' => 'Museum',
                'add_new_item' => 'Add New Museum',
                'edit_item' => 'Edit Museum',
            ),
            'menu-icon' => 'dashicons-clipboard',
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title', 'thumbnail', 'editor', 'excerpt', 'comments',
            ),
            'taxonomies' => array('post_tag'),
            'show_in_menu' => 'rare-materials',
        )
    );
}
add_action('init', 'rare_material_museum_custom_post_type');

function rare_material_patron_custom_post_type()
{
    register_post_type('patrons',
        array(
            'rewrite' => array('slug' => 'patron'),
            'labels' => array(
                'name' => 'Patron',
                'singular_name' => 'Patron',
                'add_new_item' => 'Add New Patron',
                'edit_item' => 'Edit Patron',
            ),
            'menu-icon' => 'dashicons-clipboard',
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title', 'thumbnail', 'editor', 'excerpt', 'comments',
            ),
            'taxonomies' => array('post_tag'),
            'show_in_menu' => 'rare-materials',
        )
    );
}
add_action('init', 'rare_material_patron_custom_post_type');

/**
 *
 * Saving Custom fields into post fields acf_forms
 *
 */

// function acf_review_before_save_post($post_id)
// {
//     if (empty($_POST['acf'])) {
//         return;
//     }

//     $_POST['acf']['_post_title'] = $_POST['acf']['field_63cf68fc118b0'];
//     return $post_id;
// }
// add_action('acf/pre_save_post', 'acf_review_before_save_post', -1);

function rare_material_file_upload_custom_post_type()
{
    register_post_type('uploads',
        array(
            'rewrite' => array('slug' => 'upload'),
            'labels' => array(
                'name' => 'File Upload',
                'singular_name' => 'File Upload',
                'add_new_item' => 'Add New File Upload',
                'edit_item' => 'Edit File Upload',
            ),
            'menu-icon' => 'dashicons-clipboard',
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title', 'thumbnail', 'editor', 'excerpt', 'comments',
            ),
            'taxonomies' => array('post_tag'),
            'show_in_menu' => 'rare-materials',
        )
    );
}
add_action('init', 'rare_material_file_upload_custom_post_type');