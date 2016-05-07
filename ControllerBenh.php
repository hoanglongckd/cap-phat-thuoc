<?php 
	
	session_start();
	
	require_once 'ModelConnectDatabase.php';
	include 'ModelBenh.php';

	$action = filter_input(INPUT_POST, 'action');
	if (empty($action))
		$action = filter_input(INPUT_GET, 'action');
	
	$ma = new Benh();
	
	switch ($action) {

		case 'add':
			$tenbenh = filter_input(INPUT_POST, 'tenbenh');
			$mota = filter_input(INPUT_POST, 'mota');
			if (!$ma->loaibenh_exist($db, $tenbenh)) {
					$ma->add_benh($db, $tenbenh, $mota);
					$_SESSION['flash-level'] = 'success';
					$_SESSION['flash-message'] = 'Thêm mới bệnh thành công.';
					header("Location: view-list-benh.php");
				
			} else {
				$_SESSION['flash-level'] = 'danger';
				$_SESSION['flash-error'] = 'Loại bệnh này đã tồn tại.';
				header("Location: view-add-benh.php");
			}
			break;
		case 'edit':
			$id = filter_input(INPUT_GET, 'id');
			$user = $ma->get_edit_user($db, $id);
			if (!empty($user)) {
				$_SESSION['EditUser'] = $user;
				header("Location: view-edit-user.php");
			} else {
				$_SESSION['flash-level'] = 'danger';
				$_SESSION['flash-message'] = 'Xảy ra lỗi. Vui lòng liên hệ với quản trị viên để được giúp đỡ.';
				header("Location: view-list-user.php");
			}
			break;
		case 'postedit':
			$id = filter_input(INPUT_POST, 'id');
			$username = filter_input(INPUT_POST, 'username');
			$password = filter_input(INPUT_POST, 'password');
			$rePassword = filter_input(INPUT_POST, 're-password');
			if ($password == $rePassword) {
				$valid = $ma->post_edit_user($db, $id, $username, $password);
				if ($valid) {
					$_SESSION['flash-level'] = 'success';
					$_SESSION['flash-message'] = 'Sửa thành công.';
					header("Location: view-list-user.php");
				} else {
					$_SESSION['flash-level'] = 'danger';
					$_SESSION['flash-message'] = 'Xảy ra lỗi. Vui lòng liên hệ với quản trị viên để được giúp đỡ.';
					header("Location: view-list-user.php");
				}
			} else {
				$_SESSION['flash-level'] = 'danger';
				$_SESSION['flash-message'] = 'Mật khẩu xác nhận không trùng khớp.';
				header("Location: ControllerAdmin.php?action=edit&id=$id");
			}
			break;
		case 'delete':
			$id = filter_input(INPUT_GET, 'id');
			if ($ma->delete_user($db, $id)) {
				$_SESSION['flash-level'] = 'success';
				$_SESSION['flash-message'] = 'Xóa User thành công.';
			} else {
				$_SESSION['flash-level'] = 'danger';
				$_SESSION['flash-message'] = 'Xảy ra lỗi. Vui lòng liên hệ với quản trị viên để được giúp đỡ.';
			}
			header("Location: view-list-user.php");
			break;
		default:
			$users = $ma->list_user($db);
			break;
	}
?>