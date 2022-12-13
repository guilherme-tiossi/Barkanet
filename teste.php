<?php
include "lib/includes.php";
include "conexao.php";
$iduser = $_SESSION['userId'];
$stmt = $pdo->prepare("select * from tbgrupos where adm_grupo = $iduser");
$stmt->execute();
echo '<form action="exec_teste.php" method="post">';

foreach ($stmt as $row):
  $nome_grupo = $row['nome_grupo'];
  $id_grupo = $row['id_grupo'];
  echo '<label for="membro">Escolha um membro para ser o próximo administrador do grupo ' . $nome_grupo . '('. $id_grupo . '):</label>
  <select name="' . $id_grupo .'" id="' . $nome_grupo . '">';
  $stmt = $pdo->prepare("select id_usuario, id_grupo from membros_grupos where id_grupo = $id_grupo AND id_usuario != $iduser");
  $stmt->execute();
  foreach ($stmt as $row):
    $id = $row['id_usuario'];
    $id_grupo = $row['id_grupo'];
    $stmt = $pdo->prepare("select nome from usuarios where id = $id");
    $stmt->execute();
    foreach($stmt as $row):
    $nome = $row['nome'];
    echo "<option value='". $id . "'>" . $nome . "</option> <br>";
    endforeach;  
  endforeach;  
  
  echo '</select> <br> <br>';

endforeach;
echo '<button class="text-uppercase btnposts" type="submit" name="submit">Postar</button>
</form>';


?>