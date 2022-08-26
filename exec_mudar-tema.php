<?php 
require 'conexao.php';
session_start();

$email = $_SESSION['email'];
$stmt1 = $pdo->prepare("SELECT * FROM usuarios WHERE email = '$email'");
$stmt1 ->execute();

foreach($stmt1 as $row) {
    $id = $row['id'];
}
    $stmt = $pdo->prepare("UPDATE usuarios set cordefundo='" . $_POST['cordefundo'] . "' WHERE id='$id'");
    $stmt ->execute();
header("Location: configuracoes.php");
?>