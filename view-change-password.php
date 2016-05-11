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
                        <h1 class="page-header">Account
                            <small>Change Password</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    
                    <?php include 'block-messages.php'; ?>
                    
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="ControllerUser.php" method="POST">
                            <div class="form-group">
                                <label for="old-password">Old Password</label>
                                <input type="password" class="form-control" name="oldPassword" id="old-password" required />
                            </div>
                            <div class="form-group">
                                <label for="new-password">New Password</label>
                                <input type="password" class="form-control" name="newPassword" id="new-password" required />
                            </div>
                            <div class="form-group">
                                <label for="re-new-password">Re-New Password</label>
                                <input type="password" class="form-control" name="reNewPassowrd" id="re-new-password" required />
                            </div>
                            <input type="hidden" name="action" value="change" />
                            <button type="submit" class="btn btn-default">Change</button>
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