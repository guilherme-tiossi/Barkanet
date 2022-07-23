<?php
include("lib/includes.php");
include("conexao.php");
include('menu_esquerda.php');
include('menu_direita.php');

$users=array("$id");
$stmt = $pdo->prepare("SELECT * FROM amigos WHERE (id_de = {$_SESSION['userId']} and status = '1') OR (id_para = {$_SESSION['userId']} AND status = '1')");
$stmt ->execute();
foreach ($stmt as $row):
  if ($row["id_de"] == $id ){
  array_push($users, $row["id_para"]);
  }
  elseif ($row["id_para"] == $id){
    array_push ($users, $row["id_de"]);
  }
endforeach;
$users = implode(",", $users);
$stmt = $pdo->prepare("SELECT * FROM tbposts WHERE usuario in ($users) AND idgrupo = '0' ORDER BY idpost DESC");
$stmt->execute();

foreach ($stmt as $row) : ?>
  <div>
      <img src="img/<?php echo $row["profilepic"]; ?>" width = 50 title="<?php echo $pfp; ?>">
    <?php
      echo $row["nome"];
      echo "<br>";
        echo $row["titulo"];
      echo "<br>";
      echo $row["post"];
      echo "<br>";
      echo "<br>";
    if ($row["image"] != null){
    ?>
    <img src="img/<?php echo $row["image"]; ?>" width = 200 title="<?php echo $row['image']; ?>">
  </div>
    <?php }
    $swor = $pdo->prepare("SELECT * FROM comentarios WHERE id_post = '{$row['idpost']}' ORDER BY id_com DESC");
    $swor->execute();
    foreach ($swor as $swo) : ?>
    <div>
      <?php
        echo $swo["com_nome"];
        echo "<br>";
        echo $swo["comentario"];
      ?>
    </div>
    <br>
    <?php endforeach; ?>
    </div>
    <br>
    <h5>Publicar seu Comentario</h5>
    <form action="exec_com.php"  method="post">
      <label for="txcom">Comentario:</label>
      <input type="text" name="txcom" id="txcom" maxlength="100">
      <span id="alert-com" class="to-hide" role="alert">Digite um comentario...</span>
      <br>
      <input type="hidden" name="post_id" value="<?php echo $row["idpost"]; ?>">
      <input type="submit" name="comentar" value="Enviar">
    </form>
    <?php endforeach;?>
