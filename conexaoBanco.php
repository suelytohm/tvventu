<?php

if(!isset($_SESSION['logado']))
{
    header('Location: login.php');
}

try
{
    include "configdb.php";
    
    if(!isset($_REQUEST['link']))
    {
        header('Location: postaovivo.php');
    }
    
    // $sql = "INSERT INTO aovivo (data, link, aovivo) values (curdate(), ?, ?)";
    $sql = "CALL aovivo(?)";
    
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(1, $_REQUEST['link']);
    $stmt->execute();
    
    if($stmt->errorCode() != "00000")
    {
        echo 'Link ao vivo!';
        echo $stmt->errorInfo();
    }
    echo "Link ao vivo!";
    echo "<br><a href='index.php'>Voltar para o site</a>";
}
catch(PDOException $e)
{
    echo "Falha: " . $e->getMessage();
    exit();
    
}

?>