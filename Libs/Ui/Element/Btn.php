<?php
class Ui_Element_Btn extends Zend_Form_Element{
	public $helper = 'formBtn';

	public function init(){
		$this->addDecorator('ViewHelper');
		$this->setAttrib('event', 'click');
		Browser_Control::setScript('js', 'Button', 'Button/Button.js');
		Browser_Control::setScript('css', 'Button', 'Button/Button.css');
	}
	/**
	 * Adiciona o texto e a imagem para o botão
	 *
	 * @param String $label
	 * @param String $src
	 * @param String $alt
	 */
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