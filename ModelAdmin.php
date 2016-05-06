<?php
	
	

	class Admin {
		
		public function is_valid_login($db, $username, $password) {
			$password = md5($username . $password);
			$query = "SELECT level FROM admin WHERE
						username = :username AND password = :password";
			$statement = $db->prepare($query);
			$statement->bindValue(':username', $username);
			$statement->bindValue(':password', $password);
			$statement->execute();
			$row = $statement->fetch();
			$statement->closeCursor();
			return $row['level'];
		}
		
		public function user_exist($db, $username) {
			$query = "SELECT * FROM admin WHERE username = :username";
			$statement = $db->prepare($query);
			$statement->bindValue(':username', $username);
			$statement->execute();
			$valid = ($statement->rowCount() == 1);
			return $valid;
		}
		
		public function add_user($db, $username, $password) {
			$password = md5($username . $password);
			$query = "INSERT INTO admin 
						(username, password, level)
					  VALUES
						(:username, :password, 2)";
			$statement = $db->prepare($query);
			$statement->bindValue(':username', $username);
			$statement->bindValue(':password', $password);
			$statement->execute();
			$statement->closeCursor();
		}
		
		public function list_user($db) {
			$query = "SELECT id, username FROM admin ORDER BY username";
			$statement = $db->prepare($query);
			$statement->execute();
			$row = $statement->fetchAll();
			$statement->closeCursor();
			return $row;
		}
		
	}


?>