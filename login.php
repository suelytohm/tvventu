<?php

include 'configdb.php';
session_start();

if(isset($_POST['btn-entrar']))
{
    //$erros = array();
    $erros = "";
    $login = $_POST['login'];
    $senha = md5($_POST['senha'] . "123");
    
    if(empty($login) || empty($senha))
    {
        $erros .= "Usuário e senha não pode ser vazios!";
    }
    else
    {   
        $rs = $connection->prepare("SELECT nome, login, senha senha FROM usuarios where login = :login;");
        $rs->bindValue(':login', "{$login}");        
        
        $count = 0;
        if($rs->execute())
        {
            while($registro = $rs->fetch(PDO::FETCH_OBJ))
            {
                $nomeBanco = $registro->nome;
                $loginBanco = $registro->login;
                $senhaBanco = $registro->senha;        
                
                if($senha == $senhaBanco)
                {
                    $_SESSION['logado'] = true;
                    $_SESSION['usuario'] = $nomeBanco;
                    header('Location: adm.php');
                    echo "Usuario autorizado";
                    $count = 1;
                }
                else
                {
                    $erros .= "Senha incorreta";
                } 
                
            }
            if($count == 0)
            {
                $erros .= "Usuário não encontrado";                
            }
        }
        else
        {
            $erros .= "Usuário não encontrado!";
        }        
        
        
    }
}
?>
<html>
<head>
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title>Painel Administrativo - TV Ventu</title>
    <link rel="icon" href="img/favicon.png" type="image/gif">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/css/mdb.min.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <style>
        .titulo, hr
        {
            margin-top: 50px;
            margin-bottom: 50px;
        }
        
        .btn
        {
            width: 100%;
        }
        
        p, h1, h2, h3, h4, h5, h6, label
        {
            text-align: center;
            
        }
        
        hr
        {
            background-color: #fff;
        }
    </style>
    
</head>
<body class="animated fadeIn">
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="titulo">Login</h2>    
                
                
                <?php 
                    if(!empty($erros))
                    {
                        echo "<div class='alert alert-danger' role='alert'>";
                            echo $erros;  
                        echo "</div>";
                                    
                    }
                
                ?>
                
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Login:</label><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input class="form-control" type="text" name="login" required><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Senha:</label><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input class="form-control" type="password" name="senha" required><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary" type="submit" name="btn-entrar">Entrar</button>
                        </div>
                    </div>                    
                </form>       
            </div>
            <div class="col-md-3">
            </div>            
        </div>
    </div>
    
    
    
    
</body>
</html>