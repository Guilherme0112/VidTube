<?php
    header('location: ../index.php');
    session_start();
    include_once('../database/conexao.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['like']) && isset($_SESSION['email'])){
            $likeVideo = $_POST['like'];
            $emailSession = $_SESSION['email'];
            $info = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$emailSession'");
            $resp = $info->fetch_assoc();
            $idUser = $resp['id'];
            $condition = mysqli_query($conexao, "SELECT * FROM likes WHERE videoLike = $likeVideo AND userLike = $idUser");
            if(mysqli_num_rows($condition) == 0){
                $sql = mysqli_query($conexao, "INSERT INTO likes VALUES (default, $likeVideo, $idUser)");
            } else {
                $sql = mysqli_query($conexao, "DELETE FROM likes WHERE videoLike = $likeVideo AND userLike = $idUser");
            }
        }
    }
?>