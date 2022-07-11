
    <?php
    include('lib/includes.php');
    include('conexao.php');
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Grupo</title>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' type='text/css' href='css/style.css'>
        <script src='js/perfil.js'></script>
    </head>
    <body>
        <div>
            <h2>Nome do Grupo</h2>
            <h3>Descrição...</h3>
            <a href='#'>Timeline</a>
            <br>
            <a href='#'>Chat</a>
            <br>
            <a href='#'>Sair do grupo</a>
            <br>
            <a href='posts.php'>Voltar</a>
        </div>
        <?php carrega_pagina_atalho($con);?>
        <div>
        <h3> Amigos </h3>
        <?php 
          $stmt2 = $pdo->prepare("select * from amigos where (id_de = {$_SESSION['userId']} and status = '1') or (id_para = {$_SESSION['userId']} and status = '1')");
        $stmt2 ->execute();

        foreach ($stmt2 as $row) :
          $id_para = $row['id_para'];
          $id_de = $row['id_de'];
          
          if($id_para == $_SESSION['userId']){
            $stmt3 = $pdo->prepare("select id, nome from usuarios where id = '$id_de'");
            $stmt3 ->execute();
            foreach ($stmt3 as $row):
              echo "<a href='?pagina=grupo&id_grupo={$_GET['id_grupo']}&id={$row['id']}'>{$row['nome']}</a>";
              echo "<br>";
            endforeach;
          }

          if($id_de == $_SESSION['userId']){
            $stmt3 = $pdo->prepare("select id, nome from usuarios where id = '$id_para'");
            $stmt3 ->execute();
            foreach ($stmt3 as $row):
              echo "<a href='?pagina=grupo&id_grupo={$_GET['id_grupo']}&id={$row['id']}'>{$row['nome']}</a>";
              echo "<br>";
            endforeach;
          }
        endforeach
        ?>
    </div>
    </body>
    </html>
    