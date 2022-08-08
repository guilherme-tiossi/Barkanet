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
			'<div class="mx-auto pt-3 pb-3" style="width: 90%;">
	            <div class="card card-perfil">
	                <div class="card-body">
	                    <div class="d-flex flex-row bd-highlight mb-0">
	                        <div class="p-2 bd-highlight">
	                            <img class="float-left" src="img/'.$pfp.'" width="150" height="150" title="'.$pfp.'">
	                            <p class="mb-0" style="font-size: 18px";>
	                                <b>Nome:</b>
	                                <br>'.$nome.'
	                                <a href="update.php'.'" class="icon-lapis">
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
	                                <a href="update.php'.'" class="icon-lapis">
							            <i class="fa-solid fa-pencil"></i>
							        </a>
	                            </p>
	                            <p class="mb-0" style="font-size: 18px";>
	                                <b>Data de nascimento:</b>
	                                <br>'.$nasc.'
	                                <a href="update.php'.'" class="icon-lapis">
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
	        </div>';
			};

	function ler_amigos_usuario(){
		global $pdo;
		$stmt2 = $pdo->prepare("select * from amigos where (id_de = {$_SESSION['userId']} and status = '1') or (id_para = {$_SESSION['userId']} and status = '1')");
        $stmt2 ->execute();
		
        foreach ($stmt2 as $row) :
          $id_para = $row['id_para'];
          $id_de = $row['id_de'];
          if($id_para == $_SESSION['userId']){
            $stmt3 = $pdo->prepare("select profilepic from usuarios where id = '$id_de'");
            $stmt3 ->execute();
            foreach ($stmt3 as $row):
			echo "
				<img class='float-left' src='img/" . $row["profilepic"] . "' width='64' height='64' title='foto'>
				";
              echo "<br>";
            endforeach;
          }

          if($id_de == $_SESSION['userId']){
            $stmt3 = $pdo->prepare("select profilepic from usuarios where id = '$id_para'");
            $stmt3 ->execute();
            foreach ($stmt3 as $row):
				echo "
				<img class='float-left' src='img/" . $row["profilepic"] .  "' width='64' height='64' title='foto'>
				";
              echo "<br>";
            endforeach;
          }
        endforeach; 	
	}

    function ler_posts_usuario(){
        global $pdo;
        global $id;
        global $pfp;
//        $stmt = $pdo->prepare("SELECT * FROM tbposts WHERE (usuario = '$id')  ORDER BY idpost DESC");
		$stmt=$pdo->prepare("SELECT * FROM tbposts WHERE (usuario = '$id') ORDER BY idpost DESC");
        $stmt ->execute();
		echo '<h2 class="p-3">Meus posts</h2>';
        foreach ($stmt as $row) :
        echo "<div class='mx-auto' style='width: 80%;'>
                <!--post-->
                <div class='mt-3 card-posts'>
                <div class='card-body'>
                    <div class='d-flex flex-row bd-highlight mb-0'>
                        <div class='p-2 bd-highlight'>
                            <img class='float-left' src='img/$pfp' width='64' height='64' title='foto'>
                        </div>
                        <div class='p-2 bd-highlight'>
                            <p class='mb-0' style='font-size: 18px';>";
                                if($row['idgrupo'] > 0){
                                $stmt = $pdo->prepare("SELECT tbgrupos.nome_grupo, tbgrupos.id_grupo from tbposts JOIN tbgrupos ON tbposts.idgrupo = tbgrupos.id_grupo WHERE usuario = '$id' AND idpost = $row[idpost]");
                                $stmt->execute();
								foreach($stmt as $roww):
                              	$id_grupo = $roww['id_grupo'];
							    echo "<a href='pggrupo.php?id_grupo=$id_grupo'>" . $roww['nome_grupo']. "</a>
								<br>";
								endforeach; 	
								}
								$idposter = $row['usuario'];
								echo "<b> <a href='pgamigo.php?id=$idposter'>" . $row['nome'] . "</a> </b>
								<br>
								<b> $row[titulo]</b>
                            </p>
                        </div>
                    </div>
                    <p class='m-1'> $row[post]</p>
                    <div class='mx-auto m-1//' style='width: 80%;'>";
                        if ($row['image'] != null){
                        echo "<img src='img/$row[image]' class='img-fluid' title='<$row[image]>' />";}
                        echo "</div></div>";

            //comentários
            $swor = $pdo->prepare("SELECT * FROM comentarios WHERE id_post = '{$row['idpost']}'");
            $swor->execute();
            foreach ($swor as $swo) :
            echo "<br>
            <div class='d-flex flex-row bd-highlight mb-0'>
                <div class='p-2 bd-highlight'>
                    <img class='float-left' src='img/" . $swo['profilepic'] . "' width='50' height='50' title='foto'>
                </div>
                <div class='p-2 bd-highlight'>
                    <p class='mb-0' style='font-size: 17px';>";
					$idcomenter = $swo['com_user'];
					echo "
					    <a href='pgamigo.php?id=$idcomenter'> $swo[com_nome] </a>				
                        <br>
						$swo[comentario]
                        </p> </div> </div>";
                endforeach;
            echo '     <br>
            <h5>Publicar seu Comentario</h5>
            <form action="exec_com.php"  method="post">
              <label for="txcom">Comentario:</label>
              <input type="text" name="txcom" id="txcom" maxlength="100">
              <span id="alert-com" class="to-hide" role="alert">Digite um comentario...</span>
              <br>
              <input type="hidden" name="post_id" value=';  echo $row["idpost"];  echo ' 
              <input type="submit" name="comentar" value="Enviar">
            </form> </div> </div>';
            endforeach;
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

	function get_perfil_grupo($con, $id_grupo, $perfil){
		$sql = $con->prepare("SELECT * FROM usuarios WHERE id = ?");
		$sql->bind_param("s", $perfil);
		$sql->execute();
		$get = $sql->get_result();
		$total = $get->num_rows;
		
		if($total > 0){
			$dados = $get->fetch_assoc();
			echo "<b>{$dados['nome']}</b>";
			verfica_solicitacoes_grupo($con, $_SESSION['userId'], $perfil, $id_grupo);
		}
	}

	function verfica_solicitacoes_grupo($con, $id_adm, $id_usuario, $id_grupo){
		//CONSULTA NOME DO GRUPO...

		$sql = $con->prepare("SELECT * FROM membros_grupos WHERE (id_adm = ? AND id_usuario = ? AND id_grupo = ?) OR (id_adm = ? AND id_usuario = ? AND id_grupo = ?)");
		$sql->bind_param("ssssss", $id_adm, $id_usuario, $_GET['id_grupo'], $id_usuario, $id_adm, $_GET['id_grupo']);
		$sql->execute();
		$get = $sql->get_result();
		$total = $get->num_rows;
		
		if($total > 0){
			$dados = $get->fetch_assoc();
			//CONSULTA DE ADMINISTRADOR
			$sql = $con->prepare("SELECT * FROM membros_grupos WHERE id_adm = ? AND id_usuario = ? AND id_grupo = ?");
			$sql->bind_param("sss", $id_adm, $id_usuario, $_GET['id_grupo']);
			$sql->execute();
			$get = $sql->get_result();
			$total = $get->num_rows;

			if($total > 0){
				$dados = $get->fetch_assoc();

				if($dados['id_adm'] == $id_adm && $dados['id_usuario'] != $id_adm && $dados['status'] == 1){
					echo "<a href='?pagina=remover-usuario-grupo&id_grupo={$id_grupo}&id={$dados['id']}'> Remover</a>";
					echo "<br>";
					echo"<a href='pggrupo.php?id_grupo={$id_grupo}'>Voltar</a>";
				}

				if($dados['id_adm'] == $id_adm && $id_usuario == $dados['id_usuario'] && $dados['para'] == $id_usuario && $dados['status'] == 0){
					echo "<a href='?pagina=remover-usuario-grupo&id_grupo={$id_grupo}&id={$dados['id']}'> Cancelar Solicitação</a>";
					echo "<br>";
					echo"<a href='pggrupo.php?id_grupo={$id_grupo}'>Voltar</a>";
				}

				if($dados['id_adm'] == $id_adm && $id_usuario == $dados['id_usuario'] && $dados['para'] == $id_adm && $dados['status'] == 0){
					echo " pediu para entrar no grupo: ";
					echo "<a href='?pagina=aceitar-solicitacao-grupo&id_grupo={$id_grupo}&id_adm={$dados['id_adm']}&id_usuario={$dados['id_usuario']}'>Aceitar</a>";
					echo "<br>";
					echo"<a href='pggrupo.php?id_grupo={$id_grupo}'>Voltar</a>";
				}
			}
		}else{
			$sql = $con->prepare("SELECT * FROM membros_grupos WHERE (id_adm = ? AND id_usuario = ?) OR (id_adm = ? AND id_usuario = ?)");
			$sql->bind_param("ssss", $id_adm, $id_usuario, $id_usuario, $id_adm);
			$sql->execute();
			$get = $sql->get_result();
			$total = $get->num_rows;
			
			if($total > 0){
				//CONSULTA DE USUARIO
				$sql = $con->prepare("SELECT * FROM membros_grupos WHERE id_adm = ? AND id_usuario = ?");
				$sql->bind_param("ss", $id_usuario, $id_adm);
				$sql->execute();
				$get = $sql->get_result();
				$total = $get->num_rows;

				if($total > 0){
					$dados = $get->fetch_assoc();

					if($dados['id_adm'] == $id_usuario && $dados['id_usuario'] == $id_adm && $dados['para'] == $id_adm && $dados['status'] == 0 && $id_grupo == $dados['id_grupo']){
						echo " convidou voce para entrar no grupo: ";
						echo "<a href='?pagina=aceitar-solicitacao-grupo&id_grupo={$id_grupo}&id_adm={$dados['id_adm']}&id_usuario={$dados['id_usuario']}'> Entrar</a>   ";
						echo "<a href='?pagina=recusar-solicitacao-grupo&id_grupo={$id_grupo}&id={$dados['id']}'>Recusar</a>";
						echo "<br>";
						echo"<a href='procurar.php'>Voltar</a>";
					}
				}
			}else{
				$sql = $con->prepare("SELECT adm_grupo FROM tbgrupos WHERE id_grupo = ?");
				$sql->bind_param("s", $id_grupo);
				$sql->execute();
				$get = $sql->get_result();
				$total = $get->num_rows;
				$dados = $get->fetch_assoc();
				
				if($total > 0  && $dados['adm_grupo'] == $id_adm){
					echo "<a href='?pagina=solicitar-convite-grupo&id_grupo={$id_grupo}&id={$id_usuario}'> Convidar</a>";
					echo "<br>";
					echo"<a href='pggrupo.php?id_grupo={$id_grupo}'>Voltar</a>";
				}

				if($total > 0 && $dados['adm_grupo'] == $id_usuario){
					echo "<a href='?pagina=solicitar-entrada-grupo&id_grupo={$id_grupo}&id={$id_usuario}'> Pedir para entrar</a>";
					echo "<br>";
					echo"<a href='procurar.php'>Voltar</a>";
				}
			}
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

	function verifica_membro_solicitacao($con, $id_adm, $id_usuario){
		$sql = $con->prepare("SELECT * FROM membros_grupos WHERE id_adm = ? AND id_usuario = ? AND status = 0");
		$sql->bind_param("ss", $id_adm, $id_usuario);
		$sql->execute();

		return $sql->get_result()->num_rows;
	}

	function send_solicitacion_grupo($con, $id_grupo, $id_adm){
		$zero = 0;
		if(verifica_membro_solicitacao($con, $id_adm, $_SESSION['userId']) <= 0){
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
		$sql = $con->prepare("SELECT * FROM membros_grupos WHERE id_adm = ? AND id_usuario = ? AND status = 0");
		$sql->bind_param("ss", $id_adm, $id_usuario);
		$sql->execute();
		$get = $sql->get_result();
		$total = $get->num_rows;

		if($total > 0){
			$dados = $get->fetch_assoc();
				echo "passou 1";
				if(atualiza_solicitacao_grupo($con, $id_adm, $id_usuario) > 0){
					redireciona("pggrupo.php?id_grupo={$id_grupo}");	
				}else{
					echo "erro ao atualizar;";
				}
				
		}else{
			return false;
		}
	}

	function atualiza_solicitacao_grupo($con, $id_adm, $id_usuario){
		$sql = $con->prepare("UPDATE membros_grupos SET status = 1 WHERE id_adm = ? AND id_usuario = ?");
		$sql->bind_param("ss", $id_adm, $id_usuario);
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
						get_perfil_grupo($con, $dados['id_grupo'], $dados['id_usuario']);
					}

					if($dados['para'] == $dados['id_usuario']){
						get_perfil_grupo($con, $dados['id_grupo'], $dados['id_adm']);
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
