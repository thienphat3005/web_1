<?php
class database {
private $servername = "sql207.infinityfree.com"; // Thay bằng Hostname bạn vừa copy
private$username = "if0_41983510";              // Username của bạn
private$password = "vtRv8KJ9KCnQ";          // Mật khẩu bạn đặt lúc tạo tài khoản
private $dbname = "if0_41983510_donhang";   // Lưu ý: Tên DB trên server thường có tiền tố

    public function connection_database() {
        try {
            // Chuỗi kết nối PDO hoàn chỉnh
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname;charset=utf8", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e) {
            echo "Lỗi kết nối: " . $e->getMessage();
            die();
        }
    }
}
?>