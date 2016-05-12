<?php 
	require_once('modelConnectDatabase.php');
	
	$username = 'admin';
	$password = '123456';
	
	$query =   "insert into admin
					(username, password, level)
				values
					(:username, :password, 1)";
	$statement = $db->prepare($query);
	$statement->bindValue(':username', $username);
	$statement->bindValue(':password', md5($username . $password));
	$statement->execute();
	$bool = $statement->closeCursor();
	if ($bool)
		echo 'Success.';
	else 
		echo 'Fail.';
?>