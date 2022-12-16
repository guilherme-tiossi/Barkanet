<?php
	session_start();
	include('conexao.php');

	$email = $_SESSION['email'];
	$stmt = $pdo->prepare("SELECT email, id FROM usuarios WHERE email = '$email'");
	$stmt ->execute();

	foreach($stmt as $row) {
	    $email = $row['email'];
	    $id = $row['id'];
	}

	if(!isset($email)){
	    header('Location: login.php');
	    exit();
	}

	
	$_SESSION['userLogin'] = $email;
	$_SESSION['userId'] = $id;
	$_SESSION['incorreto'] = false;
	include_once("dbconnect.php");
	include_once("functions.php");
?>




