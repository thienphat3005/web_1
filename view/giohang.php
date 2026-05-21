<div class="page-heading" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Giỏ Hàng & Thanh Toán</h2>
                <span>Kiểm tra lại sách đã chọn và nhập địa chỉ nhận hàng</span>
            </div>
        </div>
    </div>
</div>

<div class="container" style="padding-top: 50px; padding-bottom: 80px;">
    <?php if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
        <div class="row">
            <div class="col-lg-7" style="margin-bottom: 30px;">
                <h4 style="font-weight: 700; margin-bottom: 20px;">📚 Sách Đang Chọn</h4>
                <div class="table-responsive">
                    <table class="table table-bordered text-center" style="vertical-align: middle; background: #fff;">
                        <thead class="thead-dark">
                            <tr>
                                <th>Ảnh</th>
                                <th>Tên Sách</th>
                                <th>Giá</th>
                                <th>SL</th>
                                <th>Thành Tiền</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $tong_gio_hang = 0;
                            foreach($_SESSION['cart'] as $id => $item): 
                                $thanh_tien = $item['price'] * $item['quantity'];
                                $tong_gio_hang += $thanh_tien;
                            ?>
                                <tr>
                                    <td><img src="../view/assets/images/<?php echo $item['image']; ?>" style="width: 40px; height: 55px; object-fit: contain;"></td>
                                    <td class="text-left" style="font-weight: 600;"><?php echo $item['name']; ?></td>
                                    <td><?php echo $item['price']; ?>.000đ</td>
                                    <td style="font-weight: bold;"><?php echo $item['quantity']; ?></td>
                                    <td style="color: red; font-weight: bold;"><?php echo $thanh_tien; ?>.000đ</td>
                                    <td>
                                        <a href="index.php?act=cart_xoa&id=<?php echo $id; ?>" class="text-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr style="font-size: 18px; font-weight: bold; background: #f8f9fa;">
                                <td colspan="4" class="text-right">Tổng Đơn Hàng:</td>
                                <td colspan="2" style="color: red;"><?php echo number_format($tong_gio_hang, 0); ?>.000đ</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <a href="index.php?act=trangchu" class="btn btn-outline-dark" style="font-weight: 600;"><i class="fa fa-reply"></i> Tiếp tục mua sách</a>
            </div>

            <div class="col-lg-5">
                <div style="background: #f8f9fa; padding: 25px; border-radius: 8px; border: 1px solid #eee;">
                    <h4 style="font-weight: 700; margin-bottom: 20px;"><i class="fa fa-truck"></i> Thông Tin Giao Hàng</h4>
                    
                    <form action="index.php?act=checkout_process" method="POST">
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label style="font-weight: 600;">Họ và tên người nhận:</label>
                            <input type="text" name="hoten" required class="form-control" placeholder="Ví dụ: Nguyễn Văn A">
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label style="font-weight: 600;">Số điện thoại:</label>
                            <input type="text" name="sdt" required class="form-control" placeholder="Số điện thoại nhận hàng...">
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label style="font-weight: 600;">Địa chỉ nhận sách đầy đủ:</label>
                            <input type="text" name="diachi" required class="form-control" placeholder="Số nhà, tên đường, xã/phường...">
                        </div>

                        <div class="form-group" style="margin-bottom: 20px;">
                            <label style="font-weight: 600; display: block; margin-bottom: 10px;">Phương thức thanh toán:</label>
                            
                            <div class="custom-control custom-radio" style="margin-bottom: 8px;">
                               <input type="radio" id="pt_cod" name="phuongthuc_tt" value="0" checked class="custom-control-input">
                                <label class="custom-control-label" for="pt_cod" style="cursor: pointer; font-weight: 500;">
                                    💵 Thanh toán khi nhận hàng (COD)
                                </label>
                            </div>
                            
                            <div class="custom-control custom-radio">
                                <input type="radio" id="pt_ck" name="phuongthuc_tt" value="1" class="custom-control-input">
                                <label class="custom-control-label" for="pt_ck" style="cursor: pointer; font-weight: 500;">
                                    🏦 Chuyển khoản ngân hàng (Qua mã QR)
                                </label>
                            </div>
                        </div>
                        
                        <input type="hidden" name="tongtien" value="<?php echo $tong_gio_hang; ?>">

                        <button type="submit" name="dathang" class="btn btn-danger btn-block" style="font-weight: 700; padding: 12px; font-size: 16px; background-color: #ea1d25; border: none;">
    XÁC NHẬN ĐẶT HÀNG
</button>
                    </form>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="row text-center">
            <div class="col-12" style="padding: 50px 0;">
                <p style="font-size: 20px; color: #7a7a7a; margin-bottom: 20px;">Giỏ hàng của bạn đang trống trơn!</p>
                <a href="index.php?act=trangchu" class="btn btn-dark" style="font-weight:600;">QUAY LẠI MUA SÁCH NGAY</a>
            </div>
        </div>
    <?php endif; ?>
</div>