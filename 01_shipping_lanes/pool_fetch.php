<?php
session_start();

include ('../../login/config.php');

$columns = array('O_GATE','O_COLUMN' );

$query = "SELECT * FROM `wi_reports`.`outbound_gate`  ";

if(isset($_POST["search"]["value"]))
{
 $query .= " WHERE  ( `O_GATE` LIKE '%".$_POST["search"]["value"]."%' OR `O_COLUMN` LIKE '%".$_POST["search"]["value"]."%' )  AND `O_MANDAT` = '".$_SESSION["location"]."'   ";
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 //$query .= 'ORDER BY `nr` DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
	if ($row['O_COLUMN']=='0') {
		$BTN = '<button type="button" name="'.$row['O_COLUMN'].'" class="btn btn-warning btn-xs btn-block aktiv" id="'.$row["O_NR"].'">DEAKTIV</button>';
	} elseif ($row['O_COLUMN']=='1') {
		$BTN = '<button type="button" name="'.$row['O_COLUMN'].'" class="btn btn-success btn-xs btn-block aktiv" id="'.$row["O_NR"].'">AKTIV</button>';
	}

 $sub_array = array();
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["O_NR"].'" data-column="O_GATE"><strong>'.$row["O_GATE"].'</strong></div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["O_NR"].'" data-column="O_TEXT">'.$row["O_TEXT"].'</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["O_NR"].'" data-column="O_AUTO">'.$row["O_AUTO"].'</div>';
 $sub_array[] = $BTN;
 $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete pull-right" id="'.$row["O_NR"].'"><i class="fa fa-trash"></i></button>';
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM `wi_reports`.`outbound_gate` WHERE `O_MANDAT` = '".$_SESSION["location"]."' ";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

mysql_close($conn);	
?>
