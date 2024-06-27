<?php
    session_start();
    include_once('../database/conexao.php');
    if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
        header('location: ../index.php');
    }
    $email = $_SESSION['email'];
    $sql = mysqli_query($conexao, "SELECT * FROM users WHERE email = '$email'");
    $resp = $sql->fetch_assoc();
    $idSession = $resp['id'];
    $nome = $resp['nome'];
    $photoProfile = $resp['photoProfile'];
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loja.css">
    <link rel="stylesheet" href="../classes.css">
    <script src="loja.js"></script>
    <link rel="shortcut icon" href="../photos/icone.ico" type="image/x-icon">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <title><?php echo $nome ?></title>
</head>
<body>
    <header>
        <div class="header_1">
            <a href="../index.php">
                <img src="../photos/icone.ico" alt="" class="icon">
            </a>
            <a href="../promotions/promotions.php" class="line-of-options" style="color: white;">Promoções</a>
            <a href="" class="line-of-options" style="color: white;">Lojas</a>
            <a href="" class="line-of-options" style="color: white;">Ajuda</a>
            <a href="../config/config.php" class="line-of-options" style="color: white;">Editar Perfil</a>
        </div>
        <div class='header_2'>
            <a href='../login/logout.php' title='Sair' class='fa-solid fa-right-from-bracket'></a>
        </div>
    </header>
    <section class="first-part">
        <div>
            <img src="<?php echo $photoProfile ?>" class="photoUser">
        </div>
        <div>
            <p class="nome-user"><?php echo $nome ?></p>
        </div>
    </section>
    <main>
        <?php
            $sql = mysqli_query($conexao, "SELECT * FROM products WHERE ownerProduct = $idSession");
            if(mysqli_num_rows($sql) == 0){
                echo "
                        <p class='msg-product'>
                            Você não postou nenhum produto
                            <a href='' class='line-of-options'>Postar agora</a>
                        </p>
                        ";
            } else {
                echo "";
            }
        ?>
    </main>
</body>
</html>