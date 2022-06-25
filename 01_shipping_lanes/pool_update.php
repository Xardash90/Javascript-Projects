<?php
session_start();

include ('../../login/config.php');

if(isset($_POST["id"]))
{
 $value = mysqli_real_escape_string($connect, $_POST["value"]);
 $query = "UPDATE `wi_reports`.`outbound_gate` SET ".$_POST["column_name"]."='".$value."' WHERE `O_NR` = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Updated';
 }
}

mysqli_close($connect);	
?>