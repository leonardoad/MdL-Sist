<?php
class Empresa extends Db_Table {
	protected $_name ='empresa';
	public $_primary = 'id_empresa';

	protected $_log_text = 'Empresa';
	protected $_log_info = 'a_razaosocial';

	public function setDataFromRequest($post) {
		$this->setNomeFantasia($post->nomeFantasia);
		$this->setRazaoSocial($post->razaoSocial);
		$this->setEndereco($post->endereco);
		$this->setCidade($post->cidade);
		$this->setBairro($post->bairro);
		$this->setUf($post->uf);
		$this->setCep($post->cep);
		$this->setTelefone($post->telefone);
		$this->setFax($post->fax);
		$this->setCnpj($post->cnpj);
		$this->setInscricaoEstadual($post->inscricaoEstadual);
		$this->setEmail($post->email);
		$this->setSite($post->site );
		$this->setEmbratur($post->embratur);
		$this->setIata($post->iata);
		$this->setSnea($post->snea);
		$this->setAbav($post->abav);
		$this->setResponsavel($post->responsavel);
		$this->setPrincipal($post->principal);
		$this->setEditavel(cTRUE);
	}
}