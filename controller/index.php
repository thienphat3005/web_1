<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// BẮT BUỘC: Ép hệ thống PHP lấy đúng múi giờ Việt Nam để không bị lỗi quá hạn đơn trên VNPAY
date_default_timezone_set('Asia/Ho_Chi_Minh');

// BẮT BUỘC: Khởi chạy bộ nhớ đệm đầu tiên để tránh lỗi nghẽn Header
ob_start();

// Khởi chạy session ở dòng đầu tiên
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Nhúng file model xử lý dữ liệu
include_once __DIR__ . "/../model/xl_data.php"; 
// 2. Khởi tạo đối tượng
$db_book = new xl_data(); 

// 3. Gọi hàm lấy danh mục sách
$ds_danhmuc = $db_book->get_all_categories(); 

$act = isset($_GET['act']) ? $_GET['act'] : 'trangchu';

// Các trường hợp chỉ xử lý Logic backend (Không hiển thị HTML trực tiếp tại đây)
$is_api_case = in_array($act, ['checkout_process', 'login', 'login_handle', 'register', 'logout', 'admin_duyet_don', 'admin_them', 'admin_xoa', 'admin_update_handle']);

// Tự động nhúng Header cho các trang giao diện
if (!$is_api_case) {
    include __DIR__ . "/../view/header.php"; 
}

switch ($act) {
    case 'trangchu':
        $ds_sanpham = $db_book->get_all_products(); 
        include __DIR__ . "/../view/trangchu.php";
        break;

    case 'sanpham':
        $ds_sanpham = $db_book->get_all_products(); 
        include __DIR__ . "/../view/sanpham.php";
        break;

    case 'danhmuc':
        $id_dm = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $ds_sanpham = $db_book->get_products_by_category($id_dm);
        include __DIR__ . "/../view/sanpham.php";
        break;

    case 'chitiet':
        $id_ct = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id_ct > 0) {
            $kq_chitiet = $db_book->get_product_by_id($id_ct);
            if (!empty($kq_chitiet) && isset($kq_chitiet[0])) {
                $sp_chitiet = $kq_chitiet[0]; 
                $sp = $kq_chitiet[0]; 
            } else {
                $sp_chitiet = ['id'=>'', 'name'=>'Không tồn tại', 'price'=>0, 'image'=>'', 'description'=>'', 'stars'=>5, 'id_danhmuc'=>''];
                $sp = $sp_chitiet;
            }
            
            if (file_exists(__DIR__ . "/../view/chitietsanpham.php")) {
                include __DIR__ . "/../view/chitietsanpham.php";
            } else {
                include __DIR__ . "/../view/chitiet.php";
            }
        } else {
            header("Location: index.php?act=trangchu");
            exit();
        }
        break;

    case 'lienhe':
        include __DIR__ . "/../view/lienhe.php";
        break;

    case 'taikhoan':
        include __DIR__ . "/../view/taikhoan.php";
        break;

    case 'register':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = isset($_POST['username']) ? $_POST['username'] : (isset($_POST['user']) ? $_POST['user'] : '');
            $pass = isset($_POST['password']) ? $_POST['password'] : (isset($_POST['pass']) ? $_POST['pass'] : '');
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            
            if (!empty($user) && !empty($pass)) {
                $db_book->insert_user($user, $pass, $email);
                echo "<script>alert('Đăng ký tài khoản thành công! Hãy đăng nhập.'); window.location.href='index.php?act=taikhoan';</script>";
                exit();
            }
        }
        header("Location: index.php?act=taikhoan");
        exit();
        break;

    case 'login':
    case 'login_handle':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_input = trim($_POST['username'] ?? $_POST['user'] ?? '');
            $pass_input = trim($_POST['password'] ?? $_POST['pass'] ?? '');

            $user = $db_book->check_login($user_input, $pass_input); 
            
            if ($user != false && !empty($user)) {
                $_SESSION['user'] = $user['username']; 
                $_SESSION['user_id'] = $user['id']; 
                $_SESSION['role'] = $user['role'];      
                
                if ($_SESSION['role'] == 1) {
                    echo "<script>alert('Chào mừng Admin trở lại!'); window.location.href='index.php?act=admin';</script>";
                } else {
                    echo "<script>alert('Đăng nhập thành công!'); window.location.href='index.php?act=trangchu';</script>";
                }
                exit();
            } else {
                echo "<script>alert('Sai tài khoản hoặc mật khẩu! Vui lòng thử lại.'); window.location.href='index.php?act=taikhoan';</script>";
                exit();
            }
        }
        break;

    case 'logout':
        session_destroy();
        header("Location: index.php?act=trangchu");
        exit();
        break;

    case 'admin':
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
            header("Location: index.php?act=taikhoan");
            exit();
        }
        $tong_doanh_thu = $db_book->get_total_revenue();
        $don_cho_duyet  = $db_book->count_pending_orders();
        $ds_donhang = $db_book->get_all_orders();
        $ds_sanpham = $db_book->get_all_products();

        include __DIR__ . "/../view/admin.php";
        break;

    case 'admin_duyet_don':
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) { die("Từ chối truy cập."); }
        $id_dh = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $status_moi = isset($_GET['status']) ? intval($_GET['status']) : 0;
        if ($id_dh > 0) {
            $db_book->update_order_status($id_dh, $status_moi);
        }
        header("Location: index.php?act=admin");
        exit();
        break;

    case 'admin_them':
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) { die("Từ chối truy cập."); }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $id_danhmuc = $_POST['id_danhmuc'];
            $description = $_POST['description'];
            
            $image_name = $_FILES['image']['name'];
            $target_file = "../view/assets/images/" . basename($image_name);
            move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

            $db_book->insert_product($name, $price, $image_name, $description, $id_danhmuc);
        }
        header("Location: index.php?act=admin");
        exit();
        break;

    case 'admin_xoa':
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) { die("Từ chối truy cập."); }
        $id_xoa = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id_xoa > 0) {
            $db_book->delete_product($id_xoa);
        }
        header("Location: index.php?act=admin");
        exit();
        break;
    
    case 'admin_sua':
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) { die("Từ chối truy cập."); }
        $id_sua = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id_sua > 0) {
            $kq_query = $db_book->get_product_by_id($id_sua); 
            if (!empty($kq_query) && isset($kq_query[0])) {
                $sp_edit = $kq_query[0]; 
            } else {
                header("Location: index.php?act=admin");
                exit();
            }
            include __DIR__ . "/../view/admin_sua.php";
        } else {
            header("Location: index.php?act=admin");
            exit();
        }
        break;

    case 'admin_update_handle':
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) { die("Từ chối truy cập."); }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $id_danhmuc = $_POST['id_danhmuc'];
            $description = $_POST['description'];
            
            $image_name = "";
            if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];
                $target_file = "../view/assets/images/" . basename($image_name);
                move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
            }
            $db_book->update_product($id, $name, $price, $image_name, $description, $id_danhmuc);
        }
        header("Location: index.php?act=admin");
        exit();
        break;

    case 'giohang':
        include __DIR__ . "/../view/giohang.php";
        break;

    case 'cart_them':
        $id_them = isset($_POST['id']) ? intval($_POST['id']) : (isset($_GET['id']) ? intval($_GET['id']) : 0);
        $soluong_dat = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
        if($soluong_dat <= 0) { $soluong_dat = 1; }

        if ($id_them > 0) {
            $kq = $db_book->get_product_by_id($id_them);
            if (!empty($kq)) {
                $sp = $kq[0];
                if (!isset($_SESSION['cart'])) { $_SESSION['cart'] = []; }

                if (isset($_SESSION['cart'][$id_them])) {
                    $_SESSION['cart'][$id_them]['quantity'] += $soluong_dat;
                } else {
                    $_SESSION['cart'][$id_them] = [
                        'name' => $sp['name'],
                        'price' => $sp['price'],
                        'image' => $sp['image'],
                        'quantity' => $soluong_dat
                    ];
                }
            }
        }
        header("Location: index.php?act=giohang");
        exit();
        break;

    case 'cart_xoa':
        $id_xoa = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id_xoa > 0 && isset($_SESSION['cart'][$id_xoa])) {
            unset($_SESSION['cart'][$id_xoa]);
        }
        header("Location: index.php?act=giohang");
        exit();
        break;

    case 'checkout_process':
        if (isset($_POST['dathang']) || $_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $hoten = isset($_POST['hoten']) ? $_POST['hoten'] : 'Khach hang';
            $sdt = isset($_POST['sdt']) ? $_POST['sdt'] : '';
            $diachi = isset($_POST['diachi']) ? $_POST['diachi'] : '';
            $phuongthuc_tt = isset($_POST['phuongthuc_tt']) ? $_POST['phuongthuc_tt'] : '1';
            
            $id_user = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

            // 1. Tính toán tổng tiền thực tế từ giỏ hàng ngay lập tức
            $tongtien_giohang = 0;
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $item) {
                    $tongtien_giohang += (int)$item['price'] * (int)$item['quantity'];
                }
            }
            
            if ($tongtien_giohang <= 0) {
                $tongtien_giohang = isset($_POST['tongtien']) ? (int)$_POST['tongtien'] : 50;
            }

            // 2. Gọi hàm lưu đơn hàng vào database
            $id_donhang = 0;
            if (method_exists($db_book, 'insert_order')) {
                $id_donhang = $db_book->insert_order($id_user, $hoten, $sdt, $diachi, $tongtien_giohang, $phuongthuc_tt);
            }
            if (empty($id_donhang) || $id_donhang <= 0) {
                $id_donhang = time(); 
            }
         
            if ($phuongthuc_tt == '1') { 
                // Thay vì sang VNPAY, ta đẩy sang trang hiển thị QR
                // Lưu ID đơn hàng vào Session để trang View lấy ra hiển thị
                $_SESSION['last_order_id'] = $id_donhang;
                $_SESSION['last_order_amount'] = $tongtien_giohang;
                
                header('Location: index.php?act=thanh_toan_qr');
                exit();
            } else { 
                unset($_SESSION['cart']);
                echo "<script>alert('Đặt hàng thành công! Đơn hàng của bạn đang được xử lý (COD).'); window.location.href='index.php?act=lichsu_donhang';</script>";
                exit();
            }
        }
        break;

    // Thêm case mới để hiển thị trang QR
    case 'thanh_toan_qr':
        include __DIR__ . "/../view/thanh_toan_qr.php";
        break;

    case 'lichsu_donhang':
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?act=taikhoan");
            exit();
        }
        $ds_donhang_khach = $db_book->get_orders_by_user($_SESSION['user_id']);
        include __DIR__ . "/../view/lichsu_donhang.php";
        break;
}

if (!$is_api_case) {
    include __DIR__ . "/../view/footer.php"; 
}

ob_end_flush();
?>