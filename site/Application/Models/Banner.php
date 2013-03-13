<?php
/**
 * Modelo da classe Banner
 * @filesource
 * @author 		Leonardo Daneili
 * @copyright 	Ismael Sleifer Web Designer
 * @package		sistema
 * @subpackage	sistema.apllication.models
 * @version		1.0
 */
class Banner extends Db_Table {
	protected $_name = 'banner';
	public $_primary = 'id_banner';
	public $_log_ativo = true;

	public function setDataFromRequest($post) {
		$this->setTitulo($post->titulo);
		$this->setDescricao($post->descricao);
		$this->setAtivo($post->ativo);
	}

	 

}