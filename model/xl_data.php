<?php

include_once "../model/database.php";

class xl_data extends database {
    // Thêm thuộc tính để lưu kết nối, đỡ phải gọi đi gọi lại hàm connection_database()
    private $db;

    public function __construct(){
        // Khởi tạo kết nối ngay khi đối tượng được tạo
        $this->db = $this->connection_database();
    }
    
    // Hàm thực hiện câu sql có lấy giá trị trả về
    function readitem($sql): array{
        $result = $this->db->query($sql);
        $danhsach = $result->fetchAll(PDO::FETCH_ASSOC); // Thêm FETCH_ASSOC để mảng gọn gàng hơn
        return $danhsach;
    }   

    // Hàm thực hiện câu sql không lấy giá trị trả về
    function execute_item($sql): void{
        $this->db->query($sql);
    }

    /* ==========================================================
       HỆ THỐNG XỬ LÝ SÁCH VÀ DANH MỤC
       ========================================================== */

    // 1. Hàm lấy toàn bộ danh mục sách
    function get_all_categories(): array {
        $sql = "SELECT * FROM danhmuc ORDER BY id DESC";
        return $this->readitem($sql);
    }

    // 2. Hàm lấy tất cả sách
    function get_all_products(): array {
        $sql = "SELECT * FROM sanpham ORDER BY id DESC";
        return $this->readitem($sql);
    }

    // 3. Hàm lấy sách theo đúng mã danh mục
    function get_products_by_category($id_danhmuc): array {
        $sql = "SELECT * FROM sanpham WHERE id_danhmuc = " . intval($id_danhmuc) . " ORDER BY id DESC";
        return $this->readitem($sql);
    }

    // 4. Hàm lấy 1 cuốn sách chi tiết theo ID
    function get_product_by_id($id) {
        $sql = "SELECT * FROM sanpham WHERE id = " . intval($id);
        return $this->readitem($sql); 
    }

    // 5. Hàm thêm sách mới kèm upload ảnh
    function insert_product($name, $price, $image_name, $description, $id_danhmuc): void {
        $sql = "INSERT INTO sanpham (name, price, image, description, id_danhmuc, stars) 
                VALUES ('$name', '$price', '$image_name', '$description', '$id_danhmuc', 5)";
        $this->execute_item($sql);
    }

    // 6. Hàm xóa sách theo ID
    function delete_product($id): void {
        $sql = "DELETE FROM sanpham WHERE id = " . intval($id);
        $this->execute_item($sql);
    }

    // 7. Hàm cập nhật thông tin sách (Sửa)
    function update_product($id, $name, $price, $image_name, $description, $id_danhmuc): void {
        if (!empty($image_name)) {
            $sql = "UPDATE sanpham SET name='$name', price='$price', image='$image_name', description='$description', id_danhmuc='$id_danhmuc' WHERE id=" . intval($id);
        } else {
            $sql = "UPDATE sanpham SET name='$name', price='$price', description='$description', id_danhmuc='$id_danhmuc' WHERE id=" . intval($id);
        }
        $this->execute_item($sql);
    }

    /* ==========================================================
       HỆ THỐNG QUẢN LÝ TÀI KHOẢN (ĐÃ ĐỒNG BỘ BẢNG TAIKHOAN)
       ========================================================== */

    // 8. Hàm kiểm tra đăng nhập cũ
    function check_user($user, $pass): array {
        $sql = "SELECT * FROM taikhoan WHERE user = '$user' AND pass = '$pass'";
        return $this->readitem($sql);
    }

   
   // 9. Hàm đăng ký tài khoản mới (ĐÃ SỬA)
function insert_user($username, $password, $email): void {
    // Thay đổi 'user' thành 'username' và 'pass' thành 'password'
    $sql = "INSERT INTO taikhoan (username, password, email, role) 
            VALUES ('$username', '$password', '$email', 0)";
    $this->execute_item($sql);
}

  // ĐÃ SỬA: Dùng $this->db thay vì $this->pdo để khớp với thuộc tính đã khai báo trong class
    function check_login($username, $password) {
        // Sử dụng prepare để chống SQL Injection
        // Lưu ý: $this->db là biến kết nối bạn đã khởi tạo trong __construct()
        $sql = "SELECT * FROM taikhoan WHERE username = ? AND password = ? LIMIT 1";
        
        $stmt = $this->db->prepare($sql); // Dùng $this->db thay vì $this->pdo
        $stmt->execute([$username, $password]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        if (!empty($result)) {
            return $result[0];
        }
        return false;
    }
    /* ==========================================================
       HỆ THỐNG XỬ LÝ ĐƠN HÀNG (ADMIN & CHECKOUT)
       ========================================================== */

    // 10. Lấy tổng doanh thu từ các đơn hàng đã duyệt hoặc đã giao (trangthai = 1 hoặc 2)
    function get_total_revenue(): int {
        $sql = "SELECT SUM(tongtien) as doanh_thu FROM donhang WHERE trangthai IN (1, 2)";
        $result = $this->readitem($sql);
        return isset($result[0]['doanh_thu']) ? intval($result[0]['doanh_thu']) : 0;
    }

    // 11. Đếm tổng số đơn hàng đang chờ duyệt (trangthai = 0)
    function count_pending_orders(): int {
        $sql = "SELECT COUNT(*) as songuoi FROM donhang WHERE trangthai = 0";
        $result = $this->readitem($sql);
        return isset($result[0]['songuoi']) ? intval($result[0]['songuoi']) : 0;
    }

    // 12. Lấy toàn bộ danh sách đơn hàng mới nhất
    function get_all_orders(): array {
        $sql = "SELECT * FROM donhang ORDER BY id DESC";
        return $this->readitem($sql);
    }

   // 13. Cập nhật trạng thái đơn hàng (Duyệt đơn / Hủy đơn)
    function update_order_status($id_donhang, $trangthai_moi): void {
    // Ép kiểu ID và trạng thái về số nguyên để tránh lỗi SQL
    $sql = "UPDATE donhang SET trangthai = " . intval($trangthai_moi) . " WHERE id = " . intval($id_donhang);
    $this->execute_item($sql);
}

    // 14. Thêm đơn hàng mới và trả về ID vừa chèn (Thêm try-catch chống xoay trang)
    function insert_order($id_user, $hoten, $sdt, $diachi, $tongtien, $phuongthuc_tt): int {
        try {
            $sql = "INSERT INTO donhang (id_user, hoten, sdt, diachi, tongtien, phuongthuc_tt, trangthai) 
                    VALUES ('$id_user', '$hoten', '$sdt', '$diachi', '$tongtien', '$phuongthuc_tt', 0)";
            $this->execute_item($sql);
            
            $sql_id = "SELECT LAST_INSERT_ID() as last_id";
            $result = $this->readitem($sql_id);
            return isset($result[0]['last_id']) ? intval($result[0]['last_id']) : 0;
        } catch (Exception $e) {
            return 0; // Trả về 0 lập tức nếu lỗi kết nối database, chặn đứng việc xoay trang vô tận
        }
    }

    // 15. Thêm chi tiết từng cuốn sách trong đơn hàng
    function insert_order_detail($id_donhang, $id_sanpham, $soluong, $gia): void {
        $sql = "INSERT INTO chitietdonhang (id_donhang, id_sanpham, soluong, gia) 
                VALUES ('$id_donhang', '$id_sanpham', '$soluong', '$gia')";
        $this->execute_item($sql);
    }

    // 16. Hàm lấy lịch sử mua hàng của 1 khách hàng cụ thể
    function get_orders_by_user($id_user) {
        $sql = "SELECT * FROM donhang WHERE id_user = " . intval($id_user) . " ORDER BY id DESC";
        return $this->readitem($sql);
    }
}
?>