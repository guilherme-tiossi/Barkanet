<?php
require 'perfil.php';
require 'conexao.php';
require_once 'lib/functions.php';
if($_POST["txcom"] != ""){
  $comentar = $_POST["txcom"];
  $post_id = $_POST["post_id"];
  $email_com = $_SESSION['email'];
  $stmt = $pdo->prepare("insert into comentarios(id_post, com_nome, com_user, comentario) values ('$post_id', '$nome', '$id', '$comentar')");
  $stmt -> execute();
  echo
  "
  <script>
	document.location.href = 'posts.php';
  </script>
  ";
}
else{
  echo
  "
  <script>
	document.location.href = 'posts.php';
  </script>
  ";
}
?>