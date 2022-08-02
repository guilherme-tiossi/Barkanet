<?php
	include("lib/includes.php");
    include_once("lib/functions.php");
	include("conexao.php");
	//include('menu_esquerda.php');
	//include('menu_direita.php');
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
    <script src="js/perfil.js"></script>
    <link href="fontawesome/css/all.css" rel="stylesheet">
</head>

<body>
    <?php $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = '$email'");
		 $stmt ->execute();
			foreach($stmt as $row) {
				global $nome;
				global $cod;
				global $nasc;
				global $bio;
				global $id;
				global $pfp;
				$nome = $row['nome'];
				$nasc = $row['data_nasc'];
				$nasc = date_create_from_format("Y-m-d", $nasc)->format("d/m/Y");
				$cod = $row['codigo'];
				$bio = $row['bio'];
				$id = $row['id'];
				$pfp = $row['profilepic'];
				}
			echo 
			'<div class="card-fundo mx-auto pt-1" style="width: 50%;">
			<div class="mx-auto pt-3 pb-3" style="width: 90%;">
	            <div class="card card-perfil">
	                <div class="card-body">
	                    <div class="d-flex flex-row bd-highlight mb-0">
	                        <div class="p-2 bd-highlight">
							<div class="image-upload">
								<form method="POST" action = "exec_update.php">
	                            <label for="file-input">
								<img class="float-left" src="img/'.$pfp.'" width="150" height="150" title="'.$pfp.'">
								</label>
								<input type="file" name="pfp" id="file-input" class ="pfp-input" accept=".png, .jpeg, .jpg" value="'.$pfp.'"">
							</div>
	                            <p class="mb-0" style="font-size: 18px";>
	                                <b>Nome:</b>
	                                <br>
                                  <form method="POST" action="exec_update.php">
                                  <input class="textoupdate_nome" type="text" name="nome" id="nome" value="'.$nome.'">
                                  <input type="submit" hidden />
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
	                                <b>Data de nascimento:</br>
                                  <input class="textoupdate_2" type="text" name="data" id="data" value="'.$nasc.'">
                                  <input type="submit" hidden />
	                            </p>
                          </form>
	                            <p class="mb-0" style="font-size: 18px";>
	                                <b>Código:</b>
	                                '.$cod.'
	                            </p>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        </div>';?>

    <div class="card-fundo mx-auto" style="width: 50%;">
        <h2 class="p-3">Meus posts</h2>
        <?php ler_posts_usuario() ?>



<br>
<br>
<br>
<div class="card bg-light mb-3" style="max-width: 18rem;">
  <div class="card-header">Opçoes q vão ficar no menu depois</div>
  <div class="card-body">
    <a href="logout.php">Sair</a>
    <br>
    <a href="update.php">Editar perfil</a>
  </div>
</div>
<br>
<br>
<br>



</body>
</html>


