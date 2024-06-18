<?php
    session_start();
    include_once('../database/conexao.php');
    if(!isset($_SESSION['email']) || !isset($_GET['a'])){
        header('location: ../index.php');
    }
    $emailSession = $_SESSION['email'];
    $sqlSession = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$emailSession'");
    $rSession = $sqlSession->fetch_assoc();
    $idSession = $rSession['id'];
    $idAjuda = $_GET['a'];
    $sqlAjuda = mysqli_query($conexao, "SELECT *, date_format(timeAjuda, '%d/%m/%Y') FROM ajuda WHERE idAjuda = $idAjuda");
    $rAjuda = $sqlAjuda->fetch_assoc();
    $idUserAjuda = $rAjuda['idUser'];
    if($idUserAjuda != $idSession){
        header('location: ../index.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ajuda.css">
    <link rel="stylesheet" href="../styles/model-of-page.css">
    <link rel="shortcut icon" href="../styles/icons/icon-ligth.png" type="image/x-icon">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <script src="../styles/jquery-3.7.1.js"></script>
    <title>Suas Ajudas</title>
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
                    <a href='suasAjudas.php'>
                        <i class='fa-solid fa-upload icon-menu'></i>
                        Suas Ajudas
                    </a>
                    <a href="../settings/settings.php" class="">
                        <i class="fa-solid fa-gear icon-menu"></i>
                        Configurações
                    </a>
                    <a href='../profile/profile.php'>
                        <i class='fa-solid fa-user icon-menu'></i>
                        Seu Perfil
                    </a>
                </div>
            </div>
        </div>
    </header>   
    <main>
            
        <?php
            $sqlAjudaPost = mysqli_query($conexao, "SELECT a.*, u.nome, u.id, date_format(timeAjuda, '%d/%m/%Y') FROM ajuda a join usuarios u WHERE idAjuda = $idAjuda AND u.id = $idUserAjuda;");
            while ($i = $sqlAjudaPost->fetch_assoc()){
                $textAjuda = $i['textAjuda'];
                $timeAjuda = $i["date_format(timeAjuda, '%d/%m/%Y')"];
                $idUserAjuda = $i['idUser'];
                $nomeAjuda = $i['nome'];
                echo " <div class='box-ajuda'>
                            <input type='text' class='idAjuda' value='$idAjuda' style='display: none;'>
                            <p class='name'>$nomeAjuda</p>
                            <p class='time'>$timeAjuda</p>
                            <p class='text'>$textAjuda</p>
                            <button class=' fa-solid fa-trash btn-remove'></button>
                        </div>";
            }
        ?>
    </main>
    <script>
        document.querySelector('.icon').addEventListener('click', function () {
            document.querySelector('.menu').classList.toggle('show-menu');
        });
        $('.btn-remove').click(function(){
            var resp = confirm('Você deseja realmente apagar esta solicitaçao?');
            if(resp){
                var idAjuda = $('.idAjuda').val()
                $.ajax({
                    url: '../routes/comments.php',
                    method: 'POST',
                    data: {remove: idAjuda},
                    success: function(e){
                        console.log('Success:' + e)
                        location.href = 'suasAjudas.php';
                    }, error: function(e){
                        console.log('Error: ' + e)
                    }
                });
                
            } 
        });
            
    </script>
    <style>
        @import url('../styles/colors.css');
        .box-ajuda{
            width: 500px;
            height: auto;
            background-color: var(--color-box-ligth);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            padding: 10px;
            border-radius: 10px;
        }
        .btn-remove{
            width: 40px;
            height: 40px;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            cursor: pointer;
            background-color: rgb(200, 0, 0);
            margin: 20px 0;
        }
        .name{
            width: 70%;
            height: 20px;
            font-size: 12px;
            opacity: 0.7;
        }
        .time{
            width: 30%;
            height: 20px;
            font-size: 12px;
            opacity: 0.7;
        }
        .text{
            width: 100%;
        }
    </style>
</body>
</html>