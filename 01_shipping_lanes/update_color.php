<?php
session_start();
include ('../../login/conf.php');
if(isset($_POST["id"]))  
 {  				
mysql_query("UPDATE `wi_reports`.`outbound_gate` SET `O_COLOR`='".$_POST["name"]."', `user` = '".$_SESSION["fname"]." ".$_SESSION["lname"]."' , `moddate` = NOW() WHERE `O_NR` = '".$_POST["id"]."' ");
 } 
		 						
mysql_close($conn);
?>
