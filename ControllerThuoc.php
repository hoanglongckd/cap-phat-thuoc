<?php 
	
	session_start();
	
	require_once 'ModelConnectDatabase.php';
	include 'ModelBenh.php';
	include 'ModelHang.php';
	include 'ModelThuoc.php';

	$action = filter_input(INPUT_POST, 'action');
	if (empty($action))
		$action = filter_input(INPUT_GET, 'action');
	
	$mb = new Benh();
	$mh = new Hang();
	$mt = new Thuoc();
	
	switch ($action) {
		case 'getadd':
			$_SESSION['benhs'] = $mb->list_benh($db);
			$_SESSION['hangs'] = $mh->list_hang($db);
			header("Location: view-add-thuoc.php");
			break;
		case 'getadd':
			$_SESSION['benhs'] = $mb->list_benh($db);
			$_SESSION['hangs'] = $mh->list_hang($db);
			header("Location: view-add-thuoc.php");
			break;
		case 'edit':
			$id = filter_input(INPUT_GET, 'id');
			$hang = $mh->get_edit_hang($db, $id);
			if (!empty($hang)) {
				$_SESSION['SuaHang'] = $hang;
				header("Location: view-edit-hang.php");
			} else {
				$_SESSION['flash-level'] = 'danger';
				$_SESSION['flash-message'] = 'Xảy ra lỗi. Vui lòng liên hệ với quản trị viên để được giúp đỡ.';
				header("Location: view-list-hang.php");
			}
			break;
		case 'postedit':
			$id = filter_input(INPUT_POST, 'id');
			$name = filter_input(INPUT_POST, 'name');
			$description = filter_input(INPUT_POST, 'description');
			$valid = $mh->post_edit_hang($db, $id, $name, $description);
			if ($valid) {
				$_SESSION['flash-level'] = 'success';
				$_SESSION['flash-message'] = 'Sửa thành công.';
				header("Location: view-list-hang.php");
			} else {
				$_SESSION['SuaHang']['id'] = $id;
				$_SESSION['SuaHang']['TenHang'] = $name;
				$_SESSION['SuaHang']['MoTa'] = $description;
				$_SESSION['flash-level'] = 'danger';				
				$_SESSION['flash-message'] = 'Tên hãng đã tồn tại.';
				header("Location: view-edit-hang.php");
			}
			break;
		case 'delete':
			$id = filter_input(INPUT_GET, 'id');
			if ($mh->delete_hang($db, $id)) {
				$_SESSION['flash-level'] = 'success';
				$_SESSION['flash-message'] = 'Xóa thành công!';
			} else {
				$_SESSION['flash-level'] = 'danger';
				$_SESSION['flash-message'] = 'Xảy ra lỗi. Vui lòng liên hệ với quản trị viên để được giúp đỡ.';
			}
			header("Location: view-list-hang.php");
			break;
		default:
			$hangs = $mh->list_hang($db);
			break;
	}

?>