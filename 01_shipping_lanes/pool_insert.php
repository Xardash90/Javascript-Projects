<?php
session_start();

include ('../../login/config.php');

if(isset($_POST["O_GATE"]))
{
 $O_GATE = mysqli_real_escape_string($connect, $_POST["O_GATE"]);
 $O_TEXT = mysqli_real_escape_string($connect, $_POST["O_TEXT"]);
 $O_AUTO = mysqli_real_escape_string($connect, $_POST["O_AUTO"]);
 
 $query = "  
      SELECT * FROM `wi_reports`.`outbound_gate` 
      WHERE `O_GATE` LIKE '".$O_GATE."' AND `O_MANDAT` = '".$_SESSION["location"]."'   
      ";  
      $result = mysqli_query($connect, $query);  
      if(mysqli_num_rows($result) > 0)  
      {    
		echo 'Yes';
	  }  
      else  
      {  
		$query = "INSERT INTO `wi_reports`.`outbound_gate`  (`O_COLUMN`,`O_GATE`,`O_TEXT`,`O_AUTO`,`O_MANDAT`) VALUES('0','".$O_GATE."', '".$O_TEXT."', '".$O_AUTO."', '".$_SESSION["location"]."')";
		$result = mysqli_query($connect, $query);  
        echo 'No';  
      }  
 
}

mysqli_close($connect);	
?>