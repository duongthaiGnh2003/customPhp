<?php
class Wp2023Order
{ //Định nghĩa một lớp để thao tác với bảng orders trong csdl
    private $_orders = ''; //để lưu tên bảng trong CSDL.
    public function __construct()
    {
        global $wpdb;
        $this->_orders = $wpdb->prefix . 'orders'; // wp_orders
    }

    public function all()
    {
        global $wpdb;
        $sql = "SELECT * FROM $this->_orders";
        $items = $wpdb->get_results($sql);

        return $items;
    }

    public function paginate($limit = 20)
    {
        global $wpdb;
        $paged = isset($_REQUEST['paged']) ? $_REQUEST['paged'] : 1;
        $search = isset($_REQUEST['s']) ? $_REQUEST['s'] : "";
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : "";

        // Lấy tổng số records
        $sql = "SELECT count(id) FROM $this->_orders WHERE deleted = 0";

        $total_items = $wpdb->get_var($sql);

        // Thuật toán phân trang

        $total_pages = ceil($total_items / $limit);
        $offset = ($paged * $limit) - $limit;

        $sql = "SELECT * FROM $this->_orders WHERE deleted = 0";
        // tim kiem
        if ($search) {
            $sql .= " AND (customer_name LIKE '%$search%' OR customer_phone LIKE '%$search%' )";
        }

        switch ($status) {
            case 'pending': {
                    $sql .= " AND status = '$status' ";
                    break;
                }
            case 'completed': {
                    $sql .= " AND status = '$status' ";
                    break;
                }
            case 'canceled': {
                    $sql .= " AND status = '$status' ";
                    break;
                }
            default: {
                }
        };
        $sql .= " ORDER BY id DESC";
        $sql .= " LIMIT $limit OFFSET $offset";


        $items = $wpdb->get_results($sql);
        return [
            'total_page' => $total_pages,
            'total_items' => $total_items,
            'items' => $items
        ];
    }

    public function find($id)
    {
        global $wpdb;
        $sql = "SELECT * FROM $this->_orders WHERE id = $id";
        $item = $wpdb->get_row($sql);
        return $item;
    }

    public function save($data)
    {
        global $wpdb;
        $wpdb->insert($this->_orders, $data);
        $lastId = $wpdb->insert_id;
        $item = $this->find($lastId);
        return $item;
    }

    public function update($id, $data)
    {
        global $wpdb;
        $wpdb->update($this->_orders, $data, [
            'id' => $id
        ]);
        return true;
    }

    public function destroy($id)
    {
        global $wpdb;
        $wpdb->delete($this->_orders, [
            'id' => $id
        ]);
        return true;
    }

    public function trash($id)
    {
        global $wpdb;
        $wpdb->update(
            $this->_orders,
            [
                'deleted' => 1
            ],
            [
                'id' => $id
            ]
        );
        return true;
    }

    public function change_status($order_id, $status)
    {
        global $wpdb;
        $wpdb->update(
            $this->_orders,
            [
                'status' => $status
            ],
            [
                'id' => $order_id
            ]
        );
        return true;
    }
}
