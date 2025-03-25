<?php
/*
RestAPI:
RESTFUL API là một tiêu chuẩn dùng trong việc thiết kế API cho các ứng dụng webservice.
Web services là một tập hợp các giao thức và tiêu chuẩn mở được sử dụng để trao đổi
dữ liệu giữa các ứng dụng, các hệ thống.

REST hoạt động dựa chủ yếu trên phương thức CRUD (Create, Read, Update, Delete)
tương đương với 4 giao thức HTTP: POST, GET, PUT, DELETE.

Xây dựng rest api cho tài nguyên orders

GET     - /orders           - lấy toàn bộ orders
POST    - /orders           - thêm mới order

GET     - /orders/{id}      - lấy chi tiết order theo tham số id
PUT     - /orders/{id}      - cập nhật order theo tham số id
DELETE  - /orders/{id}      - xóa order theo tham số id
*/

add_action('rest_api_init', 'wp2023_apis'); //rest_api_init: cố định

function wp2023_apis()
{
    $nameSpace = 'wp2023/v1';
    $base = 'orders';
    register_rest_route(
        $nameSpace,
        '/' . $base,
        [
            [
                'methods' => WP_REST_Server::READABLE,
                'callback' => 'wp2023_apis_order_all'
            ],
            [
                'methods' => WP_REST_Server::CREATABLE, // CREATABLE : tương đương post
                'callback' => 'wp2023_apis_order_store'
            ],
        ]
    );



    // http://yourdomain.com/wp-json/wp2023/v1/orders/5
    register_rest_route($nameSpace, '/' . $base . '/(?P<id>[\d]+)', [ // (?P<id>[\d]+) : là biểu thức chính quy (regex) được dùng để bắt tham số id
        [
            'methods' => WP_REST_Server::READABLE,
            'callback' => 'wp2023_apis_order_show'
        ],
        [
            'methods' => WP_REST_Server::EDITABLE,  // EDITABLE : tương đương Put
            'callback' => 'wp2023_apis_order_update'
        ],
        [
            'methods' => WP_REST_Server::DELETABLE,  //  delete
            'callback' => 'wp2023_apis_order_destroy'
        ],
        [
            'methods' => WP_REST_Server::DELETABLE,
            'callback' => 'wp2023_apis_order_trash'
        ],
    ]);
    register_rest_route($nameSpace, '/' . $base . '/soft-delete/(?P<id>[\d]+)', [
        [
            'methods' => WP_REST_Server::DELETABLE,
            'callback' => 'wp2023_apis_order_trash'
        ],
    ]);

    function wp2023_apis_order_all()
    {
        $Wp2023OrderClass = new Wp2023Order();
        $resuilt = $Wp2023OrderClass->paginate(10);
        return  new WP_REST_Response([
            "data" => $resuilt,

        ], 200);
    }

    function wp2023_apis_order_store()
    {

        $required = ['total', 'payment_method', 'customer_name', 'customer_phone', 'customer_email'];
        $filterMissingFields = array_filter($required, fn($f) => empty($_POST[$f]));

        if (count($filterMissingFields)) {
            return new WP_Error(
                'missing_fields',
                'Thiếu thông tin đơn hàng: ' . implode(', ', $filterMissingFields), // implode: chuyển một mảng thành chuỗi, nối các phần tử lại bằng một ký tự phân cách 
                ['status' => 400]
            );
        }
        $Wp2023OrderClass = new Wp2023Order();
        $resuilt = $Wp2023OrderClass->save($_POST);

        return  new WP_REST_Response([
            "data" => $resuilt,
        ]);
    }

    function wp2023_apis_order_show($request)
    {
        $Wp2023OrderClass = new Wp2023Order();

        $resuilt = $Wp2023OrderClass->find($request['id']);

        return  new WP_REST_Response([
            "data" => $resuilt,

        ]);
    }

    function wp2023_apis_order_update($request)
    {

        $Wp2023OrderClass = new Wp2023Order();
        $resuilt = $Wp2023OrderClass->update($request['id'], $_POST);

        return new WP_REST_Response([
            "data" => $resuilt,
        ], 201);

        print_r($_POST);
    }
    function wp2023_apis_order_destroy($request)
    {

        $Wp2023OrderClass = new Wp2023Order();

        $resuilt = $Wp2023OrderClass->destroy($request['id']);

        return  new WP_REST_Response([
            "data" => $resuilt,

        ]);
    }

    function wp2023_apis_order_trash($request)
    {

        $Wp2023OrderClass = new Wp2023Order();

        $resuilt = $Wp2023OrderClass->trash($request['id']);

        return  new WP_REST_Response([
            "data" => $resuilt,

        ]);
    }
}
