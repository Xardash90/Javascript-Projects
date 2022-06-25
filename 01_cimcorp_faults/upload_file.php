<?php

if(isset($_POST['hidden_field']))
{
 $error = '';
 $total_line = '';
 session_start();
 include ('../../login/conf.php');
 
if (!is_dir('../01_cimcorp_faults/file_upload_'.$_SESSION["location"].'' )) {
    mkdir('../01_cimcorp_faults/file_upload_'.$_SESSION["location"].'' , 0777, true);
}

 if($_FILES['upload']['name'] != '')
 {
  $allowed_extension = array('PDF','pdf','msg','jpg','JPG','png','img', 'JPEG', 'jpeg');
  $file_array = explode(".", $_FILES["upload"]["name"]);
  $extension = end($file_array);
  if(in_array($extension, $allowed_extension))
  {
   $new_file_name = rand() . '.' . $extension;
   $_SESSION['csv_file_name'] = $new_file_name;
   move_uploaded_file($_FILES['upload']['tmp_name'], '../01_cimcorp_faults/file_upload_'.$_SESSION["location"].'/'.$_POST["uploadID"].'_'.$new_file_name);
   $file_content = file('../01_cimcorp_faults/file_upload_'.$_SESSION["location"].'/'.$_POST["uploadID"].'_'. $new_file_name, FILE_SKIP_EMPTY_LINES);
   mysql_query("UPDATE `mp_38matrix` SET `mp_18`= '".$_POST["uploadID"]."_".$new_file_name."' WHERE `nr` = '".$_POST["uploadID"]."' ");	
   $total_line = count($file_content);
  }
  else
  {
   $error = '<center>Dateiformat nicht zulässig !</center>';
  }
 }
 else
 {
  $error = '<center>Bitte Datei auswählen.</center>';
 }

 if($error != '')
 {
  $output = array(
   'error'  => $error
  );
 } 
 else
 {
  $output = array(
   'success'  => true,
   'total_line' => ($total_line - 1)
  );
 }

 echo json_encode($output);
}

mysql_close($conn);
?>