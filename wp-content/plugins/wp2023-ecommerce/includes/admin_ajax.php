<?php
// Khi đã đăng nhập
add_action('wp_ajax_wp2023_order_change_status', 'wp2023_order_change_status'); //wp_ajax_<ten>

// Khi chưa đăng nhập
add_action('wp_ajax_nopriv_wp2023_order_change_status', 'wp2023_order_change_status');

function wp2023_order_change_status()
{
    $order_id = $_REQUEST['order_id'];
    $status = $_REQUEST['status'];
    $Wp2023OrderClass = new Wp2023Order();
    $Wp2023OrderClass->change_status($order_id, $status);
    $res = [
        'success' => true
    ];
    echo json_encode($res);
    die();
}
