<?php

	session_start();	
	include_once 'ControllerSession.php';
	
	$cs = new Session();
	if (!$cs->checkUserLogin())
		header("Location: login.php");
	if (empty($_SESSION['SuaHang']))
		header("Location: errors.php");
	
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
                        <h1 class="page-header">Manufacturer
                            <small>Edit</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    
                    <?php include 'block-messages.php'; ?>
                    
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="ControllerHang.php" method="POST">
                            <div class="form-group">
                                <label for="name">Tên hãng</label>
                                <input type="text" class="form-control" name="name" id="name" value="<?php echo $_SESSION['SuaHang']['TenHang']; ?>" required />
                            </div>
                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <textarea class="form-control" rows="10" cols="" name="description" id="description"><?php echo $_SESSION['SuaHang']['MoTa']; ?></textarea>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $_SESSION['SuaHang']['id']; ?>" />
                            <input type="hidden" name="action" value="postedit" />
                            <button type="submit" class="btn btn-default">Edit Manufacturer</button>
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
	unset($_SESSION['SuaHang']);
	include_once 'footer.php'; 
?>