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
    <?php $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = '$email'");
		 $stmt ->execute();
			foreach($stmt as $row) {
				global $nome;
				global $cod;
				global $nasc;
				global $bio;
				global $id;
				global $pfp;
				global $cordefundo;
				$nome = $row['nome'];
				$nasc = $row['data_nasc'];
				$nasc = date_create_from_format("Y-m-d", $nasc)->format("d/m/Y");
				$cod = $row['codigo'];
				$bio = $row['bio'];
				$id = $row['id'];
				$pfp = $row['profilepic'];
				$cordefundo = $row['cordefundo'];
				}
			echo 
			'<div class="card-fundo pt-1">
			<div class="mx-auto pt-3 pb-3" style="width: 90%;">
	            <div class="card card-perfil">
	                <div class="card-body">
	                	<form method="POST" action="exec_update.php" autocomplete="off" enctype="multipart/form-data">
	                    <div class="d-flex flex-row bd-highlight mb-0">
	                        <div class="p-2 bd-highlight">
														<div class="image-upload">
															<label for="pfp" class="position-absolute">
																<i class="fa-solid fa-pencil"> <input type="file" name="pfp" id="pfp" class ="pfp-input" accept=".png, .jpeg, .jpg"> </i>
															</label>
															<img class="float-left" src="img/'.$pfp.'" width="150" height="150" title="'.$pfp.'">
														</div>
	                            <p class="mb-0" style="font-size: 18px";>
	                                <b>Nome:</b>
	                                <br>
                                  <input class="textoupdate_nome" type="text" name="nome" id="nome" value="'.$nome.'">
                                  <input type="submit" hidden>
	                            </p>
	                        </div>
	                        <div class="p-2 bd-highlight">
	                            <h5 class="m-0">
	                                <b>Informações da conta:</b>
	                            </h5>
	                            <p class="mb-0" style="font-size: 18px";>
	                                <b>E-mail:</b>
	                                <br>'.$email.'
	                            </p>
	                            <p class="mb-0" style="font-size: 18px";>
	                                <b>Biografia:</b>
	                                <br>
                                  <input class="textoupdate_2" type="text" name="bio" id="bio" value="'.$bio.'">              
                                </p>
	                            <p class="mb-0" style="font-size: 18px";>
	                                <b>Data de nascimento:</b>
	                                <br>
                                  <input class="textoupdate_2" type="text" name="data" id="data" value="'.$nasc.'">
                                  <input type="submit" hidden />
	                            </p>
	                            <p class="mb-0" style="font-size: 18px";>
	                                <b>Código:</b>
	                                '.$cod.'
	                            </p>
								<select id="cordefundo" name="cordefundo">
								<option value="rgb(238, 239, 243))">Padrão</option>
  								<option value="rgb(24, 8, 54)">Mirtilo</option>
  								<option value="rgb(218, 42, 42)">Morango</option>
  								<option value="rgb(158, 222, 84)">Limão</option>
  								<option value="rgb(235, 154, 129)">Pêssego</option>
								</select>
	                        </div>
	                    </div>
	                	</form>
	                </div>
	            </div>
	        </div>
	        </div>';?>

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


