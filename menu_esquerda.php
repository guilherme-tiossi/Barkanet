<?php
require_once ("conexao.php");
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = '$email'");
$stmt ->execute();

 foreach($stmt as $row) {
   $nome = $row['nome'];
   $pfp = $row['profilepic'];
   }
?>

<div class="card-fundo-esquerda">
  <div>
    <!--Barra de pesquisa-->
    <div class="input-group m-2 div-pesquisa">
      <input type="text" class="form-control inputpesquisa" aria-label="Pesquisa" aria-describedby="btnpesquisa">
      <a class="btn botaopesquisa" type="button" id="btnpesquisa" href="procurar.php"><i class="fa-solid fa-magnifying-glass fa-lg"></i></a>
    </div>
    <!--Botão editar-->
    <div class="bordaperfil m-2">
      <div class="d-flex flex-row mb-0">
        <div class='m-1'>
          <img src='img/<?php echo $pfp; ?>' width='60px' title='<?php echo $pfp; ?>'>
        </div>
        <div class='m-1'>
        <h4 class="PORRA"> <a href="perfil.php" class="link-perfil"> <?php echo $nome; ?> </a> </h4>
            <a href="perfil.php?class=to-hide" class="editarperfil">Editar perfil</a>
        </div>
      </div>
    </div>
  </div>

  <div>
      <!--Formulário de posts-->
      <div>
         <form action="exec_posts.php"  method="post" onsubmit="return verificaPostagem()" autocomplete="off" enctype="multipart/form-data">
            <div>
               <div id="alert-titulo1" class="to-hide">
                    <span>Coloque um titulo</span>
               </div>
               <div id="alert-titulo2" class="to-hide">
                    <span>O titulo deve ter no maximo 50 caracteres</span>
               </div>
               <div id="alert-postagem" class="to-hide">
                    <span>Digite alguma coisa...</span>
               </div>
               
               <div class="form-group row">
                  <!--Input titulo-->
                  <div class="col">
                     <input class="form-control-plaintext border border-secondary posttitulo" type="text" name="txTitulo" id="txTitulo" placeholder="Título">
                  </div>
               </div>
               <div class="form-group row">
                  <!--Input texto-->
                  <div class="col">
                     <textarea class="form-control-plaintext border border-secondary mainpost" type="text" name="txPost" id="txPost" placeholder="Digite alguma coisa..."></textarea>
                  </div>
               </div>
               <div class="form-group row">
                  <!--Input imagem-->
                  <div class="d-flex justify-content-end">
                     <input class="form-control-file imgpost" type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
                  </div>
               </div>
            </div>
            <div class="d-flex justify-content-end">
              <!--Botão de posts-->
              <input type="hidden" name="idgrupo" value="0">
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
         <a class="listapags" href="procurar.php"><i class="fa-solid fa-magnifying-glass"></i>Procurar <?php if($not > 0){ echo $not; }?></a>
         <a class="listapags" href="configuracoes.php"><i class="fa-solid fa-gear"></i>Configurações</a>
         <a class="listapags" href="logout.php" onclick="reset()"><i class="fa-solid fa-right-from-bracket"></i>Sair</a>
      </div>
   </div>
</div>