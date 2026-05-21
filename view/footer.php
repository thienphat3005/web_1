</div> <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="first-item">
                        <div class="logo">
                            <img src="../view/assets/images/white-logo.png" alt="hexashop ecommerce templatemo">
                        </div>
                        <ul>
                            <li><a href="#">Số 1 Đường ABC, TP. Hồ Chí Minh, Việt Nam</a></li>
                            <li><a href="#">caothienphat@company.com</a></li>
                            <li><a href="#">0123-456-789</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <h4>Danh Mục Sách</h4>
                    <ul>
                        <li><a href="index.php?act=danhmuc">Quản lý danh mục</a></li>
                        <li><a href="index.php?act=sanpham">Quản lý sách</a></li>
                        <li><a href="index.php?act=donhang">Quản lý đơn hàng</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4>Liên Kết Nhanh</h4>
                    <ul>
                        <li><a href="index.php">Trang chủ</a></li>
                        <li><a href="#">Giới thiệu</a></li>
                        <li><a href="#">Liên hệ</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4>Hỗ Trợ Khách Hàng</h4>
                    <ul>
                        <li><a href="#">Chính sách đổi trả</a></li>
                        <li><a href="#">Hướng dẫn mua hàng</a></li>
                        <li><a href="#">Điều khoản dịch vụ</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="under-footer">
                        <p>Copyright © 2026 Cao Thiên Phát Shop. All Rights Reserved. 
                        <br>Design: <a href="https://templatemo.com" target="_parent" title="free css templates">TemplateMo</a></p>
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-behance"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="../view/assets/js/jquery-2.1.0.min.js"></script>

    <script src="../view/assets/js/popper.js"></script>
    <script src="../view/assets/js/bootstrap.min.js"></script>

    <script src="../view/assets/js/owl-carousel.js"></script>
    <script src="../view/assets/js/accordions.js"></script>
    <script src="../view/assets/js/datepicker.js"></script>
    <script src="../view/assets/js/scrollreveal.min.js"></script>
    <script src="../view/assets/js/waypoints.min.js"></script>
    <script src="../view/assets/js/jquery.counterup.min.js"></script>
    <script src="../view/assets/js/imgfix.min.js"></script> 
    <script src="../view/assets/js/slick.js"></script> 
    <script src="../view/assets/js/lightbox.js"></script> 
    <script src="../view/assets/js/isotope.js"></script> 
    
    <script src="../view/assets/js/custom.js"></script>

    <script>
        $(function() {
            var selectedClass = "";
            $("p").click(function(){
                selectedClass = $(this).attr("data-rel");
                $("#portfolio").fadeTo(50, 0.1);
                $("#portfolio div").not("."+selectedClass).fadeOut();
                setTimeout(function() {
                    $("."+selectedClass).fadeIn();
                    $("#portfolio").fadeTo(50, 1);
                }, 500);
            });
        });
    </script>

</body>
</html>