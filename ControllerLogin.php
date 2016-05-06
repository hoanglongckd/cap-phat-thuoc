<?php
	require_once('modelConnectDatabase.php');
	require_once('modelAdmin.php');
	
	session_start();
	
	$username = filter_input(INPUT_POST, 'username');
	$password = filter_input(INPUT_POST, 'password');
	
	$ma = new Admin();
	$level = $ma->is_valid_login($db, $username, $password);
	if(!empty($level)) {
		$_SESSION['user']['username'] = $username;
		$_SESSION['user']['level'] = $level;
		header("Location: dashboard.php");
	}
	else
		echo 'fail';
	
?>