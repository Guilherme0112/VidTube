<?php
    include_once('../database/conexao.php');
    session_start();
    if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: ../login/login.php');
    } else {
        $logado = $_SESSION['email'];
        $cursor = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$logado' ");
        $MySQL = $cursor->fetch_assoc();
        $id = $MySQL['id'];
        $name = $MySQL['nome']; 
        $photoProfile = $MySQL['photoProfile']; 
        
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
    <script src="profile.js"></script>
    <link rel="shortcut icon" href="../styles/icons/icon-ligth.png" type="image/x-icon">
    <title>
        <?php echo $name; ?>
    </title>
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
                    <a href="uploadVideo/uploadVideo.php">
                        <i class='fa-solid fa-upload icon-menu'></i>
                        Enviar Vídeo
                    </a>
                    <a href="goOut.php" class="close-btn font-nigth" title="Sair do Perfil">
                        Sair
                    </a>
                </div>
            </div>
        </div>
    </header>
    <section>
        <div class="size-img-profile">
            <img src="<?php echo $photoProfile; ?>" alt="" class="img-profile" class='photo-profile'>
            <div class="name-space">
                <p class="name">
                    <?php print "$name"; ?>
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
                echo "
                    <div class='box-config'>
                        <a href='../page-video/video.php?id=$idVideo' class='size-box-video' title='$title' style='display: block;'>
                            <img class='box-video' src='../$thumb'></img>
                            <h3 class='video-title font-nigth'>$title</h3>
                            <p class='views-video font-nigth'> $likes pessoas curtiram</p>
                        </a>
                        <form class='edit' action='profile.php'>
                            <a href='editVideo.php?id=$idVideo'name='config' class='config'>Configuraçoes</a>
                            <input type='submit' name='deleteVideo' class='close-btn' value='Apagar Vídeo'>
                        </form>
                    </div>
                        ";
            }
        ?>
    </main>
    <script>
        document.querySelector('.icon').addEventListener('click', function() {
            document.querySelector('.menu').classList.toggle('show-menu');
        });
    </script>
</body>
</html>