<?php
class ConfigController extends Zend_Controller_Action{

	public function indexAction(){

		$form = new Ui_Form();
		$form->setName('formConfig');
		$form->setAction('.');

		$element = new Ui_Element_Checkbox('trocaSenhaTempo');
		$element->setCheckedValue('S');
		$element->setUncheckedValue('N');
		$form->addElement($element);

		$element = new Ui_Element_Text('tempoTrocaSenha');
		$form->addElement($element);

		$element = new Ui_Element_Checkbox('forcaTrocaSenha');
		$element->setCheckedValue('S');
		$element->setUncheckedValue('N');
		$form->addElement($element);

		$item = new Config();
		$item->read(1);

		$form->setDataForm($item);

		$view = Zend_Registry::get('view');

		$view->assign('body', $form->displayTpl($view, 'Config/index.tpl'));
		$view->output('index.tpl');
	}
}