<?php
$beginn = microtime(true); 
// error_reporting(E_ERROR | E_PARSE);  
session_start();
include ('../../login/conf.php');

// $_POST['name'] = $TEST;
	ECHO '
	
			<table  id="datatable-header-cimcorp" class="table table-bordered table-sm table-hover" width="100%" >
			 <thead>
				 <tr class="d-flex justify-content-center">
					<th class="warning d-flex justify-content-between"><a title="Schichtreport hinzufügen"  class="btn btn-default text-success btn-sm add" role="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" >
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
		} else {
			$query = "SELECT * FROM `mp_38matrix` WHERE DATE(`mp_2`) = CURDATE()  AND `mp_1` = '".$_SESSION["location"]."' AND `mp_9` = 'CC_SCHIFTREPORT' ORDER BY `mp_2` DESC";
		}
		$result = mysql_query($query) or die(mysql_error());
		 while($row = mysql_fetch_array($result)){
			// Farben,  Icons, Symbole	 
			if($row['mp_5'] == "Offen")  {
				$colorRow = "danger";
				$icon = ' <i style="color: red;" class="fa fa-exclamation-triangle blink"></i>';	
				$textStatus = '<small><br><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Eintrag Eröffnet: </small><br>';
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
				$_TEXT2 = '2. Benutztes Ersatzteil: ';
				$_TEXT3 = '3. Benutztes Ersatzteil: ';
			} else {
				$_TEXT1 = '';
				$_TEXT2 = '';
				$_TEXT3 = '';
			}
			
			// PDF Filter 
		
			if (isset($_POST["nr"])){
				// $PDF = '<a target="_new" href="../wi-pdf/covid.php?s='.$_SESSION["location"].'&date='.$FROM.'&" class="btn btn-default btn-xs  pull-left " role="button"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';
			// } elseif (isset($_POST["name"]) and !empty($_POST["name"])){
				// $PDF = '<a target="_new" href="../wi-pdf/covid.php?s='.$_SESSION["location"].'&name='.$NAME.'&" class="btn btn-info btn-xs  pull-left " role="button"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';
			// } elseif (isset($_POST["result"]) and !empty($_POST["result"] == 'all_result')){
				// $PDF = '<a target="_new" href="../wi-pdf/covid.php?s='.$_SESSION["location"].'&all='.$ALL_RESULT.'&" class="btn btn-info btn-xs  pull-left " role="button"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';
			}else {
				// $PDF = '<a target="_new" href="../wi-pdf/covid.php" class="btn btn-default btn-xs  pull-left " role="button"><i class="fa fa-file-pdf-o" ></i></a>';
			}
			//PDF Filter Ende
			
			//Button Upload anzeigen wenn Eintrag vorhanden , andernfalls nicht
			if ($row["mp_3"]) {
			$btn_upl ='<button  id="'.$row['nr'].'"  type="button" class="btn btn-default btn-xs uploadFile pull-left"><i class="fa fa-upload"></i></button>';
			}
			else {
				$btn_upl ='<button  id="'.$row['nr'].'"  type="button" class="btn btn-default btn-xs uploadFile pull-left"><i class="fa fa-upload"></i></button>';
			}
			// Farben,  Icons, Symbole ende
			
			// Upload Link für hochgeladene Dateien
			if ($row["mp_18"] >'') { $link ='<a title"Anhang" style="background-color: #45B8AC;color: white;" class="btn btn-default btn-xs pull-left" target="_new" href="../dashboard/lists/01_cimcorp_faults/file_upload_'.$_SESSION["location"].'/'.$row['mp_18'].'" role="button"><i class="fa fa-picture-o"></i></a>';}	
			
			else 
			{
				$link ='';
			}
			// Upload Link für hochgeladene Dateien Ende
			ECHO '
						<tr class="'.$colorRow.'" >
							<td><small class="trimText">Eintrag Start: </small><br><i class="fa fa-calendar" aria-hidden="true"></i>
								<small>'.date(' d.m.Y'  , strtotime($row["mp_2"])).'<br><i class="fa fa-clock-o" aria-hidden="true"></i>'.date(' H:i:s'  , strtotime($row["moddate"])).' Uhr</small><br>
								<small>Report Nr: </small>	'.$row['nr'].' <br>'.$link.'								
							</td> 			
							<td style="cursor: pointer" class="edit_data " name="edit" id="'.$row["nr"] .'" ">'.$row['mp_7'].'</td>							
							<td style="cursor: pointer" class="edit_data " name="edit" id="'.$row["nr"] .'" ">'.$row['mp_11'].'</td>							
							<td style="cursor: pointer" class="edit_data" name="edit" id="'.$row["nr"] .'" ">'.$row['mp_3'].'
							<td style="cursor: pointer" class="edit_data" name="edit" id="'.$row["nr"] .'" ">'.$row['mp_4'].' <small><br> '.$_TEXT1.''.$row['mp_8'].'<br> '.$_TEXT2.''.$row['mp_12'].'<br> '.$_TEXT3.''.$row['mp_13'].'</small>
							</td>	
							<td><small>Status Report: <br></small>'.$row['mp_5'].''.$icon.''.$textStatus.' <i class="fa fa-users"></i> '.$row['mp_6'].'</td> 
							<td>
								<a class="btn btn-default text-success btn-xs edit_data" role="button" name="edit" id="'.$row["nr"] .'" " >
								 <i class="fa fa-pencil-square-o"></i>
								</a>
								<a class="btn btn-default text-success btn-xs delete_data" role="button" name="delete" id="'.$row["nr"] .'" " >
								 <i class="fa fa-trash"></i>
								</a><br>
								'.$btn_upl.'
					
							</td> 
						</tr>';
	}
		 
			
ECHO '</tbody></table></div>';
echo "<script>
		$('#add').click(function(){ 
	
				$('#mp_5').hide();
				$('.mp_5_text').hide();
			  }); 
		</script>
	  ";

// echo "<script>
		// $(document).ready(function() {	 
		// $('.pdf').html('$PDF');
		// });	
		// </script>

	  // ";
		
			
include ('tbl_script.php');		
mysql_close($conn);	
?>


<script>
// Wichtig!! BUG FIX für überschreiben des alten Eintrags nach Update/EDIT 
		$('.add').click(function(){
		$('#insert').val("Insert");  
		$('#insert_form')[0].reset(); 
		$('#id').val("");
		});
</script>
