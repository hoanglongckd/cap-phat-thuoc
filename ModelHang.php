<?php

	class Hang {
		
		public function them_hang ($db, $tenHang, $moTa) {
			$query = "INSERT INTO hang (TenHang, MoTa) VALUES (:tenHang, :moTa)";
			$statement = $db->prepare($query);
			$statement->bindValue(':tenHang', $tenHang);
			$statement->bindValue(':moTa', $moTa);
			$valid = $statement->execute();
			$statement->closeCursor();
			return $valid;
		}
		
		public function list_hang ($db) {
			$query = "SELECT * FROM hang ORDER BY TenHang";
			$statement = $db->prepare($query);
			$statement->execute();
			$row = $statement->fetchAll();
			$statement->closeCursor();
			return $row;
		}
		
		public function get_edit_hang($db, $id) {
			
		}
		
		public function delete_hang($db, $id) {
			$query = "DELETE FROM hang where id = :id";
			$statement = $db->prepare($id);
			$statement->bindValue(':id', $id);
			$valid = $statement->execute();
			$statement->closeCursor();
			return $valid;
		}
		
	}


?>