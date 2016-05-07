<?php
	class Benh {
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
	}
?>