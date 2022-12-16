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
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>

<div class="d-flex">
  <!--Menu Esquerada-->
  <div class="col">
    <?php include('menu_esquerda.php');?>
  </div>

  <!--Centro-->
  <div class="col-6">
  	<div class="card-fundo-ext">
	<div class="box-center">
		<div class="card m-3" style="width: 25rem;">
			<div class="card-body">
				<h3>Criar grupo</h3>
				<form action="exec_grupos.php"  method="post" onsubmit="return verificaGrupo()" autocomplete="off" enctype="multipart/form-data">
					<div class="form-group mt-3">
						<input class="form-control" type="text" name="txNomeGrupo" id="txNomeGrupo" placeholder="Nome do grupo">
						<span id="alert-nome1" class="to-hide">Digite um nome para o grupo</span>
						<span id="alert-nome2" class="to-hide">Nome muito grande</span>
					</div>
					<div class="form-group mt-3">
						<textarea class="form-control" type="text" name="txDescricaoGrupo" id="txDescricaoGrupo" placeholder="Descrição" style="resize: none;"></textarea>
						<span id="alert-desc1" class="to-hide">Digite a descrição...</span>
						<span id="alert-desc2" class="to-hide">Descrição muito longa</span>
					</div>
					<div class="form-group mt-3">
						<select name="optTipoGrupo" id="optTipoGrupo" class="form-control">
							<option value="">Tipo...</option>
							<option value="Privado">Privado</option>
							<option value="Publico">Publico</option>
						</select>
						<span id="alert-tipo" class="to-hide">Selecione um tipo de grupo...</span>
					</div>
					<div class="form-group mt-3">
						<input type="submit" name="submit" class="btn-verde" value="Criar">
					</div>
				</form>
			</div>
		</div>
	</div>
	</div>
  </div>

  <!--Menu Direita-->
  <div class="col">
    <?php include('menu_direita.php');?>
  </div>
</div>