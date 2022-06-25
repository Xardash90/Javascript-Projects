<?php
 error_reporting(0);
 
 if(isset($_POST["id"]))  
 {  

 $output = '';  
      include ('../../login/conf.php');  
	  
      $query = "SELECT * FROM  `wi_reports`.`outbound_gate` WHERE `O_NR` = '".$_POST["id"]."' ";  
      $result = mysql_query($query) or die(mysql_error());
	  while($row = mysql_fetch_array($result))  
      {  
		   $BAHN =  $row["O_GATE"].' <small>&nbsp;Versandbahn </small>';
		   echo "	<script>$(document).ready(function() {
							$('#info').html('$BAHN');
							}); </script>";
							
			if ( $row['O_LROU_DEPARTDATE'] == '' ) 
						{ 
							$DEPARTDATE = ''; 
							$LDUSUM = '';  
							$LDUSUMT = ''; 
						} 
						else
						{ 
							$DEPARTDATE = '<i class="fa fa-calendar"></i> '.date('d.m.Y - H:i', strtotime($row['O_LROU_DEPARTDATE'])).' <i class="fa fa-clock-o"></i>'; 
							$LDUSUM = ' <i class="fa fa-arrow-right"></i> '.$row['O_LDTU_TOTAL'].' / '.$row['O_LDTU_PICKED'].' '; 
							$LDUSUMT = $row['O_LDTU_TOTAL'].' / '.$row['O_LDTU_PICKED']; 
						} 	
           echo '
				 <button type="button" id="'.$row["O_NR"].'" name="#0275d8;color:white" class="btn btn-primary btn-lg btn-block BTNCOLOR"><span class="pull-left"><small>Versandbahn - </small><small>TAG - <i class="fa fa-truck"></i></small></span> <span class="pull-right"><small>'.$row["O_GATE"].'</small></span></button>
				 <button type="button" id="'.$row["O_NR"].'" name="#292b2c;color:white" class="btn btn-inverse btn-lg btn-block BTNCOLOR"><span class="pull-left"><small>Versandbahn - </small><small>NACHT - <i class="fa fa-truck"></i></small></span> <span class="pull-right"><small>'.$row["O_GATE"].'</small></span></button>
				 <button type="button" id="'.$row["O_NR"].'" name="#5cb85c;color:white" class="btn btn-success btn-lg btn-block BTNCOLOR"><span class="pull-left"><small>Versandbahn - </small>LEER</span> <span class="pull-right"><small>'.$row["O_GATE"].'</small></span></button>
				 <button type="button" id="'.$row["O_NR"].'" name="#d9534f;color:white" class="btn btn-danger btn-lg btn-block BTNCOLOR"><span class="pull-left"><small>Versandbahn - </small>BELEGT</span> <span class="pull-right"><small>'.$row["O_GATE"].'</small></span></button>
				 <button type="button" id="'.$row["O_NR"].'" name="#f0ad4e;color:black" class="btn btn-warning btn-lg btn-block BTNCOLOR"><span class="pull-left"><small>Versandbahn - </small>RESTE</span> <span class="pull-right"><small>'.$row["O_GATE"].'</small></span></button>
				 <button type="button" id="'.$row["O_NR"].'" name="#5bc0de;color:black" class="btn btn-info btn-lg btn-block BTNCOLOR"><span class="pull-left"><small>Versandbahn - </small>LADET - <small><i class="fa fa-truck"></i></small></span> <span class="pull-right"><small>'.$row["O_GATE"].'</small></span></button>
				 <hr>
				 <button type="button" id="'.$row["O_NR"].'" name="#F2F2F2;color:#717171" class="btn btn- btn-lg btn-block BTNCOLOR"><span class="pull-left"><small>Versandbahn - </small>DEFAULT</span><span class="pull-right"><small>'.$row["O_GATE"].'</small></span></button>
				';
				// Inverse #292b2c  Faded #f7f7f7
		   echo '<br><p>Filiale =  '.$row['O_LCU_IDENT'].' '.$row['O_LCU_NAME1'].'<br> ';
		   echo 'Bereistellung =  '.$DEPARTDATE.'<br> ';
		   echo 'Transporteinheiten Total = '.$LDUSUMT.' erledigt!<br>';
		   echo 'Bearbeiter = '.$row['User'].'</p>';
		   echo '<button type="button" id="'.$row["O_NR"].'" name="1" class="btn btn-danger btn-xs btn-block BTNVIP"><span class="pull-left"><small><i class="fa fa-star-o"></i> NEUERÖFFNUNG - JA</small></span><span class="pull-right"><small>'.$row["O_GATE"].'</small></span></button>';
		   echo '<button type="button" id="'.$row["O_NR"].'" name="0" class="btn btn- btn-xs btn-block BTNVIP"><span class="pull-left"><small><i class="fa fa-star-o"></i> NEUERÖFFNUNG - NEIN</small></span><span class="pull-right"><small>'.$row["O_GATE"].'</small></span></button>';
      	 }  

} else { 
		echo '<h3><center>!! keine Daten gefunden !!</center></h3>'; 
 }
 
 ?>
