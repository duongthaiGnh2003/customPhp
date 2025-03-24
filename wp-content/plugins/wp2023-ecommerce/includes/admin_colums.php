<?php
// Hiển thị các cột của post type sản phẩm trong admin
add_filter('manage_product_posts_columns', 'wp2023_admin_columns_product_filter_columns'); //manage_<post_type>_posts_columns

function wp2023_admin_columns_product_filter_columns($columns) {
    $columns['product_price'] = 'Giá bán';
    $columns['product_price_sale'] = 'Giá khuyến mại';
    $columns['product_stock'] = 'Số lượng';
    
    return $columns; // Trả về danh sách cột đã sửa đổi
}

// Hiển thị nội dung tùy chỉnh cho các cột trong post type "product"
add_action('manage_product_posts_custom_column', 'wp2023_admin_columns_product_render_columns', 10, 2); //manage_<post_type>_posts_custom_column; 10 là mức độ ưu tiên; 2 xác định hàm có bao tham số

function wp2023_admin_columns_product_render_columns($column, $post_id) {
    switch ($column) {
        case 'product_price':
            $price = get_post_meta($post_id, 'product_price', true);
            echo   number_format($price)  ;
            break;

        case 'product_price_sale':
            $sale_price = get_post_meta($post_id, 'product_price_sale', true);
            echo number_format($sale_price)  ;
            break;

        case 'product_stock':
            $stock = get_post_meta($post_id, 'product_stock', true);
            echo   $stock  ;
            break;
    }
}
