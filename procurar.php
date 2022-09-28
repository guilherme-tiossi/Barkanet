<?php
  include("lib/includes.php");
  include("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/fonts/font.css">
    <script src="js/script.js"></script>
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <title>Procurar</title>
  </head>

<body>
  <div class="d-flex">
    <!--Menu Esquerada-->
    <div class="col">
      <?php include('menu_esquerda.php');?>
    </div>

    <!--Centro-->
    <div class="col-6">
      <div class="card-fundo-ext">
      <!--Pesquisa com código-->
      <h2>Insira o código de amizade:</h2>
      <form action="" method="post">
      <input type="text" class="form-control" id="live_search" autocomplete="off" placeholder="Search...">
        <button type="submit">Procurar</button><br>
      </form>

      <div id="searchresult"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#live_search").keyup(function(){
            var input = $(this).val();
            //alert(input);

            if(input !=""){
                $.ajax({

                url:"livesearch.php",
                method:"POST",
                data:{input:input},

                success:function(data){
                    $("#searchresult").html(data);
                    $("#searchresult").css("display","block");
                }
                });
            }else{
                $("#searchresult").css("display","none");
            }
        });

    });
</script>

      <!--Resultado da busca-->
      <div>
      <?php
      if(isset($_POST['live_search'])){
        $codigo = $_POST['live_search'];
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE codigo = '$codigo'");
        $stmt ->execute();
        $count1 = $stmt->rowCount();
        echo "Usuários: </br>";
        if($count1 >= 0){
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
      </div>
      </div>
    <!--Menu Direita-->
    <div class="col">
      <?php include('menu_direita.php');?>
    </div>
  </div>
  </body>
</html>
