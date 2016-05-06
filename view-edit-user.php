<?php

	session_start();	
	include_once 'ControllerSession.php';
	
	$cs = new Session();
	if (!$cs->checkUserLogin())
		header("Location: login.php");
	if ($_SESSION['user']['level'] != 1)
		header("Location: errors.php");
	if (empty($_SESSION['EditUser']))
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
                        <h1 class="page-header">User
                            <small>Edit</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    
                    <?php include 'block-messages.php'; ?>
                    
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="ControllerAdmin.php" method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" value="<?php echo $_SESSION['EditUser']['username']; ?>" readonly required />
                            </div>
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" class="form-control" name="password" id="password" required />
                            </div>
                            <div class="form-group">
                                <label for="re-password">Re-Password</label>
                                <input type="password" class="form-control" name="re-password" id="re-password" required />
                            </div>
                            <input type="hidden" name="id" value="<?php echo $_SESSION['EditUser']['id']; ?>" />
                            <?php unset($_SESSION['EditUser']); ?>
                            <input type="hidden" name="action" value="postedit" />
                            <button type="submit" class="btn btn-default">Edit User</button>
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