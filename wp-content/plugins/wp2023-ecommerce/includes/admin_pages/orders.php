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

?>

<div class="wrap">
	<h1 class="wp-heading-inline">Quản lý đơn hàng</h1>
	<hr class="wp-header-end">
	<ul class="subsubsub">
		<li class="all"><a href="admin.php?page=wp2023-orders" class="current">Tất cả <span class="count">(3)</span></a></li>
		<li class="publish"><a href="admin.php?page=wp2023-orders&status=pending">Đơn hàng mới</a> |</li>
		<li class="publish"><a href="admin.php?page=wp2023-orders&status=completed">Đơn hàng đã hoàn thành</a> |</li>
		<li class="publish"><a href="admin.php?page=wp2023-orders&status=canceled">Đơn hàng đã hủy</a></li>
	</ul>
	<form id="posts-filter" method="get">
		<input type="hidden" name="page" value="wp2023-orders">
		<!-- <input type="hidden" name="paged" value="1"> -->
		<p class="search-box">
			<label class="screen-reader-text" for="post-search-input">Tìm các bài viết:</label>
			<input type="search" id="post-search-input" name="s" value="<?= $search ?>">
			<input type="submit" id="search-submit" class="button" value="Tìm các bài viết">
		</p>
		<div class="tablenav top">
			<div class="alignleft actions bulkactions">
				<label for="bulk-action-selector-top" class="screen-reader-text">Lựa chọn thao tác hàng loạt</label>
				<select name="action" id="bulk-action-selector-top">
					<option value="-1">Hành động</option>
					<option value="trash">Bỏ vào thùng rác</option>
				</select>
				<input type="submit" id="doaction" class="button action" value="Áp dụng">
			</div>
			<div class="alignleft actions">
				<label class="screen-reader-text" for="cat">Lọc theo danh mục</label>
				<select name="status" id="cat" class="postform">
					<option value="0">Tất cả trạng thái</option>
					<option value="pending" <?php echo ($_REQUEST['status'] == "pending") ? "selected" : ""; ?>>Đơn hàng mới</option>
					<option value="completed" <?php echo ($_REQUEST['status'] == "completed") ? "selected" : ""; ?>>Đơn đã hoàn thành</option>
					<option value="canceled" <?php echo ($_REQUEST['status'] == "canceled") ? "selected" : ""; ?>>Đơn đã hủy</option>
				</select>
				<input type="submit" id="post-query-submit" class="button" value="Lọc">
			</div>
			<?php
			include_once WP2023_PATH . 'includes/templates/elements/paginate.php';
			?>
		</div>
		<h2 class="screen-reader-text">Danh sách bài viết</h2>
		<table class="wp-list-table widefat fixed striped table-view-list posts">
			<thead>
				<tr>
					<td id="cb" class="manage-column column-cb check-column">
						<label class="screen-reader-text" for="cb-select-all-1">Chọn toàn bộ</label>
						<input id="cb-select-all-1" type="checkbox">
					</td>
					<th class="manage-column column-primary">Mã đơn hàng</th>
					<th class="manage-column">Tổng tiền</th>
					<th class="manage-column">Khách hàng</th>
					<th class="manage-column">Điện thoại</th>
					<th class="manage-column">Trạng thái</th>
					<th class="manage-column">Thời gian</th>
				</tr>
			</thead>
			<tbody id="the-list">
				<?php foreach ($items as $item) : ?> <!-- Loop starts (not fully captured) -->
					<tr id="post-<?= $item->id ?>" class="iedit author-self level-0 post-<?= $item->id ?> status-public">
						<th scope="row" class="check-column">
							<input id="cb-select-<?= $item->id ?>" type="checkbox" name="post[]" value="<?= $item->id ?>">
						</th>
						<td class="title column-title has-row-actions column-primary">
							<strong>
								<a class="row-title" href=""># <?= $item->id ?></a>
							</strong>
						</td>
						<td><?= number_format($item->total) ?></td>
						<td><?= $item->customer_name ?></td>
						<td><?= $item->customer_phone ?></td>
						<td>
							<select name="" id="" class="order_status " data-id="<?= $item->id ?>">
								<option value="pending" <?php echo ($item->status == "pending") ? "selected" : ""; ?>>Đơn hàng mới</option>
								<option value="completed" <?php echo ($item->status == "completed") ? "selected" : ""; ?>>Đơn đã hoàn thành</option>
								<option value="canceled" <?php echo ($item->status == "canceled") ? "selected" : ""; ?>>Đơn đã hủy</option>
							</select>
						</td>
						<td><?= date('d-m-yy', strtotime($item->created)) ?></td>
					</tr>
				<?php endforeach ?> <!-- Loop ends -->
			</tbody>
			<tfoot>
				<tr>
					<td id="cb" class="manage-column column-cb check-column">

						<input id="cb-select-all-1" type="checkbox">
					</td>
					<th class="manage-column column-primary">Mã đơn hàng</th>
					<th class="manage-column">Tổng tiền</th>
					<th class="manage-column">Khách hàng</th>
					<th class="manage-column">Điện thoại</th>
					<th class="manage-column">Trạng thái</th>
					<th class="manage-column">Thời gian</th>
				</tr>
			</tfoot>
		</table>
</div>
<script>
	// đường dẫn xử lý ajaxt 
	const ajax_url = '<?= admin_url('admin-ajax.php') ?>' // admin_url : lay ra url cua admin :  http://wordpress/testplugin/wp-admin  roi noi cai ben trong
	//admin-ajax.php: cái này dell kiên quan gì đến cái file admin_ajax.php mà mk tạo mà nó là file mặc định của worPreess

	jQuery(document).ready(function() {
		// alert('Jquery')
		jQuery('.order_status').on('change', function() {
			const order_id = jQuery(this).data('id'); // nó lấy ra data-id
			const status = jQuery(this).val();

			jQuery.ajax({
				url: ajax_url,
				method: 'POST',
				dataType: 'json',

				data: {
					action: "wp2023_order_change_status",
					order_id: order_id,
					status: status
				},
				success: function(res) {

				},
				error: function(error) {

				}
			});
		});
	});
</script>