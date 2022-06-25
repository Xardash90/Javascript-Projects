<?php
session_start();
if(isset($_SESSION['location'])){
	  include ('../../login/conf.php'); 
	}
	else{
	  header("location: ../../");
	}
						  
				if(isset($_POST["query"]))
				{
				 $query=" SELECT *,
								  ( SELECT `O_LROU_DEPARTDATE` FROM wi_reports.`om36` WHERE NOT `O_LROU_CSLCNTASSIGNED` = `O_LROU_CSLCNTPICKED` AND `O_LOW_OWNER` = '".$_SESSION["location"]."' GROUP BY `O_LROU_DEPARTDATE` ORDER BY `O_LROU_DEPARTDATE` ASC LIMIT 1 ) AS 'AUFTRAGSSTAND'
						  FROM `wi_reports`.`outbound_gate` WHERE  NOT `O_COLUMN` = '0' AND`O_MANDAT` = '".$_SESSION["location"]."' AND ( `O_GATE` LIKE '%".$_POST["query"]."%' OR `O_LCU_IDENT` LIKE '%".$_POST["query"]."%' ) GROUP BY `O_GATE` ORDER BY `O_AUTO`,`O_GATE` ASC ";								
				}
				else
				{
				 $query=" SELECT *,
								  ( SELECT `O_LROU_DEPARTDATE` FROM wi_reports.`om36` WHERE NOT `O_LROU_CSLCNTASSIGNED` = `O_LROU_CSLCNTPICKED` AND `O_LOW_OWNER` = '".$_SESSION["location"]."' GROUP BY `O_LROU_DEPARTDATE` ORDER BY `O_LROU_DEPARTDATE` ASC LIMIT 1 ) AS 'AUFTRAGSSTAND'
						  FROM `wi_reports`.`outbound_gate` WHERE  NOT `O_COLUMN` = '0' AND`O_MANDAT` = '".$_SESSION["location"]."' GROUP BY `O_GATE` ORDER BY `O_AUTO`,`O_GATE` ASC ";	
				}
				$result = mysql_query($query) or die(mysql_error());
						while($row = mysql_fetch_array($result)){
							
					if ( $row['AUFTRAGSSTAND'] <= date('Y-m-d H:i') ) 
						{ 
							$AUFTRAGSSTAND  = '<small class="text-danger"><center><i class="fa fa-info"></i> '.date('d.m.Y - H:i:s', strtotime($row['AUFTRAGSSTAND'])).'</center></small>';
						}
						else
						{ 
							$AUFTRAGSSTAND  = '<small><center><i class="fa fa-info"></i> '.date('d.m.Y - H:i:s', strtotime($row['AUFTRAGSSTAND'])).'</center></small>';
						} 		
					
					echo "	<script>$(document).ready(function() {
							
							$('#AUFTRAGSSTAND').html('$AUFTRAGSSTAND');

							}); </script>";
						
					if ( $row['O_LROU_STARTDATE'] == '02.01.1970' ) { $PICKDATE = 'Warte auf Freigabe !'; } 
					else { $PICKDATE = $row['O_LROU_STARTDATE']; } 
				
					if ( $row['FLAG'] == '1' ) 
						{ 
							$VIP = ' <i class="fa fa-star-o" aria-hidden="true"></i> '; 
						} 
						else
						{ 
							$VIP = ''; 
						} 
						
					if ( $row['O_LROU_DEPARTDATE'] == '' ) 
						{ 
							$DEPARTDATE = ''; 
							$LDUSUM = '';  
							$LDUSUMT = ''; 
						} 
						else
						{ 
							$DEPARTDATE = date('d.m.Y - H:i', strtotime($row['O_LROU_DEPARTDATE'])); 
							$LDUSUM = ' <i class="fa fa-arrow-right"></i> '.$row['O_LDTU_TOTAL'].' / '.$row['O_LDTU_PICKED'].' '; 
							$LDUSUMT = $row['O_LDTU_TOTAL'].' / '.$row['O_LDTU_PICKED']; 
						} 
						
					$TITLE = 'Versandbahn '.$row['O_GATE'].' &#10;&#10;Filiale =  '.$row['O_LCU_IDENT'].' '.$row['O_LCU_NAME1'].' &#10;Bereistellung = '.$DEPARTDATE.'&#10;Status = '.$row['O_LROU_STATE'].'&#10;Transporteinheiten Total = '.$LDUSUMT.' davon erledigt! &#10;&#10;Tour Gestartet = '.$PICKDATE.'&#10;&#10;Stellplatzinfo = '.$row['O_TEXT'].'&#10;&#10;Letzer Bearbeiter = '.$row['User'].' '.date('d.m.Y - H:i:s', strtotime($row['Moddate'])).'  '; 		
					
					ECHO '<div class="lines view_data" id="'.$row['O_NR'].'" scroll="no" style ="background-color: '.$row['O_COLOR'].';cursor: pointer;overflow: hidden" title="'.$TITLE.'"><p><small> Versandbahn</small> '.$VIP.'
													<strong class="pull-right" style="font-size: 16px" >'.$row['O_GATE'].' </strong>
													</p>
													<p style="font-size: 10px" > '.$DEPARTDATE.'<br>'.$row['O_LROU_STATE'].' '.$LDUSUM.' <br> '.$row['O_LCU_IDENT'].' '.$row['O_LCU_NAME1'].' 					  
													</p>
													
						  </div>';
							
					
					} //'.date('d.m.Y - H:i', strtotime($row['O_LROU_DEPARTDATE'])).'    '.$row['O_LROU_STATE'].'        				
mysql_close($conn);
?>









