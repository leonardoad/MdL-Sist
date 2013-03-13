<?php
/**
 * Modelo da classe Tipoproduto
 * @filesource
 * @author 		Leonardo Daneili
 * @copyright 	Ismael Sleifer Web Designer
 * @package		sistema
 * @subpackage	sistema.apllication.models
 * @version		1.0
 */
class Tipoproduto extends Db_Table {
	protected $_name = 'tipoproduto';
	public $_primary = 'id_tipoproduto';
	public $_log_ativo = true;

	public function setDataFromRequest($post) {
		$this->setDescricao($post->descricao);
		$this->setId_Owner($post->id_owner);
	}

	 

}