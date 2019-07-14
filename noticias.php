
<?php 
try
{
    include 'configdb.php';   
}
catch(PDOException $e)
{
    echo "Falha: " . $e->getMessage();
    exit();
}


$id = $_REQUEST['id'];
$titulo = "";
$imagemDestaque = "";
$texto = "";
$autor = "";
$data = "";
$categoria = "";
$imagem_secundaria = "";


$rs = $connection->prepare("SELECT titulo, imagem_principal as imagem, texto, autor, DATE_FORMAT(DATA,'%d/%m/%Y') as data, categoria, ifnull(imagem_secundaria, 0) as imagem_secundaria from postagens where id = :id");
$rs->bindValue(':id', "{$id}");
// $rs = $connection->prepare($sql);


if($rs->execute())
{
    while($registro = $rs->fetch(PDO::FETCH_OBJ))
    {
        $titulo = $registro->titulo ;
        $imagemDestaque = $registro->imagem ;
        $texto = $registro->texto ;
        $autor = $registro->autor;
        $data = $registro->data;
        $categoria = $registro->categoria;
        $imagem_secundaria = $registro->imagem_secundaria;
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
    <title>TV Ventu - Notícias</title>
    <link rel="icon" href="img/favicon.png" type="image/gif">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/css/mdb.min.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    
    <style>
        
        img
        {
            max-width: 100%;
        }
        .img-publicidade
        {
            margin-bottom: 15px;
            max-width: 100%;
            width: 100%;
        }
        .section
        {
            margin-top: 50px;
        }
        h1, h2, h3, h4, h5, h6, p
        {
            font-family: 'Open Sans', sans-serif;
            color: #fff;
        }
        hr
        {
            background-color: #fff;
        }
        .img-destaque
        {
            margin-bottom: 50px;
        }
        p
        {
            margin-bottom: 50px;
            font-size: 1.5rem;
        }
    </style>
    
</head>
    
<body class="animated fadeIn black">
    
    <?php include 'header.php'; ?>
    
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <h1><?php echo $titulo; ?></h1>
                    <h6>Autor: <?php echo $autor;?></h6>
                    <h6>Postado em: <?php echo $data;?></h6>
                    <hr>
                    <div class="text-center">
                        <img class="img-destaque" src="<?php echo $imagemDestaque; ?>"/>
                    </div>
                    <p><?php echo $texto;?></p>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Publicidade</h2>
                            <hr>
                        </div>
                    </div>
                    <?php include "anuncios.php";?>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'footer.php'?>
        
</body>        
</html>