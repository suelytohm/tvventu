<?php

include "configdb.php";

/*
if(!isset($_SESSION['logado']))
{
    header('Location: login.php');
} */


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
                    if(move_uploaded_file($arquivoNomeTemp, "img/anuncios/".$arquivoNome))
                    {
                        $destino = "img/anuncios/".$arquivoNome;
                        
                        try
                        {   
                            // $sql = "CALL novapostagem(?, ?, ?, ?, ?, ?, ?)";
                            $sql = "INSERT INTO anuncios (nome, observacao, imagem, ativo, link, datainicio) VALUES (?, ?, ?, ?,  ?, curdate())";

                            $stmt = $connection->prepare($sql);
                            $stmt->bindParam(1, $_REQUEST['empresa']);
                            $stmt->bindParam(2, $_REQUEST['observacao']);
                            $stmt->bindParam(3, $destino);
                            $stmt->bindParam(4, $_REQUEST['ativo']);
                            $stmt->bindParam(5, $_REQUEST['link']);
                            // $stmt->bindParam(6, $_REQUEST['imagem_principal']);
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
                        include 'mensagem_sucesso.php';
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
        }
    }

?>



<html>
    <head>
        <title>Novo Anúncio</title>
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
            textarea
            {
                min-height: 300px;
            }
        </style>
    </head>
    <body class="animated fadeIn black">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img src="img/logo2.png">
                    <h1 class="display-4">Novo Anúncio</h1>   
                </div>
            </div>
            
            
            
            <div class="row">
                <div class="col-md-12">
                    <!--form method="post" action="novapostagem.php" enctype="multipart/form-data"-->
                    <form method="post" action="?envio=true" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="empresa">Empresa</label><br>
                                <input class="form-control" type="text" name="empresa" id="empresa" required>
                                <br>
                                <label for="observacao">Observação</label><br>
                                <textarea class="form-control" name="observacao" id="observacao"></textarea><br>                       
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="link">Link</label>
                                <input class="form-control" type="text" name="link" id="link" required>
                                <br>                
                                <label for="ativo">Anúncio Ativo</label>
                                <select class="form-control" name="ativo" id="ativo">
                                  <option value="S">Sim</option>
                                  <option value="N">Não</option>
                                </select>                            
                            </div>
                            
                                                  
                            <div class="col-md-6">
                                <label>Imagem</label>
                                <input class="form-control" type="file" name="campoArquivo">
                                <br>                                
                            </div>
                        </div>
                        <input class="btn btn-danger" type="submit" value="Postar">
                        <a href="adm.php" class="btn btn-primary">Voltar</a>
                        <a href="index.php" class="btn btn-success">Ir para o Site</a>
                    </form> 
                </div>
            </div>
        </div>
    </body>
</html>