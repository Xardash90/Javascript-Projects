<?php
include ('../../login/config.php');

if(isset($_POST["id"]))
{
 $query = "DELETE FROM `wi_reports`.`outbound_gate` WHERE `O_NR` = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Deleted';
 }
}
mysqli_close($connect);
?>