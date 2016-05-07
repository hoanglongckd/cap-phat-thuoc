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
		case 'postadd':
			$idHang = filter_input(INPUT_POST, 'idHang');
			$idBenh = filter_input(INPUT_POST, 'idBenh');
			$tenThuoc = filter_input(INPUT_POST, 'TenThuoc');
			$dinhLuong = filter_input(INPUT_POST, 'DinhLuong');
			$moTa = filter_input(INPUT_POST, 'MoTa');
			if (!$mt->thuoc_exist($db, $tenThuoc, $idHang, $idBenh)) {
				$mt->add_thuoc($db, $tenThuoc, $dinhLuong, $moTa, $idBenh, $idHang);
				if (valid) {
					$_SESSION['flash-level'] = 'success';
					$_SESSION['flash-message'] = 'Thêm thành công!';
					header("Location: view-list-thuoc.php");
				} else {
					$_SESSION['flash-level'] = 'danger';
					$_SESSION['flash-error'] = 'Xảy ra lỗi. Vui lòng liên hệ với quản trị viên để được giúp đỡ.';
					header("Location: ControllerThuoc.php?action=getadd");
				}
			} else {
				$_SESSION['flash-level'] = 'danger';
				$_SESSION['flash-error'] = 'Tên thuốc ứng với tên hãng và tên bệnh đã tồn tại.';
				$_SESSION['Thuoc']['IdHang'] = $idHang;
				$_SESSION['Thuoc']['IdBenh'] = $idBenh;
				$_SESSION['Thuoc']['TenThuoc'] = $tenThuoc;
				$_SESSION['Thuoc']['DinhLuong'] = $dinhLuong;
				$_SESSION['Thuoc']['MoTa'] = $moTa;
				header("Location: ControllerThuoc.php?action=getadd");
			}
			break;
		case 'edit':
			$id = filter_input(INPUT_GET, 'id');
			$thuoc = $mt->get_edit_thuoc($db, $id);
			if (!empty($thuoc)) {
				$_SESSION['SuaThuoc'] = $thuoc;
				$_SESSION['benhs'] = $mb->list_benh($db);
				$_SESSION['hangs'] = $mh->list_hang($db);
				header("Location: view-edit-thuoc.php");
			} else {
				$_SESSION['flash-level'] = 'danger';
				$_SESSION['flash-error'] = 'Xảy ra lỗi. Vui lòng liên hệ với quản trị viên để được giúp đỡ.';
				header("Location: view-list-thuoc.php");
			}
			break;
		case 'postedit':
			$id = filter_input(INPUT_POST, 'id');
			$idHang = filter_input(INPUT_POST, 'idHang');
			$idBenh = filter_input(INPUT_POST, 'idBenh');
			$tenThuoc = filter_input(INPUT_POST, 'TenThuoc');
			$dinhLuong = filter_input(INPUT_POST, 'DinhLuong');
			$moTa = filter_input(INPUT_POST, 'MoTa');
			if (!$mt->thuoc_exist_not_itself($db, $id, $tenThuoc, $idHang, $idBenh)) {
				$valid = $mt->post_edit_thuoc($db, $id, $tenThuoc, $dinhLuong, $moTa, $idBenh, $idHang);
				if ($valid) {
					$_SESSION['flash-level'] = 'success';
					$_SESSION['flash-message'] = 'Sửa thành công.';
					header("Location: view-list-thuoc.php");
				} else {
					$_SESSION['flash-level'] = 'danger';
					$_SESSION['flash-message'] = 'Xảy ra lỗi. Vui lòng liên hệ với quản trị viên để được giúp đỡ.';
					header("Location: view-list-thuoc.php");
				}
			} else {
				$_SESSION['SuaThuoc']['id'] = $id;
				$_SESSION['SuaThuoc']['TenThuoc'] = $tenThuoc;
				$_SESSION['SuaThuoc']['DinhLuong'] = $dinhLuong;
				$_SESSION['SuaThuoc']['MoTa'] = $moTa;
				$_SESSION['SuaThuoc']['idHang'] = $idHang;
				$_SESSION['SuaThuoc']['idLoaiBenh'] = $idBenh;
				$_SESSION['benhs'] = $mb->list_benh($db);
				$_SESSION['hangs'] = $mh->list_hang($db);
				$_SESSION['flash-level'] = 'danger';				
				$_SESSION['flash-error'] = 'Tên thuốc tương ứng với tên hãng và tên bệnh đã tồn tại.';
				header("Location: view-edit-thuoc.php");
			}
			break;
		case 'delete':
			$id = filter_input(INPUT_GET, 'id');
			if ($mt->delete($db, $id)) {
				$_SESSION['flash-level'] = 'success';
				$_SESSION['flash-message'] = 'Xóa thành công!';
			} else {
				$_SESSION['flash-level'] = 'danger';
				$_SESSION['flash-message'] = 'Xảy ra lỗi. Vui lòng liên hệ với quản trị viên để được giúp đỡ.';
			}
			header("Location: view-list-thuoc.php");
			break;
		default:
			$thuocs = $mt->list_thuoc($db);
			break;
	}

?>