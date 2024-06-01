<?php
session_start();
    if(!isset($_GET['id']) || !isset($_SESSION['email'])){
        header('Location: ../index.php');
    }
    include_once('../database/conexao.php');
    $idVideo = $_GET['id'];
    $sql = mysqli_query($conexao, "SELECT * FROM videos WHERE idVideo = $idVideo");
    $resp = $sql->fetch_assoc();
    $title = $resp['title'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="../styles/model-of-page.css">
    <link rel="shortcut icon" href="../styles/icons/icon-ligth.png" type="image/x-icon">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <title><?php echo $title ?></title>
</head>
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
<body>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="title">Título do Vídeo</label>
        <input type="text" name="title" id="title" value='<?php echo $title ?>'>
        <label for="thumb">Capa do Vídeo</label>
        <input type="file" name="thumb" id="thumb">
        <img src="" alt="" id='img-preview'>
    </form>
    <script>
         document.querySelector('.icon').addEventListener('click', function() {
            document.querySelector('.menu').classList.toggle('show-menu');
        });
        const fileInput = document.getElementById('thumb');
        const imagePreview = document.getElementById('img-preview');

        fileInput.addEventListener('change', function() {
            const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(event) {
                imagePreview.src = event.target.result;
                };

        reader.readAsDataURL(file);
    }
});
    </script>
</body>
</html>