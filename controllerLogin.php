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
		echo $_SESSION['user']['username'];
		echo '<br>' . $_SESSION['user']['level'] . '<br>';
		print_r($_SESSION);
	}
	else
		echo 'fail';
	
?>