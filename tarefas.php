<?php

function formataData($data) {
    
    $list = explode('-', $data);
    if(count($list)==3){
        if(count($list[0])==2)
            return implode ('/', $list);
        else
            return $list[2].'/'.$list[1].'/'.$list[0];
    }else{
        $list = explode('/', $data);
        if(count($list[0])==4)
            return implode ('-', $list);
        else
            return $list[2].'-'.$list[1].'-'.$list[0];
    }
    
    
}
// Importando a classe de conexï¿½o
require_once("db/db.php");
// Instanciando a classe de conexï¿½o
$db = new db();
// Abrindo o banco de dados
$db->open();

if ($_POST['mostrarTodos'] == 'S') {

    $sql = "SELECT * FROM tarefas ";
} else
if ($_POST['editDesc'] == 'S') {
    $sql = "UPDATE tarefas set descricao = '" . $_POST['descricao'] . "' where id = " . $_POST['id'];
    $db->query($sql);

    $sql = "SELECT * FROM tarefas WHERE ativo='S' ";
} else
if ($_POST['iniciar'] == 'S') {
    $sql = "UPDATE tarefas set datainicio = '" . date('Y-m-d H:i:s') . "' where id = " . $_POST['id'];
    $db->query($sql);

    $sql = "SELECT * FROM tarefas WHERE ativo='S' ";
} else
if ($_POST['completo'] == 'S') {
    $sql = "UPDATE tarefas set completo = 'S' , datafim = '" . date('Y-m-d H:i:s') . "' where id = " . $_POST['id'];
    $db->query($sql);

    $sql = "SELECT * FROM tarefas WHERE ativo='S' ";
} else
if ($_POST['desativa'] == 'S') {
    $sql = "UPDATE tarefas set ativo = 'N' where id = " . $_POST['id'];
    $db->query($sql);

    $sql = "SELECT * FROM tarefas WHERE ativo='S' ";
} else
if ($_POST['cadastra'] == 'S') {
    $sql = "INSERT INTO tarefas (descricao,tempo,datacadastro,ativo,completo)
        values('" . htmlspecialchars($_POST['descricao']) . "', '" . $_POST['tempo'] . "','" . date('Y-m-d') . "','S','N')";
    $db->query($sql);

    $sql = "SELECT * FROM tarefas WHERE ativo='S'";
} else {

    // Select, trazendo os dados da tabela de Cliente. O cï¿½digo $_POST['nome'] contï¿½m o valor da busca
    $sql = "SELECT * FROM tarefas WHERE ativo='S' and descricao LIKE '%" . $_POST['descricao'] . "%' ";
}

// Executa o sql
$db->query($sql);
// Verificando se hï¿½ registros
 

if ($db->count()) {
    header("Content-type: application/xml");
    $xml = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?>";
    $xml.="<dados>";
// Definindo as colunas da tabela de listagem dos registros
//    $xml.= "<cabecalho>";
//    $xml.= "<coluna>Desativar </coluna>";
//    $xml.= "<coluna>Completo </coluna>";
//    $xml.= "<coluna>Iniciar</coluna>";
//    $xml.= "<coluna>DescriÃ§Ã£o </coluna>";
////    $xml.= "<coluna>Data Cadastro </coluna>";
//    $xml.= "<coluna>Tempo Tï¿½rmino </coluna>";
//    $xml.= "<coluna>Data Inicio </coluna>";
//    $xml.= "<coluna>Data Fim</coluna>";
////    $xml.= "<coluna>Duraï¿½ï¿½o</coluna>";
//    $xml.= "</cabecalho>";
    // Montando o XML com os registros do banco
    // Montando o corpo da tabela

    while ($dados = $db->getItensToArray()) {
        $xml.="<registro>";
        $xml.= "<item>" . $dados['id'] . "</item>";
        $xml.= "<item>" . $dados['completo'] . "</item>";
        $xml.= "<item>" . $dados['descricao'] . "</item>";
        $xml.= "<item>" . $dados['tempo'] . "</item>";
        $xml.= "<item>" . formataData($dados['datainicio']) . "</item>";
        $xml.= "<item>" . $dados['datafim'] . "</item>";
        $xml.="</registro>";
    }
//fim da tabela
    $xml.="</dados>";
}

// Retornando o XML com os registros do banco
echo $xml;
// Fechando o banco
$db->close();

exit();
?>