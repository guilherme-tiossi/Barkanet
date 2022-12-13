<?php
include "lib/includes.php";
include "conexao.php";
$iduser = $_SESSION['userId'];
$stmt = $pdo->prepare("select * from tbgrupos where adm_grupo = $iduser");
$stmt->execute();
foreach ($stmt as $row):
  $nome_grupo = $row['nome_grupo'];
  $id_grupo = $row['id_grupo'];
  
  echo '<form> 
  <label for="membro">Escolha um membro para ser o próximo administrador do grupo ' . $nome_grupo . ':</label>
  <select name="membro" id="' . $id_grupo . '">';
  $stmt = $pdo->prepare("select id_usuario, id_grupo from membros_grupos where id_grupo = 40");
  $stmt->execute();
  foreach ($stmt as $row):
    $id = $row['id_usuario'];
    $id_grupo = $row['id_grupo'];
    echo "<option value='". $id . "'>" . $id . "</option> <br>";
  endforeach;  
  
  echo '</select> </form>';

endforeach;



?>