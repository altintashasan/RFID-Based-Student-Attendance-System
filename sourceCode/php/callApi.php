<?php 
	include_once("config.php");
	$callFxn = isset($_REQUEST['method'])?$_REQUEST['method']:"-1";
	//$commonObj->getRFIDAttendanceApi();

	switch ($callFxn) {
		case 'checkUIDAlreadyExists':
			$commonObj->checkUIDAlreadyExists();
			break;
		case 'addUser':
			$commonObj->addUser();
			
			break;
		case "getRFIDAttendanceApi":
			$commonObj->getRFIDAttendanceApi();
			break;
		default:
			echo "Method not found! please pass correct method!";
			break;
	}
	
?>
