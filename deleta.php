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
  <div class="col-6">
    <div class="card-fundo-ext">
      <div class="box-center">
        <div class="card m-3" style="width: 25rem;">
          <div class="card-body">
              <h3>Deletar Conta</h3>
              <form  action="exec_deleta.php"  method="post" onsubmit="return verificaExclusao()" autocomplete="off" enctype="multipart/form-data">
              
              
            <?php 
                $iduser = $_SESSION['userId'];
                $stmt = $pdo->prepare("select * from tbgrupos where adm_grupo = $iduser");
                $stmt->execute();
                echo '<form action="exec_teste.php" method="post">';
                
                foreach ($stmt as $row):
                  $nome_grupo = $row['nome_grupo'];
                  $id_grupo = $row['id_grupo'];
                  echo '<label for="membro">Escolha um membro para ser o próximo administrador do grupo ' . $nome_grupo . '('. $id_grupo . '):</label>
                  <select name="' . $id_grupo .'" id="' . $nome_grupo . '">';
                  $stmt = $pdo->prepare("select id_usuario, id_grupo from membros_grupos where id_grupo = $id_grupo AND id_usuario != $iduser");
                  $stmt->execute();
                  foreach ($stmt as $row):
                    $id = $row['id_usuario'];
                    $id_grupo = $row['id_grupo'];
                    $stmt = $pdo->prepare("select nome from usuarios where id = $id");
                    $stmt->execute();
                    foreach($stmt as $row):
                    $nome = $row['nome'];
                    echo "<option value='". $id . "'>" . $nome . "</option> <br>";
                    endforeach;  
                  endforeach;  
                  
                  echo '</select> <br> <br>';
                
                endforeach;
            ?>
              
              <div class="form-group mt-3">
                    <input class="form-control" type="text" name="email" id="email" placeholder="E-mail">
                    <span id="alerta-email" class="to-hide">Preencha o campo email corretamente</span>
                </div>
                <div class="form-group mt-3">
                    <input class="form-control" type="password" name="senha" id="senha" placeholder="Senha">
                    <span id="alerta-senha" class="to-hide">Preencha o campo senha corretamente</span>
                </div>
                <div class="form-group mt-3">
                    <a href="configuracoes.php" class="btn-cinza">Voltar</a>
                    <a href="" class="btn-verde" data-toggle="modal" data-target="#ModalLongoExemplo"> Deletar </a>
                    <div class="modal fade-modal" id="ModalLongoExemplo" tabindex="-1" role="dialog" aria-labelledby="TituloModalLongoExemplo" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="TituloModalLongoExemplo"> VOCÊ TEM CERTEZA QUE DESEJA DELETAR SUA CONTA DO BARKANET? </h3>
                            </div>
                            <div class="modal-body">
                                <p> 
                                  Você tem certeza de que deseja excluir sua conta do Barkanet? Seu dados, incluindo publicações e comentários serão apagados imediatamente. Essa ação é irreversível.
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn-cinza" data-dismiss="modal">Cancelar</button>
                                <input type="submit" class="btn-verde" name="submit" value="Deletar" id="form_exclusao">
                            </div>
                          </div>
                      </div>
                    </div>
                </div>
              </form>
          </div>
        </div>
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
