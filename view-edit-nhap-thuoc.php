<?php
	session_start();
	include 'ControllerSession.php';
	
	$cs = new Session();
	if (!$cs->checkUserLogin())
		header("Location: login.php");
	if(empty($_SESSION['item'])){
		header("Location: errors.php");
	}
	$item = $_SESSION['item'];
	unset($_SESSION['item']);
	include_once 'header.php';
	include_once 'openBodyTag.php';
	include_once 'navbar-top.php';
	include_once 'navbar-left.php';
?>

	<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Nhập thuốc
                            <small>Add đơn hàng</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    
                    <?php include 'block-messages.php'; ?>
                    
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="ControllerNhapThuoc.php" method="POST">
                            <div class="form-group">
	                            <div>
	                                <label for="TenThuoc">Tên thuốc</label>
	                                <input type="text" name="TenThuoc" id="TenThuoc" class="form-control" 
	                                	value="<?php echo $item['TenThuoc']?>" readonly	required/>
	                            </div>
	                             <div>
	                                <input type="hidden" name=id id="id" class="form-control" 
	                                	value="<?php echo $item['id']?>" readonly	required/>
	                            </div>
	                             <div>
	                                <label for="TenHang">Tên hãng sản xuất</label>
	                                <input type="text" name="TenHang" id="TenHang" class="form-control" 
	                                	value="<?php echo $item['TenHang']?>" readonly	required/>
	                            </div>
	                             <div>
	                                <label for="TenThuoc">Tên bệnh</label>
	                                <input type="text" name="TenHang" id="TenHang" class="form-control" 
	                                	value="<?php echo $item['TenBenh']?>" readonly	required/>
	                            </div>
	                            <div class="form-group">
	                                <label for="soluong">Số lượng nhập</label>
	                                <input type="number" name="soluong" id="soluong" class="form-control" 
	                                	value="<?php echo $item['SoLuongNhap']?>" required/>
	                            </div>
	                            <div class="form-group">
	                                <label for="fee">Số tiền trên mỗi đơn vị</label>
	                                <input type="number" name="fee" id="fee" class="form-control" 
	                                	value="<?php echo $item['SoTienTrenMotDonVi']?>" required/>
	                            </div>
	                            <div class="form-group">
	                                <label for="thanhtien">Thành tiền</label>
	                                <input type="number" name="thanhtien" id="thanhtien" class="form-control" 
	                                	value="<?php echo $item['ThanhTien']?>"   readonly required/>
	                            </div>
	                            <div class="form-group">
	                                <input type="hidden" name="soluongcu" id="soluongcu" class="form-control" 
	                                	value="<?php echo $item['SoLuongNhap']?>" required/>
	                            </div>
                            </div>
                            <input type="hidden" name="action" value="postedit" />
                            <button type="submit" class="btn btn-default">Sửa đơn hàng</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php 
include_once 'footer.php'; 
?>