<?php
$beginn = microtime(true); 
// error_reporting(E_ERROR | E_PARSE);  
session_start();
include ('../../login/conf.php');

	ECHO '
			<table  id="datatable-header-cimcorp" class="table table-bordered table-sm table-hover table-condensed" width="100%" >
			 <thead>
				 <tr class="d-flex justify-content-center">
					<th class="warning d-flex justify-content-between"><a title="Schichtreport hinzufügen" class="btn btn-default text-success btn-sm add" role="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" >
						Neuer Eintrag <i class="fa fa-pencil-square-o"></i>
						</a>Information</th>
					<th class="warning" >Bereich</th>			
					<th class="warning" >Fehlercode</th>			
					<th class="warning" >Beschreibung</th>
					<th class="warning" >Lösungsweg <small><i class="pull-right" id="MA_COUNT_Z" ></i></th>
					<th class="warning" >Status <small><i class="pull-right" id="MA_COUNT_Z" ></i></th>
					<th class="warning" >#</th> 
				 </tr>
				 </thead>
				 <tbody>'; 
				 
		if (isset($_POST['id']) && ($_POST['name'] =='OPEN'))
		{
			$query = "SELECT * FROM `mp_38matrix` WHERE `mp_5` = 'Offen' AND `mp_1` = '".$_SESSION["location"]."' AND `mp_9` = 'CC_SCHIFTREPORT' ORDER BY `mp_2` DESC";
		}
		elseif (isset($_POST['id']) && ($_POST['name'] =='WATCH')){
			$query = "SELECT * FROM `mp_38matrix` WHERE `mp_5` = 'In Bearbeitung' AND `mp_1` = '".$_SESSION["location"]."' AND `mp_9` = 'CC_SCHIFTREPORT' ORDER BY `mp_2` DESC";
		} 
		elseif (isset($_POST['id']) && ($_POST['name'] =='DONE')){
			$query = "SELECT * FROM `mp_38matrix` WHERE `mp_5` = 'Abgeschlossen' AND `mp_1` = '".$_SESSION["location"]."' AND `mp_9` = 'CC_SCHIFTREPORT' ORDER BY `mp_2` DESC";
		} 
		elseif (isset($_POST['id']) && ($_POST['name'] =='ALL')){
			$query = "SELECT * FROM `mp_38matrix` WHERE `mp_1` = '".$_SESSION["location"]."' AND `mp_9` = 'CC_SCHIFTREPORT'  ORDER BY `mp_2` DESC";
		} 
		elseif (isset($_POST["From"]) and !empty($_POST["From"])){
		$FROM = date('Y-m-d', strtotime($_POST["From"])) ; 
		$query = "SELECT * FROM `mp_38matrix` WHERE `mp_15` LIKE '".$FROM."%' AND `mp_1` = '".$_SESSION["location"]."' AND `mp_9` = 'CC_SCHIFTREPORT' ORDER BY `mp_2` DESC";
		} else {
			$query = "SELECT * FROM `mp_38matrix` WHERE DATE(`mp_2`) = CURDATE()  AND `mp_1` = '".$_SESSION["location"]."' AND `mp_9` = 'CC_SCHIFTREPORT' ORDER BY `mp_2` DESC";
		}
		$result = mysql_query($query) or die(mysql_error());
		 while($row = mysql_fetch_array($result)){
			// Farben,  Icons, Symbole	 
			if($row['mp_5'] == "Offen")  {
				$colorRow = "danger";
				$icon = ' <i style="color: red;" class="fa fa-exclamation-triangle blink"></i>';	
				$textStatus = '<small><br><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Eintrag Ende: </small><br>';
			} 
			elseif($row['mp_5'] == "In Bearbeitung"){ 
				$colorRow = "warning";
				$icon = ' <i style="color: #000;" class="fa fa-eye"></i>';	
				$textStatus = '<small><br><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Eintrag Eröffnet: </small><br>';
			} else {	
				$icon = ' <i style="color: #66CDAA;" class="fa fa-check"></i>';
				$colorRow = "";
				$textStatus = '<small><br><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Eintrag Abgeschlossen: </small><br>';
			}
			
			if($row['mp_8'] != "") {
				$_TEXT1 = '1. Benutztes Ersatzteil: ';
			} else {
				$_TEXT1 = '';

			}
			
			if($row['mp_12'] != "") {
				$_TEXT2 = '2. Benutztes Ersatzteil: ';
			} else {
				$_TEXT2 = '';
			
			}
			if($row['mp_13'] != "") {
				$_TEXT3 = '3. Benutztes Ersatzteil: ';
			} else {
				$_TEXT3 = '';
			
			}
			if($row['mp_14'] != "") {
				$_TEXT4 = '4. Benutztes Ersatzteil: ';
			} else {
				$_TEXT4 = '';
			
			}
			
			if($row['mp_17'] != "") {
				$_EMPLOYEE_TEXT =   '<i class="fa fa-users"> Verantwortliche Personen: </i>';

			} else {
				$_EMPLOYEE_TEXT = '';
			}
				// Farben,  Icons, Symbole ende
				
				
			//Button Upload anzeigen wenn Eintrag vorhanden , andernfalls nicht
			if ($row["mp_3"]) {
			$btn_upl ='<button  id="'.$row['nr'].'"  type="button" class="btn btn-default btn-xs uploadFile pull-left"><i class="fa fa-upload"></i></button>';
			} else {
				$btn_upl ='<button  id="'.$row['nr'].'"  type="button" class="btn btn-default btn-xs uploadFile pull-left"><i class="fa fa-upload"></i></button>';
			}
			
			// Upload Link Anzeige für hochgeladene Dateien
			if ($row["mp_18"] >'') { $link ='<a title"Anhang" style="background-color: #45B8AC;color: white;" class="btn btn-default btn-xs pull-left" target="_new" href="../dashboard/lists/01_cimcorp_faults/file_upload_'.$_SESSION["location"].'/'.$row['mp_18'].'" role="button"><i class="fa fa-picture-o"></i></a>';
			} else {
			$link ='';
			}
				// Upload Link Anzeige für hochgeladene Dateien Ende
			
			if (isset($_POST["From"]) and !empty($_POST["From"])){
				$PDF = '<a target="_new" href="../wi-pdf/cc_shiftreport_filter.php?s='.$_SESSION["location"].'&date='.$FROM.'&" class="btn btn-danger btn-xs  pull-right " role="button"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';
			} else {
				$PDF = '<a target="_new" href="../wi-pdf/cc_shiftreport_filter.php" class="btn btn-danger btn-xs  pull-right " role="button"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';
			}

			//Zeitberechnung wie lange Eintrag existiert
			$datetime1 = new DateTime($row["mp_15"]);
			$datetime2 = new DateTime($row["mp_16"]);
			$ergebniss = $datetime1->diff($datetime2);
			
			// zeilen umbruch erzwingen = damit Tabellenform erhalten bleibt !
				$mp3_umbruch = wordwrap($row["mp_3"], 100, "\n", True);
				$mp3_text_gekuerzt = substr($mp3_umbruch,0,430);
				$mp_3_out =  nl2br($mp3_text_gekuerzt);

				$mp4_umbruch = wordwrap($row["mp_4"], 100, "\n", True);
				$mp4_text_gekuerzt = substr($mp4_umbruch,0,430);
				$mp_4_out =  nl2br($mp4_text_gekuerzt);	

			
			ECHO '
						<tr class="'.$colorRow.' " >
							<td style="cursor: pointer" name="edit" id="'.$row["nr"] .'" ">
								<small>Report Nr: </small><b>'.$row['nr'].' </b><br>'.$link.'
								<small class="">Eintrag Start: <br><i class="fa fa-calendar" aria-hidden="true"></i> </small>
								<small>'.date(' d.m.Y'  , strtotime($row["mp_15"])).'<br><i class="fa fa-clock-o" aria-hidden="true"></i>'.date(' H:i:s'  , strtotime($row["mp_15"])).' Uhr</small><br>
								
								<small>Letzte Bearbeitung:</br> '.date('d.m.Y H:i:s'  , strtotime($row["mp_2"])).' Uhr</small>								
							</td> 			
							<td style="cursor: pointer" class="edit_data " name="edit" id="'.$row["nr"] .'" ">'.$row['mp_7'].' </br>
							<small class=""><br> '.$_EMPLOYEE_TEXT.'<br>'.$row['mp_17'].'<br></small>	
							</td>							
							<td style="cursor: pointer" class="edit_data" name="edit" id="'.$row["nr"] .'" ">'.$row['mp_11'].'</td>							
							<td style="cursor: pointer" class="edit_data trimText" name="edit" id="'.$row["nr"] .'" ">'.$mp_3_out.'&nbsp;....&nbsp;</td>
							<td style="cursor: pointer" class="edit_data trimText" name="edit" id="'.$row["nr"] .'" ">'.$mp_4_out.'&nbsp;....&nbsp; 
								<small><br> '.$_TEXT1.''.$row['mp_8'].'<br> '.$_TEXT2.''.$row['mp_12'].'<br> '.$_TEXT3.''.$row['mp_13'].'<br> '.$_TEXT4.''.$row['mp_14'].'</small>
							</td>	
							<td><small>Status Report: <br></small>'.$row['mp_5'].''.$icon.''.$textStatus.' <small><i class="fa fa-clock-o" aria-hidden="true"></i> '.date('d.m.Y H:i:s'  , strtotime($row["mp_16"])).' Uhr</small></td> 
							<td>
								<a class="btn btn-default text-success btn-xs edit_data" role="button" name="edit" id="'.$row["nr"] .'" " >
								 <i class="fa fa-pencil-square-o"></i>
								</a>
								<a class="btn btn-default text-success btn-xs delete_data" role="button" name="delete" id="'.$row["nr"] .'" " >
								 <i class="fa fa-trash"></i></a><br>
								'.$btn_upl.'
								<p><a class="btn btn-default btn-xs" target="__new" href="../wi-pdf/cc_shiftreport_single_test.php?nr='.$row["nr"].'" ><i class="fa fa-file-pdf-o" style="font-size:15px;color:red;" ></i></a></p>
									<small></br>Eintrag existiert:</br>
								'.$ergebniss->format('%dd')." ".$ergebniss->format('%hh')." ".$ergebniss->format('%im')." ".$ergebniss->format('%ss')."".'</small>
							</td> 
						</tr>';
	}
	

ECHO '</tbody></table></div>';
echo "<script>
		$(document).ready(function() {	 
		$('#pdf').html('$PDF');
		});	
		</script>

	  ";

include ('tbl_script.php');		
mysql_close($conn);	
?>

<script>
// Wichtig!! BUG FIX für überschreiben des alten Eintrags nach Update/EDIT 
		$('.add').click(function(){
		$('#insert').val("Hinzufügen");  
		$('#insert_form')[0].reset(); 
		$(".select2_multiple_area").select2("val", "Bereich auswählen");
		$(".select2_multiple_status").select2("val", "Status auswählen");
		$(".select2_multiple_code").select2("val", "Fehlercode auswählen");
		$(".select2_multiple_part").select2("val", "Ersatzteil auswählen");
		$('#id').val("");
		});
</script>

