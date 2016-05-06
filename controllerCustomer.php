<?php
	require_once 'modelConnectDatabase.php';
	require_once 'modelCustomer.php';
	
	$action = filter_input(INPUT_POST, 'action');
	
	$fullname = filter_input(INPUT_POST, 'fullname');
	$phone = filter_input(INPUT_POST, 'phone');
	$address = filter_input(INPUT_POST, 'address');
	$birthday = filter_input(INPUT_POST, 'birthday');
	$gender = filter_input(INPUT_POST, 'gender');
	
	$mc = new Customer();
	
	switch ($action) {
		case 'add':
			$mc->addCustomer($db, $fullname, $phone, $address, $birthday, $gender);
			header("Location: addcustomer.php");
			break;
		
		default:
			;
		break;
	}