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
                        <h1 class="page-header">Bệnh
                            <small>Add</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    
                    <?php include 'block-messages.php'; ?>
                    
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="ControllerBenh.php" method="POST">
                            <div class="form-group">
                                <label for="tenbenh">Tên bệnh</label>
                                <input type="text" class="form-control" name="tenbenh" id="tenbenh" required  
                                	value="<?php echo (!empty($_SESSION['ThemBenh'])) ? $_SESSION['ThemBenh']['name'] : '' ?>" required />
                            </div>
                            <div class="form-group">
                                <label for="mota">Mô tả</label>
                                <textarea rows="10" class="form-control" name="mota" id="mota" 
                                	><?php echo (!empty($_SESSION['ThemBenh'])) ? $_SESSION['ThemBenh']['mota'] : '' ?></textarea>
                            </div>

                            <input type="hidden" name="action" value="add" />
                            <button type="submit" class="btn btn-default">Thêm bệnh</button>
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
unset($_SESSION['ThemBenh']);
include_once 'footer.php'; 
?>