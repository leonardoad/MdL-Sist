<?php
class Ui_Element_Btn extends Zend_Form_Element{
	public $helper = 'formBtn';

	public function init(){
		$this->addDecorator('ViewHelper');
		$this->setAttrib('event', 'load');
	}
	public function setDisplay($label, $src = '', $alt = ''){
		$this->label = $label;
		$this->src = $src;
		$this->alt = $alt;
	}
	public function setVisible($processo, $acao = ''){
		if(!Usuario::verificaAcesso($processo, $acao)){
			$this->removeDecorator('ViewHelper');
		}
	}
}