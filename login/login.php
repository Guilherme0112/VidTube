<?php
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
    <script src="login.js"></script>
    <link rel="shortcut icon" href="../styles/icons/icon-ligth.png" type="image/x-icon">
    <script src="../styles/jquery-3.7.1.js"></script>
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
                    <a href="#">
                        <i class="fa-solid fa-fire icon-menu"></i>
                        Em Alta
                    </a>
                    <a href="../settings/settings.php" class="">
                        <i class="fa-solid fa-gear icon-menu"></i>
                        Configurações
                    </a>
                    <a href="../comunidade/comunidade.php" class="">
                        <i class="fa-solid fa-inbox icon-menu"></i>
                        Comunidade
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
            <a href="" class="font-nigth effect-text-line">Esqueci minha senha</a>
            <input type="submit" name='submit' id='submit' value="Entrar">
        </form>
    </main>
    <script>
        document.querySelector('.icon').addEventListener('click', function () {
            document.querySelector('.menu').classList.toggle('show-menu');
        });     

        // verification if email exist

        $(function(){
            $('#submit').submit(function(e){
                e.preventDefault();
                var email = $('.email').val();
                $.ajax({
                    url: 'login.php',
                    method: 'POST',
                    data: {emailUser: email},
                    success: function(e){
                        console.log(e)
                    }, error: function(e){
                        console.log(e)
                    }
                })
            })
        })  
    </script>
</body>
</html>