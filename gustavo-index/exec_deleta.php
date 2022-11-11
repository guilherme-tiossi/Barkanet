<?php
session_start();
include('conexao.php');

$email = $_POST['email'];
$senha = $_POST['senha'];
$stmt = $pdo->prepare("SELECT email FROM usuarios WHERE email = '$email' and senha = '$senha'");
$stmt ->execute();
$row = $stmt->rowCount();
$fetch = $stmt->fetch();

if($row == 1) {
	$stmt2 = $pdo->prepare("DELETE FROM usuarios WHERE usuarios.email = '$email'");
	$stmt2 ->execute();
	$stmt2 = $pdo->prepare("DELETE FROM tbposts WHERE usuario = '$email'");
	$stmt2 ->execute();
	$stmt2 = $pdo->prepare("DELETE FROM amigos WHERE (id_de = '$email') OR (id_para = '$email')");
	$stmt2 ->execute();
	$stmt2 = $pdo->prepare("DELETE FROM comentarios WHERE com_email = '$email'");
	$stmt2 ->execute();
	session_destroy();
	header('Location: deletado.php');
	exit();
} else {
	$_SESSION['nao_autenticado'] = true;
	header('Location: deleta.php');
	exit();
}