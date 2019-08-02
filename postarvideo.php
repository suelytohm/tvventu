<?php

include 'configdb.php';

$aovivo = "";

if(isset($_REQUEST['postar']) && $_REQUEST['postar'])
{
    try
    {    

            

        $sql = "INSERT INTO videos (video, data, visivel) values (?, curdate(), 'S')";
        
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(1, $_REQUEST['link']);
        $stmt->execute();
        
        if($stmt->errorCode() != "00000")
        {
            echo 'Vídeo Salvo!';
            echo $stmt->errorInfo();
        }
        echo "Vídeo Salvo!";
        echo "<br><a href='adm.php'>Voltar para o site</a>";
        exit();



    }
    catch(PDOException $e)
    {
        echo "Falha: " . $e->getMessage();
        exit();
    }
}


?>

<html>
    <head>
        <title>Postar Vídeo</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="icon" href="img/favicon.png" type="image/gif">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <!-- Bootstrap core CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/css/mdb.min.css" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">        
        
        <style>
            .container
            {
                margin-top: 50px;
            }
            p, h1, h2, h3, h4, h5, h6, label
            {
                color: #fff;
            }
            hr
            {
                background-color: #fff;
            }
            .encerrar
            {
                margin-top: 70px;
            }
        </style>
    </head>
    <body class="animated fadeIn black">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img src="img/logo2.png">
                    <h1 class="display-3">Postar Vídeo</h1>   
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <form method="post" action="?postar=true">
                        <label for="link">Copie o link do vídeo como o exemplo:</label>
                        <img src="img/link.jpg"><br><br>
                        <label>Cole abaixo:</label>
                        <input class="form-control" type="text" name="link" id="link" maxlength="11" required>
                        <br>
                        <!--label for="link">Ao vivo agora?</label>
                        <input type="text" name="aovivo" id="aovivo" value="S"-->
                        <input class="btn btn-danger" type="submit" value="Postar">
                        <a href="adm.php" class="btn btn-primary">Voltar</a>
                        <a href="index.php" class="btn btn-success">Ir para o Site</a>
                    </form> 
                </div>
                <div class="col-md-7">

                </div>
            </div>
        </div>
    </body>
</html>