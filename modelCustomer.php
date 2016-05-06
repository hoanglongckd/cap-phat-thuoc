<?php
	class Customer {
		
		public function addCustomer($name, $phone, $address, $birthday, $gender) {
			$query = "INSERT INTO khachhang (HoTen, SoDienThoai, DiaChi, NgaySinh, GioiTinh)
						VALUES (:hoTen, :soDienThoai, :diaChi, :ngaySinh, :gioiTinh)";
			$statement = $db->prepare($query);
			$statement->bindValue(':hoTen', $name);
			$statement->bindValue(':soDienThoai', $phone);
			$statement->bindValue(':diaChi', $address);
			$statement->bindValue(':ngaySinh', $birthday);
			$statement->bindValue(':gioitinh', $gender);
			$statement->excute();
			$statement->closeCursor();
		}
		
	}