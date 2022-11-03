<?php
session_start();
?>

<!DOCTYPE html>
<html lang="utf-8" class="h-100 w-100">
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/fonts/font.css">
	<script type="text/javascript" src="js/script.js"></script>
</head>
<body id="intro" class="h-100 w-100">
	<div class="container h-100 w-100">
	    <div class="row h-100 w-100 align-items-center justify-content-md-center">
		<div class="col"></div>
		<div class="col-md-auto">
		    <div class="card text-bg-light mb-3" style="width: 29rem;height: 22rem;">
			<div id="cdheader" class="card-header d-inline-flex justify-content-between">
			    <div>
			    <h5>BARKANET</h5>
			    </div>
			    <div>
			    <h5>🌐</h5>
			    </div>
			</div>
			<div id="cdbody" class="card-body text-center">
			<?php
            if(isset($_SESSION['nao_autenticado'])):
            ?>
            <p class="alert">Email ou senha incorretos</p>
            <?php
            endif;
            unset($_SESSION['nao_autenticado']);
            ?>
            <?php
			if(isset($_SESSION['email'])){
				header('Location: perfil.php');
			}
			?>
			<form method="POST" action="exec_login.php" onsubmit="return verificaLogin()">
				<label for="email">EMAIL</label>
				<br>
				<input type="text" name="email" id="email">
				<br>
				<span id="alert-email" class="to-hide" role="alert">Preencha o campo email corretamente</span>
				<br>
				<label for="senha">SENHA</label>
				<br>
				<input type="password" name="senha" id="senha">
				<br>
				<span id="alert-senha" class="to-hide" role="alert">Preencha o campo senha corretamente</span>
				<br>
				<input type="checkbox" name="mostrar" onclick="senhaLogin()">
				<label for="mostrar">Mostrar senha</label>
				<br>
				<a href="forgot.php" class="btn-link">Esqueci minha senha</a>
				<br>
				<input class="btn btn-outline-secondary" style="--bs-btn-padding-y: 0.5rem; --bs-btn-padding-x: 2.4rem; --bs-btn-font-size: 1.4rem;" type="submit" name="login" value="Log In">
				<a href="signup.php" class="btn-link">Não tenho conta</a>
			</form>
			</div>
		    </div>
		</div>
		<div class="col"></div>
	    </div>
	</div>
</body>
</html>
