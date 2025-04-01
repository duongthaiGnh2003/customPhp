<?php

// đắng ký loại bài viết sản phẩm
function wp2023_custom_post_type()
{
    // post: bài viết
    // page: trang
    // product: sản phẩm
    register_post_type(
        'product',
        array(
            'labels'      => array(
                'name'          => __('Các sản phẩm custom', 'wp2023-ecommerce'), //wp2023-ecommerce định nghĩa ở Text Domain: trong wp2023-ecommerce.php
                'singular_name' => __('Sản phẩm', 'wp2023-ecommerce'),
            ),
            'public'      => true,
            'has_archive' => true,
            'rewrite'     => array('slug' => 'products'), // my custom slug
            "supports" => array("title", 'editor', 'thumbnail', 'excerpt')
        )
    );
}
add_action('init', 'wp2023_custom_post_type');

// đăng ký Taxonomy
add_action('init', 'wp2023_register_taxonomy_product');
function wp2023_register_taxonomy_product()
{
    $labels = array(
        'name'              => _x('Danh mục product ', 'taxonomy general name'),
        'singular_name'     => _x('Danh mục product', 'taxonomy singular name'),
        'search_items'      => __('Search Danh mục'),
        'all_items'         => __('All Danh mục'),
        'parent_item'       => __('Parent Danh mục'),
        'parent_item_colon' => __('Parent Danh mục:'),
        'edit_item'         => __('Edit Danh mục'),
        'update_item'       => __('Update Danh mục'),
        'add_new_item'      => __('Add New Danh mục'),
        'new_item_name'     => __('New Danh mục Name'),
        'menu_name'         => __('Danh mục product'),
    );
    $args   = array(
        'hierarchical'      => true, // make it hierarchical (like categories)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'course_custom'],
    );
    register_taxonomy('product_cat', ['product'], $args);
}
