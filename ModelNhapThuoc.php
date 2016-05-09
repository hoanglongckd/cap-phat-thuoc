<?php
	class Nhap {
		
		public function loaibenh_exist($db, $tenbenh) {
			$query = "SELECT * FROM loaibenh WHERE TenBenh = :tenbenh";
			$statement = $db->prepare($query);
			$statement->bindValue(':tenbenh', $tenbenh);
			$statement->execute();
			$valid = ($statement->rowCount() == 1);
			return $valid;
		}
		
		public function add_nhap_hang($db, $soLuongNhap,$sotiendonvi,$thanhtien,$ngaynhap,$idthuoc,$idHang,$idBenh) {
			$query = "INSERT INTO nhapthuoc
								(`SoLuongNhap`, `SoTienTrenMotDonVi`, `ThanhTien`, `NgayNhap`, `idLoaiThuoc`, idHang, idBenh )
							  VALUES
								(:soluong, :sotiendonvi , :thanhtien, :ngaynhap, :idloaithuoc, :idHang, :idBenh)";
			$statement = $db->prepare($query);
			$statement->bindValue(':soluong', $soLuongNhap);
			$statement->bindValue(':sotiendonvi', $sotiendonvi);
			$statement->bindValue(':thanhtien', $thanhtien);
			$statement->bindValue(':ngaynhap', $ngaynhap);
			$statement->bindValue(':idloaithuoc', $idthuoc);
			$statement->bindValue(':idBenh', $idBenh);
			$statement->bindValue(':idHang', $idHang);
			$valid = $statement->execute();
			$statement->closeCursor();
			return $valid;
		}
		
		public function list_don_hang($db) {
			$query = "SELECT n.id, n.`SoLuongNhap`, n.`SoTienTrenMotDonVi`, n.`ThanhTien`, n.`NgayNhap`, n.`NgaySua`, hang.TenHang, loaibenh.TenBenh, loaithuoc.TenThuoc
					FROM `nhapthuoc` as n
					INNER join hang , loaibenh , loaithuoc
					WHERE n.idHang = hang.id AND n.idBenh = loaibenh.id AND loaithuoc.id = n.idLoaiThuoc";
			$statement = $db->prepare($query);
			$statement->execute();
			$row = $statement->fetchAll();
			$statement->closeCursor();
			return $row;
		}
		
		public function get_edit_nhap_thuoc($db, $id) {
			$query = "SELECT n.id, n.`SoLuongNhap`, n.`SoTienTrenMotDonVi`, n.`ThanhTien`, n.`NgayNhap`, n.`NgaySua`, hang.TenHang, loaibenh.TenBenh, loaithuoc.TenThuoc
					FROM `nhapthuoc` as n
					INNER join hang , loaibenh , loaithuoc
					WHERE n.idHang = hang.id AND n.idBenh = loaibenh.id AND loaithuoc.id = n.idLoaiThuoc AND n.id = :id";
			$statement = $db->prepare($query);
			$statement->bindValue(':id', $id);
			$statement->execute();
			$row = $statement->fetch();
			$statement->closeCursor();
			return $row;
		}
		
		public function get_nhap_thuoc_by_id($db, $id) {
			$query = "SELECT * FROM nhapthuoc WHERE id = :id";
			$statement = $db->prepare($query);
			$statement->bindValue(':id', $id);
			$statement->execute();
			$row = $statement->fetch();
			$statement->closeCursor();
			return $row;
		}
		
		public function post_edit_nhap_thuoc($db, $soLuongNhap,$sotiendonvi,$thanhtien,$ngaysua,$id) {
			$query = "UPDATE `nhapthuoc` 
					SET `SoLuongNhap`=:Soluong,`SoTienTrenMotDonVi`=:soTienDonVi,
						`ThanhTien`=:thanhTien,`NgaySua`=:ngaySua
					WHERE id=:id ";
			$statement = $db->prepare($query);
			$statement->bindValue(':Soluong', $soLuongNhap);
			$statement->bindValue(':soTienDonVi', $sotiendonvi);
			$statement->bindValue(':thanhTien', $thanhtien);
			$statement->bindValue(':ngaySua', $ngaysua);
			$statement->bindValue(':id', $id);
			$valid = $statement->execute();
			$statement->closeCursor();
			return $valid;
		}
		
		public function delete_don_nhap_hang($db, $id) {
			$query = "DELETE FROM nhapthuoc WHERE id = :id";
			$statement = $db->prepare($query);
			$statement->bindValue(':id', $id);
			$valid = $statement->execute();
			$statement->closeCursor();
			return $valid;
		}
		
	}
?>