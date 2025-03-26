<?php
// Tạo bảng
require_once ABSPATH . 'wp-admin/includes/upgrade.php';
// dbDelta($sql);
global $wpdb;
$charset_collate = $wpdb->get_charset_collate();
$tbl_orders = $wpdb->prefix . 'wp2023_orders'; // wp_wp2023_orders
$tbl_order_detail = $wpdb->prefix . 'wp2023_order_detail'; // wp_wp2023_order_detail

$sql = "CREATE TABLE `$tbl_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` date DEFAULT current_timestamp(),
  `total` double DEFAULT NULL,
  `status` varchar(255) DEFAULT 'pending',
  `payment_method` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(255) DEFAULT NULL,
  `customer_email` varchar(25) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) " . $charset_collate . ";";

dbDelta($sql);

$sql_order_detail = "CREATE TABLE `$tbl_order_detail` (
    `id` int(11) NOT NULL  AUTO_INCREMENT,
    `product_id` int(11) NOT NULL,
    `order_id` int(11) NOT NULL,
    `quantity` int(11) NOT NULL,
    `price` int(11) NOT NULL,
    PRIMARY KEY (`id`)
  ) " . $charset_collate . ";";

dbDelta($sql_order_detail);
