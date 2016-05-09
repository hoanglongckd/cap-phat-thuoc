<?php

	class XuatThuoc {
		
		public function add_xuat_thuoc($db, $soLuongXuat, $soTien, $thanhTien, $ngayXuat, $idLoaiThuoc) {
			$query = "INSERT INTO xuatthuoc 
						(SoLuongXuat, SoTienTrenMotDonVi, ThanhTien, NgayXuat, NgaySua, idLoaiThuoc)
					  VALUES
						(:soLuongXuat, :soTien, :thanhTien, :ngayXuat, :ngayXuat, :idLoaiThuoc)";
			$statement = $db->prepare($query);
			$statement->bindValue(':soLuongXuat', $soLuongXuat);
			$statement->bindValue(':soTien', $soTien);
			$statement->bindValue(':thanhTien', $thanhTien);
			$statement->bindValue(':ngayXuat', $ngayXuat);
			$statement->bindValue(':idLoaiThuoc', $idLoaiThuoc);
			$valid = $statement->execute();
			$statement->closeCursor();
			return $valid;
		}
		
		public function list_xuat_thuoc($db) {
			$query = "SELECT xuatthuoc.id, xuatthuoc.SoLuongXuat, xuatthuoc.SoTienTrenMotDonVi
						, xuatthuoc.ThanhTien, xuatthuoc.NgayXuat, xuatthuoc.NgaySua
						, loaithuoc.TenThuoc, loaibenh.TenBenh, hang.TenHang FROM xuatthuoc 
						INNER JOIN loaithuoc ON xuatthuoc.idLoaiThuoc = loaithuoc.id 
						INNER JOIN loaibenh ON loaithuoc.idLoaiBenh = loaibenh.id 
						INNER JOIN hang ON loaithuoc.idHang = hang.id 
						ORDER BY xuatthuoc.NgaySua DESC";
			$statement = $db->prepare($query);
			$statement->execute();
			$row = $statement->fetchAll();
			$statement->closeCursor();
			return $row;
		}
		
		// Lay so luong thuoc da xuat
		public function get_so_luong_xuat($db, $id) {
			$query = "SELECT SoLuongXuat, idLoaiThuoc FROM xuatthuoc WHERE id = :id";
			$statement = $db->prepare($query);
			$statement->bindValue(':id', $id);
			$statement->execute();
			$row = $statement->fetch();
			$statement->closeCursor();
			return $row;
		}
		
		// Xoa don thuoc da duoc xuat
		public function delete($db, $id) {
			$query = "DELETE FROM xuatthuoc WHERE id = :id";
			$statement = $db->prepare($query);
			$statement->bindValue(':id', $id);
			$valid = $statement->execute();
			$statement->closeCursor();
			return $valid;
		}
		
	}

?>