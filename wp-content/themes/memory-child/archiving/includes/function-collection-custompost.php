<?php
function collection_custom_post_type()
{
    register_post_type('collection',
        array(
            'rewrite' => array('slug' => 'post-collection'),
            'labels' => array(
                'name' => 'Collection',
                'singular_name' => 'Collection',
                'add_new_item' => 'Add New Collection',
                'edit_item' => 'Edit Collection',
            ),
            'menu-icon' => 'dashicons-clipboard',
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title', 'thumbnail', 'editor', 'excerpt', 'comments',
            ),
            'taxonomies' => array('category', 'post_tag'),
            // 'show_in_menu' => 'archiving',
        )
    );
}
add_action('init', 'collection_custom_post_type');

/**
 * Collection custom pagination
 */

if (!function_exists('collection_pagination')):
    function collection_pagination()
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

// function my_acf_redirect_after_save($post_id)
// {

//     if (get_post_type($post_id) != 'collection') {
//         return;
//     }

//     if (is_admin()) {
//         return;
//     }

//     wp_redirect(site_url('add-sub-collection') . '?postid=' . $post_id);
//     // wp_redirect('http://localhost/nhcp/add-sub-collection/?postid=' . $post_id);
//     die();

// }

// add_action('acf/save_post', 'my_acf_redirect_after_save', 99);

/**
 * Disabled  Collection Field
 */

function collection_name_acf_prepare_field($field)
{

    $field['readonly'] = true;
    return $field;
}

add_filter('acf/prepare_field/name=collection', 'collection_name_acf_prepare_field');

/**
 * Disabled Sub Collection Field
 */

function sub_collection_name_acf_prepare_field($field)
{

    $field['readonly'] = true;
    return $field;
}

add_filter('acf/prepare_field/name=sub_collection', 'sub_collection_name_acf_prepare_field');

// function my_acf_redirect_after_save($post_id)
// {

//     // Only do it for "custom_post" post type
//     if (get_post_type($post_id) != 'collection') {
//         return;
//     }

//     // Only do it on the front end
//     if (is_admin()) {
//         return;
//     }

//     wp_redirect('https://example.com/thank/you/page/?postid=' . $post_id);

// }

// // run after ACF saves the $_POST['acf'] data
// add_action('acf/save_post', 'my_acf_redirect_after_save', 99);