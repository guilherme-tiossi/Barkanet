<?php
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

	function carrega_pagina_grupo($con){
		$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 'inicio-grupo';
		$dir = "pags/";
		$ext = ".php";

		if(file_exists($dir.$pagina.$ext)){
			include($dir.$pagina.$ext);
		}else{
			echo "<div>Página não encontrada</div>";
		}
	}

	function get_perfil_grupo($con, $id_grupo, $perfil){
		$sql = $con->prepare("SELECT * FROM usuarios WHERE id = ?");
		$sql->bind_param("s", $perfil);
		$sql->execute();
		$get = $sql->get_result();
		$total = $get->num_rows;
		
		if($total > 0){
			$dados = $get->fetch_assoc();
			echo "<h4>{$dados['nome']}</h4>";
			verfica_solicitacoes_grupo($con, $_SESSION['userId'], $perfil, $id_grupo);
		}
	}

	function verifica_membro($con, $id_adm, $id_usuario){
		$sql = $con->prepare("SELECT * FROM membros_grupos WHERE id_adm = ? AND id_usuario = ? AND status = 0");
		$sql->bind_param("ss", $id_adm, $id_usuario);
		$sql->execute();

		return $sql->get_result()->num_rows;
	}

	function send_solicitation_grupo($con, $id_grupo, $id_usuario){
		$zero = 0;
		if(verifica_membro($con, $_SESSION['userId'], $id_usuario) <= 0){
			$sql = $con->prepare("INSERT membros_grupos (id_adm, id_usuario, id_grupo, status) VALUES (?, ?, ?, ?)");
			$sql->bind_param("ssss", $_SESSION['userId'], $id_usuario, $id_grupo, $zero);
			$sql->execute();

			if($sql->affected_rows > 0){
				redireciona("posts.php?id_grupo={$id_grupo}");
			}else{
				return false;
			}
		}else{
			redireciona("posts.php?id_grupo={$id_grupo}&id={$id_usuario}");
		}
		
	}

	function verfica_solicitacoes_grupo($con, $id_adm, $id_usuario, $id_grupo){		
		$sql = $con->prepare("SELECT * FROM membros_grupos WHERE (id_adm = ? AND id_usuario = ?) OR (id_usuario = ? AND id_adm = ?)");
		$sql->bind_param("ssss", $id_adm, $id_usuario, $id_adm, $id_usuario);
		$sql->execute();
		$get = $sql->get_result();
		$total = $get->num_rows;

		if($total > 0){
			$dados = $get->fetch_assoc();

			if($dados['id_adm'] == $id_adm && $dados['status'] == 1){
				echo "<a href='?pagina=remover-usuario-grupo&id_grupo={$id_grupo}&id={$dados['id']}'>Remover do Grupo</a>";
				echo "<br>";
				echo"<a href='pggrupo.php?id_grupo={$id_grupo}'>Voltar</a>";
			}

			if($dados['id_adm'] == $id_usuario && $dados['status'] == 1){
				echo "<a href='?pagina=remover-grupo&id_grupo={$id_grupo}&id={$dados['id']}'>Sair do Grupo</a>";
				echo "<br>";
				echo"<a href='procurar.php'>Voltar</a>";
			}

			if($dados['id_usuario'] == $id_usuario && $dados['id_adm'] == $id_adm && $dados['status'] == 0){
				echo "<a href='?pagina=remover-usuario-grupo&id_grupo={$id_grupo}&id={$dados['id']}'>Cancelar Convite</a>";
				echo "<br>";
				echo"<a href='pggrupo.php?id_grupo={$id_grupo}'>Voltar</a>";
			}

			if($dados['id_adm'] == $id_usuario && $dados['id_usuario'] == $id_adm && $dados['status'] == 0){
				echo "<a href='?pagina=aceitar-grupo&id_grupo={$id_grupo}&id={$dados['id_adm']}'>Entrar</a>";
				echo "<br>";
				echo "<a href='?pagina=remover-grupo&id_grupo={$id_grupo}&id={$dados['id']}'>Recusar</a>";
				echo "<br>";
				echo"<a href='procurar.php'>Voltar</a>";
			}
		}else if($total <= 0  && $id_usuario != $id_adm){
			echo "<a href='?pagina=solicitar-grupo&id_grupo={$id_grupo}&id={$id_usuario}'>Enviar Convite</a>";
			echo "<br>";
			echo"<a href='pggrupo.php?id_grupo={$id_grupo}'>Voltar</a>";
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
			redireciona("posts.php?id_grupo={$id_grupo}");
		}else{
			return false;
		}
	}

	function aceita_solicitacao_grupo($con, $id_grupo, $id_adm){
		$sql = $con->prepare("SELECT * FROM membros_grupos WHERE id_adm = ? AND id_usuario = ? AND status = 0");
		$sql->bind_param("ss", $id_adm, $_SESSION['userId']);
		$sql->execute();
		$get = $sql->get_result();
		$total = $get->num_rows;

		if($total > 0){
			$dados = $get->fetch_assoc();

			if($dados['id_usuario'] == $_SESSION['userId']){
				if(atualiza_solicitacao_grupo($con, $id_adm, $_SESSION['userId']) > 0){
					redireciona("posts.php?id_grupo={$id_grupo}");	
				}else{
					echo "erro ao atualizar;";
				}
				
			}else{
				return false;
			}
		}
	}

	function atualiza_solicitacao_grupo($con, $id_adm, $id_usuario){
		$sql = $con->prepare("UPDATE membros_grupos SET status = 1 WHERE id_adm = ? AND id_usuario = ?");
		$sql->bind_param("ss", $id_adm, $id_usuario);
		$sql->execute();

		return $sql->affected_rows;
	}

	function solicitacoes_grupo($con){
		if(isset($_SESSION['userId'])){
			$sql = $con->prepare("SELECT * FROM membros_grupos WHERE id_usuario = ? AND status = 0");
			$sql->bind_param("s", $_SESSION['userId']);
			$sql->execute();
			$get = $sql->get_result();
			$total = $get->num_rows;

			if($total > 0){
				while($dados = $get->fetch_array()){
					get_perfil_grupo($con, $dados['id_grupo'], $dados['id_adm']);
				}
			}
		}else{
			exit();
		}
	}

	function return_total_solicitation_grupo($con){
		$sql = $con->prepare("SELECT * FROM membros_grupos WHERE id_usuario = ? AND status = 0");
		$sql->bind_param("s", $_SESSION['userId']);
		$sql->execute();
		$get = $sql->get_result();
		$total = $get->num_rows;
		if($total > 0){
			return " ".$total;
		}
	}























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

	function get_users($con){
		$sql = $con->prepare("SELECT * FROM usuarios ORDER BY id DESC");
		$sql->execute();
		$get = $sql->get_result();
		$total = $get->num_rows;

		if($total > 0){
			while($dados = $get->fetch_array()){
				echo "<a href='?pagina=perfil&id={$dados['email']}'>{$dados['nome']}</a><br>";
			}
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
			echo "<h4>{$dados['nome']}</h4>";
			verfica_solicitacoes($con, $_SESSION['userId'], $perfil);
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


	function ler_dados_usuario($email, $pdo)
	{   global $pdo;
		$stmt = $pdo->prepare("select * from usuarios where email = '$email'");
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
		'<div class="card-fundo mx-auto pt-1" style="width: 50%;">
		<div class="mx-auto pt-3 pb-3" style="width: 90%;">
            <div class="card card-perfil">
                <div class="card-body">
                    <div class="d-flex flex-row bd-highlight mb-0">
                        <div class="p-2 bd-highlight">
                            <img class="float-left" src="img/'.$pfp.'" width="150" height="150" title="'.$pfp.'">
                            <p class="mb-0" style="font-size: 18px";>
                                <b>Nome:</b>
                                <br>'.$nome.'
                                <a href="update-name.php?id='.$row["id"].'" class="icon-lapis">
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
                                <br>'.$bio.'
                                <a href="update-bio.php?id='.$row["id"].'" class="icon-lapis">
						            <i class="fa-solid fa-pencil"></i>
						        </a>
                            </p>
                            <p class="mb-0" style="font-size: 18px";>
                                <b>Data de nascimento:</b>
                                <br>'.$nasc.'
                                <a href="update-date.php?id='.$row["id"].'" class="icon-lapis">
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
        </div>';
		};
	?>