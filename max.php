<?php
    include("lib/includes.php");
    include_once("lib/functions.php");
    include("conexao.php");
    //include('menu_esquerda.php');
    //include('menu_direita.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Perfil</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/fonts/font.css">
    <script src="js/perfil.js"></script>
    <link href="fontawesome/css/all.css" rel="stylesheet">
</head>

<body>
    <div><?php echo ler_dados_usuario($email, $pdo);?></div>

    <div class="card-fundo-posts mx-auto" style="width: 50%;">
        <h2 class="p-3">Meus posts</h2>
        <?php
        $stmt = $pdo->prepare("select * from tbposts where (usuario = '$id')  order by idpost desc");
        $stmt ->execute();
        
        foreach ($stmt as $row) :?>
        <div class="mx-auto" style="width: 80%;">
            <div class="mt-3 card-posts">
                <div class="card-body">
                    <div class="d-flex flex-row bd-highlight mb-0">
                        <div class="p-2 bd-highlight">
                            <img class="float-left" src="img/<?php echo $pfp;?>" width="64" height="64" title="foto">
                        </div>
                        <div class="p-2 bd-highlight">
                            <p class="mb-0" style="font-size: 18px";>
                                <b><u><?php echo $row["nome"];?></u></b>
                                <br>
                                <b><?php echo $row["titulo"];?></b>
                            </p>
                        </div>
                    </div>
                    <p class="m-1"><?php echo $row["post"];?></p>
                    <div class="mx-auto" style="width: 80%;">
                        <?php if ($row["image"] != null){?>
                        <img src="img/<?php echo $row["image"]; ?>" class="img-fluid" title="<?php echo $row['image']; ?>">
                    </div>
                </div>
            </div>
            <?php
            }
            $swor = $pdo->prepare("select * from comentarios where id_post = '{$row['idpost']}'");
            $swor->execute();?>
                <br>
                <button class="btn btn-secondary btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Comentários</button>
                <div class="collapse" id="collapseExample">
                    <br>
                    <div class="card-body">
                    <?php
                    foreach ($swor as $swo) :?>
                        <div class="d-flex flex-row bd-highlight mb-0">
                            <div class="p-2 bd-highlight">
                                <img class="float-left" src="img/<?php echo $pfp;?>" width="50" height="50" title="foto">
                            </div>
                            <div class="p-2 bd-highlight">
                                <p class="mb-0" style="font-size: 17px";>
                                    <b><?php echo $swo["com_nome"];?></b>
                                    <br>
                                    <?php echo $swo["comentario"];?>
                                </p>
                            </div>
                        </div>
                    <?php
                    endforeach;
                    ?> 
                  </div>
                </div>
        </div>
        <?php endforeach;?>
    </div>
    <br>
    <br>
    <div>
        <h3>Amigos</h3>
        <?php 
        $stmt2 = $pdo->prepare("select * from amigos where (id_de = {$_SESSION['userId']} and status = '1') or (id_para = {$_SESSION['userId']} and status = '1')");
        $stmt2 ->execute();

        foreach ($stmt2 as $row) :
            $id_para = $row['id_para'];
            $id_de = $row['id_de'];
                      
            if($id_para == $_SESSION['userId']){
                $stmt3 = $pdo->prepare("select nome from usuarios where id = '$id_de'");
                $stmt3 ->execute();
                foreach ($stmt3 as $row):
                    echo $row["nome"];
                    echo "<br>";
                endforeach;
            }

            if($id_de == $_SESSION['userId']){
                $stmt3 = $pdo->prepare("select nome from usuarios where id = '$id_para'");
                $stmt3 ->execute();
                foreach ($stmt3 as $row):
                    echo $row["nome"];
                    echo "<br>";
                endforeach;
            }
        endforeach;
        ?>  
    </div>
<br>
</div>
</div>
</div>
</body>
</html>


