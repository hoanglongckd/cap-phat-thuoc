<?php
	// Database Source Name
	$dsn = 'mysql:host=localhost;dbname=capphatthuoc';
	$username = 'root';
	$password = '';
	
	try {
		$db = new PDO($dsn, $username, $password);
	} catch (Exception $e) {
		$error_messages = $e->getMessage();
		include 'errors.php';
		exit();
	}

?>