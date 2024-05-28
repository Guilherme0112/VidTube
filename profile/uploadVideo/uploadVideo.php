<?php
    session_start();
    include_once('../../database/conexao.php');
    $email = $_SESSION['email'];
    $sql = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$email'");
    $resp = $sql->fetch_assoc();
    $idUser = $resp['id'];

    if(isset($_POST['submit']) && isset($_FILES['video']['name'])){
        $nameVideo = $_FILES['video']['name'];
        $ext = pathinfo($nameVideo, PATHINFO_EXTENSION);
        $titleVideoToView = $_POST['title'];
        $titleVideoToMySQL = $_POST['title'] . '.' . $ext;
        $route = "../database/Arquivos/$idUser/$titleVideoToMySQL";
        move_uploaded_file($_FILES['video']['tmp_name'], "../$route");
        $sql2 = mysqli_query($conexao, "INSERT INTO videos VALUES (default, '$route', 0, '', $idUser, '$titleVideoToView')");
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
    <link rel="stylesheet" href="../../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="stylesheet" href="uploadVideo.css">
    <title>Upload de Vídeo</title>
</head>
<body>
<header>
        <div class="header-one">
            
        </div>
        <div class="header-two">
            <i class="fas fa-bars icon"></i>
            <div class="menu">
                <div style="margin-top: 40px;">
                    <a href="../../index.php" class="select">
                        <i class="fa-solid fa-house icon-menu"></i>
                        Início
                    </a>
                    <a href="../../settings/settings.php" class="">
                        <i class="fa-solid fa-gear icon-menu"></i>
                        Configurações
                    </a>
                    <a href="../goOut.php" class="close-btn font-nigth" title="Sair do Perfil">
                        Sair
                    </a>
                </div>
            </div>
        </div>
    </header>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <label for="video"></label>
        <input type="file" name="video" id='video' accept="video/*">
        <input type="text" name="title" id="title">
        <input type="submit" name='submit' value="Postar Vídeo">
    </form>
    <script>
        document.querySelector('.icon').addEventListener('click', function() {
            document.querySelector('.menu').classList.toggle('show-menu');
        });
    </script>
</body>
</html>