<?php

	session_start();	
	include_once 'ControllerSession.php';
	
	$cs = new Session();
	if (!$cs->checkUserLogin())
		header("Location: login.php");

	if (empty($_SESSION['EditBenh']))
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
                        <h1 class="page-header">Bệnh
                            <small>Edit</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    
                    <?php include 'block-messages.php'; ?>
                    
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="ControllerBenh.php" method="POST">
                            <div class="form-group">
                                <label for="tenbenh">Tên Bệnh</label>
                                <input type="text" class="form-control" name="tenbenh" id="tenbenh" value="<?php echo $_SESSION['EditBenh']['TenBenh']; ?>" readonly required />
                            </div>
                            <div class="form-group">
                                <label for="mota">New Mô tả</label>
                                <textarea class="form-control" name="mota" id="mota"  ></textarea>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $_SESSION['EditBenh']['id']; ?>" />
                            <?php unset($_SESSION['EditBenh']); ?>
                            <input type="hidden" name="action" value="postedit" />
                            <button type="submit" class="btn btn-default">Edit Bệnh</button>
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

<?php include_once 'footer.php'; ?>