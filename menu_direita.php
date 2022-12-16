<?php
include("conexao.php");
$stmt = $pdo->prepare("SELECT * FROM tbgrupos WHERE adm_grupo = {$_SESSION['userId']}");
$stmt ->execute();

foreach ($stmt as $row) :
  $id_grupo = $row['id_grupo'];
  $nome_grupo = $row['nome_grupo'];
endforeach;
?>

<div class="card-fundo-direita p-2">
  <div class="card-time m-2 p-2 mx-auto">
    <h3>TEMPO: <b id="cronometro"></b></h3>
  </div>

  <div>
    <div class="btn-group" role="group">
      <a id="btncriargrupo" class="btn btn-secondary text-uppercase" onclick="grupos()">Todos</a>
      <a id="btncriargrupo" class="btn btn-secondary text-uppercase" onclick="meusgrupos()">Meus Grupos</a>
      <a id="btncriargrupo" class="btn btn-secondary text-uppercase" href="grupos.php">Criar  <i class="fa-solid fa-plus"></i></a>
    </div>

    <br>

    <div id="meusgrupos" class="to-hide">
      <h5 class="m-2">Meus Grupos:</h5>
      <div class='lista-grupos'>
      <?php
      $stmt = $pdo->prepare("SELECT * FROM tbgrupos WHERE adm_grupo = {$_SESSION['userId']} ORDER BY id_grupo DESC");
      $stmt ->execute();

      foreach ($stmt as $row) :
        $nome_grupo = $row['nome_grupo'];
        $id_grupo = $row['id_grupo'];
        $desc_grupo = $row['descricao_grupo'];
        $tipo_grupo = $row['tipo_grupo'];
        echo "
        <div class='bordagrupos'>
          <a href='pggrupo.php?id_grupo=$id_grupo&pagina_grupo=1'>
                <div class='d-flex flex-row mb-0'>
                  <div class='p-2'>
                    <img src='img/$row[foto_grupo]' title='$row[foto_grupo]' class='imggrupo'> 
                  </div>
                  <div class='p-2'>
                    <h5>".$nome_grupo."</h5>
                    <div class='card-body'>
                      <p>".mb_strimwidth($desc_grupo, 0, 50, "...")."</p>
                    </div>
                    <p><i class='fa-solid fa-tag'></i> ".$tipo_grupo."</p>
                  </div>
              </div>
          </a>
        </div> <br>";
      endforeach;
      ?>
      </div>
    </div>

    <div id="grupos">
      <h5 class="m-2">Grupos de que você participa:</h5>
      <div class='lista-grupos'>
      <?php
      $stmt = $pdo->prepare("SELECT *
      FROM tbgrupos
      WHERE EXISTS (SELECT id_grupo FROM membros_grupos WHERE id_grupo = tbgrupos.id_grupo and id_usuario = '{$_SESSION['userId']}' and status = 1) ORDER BY id_grupo DESC");
      $stmt ->execute();

      foreach ($stmt as $row) :
        $nome_grupo = $row['nome_grupo'];
        $id_grupo = $row['id_grupo'];
        $desc_grupo = $row['descricao_grupo'];
        $tipo_grupo = $row['tipo_grupo'];
        echo "
        <div class='bordagrupos'>
          <a href='pggrupo.php?id_grupo=$id_grupo'>
                <div class='d-flex flex-row mb-0'>
                  <div class='p-2'>
                    <img src='img/$row[foto_grupo]' title='$row[foto_grupo]' class='imggrupo'> 
                  </div>
                  <div class='p-2'>
                    <h5>".$nome_grupo."</h5>
                    <div class='card-body'>
                      <p>".mb_strimwidth($desc_grupo, 0, 50, "...")."</p>
                    </div>
                    <p><i class='fa-solid fa-tag'></i> ".$tipo_grupo."</p>
                  </div>
              </div>
          </a>
        </div> <br>";
      endforeach;
      ?>
      </div>
    </div>
  </div>
</div>

<!-- Modal Alerta-->
<div class="modal" id="modal-cronometro" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <div class="modal-alerta">
          <h1 class="txt-modal">TEMPO: <b id="cronometro-modal" class="cro-modal"></b></h1>
          <p class="m-2 alert">Você esta no Barkanet há 30 minutos</p>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="fecharAlerta()">OK já vou sair</button>
        </div>
      </div>
    </div>
  </div>
</div>