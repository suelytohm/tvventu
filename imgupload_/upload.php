<?php
//upload.php
include('database_connection.php');

$id_postagem = $_POST['id_postagem'];
$categoria = $_POST['categoria'];

if(count($_FILES["file"]["name"]) > 0)
{
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
  $location = '../img/postagens/slide/' . $file_name;
  if(move_uploaded_file($tmp_name, $location))
  {
   $query = "
   INSERT INTO tbl_image (image_name, image_description, id_postagem, categoria) 
   VALUES ('img/postagens/slide/?', '', ?, ?);";      
    $stmt = $connection->prepare($query);
    $stmt->bindParam(1, $file_name);
    $stmt->bindParam(2, $id_postagem);
    $stmt->bindParam(3, $categoria);
    $stmt->execute();      
   /*
   $statement = $connect->prepare($query);
   $statement->execute();*/
  }
 }
}



/*

            $stmt = $connection->prepare($query);
            $stmt->bindParam(1, $file_name);
            $stmt->bindParam(2, $id_postagem);
            $stmt->bindParam(3, $categoria);
            $stmt->execute();            
            

*/




function file_already_uploaded($file_name, $connect)
{
 
 $query = "SELECT * FROM tbl_image WHERE image_name = '".$file_name."' AND CATEGORIA = '".$categoria."'";
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
