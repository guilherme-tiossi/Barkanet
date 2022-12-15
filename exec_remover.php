<?php
require 'conexao.php';
session_start();

$idgrupo = $_GET['id_grupo'];
$email = $_SESSION['email'];
$stmt1 = $pdo->prepare("SELECT * FROM usuarios WHERE email = '$email'");
$stmt1 ->execute();

foreach($stmt1 as $row) {
    $id = $row['id'];
}
    if(!isset($idgrupo)){
      $stmt = $pdo->prepare("UPDATE usuarios SET profilepic = 'avatar.jpg' WHERE id = '$id'");
      $stmt->execute();
      $stmt = $pdo->prepare("UPDATE tbposts SET profilepic = 'avatar.jpg' WHERE usuario = '$id'");
      $stmt->execute();
      $stmt = $pdo->prepare("UPDATE comentarios SET profilepic = 'avatar.jpg' WHERE com_user = '$id'");
      $stmt->execute();
      header("Location: perfil.php?editar&pag=1");
    }
    else{
      $stmt = $pdo->prepare("UPDATE tbgrupos SET foto_grupo= 'grupo.png' where id_grupo = '".$idgrupo."'");
      $stmt->execute();
      header("Location: pggrupo.php?editar-grupo&id_grupo=$idgrupo&pag=1");
    }
?>