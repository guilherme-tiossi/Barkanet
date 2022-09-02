<?php
	function ler_dados_usuario($email, $pdo){
		global $pdo;
		$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = '$email'");
		 $stmt ->execute();
			foreach($stmt as $row) {
				global $nome;
				global $cod;
				global $nasc;
				global $bio;
				global $id;
				global $pfp;
				$nome = $row['nome'];
				$nasc = $row['data_nasc'];
				$nasc = date_create_from_format("Y-m-d", $nasc)->format("d/m/Y");
				$cod = $row['codigo'];
				$bio = $row['bio'];
				$id = $row['id'];
				$pfp = $row['profilepic'];
				}
			echo 
			'<div class="card-fundo pt-1" id="infouser">
			<div class="mx-auto pt-3 pb-3" style="width: 90%;">
	            <div class="card card-perfil">
	                <div class="card-body">
	                    <div class="d-flex flex-row bd-highlight mb-0">
	                        <div class="p-2 bd-highlight">
	                            <img class="float-left" src="img/'.$pfp.'" width="150" height="150" title="'.$pfp.'">
	                            <p class="mb-0" style="font-size: 18px";>
	                                <b>Nome:</b>
	                                <br>'.mb_strimwidth($nome, 0, 16, "...").'
									<a class="icon-lapis" onclick="mostraropcoesperfil()">
									<i class="fa-solid fa-pencil"></i>
									</a>
	                            </p>
	                        </div>
	                        <div class="p-2 bd-highlight">
	                            <h5 class="m-0">
	                                <b>Informações da conta:</b>
	                            </h5>
	                            <p class="mb-0" style="font-size: 18px";>
	                                <b>E-mail:</b>
	                                <br>'.$email.'
	                            </p>
	                            <p class="mb-0" style="font-size: 18px";>
	                                <b>Biografia:</b>
	                                <br>'.mb_strimwidth($bio, 0, 30, "...").'
									<a class="icon-lapis" onclick="mostraropcoesperfil()">
									<i class="fa-solid fa-pencil"></i>
									</a>
	                            </p>
	                            <p class="mb-0" style="font-size: 18px";>
	                                <b>Data de nascimento:</b>
	                                <br>'.$nasc.'
									<a class="icon-lapis" onclick="mostraropcoesperfil()">
									<i class="fa-solid fa-pencil"></i>
									</a>
	                            </p>
	                            <p class="mb-0" style="font-size: 18px";>
	                                <b>Código:</b>
	                                '.$cod.'
	                            </p>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        </div>
			<div class="to-hide" id="edituser">
			<div class="mx-auto pt-3 pb-3" style="width: 90%;">
	            <div class="card card-perfil">
	                <div class="card-body">
	                	<form method="POST" action="exec_update.php" autocomplete="off" enctype="multipart/form-data">
	                    <div class="d-flex flex-row bd-highlight mb-0">
	                        <div class="p-2 bd-highlight">
														<div class="image-upload">
															<label for="pfp" class="position-absolute">
																<i class="fa-solid fa-pencil"> <input type="file" name="pfp" id="pfp" class ="pfp-input" accept=".png, .jpeg, .jpg"> </i>
															</label>
															<img class="float-left" src="img/'.$pfp.'" width="150" height="150" title="'.$pfp.'">
														</div>
	                            <p class="mb-0" style="font-size: 18px";>
	                                <b>Nome:</b>
	                                <br>
                                  <input class="textoupdate_nome" type="text" name="nome" id="nome" value="'.$nome.'">
                                  <input type="submit" hidden>
	                            </p>
	                        </div>
	                        <div class="p-2 bd-highlight">
	                            <h5 class="m-0">
	                                <b>Informações da conta:</b>
	                            </h5>
	                            <p class="mb-0" style="font-size: 18px";>
	                                <b>E-mail:</b>
	                                <br>'.$email.'
	                            </p>
	                            <p class="mb-0" style="font-size: 18px";>
	                                <b>Biografia:</b>
	                                <br>
                                  <input class="textoupdate_2" type="text" name="bio" id="bio" value="'.$bio.'">              
                                </p>
	                            <p class="mb-0" style="font-size: 18px";>
	                                <b>Data de nascimento:</b>
	                                <br>
                                  <input class="textoupdate_2" type="text" name="data" id="data" value="'.$nasc.'">
                                  <input type="submit" hidden />
	                            </p>
	                            <p class="mb-0" style="font-size: 18px";>
	                                <b>Código:</b>
	                                '.$cod.'
	                            </p>
								<select id="cordefundo" name="cordefundo">
								<option value="rgb(238, 239, 243))">Padrão</option>
  								<option value="rgb(24, 8, 54)">Mirtilo</option>
  								<option value="rgb(218, 42, 42)">Morango</option>
  								<option value="rgb(158, 222, 84)">Limão</option>
  								<option value="rgb(235, 154, 129)">Pêssego</option>
								</select>
	                        </div>
	                    </div>
	                	</form>
	                </div>
	            </div>
	        </div>
	        </div>';
			};

	

	function ler_amigos_usuario(){
		global $pdo;
		echo "<div class='card card-amigos'>";
		$stmt2 = $pdo->prepare("select * from amigos where (id_de = {$_SESSION['userId']} and status = '1') or (id_para = {$_SESSION['userId']} and status = '1')");
        $stmt2 ->execute();
		
        foreach ($stmt2 as $row) :
          $id_para = $row['id_para'];
          $id_de = $row['id_de'];
          if($id_para == $_SESSION['userId']){
            $stmt3 = $pdo->prepare("select id, profilepic from usuarios where id = '$id_de'");
            $stmt3 ->execute();
            foreach ($stmt3 as $row):
				$idposter = $row['id'];
				echo "<a href='pgamigo.php?id=$idposter'> <img src='img/" . $row["profilepic"] . "' width='64' height='64' title='foto'> </a>
				";
            endforeach;
          }

          if($id_de == $_SESSION['userId']){
            $stmt3 = $pdo->prepare("select id, profilepic from usuarios where id = '$id_para'");
            $stmt3 ->execute();
            foreach ($stmt3 as $row):
				$idposter = $row['id'];
				echo "<a href='pgamigo.php?id=$idposter'> <img src='img/" . $row["profilepic"] . "' width='64' height='64' title='foto'> </a>
				";
            endforeach;
          }
        endforeach;
		echo "</div>";
	}

    function ler_posts_usuario(){
        global $pdo;
		global $id;
		global $pfp;

		$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
		$quantidade_pg = 50;

		$stmt = $pdo->prepare("SELECT * FROM tbposts WHERE (usuario = '$id') ORDER BY idpost DESC");
		$stmt->execute();

		$rowNum = $stmt->rowCount();
		$num_pagina = $rowNum / $quantidade_pg;
		$incio = $quantidade_pg * $pagina - $quantidade_pg;

		if(isset($_GET['pagina'])){
			if($_GET['pagina'] > ($num_pagina + 1)){
			  echo "<script>document.location.href = 'posts.php?pagina=1';</script>";
			}
	  
			if($_GET['pagina'] == 0){
			  echo "<script>document.location.href = 'posts.php?pagina=1';</script>";
			}
	  
			if (!preg_match('/^[1-9][0-9]*$/', $_GET['pagina'])) {
			  echo "<script>document.location.href = 'posts.php?pagina=1';</script>";
			}
		}

		$stmt = $pdo->prepare("SELECT * FROM tbposts WHERE (usuario = '$id') ORDER BY idpost DESC LIMIT $incio, $quantidade_pg");
		$stmt->execute();

		echo '<h2 class="p-3">Meus posts</h2>';
		foreach ($stmt as $row):
		$idposter = $row['usuario'];

			echo "
			<div class='mx-auto' style='width: 80%;'>
			<div class='card-posts'>
				<div class='card-body card bg-light m-2'>
				<div class='d-flex flex-row bd-highlight mb-0'>
					<div class='p-2 bd-highlight'>
					<img class='float-left' src='img/$pfp' width='64' height='64' title='foto'>
					</div>
					<div class='p-2 bd-highlight'>
					<p class='mb-0' style='font-size: 18px';>";
			
			if ($row['idgrupo'] > 0) {
				$stmt = $pdo->prepare("SELECT tbgrupos.nome_grupo, tbgrupos.id_grupo from tbposts JOIN tbgrupos ON tbposts.idgrupo = tbgrupos.id_grupo WHERE usuario = '$id' AND idpost = $row[idpost]");
				$stmt->execute();
				foreach ($stmt as $roww):
					$id_grupo = $roww['id_grupo'];
					echo "<a href='pggrupo.php?id_grupo=$id_grupo'>" . $roww['nome_grupo'] . "</a><br>";
				endforeach;
			}
			
			echo "<b><a href='pgamigo.php?id=$idposter'>".$row['nome']."</a></b><br>
					<b>$row[titulo]</b>
					</p>
				</div>
				</div>

				<div class='m-3 mt-0'>
					<p> $row[post]</p>
					<div class='mx-auto m-1' style='width: 80%;'>";
			if ($row['image'] != null) {
				echo "<img src='img/$row[image]' class='img-fluid' title='<$row[image]>' />";
			}
			echo "</div>
				</div>
				</div>
			</div>
			</div>";

			//COMENTARIOS
			$swor = $pdo->prepare("SELECT * FROM comentarios WHERE id_post = '{$row['idpost']}'");
			$swor->execute();
			$linhas = $swor->rowCount();

			if($linhas > 0){
			echo "
			<div class='mx-auto mb-2' style='width: 80%;'>
			<div class='card-comentarios pt-3'>";
			foreach ($swor as $swo):
			$idcomenter = $swo['com_user'];
			$pfpcom = $swo['profilepic'];
			$com = $swo['comentario'];
			$com_nome = $swo['com_nome'];

				echo "
				<div class='card bg-light m-3 mt-0 p-2' style='width: 80%;'>
				<div class='d-flex flex-row mb-0'>
					<div class='p-2 bd-highlight'>
						<img class='float-left' src='img/$pfpcom' width='50' height='50' title='foto'>
					</div>
					<div class='p-2 bd-highlight'>
						<div class='mb-0' style='font-size: 17px;'>
						<a href='pgamigo.php?id=$idcomenter'>$com_nome</a>				
						<br>
						<p>$com</p>
					</div>
					</div>
				</div>
				</div>";
			endforeach;
			echo "
			</div>
			</div>";
			}

			//COMENTAR
			$idpost = $row["idpost"];
			echo '
			<div class="mx-auto mb-2" style="width: 80%;">
			<form action="exec_com.php" method="post">
				<input class="comentario mt-2" type="text" name="txcom" id="txcom" maxlength="100" autocomplete=off placeholder="comentar...">
				<span id="alert-com" class="to-hide" role="alert">Digite um comentario...</span>
				<input type="hidden" name="post_id" value="'.$idpost.'">
				<button type="submit" name="comentar" class="btn_comentario">
				<i class="fa-solid fa-square-arrow-up-right"></i>
				</button>';
			echo '
			</form>
			</div>';
		endforeach;

		$pagina_anterior = $pagina - 1;
		$pagina_posterior = $pagina + 1;

		echo '
		<div class="mt-5">
		<nav>
			<ul class="pagination justify-content-center pt-2">';
				if($pagina_anterior != 0){
					$btn1 = '
					<a class="page-link text-muted" href="perfil.php?pagina='.$pagina_anterior.'" aria-label="Previous">
					<i class="fa-solid fa-reply"></i>
					</a>';
				}else{
				$btn1 = '<span class="page-link text-black-50"><i class="fa-solid fa-reply"></i></span>';
				}
			
			echo '<li class="page-item">';
			echo $btn1;
			echo '</li>';

				$num_atual = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
				$num_anterior = $num_atual - 1;
				$num_posterior = $num_atual + 1;

				if($num_anterior != 0){
					$btn2 = '<a class="page-link text-muted" href="perfil.php?pagina='.$num_anterior.'">'.$num_anterior.'</a>';
					echo '<li class="page-item">'.$btn2.'</li>';
				}

				$btn2 = '<a class="page-link text-muted" href="perfil.php?pagina='.$num_atual.'">'.$num_atual.'</a>';
				echo '<li class="page-item">'.$btn2.'</li>';

				if($num_posterior < ($num_pagina + 1)){
					$btn2 = '<a class="page-link text-muted" href="perfil.php?pagina='.$num_posterior.'">'.$num_posterior.'</a>';
					echo '<li class="page-item">'.$btn2.'</li>';
				}

				if($num_posterior < ($num_pagina + 1)){
				$btn3 = '<a class="page-link text-muted" href="perfil.php?pagina='.$pagina_posterior.'" aria-label="Previous"><i class="fa-solid fa-share"></i></a>';
				}else{
				$btn3 = '<span class="page-link text-black-50"><i class="fa-solid fa-share"></i></span>';
				}

			echo '<li class="page-item">';
			echo $btn3;
			echo '</li>
			</ul>
		</nav>
      	</div>';
    };
		
	function ler_dados_grupo($id_grupo, $id_usuario){
			global $pdo;
			$stmt = $pdo->prepare("SELECT * FROM tbgrupos WHERE id_grupo = '$id_grupo'");
			 $stmt->execute();
				foreach($stmt as $row) {
					global $nome_grupo; global $descricao_grupo; global $tipo_grupo; global $adm_grupo; global $foto_grupo;
					$nome_grupo = $row['nome_grupo'];
					$descricao_grupo = $row['descricao_grupo'];
					$tipo_grupo = $row['tipo_grupo'];
					$adm_grupo = $row['adm_grupo'];
					$foto_grupo = $row['foto_grupo'];
					}
				if ($id_usuario == $adm_grupo){
				echo 
				'<div class="card-fundo pt-1" id="infogrupo">
				<div class="mx-auto pt-3 pb-3" style="width: 90%;">
					<div class="card card-perfil">
						<div class="card-body">
							<div class="d-flex flex-row bd-highlight mb-0">
								<div class="p-2 bd-highlight">
									<img class="float-left" src="img/'.$foto_grupo.'" width="150" height="150" title="'.$foto_grupo.'">
									<p class="mb-0" style="font-size: 18px";>
										<b>Grupo:</b>
										<br>'.mb_strimwidth($nome_grupo, 0, 16, "...").'
										<a class="icon-lapis" onclick="mostraropcoesgrupos()">
											<i class="fa-solid fa-pencil"></i>
										</a>
									</p>
								</div>
								<div class="p-2 bd-highlight">
									<h5 class="m-0">
										<b>Informações do grupo:</b>
									</h5>
									<p class="mb-0" style="font-size: 18px";>
										<b>Privacidade:</b>
										<br>'.$tipo_grupo.'
										<a class="icon-lapis" onclick="mostraropcoesgrupos()">
										<i class="fa-solid fa-pencil"></i>
									</a>
									</p>
									<p class="mb-0" style="font-size: 18px";>
										<b>Descrição:</b>
										<br>'.mb_strimwidth($descricao_grupo, 0, 30, "...").'
										<a class="icon-lapis" onclick="mostraropcoesgrupos()">
											<i class="fa-solid fa-pencil"></i>
										</a>
									</p>
									<p class="mb-0" style="font-size: 18px";>
										<b>Criador:</b>
										<br>'.$adm_grupo.'
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
				<div class="to-hide" id="editgrupo">
				<div class="mx-auto pt-3 pb-3" style="width: 90%;">
					<div class="card card-perfil">
						<div class="card-body">
						<form method="POST" action="exec_update_grupo.php" autocomplete="off" enctype="multipart/form-data">
							<div class="d-flex flex-row bd-highlight mb-0">
								<div class="p-2 bd-highlight">
									<img class="float-left" src="img/'.$foto_grupo.'" width="150" height="150" title="'.$foto_grupo.'">
									<p class="mb-0" style="font-size: 18px";>
	                                <b>Grupo:</b>
	                                <br>
                                  <input class="textoupdate_nome" type="text" name="nome_grupo" id="nome_grupo" value="'.$nome_grupo.'">
								  <input type="hidden" name="id_grupo" value="' . $id_grupo .'">
								  <input type="submit" hidden>
	                            </p>
								</div>
								<div class="p-2 bd-highlight">
									<h5 class="m-0">
										<b>Editar informações do grupo:</b>
									</h5>
									<p class="mb-0" style="font-size: 18px";>
										<b>Privacidade:</b>
										<br>
										<select id="privacidade" name="privacidade">
										<option value="Publico"> Publico </option>
  										<option value="Privado"> Privado </option>	
										</select>
									</a>
									</p>
	                            <p class="mb-0" style="font-size: 18px";>
	                                <b>Descrição:</b>
	                                <br>
                                  <input class="textoupdate_2" type="text" name="descricao_grupo" id="descricao_grupo" value="'.$descricao_grupo.'">              
                                </p>
									<p class="mb-0" style="font-size: 18px";>
										<b>Criador:</b>
										<br>'.$adm_grupo.'
									</p>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>
				</div>';
				}
				else{
					echo 
					'<div class="card-fundo pt-1">
					<div class="mx-auto pt-3 pb-3" style="width: 90%;">
						<div class="card card-perfil">
							<div class="card-body">
								<div class="d-flex flex-row bd-highlight mb-0">
									<div class="p-2 bd-highlight">
										<img class="float-left" src="img/'.$foto_grupo.'" width="150" height="150" title="'.$foto_grupo.'">
										<p class="mb-0" style="font-size: 18px";>
											<b>Grupo:</b>
											<br>'.mb_strimwidth($nome_grupo, 0, 16, "...").'
										</p>
									</div>
									<div class="p-2 bd-highlight">
										<h5 class="m-0">
											<b>Informações do grupo:</b>
										</h5>
										<p class="mb-0" style="font-size: 18px";>
											<b>Privacidade:</b>
											<br>'.$tipo_grupo.'
										</p>
										<p class="mb-0" style="font-size: 18px";>
											<b>Descrição:</b>
											<br>'.mb_strimwidth($descricao_grupo, 0, 30, "...").'
										</p>
										<p class="mb-0" style="font-size: 18px";>
											<b>Criador:</b>
											<br>'.$adm_grupo.'
									</div>
								</div>
							</div>
						</div>
					</div>
					</div>';	
				}
				};

// ========================== SOLICITAÇÕES DE GRUPOS ==========================
	function carrega_pagina_atalho($con){
		$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 'atalho';
		$dir = "pags/";
		$ext = ".php";

		if(file_exists($dir.$pagina.$ext)){
			include($dir.$pagina.$ext);
		}else{
			echo "<div>Página não encontrada</div>";
		}
	}

	function get_perfil_grupo_procurar($con, $id_grupo, $id_amigo){
		$sql = $con->prepare("SELECT * FROM usuarios WHERE id = ?");
		$sql->bind_param("s", $id_amigo);
		$sql->execute();
		$get = $sql->get_result();
		$total = $get->num_rows;
		
		if($total > 0){
			$dados = $get->fetch_assoc();
			echo "<br>"."<b>{$dados['nome']}</b>";
			verfica_solicitacoes_grupo_procurar($con, $_SESSION['userId'], $id_amigo, $id_grupo);
			echo "<br>";
			echo"<a href='procurar.php'>Voltar</a>";
		}
	}

	function get_perfil_grupo_pggrupo($con, $id_grupo, $id_amigo){
		$sql = $con->prepare("SELECT * FROM usuarios WHERE id = ?");
		$sql->bind_param("s", $id_amigo);
		$sql->execute();
		$get = $sql->get_result();
		$total = $get->num_rows;
		
		if($total > 0){
			$dados = $get->fetch_assoc();
			echo "<b>{$dados['nome']}</b>";
			verfica_solicitacoes_grupo_pggrupo($con, $_SESSION['userId'], $id_amigo, $id_grupo);
			echo "<br>";
			echo"<a href='pggrupo.php?id_grupo={$id_grupo}'>Voltar</a>";
		}
	}

	function verfica_solicitacoes_grupo_pggrupo($con, $id_usuario, $id_amigo, $id_grupo){
		//CONSULTA DE ADMINISTRADOR
		$sql = $con->prepare("SELECT * FROM membros_grupos WHERE (id_adm = ? AND id_usuario = ? AND id_grupo = ?) OR (id_adm = ? AND id_usuario = ? AND id_grupo = ?)");
		$sql->bind_param("ssssss", $id_usuario, $id_amigo, $_GET['id_grupo'], $id_amigo, $id_usuario, $_GET['id_grupo']);
		$sql->execute();
		$get = $sql->get_result();
		$total = $get->num_rows;
		
		if($total > 0){
			$dados = $get->fetch_assoc();
			$sql = $con->prepare("SELECT * FROM membros_grupos WHERE id_adm = ? AND id_usuario = ? AND id_grupo = ?");
			$sql->bind_param("sss", $id_usuario, $id_amigo, $_GET['id_grupo']);
			$sql->execute();
			$get = $sql->get_result();
			$total = $get->num_rows;

			if($total > 0){
				$dados = $get->fetch_assoc();

				if($dados['id_adm'] == $id_usuario && $dados['id_usuario'] != $id_usuario && $dados['status'] == 1){
					echo "<a href='?pagina=remover-usuario-grupo&id_grupo={$id_grupo}&id={$dados['id']}'> Remover</a>";
				}

				if($dados['id_adm'] == $id_usuario && $id_amigo == $dados['id_usuario'] && $dados['para'] == $id_amigo && $dados['status'] == 0){
					echo "<a href='?pagina=remover-usuario-grupo&id_grupo={$id_grupo}&id={$dados['id']}'> Cancelar Solicitação</a>";
				}

				if($dados['id_adm'] == $id_usuario && $dados['id_usuario'] != $id_usuario && $dados['para'] == $id_usuario && $dados['status'] == 0){
					echo " pediu para entrar no grupo ";
					echo "<a href='?pagina=aceitar-solicitacao-grupo&id_grupo={$id_grupo}&id_adm={$dados['id_adm']}&id_usuario={$dados['id_usuario']}'>Aceitar</a>";
					echo "<a href='?pagina=recusar-solicitacao-grupo&id_grupo={$id_grupo}&id={$dados['id']}'> Recusar</a>";
				}
			}
		}

		else{
			$sql = $con->prepare("SELECT adm_grupo FROM tbgrupos WHERE id_grupo = ?");
			$sql->bind_param("s", $id_grupo);
			$sql->execute();
			$get = $sql->get_result();
			$total = $get->num_rows;
			$dados = $get->fetch_assoc();
				
			if($total > 0  && $dados['adm_grupo'] == $id_usuario){
				echo "<a href='?pagina=solicitar-convite-grupo&id_grupo={$id_grupo}&id={$id_amigo}'> Convidar</a>";
			}
		}
	}

	function verfica_solicitacoes_grupo_procurar($con, $id_usuario, $id_amigo, $id_grupo){
		//CONSULTA NOME GRUPO
		$sql = $con->prepare("SELECT nome_grupo FROM tbgrupos WHERE id_grupo = '$id_grupo'");
		$sql->execute();
		$get = $sql->get_result();
		$dados = $get->fetch_assoc();
		$nome_grupo = $dados['nome_grupo'];

		//CONSULTA DE USUARIO
		$sql = $con->prepare("SELECT * FROM membros_grupos WHERE (id_adm = ? AND id_usuario = ? AND status = 0 AND id_grupo = ?) OR (id_adm = ? AND id_usuario = ? AND status = 0 AND id_grupo = ?)");
		$sql->bind_param("ssssss", $id_amigo, $id_usuario, $id_grupo, $id_usuario, $id_amigo, $id_grupo);
		$sql->execute();
		$get = $sql->get_result();
		$total = $get->num_rows;
		
		if($total > 0){
			$dados = $get->fetch_assoc();
			if($dados['id_adm'] == $id_amigo && $dados['id_usuario'] == $id_usuario && $dados['para'] == $id_usuario && $dados['status'] == 0 && $id_grupo == $dados['id_grupo']){
				echo " convidou voce para entrar no grupo ";
				echo "<a href='procurar.php?pagina=pesquisa_grupo&nome_grupo={$nome_grupo}''>$nome_grupo</a> <br>";

				echo "<a href='?pagina=aceitar-solicitacao-grupo&id_grupo={$id_grupo}&id_adm={$dados['id_adm']}&id_usuario={$dados['id_usuario']}'> Entrar</a>   ";
				echo "<a href='?pagina=recusar-solicitacao-grupo&id_grupo={$id_grupo}&id={$dados['id']}'>Recusar</a>";
			}

			if($dados['id_adm'] == $id_usuario && $dados['id_usuario'] == $id_amigo && $dados['para'] == $id_usuario && $dados['status'] == 0){
				echo " pediu para entrar no grupo $nome_grupo ";
				echo "<a href='?pagina=aceitar-solicitacao-grupo&id_grupo={$id_grupo}&id_adm={$dados['id_adm']}&id_usuario={$dados['id_usuario']}'>Aceitar</a>";
				echo "<a href='?pagina=recusar-solicitacao-grupo&id_grupo={$id_grupo}&id={$dados['id']}'> Recusar</a>";
			}
		}

		else{
			$sql = $con->prepare("SELECT id_grupo, adm_grupo FROM tbgrupos WHERE id_grupo = ?");
			$sql->bind_param("s", $id_grupo);
			$sql->execute();
			$get = $sql->get_result();
			$total = $get->num_rows;
			$dados = $get->fetch_assoc();

			if($total > 0 && $dados['adm_grupo'] == $id_amigo && $dados['id_grupo'] == $id_grupo){
				echo "<a href='?pagina=solicitar-entrada-grupo&id_grupo={$id_grupo}&id={$id_amigo}'> Pedir para entrar</a>";
			}
		}
	}

	function pesquisa_grupo($con, $nome_grupo){
		//CONSULTA NOME GRUPO
		$sql = $con->prepare("SELECT * FROM tbgrupos WHERE nome_grupo = '$nome_grupo'");
		$sql->execute();
		$get = $sql->get_result();
		$total = $get->num_rows;
		$dados = $get->fetch_assoc();
		$tipo_grupo = $dados['tipo_grupo'];
		$foto_grupo = $dados['foto_grupo'];
		$desc_grupo = $dados['descricao_grupo'];
		
		if($total > 0){
			$dados = $get->fetch_assoc();
			echo "<img src='img/$foto_grupo' width='64' height='64' title='$foto_grupo'>";
			echo $nome_grupo." - ".$tipo_grupo."<br>";
			echo mb_strimwidth($desc_grupo, 0, 50, "...");
			echo "<br>"."<a href='?pagina=solicitacoes-grupo'>Voltar</a>";
		}
	}

	function verifica_membro_convite($con, $id_adm, $id_usuario, $idgrupo){
		$sql = $con->prepare("SELECT * FROM membros_grupos WHERE id_adm = ? AND id_usuario = ? AND id_grupo = ? AND status = 0");
		$sql->bind_param("sss", $id_adm, $id_usuario, $idgrupo);
		$sql->execute();

		return $sql->get_result()->num_rows;
	}

	function send_convite_grupo($con, $id_grupo, $id_usuario){
		$zero = 0;
		if(verifica_membro_convite($con, $_SESSION['userId'], $id_usuario, $id_grupo) <= 0){
			$sql = $con->prepare("INSERT membros_grupos (id_adm, id_usuario, id_grupo, para, status) VALUES (?, ?, ?, ?, ?)");
			$sql->bind_param("sssss", $_SESSION['userId'], $id_usuario, $id_grupo, $id_usuario, $zero);
			$sql->execute();

			if($sql->affected_rows > 0){
				redireciona("pggrupo.php?id_grupo={$id_grupo}");
			}else{
				return false;
			}
		}else{
			redireciona("pggrupo.php?id_grupo={$id_grupo}");
		}
		
	}

	function verifica_membro_solicitacao($con, $id_adm, $id_usuario, $id_grupo){
		$sql = $con->prepare("SELECT * FROM membros_grupos WHERE id_adm = ? AND id_usuario = ? AND status = 0 AND id_grupo = ?");
		$sql->bind_param("sss", $id_adm, $id_usuario, $id_grupo);
		$sql->execute();

		return $sql->get_result()->num_rows;
	}

	function send_solicitacion_grupo($con, $id_grupo, $id_adm){
		$zero = 0;
		if(verifica_membro_solicitacao($con, $id_adm, $_SESSION['userId'], $id_grupo) <= 0){
			$sql = $con->prepare("INSERT membros_grupos (id_adm, id_usuario, id_grupo, para, status) VALUES (?, ?, ?, ?, ?)");
			$sql->bind_param("sssss", $id_adm, $_SESSION['userId'], $id_grupo, $id_adm, $zero);
			$sql->execute();

			if($sql->affected_rows > 0){
				redireciona("procurar.php");
			}else{
				return false;
			}
		}
		
	}

	function deleta_solicitacao_grupo($con, $id_grupo, $id){
		$sql = $con->prepare("DELETE FROM membros_grupos WHERE id = ?");
		$sql->bind_param("s", $id);
		$sql->execute();

		if($sql->affected_rows > 0){
			redireciona("procurar.php");
		}else{
			return false;
		}
	}

	function remover_usuario_grupo($con, $id_grupo, $id){
		$sql = $con->prepare("DELETE FROM membros_grupos WHERE id = ?");
		$sql->bind_param("s", $id);
		$sql->execute();

		if($sql->affected_rows > 0){
			redireciona("pggrupo.php?id_grupo={$id_grupo}");
		}else{
			return false;
		}
	}

	function aceita_solicitacao_grupo($con, $id_grupo, $id_adm, $id_usuario){
		$sql = $con->prepare("SELECT * FROM membros_grupos WHERE id_adm = ? AND id_usuario = ? AND status = 0 AND id_grupo = ?");
		$sql->bind_param("sss", $id_adm, $id_usuario, $id_grupo);
		$sql->execute();
		$get = $sql->get_result();
		$total = $get->num_rows;

		if($total > 0){
			$dados = $get->fetch_assoc();
				if(atualiza_solicitacao_grupo($con, $id_adm, $id_usuario, $id_grupo) > 0){
					redireciona("pggrupo.php?id_grupo={$id_grupo}");	
				}else{
					echo "erro ao atualizar;";
				}
		}else{
			return false;
		}
	}

	function atualiza_solicitacao_grupo($con, $id_adm, $id_usuario, $id_grupo){
		$sql = $con->prepare("UPDATE membros_grupos SET status = 1 WHERE id_adm = ? AND id_usuario = ? AND id_grupo = ?");
		$sql->bind_param("sss", $id_adm, $id_usuario, $id_grupo);
		$sql->execute();

		return $sql->affected_rows;
	}


	function verifica_membro_solicitacao_publico($con, $id_adm, $id_usuario){
		$sql = $con->prepare("SELECT * FROM membros_grupos WHERE id_adm = ? AND id_usuario = ? AND status = 1");
		$sql->bind_param("ss", $id_adm, $id_usuario);
		$sql->execute();

		return $sql->get_result()->num_rows;
	}

	function entrar_grupo_publico($con, $id_grupo, $id_adm){
		$um = 1;
		if(verifica_membro_solicitacao_publico($con, $id_adm, $_SESSION['userId']) <= 0){
			$sql = $con->prepare("INSERT membros_grupos (id_adm, id_usuario, id_grupo, para, status) VALUES (?, ?, ?, ?, ?)");
			$sql->bind_param("sssss", $id_adm, $_SESSION['userId'], $id_grupo, $_SESSION['userId'], $um);
			$sql->execute();

			if($sql->affected_rows > 0){
				redireciona("pggrupo.php?id_grupo={$id_grupo}");
			}else{
				return false;
			}
		}else{
			redireciona("pggrupo.php?id_grupo={$id_grupo}");
		}
	}

	function solicitacoes_grupo($con){
		if(isset($_SESSION['userId'])){
			$sql = $con->prepare("SELECT * FROM membros_grupos WHERE para = ? AND status = 0");
			$sql->bind_param("s", $_SESSION['userId']);
			$sql->execute();
			$get = $sql->get_result();
			$total = $get->num_rows;

			if($total > 0){
				while($dados = $get->fetch_array()){
					if($dados['para'] == $dados['id_adm']){
						get_perfil_grupo_procurar($con, $dados['id_grupo'], $dados['id_usuario']);
					}

					if($dados['para'] == $dados['id_usuario']){
						get_perfil_grupo_procurar($con, $dados['id_grupo'], $dados['id_adm']);
					}
				}
			}
		}else{
			exit();
		}
	}

	function return_total_solicitation_grupo($con){
		$sql = $con->prepare("SELECT * FROM membros_grupos WHERE para = ? AND status = 0");
		$sql->bind_param("s", $_SESSION['userId']);
		$sql->execute();
		$get = $sql->get_result();
		$total = $get->num_rows;
		if($total > 0){
			return " ".$total;
		}
	}

// ========================== SOLICITAÇÕES DE AMIZADE ========================== 
	function carrega_pagina_solicitacao($con){
		$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 'inicio';
		$dir = "pags/";
		$ext = ".php";

		if(file_exists($dir.$pagina.$ext)){
			include($dir.$pagina.$ext);
		}else{
			echo "<div>Página não encontrada</div>";
		}
	}

	function get_perfil($con, $perfil){
		$sql = $con->prepare("SELECT * FROM usuarios WHERE id = ?");
		$sql->bind_param("s", $perfil);
		$sql->execute();
		$get = $sql->get_result();
		$total = $get->num_rows;

		if($total > 0){
			$dados = $get->fetch_assoc();
			echo "<b>{$dados['nome']}</b> <br>";
			verfica_solicitacoes($con, $_SESSION['userId'], $perfil);
			echo "<br>";
		}
	}

	function verifica_amizade($con, $id_de, $id_para){
		$sql = $con->prepare("SELECT * FROM amigos WHERE id_de = ? AND id_para = ? AND status = 0");
		$sql->bind_param("ss", $id_de, $id_para);
		$sql->execute();

		return $sql->get_result()->num_rows;
	}

	function send_solicitation($con, $id_para){
		if(verifica_amizade($con, $_SESSION['userId'], $id_para) <= 0){
			$sql = $con->prepare("INSERT amigos (id_de, id_para) VALUES (?, ?)");
			$sql->bind_param("ss", $_SESSION['userId'], $id_para);
			$sql->execute();

			if($sql->affected_rows > 0){
				redireciona("?pagina=perfil&id={$id_para}");
			}else{
				return false;
			}
		}else{
			redireciona("?pagina=perfil&id={$id_para}");
		}
		
	}

	function verfica_solicitacoes($con, $id_de, $id_para){		
		$sql = $con->prepare("SELECT * FROM amigos WHERE (id_de = ? AND id_para = ?) OR (id_para = ? AND id_de = ?)");
		$sql->bind_param("ssss", $id_de, $id_para, $id_de, $id_para);
		$sql->execute();
		$get = $sql->get_result();
		$total = $get->num_rows;

		if($total > 0){
			$dados = $get->fetch_assoc();

			if($dados['status'] == 1){
				echo "<a href='?pagina=desfazer-amizade&id={$dados['id']}'>Desfazer Amizade</a>";
				echo "<br>";
				echo"<a href='procurar.php'>Voltar</a>";
			}

			if($dados['id_para'] == $id_para && $dados['id_de'] == $id_de && $dados['status'] == 0){
				echo "<a href='?pagina=desfazer-amizade&id={$dados['id']}'>Cancelar Solicitação</a>";
				echo "<br>";
				echo"<a href='procurar.php'>Voltar</a>";
			}

			if($dados['id_de'] == $id_para && $dados['id_para'] == $id_de && $dados['status'] == 0){
				echo "<a href='?pagina=aceitar-amizade&id={$dados['id_de']}'>Aceitar Solicitação</a>";
				echo "<br>";
				echo "<a href='?pagina=desfazer-amizade&id={$dados['id']}'>Recusar Solicitação</a>";
				echo "<br>";
				echo"<a href='procurar.php'>Voltar</a>";
			}
		}else if($total <= 0  && $id_para != $id_de){
			echo "<a href='?pagina=solicitar-amizade&id={$id_para}'>Adicionar Amigo</a>";
			echo "<br>";
			echo"<a href='procurar.php'>Voltar</a>";
		}
	}

	function verfica_solicitacoes_amigos($con, $id_de, $id_para){		
		$sql = $con->prepare("SELECT * FROM amigos WHERE (id_de = ? AND id_para = ?) OR (id_para = ? AND id_de = ?)");
		$sql->bind_param("ssss", $id_de, $id_para, $id_de, $id_para);
		$sql->execute();
		$get = $sql->get_result();
		$total = $get->num_rows;

		if($total > 0){
			$dados = $get->fetch_assoc();

			if($dados['status'] == 1){
				echo "<td><a href='?pagina=desfazer-amizade&id={$dados['id']}'>Desfazer Amizade</a></td>";
			}
		}
	}

	function deleta_solicitacao($con, $id){
		$sql = $con->prepare("DELETE FROM amigos WHERE id = ?");
		$sql->bind_param("s", $id);
		$sql->execute();

		if($sql->affected_rows > 0){
			redireciona("?pagina=inicio");
		}else{
			return false;
		}
	}

	function recusar_solicitacao($con, $id){
		$sql = $con->prepare("DELETE FROM amigos WHERE id = ?");
		$sql->bind_param("s", $id);
		$sql->execute();

		if($sql->affected_rows > 0){
			redireciona("?pagina=solicitacoes");
		}else{
			return false;
		}
	}

	function aceita_solicitacao($con, $id_de){
		$sql = $con->prepare("SELECT * FROM amigos WHERE id_de = ? AND id_para = ? AND status = 0");
		$sql->bind_param("ss", $id_de, $_SESSION['userId']);
		$sql->execute();
		$get = $sql->get_result();
		$total = $get->num_rows;

		if($total > 0){
			$dados = $get->fetch_assoc();

			if($dados['id_para'] == $_SESSION['userId']){
				if(atualiza_solicitacao($con, $id_de, $_SESSION['userId']) > 0){
					redireciona("?pagina=perfil&id={$id_de}");	
				}else{
					echo "erro ao atualizar;";
				}
				
			}else{
				return false;
			}
		}
	}

	function atualiza_solicitacao($con, $id_de, $id_para){
		$sql = $con->prepare("UPDATE amigos SET status = 1 WHERE id_de = ? AND id_para = ?");
		$sql->bind_param("ss", $id_de, $id_para);
		$sql->execute();

		return $sql->affected_rows;
	}

	function redireciona($dir){
		echo "<meta http-equiv='Refresh' content='0; url={$dir}'/>";
	}

	function solicitacoes($con){
		if(isset($_SESSION['userId'])){
			$sql = $con->prepare("SELECT * FROM amigos WHERE id_para = ? AND status = 0");
			$sql->bind_param("s", $_SESSION['userId']);
			$sql->execute();
			$get = $sql->get_result();
			$total = $get->num_rows;

			if($total > 0){
				while($dados = $get->fetch_array()){
					get_perfil($con, $dados['id_de']);
				}
			}
		}else{
			exit();
		}
	}

	function return_total_solicitation($con){
		$sql = $con->prepare("SELECT * FROM amigos WHERE id_para = ? AND status = 0");
		$sql->bind_param("s", $_SESSION['userId']);
		$sql->execute();
		$get = $sql->get_result();
		$total = $get->num_rows;
		if($total > 0){
			return " ".$total;
		}
	}
?>
