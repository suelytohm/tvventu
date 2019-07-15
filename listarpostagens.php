<?php

/*
if(!isset($_SESSION['logado']))
{
    header('Location: login.php');
}*/

try
{
    include 'configdb.php';   
}
catch(PDOException $e)
{
    echo "Falhas: " . $e->getMessage();
    exit();
}

$anuncios = "";
$cor = "";
$rs = $connection->prepare("SELECT id, titulo, categoria, autor, visivel, DATE_FORMAT(data, '%d/%m/%y') AS data FROM postagens");

if($rs->execute())
{
    while($registro = $rs->fetch(PDO::FETCH_OBJ))
    {
        $id = $registro->id;
        $titulo = $registro->titulo;
        $categoria = $registro->categoria;
        $autor = $registro->autor;
        $visivel = $registro->visivel;
        $data = $registro->data;
        

        if($visivel == "S")
        {
            $cor = "bg-primary";
        }
        else
        {
            $cor = "bg-danger";
        }
        
        // $saida .= "<a href='" . $categoria . ".php?id=" . $id . "' class='carousel-item'>";
        
        $anuncios .= "<a href='editarPostagem.php?id=" . $id . "' class='card text-white " . $cor . "'>";
          $anuncios .= "<div class='card-body'>";
            $anuncios .= "<h5 class='card-title'>" . $titulo . "</h5>";
            $anuncios .= "<p class='card-text text-white'>Data: " . $data ."</p>";
            $anuncios .= "<p class='card-text text-white'>Autor.: " . $autor ."</p>";
          $anuncios .= "</div>";
        $anuncios .= "</a><br>";
        
    }
}
else
{
    echo "Falha";
}
?>

<html>
<head>
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title>Anúncios - TV Ventu</title>
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
        
        p, h1, h2, h3, h4
        {
            color: #fff;
        }
        
        hr
        {
            background-color: #fff;
        }
        
        .card
        {
            margin: 10px;
        }
    </style>
    
</head>
    <body class="animated fadeIn black">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <hr>
                    <img src="img/logo2.png">
                    <h1 class="titulo" align="center">Anúncios</h1>        
                </div>
            </div>          
            <div class="row">
                <div class="col-md-3">
                    <a href="listarpostagens.php" class="btn btn-primary">Postagens</a>
                </div>    
                <div class="col-md-3">    
                    <a href="postaovivo.php" class="btn btn-danger">Ao Vivo</a>
                </div>    
                <div class="col-md-3">                        
                    <a href="listaranuncios.php" class="btn btn-success">Anúncios</a>
                </div>    
                <div class="col-md-3">                        
                    <a class="btn btn-warning">Melhores do Ano</a>
                </div>
            </div>            
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <a href="postagem.php" class="card text-white bg-success mb-3" style="max-width: 20rem;">
                                  <div class="card-header"></div>
                                  <div class="card-body">
                                    <h2 class="card-title">Nova Postagem</h2>
                                  </div>
                                </a>                                
                                <?php echo $anuncios ;?>
                            </div>
                            
                            
                        </div>                      
                    </div>
                </div>
            </div>              

            
        </div>
        
    </body>
</html>