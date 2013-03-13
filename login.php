<?php

// verifica se a entrada nesta p�gina
// vem pelo formul�rio correto
if(isset($_POST["acao"])) {

	// realiza a conex�o com a base de dados
//	require("conexao.inc.php");
	// Importando a classe de conexï¿½o
        require_once("db/db.php");
        // Instanciando a classe de conexï¿½o
        $db = new db();
        // Abrindo o banco de dados
        $db->open();

        
	// recebe os valores digitados no formul�rio
	$email = $_POST["login"];
	$senha = $_POST["senha"];
	
	// cria a consulta com as informa��es 
	// recebidas do formul�rio
	// utiliza md5() pois a senha est� criptografada
	// no banco de dados
	$sql = "SELECT nome FROM usuario
			WHERE login='".$email."' AND 
				  senha='".md5($senha)."'";
	
	// atribui a vari�vel a consulta
	$db->query($sql);
        
        
        if ($db->count() == 0){
            $msg = 'usuario ou senha invalido!';
            header("Location: formlogin.php?msg=".$msg);
            return;
        }
        
        
        
	// executa a consulta na base de dados
	$retorno = $db->getItensToArray();
	
	
	// criar a sess�o para o usu�rio
	session_start();
	
	$_SESSION["nomecompleto"] = $retorno['nome']; 
	
	// d = dia 
	// m = m�s
	// y = ano (2 d�gitos) Y = ano (4 d�gitos)
	// h = hora (12 horas) H = hora (24 horas)
	// i = minutos
	// s = segundos
	$_SESSION["datahora"] = date("d/m/Y H:i:s");
	
	// fun��o session_id cria um id �nico
	// para a sess�o ativa
	$_SESSION["id"] = session_id();
	
	header("Location: index.php");

} else {

	echo "Voc� o voc� quer aqui?! :P";

}
?>