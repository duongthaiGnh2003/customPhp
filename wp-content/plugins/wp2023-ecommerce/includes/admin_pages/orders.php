<?php

use SimplePie\Item;

$Wp2023OrderClass = new Wp2023Order();
$resuilt = $Wp2023OrderClass->paginate(10);

$search = isset($_REQUEST['s']) ? $_REQUEST['s'] : "";
extract($resuilt); // chuyển các phần tử trong mảng thành cac biến vd: $items,tatol_page... theo nhuw return owr ham paginate



$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";
if ($action === 'trash') {
	$orderIds = $_REQUEST['post'];
	if (!empty($orderIds)) {
		foreach ($orderIds as $orderId) {
			$Wp2023OrderClass->trash($orderId);
		}
	}

	echo ("<script>location.href = '" . 'admin.php?page=wp2023-orders' . "'</script>");

	exit();
};

if (isset($_GET['order_id']) && $_GET['order_id'] != '') {
	include WP2023_PATH . 'includes/admin_pages/orders/edit.php';
} else {
	include WP2023_PATH . 'includes/admin_pages/orders/list.php';
}
