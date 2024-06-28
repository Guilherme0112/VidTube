<?php
session_start();
 //var_dump($_POST);
 if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])){

     include_once('../database/conexao.php');
     $email = $_POST['email'];
     $senha = $_POST['senha'];
     $sql = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha'";
     $return = $conexao->query($sql);

     if(mysqli_num_rows($return) > 0){
         header('Location: ../profile/profile.php');
         $_SESSION['email'] = $email;
         $_SESSION['senha'] = $senha;
     } else {
         header('Location: login.php');
         unset($_SESSION['email']);
         unset($_SESSION['senha']);
         
     }
 } else {

     header('Location: login.php');

 }

 ?>