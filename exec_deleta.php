<?php
session_start();
include('conexao.php');

$email = $_POST['email'];
$senha = $_POST['senha'];
$stmt = $pdo->prepare("select email from usuarios where email = '$email' and senha = '$senha'");
$stmt ->execute();
$row = $stmt->rowCount();
$fetch = $stmt->fetch();

if($row == 1) {
	$stmt2 = $pdo->prepare("delete from usuarios where usuarios.email = '$email'");
	$stmt2 ->execute();
	$stmt2 = $pdo->prepare("delete from tbposts where usuario = '$email'");
	$stmt2 ->execute();
	$stmt2 = $pdo->prepare("delete from amigos where (id_de = '$email') or (id_para = '$email')");
	$stmt2 ->execute();
	$stmt2 = $pdo->prepare("delete from comentarios where com_email = '$email'");
	$stmt2 ->execute();

	header('Location: login.php');
	exit();
} else {
	$_SESSION['nao_autenticado'] = true;
	header('Location: deleta.php');
	exit();
}