<?php
require 'conexao.php';
session_start();

$email = $_SESSION['email'];
$data = date_create_from_format("d/m/Y", $_POST['data'])->format("Y-m-d");
$stmt1 = $pdo->prepare("SELECT * FROM usuarios WHERE email = '$email'");
$stmt1 ->execute();

foreach($stmt1 as $row) {
    $id = $row['id'];
}
    $stmt = $pdo->prepare("UPDATE usuarios set nome='" . $_POST['nome'] . "' WHERE id='$id'");
    $stmt ->execute();
    $stmt = $pdo->prepare("UPDATE usuarios set bio='" . $_POST['bio'] . "' WHERE id='$id'");
    $stmt ->execute();
    $stmt = $pdo->prepare("UPDATE usuarios set profilepic='" . $_POST['pfp'] . "' WHERE id='$id'");
    $stmt ->execute();
    $stmt = $pdo->prepare("UPDATE usuarios set data_nasc='$data' WHERE id='$id'");
    $stmt ->execute();
    $stmt = $pdo->prepare("UPDATE tbposts set nome='" . $_POST['nome'] . "' WHERE usuario='$id'");
    $stmt ->execute();
    $stmt = $pdo->prepare("UPDATE comentarios set com_nome='" . $_POST['nome'] . "' WHERE com_user='$id'");
    $stmt ->execute();
    header("Location: perfil.php");
?>