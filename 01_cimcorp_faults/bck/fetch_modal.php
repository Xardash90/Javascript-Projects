 <?php
 include ('../../login/config.php');
 session_start();

 if(isset($_POST["id"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM `wi_home`.`mp_38matrix` WHERE DATE(`mp_2`) = CURDATE()  AND `mp_1` = '".$_SESSION["location"]."' AND `mp_9` = 'CC_SCHIFTREPORT' AND `nr` = ".$_POST["id"]." ORDER BY `mp_2` DESC";  
      $result = mysqli_query($connect, $query);  
      $output .= ' 
     <table  id="datatable-header-cimcorp" class="table table-bordered table-sm table-hover table-condensed" >
			 <thead>
				 <tr class="d-flex justify-content-center">
					<th class="warning" >Bereich</th>			
					<th class="warning" >Fehlercode</th>			
					<th class="warning" >Beschreibung</th>
					<th class="warning" >Lösungsweg <small><i class="pull-right" id="MA_COUNT_Z" ></i></th>
				 </tr>
				 </thead>
				 <tbody>';  
      while($row = mysqli_fetch_array($result))  
      { 
		$datetime1 = new DateTime($row["mp_15"]);
		$datetime2 = new DateTime($row["mp_16"]);
		$ergebniss = $datetime1->diff($datetime2);
		
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
			}
			else {
				$btn_upl ='<button  id="'.$row['nr'].'"  type="button" class="btn btn-default btn-xs uploadFile pull-left"><i class="fa fa-upload"></i></button>';
			}
			
			// Upload Link Anzeige für hochgeladene Dateien
			if ($row["mp_18"] >'') { $link ='<a title"Anhang" style="background-color: #45B8AC;color: white;" class="btn btn-default btn-xs pull-left" target="_new" href="../dashboard/lists/01_cimcorp_faults/file_upload_'.$_SESSION["location"].'/'.$row['mp_18'].'" role="button"><i class="fa fa-picture-o"></i></a>';}	
			
			else 
			{
				$link ='';
			}
			// zeilen umbruch erzwingen = damit Tabellenform erhalten bleibt !
				$mp3_umbruch = wordwrap($row["mp_3"], 100, "\n", True);
				$mp3_text_gekuerzt = substr($mp3_umbruch,0,430);
				$mp_3_out =  nl2br($mp3_text_gekuerzt);

				$mp4_umbruch = wordwrap($row["mp_4"], 100, "\n", True);
				$mp4_text_gekuerzt = substr($mp4_umbruch,0,430);
				$mp_4_out =  nl2br($mp4_text_gekuerzt);	
				
           $output .= '  
                <tr>  
					<td style="cursor: pointer" name="edit" id="'.$row["nr"] .'" ">'.$row['mp_7'].' </br>
						<small class=""><br> '.$_EMPLOYEE_TEXT.'<br>'.$row['mp_17'].'<br></small>	
					</td>							
					<td style="cursor: pointer" name="edit" id="'.$row["nr"] .'" ">'.$row['mp_11'].'</td>							
					<td style="cursor: pointer" name="edit" id="'.$row["nr"] .'" ">'.$mp_3_out.'&nbsp;....&nbsp</td>
					<td style="cursor: pointer" name="edit" id="'.$row["nr"] .'" ">'.$mp_4_out.'&nbsp;....&nbsp 
						<small><br> '.$_TEXT1.''.$row['mp_8'].'<br> '.$_TEXT2.''.$row['mp_12'].'<br> '.$_TEXT3.''.$row['mp_13'].'<br> '.$_TEXT4.''.$row['mp_14'].'</small>
					</td>	 
				</tr>  
           ';  
      }  
      $output .= '  
       </tbody></table>
      ';  
      echo $output;  
 }  
?>