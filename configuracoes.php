<?php
	include("lib/includes.php");
  include_once("lib/functions.php");
	include("conexao.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Configurações</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.php">
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
    <a href='update-pass.php?id=<?php echo $_SESSION['userId']; ?>'> Alterar Senha  </a>
    <br>
    <a href="deleta.php"> Deletar Conta </a>
    <br>
    <p> Mudar tema </p>
    <form method="POST" action="exec_mudar-tema.php" autocomplete="off" enctype="multipart/form-data">
        <select id="cordefundo" name="cordefundo">
        <option value="rgb(238, 239, 243)">Padrão</option>
        <option value="rgb(24, 8, 54)">Mirtilo</option>
        <option value="rgb(218, 42, 42)">Morango</option>
        <option value="rgb(158, 222, 84)">Limão</option>
        <option value="rgb(235, 154, 129)">Pêssego</option>
        </select>
        <input type="submit" value="Confirmar">
	</form>
  </div>

  <!--Menu Direita-->
  <div class="col">
    <?php include('menu_direita.php');?>
  </div>
</div>

</body>
</html> 