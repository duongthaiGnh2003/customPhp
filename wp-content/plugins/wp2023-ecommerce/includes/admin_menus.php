<?php
// Thêm menu vào trang quản trị WordPress
add_action('admin_menu', 'wp2023_admin_menu');

function wp2023_admin_menu() {
    // Thêm một mục menu chính vào bảng điều khiển WordPress
    add_menu_page(
        'WordPress 2023',                 // Tiêu đề trang
        'WordPress 2023 custom',                 // Tên hiển thị trên menu
        'manage_options',                 // Quyền truy cập
        'wp2023',                         // Slug của menu
        'wp2023_admin_page_dashboard',    // Hàm callback hiển thị nội dung trang
        'dashicons-admin-page',           // Icon của menu (Dashicons)
        25                                // Vị trí menu
    );
//  menu con
    add_submenu_page(
        'wp2023',                          // Slug của menu cha
        'Đơn hàng',                        // Tiêu đề trang
        'Đơn hàng',                        // Tên hiển thị trên menu
        'manage_options',                  // Quyền truy cập
        'wp2023-orders',                   // Slug của menu con
        'wp2023_admin_page_orders'         // Hàm callback hiển thị nội dung trang
    );
    add_submenu_page(
        'wp2023',                           
        'Cấu hình',                         
        'Cấu hình',                         
        'manage_options',                   
        'wp2023-settings',                  
        'wp2023_admin_page_settings'        
    );

}

// Hàm hiển thị nội dung trang dashboard
function wp2023_admin_page_dashboard() {
     include_once WP2023_PATH.'includes/admin_pages/dashboard.php';
}

// Hàm hiển thị nội dung trang "Đơn hàng"
function wp2023_admin_page_orders() {
    include_once WP2023_PATH.'includes/admin_pages/orders.php';

}

function wp2023_admin_page_settings() {
    include_once WP2023_PATH.'includes/admin_pages/setting.php';

}