<div class="page-heading" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Lịch Sử Đơn Hàng Của Bạn</h2>
                <span>Theo dõi tiến độ giao nhận các cuốn sách bạn đã đặt mua</span>
            </div>
        </div>
    </div>
</div>

<div class="container" style="padding-top: 50px; padding-bottom: 80px;">
    <div class="row">
        <div class="col-12">
            <h4 style="font-weight: 700; margin-bottom: 25px;"><i class="fa fa-list-alt"></i> Danh sách đơn hàng</h4>
            
            <?php if(isset($ds_donhang_khach) && !empty($ds_donhang_khach)): ?>
                <div class="table-responsive">
                    <table class="table table-bordered text-center" style="background: #fff; vertical-align: middle;">
                        <thead class="thead-dark">
                            <tr>
                                <th>Mã Đơn</th>
                                <th>Ngày Đặt</th>
                                <th>Địa Chỉ Giao</th>
                                <th>Tổng Tiền</th>
                                <th>Thanh Toán</th>
                                <th>Tình Trạng Đơn Hàng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($ds_donhang_khach as $dh): ?>
                                <tr>
                                    <td style="font-weight: bold; color: #333;">#<?php echo $dh['id']; ?></td>
                                    <td><?php echo isset($dh['ngaydat']) ? $dh['ngaydat'] : date('d/m/Y'); ?></td>
                                    <td class="text-left" style="font-size: 14px;"><?php echo $dh['diachi']; ?></td>
                                    <td style="font-weight: bold; color: red;"><?php echo number_format($dh['tongtien'], 0); ?>.000đ</td>
                                    <td>
                                        <?php echo ($dh['phuongthuc_tt'] == 1) ? '🏦 Chuyển khoản' : '💵 Tiền mặt (COD)'; ?>
                                    </td>
                                    <td>
                                        <?php 
                                        if($dh['trangthai'] == 0) {
                                            echo '<span class="badge badge-warning" style="padding: 8px 12px; font-size: 13px;"><i class="fa fa-spinner fa-spin"></i> Chờ duyệt...</span>';
                                        } elseif($dh['trangthai'] == 1) {
                                            echo '<span class="badge badge-primary" style="padding: 8px 12px; font-size: 13px;"><i class="fa fa-truck"></i> Đang giao hàng</span>';
                                        } elseif($dh['trangthai'] == 2) {
                                            echo '<span class="badge badge-success" style="padding: 8px 12px; font-size: 13px;"><i class="fa fa-check-circle"></i> Đã giao thành công</span>';
                                        } else {
                                            echo '<span class="badge badge-danger" style="padding: 8px 12px; font-size: 13px;"><i class="fa fa-times"></i> Đã hủy</span>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center" style="padding: 40px; background: #f8f9fa; border-radius: 8px;">
                    <p style="color: #7a7a7a; font-size: 16px;">Bạn chưa đặt mua đơn hàng nào tại hệ thống.</p>
                    <a href="index.php?act=trangchu" class="btn btn-dark style="margin-top: 15px;">Khám phá kho sách ngay</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>