<?php



if(isset($_POST['campoArquivo']))
{    
    
    $arquivoNome = $_FILES['campoArquivo']['name'];
    $arquivoTipo = $_FILES['campoArquivo']['type'];
    $arquivoTamanho = $_FILES['campoArquivo']['size'];
    $arquivoNomeTemp = $_FILES['campoArquivo']['tmp_name'];
    $erro = $_FILES['campoArquivo']['error'];

    
    echo $arquivoNome . '<br>';
    echo $arquivoTipo . '<br>';
    echo $arquivoTamanho . '<br>';
    echo $arquivoNomeTemp . '<br>';
    
}

?>