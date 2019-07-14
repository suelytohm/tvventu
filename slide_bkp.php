<?php

include 'configdb.php';
$contador = 0;

$rs = $connection->prepare("SELECT id, titulo, categoria, imagem_principal as imagem, (SELECT COUNT(*) FROM postagens WHERE tipo = 'Destaque') AS qtddestaques FROM postagens where visivel = 'S' and tipo = 'Destaque'");

if($rs->execute())
{
    
    $contador = 0; 
    $slide = "";
    $bolinhas = "";
    while($registro = $rs->fetch(PDO::FETCH_OBJ))
    {
        
        if($contador == 0)
        {
            $bolinhas = "<li data-target='#carousel-example-2' data-slide-to='" . $contador . "' class='active'></li>";
            $contador = $contador+1;
        }
        else
        {
            $bolinhas .= "<li data-target='#carousel-example-2' data-slide-to='" . $contador . "'></li>";
            $contador = $contador+1;                        
        }

        
        

        $id = $registro->id;
        $titulo = $registro->titulo;
        $imagemDestaque = $registro->imagem;
        $categoria = $registro->categoria;

        
        $slide .= "<a class='carousel-item active' href='" . $categoria . ".php?id=" . $id . "'>";
        $slide .= "<div class='view overlay'>";
        $slide .= "<img class='d-block w-100 img-fluid' src='" . $imagemDestaque . "'>";
        $slide .= "<div class='mask rgba-black-light'></div></div>";
        $slide .= "<div class='carousel-caption'>";
        $slide .= "<h3 class='h3-responsive'>" . $titulo . "</h3></div></a>";
        
        
        
    }
    
}
else
{
    
}

echo "<div id='carousel-example-2' class='carousel slide carousel-fade' data-ride='carousel'>";
echo "<ol class='carousel-indicators'>";
echo $bolinhas;
echo "</ol>";


echo "<div class='carousel-inner' role='listbox'>";
echo $slide;
echo "</div>";
?>


    
  
      


  <a class='carousel-control-prev' href='#carousel-example-2' role='button' data-slide='prev'>
    <span class='carousel-control-prev-icon' aria-hidden='true'></span>
    <span class='sr-only'>Previous</span>
  </a>
  <a class='carousel-control-next' href='#carousel-example-2' role='button' data-slide='next'>
    <span class='carousel-control-next-icon' aria-hidden='true'></span>
    <span class='sr-only'>Next</span>
  </a>
</div>
