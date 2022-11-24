<?php
include "conexao.php";
include "lib/includes.php";
$id = $_GET['id'];
if ($id == $_SESSION['userId']) {
    header("Location: perfil.php");
}
else {$stmt = $pdo->prepare("SELECT count(*) FROM amigos WHERE (id_de = {$_SESSION['userId']} AND id_para = {$id} AND status = '1') OR (id_para = {$_SESSION['userId']} AND id_de = {$id} AND status = '1')");
$stmt->execute();
$row_count = $stmt->fetchColumn();
if ($row_count < 1) {
    header("Location: procurar.php");
}
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
    <?php include 'menu_esquerda.php'; ?>
  </div>

  <!--Centro-->
  <div class="col-6">
    <?php
    carrega_pagina_atalho($con);
    $pagina = (isset($_GET['pag']) && $_GET['pag'] != null && is_numeric($_GET['pag'])) ? $_GET['pag'] : 1;
    $quantidade_pg = 50;

    $stmt = $pdo->prepare("SELECT * FROM tbposts WHERE (usuario = '$id') ORDER BY idpost DESC");
    $stmt->execute();

    $rowNum = $stmt->rowCount();
    $num_pagina = $rowNum / $quantidade_pg;
    $incio = $quantidade_pg * $pagina - $quantidade_pg;

    if(isset($_GET['pag'])){
        if($_GET['pag'] > ($num_pagina + 1)){
        echo "<script>document.location.href = 'pgamigo.php?id=".$id."&pag=1';</script>";
        }

        if($_GET['pag'] == 0){
        echo "<script>document.location.href = 'pgamigo.php?id=".$id."&pag=1';</script>";
        }

        if (!preg_match('/^[1-9][0-9]*$/', $_GET['pag'])) {
        echo "<script>document.location.href = 'pgamigo.php?id=".$id."&pag=1';</script>";
        }
    }
    else{
        echo "<script>document.location.href = 'pgamigo.php?id=".$id."&pag=1';</script>";
    }
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = '$id'");
    $stmt->execute();
    foreach ($stmt as $row) {
        $nome = $row['nome'];
        $nasc = $row['data_nasc'];
        $nasc = date_create_from_format("Y-m-d", $nasc)->format("d/m/Y");
        $email = $row['email'];
        $cod = $row['codigo'];
        $bio = $row['bio'];
        $id = $row['id'];
        $pfp = $row['profilepic'];
    }
    $stmt3 = $pdo->prepare("select * from amigos where (id_de = '$id' and id_para = '$_SESSION[userId]') or (id_para = '$id' and id_de = '$_SESSION[userId]')");
    $stmt3 ->execute();
    foreach ($stmt3 as $row3):
		$idamigo = $row3['id'];
    endforeach;
    echo '
    <div class="card-fundo mx-auto pt-1">
       <div class="mx-auto pt-3 pb-3" style="width: 90%;">
           <div class="card card-perfil">
               <div class="card-body">
                   <div class="d-flex flex-row bd-highlight mb-0">
                       <div class="p-2 bd-highlight">
                           <img class="float-left" src="img/'.$pfp .'" width="150" height="150" title="'.$pfp.'">
                           <p class="mb-0" style="font-size: 18px";>
                               <b>Nome:</b>
                               <br>'.$nome .'
                           </p>
                       </div>
                       <div class="p-2 bd-highlight">
                           <h5 class="m-0">
                               <b>Informações da conta:</b>
                           </h5>
                           <p class="mb-0" style="font-size: 18px";>
                               <b>Código:</b>
                               '.$cod.'
                           </p>
                           <p class="mb-0" style="font-size: 18px";>
                               <b>Data de nascimento:</b>
                               <br>'.$nasc.'
                           </p>
                           <div style="width: 18rem;">
                           <p class="mb-0" style="font-size: 18px";>
                               <b>Biografia:</b>
                               <br>'.$bio.'
                           </p>
                           </div>
                           <div style="width: 18rem;">
                           <p class="mb-0" style="font-size: 18px";>
                             <div class="mt-3">
                               <a href="?pagina=desfazer-amizade&id='.$idamigo.'" class="btn-vermelho-desfazer">Desfazer amizade</a>
                             </div>
                           </p>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>';

    echo '</div>';
        $stmt = $pdo->prepare("SELECT * FROM tbposts WHERE (usuario = '$id') ORDER BY idpost DESC LIMIT $incio, $quantidade_pg");
        $stmt->execute();
        echo "
        <div class='card-fundo-ext mx-auto'>";
        if($rowNum <= 0){
            echo "
            <h2 class='p-3'>Posts de ".$row['nome']."</h2>
            <div class='conteudo'>
              <p class='msg-timeline text-center'>Ainda não tem nenhum post aqui...</p>
            </div>";
        }
        else{
            echo "<h2 class='p-3'>Posts de ".$row['nome']."</h2>";
            
            foreach ($stmt as $row):
                $swor = $pdo->prepare("SELECT * FROM comentarios WHERE id_post = '{$row['idpost']}'");
                $swor->execute();
                $linhas = $swor->rowCount();

                echo "
                <div class='conteudo'>
                <div class='mx-auto' style='width: 80%;'>";

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
                                    <img class='float-left' src='img/$pfp' width='64' height='64' title='foto'>
                                </div>
                                <div class='p-2 bd-highlight'>
                                    <p class='mb-0' style='font-size: 18px';>";
                                    if ($row['idgrupo'] > 0) {
                                        $stmt = $pdo->prepare("SELECT tbgrupos.id_grupo, tbgrupos.nome_grupo from tbposts JOIN tbgrupos ON tbposts.idgrupo = tbgrupos.id_grupo WHERE usuario = '$id' AND idpost = $row[idpost]");
                                        $stmt->execute();
                                        foreach ($stmt as $roww):
                                            $id_grupo = $roww['id_grupo'];
                                            echo "
                                            <b> <a href='pggrupo.php?id_grupo=$id_grupo' class='link'>".$roww['nome_grupo']."</a></b><br>";
                                        endforeach;
                                    }
                                    $idposter = $row['usuario'];
                                    echo "
                                    <b><a href='pgamigo.php?id=$idposter' class='link'>".$row['nome']."</a></b>
                                    <br>
                                    <p class='titulo-post'>$row[titulo]</p>
                                    </p>
                                </div>
                            </div>

                            <div class='m-3 mt-0'
                                <p> $row[post]</p>
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
                                            <div class='mb-0' style='font-size: 17px;'>
                                                <b><a href='pgamigo.php?id=$idcomenter' class='link'> $com_nome </a></b>
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
                            <input type="hidden" name="grupo_id" value=0> 
                            <input type="hidden" name="id_amigo" value='; echo $id; echo '>
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

            echo '
            <div class="mt-5 paginacao">
                <nav>
                    <ul class="pagination justify-content-center pt-2">';
                        if($pagina_anterior != 0){
                            $btn1 = '
                            <a class="page-link text-kiwi" href="pgamigo.php?id='.$id.'&pag='.$pagina_anterior.'" aria-label="Previous">
                            <i class="fa-solid fa-reply"></i>
                            </a>';
                        }else{
                        $btn1 = '<span class="page-link text-black-50"><i class="fa-solid fa-reply"></i></span>';
                        }
                    
                    echo '<li class="page-item">';
                    echo $btn1;
                    echo '</li>';

                        $num_atual = (isset($_GET['pag']))? $_GET['pag'] : 1;
                        $num_anterior = $num_atual - 1;
                        $num_posterior = $num_atual + 1;

                        if($num_anterior != 0){
                            $btn2 = '<a class="page-link text-kiwi" href="pgamigo.php?id='.$id.'&pag='.$num_anterior.'">'.$num_anterior.'</a>';
                            echo '<li class="page-item">'.$btn2.'</li>';
                        }

                        $btn2 = '<a class="page-link text-kiwi" href="pgamigo.php?id='.$id.'&pag='.$num_atual.'">'.$num_atual.'</a>';
                        echo '<li class="page-item">'.$btn2.'</li>';

                        if($num_posterior < ($num_pagina + 1)){
                            $btn2 = '<a class="page-link text-kiwi" href="pgamigo.php?id='.$id.'&pag='.$num_posterior.'">'.$num_posterior.'</a>';
                            echo '<li class="page-item">'.$btn2.'</li>';
                        }

                        if($num_posterior < ($num_pagina + 1)){
                        $btn3 = '<a class="page-link text-kiwi" href="pgamigo.php?id='.$id.'&pag='.$pagina_posterior.'" aria-label="Previous"><i class="fa-solid fa-share"></i></a>';
                        }else{
                        $btn3 = '<span class="page-link text-black-50"><i class="fa-solid fa-share"></i></span>';
                        }

                    echo '<li class="page-item">';
                    echo $btn3;
                    echo '</li>
                    </ul>
                </nav>
            </div>
        </div>';
    ?>
  </div>

  <!--Menu Direita-->
  <div class="col">
    <?php include 'menu_direita.php'; ?>
  </div>
</div>