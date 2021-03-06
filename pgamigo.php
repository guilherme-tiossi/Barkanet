<?php
include("conexao.php");
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
$id = $_GET['id'];  
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
   '<div class="card-fundo mx-auto pt-1" style="width: 50%;">
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

   $stmt=$pdo->prepare("SELECT * FROM tbposts WHERE (usuario = '$id') ORDER BY idpost DESC");
        $stmt ->execute();
        echo "<div class='card-fundo mx-auto' style='width: 50%;'>
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
                                <p class='mb-0' style='font-size: 18px';>
                                    <b><u> $row[nome]</u></b>
                                    <br>
                                    <b> $row[titulo]</b>
                                </p>
                            </div>
                        </div>
                        <p class='m-1'> $row[post]</p>
                        <div class='mx-auto m-1//' style='width: 80%;'>";
                            if ($row['image'] != null){
                            echo "<img src='img/'$row[image]' class='img-fluid' title='<$row[image]';/>";}
                            echo "</div></div></div>";
    
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
            echo "</div>";
            endforeach;
            echo "</div>";
        

   ?>
