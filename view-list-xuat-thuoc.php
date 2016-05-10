<?php

	include 'ControllerXuatThuoc.php';
	
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
                        <h1 class="page-header">Export Drug
                            <small>List</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    
                    <?php include 'block-messages.php'; ?>
                    
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>STT</th>
                                <th>Tên Hãng</th>
                                <th>Tên Bệnh</th>
                                <th>Tên Thuốc</th>
                                <th>Số Lượng</th>
                                <th>Số Tiền Trên Một Đơn Vị</th>
                                <th>Thành Tiền</th>
                                <th>Ngày Xuất</th>
                                <th>Ngày Sửa</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $stt = 0; ?>
                        <?php foreach($xuatthuocs as $xuatthuoc) : ?>
                            <tr class="odd gradeX" align="center">
                                <td><?php echo ++$stt; ?></td>
                                <td><?php echo $xuatthuoc['TenHang']; ?></td>
                                <td><?php echo $xuatthuoc['TenBenh']; ?></td>
                                <td><?php echo $xuatthuoc['TenThuoc']; ?></td>
                                <td><?php echo $xuatthuoc['SoLuongXuat']; ?></td>
                                <td><?php echo number_format($xuatthuoc['SoTienTrenMotDonVi'], '0', ',', '.'); ?></td>
                                <td><?php echo number_format($xuatthuoc['ThanhTien'], '0', ',', '.'); ?></td>
                                <td><?php echo date('d-m-Y', strtotime($xuatthuoc['NgayXuat'])); ?></td>
                                <td><?php echo date('d-m-Y', strtotime($xuatthuoc['NgaySua'])); ?></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i>
                                	<a href="ControllerXuatThuoc.php?action=edit&id=<?php echo $xuatthuoc['id']; ?>">Edit</a>
                                </td>
                                <td class="center"><i class="fa fa-trash-o fa-fw"></i> 
                                	<a 	onclick="return deleteConfirm('Bạn có thật sự muốn xóa?')" 
                                		href="ControllerXuatThuoc.php?action=delete&id=<?php echo $xuatthuoc['id']; ?>">
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