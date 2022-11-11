<?php
require 'conexao.php';
session_start();

$email = $_SESSION['email'];
$data = date_create_from_format("d/m/Y", $_POST['data'])->format("Y-m-d");
$stmt1 = $pdo->prepare("SELECT * FROM usuarios WHERE email = '$email'");
$stmt1 ->execute();

$nome = $_POST['nome'];
$nome = str_replace('<', '&lt;', $nome);
$nome = str_replace('>', '&gt;', $nome);

$bio = $_POST['bio'];
$bio = str_replace('<', '&lt;', $bio);
$bio = str_replace('>', '&gt;', $bio);

$bio1 = str_replace(array(' ', "\t", "\n", "/(\\r)?\\n/i"), '', $bio);

if(strlen($bio1) == 0){
  $bio = "";
}

foreach($stmt1 as $row) {
    $id = $row['id'];
}
    $stmt = $pdo->prepare("UPDATE usuarios set nome='" . $nome . "' WHERE id='$id'");
    $stmt ->execute();
    $stmt = $pdo->prepare("UPDATE usuarios set bio='" . $bio . "' WHERE id='$id'");
    $stmt ->execute();
    $stmt = $pdo->prepare("UPDATE usuarios set data_nasc='$data' WHERE id='$id'");
    $stmt ->execute();
    $stmt = $pdo->prepare("UPDATE tbposts set nome='" . $nome . "' WHERE usuario='$id'");
    $stmt ->execute();
    $stmt = $pdo->prepare("UPDATE comentarios set com_nome='" . $nome . "' WHERE com_user='$id'");
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