<?php
	include('conexao.php');
	
	$stmt2 = $pdo->prepare("SELECT idpost FROM tbposts WHERE idgrupo = '{$_GET['id_grupo']}'");
	$stmt2 ->execute();
	foreach ($stmt2 as $row) :
  		$idpost = $row['idpost'];
		$stmt3 = $pdo->prepare("DELETE FROM comentarios WHERE id_post = '$idpost'");
		$stmt3 ->execute();
	endforeach;
	$stmt2 = $pdo->prepare("DELETE FROM tbposts WHERE idgrupo = '{$_GET['id_grupo']}'");
	$stmt2 ->execute();
	$stmt2 = $pdo->prepare("DELETE FROM membros_grupos WHERE id_grupo = '{$_GET['id_grupo']}'");
	$stmt2 ->execute();
	$stmt2 = $pdo->prepare("DELETE FROM tbgrupos WHERE id_grupo = '{$_GET['id_grupo']}'");
	$stmt2 ->execute();

	header('Location: perfil.php');