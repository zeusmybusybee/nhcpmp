<?php

function wpse_226690_admin_menu()
{
    add_menu_page(
        'Cataloging',
        'Cataloging',
        'read',
        'cataloging',
        '', // Callback, leave empty
        'dashicons-admin-post',
        5// Position
    );
}

add_action('admin_menu', 'wpse_226690_admin_menu');

function catalog_audio_visual_custom_post_type()
{
    register_post_type('audio-visual',
        array(
            'rewrite' => array('slug' => 'audio-visuals'),
            'labels' => array(
                'name' => 'Audio Visuals',
                'singular_name' => 'Audio Visuals',
                'add_new_item' => 'Add New Audio Visuals',
                'edit_item' => 'Edit Audio Visuals',
            ),
            'menu-icon' => 'dashicons-clipboard',
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title', 'thumbnail', 'editor', 'excerpt', 'comments',
            ),
            'taxonomies' => array('post_tag'),
            'show_in_menu' => 'cataloging',
        )
    );
}
add_action('init', 'catalog_audio_visual_custom_post_type');

function catalog_book_and_manuscripts_custom_post_type()
{
    register_post_type('books-manuscript',
        array(
            'rewrite' => array('slug' => 'books-manuscripts'),
            'labels' => array(
                'name' => 'Books and Manuscripts',
                'singular_name' => 'Books and Manuscript',
                'add_new_item' => 'Add New Books and Manuscripts',
                'edit_item' => 'Edit Books and Manuscripts',
            ),
            'menu-icon' => 'dashicons-clipboard',
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title', 'thumbnail', 'editor', 'excerpt', 'comments',
            ),
            'taxonomies' => array('post_tag'),
            'show_in_menu' => 'cataloging',
        )
    );
}
add_action('init', 'catalog_book_and_manuscripts_custom_post_type');

function catalog_academic_courseworks_custom_post_type()
{
    register_post_type('academic-courseworks',
        array(
            'rewrite' => array('slug' => 'academic-coursework'),
            'labels' => array(
                'name' => 'Academic and Courseworks',
                'singular_name' => 'Academic and Courseworks',
                'add_new_item' => 'Add New Academic and Courseworks',
                'edit_item' => 'Edit Academic and Courseworks',
            ),
            'menu-icon' => 'dashicons-clipboard',
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title', 'thumbnail', 'editor', 'excerpt', 'comments',
            ),
            'taxonomies' => array('post_tag'),
            'show_in_menu' => 'cataloging',
        )
    );
}
add_action('init', 'catalog_academic_courseworks_custom_post_type');

function catalog_audio_recordings_custom_post_type()
{
    register_post_type('audio-recordings',
        array(
            'rewrite' => array('slug' => 'audio-recording'),
            'labels' => array(
                'name' => 'Audio Recordings',
                'singular_name' => 'Audio Recordings',
                'add_new_item' => 'Add New Audio Recordings',
                'edit_item' => 'Edit Audio Recordings',
            ),
            'menu-icon' => 'dashicons-clipboard',
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title', 'thumbnail', 'editor', 'excerpt', 'comments',
            ),
            'taxonomies' => array('post_tag'),
            'show_in_menu' => 'cataloging',
        )
    );
}
add_action('init', 'catalog_audio_recordings_custom_post_type');

function catalog_e_resources_custom_post_type()
{
    register_post_type('e-resources',
        array(
            'rewrite' => array('slug' => 'e-resource'),
            'labels' => array(
                'name' => 'E-Resources',
                'singular_name' => 'E-Resources',
                'add_new_item' => 'Add New E-Resources',
                'edit_item' => 'Edit E-Resources',
            ),
            'menu-icon' => 'dashicons-clipboard',
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title', 'thumbnail', 'editor', 'excerpt', 'comments',
            ),
            'taxonomies' => array('post_tag'),
            'show_in_menu' => 'cataloging',
        )
    );
}
add_action('init', 'catalog_e_resources_custom_post_type');

function catalog_serial_custom_post_type()
{
    register_post_type('serial',
        array(
            'rewrite' => array('slug' => 'serials'),
            'labels' => array(
                'name' => 'Serial',
                'singular_name' => 'Serial',
                'add_new_item' => 'Add New Serial',
                'edit_item' => 'Edit Serial',
            ),
            'menu-icon' => 'dashicons-clipboard',
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title', 'thumbnail', 'editor', 'excerpt', 'comments',
            ),
            'taxonomies' => array('post_tag'),
            'show_in_menu' => 'cataloging',
        )
    );
}
add_action('init', 'catalog_serial_custom_post_type');

function catalog_video_recordings_custom_post_type()
{
    register_post_type('video-recording',
        array(
            'rewrite' => array('slug' => 'video-recordings'),
            'labels' => array(
                'name' => 'Video Recording',
                'singular_name' => 'Video Recording',
                'add_new_item' => 'Add New Video Recording',
                'edit_item' => 'Edit Video Recording',
            ),
            'menu-icon' => 'dashicons-clipboard',
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title', 'thumbnail', 'editor', 'excerpt', 'comments',
            ),
            'taxonomies' => array('post_tag'),
            'show_in_menu' => 'cataloging',
        )
    );
}
add_action('init', 'catalog_video_recordings_custom_post_type');

function catalog_website_custom_post_type()
{
    register_post_type('website',
        array(
            'rewrite' => array('slug' => 'websites'),
            'labels' => array(
                'name' => 'Web Sites',
                'singular_name' => 'Web Sites',
                'add_new_item' => 'Add New Web Sites',
                'edit_item' => 'Edit Web Sites',
            ),
            'menu-icon' => 'dashicons-clipboard',
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title', 'thumbnail', 'editor', 'excerpt', 'comments',
            ),
            'taxonomies' => array('post_tag'),
            'show_in_menu' => 'cataloging',
        )
    );
}
add_action('init', 'catalog_website_custom_post_type');