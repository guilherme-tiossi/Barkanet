<?php
session_start();
include('conexao.php');

$iduser = $_SESSION['userId'];
            $stmt = $pdo->prepare("select * from tbgrupos where adm_grupo = $iduser");
            $stmt->execute();
            foreach ($stmt as $row):
                $idgrupo = $row["id_grupo"];
                $nomegrupo = $row["nome_grupo"];
				echo $_POST['40'];
				$stmt = $pdo->prepare("UPDATE tbgrupos SET adm_grupo='" . $_POST[$idgrupo] . "' WHERE id_grupo='$idgrupo'");
				$stmt ->execute();
				$stmt = $pdo->prepare("UPDATE membros_grupos SET id_adm='" . $_POST[$idgrupo] . "' WHERE id_grupo='$idgrupo'");
				$stmt ->execute();
        endforeach;


$email = $_POST['email'];
$senha = $_POST['senha'];
echo $email . " " . $senha;
$stmt = $pdo->prepare("SELECT email FROM usuarios WHERE email = '$email' and senha = '$senha'");
$stmt ->execute();
$row = $stmt->rowCount();
$fetch = $stmt->fetch();

 if($row == 1) {
  echo "bananinha";
 	$stmt2 = $pdo->prepare("DELETE FROM usuarios WHERE id = '$iduser'");
 	$stmt2 ->execute();
 	$stmt2 = $pdo->prepare("DELETE FROM tbposts WHERE usuario = '$iduser'");
 	$stmt2 ->execute();
 	$stmt2 = $pdo->prepare("DELETE FROM amigos WHERE (id_de = '$iduser') OR (id_para = '$iduser')");
 	$stmt2 ->execute();
 	$stmt2 = $pdo->prepare("DELETE FROM comentarios WHERE com_user = '$iduser'");
 	$stmt2 ->execute();
 	session_destroy();
	header('Location: deletado.php');
 	exit();
 } else {
 	$_SESSION['nao_autenticado'] = true;
 	header('Location: deleta.php');
 	exit();
}