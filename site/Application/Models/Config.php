<?php
/**
 * Modelo da classe Usuario
 * @filesource
 * @author 		Ismael Sleifer
 * @copyright 	Ismael Sleifer Web Designer
 * @package		sistema
 * @subpackage	sistema.apllication.models
 * @version		1.0
 */
class Config extends Db_Table {
	protected $_name = 'config';
	public $_primary = 'id_config';
	protected $_log_text = 'Configuração';

	public function setDataFromRequest($post) {

		$this->setDescricao($post->descricao);
		$this->setTrocaSenhaTempo($post->trocasenhatempo);

	}
}