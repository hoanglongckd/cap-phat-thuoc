<?php
	// Database Source Name
	$dsn = 'mysql:host=localhost;dbname=capphatthuoc';
	$username = 'root';
	$password = '';
	
	try {
		$db = new PDO($dsn, $username, $password);
		$db->exec("SET names utf8"); //them tieng viet vao database php
	} catch (Exception $e) {
		$error_messages = $e->getMessage();
		include 'errors.php';
		exit();
		
	}
?>