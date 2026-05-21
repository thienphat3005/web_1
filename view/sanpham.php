<div class="page-heading" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-content" style="text-align: center;">
                    <h2>Không Gian Sách Hay</h2>
                    <span>Khám phá các tựa sách phù hợp với sở thích của bạn</span>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="section" id="products" style="padding-top: 80px; padding-bottom: 80px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading" style="text-align: center; margin-bottom: 60px;">
                    <h2>Kết Quả Tìm Kiếm / Phân Loại</h2>
                    <span>Hệ thống tự động lọc sách dựa theo lựa chọn của bạn</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            
            <?php 
            // Biến $ds_sanpham được Controller xử lý dựa theo ID danh mục và truyền sang đây
            if (isset($ds_sanpham) && !empty($ds_sanpham)): 
                foreach ($ds_sanpham as $sp): 
                    $link_chitiet = "index.php?act=chitiet&id=" . $sp['id'];
                    $hinh_anh = "../view/assets/images/" . $sp['image'];
            ?>
                <div class="col-lg-4 col-md-6" style="margin-bottom: 40px;">
                    <div class="item">
                        <div class="thumb">
                            <div class="hover-content">
                                <ul>
                                    <li><a href="<?php echo $link_chitiet; ?>"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="<?php echo $link_chitiet; ?>"><i class="fa fa-star"></i></a></li>
                                    <li><a href="<?php echo $link_chitiet; ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <img src="<?php echo $hinh_anh; ?>" alt="<?php echo $sp['name']; ?>" style="width: 100%; height: 350px; object-fit: contain; background-color: #f7f7f7; padding: 10px;">
                        </div>
                        <div class="down-content" style="padding: 20px; border: 1px solid #eee; border-top: none;">
                            <h4 style="font-size: 18px; color: #2a2a2a; margin-bottom: 10px; font-weight: 700; min-height: 44px; line-height: 22px;">
                                <?php echo $sp['name']; ?>
                            </h4>
                            <span style="color: #ea1d25; font-size: 18px; font-weight: 700; display: block; margin-bottom: 10px;">
                                <?php echo number_format($sp['price'], 0, ',', '.'); ?>.000đ
                            </span>
                            <ul class="stars" style="list-style: none; padding: 0; margin: 0;">
                                <?php for($i = 1; $i <= $sp['stars']; $i++): ?>
                                    <li style="display: inline-block; margin-right: 3px;"><i class="fa fa-star" style="color: #f33c3c;"></i></li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php 
                endforeach; 
            else: 
            ?>
                <div class="col-12 text-center" style="padding: 60px 0;">
                    <p style="font-size: 18px; color: #7a7a7a;">Hiện tại chưa có sản phẩm sách nào thuộc danh mục này.</p>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>