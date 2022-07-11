<?php
	session_start();
	include('conexao.php');

	$email = $_SESSION['email'];
	$stmt = $pdo->prepare("select email, id from usuarios where email = '$email'");
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
	include_once("dbconnect.php");
	include_once("functions.php");
?>




