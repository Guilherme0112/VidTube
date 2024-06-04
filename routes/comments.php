<?php
    header('Location: ../index.php');
    session_start();
    include_once('../database/conexao.php');
    if(isset($_SESSION['email']) ){
        $emailSession = $_SESSION['email'];
        $sqlUser = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$emailSession'");
        $dataUser = $sqlUser->fetch_assoc();
        $idUser = $dataUser['id'];
    }   
    if(isset($_POST['comment']) && isset($_POST['idVideo'])){
        $idVideo = $_POST['idVideo'];
        $comentario = $_POST['comment'];
        if(strlen($comentario) > 0){
            $sqlComment = mysqli_query($conexao, "INSERT INTO comentarios VALUES(default, $idUser, $idVideo,'$comentario')");
        }
    }
?>