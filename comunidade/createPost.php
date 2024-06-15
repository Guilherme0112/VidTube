<?php
session_start();
include_once('../database/conexao.php');
if (!isset($_SESSION['email'])) {
    header('Location: ../login/login.php');
} else {
    $emailSession = $_SESSION['email'];
    $sessionSQL = mysqli_query($conexao, "SELECT * FROM usuarios  WHERE email = '$emailSession'");
    $respSession = $sessionSQL->fetch_assoc();
    $idSession = $respSession['id'];
}
if (isset($_POST['submit'])) {
    if (isset($_POST['txt'])) {
        $desc = $_POST['txt'];
        if (strlen($desc) > 0) {
            if (isset($_FILES['img']['name'])) {
                $imgName = $_FILES['img']['name'];
                $routePost = "../database/Arquivos/$idSession/$imgName";
                move_uploaded_file($_FILES['img']['tmp_name'], "$routePost");
                $insertPost = mysqli_query($conexao, "INSERT INTO comunidade VALUES (default, $idSession, '$routePost', '$desc', default)");
            } else {
                $add = mysqli_query($conexao, "INSERT INTO comunidade VALUES (default, $idSession, '', '$desc', default)");
        } 
    }
}

    header('Location: comunidade.php');
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/model-of-page.css">
    <link rel="stylesheet" href="comunidade.css">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <script src="../styles/jquery-3.7.1.js"></script>
    <link rel="shortcut icon" href="../styles/icons/icon-ligth.png" type="image/x-icon">
    <title>Criar Postagem</title>
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
                    <?php
                    if (isset($_SESSION['email']) && isset($_SESSION['senha'])) {
                        echo "
                                <a href='../profile/uploadVideo/uploadVideo.php'>
                                    <i class='fa-solid fa-upload icon-menu'></i>
                                    Enviar Vídeo
                                </a>
                                <a href='../profile/profile.php'>
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
    <main>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class='createPost' enctype="multipart/form-data">
            <p></p>
            <textarea name='txt' placeholder="Faça uma postagem"></textarea>
            <label for="post-img" class="label-img">Poste uma imagem</label>
            <input type="file" name='img' id="post-img" accept="image/*">
            <img class="img">
            <input type="submit" name='submit' class='btn-post' style='width: 200px;' value="Postar">
        </form>
    </main>
</body>
<script>
    document.querySelector('.icon').addEventListener('click', function() {
        document.querySelector('.menu').classList.toggle('show-menu');
    });

    //img preview

    const fileInput = document.querySelector('#post-img')
    const imagePreview = document.querySelector('.img')

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

</html>