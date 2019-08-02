<?php
//upload.php
include('database_connection.php');
if(count($_FILES["file"]["name"]) > 0)
{
    
if(isset($_REQUEST['id']))
{
    $id = $_REQUEST['id'];
}
 
if(isset($_REQUEST['categoria']))
{
    $categoria = $_REQUEST['categoria'];
}    
    
 //$output = '';
 sleep(3);
 for($count=0; $count<count($_FILES["file"]["name"]); $count++)
 {
  $file_name = $_FILES["file"]["name"][$count];
  $tmp_name = $_FILES["file"]['tmp_name'][$count];
  $file_array = explode(".", $file_name);
  $file_extension = end($file_array);
  if(file_already_uploaded($file_name, $connect))
  {
   $file_name = $file_array[0] . '-'. rand() . '.' . $file_extension;
  }
  $location = 'img/postagens/slide/' . $file_name;
  if(move_uploaded_file($tmp_name, $location))
  {
   $query = "
   INSERT INTO tbl_image (image_name, image_description, id_postagem, categoria) 
   VALUES ('img/postagens/slide/".$file_name."', '', '" . $id . "', '" . $categoria . "')
   ";
   $statement = $connect->prepare($query);
   $statement->execute();
  }
 }
}

function file_already_uploaded($file_name, $connect)
{
 
 $query = "SELECT * FROM tbl_image WHERE image_name = '".$file_name."' AND id_postagem = '" . $id . "' AND categoria = '" . $categoria . "';";
 $statement = $connect->prepare($query);
 $statement->execute();
 $number_of_rows = $statement->rowCount();
 if($number_of_rows > 0)
 {
  return true;
 }
 else
 {
  return false;
 }
}

?>
