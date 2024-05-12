<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styles/model-of-page.css">
    <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/all.min.css">
    <script src="scripts.js" defer></script>
    <link rel="shortcut icon" href="/project/styles/icon.png" type="image/x-icon">
    <title>Início</title>
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
                    <a href="/project/index.php" class="select">
                        <i class="fa-solid fa-house icon-menu"></i>
                        Início
                    </a>
                    <a href="lives/lives.php">
                        <i class="fa-solid fa-tower-broadcast icon-menu"></i>
                        Lives
                    </a>
                    <a href="#">
                        <i class="fa-solid fa-fire icon-menu"></i>
                        Em Alta
                    </a>
                    <a href="settings/settings.php" class="">
                        <i class="fa-solid fa-gear icon-menu"></i>
                        Configurações
                    </a>
                    <?php 
                        session_start();
                        if(isset($_SESSION['email']) && isset($_SESSION['senha'])){
                            echo "<a href='./profile/profile.php'>
                                    <i class='fa-solid fa-user icon-menu'></i>
                                    Seu Perfil
                                </a>
                                <a href='profile/goOut.php' class='close-btn font-nigth' title='Sair do Perfil'>
                                    Sair
                                </a>";
                        } else {
                            echo "<a href='./register/register.php'>
                                    <i class='fa-solid fa-user icon-menu'></i>
                                    Criar Conta
                                </a>
                                <a href='./login/login.php'>
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
    <main id="primary-page-video">
        <a href='page-video/video.php' class="size-box-video">
            <div class="box-video"></div>
            <h3 class="video-title font-nigth ">Título do video</h3>
            <p class="views-video font-nigth">0 visualizaçoes</p>
        </a>
        <a href='page-video/video.php' class="size-box-video">
            <div class="box-video"></div>
            <h3 class="video-title font-nigth ">Título do video</h3>
            <p class="views-video font-nigth">0 visualizaçoes</p>
        </a>
        <a href='page-video/video.php' class="size-box-video">
            <div class="box-video"></div>
            <h3 class="video-title font-nigth ">Título do video</h3>
            <p class="views-video font-nigth">0 visualizaçoes</p>
        </a>
        <a href='page-video/video.php' class="size-box-video">
            <div class="box-video"></div>
            <h3 class="video-title font-nigth ">Título do video</h3>
            <p class="views-video font-nigth">0 visualizaçoes</p>
        </a>
        <a href='page-video/video.php' class="size-box-video">
            <div class="box-video"></div>
            <h3 class="video-title font-nigth ">Título do video</h3>
            <p class="views-video font-nigth">0 visualizaçoes</p>
        </a>
        <a href='page-video/video.php' class="size-box-video">
            <div class="box-video"></div>
            <h3 class="video-title font-nigth ">Título do video</h3>
            <p class="views-video font-nigth">0 visualizaçoes</p>
        </a>
        <a href='page-video/video.php' class="size-box-video">
            <div class="box-video"></div>
            <h3 class="video-title font-nigth ">Título do video</h3>
            <p class="views-video font-nigth">0 visualizaçoes</p>
        </a>
        <a href='page-video/video.php' class="size-box-video">
            <div class="box-video"></div>
            <h3 class="video-title font-nigth ">Título do video</h3>
            <p class="views-video font-nigth">0 visualizaçoes</p>
        </a>
        <a href='page-video/video.php' class="size-box-video">
            <div class="box-video"></div>
            <h3 class="video-title font-nigth ">Título do video</h3>
            <p class="views-video font-nigth">0 visualizaçoes</p>
        </a>
        <a href='page-video/video.php' class="size-box-video">
            <div class="box-video"></div>
            <h3 class="video-title font-nigth ">Título do video</h3>
            <p class="views-video font-nigth">0 visualizaçoes</p>
        </a>
        <a href='page-video/video.php' class="size-box-video">
            <div class="box-video"></div>
            <h3 class="video-title font-nigth ">Título do video</h3>
            <p class="views-video font-nigth">0 visualizaçoes</p>
        </a>
        <a href='page-video/video.php' class="size-box-video">
            <div class="box-video"></div>
            <h3 class="video-title font-nigth ">Título do video</h3>
            <p class="views-video font-nigth">0 visualizaçoes</p>
        </a>
    </main>
    <main id="primary-page-post">
        <div class="box-post">
            <div class="img-post">
                <img src="" alt="">
            </div>
        </div>
        <div class="box-post">
            <div class="img-post">
                <img src="" alt="">
            </div>
        </div>
        <div class="box-post">
            <div class="img-post">
                <img src="" alt="">
            </div>
        </div>
        <div class="box-post">
            <div class="img-post">
                <img src="" alt="">
            </div>
        </div>
        <div class="box-post">
            <div class="img-post">
                <img src="" alt="">
            </div>
        </div>
        <div class="box-post">
            <div class="img-post">
                <img src="" alt="">
            </div>
        </div>
    </main>
</body>
<script>
    document.querySelector('.icon').addEventListener('click', function () {
        document.querySelector('.menu').classList.toggle('show-menu');
    });
</script>
</html>