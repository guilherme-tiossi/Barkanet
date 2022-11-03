<?php
include("lib/includes.php");
include("conexao.php");
$iduser = $_SESSION['userId'];
        $stmt = $pdo->prepare("select * from tbgrupos where adm_grupo = $iduser");
        $stmt->execute();
        foreach ($stmt as $row):
            $idgrupo = $row["id_grupo"];
            $nomegrupo = $row["nome_grupo"];
        echo "<b>" . $nomegrupo . "</b> <hr>";
		$stmt2 = $pdo->prepare("select * from membros_grupos where (id_adm = $iduser and id_grupo = $idgrupo)");
        $stmt2 ->execute();
        foreach ($stmt2 as $row):
          $id_usuario = $row['id_usuario'];
            $stmt3 = $pdo->prepare("select id, profilepic, nome from usuarios where id = '$id_usuario'");
            $stmt3 ->execute();
            foreach ($stmt3 as $row):
				$idnovoadm = $row['id'];
				echo "<a href='exec_teste.php?novoadm=$idnovoadm&idgrupo=$idgrupo' class='link'>" . $row["nome"] . "</a> <br>";
            endforeach;
        endforeach;
        echo "<br>";
    endforeach;
?>