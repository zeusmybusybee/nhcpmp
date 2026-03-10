<?php
function subcollection_custom_post_type()
{
    register_post_type('sub-collection',
        array(
            'rewrite' => array('slug' => 'sub-collections'),
            'labels' => array(
                'name' => 'Sub-Collection Management',
                'singular_name' => 'Sub Collection',
                'add_new_item' => 'Add New Sub Collection',
                'edit_item' => 'Edit Sub Collection',
            ),
            'menu-icon' => 'dashicons-clipboard',
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title', 'thumbnail', 'editor', 'excerpt', 'comments',
            ),
            'taxonomies' => array('post_tag'),
            'show_in_menu' => 'archiving',
        )
    );
}
add_action('init', 'subcollection_custom_post_type');