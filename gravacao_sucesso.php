<?php


if(isset($_REQUEST['tipo']))
{
    $tipo = $_REQUEST['tipo'];
}

if(isset($_REQUEST['acao']))
{
    $categoria = $_REQUEST['acao'];
}

if(isset($_REQUEST['id']))
{
    $id = $_REQUEST['id'];
}


try
{
    include 'configdb.php';   
}
catch(PDOException $e)
{
    echo "Falha: " . $e->getMessage();
    exit();
}

if($tipo == "novoregistro")
{
    
    $titulo = "Postagem Enviada com Sucesso!";
    
    $rs = $connection->prepare("SELECT MAX(id) as id FROM " . $categoria . ";");    
    

    if($rs->execute())
    {
        while($registro = $rs->fetch(PDO::FETCH_OBJ))
        {
            $id = $registro->id ;
        }
    }
    else
    {
        echo "Falha";
    }    
}
elseif($tipo == "editar")
{
    $titulo = "Postagem editada!";
}
else
{
    $id = $_REQUEST['id'];
}
?>



<html>
<head>
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title>Painel Administrativo - TV Ventu</title>
    <link rel="icon" href="img/favicon.png" type="image/gif">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/css/mdb.min.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <style>
        .titulo, hr
        {
            margin-top: 50px;
            margin-bottom: 50px;
        }
        
        .btn
        {
            width: 100%;
        }
        
        p, h1, h2, h3, h4, h5, h6
        {
            color: #fff;
        }
        
        hr
        {
            background-color: #fff;
        }
        .row
        {
            margin-top: 100px;
        }
    </style>
    
</head>
    <body class="animated fadeIn black">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="row">
                        <div class="col-md-12">
                            <h2><?php echo $titulo; ?></h2>                        
                            <p>Deseja criar um slide para a postagem?</p>                            
                        </div>
                    </div>
                    <div class="row">                    
                        <div class="col-md-6"><a href="imgupload/index.php?id=<?php echo $id;?>&categoria=<?php echo $categoria;?>" class="btn btn-success">MONTAR SLIDE</a></div>
                        <div class="col-md-6">                       
                            <a href="index.php" class="btn btn-danger">IR PARA A PÁGINA INICIAL</a>                 
                        </div>                        
                    </div>                    
                </div>
            </div>
        </div>
    </body>
</html>
