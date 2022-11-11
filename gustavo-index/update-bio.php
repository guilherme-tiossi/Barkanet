<?php
include_once 'conexao.php';
if(count($_POST)>0) {
$stmt = $pdo->prepare("UPDATE usuarios SET bio='" . $_POST['bio'] . "' WHERE id='" . $_GET['id'] . "'");
$stmt ->execute();
header("Location: perfil.php");
}
$smt = $pdo->prepare("SELECT * FROM usuarios WHERE id='" . $_GET['id'] . "'");
$smt ->execute();
$row = $smt->fetch();
?>
<html>
  <head>
    <title>Alterar de bio</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="js/script.js"></script>
  </head>
<body>
        <form name="frmUser" method="post" action="" onsubmit="return editarBio()">
                <a href="perfil.php">Voltar</a>
                <br>
                <label for="bio">Alterar descrição:</label>
                <br>
                <input type="textarea" name="bio"  id="bio" value="<?php echo $row['bio']; ?>">
                <span id="alert-bio" class="to-hide" role="alert">A bio deve ter no máximo 100 caracteres</span>
                <br>
                <input type="submit" name="submit" value="Salvar" class="button">
        </form>
</body>
</html>