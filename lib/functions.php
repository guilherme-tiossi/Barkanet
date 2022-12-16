<?php
//=============================== FUNÇÔES GERAIS ===================================
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
			"<div class='card-fundo pt-1' id='infouser'>
			<div class='mx-auto pt-3 pb-3' style='width: 90%;'>
	            <div class='card card-perfil'>
	                <div class='card-body'>
	                    <div class='d-flex flex-row bd-highlight mb-0'>
	                        <div class='p-2 bd-highlight'>
	                            <img class='float-left img-pfp' src='img/".$pfp."' width='150' height='150' title='foto_perfil'>
	                            <p class='mb-0' style='font-size: 18px';>
	                                <b>Nome:</b>
									<a class='icon-lapis' href='?editar&pag=1'>
									<i class='fa-solid fa-pencil'></i>
									</a>
									<div style='width: 10rem;'>
									<p>".$nome."</p>
									</div>
								</p>
	                        </div>
	                        <div class='p-2 bd-highlight'>
	                            <h5 class='m-0'>
	                                <b>Informações da conta:</b>
	                            </h5>
	                            <p class='mb-0' style='font-size: 18px';>
	                                <b>E-mail:</b>
	                                <br>".$email."
	                            </p>
	                            <p class='mb-0' style='font-size: 18px';>
	                                <b>Código:</b>
	                                ".$cod."
	                            </p>
	                            <p class='mb-0' style='font-size: 18px';>
	                                <b>Data de nascimento:</b>
									<a class='icon-lapis' href='?editar&pag=1'>
									<i class='fa-solid fa-pencil'></i>
									</a>
	                                <br>".$nasc."
								</p>
                           <div style='width: 18rem;''>
                           <p class='mb-0' style='font-size: 18px';>
                               <b>Biografia:</b>
							   <a class='icon-lapis' href='?editar&pag=1'>
							   <i class='fa-solid fa-pencil'></i>
							   </a>
                               <br>";

                               if(1 == 1){
                               	echo "".mb_strimwidth($bio, 0, 59, ' ler mais')."";
                               }else{
                               	echo "<textarea class='textoupdate_3' type='text' name='bio' id='bio' maxlength='200' disabled>".$bio."</textarea>";
                               }

                               echo " 
                           </p>
                           </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        </div>

			<div class='to-hide' id='edituser'>
			<div class='mx-auto pt-3 pb-3' style='width: 90%;'>
	            <div class='card card-perfil'>
	                <div class='card-body'>
	                	<form method='post' action='exec_update.php' onsubmit='return editarDados()' autocomplete='off' enctype='multipart/form-data'>
	                    <div class='d-flex flex-row bd-highlight mb-0'>
	                        <div class='p-2 bd-highlight'>
	                        <div style='position: absolute; display: inline-grid;'>
								<label for='pfp' class='icon-camera1'>
									<i class='fa-solid fa-camera'><input type='file' name='pfp' id='pfp' class ='pfp-input' accept='.png, .jpeg, .jpg'></i>
								</label>";

								if($pfp != "avatar.jpg"){
									echo "
									<a href='exec_remover.php' class='icon-camera2'>
										<i class='fa-regular fa-trash-can'></i>
									</a>";
								}
							
							echo "
							</div>
								<img id='blah' class='float-left img-pfp' src='img/".$pfp."' width='150' height='150' title='foto_perfil'>
	                            <p class='mb-0' style='font-size: 18px';>
	                                <b>Nome:</b>
	                                <br>
                                  <input class='textoupdate_nome' type='text' name='nome' id='nome' value='".$nome."' maxlength='30'>
								  <span id='alert-nome' class='to-hide' role='alert'><br>O nome deve ter no <br> mínimo 3 caracteres</span>
								</p>
	                        </div>
	                        <div class='p-2 bd-highlight'>
	                            <h5 class='m-0'>
	                                <b>Informações da conta:</b>
	                            </h5>
	                            <p class='mb-0' style='font-size: 18px';>
	                                <b>Data de nascimento:</b>
	                                <br>
                                  <input class='textoupdate_2' type='text' name='data' id='data' value='".$nasc."'>
								  <span id='alert-data' class='to-hide' role='alert'><br>Preencha o campo data de nascimento</span>
								  <span id='alert-idade' class='to-hide' role='alert'><br>Voce não tem idade suficiente para usar essa rede social</span>
								  <span id='alert-idade1' class='to-hide' role='alert'><br>Insira uma data de nascimento válida.</span>
						   		</p>
	                            <p class='mb-0' style='font-size: 18px';>
	                                <b>Biografia:</b>
	                                <br>
                                  <textarea class='textoupdate_3' type='text' name='bio' id='bio' maxlength='200'>".$bio."</textarea>
								</p>
								<input type='submit' value='Salvar' class='btn-editar'>
	                        </div>
	                    </div>
	                	</form>
	                </div>
	            </div>
	        </div>
	    	</div>";
	};

	function ClassifyChar( $ch )
			{
				if ( ( 'a' <= $ch && 'z' >= $ch ) || ' ' == $ch )
					return 'lower';
				if ( 'A' <= $ch && 'Z' >= $ch )
					return 'upper';
				if ( '0' <= $ch && '9' >= $ch )
					return 'number';
				if ( false === strpos( "`~!@#$%^&*()_-+={}|[]\\:\";',./<>?", $ch ) )
					return 'symbol';
				return 'other';
			}
		
			function CalcPasswordStrength( $pw )
			{
				if ( !strlen( $pw ) )
					return 0;
				
				$score = array( "lower"=>26, "upper"=>26, "number"=>10, "symbol"=>35, "other"=>20 );
				
				$dist = array(); $used = array();
				for ( $i = 0; $i < strlen( $pw ); $i++ )
					if ( !isset( $used[ $pw[ $i ] ] ) )
					{	$used[ $pw[ $i ] ] = 1;
						$c = ClassifyChar( $pw[ $i ] );
						if ( !isset( $dist[ $c ] ) )
							$dist[ $c ] = $score[ $c ] / 2;
						else 
							$dist[ $c ] = $score[ $c ];
					}
		
				$total = 0;
				foreach( $dist as $k => $v )
					$total += $v;
		
				$used = array();
				$strength = 1;
				for ( $i = 0; $i < strlen( $pw ); $i++ )
				{	
					if ( !isset( $used[ $pw[ $i ] ] ) )
						$used[ $pw[ $i ] ] = 1;
					else 
						$used[ $pw[ $i ] ]++;
					
					if ( $total > $used[ $pw[ $i ] ] )
						$strength *= $total / $used[ $pw[ $i ] ];
						
				}
				
				return (int)( log( $strength ) );
	}

	function ler_amigos_usuario(){
		global $pdo;
		echo "<div>";
		$stmt2 = $pdo->prepare("select * from amigos where (id_de = {$_SESSION['userId']} and status = '1') or (id_para = {$_SESSION['userId']} and status = '1')");
        $stmt2 ->execute();
		$rowNum = $stmt2->rowCount();

		if($rowNum <= 0){
			echo "
			<div class='d-flex'>
				<div class='p-2 flex-fill'>
					<h2 class='p-3'>Meus Amigos</h2>
				</div>
				<div class='p-2 flex-fill'>
					<div class='d-flex flex-row-reverse'>
						<div class='btn-group p-3' role='group'>
							<a id='btnopcoesgrupo' class='btn btn-secondary text-uppercase' href='?meus-posts&pag=1'>Posts</a>
							<a id='btnopcoesgrupo' class='btn btn-secondary text-uppercase' href='?meus-amigos&pag=1'>Amigos</a>
						</div>
					</div>
				</div>
			</div>
			<div class='conteudo'>
			  <p class='msg-timeline text-center'>Voce ainda não fez amizades...</p>
			</div>";
		}
		else{
			echo "
			<div class='d-flex'>
				<div class='p-2 flex-fill'>
					<h2 class='p-3'>Meus Amigos</h2>
				</div>
				<div class='p-2 flex-fill'>
					<div class='d-flex flex-row-reverse'>
						<div class='btn-group p-3' role='group'>
							<a id='btnopcoesgrupo' class='btn btn-secondary text-uppercase' href='?meus-posts&pag=1'>Posts</a>
							<a id='btnopcoesgrupo' class='btn btn-secondary text-uppercase' href='?meus-amigos&pag=1'>Amigos</a>
						</div>
					</div>
				</div>
			</div>
			<div class='d-flex flex-wrap'>";
			foreach ($stmt2 as $row) :
			  $id_para = $row['id_para'];
			  $id_de = $row['id_de'];
			  if($id_para == $_SESSION['userId']){
				$stmt3 = $pdo->prepare("select id, profilepic, nome from usuarios where id = '$id_de'");
				$stmt3 ->execute();
				foreach ($stmt3 as $row):
					$idposter = $row['id'];
					echo "
					<div class='card-amigos' style='width: 8.5rem;'>
						<div class='card-body'>
							<a href='pgamigo.php?id=$idposter'>
								<img src='img/".$row["profilepic"]."' width='64' height='64' class='card-amigos-img'>
								<div class='card-amigos-nome'>".mb_strimwidth($row["nome"], 0, 11, "...")."</div>
							</a>
						</div>
					</div>
					";
				endforeach;
			  }

			  if($id_de == $_SESSION['userId']){
				$stmt3 = $pdo->prepare("select id, profilepic, nome from usuarios where id = '$id_para'");
				$stmt3 ->execute();
				foreach ($stmt3 as $row):
					$idposter = $row['id'];
					echo "
					<div class='card-amigos' style='width: 8.5rem;'>
						<div class='card-body'>
							<a href='pgamigo.php?id=$idposter'>
								<img src='img/".$row["profilepic"]."' width='64' height='64' class='card-amigos-img'>
								<div class='card-amigos-nome'>".mb_strimwidth($row["nome"], 0, 11, "...")."</div>
							</a>
						</div>
					</div>
					";
				endforeach;
			  }
			endforeach;
			echo "</div>";
		}
		echo "</div>";
	}

    function ler_posts_usuario($pagina, $num_pagina, $inicio, $quantidade_pg){
        global $pdo;
		global $id;
		global $pfp;

		$stmt = $pdo->prepare("SELECT * FROM tbposts WHERE (usuario = '$id') ORDER BY idpost DESC LIMIT $inicio, $quantidade_pg");
		$stmt->execute();
		$rowNum = $stmt->rowCount();

		if($rowNum <= 0){
			echo "
			<div class='d-flex'>
				<div class='p-2 flex-fill'>
					<h2 class='p-3'>Meus Posts</h2>
				</div>
				<div class='p-2 flex-fill'>
				<div class='d-flex flex-row-reverse'>
					<div class='btn-group p-3' role='group'>
						<a id='btnopcoesgrupo' class='btn btn-secondary text-uppercase' href='?meus-posts&pag=1'>Posts</a>
						<a id='btnopcoesgrupo' class='btn btn-secondary text-uppercase' href='?meus-amigos&pag=1'>Amigos</a>
					</div>
				</div>
				</div>
			</div>
			
			<div class='conteudo'>
			  <p class='msg-timeline text-center'>Ainda não tem nenhum post aqui...</p>
			</div>";
		  }
		else{
		echo "
			<div class='d-flex'>
				<div class='p-2 flex-fill'>
					<h2 class='p-3'>Meus Posts</h2>
				</div>
				<div class='p-2 flex-fill'>
				<div class='d-flex flex-row-reverse'>
					<div class='btn-group p-3' role='group'>
						<a id='btnopcoesgrupo' class='btn btn-secondary text-uppercase' href='?meus-posts&pag=1'>Posts</a>
						<a id='btnopcoesgrupo' class='btn btn-secondary text-uppercase' href='?meus-amigos&pag=1'>Amigos</a>
					</div>
				</div>
				</div>
			</div>
		";
		foreach ($stmt as $row):
		$idposter = $row['usuario'];
		$swor = $pdo->prepare("SELECT * FROM comentarios WHERE id_post = '{$row['idpost']}'");
		$swor->execute();
		$linhas = $swor->rowCount();
  
		echo "<div class='mx-auto' style='width: 80%;'>";
  
		if($linhas > 0){
		  echo "
		  <div class='card-posts' style='border-bottom: none;'>
		  <div class='card-body card bg-light m-2 mb-0'>";
		}else{
		  echo "
		  <div class='card-posts'>
		  <div class='card-body card bg-light m-2'>";
		}
			echo "<div class='d-flex flex-row bd-highlight mb-0'>
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
					echo "<b><a href='pggrupo.php?id_grupo=$id_grupo' class='link'>".$roww['nome_grupo']."</a> • </b>";
				endforeach;
			}
			
			echo "<b><a href='perfil.php' class='link'>".$row['nome']."</a></b><br>
					<p class='titulo-post'>$row[titulo]</p>
				</p>
				</div>
				</div>

				<div class='m-3 mt-0'>
					<p> $row[post]</p>
					<div class='mx-auto m-1' style='width: 80%;'>";
					if ($row['file'] != null) {
						if(strripos($row['file'], 'jpg') == true || strripos($row['file'], 'jpeg') == true || strripos($row['file'], 'png') == true || strripos($row['file'], 'gif') == true){
						  echo "<img src='img/$row[file]' class='img-fluid' title='<$row[file]>' />";
						}else {
						  echo "<video class='vid-fluid' controls><source src='img/$row[file]' title='<$row[file]>''/></video>";
						}
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
						<b> <a class='link' href='pgamigo.php?id=$idcomenter'>$com_nome</a> </b>				
						<br>
						<p style='word-break: break-word;'>$com</p>
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
				<input class="comentario mt-2" type="text" name="txcom" id="txcom" maxlength="250" autocomplete=off placeholder="comentar...">
				<span id="alert-com" class="to-hide" role="alert">Digite um comentario...</span>
				<input type="hidden" name="post_id" value="'.$idpost.'">
				<button type="submit" name="comentar" class="btn_comentario">
				<i class="fa-solid fa-square-arrow-up-right"></i>
				</button>';
			echo '
			</form>
			</div>';
		endforeach;
		}
    };

	function ler_dados_grupo($id_grupo, $id_usuario){
			global $pdo;
			$stmt = $pdo->prepare("SELECT * FROM tbgrupos WHERE id_grupo = '$id_grupo'");
			 $stmt->execute();
				foreach($stmt as $row) {
					global $nome_grupo; global $descricao_grupo; global $tipo_grupo; global $adm_grupo;
					global $foto_grupo;
					$nome_grupo = $row['nome_grupo'];
					$descricao_grupo = $row['descricao_grupo'];
					$tipo_grupo = $row['tipo_grupo'];
					$adm_grupo = $row['adm_grupo'];
					$foto_grupo = $row['foto_grupo'];
				}
			if($tipo_grupo == "Privado"){
				$outro_tipo = "Publico";
			}else{
				$outro_tipo = "Privado";
			}

			$stmt2 = $pdo->prepare("SELECT * FROM usuarios INNER JOIN tbgrupos ON usuarios.id = '$adm_grupo'");
			$stmt2->execute();
				foreach($stmt2 as $row2) {
					$nome_adm_grupo = $row2['nome'];
				}
				if ($id_usuario == $adm_grupo){
				echo 
				'<div class="card-fundo pt-1" id="infogrupo">
				<div class="mx-auto pt-3 pb-3" style="width: 90%;">
					<div class="card card-perfil">
						<div class="card-body">
							<div class="d-flex flex-row bd-highlight mb-0">
								<div class="p-2 bd-highlight">
									<img class="float-left img-pfp" src="img/'.$foto_grupo.'" width="150" height="150" title="'.$foto_grupo.'">
									<p class="mb-0" style="font-size: 18px";>
										<b>Grupo:</b>
										<br>'.mb_strimwidth($nome_grupo, 0, 16, "...").'
										<a class="icon-lapis" href="?editar-grupo&id_grupo='.$id_grupo.'&pag=1">
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
										<a class="icon-lapis" href="?editar-grupo&id_grupo='.$id_grupo.'&pag=1">
										<i class="fa-solid fa-pencil"></i>
									</a>
									</p>
									<p class="mb-0" style="font-size: 18px";>
										<b>Descrição:</b>
										<br>'.mb_strimwidth($descricao_grupo, 0, 30, "...").'
										<a class="icon-lapis" href="?editar-grupo&id_grupo='.$id_grupo.'&pag=1">
											<i class="fa-solid fa-pencil"></i>
										</a>
									</p>
									<p class="mb-0" style="font-size: 18px";>
										<b>Criador:</b>
										<br>'.$nome_adm_grupo.'
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
						<form method="POST" action="exec_update_grupo.php" onsubmit="return editarGrupo()" autocomplete="off" enctype="multipart/form-data">
							<div class="d-flex flex-row bd-highlight mb-0">
								<div class="p-2 bd-highlight">
								<div style="position: absolute; display: inline-grid;">
								<label for="pfpgrupo" class="icon-camera1">
									<i class="fa-solid fa-camera"> <input type="file" name="pfpgrupo" id="pfpgrupo" class ="pfp-input" accept=".png, .jpeg, .jpg"></i>
								</label>';

								if($foto_grupo != "grupo.png"){
									echo "
									<a href='exec_remover.php?id_grupo=".$id_grupo."' class='icon-camera2'>
										<i class='fa-regular fa-trash-can'></i>
									</a>";
								}

								echo '
								</div>
								<img id="blah" class="float-left img-pfp" src="img/'.$foto_grupo.'" width="150" height="150" title="'.$foto_grupo.'">
								<p class="mb-0" style="font-size: 18px";>
									<b>Nome:</b><br>
									<input class="textoupdate_nome" type="text" name="nome_grupo" id="nome_grupo" value="'.$nome_grupo.'" maxlength="30">
									<span id="alert-nome_grupo" class="to-hide" role="alert"><br>O nome deve ter no <br> mínimo 3 caracteres</span>
									<input type="hidden" name="id_grupo" value="'.$id_grupo.'">
	                            </p>
								</div>
								<div class="p-2 bd-highlight">
									<h5 class="m-0">
										<b>Editar informações do grupo:</b>
									</h5>
									<p class="mb-0" style="font-size: 18px";>
										<b>Tipo:</b>
										<br>
										<select id="tipo" name="tipo" class="tipo-grupo">
											<option value="'.$tipo_grupo.'"> '.$tipo_grupo.' </option>
											<option value="'.$outro_tipo.'"> '.$outro_tipo.' </option>	
										</select>
									</p>
									<p class="mb-0" style="font-size: 18px";>
										<b>Descrição:</b>
										<br>
										<textarea class="textoupdate_3" type="text" name="descricao_grupo" id="descricao_grupo">'.$descricao_grupo.'</textarea>              
										<span id="alert-descricao_grupo" class="to-hide" role="alert"><br>Digite a descrição do grupo</span>
									</p>
									<p>
										<input type="submit" value="Salvar" class="btn-verde">
										<a href="exec_deleta_grupo.php?id_grupo='.$id_grupo.'" class="btn-cinza">Apagar Grupo</a>
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
											<br>'.$nome_adm_grupo.'
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
			echo "
			<div class='col'>
				<b>{$dados['nome']}</b>";
				verfica_solicitacoes_grupo_procurar($con, $_SESSION['userId'], $id_amigo, $id_grupo);
			echo "
			</div>";
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
			echo "
			<div class='box-solicitation-pesquisa'>
				<div class='card text-center' style='width: 18rem; box-shadow: 0 0 5px #000;'>
					<div class='card-body'>
						<h5 class='card-title mb-3'><b>{$dados['nome']}</b></h5>
						<div class='col'>";
							verfica_solicitacoes_grupo_pggrupo($con, $_SESSION['userId'], $id_amigo, $id_grupo);
							echo "
						</div>
					</div>
				</div>
			</div>";
		}
	}

	function lista_grupo($con, $id_usuario, $id_amigo, $id_grupo){
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
					echo "<a href='?pagina=remover-usuario-grupo&id_grupo={$id_grupo}&id={$dados['id']}' class='btn-cinza'>Remover</a>";
				}

				if($dados['id_adm'] == $id_usuario && $id_amigo == $dados['id_usuario'] && $dados['para'] == $id_amigo && $dados['status'] == 0){
					echo "<a href='?pagina=remover-usuario-grupo&id_grupo={$id_grupo}&id={$dados['id']}' class='btn-cinza'>Cancelar Solicitação</a>";
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
				echo "<a href='?pagina=solicitar-convite-grupo&id_grupo={$id_grupo}&id={$id_amigo}' class='btn-verde'>Convidar</a>";
			}
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
					echo "<a href='javascript: history.go(-1)' class='btn-cinza'>Voltar</a>";
					echo "<a href='?pagina=remover-usuario-grupo&id_grupo={$id_grupo}&id={$dados['id']}' class='btn-verde'>Remover</a>";
				}

				if($dados['id_adm'] == $id_usuario && $id_amigo == $dados['id_usuario'] && $dados['para'] == $id_amigo && $dados['status'] == 0){
					echo "<a href='javascript: history.go(-1)' class='btn-cinza'>Voltar</a>";
					echo "<a href='?pagina=remover-usuario-grupo&id_grupo={$id_grupo}&id={$dados['id']}' class='btn-verde'>Cancelar Solicitação</a>";
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
				echo "<a href='javascript: history.go(-1)' class='btn-cinza'>Voltar</a>";
				echo "<a href='?pagina=solicitar-convite-grupo&id_grupo={$id_grupo}&id={$id_amigo}' class='btn-verde'>Convidar</a>";
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
				echo "<p class='mb-2'>convidou voce para entrar no grupo ";
				echo "<a href='?pag=1&pagina=pesquisa_grupo&nome_grupo={$nome_grupo}''>$nome_grupo</a></p>";
				echo "<a href='?pagina=recusar-solicitacao-grupo&id_grupo={$id_grupo}&id={$dados['id']}' class='btn-cinza'>Recusar</a>";
				echo "<a href='?pagina=aceitar-solicitacao-grupo&id_grupo={$id_grupo}&id_adm={$dados['id_adm']}&id_usuario={$dados['id_usuario']}' class='btn-verde'>Entrar</a>   ";
			}

			if($dados['id_adm'] == $id_usuario && $dados['id_usuario'] == $id_amigo && $dados['para'] == $id_usuario && $dados['status'] == 0){
				echo "<p class='mb-2'>pediu para entrar no grupo ";
				echo "<a href='?pag=1&pagina=pesquisa_grupo&nome_grupo={$nome_grupo}'>$nome_grupo</a></p>";
				echo "<a href='?pagina=recusar-solicitacao-grupo&id_grupo={$id_grupo}&id={$dados['id']}' class='btn-cinza'>Recusar</a>";
				echo "<a href='?pagina=aceitar-solicitacao-grupo&id_grupo={$id_grupo}&id_adm={$dados['id_adm']}&id_usuario={$dados['id_usuario']}' class='btn-verde'>Aceitar</a>";
			}

			if($dados['id_adm'] == $id_amigo && $id_usuario == $dados['id_usuario'] && $dados['para'] == $id_amigo && $dados['status'] == 0){
				echo "<a href='javascript: history.go(-1)' class='btn-cinza'>Voltar</a>";
				echo "<a href='?pagina=remover-usuario-grupo&id_grupo={$id_grupo}&id={$dados['id']}' class='btn-verde'>Cancelar Solicitação</a>";
			}
		}

		else{
			$sql = $con->prepare("SELECT id_grupo, adm_grupo FROM tbgrupos WHERE id_grupo = ?");
			$sql->bind_param("s", $id_grupo);
			$sql->execute();
			$get = $sql->get_result();
			$total = $get->num_rows;
			$dados = $get->fetch_assoc();

			if($total > 0 && $id_usuario != $id_amigo && $dados['adm_grupo'] == $id_amigo && $dados['id_grupo'] == $id_grupo){
				echo "<br>"."<a href='javascript: history.go(-1)' class='btn-cinza'>Voltar</a>";
				echo "<a href='?pagina=solicitar-entrada-grupo&id_grupo={$id_grupo}&id={$id_amigo}' class='btn-verde'> Pedir para entrar</a>";
			}

			if($total > 0 && $id_usuario == $id_amigo && $dados['id_grupo'] == $id_grupo){
				redireciona("pggrupo.php?id_grupo={$id_grupo}&pag=1");
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
			echo "
			<div class='box-solicitation-pesquisa'>
				<div class='card' style='width: 18rem; box-shadow: 0 0 5px #000;'>
					<div class='card-body'>
						<div class='text-center'>
							<img src='img/$foto_grupo' width='84' height='84' title='$foto_grupo'>
							<h5 class='card-title mb-2'><b>".$nome_grupo."</b></h5>
						</div>
						<div class='col'>
							<p>".$tipo_grupo."</p>
							<p class='mb-2'>".mb_strimwidth($desc_grupo, 0, 50, "...")."</p>
							<a href='javascript: history.go(-1)' class='btn-cinza btn-block'>Voltar</a>
						</div>
					</div>
				</div>
			</div>";
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
		if (isset($_GET['grupo-membros'])){
			$red = "pggrupo.php?grupo-membros&id_grupo={$id_grupo}&pag=1";
		}else{
			$red = "pggrupo.php?grupo-posts&id_grupo={$id_grupo}&pag=1";
		}

		if(verifica_membro_convite($con, $_SESSION['userId'], $id_usuario, $id_grupo) <= 0){
			$sql = $con->prepare("INSERT membros_grupos (id_adm, id_usuario, id_grupo, para, status) VALUES (?, ?, ?, ?, ?)");
			$sql->bind_param("sssss", $_SESSION['userId'], $id_usuario, $id_grupo, $id_usuario, $zero);
			$sql->execute();

			if($sql->affected_rows > 0){
				redireciona($red);
			}else{
				return false;
			}
		}else{
			redireciona($red);
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
		if (isset($_GET['grupo-membros'])){
			$red = "pggrupo.php?grupo-membros&id_grupo={$id_grupo}&pag=1";
		}else{
			$red = "pggrupo.php?grupo-posts&id_grupo={$id_grupo}&pag=1";
		}
		if(verifica_membro_solicitacao($con, $id_adm, $_SESSION['userId'], $id_grupo) <= 0){
			$sql = $con->prepare("INSERT membros_grupos (id_adm, id_usuario, id_grupo, para, status) VALUES (?, ?, ?, ?, ?)");
			$sql->bind_param("sssss", $id_adm, $_SESSION['userId'], $id_grupo, $id_adm, $zero);
			$sql->execute();

			if($sql->affected_rows > 0){
				redireciona($red);
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
			redireciona("perfil.php");
		}else{
			return false;
		}
	}

	function remover_usuario_grupo($con, $id_grupo, $id){
		if (isset($_GET['grupo-membros'])){
			$red = "pggrupo.php?grupo-membros&id_grupo={$id_grupo}&pag=1";
		}else{
			$red = "pggrupo.php?grupo-posts&id_grupo={$id_grupo}&pag=1";
		}
		$sql = $con->prepare("DELETE FROM membros_grupos WHERE id = ?");
		$sql->bind_param("s", $id);
		$sql->execute();

		if($sql->affected_rows > 0){
			redireciona($red);
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

	function verifica_membro_solicitacao_publico($con, $id_adm, $id_usuario, $id_grupo){
		$sql = $con->prepare("SELECT * FROM membros_grupos WHERE id_adm = ? AND id_usuario = ? AND id_grupo = ? AND status = 1");
		$sql->bind_param("sss", $id_adm, $id_usuario, $id_grupo);
		$sql->execute();

		return $sql->get_result()->num_rows;
	}

	function entrar_grupo_publico($con, $id_grupo, $id_adm){
		$um = 1;
		if(verifica_membro_solicitacao_publico($con, $id_adm, $_SESSION['userId'], $id_grupo) <= 0){
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
				echo "
				<div class='box-solicitation-pesquisa'>
					<div class='card box-solicitation'>
					<div class='div-lista-amizade'>
					<div class='d-flex bd-highlight'>
					  <div class='p-2 w-100 bd-highlight'>
					  	<h5>Solicitações de Grupos</h5>
					  </div>
					  <div class='p-2 flex-shrink-1 bd-highlight'>
					  	<a href='javascript: history.go(-1)' class='btn-voltar-lista'>Voltar</a>
					  </div>
					</div>
					</div>
					";
					while($dados = $get->fetch_array()){
						echo "<div class='card-body'>";
						if($dados['para'] == $dados['id_adm']){
							get_perfil_grupo_procurar($con, $dados['id_grupo'], $dados['id_usuario']);
						}

						if($dados['para'] == $dados['id_usuario']){
							get_perfil_grupo_procurar($con, $dados['id_grupo'], $dados['id_adm']);
						}
						echo "</div>";
					}
				echo "
					</div>
				</div>";
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

	function get_perfil_usuario($con, $perfil){
		$sql = $con->prepare("SELECT * FROM usuarios WHERE id = ?");
		$sql->bind_param("s", $perfil);
		$sql->execute();
		$get = $sql->get_result();
		$total = $get->num_rows;

		if($total > 0){
			$dados = $get->fetch_assoc();
			echo "
			<div class='box-solicitation-pesquisa'>
				<div class='card text-center' style='width: 18rem; box-shadow: 0 0 5px #000;'>
					<div class='card-body'>
						<h5 class='card-title mb-3'><b>{$dados['nome']}</b></h5>
						<div class='col'>";
							verfica_solicitacoes($con, $_SESSION['userId'], $perfil);
							echo "
						</div>
					</div>
				</div>
			</div>";
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
			echo "
			<div>
				<b>{$dados['nome']}</b>";
				verfica_solicitacoes($con, $_SESSION['userId'], $perfil);
			echo "
			</div>";
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
				echo "<div class='mt-2'>";
				echo"<a href='javascript: history.go(-1)' class='btn-cinza'>Voltar</a>";
				echo "<a href='?pagina=desfazer-amizade&id={$dados['id']}' class='btn-verde'>Desfazer Amizade</a>";
				echo "</div>";
			}

			if($dados['id_para'] == $id_para && $dados['id_de'] == $id_de && $dados['status'] == 0){
				echo "<div class='mt-2'>";
				echo"<a href='javascript: history.go(-1)' class='btn-cinza'>Voltar</a>";
				echo "<a href='?pagina=desfazer-amizade&id={$dados['id']}' class='btn-verde'>Cancelar Solicitação</a>";
				echo "</div>";
			}

			if($dados['id_de'] == $id_para && $dados['id_para'] == $id_de && $dados['status'] == 0){
				echo "<div class='mt-2'>";
				echo "<a href='?pagina=desfazer-amizade&id={$dados['id']}' class='btn-cinza'>Recusar</a>";
				echo "<a href='?pagina=aceitar-amizade&id={$dados['id_de']}' class='btn-verde'>Aceitar</a>";
				echo "</div>";
			}
		}else if($total <= 0  && $id_para != $id_de){
			echo "<div class='mt-2'>";
			echo"<a href='javascript: history.go(-1)' class='btn-cinza'>Voltar</a>";
			echo "<a href='?pagina=solicitar-amizade&id={$id_para}' class='btn-verde'>Adicionar Amigo</a>";
			echo "</div>";
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
				echo "<td><a href='?pagina=desfazer-amizade&id={$dados['id']}' class='btn-cinza'>Desfazer Amizade</a></td>";
			}
		}
	}

	function deleta_solicitacao($con, $id){
		$sql = $con->prepare("DELETE FROM amigos WHERE id = ?");
		$sql->bind_param("s", $id);
		$sql->execute();

		if($sql->affected_rows > 0){
			redireciona("perfil.php");
		}else{
			return false;
		}
	}

	function recusar_solicitacao($con, $id){
		$sql = $con->prepare("DELETE FROM amigos WHERE id = ?");
		$sql->bind_param("s", $id);
		$sql->execute();

		if($sql->affected_rows > 0){
			redireciona("?pagina=solicitacoes&pag=1");
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
				echo "
				<div class='box-solicitation-pesquisa'>
					<div class='card box-solicitation'>
					<div class='div-lista-amizade'>
					<div class='d-flex bd-highlight'>
					  <div class='p-2 w-100 bd-highlight'>
					  	<h5>Solicitações de Amizade</h5>
					  </div>
					  <div class='p-2 flex-shrink-1 bd-highlight'>
					  	<a href='javascript: history.go(-1)' class='btn-voltar-lista'>Voltar</a>
					  </div>
					</div>
					</div>
					";
				while($dados = $get->fetch_array()){
					echo "<div class='card-body'>";
					get_perfil($con, $dados['id_de']);
					echo "</div>";
				}
				echo "
					</div>
				</div>";
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
