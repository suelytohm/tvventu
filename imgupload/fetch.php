<?php
include('database_connection.php');

    
if(isset($_REQUEST['id']))
{
    $id = $_REQUEST['id'];
}
 
if(isset($_REQUEST['categoria']))
{
    $categoria = $_REQUEST['categoria'];
}    

$query = "SELECT * FROM tbl_image WHERE id_postagem = '" . $id . "' and categoria = '" . $categoria . "' ORDER BY image_id DESC";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$number_of_rows = $statement->rowCount();
$output = '';
$output .= '
 <table class="table table-bordered table-striped">
  <tr>
   <th>Nº</th>
   <th>Imagem</th>
   <th>Nome</th>
   <th>Descrição</th>
   <th>Editar</th>
   <th>Delete</th>
  </tr>
';
if($number_of_rows > 0)
{
 $count = 0;
 foreach($result as $row)
 {
  $count ++; 
  $output .= '
  <tr>
   <td>'.$count.'</td>
   <td><img src="'.$row["image_name"].'" class="img-thumbnail" width="100" height="100" /></td>
   <td>'.$row["image_name"].'</td>
   <td>'.$row["image_description"].'</td>
   <td><button type="button" class="btn btn-warning btn-xs edit" id="'.$row["image_id"].'">Editar</button></td>
   <td><button type="button" class="btn btn-danger btn-xs delete" id="'.$row["image_id"].'" data-image_name="'.$row["image_name"].'">Delete</button></td>
  </tr>
  ';
 }
}
else
{
 $output .= '
  <tr>
   <td colspan="6" align="center">No Data Found</td>
  </tr>
 ';
}
$output .= '</table>';
echo $output;
?>
