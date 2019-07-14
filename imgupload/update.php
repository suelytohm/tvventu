<?php
//update.php

include('database_connection.php');

if(isset($_POST["image_id"]))
{
 $old_name = get_old_image_name($connect, $_POST["image_id"]);
 $file_array = explode(".", $old_name);
 $file_extension = end($file_array);
 $new_name = $_POST["image_name"] . '.' . $file_extension;
 $query = '';
 if($old_name != $new_name)
 {
  $old_path = 'files/' . $old_name;
  $new_path = 'files/' . $new_name;
  if(rename($old_path, $new_path))
  { 
   $query = "
   UPDATE tbl_image 
   SET image_name = '".$new_name."', image_description = '".$_POST["image_description"]."' 
   WHERE image_id = '".$_POST["image_id"]."'
   ";
  }
 }
 else
 {
  $query = "
   UPDATE tbl_image 
   SET image_description = '".$_POST["image_description"]."' 
   WHERE image_id = '".$_POST["image_id"]."'
   ";
 }
 
 $statement = $connect->prepare($query);
 $statement->execute();
}
function get_old_image_name($connect, $image_id)
{
 $query = "
 SELECT image_name FROM tbl_image WHERE image_id = '".$image_id."'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  return $row["image_name"];
 }
}

?>
