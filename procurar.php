<?php
  include("lib/includes.php");
  include("conexao.php");
  include('menu_esquerda.php');
  include('menu_direita.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Procurar</title>
  </head>
  <body>
    <!--Pesquisa com código-->
    <h2>Insira o código de amizade:</h2>
    <form action="" method="post">
      <input type="text" name="buscar" placeholder="#c0d1g0" required>
      <button type="submit">Procurar</button><br>
    </form>

    <!--Resultado da busca-->
    <div>
    <?php
    if(isset($_POST['buscar'])){
      $codigo = $_POST['buscar'];
      $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE codigo = '$codigo'");
      $stmt ->execute();
      $count1 = $stmt->rowCount();
      echo "Usuários: </br>";

      if($count1 >= 1){
        foreach($stmt as $row) {
          $id = $row['id'];
          $nome = $row['nome'];
        }
        echo "<a href='?pagina=perfil&id={$id}'>{$nome}</a> </br>";
      }else{
        echo "Usuário não encontrado" . "</br>";
      }

      $stmt = $pdo->prepare("SELECT * FROM tbgrupos WHERE nome_grupo LIKE '%$codigo%'");
      $stmt ->execute();
      $count2 = $stmt->rowCount();
      echo "</br>Grupos:</br>";

        if($count2 >= 1){
          foreach($stmt as $row) {
            $idgrupo = $row['id_grupo'];
            $adm_grupo = $row['adm_grupo'];
            $nomegrupo = $row['nome_grupo'];

            if($row['tipo_grupo'] == "Privado" ){
              echo "<a href='?pagina=grupo&id_grupo=$idgrupo&id=$adm_grupo'>{$nomegrupo}</a>";
              echo " " . $row["descricao_grupo"];
              echo "</br>";
            }

            if($row['tipo_grupo'] == "Publico" ){
              echo "<a href='pggrupo.php?pagina=entrar-grupo-publico&id_grupo=$idgrupo&id=$adm_grupo'>$nomegrupo</a>";
              echo " " . $row["descricao_grupo"];
              echo "</br>";
            }
          }
        }else{
          echo "Grupo não encontrado";
        }
    }
    ?>
    </div>

    <?php carrega_pagina_solicitacao($con);?>
    
    <div>
        <h3> Amigos </h3>
        <?php 
        $stmt2 = $pdo->prepare("select * from amigos where (id_de = {$_SESSION['userId']} and status = '1') or (id_para = {$_SESSION['userId']} and status = '1')");
        $stmt2 ->execute();

        foreach ($stmt2 as $row) :
          $id_para = $row['id_para'];
          $id_de = $row['id_de'];
          
          if($id_para == $_SESSION['userId']){
            $stmt3 = $pdo->prepare("select nome from usuarios where id = '$id_de'");
            $stmt3 ->execute();
            foreach ($stmt3 as $row):
              echo $row["nome"];
              echo "<br>";
            endforeach;
          }

          if($id_de == $_SESSION['userId']){
            $stmt3 = $pdo->prepare("select nome from usuarios where id = '$id_para'");
            $stmt3 ->execute();
            foreach ($stmt3 as $row):
              echo $row["nome"];
              echo "<br>";
            endforeach;
          }
        endforeach
        ?>
    </div>
  </body>
</html>