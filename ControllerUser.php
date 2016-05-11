<?php 
	
	session_start();
	include_once 'ControllerSession.php';
	
	$cs = new Session();
	if (!$cs->checkUserLogin()) {
		header("Location: login.php");
		return;
	}
		
	require_once 'ModelConnectDatabase.php';
	include 'ModelAdmin.php';

	$action = filter_input(INPUT_POST, 'action');
	if (empty($action))
		$action = filter_input(INPUT_GET, 'action');
	
	$ma = new Admin();
	
	switch ($action) {
		case 'change':
			$oldPassword = filter_input(INPUT_POST, 'oldPassword');
			$newPassword = filter_input(INPUT_POST, 'newPassword');
			$reNewPassowrd = filter_input(INPUT_POST, 'reNewPassowrd');
			if ($newPassword == $reNewPassowrd) {
				if (empty($ma->is_valid_login($db, $_SESSION['user']['username'], $oldPassword))) {
					$_SESSION['flash-level'] = 'danger';
					$_SESSION['flash-message'] = 'Mật khẩu cũ không chính xác.';
					header("Location: view-change-password.php");
				} else {
					if($ma->post_edit_user($db, $_SESSION['user']['id'], $_SESSION['user']['username'], $newPassword)) {
						$_SESSION['flash-level'] = 'success';
						$_SESSION['flash-message'] = 'Thay đổi mật khẩu thành công.';
						header("Location: view-change-password.php");
					} else {
						$_SESSION['flash-level'] = 'danger';
						$_SESSION['flash-message'] = 'Xảy ra lỗi. Vui lòng liên hệ với quản trị viên để được giúp đỡ.';
						header("Location: view-change-password.php");
					}
				}
			} else {
				$_SESSION['flash-level'] = 'danger';
				$_SESSION['flash-message'] = 'Mật khẩu xác nhận không trùng với mật khẩu mới.';
				header("Location: view-change-password.php");
			}
			break;
		default:
			header("Location: dashboard.php");
			break;
	}

?>