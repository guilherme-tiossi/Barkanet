<?php
session_start();
include("conexao.php");

$email = $_POST['email'];
$stmt = $pdo->prepare("SELECT email FROM usuarios WHERE email = '$email'");
$stmt ->execute();
$row = $stmt->rowCount();
$fetch = $stmt->fetch();

if($row == 0) {
	$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
	$data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
	$dataNew = date_create_from_format("d/m/Y", $data)->format("Y-m-d");
	$codigo = "#".substr(md5(md5($email)), 0, 6);
	$bio = "";
	$stmt1 = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, data_nasc, codigo, bio) VALUES ('$nome', '$email', '$senha', '$dataNew', '$codigo', '$bio')");
	$stmt1 ->execute();
	header("Location: login.php");

}
else{
	$_SESSION['nao_autenticado'] = true;
	header("Location: signup.php");
	exit();
}
?>

