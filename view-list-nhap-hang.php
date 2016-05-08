<?php

	include 'ControllerNhapThuoc.php';
	include_once 'ControllerSession.php';
	
	$cs = new Session();
	if (!$cs->checkUserLogin())
		header("Location: login.php");
	//$donhangs = $_SESSION['donhangs'];
	//unset ($_SESSION['donhangs']);
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
                            <small>List</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    
                    <?php include 'block-messages.php'; ?>
                    
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>STT</th>
                                <th>Tên thuốc</th>
                                <th>Tên hãng</th>
                                <th>Tên bệnh</th>
                                <th>Ngày nhập </th>
                                <th>Ngày sửa </th>
                                <th>Số lượng nhập</th>
                                <th>Số tiền mỗi đơn vị</th>
                                <th>Thành tiền</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $stt = 0; ?>
                        <?php foreach($donhangs as $donhang) : ?>
                            <tr class="odd gradeX" align="center">
                                <td><?php echo ++$stt; ?></td>
                                <td><?php echo $donhang['TenThuoc'] ?></td>
                                <td><?php echo $donhang['TenHang'] ?></td>
                                <td><?php echo $donhang['TenBenh'] ?></td>
                                <td><?php echo $donhang['NgayNhap']; ?></td>
                                <td><?php echo $donhang['NgaySua'] ?></td>
                                <td><?php echo $donhang['SoLuongNhap']; ?></td>
                                <td><?php echo $donhang['SoTienTrenMotDonVi']; ?></td>
                                <td><?php echo $donhang['ThanhTien']; ?></td>
                                
                                <td class="center"><i class="fa fa-pencil fa-fw"></i>
                                	<a href="ControllerNhapThuoc.php?action=edit&id=<?php echo $donhang['id']; ?>">Edit</a>
                                </td>
                                <td class="center"><i class="fa fa-trash-o fa-fw"></i> 
                                	<a 	onclick="return deleteConfirm('Bạn có thật sự muốn xóa?')" 
                                		href="ControllerNhapThuoc.php?action=delete&id=<?php echo $donhang['id']; ?>">
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