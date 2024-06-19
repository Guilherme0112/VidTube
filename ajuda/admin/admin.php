<?php
    session_start();
    include_once('../../database/conexao.php');
    $emailSession = $_SESSION['email'];
    $sqlVerification = mysqli_query($conexao, "SELECT * FROM admin WHERE emailAdmin = '$emailSession'");
    if(mysqli_num_rows($sqlVerification) == 0){
        header('location: ../../index.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="../../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="stylesheet" href="../../styles/model-of-page.css">
    <link rel="shortcut icon" href="../../styles/icons/icon-ligth.png" type="image/x-icon">
    <script defer src="admin.js"></script>
    <title>Administradores</title>
</head>
<body>
    <header>
        <div class="header-one">
        </div>
        <div class="header-two">
            <i class="fas fa-bars icon"></i>
            <div class="menu">
                <div style="margin-top: 40px;">
                    <a href="../../index.php" class="select">
                        <i class="fa-solid fa-house icon-menu"></i>
                        Início
                    </a>
                    <a href="../../settings/settings.php" class="">
                        <i class="fa-solid fa-gear icon-menu"></i>
                        Configurações
                    </a>
                    <a href='../suasAjudas.php'>
                        <i class='fa-solid fa-upload icon-menu'></i>
                        Suas Ajudas
                    </a>
                    <a href='../ajuda.php'>
                        <i class='fa-solid fa-upload icon-menu'></i>
                        Criar Ajuda
                    </a>
                    <a href='../../profile/profile.php'>
                        <i class='fa-solid fa-user icon-menu'></i>
                        Seu Perfil
                    </a>
                    <a href='../../profile/goOut.php' class='close-btn font-nigth'>
                        Sair
                    </a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <?php
            $sql = mysqli_query($conexao, "SELECT *, date_format(timeAjuda, '%d/%m/%Y') FROM ajuda");
            if(mysqli_num_rows($sql) > 0){
                while ($i = $sql->fetch_assoc()){
                $idAjuda = $i['idAjuda'];
                $titleAjuda = $i['title'];
                $situacao = $i['situacao'];
                $textAjuda = $i['textAjuda'];
                $timeAjuda = $i["date_format(timeAjuda, '%d/%m/%Y')"];
                echo "<a href='screenAjuda.php?a=$idAjuda' class='box-post-ajuda'>
                        <h1 class='title'>$titleAjuda</h1>
                        <p class='time'>$situacao</p>      
                        <p class='time'>$timeAjuda</p>      

                    </a>";
                }
            } else {
                echo "Nenhuma ajuda pendente";
            }
            
        ?>
        
    </main>   
</body>
</html>