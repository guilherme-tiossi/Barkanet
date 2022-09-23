<?php
	include("lib/includes.php");
	include("conexao.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Grupos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/fonts/font.css">
    <script src="js/script.js"></script>
    <link href="fontawesome/css/all.css" rel="stylesheet">
</head>

<div class="d-flex">
  <!--Menu Esquerada-->
  <div class="col">
    <?php include('menu_esquerda.php');?>
  </div>

  <!--Centro-->
  <div class="col-6">
  	<div class="card-fundo">
	<section>
		<div class="card" style="width: 18rem;">
			<div class="card-body">
				<h3>Criar grupo</h3>
				<form action="exec_grupos.php"  method="post" onsubmit="return verificaGrupo()" autocomplete="off" enctype="multipart/form-data">
					<div class="form-group">
						<input type="text" name="txNomeGrupo" id="txNomeGrupo" placeholder="Nome do grupo">
						<br>
						<span id="alert-nome1" class="to-hide">Digite um nome para o grupo</span>
						<span id="alert-nome2" class="to-hide">Nome muito grande</span>
					</div>
					<div class="form-group">
						<textarea type="text" name="txDescricaoGrupo" id="txDescricaoGrupo" placeholder="Descrição"></textarea>
						<br>
						<span id="alert-desc1" class="to-hide">Digite a descrição...</span>
						<span id="alert-desc2" class="to-hide">Descrição muito longa</span>
					</div>
					<div class="form-group">
						<label for="optTipoGrupo">Tipo:</label>
						<select name="optTipoGrupo" id="optTipoGrupo">
							<option value="Privado">Privado</option>
							<option value="Publico">Publico</option>
						</select>
					</div>
					<div class="form-group">
						<input type="submit" name="submit" value="Criar">
					</div>
				</form>
			</div>
		</div>
	</section>
	</div>
  </div>

  <!--Menu Direita-->
  <div class="col">
    <?php include('menu_direita.php');?>
  </div>
</div>