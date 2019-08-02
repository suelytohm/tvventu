<?php

include "configdb.php";

$titulo = "";
$imagemDestaque = "";
$texto = "";
$autor = "";
$data = "";
$categoria = "";


    if(isset($_REQUEST["carregar"]))
    {
        
        $id = $_REQUEST['id'];

        $rs = $connection->prepare("SELECT titulo, texto, autor, categoria FROM postagens WHERE id = :id");
        $rs->bindValue(':id', "{$id}");
        
        if($rs->execute())
        {
            while($registro = $rs->fetch(PDO::FETCH_OBJ))
            {
                $titulo = $registro->titulo ;
                $texto = $registro->texto ;
                $autor = $registro->autor;
                $categoria = $registro->categoria;
            }
        }
        else
        {
            echo "Falha";
        }
    }



    if(isset($_REQUEST["atualizar"]) && $_REQUEST["atualizar"] == "true")
    {
        $erro = 0;
        
        
        $titulo = $_REQUEST['titulo'];
        $texto = $_REQUEST['texto'];
        $autor = $_REQUEST['autor'];
        $categoria = $_REQUEST['categoria'];
        $tipo = $_REQUEST['tipo'];
        $id = $_REQUEST['id'];
        
        $categoria = $_REQUEST['categoria'];

        try
        {   
            // $sql = "CALL novapostagem(?, ?, ?, ?, ?, ?, ?)";
            $sql = "UPDATE postagens SET titulo = ?, texto = ?, autor = ?, categoria = ?, tipo = ? WHERE id = ?;";

            $stmt = $connection->prepare($sql);
            $stmt->bindParam(1, $titulo);
            $stmt->bindParam(2, $texto);
            $stmt->bindParam(3, $autor);
            $stmt->bindParam(4, $categoria);
            $stmt->bindParam(5, $tipo);
            $stmt->bindParam(6, $id);
            $stmt->execute();            
            
            /*
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(1, $_REQUEST['titulo']);
            $stmt->bindParam(2, $_REQUEST['texto']);
            $stmt->bindParam(3, $_REQUEST['autor']);
            $stmt->bindParam(4, $_REQUEST['categoria']);
            $stmt->bindParam(5, $_REQUEST['tipo']);
            $stmt->bindParam(6, $id);
            $stmt->execute(); */

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
        header("Location gravacao_sucesso.php?acao=postagens&tipo=editar&id=" . $id . "&categoria=" . $categoria ."");
        
        if($erro !== 0)
        {
            echo $erro;
        }
    }

?>



<html>
    <head>
        <title>Editar Postagem</title>
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
                    <h1 class="display-4">Editar Postagem</h1>   
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!--form method="post" action="novapostagem.php" enctype="multipart/form-data"-->
                    <form method="post" action="?atualizar=true" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
                                <label for="titulo">Titulo</label><br>
                                <input class="form-control" type="text" name="titulo" id="titulo" required value="<?php echo $titulo;?>">
                                <br>
                                <label for="texto">Texto</label><br>
                                <textarea class="form-control" name="texto" id="texto"><?php echo $texto;?></textarea><br>                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="autor">Autor</label>
                                <input class="form-control" type="text" name="autor" id="autor" required value="<?php echo $autor;?>">
                                <br>                
                                <label for="categoria">Categoria</label>
                                <select class="form-control" name="categoria" id="categoria">
                                  <option value="melhoresDoAno">Melhores Do Ano</option>                                    
                                  <option value="noticias">Notícias</option>
                                  <option value="esportes">Esportes</option>
                                  <option value="politica">Política</option>
                                  <option value="famosos">Famosos</option>
                                  <option value="eventos">Eventos</option>
                                </select>                            
                            </div>
                            <div class="col-md-6">
                                <label for="tipo">Tipo</label>
                                <select class="form-control" name="tipo" id="tipo">
                                  <option value="Normal">Normal</option>
                                  <option value="Destaque">Destaque</option>
                                </select>                     
                                <br><br>
                                <a href="alterarimagem.php?id=<?php echo $id; ?>" class="btn btn-success">Alterar capa</a>
                                <a href="imgupload/index.php?id=<?php echo $id; ?>&categoria=postagens" class="btn btn-info">Gerenciar Slider</a>                                
                                <!--label>Imagem</label>
                                <input class="form-control" type="file" name="campoArquivo"-->
                                <br>                                
                            </div>
                        </div>
                        <input class="btn btn-primary" type="submit" value="Alterar">
                        <a href="excluirpostagem.php?id=<?php echo $id; ?>" class="btn btn-danger">Excluir</a>
                        <a href="adm.php" class="btn btn-success">Voltar</a>
                    </form> 
                </div>
            </div>
        </div>
    </body>
</html>