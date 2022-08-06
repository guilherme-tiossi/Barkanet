<?php
require 'conexao.php';
session_start();

$email = $_SESSION['email'];
$data = date_create_from_format("d/m/Y", $_POST['data'])->format("Y-m-d");
$stmt1 = $pdo->prepare("SELECT * FROM usuarios WHERE email = '$email'");
$stmt1 ->execute();

foreach($stmt1 as $row) {
    $id = $row['id'];
}
    $stmt = $pdo->prepare("UPDATE usuarios set nome='" . $_POST['nome'] . "' WHERE id='$id'");
    $stmt ->execute();
    $stmt = $pdo->prepare("UPDATE usuarios set bio='" . $_POST['bio'] . "' WHERE id='$id'");
    $stmt ->execute();
    $stmt = $pdo->prepare("UPDATE usuarios set data_nasc='$data' WHERE id='$id'");
    $stmt ->execute();
    $stmt = $pdo->prepare("UPDATE tbposts set nome='" . $_POST['nome'] . "' WHERE usuario='$id'");
    $stmt ->execute();
    $stmt = $pdo->prepare("UPDATE comentarios set com_nome='" . $_POST['nome'] . "' WHERE com_user='$id'");
    $stmt ->execute();

    $fileName = $_FILES["pfp"]["name"];
    $fileSize = $_FILES["pfp"]["size"];
    $tmpName = $_FILES["pfp"]["tmp_name"];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));
    if ( !in_array($imageExtension, $validImageExtension) ){
      echo
      "
      <script>
        alert('Invalid Image Extension');
        document.location.href = 'perfil.php';
      </script>
      ";
    }
    else if($fileSize > 10000000){
      echo
      "
      <script>
        alert('Image Size Is Too Large');
        document.location.href = 'perfil.php';
      </script>
      ";
    }
    else{
      $newImageName = uniqid();
      $newImageName .= '.' . $imageExtension;

      move_uploaded_file($tmpName, 'img/' . $newImageName);
      $stmt = $pdo->prepare("UPDATE usuarios SET profilepic = '$newImageName' WHERE id = '$id'");
      $stmt->execute();
      $stmt = $pdo->prepare("UPDATE tbposts SET profilepic = '$newImageName' WHERE usuario = '$id'");
      $stmt->execute();
      $stmt = $pdo->prepare("UPDATE comentarios SET profilepic = '$newImageName' WHERE com_user = '$id'");
      $stmt->execute();
      header("Location: perfil.php");
    }

    header("Location: perfil.php");
?>