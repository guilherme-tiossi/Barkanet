<?php
include("lib/includes.php");
include("conexao.php");
include('menu_esquerda.php');
include('menu_direita.php');
?>
<!DOCTYPE html>
<html>
 <head>
   <title>Alterar dados</title>
 </head>
<body>
		<?php
		$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = '$id'");
		$stmt->execute();
		$row = $stmt->rowCount();
		if ($row > 0) {
		?>
			<?php
			$i=0;
			while($row = $stmt->fetch(PDO::FETCH_BOTH)) {
			?>
			<a href="perfil.php?id=<?php echo $row["id"]; ?>">Voltar</a> <br>
	<div>
	<h2> Editar perfil </h1>
		Nome: <?php echo $row["nome"]; ?> <a href="update-name.php?id=<?php echo $row["id"]; ?>">Editar</a> <br>
		Bio: <?php echo $row["bio"]; ?>  <a href="update-bio.php?id=<?php echo $row["id"]; ?>">Editar</a><br>
		Data de nascimento: <?php echo $row["data_nasc"]; ?> <a href="update-date.php?id=<?php echo $row["id"]; ?>">Editar</a> <br>
		Senha: <a href="update-pass.php?id=<?php echo $row["id"]; ?>">Alterar senha</a> <br>
	</div>
	<form action=exec_pfp.php  method="post" autocomplete="off" enctype="multipart/form-data">
			<label for="image"> PFP </label>
			<input type="file" name="pfp" id = "pfp" accept=".jpg, .jpeg, .png">
			<br>
			<button type="submit" name="submit">Enviar</button>
		</form>
			<?php
			$i++;
			}
}
else
{
    echo "No result found";
}
?>
 </body>
</html>