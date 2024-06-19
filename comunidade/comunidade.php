<?php
    session_start();
    include_once('../database/conexao.php');
    if (isset($_SESSION['email'])) {
        $emailSession = $_SESSION['email'];
        $sqlSession = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$emailSession'");
        $respSession = $sqlSession->fetch_assoc();
        $idSession = $respSession['id'];
    } else {
        $idSession = $respSession['id'] ?? '';
    }
    if(isset($_POST['deletePost'])){
        $idPost = $_POST['deletePost'];
        $sqlVerification = mysqli_query($conexao, "SELECT * FROM comunidade WHERE idPost = $idPost");
        $rVerification = $sqlVerification->fetch_assoc();
        $idCreatePost = $rVerification['idPostUser'];
        $photoPost = $rVerification['post'];
        if($idCreatePost == $idSession){
            $delete = mysqli_query($conexao, "DELETE FROM comunidade WHERE idPost = $idPost");
            if(file_exists($photoPost)){
                unlink($photoPost);
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
    <link rel="stylesheet" href="../styles/model-of-page.css">
    <link rel="stylesheet" href="comunidade.css">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <script src="comunidade.js"></script>
    <script src="../styles/jquery-3.7.1.js"></script>
    <link rel="shortcut icon" href="../styles/icons/icon-ligth.png" type="image/x-icon">
    <title>Comunidade</title>
</head>

<body>
    <header>
        <div class="header-one">
            <?php
                if (isset($_SESSION['email'])) {
                    echo "<button class='btn-post'>Criar Postagem</button>";
                }
            ?>
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
                    <?php
                    if (isset($_SESSION['email'])) {
                        echo "
                                <a href='../profile/uploadVideo/uploadVideo.php'>
                                    <i class='fa-solid fa-upload icon-menu'></i>
                                    Enviar Vídeo
                                </a>
                                <a href='../profile/profile.php'>
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
                                </a>
                                ";
                    }
                    ?>
                </div>
            </div>
        </div>
    </header>
    <main>
        <?php
        $sql = mysqli_query($conexao, "SELECT c.idPost, c.idPostUser, c.post, c.descPost, date_format(c.timePost, '%d/%m/%Y'), u.photoProfile, u.nome FROM comunidade c JOIN usuarios u WHERE c.idPostUser = u.id;");
        while ($i = $sql->fetch_assoc()) {
            $idPost = $i['idPost'];
            $idPostUser = $i['idPostUser'];
            $namePostUser = $i['nome'];
            $photoProfilePostUser = $i['photoProfile'];
            $post = $i['post'];
            $descPost = $i['descPost'];
            $timePost = $i["date_format(c.timePost, '%d/%m/%Y')"];
            if($idPostUser == $idSession){
                if(!file_exists($post)){
                    echo "
                            <div class='boxPost' title='$descPost'>
                                <input style='display: none;' id='idPost' value='$idPost'>
                                <div class='boxPost1'>
                                    <img src='$photoProfilePostUser' class='photoUserPost'>
                                    <a href='../profile/outherProfile.php?id=$idPostUser' class='nameUserPost'>$namePostUser</a>
                                    <span class='timePost'>$timePost</span>
                                    <button class='fa-solid fa-trash delete'>
                                </div>
                                <p class='textPost'>$descPost</p>
                            </div>
                        ";  
                } else {
                    echo "
                            <div class='boxPost' title='$descPost'>
                                <input style='display: none;' id='idPost' value='$idPost'>
                                <div class='boxPost1'>
                                    <img src='$photoProfilePostUser' class='photoUserPost'>
                                    <a href='../profile/outherProfile.php?id=$idPostUser' class='nameUserPost'>$namePostUser</a>
                                    <span class='timePost'>$timePost</span>
                                    <button class='fa-solid fa-trash delete'>
                                </div>
                                <p class='textPost'>$descPost</p>
                                <img src='$post' class='photoPost'>
                            </div>
                        ";  
                    }   
                } else { 
                    if(!file_exists($post)){
                        echo "
                                <div class='boxPost' title='$descPost'>
                                    <div class='boxPost1'>
                                        <img src='$photoProfilePostUser' class='photoUserPost'>
                                        <a href='../profile/outherProfile.php?id=$idPostUser' class='nameUserPost'>$namePostUser</a>
                                        <span class='timePost'>$timePost</span>
                                    </div>
                                    <p class='textPost'>$descPost</p>
                                </div>
                            ";
                    } else {

                        echo "
                                <div class='boxPost' title='$descPost'>
                                    <div class='boxPost1'>
                                        <img src='$photoProfilePostUser' class='photoUserPost'>
                                        <a href='../profile/outherProfile.php?id=$idPostUser' class='nameUserPost'>$namePostUser</a>
                                        <span class='timePost'>$timePost</span>
                                    </div>
                                    <p class='textPost'>$descPost</p>
                                    <img src='$post' class='photoPost'>
                                </div>
                            ";
                    }
                }
        }
        ?>
    </main>
    <script>
        document.querySelector('.icon').addEventListener('click', function() {
            document.querySelector('.menu').classList.toggle('show-menu');
        });
        document.querySelector('.btn-post').addEventListener('click', function() {
            location.href = 'createPost.php';
        });
        document.querySelectorAll('.delete').forEach(button => {
            button.addEventListener('click', function (event) {
            var idPost = $('#idPost').val()
            $.ajax({
                url: 'comunidade.php',
                method: 'POST',
                data: { deletePost: idPost },
                success: function (event) {
                console.log('Success')
        
                }, error: function (e) {
                console.log('Error: ' + e);
                }
            })
            const targetDiv = event.target.closest('.boxPost');
            targetDiv.remove();
            });
        });
    </script>
</body>

</html>