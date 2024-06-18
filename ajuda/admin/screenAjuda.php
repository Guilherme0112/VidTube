<?php
    session_start();
    include_once('../../database/conexao.php');
    $emailSession = $_SESSION['email'];
    $sqlVerification = mysqli_query($conexao, "SELECT * FROM admin WHERE emailAdmin = '$emailSession'");
    if(mysqli_num_rows($sqlVerification) == 0 || !isset($_GET['a'])){
        header('location: ../../index.php');
    }

    $idAjuda = $_GET['a'];
    $sqlQuery = mysqli_query($conexao, "SELECT *, date_format(timeAjuda, '%d/%m/%Y') FROM ajuda WHERE idAjuda = $idAjuda");
    $rQuery = $sqlQuery->fetch_assoc();
    $title = $rQuery['title'];
    $idAjuda = $rQuery['idAjuda'];
    $text = $rQuery['textAjuda'];
    $time = $rQuery["date_format(timeAjuda, '%d/%m/%Y')"];

    if(isset($_POST['submit'])){
        if(isset($_POST['response'])){
            $response = $_POST['response'];
            if(strlen($response) > 0){
                $sql = mysqli_query($conexao, "INSERT INTO respajuda VALUES (default, $idAjuda, '$response', default)");
                if($sql){
                    $sql2 = mysqli_query($conexao, "UPDATE ajuda SET situacao = 'Respondido' WHERE idAjuda = $idAjuda");
                    header('location: admin.php');
                }
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
    <link rel="stylesheet" href="../../styles/model-of-page.css">
    <link rel="shortcut icon" href="../../styles/icons/icon-ligth.png" type="image/x-icon">
    <link rel="stylesheet" href="../../fontawesome-free-6.5.1-web/css/all.min.css">
    <script src="../../styles/jquery-3.7.1.js"></script>
    <title>Resposta ao usuário</title>
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
                    <a href='../suasAjudas.php'>
                        <i class='fa-solid fa-upload icon-menu'></i>
                        Suas Ajudas
                    </a>
                    <a href="../../settings/settings.php" class="">
                        <i class="fa-solid fa-gear icon-menu"></i>
                        Configurações
                    </a>
                    <a href='../../profile/profile.php'>
                        <i class='fa-solid fa-user icon-menu'></i>
                        Seu Perfil
                    </a>
                </div>
            </div>
        </div>
    </header>   
    <main>
        <div class='box-ajuda'>
            <input type='text' class='idAjuda' value='<?php echo $idAjuda ?>' style='display: none;'>
            <p class='name'><?php echo $title ?></p>
            <p class='time'><?php echo $time ?></p>
            <p class='text'><?php echo $text ?></p>
            <button class=' fa-solid fa-trash btn-remove'></button>
        </div>
        <form action='<?php $_SERVER['PHP_SELF'] ?>' method="post" class="box-response">
            <textarea name="response" placeholder='Responda o usuario'></textarea>
            <input type="submit" name='submit' value="Reponder">
        </form>
    </main>
    <script>
        document.querySelector('.icon').addEventListener('click', function () {
            document.querySelector('.menu').classList.toggle('show-menu');
        });
        $('.btn-remove').click(function(){
            var resp = confirm('Você deseja realmente apagar esta solicitaçao?');
            if(resp){
                var idAjuda = $('.idAjuda').val()
                $.ajax({
                    url: '../../routes/comments.php',
                    method: 'POST',
                    data: {remove: idAjuda},
                    success: function(e){
                        console.log('Success:' + e)
                        location.href = 'admin.php';
                    }, error: function(e){
                        console.log('Error: ' + e)
                    }
                });
            } 
        });
            
    </script>
    <style>
        @import url('../../styles/colors.css');
        main{
            width: 100%;
            margin-top: 70px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }
        .box-ajuda{
            width: 500px;
            height: auto;
            background-color: var(--color-box-ligth);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            padding: 10px;
            border-radius: 10px;
            margin: 20px 0;
        }
        .btn-remove{
            width: 40px;
            height: 40px;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            cursor: pointer;
            background-color: rgb(200, 0, 0);
            margin: 20px 0;
        }
        .name{
            width: 70%;
            height: 20px;
            font-size: 12px;
            opacity: 0.7;
        }
        .time{
            width: 30%;
            height: 20px;
            font-size: 12px;
            opacity: 0.7;
        }
        .text{
            width: 100%;
        }
        .box-response{

            width: 500px;
            height: auto;
            background-color: var(--color-box-ligth);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            padding: 10px;
            border-radius: 10px;
        }
        textarea{

            border-radius: 10px;
            background-color: var(--color-background-ligth);
            resize: none;
            padding: 10px;
            width: 90%;
            height: 200px;
            margin: 20px 0;
        }
        input[type='submit']{

            width: 90%;
            height: 40px;
            border-radius: 10px;
            background-color: rgb(24, 182, 24);
            cursor: pointer;
            color: white;
            transition: .3s;
        }
        input[type='submit']:hover{

            box-shadow: 0 0 7px rgb(24, 182, 24);
        }
        
    </style>
</body>
</html>