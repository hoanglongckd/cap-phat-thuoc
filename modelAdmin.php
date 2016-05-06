<?php
	

	class Admin {
		
		public function __construct() { }
		
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
	}


?>