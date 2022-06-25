<?php
	include ('login/conf.php');
		$query = "SELECT * FROM `mp_34matrix` WHERE `mp_1` =  '".$_SESSION["location"]."'ORDER BY `mp_2` ASC";
		$result = mysql_query($query) or die(mysql_error());
		while($row = mysql_fetch_array($result)){
		echo '<option value = "'.$row['mp_4'].'">'.$row['mp_4'].'</option>';	
			}
	mysql_close($conn);	
 ?>	