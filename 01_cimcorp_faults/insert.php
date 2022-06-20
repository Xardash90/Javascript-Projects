<?php
session_start();

include ('../../login/conf.php');	

if($_POST["id"] == '') 
       
      { 
	// Schichtreport hinzufügen 
	mysql_query("INSERT INTO `wi_home`.`mp_38matrix`(`mp_1`, `mp_2`, `mp_3`, `mp_4`, `mp_5`, `mp_6`, `mp_7`, `mp_8`, `mp_9`, `mp_11`, `mp_12`, `mp_13`, `mp_14`, `mp_15`, `mp_16`, `mp_17`) 
	VALUES('".$_SESSION["location"]."', NOW(), '".$_POST["mp_3"]."', '".$_POST["mp_4"]."', 'Offen', '".$_SESSION["fname"]." ".$_SESSION["lname"]."', '".$_POST["mp_7"]."', 
	'".$_POST["mp_8"]."', 'CC_SCHIFTREPORT' , '".$_POST["mp_11"]."', '".$_POST["mp_12"]."', '".$_POST["mp_13"]."', '".$_POST["mp_14"]."', '".$_POST["mp_15"]."', '".$_POST["mp_16"]."','".$_POST["mp_17"]."')   ");
	  }  else { 
  	 
	// Wenn Schichtreport bereits vorhanden dann Update
	mysql_query(" UPDATE  `wi_home`.`mp_38matrix` SET 	
											`mp_1` 	= '".$_SESSION["location"]."'						,
											`mp_2`	= NOW()												, 
											`mp_3` 	= '".$_POST["mp_3"]."' 								, 
											`mp_4` 	= '".$_POST["mp_4"]."' 								, 
											`mp_5` 	= '".$_POST["mp_5"]."'								,
											`mp_6`  = '".$_SESSION["fname"]." ".$_SESSION["lname"]."'	,
											`mp_7` 	= '".$_POST["mp_7"]."' 								,
											`mp_8` 	= '".$_POST["mp_8"]."' 								,
											`mp_11` = '".$_POST["mp_11"]."' 							,
											`mp_12` = '".$_POST["mp_12"]."' 							,	
											`mp_13` = '".$_POST["mp_13"]."' 							,
											`mp_14` = '".$_POST["mp_14"]."' 							,
											`mp_15` = '".$_POST["mp_15"]."' 							,
											`mp_16` = '".$_POST["mp_16"]."' 							,
											`mp_17` = '".$_POST["mp_17"]."' 												
				  WHERE `nr` = '".$_POST["id"]."' AND `mp_1` 	= '".$_SESSION["location"]."'
				");
	  }
	  
	
mysql_close($conn);
?>

