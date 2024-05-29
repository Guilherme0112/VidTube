<?php   
    session_start();
    include_once('../database/conexao.php');
    if(!isset($_GET['id'])){
        header('Location: ../index.php');
    } else {
        $id = $_GET['id'];
        $sql = mysqli_query($conexao, "SELECT * FROM usuarios WHERE id = $id");
        $infoUser = $sql->fetch_assoc();
        $nameUser = $infoUser['nome'];
        $photoProfileUser = $infoUser['photoProfile'];
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="../styles/model-of-page.css">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="shortcut icon" href="../styles/icons/icon-ligth.png" type="image/x-icon">
    <title><?php echo $nameUser; ?></title>
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
                    <?php 
                        if(isset($_SESSION['email']) && isset($_SESSION['senha'])){
                            echo "<a href='../profile/profile.php'>
                                    <i class='fa-solid fa-user icon-menu'></i>
                                    Seu Perfil
                                </a>
                                <a href='../profile/goOut.php' class='close-btn font-nigth' title='Sair do Perfil'>
                                    Sair
                                </a>";
                        } else {
                            echo "<a href='../register/register.php'>
                                    <i class='fa-solid fa-user icon-menu'></i>
                                    Criar Conta
                                </a>
                                <a href='../login/login.php'>
                                    <i class='fa-solid fa-user icon-menu'></i>
                                    Fazer Login
                                </a>
                                ";
                        }
                    ?>
                </div>
            </div>
        </div>
    </header>
    <section>
        <div class="size-img-profile">
            <img src="<?php echo "$photoProfileUser"; ?>" alt="" class="img-profile" class='photo-profile'>
            <div class="name-space">
                <p class="name">
                    <?php echo $nameUser ?>
                </p>
            </div>
        </div>

    </section>
    <main>
        <?php
            $sql = mysqli_query($conexao, "SELECT * FROM videos WHERE userVideo = $id");
            while($i = $sql->fetch_assoc()){
                $idVideo = $i['idVideo'];
                $title = $i['title'];
                $thumb = $i['thumb'];
                $likes = $i['likes'];
                echo "<a href='../page-video/video.php?id=$idVideo' class='size-box-video' title='$title'>
                        <img class='box-video' src='../$thumb'></img>
                        <h3 class='video-title font-nigth'>$title</h3>
                        <p class='views-video font-nigth'> $likes pessoas curtiram</p>
                    </a>";
            }
        ?>
    </main>
    <script>
        document.querySelector('.icon').addEventListener('click', function() {
            document.querySelector('.menu').classList.toggle('show-menu');
        });
    </script>
    <script>

    </script>
</body>
</html>