<?php
class UsuarioController extends Zend_Controller_Action{
	public function init(){
		Browser_Control::setScript('js', 'Md5', 'md5.js');
		Browser_Control::setScript('js', 'Mask', 'Mask/Mask.js');
	}
	private function gridsAction($tipo){
		$session = Zend_Registry::get('session');

		$form = new Ui_Form();
		$form->setName('formUsers');
		$form->setAction('Usuario');

		if($tipo == 'user'){
			$idGrid = 'gridUsers';
		}else{
			$idGrid = 'gridGrupos';
		}

		$accordion = new Ui_Element_Accordion('filtros');

		$section = new Ui_Element_Section('section1');
		$section->setTitle('Filtros');
		$section->setTemplate('Usuario/filtros.tpl');

		$element = new Ui_Element_Checkbox('ativoFiltro');
		$element->setAttrib('grid', $idGrid);
		$element->setChecked(cTRUE);
		$element->setCheckedValue(cTRUE);
		$element->setUncheckedValue(cFALSE);
		$section->addElement($element);

		$element = new Ui_Element_Text('loginUserFiltro');
		$element->setAttrib('grid', $idGrid);
		$section->addElement($element);

		$element = new Ui_Element_Text('nomeCompletoFiltro');
		$element->setAttrib('grid', $idGrid);
		$section->addElement($element);

		$element = new Ui_Element_Btn('btnFiltrar');
		$element->setDisplay('Filtrar', PATH_IMAGES.'Buttons/Find.png');
		$element->setAttrib('event', '');
		$element->setAttrib('updateGrid', $idGrid);
		$section->addElement($element);

		$element = new Ui_Element_Btn('btnLimparFiltros');
		$element->setDisplay('Limpar', PATH_IMAGES.'Buttons/Clear.png');
		$section->addElement($element);
		$accordion->addSection($section);

		$form->addElement($accordion);

		$grid = new Ui_Element_Grid($idGrid);
		if($tipo == 'user'){
			$grid->setParams('Usúarios', 'listaUsers');
		}else{

			$grid->setParams('Grupos', 'listaGrupos');
		}

		$button = new Ui_Element_Grid_Button('btnNovo', 'Inserir');
		$button->setImg('Buttons/Novo.png');
		$button->setAttribs('params="tipo=' . $tipo.'"');
		$button->setVisible('CAD_USER', 'inserir');
		$grid->addButton($button);

		$button = new Ui_Element_Grid_Button('btnExcluir', 'Excluir');
		$button->setImg('Buttons/Cancelar.png');
		$button->setAttribs('msg = "Excluir o item selecionado ?"');
		$button->setVisible('CAD_USER', 'excluir');
		$button->setSendFormFields();
		$grid->addButton($button);

		// Checkbox
		$column = new Ui_Element_Grid_Column_Check('ID', 'id_usuario', '30', 'center');
		$column->setCondicao('N', 'excluivel');
		$grid->addColumn($column);

		if($tipo != 'user'){
			$column = new Ui_Element_Grid_Column_Text('ID', 'id_usuario', '20');
			$grid->addColumn($column);
		}

		$column = new Ui_Element_Grid_Column_Text('Nome', 'nomecompleto', '300');
		$grid->addColumn($column);

		// Grupo
		if($tipo == 'user'){
			$column = new Ui_Element_Grid_Column_Text('Grupo', 'nomeGrupo', '120');
			$grid->addColumn($column);
		}

		$column = new Ui_Element_Grid_Column_Image('Ativo', 'ativo', '30', 'center');
		$column->setCondicao('S', 'ativo');
		$column->setImages(PATH_IMAGES.'Buttons/Ok.png', PATH_IMAGES.'Buttons/Cancelar.png');
		$grid->addColumn($column);

		$form->addElement($grid);

		$view = Zend_Registry::get('view');

		$view->assign('scripts', Browser_Control::getScripts());
		$view->assign('body', $form->displayTpl($view, 'Usuario/index.tpl'));
		$view->output('index.tpl');
	}

	public function edit($tipo){

		$post = Zend_Registry::get('post');

		$br = new Browser_Control;

		$form = new Ui_Form();
		$form->setAction('Usuario');
		$form->setName('formUsersEdit');

		$mainTab = new Ui_Element_TabMain('editUserTab');

		$tabGeral = new Ui_Element_Tab('tabGeral');
		$tabGeral->setTitle('Geral');
		$tabGeral->setTemplate('Usuario/tabGeral.tpl');

		$element = new Ui_Element_Checkbox('ativo');
		$element->setCheckedValue('S');
		$element->setUncheckedValue('N');
		$tabGeral->addElement($element);

		$element = new Ui_Element_Text('loginUser');
		$element->setAttrib('maxlength', '25');
		$element->setAttrib('obrig', 'obrig');
		$element->setRequired();
		if($post->id){
			$element->setReadOnly('true');
		}
		$tabGeral->addElement($element);

		$element = new Ui_Element_Text('nomeCompleto');
		$element->setAttrib('maxlength', '25');
		$element->setAttrib('obrig', 'obrig');
		$element->setRequired();
		$element->setAttrib('size', 30);
		$tabGeral->addElement($element);

		if($tipo == 'user'){
			$users = new Usuario;
			$users->where('tipo', 'grupo');
			$element = new Ui_Element_Select('grupo');
			$element->setAttrib('event', 'change');
			$element->addMultiOptions($users->getOptionList('id_usuario', 'nomecompleto', $users));
			$tabGeral->addElement($element);

			$element = new Ui_Element_Password('senha');
			$element->setAttrib('maxlength', 32);
			$element->setAttrib('cript', '1');
			$tabGeral->addElement($element);

			$element = new Ui_Element_Text('email');
			$element->setAttrib('maxlength', 255);
			$element->setAttrib('obrig', 'obrig');
			$element->setRequired();
			$tabGeral->addElement($element);

			$element = new Ui_Element_Password('senhaEmail');
			$element->setAttrib('maxlength', 50);
			$tabGeral->addElement($element);

			$element = new Ui_Element_Text('smtp');
			$element->setAttrib('maxlength', 25);
			$tabGeral->addElement($element);

			$element = new Ui_Element_TextMask('porta');
			$element->setMask('999');
			$element->setAttrib('size', 1);
			$tabGeral->addElement($element);
		}

		$empresa = new Empresa();
		$empresa->where('editavel', cTRUE);
		
		$element = new Ui_Element_Select('id_empresa');
		$element->addMultiOptions(Empresa::getOptionList('id_empresa', 'razaosocial', $empresa, false));
		$element->setAttrib('obrig', 'obrig');
		$element->setRequired();
		$tabGeral->addElement($element);

		$salvar = new Ui_Element_Btn('btnSalvar');
		$salvar->setDisplay('Salvar', PATH_IMAGES.'Buttons/Ok.png');
		if($tipo == 'user'){
			$salvar->setAttrib('params', 'id='.$post->id.'&tipo=user');
		}else{
			$salvar->setAttrib('params', 'id='.$post->id.'&tipo=grupo');
		}
		$salvar->setAttrib('sendFormFields', '1');
		$salvar->setAttrib('validaObrig', '1');
		$form->addElement($salvar);

		$cancelar = new Ui_Element_Btn('btnCancelar');
		$cancelar->setDisplay('Cancelar', PATH_IMAGES.'Buttons/Cancelar.png');
		$form->addElement($cancelar);

		$mainTab->addTab($tabGeral);

		// Tab permissões
		$tabPermissoes = new Ui_Element_Tab('tabPermissoes');
		$tabPermissoes->setTitle('Permissões');
		$tabPermissoes->setTemplate('Usuario/tabPermissoes.tpl');

		// Grid permissões
		$gridPermissoes = new Ui_Element_Grid('gridPermissao');
		$gridPermissoes->setParams('Permissões', '../permissao/listapermissoes');
		$gridPermissoes->setController('Permissao');
		$gridPermissoes->setDimension('545', '150');

		$button = new Ui_Element_Grid_Button('btnInserir', 'Inserir');
		$button->setImg('Buttons/Novo.png');
		$button->setVisible('CAD_PERMISSAO', 'inserir');
		$button->setUrl('../Permissao');
		$gridPermissoes->addButton($button);

		$button = new Ui_Element_Grid_Button('btnExcluir', 'Excluir');
		$button->setImg('Buttons/Cancelar.png');
		$button->setAttribs('msg = "Excluir o item selecionado ?"');
		$button->setUrl('../Permissao');
		$button->setVisible('CAD_PERMISSAO', 'excluir');
		$button->setSendFormFields();
		$gridPermissoes->addButton($button);

		$column = new Ui_Element_Grid_Column_Check('id', 'id_permissao', '30', 'center');
		$column->setCondicao('S', 'grupo');
		$gridPermissoes->addcolumn($column);

		$column = new Ui_Element_Grid_Column_Text('Processo', 'descricao', '230');
		$gridPermissoes->addColumn($column);

		$column = new Ui_Element_Grid_Column_Image('Ver', 'ver', '35', 'center');
		$column->setCondicao('S');
		$column->setImages(PATH_IMAGES.'Buttons/Ok.png', PATH_IMAGES.'Buttons/Cancelar.png');
		$gridPermissoes->addColumn($column);

		$column = new Ui_Element_Grid_Column_Image('Inserir', 'inserir', '35', 'center');
		$column->setCondicao('S');
		$column->setImages(PATH_IMAGES.'Buttons/Ok.png', PATH_IMAGES.'Buttons/Cancelar.png');
		$gridPermissoes->addColumn($column);

		$column = new Ui_Element_Grid_Column_Image('Excluir', 'excluir', '35', 'center');
		$column->setCondicao('S');
		$column->setImages(PATH_IMAGES.'Buttons/Ok.png', PATH_IMAGES.'Buttons/Cancelar.png');
		$gridPermissoes->addColumn($column);

		$column = new Ui_Element_Grid_Column_Image('Editar', 'editar', '35', 'center');
		$column->setCondicao('S');
		$column->setImages(PATH_IMAGES.'Buttons/Ok.png', PATH_IMAGES.'Buttons/Cancelar.png');
		$gridPermissoes->addColumn($column);

		$column = new Ui_Element_Grid_Column_Image('Herdada', 'grupo', '50', 'center');
		$column->setCondicao('S');
		$column->setImages(PATH_IMAGES.'Diversos/Grupo.png', PATH_IMAGES.'Diversos/User.png');
		$column->setSortable('false');
		$gridPermissoes->addColumn($column);

		$tabPermissoes->addElement($gridPermissoes);

		$mainTab->addTab($tabPermissoes);

		if($tipo == 'user'){
			$tab = new Ui_Element_Tab('tabAssinatura');
			$tab->setTitle('Assinatura do e-mail');
			$tab->setTemplate('Usuario/tabAssinaturaEmail.tpl');

			$element = new Ui_Element_Textarea('assinaturaEmail');
			$element->setAttrib('cols', '70');
			$element->setAttrib('rows', '15');
			$tab->addElement($element);
			$mainTab->addTab($tab);
		}

		// Tab Logs
		$tabLogs = new Ui_Element_Tab('tabLogs');
		$tabLogs->setTitle('Logs');

		$log = Log::gridLogs($post->id, 'Usuario');

		$tabLogs->addElement($log);

		$mainTab->addTab($tabLogs);

		$form->addElement($mainTab);
		
		$form->setDataSession();

		$obj = new Usuario();
		$obj->setAtivo('S');
		if(isset($post->id)){
			$obj->read($post->id);
		}

		$form->setDataForm($obj);

		$form->setDataSession();

		Session_Control::setDataSession('userEdit', $obj);

		if($tipo == 'user'){
			$label = 'Login do usúario';
			$descricao = 'Nome Completo';
		}else{
			$label = 'Nome do grupo';
			$descricao = 'Descrição';
		}

		$view = Zend_Registry::get('view');
		$view->assign('labelLogin', $label);
		$view->assign('descricao', $descricao);

		$w = new Ui_Window('EditUsers', 'Edição de usúarios', $form->displayTpl($view, 'Usuario/edit.tpl'));
		$w->setDimension('595', '420');
		$w->setCloseOnEscape();

		$br->newWindow($w);
		$br->send();
	}

	public function btnnovoclickAction(){
		$post = Zend_Registry::get('post');
		$this->edit($post->tipo);
	}

	public function btnsalvarclickAction(){
		$post = Zend_Registry::get('post');
		$br = new Browser_Control();
		
		$form = Session_Control::getDataSession('formUsersEdit');

		$valid = $form->processAjax($_POST);

		$br = new Browser_Control();
		if($valid != 'true'){
			$br->validaForm($valid);
			$br->send();
			exit;
		}

		$user = Usuario::getInstance('userEdit');
		$user->setDataFromRequest($post);
		$user->save();


		$br->setRemoveWindow('EditUsers');
		$br->setUpdateGrid('gridUsers');
		$br->setUpdateGrid('gridGrupos');
		$br->send();
		
		Session_Control::setDataSession('formUsersEdit', '');
	}

	public function btnexcluirclickAction(){
		Grid_Control::deleteDataGrid('Usuario', '', array('gridUsers', 'gridGrupos'));
	}

	public function btncancelarclickAction(){
		$br = new Browser_Control;
		$br->setRemoveWindow('EditUsers');
		$br->send();
	}

	public function gridusersdblclickAction(){
		$this->edit('user');
	}

	public function gridgruposdblclickAction(){
		$this->edit('grupo');
	}

	public function btnlimparfiltrosclickAction(){
		$br = new Browser_Control();
		$br->addFieldValue('ativoFiltro', 'S');
		$br->addFieldValue('loginUserFiltro', '');
		$br->addFieldValue('nomeCompletoFiltro', '');
		$br->setDataForm();
		$br->setUpdateGrid('gridUsers');
		$br->setUpdateGrid('gridGrupos');
		$br->send();
	}

	public function listausersAction($tipo = 'user'){
		$post = Zend_Registry::get('post');

		$users  = new Usuario();
		$users->where('ativo', $post->ativoFiltro);
		if($post->loginUserFiltro != ''){
			$users->where('loginuser', $post->loginUserFiltro, 'ilike');
		}
		if($post->nomeCompletoFiltro != ''){
			$users->where('nomecompleto', $post->nomeCompletoFiltro, 'ilike');
		}
		$users->where('editavel', cTRUE);
		$users->where('tipo', $tipo);
		Grid_Control::setDataGrid($users);
	}

	public function listagruposAction(){
		$this->listausersAction('grupo');
	}

	public function usersAction(){
		$this->gridsAction('user');
	}

	public function gruposAction(){
		$this->gridsAction('grupo');
	}

	public function btntrocasenhaclickAction(){
		$post = Zend_Registry::get('post');

		$user = new Usuario;
		if ($post->id !='') {
			$user->read($post->id);
		}
		if ($post->senhaCrip != ''){
			$user->setSenhaAtual($user->getCriptPass($post->senhaCrip));
		}
		$user->save();

		$br = new Browser_Control();
		$br->setRemove('EditUsers');
		$br->setUpdateGrid('gridUsers');
		$br->send();
	}

	public function grupochangeAction(){
		$user = Usuario::getInstance('userEdit');
		if($user->getId() != ''){
			$id = $user->getId();
		}else{
			$id = '';
		}

		$post = Zend_Registry::get('post');
		$br = new Browser_Control();

		$permissao = new Permissao;
		$user->permissoesLst = $permissao->getPermissoes($id, $post->controlValue);

		Session_Control::setDataSession('userEdit', $user);

		$br->setUpdateGrid('gridPermissao');
		$br->send();
	}
}