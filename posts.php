<?php
include("lib/includes.php");
include("conexao.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Posts</title>
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
  <!--Menu Esquerda-->
  <div class="col">
    <?php include('menu_esquerda.php');?>
  </div>

  <!--Centro-->
  <div class="col-6">
    <?php
    $pagina = (isset($_GET['pag']) && $_GET['pag'] != null && is_numeric($_GET['pag']))? $_GET['pag'] : 1;

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

    if(isset($_GET['pag'])){
      if($_GET['pag'] > ($num_pagina + 1)){
        echo "<script>document.location.href = 'posts.php?pag=1';</script>";
      }

      if($_GET['pag'] == 0){
        echo "<script>document.location.href = 'posts.php?pag=1';</script>";
      }

      if (!preg_match('/^[1-9][0-9]*$/', $_GET['pag'])) {
        echo "<script>document.location.href = 'posts.php?pag=1';</script>";
      }
    }else{
      echo "<script>document.location.href = 'posts.php?pag=1';</script>";
    }

    echo "
    <div class='card-fundo-ext'>";

      if($rowNum <= 0){
        echo "
        <h2 class='p-3'>Timeline Principal</h2>
        <div class='conteudo'>
          <p class='msg-timeline text-center'>Ainda não tem nenhum post aqui...</p>
        </div>";
      }
      else{

        $stmt = $pdo->prepare("SELECT * FROM tbposts WHERE usuario in ($users) AND idgrupo = '0' ORDER BY idpost DESC LIMIT $incio, $quantidade_pg");
        $stmt->execute();
        
        echo "<h2 class='p-3'>Timeline Principal</h2>";
        
        foreach ($stmt as $row):
        $idposter = $row['usuario'];
        $pfpamigo = $row['profilepic'];

        $swor = $pdo->prepare("SELECT * FROM comentarios WHERE id_post = '{$row['idpost']}'");
        $swor->execute();
        $linhas = $swor->rowCount();
        
        echo "
        <div class='conteudo'>
          <div class='mx-auto pt-4' style='width: 80%;'>";

        if($linhas > 0){
          echo "
          <div class='card-posts' style='border-bottom: none;'>
          <div class='card-body card bg-light m-2 mb-0'>";
        }else{
          echo "
          <div class='card-posts'>
          <div class='card-body card bg-light m-2'>";
        }
          echo "<div class='d-flex flex-row bd-highlight mb-0'>
                  <div class='p-2 bd-highlight'>
                    <img class='float-left' src='img/$pfpamigo' width='64' height='64' title='foto'>
                  </div>
                  <div class='p-2 bd-highlight'>
                    <p class='mb-0' style='font-size: 18px';>";
          
          if ($row['idgrupo'] > 0) {
              $stmt = $pdo->prepare("SELECT tbgrupos.nome_grupo, tbgrupos.id_grupo from tbposts JOIN tbgrupos ON tbposts.idgrupo = tbgrupos.id_grupo WHERE usuario = '$id' AND idpost = $row[idpost]");
              $stmt->execute();
              foreach ($stmt as $roww):
                  $id_grupo = $roww['id_grupo'];
                  echo "<a class='link' href='pggrupo.php?id_grupo=$id_grupo'>" . $roww['nome_grupo'] . "</a><br>";
              endforeach;
          }
          
            echo "<b><a class='link' href='pgamigo.php?id=$idposter'>".$row['nome']."</a></b><br>
                  <p class='titulo-post'>$row[titulo]</p>
                  </p>
                </div>
              </div>

                <div class='m-3 mt-0'>
                  <p> $row[post]</p>
                  <div class='mx-auto m-1' style='width: 80%;'>";
          if ($row['file'] != null) {
              if(strripos($row['file'], 'jpg') == true || strripos($row['file'], 'jpeg') == true || strripos($row['file'], 'png') == true || strripos($row['file'], 'gif') == true){
                echo "<img src='img/$row[file]' class='img-fluid' title='<$row[file]>' />";
              }else {
                echo "<video class='vid-fluid' controls><source src='img/$row[file]' title='<$row[file]>''/></video>";
              }
          }
            echo "</div>
                </div>
              </div>
            </div>
          </div>";

          //COMENTARIOS
          $swor = $pdo->prepare("SELECT * FROM comentarios WHERE id_post = '{$row['idpost']}'");
          $swor->execute();
          $linhas = $swor->rowCount();

          if($linhas > 0){
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
                        <b> <a class='link' href='pgamigo.php?id=$idcomenter'>$com_nome</a> </b>				
                        <br>
                        <p style='word-break: break-word;'>$com</p>
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
          echo '
          <div class="mx-auto mb-2" style="width: 80%;">
            <form action="exec_com.php" method="post">
              <input class="comentario mt-2" type="text" name="txcom" id="txcom" maxlength="250" autocomplete=off placeholder="comentar...">
              <span id="alert-com" class="to-hide" role="alert">Digite um comentario...</span>
              <input type="hidden" name="post_id" value="'.$idpost.'">
              <button type="submit" name="comentar" class="btn_comentario">
              <i class="fa-solid fa-square-arrow-up-right"></i>
              </button>';
            echo '
            </form>
          </div>
        </div>';
        endforeach;
      }
        
      $pagina_anterior = $pagina - 1;
      $pagina_posterior = $pagina + 1;
      ?>

      <div class="mt-5 paginacao">
          <nav>
            <ul class="pagination justify-content-center pt-2">
              <?php
                if($pagina_anterior != 0){
                    $btn1 = '
                    <a class="page-link text-kiwi" href="posts.php?pag='.$pagina_anterior.'" aria-label="Previous">
                      <i class="fa-solid fa-reply"></i>
                    </a>';
                }else{
                  $btn1 = '<span class="page-link text-black-50"><i class="fa-solid fa-reply"></i></span>';
                }
              ?>
              <li class="page-item">
                <?php echo $btn1?>
              </li>

              <?php
                  $num_atual = (isset($_GET['pag']))? $_GET['pag'] : 1;
                  $num_anterior = $num_atual - 1;
                  $num_posterior = $num_atual + 1;

                  if($num_anterior != 0){
                    $btn2 = '<a class="page-link text-kiwi" href="posts.php?pag='.$num_anterior.'">'.$num_anterior.'</a>';
                    echo '<li class="page-item">'.$btn2.'</li>';
                  }

                  $btn2 = '<a class="page-link text-kiwi" href="posts.php?pag='.$num_atual.'">'.$num_atual.'</a>';
                  echo '<li class="page-item">'.$btn2.'</li>';

                  if($num_posterior < ($num_pagina + 1)){
                    $btn2 = '<a class="page-link text-kiwi" href="posts.php?pag='.$num_posterior.'">'.$num_posterior.'</a>';
                    echo '<li class="page-item">'.$btn2.'</li>';
                  }
              ?>

              <?php
                if($num_posterior < ($num_pagina + 1)){
                  $btn3 = '<a class="page-link text-kiwi" href="posts.php?pag='.$pagina_posterior.'" aria-label="Previous"><i class="fa-solid fa-share"></i></a>';
                }else{
                  $btn3 = '<span class="page-link text-black-50"><i class="fa-solid fa-share"></i></span>';
                }
              ?>
              <li class="page-item">
                <?php echo $btn3?>
              </li>
            </ul>
          </nav>
      </div>
    
      <?php
    echo "
    </div>";
    ?>
  </div>
  
  <!--Menu Direita-->
  <div class="col">
    <?php include('menu_direita.php');?>
  </div>
</div>