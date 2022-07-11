<?php
include("conexao.php");
$stmt = $pdo->prepare("SELECT * FROM tbgrupos WHERE adm_grupo = {$_SESSION['userId']}");
$stmt ->execute();

foreach ($stmt as $row) :
  $id_grupo = $row['id_grupo'];
  $nome_grupo = $row['nome_grupo'];
endforeach;
?>

<div>
  <div>
    <a href="posts.php">Timeline Amigos</a>
    <br>
    <a href="grupos.php">Criar Novo Grupo</a>
    <br>
    <p>Seus Grupos:</p>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM tbgrupos WHERE adm_grupo = {$_SESSION['userId']}");
    $stmt ->execute();

    foreach ($stmt as $row) :
      $id_grupo = $row['id_grupo'];
      $nome_grupo = $row['nome_grupo'];
      echo "<a href='pggrupo.php?id_grupo=$id_grupo'>$nome_grupo</a>";
      echo "<br>";
    endforeach;
    ?>

    <p>Grupos que você participa:</p>
    <?php
    $stmt = $pdo->prepare("SELECT *
    FROM tbgrupos
    WHERE EXISTS (SELECT id_grupo FROM membros_grupos WHERE id_grupo = tbgrupos.id_grupo and id_usuario = '$id')");
    $stmt ->execute();

    foreach ($stmt as $row) :
      $nome_grupo = $row['nome_grupo'];
      $id_grupo = $row['id_grupo'];
      echo "<a href='pggrupo.php?id_grupo=$id_grupo'>$nome_grupo</a>";
      echo "<br>";
    endforeach;
    ?>
  </div>
</div>
<br>
<br>
