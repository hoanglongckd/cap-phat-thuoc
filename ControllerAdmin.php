<?php 
	
	session_start();
	include_once 'ControllerSession.php';
	
	$cs = new Session();
	if (!$cs->checkUserLogin()) {
		header("Location: login.php");
		return;
	}
	if ($_SESSION['user']['level'] != 1) {
		header("Location: errors.php");
		return;
	}
		
	require_once 'ModelConnectDatabase.php';
	include 'ModelAdmin.php';

	$action = filter_input(INPUT_POST, 'action');
	if (empty($action))
		$action = filter_input(INPUT_GET, 'action');
	
	$ma = new Admin();
	
	switch ($action) {
		case 'logout':
			$ma->logout();
			header("Location: login.php");
			break;
		case 'add':
			$username = filter_input(INPUT_POST, 'username');
			$password = filter_input(INPUT_POST, 'password');
			$rePassword = filter_input(INPUT_POST, 're-password');
			if (!$ma->user_exist($db, $username)) {
				if ($password == $rePassword) {
					$ma->add_user($db, $username, $password);
					$_SESSION['flash-level'] = 'success';
					$_SESSION['flash-message'] = 'Thêm User thành công.';
					header("Location: view-list-user.php");
				} else {
					$_SESSION['flash-level'] = 'danger';
					$_SESSION['flash-error'] = 'Mật khẩu xác nhận không trùng khớp.';
					header("Location: view-add-user.php");
				}
			} else {
				$_SESSION['flash-level'] = 'danger';
				$_SESSION['flash-error'] = 'Tài khoản này đã tồn tại.'; 
				header("Location: view-add-user.php");
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