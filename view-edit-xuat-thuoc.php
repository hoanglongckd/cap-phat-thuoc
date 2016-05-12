<?php
	session_start();
	include 'ControllerSession.php';
	
	$cs = new Session();
	if (!$cs->checkUserLogin())
		header("Location: login.php");
	if (empty($_SESSION['XuatThuoc']))
		header("Location: errors.php");
	$xuatthuoc = $_SESSION['XuatThuoc'];
	unset($_SESSION['XuatThuoc']);
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
                        <h1 class="page-header">Export Drug
                            <small>Edit</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    
                    <?php include 'block-messages.php'; ?>
                    
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="ControllerXuatThuoc.php" method="POST">
                            
                            <div class="form-group">
                                <label for="TenHang">Tên Hãng Sản Xuất</label>
                                <input type="text" name="TenHang" id="TenHang" value="<?php echo $xuatthuoc['TenHang'] ?>" class="form-control" disabled />
                            </div>
                            
                            <div class="form-group">
                                <label for="TenBenh">Tên Bệnh</label>
                                <input type="text" name="TenBenh" id="TenBenh" value="<?php echo $xuatthuoc['TenBenh'] ?>" class="form-control" disabled />
                            </div>
                            
                            <div class="form-group">
                                <label for="TenThuoc">Tên Thuốc</label>
                                <input type="text" name="TenThuoc" id="TenThuoc" value="<?php echo $xuatthuoc['TenThuoc'] ?>" class="form-control" disabled />
                            </div>
                            
                            <div class="form-group">
                                <label for="SoLuongToiDa">Số Lượng Tối Đa Có Thể Xuất</label>
                                <input type="text" name="SoLuongToiDa" id="SoLuongToiDa" value="<?php echo $xuatthuoc['SoLuongTonKho'] + $xuatthuoc['SoLuongXuat']; ?>" class="form-control" readonly />
                            </div>
                            
                            <div class="form-group">
                                <label for="SoLuongXuat">Số Lượng Xuất</label>
                                <input type="number" name="SoLuongXuat" id="SoLuongXuat" value="<?php echo $xuatthuoc['SoLuongXuat']; ?>" class="form-control" />
                            </div>
                            
                            <div class="form-group">
                                <label for="SoTienTrenMotDonVi">Số Tiền Trên Một Đơn Vị</label>
                                <input type="number" name="SoTienTrenMotDonVi" id="SoTienTrenMotDonVi" value="<?php echo $xuatthuoc['SoTienTrenMotDonVi']; ?>" class="form-control" />
                            </div>
                            
                            <input type="hidden" name="idLoaiThuoc" value=<?php echo $xuatthuoc['idLoaiThuoc']; ?> />
                            <input type="hidden" name="id" value="<?php echo $xuatthuoc['id']; ?>" />
                            <input type="hidden" name="action" value="postedit" />
                            <button type="submit" class="btn btn-default">Edit Drug</button>
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
	unset($_SESSION['SuaThuoc']);
	include_once 'footer.php'; 
?>