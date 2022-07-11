<?php
require 'conexao.php';
session_start();
$email = $_SESSION['email'];
$stmt1 = $pdo->prepare("select * from usuarios where email = '$email'");
$stmt1 ->execute();

foreach($stmt1 as $row) {
    $email = $row['email'];
    $id = $row['id'];
    $nome = $row['nome'];
}

if(isset($_POST["submit"])){
  $nomegrupo = $_POST["txNomeGrupo"];
  $descgrupo = $_POST["txDescricaoGrupo"];
  $tipogrupo = $_POST["optTipoGrupo"];
  $stmt = $pdo->prepare("insert into tbgrupos values ('', '$nomegrupo', '$descgrupo', '$tipogrupo' , '$id')");
  $stmt->execute();
  $stmt = $pdo->prepare("SELECT * FROM tbgrupos WHERE nome_grupo = '$nomegrupo' AND adm_grupo = '$id'");
  $stmt ->execute();

  foreach ($stmt as $row) :
    $id_grupo = $row['id_grupo'];
    $stmt = $pdo->prepare("insert into membros_grupos values ('', '$id', '$id', '$id_grupo', '1')");
    $stmt ->execute();
  endforeach;

  echo " <script> document.location.href = 'pggrupo.php?id_grupo=$id_grupo' </script>";
}
?>
