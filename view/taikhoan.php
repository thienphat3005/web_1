<div class="page-heading" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Tài Khoản Hệ Thống</h2>
                <span>Đăng nhập để mua hàng hoặc tạo tài khoản mới chỉ trong vài giây</span>
            </div>
        </div>
    </div>
</div>

<div class="container" style="padding-top: 60px; padding-bottom: 80px;">
    <div class="row">
        <div class="col-lg-5" style="margin-bottom: 40px;">
            <div style="background: #f8f9fa; padding: 30px; border-radius: 8px; border: 1px solid #eee;">
                <h4 style="font-weight: 700; margin-bottom: 20px; color: #2a2a2a;"><i class="fa fa-sign-in"></i> Đăng Nhập</h4>
                
                <form action="index.php?act=login" method="POST">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label style="font-weight: 600;">Tên đăng nhập:</label>
                        <input type="text" name="user" required class="form-control" placeholder="Tên tài khoản...">
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="font-weight: 600;">Mật khẩu:</label>
                        <input type="password" name="pass" required class="form-control" placeholder="Mật khẩu...">
                    </div>
                    <button type="submit" class="btn btn-dark btn-block" style="font-weight: 600; padding: 10px;">ĐĂNG NHẬP</button>
                </form>
            </div>
        </div>

        <div class="col-lg-2 text-center d-none d-lg-block">
            <div style="border-left: 1px dashed #ccc; height: 100%; margin: 0 auto; width: 1px;"></div>
        </div>

        <div class="col-lg-5">
            <div style="background: #f8f9fa; padding: 30px; border-radius: 8px; border: 1px solid #eee;">
                <h4 style="font-weight: 700; margin-bottom: 20px; color: #2a2a2a;"><i class="fa fa-user-plus"></i> Đăng Ký Thành Viên</h4>
                
                <form action="index.php?act=register" method="POST">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label style="font-weight: 600;">Tên đăng nhập mới:</label>
                        <input type="text" name="user" required class="form-control" placeholder="Ví dụ: nva123">
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label style="font-weight: 600;">Địa chỉ Email:</label>
                        <input type="email" name="email" required class="form-control" placeholder="Ví dụ: nguyenvana@gmail.com">
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="font-weight: 600;">Mật khẩu mật:</label>
                        <input type="password" name="pass" required class="form-control" placeholder="Tối thiểu 6 ký tự...">
                    </div>
                    <button type="submit" class="btn btn-danger btn-block" style="font-weight: 600; padding: 10px; background-color: #ea1d25;">ĐĂNG KÝ TÀI KHOẢN</button>
                </form>
            </div>
        </div>
    </div>
</div>