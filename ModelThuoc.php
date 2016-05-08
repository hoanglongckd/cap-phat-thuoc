<?php

	class Thuoc {
		
		public function thuoc_exist($db, $tenThuoc, $idHang, $idBenh) {
			$query = "SELECT id FROM loaithuoc WHERE TenThuoc = :tenThuoc AND idLoaiBenh = :idBenh AND idHang = :idHang";
			$statement = $db->prepare($query);
			$statement->bindValue(':tenThuoc', $tenThuoc);
			$statement->bindValue(':idBenh', $idBenh);
			$statement->bindValue(':idHang', $idHang);
			$statement->execute();
			$valid = ($statement->rowCount() == 1);
			$statement->closeCursor();
			return $valid;
		}
		
		// Kiểm tra xem tên thuốc đã tồn tại hay chưa, ngoại trừ chính nó.
		public function thuoc_exist_not_itself($db, $id, $tenThuoc, $idHang, $idBenh) {
			$query = "SELECT id FROM loaithuoc 
						WHERE id != :id AND TenThuoc = :tenThuoc AND idLoaiBenh = :idBenh AND idHang = :idHang";
			$statement = $db->prepare($query);
			$statement->bindValue(':id', $id);
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
		
		public function get_edit_thuoc($db, $id) {
			$query = "SELECT * FROM loaithuoc WHERE id = :id";
			$statement = $db->prepare($query);
			$statement->bindValue(':id', $id);
			$statement->execute();
			$row = $statement->fetch();
			$statement->closeCursor();
			return $row;
		}
		
		public function post_edit_thuoc($db, $id, $tenThuoc, $dinhLuong, $moTa, $idBenh, $idHang) {
			$query = "UPDATE loaithuoc SET 
						TenThuoc = :tenThuoc, DinhLuong = :dinhLuong, MoTa = :moTa
						, idLoaiBenh = :idBenh, idHang = :idHang
						WHERE id = :id";
			$statement = $db->prepare($query);
			$statement->bindValue(':tenThuoc', $tenThuoc);
			$statement->bindValue(':dinhLuong', $dinhLuong);
			$statement->bindValue(':moTa', $moTa);
			$statement->bindValue(':idBenh', $idBenh);
			$statement->bindValue(':idHang', $idHang);
			$statement->bindValue(':id', $id);
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
		
		// Lay danh sach thuoc khi co idBenh va idHang
		public function get_thuoc($db, $idBenh, $idHang) {
			$query = "SELECT id, TenThuoc FROM loaithuoc WHERE idLoaiBenh = :idBenh AND idHang = :idHang";
			$statement = $db->prepare($query);
			$statement->bindValue(':idBenh', $idBenh);
			$statement->bindValue(':idHang', $idHang);
			$statement->execute();
// 			if ($statement->rowCount() == 1) {
// 				$row = $statement->fetch();
// 			} else {
				$row = $statement->fetchAll();
// 			}
			$statement->closeCursor();
			return $row;
		}
		
		// Lay so luong thuoc trong kho
		public function get_so_luong($db, $id) {
			$query = "SELECT SoLuongTonKho FROM loaithuoc WHERE id = :id";
			$statement = $db->prepare($query);
			$statement->bindValue(':id', $id);
			$statement->execute();
			$row = $statement->fetch();
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