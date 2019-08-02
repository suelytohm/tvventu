<?php

include 'configdb.php';   

$rs = $connection->prepare("SELECT id, titulo, imagem_principal as imagem, categoria FROM postagens WHERE tipo = 'Normal' and visivel = 'S' order by(id) desc limit 5;");

if($rs->execute())
{
    // Categoria vazia, caso a categoria seja diferente do retorno do select, ele exibe a nova categoria

    while($registro = $rs->fetch(PDO::FETCH_OBJ))
    {
        $id = $registro->id;
        $imagem = $registro->imagem;
        $titulo = $registro->titulo;
        $categoria = $registro->categoria;
        
        echo "<div class='col-md-6'>";
        echo "<a href='" . $categoria .  ".php?id=" . $id . "' class='card'>";
        echo "<img class='card-img-top' src='" . $imagem . "' alt='" . $titulo . "'>";
        echo "<div class='card-body'>";
        echo "<h4 class='card-title'>" . $titulo . "</h4>";
        echo "</div>";
        echo "</a>";                             
        echo "</div>";
        
    }
}
else
{
    echo "Falha";
}


?>



