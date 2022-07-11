<?php session_start();?>

<!DOCTYPE html>
<html lang="utf-8">
   <head>
      <meta charset="utf-8">
      <title>Sign up</title>
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="css/fonts/font.css">
      <!--<script src='https://www.google.com/recaptcha/api.js?hl=pt-BR'></script>-->
      <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
      <script type="text/javascript" src="js/jquery.mask.min.js"></script>
      <script type="text/javascript" src="js/script.js"></script>
      
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
      <script type="text/javascript">
         $(document).ready(function() {
             $("#data").mask("00/00/0000")
         });
      </script>
   </head>
   <body>
      <section>
         <div class="centralizar">
         <div class="box">
            <h1>Sign up</h1>
            <?php
               if(isset($_SESSION['nao_autenticado'])):
               ?>
            <div>
               <p class="alert">Esse email já esta sendo usado</p>
            </div>
            <?php
               endif;
               unset($_SESSION['nao_autenticado']);
               ?>
            <?php
               if(isset($_SESSION['email'])){
               	header('Location: perfil.php');
               }
               ?>
            <form id="formulario" method="POST" action="exec_signup.php" onsubmit="return verificaCadastro()">
               <label for="nome">Nome: </label>
               <br>
               <input type="text" name="nome" id="nome">
               <span id="alert-nome" class="to-hide" role="alert"><br>O nome deve ter no mínimo 3 caracteres</span>
               <br>
               <label for="data">Data de nascimento: </label>
               <br>
               <input type="text" name="data" id="data">
               <span id="alert-data" class="to-hide" role="alert"><br>Preencha o campo data de nascimento</span>
               <span id="alert-idade" class="to-hide" role="alert"><br>Voce não tem idade suficiente para usar essa rede social</span>
               <span id="alert-idade1" class="to-hide" role="alert">Insira uma data de nascimento válida.</span>
               <br>
               <label for="email">Email: </label>
               <br>
               <input type="text" name="email" id="email">
               <span id="alert-email" class="to-hide" role="alert"><br>Preencha o campo email corretamente</span>
               <br>
               <label for="senha">Senha: </label>
               <br>
               <input type="password" name="senha" id="senha">
               <span id="alert-senha" class="to-hide" role="alert"><br>A senha deve ter no mínimo 8 caracteres</span>
               <br>
               <label for="senha">Confirmar senha: </label>
               <br>
               <input type="password" name="senha" id="c_senha">
               <span id="alert-c_senha1" class="to-hide" role="alert"><br>Repita a senha</span>
               <span id="alert-c_senha2" class="to-hide" role="alert"><br>As senhas não são iguais</span>
               <br>
               <input type="checkbox" name="mostrar" onclick="senhaCadastro()">
               <label for="mostrar">Mostrar senha</label>
               <br>
               <input type="checkbox" name="termos" id="check_termos">
               <label for="check_termos">Eu li e concordo com os <a href="" data-toggle="modal" data-target="#ModalLongoExemplo">Termos de uso e Privacidade</a></label>
               <span id="alert-termos" class="to-hide" role="alert"><br>Voce precisa aceitar os Termos</span>
               <br>
               <input type="submit" name="signin" value="Sign in">
               <a href="login.php">Já tenho uma conta</a>
            </form>
         </div>
      </div>
         <div class="modal fade-modal-lg" id="ModalLongoExemplo" tabindex="-1" role="dialog" aria-labelledby="TituloModalLongoExemplo" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h2 class="modal-title" id="TituloModalLongoExemplo"> Termos de Uso e Condições </h2>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <h3> Bem-vindo a Barkanet. </h3>
                     <p> A seguir estão os termos e condições que regulam o uso deste site. </p>
                     <h3>Sobre</h3>
                     <p>1.1A Barkanet é uma rede social privada, que visa oferecer um ambiente amigável, saudável e seguro aos usuários. Nossa plataforma funciona dentro de um sistema de amizades, onde apenas aqueles que você confia possam ver e interagir com suas postagens e atualizações.
                     Barkanet traz para seus usuários um sistema de grupos, que funcionam como outra timeline para assuntos específicos, abrangendo temas desde gostos pessoais, fandoms ou até trabalho. Os grupos existem separadamente do sistema de amizades, ou seja, você não precisa ter algum colega de trabalho adicionado como amigo para estar no grupo da sua empresa dentro do Barkanet, assim adicionando mais um tijolo para nossa parede de privacidade interpessoal. 
                     Seja em um ambiente de amizade, familiar ou de trabalho, o nosso papel é manter você conectado apenas com quem você desejase conectar. 
                     </p>
                     <h3>Acesso ao site </h3>
                     <p>2.1 Ao se cadastrar no site, você imediatamente concorda com os Termos de Uso e Condições presentes neste documento. </p>
                     <p> 2.2 Para a utilização imediata dos recursos presentes no site, você precisa se cadastrar. O fornecimento de informações como um e-mail e uma senha são prezados para a conclusão do registro.
                     <p>2.3 Você deve ter 16 anos ou mais para fazer uso do site. Ao se registrar, você garante ao Barkanet que você tem 16 anos ou mais. </p>
                     <p>2.4  Você é responsável pela segurança e uso dos dados cadastrados no site, como o e-mail e a senha, e deve prezar e garantir a confidencialidade e segurança desses dados. </p>
                     <p>2.5 A Barkanet se reserva o direito de suspender o acesso a conta, caso considere que haja alguma violação de segurança. </p>
                     <h3> Uso do site </h3>
                     <p> 3.1 Um dos principais objetivos do Barkanet é proporcionar uma rede social segura, saudável e intuitiva para os usuários, disponibilizando recursos que possibilitam publicação de textos, imagens e vídeos, edição de perfil, lista de amigos, criação de comunidades e grupos etc. Ao se registrar, você concorda em utilizar esses recursos de forma apropriada e concorda em não usar tais recursos para:</p>
                     <p>3.1.1 Atacar, ameaçar, difamar, fazer comentários que contenham algum tipo de discriminação, seja esta racial, social, religiosa, sexual, por causa de nacionalidade, cor, origem ou de qualquer forma que exclua a pessoa socialmente, cause constrangimento e/ou viole a segurança da mesma;</p>
                     <p>3.1.2 Postar ou comentar qualquer informação ou material que seja: difamatório, profano, obsceno e/ou inapropriado (pornografia, descrições ou imagens violentas e/ou sexuais, informações pessoais de outras pessoas);</p>
                     <p>3.1.3 Postar, compartilhar ou fazer uploads de links que possam prejudicar e/ou espalhar vírus, trojans, arquivos corrompidos ou nocivos que possam causar danos a computadores, celulares ou máquinas de outros usuários;</p>
                     <p>3.1.4 Ter um perfil que contenha no nome ou na foto, algum conteúdo que seja discriminatório e/ou ofensivo e/ou que faça apologia à racismo, xenofobia, homofobia ou quaisquer tipo de discriminação ou crime;</p>
                     <p>3.1.5 Usar o nome/imagem de outra pessoa a fim de se passar por ela ou para qualquer outro propósito;</p>
                     <p>3.1.6 Fazer upload de arquivos que contenham materiais que ferem quaisquer direitos de propriedade intelectual (ou direitos de privacidade ou publicidade) a menos que você detenha posse dos ditos direitos ou tenha recebido todos os avais necessários; </p>
                     <p>3.1.7 Realizar, divulgar e incentivar ataques (raids) a outros grupos a fim de causar transtornos; </p>
                     <p>3.1.8 Se passar por dono, administrador, moderador ou ajudante de uma comunidade, grupo ou do próprio Barkanet a fim de extrair dados pessoais, vantagens etc. </p>
                     <p>3.1.9 Promover, oferecer, sugerir vendas de contas e/ou grupos </p>
                     <p>3.2 Em caso de violação dos Termos de Uso e Condições, o Barkanet se reserva o direito de temporariamente ou permanentemente suspender e/ou excluir contas, publicações, comentários etc a qualquer momento e sem aviso prévio. </p>
                     <p>3.2.1Em caso de violação dos Termos de Uso e Condições, o Barkanet se reserva o direito de temporariamente ou permanentemente cancelar o seu acesso ao site a qualquer momento e sem aviso prévio. </p>
                     <h3> Limitação de responsabilidade </h3>
                     <p> 4.1O Barkanet não é responsável por danos e prejuízos que você possa sofrer como consequência: do conteúdo na rede social, sites e links de terceiros associados a rede social, de produtos ou serviços de terceiros que você possa adquirir na rede social, de lesões pessoais ou danos à propriedade que decorrerem do uso por você do site, do acesso não autorizado às suas informações pessoais armazenadas na sua base de dados, de falhas ou vírus que um terceiro possa causar ao seu computador pessoal como resultado do uso por você do site, de quaisquer interrupções do site ou de qualquer atividade de qualquer pessoa que use o site sem autorização. </p>
                     <p> 4.2 O Barkanet não garante que o site estará disponível, livre de erros ou bugs. </p>
                     <h3> Modificação dos termos de uso e cancelamento do site </h3>
                     <p> 5.1O Barkanet se reserva o direito de alterar os Termos e Condições, a qualquer momento e sob nosso julgamento. O uso por você do site constituirá o seu consentimento à alteração deste termos.­</p>
                     <p>5.2O Barkanet se reserva o direito de modificar, descontinuar ou suspender a rede social a qualquer momento, a nosso critério. </p>
                     <h3> Outro </h3>
                     <p> 6.1Os termos descritos neste documento são somente para conveniência da rede social enquanto existência, e não terão quaisquer efeitos legais e/ou de contrato. </p>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
               </div>
            </div>
         </div>
         <!--pop-up-->
         <div>
            <div class="pop-up" id="pop-up">
               <p>Utilizamos cookies essenciais de acordo com os nossos <a href="" data-toggle="modal" data-target="#ModalLongoExemplo">Termos de uso e Privacidade</a> e, ao continuar navegando, você concorda com estas condições.</p>
               <button type="button" class="btn btn-primary" onclick="hiddenPop()">Aceitar</button>
            </div>
         </div>
      </section>
   </body>
</html>