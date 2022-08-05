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
    <script src="js/script.js"></script>
    <link href="fontawesome/css/all.css" rel="stylesheet">
</head>

<body>
    <?php ler_dados_usuario($email, $pdo);?>

    <div class="card-fundo mx-auto" style="width: 50%;">
        <h2 class="p-3">Meus posts</h2>
        <?php ler_posts_usuario() ?>
    </div>
</body>
</html>


