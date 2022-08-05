<?php
require_once ("conexao.php");
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = '$email'");
$stmt ->execute();

 foreach($stmt as $row) {
   $pfp = $row['profilepic'];
   }
?>

<head>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script type="text/javascript" src="js/script.js"></script>
</head>
<div>
  <div>
    <img src='img/<?php echo $pfp; ?>' width = 50 title='<?php echo $pfp; ?>'>
    <br>
    <a href="perfil.php">Perfil</a>
    <br>
    <a href="procurar.php">Procurar </a>
    <?php
    $not = return_total_solicitation($con) + return_total_solicitation_grupo($con);
    if($not > 0){
      echo $not;
    }
    ?>
    <br>
    <a href="update.php">Editar perfil</a>
    <br>
    <a href="#">Configurações</a>
    <br>
    <a href="logout.php" onclick="reset()">Sair</a>
  </div>
  <div>
    <div>
    <h3>Publicar seu post</h3>
    <form action="exec_posts.php"  method="post" onsubmit="return verificaPostagem()" autocomplete="off" enctype="multipart/form-data">
      <label for="txTitulo">Título</label>
      <input type="text" name="txTitulo" id="txTitulo">
      <span id="alert-titulo1" class="to-hide" role="alert">Coloque um titulo</span>
      <span id="alert-titulo2" class="to-hide" role="alert">O titulo deve ter no maximo 50 caracteres</span>
      <br>
      <label for="txPost">Post</label>
      <input type="text" name="txPost" id="txPost">
      <span id="alert-postagem" class="to-hide" role="alert">Digite algo...</span>
      <br>
      <label for="image">Imagem</label>
      <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
      <br>
      <input type="hidden" name="idgrupo" value="0">
      <input type="submit" name="submit" value="Submit">
    </form>
  </div>
</div>