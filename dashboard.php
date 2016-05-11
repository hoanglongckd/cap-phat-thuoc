<?php 
	session_start();

	include 'ControllerSession.php';
	
	$cs = new Session();
	if (!$cs->checkUserLogin())
		header("Location: login.php");
	
	include 'header.php';
	include 'openBodyTag.php'; 
	include 'navbar-top.php';
	include 'navbar-left.php';
?>

	<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Công Nghệ Web
                            <small>Quản lý việc cấp phát thuốc</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label>Sinh Viên 1</label>
								<input class="form-control" value="Trần Hoàng Long" readonly />
                            </div>
                            <div class="form-group">
                                <label>Mã Số Sinh Viên</label>
                                <input class="form-control" value="102120184" readonly />
                            </div>
                            <div class="form-group">
                                <label>Sinh Viên 2</label>
                                <input class="form-control" value="Nguyễn Duy Điền Nguyên" readonly />
                            </div>
                            <div class="form-group">
                                <label>Mã Số Sinh Viên</label>
                                <input class="form-control" value="102120186" readonly />
                            </div>
                            <div class="form-group">
                                <label>Lớp</label>
                                <input class="form-control" value="12T3" readonly />
                            </div>
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

<?php include 'footer.php'; ?>