<?php
    session_start();
    include_once('../database/conexao.php');
    if(isset($_SESSION['email']) ){
        $emailSession = $_SESSION['email'];
        $sqlUser = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$emailSession'");
        $dataUser = $sqlUser->fetch_assoc();
        $idSession = $dataUser['id'];
        if(isset($_POST['comment']) && isset($_POST['idVideo'])){
            $idVideo = $_POST['idVideo'];
            $comentario = $_POST['comment'];           
            if(strlen($comentario) > 0){
                $sqlComment = mysqli_query($conexao, "INSERT INTO comentarios VALUES (default, $idSession, $idVideo, '$comentario', default)");
            }   
        }
        if(isset($_POST['deleteComment'])){
            $idComment = $_POST['deleteComment'];
            $sql = mysqli_query($conexao, "SELECT idUserComment FROM comentarios WHERE idComment = $idComment");
            $resp = $sql->fetch_assoc();
            $idUserComment = $resp['idUserComment'];
            //echo "Id do usuario do comentario " . $idUserComment;
            //echo "Id da sessao " . $idSession;
            if($idUserComment === $idSession){
                $sql2 = mysqli_query($conexao, "DELETE FROM comentarios WHERE idComment = $idComment AND idUserComment = $idSession");
            }
        }
    }
    
    // delete ajuda

    if(isset($_POST['remove'])){
        $idAjuda = $_POST['remove'];
        $sqlRemove = mysqli_query($conexao, "DELETE FROM ajuda WHERE idAjuda = $idAjuda");
    }

?>
