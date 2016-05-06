<?php
	session_start();
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
                            <small>Add</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    
                    <?php include 'block-messages.php'; ?>
                    
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="ControllerAdmin.php" method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" required />
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" required />
                            </div>
                            <div class="form-group">
                                <label for="re-password">Re-Password</label>
                                <input type="password" class="form-control" name="re-password" id="re-password" required />
                            </div>
                            <input type="hidden" name="action" value="add" />
                            <button type="submit" class="btn btn-default">Add User</button>
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