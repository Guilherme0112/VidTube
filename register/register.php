<?php
    $name = '';
    $email = '';
    $phone = '';
    include_once('../database/conexao.php');
    if (isset($_POST['enviar'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $senha = $_POST['senha'];
        $rsenha = $_POST['rsenha'];
        if (strlen($name) > 3 && strlen($phone) == 15 && $senha == $rsenha){
            $cursor = mysqli_query($conexao, "INSERT INTO usuarios (nome, email, senha, phone) VALUES ('$name', '$email', '$senha', '$phone')");
            $sql = mysqli_query($conexao, "SELECT *  FROM usuarios WHERE email = '$email';");
            $result = $sql->fetch_assoc();
            $idBC = $result['id'];
            //criar uma pasta para uploads assim que o perfil é criado
            $dir = '../database/Arquivos/' . $idBC . '/';
            mkdir($dir, 0777, true);
            header('Location: ../login/login.php');

        }    
    };
    //if the user is online, do not login
    session_start();
    if(isset($_SESSION['email'])){

        header('Location: ../index.php');
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="../styles/model-of-page.css">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="shortcut icon" href="../styles/icon.png" type="image/x-icon">
    <script defer src="register.js"></script>
    <title>Registrar</title>
</head>
<body>
    <header>
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
                    <a href="../login/login.php">
                        <i class="fa-solid fa-user icon-menu"></i>
                        Fazer Login
                    </a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <form id='form' action="<?= $_SERVER['PHP_SELF'] ?>" method="post" onsubmit='return validateForm()'>
            <div>
                <label for="name">Nome:</label>
                <input type="text" name="name" class="input-space placeholder-center" min='3' placeholder='Digite seu nome' value='<?php print"$name";?>' required>
                <p class='msg-error' id='nameError'></p>
                <label for="email">Email:</label>
                <input type="email" name="email" class="input-space placeholder-center" placeholder='Digite seu e-mail' value='<?php print"$email";?>' required>
                <label for="phone">Telefone:</label>
                <input type="tel" name="phone" class="input-space placeholder-center tel" placeholder="(00)0000-0000" value='<?php print"$phone";?>' style="margin-top: 5px;" required>
                <p class='msg-error' id='phoneError'></p>
            </div>
            <div>
                <label for="senha">Senha:</label>
                <input type="password" name="senha" class="input-space placeholder-center pass" placeholder='Digite sua senha' required>
                <p class='msg-error' id='passError'></p>
                <label for="rsenha">Repita a Senha:</label>
                <input type="password" name="rsenha" class="input-space placeholder-center rpass" placeholder='Repita sua senha' required>
                <p class='msg-error' id='rpassError'></p>
                <a href="../login/login.php" class="font-nigth effect-text-line">Já tem conta? Faça Login</a>
                <input type="submit" value="Registrar" name="enviar" id='submit' title="Registrar conta">
            </div>
        </form>
    </main>
</body>
</html>