<?php
	include("lib/includes.php");
  include_once("lib/functions.php");
	include("conexao.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Deletar Conta</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/fonts/font.css">
    <script src="js/script.js"></script>
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>

<body>

<div class="d-flex">
  <!--Menu Esquerada-->
  <div class="col">
    <?php include('menu_esquerda.php');?>
  </div>

  <!--Centro-->
  <div class="col-6">
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
  </div>

  <!--Menu Direita-->
  <div class="col">
    <?php include('menu_direita.php');?>
  </div>
</div>

</body>
</html>
