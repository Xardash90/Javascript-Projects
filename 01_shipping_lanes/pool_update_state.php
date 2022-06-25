<?php
session_start();
include ('../../login/conf.php');

if($_POST["name"] == '1' )
	{
	mysql_query("UPDATE `wi_reports`.`outbound_gate` SET `O_COLUMN` = '0' WHERE `O_NR`='".$_POST["id"]."'  "); 
	} 
else
	{ 
	mysql_query("UPDATE `wi_reports`.`outbound_gate` SET `O_COLUMN` = '1' WHERE `O_NR`='".$_POST["id"]."'  "); 
	} 
mysql_close($conn);	
?>

