<?php
header("Content-type: text/css; charset: UTF-8"); //look carefully to this line
include('../conexao.php');
include('../lib/includes.php');
    $id = $_SESSION['userId'];
    $stmt = $pdo->prepare("SELECT cordefundo FROM usuarios WHERE id = '$id'");
    $stmt->execute();
    $cor = $stmt->fetchColumn();
    ?>
<style>
.PORRA{
  color: black;
}
.link-perfil{
  text-decoration: none;
  color: black !important;
}

.icon-lapis{
  font-size: 14px;
  cursor: pointer;
  color: #000;
}

.card-perfil{
  background-color: rgb(238, 239, 243);
  border: 3px solid #b9babe;
  border-radius: 0;
}

.card-amigos{
  background-color: rgb(238, 239, 243);
  width: 100%;
  border: 2px solid #b9babe;
  border-top: none;
  border-radius: 0;
  display: inline-block;
  padding: 5px;
  }

.card-amigos img{
  padding-right: 0px;
}

.card-fundo{
  background-color: <?php echo $cor;?>; 
  border-left: 2px solid #b9babe;
  border-right: 2px solid #b9babe;
  border-bottom: 2px solid #b9babe;
  border-radius: 0;
  max-height: 100%;
}

.card-fundo-esquerda{
  background-color: rgb(238, 239, 243);
  border-left: 2px solid #b9babe;
  border-bottom: 2px solid #b9babe;
  border-radius: 0;
  height: 100%;
  width: 25%;
  position: fixed;
}

.card-fundo-direita{
  background-color: rgb(238, 239, 243);
  border-right: 2px solid #b9babe;
  border-bottom: 2px solid #b9babe;
  border-radius: 0;
  height: 100%;
  width: 100%;
  position: fixed;
}

.lista-grupos{
  background-color: #fff;
  border: 1px solid #b9babe;
  height: 450px;
  width: 100%;
  overflow-y: scroll;
  padding: 5px;
}

.card-posts{
  background-color: rgb(238, 239, 243);
  border: 2px solid #b9babe;;
  border-radius: 0;
}

.bg-card-perfil{
  background-color: rgb(238, 239, 243);
}

.to-hide{
	display: none;
}

.alert{
  color: #e60000;
  font-size: 17px;
  font-weight: 700;
}

span{
  margin-left: 0.8rem;
}

.div-alerta{
  padding: 0.35rem calc(1.5rem * 0.5) 0.35rem calc(1.5rem * 0.5);
  flex-shrink: 0;
  flex-wrap: wrap;
}

.pop-up{
	color: #fff;
 	position: fixed;
 	width: 100%;
 	bottom: 2rem;
 	z-index: 1000;
 	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);
 	background: #000;
 	border-radius: 5px;
 	padding: 1rem;
 	margin: 0 auto;
 	display: grid;
 	grid-template-columns: 1fr auto;
 	gap: 0.5rem;
 	opacity: 0;
 	transform: translateY(1rem);
 	animation: slideUp 0.5s forwards;
}

@keyframes slideUp {
  to {
    transform: initial;
    opacity: initial;
  }
}

.pop-up-hidden{
	color: #fff;
 	position: fixed;
 	width: 100%;
 	bottom: 2rem;
 	z-index: 1000;
 	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);
 	background: #000;
 	border-radius: 5px;
 	padding: 1rem;
 	margin: 0 auto;
 	display: grid;
 	grid-template-columns: 1fr auto;
 	gap: 0.5rem;
 	opacity: initial;
 	transform: initial;
 	animation: slideDown 1s forwards;
}

@keyframes slideDown {
  to {
    transform: translateY(10rem);
  	opacity: 0;
  }
}

.comentario{
	font-size: 16px;
	width: 30vh;
	height: 6vh;
  border: none;
  background-color: transparent;
  border-bottom: 2px solid #b9babe;
}

.btn_comentario{
  border: none;
  border-radius: 2px;
  background-color: #eeeeee;
  font-size: 20px;
  width: auto;
  color: #706f6f;
}

.card-comentarios{
  background-color: rgb(238, 239, 243);
  border: 2px solid #b9babe;;
  border-radius: 0;
  border-top: none;
}

.textoupdate_nome{
	font-size:15px;
	width: 25vh;
	height: 4vh;
  border: none;
  background-color: transparent;
  border-bottom: 2px solid #b9babe;
}

.textoupdate_2{
	font-size:15px;
	width: 25vh;
	height: 4vh;
  border: none;
  background-color: transparent;
  border-bottom: 2px solid #b9babe;
}

.pfp-input{
	display: none;
}

.label-pfpalterar{
	opacity: 0.3;
}

input[type=text]{
  outline: none;
}

.modal-alerta{
  background-color: rgb(238, 239, 243);
  border: 2px solid #b9babe;;
  border-radius: 5px;
  padding: 0.8rem;
}

.cro-modal{
  color: #e60000;
  font-size: 3rem;
}

.txt-modal{
  font-size: 3rem;
}

/*================================================ CSS MENUS ================================================*/

.inputpesquisa,
.botaopesquisa {
  border-width: 2px;
  border-color: #BEBEBE;
  border-radius: 0;
}

.inputpesquisa {
  border-right: 0;
  background-color: rgb(252, 252, 252);
}

.botaopesquisa {
  background-color: rgb(252, 252, 252);
  border-left: 0;
  color: #BEBEBE;
}

.inputpesquisa:focus, .inputpesquisa:hover, .botaopesquisa:focus, .botaopesquisa:hover {
  border-color: #BEBEBE;
  box-shadow: 0rem 0rem 0rem 0rem rgb(0 0 0 / 100%);
  background-color: rgb(252, 252, 252);
}

.bordaperfil {
  padding: 0.35rem calc(1.5rem * 0.5) 0.35rem calc(1.5rem * 0.5);
  border: 2px solid #BEBEBE;
  background: linear-gradient(180deg, #DCDCDC 0%, #FDFDFD 100%);
  flex-shrink: 0;
  flex-wrap: wrap;
}

.bordaperfil a {
  color: #BEBEBE;
}

.bordaperfil a:hover,
.bordaperfil a:focus{
  color: #BEBEBE;
}

.mainpost,
.posttitulo {
  font-family: 'KoHo', monospace, 'DM_Sans';
  background-color: white;
  outline: none;
}

.posttitulo {
  margin-top: 1rem;
  margin: 10px 10px 0 10px;
  padding-left: 20px;
  font-weight: bold;
  width: 95%;
}

.mainpost {
  height: 8rem;
  margin: 0 10px 10px 10px;
  width: 95%;
  padding-left: 1rem;
  font-weight: normal;
  resize: none;
}

.btnposts {
  border-radius: 2px;
  border: 1px solid #737373;
  padding: 0.5rem 0.7rem;
  margin: 0.5rem;
  cursor: pointer;
  font-weight: 700;
  color: #fff;
  background-color: #999999;
  box-shadow: 0 3px 0 #666666;
  transition: 0.3s;
}

.btnposts:active{
  transition: 0.3s;
  top: 3px;
  background-color: #C0C0C0;
  position: relative;
  box-shadow: none;
}

.listapags {
  text-decoration: none;
  color: black;
  font-size: 1.4rem;
  margin: 0.25rem 0.25rem 0.25rem 0.75rem;
  padding: 0.1rem;
  display: table;
}

.listapags:hover, .listapags:focus {
  color: black;
}

.listapags i {
  color: rgba(80, 140, 240, 0.7);
  margin-right: 0.5rem;
  font-size: 1.6rem;
  vertical-align:middle;
}

#linha-vertical {
  border-right: 2px solid #BEBEBE;
  width: 0;
  padding: 0;
}

.bordagrupos {
  padding: 0.35rem calc(1.5rem * 0.5) 0.35rem calc(1.5rem * 0.5);
  border: 2px solid #BEBEBE;
  margin-top: 0.4rem;
  background-color: rgba(112.520718, 44.062154, 249.437846, 0.1);
  flex-shrink: 0;
  width: 100%;
  max-width: 100%;
  flex-wrap: wrap;
}

.bordagrupos:hover,
.bordagrupos:focus {
  color: black;
  box-shadow: 0rem 0rem 0rem 0.225rem rgb(192 192 192 / 32%);
}

.bordagrupos a {
  text-decoration: none;
  color: black;
}

.imgperfil {
  width: 6.2rem;
  height: 6.2rem;
}

.imggrupo {
  width: 6.2rem;
  height: 6.2rem;
}

.textogrupo h5 {
  font-weight: 600;
}

.textogrupo h5, p {
  margin-bottom: 0.1rem;
}

#btncriargrupo {
  border-radius: 0;
  border-color: #C0C0C0;
  margin-top: 15px;
  padding-left: 5px;
  padding-right: 5px;
  background-color: #C0C0C0;
  color: black;
  font-weight: 650;
}

#btncriargrupo:hover,
#btncriargrupo:focus {
  box-shadow: 0rem 0rem 0rem 0.225rem rgb(192 192 192 / 32%);
}

.editarperfil{
  font-weight: 700;
  font-size: 16px;
  color: #0c0c0d;
}

.div-pesquisa{
  width: auto;
}
</style>