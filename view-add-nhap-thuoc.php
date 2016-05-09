<?php
	session_start();
	include 'ControllerSession.php';
	
	$cs = new Session();
	if (!$cs->checkUserLogin())
		header("Location: login.php");
	if (empty($_SESSION['hangs']))
		header("Location: errors.php");
	$hangs = $_SESSION['hangs'];
	$benhs = $_SESSION['benhs'];
	unset($_SESSION['hangs']);
	unset($_SESSION['benhs']);
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
                        <h1 class="page-header">Drug
                            <small>Import</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    
                    <?php include 'block-messages.php'; ?>
                   	<div id="errors" ></div>
                    
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="ControllerNhapThuoc.php" method="POST">
                            <div class="form-group">
                                <label for="TenHang">Tên Hãng Sản Xuất Thuốc</label>
                                <select class="form-control" name="idHang" id="TenHang" onchange="checkTenHang()" required>
                                	<option value="">Chọn tên hãng sản xuất</option>
                                <?php foreach ($hangs as $hang) : ?>
                                	<option value="<?php echo $hang['id']?>" ><?php echo $hang['TenHang']?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="TenBenh">Tên Bệnh</label>
                                <select class="form-control" name="idBenh" id="TenBenh" onchange="importDrug()" required>
                                	<option value="">Chọn tên bệnh</option>
                                <?php foreach ($benhs as $benh) : ?>
                                	<option value="<?php echo $benh['id']?>" ><?php echo $benh['TenBenh']?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                            
                			<div id="insert-input-drug-import"></div>
                            
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
	unset($_SESSION['Thuoc']);
	include_once 'footer.php'; 
?>