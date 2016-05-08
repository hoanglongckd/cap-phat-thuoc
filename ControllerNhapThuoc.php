<?php 
	
	session_start();
	
	require_once 'ModelConnectDatabase.php';
	include 'ModelNhapThuoc.php';
	include 'ModelThuoc.php';
	include 'ModelBenh.php';
	include 'ModelHang.php';
	$action = filter_input(INPUT_POST, 'action');
	if (empty($action))
		$action = filter_input(INPUT_GET, 'action');
	
	$ma = new Nhap();
	$drug = new Thuoc();
	$benh = new Benh();
	$hang = new Hang();
	switch ($action) {

		case 'add':
			$listthuoc = $drug->list_all_thuoc($db);//////////////////////////////
			$_SESSION['thuocs'] = $listthuoc;//////////////////////////////////
			$listbenh = $benh->list_benh($db);
			$_SESSION['benhs'] = $listbenh;
			$listhang = $hang->list_hang($db);
			$_SESSION['hangs'] = $listhang;
			header("Location: view-add-nhap-thuoc.php");
			break;
		case 'add-2':
			$soLuongNhap = filter_input(INPUT_POST, 'soluong');
			$sotiendonvi = filter_input(INPUT_POST, 'fee');
			$thanhtien = filter_input(INPUT_POST, 'thanhtien');
			$ngaynhap = date('Y-m-d');
			$idthuoc = filter_input(INPUT_POST, 'TenThuoc');
			if (!empty($row = $drug->get_edit_thuoc($db,$idthuoc))) {
				//lay dc loai thuoc theo idBenh va idHang ten benh them moi don nhap hang thanh cong
				$idBenh = $row['idBenh'];
				$idHang = $row['idHang'];
				if($ma->add_nhap_hang($db, $soLuongNhap,$sotiendonvi,$thanhtien,$ngaynhap,$idthuoc,$idHang,$idBenh)){
					// them moi don nhap hang thanh cong
					$soLuongTrongKho = $row['SoLuongTonKho']+$soLuongNhap;
					if(!$drug->nhap_thuoc($db, $row['id'],$soLuongTrongKho)){
						//+ them so luong thuoc khong thanh cong
						$listthuoc = $drug->list_all_thuoc($db);//////////////////////////////////
						$_SESSION['thuocs'] = $listthuoc;//////////////////////////////////
						$listbenh = $benh->list_benh($db);
						$_SESSION['benhs'] = $listbenh;
						$listhang = $hang->list_hang($db);
						$_SESSION['hangs'] = $listhang;
						$_SESSION['flash-level'] = 'danger';
						$_SESSION['flash-error'] = 'Thêm thất bại1';
						header("Location: view-add-nhap-thuoc.php");
					}else{
						//+ them thuoc thanh cong
						$_SESSION['flash-level'] = 'success';
						$_SESSION['flash-message'] = 'Thêm mới đơn nhập hàng thành công.';
						header("Location: view-list-nhap-hang.php");
					}
				}else{
					// them don hang thuoc that bai
					$listthuoc = $drug->list_all_thuoc($db);//////////////////////////////////
					$_SESSION['thuocs'] = $listthuoc;//////////////////////////////////
					$listbenh = $benh->list_benh($db);
					$_SESSION['benhs'] = $listbenh;
					$listhang = $hang->list_hang($db);
					$_SESSION['hangs'] = $listhang;
					$_SESSION['flash-level'] = 'danger';
					$_SESSION['flash-error'] = 'Thêm thất bại2';
					header("Location: view-add-nhap-thuoc.php");
				}
				$_SESSION['flash-level'] = 'success';
				$_SESSION['flash-message'] = 'Thêm mới đơn nhập hàng thành công.';
				header("Location: view-list-nhap-hang.php");
			} else {
				// lay loai thuoc thay bai that bai
				$listthuoc = $drug->list_all_thuoc($db);//////////////////////////////////
				$_SESSION['thuocs'] = $listthuoc;//////////////////////////////////
				$listbenh = $benh->list_benh($db);
				$_SESSION['benhs'] = $listbenh;
				$listhang = $hang->list_hang($db);
				$_SESSION['hangs'] = $listhang;
				$_SESSION['flash-level'] = 'danger';
				$_SESSION['flash-error'] = 'Thong tin loai thuoc khong dung';
				header("Location: view-add-nhap-thuoc.php");
			}
			break;
		case 'edit':
			$id = filter_input(INPUT_GET, 'id');
			$donhang = $ma->get_edit_nhap_thuoc($db, $id);
			if (!empty($donhang)) {
				$_SESSION['item'] = $donhang;
				header("Location: view-edit-nhap-thuoc.php");
			} else {
				$_SESSION['flash-level'] = 'danger';
				$_SESSION['flash-message'] = 'Xảy ra lỗi. Vui lòng liên hệ với quản trị viên để được giúp đỡ.';
				header("Location: view-list-nhap-thuoc.php");
			}
			break;
		case 'postedit':
			$soLuongNhap = filter_input(INPUT_POST, 'soluong');
			$soLuongCu = filter_input(INPUT_POST, 'soluongcu');
			$sotiendonvi = filter_input(INPUT_POST, 'fee');
			$thanhtien = filter_input(INPUT_POST, 'thanhtien');
			$ngaysua = date('Y-m-d');
			$idthuoc = filter_input(INPUT_POST, 'TenThuoc');
			$idHang = filter_input(INPUT_POST, 'idHang');
			$idBenh = filter_input(INPUT_POST, 'idBenh');
			if ($ma->post_edit_nhap_thuoc($db, $soLuongNhap,$sotiendonvi,$thanhtien,$ngaysua,$idthuoc,$idHang,$idBenh)) {
				//sua don nhap hang thanh cong
				if(!empty($row = $drug->get_thuoc_by_idBenh_idHang($db,$idBenh,$idHang))){
					// lay dc loai thuoc theo idBenh va idHang
					$soLuongTrongKho = $row['SoLuongTonKho']+$soLuongNhap-$soLuongCu;
					if(!$drug->nhap_thuoc($db, $row['id'],$soLuongTrongKho)){
						//sua so luong thuoc khong thanh cong
						$_SESSION['flash-level'] = 'danger';
						$_SESSION['flash-message'] = 'Xảy ra lỗi. Vui lòng liên hệ với quản trị viên để được giúp đỡ.';
						header("Location: view-list-nhap-hang.php");
					}else{
						//sua thuoc thanh cong
						$_SESSION['flash-level'] = 'success';
						$_SESSION['flash-message'] = 'Sửa thành công.';
						header("Location: view-list-nhap-hang.php");
					}
				}else{
					// lay loai thuoc that bai
					$_SESSION['flash-level'] = 'danger';
					$_SESSION['flash-message'] = 'Xảy ra lỗi. Vui lòng liên hệ với quản trị viên để được giúp đỡ.';
					header("Location: view-list-nhap-hang.php");
				}
			} else {
				// sua don hang that bai
					$_SESSION['flash-level'] = 'danger';
					$_SESSION['flash-message'] = 'Xảy ra lỗi. Vui lòng liên hệ với quản trị viên để được giúp đỡ.';
					header("Location: view-list-nhap-hang.php");
			}
			break;
			
		case 'delete':
			$id = filter_input(INPUT_GET, 'id');
			$donhang = $ma->get_nhap_thuoc_by_id($db, $id);
			if ($ma->delete_benh($db, $id)) {
				if(!empty($row = $drug->get_thuoc_by_idBenh_idHang($db,$donhang['idBenh'],$donhang['idHang']))){
					// lay dc loai thuoc theo idBenh va idHang
					$soLuongTrongKho = $row['SoLuongTonKho']-$donhang['SoLuongTonKho'];
					if(!$drug->nhap_thuoc($db, $row['id'],$soLuongTrongKho)){
						//sua so luong thuoc khong thanh cong
						$_SESSION['flash-level'] = 'danger';
						$_SESSION['flash-message'] = 'Xảy ra lỗi. Vui lòng liên hệ với quản trị viên để được giúp đỡ.';
						header("Location: view-list-nhap-hang.php");
					}else{
						//sua thuoc thanh cong
						$_SESSION['flash-level'] = 'success';
						$_SESSION['flash-message'] = 'Xoa thành công.';
						header("Location: view-list-nhap-hang.php");
					}
				}else{
					// lay loai thuoc that bai
					$_SESSION['flash-level'] = 'danger';
					$_SESSION['flash-message'] = 'Xảy ra lỗi. Vui lòng liên hệ với quản trị viên để được giúp đỡ.';
					header("Location: view-list-nhap-hang.php");
				}
			} else {
				$_SESSION['flash-level'] = 'danger';
				$_SESSION['flash-message'] = 'Xảy ra lỗi. Vui lòng liên hệ với quản trị viên để được giúp đỡ.';
				header("Location: view-list-nhap-hang.php");
			}
			
			break;
		default:
			$donhangs = $ma->list_don_hang($db);
			break;
	}
?>