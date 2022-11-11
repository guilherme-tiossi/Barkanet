<?php
include_once 'conexao.php';
if(count($_POST)>0) {
$stmt = $pdo->prepare("UPDATE usuarios set senha='" . $_POST['password'] . "' WHERE id='" . $_GET['id'] . "'");
$stmt ->execute();
header("Location: perfil.php");
}
$smt = $pdo->prepare("SELECT * FROM usuarios WHERE id='" . $_GET['id'] . "'");
$smt ->execute();
?>

<html>
<head>
<title>Alteração de senha</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
        <form name="frmUser" method="post" action="exec_senha.php" onsubmit="return editarSenha()">
        <a href="configuracoes.php">Voltar</a>
        <br>
        <label for="senha">Senha:</label>
        <br>
        <input type="password" name="senha" id="senha">
        <span id="alert-senha" class="to-hide" role="alert">A senha deve ter no mínimo 8 caracteres</span>
        <br>
        <label for="c_senha">Confirmar senha:</label>
        <br>
        <input type="password" name="c_senha" id="c_senha">
        <span id="alert-c_senha1" class="to-hide" role="alert">Repita a senha</span>
        <span id="alert-c_senha2" class="to-hide" role="alert">As senhas não são iguais</span>
        <br>
        <input type="checkbox" name="mostrar" onclick="senhaCadastro()">
        <label for="mostrar">Mostrar senha</label>
        <br>
        <input type="submit" name="submit" value="Salvar" class="button">
        </form> 
</body>
</html>