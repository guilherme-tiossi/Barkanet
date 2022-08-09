<?php
	include("lib/includes.php");
  include_once("lib/functions.php");
	include("conexao.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Perfil</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/fonts/font.css">
    <script src="js/script.js"></script>
    <link href="fontawesome/css/all.css" rel="stylesheet">
</head>

<body>

<div class="d-flex">
  <!--Menu Esquerada-->
  <div class="col">
    <?php include('menu_esquerda.php');?>
  </div>

  <!--Centro-->
  <div class="col-6">
    <?php ler_dados_usuario($email, $pdo);
    //ler_amigos_usuario();?>
    <div class="card-fundo">
      <?php ler_posts_usuario(); ?>
    </div>
  </div>

  <!--Menu Direita-->
  <div class="col">
    <?php include('menu_direita.php');?>
  </div>
</div>

</body>
</html>