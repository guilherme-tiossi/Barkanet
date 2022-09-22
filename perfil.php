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
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>    
    <!-- se der problema em algum canto nessa pagina talvez seja isso <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> --> 
</head>

<body>

<div class="d-flex">
  <!--Menu Esquerada-->
  <div class="col">
    <?php include('menu_esquerda.php');?>
  </div>

  <!--Centro-->
  <div class="col-6">
    <?php
      $pagina = (isset($_GET['pagina']) && $_GET['pagina'] != null && is_numeric($_GET['pagina'])) ? $_GET['pagina'] : 1;
      $quantidade_pg = 50;

      $stmt = $pdo->prepare("SELECT * FROM tbposts WHERE (usuario = '$id') ORDER BY idpost DESC");
      $stmt->execute();

      $rowNum = $stmt->rowCount();
      $num_pagina = $rowNum / $quantidade_pg;
      $inicio = $quantidade_pg * $pagina - $quantidade_pg;

      if(isset($_GET['pagina'])){
        if($_GET['pagina'] > ($num_pagina + 1)){
          echo "<script>document.location.href = 'posts.php?pagina=1';</script>";
        }

        if($_GET['pagina'] == 0){
          echo "<script>document.location.href = 'posts.php?pagina=1';</script>";
        }

        if (!preg_match('/^[1-9][0-9]*$/', $_GET['pagina'])) {
          echo "<script>document.location.href = 'posts.php?pagina=1';</script>";
        }
      }
      else{
        echo "<script>document.location.href = 'perfil.php?pagina=1';</script>";
      }
    ?>
    <?php ler_dados_usuario($email, $pdo);
    ler_amigos_usuario();?>
    <div class="card-fundo">
      <?php ler_posts_usuario($num_pagina, $inicio, $quantidade_pg); ?>
    </div>
  </div>

  <!--Menu Direita-->
  <div class="col">
    <?php include('menu_direita.php');?>
  </div>
</div>

<?php
if (isset($_GET['editar'])){
  ?><script>
    mostraropcoesperfil()
  </script><?php
}
?>

</body>
</html>