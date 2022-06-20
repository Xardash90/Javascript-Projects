
 <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
<div id="add_data_Modal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Neuer Schichtreport Eintrag:</h4>
   </div>
   <div class="modal-body">
    <form method="post" id="insert_form">
		<div class="form-group">
			 <label class="mp_7_text">Bereich :</label>
			 <select class="form-control select_user" name="mp_7"  id="mp_7" >
				<option></option>
				<?php
					include ('login/conf.php');
						$query = "SELECT * FROM `wi_home`.`mp_38matrix` WHERE `mp_1` = '".$_SESSION["location"]."' ORDER BY `mp_2` ASC";
						$result = mysql_query($query) or die(mysql_error());
						while($row = mysql_fetch_array($result)){
						echo '<option value = "'.$row['mp_10'].'">'.$row['mp_10'].'</option>';	
							}
					mysql_close($conn);	
					?>	
			</select>
			</div>
		<label class="mp_11_text">Fehlercode:</label>
		 <select name="mp_11" id="mp_11" class="form-control">
			<option></option>
			<option value="Verschleiß">Verschleiß</option>
			<option value="Bedienfehler ">Bedienfehler </option>   
			<option value="Wartungsfehler">Wartungsfehler</option>  
			<option value="Konstruktionsfehler">Konstruktionsfehler</option>  
			<option value="Wartung">Wartung</option> 
		 </select>
		 <br>
     <label>Problembeschreibung:</label>
     <textarea name="mp_3" id="mp_3" class="form-control"></textarea>
     <br />
	   <label>Lösung:</label>
     <textarea name="mp_4" id="mp_4" class="form-control"></textarea>
		<br/> 
		 <label class="mp_8_text ">1. Eingebautes Ersatzteil :</label>
		 <br/> 
				 <select name="mp_8" id="mp_8" class="form-control select2_multiple" style="width:100%;">
				 <option></option>
					<?php
						include ('login/conf.php');
							$query = "SELECT * FROM `mp_34matrix` WHERE `mp_1` =  '".$_SESSION["location"]."' ORDER BY `mp_2` ASC";
							$result = mysql_query($query) or die(mysql_error());
							while($row = mysql_fetch_array($result)){
							echo '<option value = "'.$row['mp_4'].'">'.$row['mp_4'].'</option>';	
								}
						mysql_close($conn);	
					 ?>	
				 </select>
			<br/>	 
		  <br/>
		 <label class="mp_12_text ">2. Eingebautes Ersatzteil :</label>
		 <br/> 
				 <select name="mp_12" id="mp_12" class="form-control select2_multiple" style="width:100%;">
				 <option></option>
					<?php
						include ('login/conf.php');
							$query = "SELECT * FROM `mp_34matrix` WHERE `mp_1` =  '".$_SESSION["location"]."' ORDER BY `mp_2` ASC";
							$result = mysql_query($query) or die(mysql_error());
							while($row = mysql_fetch_array($result)){
							echo '<option value = "'.$row['mp_4'].'">'.$row['mp_4'].'</option>';	
								}
						mysql_close($conn);	
					 ?>	
				 </select>
			<br/>
		<br/>
	
		 <label class="mp_13_text ">3. Eingebautes Ersatzteil :</label>
		 <br/> 
				 <select name="mp_13" id="mp_13" class="form-control select2_multiple" style="width:100%;">
				 <option></option>
					<?php
						include ('login/conf.php');
							$query = "SELECT * FROM `mp_34matrix` WHERE `mp_1` =  '".$_SESSION["location"]."' ORDER BY `mp_2` ASC";
							$result = mysql_query($query) or die(mysql_error());
							while($row = mysql_fetch_array($result)){
							echo '<option value = "'.$row['mp_4'].'">'.$row['mp_4'].'</option>';	
								}
						mysql_close($conn);	
					 ?>	
				 </select>
			<br/>
			
			
		<br/>
	<input type="hidden" name="id" id="id"/>
		  <label class="mp_5_text">Bearbeitungsstatus auswählen:</label>
			 <select name="mp_5" id="mp_5" class="form-control">
				<option value="Offen">Offen</option> 
				<option value="In Bearbeitung">In Bearbeitung</option>
				<option value="Abgeschlossen">Abgeschlossen</option>   
			 </select>
		 <br>	
	 </div>
	   <div class="modal-footer">
			
			<input type="button" name="insert" id="insert" value="Hinzufügen" class="btn btn-success btn-xs form-group pull-right" />
			<button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Close</button>
	   </div>
  </form>
  </div>
 </div>
</div>

<div id="add_segment_Modal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Neuer Segment Eintrag:</h4>
   </div>
   <div class="modal-body">
    <form method="post" id="segment_form">
	<div class="form-group">
	<label>Bereich:</label>
	<input name="mp_10" id="mp_10" class="form-control"></input>
	</div>
   
	 <br>	
	
	 <input type="" name="id" id="id"/>
     <input type="submit" name="insert" id="insert" value="Hinzufügen" class="btn btn-success btn-xs form-group pull-right" />
	
    </form>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>


