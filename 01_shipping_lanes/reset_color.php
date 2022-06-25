<?php
session_start();
include ('../../login/conf.php');
				
mysql_query("UPDATE `wi_reports`.`outbound_gate` SET `O_COLOR`='#F2F2F2;color:#717171' WHERE `O_MANDAT` = '".$_SESSION["location"]."' ");
		 						
mysql_close($conn);
?>
