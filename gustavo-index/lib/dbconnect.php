<?php
	$host = 'localhost';
	$usuario = 'root';
	$senha =  '';
	$banco = 'barkanet';

	$con = new mysqli($host, $usuario, $senha, $banco);


	if(mysqli_connect_errno()){
		exit('Erro a o conectar-se ao banco de dados: '.mysqli_connect_error());
	}
?>