<?php

/**
 * Modelo da classe de Cliente
 * @author 	Leonardo Daneili <leonardo.danieli@gmail.com>
 * @copyright 	4Coffee.com.br
 * @package	sistema
 * @subpackage	sistema.apllication.models
 * @version	1.0 16/03/2013
 */
class Cliente extends Db_Table {

    protected $_name = 'cliente';
    public $_primary = 'id_cliente';
    public $_log_ativo = true;

    public function setDataFromRequest($post) {
        $this->setNome($post->getUnescaped('nome'));
        $this->setEmail($post->getUnescaped('email'));
        $this->setFone($post->getUnescaped('fone'));
        $this->setFone2($post->getUnescaped('fone2'));
        $this->setFone3($post->getUnescaped('fone3'));
        $this->setLogradouro($post->getUnescaped('logradouro'));
        $this->setNumero($post->getUnescaped('numero'));
        $this->setComplemento($post->getUnescaped('complemento'));
        $this->setBairro($post->getUnescaped('bairro'));
        $this->setCidade($post->getUnescaped('cidade'));
        $this->setUf($post->getUnescaped('uf'));
        $this->setCep($post->getUnescaped('cep'));
    }

}