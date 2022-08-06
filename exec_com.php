<?php
require 'conexao.php';
require_once 'lib/includes.php';
if($_POST["txcom"] != ""){
  $comentar = $_POST["txcom"];
  $post_id = $_POST["post_id"];
  $email_com = $_SESSION['email'];
  $id = $_SESSION['userId'];
  $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = $id");
  $stmt -> execute();
  foreach($stmt as $row){
    $nome = $row['nome'];
    $pfp = $row['profilepic'];
  }
  $stmt = $pdo->prepare("INSERT INTO comentarios(id_post, com_nome, com_user, comentario, profilepic) VALUES ('$post_id', '$nome', '$id', '$comentar', '$pfp')");
  $stmt -> execute();
  
  header('Location: posts.php');
}
else{
  header('Location: posts.php');
}
?>