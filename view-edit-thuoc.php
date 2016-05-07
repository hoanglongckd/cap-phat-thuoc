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
                            <small>Edit</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    
                    <?php include 'block-messages.php'; ?>
                    
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="ControllerThuoc.php" method="POST">
                            <div class="form-group">
                                <label for="TenHang">Tên Hãng Sản Xuất Thuốc</label>
                                <select class="form-control" name="idHang" id="TenHang">
                                <?php foreach ($hangs as $hang) : ?>
                                	<option value="<?php echo $hang['id']?>" 
                                		<?php 
                                			if (!empty($_SESSION['SuaThuoc'])) {
                                				if ($_SESSION['SuaThuoc']['idHang'] == $hang['id'])
                                					echo 'selected';
                                			}
                                		?> ><?php echo $hang['TenHang']?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="TenBenh">Tên Hãng</label>
                                <select class="form-control" name="idBenh" id="TenBenh">
                                <?php foreach ($benhs as $benh) : ?>
                                	<option value="<?php echo $benh['id']?>" 
                                		<?php 
                                			if (!empty($_SESSION['SuaThuoc'])) {
                                				if ($_SESSION['SuaThuoc']['idLoaiBenh'] == $benh['id'])
                                					echo 'selected';
                                			}
                                		?> ><?php echo $benh['TenBenh']?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="TenThuoc">Tên Thuốc</label>
                                <input type="text" name="TenThuoc" id="TenThuoc" value="<?php if (!empty($_SESSION['SuaThuoc']) )  echo $_SESSION['SuaThuoc']['TenThuoc']; ?>" class="form-control" required />
                            </div>
                            
                            <div class="form-group">
                                <label for="DinhLuong">Định Lượng Thuốc</label>
                                <input type="text" name="DinhLuong" id="DinhLuong" value="<?php if (!empty($_SESSION['SuaThuoc']) )  echo $_SESSION['SuaThuoc']['DinhLuong']; ?>" class="form-control" required />
                            </div>
                            
                            <div class="form-group">
                                <label for="MoTa">Mô Tả</label>
                                <textarea rows="10" name="MoTa" id="MoTa" class="form-control"><?php if (!empty($_SESSION['SuaThuoc']) )  echo $_SESSION['SuaThuoc']['MoTa']; ?></textarea>
                            </div>
                            
                            <input type="hidden" name="id" value="<?php echo $_SESSION['SuaThuoc']['id']; ?>" />
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