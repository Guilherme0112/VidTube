<?php
    session_start();
    if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: ../../login/login.php');
    } else {
        //data for verification
        $session = $_SESSION['email'];
        include_once('../../database/conexao.php');
        $sql = mysqli_query($conexao, "SELECT senha FROM usuarios WHERE email = '$session'");
        $rMySQL = $sql->fetch_assoc();

        //user data
        $senha = $rMySQL['senha'];

        // input values
        $passInput = $_POST['passCurrent'] ?? '';
        $newPass = $_POST['newPass'] ?? '';
        $RnewPass = $_POST['RnewPass'] ?? '';
        if($passInput == $senha && $newPass == $RnewPass){
            $cursor = mysqli_query($conexao, "UPDATE usuarios SET senha = '$newPass' WHERE email = '$session';");
            header('Location: ../settings.php');
        } 
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="restorePass.css">
    <link rel="stylesheet" href="../../styles/model-of-page.css">
    <link rel="stylesheet" href="../../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="shortcut icon" href="../../styles/icon.png" type="image/x-icon">
    <title>Restaurar sua senha</title>
</head>
<header>
    <div class="header-two">
        <i class="fas fa-bars icon" style="position: absolute; right: 0px; top: 13px;"></i>
        <div class="menu">
            <div style="margin-top: 40px;">
                <a href="../../settings/settings.php" class="">
                    <i class="fa-solid fa-gear icon-menu"></i>
                    Configurações
                </a>
                <a href='../../profile/profile.php'>
                    <i class='fa-solid fa-user icon-menu'></i>
                    Seu Perfil
                </a>
                <a href='../../profile/goOut.php' class='close-btn font-nigth' title='Sair do Perfil'>
                    Sair
                </a>
            </div>
        </div>
    </div>
</header>
<body>
    <form action="<?= $_SERVER['PHP_SELF']?>" method="post">
        <label for="passCurrent" class="font-nigth">Digite sua senha atual:</label>
        <input type="password" name="passCurrent" class="input">
        <p class='msg-erro'></p>
        <label for="newPass" class="font-nigth">Digite sua nova senha:</label>
        <input type="password" name="newPass" class="">
        <label for="RnewPass" class="font-nigth">Repita sua nova senha:</label>
        <input type="password" name="RnewPass" class="">
        <a href="" class="effect-text-line font-nigth">Esqueci minha senha</a>
        <input type="submit" value="Alterar Senha">
    </form>

    <script>
        document.querySelector('.icon').addEventListener('click', function () {
            document.querySelector('.menu').classList.toggle('show-menu');
        });
    </script>
</body>
</html>