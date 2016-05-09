<?php 
	
	session_start();
	include 'ControllerSession.php';
	$cs = new Session();
	if (!$cs->checkUserLogin()) {
		header("Location: login.php");
		return;
	}
	require_once 'ModelConnectDatabase.php';
	include 'ModelBenh.php';
	include 'ModelHang.php';
	include 'ModelThuoc.php';
	include 'ModelXuatThuoc.php';

	$action = filter_input(INPUT_POST, 'action');
	if (empty($action))
		$action = filter_input(INPUT_GET, 'action');
	
	$mb = new Benh();
	$mh = new Hang();
	$mt = new Thuoc();
	$mxt = new XuatThuoc();
	
	switch ($action) {
		case 'getexport':
			$_SESSION['benhs'] = $mb->list_benh($db);
			$_SESSION['hangs'] = $mh->list_hang($db);
			header("Location: view-add-xuat-thuoc.php");
			break;
		case 'postexport':
			$idThuoc = filter_input(INPUT_POST, 'idThuoc');
			$soLuongXuat = filter_input(INPUT_POST, 'soLuongXuat');
			$soTien = filter_input(INPUT_POST, 'soTien');
			$thanhTien = ( (int)$soLuongXuat ) * ( (int)$soTien );
			$ngayXuat = date("Y-m-d");
			if ($mxt->add_xuat_thuoc($db, $soLuongXuat, $soTien, $thanhTien, $ngayXuat, $idThuoc)) {
				$mt->decrement($db, $idThuoc, $soLuongXuat);
				$_SESSION['flash-level'] = 'success';
				$_SESSION['flash-message'] = 'Xuất thuốc thành công!';
				echo 'success';
			} else {
				echo 'Xảy ra lỗi. Vui lòng liên hệ với quản trị viên để được giúp đỡ.';
			}
			break;
		case 'getthuoc':
			$idBenh = filter_input(INPUT_POST, 'idBenh');
			$idHang = filter_input(INPUT_POST, 'idHang');
			$thuocs = $mt->get_thuoc($db, $idBenh, $idHang);
			$data = '';
			if ( !empty($thuocs) ) {
				$data .= '<div class="form-group">';
				$data .= '<label for="TenThuoc">Tên Thuốc</label>';
				$data .= '<select class="form-control" name="idThuoc" id="TenThuoc" required>';
				$data .= '<option value="">Chọn tên thuốc</option>';
				foreach($thuocs as $thuoc) {
					$data .= '<option value="' . $thuoc['id'] . '">' . $thuoc['TenThuoc'] . '</option>';
				}
				$data .= '</select>';
				$data .= '</div>';
				$data .= '<div id="insert-input-to-export"></div>';
			} else {
				$data .= '<div class="form-group">';
				$data .= '<input type="text" class="form-control" value="Không có thuốc trong kho." disabled />';
			}
			echo $data;
			break;			
		case 'getsoluongthuoc';
			$idThuoc = filter_input(INPUT_POST, 'idThuoc');
			$thuoc = $mt->get_so_luong($db, $idThuoc);
			$data = '';
			$data .= '<div class="form-group"';
			$data .= '<label for="">Số lượng tồn kho</label>';
			$data .= '<input type="text" class="form-control" name="tonkho" id="tonkho" value="' . $thuoc['SoLuongTonKho'] . '" readonly />';
			$data .= '</div>';
			$data .= '<div class="form-group">';
			$data .= '<label for="soluongxuat">Số lượng xuất</label>';
			$data .= '<input type="number" class="form-control" name="soluongxuat" id="soluongxuat" required />';
			$data .= '</div>';
			$data .= '<div class="form-group">';
			$data .= '<label for="sotien">Số tiền trên một đơn vị</label>';
			$data .= '<input type="number" class="form-control" name="sotien" id="sotien" required />';
			$data .= '</div>';
			$data .= '<input type="hidden" name="action" id="action" value="postexport" />';
			$data .= '<button type="button" id="exportdrug" onclick="exportDrug()" class="btn btn-default">Add Drug</button>';
			$data .= '<button type="reset" class="btn btn-default">Reset</button>';
			echo $data;
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
			$xuatthuoc = $mxt->get_so_luong_xuat($db, $id);
			if ($mxt->delete($db, $id)) {
				$mt->increment($db, $xuatthuoc['idLoaiThuoc'], $xuatthuoc['SoLuongXuat']);
				$_SESSION['flash-level'] = 'success';
				$_SESSION['flash-message'] = 'Xóa thành công!';
			} else {
				$_SESSION['flash-level'] = 'danger';
				$_SESSION['flash-message'] = 'Xảy ra lỗi. Vui lòng liên hệ với quản trị viên để được giúp đỡ.';
			}
			header("Location: view-list-xuat-thuoc.php");
			break;
		default:
			$xuatthuocs = $mxt->list_xuat_thuoc($db);
			break;
	}

?>