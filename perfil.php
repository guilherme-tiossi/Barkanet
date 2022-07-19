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
    <div><?php echo ler_dados_usuario($email, $pdo);?></div>

    <div class="card-fundo mx-auto" style="width: 50%;">
        <h2 class="p-3">Meus posts</h2>
        <?php
        $stmt = $pdo->prepare("SELECT * FROM tbposts WHERE (usuario = '$id')  ORDER BY idpost DESC");
        $stmt ->execute();
        
        foreach ($stmt as $row) :?>
        <div class="mx-auto" style="width: 80%;">
            <!--post-->
            <div class="mt-3 card-posts">
                <div class="card-body">
                    <div class="d-flex flex-row bd-highlight mb-0">
                        <div class="p-2 bd-highlight">
                            <img class="float-left" src="img/<?php echo $pfp;?>" width="64" height="64" title="foto">
                        </div>
                        <div class="p-2 bd-highlight">
                            <p class="mb-0" style="font-size: 18px";>
                                <b><u><?php echo $row["nome"];?></u></b>
                                <br>
                                <b><?php echo $row["titulo"];?></b>
                            </p>
                        </div>
                    </div>
                    <p class="m-1"><?php echo $row["post"];?></p>
                    <div class="mx-auto m-1//" style="width: 80%;">
                        <?php if ($row["image"] != null){?>
                        <img src="img/<?php echo $row["image"]; ?>" class="img-fluid" title="<?php echo $row['image']; ?>">
                        <?php }?>
                    </div>
                </div>
            </div>

            <!--comentarios-->
            <?php
            $swor = $pdo->prepare("SELECT * FROM comentarios WHERE id_post = '{$row['idpost']}'");
            $swor->execute();
            foreach ($swor as $swo) : ?>
            <br>
            <div class="d-flex flex-row bd-highlight mb-0">
                <div class="p-2 bd-highlight">
                    <img class="float-left" src="img/<?php echo $pfp;?>" width="50" height="50" title="foto">
                </div>
                <div class="p-2 bd-highlight">
                    <p class="mb-0" style="font-size: 17px";>
                        <b><?php echo $swo["com_nome"];?></b>
                        <br>
                        <?php echo $swo["comentario"];?>
                    </p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endforeach;?>
    </div>



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


