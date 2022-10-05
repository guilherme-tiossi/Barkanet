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
                echo "<a href='?pag=1&pagina=perfil&id={$id_de}'>".$row['nome']."</a> <br>";
                echo "<br>";
              endforeach;
            }

            if($id_de == $_SESSION['userId']){
              $stmt3 = $pdo->prepare("select nome from usuarios where id = '$id_para'");
              $stmt3 ->execute();
              foreach ($stmt3 as $row):
                echo "<a href='?pag=1&pagina=perfil&id={$id_para}'>".$row['nome']."</a> <br>";
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
