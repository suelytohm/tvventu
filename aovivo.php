<?php

$video = "https://www.youtube.com/embed/d3_gK9MrXo8";
/* src="https://www.youtube.com/watch?v=Fk4CGIkUF3U?rel=0&autoplay=1" */

try
{
    include 'configdb.php';
}
catch(PDOException $e)
{
    echo "Falha: " . $e->getMessage();
    exit();
}

$rs = $connection->prepare("SELECT link FROM aovivo WHERE aovivo = 'S';");

if($rs->execute())
{
    while($registro = $rs->fetch(PDO::FETCH_OBJ))
    {
        $video = "https://www.youtube.com/embed/" . $registro->link ;
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
    <title>TV Ventu</title>
    <link rel="icon" href="img/favicon.png" type="image/gif">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/css/mdb.min.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    
    <style>
        h1, h2, h3, h4, h5, h6, p
        {
            font-family: 'Open Sans', sans-serif;
            color: #fff;
        }
        h1
        {
            font-weight: bold;
            font-size: 4.5rem;
        }
        hr
        {
            background-color: #fff;
        }
        .aovivo
        {
            height: 130px;
            background-color: #FF4F48;
            margin-bottom: 50px;
            text-align: center;
            padding: 20px;
        }
    </style>
    
</head>
    <body class="animated fadeIn black">
        
    <?php include 'header.php'; ?>
        
        
        <div class="section animated bounceInUp">
            
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 aovivo">
                            <h1>AO VIVO</h1>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="container">
                <div class="col-md-12">
                    <iframe width="100%" height="500" src="<?php echo $video; ?>?rel=0&autoplay=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        
        
        
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