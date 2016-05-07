<?php
	session_start();
	include 'ControllerSession.php';
	
	$cs = new Session();
	if (!$cs->checkUserLogin())
		header("Location: login.php");
	
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
                            <small>Add</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    
                    <?php include 'block-messages.php'; ?>
                    
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="ControllerHang.php" method="POST">
                            <div class="form-group">
                                <label for="name">Tên Hãng</label>
                                <input type="text" class="form-control" name="name" id="name" 
                                	value="<?php echo (!empty($_SESSION['ThemHang'])) ? $_SESSION['ThemHang']['name'] : '' ?>" required />
                            </div>
                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <textarea rows="10" class="form-control" name="description" id="description"><?php echo (!empty($_SESSION['ThemHang'])) ? $_SESSION['ThemHang']['description'] : '' ?></textarea>
                            </div>
                            <input type="hidden" name="action" value="add" />
                            <button type="submit" class="btn btn-default">Add Manufacturer</button>
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
	unset($_SESSION['ThemHang']);
	include_once 'footer.php'; 
?>