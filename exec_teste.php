<?php 
include("lib/includes.php");
include("conexao.php");
$iduser = $_SESSION['userId'];
$novoadm = $_GET['novoadm'];
$stmt = $pdo->prepare("UPDATE tbgrupos SET adm_grupo='" . $_GET['novoadm'] . "' WHERE id_grupo='" . $_GET['idgrupo'] . "'");
$stmt ->execute();
$stmt = $pdo->prepare("UPDATE membros_grupos SET id_adm='" . $_GET['novoadm'] . "' WHERE id_grupo='" . $_GET['idgrupo'] . "'");
$stmt ->execute();

echo "A administração do grupo " . $_GET['idgrupo'] . " passou de " . $iduser . " para" . $novoadm;

?>