<?php
include("lib/includes.php");
include("conexao.php");
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
    <?php include('menu_esquerda_grupo.php');?>
  </div>

  <!--Centro-->
  <div class="col-6">
  <?php 
  $id_usuario = $_SESSION['userId'];
  ler_dados_grupo($id_grupo, $id_usuario);
  ?>
    <div class="card-fundo">
    <?php
    $id_grupo = $_GET['id_grupo'];
    $grp = $pdo->prepare("SELECT nome_grupo FROM tbgrupos WHERE id_grupo = '$id_grupo'");
    $grp->execute();
    foreach ($grp as $row):
    $nome_grupo = $row['nome_grupo'];
    endforeach;
    $stmt = $pdo->prepare("SELECT * FROM tbposts WHERE idgrupo = '$id_grupo' ORDER BY idpost DESC");
    $stmt->execute();
    echo "<div class='card-fundo mx-auto'>
    <h2 class='p-3'>Posts de " . $nome_grupo . "</h2>";
    foreach ($stmt as $row) :
        echo "<div class='mx-auto' style='width: 80%;'>
                <!--post-->
                <div class='mt-3 card-posts'>
                <div class='card-body'>
                    <div class='d-flex flex-row bd-highlight mb-0'>
                        <div class='p-2 bd-highlight'>
                            <img class='float-left' src='img/" . $row['profilepic'] . "' width='64' height='64' title='foto'>
                        </div>
                        <div class='p-2 bd-highlight'>
                            <p class='mb-0' style='font-size: 18px';>";
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
                        echo "<img src='img/$row[image]' class='img-fluid' title='<$row[image]';/>";}
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
                    echo "<a href='pgamigo.php?id=$idcomenter'> $swo[com_nome] </a>
                    <br>
                        $swo[comentario]
                    </p> </div> </div>";
            endforeach;
            $buceta = "40";
        echo '     <br>
        <h5>Publicar seu Comentario</h5>
        <form action="exec_com.php"  method="post">
          <label for="txcom">Comentario:</label>
          <input type="text" name="txcom" id="txcom" maxlength="100">
          <span id="alert-com" class="to-hide" role="alert">Digite um comentario...</span>
          <br>
          <input type="hidden" name="post_id" value=';  echo $row["idpost"];  echo '>
          <input type="hidden" name="id_amigo" value=0> 
          <input type="hidden" name="grupo_id" value=';  echo $_GET['id_grupo'];  echo '> 
          <input type="submit" name="comentar" value="Enviar">
        </form> </div> </div>';
        endforeach;
        echo "</div>";

       carrega_pagina_atalho($con);
      
    //  <!--LISTA DE AMIGOS PARA ADD-->
      $stmt2 = $pdo->prepare("SELECT * from tbgrupos where id_grupo = {$_GET['id_grupo']}");
      $stmt2 ->execute();
      foreach ($stmt2 as $row) :
        $adm_grupo = $row['adm_grupo'];
      endforeach;

      if($adm_grupo == $_SESSION['userId']){
        echo "<h3>Convidar Amigos</h3>";
        $stmt2 = $pdo->prepare("SELECT * from amigos where (id_de = {$_SESSION['userId']} and status = '1') or (id_para = {$_SESSION['userId']} and status = '1')");
        $stmt2 ->execute();

        foreach ($stmt2 as $row) :
          $id_para = $row['id_para'];
          $id_de = $row['id_de'];
                    
          if($id_para == $_SESSION['userId']){
            $stmt3 = $pdo->prepare("SELECT id, nome from usuarios where id = '$id_de'");
            $stmt3 ->execute();
            foreach ($stmt3 as $row):
              echo "<a href='?pagina=grupo&id_grupo={$_GET['id_grupo']}&id={$row['id']}'>{$row['nome']}</a>";
              echo "<br>";
            endforeach;
          }

          if($id_de == $_SESSION['userId']){
            $stmt3 = $pdo->prepare("SELECT id, nome from usuarios where id = '$id_para'");
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
        echo "<a href='?pagina=recusar-solicitacao-grupo&id_grupo={$id_grupo}&id={$id}'>Sair do Grupo</a>";
      }
      ?>
    </div>
  </div>

  <!--Menu Direita-->
  <div class="col">
    <?php include('menu_direita.php');?>
  </div>
</div>












<?php
/* MENU ESQUERDA
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = '$email'");
$stmt ->execute();
$id_grupo = $_GET['id_grupo'];
 foreach($stmt as $row) {
   $pfp = $row['profilepic'];
   }
?>
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
    
  </div>
</div>
<?php
// FIM DO MENU ESQUERDA*/
