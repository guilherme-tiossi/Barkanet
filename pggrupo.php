<?php
include "lib/includes.php";
include "conexao.php";
?>

<?php
$stmt = $pdo->prepare("SELECT *
FROM tbgrupos
WHERE EXISTS (SELECT id_grupo FROM membros_grupos WHERE id_grupo = tbgrupos.id_grupo and id_usuario = '{$_SESSION['userId']}' and status = 1) ORDER BY id_grupo DESC");
$stmt->execute();

$row_count = $stmt->fetchColumn();
if ($row_count < 1) {
    header('Location: procurar.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Barkanet</title>
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

<div class="d-flex">
  <!--Menu Esquerada-->
  <div class="col">
    <?php include 'menu_esquerda_grupo.php'; ?>
  </div>

  <!--Centro-->
  <div class="col-6">
  <?php
  $id_usuario = $_SESSION['userId'];
  ler_dados_grupo($id_grupo, $id_usuario);

  $pagina_posts = isset($_GET['pagina_posts']) ? $_GET['pagina_posts'] : 1;
  $quantidade_pg = 50;

  ?>
    <div class="card-fundo max-auto">
      <?php
      $id_grupo = $_GET['id_grupo'];
      $grp = $pdo->prepare("SELECT nome_grupo FROM tbgrupos WHERE id_grupo = '$id_grupo'");
      $grp->execute();
      echo "<a href='exec_deleta_grupo.php?id_grupo=$id_grupo'>Apagar Grupo</a>";
      foreach ($grp as $row):
          $nome_grupo = $row['nome_grupo'];
      endforeach;

      $stmt = $pdo->prepare("SELECT * FROM tbposts WHERE idgrupo = '$id_grupo' ORDER BY idpost DESC");
      $stmt->execute();

      $rowNum = $stmt->rowCount();
      $num_pagina = $rowNum / $quantidade_pg;
      $incio = $quantidade_pg * $pagina_posts - $quantidade_pg;

      if (isset($_GET['pagina_posts'])) {
          if ($_GET['pagina_posts'] > $num_pagina + 1) {
              echo "<script>document.location.href = 'pggrupo.php?id_grupo=" . $_GET['id_grupo'] . "&pagina_posts=1';</script>";
          }

          if ($_GET['pagina_posts'] == 0) {
              echo "<script>document.location.href = 'pggrupo.php?id_grupo=" . $_GET['id_grupo'] . "&pagina_posts=1';</script>";
          }

          if (!preg_match('/^[1-9][0-9]*$/', $_GET['pagina_posts'])) {
              echo "<script>document.location.href = 'pggrupo.php?id_grupo=" . $_GET['id_grupo'] . "&pagina_posts=1';</script>";
          }
      }

      $stmt = $pdo->prepare("SELECT * FROM tbposts WHERE idgrupo = '$id_grupo' ORDER BY idpost DESC LIMIT $incio, $quantidade_pg");
      $stmt->execute();

      echo "
      <h2 class='p-3'>Posts de " .
          $nome_grupo .
          "</h2>";
      foreach ($stmt as $row):
          $idposter = $row['usuario'];
          $pfp_poster = $row['profilepic'];
          $nome_poster = $row['nome'];
          $poster = $row['post'];

          echo "
        <div class='mx-auto' style='width: 80%;'>
          <div class='mt-3 card-posts'>
            <div class='card-body card bg-light m-2'>
              <div class='d-flex flex-row bd-highlight mb-0'>
                <div class='p-2 bd-highlight'>
                  <img class='float-left' src='img/$pfp_poster' width='64' height='64' title='foto'>
                </div>
                <div class='p-2 bd-highlight'>
                  <p class='mb-0' style='font-size: 18px';>
                  <b><a href='pgamigo.php?id=$idposter'>$nome_poster</a></b>
                  <br>
                  <b>$row[titulo]</b>
                  </p>
                </div>
              </div>
              <div class='m-3 mt-0'>
                <p class='m-1'>$poster</p>
                <div class='mx-auto m-1' style='width: 80%;'>";
          if ($row['image'] != null) {
              echo "
                          <img src='img/$row[image]' class='img-fluid' title='<$row[image]';/>";
          }
          echo "
                </div>
              </div>
            </div>
          </div>
        </div>";

          //COMENTARIOS
          $swor = $pdo->prepare("SELECT * FROM comentarios WHERE id_post = '{$row['idpost']}'");
          $swor->execute();
          $linhas = $swor->rowCount();

          if ($linhas > 0) {
              echo "
            <div class='mx-auto mb-2' style='width: 80%;'>
              <div class='card-comentarios pt-3'>";
              foreach ($swor as $swo):
                  $idcomenter = $swo['com_user'];
                  $pfpcom = $swo['profilepic'];
                  $com = $swo['comentario'];
                  $com_nome = $swo['com_nome'];

                  echo "
                    <div class='card bg-light m-3 mt-0 p-2' style='width: 80%;'>
                      <div class='d-flex flex-row mb-0'>
                        <div class='p-2 bd-highlight'>
                            <img class='float-left' src='img/$pfpcom' width='50' height='50' title='foto'>
                        </div>
                        <div class='p-2 bd-highlight'>
                            <div class='mb-0' style='font-size: 17px';>
                              <a href='pgamigo.php?id=$idcomenter'>$com_nome</a>				
                              <br>
                              <p>$com</p>
                            </div>
                        </div>
                      </div>
                    </div>";
              endforeach;
              echo "
              </div>
            </div>";
          }

          //COMENTAR
          $idpost = $row["idpost"];
          $idgrupo = $_GET['id_grupo'];
          echo '
        <div class="mx-auto mb-2" style="width: 80%;">
          <form action="exec_com.php" method="post">
            <input class="comentario mt-2" type="text" name="txcom" id="txcom" maxlength="100" autocomplete=off placeholder="comentar...">
            <span id="alert-com" class="to-hide" role="alert">Digite um comentario...</span>
            <input type="hidden" name="post_id" value="' .
              $idpost .
              '">
            <input type="hidden" name="id_amigo" value=0> 
            <input type="hidden" name="grupo_id" value="' .
              $idgrupo .
              '"> 
            <button type="submit" name="comentar" class="btn_comentario">
              <i class="fa-solid fa-arrow-up-right-from-square"></i>
            </button>';
          echo '
          </form>
        </div>';
      endforeach;

      $pagina_anterior = $pagina_posts - 1;
      $pagina_posterior = $pagina_posts + 1;

      echo '
            <div class="mt-5">
                <nav>
                    <ul class="pagination justify-content-center pt-2">';
      if ($pagina_anterior != 0) {
          $btn1 =
              '
                            <a class="page-link text-muted" href="pggrupo.php?id_grupo=' .
              $_GET['id_grupo'] .
              '&pagina_posts=' .
              $pagina_anterior .
              '" aria-label="Previous">
                            <i class="fa-solid fa-reply"></i>
                            </a>';
      } else {
          $btn1 = '<span class="page-link text-black-50"><i class="fa-solid fa-reply"></i></span>';
      }

      echo '<li class="page-item">';
      echo $btn1;
      echo '</li>';

      $num_atual = isset($_GET['pagina_posts']) ? $_GET['pagina_posts'] : 1;
      $num_anterior = $num_atual - 1;
      $num_posterior = $num_atual + 1;

      if ($num_anterior != 0) {
          $btn2 = '<a class="page-link text-muted" href="pggrupo.php?id_grupo=' . $_GET['id_grupo'] . '&pagina_posts=' . $num_anterior . '">' . $num_anterior . '</a>';
          echo '<li class="page-item">' . $btn2 . '</li>';
      }

      $btn2 = '<a class="page-link text-muted" href="pggrupo.php?id_grupo=' . $_GET['id_grupo'] . '&pagina_posts=' . $num_atual . '">' . $num_atual . '</a>';
      echo '<li class="page-item">' . $btn2 . '</li>';

      if ($num_posterior < $num_pagina + 1) {
          $btn2 = '<a class="page-link text-muted" href="pggrupo.php?id_grupo=' . $_GET['id_grupo'] . '&pagina_posts=' . $num_posterior . '">' . $num_posterior . '</a>';
          echo '<li class="page-item">' . $btn2 . '</li>';
      }

      if ($num_posterior < $num_pagina + 1) {
          $btn3 = '<a class="page-link text-muted" href="pggrupo.php?id_grupo=' . $_GET['id_grupo'] . '&pagina_posts=' . $pagina_posterior . '" aria-label="Previous"><i class="fa-solid fa-share"></i></a>';
      } else {
          $btn3 = '<span class="page-link text-black-50"><i class="fa-solid fa-share"></i></span>';
      }

      echo '<li class="page-item">';
      echo $btn3;
      echo '</li>
                    </ul>
                </nav>
            </div>
      </div>';

      carrega_pagina_atalho($con);

      //LISTA DE AMIGOS PARA ADICIONAR
      $stmt2 = $pdo->prepare("SELECT * from tbgrupos where id_grupo = {$_GET['id_grupo']}");
      $stmt2->execute();
      foreach ($stmt2 as $row):
          $adm_grupo = $row['adm_grupo'];
      endforeach;

      if ($adm_grupo == $_SESSION['userId']) {
          echo "<h3>Convidar Amigos</h3>";
          $stmt2 = $pdo->prepare("SELECT * from amigos where (id_de = {$_SESSION['userId']} and status = '1') or (id_para = {$_SESSION['userId']} and status = '1')");
          $stmt2->execute();

          foreach ($stmt2 as $row):
              $id_para = $row['id_para'];
              $id_de = $row['id_de'];

              if ($id_para == $_SESSION['userId']) {
                  $stmt3 = $pdo->prepare("SELECT id, nome from usuarios where id = '$id_de'");
                  $stmt3->execute();
                  foreach ($stmt3 as $row):
                      echo "<a href='?pagina=grupo&id_grupo={$_GET['id_grupo']}&id={$row['id']}'>{$row['nome']}</a>";
                      echo "<br>";
                  endforeach;
              }

              if ($id_de == $_SESSION['userId']) {
                  $stmt3 = $pdo->prepare("SELECT id, nome from usuarios where id = '$id_para'");
                  $stmt3->execute();
                  foreach ($stmt3 as $row):
                      echo "<a href='?pagina=grupo&id_grupo={$_GET['id_grupo']}&id={$row['id']}'>{$row['nome']}</a>";
                      echo "<br>";
                  endforeach;
              }
          endforeach;
      } else {
          $stmt2 = $pdo->prepare("SELECT * FROM membros_grupos WHERE (id_adm = $adm_grupo AND id_usuario = {$_SESSION['userId']}) OR (id_usuario = $adm_grupo AND id_adm = {$_SESSION['userId']})");
          $stmt2->execute();
          foreach ($stmt2 as $row):
              $id = $row['id'];
              $id_grupo = $row['id_grupo'];
          endforeach;
          echo "<a href='?pagina=recusar-solicitacao-grupo&id_grupo={$id_grupo}&id={$id}'>Sair do Grupo</a>";
      }
      ?>
  </div>

  <!--Menu Direita-->
  <div class="col">
    <?php include 'menu_direita.php'; ?>
  </div>
</div>