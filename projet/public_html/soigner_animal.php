<?php
	session_start();
	require_once('db.php');
	$rfid = isset($_POST['RFID']) ? $_POST['RFID'] : '';
	if (!isset($_SESSION['user'])) {
		header("Location: login.php");
	} else {
		$user=$_SESSION['user'];
		$id_pers=$user['ID_PERSONNEL'];
		$sql="SELECT type_personnel FROM personnel WHERE id_personnel=:id_pers";
		$result=db_one($sql,[':id_pers'=>$id_pers]);
		if ($result['TYPE_PERSONNEL']=="TPPE0003") {
			$type_soin="SIMPLE";
			$sql="SELECT MAX(id_soin) AS max_id FROM soin";
			$result=db_one($sql,[]);
			$der_id=$result['MAX_ID'];
			$numero = (int) str_replace('SOIN', '', $der_id);
			$numero++;
			$new_id='SOIN'.str_pad($numero, 4, '0', STR_PAD_LEFT);
			$date=date("d-m-Y");
			$sql="INSERT INTO soin VALUES (:id_soin,:rfid,TO_DATE(:date_ajd,'DD-MM-YYYY'),:type_soin,:id_pers)";
			$params=[
				":id_soin"=>$new_id,
				":rfid"=>$rfid,
				":date_ajd"=>$date,
				":type_soin"=>$type_soin,
				":id_pers"=>$id_pers
			];
			db_exec($sql,$params);
		} elseif ($result['TYPE_PERSONNEL']=="TPPE0004") {
			$type_soin="COMPLEXE";
			$sql="SELECT MAX(id_soin) FROM soin";
			$result=db_one($sql,[]);
			$der_id=$result['ID_SOIN'];
			$numero = (int) str_replace('SOIN', '', $der_id);
			$numero++;
			$new_id='SOIN'.str_pad($numero, 4, '0', STR_PAD_LEFT);
			$date=date("d-m-Y");
			$sql="INSERT INTO soin VALUES (:id_soin,:rfid,TO_DATE(:date_ajd,'DD-MM-YYYY'),:type_soin,:id_pers)";
			$params=[
				":id_soin"=>$new_id,
				":rfid"=>$rfid,
				":date_ajd"=>$date,
				":type_soin"=>$type_soin,
				":id_pers"=>$id_pers
			];
			db_exec($sql,$params);
		} else {
			echo "Vous n'êtes pas habilité, contactez l'administrateur";
			header("Refresh: 10; url=dashboard.php");
		}
		header("Location: soinPanel.php");
	}
?>