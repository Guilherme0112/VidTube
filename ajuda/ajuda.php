<?php
session_start();
include_once('../database/conexao.php');
if (!isset($_SESSION['email'])) {
    header('location: ../index.php');
} else {
    $emailSession = $_SESSION['email'];
    $sqlSession = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$emailSession'");
    $rSession = $sqlSession->fetch_assoc();
    $idSession = $rSession['id'];
}
if (isset($_POST['submit'])) {
    if (isset($_POST['title']) && isset($_POST['text'])) {
        $title = $_POST['title'];
        $text = $_POST['text'];
        if (strlen($title) != 0 && strlen($text) >= 5) {
            $sql = mysqli_query($conexao, "INSERT INTO ajuda VALUES (default, $idSession, '$title', '$text', default)");
            if ($sql) {
                header('Location: suasAjudas.php');
            }
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
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="stylesheet" href="../styles/model-of-page.css">
    <link rel="shortcut icon" href="../styles/icons/icon-ligth.png" type="image/x-icon">
    <title>Ajuda</title>
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
                    <a href="../settings/settings.php" class="">
                        <i class="fa-solid fa-gear icon-menu"></i>
                        Configurações
                    </a>
                    <a href='suasAjudas.php'>
                        <i class='fa-solid fa-upload icon-menu'></i>
                        Suas Ajudas
                    </a>
                    <a href='../profile/profile.php'>
                        <i class='fa-solid fa-user icon-menu'></i>
                        Seu Perfil
                    </a>
                    <a href='../profile/goOut.php' class='close-btn font-nigth' title='Sair do Perfil'>
                        Sair
                    </a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <section>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return vali()">
                <label for="title">Título do problema</label>
                <input type="text" class="title" name="title" placeholder="Título do Problema">
                <label for="text">Descreva o problema</label>
                <textarea name="text" placeholder="Descreva seu problema"></textarea>
                <input type="submit" value="Enviar" name="submit" onclick="vali()">
            </form>
        </section>
    </main>
    <script>
        document.querySelector('.icon').addEventListener('click', function() {
            document.querySelector('.menu').classList.toggle('show-menu');
        });

        function vali() {
            var title = document.getElementsByName('title')[0];
            var text = document.getElementsByName('text')[0];
            if (title.value.length === 0) {
                title.style.outline = "2px solid red";
                return false
            } else {
                title.style.outline = "none";
                return true;
            }
            if (text.value.length < 5) {
                text.style.outline = "2px solid red";
                return false
            } else {
                text.style.outline = "none";
                return true;
            }
        }
    </script>
</body>

</html>