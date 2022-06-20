<?php
session_start();	
?>
 <div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12" >
			<div class="x_panel" >
			 <div class="row x_title">
				<div class="form-group">
					<h2 class="pull-left">CIMCORP - Schichtreport<small>(Wartungsplan & Störbeseitigung)</small> <small>Niederlassung - <?php echo $_SESSION["location"] ; ?></small></h2>  
					
					<div class="dropdown pull-right">
					  <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-cog fa-spin"></i>
					  <span class="caret"></span></button>
					  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
						<li><a class="segment_list" name="segment_list" id="segment_list" ><i class="fa fa-bars"></i> Segmentliste</a>	</li>
						<li role="presentation"><a  href="cc_file_system.php" class="file_system" name="file_system" id="file_system"><i class="fa fa-file-o" aria-hidden="true"></i> File-System</a></li>
						<li role="presentation"><a href="../dashboard/pdf/cc_shiftreport.php"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Tagesbericht</a></li>
					  </ul>
					</div>
					<a class="btn btn-default btn-xs refresh_tab pull-right" role="button" name="refresh_tab" id="refresh_tab" ><i class="text-success fa fa-spinner fa-pulse" ></i></a>	
				</div>								
		    </div>
					
							<div class="collapse" id="InboundDetails">
							<div class="clearfix"></div>
								<div class="col-md-4 col-sm-12 col-xs-12">
									<div id="shiftreport_open"></div>
								</div>
								<div class="col-md-4 col-sm-12 col-xs-12">
									<div id="shiftreport_progress"></div>
								</div>
								<div class="col-md-4 col-sm-12 col-xs-12">
									<div id="shiftreport_done"></div>
								</div>
								<div class="clearfix"></div>
						</div>	
			
		<div class="form-group pull-right">
				<button class="btn btn-primary btn-sm InboundDetails pull-left" type="button" data-toggle="collapse" data-target="#InboundDetails" aria-expanded="false" aria-controls="InboundDetails"> Bearbeitungsstatus-Übersicht <i id="btnP"></i> </button>
		</div>			
					<div class="clearfix"></div>
						<div id="live_data"></div>  
					
				
				</div>		
			</div>		
		</div>		
<?php
include ('script.php');
?>	





