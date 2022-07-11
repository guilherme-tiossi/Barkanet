
<?php
	include("lib/includes.php");
	include("conexao.php");
	include('menu_esquerda.php');
	include('menu_direita.php');

?>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/script.js"></script>
</head>
<section>
		<div>
			<?php
			$stmt2 = $pdo->prepare("select id_para, id_de from amigos where (id_de = '$id' and status = '1') or (id_para = '$id' and status = '1') order by id desc");
            $stmt2 ->execute();
            foreach ($stmt2 as $row) :
            $id_para = $row['id_para'];
            $id_de = $row['id_de'];
			$stmt = $pdo->prepare("select * from tbposts where (usuario = '$id_de') or (usuario = '$id_para') order by idpost desc");
			$stmt ->execute();
			foreach ($stmt as $row) : ?>
			<div>
				<?php
					echo $row["nome"];
					echo "<br>";
				  	echo $row["titulo"];
					echo "<br>";
					echo $row["post"];
					echo "<br>";
					echo "<br>";
				if ($row["image"] != null){
				?>
				<img src="img/<?php echo $row["image"]; ?>" width = 200 title="<?php echo $row['image']; ?>">
			</div>
				<?php }
				$swor = $pdo->prepare("select * from comentarios where id_post = '{$row['idpost']}' order by id_com desc");
				$swor->execute();
				foreach ($swor as $swo) : ?>
				<div>
					<?php
						echo $swo["com_nome"];
						echo "<br>";
						echo $swo["comentario"];
					?>
				</div>
				<br>
				<?php endforeach; ?>
				</div>
				<br>
				<h5>Publicar seu Comentario</h5>
				<form action="exec_com.php"  method="post">
					<label for="txcom">Comentario:</label>
					<input type="text" name="txcom" id="txcom">
					<span id="alert-com" class="to-hide" role="alert">Digite um comentario...</span>
					<br>
					<input type="hidden" name="post_id" value="<?php echo $row["idpost"]; ?>">
					<input type="submit" name="comentar" value="Enviar">
				</form>
				<?php endforeach;
			endforeach;
			?>
		</div>	
	</div>
</section>