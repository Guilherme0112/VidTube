<?php
    session_start();
    include_once('../../database/conexao.php');
     if(isset($_SESSION['email']) == false){
        header('Location: ../../index.php');
    }
    $email = $_SESSION['email'];
    $sql = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$email'");
    $resp = $sql->fetch_assoc();
    $id = $resp['id'];
    if(isset($_POST['submit']) && isset($_FILES['photo']['name'])){
        $nameFile = $_FILES['photo']['name'];
        $route = "../database/Arquivos/$id/$nameFile";
        move_uploaded_file($_FILES['photo']['tmp_name'], "../../database/Arquivos/$id/$nameFile");
        $sql = mysqli_query($conexao, "UPDATE usuarios SET photoProfile = '$route' WHERE id = $id");
        header('Location: ../../profile/profile.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/model-of-page.css">
    <link rel="shortcut icon" href="../../styles/icons/icon-ligth.png" type="image/x-icon">
    <link rel="stylesheet" href="../../fontawesome-free-6.5.1-web/css/all.min.css">
    <title>Foto de Perfil</title>
</head>
<body>
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
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <label for="photo">Clique aqui para fazer o upload da imagem</label>
        <input type="file" name="photo" id="photo" accept="image/*">
        <img src="" alt="" id="img-preview">
        <input type="submit" name='submit' value="Mudar foto de Perfil">
    </form>
    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form{

            width: 500px;
            height: 500px;
            background-color: #2b2b2b;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }
        input[type='file']{
            display: none;
        }
        label{
            background-color: #1b1b1b;
            width: 90%;
            height: 40%;
            border-radius: 10px;
            cursor: pointer;
            color: white;
            display: grid;
            place-items: center;
        }
        input[type='submit']{

            width: 300px;
            height: 40px;
            border-radius: 10px;
            background-color: rgb(37, 37, 190);
            color: white;
            transition: .3s;
            cursor: pointer;
        }
        input[type='submit']:hover{

            background-color: #1b1b1b;
        }
        img{

            display: block;
            width: 200px;
            height: 200px;
            object-fit: cover;
            object-position: center;
            border-radius: 50%;
            background-color: #1b1b1b;
            outline: 2px solid white;
            margin: 10px;
        }
    </style>
    <script>
        document.querySelector('.icon').addEventListener('click', function(){
            document.querySelector('.menu').classList.toggle('show-menu');
        });
        const fileInput = document.getElementById('photo');
        const imagePreview = document.getElementById('img-preview');

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
</body>
</html>