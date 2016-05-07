<?php

	include 'ControllerAdmin.php';
	include_once 'ControllerSession.php';
	
	$cs = new Session();
	if (!$cs->checkUserLogin())
		header("Location: login.php");
	if ($_SESSION['user']['level'] != 1)
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
                            <small>List</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    
                    <?php include 'block-messages.php'; ?>
                    
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>STT</th>
                                <th>Username</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $stt = 0; ?>
                        <?php foreach($users as $user) : ?>
                            <tr class="odd gradeX" align="center">
                                <td><?php echo $stt++; ?></td>
                                <td><?php echo $user['username']; ?></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i>
                                	<a href="ControllerAdmin.php?action=edit&id=<?php echo $user['id']; ?>">Edit</a>
                                </td>
                                <td class="center"><i class="fa fa-trash-o fa-fw"></i> 
                                	<a 	onclick="return deleteConfirm('Bạn có thật sự muốn xóa?')" 
                                		href="ControllerAdmin.php?action=delete&id=<?php echo $user['id']; ?>">
                                		Delete
                                	</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include_once 'footer.php'; ?>