<?php
include("conexao.php");
include("lib/includes.php");    
$id = $_GET['id'];  
if ($id == $_SESSION['userId']){
    header("Location: perfil.php");
}
$stmt = $pdo->prepare("SELECT count(*) FROM amigos WHERE (id_de = {$_SESSION['userId']} AND id_para = {$id} AND status = '1') OR (id_para = {$_SESSION['userId']} AND id_de = {$id} AND status = '1')");
$stmt->execute();
$row_count = $stmt->fetchColumn();
if ($row_count < 1){
    header("Location: procurar.php");
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
    <script src="js/perfil.js"></script>
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>

<div class="d-flex">
  <!--Menu Esquerada-->
  <div class="col">
    <?php include('menu_esquerda.php');?>
  </div>

  <!--Centro-->
  <div class="col-6">
    <?php

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = '$id'");
    $stmt ->execute();
       foreach($stmt as $row) {
           $nome = $row['nome'];
           $nasc = $row['data_nasc'];
           $nasc = date_create_from_format("Y-m-d", $nasc)->format("d/m/Y");
           $email = $row['email'];
           $cod = $row['codigo'];
           $bio = $row['bio'];
           $id = $row['id'];
           $pfp = $row['profilepic'];
           }
       echo 
       '<div class="card-fundo mx-auto pt-1">
       <div class="mx-auto pt-3 pb-3" style="width: 90%;">
           <div class="card card-perfil">
               <div class="card-body">
                   <div class="d-flex flex-row bd-highlight mb-0">
                       <div class="p-2 bd-highlight">
                           <img class="float-left" src="img/'.$pfp.'" width="150" height="150" title="'.$pfp.'">
                           <p class="mb-0" style="font-size: 18px";>
                               <b>Nome:</b>
                               <br>'.$nome.'
                           </p>
                       </div>
                       <div class="p-2 bd-highlight">
                           <h5 class="m-0">
                               <b>Informações da conta:</b>
                           </h5>
                           <p class="mb-0" style="font-size: 18px";>
                               <b>E-mail:</b>
                               <br>'.$email.'
                           </p>
                           <p class="mb-0" style="font-size: 18px";>
                               <b>Biografia:</b>
                               <br>'.$bio.'
                           </p>
                           <p class="mb-0" style="font-size: 18px";>
                               <b>Data de nascimento:</b>
                               <br>'.$nasc.'
                           </p>
                           <p class="mb-0" style="font-size: 18px";>
                               <b>Código:</b>
                               '.$cod.'
                           </p>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       </div>';

        $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
        $quantidade_pg = 50;
        
        $stmt=$pdo->prepare("SELECT * FROM tbposts WHERE (usuario = '$id') ORDER BY idpost DESC");
        $stmt ->execute();
        
        $rowNum = $stmt->rowCount();
        $num_pagina = ($rowNum/$quantidade_pg);
        $incio = ($quantidade_pg*$pagina)-$quantidade_pg;

        $stmt=$pdo->prepare("SELECT * FROM tbposts WHERE (usuario = '$id') ORDER BY idpost DESC LIMIT $incio, $quantidade_pg");
        $stmt ->execute();
            echo "<div class='card-fundo mx-auto'>
            <h2 class='p-3'>Posts de " . $row['nome'] . "</h2>";
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
                                        $stmt = $pdo->prepare("SELECT tbgrupos.id_grupo, tbgrupos.nome_grupo from tbposts JOIN tbgrupos ON tbposts.idgrupo = tbgrupos.id_grupo WHERE usuario = '$id' AND idpost = $row[idpost]");
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
                echo '     <br>
                <h5>Publicar seu Comentario</h5>
                <form action="exec_com.php"  method="post">
                  <label for="txcom">Comentario:</label>
                  <input type="text" name="txcom" id="txcom" maxlength="100">
                  <span id="alert-com" class="to-hide" role="alert">Digite um comentario...</span>
                  <br>
                  <input type="hidden" name="post_id" value=';  echo $row["idpost"];  echo '>
                  <input type="hidden" name="grupo_id" value=0> 
                  <input type="hidden" name="id_amigo" value=';  echo $id;  echo '> 
                  <input type="submit" name="comentar" value="Enviar">
                </form> </div> </div>';
                endforeach;
                echo "</div>";
        $pagina_anterior = $pagina - 1;
        $pagina_posterior = $pagina + 1;

        echo '<div class="card-fundo">
      <nav>
        <ul class="pagination pagination-lg justify-content-center pt-2">';
            if($pagina_anterior != 0){
                $btn1 = '<a class="page-link" href="pgamigo.php?id='.$id.'?pagina='.$pagina_anterior.'" aria-label="Previous">&laquo;</a>';
            }else{
              $btn1 = '<span class="page-link">&laquo;</span>';
            }
          
          echo '<li class="page-item">'.$btn1.'</li>';

            for($i = 1; $i < $num_pagina + 1; $i++){
              $btn2 = '<a class="page-link" href="pgamigo.php?id='.$id.'?pagina='.$i.'">'.$i.'</a>';
              echo '<li class="page-item">'.$btn2.'</li>';
            }

            if($pagina_posterior <= $num_pagina){
              $btn3 = '<a class="page-link" href="pgamigo.php?id='.$id.'?pagina='.$pagina_posterior.'" aria-label="Previous">&raquo;</a>';
            }else{
              $btn3 = '<span class="page-link">&raquo;</span>';
            }
          echo '<li class="page-item">'.$btn3.'</li>
        </ul>
      </nav>
      </div>';
       ?>
  </div>

  <!--Menu Direita-->
  <div class="col">
    <?php include('menu_direita.php');?>
  </div>
</div>