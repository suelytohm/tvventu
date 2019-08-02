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
try
{
        $id = $_REQUEST['id'];
        $sql = "DELETE FROM postagens WHERE id = ?;";

        $stmt = $connection->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
    
        if($stmt->errorCode() != "00000")
        {
            echo $stmt->errorInfo();
        }
}
catch(PDOException $e)
{
    echo "Falha: " . $e->getMessage();
    exit();
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
        .btn
        {
            margin-top: 20px;
            max-width: 50%;
        }
    </style>
    
</head>
    <body class="animated fadeIn black">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>Postagem Excluída!</h2>
                    <a href="adm.php" class="btn btn-success">Voltar</a>
                </div>
            </div>
        </div>
    </body>
</html>