

<?php

include 'configdb.php';       



$destaque1Id = "1";
$destaque2Id = "2";
$destaque3Id = "3";


$destaque1Categoria = "noticias";
$destaque2Categoria = "noticias";
$destaque3Categoria = "noticias";


$destaque1Titulo = "Sem reforma, déficit das previdências estaduais em 2060 deve ser 4 vezes maior que o de 2013, aponta estudo";
$destaque2Titulo = "Hamilton mantém o domínio e vence a quinta no ano após punição polêmica a Vettel";
$destaque3Titulo = "Reabertura de fronteira entre Venezuela e Colômbia tem tráfego intenso de pessoas";

$destaque1Img = "https://jornaldebrasilia.com.br/wp-content/uploads/2019/04/rodrigo-maia.jpg";
$destaque2Img = "https://s2.glbimg.com/oXUo0qLRnT9MN3_7tB3AQO4xlnA=/0x0:3393x2406/1600x0/smart/filters:strip_icc()/s.glbimg.com/es/ge/f/original/2019/06/09/063_1154844080.jpg";
$destaque3Img = "https://s2.glbimg.com/v0E_6HA5o42M4KYT_9zboNJW5JA=/0x0:5235x3490/1000x0/smart/filters:strip_icc()/i.s3.glbimg.com/v1/AUTH_59edd422c0c84a879bd37670ae4f538a/internal_photos/bs/2019/j/g/0PJyAvRGG8ikvsyvkbFw/venezuela-simon-bolivar-bridge-reuters-carlos-eduardo-ramirez.jpg";



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
    
    
        <script type="text/javascript">
            var x = document.getElementById("myAudio");
            x.load();
            console.log("entrou aqui");
            
        </script>
    
    
    <style>
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
        .carousel-caption
        {
            padding: 15px;
            background-color: rgba(0,0,0,0.6);
        }
        .view
        {
            height: 500px;
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
        
        #radi
        {
            width: 100%: 
        }
        
        .card-title
        {
            color: #000;
        }
        .card
        {
            margin-top: 15px;
            margin-bottom: 50px;
        }
        .card-img-top
        {
            max-height: 300px;
        }
        audio 
        { 
            max-width: 100%; 
        }
        .social-icon
        {
            max-width: 50px;
        }
    </style>
    
</head>
    <body class="animated fadeIn black">
        <!--Navbar-->
        
        
    <?php include 'header.php'; ?>
        
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>Destaques</h1>
                                <hr>

                                <?php include "slide_destaque.php"; ?>                      
                            </div>
                        </div>
                        
                        <!-- FINAL DESTAQUES  -->
                        <!-- INÍCIO NOTÍCIAS  -->
                        
                        <div class="row">
                            <div class="col-md-12 section">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h2>Notícias</h2>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php include "categorias.php";?>
                                </div>
                            </div>                
                        </div>                        
                        <!-- FINAL NOTÍCIAS  -->
                        
                        
                        <!-- INÍCIO CATEGORIAS  -->
                        
                        <!-- FINAL CATEGORIAS  -->                        

                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>Publicidade</h1>
                                <hr>
                            </div>
                        </div>
                            
                        <?php include "anuncios.php";?>
                        
                    </div>
                </div>
            </div>
        </div>
        
        
        <?php include 'footer.php'?>
        
        <!-- Footer -->
        <!--footer class="page-footer font-small black fixed-bottom">

          <!-- Copyright -->
          <!--div class="footer-copyright text-center py-3">© Copyright: 2019 - TV Ventu | Desenvolvido por: 
            <a href="https://www.instagram.com/t22suelytohm/">Suelytohm Oliveira</a>
          </div -->
          <!-- Copyright -->

        <!--/footer-->
        <!-- Footer -->
        

        
        
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