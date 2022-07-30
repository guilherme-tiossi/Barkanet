<?php
require 'conexao.php';
session_start();

$email = $_SESSION['email'];
$stmt1 = $pdo->prepare("SELECT * FROM usuarios WHERE email = '$email'");
$stmt1 ->execute();

foreach($stmt1 as $row) {
    $id = $row['id'];
}

    $stmt = $pdo->prepare("UPDATE usuarios set nome='" . $_POST['nome'] . "' WHERE id='$id'");
    $stmt ->execute();
    $stmt = $pdo->prepare("UPDATE usuarios set bio='" . $_POST['bio'] . "' WHERE id='$id'");
    $stmt ->execute();
    $stmt = $pdo->prepare("UPDATE usuarios set data_nasc='" . $_POST['data'] . "' WHERE is='$id'");
    $stmt ->execute();
    $stmt = $pdo->prepare("UPDATE tbposts set nome='" . $_POST['nome'] . "' WHERE usuario='$id'");
    $stmt ->execute();
    $stmt = $pdo->prepare("UPDATE comentarios set com_nome='" . $_POST['nome'] . "' WHERE com_user='$id'");
    $stmt ->execute();
    header("Location: perfil.php");
?>