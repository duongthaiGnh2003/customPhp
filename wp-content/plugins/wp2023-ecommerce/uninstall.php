<?php
// định nghĩa hoạt động khi xóa plugin

// if uninstall.php is not called by WordPress, die
if (! defined('WP_UNINSTALL_PLUGIN')) {
    die;
}


// xóa csdl
include_once WP2023_PATH . 'includes/db/migrationRollback.php';

// xóa option
delete_option("wp2023_settings_options", []);
