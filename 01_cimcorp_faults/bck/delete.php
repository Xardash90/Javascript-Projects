<?php
if(isset($_POST["id"]))
{
include ('../../login/conf.php');
			// Löschen aus der Datenbank 
		    mysql_query(" DELETE FROM `mp_38matrix` WHERE `nr`='".$_POST["id"]."' ");

mysql_close($conn);			
}
?>