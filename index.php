<?php
	include 'controllerSession.php';
	
	$session = new Session();
	if ($session->checkUser())
		header("Location: dashboard.php");
	else
		header("Location: login.php");