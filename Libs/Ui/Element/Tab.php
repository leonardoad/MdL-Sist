<?php
class Ui_Element_Tab extends Zend_Form_Element{
	public $helper = 'formTab';
	public $fields;
	public $visible;
	public function init()	{
		$this->addDecorator('ViewHelper')
			 ->addDecorator('Label')
			 ->addDecorator('HtmlTag');
		$this->visible = true;
	}
	public function setTitle($title){
		$this->title = $title;
	}
	public function setTemplate($template){
		$this->template = $template;
	}
	public function addElement($element){
		$this->fields[] = $element;
	}
	public function setVisible($processo, $acao){
		$this->visible = Usuario::verificaAcesso($processo, $acao);
	}
}