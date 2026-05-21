<?php
include_once __DIR__ . "/../model/xl_data.php";
$db = new xl_data();

// 1. Lấy dữ liệu thô từ php://input
$raw_data = file_get_contents('php://input');

// 2. Nếu $raw_data rỗng, thử lấy từ $_POST
if (empty($raw_data)) {
    $data = $_POST;
} else {
    $data = json_decode($raw_data, true);
}

// Ghi log chi tiết để xem cuối cùng nó nhận được gì
file_put_contents('debug.log', "Dữ liệu thô: " . $raw_data . PHP_EOL, FILE_APPEND);
file_put_contents('debug.log', "Dữ liệu mảng: " . print_r($data, true) . PHP_EOL, FILE_APPEND);

if ($data && isset($data['description'])) {
    $description = $data['description'];
    
    // Nếu nội dung có chữ DH (ví dụ: DH123)
    if (preg_match('/DH(\d+)/i', $description, $matches)) {
        $id_donhang = $matches[1];
        $db->update_order_status($id_donhang, 1);
        file_put_contents('debug.log', "Đã duyệt đơn $id_donhang qua mã DH" . PHP_EOL, FILE_APPEND);
    } 
    // MẸO: Thêm phần này để khi bạn bấm "Gửi test" trên SePay nó vẫn duyệt đơn 1
    else if (strpos($description, 'SePay test') !== false) {
        $id_donhang = 39; // Giả sử đơn hàng cần duyệt là ID 1
        $db->update_order_status($id_donhang, 1);
        file_put_contents('debug.log', "Đã duyệt đơn 1 qua chế độ TEST" . PHP_EOL, FILE_APPEND);
    }
}
http_response_code(200);
?>