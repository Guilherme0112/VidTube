<?php
    session_start();
    if(isset($_SESSION['email']) && isset($_SESSION['senha'])){

        // Inclusao do MYSQL, envio e recibo de dados
        include_once('../database/conexao.php');
        $email = $_SESSION['email'];
        $cursor = "SELECT * FROM usuarios WHERE email = '$email';";
        $response = $conexao->query($cursor);
        $resultMySQL = $response->fetch_assoc();

        

        // Variaveis do MySQL
        $id = $resultMySQL['id'];
        $name = $resultMySQL['nome'];
        $email = $resultMySQL['email'];
        $phone = $resultMySQL['phone'];


        if (isset($_POST['submit'])){
            //Dados do método POST
            $nameForm = $_POST['name'];
            $phoneForm = $_POST['phone'];
            if (isset($_POST['name']) && strlen($_POST['name']) > 3){

                $cursor = mysqli_query($conexao, "UPDATE usuarios SET nome = '$nameForm' WHERE id = $id");
            } 
            if (isset($_POST['phone']) && strlen($_POST['phone']) == 11){

                $cursor = mysqli_query($conexao, "UPDATE usuarios SET phone = '$phoneForm' WHERE id = $id");
            }
            
            
        }
    };
    if(isset($_POST['deleteUser'])){

        $cursor = mysqli_query($conexao, "DELETE FROM usuarios WHERE id = $id");
        header('Location: ../login/login.php');
        session_destroy();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="settings.css">
    <link rel="stylesheet" href="../styles/model-of-page.css">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="shortcut icon" href="/project/styles/icon.png" type="image/x-icon">
    <script src="settings.js"></script>
    <title>Configuraçoes</title>
</head>
<body>
    <header>
        <div class="header-one">
            <input type="search" name="search" id="search" placeholder="O que você está pensando?" class="placeholder-center">
            <i class="fa-solid fa-magnifying-glass"></i>
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
                        Em Alta</a>
                    <a href="settings.php" class="">
                        <i class="fa-solid fa-gear icon-menu"></i>
                        Configurações
                    </a>
                    <?php 
                        if(isset($_SESSION['email']) && isset($_SESSION['senha'])){
                            echo "<a href='../profile/profile.php'>
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
                            </a>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </header>
    <!-- Menu left -->
    <section class="box-options" style="margin-top: 100px;">
        <?php 
            if(isset($_SESSION['email']) && isset($_SESSION['senha'])){

                echo "<a href='' class='font-nigth'>Seu perfil</a>
                    <a href='' class='font-nigth'>Configurações de privacidade</a>";
            }
        ?>
        <a href="" class="font-nigth">Idioma</a>
        <a href="" class="font-nigth">Tema</a>
        <a href="" class="font-nigth">Notificações</a>
    </section>
    <main class="main-box">
        <?php 
            if(isset($_SESSION['email']) && isset($_SESSION['senha'])){
                echo "<form action='settings.php' method='post' class='yourProfile'>
            <h1 class='font-nigth'>Seu Perfil</h1>
            <label for='id' class='font-nigth'>Id do usuário: </label>
            <span class='font-nigth'>$id</span>
            <label for='name' class='font-nigth'>Nome do usuário:</label>
            <input type='text' name='name' class='input' placeholder='$name'>
            <label for='email' class='font-nigth'>Email:</label>
            <input type='email' name='email' class='input' value='$email' id='email' desabled>
            <span style='width: 100%;'></span>
            <input type='button' onclick='restorePass()' value='Alterar Senha' class='alterPass'>
            <label for='phone' class='font-nigth' min='11'>Telefone:</label>
            <input type='tel' class='' placeholder='$phone' name='phone'> 
            <span style='width: 100%;'></span>
            <input type='submit' value='Alterar Dados' class='submit font-nigth' name='submit'>
            <span style='width: 100%;'></span>
            <input type='submit' value='Excluir Conta' class='deleteUser' name='deleteUser'>
        </form>";
            };
        ?>
        
        
    </main>
    <script>
        document.querySelector('.icon').addEventListener('click', function () {
            document.querySelector('.menu').classList.toggle('show-menu');
        });
        const email = document.getElementById('email').disabled = true;

        function restorePass(){
            location.href = 'restorePass/restorePass.php'
        }
    </script>
</body>
</html>