<?php

// verifica se a sess�o est� ativa
require("verifica.inc.php");

// destroi a sess�o ativa do usu�rio
session_destroy();

// direciona para uma p�gina espec�fica
header("Location: formlogin.php");

?>