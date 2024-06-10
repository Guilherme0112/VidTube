<?php
    session_start();
    if(!isset($_GET['id']) || !isset($_SESSION['email'])){
        header('Location: ../index.php');
    }
    include_once('../database/conexao.php');
    $emailSession = $_SESSION['email'];
    $sqlSession = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$emailSession'");
    $respSession = $sqlSession->fetch_assoc();
    $idSession = $respSession['id'];
    //info video
    $idVideo = $_GET['id'];
    $sql = mysqli_query($conexao, "SELECT * FROM videos WHERE idVideo = $idVideo");
    $resp = $sql->fetch_assoc();
    $title = $resp['title'];
    $video = $resp['video'];
    $thumb = $resp['thumb'];
    if(isset($_POST['submit'])){
        if(isset($_POST['title'])){
            $changeTitle = $_POST['title'];
            if(strlen($changeTitle) > 2){
                $changeSQL = mysqli_query($conexao, "UPDATE videos SET title = '$changeTitle' WHERE idVideo = $idVideo");
            }  
        }
        if(!empty($_FILES['thumbChange']['name'])){
            $nameThumb = $_FILES['thumbChange']['name'];
            $routeThumb = "database/Arquivos/$idSession/$nameThumb";
            move_uploaded_file($_FILES['thumbChange']['tmp_name'], "../$routeThumb");
            $update = mysqli_query($conexao, "UPDATE videos SET thumb = '$routeThumb' WHERE idVideo = $idVideo");
            if($update){
                unlink("../$thumb");    
            }
        }
        header("Location: profile.php");
    }
    if(isset($_POST['delete'])){
        if(file_exists($video)){
            unlink("../$thumb");
            $deleteVideo = mysqli_query($conexao, "DELETE FROM videos WHERE idVideo = $idVideo");
            $deleteCommentVideo = mysqli_query($conexao, "DELETE FROM comentarios WHERE idVideoComment = $idVideo");
            unlink($video);
            header('Location: profile.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="../styles/model-of-page.css">
    <link rel="shortcut icon" href="../styles/icons/icon-ligth.png" type="image/x-icon">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <title><?php echo $title ?></title>
</head>
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
                    <a href="uploadVideo/uploadVideo.php">
                        <i class='fa-solid fa-upload icon-menu'></i>
                        Enviar Vídeo
                    </a>
                    <a href="goOut.php" class="close-btn font-nigth" title="Sair do Perfil">
                        Sair
                    </a>
                </div>
            </div>
        </div>
    </header>
<body>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" onsubmit="return vali()">
        <label for="title">Título do Vídeo</label>
        <input type="text" name="title" id="title" value='<?php echo $title ?>'>
        <p class='msg-error'></p>
        <label for="thumb" class='thumb'>Clique para mudar a thumb</label>
        <input type="file" name="thumbChange" id="thumb" accept="image/*">
        <img id='img-preview'>
        <button name='submit' class="submit">Confirmar Alteraçoes</button>
        <button name='delete' onclick="return delet()">Apagar Vídeo</button>
    </form>
    <script>
         document.querySelector('.icon').addEventListener('click', function() {
            document.querySelector('.menu').classList.toggle('show-menu');
        });
        function delet(){
           
            if(confirm("Você realmente deseja apagar este vídeo?")){
                return true;
            } else{
                return false;
            }
        }
        function vali(){
            var title = document.querySelector('#title');
            if(title.value.length < 3){
                document.getElementById('title').style.outline = "2px solid red";
                document.querySelector('.msg-error').innerHTML = 'O título precisa ter pelo menos 3 caracteres';
                return false;
            } else {
                document.getElementById('title').style.outline = "none";
                return true;
            }
        }
        //img preview
        const fileInput = document.getElementById('thumb');
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
    <style>
        @import url('../styles/colors.css');
        body{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        header{
            background-color: transparent !important;
        }
        form{
            box-shadow: 0px 0px 10px black;
        }
        #title{
            background-color: var(--color-box-ligth);
            color: var(--color-font-ligth);
        }
        #title:hover, #title:focus{
            outline: 1px solid white;
            box-shadow: 0px 0px 3px white;
        }
        button{

            width: 150px;
            height: 40px;
            color: white;
            background-color: rgba(255, 0, 0, 0.8);
            border-radius: 10px;
            cursor: pointer;
            transition: .3s;
            margin: 10px;
        }
        button:hover{
            background-color: rgba(255, 0, 0, 0.5);
        }
        .submit{

            background-color: rgb(37, 37, 190);
            transition: .3s;
        }
        .submit:hover{
            background-color: rgba(37, 37, 190, 0.7);
        }   
        img{
            width: 300px;
            height: 170px;
            border-radius: 10px;
            background-color: var();
        }
        input[type='file']{
            display: none;
        }
        
        .thumb{
            display: flex;
            place-items: center;
            justify-content: center;
            width: 300px;
            height: 40px;
            cursor: pointer;
            border-radius: 10px;
            background-color: var(--color-box-ligth);
        }
        .thumb:hover{

            outline: 2px solid #3b3b3b;
        }
        .msg-error{
            width: 100%;
            text-align: center;
            font-size: 11px;
            color: red;
        }
        @media (max-width: 768px){
            form{
                width: 100%;
                height: 100%;
                text-align: center;
                box-shadow: none;
            }
            button{

                width: 90%;
                margin: 0;
            }
            .thumb{
                width: 70%;
            }
            #title{

                width: 70%;
            }
        }
    </style>
</body>
</html>