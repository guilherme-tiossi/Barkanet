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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--<link href="fontawesome/css/all.css" rel="stylesheet">-->
	<script src="https://kit.fontawesome.com/0bba2bf162.js" crossorigin="anonymous"></script>
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
					<h5><i class="fa-solid fa-globe" style="color: #0049e6;"></i></h5>
				</div>
			</div>
			<div id="cdbody" class="card-body box-center">
			<?php
            if(isset($_SESSION['nao_autenticado'])):
            ?>
            <p class="alerta">Email ou senha incorretos</p>
            <?php
            endif;
            unset($_SESSION['nao_autenticado']);
            ?>
            <?php
			if(isset($_SESSION['email'])){
				header('Location: perfil.php');
			}
			?>
			</div>
			<div id="cdbody" class="card-body box-center">
			<form method="POST" action="exec_login.php" onsubmit="return verificaLogin()">
				<div class="form-group">
					<label for="email">Email:</label>
					<input type="text" name="email" id="email" class="form-control" style="width: 19rem">
					<span id="alert-email" class="to-hide" role="alert">Preencha o campo email corretamente</span>
				</div>
				<div class="form-group">
					<label for="senha">Senha:</label>
					<input type="password" name="senha" id="senha" class="form-control" style="width: 19rem">
					<span id="alert-senha" class="to-hide" role="alert">Preencha o campo senha corretamente</span>
				</div>
				<div class="form-group">
					<input type="checkbox" name="mostrar" onclick="senhaLogin()">
					<label for="mostrar">Mostrar senha</label>
				</div>
				<div class="form-group">
					<a href="forgot.php" class="btn-link">Esqueci minha senha</a>
				</div>
				<div class="mt-2 text-center">
					<input class="btn btn-outline-secondary" style="--bs-btn-padding-y: 0.5rem; --bs-btn-padding-x: 2.4rem; --bs-btn-font-size: 1.4rem;" type="submit" name="login" value="Log In">
				</div>
				<div class="mt-2 text-center">
					<a href="signup.php" class="btn-link">Não tenho conta</a>
				</div>
			</form>
			</div>
		    </div>
		</div>
		<div class="col"></div>
	    </div>
	</div>
</body>
</html>
