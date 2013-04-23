<?php

/**
 * Classe para manipulação dos objetos
 * 
 * @version 19/03/2013
 * @author Ismael Sleifer <ismael@gmail.com.br>
 * @author Leonardo Danieli <leonardo@4coffee.com.br>
 * 
 */
class Db_Table extends Zend_Db_Table {

    /**
     * Colunas a serem buscadas na consulta sql
     */
    protected $_columns = '';

    /**
     * Adiciona a consulta a uma view em vez de uma tabela mas pode ser passado uma outra tabela
     */
    protected $_view;

    /**
     * Lista de filtros "where" da consulta
     */
    protected $_whereSelect = array();
    protected $_filters = array();

    /**
     * Lista de junções "joins" da consulta
     */
    protected $_joins = array();
    protected $_havings = array();

    /**
     * Agrupamaneto das linhas
     */
    protected $_group = false;

    /**
     * Lista de ordenação ASC/DESC
     */
    protected $_sortOrder;
    /*
     * numero de linhas a serem retornadas na consulta
     */
    protected $_limit = 0;

    /**
     * numero da pagina para consulta
     */
    protected $_offset = 0;

    /**
     * Lista de classes buscadas na consulta
     */
    protected $_list;

    /**
     * Lista de classes que sera incluida no leitura do objeto pai,
     * deve ser passado um array com o nome da classe e campo do id que serão listadas,
     * para cada classe será executada a função classList, buscando todos os campos da classe
     * caso queira uma consulta especifica, implementar a função classList no modelo
     *
     * ex: array(array('name'=>User, 'id'=>id_user))
     */
    protected $_classList = array();

    /**
     * Ativa ou desativa a leitura da lista de objetos dependentes.
     * Usados para a leitura dos dados aprensados no grid para evitar a demora na apresentação.
     * o proprio grid ja seta para false esta opção
     */
    protected $_readList = true;

    /**
     * estado do objeto se e cCREATE, cUPDATE ou cDELETE
     */
    protected $_state = cCREATE;

    /**
     * id do objeto pai da classe
     */
    protected $_owner = '';

    /**
     * ativa o log para todas as classes filhas
     */
    protected $_log_ativo = cLOG_ATIVA;

    /**
     * Habilita ou desabilita a formatação dos valores lidos do banco,
     * no banco de dados os valores estão salvos no formato html, mas quando e lido os valores para colocar no campos de texto aparece os
     * valores em html e usado para corrigir isso a função Format_String::htmlToString();, mas na comparação dos dados do log ela não pode
     * ser usada, pois quando os dados vem pelo post o sistema trata os dados para evitar SQL Injection ou funções javaScript
     */
    protected $_formatData = true;

    /**
     * Nome do campo de que sera pego o texto para gravar o log
     *
     * obs: sempre informar este campo nos modelos, so não e preciso se for a_descricao
     * ex: a_descricao
     */
    protected $_log_info = 'a_descricao';

    /**
     * texto utilizado no log para delete ou insert
     * ex: $_log_text = 'Usúario' - log: Deletado Usúario Ismael.....
     */
    protected $_log_text = '';

    /**
     * Atributo que contem o texto que será usado na criação do log.
     * Este atributo e preenchido com um dos campos do banco de dados na função read, usando junto o atributo $_log_info
     * para saber qual campos pegar o texto.
     * @var String
     */
    protected $_text_log = '';

    /**
     * configura a leitura do total de itens da tabela
     * por padrão ele não busca o total de linhas da tabela
     * @var Bool;
     */
    protected $_readCount = true;
    protected $_removeJoin = false;

    public function setTextLog($text) {
        $this->_text_log = $text;
    }

    public function getTextLog() {
        return $this->_text_log;
    }

    public function setRemoveJoin() {
        $this->_removeJoin = true;
    }

    public function setReadCount() {
        $this->_readCount = true;
    }

    public function setDataFromRequest($post) {
        
    }

    /*
     *
     * === Metodo que implementa todos os GET/SET da classe =====
     *
     * @author Leonardo
     * @date 20-09-2009
     *
     */

    public function __call($metodo, $parametros) {

        // se for set*, "seta" um valor para a propriedade
        if (substr($metodo, 0, 3) == 'set') {
            $var1 = strtolower(substr($metodo, 3));
            $var = 'a_' . $var1;
            //            if (!property_exists($this, $var)) {
            //               die('Método--> set' . $var1 . '() não existe em ' . get_class($this));
            //            }else
            $this->$var = Format_String::htmlToString(trim($parametros[0]));
        }
        // se for get*, retorna o valor da propriedade
        elseif (substr($metodo, 0, 3) == 'get') {
            $var1 = strtolower(substr($metodo, 3));
            $var = 'a_' . $var1;
            if (!property_exists($this, $var)) {
                //                        die('Método--> get' . $var1 . '() não existe em ' . get_class($this));
                //				throw new Zend_Db_Table_Exception("Há propriedade \"$var\" não existe ou não foi setada na classe ".get_class($this));
            } else {
                return $this->$var;
            }
        }
    }

    /**
     * Adiciona um objeto na memoria
     *
     * @param string $nome
     */
    public function setInstance($nome) {
        $session = Zend_Registry::get('session');
        $session->$nome = serialize($this);
        Zend_Registry::set('session', $session);
    }

    /**
     * Retorna um objeto da memoria
     *
     * @param string $nome
     * @return object
     */
    static function getInstance($nome) {
        $session = Zend_Registry::get('session');
        return unserialize($session->$nome);
    }

    /**
     * Seta a id no proprio o objeto na propriedade a_id ....
     * @param $id
     */
    public function setID($id) {
        $primary = 'a_' . $this->getPrimaryName();
        $this->$primary = $id;
    }

    public function getID() {
        $primary = 'a_' . $this->getPrimaryName();
        if (isset($this->$primary)) {
            return $this->$primary;
        }
    }

    public function setOwner($id) {
        $this->_owner = $id;
    }

    public function getOwner() {
        return $this->_owner;
    }

    public static function getOptionList($keyName, $valueName, $class, $firstEmpty = true) {
        if ($firstEmpty) {
            $return[] = array('key' => '-1', 'value' => '---');
        }

        if (is_object($class)) {
            $lista = $class->readLst('array');
        } else if ($class != '') {
            $item = new $class;
            $item->sortOrder($valueName);
            $lista = $item->readLst('array');
        } else {
            throw new Zend_Db_Table_Exception('Deve ser passado um objeto ou um nome de modelo');
        }

        unset($lista['totalItens']);

        foreach ($lista as $litem) {
            $return[] = array('key' => $litem[$keyName], 'value' => $litem[$valueName]);
        }
        if ($return == '') {
            $return = array();
        }
        return $return;
    }

    /**
     * Retorna o nome da chave primaria da tabela
     *
     * @return string
     */
    public function getPrimaryName() {
        if (is_array($this->_primary)) {
            $PrimaryKey = $this->_primary[1];
        } else {
            $PrimaryKey = $this->_primary;
        }
        return $PrimaryKey;
    }

    /**
     * Muda o estado do objeto para novo, atualizar ou deletar
     * @param $state  cCREATE, cUPDATE ou cDELETE 
     */
    public function setState($state) {
        $this->_state = $state;
    }

    /**
     * Retorna o estado do objeto se ele e para novo, atualizar ou deletar
     * @return integer
     */
    public function getState() {
        return $this->_state;
    }

    /**
     * seta o objeto como deletado para ser deletado no save do objeto
     */
    public function setDeleted() {
        $this->_state = cDELETE;
    }

    /**
     * Retorna se o objeto foi marcado para ser deletado
     * @return unknown_type
     */
    public function deleted() {
        if ($this->_state == cDELETE) {
            return true;
        }else
            return false;
    }

    /**
     * Desabilita a formatação dos dados na leitura do objeto.
     * retornando os dados no
     */
    public function notFormatData() {
        $this->_formatData = false;
    }

    /**
     * Retorna o numeto total de itens da lista mesmo eles estando marcados para deletados
     * @return int
     */
    public function countItens() {
        return count($this->_list);
    }

    /**
     * Retorna o numero de itens NÂO deletados na lista
     * @return int
     */
    public function countItensNotDeleted() {
        $count = 0;
        for ($i = 0; $i < $this->countItens(); $i++) {
            $Item = $this->getItem($i);
            if (!$Item->deleted()) {
                $count++;
            }
        }
        return $count;
    }

    /**
     * Retorna um item da lista
     * @param int $index
     * @return object
     */
    public function getItem($index) {
        return $this->_list[$index];
    }

    /**
     * Busca um item na lista procurando pelo id passado e retorna esse item
     * @param int $id id do item procurado
     * @return object
     */
    public function getItemById($id) {
        foreach ($this->_list as $key => $item) {
            if ($item->getID() == $id)
                return $this->_list[$key];
        }
    }

     

    /**
     * Adiciona ou substitui (se passado o index) um item na lista
     *
     * @param string $value
     * @param int $index
     */
    public function addItem($value, $index = '') {
        if ($index == '') {
            $this->_list[] = $value;
        } else {
            $this->_list[$index] = $value;
        }
    }

    /**
     * Retorna dos os itens da lista
     * @return objects
     */
    public function getItens() {
        return $this->_list;
    }

    /**
     * Função que retorna a lista de classes
     * O parametro $array e usado para passar parametro para a função.
     */
    public function classList() {
        foreach ($this->_classList as $class) {
            $nameClass = $class['nome'];
            $obj = new $nameClass();
            $obj->where($class['campo'], $this->getID());
            $obj->readLst();
            $name = strtolower($class['nome']) . 'Lst';
            $this->$name = $obj->getItens();
        }
    }

    /**
     * Desativa a leitura das listas do objeto.
     */
    public function setNoReadList() {
        $this->_readList = false;
    }

    /**
     * Adiciona as colunas a serem buscadas na consulta
     * obs: colunas separadas por "virgula"
     *
     * @param string $columns ex: coluna1, coluna2, coluna3
     */
    public function columns($columns) {
        $colunas = explode(',', $columns);
        foreach ($colunas as $nome) {
            $array[] = trim($nome);
        }
        $this->_columns = $array;
        return $this;
    }

    /**
     * Adiciona uma view ou outra tabela na consulta.
     * obj: será removido qualquer outro valor do from e adicionado o valor da view
     *
     * @param String $view
     */
    public function addView($view) {
        $this->_view = $view;
    }

    /**
     * condições para clausula where
     *
     * @param $campo
     * @param $valor
     * @param $oper
     * @param $glue ex: and ou or
     */
    public function where($campo, $valor, $oper = '=', $glue = 'and') {
        if ($campo != '') {
            if ($oper == 'like' || $oper == 'ilike') {
                $this->_whereSelect[] = array('campo' => $campo . ' ' . $oper . ' ? ', 'valor' => '%' . Format_String::htmlToString($valor) . '%', 'glue' => $glue);
            } else {
                $this->_whereSelect[] = array('campo' => $campo . ' ' . $oper . ' ? ', 'valor' => Format_String::htmlToString($valor), 'glue' => $glue);
            }
        }
        return $this;
    }

    /**
     * Parametros da junção "join"
     *
     * @param $table tabela de consulta
     * @param $cond condição da consulta ex: table.id_exemplo = table2.id_exemplo
     * @param $col colunas a serem retornadas
     * @param $type tipo de junção, inner [padrão], left, right, full, cross, natural
     * @param $schema esquema do banco de dados
     */
    public function join($table, $cond, $cols, $type = 'inner', $schema = null) {
        $arrayCols = explode(',', $cols);
        foreach ($arrayCols as $key) {
            $array[] = trim($key);
        }
        $this->_joins[] = array('table' => $table, 'cond' => $cond, 'col' => $array, 'type' => $type, 'schema' => $schema);
        return $this;
    }

    /**
     * condições de retorno de consulta
     *
     * @param $cond
     * @param $glue
     */
    public function having($cond, $glue = 'and') {
        $this->_havings[] = array('cond' => $cond, 'glue' => $glue);
        return $this;
    }

    /**
     * Agrupamento das linhas na consulta
     *
     * @param $flag true/false
     */
    public function groupBy($flag = true) {
        $this->_group = $flag;
        return $this;
    }

    /**
     * Ordenação do consulta adicionar a colunas e modo de ordenação separados por virgula.
     * Ex: coluna1 asc, colunas2 desc
     * @param $order
     */
    public function sortOrder($column, $order = 'asc') {
        if ($column != '') {
            $this->_sortOrder[] = $column . ' ' . $order;
        }
        return $this;
    }

    /**
     * Adiciona limites de linhas no retorno da consulta
     *
     * @param $limit numero de linhas a serem retornadas na consulta
     * @param $offset numero da pagina para consulta
     */
    public function limit($limit, $offset) {
        $this->_limit = $limit;
        $this->_offset = $offset;
        return $this;
    }

    public function setNoFormatData() {
        $this->_formatData = false;
    }

    /**
     * Retorna todos os filtros para a consulta sql.
     * @return Zend_Db_Table_Select
     */
    protected function getSelect() {

        $select = $this->select();

        if ($this->_view != '') {
            if ($this->_columns != '') {
                $select->from(strtolower($this->_view), '');
            } else {
                $select->from(strtolower($this->_view));
            }
        } else {
            if ($this->_columns != '') {
                $select->from($this->_name, '');
            } else {
                $select->from(strtolower($this->_name));
            }
        }

        if ($this->_columns != '') {
            $select->columns($this->_columns);
        }

        foreach ($this->_joins as $key) {
            $select->setIntegrityCheck(false);
            if ($key['type'] == 'inner') {
                $select->join($key['table'], $key['cond'], $key['col'], $key['schema']);
            } else if ($key['type'] == 'left') {
                $select->joinLeft($key['table'], $key['cond'], $key['col'], $key['schema']);
            } else if ($key['type'] == 'right') {
                $select->joinRight($key['table'], $key['cond'], $key['col'], $key['schema']);
            } else if ($key['type'] == 'full') {
                $select->joinFull($key['table'], $key['cond'], $key['col'], $key['schema']);
            } else if ($key['type'] == 'cross') {
                $select->joinCross($key['table'], $key['col'], $key['schema']);
            } else {
                $select->joinNatural($key['table'], $key['col'], $key['schema']);
            }
        }

        foreach ($this->_whereSelect as $key) {
            if ($key['glue'] == 'and') {
                $select->where($key['campo'], $key['valor']);
            } else {
                $select->orWhere($key['campo'], $key['valor']);
            }
        }

        foreach ($this->_havings as $key) {
            $this->_group = true;
            if ($key['glue'] == 'and') {
                $select->having($key['cond']);
            } else {
                $select->orHaving($key['cond']);
            }
        }

        if ($this->_group) {
            $nomeTable = strtolower(get_class($this));
            foreach ($this->_columns as $nome) {
                $group[] = $nomeTable . '.' . $nome;
            }
            foreach ($this->_joins as $key) {
                $group[] = $key['table'] . '.' . $key['col'];
            }
            $select->group($group);
        }
        if ($this->_sortOrder != '') {
            $select->order($this->_sortOrder);
        }
        if ($this->_limit != '' && $this->_offset != '') {
            $select->limitPage($this->_limit, $this->_offset);
        }

        return $select;
    }

    /**
     *
     * @param type $campo
     * @param type $valor
     * @param type $oper
     * @param type $glue 
     */
    public function addFilters($campo, $valor, $oper = '=', $glue = 'and') {
        if ($oper == 'like' || $oper == 'ilike') {
            $this->_filters[] = array('campo' => ' ' . $glue . ' ' . $campo . ' ' . $oper . ' ? ', 'valor' => '%' . $valor . '%');
        } else {
            $this->_filters[] = array('campo' => ' ' . $glue . ' ' . $campo . ' ' . $oper . ' ? ', 'valor' => $valor);
        }
    }

    function getFilters() {
        if ($this->_filters != '') {
            $where = '1=1 ';
            foreach ($this->_filters as $val) {
                $where .= $this->getAdapter()->quoteInto($val['campo'], $val['valor']);
            }
            $this->_filters = '';
            return $where;
        }
    }

    /**
     *  efetua a contagem de quantas linhas a no banco de dados
     *  com os filtros passados retirando o a clausula limite
     */
    public function count() {

        $col = $this->getPrimaryName();
        $class = get_class($this);
        $item = new $class;
        $item->columns('count(' . $col . ') as count');
        $item->_joins = array();
        $item->_whereSelect = $this->_whereSelect;
        $count = $item->fetchAll($item->getSelect())->toArray();

        return $count[0]['count'];
    }

    /**
     * Faz uma leitura no banco de dados de apenas uma linha
     *
     * @param int $id
     * @param string $modo
     * @param $dataConection instance of Zend_Config_Ini
     * @return array or class
     */
    public function read($id = null, $modo = 'obj') {

        if ($id != null) {
            $this->setID($id);
        }
        if ($this->getID() == '') {
            throw new Zend_Db_Table_Exception('O ID do objeto não foi passado ou não está setado no objeto');
        }

        $this->where($this->_name.'.'.$this->getPrimaryName(), $this->getID());

        if ($this->_removeJoin) {
            $this->_joins = array();
        }

        $filtros = $this->getSelect();

        if ($modo == 'obj') {
            $rows = $this->fetchAll($filtros)->toArray();
        } else {
            if ($this->_formatData) {
                return $this->fetchAll($filtros)->toArray();
            } else {
                return $this->fetchAll($filtros)->toArray();
            }
        }

        if (count($rows) == 0) {
            $this->error = 'Item não Encontrado!';
        }

        foreach ($rows as $numLinha => $row) {
            foreach ($row as $key => $value) {
                $key = 'a_' . $key;
                if ($this->_formatData) {
                    $this->$key = FormataDados::formataDadosRead($value);
                } else {
                    $this->$key = $value;
                }
            }
        }

        $key = $this->_log_info;
        $this->setTextLog($this->$key);
        if ($this->_readList) {
            $this->classList();
        }

        $this->setState(cUPDATE);

        return $this;
    }

    /**
     * Faz uma leitura no banco de dados de retornando varias linhas
     *
     * @param string $modo
     * @return array or class
     */
    public function readLst($modo = 'obj') {

        if ($this->_removeJoin) {
            $this->_joins = array();
        }

        $filtros = $this->getSelect();

        if ($modo == 'obj') {
            $rows = $this->fetchAll($filtros)->toArray();
        } else {
            $array = $this->fetchAll($filtros)->toArray();
            if ($this->_readCount) {
                $array['totalItens'] = $this->count();
            }
            return $array;
        }

        if (count($rows) == 0) {
            $this->error = 'Nenhum foi item não encontrado!';
        }

        if ($this->_readCount) {
            $this->setTotalItens($this->count());
        }

        foreach ($rows as $numLinha => $row) {
            $nome = get_class($this);
            $item = new $nome;
            $item->setState(cUPDATE);
            foreach ($row as $key => $value) {
                $key = 'a_' . $key;
                if ($this->_formatData) {
                    $item->$key = FormataDados::formataDadosRead($value);
                } else {
                    $item->$key = $value;
                }
            }
            $key = $this->_log_info;
            $item->setTextLog($item->$key);
            $this->addItem($item, $numLinha);
        }
        return $this;
    }

    /**
     * Faz uma leitura SIMPLIFICADA no banco de dados para ser mostrado no grid
     *
     * a idéia é ela ser sobreescrita na classe filha.
     *
     * @param string $modo
     * @return array or class
     */
    public function readGrid($modo = 'obj') {
        return $this->readLst($modo);
    }
    
    /** retorna o tipo da coluna no banoc de dados.
     * 
     * @param String $nomeColuna
     * @return String
     */
    public function getTipoColuna($nomeColuna) {
        return $this->_metadata[$nomeColuna]['DATA_TYPE'];
    }

    public function save() {
        if ($this->countItens() > 0) {
            for ($i = 0; $i < $this->countItens(); $i++) {
                $item = $this->getItem($i);
                if ($this->deleted()) { //se o item esta marcado para delecao
                    $item->setDeleted();
                    $item->save();
                } else {
                    $item->save();
                }
            }
        } else {
            if ($this->deleted()) { // primeiro ele testa se o item esta setado para delecao, se sim, deleta!
                if ($this->getID() != '') { //so deleta do banco de dados se tiver um id setado, senao da erro no sql
                    $nameClass = get_class($this);
                    $class = new $nameClass;
                    $class->read($this->getID());

                    $this->addFilters($this->getPrimaryName(), $this->getID());
                    $this->delete($this->getFilters());

                    if ($this->_log_ativo) {

                        $text = $this->_log_info;

                        if ($this->getOwner() != '') {
                            //							Log::createLogSql($this, $this->getID(), cLOG_SQL, cLOG_ACAO_DELETE);
                            Log::createLogSql($this, $this->getOwner(), cLOG_SQL, cLOG_ACAO_DELETE);
                            Log::createLog($this->getOwner(), 'Deletado ' . $this->_log_text . ' ' . $class->getTextLog(), cLOG_DELETE, cLOG_ACAO_DELETE);
                        } else {
                            Log::createLogSql($this, $this->getID(), cLOG_SQL, cLOG_ACAO_DELETE);
                            Log::createLog($this->getID(), 'Deletado ' . $this->_log_text . ' ' . $class->getTextLog(), cLOG_DELETE, cLOG_ACAO_DELETE);
                        }
                    }
                }
                return $this;
            }

            $data = '';
            $atribs = get_object_vars($this);
            $id = '';
            if (key_exists('a_' . $this->getPrimaryName(), $atribs)) {
                $id = $this->getID();
                unset($atribs['a_' . $this->getPrimaryName()]);
            }
            // percorre todos os atributos da classe para gerar o array dada
            foreach ($atribs as $key => $value) {
                $pos = strpos($key, 'a_');
                if ($pos !== false) {
                    $atrib = substr($key, 2);
                    $data[$atrib] = FormataDados::formataDadosSave($this, $atrib);
                }
            }
            if (is_array($data)) {
                if ($this->getState() == cUPDATE) {
                    $this->addFilters($this->getPrimaryName(), $id);

                    if ($this->_log_ativo) {
                        $this->_log_ativo = Log::createLogCampos($this);
                    }
                    if ($this->_log_ativo) {
                        $this->update($data, $this->getFilters());
                        $this->setID($id);
                    }

                    if ($this->_log_ativo) {
                        if ($this->getOwner() != '') {
                            Log::createLogSql($this, $this->getOwner(), cLOG_SQL, cLOG_ACAO_UPDATE);
                        } else {
                            Log::createLogSql($this, $this->getId(), cLOG_SQL, cLOG_ACAO_UPDATE);
                        }
                    }
                } else if ($this->getState() == cCREATE) {
                    $id = $this->insert($data); //o insert e devolve o id do novo item do db
                    $this->setID($id);

                    $nomeClass = get_class($this);
                    $item = new $nomeClass;

                    if ($this->_log_ativo) {
                        if ($this->getOwner() != '') {
                            Log::createLogSql($this, $this->getOwner(), cLOG_SQL, cLOG_ACAO_INSERT);
                            $item->read($this->getID());
                            Log::createLog($this->getOwner(), 'Inserido ' . $this->_log_text . '<b> ' . $item->getTextLog() . '</b>', cLOG_INSERT, cLOG_ACAO_INSERT);
                        } else {
                            Log::createLogSql($this, $id, cLOG_SQL, cLOG_ACAO_INSERT);
                            $item->read($this->getID());
                            Log::createLog($this->getID(), 'Inserido ' . $this->_log_text . '<b> ' . $item->getTextLog() . '</b>', cLOG_INSERT, cLOG_ACAO_INSERT);
                        }
                    }
                }
            }
        }
        return $this;
    }

}