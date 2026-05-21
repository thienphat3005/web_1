<div class="page-heading" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-content">
                    <h2>Thông Tin Chi Tiết</h2>
                    <span>Khám phá nội dung và giá trị của cuốn sách bạn yêu thích</span>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="section" id="product" style="padding-top: 60px; padding-bottom: 60px;">
    <div class="container">
        <div class="row">
            
            <?php 
            if (isset($sp_chitiet) && !empty($sp_chitiet)): 
                $hinh_anh = "../view/assets/images/" . $sp_chitiet['image'];
            ?>
                <div class="col-lg-6">
                    <div class="left-images" style="text-align: center; background: #f7f7f7; padding: 20px; border-radius: 8px;">
                        <img src="<?php echo $hinh_anh; ?>" alt="<?php echo $sp_chitiet['name']; ?>" style="max-height: 500px; object-fit: contain; max-width: 100%;">
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="right-content" style="padding-left: 20px;">
                        <h4 style="font-size: 28px; font-weight: 700; color: #2a2a2a; margin-bottom: 15px;">
                            <?php echo $sp_chitiet['name']; ?>
                        </h4>
                        
                        <span class="price" style="font-size: 24px; color: #ea1d25; font-weight: 700; display: block; margin-bottom: 15px;">
                            <?php echo number_format($sp_chitiet['price'], 0, ',', '.'); ?>.000đ
                        </span>
                        
                        <ul class="stars" style="list-style: none; padding: 0; margin-bottom: 20px;">
                            <?php 
                            // Đề phòng nếu cột 'stars' trong DB trống thì mặc định hiện 5 sao
                            $rating = isset($sp_chitiet['stars']) ? intval($sp_chitiet['stars']) : 5;
                            for($i = 1; $i <= $rating; $i++): 
                            ?>
                                <li style="display: inline-block; margin-right: 3px;"><i class="fa fa-star" style="color: #f33c3c;"></i></li>
                            <?php endfor; ?>
                        </ul>
                        
                        <div class="quote" style="background-color: #f8f9fa; border-left: 4px solid #ea1d25; padding: 15px; margin-bottom: 25px; border-radius: 4px;">
                            <i class="fa fa-quote-left" style="color: #ea1d25; margin-bottom: 10px;"></i>
                            <p style="font-style: italic; color: #4a4a4a; line-height: 24px;">
                                <?php echo $sp_chitiet['description']; ?>
                            </p>
                        </div>
                        
                        <form action="index.php?act=cart_them" method="POST">
                            <input type="hidden" name="id" value="<?php echo $sp_chitiet['id']; ?>">
                            
                            <div class="quantity-content" style="margin-bottom: 25px; display: flex; align-items: center;">
                                <div class="left-content" style="margin-right: 20px;">
                                    <h6 style="font-weight: 700; margin: 0;">Số lượng đặt mua:</h6>
                                </div>
                                <div class="right-content">
                                    <div class="quantity buttons_added">
                                        <input type="button" value="-" class="minus" onclick="giamSoLuong()">
                                        <input type="number" step="1" min="1" max="99" name="quantity" id="soluong_mua" value="1" title="Qty" class="input-text qty text" size="4" style="text-align: center; width: 60px; border: 1px solid #ddd; height: 35px; margin: 0 5px;">
                                        <input type="button" value="+" class="plus" onclick="tangSoLuong()">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="total" style="border-top: 1px solid #eee; padding-top: 20px;">
                                <div class="main-border-button">
                                    <button type="submit" class="btn btn-dark" style="padding: 12px 30px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">
                                        <i class="fa fa-shopping-cart"></i> Thêm Vào Giỏ Hàng
                                    </button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            <?php 
            else: 
            ?>
                <div class="col-12 text-center" style="padding: 100px 0;">
                    <h3 style="color: red;">Không tìm thấy thông tin cuốn sách này!</h3>
                    <a href="index.php?act=trangchu" class="btn btn-outline-dark" style="margin-top:20px;">Quay lại trang chủ</a>
                </div>
            <?php endif; ?>
            
        </div>
    </div>
</section>

<script>
function tangSoLuong() {
    var input = document.getElementById('soluong_mua');
    var value = parseInt(input.value, 10);
    value = isNaN(value) ? 1 : value;
    if(value < 99) {
        input.value = value + 1;
    }
}

function giamSoLuong() {
    var input = document.getElementById('soluong_mua');
    var value = parseInt(input.value, 10);
    value = isNaN(value) ? 1 : value;
    if(value > 1) {
        input.value = value - 1;
    }
}
</script>