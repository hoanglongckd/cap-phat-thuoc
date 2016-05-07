<?php
	class Benh {
		
		public function loaibenh_exist($db, $tenbenh) {
			$query = "SELECT * FROM loaibenh WHERE TenBenh = :tenbenh";
			$statement = $db->prepare($query);
			$statement->bindValue(':tenbenh', $tenbenh);
			$statement->execute();
			$valid = ($statement->rowCount() == 1);
			return $valid;
		}
		
		public function add_benh($db, $TenBenh, $MoTa) {
			$password = md5($username . $password);
			$query = "INSERT INTO loaibenh
								(MoTa, TenBenh)
							  VALUES
								(:MoTa, :TenBenh)";
			$statement = $db->prepare($query);
			$statement->bindValue(':MoTa', $MoTa);
			$statement->bindValue(':TenBenh', $TenBenh);
			$statement->execute();
			$statement->closeCursor();
		}
		
		public function list_benh($db) {
			$query = "SELECT * FROM loaibenh WHERE 1 ORDER BY id";
			$statement = $db->prepare($query);
			$statement->execute();
			$row = $statement->fetchAll();
			$statement->closeCursor();
			return $row;
		}
		
		public function get_edit_benh($db, $id) {
			$query = "SELECT id, TenBenh, MoTa FROM loaibenh WHERE id = :id";
			$statement = $db->prepare($query);
			$statement->bindValue(':id', $id);
			$statement->execute();
			$row = $statement->fetch();
			$statement->closeCursor();
			return $row;
		}
		
		public function post_edit_benh($db, $id, $tenbenh, $mota) {
			$query = "UPDATE loaibenh SET TenBenh = :tenbenh, MoTa = :mota where id = :id ";
			$statement = $db->prepare($query);
			$statement->bindValue(':tenbenh', $tenbenh);
			$statement->bindValue(':mota', $mota);
			$statement->bindValue('id', $id);
			$valid = $statement->execute();
			$statement->closeCursor();
			return $valid;
		}
		
		public function delete_benh($db, $id) {
			$query = "DELETE FROM loaibenh WHERE id = :id";
			$statement = $db->prepare($query);
			$statement->bindValue(':id', $id);
			$valid = $statement->execute();
			$statement->closeCursor();
			return $valid;
		}
		
	}
?>