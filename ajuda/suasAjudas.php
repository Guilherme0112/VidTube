<?php
    session_start();
    include_once('../database/conexao.php');
    if(!isset($_SESSION['email'])){
        header('location: ../index.php');
    } else {
        $emailSession = $_SESSION['email'];
        $sqlSession = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$emailSession'");
        $rSession = $sqlSession->fetch_assoc();
        $idSession = $rSession['id'];
    }
    if(isset($_POST['remove'])){
        if($idSession == $idUserAjuda){
            $sqlDelete = mysqli_query($conexao, "DELETE FROM ajuda WHERE idAjuda = $idAjuda");
            if($sqlAjuda){
                header('location: suasAjudas.php');
            }
        }
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
                    <a href='ajuda.php'>
                        <i class='fa-solid fa-upload icon-menu'></i>
                        Criar Ajuda
                    </a>
                    <a href="../settings/settings.php" class="">
                        <i class="fa-solid fa-gear icon-menu"></i>
                        Configurações
                    </a>
                    <a href='../profile/profile.php'>
                        <i class='fa-solid fa-user icon-menu'></i>
                        Seu Perfil
                    </a>
                    <?php
                        $sqlVeri = mysqli_query($conexao, "SELECT * FROM  admin WHERE emailAdmin = '$emailSession'");
                        if(mysqli_num_rows($sqlVeri) != 0){
                            echo "
                                <a href='admin/admin.php'>
                                    <i class='fa-solid fa-user icon-menu'></i>
                                    Administradores
                                </a>
                            ";
                        }
                    ?>
                </div>
            </div>
        </div>
    </header>  
    <main>
        <?php
            $sql = mysqli_query($conexao, "SELECT *, date_format(timeAjuda, '%d/%m/%Y') FROM ajuda WHERE idUser = $idSession");
            if(mysqli_num_rows($sql) > 0){
                while ($i = $sql->fetch_assoc()){
                $idAjuda = $i['idAjuda'];
                $titleAjuda = $i['title'];
                $textAjuda = $i['textAjuda'];
                $timeAjuda = $i["date_format(timeAjuda, '%d/%m/%Y')"];
                echo "<a href='respAjuda.php?a=$idAjuda' class='box-post-ajuda'>
                        <h1 class='title'>$titleAjuda</h1>
                        <p class='time'>$timeAjuda</p>      

                    </a>";
                }
            } else {
                echo "Você nao pediu ajuda";
            }
            
        ?>
        
    </main>   
    <style>
        @import url('../styles/colors.css');
        main{
            margin-top: 70px;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }
        a{
            text-decoration: none;
            color: black;
            cursor: pointer;
        }
        .box-post-ajuda{
            width: 90%;
            height: 100px;
            display: flex;
            justify-content: start;
            align-items: center;
            background-color: var(--color-box-ligth);
            border-radius: 10px;
            padding: 10px;
            transition: .3s;
            margin: 20px 0;
        }
        .box-post-ajuda:hover{

            box-shadow:  0 0 7px black;
        }
        .title{
            font-size: 20px;
            width: 80%;
            margin: 0 20px;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            overflow: hidden;
            -webkit-box-orient: vertical;

        }
        .time{
            font-size: 12px;
            opacity: 0.6;
        }
    </style>
    <script>
        document.querySelector('.icon').addEventListener('click', function(){
            document.querySelector('.menu').classList.toggle('show-menu');
        });
        
    </script>
</body>
</html>