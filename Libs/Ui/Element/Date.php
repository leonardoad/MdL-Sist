<?php
class Ui_Element_Date extends Zend_Form_Element_Text{

	public $buttonImageOnly = true;
	public $showOn = 'button';
	public $dateFormat = 'dd/mm/yy';
	public $mask = '39/19/9999';
	public $buttonText = '';
	public $autoSize = true;
	public $constrainInput = false;

	public $helper = 'formDate';

	public function init(){
		$this->addDecorator('ViewHelper');
		Browser_Control::setScript('js', 'Date', 'Date/Date.js');
		Browser_Control::setScript('js', 'Mask', 'Mask/Mask.js');
		Browser_Control::setScript('css', 'Date', 'Date/Date.css');
                $this->buttonImage = '/'.BASE . '/Libs/Images/Calendarios/CalendarAdd24x24.png';
	}
	public function setAlt($alt){
		$this->buttonText = $alt;
	}

	public function setImage($scr, $button){
		$this->buttonImage = $src;
		$this->buttonImageOnly = $button;
	}
	public function setFormatData($format = 'dd/mm/yy'){
		$this->dateFormat = $format;
	}
	public function setVisible($processo, $acao = ''){
		if(!Usuario::verificaAcesso($processo, $acao)){
			$this->removeDecorator('ViewHelper');
		}
	}
}