<?php

/**
 * Modelo da classe que liga a Materia de Serviço ao produto
 * @filesource
 * @author 		Leonardo Daneili <leonardo.danieli@gmail.com>
 * @copyright 	4Coffee.com.br
 * @package		sistema
 * @subpackage	sistema.apllication.models
 * @version		1.0 16/03/2013
 */
class Materiaproduto extends Db_Table {

    protected $_name = 'materiaproduto';
    public $_primary = 'id_materiaproduto';
    public $_log_ativo = true;

}