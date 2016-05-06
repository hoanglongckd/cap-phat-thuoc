<?php
	session_start();
	include 'controllerSession.php';
	
	$session = new Session();
	if ($session->checkUserLogin())
		header("Location: dashboard.php");
	else
		header("Location: login.php");