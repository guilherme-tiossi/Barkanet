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
    <script type="text/javascript" src="js/jquery.mask.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>

<body>

<div class="d-flex">
  <!--Menu Esquerda-->
  <div class="col">
    <?php include('menu_esquerda.php');?>
  </div>

  <!--Centro-->
  <div class="col-6">
        <div class="card-fundo-ext">
                <div class="box-center">
                        <div class="card m-3" style="width: 25rem;" id="box-alterar">
                                        <div class="card-body">
                                                <h3>Alterar senha</h3>
                                                <form name="frmUser" method="post" action="exec_senha.php" onsubmit="return editarSenha()">
                                                        <div class="form-group mt-3">
                                                                <input type="password" class="form-control" placeholder="Senha:" name="senha" id="senha">
                                                                <span id="alert-senha" class="to-hide">A senha deve ter no mínimo 8 caracteres</span>
                                                        </div>
                                                        <div class="form-group mt-3">
                                                                <input type="password" class="form-control" placeholder="Confirmar senha:" name="c_senha" id="c_senha">
                                                                <span id="alert-c_senha1" class="to-hide">Repita a senha<br></span>
                                                                <span id="alert-c_senha2" class="to-hide">As senhas não são iguais<br></span>
                                                                <input type="checkbox" name="mostrar" onclick="senhaCadastro()">
                                                                <label for="mostrar">Mostrar senha</label>
                                                        </div>
                                                        <div class="form-group mt-3">
                                                                <a href="configuracoes.php" class="btn-cinza">Voltar</a>
                                                                <input type="submit" name="submit" value="Salvar" class="btn-verde">
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