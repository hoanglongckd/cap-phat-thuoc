<?php
	require_once('modelConnectDatabase.php');
	require_once('modelAdmin.php');
	
	session_start();
	include 'ControllerSession.php';
	$cs = new Session();
	if (!empty($_SESSION['user'])) {
		header("Location: errors.php");
		return;
	}
	$username = filter_input(INPUT_POST, 'username');
	$password = filter_input(INPUT_POST, 'password');
	
	if (empty($username)) {
		header("Location: login.php");
		return;
	}
	
	$ma = new Admin();
	$level = $ma->is_valid_login($db, $username, $password);
	if(!empty($level)) {
		$_SESSION['user']['username'] = $username;
		$_SESSION['user']['level'] = $level;
		header("Location: dashboard.php");
	}
	else {
		$_SESSION['flash-level'] = 'danger';
		$_SESSION['flash-error'] = 'Username hoặc Password không đúng!';
		header("Location: login.php");
	}
	return;
	
?>