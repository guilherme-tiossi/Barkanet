<?php
	include("lib/includes.php");
	include("conexao.php");
	include('menu_esquerda.php');
?>

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