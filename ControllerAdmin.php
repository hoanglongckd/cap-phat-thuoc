<?php 
	
	session_start();
	
	require_once 'ModelConnectDatabase.php';
	include 'ModelAdmin.php';

	$action = filter_input(INPUT_POST, 'action');
	$ma = new Admin();
	
	switch ($action) {
		case 'add':
			$username = filter_input(INPUT_POST, 'username');
			$password = filter_input(INPUT_POST, 'password');
			$rePassword = filter_input(INPUT_POST, 're-password');
			if ($password == $rePassword) {
				if (!$ma->user_exist($db, $username)) {
					$ma->add_user($db, $username, $password);
				} else {
					$_SESSION['flash-level'] = 'danger';
					$_SESSION['flash-error'] = 'Tài khoản này đã tồn tại.'; 
					header("Location: view-add-user.php");
				}
				$_SESSION['flash-level'] = 'success';
				$_SESSION['flash-message'] = 'Thêm User thành công.';
			} else {
				$_SESSION['flash-level'] = 'danger';
				$_SESSION['flash-error'] = 'Mật khẩu xác nhận không trùng khớp.';
				header("Location: view-add-user.php");
			}
			header("Location: ControllerAdmin.php");
			break;
		default:
			$users = $ma->list_user($db);
			break;
	}

?>