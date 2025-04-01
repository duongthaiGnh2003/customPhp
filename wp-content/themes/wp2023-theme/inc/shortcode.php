<?php

// Đăng ký shortcode
add_shortcode('shortcode_header_cart', 'shortcode_header_cart');

// [shortcode_header_cart show_wishlist=1 show_cart=1 show_total=1]
function shortcode_header_cart($atts)
{
    global  $theme_dir;

    $atts = shortcode_atts(array( //gộp các giá trị mặc định với giá trị truyền vào từ shortcode.
        'show_wishlist' => 1,
        'show_cart'     => 1,
        'show_total'    => 1,
    ), $atts);
    //Lưu các giá trị vào biến
    $show_wishlist = $atts['show_wishlist']; // 1
    $show_cart     = $atts['show_cart'];     // 1
    $show_total    = $atts['show_total'];    // 1

    ob_start(); //bật buffering → bạn có thể "in ra" HTML bình thường như echo.

    // <!--  (chèn HTML ra đây sau này) -->
    include $theme_dir . '/inc/shortcode/shortcode_header_cart.php';



    return ob_get_clean(); //thu toàn bộ nội dung đã in và trả về dưới dạng chuỗi,
}
