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
</head>

<div class="d-flex">
  <!--Menu Esquerada-->
  <div class="col">
    <?php include('menu_esquerda.php');?>
  </div>

  <!--Centro-->
  <div class="col-6">
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

    echo "<div class='card-fundo mx-auto'>";
        foreach ($stmt as $row) :
        $n = $pdo->prepare("SELECT * FROM usuarios WHERE id = '{$row['usuario']}'");
        $n->execute();
        foreach ($n as $w) :
          $foto_perfil = $w['profilepic'];

        echo "<div class='mx-auto mb-2' style='width: 80%;'>
                <div class='mt-3 card-posts'>
                <div class='card-body'>
                    <div class='d-flex flex-row bd-highlight mb-0'>
                        <div class='p-2 bd-highlight'>
                            <img class='float-left' src='img/$foto_perfil' width='64' height='64' title='".$foto_perfil."'>
                        </div>
                        <div class='p-2 bd-highlight'>
                            <p class='mb-0' style='font-size: 18px';>";
                                if($row['idgrupo'] > 0){
                                $stmt = $pdo->prepare("SELECT tbgrupos.nome_grupo, tbgrupos.id_grupo from tbposts JOIN tbgrupos ON tbposts.idgrupo = tbgrupos.id_grupo WHERE usuario = '$id' AND idpost = $row[idpost]");
                                $stmt->execute();
								foreach($stmt as $roww):
                              	$id_grupo = $roww['id_grupo'];
							    echo "<a href='pggrupo.php?id_grupo=$id_grupo'>" . $roww['nome_grupo']. "</a>
								<br>";
								endforeach; 	
								}
								$idposter = $row['usuario'];
								echo "<b> <a href='pgamigo.php?id=$idposter'>" . $row['nome'] . "</a> </b>
								<br>
								<b> $row[titulo]</b>
                            </p>
                        </div>
                    </div>
                    <p class='m-1'> $row[post]</p>
                    <div class='mx-auto m-1//' style='width: 80%;'>";
                        if ($row['image'] != null){
                        echo "<img src='img/$row[image]' class='img-fluid' title='<$row[image]>' />";}
                        echo "</div></div>";
            //comentários
            $swor = $pdo->prepare("SELECT * FROM comentarios WHERE id_post = '{$row['idpost']}'");
            $swor->execute();
            foreach ($swor as $swo) :
            echo "<br>
            <div class='d-flex flex-row bd-highlight mb-0'>
                <div class='p-2 bd-highlight'>
                    <img class='float-left' src='img/" . $swo['profilepic'] . "' width='50' height='50' title='foto'>
                </div>
                <div class='p-2 bd-highlight'>
                    <p class='mb-0' style='font-size: 17px';>";
					$idcomenter = $swo['com_user'];
					echo "
					    <a href='pgamigo.php?id=$idcomenter'> $swo[com_nome] </a>				
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
        endforeach;
      $pagina_anterior = $pagina - 1;
      $pagina_posterior = $pagina + 1;
      ?>

      <div class="card-fundo">
      <nav>
        <ul class="pagination pagination-lg justify-content-center pt-2">
          <?php
            if($pagina_anterior != 0){
                $btn1 = '<a class="page-link" href="posts.php?pagina='.$pagina_anterior.'" aria-label="Previous">&laquo;</a>';
            }else{
              $btn1 = '<span class="page-link">&laquo;</span>';
            }
          ?>
          <li class="page-item">
            <?php echo $btn1?>
          </li>

          <?php
            for($i = 1; $i < $num_pagina + 1; $i++){
              $btn2 = '<a class="page-link" href="posts.php?pagina='.$i.'">'.$i.'</a>';
              echo '<li class="page-item">'.$btn2.'</li>';
            }
          ?>

          <?php
            if($pagina_posterior <= $num_pagina){
              $btn3 = '<a class="page-link" href="posts.php?pagina='.$pagina_posterior.'" aria-label="Previous">&raquo;</a>';
            }else{
              $btn3 = '<span class="page-link">&raquo;</span>';
            }
          ?>
          <li class="page-item">
            <?php echo $btn3?>
          </li>
        </ul>
      </nav>
      </div>
  </div>
  </div>
  <!--Menu Direita-->
  <div class="col">
    <?php include('menu_direita.php');?>
  </div>
</div>