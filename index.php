<?php
    include_once('database/conexao.php');
    session_start();
    if(isset($_GET['search'])){
        $search = $_GET['search'];
        $cursor = mysqli_query($conexao, "SELECT * FROM videos WHERE title LIKE '$search%'");
    } else {
        $cursor = mysqli_query($conexao, "SELECT * FROM videos");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styles/model-of-page.css">
    <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/all.min.css">
    <script src="scripts.js" defer></script>
    <script src="styles/jquery-3.7.1.js"></script>
    <link rel="shortcut icon" href="styles/icons/icon-ligth.png" type="image/x-icon">
    <title>Início</title>
</head>

<body>
    <header>
        <a href="index.php">
            <img src="styles/icons/icon.png" class="img-logo">
        </a>
        <form class="header-one" action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
            <input type="search" name="search" id="search" placeholder="O que você está pensando?" class="placeholder-center">
            <button class="fa-solid fa-magnifying-glass search"></button>
        </form>
        <div class="header-two">
            <i class="fas fa-bars icon"></i>
            <div class="menu">
                <div style="margin-top: 40px;">
                    <a href="index.php" class="select">
                        <i class="fa-solid fa-house icon-menu"></i>
                        Início
                    </a>
                    <a href="#">
                        <i class="fa-solid fa-fire icon-menu"></i>
                        Em Alta
                    </a>
                    <a href="comunidade/comunidade.php" class="">
                        <i class="fa-solid fa-inbox icon-menu"></i>
                        Comunidade
                    </a>
                    <a href="settings/settings.php" class="">
                        <i class="fa-solid fa-gear icon-menu"></i>
                        Configurações
                    </a>
                    <?php 
                        if(isset($_SESSION['email']) && isset($_SESSION['senha'])){
                            echo "
                                <a href='profile/uploadVideo/uploadVideo.php'>
                                    <i class='fa-solid fa-upload icon-menu'></i>
                                    Enviar Vídeo
                                </a>
                                <a href='profile/profile.php'>
                                    <i class='fa-solid fa-user icon-menu'></i>
                                    Seu Perfil
                                </a>
                                <a href='ajuda/suasAjudas.php'>
                                    <i class='fa-regular fa-question icon-menu'></i>
                                    Ajuda
                                </a>
                                <a href='profile/goOut.php' class='close-btn font-nigth' title='Sair do Perfil'>
                                    Sair
                                </a>";
                        } else {
                            echo "<a href='./register/register.php'>
                                    <i class='fa-solid fa-user icon-menu'></i>
                                    Criar Conta
                                </a>
                                <a href='./login/login.php'>
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
    
    <main id="primary-page-video">
        <?php
            if(mysqli_num_rows($cursor) == 0){
                echo "<p class='msgDados'>Não há dados de pesquisa
                        <a href='index.php'>Voltar ao Início</a>
                    </p>";
            } else {
                while($result = $cursor->fetch_assoc()){
                    $id = $result['idVideo'];
                    $video = $result['video']; 
                    $title = $result['title']; 
                    $thumb = $result['thumb'];
                    $sql = mysqli_query($conexao, "SELECT * FROM likes WHERE videoLike = $id");
                    $likes = mysqli_num_rows($sql);
                
                    echo "<a href='page-video/video.php?id=$id' class='size-box-video' title='$title'>
                            <img class='box-video' src='$thumb'></img>
                            <h3 class='video-title font-nigth'>$title</h3>
                            <p class='views-video font-nigth'> $likes pessoas curtiram</p>
                        </a>";
                }
            }
       
        ?>
    </main>
</body>
</html>