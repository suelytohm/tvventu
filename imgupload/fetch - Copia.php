<?php
include('database_connection.php');

$id_postagem = $_POST['id_postagem'];
$categoria = $_POST['categoria'];

$query = "SELECT * FROM tbl_image WHERE id_postagem = " . $id_postagem . " AND categoria = '" . $categoria . "' ORDER BY image_id DESC";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$number_of_rows = $statement->rowCount();
$output = '';
$output .= '
 <table class="table table-bordered table-striped">
  <tr>
   <th>No</th>
   <th>Imagem</th>
   <th>Caminho</th>
   <th>Excluir</th>
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
   <td><img src="../'.$row["image_name"].'" class="img-thumbnail" width="100" height="100" /></td>
   <td>'.$row["image_name"].'</td>
   <td><button type="button" class="btn btn-danger btn-xs delete" id="'.$row["image_id"].'" data-image_name="'.$row["image_name"].'">Excluir</button></td>
  </tr>
  ';
 }
}
else
{
 $output .= '
  <tr>
   <td colspan="6" align="center">Nenhum Arquivo Encontrado</td>
  </tr>
 ';
}
$output .= '</table>';
echo $output;
?>
