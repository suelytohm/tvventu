<?php

include 'configdb.php';   

$rs = $connection->prepare("SELECT id, titulo, imagem_principal as imagem, date_format(data, '%d/%m/%Y') data, upper(categoria) categoria FROM postagens WHERE tipo = 'Normal' and visivel = 'S' order by(id) desc limit 50;");

if($rs->execute())
{
    // Categoria vazia, caso a categoria seja diferente do retorno do select, ele exibe a nova categoria
    $categoriaAntiga = "";
    while($registro = $rs->fetch(PDO::FETCH_OBJ))
    {
        
        $id = $registro->id;
        $imagem = $registro->imagem;
        $titulo = $registro->titulo;
        $categoria = $registro->categoria;
        $data = $registro->data;
        
        $cor = "primary";

        $categoriaAntiga = $categoria;

        if($categoria == "NOTICIAS")
        {
            $categoria = "Notícias";
            $cor = "danger";
        }  

        if($categoria == "MELHORESDOANO")
        {
            $categoria = "Melhores Do Ano";
            $cor = "success";
        }  

        if($categoria == "EVENTOS")
        {
            $categoria = "Eventos";
            $cor = "warning";
        }          

        echo "<div class='col-md-6'>";
        // echo "<a href='" . strtolower($categoriaAntiga) .  ".php?id=" . $id . "' class='card'>";
        echo "<div class='card'>";
        if(strlen($imagem) > 0 || $imagem != null)
        {
            echo "<img class='card-img-top' src='" . $imagem . "' alt='" . $titulo . "'>";
        }
        //echo "<div class='card-body'>";
        //echo "<p style='color:#000;'>" . $data . "</p><h5 class='card-title'>" . $titulo . "</h5> <span class='badge badge-pill badge-" . $cor . "'>" . $categoria . "</span>";
        //echo "</div>";
        echo "</div>";                             
        // echo "</a>";                             
        echo "</div>";
    }
}
else
{
    echo "Falha";
}
?>