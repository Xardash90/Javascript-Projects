<?php
session_start();

include ('../../login/conf.php');	
	// mysql_query("  INSERT INTO `wi_home`.`mp_38matrix`(`mp_1`, `mp_9`, `mp_10`, `mp_6`) VALUES('".$_SESSION["location"]."', 'CC_SEGMENT', '".$_POST["mp_10"]."', '".$_SESSION["fname"]." ".$_SESSION["lname"]."')   ");


// mysql_query("  INSERT INTO `wi_home`.`mp_38matrix`(`mp_1`, `mp_9`, `mp_10`, `mp_6`) VALUES('".$_SESSION["location"]."', 'CC_SEGMENT', '".$_POST["mp_10"]."', '".$_SESSION["fname"]." ".$_SESSION["lname"]."')
 // on duplicate key update  `mp_10` = '".$_POST["mp_10"]."' , `mp_6` = '".$_SESSION["fname"]." ".$_SESSION["lname"]."'"); 
 
 if($_POST["id"] == '') 
       
      { 
	// Schichtreport hinzufügen 
		 mysql_query("  INSERT INTO `wi_home`.`mp_38matrix`(`mp_1`, `mp_9`, `mp_10`, `mp_6`) VALUES('".$_SESSION["location"]."', 'CC_SEGMENT', '".$_POST["mp_10"]."', '".$_SESSION["fname"]." ".$_SESSION["lname"]."')   ");
	  }  else { 
  	 
	// Wenn Schichtreport bereits vorhanden dann Update
		mysql_query(" UPDATE  `wi_home`.`mp_38matrix` SET 
												`mp_10` 	= '".$_POST["mp_10"]."' 							, 
												`mp_6`  	= '".$_SESSION["fname"]." ".$_SESSION["lname"]."'	
										
												
					  WHERE `nr` = '".$_POST["id"]."' 
					");
	  }
	  
 mysql_close($conn);
?>