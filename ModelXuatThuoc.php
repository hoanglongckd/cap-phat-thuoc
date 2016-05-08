<?php

	class XuatThuoc {
		
		public function add_xuat_thuoc($db, $soLuongXuat, $soTien, $thanhTien, $ngayXuat, $idLoaiThuoc) {
			$query = "INSERT INTO xuatthuoc 
						(SoLuongXuat, SoTienTrenMotDonVi, ThanhTien, NgayXuat, idLoaiThuoc)
					  VALUES
						(:soLuongXuat, :soTien, :thanhTien, :ngayXuat, :idLoaiThuoc)";
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
		
	}

?>