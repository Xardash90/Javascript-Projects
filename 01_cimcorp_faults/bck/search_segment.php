 <?php  
include ('../../login/config.php');

 if(isset($_POST["id"]))  
 {  
      $query = "SELECT * FROM `wi_home`.`mp_38matrix` WHERE nr = '".$_POST["id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 } 
mysql_close($conn);	 
 ?>