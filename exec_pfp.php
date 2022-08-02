<?php
require 'conexao.php';
session_start();

$email = $_SESSION['email'];
$stmt1 = $pdo->prepare("SELECT * FROM usuarios WHERE email = '$email'");
$stmt1 ->execute();

foreach($stmt1 as $row) {
    $id = $row['id'];
}

if(isset($_POST["pfp"])){
    $fileName = $_FILES["pfp"]["name"];
    $fileSize = $_FILES["pfp"]["size"];
    $tmpName = $_FILES["pfp"]["tmp_name"];

    $validImageExtension = ['png', 'jpeg', 'jpg'];
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));
    if ( !in_array($imageExtension, $validImageExtension) ){
      echo
      "
      <script>
        alert('Invalid Image Extension');
      </script>
      " . $fileName . " " . $fileSize . " " . $tmpName . " " . $validImageExtension . " " . $imageExtension . " ";
    }
    else if($fileSize > 1000000){
      echo
      "
      <script>
        alert('Image Size Is Too Large');
        document.location.href = 'posts.php';
      </script>
      ";
    }
    else{
      $newImageName = uniqid();
      $newImageName .= '.' . $imageExtension;

      move_uploaded_file($tmpName, 'img/' . $newImageName);
      $stmt = $pdo->prepare("UPDATE usuarios SET profilepic = '$newImageName' WHERE id = '$id'");
      $stmt->execute();
      $stmt = $pdo->prepare("UPDATE usuarios SET profilepic = '$newImageName' WHERE id = '$id'");
      $stmt->execute();
      echo
      "
      <script>
        document.location.href = 'perfil.php';
      </script>
      ";
    }
  }

?>