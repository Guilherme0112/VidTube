<?php
    session_start();
    $email = $_SESSION['email'];
    include_once('../database/conexao.php');
    $sql = mysqli_query($conexao, "SELECT id FROM usuarios WHERE email = '$email';");
    $result = $sql->fetch_assoc();
    $id = $result['id'];

    $video = $_FILES['file'] ?? '';
    $title = $_POST['title'] ?? '';
    if(isset($_POST['submit'])){
        if(isset($_FILES['file']) && strlen($title) > 4){
            
            $title = $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], "../database/Arquivos/" . $id . "/" . $title);
            $sql = mysqli_query($conexao, "INSERT INTO videos VALUES (default, '../database/Arquivos/$id/$title.mp4', 0, '', $id, '$title')");  
            if(isset($_FILES['thumb'])){
                $thumb = $_FILES['thumb']['name'];
                move_uploaded_file($_FILES['thumb']['tpm_name'], "..database/Arquivos/" . $id . "/" . $thumb . ".png");
                $thumbRota = "..database/Arquivos/$id/$thumb.png" ?? '';
                #$sql2 = mysqli_query($conexao, "");
            }
            header('Location: ../index.php');
        }
    }
    if(!isset($_SESSION['email'])){

        header('Location: ../login/login.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/model-of-page.css">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="shortcut icon" href="../styles/icons/icon-ligth.png" type="image/x-icon">
    <title>Upload Vídeo</title>
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
                    <a href="profile.php">
                        <i class='fa-solid fa-user icon-menu'></i>
                        Seu Perfil
                    </a>
                    <a href="goOut.php" class="close-btn font-nigth" title="Sair do Perfil">
                        Sair
                    </a>
                </div>
            </div>
        </div>
    </header>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" onsubmit="return validate()">
        <label for="files" id='file'>Clique aqui para enviar seu vídeo</label>
        <input type="file" name="file" id='files' accept="video/mp4" required>
        <label for="thumb" id='file'>Clique aqui para colocar uma capa</label>
        <input type="file" name="thumb" id="thumb" accept="image/png" required>
        <label for="title">Título do vídeo</label>
        <input type="text" name="title" id='title'>
        <p class="msg"></p>
        <input type="submit" value="Enviar" name='submit'>
    </form>
    <script>
        document.querySelector('.icon').addEventListener('click', function() {
            document.querySelector('.menu').classList.toggle('show-menu');
        });
        function validate(){

            var title = document.getElementsById('title');
            if(title.value.length > 0){
                var msg = document.getElementsByClassName('msg');
                msg.innerHTML = 'O título deve ter no máximo 70 caracteres'
                return false;
            } else {
                return true;
            }

        }
    </script>
    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form{

            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            width: 700px;
            height: 500px;
            border-radius: 10px;
            background-color: #1b1b1b;
            box-shadow: 0px 0px 7px black;
            padding: 20px;
        }
        label{

            text-align: center;
            color: white;
            width: 100%;
    
        }
        #file{

            display: block;
            padding: 60px 10px;
            width: 300px;
            height: 150px;
            background-color: #0b0b0b;
            cursor: pointer;
            color: white;
            border-radius: 10px;
            margin: auto 10px;
        }
        .msg{

            width: 100%;
            color: red;
            font-size: 13px;
            text-align: center;
        }
        input[type='file']{

            display: none;
            width: 95%;
            height: 300px;
            outline: 2px solid black;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type='text']{

            width: 80%;
            height: 40px;
            padding-left: 5px;
            border-radius: 5px;
            background-color: #0b0b0b;
            color: white;
        }
        input[type='submit']{

            width: 60%;
            height: 40px;
            border-radius: 5px;
            cursor: pointer;
            background-color: rgb(37, 37, 190);
            font-size: 20px;
            color: white;
        }
        input[type='submit']:hover{
            transition: .4s;
            background-color: white;
            color: rgb(37, 37, 190);
        }
    </style>
</body>
</html>