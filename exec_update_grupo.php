<?php
require 'conexao.php';
session_start();

    $idgrupo = $_POST['id_grupo'];
    $stmt = $pdo->prepare("UPDATE tbgrupos set nome_grupo='" . $_POST['nome_grupo'] . "' where id_grupo = '".$_POST['id_grupo']."'");
    $stmt ->execute();
    $stmt = $pdo->prepare("UPDATE tbgrupos set descricao_grupo='" . $_POST['descricao_grupo'] . "' where id_grupo = '".$_POST['id_grupo']."'");
    $stmt ->execute();
    $stmt = $pdo->prepare("UPDATE tbgrupos set tipo_grupo='" . $_POST['privacidade'] . "' where id_grupo = '".$_POST['id_grupo']."'");
    $stmt ->execute();

    // $fileName = $_FILES["pfp"]["name"];
    // $fileSize = $_FILES["pfp"]["size"];
    // $tmpName = $_FILES["pfp"]["tmp_name"];

    // $validImageExtension = ['jpg', 'jpeg', 'png'];
    // $imageExtension = explode('.', $fileName);
    // $imageExtension = strtolower(end($imageExtension));
    // if ( !in_array($imageExtension, $validImageExtension) ){
    //   echo
    //   "
    //   <script>
    //     alert('Invalid Image Extension');
    //     document.location.href = 'perfil.php';
    //   </script>
    //   ";
    // }
    // else if($fileSize > 10000000){
    //   echo
    //   "
    //   <script>
    //     alert('Image Size Is Too Large');
    //     document.location.href = 'perfil.php';
    //   </script>
    //   ";
    // }
    // else{
    //   $newImageName = uniqid();
    //   $newImageName .= '.' . $imageExtension;

    //   move_uploaded_file($tmpName, 'img/' . $newImageName);
    //   $stmt = $pdo->prepare("UPDATE usuarios SET profilepic = '$newImageName' WHERE id = '$id'");
    //   $stmt->execute();
    //   $stmt = $pdo->prepare("UPDATE tbposts SET profilepic = '$newImageName' WHERE usuario = '$id'");
    //   $stmt->execute();
    //   $stmt = $pdo->prepare("UPDATE comentarios SET profilepic = '$newImageName' WHERE com_user = '$id'");
    //   $stmt->execute();
    //   header("Location: perfil.php");
    // }

    echo " <script> document.location.href = 'pggrupo.php?id_grupo=$idgrupo' </script>"
?>