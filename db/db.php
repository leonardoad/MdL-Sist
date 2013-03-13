<?php

/*

  Classe para conexão em MySQL

 */
// Report simple running errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);

class db {

    /**
     * nessa variavel vai ficar guardada a consulta executada na funcao query();
     * @var obj 
     */
    var $consulta;
    
    
    /**
     * guarda o objeto de conexao;
     * @var obj 
     */
    var $conn;
    
    
    // Host
    var $host = "localhost";
    // Usuário de conexão
    var $user = "root";
    // Senha para conexão
    var $pass = "";
    // Banco de dados
    var $dbname = "tarefas";

    /**
     *  Função para abrir o banco de dados
     * @return object  
     */
    function open() {

        // conecta o mysql
//        $lConexao = "host=$this->host user=$this->user password=$this->pass dbname=$this->dbname";
//        $conn = @mysql_connect($lConexao) or die("<br><br><center>Problemas ao conectar no servidor:</center>");

        $conn = mysql_connect($this->host, $this->user, $this->pass);
        mysql_select_db($this->dbname, $conn);
        if (!$conn) {
            die('Problemas ao conectar no servidor:' . mysql_error() );
        }
        $this->conn = $conn;
//        return $conn;
    }

    /**
     * Função de fechamendo do banco
     */
    function close() {

        @mysql_close($this->conn);
    }

    /**
     *  Função que executa uma consulta sql
     * @param string $sql 
     */
    function query($sql) {
        
//        $this->consulta = mysql_query($sql,$this->conn);
        $this->consulta = mysql_query($sql,$this->conn) or die(mysql_error());;
        
    }

    /**
     * Função que retorna a quantidade de registros da consulta
     * @return int
     */
    function count() {

        return mysql_num_rows($this->consulta);
    }

    /**
     * Função que retorna a quantidade de registros da consulta
     * 
     * @return array
     */
    function getItensToArray() {
        return mysql_fetch_array($this->consulta);
    }

}

?>