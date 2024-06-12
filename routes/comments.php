<?php
    session_start();
    include_once('../database/conexao.php');
    if(isset($_SESSION['email']) ){
        $emailSession = $_SESSION['email'];
        $sqlUser = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$emailSession'");
        $dataUser = $sqlUser->fetch_assoc();
        $idUser = $dataUser['id'];
        if(isset($_POST['comment']) && isset($_POST['idVideo'])){
            $idVideo = $_POST['idVideo'];
            $comentario = $_POST['comment'];           
            if(strlen($comentario) > 0){
                $sqlComment = mysqli_query($conexao, "INSERT INTO comentarios VALUES (default, $idUser, $idVideo, '$comentario', default)");
                
                $sql = mysqli_query($conexao, "SELECT * FROM comentarios WHERE idVideoComment = $idVideo");
                $resp = $sql->fetch_assoc();
                echo json_encode($res);
            }
            
            
        }
        if(isset($_POST['deleteComment'])){
            $dComment = $_POST['deleteComment'];
            $sql = mysqli_query($conexao, "SELECT idUserComment FROM comentarios WHERE idComment = $dComment");
            $resp = $sql->fetch_assoc();
            $idUserComment = $resp['idUserComment'];
            if($idUserComment == $idUser){
                $sql2 = mysqli_query($conexao, "DELETE FROM comentarios WHERE idComment = $dComment AND idUserComment = $idUser");
            }
        }
    }
    
?>