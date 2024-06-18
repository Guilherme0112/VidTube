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
        if (strlen($title) != 0 && strlen($title) <= 30 && strlen($text) >= 5 && strlen($text) <= 500) {
            $textTratado = mysqli_real_escape_string($conexao, $text);
            $titleTratado = mysqli_real_escape_string($conexao, $title);
            $sql = mysqli_query($conexao, "INSERT INTO ajuda VALUES (default, $idSession, '$titleTratado', '$textTratado', default, default)");
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
                <input type="text" class="title" name="title" placeholder="Título do Problema" oninput="refreshTxt()">
                <p class="msg-error" id="title">0/30</p>
                <label for="text">Descreva o problema</label>
                <textarea name="text" placeholder="Descreva seu problema" oninput="refreshTxt()"></textarea>
                <p class="msg-error" id="text">0/500</p>
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
            var msgError = document.getElementById('title');
            if (title.value.length === 0 || title.value.length > 30) {
                title.style.outline = "2px solid red";
                return false
            } else {
                title.style.outline = "none";
            }
            if (text.value.length < 5 || text.value.length > 500) {
                text.style.outline = "2px solid red";
                return false;
            } else {
                text.style.outline = "none";
            }

        }
        function refreshTxt(){

            //textarea

            var amount = document.getElementById('title');
            var text1 = document.getElementsByName('title')[0].value.length; 
            amount.innerHTML = text1 + '/30';
            if(text1 < 1 || text1 > 30){
                amount.style.color = 'red';
            } else {
                amount.style.color = 'gray';
            }

            //title

            var amount2 = document.getElementById('text');
            var text2 = document.getElementsByName('text')[0].value.length; 
            amount2.innerHTML = text2 + '/500';
            if(text2 < 5 || text2 > 500){
                amount2.style.color = 'red';
            } else {
                amount2.style.color = 'gray';
            }

        }
    </script>
</body>

</html>