<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Hexashop - Shop Bán Sách</title>

    <link rel="stylesheet" type="text/css" href="../view/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../view/assets/css/font-awesome.css">
    <link rel="stylesheet" href="../view/assets/css/templatemo-hexashop.css">
    <link rel="stylesheet" href="../view/assets/css/owl-carousel.css">
    <link rel="stylesheet" href="../view/assets/css/lightbox.css">
  </head>
    
  <body>
    
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  

    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        
                        <a href="index.php?act=trangchu" class="logo">
                            <img src="../view/assets/images/logo.png" onerror="this.src='assets/images/logo.png'" alt="Hexashop Logo">
                        </a>

                        <ul class="nav">
                            <li class="scroll-to-section"><a href="index.php?act=trangchu" class="active">Trang Chủ</a></li>

                            <?php 
                            if (isset($ds_danhmuc) && !empty($ds_danhmuc)):
                                foreach ($ds_danhmuc as $dm): 
                            ?>
                                <li class="scroll-to-section">
                                 
<li><a href="index.php?act=danhmuc&id=<?= $dm['id'] ?>"><?= $dm['ten_danhmuc'] ?></a></li>
                                </li>
                            <?php 
                                endforeach;
                            endif; 
                            ?>
                            
                            <li class="submenu">
                                <a href="javascript:;">Hỗ Trợ</a>
                                <ul>
                                    <li><a href="index.php?act=gioithieu">Giới Thiệu</a></li>
                                    <li><a href="index.php?act=sanpham">Tất Cả Sách</a></li>
                                    <li><a href="index.php?act=lienhe">Liên Hệ</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="index.php?act=giohang" style="font-weight: bold; color: #2a2a2a;">
                                    <i class="fa fa-shopping-cart"></i> Giỏ Hàng 
                                    <?php echo isset($_SESSION['cart']) ? '('.count($_SESSION['cart']).')' : '(0)'; ?>
                                </a>
                            </li>

                            <?php if(isset($_SESSION['user'])): ?>
                                <li class="submenu">
                                    <a href="javascript:;" style="color: #ea1d25; font-weight: bold;">Chào, <?php echo $_SESSION['user']; ?></a>
                                    <ul>
                                        <li><a href="index.php?act=lichsu_donhang"><i class="fa fa-history"></i> Đơn hàng của tôi</a></li>
                                        
                                        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>
                                            <li><a href="index.php?act=admin" style="color: blue; font-weight: bold;"><i class="fa fa-dashboard"></i> Trang Quản Trị</a></li>
                                        <?php endif; ?>
                                        
                                        <li><a href="index.php?act=logout"><i class="fa fa-sign-out"></i> Đăng Xuất</a></li>
                                    </ul>
                                </li>
                            <?php else: ?>
                                <li><a href="index.php?act=taikhoan">Đăng Nhập / Đăng Ký</a></li>
                            <?php endif; ?>
                        </ul>        
                        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <div class="main-content-wrapper" style="margin-top: 100px; padding: 20px;">