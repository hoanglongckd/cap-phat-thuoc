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
			$listbenh = $benh->list_benh($db);
			$_SESSION['benhs'] = $listbenh;
			$listhang = $hang->list_hang($db);
			$_SESSION['hangs'] = $listhang;
			header("Location: view-add-nhap-thuoc.php");
			break;
		case 'add-2':
			$soLuongNhap = filter_input(INPUT_POST, 'soluong');
			$sotiendonvi = filter_input(INPUT_POST, 'fee');
			$thanhtien = $soLuongNhap*$sotiendonvi;
			$ngaynhap = date('Y-m-d');
			$idthuoc = filter_input(INPUT_POST, 'idThuoc');
			if (!empty($row = $drug->get_edit_thuoc($db,$idthuoc))) {
				//lay dc loai thuoc theo idBenh va idHang ten benh them moi don nhap hang thanh cong
				$idBenh = $row['idLoaiBenh'];
				$idHang = $row['idHang'];
				if($ma->add_nhap_hang($db, $soLuongNhap,$sotiendonvi,$thanhtien,$ngaynhap,$idthuoc,$idHang,$idBenh)){
					// them moi don nhap hang thanh cong
					$soLuongTrongKho = $row['SoLuongTonKho']+$soLuongNhap;
					if(!$drug->nhap_thuoc($db, $row['id'],$soLuongTrongKho)){
						//+ them so luong thuoc khong thanh cong
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
			$id = filter_input(INPUT_POST, 'id');
		 	$loaithuoc = $ma->get_nhap_thuoc_by_id($db, $id);
		 	$idthuoc = $loaithuoc['idLoaiThuoc'];
			if ($ma->post_edit_nhap_thuoc($db, $soLuongNhap,$sotiendonvi,$thanhtien,$ngaysua,$id)) {
				//sua don nhap hang thanh cong
				if(!empty($row = $drug->get_edit_thuoc($db,$idthuoc))){
					// lay dc loai thuoc theo idthuoc
					$soLuongTrongKho = $row['SoLuongTonKho']+$soLuongNhap-$soLuongCu;
					if(!$drug->nhap_thuoc($db, $row['id'],$soLuongTrongKho)){
						//sua so luong thuoc khong thanh cong
						$_SESSION['flash-level'] = 'danger';
						$_SESSION['flash-message'] = 'Xảy ra lỗi. Vui lòng liên hệ với quản trị viên để được giúp đỡ.1';
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
					$_SESSION['flash-message'] = 'Xảy ra lỗi. Vui lòng liên hệ với quản trị viên để được giúp đỡ.2';
					header("Location: view-list-nhap-hang.php");
				}
			} else {
				// sua don hang that bai
					$_SESSION['flash-level'] = 'danger';
					$_SESSION['flash-message'] = 'Xảy ra lỗi. Vui lòng liên hệ với quản trị viên để được giúp đỡ.3';
					header("Location: view-list-nhap-hang.php");
			}
			break;
			
		case 'delete':
			$id = filter_input(INPUT_GET, 'id');
			$donhang = $ma->get_nhap_thuoc_by_id($db, $id);
			if ($ma->delete_don_nhap_hang($db, $id)) {
				if(!empty($row = $drug->get_edit_thuoc($db,$donhang['idLoaiThuoc']))){
					// lay dc loai thuoc theo idloaithuoc
					$soLuongTrongKho = $row['SoLuongTonKho']-$donhang['SoLuongNhap'];
					if(!$drug->nhap_thuoc($db, $row['id'],$soLuongTrongKho)){
						//sua so luong thuoc khong thanh cong
						$_SESSION['flash-level'] = 'danger';
						$_SESSION['flash-message'] = 'Xảy ra lỗi. Vui lòng liên hệ với quản trị viên để được giúp đỡ.';
						header("Location: view-list-nhap-hang.php");
					}else{
						//sua thuoc thanh cong
						$_SESSION['flash-level'] = 'success';
						$_SESSION['flash-message'] = 'Xóa thành công.';
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
		case 'getthuoc':
			$idBenh = filter_input(INPUT_POST, 'idBenh');
			$idHang = filter_input(INPUT_POST, 'idHang');
			$thuocs = $drug->get_thuoc($db, $idBenh, $idHang);
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
				$data .= '<div id="insert-input-to-import"></div>';
			} else {
				$data .= '<div class="form-group">';
				$data .= '<input type="text" class="form-control" value="Không có thuốc trong kho." disabled />';
			}
			echo $data;
			break;
		case 'getsoluongthuoc';
			$soluong1 = filter_input(INPUT_POST, 'soLuongNhap');
			$sotiendonvi1 = filter_input(INPUT_POST, 'soTien');
			$thanhtien1 = $soluong1 *$sotiendonvi1;
			$data = '';
			$data .= '<div class="form-group">';
			$data .= '<label for="soluong">Số lượng nhập</label>';
			$data .= '<input type="number" class="form-control" name="soluong" id="soluong" required />';
			$data .= '</div>';
			$data .= '<div class="form-group">';
			$data .= '<label for="fee">Số tiền trên một đơn vị</label>';
			$data .= '<input type="number" class="form-control" name="fee" id="fee" required  onblur="importDrug()"/>';
			$data .= '</div>';
			$data .= '<input type="hidden" name="action" value="add-2" />';
			$data .= '<button type="submit" class="btn btn-default" >Thêm đơn hàng</button>';
			$data .= '<button type="button" id="resetxuathang" onclick="importDrug()" class="btn btn-default">Reset</button>';
			echo $data; 
		break;
			
		default:
			$donhangs = $ma->list_don_hang($db);
			break;
	}
?>