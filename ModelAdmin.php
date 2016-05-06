<?php
	
	class Admin {
		
		public function logout() {
			session_start();
			$_SESSION = array(); // Clear session data from memory
			session_destroy();	// Clean up the session ID
		}
		
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
			$query = "SELECT id, username FROM admin WHERE level != 1 ORDER BY username";
			$statement = $db->prepare($query);
			$statement->execute();
			$row = $statement->fetchAll();
			$statement->closeCursor();
			return $row;
		}
		
		public function get_edit_user($db, $id) {
			$query = "SELECT id, username FROM admin WHERE id = :id";
			$statement = $db->prepare($query);
			$statement->bindValue(':id', $id);
			$statement->execute();
			$row = $statement->fetch();
			$statement->closeCursor();
			return $row;
		}
		
		public function post_edit_user($db, $id, $username, $password) {
			$password = md5($username . $password);
			$query = "UPDATE admin SET username = :username, password = :password where id = :id ";
			$statement = $db->prepare($query);
			$statement->bindValue(':username', $username);
			$statement->bindValue(':password', $password);
			$statement->bindValue('id', $id);
			$valid = $statement->execute();
			$statement->closeCursor();
			return $valid;
		}
		
		public function delete_user($db, $id) {
			$query = "DELETE FROM admin WHERE id = :id";
			$statement = $db->prepare($query);
			$statement->bindValue(':id', $id);
			$valid = $statement->execute();
			$statement->closeCursor();
			return $valid;
		}
		
	}


?>