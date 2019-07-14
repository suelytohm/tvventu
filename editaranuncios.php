<?php

include "configdb.php";



    if(isset($_REQUEST["id"]))
    {
        $id = $_REQUEST["id"];
        
        $rs = $connection->prepare("SELECT id, nome, observacao, imagem, ativo, link as links, DATE_FORMAT(datainicio, '%d/%m/%y') AS datainicio FROM anuncios where id = :id");
        $rs->bindValue(':id', "{$id}");

        if($rs->execute())
        {
            while($registro = $rs->fetch(PDO::FETCH_OBJ))
            {
                $id = $registro->id;
                $nome = $registro->nome;
                $observacao = $registro->observacao;
                $imagem = $registro->imagem;
                $ativo = $registro->ativo;
                $links = $registro->links;
                $datainicio = $registro->datainicio;
            }
        }
    }


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
                            $sql = "UPDATE anuncios SET nome = ?, observacao = ?, imagem = ?, ativo = ?, link = ? WHERE id = ?";

                            $stmt = $connection->prepare($sql);
                            $stmt->bindParam(1, $_REQUEST['empresa']);
                            $stmt->bindParam(2, $_REQUEST['observacao']);
                            $stmt->bindParam(3, $destino);
                            $stmt->bindParam(4, $_REQUEST['ativo']);
                            $stmt->bindParam(5, $_REQUEST['link']);
                            $stmt->bindParam(6, $id);
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
        <title>Editar Anúncio</title>
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
                    <h1 class="display-4">Editar Anúncio</h1>   
                </div>
            </div>
            
            
            
            <div class="row">
                <div class="col-md-12">
                    <!--form method="post" action="novapostagem.php" enctype="multipart/form-data"-->
                    <form method="post" action="?envio=true" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="empresa">Empresa</label><br>
                                <input class="form-control" type="text" name="empresa" id="empresa" required value="<?php echo $nome;?>">
                                <br>
                                <label for="observacao">Observação</label><br>
                                <textarea class="form-control" name="observacao" id="observacao"><?php echo $observacao; ?></textarea><br>                       
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="link">Link</label>
                                <input class="form-control" type="text" name="link" id="link" required value="<?php echo $links; ?>">
                                <br>                
                                
                                <?php 
                                
                                if($ativo == "S")
                                {
                                    echo "<a href='desativaranuncio.php?id=" . $id . "' class='btn btn-danger'>DESATIVAR</a>";
                                }
                                else
                                {
                                    echo "<a href='ativaranuncio.php?id=" . $id . "' class='btn btn-success'>ATIVAR</a>";
                                }
                                ?>
                                
                            </div>
                            
                            <div class="col-md-6">
                                <label>Imagem</label>
                                <input class="form-control" type="file" name="campoArquivo">
                                <br>                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input class="btn btn-success" type="submit" value="Alterar">
                                <a href="excluiranuncio.php?id=<?php echo $id;?>" class="btn btn-danger">Excluir</a>
                                <a href="adm.php" class="btn btn-primary">Voltar</a>                            
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </body>
</html>