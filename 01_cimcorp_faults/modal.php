<!-- START Modal new_open listing -->
		<div id="add_data_Modal" class="modal bs-example-modal-lg" role="dialog">
			<div class="modal-dialog modal-lg">
			 <div class="modal-content ">
				
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					 <h4 class="modal-title">
		     <form method="post" id="insert_form">
					 <img src="./img/netto.png" width="100" height="30">&nbsp;&nbsp;&nbsp; </img>
						<small><i class="fa fa-wrench"></i> Erstelle neuen Schichtreport</small>
					</h4>
				  </div>
				<div class="modal-body text-left left-text" >
				
				<div class="well" style="overflow: auto">	  
				 <div class="col-md-4 col-sm-12 col-xs-12">
				 <div class="form-group"> 
				
					 <input name="mp_17" id="mp_17" class="form-control" placeholder="Verantwortliche Person /en..."/>
					 <div class="alert_text">
						<small class="text-danger">Bei mehreren Personen bitte Namen mit Komma trennen!</small>
					 </div>
				</div> 
				</div>
				
				<div class="col-md-4 col-sm-12 col-xs-12">
				   <div class="input-group">
						<span class="input-group-addon"><small><i class="fa fa-calendar"></i> Start</small></span>
							<input name="mp_15" id="mp_15" class="form-control " required=""  type="text" value="<?php echo date('d.m.Y H:i:s'); ?>" >						
					</div>
				</div>
				<div class="col-md-4 col-sm-12 col-xs-12">
				   <div class="input-group">
						<span class="input-group-addon"><small><i class="fa fa-calendar"></i> Ende</small></span>
							<input name="mp_16" id="mp_16" class="form-control " required=""  type="text" value="<?php echo date('d.m.Y H:i:s'); ?>" >						
					</div>
				</div>
				</div>
				  <div class="clearfix"></div>
			
				<div class="well" style="overflow: auto">
					<div class="col-md-4 col-sm-12 col-xs-12 form-group">
									 <label class="mp_7_text">Bereich :</label>
							 <select name="mp_7" id="mp_7" class="form-control " style="width:100%;">
							 
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

					<div class="col-md-4 col-sm-12 col-xs-12 form-group pull-left">
						 <label class="mp_7_text">Fehlercode :</label>
					 <select name="mp_11" id="mp_11" class="form-control " style="width:100%;">
						<option></option>
						<option value="Verschleiß">Verschleiß</option>
						<option value="Bedienfehler ">Bedienfehler </option>   
						<option value="Wartungsfehler">Wartungsfehler</option>  
						<option value="Konstruktionsfehler">Konstruktionsfehler</option>  
						<option value="Wartung">Wartung</option> 
					 </select>
                  </div>
				
				<div class="col-md-4 col-sm-12 col-xs-12 form-group">
			<label class="mp_7_text">Status :</label>
					 <select name="mp_5" id="mp_5" class="form-control " style="width:100%;" >
					    <option ></option>
						<option value="Offen">Offen</option> 
						<option value="In Bearbeitung">In Bearbeitung</option>
						<option value="Abgeschlossen">Abgeschlossen</option>   
					</select>

                  </div>
				
				<div  class="col-md-6 col-sm-12 col-xs-12 form-group">
					<textarea  required="required" class="form-control" rows="16" minlength="10"  name="mp_3" id="mp_3" placeholder="Beschreiben Sie Ihr Problem hier ......" ></textarea>
				 </div>
				 <div  class="col-md-6 col-sm-12 col-xs-12 form-group">
					<textarea  required="required" class="form-control" rows="16" minlength="10"  name="mp_4" id="mp_4" placeholder="Beschreiben Sie Ihre Lösung hier ......" ></textarea>
				 </div>

				   <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                    <select name="mp_8" id="mp_8" class="select2_multiple_part form-control input-sm" style="width:100%;"  tabindex="-1">
					 <option></option>
					<?php
						include ('login/conf.php');
							$query = "SELECT * FROM `mp_34matrix` WHERE `mp_1` =  '".$_SESSION["location"]."' ORDER BY `mp_2` ASC";
							$result = mysql_query($query) or die(mysql_error());
							while($row = mysql_fetch_array($result)){
							echo '<option value =  "'.$row['mp_3'].'" "'.$row['mp_4'].'">'.$row['mp_3'].' '.$row['mp_4'].'</option>';	
								}
						mysql_close($conn);	
					 ?>	
				 </select>
					</div>
				   <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                    <select name="mp_12" id="mp_12" class="select2_multiple_part form-control input-sm" style="width:100%;" tabindex="-1">
					 <option></option>
									<?php
										include ('login/conf.php');
											$query = "SELECT * FROM `mp_34matrix` WHERE `mp_1` =  '".$_SESSION["location"]."' ORDER BY `mp_2` ASC";
											$result = mysql_query($query) or die(mysql_error());
											while($row = mysql_fetch_array($result)){
											echo '<option value =  "'.$row['mp_3'].'" "'.$row['mp_4'].'">'.$row['mp_3'].' '.$row['mp_4'].'</option>';	
												}
										mysql_close($conn);	
									 ?>	
								 </select>
				 
					</select>
				   </div>
				  <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                    <select  name="mp_13" id="mp_13"  class="select2_multiple_part form-control input-sm" style="width:100%;" tabindex="-1">
					 <option></option>
									<?php
										include ('login/conf.php');
											$query = "SELECT * FROM `mp_34matrix` WHERE `mp_1` =  '".$_SESSION["location"]."' ORDER BY `mp_2` ASC";
											$result = mysql_query($query) or die(mysql_error());
											while($row = mysql_fetch_array($result)){
											echo '<option value =  "'.$row['mp_3'].'" "'.$row['mp_4'].'">'.$row['mp_3'].' '.$row['mp_4'].'</option>';	
												}
										mysql_close($conn);	
									 ?>	
								 </select>
                  </div>
				  <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                    <select  name="mp_14" id="mp_14"  class="select2_multiple_part form-control input-sm" style="width:100%;" tabindex="-1">
					 <option></option>
									<?php
										include ('login/conf.php');
											$query = "SELECT * FROM `mp_34matrix` WHERE `mp_1` =  '".$_SESSION["location"]."' ORDER BY `mp_2` ASC";
											$result = mysql_query($query) or die(mysql_error());
											while($row = mysql_fetch_array($result)){
											echo '<option value =  "'.$row['mp_3'].'" "'.$row['mp_4'].'">'.$row['mp_3'].' '.$row['mp_4'].'</option>';	
												}
										mysql_close($conn);	
									 ?>	
								 </select>
                  </div>
				  	<input type="hidden" name="id" id="id"/>
					<br>		
				 
				  <div class="pull-right">
					<div class="dropup btn-group">
						<button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
					 <input type="button" name="insert" id="insert" value="Hinzufügen" class="btn btn-success form-group pull-right" />
					</div>
				  
				  </div>

			</form>	
				</div>	
			  </div>
			</div>
		</div>	
	</div>			
<!-- END Modal new_open listing -->









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
	
	 <input type="hidden" name="id" id="id"/>
     <input type="submit" name="insert" id="insert" value="Hinzufügen" class="btn btn-success btn-xs form-group pull-right" />
		
    </form>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>



