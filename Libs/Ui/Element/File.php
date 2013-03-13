<?php
class Ui_Element_File extends Zend_Form_Element_File{
	public function init(){
		$this->addDecorator('File');
		$this->setAttrib('class', 'text ui-widget-content ui-corner-all');
	}
	public function setVisible($processo, $acao = ''){
		if(!Usuario::verificaAcesso($processo, $acao)){
			$this->removeDecorator('ViewHelper');
		}
	}
}