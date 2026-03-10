<?php

function indexing_admin_menu()
{
    add_menu_page(
        'Indexing',
        'Indexing',
        'read',
        'indexing',
        '', // Callback, leave empty
        'dashicons-admin-post',
        7// Position
    );
}

add_action('admin_menu', 'indexing_admin_menu');

function indexing_analytic_and_book_literature_custom_post_type()
{
    register_post_type('analytic-literature',
        array(
            'rewrite' => array('slug' => 'analytic-literatures'),
            'labels' => array(
                'name' => 'Analytic and Book Literature',
                'singular_name' => 'Analytic and Book Literature',
                'add_new_item' => 'Add New Analytic and Book Literature',
                'edit_item' => 'Edit Analytic and Book Literature',
            ),
            'menu-icon' => 'dashicons-clipboard',
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title', 'thumbnail', 'editor', 'excerpt', 'comments',
            ),
            'taxonomies' => array('post_tag'),
            'show_in_menu' => 'indexing',
        )
    );
}
add_action('init', 'indexing_analytic_and_book_literature_custom_post_type');

function indexing_periodical_article_custom_post_type()
{
    register_post_type('periodical-article',
        array(
            'rewrite' => array('slug' => 'periodical-articles'),
            'labels' => array(
                'name' => 'Periodical Article',
                'singular_name' => 'Periodical Article',
                'add_new_item' => 'Add New Periodical Article',
                'edit_item' => 'Edit Periodical Article',
            ),
            'menu-icon' => 'dashicons-clipboard',
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title', 'thumbnail', 'editor', 'excerpt', 'comments',
            ),
            'taxonomies' => array('post_tag'),
            'show_in_menu' => 'indexing',
        )
    );
}
add_action('init', 'indexing_periodical_article_custom_post_type');

function indexing_vertical_file_custom_post_type()
{
    register_post_type('vertical-file',
        array(
            'rewrite' => array('slug' => 'vertical-files'),
            'labels' => array(
                'name' => 'Vertical File',
                'singular_name' => 'Vertical Files',
                'add_new_item' => 'Add New Vertical File',
                'edit_item' => 'Edit Vertical File',
            ),
            'menu-icon' => 'dashicons-clipboard',
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title', 'thumbnail', 'editor', 'excerpt', 'comments',
            ),
            'taxonomies' => array('post_tag'),
            'show_in_menu' => 'indexing',
        )
    );
}
add_action('init', 'indexing_vertical_file_custom_post_type');

function indexing_cases_custom_post_type()
{
    register_post_type('cases',
        array(
            'rewrite' => array('slug' => 'case'),
            'labels' => array(
                'name' => 'Cases',
                'singular_name' => 'Cases',
                'add_new_item' => 'Add New Cases',
                'edit_item' => 'Edit Case',
            ),
            'menu-icon' => 'dashicons-clipboard',
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title', 'thumbnail', 'editor', 'excerpt', 'comments',
            ),
            'taxonomies' => array('post_tag'),
            'show_in_menu' => 'indexing',
        )
    );
}
add_action('init', 'indexing_cases_custom_post_type');