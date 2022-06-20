<?php
session_start();
include ('../../login/conf.php');
			//Select für Anzeige der Button Zähler
			$query = ("SELECT *,
					(SELECT COUNT(*) FROM wi_home.`mp_38matrix` WHERE `mp_5` = 'Offen' AND `mp_1` = '".$_SESSION["location"]."' AND `mp_9` = 'CC_SCHIFTREPORT'  LIMIT 1)							AS 'REPORT_OPEN',
					(SELECT COUNT(*) FROM wi_home.`mp_38matrix` WHERE `mp_5` = 'In Bearbeitung' AND `mp_1` = '".$_SESSION["location"]."' AND `mp_9` = 'CC_SCHIFTREPORT' LIMIT 1)					AS 'REPORT_WATCH',
					(SELECT COUNT(*) FROM wi_home.`mp_38matrix` WHERE `mp_5` = 'Abgeschlossen' AND `mp_1` = '".$_SESSION["location"]."' AND `mp_9` = 'CC_SCHIFTREPORT'  LIMIT 1)					AS 'REPORT_DONE',
					(SELECT COUNT(*) FROM wi_home.`mp_38matrix` WHERE `mp_1` = '".$_SESSION["location"]."' AND `mp_9` = 'CC_SCHIFTREPORT'  LIMIT 1)													AS 'REPORT_ALL'
			 FROM `wi_home`.`mp_38matrix` WHERE `mp_1` = '".$_SESSION["location"]."' LIMIT 1 ");						
			$result = mysql_query($query) or die(mysql_error());
				while($row = mysql_fetch_array($result)) {
					$REPORT_OPEN 			= $row["REPORT_OPEN"];
					$REPORT_WATCH			= $row["REPORT_WATCH"];
					$REPORT_DONE			= $row["REPORT_DONE"];
					$REPORT_ALL				= $row["REPORT_ALL"];
					$currentDate = date("d.m.Y");  
					
				
				}	
					
					
					
					
					
				
echo'				<div class="form-group  btn-group">				
					<button  class="btn btn-default btn-xs OPEN" id="OPEN" name="OPEN" ><i style="color: red;" class="fa fa-exclamation-triangle blink"></i> '.$REPORT_OPEN.' <span id="CNTRES" style="color:black;"></span></button>
					<button  class="btn btn-default btn-xs WATCH" id="WATCH" name="WATCH" ><i style="color: black;" class="fa fa-cog"></i> '.$REPORT_WATCH .'<span id="CNTCLR" style="color:white;"></span></button>
					<button  class="btn btn-default btn-xs DONE" id="DONE" name="DONE" ><i style="color: #66CDAA;" class="fa fa-check"></i>'.$REPORT_DONE.'<span id="CNTSYS" style="color:white;"></span></button>
					<button  class="btn btn-default btn-xs ALL" id="ALL" name="ALL" ><i style="color: black;" class="fa fa-list"></i>'.$REPORT_ALL.'<span id="CNTCLR" style="color:white;"></span></button>
				</div>
		';		
?>	