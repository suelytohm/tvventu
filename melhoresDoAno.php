
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

// INÍCIO POSTAGEM

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
// FINAL POSTAGEM


// INÍCIO CONTADORES
/*try
{ */
    $rs = $connection->prepare("SELECT image_id, image_name, image_description as descricao, id_postagem, categoria FROM tbl_image WHERE id_postagem = :id;");
    $rs->bindValue(':id', "{$id}");
    
    $count1 = 0;
    $saida1 = '';
    
    if($rs->execute())
    {
        while($registro = $rs->fetch(PDO::FETCH_OBJ))
        {
    
            if($count1 == 0)
            {
                $saida1 .= "<li data-target='#carousel-example-2' data-slide-to='" . $count1 . "' class='active'></li>";
            }
            else
            {
                $saida1 .= "<li data-target='#carousel-example-2' data-slide-to='" . $count1 . "'</li>";
            }
            $count1 = $count1 + 1;
        }
    }
/*}
catch(PDOException $e)
{
    echo "Falha: " . $e->getMessage();
    exit();
}
*/
// FINAL CONTADORES


// INÍCIO SLIDE

$saida = '';
$count = 0;

$rs = $connection->prepare("SELECT image_id as id, image_name AS imagem, image_description as descricao, id_postagem, categoria FROM tbl_image WHERE id_postagem = :id ORDER BY id;");
$rs->bindValue(':id', "{$id}");


if($rs->execute())
{
    while($registro = $rs->fetch(PDO::FETCH_OBJ))
    {
        $id = $registro->id;
        $descricao = $registro->descricao;
        $imagem = $registro->imagem;            
        $id_postagem = $registro->id_postagem;
        $categoria = $registro->categoria;  

        if($count == 0)
        {
            $saida .= "<div class='carousel-item active'>";
        }
        else
        {
            $saida .= "<div class='carousel-item'>";
        }
        
        $saida .= "<div class='view'>";
        $saida .= "<img class='d-block w-100' src='imgupload/" . $imagem . "'>";
        // $saida .= "<div class='mask rgba-black-light'></div>";
        $saida .= "</div>";
        $saida .= "<div class='carousel-caption'>";
        $saida .= "<h3 class='h3-responsive'>" . $descricao . "</h3>";
        $saida .= "</div>";
        $saida .= "</div>";
        
        $count = $count + 1;
    }
}

// FINAL SLIDE










?>

<html>
<head>
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title>TV Ventu - Melhores do Ano</title>
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
        .social-icon
        {
            max-width: 50px;
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


                        <!--Carousel Wrapper-->
                        <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
                        <!--Indicators-->
                        <ol class="carousel-indicators">
                            <?php echo $saida1; ?>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <?php echo $saida; ?>
                        </div>
                        <!--/.Slides-->
                        <!--Controls-->
                        <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        <!--/.Controls-->
                        </div>
                        <!--/.Carousel Wrapper-->


                        <?php 
                        if($count == 0)
                        {
                            echo "<img class='img-destaque' src='" . $imagemDestaque . "'/>";
                        }
                        ?>

                        
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

    
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/js/mdb.min.js"></script>
        
        
</body>        
</html>