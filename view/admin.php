<div class="page-heading" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>HỆ THỐNG QUẢN TRỊ - HEXASHOP BOOKSTORE</h2>
                <p class="text-white">Báo cáo doanh thu, xử lý đơn hàng và quản lý kho sách</p>
            </div>
        </div>
    </div>
</div>

<div class="container" style="padding-top: 40px; padding-bottom: 80px;">
    
    <div class="row text-center" style="margin-bottom: 40px;">
        <div class="col-md-6" style="margin-bottom: 15px;">
            <div style="background: #28a745; color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <h3 style="font-size: 18px; font-weight: 600; text-transform: uppercase;">💰 Tổng Doanh Thu Thực Tế</h3>
                <h2 style="font-size: 36px; font-weight: 800; margin-top: 10px;">
                    <?php echo number_format($tong_doanh_thu, 0, ',', '.'); ?>.000đ
                </h2>
                <small>* Tính từ các đơn hàng đã được duyệt hoặc giao thành công</small>
            </div>
        </div>
        <div class="col-md-6" style="margin-bottom: 15px;">
            <div style="background: #ffc107; color: #212529; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <h3 style="font-size: 18px; font-weight: 600; text-transform: uppercase;">📦 Đơn Hàng Chờ Duyệt</h3>
                <h2 style="font-size: 36px; font-weight: 800; margin-top: 10px;">
                    <?php echo $don_cho_duyet; ?> Đơn hàng
                </h2>
                <small>* Cần kiểm tra và bấm duyệt gửi cho khách ngay</small>
            </div>
        </div>
    </div>

    <hr style="margin-bottom: 40px;">

    <div class="row" style="margin-bottom: 50px;">
        <div class="col-12">
            <h4 style="font-weight: 700; margin-bottom: 20px; color: #2a2a2a;"><i class="fa fa-shopping-bag"></i> Danh Sách Duyệt Đơn Hàng</h4>
            <div class="table-responsive">
                <table class="table table-bordered" style="vertical-align: middle; background: #fff;">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>Mã Đơn</th>
                            <th>Khách Hàng / SĐT</th>
                            <th>Địa Chỉ Giao Hàng</th>
                            <th>Tổng Tiền</th>
                            <th>Trạng Thái</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($ds_donhang as $dh): ?>
                            <tr>
                                <td class="text-center" style="font-weight: bold;">#DH-<?php echo $dh['id']; ?></td>
                                <td>
                                    <strong><?php echo $dh['hoten']; ?></strong><br>
                                    <small class="text-muted">SĐT: <?php echo $dh['sdt']; ?></small>
                                </td>
                                <td><?php echo $dh['diachi']; ?></td>
                                <td class="text-center" style="font-weight: bold; color: #ea1d25;"><?php echo number_format($dh['tongtien'], 0); ?>.000đ</td>
                                <td class="text-center">
                                    <?php 
                                        if($dh['trangthai'] == 0) echo '<span class="badge badge-warning" style="padding:8px;">Chờ duyệt</span>';
                                        elseif($dh['trangthai'] == 1) echo '<span class="badge badge-primary" style="padding:8px;">Đã duyệt</span>';
                                        elseif($dh['trangthai'] == 2) echo '<span class="badge badge-success" style="padding:8px;">Đã giao</span>';
                                        else echo '<span class="badge badge-secondary" style="padding:8px;">Đã hủy</span>';
                                    ?>
                                </td>
                                
                                <td class="text-center">
                                    <?php if($dh['trangthai'] == 0): ?>
                                        <a href="index.php?act=admin_duyet_don&id=<?php echo $dh['id']; ?>&status=1" class="btn btn-success btn-sm" style="font-weight:600;">Duyệt Đơn</a>
                                        <a href="index.php?act=admin_duyet_don&id=<?php echo $dh['id']; ?>&status=3" class="btn btn-danger btn-sm" onclick="return confirm('Hủy đơn này?')">Hủy</a>
                                    <?php else: ?>
                                        <span class="text-muted">Xử lý xong</span>
                                    <?php endif; ?>
                                </td>
                                <td>
    <?php echo ($dh['phuongthuc_tt'] == 1) ? '🏦 Chuyển khoản' : '💵 Tiền mặt (COD)'; ?>
</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <hr style="margin-bottom: 40px;">

    <div class="row">
        <div class="col-lg-4" style="margin-bottom: 40px;">
            <div style="background: #f8f9fa; padding: 25px; border-radius: 8px; border: 1px solid #eee;">
                <h5 style="font-weight: 700; margin-bottom: 20px; color: #2a2a2a;">Thêm Sách Vào Kho</h5>
                <form action="index.php?act=admin_them" method="POST" enctype="multipart/form-data">
                    <div class="form-group" style="margin-bottom: 12px;">
                        <label>Tên sách:</label>
                        <input type="text" name="name" required class="form-control">
                    </div>
                    <div class="form-group" style="margin-bottom: 12px;">
                        <label>Giá bán (.000đ):</label>
                        <input type="number" name="price" required class="form-control">
                    </div>
                    <div class="form-group" style="margin-bottom: 12px;">
                        <label>Danh mục:</label>
                        <select name="id_danhmuc" class="form-control">
                            <?php foreach ($ds_danhmuc as $dm): ?>
                                <option value="<?php echo $dm['id']; ?>"><?php echo $dm['ten_danhmuc']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group" style="margin-bottom: 12px;">
                        <label>Ảnh bìa sách:</label>
                        <input type="file" name="image" required class="form-control-file">
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Mô tả sách:</label>
                        <textarea name="description" rows="3" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block" style="font-weight:600;">THÊM SÁCH</button>
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <h5 style="font-weight: 700; margin-bottom: 20px; color: #2a2a2a;">Danh Sách Sách Trong Kho</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>Ảnh</th>
                            <th>Tên Sách</th>
                            <th>Giá Cả</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($ds_sanpham as $sp): ?>
                            <tr>
                                <td class="text-center"><img src="../view/assets/images/<?php echo $sp['image']; ?>" style="width: 40px; height: 55px; object-fit: contain; background: #eee;"></td>
                                <td style="font-weight: 600;"><?php echo $sp['name']; ?></td>
                                <td class="text-center" style="color: red; font-weight: 600;"><?php echo number_format($sp['price'], 0); ?>.000đ</td>
                                <td class="text-center">
                                    <a href="index.php?act=admin_sua&id=<?php echo $sp['id']; ?>" class="btn btn-warning btn-sm" style="font-weight: 600; margin-right: 5px;">  <i class="fa fa-edit"></i> Sửa</a>
                                    <a href="index.php?act=admin_xoa&id=<?php echo $sp['id']; ?>" onclick="return confirm('Xóa cuốn này?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>