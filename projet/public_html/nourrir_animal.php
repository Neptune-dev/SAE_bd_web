<?php
	require_once('db.php');
 	session_start();
	if ($_SESSION['user']) {
		$rfid=$_POST['RFID'];
		$quantite=$_POST['quantite'];
		$sql="SELECT regime_animal FROM animal WHERE RFID_animal=:rfid";
		$result=db_one($sql,[':rfid'=>$rfid]);
		$regime=$result['REGIME_ANIMAL'];
		$date=date('d-m-Y');
		$sql="INSERT INTO alimentation VALUES (:rfid,:regime,TO_DATE(:date_ajd,'DD-MM-YYYY'),:quantite)";
		$params=[
			':rfid'=>$rfid,
			':quantite'=>$quantite,
			':regime'=>$regime,
			'date_ajd'=>$date
		];
		$result=db_exec($sql,$params);
		header("Location: animalPanel.php");
	}