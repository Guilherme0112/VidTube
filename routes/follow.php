<?php
    //header('Location: ../index.php');
    include_once('../database/conexao.php');
    session_start();
    if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
        $sql = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$email'");
        $resp = $sql->fetch_assoc();
        $idSession = $resp['id'];
    }
    $follower = $_POST['follow'];
    if(isset($_POST['follow'])){
        $follower = $_POST['follow'];
        //$sql2 = mysqli_query($conexao, "INSERT INTO seguir VALUES (DEFAULT, $idSession, $follower");
        echo "<script>
                console.log('Dado recebido: ' + $follower)
            </script>";
    } else {
        echo "<script>
                console.log('Dado nao recebido')
            </script>";
    }
?>