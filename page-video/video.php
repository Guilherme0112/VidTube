<?php 
    include_once('../database/conexao.php');
    $id = $_GET['id'];
    $sql = mysqli_query($conexao, "SELECT * FROM videos WHERE idVideo = $id");
    $resp = $sql->fetch_assoc();
    $video = $resp['video'];
    $title = $resp['title'];
    //user data
    $idUser = $resp['userVideo'];
    $sql2 = mysqli_query($conexao, "SELECT * FROM usuarios WHERE id = $idUser");
    $resp2 = $sql2->fetch_assoc();
    $name = $resp2['nome'];
    $userPhoto = $resp2['photoProfile'];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="video.css">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="stylesheet" href="../styles/model-of-page.css">
    <script src="video.js" defer></script>
    <link rel="shortcut icon" href="../styles/icon.png" type="image/x-icon">
    <title>Vídeo</title>
</head>
<body>
    <header>
        <div class="header-one">
            <input type="search" name="search" id="search" placeholder="O que você está pensando?" class="placeholder-center">
            <i class="fa-solid fa-magnifying-glass"></i>
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
                        session_start();
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
    <body>

        <!-- box video -->

        <iframe src="<?php echo $video ?>" frameborder="0" class="box-picture">

        </iframe>
        <div class='box-title'>
            <h1 class='title font-nigth'><?php echo $title ?></h1>
        </div>

        <!-- video title and follow button -->

        <div class="box-interaction">
            <img src="<?php echo $userPhoto ?>" alt="">
            <a href='' class="font-nigth"><?php echo $name ?></a>
            <button class="btn" title="Seguir este perfil">Seguir</button>
            <i class="fa-regular fa-thumbs-up icon-interaction font-nigth" title="Like"></i>
            <i class="fa-regular fa-thumbs-down icon-interaction font-nigth" title="Deslike"></i>
            <i class="fa-solid fa-share icon-interaction font-nigth" title='Compartilhar' ></i>
        </div>
</body>
</html>