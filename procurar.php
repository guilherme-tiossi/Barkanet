<?php
  include("lib/includes.php");
  include("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Notificações</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/fonts/font.css">
    <script src="js/script.js"></script>
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.mask.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
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
      </div>
    </div>
    <!--Menu Direita-->
    <div class="col">
      <?php include('menu_direita.php');?>
    </div>
  </div>
  </body>
</html>
