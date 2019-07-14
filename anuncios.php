<?php

include 'configdb.php';       


try
{
 
    
    $rs = $connection->prepare("SELECT imagem, link as links FROM anuncios WHERE ativo = 'S' order by(id);");

    if($rs->execute())
    {
        while($registro = $rs->fetch(PDO::FETCH_OBJ))
        {
            echo "<div class='row'>";
            echo "<div class='col-md-12'>";
            $imagem = $registro->imagem;
            $links = $registro->links;
            echo "<a href='" . $links . "'><img class='img-publicidade' src='" . $imagem ."' target='_blank'></a>";
            echo "</div>";
            echo "</div>";
            
            
        }
    }
    
    
}
catch(PDOException $e)
{
    exit();
}

?>