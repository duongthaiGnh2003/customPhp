<?php
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : 0;

if ($order_id) {
    $objWp2023Order = new Wp2023Order();
    $order = $objWp2023Order->find($order_id);
    $order_items = $objWp2023Order->order_items($order_id);


    if (isset($_POST['wp2023_save_order'])) {
        check_admin_referer('wp2023-update_order'); // để xác thực nonce khi một form hoặc request được gửi đến
        // Người dùng đang lưu order
        $order_status = isset($_REQUEST['order_status']) ? $_REQUEST['order_status'] : '';
        $note = isset($_REQUEST['note']) ? $_REQUEST['note'] : '';
        $note = sanitize_text_field($note); //àm sạch dữ liệu đầu vào dạng chuỗi

        $objWp2023Order->update($order_id, [
            'status' => $order_status,
            'note'   => $note,
        ]);

        // wp_redirect(admin_url('admin.php?page=wp2023-orders'));
        // exit;
    }
}



?>

<style>
    table.form-table.bordered th,
    td {
        border: 1px solid #ccc;
        text-align: center;
    }
</style>

<div class="wrap">
    <h1 class="wp-heading-inline">Chi tiết đơn hàng: <?= $order->id ?></h1>
    <form id="posts-filter" method="post">
        <?php wp_nonce_field('wp2023-update_order'); ?>
        <!-- nonce (Number Used Once) — một mã bảo mật dùng để xác thực các  (requests) -->
        <div id="poststuff">
            <div id="post-body" class="metabox-holder columns-2">
                <!-- Left columns -->
                <div id="post-body-content">
                    <div style="display: flex; justify-content: space-between; gap: 16px;">
                        <!-- Thông tin đơn hàng -->
                        <div style="flex: 1;" class="postbox">
                            <div class="postbox-header">
                                <h2 class="hndle ui-sortable-handle">Thông tin đơn hàng</h2>
                            </div>
                            <div class="inside">
                                <table class="form-table bordered">
                                    <tr>
                                        <td>Mã đơn hàng</td>
                                        <td><?= $order->id; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Ngày đặt hàng</td>
                                        <td><?= date('d-m-Y', strtotime($order->created)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tên khách hàng</td>
                                        <td><?= $order->customer_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Số điện thoại</td>
                                        <td><?= $order->customer_phone; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?= $order->customer_email; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Địa chỉ</td>
                                        <td><?= esc_html($order->customer_address); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Ghi chú</td>
                                        <td>
                                            <textarea rows="5" class="large-text" name="note"><?= esc_html($order->note); ?></textarea>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                        <!-- Right columns -->
                        <div id="postbox-container-1">
                            <div class="postbox">
                                <div class="postbox-header">
                                    <h2 class="hndle">Hành động</h2>
                                </div>
                                <div class="inside">
                                    <div class="submitbox">
                                        <p>
                                            <select name="order_status" class="large-text">
                                                <option value="pending" <?php echo ($order->status == "pending") ? "selected" : ""; ?>>Đơn hàng mới</option>
                                                <option value="completed" <?php echo ($order->status == "completed") ? "selected" : ""; ?>>Đơn đã hoàn thành</option>
                                                <option value="canceled" <?php echo ($order->status == "canceled") ? "selected" : ""; ?>>Đơn đã hủy</option>
                                            </select>
                                        </p>
                                        <p>
                                            <input type="submit" name="wp2023_save_order" id="wp2023_save_order" value="Lưu thay đổi">
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Chi tiết đơn hàng -->
                    <div class="postbox">
                        <div class="postbox-header">
                            <h2 class="hndle">Chi tiết đơn hàng</h2>
                        </div>
                        <div class="inside">
                            <table class="form-table bordered">
                                <tr>
                                    <th>Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                </tr>

                                <?php foreach ($order_items as $item): ?>
                                    <tr>
                                        <td><?= $item->product_id; ?></td>
                                        <td><?= $item->product_name; ?></td>
                                        <td><?= $item->quantity; ?></td>
                                        <td><?= number_format($item->price); ?>đ</td>
                                    </tr>
                                <?php endforeach; ?>

                            </table>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </form>
</div>