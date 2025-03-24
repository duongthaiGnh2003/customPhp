<?php
// Hiển thị các cột của taxonomy "product_cat"
add_filter('manage_edit-product_cat_columns', 'wp2023_admin_columns_taxonomy_filter_columns');

function wp2023_admin_columns_taxonomy_filter_columns($columns) {
    $columns['image'] = 'Hình ảnh';
    return $columns;
}

// Hiển thị giá trị cột "image"
add_action('manage_product_cat_custom_column', 'wp2023_admin_columns_taxonomy_render_columns', 10, 3);

function wp2023_admin_columns_taxonomy_render_columns($content, $column, $term_id) {
    if ($column === 'image') {
        $image = get_term_meta($term_id, 'image', true);
 
    
        return $image;
    }

}
