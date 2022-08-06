<?php
include("lib/includes.php");
include("conexao.php");
include('menu_esquerda.php');
include('menu_direita.php');
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

<?php
$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

$quantidade_pg = 50;

$users=array("$id");
$stmt = $pdo->prepare("SELECT * FROM amigos WHERE (id_de = {$_SESSION['userId']} and status = '1') OR (id_para = {$_SESSION['userId']} AND status = '1')");
$stmt ->execute();
foreach ($stmt as $row):
  if ($row["id_de"] == $id ){
  array_push($users, $row["id_para"]);
  }
  elseif ($row["id_para"] == $id){
    array_push ($users, $row["id_de"]);
  }
endforeach;
$users = implode(",", $users);
$stmt = $pdo->prepare("SELECT * FROM tbposts WHERE usuario in ($users) AND idgrupo = '0' ORDER BY idpost DESC");
$stmt->execute();

$rowNum = $stmt->rowCount();
$num_pagina = ($rowNum/$quantidade_pg);
$incio = ($quantidade_pg*$pagina)-$quantidade_pg;

$stmt = $pdo->prepare("SELECT * FROM tbposts WHERE usuario in ($users) AND idgrupo = '0' ORDER BY idpost DESC LIMIT $incio, $quantidade_pg");
$stmt->execute();
echo "<div class='card-fundo mx-auto' style='width: 50%;'>";
foreach ($stmt as $row) :
  echo "<div class='mx-auto' style='width: 80%;'>
          <!--post-->
          <div class='mt-3 card-posts'>
          <div class='card-body'>
              <div class='d-flex flex-row bd-highlight mb-0'>
                  <div class='p-2 bd-highlight'>
                      <img class='float-left' src='img/$pfp' width='64' height='64' title='foto'>
                  </div>
                  <div class='p-2 bd-highlight'>
                      <p class='mb-0' style='font-size: 18px';>";
                      if($row['idgrupo'] > 0){
                          $stmt = $pdo->prepare("SELECT tbgrupos.nome_grupo from tbposts JOIN tbgrupos ON tbposts.idgrupo = tbgrupos.id_grupo WHERE usuario = '$id' AND idpost = $row[idpost]");
                          $stmt->execute();
                          foreach($stmt as $roww):
                          echo "<b> $roww[nome_grupo] </b>
                          <br>";
                          endforeach; 	
                          }
                          echo "<b><u> $row[nome]</u></b>
                          <br>
                          <b> $row[titulo]</b>
                      </p>
                  </div>
              </div>
              <p class='m-1'> $row[post]</p>
              <div class='mx-auto m-1//' style='width: 80%;'>";
                  if ($row['image'] != null){
                  echo "<img src='img/'$row[image]' class='img-fluid' title='<$row[image]';/>";}
                  echo "</div></div>";

      //comentários
      $swor = $pdo->prepare("SELECT * FROM comentarios WHERE id_post = '{$row['idpost']}'");
      $swor->execute();
      foreach ($swor as $swo) :
      echo "<br>
      <div class='d-flex flex-row bd-highlight mb-0'>
          <div class='p-2 bd-highlight'>
              <img class='float-left' src='img/$pfp' width='50' height='50' title='foto'>
          </div>
          <div class='p-2 bd-highlight'>
              <p class='mb-0' style='font-size: 17px';>
                  <b>$swo[com_nome]</b>
                  <br>
                  $swo[comentario]
              </p> </div> </div>";
      endforeach;
  echo '     <br>
  <h5>Publicar seu Comentario</h5>
  <form action="exec_com.php"  method="post">
    <label for="txcom">Comentario:</label>
    <input type="text" name="txcom" id="txcom" maxlength="100">
    <span id="alert-com" class="to-hide" role="alert">Digite um comentario...</span>
    <br>
    <input type="hidden" name="post_id" value=';  echo $row["idpost"];  echo ' 
    <input type="submit" name="comentar" value="Enviar">
  </form> </div> </div>';
  endforeach;
  echo "</div> ";

    $pagina_anterior = $pagina - 1;
    $pagina_posterior = $pagina + 1;
  ?>
  
  <nav class="text-center">
    <ul class="pagination">
      <li>
        <?php
        if($pagina_anterior != 0){ ?>
          <a href="posts.php?pagina=<?php echo $pagina_anterior; ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        <?php }else{ ?>
          <span aria-hidden="true">&laquo;</span>
        <?php }?>
      </li>
      <?php 
      for($i = 1; $i < $num_pagina + 1; $i++){ ?>
        <li><a href="posts.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
      <?php } ?>
      <li>
        <?php
        if($pagina_posterior <= $num_pagina){ ?>
          <a href="posts.php?pagina=<?php echo $pagina_posterior; ?>" aria-label="Previous">
            <span aria-hidden="true">&raquo;</span>
          </a>
        <?php }else{ ?>
          <span aria-hidden="true">&raquo;</span>
        <?php }  ?>
      </li>
    </ul>
  </nav>
