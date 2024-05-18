<?php
 
    /*
    include_once('../database/conexao.php');
    $emailInput = $_POST['email'] ?? '';
    $passInput = $_POST['senha'] ?? '';
    if(isset($email) && isset($passInput)){

        $cursor = "SELECT * FROM usuarios WHERE email = '$emailInput';";
        $response = $conexao->query($cursor);
        $resultMySQL = $response->fetch_assoc();

        $emailMySQL = $resultMySQL['email'];
        $passMySQL = $resultMySQL['senha'];
 
    }
*/
    session_start();
    if(isset($_SESSION['email'])){

        header('Location: ../index.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="../styles/model-of-page.css">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <script defer src="login.js"></script>
    <link rel="shortcut icon" href="/project/styles/icon.png" type="image/x-icon">
    <title>Login</title>
</head>
<body>
    <header>
        <div class="header-one">

        </div>
        <div class="header-two">
            <i class="fas fa-bars icon"></i>
            <div class="menu">
                <div style="margin-top: 40px;">
                    <a href="../index.php" class="select">
                        <i class="fa-solid fa-house icon-menu"></i>
                        Início
                    </a>
                    <a href="../lives/lives.php">
                        <i class="fa-solid fa-tower-broadcast icon-menu"></i>
                        Lives
                    </a>
                    <a href="#">
                        <i class="fa-solid fa-fire icon-menu"></i>
                        Em Alta
                    </a>
                    <a href="../settings/settings.php" class="">
                        <i class="fa-solid fa-gear icon-menu"></i>
                        Configurações
                    </a>
                    <a href="../register/register.php">
                        <i class="fa-solid fa-user icon-menu"></i>
                        Criar Conta
                    </a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <form action="config.php" method="post">
            <label for="email">E-mail:</label>
            <input type="email" name="email" class="email placeholder-center" value='' placeholder="Digite seu e-mail">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" class="senha placeholder-center" value='' placeholder="Digite sua senha">
            <input type="submit" name='submit' value="Entrar">
        </form>
    </main>
    
</body>
</html>