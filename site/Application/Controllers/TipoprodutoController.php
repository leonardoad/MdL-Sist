<?php
class TipoprodutoController extends Zend_Controller_Action{

	public function init(){
		Browser_Control::setScript('js', 'Mask', 'Mask/Mask.js');
	}
	public function indexAction(){
		$form = new Ui_Form();
		$form->setName('formTipoproduto');
		$form->setAction('Tipoproduto');

                $grid = new Ui_Element_Grid('gridTipoprodutos');
		$grid->setParams('Tipoproduto', 'Tipoproduto/listatipoproduto');
//		$grid->setOrder('Nome');

		$button = new Ui_Element_Grid_Button('btnNovo', 'Inserir');
		$button->setImg('Buttons/Novo.png');
		$button->setVisible('CAD_EMPRESA', 'inserir');
		$grid->addButton($button);

		$button = new Ui_Element_Grid_Button('btnExcluir', 'Excluir');
		$button->setImg('Buttons/Cancelar.png');
		$button->setAttribs('msg = "Excluir o item selecionado ?"');
		$button->setVisible('CAD_EMPRESA', 'excluir');
		$button->setSendFormFields();
		$grid->addButton($button);

		$column = new Ui_Element_Grid_Column_Check('ID', 'id_tipoproduto', '30', 'center');
		$grid->addColumn($column);
 
		$column = new Ui_Element_Grid_Column_Text('Descricao', 'descricao', '200');
		$grid->addColumn($column);
 
                
		$form->addElement($grid);

		$view = Zend_Registry::get('view');

		$view->assign('scripts', Browser_Control::getScripts());
		$view->assign('body', $form->displayTpl($view, 'Tipoproduto/index.tpl'));
		$view->output('index.tpl');
	}

	public function edit(){
		$post = Zend_Registry::get('post');

		$form = new Ui_Form();
		$form->setAction('Tipoproduto');
		$form->setName('formTipoprodutoEdit');

		$element = new Ui_Element_Text('descricao');
		$element->setAttrib('obrig', 'obrig');
		$element->setRequired();
		$element->setAttrib('size', '50');
		$form->addElement($element);

		$obj= new Tipoproduto();
		if(isset($post->id)){
			$obj->read($post->id);
                        $obj->setInstance('tipoprodutoEdit');
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

		$w = new Ui_Window('EditTipoproduto', 'Edição de Categoria de Produto', $form->displayTpl($view, 'Tipoproduto/edit.tpl'), true);
		$w->setDimension('600', '100');
		$br = new Browser_Control();
		$br->newWindow($w);
		$br->send();
	}

	public function btnnovoclickAction(){
		$this->edit();
	}

	public function btnsalvarclickAction(){
		$form = Session_Control::getDataSession('formTipoprodutoEdit');

		$valid = $form->processAjax($_POST);

		$br = new Browser_Control();
		if($valid != 'true'){
			$br->validaForm($valid);
			$br->send();
			exit;
		}

		$post = Zend_Registry::get('post');

		$obj = new Tipoproduto();
		if(isset($post->id)){
			$obj->read($post->id);
		}
		$obj->setDataFromRequest($post);
		$obj->save();

		$br->setRemoveWindow('EditTipoproduto');
		$br->setUpdateGrid('gridTipoprodutos');
		$br->send();
		
		Session_Control::setDataSession('formTipoprodutoEdit', '');
	}

	public function btnexcluirclickAction(){
		Grid_Control::deleteDataGrid('Tipoproduto', '','gridTipoproduto');
	}

	public function btncancelarclickAction(){
		$br = new Browser_Control;
		$br->setRemoveWindow('EditTipoproduto');
		$br->send();
	}

	public function gridtipoprodutosdblclickAction(){
		$this->edit();
	}
	public function listaimagensAction(){
                $Tipoproduto = Session_Control::getDataSession('produtoEdit');
		$arquivos = new Arquivo();
		$arquivos->where('id_owner', $Tipoproduto->getID());
                
		Grid_Control::setDataGrid($arquivos);
	}
	public function listatipoprodutoAction(){
		$obj = new Tipoproduto();
		Grid_Control::setDataGrid($obj);
	}
}