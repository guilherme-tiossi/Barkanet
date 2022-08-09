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
		<div>
			<h3>Criar grupo</h3>
			<form action="exec_grupos.php"  method="post" onsubmit="return verificaGrupo()" autocomplete="off" enctype="multipart/form-data">
				<label for="txNomeGrupo">Nome do grupo</label>
				<br>
				<input type="text" name="txNomeGrupo" id="txNomeGrupo">
				<span id="alerta-nomeGrupo" class="to-hide" role="alert">Digite o nome do grupo</span>
				<br>
				<label for="txDescricaoGrupo">Descrição</label>
				<br>
				<input type="text" name="txDescricaoGrupo" id="txDescricaoGrupo">
				<span id="alerta-descricaoGrupo" class="to-hide" role="alert">Digite a descrição</span>
				<br>
	            <label for="optTipoGrupo">Tipo:</label>
	            <select name="optTipoGrupo" id="optTipoGrupo">
		            <option value="Privado">Privado</option>
		            <option value="Publico">Publico</option>
	            </select>
	            <span id="alerta-optTipoGrupo" class="to-hide" role="alert">Selecione um tipo de grupo</span>
	            <br>
				<input type="submit" name="submit" value="Criar">
			</form>
		</div>
	</section>
	</div>
  </div>

  <!--Menu Direita-->
  <div class="col">
    <?php include('menu_direita.php');?>
  </div>
</div>