<?php
require 'conexao.php';
session_start();

$email = $_SESSION['email'];
$stmt1 = $pdo->prepare("SELECT * FROM usuarios WHERE email = '$email'");
$stmt1 ->execute();

foreach($stmt1 as $row) {
    $email = $row['email'];
    $id = $row['id'];
    $nome = $row['nome'];
    $pfp = $row['profilepic'];
}
if(isset($_POST["submit"])){
  $titulo = $_POST["txTitulo"];
  $post = $_POST["txPost"];
  $idgrupo = $_POST['idgrupo'];

  if($_FILES["file"]["error"] == 4){
    $stmt = $pdo->prepare("INSERT INTO tbposts(usuario, nome, titulo, post, profilepic, idgrupo) VALUES ('$id', '$nome', '$titulo', '$post', '$pfp', '$idgrupo')");
    $stmt->execute();
    // echo
    // "
    // <script>
    //   document.location.href = 'posts.php';
    // </script>
    // ";
  }
  else{
    $fileName = $_FILES["file"]["name"];
    $fileSize = $_FILES["file"]["size"];
    $tmpName = $_FILES["file"]["tmp_name"];

    $validImageExtension = ['jpg', 'jpeg', 'png', 'gif', 'mp4'];
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));
    if (!in_array($imageExtension, $validImageExtension) ){
      echo
      "
      <script>
        alert('Invalid File Extension');
        document.location.href = 'posts.php';
      </script>
      ";
    }
    else if($fileSize > 10000000){
      echo
      "
      <script>
        alert('File Size Is Too Large');
        document.location.href = 'posts.php';
      </script>
      ";
    }
    else{
      $newImageName = uniqid();
      $newImageName .= '.' . $imageExtension;
      if($imageExtension == 'jpeg' || $imageExtension == 'png' || $imageExtension == 'jpeg'){
        move_uploaded_file($tmpName, 'img/' . $newImageName);
        $stmt = $pdo->prepare("INSERT INTO tbposts(usuario, nome, titulo, post, file, profilepic, idgrupo) VALUES ('$id', '$nome', '$titulo', '$post', '$newImageName', '$pfp', '$idgrupo')");
        $stmt->execute();
      }
      else{
        move_uploaded_file($tmpName, 'img/' . $newImageName);
        $stmt = $pdo->prepare("INSERT INTO tbposts(usuario, nome, titulo, post, file, profilepic, idgrupo) VALUES ('$id', '$nome', '$titulo', '$post', '$newImageName', '$pfp', '$idgrupo')");
        $stmt->execute();
      }

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