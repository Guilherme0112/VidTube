<?php
include_once('../database/conexao.php');
session_start();
// data user session
if (isset($_SESSION['email'])) {
    $emailSession = $_SESSION['email'];
    $sqlSession = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$emailSession'");
    $respSession = $sqlSession->fetch_assoc();
    $nameSession = $respSession['nome'] ?? '';
    $photoProfileSession = $respSession['photoProfile'] ?? '';
    $idSession = $respSession['id'] ?? '';
}
// video verification
if (isset($_GET['id'])) {
    $idVideo = $_GET['id'];
} else {
    header('Location: video.php');
}
// data video
$sql = mysqli_query($conexao, "SELECT * FROM videos WHERE idVideo = $idVideo");
$resp = $sql->fetch_assoc();
$video = $resp['video'] ?? '';
$title = $resp['title'] ?? '';
$idUserVideo = $resp['userVideo'];
// data user create video  
$sql2 = mysqli_query($conexao, "SELECT * FROM usuarios WHERE id = $idUserVideo");
$resp2 = $sql2->fetch_assoc();
$name = $resp2['nome'] ?? '';
$idUser = $resp2['id'] ?? '';
$userPhoto = $resp2['photoProfile'] ?? '';
//Amount likes of video
$sql4 = mysqli_query($conexao, "SELECT * FROM likes WHERE videoLike = $idVideo");
$amountLikes = mysqli_num_rows($sql4);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="video.css">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="stylesheet" href="../styles/model-of-page.css">
    <script src="video.js" defer></script>
    <link rel="shortcut icon" href="../styles/icons/icon-ligth.png" type="image/x-icon">
    <script src="../styles/jquery-3.7.1.js"></script>
    <title><?php echo $title ?></title>
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

    <body>

        <!-- box video -->

        <video src="<?php echo $video ?>" controls class="box-picture" type='video/mp4'>
        </video>
        <div class='box-title'>
            <h1 class='title font-nigth'><?php echo $title ?></h1>
        </div>

        <!-- video title and follow button -->

        <div class="box-interaction">
            <img src="<?php echo $userPhoto ?>" alt="">
            <a href="../profile/outherProfile.php?id=<?php echo $idUser; ?>" class="font-nigth"><?php echo $name ?></a>
            <?php
            if (isset($_SESSION['email'])) {
                if ($idSession != $idUser) {
                    $condition = mysqli_query($conexao, "SELECT * FROM seguir WHERE idSeguindo = $idUser AND idSeguidor = $idSession");
                    if (mysqli_num_rows($condition) < 1) {
                        echo "<input type='button' class='btn' value='Seguir'>";
                    } else {
                        echo "<input type='button' class='btn' value='Deixar de Seguir'>";
                    }
                } else {
                    echo "<a href='../profile/profile.php'>
                                <button class='btn'>Ver meu Perfil</button>
                            </a>";
                }
            }

            ?>
            <?php
            if (isset($_SESSION['email'])) {
                $condition = mysqli_query($conexao, "SELECT * FROM likes WHERE videoLike = $idVideo AND userLike = $idSession");
                if (mysqli_num_rows($condition) == 0) {
                    echo "<i class='fa-regular fa-heart icon-interaction font-nigth' id='like' title='Like' value='true'></i><span class='amountLikes'>$amountLikes</span>";
                } else {
                    echo "<i class='fa-solid fa-heart icon-interaction font-nigth' id='like' title='Like' value='false'></i><span class='amountLikes'>$amountLikes</span>";
                }
            }

            ?>

        </div>
        <section class="comments">
            <?php
            if (isset($_SESSION['email'])) {
                echo "
                    <form action='video.php' method='POST' class='box-comments'>
                        <img src='$photoProfileSession' alt=''>
                        <a href='../profile/profile.php' class='nameComment'>$nameSession</a>
                        <input type='text' class='inputComment' placeholder='Diga a sua opinião'>
                        <button name='submitComment' class='submitComment'>Postar</button>
                    </form>
                    ";
            }
            ?>
            <script>
                var nameComment = "<?php echo $nameSession ?>"
                var photoComment = "<?php echo $photoProfileSession ?>"
                var userId = "<?php echo $idSession ?>";
                var idVideo = "<?php echo $idVideo; ?>";
                $(function() {
                    $('.comments').submit(function(e) {
                        e.preventDefault();
                        var comentario = $('.inputComment').val();
                        $.ajax({
                            url: '../routes/comments.php',
                            type: 'POST',
                            data: {
                                comment: comentario,
                                idVideo: idVideo
                            },
                            success: function(e) {
                                console.log('Sucesso: ' + e)
                            },
                            error: function(e) {
                                console.log('Error: ' + e)
                            }
                        }).done(function(e) {
                            $('.comments').children().eq(1).after("<div class='box-comments'><img src='" + photoComment + "' alt=''><a href='../profile/outherProfile.php?id=" + userId + "' class='nameComment text-line-effect'>" + nameComment + "</a><span style='width: 100%;'</span><p class='comment'>" + comentario + "</p></div>");
                            $('input').val('');
                        });
                    });
                });
                $(function() {
                    $('.btn').click(function(e) {
                        var profile = "<?php echo $idUser ?>"
                        $.ajax({
                            url: '../routes/follow.php',
                            type: 'POST',
                            data: {
                                follow: profile
                            },
                            success: function(e) {
                                console.log('Sucesso: ' + e)
                                if ($('.btn').val() === 'Seguir') {
                                    $('.btn').val("Deixar de Seguir")
                                } else {
                                    $('.btn').val("Seguir")
                                }
                            },
                            error: function(e) {
                                console.log('Error: ' + e)
                            }
                        });
                    });
                });
                $(function() {
                    $('#like').click(function(e) {
                        $.ajax({
                            url: '../routes/likes.php',
                            type: 'POST',
                            data: {
                                like: idVideo
                            },
                            success: function(e) {
                                document.getElementById("like").classList.toggle("fa-regular");
                                document.getElementById("like").classList.toggle("fa-solid");

                            }
                        })
                    })
                })
            </script>
            <?php
            // comments
            $sql3 = mysqli_query($conexao, "SELECT u.id, u.nome, u.photoProfile, c.comentario, c.idVideoComment FROM comentarios c JOIN usuarios u ON c.idUserComment = u.id WHERE idVideoComment = $idVideo;");
            while ($i = $sql3->fetch_assoc()) {
                $idComment = $i['id'];
                $photoComment = $i['photoProfile'];
                $userComment = $i['nome'];
                $comment = $i['comentario'];
                echo "
                    <div class='box-comments'>
                        <img src='$photoComment' alt=''>
                        <a href='../profile/outherProfile.php?id=$idComment' class='nameComment text-line-effect'>$userComment</a>
                        <span style='width: 100%;'</span>
                        <p class='comment'>$comment</p>
                    </div>
                    ";
            }
            ?>

        </section>
    </body>

</html>