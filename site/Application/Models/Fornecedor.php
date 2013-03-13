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
class Fornecedor extends Db_Table {
	protected $_name = 'fornecedor';
	public $_primary = 'id_fornecedor';

	protected $_log_text = 'Fornecedor';
	protected $_log_info = 'a_razaosocial';

	public function setDataFromRequest($post) {
		$this->setNomeFantasia($post->nomeFantasia);
		$this->setRazaoSocial($post->razaoSocial);
		$this->setid_endereco($post->id_endereco);
		$this->setNumero($post->numero);
		$this->setCnpj($post->cnpj);
		$this->setInscricaoEstadual($post->inscricaoEstadual);
	}
}