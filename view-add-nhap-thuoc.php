<?php
	session_start();
	include 'ControllerSession.php';
	
	$cs = new Session();
	if (!$cs->checkUserLogin())
		header("Location: login.php");
	$thuocs =$_SESSION['thuocs'];
	unset ($_SESSION['thuocs']);
	$hangs =$_SESSION['hangs'];
	unset ($_SESSION['hangs']);
	$benhs =$_SESSION['benhs'];
	unset ($_SESSION['benhs']);
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
	                                <select class="form-control" name="TenThuoc" id="TenThuoc">
	                                <?php foreach ($thuocs as $thuoc) : ?>
	                                	<option value="<?php echo $thuoc['id']?>"><?php echo $thuoc['TenThuoc']?></option>
	                                <?php endforeach; ?>
	                                </select>
	                            </div>
	                             <div>
	                                <label for="TenThuoc">Tên hãng</label>
	                                <select class="form-control" name="TenThuoc" id="TenThuoc">
	                                <?php foreach ($hangs as $hang) : ?>
	                                	<option value="<?php echo $hang['id']?>"><?php echo $hang['TenHang']?></option>
	                                <?php endforeach; ?>
	                                </select>
	                            </div>
	                             <div>
	                                <label for="TenThuoc">Tên bệnh</label>
	                                <select class="form-control" name="TenThuoc" id="TenThuoc">
	                                <?php foreach ($benhs as $benh) : ?>
	                                	<option value="<?php echo $benh['id']?>"><?php echo $benh['TenBenh']?></option>
	                                <?php endforeach; ?>
	                                </select>
	                            </div>
	                            <div class="form-group">
	                                <label for="soluong">Số lượng nhập</label>
	                                <input type="number" name="soluong" id="soluong" class="form-control" required/>
	                            </div>
	                            <div class="form-group">
	                                <label for="fee">Số tiền trên mỗi đơn vị</label>
	                                <input type="number" name="fee" id="fee" class="form-control" required/>
	                            </div>
	                            <div class="form-group">
	                                <label for="thanhtien">Thành tiền</label>
	                                <input type="number" name="thanhtien" id="thanhtien" class="form-control" 
	                                	value="45678"   readonly required/>
	                            </div>
                            </div>
	
                            <input type="hidden" name="action" value="add-2" />
                            <button type="submit" class="btn btn-default">Thêm đơn hàng</button>
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