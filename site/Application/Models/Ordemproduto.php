<?php

/**
 * Modelo da classe que liga a Ordem de Serviço ao produto
 * @filesource
 * @author 		Leonardo Daneili <leonardo.danieli@gmail.com>
 * @copyright 	4Coffee.com.br
 * @package		sistema
 * @subpackage	sistema.apllication.models
 * @version		1.0 16/03/2013
 */
class Ordemproduto extends Db_Table {

    protected $_name = 'ordemproduto';
    public $_primary = 'id_ordemproduto';
    public $_log_ativo = true;

}