<?php

include("conexao.php");
include("lib/dbconnect.php");
if(isset($_POST['input'])){

    $input = $_POST['input'];
        $codigo = $_POST['input'];
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE codigo = '$codigo'");
        $stmt ->execute();
        $count1 = $stmt->rowCount();
        echo "<div class='pesquisa'>";
        if($count1 >= 1){
          echo "Usuários: </br>";
          foreach($stmt as $row) {
            $id = $row['id'];
            $nome = $row['nome'];
          }
          echo "<a href='?pagina=perfil&id={$id}'>{$nome}</a> </br>";
        }
        $stmt = $pdo->prepare("SELECT * FROM tbgrupos WHERE nome_grupo LIKE '%$codigo%'");
        $stmt ->execute();
        $count2 = $stmt->rowCount();
          if($count2 >= 1){
            echo "</br>Grupos:</br>";
            foreach($stmt as $row) {
              $idgrupo = $row['id_grupo'];
              $adm_grupo = $row['adm_grupo'];
              $nomegrupo = $row['nome_grupo'];

              if($row['tipo_grupo'] == "Privado" ){
                echo "<a href='?pagina=grupo2&id_grupo=$idgrupo&id=$adm_grupo'>{$nomegrupo}</a>";
                echo " " . $row["descricao_grupo"];
                echo "</br>";
              }

              if($row['tipo_grupo'] == "Publico" ){
                echo "<a href='pggrupo.php?pagina=entrar-grupo-publico&id_grupo=$idgrupo&id=$adm_grupo'>$nomegrupo</a>";
                echo " " . $row["descricao_grupo"];
                echo "</br>";
              }
            }
          }
      }
        echo "</div>";
    
?>