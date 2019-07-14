<?php

include 'configdb.php';

function indicadores($connection)
{
    $rs = $connection->prepare("SELECT id, titulo, imagem_principal as imagem FROM postagens WHERE tipo = 'Destaque' AND visivel = 'S' ORDER BY id DESC LIMIT 5;");

    $count = 0;
    $saida = '';

    if($rs->execute())
    {
        while($registro = $rs->fetch(PDO::FETCH_OBJ))
        {

            if($count == 0)
            {
                $saida .= "<li data-target='#carousel-example-2' data-slide-to='" . $count . "' class='active'></li>";
            }
            else
            {
                $saida .= "<li data-target='#carousel-example-2' data-slide-to='" . $count . "'</li>";
            }
            $count = $count + 1;
        }
    }
    return $saida;
}


function slide($connection)
{
    $saida = '';
    $count = 0;
    
    $rs = $connection->prepare("SELECT id, titulo, categoria, imagem_principal as imagem FROM postagens WHERE tipo = 'Destaque' AND visivel = 'S' ORDER BY id DESC LIMIT 5;");

    if($rs->execute())
    {
        while($registro = $rs->fetch(PDO::FETCH_OBJ))
        {
            $id = $registro->id;
            $titulo = $registro->titulo;
            $imagem = $registro->imagem;            
            $categoria = $registro->categoria;  

            if($count == 0)
            {
                $saida .= "<a href='" . $categoria . ".php?id=" . $id . "' class='carousel-item active'>";
            }
            else
            {
                $saida .= "<a href='" . $categoria . ".php?id=" . $id . "' class='carousel-item'>";
            }
            
            $saida .= "<div class='view'>";
            $saida .= "<img class='d-block w-100' src='" . $imagem . "'>";
            //$saida .= "<div class='mask rgba-black-light'></div>";
            $saida .= "</div>";
            $saida .= "<div class='carousel-caption'>";
            $saida .= "<h3 class='h3-responsive'>" . $titulo . "</h3>";
            $saida .= "</div>";
            
            $count = $count + 1;
        }
    }
    return $saida;
}

?>

<!--Carousel Wrapper-->
<div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
  <!--Indicators-->
  <ol class="carousel-indicators">
    <?php echo indicadores($connection); ?>
  </ol>
  <div class="carousel-inner" role="listbox">
    <?php echo slide($connection); ?>
  </div>
  <!--/.Slides-->
  <!--Controls-->
  <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  <!--/.Controls-->
</div>
<!--/.Carousel Wrapper-->