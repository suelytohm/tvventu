

<?php

include 'configdb.php';       

?>


<html>
<head>
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title>TV Ventu - Vídeos</title>
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
        .imhead
        {
            width: 100%;
        }
    </style>
    
</head>
    <body class="animated fadeIn black">
        <!--Navbar-->
        
        
    <?php include 'header.php'; ?>
        
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>Vídeos</h1>
                                <!--img class="imhead" src="img/melhores.jpg"-->
                                <hr>
                            </div>
                        </div>
                        
                        <!-- FINAL DESTAQUES  -->
                        <!-- INÍCIO NOTÍCIAS  -->
                        
                        <div class="row">
                            <div class="col-md-12 section">
                                <!--div class="row">
                                    <div class="col-md-6">
                                        <h2>Notícias</h2>
                                        <hr>
                                    </div>
                                </div-->
                                <div class="row">
                                    <?php // include "categoriamelhoresdoano.php";?>
                                </div>
                            </div>                
                        </div>                        
                        <!-- FINAL NOTÍCIAS  -->
                        
                        
                        <!-- INÍCIO CATEGORIAS  -->
                        
                        <!-- FINAL CATEGORIAS  -->                        

                    </div>
                    <div class="col-md-12">
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