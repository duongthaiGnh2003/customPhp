<?php
// Khi đã đăng nhập
add_action('wp_ajax_wp2023_order_change_status', 'wp2023_order_change_status'); //wp_ajax_<ten>

// Khi chưa đăng nhập
add_action('wp_ajax_nopriv_wp2023_order_change_status', 'wp2023_order_change_status');

function wp2023_order_change_status()
{
    $order_id = $_REQUEST['order_id'];
    $status = $_REQUEST['status'];
    $nonce = $_REQUEST['_wpnonce'];
    if (wp_verify_nonce($nonce, 'wp2023_update_order_status')) { //dùng để kiểm tra và xác thực giá trị nonce
        $Wp2023OrderClass = new Wp2023Order();
        $Wp2023OrderClass->change_status($order_id, $status);
        $res = [
            'success' => true
        ];
    } else {
        $res = [
            'success' => false
        ];
    }

    echo json_encode($res);
    die();
}
