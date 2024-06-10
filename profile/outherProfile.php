<?php
    session_start();
    include_once('../database/conexao.php');
    if (!isset($_GET['id'])) {
        header('Location: ../index.php');
    } else {
        //data of profile
        $id = $_GET['id'];
        $sql = mysqli_query($conexao, "SELECT * FROM usuarios WHERE id = $id");
        $infoUser = $sql->fetch_assoc();
        $nameUser = $infoUser['nome'];
        $photoProfileUser = $infoUser['photoProfile'];
    }
    if (isset($_SESSION['email'])) {
        $emailSession = $_SESSION['email'];
        $sql3 = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$emailSession'");
        $resp3 = $sql3->fetch_assoc();
        $idSession = $resp3['id'];
    }
    // follow the page
    $sql = mysqli_query($conexao, "SELECT * FROM seguir WHERE idSeguindo = $id");
    $resp = $sql->fetch_assoc();
    $seguidores = mysqli_num_rows($sql);
    $sql2 = mysqli_query($conexao, "SELECT * FROM seguir WHERE idSeguidor = $id");
    $resp2 = $sql->fetch_assoc();
    $seguindo = mysqli_num_rows($sql2);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="../styles/model-of-page.css">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="shortcut icon" href="../styles/icons/icon-ligth.png" type="image/x-icon">
    <script src="../styles/jquery-3.7.1.js"></script>
    <title><?php echo $nameUser; ?></title>
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
                        Em Alta
                    </a>
                    <a href="../settings/settings.php" class="">
                        <i class="fa-solid fa-gear icon-menu"></i>
                        Configurações
                    </a>
                    <?php
                    if (isset($_SESSION['email']) && isset($_SESSION['senha'])) {
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
                                </a>
                                ";
                    }
                    ?>
                </div>
            </div>
        </div>
    </header>
    <section>
        <div class="size-img-profile">
            <img src="<?php echo "$photoProfileUser"; ?>" alt="" class="img-profile" class='photo-profile'>
            <div class="name-space">
                <p class="name">
                    <?php echo $nameUser ?>
                </p>
                <div class="box-follow">
                    <p>Seguidores <?php echo $seguidores ?? 0 ?></p>
                    <p>Seguindo <?php echo $seguindo ?? 0 ?></p>
                </div>
                <div>
                    <?php
                    if (isset($_SESSION['email'])) {
                        if ($id == $idSession) {
                            header('Location: profile.php');
                        } else {
                            $condition = mysqli_query($conexao, "SELECT * FROM seguir WHERE idSeguindo = $id AND idSeguidor = $idSession");
                            if (mysqli_num_rows($condition) < 1) {
                                echo "<input type='submit' class='btn-follow' id='follow' value='Seguir'>";
                            } else {
                                echo "<input type='submit' class='btn-follow' id='unfollow' value='Deixar de Seguir'>";
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

    </section>
    <main>
        <?php
        $sql = mysqli_query($conexao, "SELECT * FROM videos WHERE userVideo = $id");
        while ($i = $sql->fetch_assoc()) {
            $idVideo = $i['idVideo'];
            $title = $i['title'];
            $thumb = $i['thumb'];
            $likes = $i['likes'];

            $sql2 = mysqli_query($conexao, "SELECT * FROM likes WHERE videoLike = $idVideo");
            $likes = mysqli_num_rows($sql2);
            echo "<a href='../page-video/video.php?id=$idVideo' class='size-box-video' title='$title'>
                        <img class='box-video' src='../$thumb'></img>
                        <h3 class='video-title font-nigth'>$title</h3>
                        <p class='views-video font-nigth'> $likes pessoas curtiram</p>
                    </a>";
        }
        ?>
    </main>
    <script>
        document.querySelector('.icon').addEventListener('click', function() {
            document.querySelector('.menu').classList.toggle('show-menu');
        });

        //follow 

        $(function() {
            $('.btn-follow').click(function(e) {
                var profile = "<?php echo $id ?>"
                $.ajax({
                    url: '../routes/follow.php',
                    type: 'POST',
                    data: {
                        follow: profile
                    },
                    success: function(e) {
                        console.log('Sucesso: ' + e)
                        if ($('.btn-follow').val() === 'Seguir') {
                            $('.btn-follow').val("Deixar de Seguir")
                        } else {
                            $('.btn-follow').val("Seguir")
                        }
                    },
                    error: function(e) {
                        console.log('Error: ' + e)
                    }
                });
            });
        });
    </script>
</body>

</html>