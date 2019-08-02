<?php

$id = $_REQUEST['id'];
$categoria = $_REQUEST['categoria'];
?>

<!DOCTYPE html>
<html>
 <head>
  <title>Gerenciador de Sliders - TV Ventu</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  <div class="container">
   <h3 align="center">Gerenciador de Sliders - TV Ventu</h3>
   <br />
   <div align="left">
    <a href="../adm.php" class="btn btn-primary">Voltar</a>
   </div>
   <div align="right">
    <input type="file" name="multiple_files" id="multiple_files" multiple />
    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>"/>   
    <input type="hidden" name="categoria" id="categoria" value="<?php echo $categoria; ?>"/>      
    <span class="text-muted">Apenas arquivos do tipo .jpg, png, .gif são permtidos</span>
    <span id="error_multiple_files"></span>
   </div>
   <br />
   <div class="table-responsive" id="image_table">
    
   </div>
  </div>
 </body>
</html>
<div id="imageModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <form method="POST" id="edit_image_form">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">Editar Detalhes</h4>
    </div>
    <div class="modal-body">
     <div class="form-group">
      <label>Nome</label>
      <input type="text" name="image_name" id="image_name" class="form-control" />
     </div>
     <div class="form-group">
      <label>Descrição da Imagem</label>
      <input type="text" name="image_description" id="image_description" class="form-control" />
     </div>
    </div>
    <div class="modal-footer">
     <input type="hidden" name="image_id" id="image_id" value="" />
     <input type="submit" name="submit" class="btn btn-info" value="Edit" />
     <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
    </div>
   </form>
  </div>
 </div>
</div>
<script>
$(document).ready(function(){
 load_image_data();
 function load_image_data()
 {
  var form_data = new FormData();     
  var id_post = document.getElementById("id").value;   
  var categoria_post = document.getElementById("categoria").value;      
  form_data.append("id", id_post);    
  form_data.append("categoria", categoria_post);             
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data: form_data,
   contentType: false,
   cache: false,
   processData: false,      
   success:function(data)
   {
    $('#image_table').html(data);
   }
  });
 } 
 $('#multiple_files').change(function(){
  var error_images = '';
  var form_data = new FormData();
  var files = $('#multiple_files')[0].files;
  if(files.length > 20)
  {
   error_images += 'Você não pode selecionar mais de 20 arquivos ao mesmo tempo!';
  }
  else
  {
   for(var i=0; i<files.length; i++)
   {
    var name = document.getElementById("multiple_files").files[i].name;
    var ext = name.split('.').pop().toLowerCase();
    var id_post = document.getElementById("id").value;   
    var categoria_post = document.getElementById("categoria").value;      
    if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
    {
     error_images += '<p>Arquivo '+i+' Inválido</p>';
    }
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("multiple_files").files[i]);
    var f = document.getElementById("multiple_files").files[i];
    var fsize = f.size||f.fileSize;
    if(fsize > 2000000)
    {
     error_images += '<p>' + i + ' Arquivo muito grande!</p>';
    }
    else
    {
     form_data.append("file[]", document.getElementById('multiple_files').files[i]);
     form_data.append("id", id_post);    
     form_data.append("categoria", categoria_post);        
    }
   }
  }
  if(error_images == '')
  {
   $.ajax({
    url:"upload.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#error_multiple_files').html('<br /><label class="text-primary">Carregando...</label>');
    },   
    success:function(data)
    {
     $('#error_multiple_files').html('<br /><label class="text-success">Enviado!</label>');
     load_image_data();
    }
   });
  }
  else
  {
   $('#multiple_files').val('');
   $('#error_multiple_files').html("<span class='text-danger'>"+error_images+"</span>");
   return false;
  }
 });  
 $(document).on('click', '.edit', function(){
  var image_id = $(this).attr("id");
  $.ajax({
   url:"edit.php",
   method:"post",
   data:{image_id:image_id},
   dataType:"json",
   success:function(data)
   {
    $('#imageModal').modal('show');
    $('#image_id').val(image_id);
    $('#image_name').val(data.image_name);
    $('#image_description').val(data.image_description);
   }
  });
 }); 
 $(document).on('click', '.delete', function(){
  var image_id = $(this).attr("id");
  var image_name = $(this).data("image_name");
  if(confirm("Tem certeza que deseja excluir?"))
  {
   $.ajax({
    url:"delete.php",
    method:"POST",
    data:{image_id:image_id, image_name:image_name},
    success:function(data)
    {
     load_image_data();
     alert("Imagem Removida!");
    }
   });
  }
 }); 
 $('#edit_image_form').on('submit', function(event){
  event.preventDefault();
  if($('#image_name').val() == '')
  {
   alert("Informe o nome da imagem");
  }
  else
  {
   $.ajax({
    url:"update.php",
    method:"POST",
    data:$('#edit_image_form').serialize(),
    success:function(data)
    {
     $('#imageModal').modal('hide');
     load_image_data();
     alert('Detalhes da imagem Editados!');
    }
   });
  }
 }); 
});
</script>