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
    
    <?php
    //ṕroblemas demonios! 
        echo "<hr> <h4> Selecione um sucessor para fazer a administração dos seguintes grupos: </h4>";
        $iduser = $_SESSION['userId'];
            $stmt = $pdo->prepare("select * from tbgrupos where adm_grupo = $iduser");
            $stmt->execute();
            foreach ($stmt as $row):
                $idgrupo = $row["id_grupo"];
                $nomegrupo = $row["nome_grupo"];
            echo "<b>" . $nomegrupo . "</b> <hr> <select id='$idgrupo'>";
        $stmt2 = $pdo->prepare("select * from membros_grupos where (id_adm = $iduser and id_grupo = $idgrupo and id_usuario != $iduser)");
            $stmt2 ->execute();
            foreach ($stmt2 as $row):
              $id_usuario = $row['id_usuario'];
                $stmt3 = $pdo->prepare("select id, profilepic, nome from usuarios where id = '$id_usuario'");
                $stmt3 ->execute();
                foreach ($stmt3 as $row):
            $idnovoadm = $row['id'];
            echo "
            <option value='$idnovoadm'>" . $row['nome'] . "</option> 
            <br>";
                endforeach;
            endforeach;
            echo "</select> <hr>";
        endforeach;
    
    //ṕroblemas demonios!
    ?>


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
                     Você tem certeza de que deseja excluir sua conta do Barkanet? Seu dados, incluindo publicações e comentários serão apagados imediatamente. Essa ação é irreversível.
          </p>
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
