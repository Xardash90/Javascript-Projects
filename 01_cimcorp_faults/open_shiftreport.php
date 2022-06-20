<?php
session_start();
include ('../../login/conf.php');
// error_reporting(E_ERROR | E_PARSE);  
	ECHO '<div class="row container d-flex justify-content-center">
 
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table id="datatable-header-p" class="table">
                                <thead class="warning">
								<th class="warning">
									<h4 class="" title="">  <i style="color: red;" class="fa fa-exclamation-triangle blink"></i> Report im Status "Offen"</h4>
								</th>
								<th class="warning">
								</th>
                                </thead>
                                <tbody>
				';
		//Funktionen für TOP Button --> Datum, Mitarbeiter auswählen und Alle anzeigen

		$query = "SELECT * FROM `mp_38matrix` WHERE `mp_5` = 'Offen' AND `mp_1` = '".$_SESSION["location"]."' AND `mp_9` = 'CC_SCHIFTREPORT' AND DATE(`mp_2`) = CURDATE()  ORDER BY `mp_2` DESC"; 
		$result = mysql_query($query) or die(mysql_error());
		while($row = mysql_fetch_array($result)){	

		
			ECHO '
						<tr>
							<td><small>Schichtreport Eintrag: </small>'.$row['nr'].'</br><small><i class="fa fa-users" aria-hidden="true"></i> Verantwortliche Personen: </br>'.$row["mp_17"].'</small></td>		
							<td><small>Eröffnet: '.$row['mp_6'].' </small></br><small>Am: <i class="fa fa-calendar" aria-hidden="true"></i>'.date(' d.m.Y'  , strtotime($row["mp_15"])).' <i class="fa fa-clock-o" aria-hidden="true"></i>'.date(' H:i:s'  , strtotime($row["mp_15"])).' Uhr</small> </td>	

						</tr>';
	}
			
ECHO '</tbody></table></div>';

mysql_close($conn);					
?>

	
	