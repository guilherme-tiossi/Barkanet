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
    <?php ler_dados_usuario($email, $pdo); ?>
      
    <div><?php ler_amigos_usuario(); ?></div>
    
    <div class="card-fundo">
      <div class="conteudo">
        <?php ler_posts_usuario($pagina, $num_pagina, $inicio, $quantidade_pg); ?>
      </div>

      <?php
		  $pagina_anterior = $pagina - 1;
		  $pagina_posterior = $pagina + 1;
      
      echo '
		    <div class="mt-5 paginacao">
          <nav>
            <ul class="pagination justify-content-center pt-2">';
              if($pagina_anterior != 0){
                $btn1 = '
                <a class="page-link text-kiwi" href="perfil.php?pagina='.$pagina_anterior.'" aria-label="Previous">
                <i class="fa-solid fa-reply"></i>
                </a>';
              }else{
              $btn1 = '<span class="page-link text-black-50"><i class="fa-solid fa-reply"></i></span>';
              }
            
            echo '<li class="page-item">';
            echo $btn1;
            echo '</li>';

              $num_atual = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
              $num_anterior = $num_atual - 1;
              $num_posterior = $num_atual + 1;

              if($num_anterior != 0){
                $btn2 = '<a class="page-link text-kiwi" href="perfil.php?pagina='.$num_anterior.'">'.$num_anterior.'</a>';
                echo '<li class="page-item">'.$btn2.'</li>';
              }

              $btn2 = '<a class="page-link text-kiwi" href="perfil.php?pagina='.$num_atual.'">'.$num_atual.'</a>';
              echo '<li class="page-item">'.$btn2.'</li>';

              if($num_posterior < ($num_pagina + 1)){
                $btn2 = '<a class="page-link text-kiwi" href="perfil.php?pagina='.$num_posterior.'">'.$num_posterior.'</a>';
                echo '<li class="page-item">'.$btn2.'</li>';
              }

              if($num_posterior < ($num_pagina + 1)){
              $btn3 = '<a class="page-link text-kiwi" href="perfil.php?pagina='.$pagina_posterior.'" aria-label="Previous"><i class="fa-solid fa-share"></i></a>';
              }else{
              $btn3 = '<span class="page-link text-black-50"><i class="fa-solid fa-share"></i></span>';
              }

            echo '<li class="page-item">';
            echo $btn3;
            echo '</li>
            </ul>
          </nav>
      	</div>';
      ?>
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