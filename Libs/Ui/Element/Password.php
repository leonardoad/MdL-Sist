<?php
class Ui_Element_Password extends Zend_Form_Element_Password{
	public function init(){
		$this->addDecorator('ViewHelper');
	}
	public function setVisible($processo, $acao = ''){
		if(!Usuario::verificaAcesso($processo, $acao)){
			$this->removeDecorator('ViewHelper');
		}
	}
}