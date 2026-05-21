<?php
include_once "../model/xl_data.php";
$db = new xl_data();

// Kiểm tra ID có tồn tại không
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Câu lệnh truy vấn đơn hàng
    $sql = "SELECT trangthai FROM donhang WHERE id = $id";
    $result = $db->readitem($sql); // Đảm bảo hàm này trả về mảng hoặc đối tượng

    if (!empty($result)) {
        // Trả về JSON để JavaScript hiểu
        echo json_encode(['trangthai' => $result[0]['trangthai']]);
    } else {
        echo json_encode(['trangthai' => 0]);
    }
}
?>