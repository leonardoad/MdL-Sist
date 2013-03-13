<?php

// verifica se a sessão está ativa
require("verifica.inc.php");

// destroi a sessão ativa do usuário
session_destroy();

// direciona para uma página específica
header("Location: formlogin.php");

?>