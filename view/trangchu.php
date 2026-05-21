<div class="main-banner" id="top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-content" style="text-align: center; background-image: url('../view/assets/images/baner-right-image-04.jpg'); padding: 80px 0; background-size: cover;">
                    <h2 style="color: #fff; font-size: 44px; font-weight: 800; text-transform: uppercase;">Hexashop BookStore</h2>
                    <span style="color: #fff; font-style: italic;">Nơi kết nối tri thức và độc giả</span>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="section" id="men" style="padding-top: 80px; padding-bottom: 80px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading" style="text-align: center; margin-bottom: 60px;">
                    <h2>Sách Mới Xuất Bản</h2>
                    <span>Những tác phẩm tri thức đáng đọc nhất trong tháng</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php 
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
                <div class="col-12 text-center">
                    <p>Hiện chưa có sách nào trong danh sách.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>