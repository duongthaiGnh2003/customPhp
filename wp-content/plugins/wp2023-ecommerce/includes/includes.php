<?php
// đăng ký post_type và taxonomy
include_once WP2023_PATH . 'includes/post_types.php';

// đăng ký metabox cho sản phẩm
include_once WP2023_PATH . 'includes/metaboxes.php';

// thêm các cột vào custom post_type và custom taxonomy
include_once WP2023_PATH . 'includes/admin_colums.php';

// thêm các cột vào  custom taxonomy
include_once WP2023_PATH . 'includes/category_admin_colums.php';
// tạo menu cho admin
include_once WP2023_PATH . 'includes/admin_menus.php';

// làm việc với csdl 
include_once WP2023_PATH . 'includes/classes/Wp2023Oder.php';

// sử dụng ajax trong php
include_once WP2023_PATH . 'includes/admin_ajax.php';

// tạo setting
include_once WP2023_PATH . 'includes/admin_setting.php';

// tạo api
include_once WP2023_PATH . 'includes/api.php';
