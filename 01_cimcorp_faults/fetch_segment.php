<?php

session_start();
include ('../../login/conf.php');
	ECHO '<table  id="datatable-header-cimcorp" class="table table-bordered table-sm table-hover" width="100%" >
					<thead>
						<tr>
							<th class="warning">Segmente</th>
							<th class="warning">letzte Änderung</th>
							<th class="warning"><a class="btn btn-default text-success btn-xs add pull-left" role="button" name="add" id="add" data-toggle="modal" data-target="#add_segment_Modal" >
								Neues Segment <i class="fa fa-pencil-square-o"></i></a>
								<a class="btn btn-default text-success btn-xs pull-right refresh_tab" role="button" " name="refresh_tab" id="refresh_tab"  >
								zu Schichtreport <i class="fa fa-pencil-square-o"></i>
							</a>
						</th>
						</tr>
					</thead>
				<tbody>'; 
				 
		
		$query = "SELECT * FROM `mp_38matrix` WHERE `mp_9` = 'CC_SEGMENT' AND `mp_1` = '".$_SESSION["location"]."' ORDER BY `mp_10` ASC";
		$result = mysql_query($query) or die(mysql_error());
		 while($row = mysql_fetch_array($result)){
			ECHO '
						<tr>
							<td>'.$row['mp_10'].'</td>	
							<td>
							 <i><small> '.$row['mp_6'].'	- '.date(' d.m.Y h:i:s'  , strtotime($row["end_timestamp"])).' Uhr </small></i>
							</td>
							<td>
							
								<a class="btn btn-danger text-success btn-xs delete_segment_data pull-right" role="button" name="delete" id="'.$row["nr"] .'" " >
								 <i class="fa fa-trash"></i>
								</a>	
								<a class="btn btn-default text-success btn-xs pull-right edit_segment_data" role="button" name="edit" id="'.$row["nr"] .'" " >
								 <i class="fa fa-pencil-square-o"></i>
								</a>
							</td>							
						</tr>';
	}
		 
			
ECHO '</tbody></table></div>';


echo "<script>
		$('.refresh_tab').click(function(){ 
		NProgress.start();
		$('#live_data').load('lists/01_cimcorp_faults/fetch.php');
		$('#overview').load('lists/01_cimcorp_faults/top_button.php'); 
		NProgress.done();
		});
		</script>
	  ";
	
include ('tbl_script.php');	
mysql_close($conn);				
	
?>

	