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
				 $query=" SELECT * ,
									ROUND(`O_LDTU_PICKED` / `O_LDTU_TOTAL` * 100, '2') AS 'PROZENT',
									TIMEDIFF(NOW(),STR_TO_DATE(`O_LROU_STARTDATE`,'%d.%m.%Y %h:%i:%s')) AS 'PICKDURATION',
									( SELECT `O_LROU_DEPARTDATE` FROM wi_reports.`om36` WHERE NOT `O_LROU_CSLCNTASSIGNED` = `O_LROU_CSLCNTPICKED` AND `O_LOW_OWNER` = '".$_SESSION["location"]."' GROUP BY `O_LROU_DEPARTDATE` ORDER BY `O_LROU_DEPARTDATE` ASC LIMIT 1 ) AS 'AUFTRAGSSTAND',
									( SELECT CONCAT( FLOOR(HOUR(TIMEDIFF(NOW(), `O_LROU_DEPARTDATE`)) / 24), 'T ',MOD(HOUR(TIMEDIFF(NOW(), `O_LROU_DEPARTDATE`)), 24), 'h ', MINUTE(TIMEDIFF(NOW(), `O_LROU_DEPARTDATE`)), 'm ', SECOND(TIMEDIFF(NOW(), `O_LROU_DEPARTDATE`)), 's') 
									  FROM wi_reports.`om36` WHERE NOT `O_LROU_CSLCNTASSIGNED` = `O_LROU_CSLCNTPICKED` AND `O_LOW_OWNER` = '".$_SESSION["location"]."' GROUP BY `O_LROU_DEPARTDATE` ORDER BY `O_LROU_DEPARTDATE` ASC LIMIT 1 ) AS 'AUFTRAGSDURATION'	
						  FROM `wi_reports`.`outbound_gate` WHERE  NOT `O_COLUMN` = '0' AND `O_MANDAT` = '".$_SESSION["location"]."' AND ( `O_GATE` LIKE '%".$_POST["query"]."%' OR `O_LCU_IDENT` LIKE '%".$_POST["query"]."%' ) GROUP BY `O_GATE` ORDER BY `O_AUTO`,`O_GATE` ASC ";								
				}
				else
				{
				 $query=" SELECT * ,
									ROUND(`O_LDTU_PICKED` / `O_LDTU_TOTAL` * 100, '2') AS 'PROZENT',
									TIMEDIFF(NOW(),STR_TO_DATE(`O_LROU_STARTDATE`,'%d.%m.%Y %h:%i:%s')) AS 'PICKDURATION',
									( SELECT `O_LROU_DEPARTDATE` FROM wi_reports.`om36` WHERE NOT `O_LROU_CSLCNTASSIGNED` = `O_LROU_CSLCNTPICKED` AND `O_LOW_OWNER` = '".$_SESSION["location"]."' GROUP BY `O_LROU_DEPARTDATE` ORDER BY `O_LROU_DEPARTDATE` ASC LIMIT 1 ) AS 'AUFTRAGSSTAND',
									( SELECT CONCAT( FLOOR(HOUR(TIMEDIFF(NOW(), `O_LROU_DEPARTDATE`)) / 24), 'T ',MOD(HOUR(TIMEDIFF(NOW(), `O_LROU_DEPARTDATE`)), 24), 'h ', MINUTE(TIMEDIFF(NOW(), `O_LROU_DEPARTDATE`)), 'm ', SECOND(TIMEDIFF(NOW(), `O_LROU_DEPARTDATE`)), 's') 
									  FROM wi_reports.`om36` WHERE NOT `O_LROU_CSLCNTASSIGNED` = `O_LROU_CSLCNTPICKED` AND `O_LOW_OWNER` = '".$_SESSION["location"]."' GROUP BY `O_LROU_DEPARTDATE` ORDER BY `O_LROU_DEPARTDATE` ASC LIMIT 1 ) AS 'AUFTRAGSDURATION'	
						  FROM `wi_reports`.`outbound_gate` WHERE  NOT `O_COLUMN` = '0' AND `O_MANDAT` = '".$_SESSION["location"]."' GROUP BY `O_GATE` ORDER BY `O_AUTO`,`O_GATE` ASC ";	
				}
				$result = mysql_query($query) or die(mysql_error());
						while($row = mysql_fetch_array($result)){
							
					if ( $row['AUFTRAGSSTAND'] == '' ) 
						{ 
							$AUFTRAGSSTAND  = '';
						}
					else
							{ 
							if ( $row['AUFTRAGSSTAND'] <= date('Y-m-d H:i') ) 
							{ 
								$AUFTRAGSSTAND  = '<small class="text-danger" ><center>Auftragsstand '.date('d.m.Y - H:i:s', strtotime($row['AUFTRAGSSTAND'])).' (Automation Pickstand | rückstand = '.$row['AUFTRAGSDURATION'].' ) <i class="fa fa-info"></i> </center></small>';
							}
							else
							{ 
								$AUFTRAGSSTAND  = '<small><center>Auftragsstand  '.date('d.m.Y - H:i:s', strtotime($row['AUFTRAGSSTAND'])).' (Automation Pickstand | vorlauf = '.$row['AUFTRAGSDURATION'].' ) <i class="fa fa-info"></i> </center></small>';
							} 
							} 
					
					echo "	<script>$(document).ready(function() {
							
							$('#AUFTRAGSSTAND').html('$AUFTRAGSSTAND');

							}); </script>";
					
					if ( $row['PICKDURATION'] == '' ) { $PICKDURATION = ' - Gestartet = '.$row['O_LROU_STARTDATE']; } 
					elseif (  $row['O_LROU_STATE'] == '(50) Verpackt' || $row['O_LROU_STATE'] == '(99) Neu'  )  { $PICKDURATION = ''; } 
					else { $PICKDURATION = ' - Pickdauer = '.$row['PICKDURATION']; } 
					
					if ( $row['O_LROU_STARTDATE'] == '02.01.1970' ) { $PICKDATE = 'Warte auf Freigabe !'; } 
					else { $PICKDATE = $row['O_LROU_STARTDATE']; } 
					
					if ( $row['O_LROU_DEPARTDATE'] == '' ) 
						{ 
							$DEPARTDATE_ = ''; 
							$DEPARTDATE = ''; 
							$LDUSUM = '';
							$PROZENT = '' ;							
							$LDUSUMT = ''; 
						}
						elseif ( $row['O_LROU_DEPARTDATE'] <= date('Y-m-d H:i') ) 
						{ 
						$DEPARTDATE = '<strong class="text-danger" >'.date('d.m.Y - H:i', strtotime($row['O_LROU_DEPARTDATE'])).'</strong>'; 
						$DEPARTDATE_ = date('d.m.Y - H:i', strtotime($row['O_LROU_DEPARTDATE'])); 
						$LDUSUM = ' <i class="fa fa-arrow-right"></i> <small>total</small> '.$row['O_LDTU_TOTAL'].' / '.$row['O_LDTU_PICKED'].' <small>fertig</small> '; 
						$PROZENT = '<i class="pull-right" > '.$row['PROZENT'].' % &nbsp;&nbsp;</i>' ;
						$LDUSUMT = $row['O_LDTU_TOTAL'].' / '.$row['O_LDTU_PICKED']; 
						} 
						else
						{ 
							$DEPARTDATE = date('d.m.Y - H:i', strtotime($row['O_LROU_DEPARTDATE'])); 
							$DEPARTDATE_ = date('d.m.Y - H:i', strtotime($row['O_LROU_DEPARTDATE'])); 
							$LDUSUM = ' <i class="fa fa-arrow-right"></i> <small>total</small> '.$row['O_LDTU_TOTAL'].' / '.$row['O_LDTU_PICKED'].' <small>fertig</small> '; 
							$PROZENT = '<i class="pull-right" > '.$row['PROZENT'].' % &nbsp;&nbsp;</i>' ;
							$LDUSUMT = $row['O_LDTU_TOTAL'].' / '.$row['O_LDTU_PICKED']; 
						} 
					
					if ( $row['O_LDTU_TOTAL'] == $row['O_LDTU_PICKED'] ) 
						{ 
							$OK = ' <small class="pull-right">Tour &nbsp;&nbsp;</small><i class="fa fa-check pull-right" style="color:#2bd6b2;" > &nbsp;</i> '; 	
						}
						else
						{ 
							$OK = ''; 
						} 
					
					if ( $row['FLAG'] == '1' ) 
						{ 
							$VIP = ' <i class="fa fa-star-o" style="color:#fc4747;" aria-hidden="true"></i> '; 
						} 
						else
						{ 
							$VIP = ''; 
						} 
						
					$TITLE = 'Versandbahn '.$row['O_GATE'].' &#10;&#10;Filiale =  '.$row['O_LCU_IDENT'].' '.$row['O_LCU_NAME1'].' &#10;Bereistellung = '.$DEPARTDATE_.'&#10;Status = '.$row['O_LROU_STATE'].'&#10;Transporteinheiten Total = '.$LDUSUMT.' davon erledigt! &#10;&#10;Tour Gestartet = '.$PICKDATE.'&#10;&#10;Stellplatzinfo = '.$row['O_TEXT'].'&#10;&#10;Letzer Bearbeiter = '.$row['User'].' '.date('d.m.Y - H:i:s', strtotime($row['Moddate'])).'  '; 		
					
					
					
					if ( $row['O_LCU_NAME1'] == '' ) 
						{ 
							
						} 
						else
						{ 

							ECHO '<div class="view_data"  id="'.$row['O_NR'].'"  style ="background-color: #F2F2F2;color:#71717;cursor: pointer;" title="'.$TITLE.'">
								   <p><strong style="font-size: 16px" >&nbsp; '.$row['O_GATE'].' </strong>'.$VIP.' 
											<small> V-Bahn</small> 
											- '.$DEPARTDATE.' - Filiale =  <strong>'.$row['O_LCU_IDENT'].'</strong> '.$row['O_LCU_NAME1'].' 
											- <small> ( Status =  '.$row['O_LROU_STATE'].'  '.$PICKDURATION.')</small> 
											<i class="pull-right" style="background-color:'.$row['O_COLOR'].'margin: 4px; padding: 11px;" >&nbsp;</i>
											'.$PROZENT.'
											&nbsp;<br>&nbsp;
									 
									  ';
							
									for ($i=1; $i<=$row['O_LDTU_PICKED'] ; $i++)
									{
										ECHO '<i style="color:#2bd6b2;" class="fa fa-square" title="Transporteinheit-BARCODE = &#10;Transporteinheit-TYP = &#10;Transporteinheit-STATUS = " ></i> ' ; //<img src="img/europaletten.png" width="12" height="12" >
									}
									for ($i=1; $i<=$row['O_LDTU_TOTAL'] - $row['O_LDTU_PICKED'] ; $i++)
									{
										ECHO '<i style="color:#ffffff;" class="fa fa-square"></i> ' ;
									}
									
							ECHO $LDUSUM.$OK;
							ECHO '</p></div>';
						} 
					
					} 		
mysql_close($conn);
?>









