<?php 
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
                        <h1 class="page-header">Customer
                            <small>Add</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="controllerCustomer.php" method="POST">
                            <div class="form-group">
                                <label for="fullname">Họ và Tên</label>
                                <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Full Name" />
                            </div>
                            <div class="form-group">
                                <label for="phone">Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number" />
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="Address" />
                            </div>
                            <div class="form-group">
                                <label for="birthday">Ngày sinh</label>
                                <input type="date" class="form-control" name="birthday" id="birthday" placeholder="Birthday" />
                            </div>
                            <div class="form-group">
                                <label>Giới tính</label>
                                <label class="radio-inline" for="nam">
                                    <input type="radio" name="gender" id="nam" value="1" checked>Nam
                                </label>
                                <label class="radio-inline" for="nu">
                                    <input type="radio" name="gender" id="nu" value="0">Nữ
                                </label>
                                <label class="radio-inline" for="other">
                                    <input type="radio" name="gender" id="other" value="2">Khác
                                </label>
                            </div>
                            <input type="hidden" name="action" value="add" />
                            <button type="submit" class="btn btn-default">Customer Add</button>
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

<?php include 'footer.php'; ?>