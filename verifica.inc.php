<?php
	// iniciar sess�o
	session_start();
	
	// verifica se a sess�o est� ativa
	// se n�o estiver direciona para o
	// formul�rio de login
	if(!isset($_SESSION["id"])) {
		session_destroy();
		header("Location: formlogin.php");
	}
?>