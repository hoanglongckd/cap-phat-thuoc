<?php

	class Thuoc {
		
		public function thuoc_exist($db, $tenThuoc, $idHang, $idBenh) {
			$query = "SELECT id FROM loaithuoc where TenThuoc = :tenThuoc AND idLoaiBenh = :idBenh AND idHang = :idHang";
			$statement = $db->prepare($query);
			$statement->bindValue(':tenThuoc', $tenThuoc);
			$statement->bindValue(':idBenh', $idBenh);
			$statement->bindValue(':idHang', $idHang);
			$statement->execute();
			$valid = ($statement->rowCount() == 1);
			$statement->closeCursor();
			return $valid;
		}
		
		public function add_thuoc($db, $tenThuoc, $dinhLuong, $moTa, $idLoaiBenh, $idHang) {
			$query = "INSERT INTO loaithuoc 
						(TenThuoc, DinhLuong, MoTa, idLoaiBenh, idHang)
					  VALUES
						(:tenThuoc, :dinhLuong, :moTa, :idLoaiBenh, :idHang)";
			$statement = $db->prepare($query);
			$statement->bindValue(':tenThuoc', $tenThuoc);
			$statement->bindValue(':dinhLuong', $dinhLuong);
			$statement->bindValue(':moTa', $moTa);
			$statement->bindValue(':idLoaiBenh', $idLoaiBenh);
			$statement->bindValue(':idHang', $idHang);
			$valid = $statement->execute();
			$statement->closeCursor();
			return $valid;
		}
		
		public function list_thuoc($db) {
			$query = "SELECT loaithuoc.id, loaithuoc.TenThuoc, loaithuoc.DinhLuong
						, loaithuoc.SoLuongTonKho, loaithuoc.MoTa, loaibenh.TenBenh
						, hang.TenHang FROM loaithuoc, loaibenh, hang 
						WHERE loaithuoc.idLoaiBenh = loaibenh.id AND loaithuoc.idHang = hang.id 
						ORDER BY hang.TenHang";
			$statement = $db->prepare($query);
			$statement->execute();
			$row = $statement->fetchAll();
			$statement->closeCursor();
			return $row;
		}
		
		public function delete($db, $id) {
			$query = "DELETE FROM loaithuoc where id = :id";
			$statement = $db->prepare($query);
			$statement->bindValue(':id', $id);
			$valid = $statement->execute();
			$statement->closeCursor();
			return $valid;
		}
	}


?>