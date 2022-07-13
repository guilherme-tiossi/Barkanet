<?php
include("lib/includes.php");
include("conexao.php");

// MENU ESQUERDA
$stmt = $pdo->prepare("select * from usuarios where email = '$email'");
$stmt ->execute();
$id_grupo = $_GET['id_grupo'];
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
    <a href="#">Configurações</a>
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
      <input type="hidden" name="idgrupo" value="<?php echo $id_grupo;?>"> </input>
      <input type="submit" name="submit" value="Submit">
    </form>
  </div>
</div>
<?php
// FIM DO MENU ESQUERDA
include('menu_direita.php');
$id_grupo = $_GET['id_grupo'];
$stmt = $pdo->prepare("select * from tbposts where idgrupo = '$id_grupo' order by idpost desc");
$stmt->execute();

foreach ($stmt as $row) : ?>
  <div>
    <?php
      echo $row["nome"];
      echo "<br>";
      echo $row["titulo"];
      echo "<br>";
      echo $row["post"];
      echo "<br>";
      echo "<br>";
    if ($row["image"] != null){
    ?>
    <img src="img/<?php echo $row["image"]; ?>" width = 200 title="<?php echo $row['image']; ?>">
  </div>
    <?php }
    $swor = $pdo->prepare("select * from comentarios where id_post = '{$row['idpost']}' order by id_com desc");
    $swor->execute();
    foreach ($swor as $swo) : ?>
    <div>
      <?php
        echo $swo["com_nome"];
        echo "<br>";
        echo $swo["comentario"];
      ?>
    </div>
    <br>
    <?php endforeach; ?>
    </div>
    <br>
    <h5>Publicar seu Comentario</h5>
    <form action="exec_com.php"  method="post">
      <label for="txcom">Comentario:</label>
      <input type="text" name="txcom" id="txcom">
      <span id="alert-com" class="to-hide" role="alert">Digite um comentario...</span>
      <br>
      <input type="hidden" name="post_id" value="<?php echo $row["idpost"]; ?>">
      <input type="submit" name="comentar" value="Enviar">
    </form>
    <?php endforeach;?>

  <?php carrega_pagina_atalho($con);?>
  
  <!--LISTA DE AMIGOS PARA ADD-->
  <?php 
  $stmt2 = $pdo->prepare("select * from tbgrupos where id_grupo = {$_GET['id_grupo']}");
  $stmt2 ->execute();
  foreach ($stmt2 as $row) :
    $adm_grupo = $row['adm_grupo'];
  endforeach;

  if($adm_grupo == $_SESSION['userId']){
    echo "<h3>Convidar Amigos</h3>";
    $stmt2 = $pdo->prepare("select * from amigos where (id_de = {$_SESSION['userId']} and status = '1') or (id_para = {$_SESSION['userId']} and status = '1')");
    $stmt2 ->execute();

    foreach ($stmt2 as $row) :
      $id_para = $row['id_para'];
      $id_de = $row['id_de'];
                
      if($id_para == $_SESSION['userId']){
        $stmt3 = $pdo->prepare("select id, nome from usuarios where id = '$id_de'");
        $stmt3 ->execute();
        foreach ($stmt3 as $row):
          echo "<a href='?pagina=grupo&id_grupo={$_GET['id_grupo']}&id={$row['id']}'>{$row['nome']}</a>";
          echo "<br>";
        endforeach;
      }

      if($id_de == $_SESSION['userId']){
        $stmt3 = $pdo->prepare("select id, nome from usuarios where id = '$id_para'");
        $stmt3 ->execute();
        foreach ($stmt3 as $row):
          echo "<a href='?pagina=grupo&id_grupo={$_GET['id_grupo']}&id={$row['id']}'>{$row['nome']}</a>";
          echo "<br>";
        endforeach;
      }
    endforeach;
  }else{
    $stmt2 = $pdo->prepare("SELECT * FROM membros_grupos WHERE (id_adm = $adm_grupo AND id_usuario = {$_SESSION['userId']}) OR (id_usuario = $adm_grupo AND id_adm = {$_SESSION['userId']})");
    $stmt2 ->execute();
    foreach ($stmt2 as $row) :
      $id = $row['id'];
      $id_grupo = $row['id_grupo'];
    endforeach;
    echo "<a href='?pagina=remover-grupo&id_grupo={$id_grupo}&id={$id}'>Sair do Grupo</a>";
  }
  ?>
</div>
