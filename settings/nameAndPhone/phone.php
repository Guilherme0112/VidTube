<?php 
session_start();
    include_once('../../database/conexao.php');
    if(isset($_SESSION['email']) == false){
        header('Location: ../../index.php');
    }
    $email = $_SESSION['email'];
    $sql = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$email'");
    $resp = $sql->fetch_assoc();
    $name = $resp['nome'];
    $phone = $resp['phone'];
    $senha = $resp['senha'];
    if(isset($_POST['submit'])){
        $pass = $_POST['pass'];
        $phoneInput = $_POST['phone'];
        if($pass == $senha & strlen($phoneInput) == 15){

            $sql2 = mysqli_query($conexao, "UPDATE usuarios SET phone = '$phoneInput' WHERE email = '$email'");
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
    <link rel="stylesheet" href="../../styles/model-of-page.css">
    <link rel="stylesheet" href="styleNamePhone.css">
    <link rel="stylesheet" href="../restorePass/restorePass.css">
    <link rel="stylesheet" href="../../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="shortcut icon" href="../../styles/icons/icon-ligth.png" type="image/x-icon">
    <title><?php echo $name; ?></title>
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
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="phone">Digite seu novo número de telefone</label>
        <input type="tel" name="phone" class='tel' placeholder="(00) 00000-0000">
        <label for="pass">Digite sua senha</label>
        <input type="password" name="pass" placeholder="Digite sua senha">
        <input type="submit" name='submit' value="Mudar telefone">
    </form>
    <script>
        document.querySelector('.icon').addEventListener('click', function () {
            document.querySelector('.menu').classList.toggle('show-menu');
        });
        document.querySelector('.tel').addEventListener('input', function (e) {
            let tel = e.target.value.replace(/\D/g, ''); //retira os espaços
            tel = tel.replace(/^(\d{2})(\d)/g, '($1) $2'); //coloca parenteses nos 2 primeiros números
            tel = tel.replace(/(\d)(\d{4})$/, '$1-$2'); //coloca o hífen depois de 5 números
            e.target.value = tel;
  });

    </script>
</body>
</html>