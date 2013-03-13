<?php
class PermissaoController extends Zend_Controller_Action{
	public function indexAction(){

		$form = new Ui_Form();
		$form->setName('formPermissao');
		$form->setAction('Permissao');

		// Grid Permissões
		$grid = new Ui_Element_Grid('Permissoes');
		$grid->setParams('Permissões', 'listaPermissoes');

		$element = new Ui_Element_Grid_Button('btnNovo', 'Inserir');
		$element->setImg('Buttons/Novo.png');
		$element->setVisible('PROC_CAD_PERMISSOES', 'inserir');
		$grid->addButton($element);

 		$element = new Ui_Element_Grid_Button('btnExcluir', 'Excluir');
		$element->setImg('Buttons/Cancelar.png');
		$element->setAttribs('msg = "Excluir o item selecionado ?"');
		$element->setVisible('PROC_CAD_PERMISSOES', 'excluir');
		$element->setSendFormFields('sendFormFields', '1');
		$grid->addButton($element);

		$column = new Ui_Element_Grid_Column_Check('ID', 'oid_permissao', '30', 'center');
		$grid->addColumn($column);

		$column = new Ui_Element_Grid_Column_Text('Usúario ou grupo', 'nomecompleto', '110');
		$grid->addColumn($column);

		$column = new Ui_Element_Grid_Column_Text('Processo', 'descricao', '110');
		$grid->addColumn($column);

		$column = new Ui_Element_Grid_Column_Image('Ver', 'ver', '30', 'center');
		$column->setCondicao('S','', '==');
		$column->setImages(PATH_IMAGES.'Buttons/Ok.png', PATH_IMAGES.'Buttons/Cancelar.png');
		$grid->addColumn($column);

		$column = new Ui_Element_Grid_Column_Image('Inserir', 'inserir', '40', 'center');
		$column->setCondicao('S','', '==');
		$column->setImages(PATH_IMAGES.'Buttons/Ok.png', PATH_IMAGES.'Buttons/Cancelar.png');
		$grid->addColumn($column);

		$column = new Ui_Element_Grid_Column_Image('Excluir', 'excluir', '40', 'center');
		$column->setCondicao('S','', '==');
		$column->setImages(PATH_IMAGES.'Buttons/Ok.png', PATH_IMAGES.'Buttons/Cancelar.png');
		$grid->addColumn($column);

		$column = new Ui_Element_Grid_Column_Image('Editar', 'editar', '40', 'center');
		$column->setCondicao('S','', '==');
		$column->setImages(PATH_IMAGES.'Buttons/Ok.png', PATH_IMAGES.'Buttons/Cancelar.png');
		$grid->addColumn($column);

		$form->addElement($grid);

		$view = Zend_Registry::get('view');

		$view->assign('scripts', Browser_Control::getScripts());
		$view->assign('body', $form->displayTpl($view, 'Permissoes/index.tpl'));
		$view->output('index.tpl');
	}
	public function btnexcluirclickAction(){
		$post = Zend_Registry::get('post');

		$permissoes = new Permissao;

		$userEdit = Session_Control::getDataSession('userEdit');

		for ($i = 0; $i < $post->rp; $i++) {
			$chk = 'gridChk_' . $i;
			if ($post->$chk != '') {
				$item = $userEdit->permissoesLst[$post->$chk];
				$item->setState(cDELETE);
				$userEdit->permissoesLst[$post->$chk] = $item;
			}
		}
		
		Session_Control::setDataSession('userEdit', $userEdit);

		$br = new Browser_Control();
		$br->setUpdateGrid('gridPermissao');
		$br->send();

	}
	public function listapermissoesAction(){
		$user = Usuario::getInstance('userEdit');
		$post = Zend_Registry::get('post');
		$permissoes = new Permissao();

		if($user->permissoesLst != ''){
			$permissoesLst = $user->permissoesLst;
		}else{
			$permissoesLst = array();
		}

		foreach($permissoesLst as $permissao){

			if($permissao->getTipo() != 'controlador' && $permissao->getState() != cDELETE){
				$permissoes->addItem($permissao);
			}
		}
		Grid_Control::setDataGridJson(Session_Control::getDataSession($post->idGrid), $post->page, count($permissoes), $permissoes, 'nome');
	}
	public function btninserirclickAction(){
		$this->edit();
	}
	public function gridpermissaodblclickAction(){
		$this->edit();
	}
	public function btnsalvarclickAction(){

		$post = Zend_Registry::get('post');

		$user = Usuario::getInstance('userEdit');

		$processos = new Processo;
		$processos->read($post->processo);

		$state = cCREATE;

		$id = $processos->getNome();


		$permissao = new Permissao();
		if($post->id != ''){
			$state = cUPDATE;
			$id = $post->id;
			$permissao = $user->permissoesLst[$post->id];
			$oidPermissao = $permissao->getId_Permissao();
		}

		$permissao->setId_Permissao($oidPermissao);
		$permissao->setId_Processo($post->processo);
		$permissao->setNome($processos->getNome());
		$permissao->setDescricao($processos->getDescricao());
		$permissao->setVer($post->ver);
		$permissao->setInserir($post->inserir);
		$permissao->setExcluir($post->excluir);
		$permissao->setEditar($post->editar);
		$permissao->setGrupo('N');
		$permissao->setId_Usuario('');
		$permissao->setTipo('permissao');
		$permissao->setState($state);

		$user->permissoesLst[$id] = $permissao;

		Session_Control::setDataSession('userEdit', $user);

		$br = new Browser_Control();
		$br->setUpdateGrid('gridPermissao');
		$br->setRemove('insertPermissao');
		$br->send();
	}

	public function edit(){
		$post = Zend_Registry::get('post');
		$br = new Browser_Control();

		$listaProcessos = Usuario::getListaProcessos();

		if($listaProcessos == '' && !isset($post->id)){
			$br->setAlert('Permissões', 'Não há mais permissões a serem inseridas. ', 380, 140);
			$br->send();
			exit;
		}

		$chkVer = false;
		$chkInserir = false;
		$chkExcluir = false;
		$chkEditar = false;

		$item = new Permissao;
		if(isset($post->id)){
			$user = Session_Control::getDataSession('userEdit');


			$item = $user->permissoesLst[$post->id];

			if($item->getGrupo() == 'S'){
				$br->setAlert('Permissões','Permissões do grupo não podem ser editadas. <br />Para autorizar ou negar a permissão, insira ela no usúario.', 380, 140);
				$br->send();
				exit;
			}
			if($item->getVer() =='S'){
				$chkVer = true;
			}
			if($item->getInserir() == 'S'){
				$chkInserir = true;
			}
			if($item->getExcluir() == 'S'){
				$chkExcluir = true;
			}
			if($item->getEditar() == 'S'){
				$chkEditar = true;
			}
		}

		$form = new Ui_Form();
		$form->setAction('Permissao');
		$form->setName('formPermissaoEdit');

		$processos = new Ui_Element_Select('processo');
		if(isset($post->id)){
			$processos->addMultiOption($item->getId_processo(), $item->getDescricao());
		}else{
			$processos->addMultiOptions($listaProcessos);
		}
		$form->addElement($processos);

		$ver = new Ui_Element_Checkbox('ver');
		$ver->setCheckedValue('S');
		$ver->setUncheckedValue('N');
		$form->addElement($ver);

		$inserir = new Ui_Element_Checkbox('inserir');
		$inserir->setCheckedValue('S');
		$inserir->setUncheckedValue('N');
		$form->addElement($inserir);

		$excluir = new Ui_Element_Checkbox('excluir');
		$excluir->setCheckedValue('S');
		$excluir->setUncheckedValue('N');
		$form->addElement($excluir);

		$editar = new Ui_Element_Checkbox('editar');
		$editar->setCheckedValue('S');
		$editar->setUncheckedValue('N');
		$form->addElement($editar);

		$btnSalvar = new Ui_Element_Btn('btnSalvar');
		$btnSalvar->setDisplay('Salvar', PATH_IMAGES.'Buttons/Ok.png');
		$btnSalvar->setAttrib('sendFormFields', '1');
		$btnSalvar->setAttrib('params','id='.$post->id);
		$form->addElement($btnSalvar);

		$btnCancelar = new Ui_Element_Btn('btnCancelar');
		$btnCancelar->setDisplay('Cancelar', PATH_IMAGES.'Buttons/Cancelar.png');
		$form->addElement($btnCancelar);

		$form->setDataForm($item);

		$view = Zend_Registry::get('view');

		$w = new Ui_Window('insertPermissao', 'Permissões', $form->displayTpl($view, 'Permissoes/edit.tpl'));
		$w->setDimension('400', '200');
		$br->newWindow($w);
		$br->send();
	}

	public function btncancelarclickAction(){
		$br = new Browser_Control();
		$br->setRemove('insertPermissao');
		$br->send();
	}
}