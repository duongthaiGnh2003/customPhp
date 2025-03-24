<?php
// product screen: màn hình chỉnh sửa/ thêm mới sản phẩm
// đăng ký metabox cho sản phẩm
add_action( 'add_meta_boxes', 'wp2023_meta_box_product' );

// can thiệp vào hành động lưu bài viết
add_action( 'save_post', 'wp2023_saved_post_product' );

function wp2023_meta_box_product() { 
		add_meta_box(
			'wp2023_product_info',                 // Unique ID
			'thông tin sản phẩm custom',      // Box title
			'wp2023_meta_box_product_html',  // Content callback, must be of type callable
			"product"                          // Post type
		);
 
}
function wp2023_meta_box_product_html() {
    include_once WP2023_PATH."/includes/templates/meta_boxe_product.php";
}

function wp2023_saved_post_product( $post_id ) {
    if($_REQUEST['post_type'] == 'product' && isset($_POST['product_price'], $_POST['product_price_sale'], $_POST['product_stock'])){ 
    $product_price = $_REQUEST['product_price'];
$product_price_sale = $_REQUEST['product_price_sale'];
$product_stock = $_REQUEST['product_stock'];

/// luu vao database: postmeta
        update_post_meta($post_id,'product_price',$product_price);
        update_post_meta($post_id,'product_price_sale',$product_price_sale);
        update_post_meta($post_id,'product_stock',$product_stock);

}
 
}

// category screen
// đăng ký tên trường cho taxonomy 
// form lúc thêm mới 
add_action('product_cat_add_form_fields', 'wp2023_meta_box_product_cat_add'); //{your name}_edit_form_fields
// form lúc chỉnh sửa\
add_action('product_cat_edit_form_fields', 'wp2023_meta_box_product_cat_edit',10,2);//{your name}_edit_form_fields

function wp2023_meta_box_product_cat_add()  {
    include_once WP2023_PATH."/includes/templates/wp2023_meta_box_product_cat_add.php"; 
}
function wp2023_meta_box_product_cat_edit($tag,$taxonomy)  {
    include_once WP2023_PATH."/includes/templates/wp2023_meta_box_product_cat_edit.php"; 
}

// xử lý khi luu tern
 /*
 * Hook vào sự kiện tạo và chỉnh sửa taxonomy
 * do_action('create_<taxonomy_name>');
 * do_action('edit_<taxonomy_name>');
 */

add_action('create_product_cat', 'wp2023_meta_box_product_cat_save',10,1 );
add_action('edit_product_cat', 'wp2023_meta_box_product_cat_save',10,1);

function wp2023_meta_box_product_cat_save($term_id) {
 
 
    if (isset($_POST['image']) && !empty($_POST['image'])) {
        $image = esc_attr($_POST['image']); // Bảo vệ dữ liệu đầu vào
        update_term_meta($term_id, 'image', $image);
		 
    }
}