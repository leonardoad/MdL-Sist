<?php
    // utiliza o include para
	// verificar se existe uma sessão ativa
	require("verifica.inc.php");

?>

<html>
    <head>
        <title>Listagem de Tarefas</title>
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!--         <script type="text/javascript" src="js/jquery.js"></script> -->
        <!-- Importando a biblioteca javascript  -->
        <script language="javascript" src="js/tarefas.js"></script>
        <!-- Importando a biblioteca javascript Prototype 
-->        <script language="javascript" src="js/prototype.js"></script> 

        
    </head>
    <!-- Na inicialização da página é executada a função createGrid.
    Essa função cria a tabela de listagem com os dados do banco -->
    <body  onLoad="javascript:createGrid();">
<!--    <body  >-->
        <div class="conteiner">
            <!-- Imagem de animação do processamento -->
            <div id="loader" ></div>

            <div class="cabecalho">
                <div id="logo"></div>
                <div id="usuario_logado">Ol&aacute; <?php echo $_SESSION['nomecompleto'];?>, seja bem vindo! | <a href="logout.php">Logout</a></div>
            </div>
            <div>
                <form action="" method="post">
                    <fieldset >
                        <legend>Adicionar Tarefa</legend>
                        <label for="pesq_descricao">Descrição: </label><input type="text" style="width: 400px" id="pesq_descricao" onKeyUp="javascript: pesquisar();">
                        <label for="pesq_tempo">Tempo:</label> <input type="text" style="width: 50px"id="pesq_tempo" > Hs
                        <input type="button" name="Button" value="Cadastrar" onClick="cadastrar();">
                        <input type="button" name="Button" value="MostrarTodos" onClick="mostrarTodos();">
                        <!--<input type="button" name="Button" value="Buscar" onClick="javascript:pesquisar();">-->
                    </fieldset>
                </form>
            </div>
            <h3 class="titulo">tarefas</h3>
            <!-- Camada onde será mostrada a tabela de listagem -->
            
            <div id="listagem">lista</div>
        </div>
        <div class="footer"><p>Todos os direitos reservados - Leonardo Danieli - leonardo.danieli@gmail.com</p></div>
    </body>
</html>