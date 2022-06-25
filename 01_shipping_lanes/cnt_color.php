<?php 
session_start();
error_reporting(0);

include ('../../login/conf.php');

	$query = "SELECT *,COUNT(*) AS 'CNT_COLOR' FROM `wi_reports`.`outbound_gate` WHERE `O_MANDAT` = '".$_SESSION["location"]."' AND `O_COLUMN` = '1' GROUP BY `O_COLOR`  ";
		$result = mysql_query($query) or die(mysql_error());								
			while($row = mysql_fetch_array($result)){
				
				if ( $row["O_COLOR"] == '#5cb85c;color:white' ) 
					{ 	
						ECHO '<i style="color:#5cb85c;" class="fa fa-square"></i><small> LEER '.$row['CNT_COLOR'].'</small>&nbsp;&nbsp;';
					} 
					elseif ($row["O_COLOR"] == '#d9534f;color:white') 
					{ 
						ECHO '<i style="color:#d9534f;" class="fa fa-square"></i><small> BELEGT '.$row['CNT_COLOR'].'</small>&nbsp;&nbsp;';
					}  
					elseif ($row["O_COLOR"] == '#f0ad4e;color:black') 
					{ 
						ECHO '<i style="color:#f0ad4e;" class="fa fa-square"></i><small> RESTE '.$row['CNT_COLOR'].'</small>&nbsp;&nbsp;';
					} 
					elseif ($row["O_COLOR"] == '#5bc0de;color:black') 
					{
						ECHO '<i style="color:#5bc0de;" class="fa fa-square"></i><small> LADET '.$row['CNT_COLOR'].'</small>&nbsp;&nbsp;';
					}
					elseif ($row["O_COLOR"] == '#F2F2F2;color:#71717') 
					{
						ECHO '<i style="color:#F2F2F2;" class="fa fa-square"></i><small> DEFAULT '.$row['CNT_COLOR'].'</small>&nbsp;&nbsp;';	
					}
					elseif ($row["O_COLOR"] == '#0275d8;color:white') 
					{
						ECHO '<i style="color:#0275d8;" class="fa fa-square"></i><small> Tag '.$row['CNT_COLOR'].'</small>&nbsp;&nbsp;';	
					}
					elseif ($row["O_COLOR"] == '#292b2c;color:white') 
					{
						ECHO '<i style="color:#292b2c;" class="fa fa-square"></i><small> Nacht '.$row['CNT_COLOR'].'</small>&nbsp;&nbsp;';	
					}

		}
					ECHO '<i class="fa fa-star-o" style="color:#d9534f;" aria-hidden="true"></i><small> NEUERÖFFNUNG</small>&nbsp;&nbsp;';	
	
mysql_close($conn);
?>