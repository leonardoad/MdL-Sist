<?php
	// iniciar sessão
	session_start();
	
	// verifica se a sessão está ativa
	// se não estiver direciona para o
	// formulário de login
	if(!isset($_SESSION["id"])) {
		session_destroy();
		header("Location: formlogin.php");
	}
?>