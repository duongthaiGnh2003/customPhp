<?php
/*
 * Plugin Name:       Wordpress 2023 - ecommerce
 * Plugin URI:        #
 * Description:      plugin phụ vụ khá học.
 * Version:           1.0.0
 *  Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            duong thai
 * Author URI:        #
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        #
 * Text Domain:       wp2023-ecommerce
 * Domain Path:       /languages

 */
// định nghĩa các hằng số của plugin
define("WP2023_PATH", plugin_dir_path(__FILE__));
define("WP2023_URL", plugin_dir_url(__FILE__));

// định nghĩa hành động khi plugin được kích hoạt
register_activation_hook(
    __FILE__,
    'wp2023_ecommerce_activation'
);
function wp2023_ecommerce_activation(){
  // tạo csdl
    // tạo dữ liệu mẫu
}

// định nghĩa hành động khi plugin được tắt ik
register_deactivation_hook(
    __FILE__,
    'wp2023_ecommerce_deActivation'
);
function wp2023_ecommerce_deActivation(){
    // xóa csdl
    // xóa dữ liệu mẫu
}

include_once WP2023_PATH.'includes/includes.php'; // có tác dụng nhúng những file này vào file includes.php