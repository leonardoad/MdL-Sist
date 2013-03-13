<?php
class ProcessoController extends Zend_Controller_Action{
	public function init(){
		Browser_Control::setScript('js', 'Easydrag', 'easydrag.js');
		Browser_Control::setScript('css', 'Window', 'Window/Window.css');
	}
	public function indexAction(){

		$form = new Ui_Form();
		$form->setName('formProcessos');
		$form->setAction('Processo');

		// Grid dos processos
		$grid = new Ui_Element_Grid('processos');
		$grid->setParams('Processos', 'listaProcessos');

		$element = new Ui_Element_Grid_Button('btnNovo', 'Inserir');
		$element->setImg('Buttons/Novo.png');
		$element->setVisible('PROC_CAD_PROCESSOS', 'inserir');
		$grid->addButton($element);


		$element = new Ui_Element_Grid_Button('btnExcluir', 'Excluir');
		$element->setImg('Buttons/Cancelar.png');
		$element->setAttribs('msg = "Excluir o item selecionado ?"');
		$element->setVisible('PROC_CAD_PROCESSOS', 'excluir');
		$element->setSendFormFields('sendFormFields', '1');
		$grid->addButton($element);

		$column = new Ui_Element_Grid_Column_Check('ID', 'oid_processo', '30', 'center');
		$grid->addColumn($column);

		$column = new Ui_Element_Grid_Column_Text('Nome', 'nome', '110');
		$grid->addColumn($column);

		$column = new Ui_Element_Grid_Column_Text('Descricao', 'descricao', '190');
		$grid->addColumn($column);
		
		$form->addElement($grid);

		$view = Zend_Registry::get('view');

		$view->assign('scripts', Browser_Control::getScripts());
		$view->assign('body', $form->displayTpl($view, 'Processos/index.tpl'));
		$view->output('index.tpl');
	}
	public function btnexcluirclickAction(){
		Browser_Control::deleteDataGrid('Processos', 'processos');
	}
	public function listaprocessosAction(){
		Browser_Control::setDataGrid('Processos');
	}
	public function btnnovoclickAction(){
		$this->edit();
	}
	public function processosdblclickAction(){
		$this->edit();
	}
	public function btnsalvarclickAction(){
		
		$post = Zend_Registry::get('post');

		$obj = new Processo();
		if(isset($post->id)){
			$obj->read($post->id);
		}

		$obj->setDataFromRequest($post);

		$obj->save();

		$br = new Browser_Control();
		$br->setRemoveWindow('editProcesso');
		$br->setUpdateGrid('gridProcesso');
		$br->send();
	}
	public function edit(){
		$post = Zend_Registry::get('post');

		$nomeProcesso = '';
		$descricaoProcesso = '';

		$processos = new Processo();
		if(isset($post->id)){
			$processo = $processos->getProcesso($post->id);
			$nomeProcesso = $processo[0]['nome'];
			$descricaoProcesso = $processo[0]['descricao'];
		}

		$br = new Browser_Control();
		$form = new Ui_Form();
		$form->setAction('.');
		$form->setName('formUpdateProcesso');

		// Campo nome
		$nome = new Ui_Element_Text('nomeProcesso');
		$nome->setValue($nomeProcesso);
		$nome->setAttrib('maxlength', '20');
		$form->addElement($nome);

		// Campo Descricao
		$descricao = new Ui_Element_Text('descricaoProcesso');
		$descricao->setValue($descricaoProcesso);
		$descricao->setAttrib('maxlength', '30');
		$form->addElement($descricao);

		// Botao Salvar
		$btnsalvar = new Ui_Element_Button('btnSalvar');
		$btnsalvar->setLabel('Salvar');
		if($post->id != ''){
			$btnsalvar->setAttrib('params', 'id='.$post->id);
		}
		$btnsalvar->setAttrib('sendFormFields', '1');
		$btnsalvar->setVisible('PROC_CAD_PROCESSOS', 'inserir');
		$form->addElement($btnsalvar);

		// Botao Cancelar
		$btncancelar = new Ui_Element_Button('btnCancelar');
		$btncancelar->setLabel('Cancelar');
		$form->addElement($btncancelar);

		$view = Zend_Registry::get('view');
		$html = $form->displayTpl($view, 'Processos/edit.tpl');

		$br->newWindow('EditProcessos', 'Edição de processos', '500', '300', $html);
		$br->send();
	}
	public function btncancelarclickAction(){
		$br = new Browser_Control();
		$br->setRemove('EditProcessos');
		$br->send();
	}
}