<?php
// định nghĩa hoạt động khi xóa plugin

// if uninstall.php is not called by WordPress, die
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die;
}


// xóa csdl
//global $wpdb;
//$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}mytable" );