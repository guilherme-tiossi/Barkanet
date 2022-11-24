<?php
require 'conexao.php';
session_start();

    $idgrupo = $_POST['id_grupo'];
    $stmt = $pdo->prepare("UPDATE tbgrupos set nome_grupo='" . $_POST['nome_grupo'] . "' where id_grupo = '".$_POST['id_grupo']."'");
    $stmt ->execute();
    $stmt = $pdo->prepare("UPDATE tbgrupos set descricao_grupo='" . $_POST['descricao_grupo'] . "' where id_grupo = '".$_POST['id_grupo']."'");
    $stmt ->execute();
    $stmt = $pdo->prepare("UPDATE tbgrupos set tipo_grupo='" . $_POST['tipo'] . "' where id_grupo = '".$_POST['id_grupo']."'");
    $stmt ->execute();

    $fileName = $_FILES["pfpgrupo"]["name"];
    $fileSize = $_FILES["pfpgrupo"]["size"];
    $tmpName = $_FILES["pfpgrupo"]["tmp_name"];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));
    if (!in_array($imageExtension, $validImageExtension) ){
      echo " <script> document.location.href = 'pggrupo.php?id_grupo=$idgrupo' </script>";
    }
    else if($fileSize > 10000000){
      echo
      "
      <script>
        alert('Image Size Is Too Large');
        document.location.href = 'pggrupo.php?id_grupo=$idgrupo';
      </script>
      ";
    }
    else{
      $newImageName = uniqid();
      $newImageName .= '.' . $imageExtension;

      move_uploaded_file($tmpName, 'img/' . $newImageName);
      $stmt = $pdo->prepare("UPDATE tbgrupos SET foto_grupo= '$newImageName' where id_grupo = '".$_POST['id_grupo']."'");
      $stmt->execute();
      header("Location: pggrupo.php?id_grupo=$idgrupo");
    }

    echo " <script> document.location.href = 'pggrupo.php?id_grupo=$idgrupo' </script>";
?>