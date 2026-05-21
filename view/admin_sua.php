<div class="page-heading" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Cập Nhật Thông Tin Sách</h2>
                <span>Chỉnh sửa giá cả, ảnh bìa hoặc nội dung tóm tắt của cuốn sách</span>
            </div>
        </div>
    </div>
</div>

<div class="container" style="padding-top: 50px; padding-bottom: 80px;">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div style="background: #f8f9fa; padding: 30px; border-radius: 8px; border: 1px solid #eee; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                <h4 style="font-weight: 700; margin-bottom: 25px; color: #2a2a2a;">
                    <i class="fa fa-edit"></i> Chỉnh Sửa Sản Phẩm
                </h4>
                
                <form action="index.php?act=admin_update_handle" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $sp_edit['id']; ?>">

                    <div class="form-group" style="margin-bottom: 15px;">
                        <label style="font-weight: 600;">Tên cuốn sách:</label>
                        <input type="text" name="name" value="<?php echo $sp_edit['name']; ?>" required class="form-control">
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label style="font-weight: 600;">Giá bán mới (.000đ):</label>
                        <input type="number" name="price" value="<?php echo $sp_edit['price']; ?>" required class="form-control">
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label style="font-weight: 600;">Danh mục sách:</label>
                        <select name="id_danhmuc" class="form-control" required>
                            <?php 
                            if(isset($ds_danhmuc) && !empty($ds_danhmuc)):
                                foreach ($ds_danhmuc as $dm): 
                            ?>
                                <option value="<?php echo $dm['id']; ?>" <?php echo ($dm['id'] == $sp_edit['id_danhmuc']) ? 'selected' : ''; ?>>
                                    <?php echo $dm['name']; ?>
                                </option>
                            <?php 
                                endforeach;
                            endif;
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label style="font-weight: 600;">Ảnh bìa hiện tại:</label><br>
                        <img src="../view/assets/images/<?php echo $sp_edit['image']; ?>" style="width: 80px; height: 110px; object-fit: contain; background: #eee; margin-bottom: 10px; border-radius: 4px;"><br>
                        <label style="font-weight: 600; color: #7a7a7a;">Chọn ảnh mới nếu muốn thay đổi:</label>
                        <input type="file" name="image" class="form-control-file">
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 25px;">
                        <label style="font-weight: 600;">Mô tả nội dung sách:</label>
                        <textarea name="description" rows="5" class="form-control"><?php echo $sp_edit['description']; ?></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-dark btn-block" style="font-weight: 600;">LƯU THAY ĐỔI</button>
                        </div>
                        <div class="col-6">
                            <a href="index.php?act=admin" class="btn btn-outline-secondary btn-block" style="font-weight: 600;">HỦY BỎ</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>