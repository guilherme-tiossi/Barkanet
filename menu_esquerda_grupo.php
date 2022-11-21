<?php
require_once ("conexao.php");
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = '$email'");
$stmt ->execute();
$id_grupo = $_GET['id_grupo'];

 foreach($stmt as $row) {
   $nome = $row['nome'];
   $pfp = $row['profilepic'];
   }
?>

<div class="card-fundo-esquerda">
  <div>
    <!--Barra de pesquisa-->
    <form action="" method="post">
    <div class="input-group m-2 div-pesquisa">
      <input type="text" class="form-control inputpesquisa" aria-label="Pesquisa" aria-describedby="btnpesquisa" id="live_search" autocomplete="off" placeholder="Search...">
      <a class ="btn botaopesquisa" type="button" id="btnpesquisa"> <i class="fa-solid fa-magnifying-glass fa-lg"></i></a>   
   </form>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#live_search").keyup(function(){
            var input = $(this).val();

            if(input !=""){
                $.ajax({

                url:"livesearch.php",
                method:"POST",
                data:{input:input},

                success:function(data){
                    $("#searchresult").html(data);
                    $("#searchresult").css("display","block");
                    jQuery('#searchresult').addClass('pesquisa-box');
                }
                });
            }else{
                $("#searchresult").css("display","none");
            }
        });

    });
</script>

<div class="to-hide" id="searchresult"></div>
<?php carrega_pagina_atalho($con); ?>

    <!--Botão editar-->
    <div class="bordaperfil m-2">
      <div class="d-flex flex-row mb-0">
        <div class='m-1'>
          <img src='img/<?php echo $pfp; ?>' width='60px' height='60px' title='<?php echo $pfp; ?>'>
        </div>
        <div class='m-1'>
            <h4>
               <a href="perfil.php" class="link-perfil"> <?php echo $nome; ?> </a>
            </h4>
            <a href="perfil.php?editar&pag=1" class="editarperfil">Editar perfil</a>
        </div>
      </div>
    </div>
  </div>

  <div>
      <!--Formulário de posts-->
      <div>
         <form action="exec_posts.php"  method="post" onsubmit="return verificaPostagem()" autocomplete="off" enctype="multipart/form-data">
            <div>
            <div>
                <span id="alert-titulo1" class="to-hide">Coloque um titulo</span>
                <span id="alert-titulo2" class="to-hide">Titulo muito grande</span>
                <span id="alert-post" class="to-hide">Digite algo...</span>
                <span id="alert-post2" class="to-hide">Post muito longo</span>
              </div>
               
               <div class="form-group row">
                  <!--Input titulo-->
                  <div class="col">
                     <input class="form-control-plaintext border border-secondary posttitulo" type="text" name="txTitulo" id="txTitulo" placeholder="Título" maxlength='50'>
                  </div>
               </div>
               <div class="form-group row">
                  <!--Input texto-->
                  <div class="col">
                     <textarea class="form-control-plaintext border border-secondary mainpost" type="text" name="txPost" id="txPost" placeholder="Digite alguma coisa..." maxlength='500'></textarea>
                  </div>
               </div>
               <div class="form-group row">
                  <!--Input imagem-->
                  <div class="d-flex justify-content-end">
                  <input class="form-control-file imgpost" type="file" name="file" id="file" accept=".jpg, .jpeg, .png, .gif, .mp4">
                  </div>
               </div>
            </div>
            <div class="d-flex justify-content-end">
              <!--Botão de posts-->
              <input type="hidden" name="idgrupo" value="<?php echo $id_grupo;?>">
              <button class="text-uppercase btnposts" type="submit" name="submit">Postar</button>
            </div>
         </form>
      </div>
   </div>


   <div>
      <!--Botões menu-->
      <div>
        <?php
          $not = return_total_solicitation($con) + return_total_solicitation_grupo($con);
         ?>
         <a class="listapags" href="perfil.php"><i class="fa-solid fa-user"></i>Perfil</a>
         <a class="listapags" href="posts.php"><i class="fa-solid fa-image"></i>Posts</a>
         <a class="listapags" href="procurar.php"><i class="fa-solid fa-envelope"></i></i>Notificações <?php if($not > 0){ echo $not; }?></a>
         <a class="listapags" href="configuracoes.php"><i class="fa-solid fa-gear"></i>Configurações</a>
         <a class="listapags" href="logout.php" onclick="reset()"><i class="fa-solid fa-right-from-bracket"></i>Sair</a>
      </div>
   </div>
</div>