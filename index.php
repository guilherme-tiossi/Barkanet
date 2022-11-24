<?php
session_start();
?>

<!DOCTYPE html>
<html lang="utf-8" class="h-100 w-100">
<head>
	<title>BARKANET</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/fonts/font.css">
	<script type="text/javascript" src="js/script.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!--<link href="fontawesome/css/all.css" rel="stylesheet">-->
	<script src="https://kit.fontawesome.com/0bba2bf162.js" crossorigin="anonymous"></script>
</head>
<body id="intro" class="h-100 w-100">
	<div class="h-100 w-100">
	    <div class="row h-100 w-100 align-items-center justify-content-center">
			<div class="col-2 h-100">
				<div class="d-flex flex-column flex-shrink-0 h-100 gap-1 colunaindex">
					<a class="d-block link-dark text-decoration-none align-self-center" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icone-barkanet">
						<img src="img/logo.png" alt="barkanet logo" class="bi pe-none img-fluid" width="200" height="200"/>
						<span class="visually-hidden">Icone-barkanet</span>
					</a>
					<ul class="indexmenu nav nav-pills nav-flush flex-column mb-auto text-center gap-4">
						<li>
							<a href="#quem somos" class="nav-link py-3 border rounded" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Dashboard" data-bs-original-title="Dashboard">
								<p class="bi pe-none" width="44" height="44" aria-label="QuemSomos">Quem Somos</p>
							</a>
						</li>
						<li>
							<a href="#problemas das redes mainstream" class="nav-link py-3 border rounded" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Orders" data-bs-original-title="Orders">
								<p class="bi pe-none" width="44" height="44" aria-label="ProblemasdasRedesMainstreams">Problemas das Redes Mainstream</p>
							</a>
						</li>
						<li>
							<a href="#como funciona" class="nav-link py-3 border rounded" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Products" data-bs-original-title="Products">
								<p class="bi pe-none" width="44" height="44" aria-label="ComoFunciona">Como Funciona?</p>
							</a>
						</li>
						<li>
							<a href="#contato" class="nav-link py-3 border rounded" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Customers" data-bs-original-title="Customers">
								<p class="bi pe-none" width="44" height="44" role="img" aria-label="Contato">Contato</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-5 h-100">
				<div class="card text-center indexcard">
					<div id="cdheader" class="card-header d-flex justify-content-between">
						<div>
							<h5><i class="fa-solid fa-globe" style="color: #0049e6;"></i></h5>
						</div>
						<div>
							<h5>Bem vindo ao BARKANET</h5>
						</div>
						<div>
							<h5><i class="fa-solid fa-ellipsis"></i></h5>
						</div>
					</div>
					<div id="cdbody" class="card-body mx-auto text-center vstack justify-content-evenly">
						<div class="row mx-auto d-grid col-10">
							<h1 class="card-title">Uma rede social saudável feita pra você!</h1>
						</div>
						<div class="row mx-auto col-10">
							<a href="signup.php" class="btn btn-lg botaoindex w-100">Cadastre-se</a>
						</div>
						<div class="row mx-auto col-10">
							<a class="btn btn-lg botaoindex w-100" href="login.php">Já tem uma conta?<br/>Faça log-in</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-5 h-100">
				<div class="card mb-3 indexcard">
					<div id="cdbody" class="card-body indextexto overflow-auto">
						<h3 class="card-title" id="quem somos">Quem somos</h3>
						<p class="card-text">O Barkanet é um grupo de desenvolvedores e artistas focados em oferecer aos usuários uma nova forma de organização da vida online. Temos o objetivo de conscientizar o público geral sobre as problemáticas das redes sociais mainstream, que dentre outras coisas, são programadas para aumentar seu potencial viciante, influenciando o usuário a gastar muito mais tempo do que ele desejava inicialmente nas redes. O Barkanet oferece aos seus usuários uma rede em que toda a quantidade colossal de conteúdo que vem junto com uma rede conectada ao resto do globo é organizada em comunidades menores mais focados para assuntos específicos, gerenciadass pelos próprios membros de tal comunidade.  </p>
						<h3 class="card-title" id="problemas das redes mainstream">Problemas das Redes Mainstream</h3>
						<p class="card-text">Nós consideramos que, pelas redes sociais mainstreams serem totalmente abertas e públicas para todos os usuários de modo que qualquer conteúdo ou experiência que você poste esteja automaticamente conectado com todo o resto do mundo, é criado por consequência um ambiente onde a sua privacidade é inexistente. Ao mesmo tempo que isso acontece, a timeline do usuário é lotada de conteúdos negativos e irrelevantes para o usuário, o que acaba criando um ambiente tóxico, repetitivo e cansativo.</p>
						<h3 class="card-title" id="como funciona">Como Funciona?</h3>
						<p class="card-text">Barkanet será uma plataforma para o usuário compartilhar suas atualizações pessoais e manter contato com amigos, familiares e conhecidos. A rede funciona através de um sistema de amizades, onde apenas seus amigos conseguem ver as suas atualizações e você as dele!
                Outra funcionalidade de Barkanet é a de criar grupos com amigos específicos, criando assim uma segunda (ou terceira, não há limites para o número de grupos) timeline, focada geralmente para postar certas coisas com um grupo de amigos em específico ao invés de compartilhar com todos os seus amigos.</p>
						<h3 class="card-title" id="contato">Contato</h3>
						<p class="card-text">Se você viu algum comportamento inapropriado ou quer reportar algum bug, pode nos contatar em qualquer um dos seguintes emails:</p>
						<p>guilherme.a.m.tiossi@gmail.com</p>
						<p>lanzhanbestboi@gmail.com</p>
						<p>gustavo.gouveia.franca@gmail.com</p>
						<p>riquemdes311@gmail.com</p>
						<p>kauapereiratavares04@gmail.com</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
