<?php
session_start();
include('verifica_login.php');
include('menu.php');
?>

<!DOCTYPE html>
<html lang="utf-8">
<head>
	<meta charset="utf-8">
	<title>Barkanet - Apagar conta</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
	<section>
		<div>
			<h1>Deletar conta</h1>
			<?php
            if(isset($_SESSION['nao_autenticado'])):
            ?>
            <div>
            	<p class="alert">Email ou senha incorretos</p>
            </div>
            <?php
            endif;
            unset($_SESSION['nao_autenticado']);
            ?>
			<form method="POST" action="exec_deleta.php" onsubmit="return verificaExclusao()">
				<label for="email">Email: </label>
				<input type="text" name="email" id="email">
				<span id="alerta-email" class="to-hide" role="alert">Preencha o campo email corretamente</span>
				<br>
				<label for="senha">Senha: </label>
				<input type="password" name="senha" id="senha">
				<span id="alerta-senha" class="to-hide" role="alert">Preencha o campo senha corretamente</span>
				<br>
				<input type="submit" name="deleta" value="Deletar">
			</form>
		</div>
	</section>
</body>
</html>