<?php
class Ui_Element_TextMask extends Zend_Form_Element_Text{
	public $helper = 'formTextMask';
	public function init(){
		$this->addDecorator('ViewHelper');
	}
	/**
	 * criar uma mascara para o input
	 * Obs:  caso usar o reverse a mascara sera invertida devido a biblioteca js

	 * @param String $mascara EX:9999,99 em caso de uso do reverse, colocar a mascara ao contrário
	 * @param bool $reverse <code>TRUE</code> para o campo ficar ao contrario(usado para campos de valor);
	 * @param String $defaulValue valor default do campo.
	 * @param Boolean $autoTab <code>TRUE</code> para que ao final da digitação do valor o foco passar para o proximo campo;
	 * @link http://www.meiocodigo.com/projects/meiomask 
	 */
	public function setMask($mascara, $reverse = false, $defaultValue = '', $autoTab = 'false'){
		$this->mask = $mascara;
		$this->defaultValue = $defaultValue;
		$this->reverse = $reverse;
		$this->autoTab = $autoTab;
	}
	public function setVisible($processo, $acao = ''){
		if(!Usuario::verificaAcesso($processo, $acao)){
			$this->removeDecorator('ViewHelper');
		}
	}
        public function setReadOnly($flag, $classCss = 'readonly'){
		if($flag){
			$this->setAttrib('readonly', 'readonly');
			$this->setAttrib('class', $classCss);
		}
	}
}