<?php
	include("lib/includes.php");
  include_once("lib/functions.php");
	include("conexao.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Deletar Conta</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/fonts/font.css">
    <script src="js/script.js"></script>
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>

<body>

<div class="d-flex">
  <!--Menu Esquerada-->
  <div class="col">
    <?php include('menu_esquerda.php');?>
  </div>

  <!--Centro-->
  <!-- <div class="col-6">
  <section>
		<div>
			<h1>Deletar conta</h1>
        PHP AUTENTICADO OU NAO!
			<form method="POST" action="exec_deleta.php" onsubmit="return verificaExclusao()">
				<label for="email">Email: </label>
				<input type="text" name="email" id="email">
				<span id="alerta-email" class="to-hide" role="alert">Preencha o campo email corretamente</span>
				<br>
				<label for="senha">Senha: </label>
				<input type="password" name="senha" id="senha">
				<span id="alerta-senha" class="to-hide" role="alert">Preencha o campo senha corretamente</span>
				<br>
				<input type="submit" name="deleta" value="Deletar">
			</form>
		</div>
	</section>
  </div> -->

  <div class="col-6">
  	<div class="card-fundo-ext">
	<section>
		<div class="card m-3" style="width: 25rem;">
			<div class="card-body">
				<h3>Deletar Conta</h3>
			<?php
            if(isset($_SESSION['nao_autenticado'])):
            ?>
            <div>
            	<p class="alert">Email ou senha incorretos</p>
            </div>
            <?php
            endif;
            unset($_SESSION['nao_autenticado']);
            ?>
			<form  action="exec_deleta.php"  method="post" onsubmit="return verificaExclusao()" autocomplete="off" enctype="multipart/form-data">
					<div class="form-group mt-3">
						<input class="form-control" type="text" name="email" id="email" placeholder="E-mail">
            <span id="alerta-email" class="to-hide" role="alert">Preencha o campo email corretamente</span>
					</div>
					<div class="form-group mt-3">
						<input class="form-control" type="password" name="senha" id="senha" placeholder="Senha">
            <span id="alerta-senha" class="to-hide" role="alert">Preencha o campo senha corretamente</span>
					</div>
					<div class="form-group mt-3">
          <a href="" data-toggle="modal" data-target="#ModalLongoExemplo"> Deletar </a>
				
          <div class="modal fade-modal-lg" id="ModalLongoExemplo" tabindex="-1" role="dialog" aria-labelledby="TituloModalLongoExemplo" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h2 class="modal-title" id="TituloModalLongoExemplo"> VOCÊ TEM CERTEZA QUE DESEJA DELETAR SUA CONTA DO BARKANET? </h2>
                  </div>
                  <div class="modal-body">
                     <p> 

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie iaculis ipsum. Vestibulum nunc nulla, tristique eget dolor bibendum, convallis bibendum metus. Morbi sed massa nec augue malesuada mattis. Praesent purus neque, ullamcorper vel sem ac, sollicitudin pulvinar ipsum. Nullam luctus libero eros. Aliquam tellus erat, imperdiet et tincidunt id, fermentum eu risus. Nulla tempus malesuada dapibus. In hac habitasse platea dictumst. Sed iaculis suscipit risus sed facilisis. Aliquam erat volutpat.

Nulla semper erat sit amet augue pharetra interdum. Mauris neque sem, viverra id tincidunt a, dignissim eu est. Donec sit amet turpis diam. Etiam fermentum magna non nibh pharetra tempor. In luctus magna nec libero molestie, quis sollicitudin arcu commodo. Donec congue sodales nisi, sagittis efficitur dolor maximus non. Cras efficitur non nunc lacinia vehicula. Fusce non suscipit felis.

Vivamus vitae magna nec ligula suscipit tincidunt. Curabitur consectetur est eget placerat lobortis. Nam posuere velit id orci venenatis ullamcorper. Phasellus euismod condimentum magna quis facilisis. Suspendisse vitae tincidunt eros, nec ornare ipsum. Pellentesque ut laoreet turpis. Donec magna libero, blandit in enim eleifend, tristique ullamcorper arcu.  </p>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>

						      <input type="submit" class="btn btn-primary" name="submit" value="Deletar" id="form_exclusao">
					        </div>
          </div>
          </form>
			</div>
		</div>
	</section>
	</div>
  </div>  

  <!--Menu Direita-->
  <div class="col">
    <?php include('menu_direita.php');?>
  </div>
</div>

</body>
</html>
