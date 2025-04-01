<?php
// Đăng ký các thành phần hỗ trợ cho theme

add_action('after_setup_theme', 'wp2023_theme_support');

function wp2023_theme_support()
{
    // Đăng ký menu
    register_nav_menus([ // đăng ký các vị trí menu 
        'primary' => 'Primary Menu custom',
        'vertical' => 'Vertical Menu custom',
        'mobile' => 'Mobile Menu custom',
    ]);

    // Đăng ký hình ảnh cho bài viết
    add_theme_support('post-thumbnails');
    add_theme_support('post-formats');
    // ...
}
