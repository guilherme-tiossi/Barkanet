<?php
require 'conexao.php';
session_start();

$email = $_SESSION['email'];
$stmt1 = $pdo->prepare("select * from usuarios where email = '$email'");
$stmt1 ->execute();

foreach($stmt1 as $row) {
    $email = $row['email'];
    $id = $row['id'];
    $nome = $row['nome'];
}
if(isset($_POST["submit"])){
  $titulo = $_POST["txTitulo"];
  $post = $_POST["txPost"];
  $idgrupo = $_POST['idgrupo'];

  if($_FILES["image"]["error"] == 4){
    $stmt = $pdo->prepare("insert into tbposts(usuario, nome, titulo, post, idgrupo) values ('$id', '$nome', '$titulo', '$post', '$idgrupo')");
    $stmt->execute();
    // echo
    // "
    // <script>
    //   document.location.href = 'posts.php';
    // </script>
    // ";
  }
  else{
    $fileName = $_FILES["image"]["name"];
    $fileSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));
    if ( !in_array($imageExtension, $validImageExtension) ){
      echo
      "
      <script>
        alert('Invalid Image Extension');
        document.location.href = 'posts.php';
      </script>
      ";
    }
    else if($fileSize > 10000000){
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
      $stmt = $pdo->prepare("insert into tbposts(usuario, nome, titulo, post, image, idgrupo) values ('$id', '$nome', '$titulo', '$post', '$newImageName', '$idgrupo')");
      $stmt->execute();
    }
  }
if ($idgrupo == 0){
  echo
  "
  <script>
    document.location.href = 'posts.php';
  </script>
  ";
}
else{
  echo " <script> document.location.href = 'pggrupo.php?id_grupo=$idgrupo' </script>";
}
}

?>