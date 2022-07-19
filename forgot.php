<?php 
session_start();
$error = array();
require "mail.php";
include "conexao.php";
	$mode = "enter_email";
	if(isset($_GET['mode'])){
		$mode = $_GET['mode'];
	}
	if(count($_POST) > 0){
		switch ($mode) {
			case 'enter_email':
				$email = $_POST['email'];
				if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					$error[] = "Insira um email válido";
				}elseif(!valid_email($email)){
					$error[] = "O email não foi encontrado";
				}else{
					$_SESSION['forgot']['email'] = $email;
					send_email($email);
					header("Location: forgot.php?mode=enter_code");
					die;
				}
				break;
			case 'enter_code':
				$code = $_POST['code'];
				$result = is_code_correct($code);

				if($result == "O código está correto"){

					$_SESSION['forgot']['code'] = $code;
					header("Location: forgot.php?mode=enter_password");
					die;
				}else{
					$error[] = $result;
				}
				break;
			case 'enter_password':
				$password = $_POST['password'];
				$password2 = $_POST['password2'];
				if($password !== $password2){
					$error[] = "As senhas não conferem. Tente outra vez";
				}elseif(!isset($_SESSION['forgot']['email']) || !isset($_SESSION['forgot']['code'])){
					header("Location: forgot.php");
					die;
				}else{
					save_password($password);
					if(isset($_SESSION['forgot'])){
						unset($_SESSION['forgot']);
					}
					header("Location: login.php");
					die;
				}
				break;
			default:
				break;
		}
	}
	function send_email($email){
		global $pdo;
		$expire = time() + (60 * 1);
		$code = rand(10000,99999);
		$email = addslashes($email);
		$stmt = $pdo->prepare("INSERT INTO codes (email,code,expire) value ('$email','$code','$expire')");
		$stmt ->execute();
		send_mail($email,'Redefinir senha',"O seu código é: " . $code);
	}
	function save_password($password){
		global $pdo;
		$email = addslashes($_SESSION['forgot']['email']);
		$stmt = $pdo->prepare("UPDATE usuarios SET senha = '$password' WHERE email = '$email' LIMIT 1");
		$stmt ->execute();
	}
	function valid_email($email){
		global $pdo;
		$email = addslashes($email);
		$stmt = $pdo->prepare("select * from usuarios where email = '$email'");
		$stmt ->execute();

		if($stmt){
			if($stmt->rowCount() > 0)
			{
				return true;
 			}
		}
		return false;
	}
	function is_code_correct($code){
		global $pdo;
		$code = addslashes($code);
		$expire = time();
		$email = addslashes($_SESSION['forgot']['email']);
		$stmt = $pdo->prepare("select * from codes where code = '$code' && email = '$email' order by id desc limit 1");
		echo $code . $email;
		$stmt -> execute();
		if($stmt){
			if($stmt->rowCount() > 0)
			{
				$row = ($stmt->fetch(PDO::FETCH_ASSOC));
				if($row['expire'] > $expire){

					return "O código está correto";
				}else{
					return "O código expirou";
				}
			}else{
				return "O código está incorreto";
			}
		}
		return "O código está incorreto";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Esqueci minha senha</title>
</head>
<body>
		<?php 
			switch ($mode) {
				case 'enter_email':
					?>
						<form method="post" action="forgot.php?mode=enter_email"> 
							<h1>Esqueci minha senha</h1>
							<h3>Digite o seu e-mail abaixo:</h3>
							<span>
							<?php 
								foreach ($error as $err) {
									echo $err . "<br>";
								}
							?>
							</span>
							<input class="textbox" type="email" name="email" placeholder="Email"><br>
							<br>
							<input type="submit" value="Prosseguir">
							<br><br>
							<div><a href="login.php">Login</a></div>
						</form>
					<?php				
					break;
				case 'enter_code':
					?>
						<form method="post" action="forgot.php?mode=enter_code"> 
							<h1>Esqueci minha senha</h1>
							<h3>Insira o código enviado para o seu email</h3>
							<span>
							<?php 
								foreach ($error as $err) {
									echo $err . "<br>";
								}
							?>
							</span>
							<input class="textbox" type="text" name="code" placeholder="Insira o código"><br>
							<br>
							<input type="submit" value="Prosseguir">
							<a href="forgot.php">
								<input type="button" value="Voltar">
							</a>
							<br><br>
							<div><a href="login.php">Login</a></div>
						</form>
					<?php
					break;
				case 'enter_password':
					?>
						<form method="post" action="forgot.php?mode=enter_password"> 
							<h1>Redefinir senha</h1>
							<h3>Insira a sua nova senha</h3>
							<span>
							<?php 
								foreach ($error as $err) {
									echo $err . "<br>";
								}
							?>
							</span>
							<input class="textbox" type="password" name="password" placeholder="Senha"><br>
							<input class="textbox" type="password" name="password2" placeholder="Confirme a senha"><br>
							<br>
							<input type="submit" value="Prosseguir">
							<a href="forgot.php">
								<input type="button" value="Voltar">
							</a>
							<br><br>
							<div><a href="login.php">Login</a></div>
						</form>
					<?php
					break;
				default:
					break;
			}

		?>
</body>
</html>