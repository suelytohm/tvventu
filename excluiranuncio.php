<?php

include 'configdb.php';
$id = "";
$id = $_REQUEST['id'];


try
{   
    // $sql = "CALL novapostagem(?, ?, ?, ?, ?, ?, ?)";
    $sql = "DELETE FROM anuncios WHERE id = ?";

    $stmt = $connection->prepare($sql);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    
    

    if($stmt->errorCode() != "00000")
    {
        echo $stmt->errorInfo();
    }
    else
    {
        echo "<h3>Anúncio Excluído!</h3><br><br>";
        echo "<a href='adm.php'>Voltar para o site</a>";
    }
}
catch(PDOException $e)
{
    echo "Falha: " . $e->getMessage();
    exit();
}

?>