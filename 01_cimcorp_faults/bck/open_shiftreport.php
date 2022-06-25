<?php
session_start();
include ('../../login/conf.php');
// error_reporting(E_ERROR | E_PARSE);  
	ECHO '<div class="row container d-flex justify-content-center">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title" title="">  <i style="color: red;" class="fa fa-exclamation-triangle blink"></i> Einträge im Status "Offen"</h4>
				</div>
				';
		//Funktionen für TOP Button --> Datum, Mitarbeiter auswählen und Alle anzeigen

		$query = "SELECT * FROM `mp_38matrix` WHERE `mp_5` = 'Offen' AND `mp_1` = '".$_SESSION["location"]."' AND `mp_9` = 'CC_SCHIFTREPORT' AND DATE(`mp_2`) = CURDATE()  ORDER BY `mp_2` DESC"; 
		$result = mysql_query($query) or die(mysql_error());
		while($row = mysql_fetch_array($result)){	
			
		$datetime1 = new DateTime($row["mp_15"]);
		$datetime2 = new DateTime($row["mp_16"]);
		$ergebniss = $datetime1->diff($datetime2);
		
			ECHO '
						<div class="panel-body">
							<span class="pull-left"><small>Schichtreport Eintrag: </small> '.$row['nr'].'</br><small><i class="fa fa-users" aria-hidden="true"></i> Verantwortliche Personen: </br>'.$row["mp_17"].'</small></span>
						    <span class="pull-right"><small>Eröffnet: '.$row['mp_6'].' </small></br><small>Am: <i class="fa fa-calendar" aria-hidden="true"></i>'.date(' d.m.Y'  , strtotime($row["mp_15"])).' <i class="fa fa-clock-o" aria-hidden="true"></i>'.date(' H:i:s'  , strtotime($row["mp_15"])).' Uhr</small>
							<br><small>Bereich: '.$row["mp_7"].'</small>
							</span>
						</div>
							<div class="panel-footer">
						  <small>Eintrag existiert: '.$ergebniss->format('%dd')." ".$ergebniss->format('%hh')." ".$ergebniss->format('%im')." ".$ergebniss->format('%ss')."".'
						  <p class="pull-right"><a class="btn btn-default btn-xs" target="__new" href="../wi-pdf/cc_shiftreport_single.php?nr='.$row["nr"].'" ><i class="fa fa-file-pdf-o" style="font-size:12px;color:red;" ></i></a></p>
						  <button class="btn btn-default btn-xs pull-right view_data" id="'.$row["nr"] .'"><i class="fa fa-eye" style="font-size:12px;"></i></button>
						  </small>
						</div>
						';
	}
			
ECHO '</div></div>';

mysql_close($conn);					
?>

	
	