<?php
session_start();
include('conexao.php');

$email = $_POST['email'];
$senha = $_POST['senha'];
$stmt = $pdo->prepare("select email from usuarios where email = '$email' and senha = '$senha'");
$stmt->execute();
$row = $stmt->rowCount();
$fetch = $stmt->fetch();

if($row == 1) {
	$_SESSION['email'] = $email;
	header('Location: perfil.php');
	exit();
} else {
	$_SESSION['nao_autenticado'] = true;
	header('Location: login.php');
	exit();
}