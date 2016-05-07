<?php 
	
	session_start();
	include 'ControllerSession.php';
	$cs = new Session();
	if (!$cs->checkUserLogin()) {
		header("Location: login.php");
		return 0;
	}
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
				$_SESSION['ThemBenh']['name'] = $tenbenh;
				$_SESSION['ThemBenh']['mota'] = $mota;
				$_SESSION['flash-level'] = 'danger';
				$_SESSION['flash-error'] = 'Loại bệnh này đã tồn tại.';
				header("Location: view-add-benh.php");
			}
			break;
		case 'edit':
			$id = filter_input(INPUT_GET, 'id');
			$loaibenh = $ma->get_edit_benh($db, $id);
			if (!empty($loaibenh)) {
				$_SESSION['EditBenh'] = $loaibenh;
				header("Location: view-edit-benh.php");
			} else {
				$_SESSION['flash-level'] = 'danger';
				$_SESSION['flash-message'] = 'Xảy ra lỗi. Vui lòng liên hệ với quản trị viên để được giúp đỡ.';
				header("Location: view-list-benh.php");
			}
			break;
		case 'postedit':
			$id = filter_input(INPUT_POST, 'id');
			$tenbenh = filter_input(INPUT_POST, 'tenbenh');
			$mota = filter_input(INPUT_POST, 'mota');
				if(!$ma->loaibenh_exist($db, $tenbenh)){
					$valid = $ma->post_edit_benh($db, $id, $tenbenh, $mota);
					if ($valid) {
						$_SESSION['flash-level'] = 'success';
						$_SESSION['flash-message'] = 'Sửa thành công.';
						header("Location: view-list-benh.php");
					} else {
	
						$_SESSION['flash-level'] = 'danger';
						$_SESSION['flash-message'] = 'Xảy ra lỗi. Vui lòng liên hệ với quản trị viên để được giúp đỡ.';
						header("Location: view-list-benh.php");
					}
				}else{
					$_SESSION['EditBenh']['id'] = $id;
					$_SESSION['EditBenh']['TenBenh'] = $tenbenh;
					$_SESSION['EditBenh']['MoTa'] = $mota;
					$_SESSION['flash-level'] = 'danger';
					$_SESSION['flash-error'] = 'Loại bệnh này đã tồn tại. Hãy dùng tên khác!';
					header("Location: view-edit-benh.php");
				}
			break;
		case 'delete':
			$id = filter_input(INPUT_GET, 'id');
			if ($ma->delete_benh($db, $id)) {
				$_SESSION['flash-level'] = 'success';
				$_SESSION['flash-message'] = 'Xóa User thành công.';
			} else {
				$_SESSION['flash-level'] = 'danger';
				$_SESSION['flash-message'] = 'Xảy ra lỗi. Vui lòng liên hệ với quản trị viên để được giúp đỡ.';
			}
			header("Location: view-list-benh.php");
			break;
		default:
			$benhs = $ma->list_benh($db);
			break;
	}
?>