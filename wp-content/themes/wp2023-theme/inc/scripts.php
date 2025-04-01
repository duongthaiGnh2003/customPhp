<?php
// Đăng ký style cho theme
// wp_enqueue_scripts
add_action('wp_enqueue_scripts', 'wp2023_theme_register_styles');
function wp2023_theme_register_styles() //Hàm này được sử dụng để đăng ký và thêm (enqueue) các file CSS vào theme.
{
    global $theme_prefix, $theme_uri;

    wp_enqueue_style($theme_prefix . '-root', $theme_uri . '/css/root.css');
    wp_enqueue_style($theme_prefix . '-slicknav', 'https://ogani.com.vn/vendors/slicknav/dist/slicknav.min.css');
    wp_enqueue_style($theme_prefix . '-bootstrap', 'https://ogani.com.vn/vendors/bootstrap/dist/css/bootstrap.min.css');
    wp_enqueue_style($theme_prefix . '-font-awesome-all', 'https://ogani.com.vn/vendors/font-awesome/css/all.css');
    wp_enqueue_style($theme_prefix . '-font-awesome_5', 'https://ogani.com.vn/vendors/font-awesome/css/v5-font-face.css');
    wp_enqueue_style($theme_prefix . '-jquery-nice-select', 'https://ogani.com.vn/vendors/jquery-nice-select/css/nice-select.css');

    wp_enqueue_style($theme_prefix . '-jquery-ui-min', 'https://ogani.com.vn/vendors/jquery-ui/themes/base/jquery-ui.min.css');
    wp_enqueue_style($theme_prefix . '-owlcarousel', 'https://ogani.com.vn/vendors/owlcarousel/dist/assets/owl.carousel.min.css');

    wp_enqueue_style($theme_prefix . '-main', $theme_uri . '/css/main.css');
    //custom
    wp_enqueue_style($theme_prefix . '-custom', $theme_uri . '/css/custom.css');
}

// Đăng ký javascript cho theme
add_action('wp_enqueue_scripts', 'wp2023_theme_register_scripts');
function wp2023_theme_register_scripts()
{
    global $theme_prefix, $theme_uri;

    wp_enqueue_script($theme_prefix . '-main', $theme_uri . '/js/main.js');
    wp_enqueue_script($theme_prefix . '-config',  'https://ogani.com.vn/public/js/config.js');
    wp_enqueue_script($theme_prefix . '-functions',  'https://ogani.com.vn/public/js/functions.js');
    wp_enqueue_script($theme_prefix . '-jquery.min',  'https://ogani.com.vn/vendors/jquery/dist/jquery.min.js');
    wp_enqueue_script($theme_prefix . '-bootstrap',  'https://ogani.com.vn/vendors/bootstrap/dist/js/bootstrap.bundle.min.js');
    wp_enqueue_script($theme_prefix . '-jquery.nice',  'https://ogani.com.vn/vendors/jquery-nice-select/js/jquery.nice-select.min.js');
    wp_enqueue_script($theme_prefix . '-jquery-ui',  'https://ogani.com.vn/vendors/jquery-ui/jquery-ui.min.js');
    wp_enqueue_script($theme_prefix . '-slicknav',  'https://ogani.com.vn/vendors/slicknav/dist/jquery.slicknav.js');
    wp_enqueue_script($theme_prefix . '-mixitup',  'https://ogani.com.vn/vendors/mixitup/dist/mixitup.min.js');
    wp_enqueue_script($theme_prefix . '-carousel',  'https://ogani.com.vn/vendors/owlcarousel/dist/owl.carousel.min.js');
    // custom
    wp_enqueue_script($theme_prefix . '-main', $theme_uri . '/js/custom.js');
}
