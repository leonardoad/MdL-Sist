<?php

/**
 * Modelo da classe de Materia Prima
 * @author 		Leonardo Daneili <leonardo.danieli@gmail.com>
 * @copyright 	4Coffee.com.br
 * @package		sistema
 * @subpackage	sistema.apllication.models
 * @version		1.0 16/03/2013
 */
class Materiaprima extends Db_Table {

    protected $_name = 'materiaprima';
    public $_primary = 'id_materiaprima';
    public $_log_ativo = true;

    public function setDataFromRequest($post) {
        $this->setNome($post->getUnescaped('nome'));
        $this->setMedida($post->medida);
        $this->setValorCusto($post->valorcusto);
    }

}