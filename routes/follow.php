<?php
    header('Location: ../index.php');
    include_once('../database/conexao.php');
    session_start();
    if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
        $sql = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$email'");
        $resp = $sql->fetch_assoc();
        $idSession = $resp['id'];
    }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['follow'])){
        $profile = $_POST['follow'];
        if($profile != $idSession){
            $condition = mysqli_query($conexao, "SELECT * FROM seguir WHERE idSeguindo = $profile AND idSeguidor = $idSession");
            if(mysqli_num_rows($condition) < 1){
                $sql2 = mysqli_query($conexao, "INSERT INTO seguir VALUES(default, $profile, $idSession)"); 
            } else {
                $sql2 = mysqli_query($conexao, "DELETE FROM seguir WHERE idSeguindo = $profile AND idSeguidor = $idSession"); 
            }
        }
    }
} 
?>