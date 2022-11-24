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

if(isset($_GET['id_grupo'])){
  $stmt = $pdo->prepare("SELECT * FROM tbgrupos WHERE id_grupo = '{$_GET['id_grupo']}'");
  $stmt->execute();
  $row_count = $stmt->fetchColumn();

  if ($row_count < 1) {
    header('Location: procurar.php');
  }
}else{
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
    <script type="text/javascript" src="js/jquery.mask.min.js"></script>  
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

      $pagina_grupo = (isset($_GET['pag']) && $_GET['pag'] != null && is_numeric($_GET['pag'])) ? $_GET['pag'] : 1;
      $quantidade_pg = 50;

      $id_grupo = $_GET['id_grupo'];
      $grp = $pdo->prepare("SELECT nome_grupo FROM tbgrupos WHERE id_grupo = '$id_grupo'");
      $grp->execute();

      foreach ($grp as $row):
        $nome_grupo = $row['nome_grupo'];
      endforeach;

      $stmt = $pdo->prepare("SELECT * FROM tbposts WHERE idgrupo = '$id_grupo' ORDER BY idpost DESC");
      $stmt->execute();

      $rowNum = $stmt->rowCount();
      $num_pagina = $rowNum / $quantidade_pg;
      $incio = $quantidade_pg * $pagina_grupo - $quantidade_pg;

      if (isset($_GET['pag'])) {
        if ($_GET['pag'] > $num_pagina + 1) {
          echo "<script>document.location.href = 'pggrupo.php?id_grupo=" . $_GET['id_grupo'] . "&pag=1';</script>";
        }

        if ($_GET['pag'] == 0) {
          echo "<script>document.location.href = 'pggrupo.php?id_grupo=" . $_GET['id_grupo'] . "&pag=1';</script>";
        }

        if (!preg_match('/^[1-9][0-9]*$/', $_GET['pag'])) {
          echo "<script>document.location.href = 'pggrupo.php?id_grupo=" . $_GET['id_grupo'] . "&pag=1';</script>";
        }
      }else{
        echo "<script>document.location.href = 'pggrupo.php?id_grupo=" . $_GET['id_grupo'] . "&pag=1';</script>";
      }
        
      $id_usuario = $_SESSION['userId'];
      ler_dados_grupo($id_grupo, $id_usuario);
      
    ?>
    <div class="card-fundo-ext max-auto">
      <?php
      $stmt = $pdo->prepare("SELECT * FROM tbposts WHERE idgrupo = '$id_grupo' ORDER BY idpost DESC LIMIT $incio, $quantidade_pg");
      $stmt->execute();
      $rowNum = $stmt->rowCount();

      echo "
      <div class='conteudo'>";

      if($rowNum <= 0){
        echo "
        <div id='grupoposts'>
        <div class='d-flex'>
          <div class='p-2 flex-fill'>
            <h2 class='p-3'>Posts de ".$nome_grupo."</h2>
          </div>
          <div class='p-2 flex-fill'>
            <div class='d-flex flex-row-reverse'>
              <div class='btn-group p-3' role='group'>
                <a id='btnopcoesgrupo' class='btn btn-secondary text-uppercase' href='?grupo-posts&id_grupo=".$id_grupo."&pag=1'>Posts</a>
                <a id='btnopcoesgrupo' class='btn btn-secondary text-uppercase' href='?grupo-membros&id_grupo=".$id_grupo."&pag=1'>Membros</a>
              </div>
            </div>
          </div>
        </div>
        <p class='msg-timeline text-center'>Ainda não tem nenhum post aqui...</p>
        </div>";
      }
      else{
        echo "
        <div id='grupoposts'>
        <div class='d-flex'>
          <div class='p-2 flex-fill'>
            <h2 class='p-3'>Posts de ".$nome_grupo."</h2>
          </div>
          <div class='p-2 flex-fill'>
            <div class='d-flex flex-row-reverse'>
              <div class='btn-group p-3' role='group'>
                <a id='btnopcoesgrupo' class='btn btn-secondary text-uppercase' href='?grupo-posts&id_grupo=".$id_grupo."&pag=1'>Posts</a>
                <a id='btnopcoesgrupo' class='btn btn-secondary text-uppercase' href='?grupo-membros&id_grupo=".$id_grupo."&pag=1'>Membros</a>
              </div>
            </div>
          </div>
        </div>";
          foreach ($stmt as $row):
              $idposter = $row['usuario'];
              $pfp_poster = $row['profilepic'];
              $nome_poster = $row['nome'];
              $poster = $row['post'];

              $swor = $pdo->prepare("SELECT * FROM comentarios WHERE id_post = '{$row['idpost']}'");
              $swor->execute();
              $linhas = $swor->rowCount();
        
              echo "
                <div class='mx-auto' style='width: 80%;'>";

                  if($linhas > 0){
                    echo "
                    <div class='mt-3 card-posts' style='border-bottom: none;'>
                    <div class='card-body card bg-light m-2 mb-0'>";
                  }else{
                    echo "
                    <div class='mt-3 card-posts'>
                    <div class='card-body card bg-light m-2'>";
                  }
                  echo "<div class='d-flex flex-row bd-highlight mb-0'>
                        <div class='p-2 bd-highlight'>
                          <img class='float-left' src='img/$pfp_poster' width='64' height='64' title='foto'>
                        </div>
                        <div class='p-2 bd-highlight'>
                          <p class='mb-0' style='font-size: 18px';>
                          <b><a href='pgamigo.php?id=$idposter' class='link'>$nome_poster</a></b>
                          <br>
                          <p class='titulo-post'>$row[titulo]</p>
                          </p>
                        </div>
                      </div>
                      <div class='m-3 mt-0'>
                        <p class='m-1'>$poster</p>
                        <div class='mx-auto m-1' style='width: 80%;'>";
                        if ($row['file'] != null) {
                          if(strripos($row['file'], 'jpg') == true || strripos($row['file'], 'jpeg') == true || strripos($row['file'], 'png') == true || strripos($row['file'], 'gif') == true){
                            echo "<img src='img/$row[file]' class='img-fluid' title='<$row[file]>' />";
                          }else {
                            echo "<video class='vid-fluid' controls><source src='img/$row[file]' title='<$row[file]>''/></video>";
                          }
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
                                      <b> <a href='pgamigo.php?id=$idcomenter' class='link'>$com_nome</a> </b>				
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
                  $idgrupo = $_GET['id_grupo'];
                  echo '
                  <div class="mx-auto mb-2" style="width: 80%;">
                  <form action="exec_com.php" method="post">
                    <input class="comentario mt-2" type="text" name="txcom" id="txcom" maxlength="250" autocomplete=off placeholder="comentar...">
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
        echo "</div>";
      }

      $pagina_anterior = $pagina_grupo - 1;
      $pagina_posterior = $pagina_grupo + 1;
      $num_atual = isset($_GET['pag']) ? $_GET['pag'] : 1;
      $num_anterior = $num_atual - 1;
      $num_posterior = $num_atual + 1;
      $i = 0;

      //LISTA DE AMIGO
      echo "
        <div id='grupomembros' class='to-hide'>
          <div class='d-flex'>
            <div class='p-2 flex-fill'>
              <h2 class='p-3'>Membros</h2>
            </div>
            <div class='p-2 flex-fill'>
              <div class='d-flex flex-row-reverse'>
                <div class='btn-group p-3' role='group'>
                  <a id='btnopcoesgrupo' class='btn btn-secondary text-uppercase' href='?grupo-posts&id_grupo=".$id_grupo."&pag=1'>Posts</a>
                  <a id='btnopcoesgrupo' class='btn btn-secondary text-uppercase' href='?grupo-membros&id_grupo=".$id_grupo."&pag=1'>Membros</a>
                </div>
              </div>
            </div>
          </div>";
        $stmt2 = $pdo->prepare("SELECT * from tbgrupos where id_grupo = {$_GET['id_grupo']}");
        $stmt2->execute();
        foreach ($stmt2 as $row):
            $adm_grupo = $row['adm_grupo'];
        endforeach;

        if ($adm_grupo == $_SESSION['userId']) {
            $stmt2 = $pdo->prepare("SELECT * from amigos where (id_de = {$_SESSION['userId']} and status = '1') or (id_para = {$_SESSION['userId']} and status = '1')");
            $stmt2->execute();

            echo '
            <div class="box-table">
            <table class="table table-hover mx-2 largura-tabela">
            <tbody>';
            foreach ($stmt2 as $row):
                $id_para = $row['id_para'];
                $id_de = $row['id_de'];
                $i += 1;

                if ($id_para == $_SESSION['userId']) {
                    $stmt3 = $pdo->prepare("SELECT id, nome, profilepic from usuarios where id = '$id_de'");
                    $stmt3->execute();
                    foreach ($stmt3 as $row):
                        echo "<tr><td class='col-xs-2 col-sm-2 col-md-2 col-lg-2'><img src='img/$row[profilepic]' class='miniatura'></td>";
                        echo "<td>{$row['nome']}</td><td>";
                        lista_grupo($con, $_SESSION['userId'], $row['id'], $_GET['id_grupo']);
                        echo "</td></tr>";
                    endforeach;
                }

                if ($id_de == $_SESSION['userId']) {
                    $stmt3 = $pdo->prepare("SELECT id, nome, profilepic from usuarios where id = '$id_para'");
                    $stmt3->execute();
                    foreach ($stmt3 as $row):
                        echo "<tr><td class='col-xs-2 col-sm-2 col-md-2 col-lg-2'><img src='img/$row[profilepic]' class='miniatura'></td>";
                        echo "<td>{$row['nome']}</td><td>";
                        lista_grupo($con, $_SESSION['userId'], $row['id'], $_GET['id_grupo']);
                        echo "</td></tr>";
                    endforeach;
                }
                
            endforeach;
            
            echo "
            </tbody>
            </table>
            </div>";

        } else {
          $stmt2 = $pdo->prepare("SELECT * FROM membros_grupos WHERE (id_adm = $adm_grupo AND id_usuario = {$_SESSION['userId']}) OR (id_usuario = $adm_grupo AND id_adm = {$_SESSION['userId']})");
          $stmt2->execute();
          foreach ($stmt2 as $row):
            $id = $row['id'];
            $id_grupo = $row['id_grupo'];
          endforeach;
          echo "<a href='?pag={$num_atual}&pagina=recusar-solicitacao-grupo&id_grupo={$id_grupo}&id={$id}' class='mx-3 btn-solicitation-n'>Sair do Grupo</a>";


          $stmt2 = $pdo->prepare("SELECT * from membros_grupos where id_grupo = {$_GET['id_grupo']}");
          $stmt2->execute();

          echo '
            <div class="box-table mt-3">
            <table class="table table-hover mx-2 largura-tabela">
            <tbody>';
          foreach ($stmt2 as $row):
            $id_usuario = $row['id_usuario'];
            $stmt2 = $pdo->prepare("SELECT * from usuarios where id = {$id_usuario}");
            $stmt2->execute();
            foreach ($stmt2 as $row):
              echo "<tr><td class='col-xs-2 col-sm-2 col-md-2 col-lg-2'><img src='img/$row[profilepic]' class='miniatura'></td>";
              echo "<td>{$row['nome']}</td>";
              echo "</tr>";
            endforeach;
          endforeach;
          echo "
          </tbody>
          </table>
          </div>";

        };
        echo "
      </div>";

      echo "</div>";
      echo '
            <div class="mt-5 paginacao">
                <nav>
                    <ul class="pagination justify-content-center pt-2">';
                    if ($pagina_anterior != 0) {
                        $btn1 =
                            '
                                          <a class="page-link text-kiwi" href="pggrupo.php?id_grupo=' .
                            $_GET['id_grupo'] .
                            '&pag=' .
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

                    if ($num_anterior != 0) {
                        $btn2 = '<a class="page-link text-kiwi" href="pggrupo.php?id_grupo=' . $_GET['id_grupo'] . '&pagina_grupo=' . $num_anterior . '">' . $num_anterior . '</a>';
                        echo '<li class="page-item">' . $btn2 . '</li>';
                    }

                    $btn2 = '<a class="page-link text-kiwi" href="pggrupo.php?id_grupo=' . $_GET['id_grupo'] . '&pagina_grupo=' . $num_atual . '">' . $num_atual . '</a>';
                    echo '<li class="page-item">' . $btn2 . '</li>';

                    if ($num_posterior < $num_pagina + 1) {
                        $btn2 = '<a class="page-link text-kiwi" href="pggrupo.php?id_grupo=' . $_GET['id_grupo'] . '&pagina_grupo=' . $num_posterior . '">' . $num_posterior . '</a>';
                        echo '<li class="page-item">' . $btn2 . '</li>';
                    }

                    if ($num_posterior < $num_pagina + 1) {
                        $btn3 = '<a class="page-link text-kiwi" href="pggrupo.php?id_grupo=' . $_GET['id_grupo'] . '&pagina_grupo=' . $pagina_posterior . '" aria-label="Previous"><i class="fa-solid fa-share"></i></a>';
                    } else {
                        $btn3 = '<span class="page-link text-black-50"><i class="fa-solid fa-share"></i></span>';
                    }

                    echo '<li class="page-item">';
                    echo $btn3;
                    echo '</li>
                    </ul>
                </nav>
            </div>';
      ?>
    </div>
  </div>

  <!--Menu Direita-->
  <div class="col">
    <?php include 'menu_direita.php'; ?>
  </div>
</div>

<?php
if (isset($_GET['editar-grupo'])){
  ?><script>
    mostraropcoesgrupos()
  </script><?php
}

if (isset($_GET['grupo-posts'])){
  ?><script>
    grupoPosts()
  </script><?php
}

if (isset($_GET['grupo-membros'])){
  ?><script>
    grupoMembros()
  </script><?php
}
?>

<script>
function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#pfpgrupo").change(function(){
    readURL(this);
});
</script>