 <?php  
include ('../../login/conf.php');


 if(isset($_POST["id"]))  
 {  
      $query = "SELECT * FROM `wi_home`.`mp_38matrix` WHERE nr = '".$_POST["id"]."'";  
		$result = mysql_query($query) or die(mysql_error());   
		$row 	= mysql_fetch_array($result); 
			
      echo json_encode($row);  
 } 
mysql_close($conn);	 
 ?>