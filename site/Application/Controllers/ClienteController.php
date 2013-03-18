<?php
class ClienteController extends Zend_Controller_Action{

	public function init(){
		Browser_Control::setScript('js', 'Mask', 'Mask/Mask.js');
	}
	public function indexAction(){
		$form = new Ui_Form();
		$form->setName('formCliente');
		$form->setAction('Cliente');

		$grid = new Ui_Element_Grid('gridCliente');
		$grid->setParams('Cliente', 'Cliente/listaCliente');
		$grid->setOrder('nomefantasia');

		$button = new Ui_Element_Grid_Button('btnNovo', 'Inserir');
		$button->setImg('Buttons/Novo.png');
		$button->setVisible('CAD_CLIENTE', 'inserir');
		$grid->addButton($button);

		$button = new Ui_Element_Grid_Button('btnExcluir', 'Excluir');
		$button->setImg('Buttons/Cancelar.png');
		$button->setAttribs('msg = "Excluir o item selecionado ?"');
		$button->setVisible('CAD_CLIENTE', 'excluir');
		$button->setSendFormFields();
		$grid->addButton($button);

		$column = new Ui_Element_Grid_Column_Check('ID', 'id_cliente', '30', 'center');
		$grid->addColumn($column);

		$column = new Ui_Element_Grid_Column_Text('Nome fantasia', 'nomefantasia', '150');
		$grid->addColumn($column);

		$column = new Ui_Element_Grid_Column_Text('Razão social', 'razaosocial', '150');
		$grid->addColumn($column);

		$form->addElement($grid);

		$view = Zend_Registry::get('view');

		$view->assign('scripts', Browser_Control::getScripts());
		$view->assign('body', $form->displayTpl($view, 'Cliente/index.tpl'));
		$view->output('index.tpl');
	}

	public function edit(){
		$post = Zend_Registry::get('post');

		$form = new Ui_Form();
		$form->setAction('Cliente');
		$form->setName('formClienteEdit');

		$mainTab = new Ui_Element_TabMain('editClienteTab');

		$tabGeral = new Ui_Element_Tab('tabGeral');
		$tabGeral->setTitle('Geral');
		$tabGeral->setTemplate('Cliente/tabGeral.tpl');

		$element = new Ui_Element_Checkbox('principal');
		$element->setCheckedValue(cTRUE);
		$element->setUncheckedValue(cFALSE);
		$tabGeral->addElement($element);

		$element = new Ui_Element_Text('nomeFantasia');
		$element->setAttrib('obrig', 'obrig');
		$element->setRequired();
		$element->setAttrib('size', '50');
		$tabGeral->addElement($element);

		$element = new Ui_Element_Text('razaoSocial');
		$element->setAttrib('obrig', 'obrig');
		$element->setRequired();
		$element->setAttrib('size', '50');
		$tabGeral->addElement($element);

		$element = new Ui_Element_Text('endereco');
		$element->setAttrib('obrig', 'obrig');
		$element->setRequired();
		$element->setAttrib('size', '50');
		$tabGeral->addElement($element);

		$element = new Ui_Element_Text('cidade');
		$element->setAttrib('obrig', 'obrig');
		$element->setRequired();
		$element->setAttrib('size', '50');
		$tabGeral->addElement($element);

		$element = new Ui_Element_Text('bairro');
		$tabGeral->addElement($element);

		$element = new Ui_Element_Text('uf');
		$tabGeral->addElement($element);

		$element = new Ui_Element_TextMask('cep');
		$element->setMask('99.999.999');
		$element->setAttrib('size', '7');
		$tabGeral->addElement($element);

		$element = new Ui_Element_TextMask('telefone');
		$element->setMask('(99) 9999-9999');
		$tabGeral->addElement($element);

		$element = new Ui_Element_TextMask('fax');
		$element->setMask('(99) 9999-9999');
		$tabGeral->addElement($element);

		$element = new Ui_Element_TextMask('cnpj');
		$element->setMask('99.999.999/9999-99');
		$tabGeral->addElement($element);

		$element = new Ui_Element_Text('inscricaoEstadual');
		$tabGeral->addElement($element);

		$element = new Ui_Element_Text('email');
		$element->setAttrib('size', '50');
		$tabGeral->addElement($element);

		$element = new Ui_Element_Text('site');
		$element->setAttrib('size', '50');
		$tabGeral->addElement($element);

		$element = new Ui_Element_Text('embratur');
		$tabGeral->addElement($element);

		$element = new Ui_Element_Text('iata');
		$tabGeral->addElement($element);

		$element = new Ui_Element_Text('snea');
		$tabGeral->addElement($element);

		$element = new Ui_Element_Text('abav');
		$tabGeral->addElement($element);

		$element = new Ui_Element_Text('responsavel');
		$element->setAttrib('size', '50');
		$tabGeral->addElement($element);

		$mainTab->addTab($tabGeral);

		// Logs
		$tabLogs = new Ui_Element_Tab('tabLogs');
		$tabLogs->setTitle('Logs');
		$tabLogs->addElement(Log::gridLogs($post->id, 'Cliente'));

		$mainTab->addTab($tabLogs);

		$form->addElement($mainTab);

		$obj= new Cliente();
		if(isset($post->id)){
			$obj->read($post->id);
		}
		$form->setDataForm($obj);

		$salvar = new Ui_Element_Btn('btnSalvar');
		$salvar->setDisplay('Salvar', PATH_IMAGES.'Buttons/Ok.png');
		if(isset($post->id)){
			$salvar->setAttrib('params', 'id='.$post->id);
		}
		$salvar->setAttrib('sendFormFields', '1');
		$salvar->setAttrib('validaObrig', '1');
		$form->addElement($salvar);

		$cancelar = new Ui_Element_Btn('btnCancelar');
		$cancelar->setDisplay('Cancelar', PATH_IMAGES.'Buttons/Cancelar.png');
		$form->addElement($cancelar);

		$form->setDataSession();

		$view = Zend_Registry::get('view');

		$w = new Ui_Window('EditCliente', 'Edição de Cliente', $form->displayTpl($view, 'Cliente/edit.tpl'), true);
		$w->setDimension('600', '580');
		$br = new Browser_Control();
		$br->newWindow($w);
		$br->send();
	}

	public function btnnovoclickAction(){
		$this->edit();
	}

	public function btnsalvarclickAction(){
		$form = Session_Control::getDataSession('formClienteEdit');

		$valid = $form->processAjax($_POST);

		$br = new Browser_Control();
		if($valid != 'true'){
			$br->validaForm($valid);
			$br->send();
			exit;
		}

		$post = Zend_Registry::get('post');

		$obj = new Cliente();
		if(isset($post->id)){
			$obj->read($post->id);
		}
		$obj->setDataFromRequest($post);
		$obj->save();

		$br->setRemoveWindow('EditCliente');
		$br->setUpdateGrid('gridCliente');
		$br->send();
		
		Session_Control::setDataSession('formClienteEdit', '');
	}

	public function btnexcluirclickAction(){
		Grid_Control::deleteDataGrid('Cliente', '','gridCliente');
	}

	public function btncancelarclickAction(){
		$br = new Browser_Control;
		$br->setRemoveWindow('EditCliente');
		$br->send();
	}

	public function gridclientedblclickAction(){
		$this->edit();
	}
	public function listaclienteAction(){
		$obj = new Cliente();
		$obj->where('editavel', 'S');

		Grid_Control::setDataGrid($obj);
	}
}