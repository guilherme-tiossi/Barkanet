<?php
require 'conexao.php';
require_once 'lib/includes.php';
if($_POST["txcom"] != ""){
  $comentar = $_POST["txcom"];
  $post_id = $_POST["post_id"];
  $email_com = $_SESSION['email'];
  $id = $_SESSION['userId'];
  $idgrupo = $_POST["grupo_id"];
  $idamigo = $_POST["id_amigo"];
  $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = $id");
  $stmt -> execute();
  foreach($stmt as $row){
    $nome = $row['nome'];
    $pfp = $row['profilepic'];
  }
  $stmt = $pdo->prepare("INSERT INTO comentarios(id_post, com_nome, com_user, comentario, profilepic) VALUES ('$post_id', '$nome', '$id', '$comentar', '$pfp')");
  $stmt -> execute();
  if ($idamigo >= 1 && $idgrupo == 0){
    echo " <script> document.location.href = 'pgamigo.php?id=$idamigo' </script>";
  }
  else if ($idgrupo >= 1){
    echo " <script> document.location.href = 'pggrupo.php?id_grupo=$idgrupo' </script>";
  }
  else{
  header('Location: posts.php');
  }
}
else{
  header('Location: posts.php');
}
?>