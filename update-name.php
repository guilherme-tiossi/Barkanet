<?php
include_once 'conexao.php';
if(count($_POST)>0) {
$stmt = $pdo->prepare("UPDATE usuarios set nome='" . $_POST['nome'] . "' WHERE id='" . $_GET['id'] . "'");
$stmt ->execute();
$stmt = $pdo->prepare("UPDATE tbposts set nome='" . $_POST['nome'] . "' WHERE usuario='" . $_GET['id'] . "'");
$stmt ->execute();
$stmt = $pdo->prepare("UPDATE comentarios set com_nome='" . $_POST['nome'] . "' WHERE com_user='" . $_GET['id'] . "'");
$stmt ->execute();
$message = "Dado(s) alterado(s) com sucesso!";
header("Location: perfil.php");
}
$smt = $pdo->prepare("SELECT * FROM usuarios WHERE id='" . $_GET['id'] . "'");
$smt ->execute();
$row = $smt->fetch();
?>
<html>
  <head>
    <title>Alterar de nome</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="js/script.js"></script>
  </head>
  <body>
    <form name="frmUser" method="post" action="" onsubmit="return editarNome()">
      <a href="perfil.php">Voltar</a>
      <br>
      <label for="nome">Alterar nome:</label>
      <br>
      <input type="text" name="nome" id="nome" value="<?php echo $row['nome']; ?>">
      <span id="alert-nome" class="to-hide" role="alert">O nome deve ter no mínimo 3 caracteres</span>
      <br>
      <input type="submit" name="submit" value="Salvar">
    </form>
    <?php if(isset($message)) { echo $message; } ?>
  </body>
</html>