<?php
class Ui_Element_TextMask extends Zend_Form_Element_Text{
	public $helper = 'formTextMask';
	public function init(){
		$this->addDecorator('ViewHelper');
	}
	/**
	 * criar uma mascara para o input
	 *
	 * Obs:  caso usar o reverse a mascara sera invertida devido a biblioteca js
	 * @param String $mascara
	 * @param Boolean $autoTab default false;
	 * @param String $defaulValue default ''
	 * @param String $reverse default '';
	 */
	public function setMask($mascara, $reverse = '', $defaultValue = '', $autoTab = 'false'){
		$this->mask = $mascara;
		$this->autoTab = $autoTab;
		$this->defaultValue = $defaultValue;
		$this->reverse = $reverse;
	}
	public function setVisible($processo, $acao = ''){
		if(!Usuario::verificaAcesso($processo, $acao)){
			$this->removeDecorator('ViewHelper');
		}
	}
}