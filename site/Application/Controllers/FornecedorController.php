<?php
class FornecedorController extends Zend_Controller_Action{

	public function indexAction(){
		$form = new Ui_Form();
		$form->setName('formFornecedor');
		$form->setAction('Fornecedor');

		$grid = new Ui_Element_Grid('gridFonecedor');
		$grid->setOrder('nomefantasia');
		$grid->setParams('Fornecedor', 'Fornecedor/listaforncedor');

		$button = new Ui_Element_Grid_Button('btnNovo', 'Inserir');
		$button->setImg('Buttons/Novo.png');
		$button->setVisible('CAD_FORNECEDOR', 'inserir');
		$grid->addButton($button);

		$button = new Ui_Element_Grid_Button('btnExcluir', 'Excluir');
		$button->setImg('Buttons/Cancelar.png');
		$button->setAttribs('msg = "Excluir o item selecionado ?"');
		$button->setVisible('CAD_FORNECEDOR', 'excluir');
		$button->setSendFormFields();
		$grid->addButton($button);

		$column = new Ui_Element_Grid_Column_Check('ID', 'id_fornecedor', '30', 'center');
		$grid->addColumn($column);

		$column = new Ui_Element_Grid_Column_Text('Nome Fantasia', 'nomefantasia', '150');
		$grid->addColumn($column);


		$column = new Ui_Element_Grid_Column_Text('Razão Social', 'razaosocial', '150');
		$grid->addColumn($column);

		$form->addElement($grid);

		$view = Zend_Registry::get('view');

		$view->assign('scripts', Browser_Control::getScripts());
		$view->assign('body', $form->displayTpl($view, 'Fornecedor/index.tpl'));
		$view->output('index.tpl');
	}

	public function edit(){
		$post = Zend_Registry::get('post');

		$form = new Ui_Form();
		$form->setAction('Fornecedor');
		$form->setName('formFornecedorEdit');

		$tabGeral = new Ui_Element_Tab('tabGeral');
		$tabGeral->setTitle('Geral');
		$tabGeral->setTemplate('Fornecedor/tabGeral.tpl');

		$element = new Ui_Element_Text('nomeFantasia');
		$element->setAttrib('maxlength', 60);
		$element->setAttrib('obrig', 'obrig');
		$element->setRequired();
		$element->setAttrib('size', 30);
		$tabGeral->addElement($element);

		$element = new Ui_Element_Text('razaoSocial');
		$element->setAttrib('maxlength', 60);
		$element->setAttrib('obrig', 'obrig');
		$element->setRequired();
		$element->setAttrib('size', 30);
		$tabGeral->addElement($element);

		
		$element = new Ui_Element_TextMask('cep');
		$element->setMask('99999999');
		
		
		
		$element = new Ui_Element_Text('ddi');
		$element->setAttrib('maxlength', 2);
		$element->setAttrib('size', 1);
		$tabGeral->addElement($element);

		$element = new Ui_Element_Select('id_moeda');
		$element->addMultiOptions(Moeda::getOptionList('id_moeda', 'nomemoeda', 'Moeda'));
		$tabGeral->addElement($element);

		$mainTab->addTab($tabGeral);

		// Tab Logs
		$tabLogs = new Ui_Element_Tab('tabLogs');
		$tabLogs->setTitle('Logs');

		$log = Log::gridLogs($post->id, 'Pais');
		$tabLogs->addElement($log);

		$mainTab->addTab($tabLogs);


		$form->addElement($mainTab);

		$obj = new Pais();
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

		$w = new Ui_Window('EditPais', 'Edição de pais', $form->displayTpl($view, 'Pais/edit.tpl'), true);
		$w->setDimension('610', '430');
		$br = new Browser_Control();
		$br->newWindow($w);
		$br->send();
	}

	public function btnnovoclickAction(){
		$this->edit();
	}

	public function btnsalvarclickAction(){
		$form = Session_Control::getDataSession('formPaisEdit');

		$valid = $form->processAjax($_POST);

		$br = new Browser_Control();
		if($valid != 'true'){
			$br->validaForm($valid);
			$br->send();
			exit;
		}

		$post = Zend_Registry::get('post');

		$pais = new Pais();
		if(isset($post->id)){
			$pais->read($post->id);
		}

		$pais->setDataFromRequest($post);

		$pais->save();

		$br->setRemoveWindow('EditPais');
		$br->setUpdateGrid('gridPais');
		$br->send();

		Session_Control::setDataSession('formPaisEdit', '');
	}

	public function btnexcluirclickAction(){
		Grid_Control::deleteDataGrid('Pais', '','gridPais');
	}

	public function btncancelarclickAction(){
		$br = new Browser_Control;
		$br->setRemoveWindow('EditPais');
		$br->send();
	}

	public function gridpaisdblclickAction(){
		$this->edit();
	}

	public function listapaisAction(){
		Grid_Control::setDataGrid(new PaisView());
	}
}