<?php

include "configdb.php";

if(!isset($_SESSION['logado']))
{
    header('Location: login.php');
}

if(!isset($_REQUEST['titulo']))
{
    echo "Título não informado!";
    exit();
}

if(!isset($_REQUEST['texto']))
{
    echo "Texto não informado!";
    exit();
}


if(!isset($_REQUEST['autor']))
{
    echo "Autor não informado!";
    exit();
}


if(!isset($_REQUEST['categoria']))
{
    echo "Categoria não informada!";
    exit();
}


$erro = 0;

if(isset($_POST['campoArquivo']))
{    
    
    
    $arquivoNome = $_FILES['campoArquivo']['name'];
    $arquivoTipo = $_FILES['campoArquivo']['type'];
    $arquivoTamanho = $_FILES['campoArquivo']['size'];
    $arquivoNomeTemp = $_FILES['campoArquivo']['tmp_name'];
    $erro = $_FILES['campoArquivo']['error'];

    $destino = "img/postagens/" . basename($_FILES['campoArquivo']['name']);
    if(move_uploaded_file($_FILES['image']['tmp_name'], $destino))
    {
        $msg = "Postagem realizada com sucesso!";
    }
    else
    {
        $msg = "Postagem com erro no envio da imagem!";
        exit();
    }
}
else
{
    $erro = "Arquivo não encontrado!";
}

if($erro != 0)
{
    echo $erro;
}

try
{   
    // $sql = "CALL novapostagem(?, ?, ?, ?, ?, ?, ?)";
    
    $sql2 = "CALL destaques();";
    
    $sql = "INSERT INTO postagens (titulo, texto, autor, categoria, visivel, tipo, imagem_principal, data) VALUES (?, ?, ?, ?, 'S', ?, ?, curdate())";
    
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(1, $_REQUEST['titulo']);
    $stmt->bindParam(2, $_REQUEST['texto']);
    $stmt->bindParam(3, $_REQUEST['autor']);
    $stmt->bindParam(4, $_REQUEST['categoria']);
    $stmt->bindParam(5, $_REQUEST['tipo']);
    $stmt->bindParam(6, $destino);
    // $stmt->bindParam(6, $_REQUEST['imagem_principal']);
    $stmt->execute();
    
    if($stmt->errorCode() != "00000")
    {
        echo $stmt->errorInfo();
    }
    
    $stmt2 = $connection->prepare($sql2);
    $stmt2->execute();
    if($stmt2->errorCode() != "00000")
    {
        echo $stmt->errorInfo();
    }
    echo $msg;
}
catch(PDOException $e)
{
    echo "Falha: " . $e->getMessage();
    exit();
    
}

?>