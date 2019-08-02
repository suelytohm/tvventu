<?php

$aovivo = "NÃO";
$postagens = "0";
$anuncios = "0";
$videos = "0";

session_start();

if(!isset($_SESSION['logado']))
{
    header('Location: login.php');
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

$rs = $connection->prepare("SELECT * FROM adm");

if($rs->execute())
{
    while($registro = $rs->fetch(PDO::FETCH_OBJ))
    {
        $aovivo = $registro->aovivo ;
        $postagens = $registro->postagens ;
        $anuncios = $registro->anuncios ;
        $videos = $registro->videos ;
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
    </style>
    
</head>
    <body class="animated fadeIn black">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <hr>
                    <a href="index.php"><img src="img/logo2.png"></a>
                    <h1 class="titulo" align="center">Painel Administrativo</h1>        
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Olá <?php echo $_SESSION['usuario']; ?></h3>
                </div>
            </div>            
            <div class="row">
                <div class="col-md-3">
                    <a href="listarpostagens.php" class="btn btn-primary">Postagens</a>
                </div>
                <div class="col-md-2">                        
                    <a href="postarvideo.php" class="btn btn-amber">Vídeos</a>
                </div>                    
                <div class="col-md-2">    
                    <a href="postaovivo.php" class="btn btn-danger">Ao Vivo</a>
                </div>    
                <div class="col-md-2">                        
                    <a href="listaranuncios.php" class="btn btn-success">Anúncios</a>
                </div>    
                <div class="col-md-3">                        
                    <a href="listarmelhoresdoano.php" class="btn btn-warning">Melhores do Ano</a>
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
                        <div class="col-md-3">
                            <h2 class="display-5">Ao Vivo:</h2>
                            <h2 class="display-2"><strong><?php echo $aovivo;?></strong></h2>
                        </div>
                        <div class="col-md-3">
                            <h2 class="display-5">Vídeos:</h2>
                            <h2 class="display-2"><strong><?php echo $videos;?></strong></h2>
                        </div>                        
                        <div class="col-md-3">
                            <h2 class="display-5">Postagens:</h2>
                            <h2 class="display-2"><strong><?php echo $postagens;?></strong></h2>
                        </div>
                        <div class="col-md-3">                    
                            <h2 class="display-5">Anúncios Ativos:</h2>
                            <h2 class="display-2"><strong><?php echo $anuncios;?></strong></h2>                       
                        </div>                        
                    </div>
                </div>
            </div>              

            
        </div>
        
    </body>
</html>