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
    };

    //update name

    if(isset($_POST['updateName']) && isset($_POST['name'])){
        $changeName = $_POST['name'];
        if(strlen($changeName) > 2){
            $sql = mysqli_query($conexao, "UPDATE usuarios SET nome = '$changeName' WHERE id = $id");
            header('Location: ../profile/profile.php');
        }
    }

    //delete user

    if(isset($_POST['deleteUser'])){

        $cursor = mysqli_query($conexao, "DELETE FROM usuarios WHERE email = '$email';");
        rmdir('../database/Arquivos/' . $id);
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
    <link rel="shortcut icon" href="../styles/icons/icon-ligth.png" type="image/x-icon">
    <script defer src="settings.js"></script>
    <title>Configuraçoes</title>
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
    <section class="box-options">
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
                echo "<form action='settings.php' method='post' class='yourProfile' onsubmit='return validate()'>
                        <h1 class='font-nigth'>Seu Perfil</h1>
                        <label for='id' class='font-nigth'>Id do usuário: </label>
                        <span class='font-nigth'>$id</span>
                        <label for='name' class='font-nigth'>Nome do usuário:</label>
                        <input type='text' name='name' class='input' value='$name' placeholder='$name'>
                        <p class='msg-error'></p>
                        <span style='width: 100%;'></span>
                        <input type='submit' value='Mudar nome' name='updateName' class='changeName'>
                        <label for='email' class='font-nigth'>Email:</label>
                        <input type='email' name='email' class='input' value='$email' id='email' desabled>
                        <span style='width: 100%;'></span>
                        <input type='button' onclick='restorePass()' value='Alterar Senha'>
                        <span style='width: 100%;'></span>
                        <input type='button' value='Mudar Telefone' onclick='phone()'> 
                        <span style='width: 100%;'></span>
                        <input type='button' name='photoProfile' id='photoProfile' value='Trocar foto de Perfil' onclick='photo()'>
                        <span style='width: 100%;'></span>
                        <input type='submit' value='Excluir Conta' class='deleteUser' name='deleteUser'>
                    </form>";
            };
        ?>
    </main>
</body>
</html>