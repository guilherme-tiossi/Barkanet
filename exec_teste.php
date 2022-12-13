<?php 
include("lib/includes.php");
include("conexao.php");
$iduser = $_SESSION['userId'];
    foreach ($_POST as $key => $value) {
    //grupo 
        echo $key;
    //adm
        echo $value ;
        $stmt = $pdo->prepare("UPDATE tbgrupos SET adm_grupo='$value' WHERE id_grupo='$key'");
        $stmt ->execute();
        $stmt = $pdo->prepare("UPDATE membros_grupos SET id_adm='$value' WHERE id_grupo='$key'");
        $stmt ->execute();
        
        echo "A administração do grupo " . $key . " passou de " . $iduser . " para" . $value;
    }
?>
</table>