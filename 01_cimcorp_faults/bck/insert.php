<?php
session_start();

include ('../../login/conf.php');	

if($_POST["id"] == '') 
      { 
 //Umwandeln von Datum Manuell EU in Datum International
$start_date_manuell = strtotime($_POST["mp_15"]);
$start_date_result = date( 'Y-m-d H:i:s', $start_date_manuell );

$end_date_manuell = strtotime($_POST["mp_16"]);
$end_date_result = date( 'Y-m-d H:i:s', $end_date_manuell );

	// Schichtreport hinzufügen 
	mysql_query("INSERT INTO `wi_home`.`mp_38matrix`(`mp_1`, `mp_2`, `mp_3`, `mp_4`, `mp_5`, `mp_6`, `mp_7`, `mp_8`, `mp_9`, `mp_11`, `mp_12`, `mp_13`, `mp_14`, `mp_15`, `mp_16`, `mp_17`) 
	VALUES('".trim($_SESSION["location"])."', NOW(), '".trim($_POST["mp_3"])."', '".trim($_POST["mp_4"])."', 'Offen', '".trim($_SESSION["fname"])." ".trim($_SESSION["lname"])."', '".trim($_POST["mp_7"])."', 
	'".trim($_POST["mp_8"])."', 'CC_SCHIFTREPORT' , '".trim($_POST["mp_11"])."', '".trim($_POST["mp_12"])."', '".trim($_POST["mp_13"])."', '".trim($_POST["mp_14"])."', '".$start_date_result."', '".$end_date_result."','".trim($_POST["mp_17"])."')   ");
	  }  else {
 //Umwandeln von Datum Manuell EU in Datum International
$start_date_manuell = strtotime($_POST["mp_15"]);
$start_date_result = date( 'Y-m-d H:i:s', $start_date_manuell );
$end_date_manuell = strtotime($_POST["mp_16"]);
$end_date_result = date( 'Y-m-d H:i:s', $end_date_manuell );		  
  	 
	// Wenn Schichtreport bereits vorhanden dann Update
	mysql_query(" UPDATE  `wi_home`.`mp_38matrix` SET 	
											`mp_1` 	= '".trim($_SESSION["location"])."'								,
											`mp_2`	= NOW()															, 
											`mp_3` 	= '".trim($_POST["mp_3"])."' 									, 
											`mp_4` 	= '".trim($_POST["mp_4"])."' 									, 
											`mp_5` 	= '".trim($_POST["mp_5"])."'									,
											`mp_6`  = '".trim($_SESSION["fname"])." ".trim($_SESSION["lname"])."'	,
											`mp_7` 	= '".trim($_POST["mp_7"])."' 									,
											`mp_8` 	= '".trim($_POST["mp_8"])."' 									,
											`mp_11` = '".trim($_POST["mp_11"])."' 									,	
											`mp_12` = '".trim($_POST["mp_12"])."' 									,	
											`mp_13` = '".trim($_POST["mp_13"])."' 									,
											`mp_14` = '".trim($_POST["mp_14"])."' 									,
											`mp_15` = '".$start_date_result."' 										,
											`mp_16` = '".$end_date_result."' 										,
											`mp_17` = '".trim($_POST["mp_17"])."' 												
				  WHERE `nr` = '".$_POST["id"]."' AND `mp_1` 	= '".$_SESSION["location"]."'
				");
	  }
	  
	
mysql_close($conn);
?>

