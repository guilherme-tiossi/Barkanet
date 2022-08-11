  <?php
require 'conexao.php';
session_start();
$email = $_SESSION['email'];
$stmt1 = $pdo->prepare("SELECT * FROM usuarios WHERE email = '$email'");
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
  $stmt = $pdo->prepare("INSERT INTO tbgrupos VALUES (null, '$nomegrupo', '$descgrupo', '$tipogrupo' , '$id', 'grupo.png')");
  $stmt->execute();
  $stmt = $pdo->prepare("SELECT * FROM tbgrupos WHERE nome_grupo = '$nomegrupo' AND adm_grupo = '$id'");
  $stmt ->execute();

  foreach ($stmt as $row) :
    $id_grupo = $row['id_grupo'];
    $stmt = $pdo->prepare("INSERT INTO membros_grupos VALUES (null, '$id', '$id', '$id_grupo', '$id', '1')");
    $stmt ->execute();
  endforeach;

  echo " <script> document.location.href = 'pggrupo.php?id_grupo=$id_grupo' </script>";
}
?>
