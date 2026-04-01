<?php
	session_start();
	require_once('db.php');
	require_once('permission.php');
	
	if (!isset($_SESSION['user']) || !gotAnimalPermission($_SESSION['userType'])) {
    	header("Location: login.php");
    	exit();
    }
	
	if (isset($_GET['RFID_animal'])){
		$sql="DELETE FROM animal WHERE RFID_animal=:rfid";
		$params=[];
		$params[':rfid']=$_GET['RFID_animal'];
		db_exec($sql,$params);
	}
	header("Location: dashboard.php");
	exit();
?>