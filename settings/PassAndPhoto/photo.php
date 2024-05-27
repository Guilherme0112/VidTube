<?php
include_once('../../database/conexao.php');
     if(isset($_SESSION['email']) == true){
        header('Location: ../../index.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/model-of-page.css">
    <link rel="shortcut icon" href="../../styles/icons/icon-ligth.png" type="image/x-icon">
    <link rel="stylesheet" href="../../fontawesome-free-6.5.1-web/css/all.min.css">
    <title>Foto de Perfil</title>
</head>
<body>
    <header>
        <div class="header-two">
            <i class="fas fa-bars icon" style="position: absolute; right: 0px; top: 13px;"></i>
            <div class="menu">
                <div style="margin-top: 40px;">
                    <a href="../../settings/settings.php" class="">
                        <i class="fa-solid fa-gear icon-menu"></i>
                        Configurações
                    </a>
                    <a href='../../profile/profile.php'>
                        <i class='fa-solid fa-user icon-menu'></i>
                        Seu Perfil
                    </a>
                    <a href='../../profile/goOut.php' class='close-btn font-nigth' title='Sair do Perfil'>
                        Sair
                    </a>
                </div>
            </div>
        </div>
    </header>
    <form action="" method="post">
        <label for="photo"></label>
        <input type="file" name="photo" class="photo">
    </form>
    <script>
        document.querySelector('.icon').addEventListener('click', function(){
            document.querySelector('.menu').classList.toggle('show-menu');
        })
    </script>
</body>
</html>