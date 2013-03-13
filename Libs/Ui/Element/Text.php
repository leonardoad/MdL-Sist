<?php
class Ui_Element_Text extends Zend_Form_Element_Text{
	public function init(){
		$this->addDecorator('ViewHelper');
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