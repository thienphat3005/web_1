<?php
$id_dh = $_SESSION['last_order_id'];
$amount = $_SESSION['last_order_amount'] * 1000;
$noi_dung = "DH" . $id_dh;

// Thay thông tin ngân hàng của bạn vào đây
// Cấu trúc: VietQR-TênNgânHàng-SốTàiKhoản-KiểuQR
$qr_url = "https://img.vietqr.io/image/MB-5882202104-compact2.png?amount={$amount}&addInfo={$noi_dung}&accountName=CAO%20THIEN%20PHAT";
?>

<img src="<?php echo $qr_url; ?>" alt="Quét mã QR để thanh toán" style="width: 300px;">
<div id="status-message" style="text-align: center; color: blue; font-weight: bold; margin: 20px 0;">
    Đang chờ xác nhận thanh toán... Vui lòng không đóng trình duyệt.
</div>

<script>
    // Lấy ID đơn hàng từ biến PHP của bạn
    var orderId = <?php echo $id_dh; ?>; 

    var checkInterval = setInterval(function() {
        // Gọi tới controller kiểm tra trạng thái
        // Lưu ý: Nếu file này nằm trong thư mục view, hãy dùng '../controller/check_status.php'
        fetch('../controller/check_status.php?id=' + orderId)
            .then(response => response.json())
            .then(data => {
                if (data.trangthai == 1) {
                    clearInterval(checkInterval); // Dừng việc kiểm tra lại
                    document.getElementById('status-message').innerHTML = "Thanh toán thành công! Đang chuyển hướng...";
                    document.getElementById('status-message').style.color = "green";
                    
                    // Chờ 1.5 giây để người dùng nhìn thấy thông báo thành công
                    setTimeout(function() {
                        window.location.href = "index.php?act=lichsu_donhang";
                    }, 1500);
                }
            })
            .catch(error => console.error('Lỗi kết nối:', error));
    }, 2000); // Tự động kiểm tra mỗi 2 giây
</script>