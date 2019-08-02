<?php

include "configdb.php";

$r = "";
if(isset($_REQUEST['id']))
{

    $id = $_REQUEST['id'];
    
    if(isset($_REQUEST["envio"]) && $_REQUEST["envio"] == "true")
    {
        $erro = 0;
        
        if(isset($_FILES["campoArquivo"]))
        {
            $arquivoNome = $_FILES["campoArquivo"]["name"];
            $arquivoTipo = $_FILES["campoArquivo"]["type"];
            $arquivoTamanho = $_FILES["campoArquivo"]["size"];
            $arquivoNomeTemp = $_FILES["campoArquivo"]["tmp_name"];
            $erro = $_FILES["campoArquivo"]["error"];
            
            if($erro == 0)
            {
                if(is_uploaded_file($arquivoNomeTemp))
                {
                    if(move_uploaded_file($arquivoNomeTemp, "img/postagens/".$arquivoNome))
                    {
                        $destino = "img/postagens/".$arquivoNome;
                        
                        try
                        {   
                            // $sql = "CALL novapostagem(?, ?, ?, ?, ?, ?, ?)";
                            $sql = "UPDATE postagens SET imagem_principal = ? WHERE id = ?;";

                            $stmt = $connection->prepare($sql);
                            $stmt->bindParam(1, $destino);
                            $stmt->bindParam(2, $id);                            
                            // $stmt->bindParam(6, $_REQUEST['imagem_principal']);
                            $stmt->execute();

                            if($stmt->errorCode() != "00000")
                            {
                                echo $stmt->errorInfo();
                            }
                            $r = "ok";
                        }
                        catch(PDOException $e)
                        {
                            echo "Falha: " . $e->getMessage();
                            exit();
                        }
                        // header("Location: gravacao_sucesso.php?acao=postagens&tipo=novoregistro");
                    }
                    else
                    {
                        $erro = "Falha ao mover o arquivo (permissão de acesso, caminho inválido)";
                    }
                }
                else
                {
                    $erro = "Erro no envio: arquivo não recebido com sucesso.";
                }
            }
            else
            {
                $erro = "Erro no envio: " . $erro;
            }
        }
        else
        {
            $erro = "Arquivo enviado não encontrado.";
        }
        
        if($erro !== 0)
        {
            echo $erro;
            exit();
        }
    }
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
            margin-top: 25px;
        }
    </style>
    
</head>
    <body class="animated fadeIn black">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <?php 
                    if($r == "ok")
                    {
                        echo "<h2>Imagem Alterada!</h2><br><br><a href='adm.php' class='btn btn-primary'>Voltar</a>"; 
                    }
                    else
                    {
                        $form = "<h2>Alterar Imagem</h2>";
                        $form .= "<form method='post' action='?envio=true' enctype='multipart/form-data'>";
                        $form .= "<input type='hidden' value='" . $id . "' name='id'>";
                        $form .= "<label>Imagem</label>";
                        $form .= "<input class='form-control' type='file' name='campoArquivo'>";
                        $form .= "<input class='btn btn-primary' type='submit' value='Alterar'>";
                        $form .= "<br><a href='adm.php' class='btn btn-danger'>Voltar</a>";
                        $form .= "</form>"; 
                        
                        echo $form;
                    }
                    
                    
                    
                    ?>

                    
                        
                        
                        
                    

                </div>
            </div>
        </div>
    </body>
</html>