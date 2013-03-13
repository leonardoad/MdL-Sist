<?php
class AlbumController extends Zend_Controller_Action{
	public function init(){

		Browser_Control::setScript('js', 'Upload', 'Upload/Upload.js');
		Browser_Control::setScript('js', 'SwfUpload', 'Upload/Swfobject.js');
		Browser_Control::setScript('css', 'Upload', 'Upload/Upload.css');

		Browser_Control::setScript('js', 'Sortable', 'Sortable/Sortable.js');

	}


	public function indexAction(){

		$view = Zend_Registry::get('view');
		$view->assign('albuns', Album::montaAlbum('', true));
		$view->output('Albuns/web.tpl');

	}

	public function mostrararquivosclickAction(){
		$post = Zend_Registry::get('post');

		Session_Control::setDataSession('album', $post->album);

		$br = new Browser_Control();
		$br->setBrowserUrl('./arquivos/mostrarArquivos');
		$br->send();
	}

	public function albunsAction(){
		$form = new Ui_Form();
		$form->setName('albuns');
		$form->setAttrib('id', 'albuns');
		$form->setAction('Album');

		$element = new Ui_Element_Checkbox('listaalbuns');
		$element->setAttrib('event', 'click');
		$element->setAttrib('sendFormFields', '1');
		$element->setCheckedValue('S');
		$element->setUncheckedValue('N');
		$form->addElement($element);

//		$element = new Ui_Element_Btn('btnnovo');
//		$element->setDisplay('Nova pasta', PATH_IMAGES.'Buttons/Novo.png');
//		$element->setVisible('PROC_CAD_ARQUIVOS', 'inserir');
//		$form->addElement($element);

		$view = Zend_Registry::get('view');
//		$view->assign('editar', Usuario::verificaAcesso('PROC_CAD_ARQUIVOS', 'editar'));
//		$view->assign('excluir', Usuario::verificaAcesso('PROC_CAD_ARQUIVOS', 'excluir'));

		$view->assign('scripts', Browser_Control::getScripts());
		$view->assign('albuns',  Album::montaAlbum());
		$view->assign('body', $form->displayTpl($view, 'Albuns/index.tpl'));
		$view->output('index.tpl');

	}

//	public function arquivosAction(){
//
//		$form = new Ui_Form();
//		$form->setName('albuns');
//		$form->setAttrib('id', 'albuns');
//		$form->setAction('.');
//
//		$grid = new Ui_Grid_Flexigrid('gridAlbuns', 'Usúarios', 'listaAlbuns');
//
//		$button = new Ui_Grid_Button();
//		$button->setDisplay('btnnovo', 'Inserir');
//		$button->setImg('Buttons/Novo.png');
//		$button->setVisible('CAD_PASTAS', 'inserir');
//		$grid->addButton($button);
//
//
//		$button = new Ui_Grid_Button();
//		$button->setDisplay('exluiralbum', 'Excluir');
//		$button->setImg('Buttons/Cancelar.png');
//		$button->setAttribs('msg = "Excluir o item selecionado ?"');
//		$button->setVisible('CAD_PASTAS', 'excluir');
//		$button->setSendFormFields();
//		$grid->addButton($button);
//
//		// Checkbox
//		$column = new Ui_Grid_Column_Check();
//		$column->setDisplay('ID', 'oid_album', '30', 'center');
//		$grid->addColumn($column);
//
//		// Nome
//		$column = new Ui_Grid_Column_Text();
//		$column->setDisplay('Nome', 'titulo', '300');
//		$grid->addColumn($column);
//
//		$view = Zend_Registry::get('view');
//		$view->assign('scripts', Browser_Control::getScripts());
//		$view->assign('grid', $grid->render());
//		$view->assign('body', $form->displayTpl($view, 'Albuns/arquivos.tpl'));
//		$view->output('index.tpl');
//
//	}

	public function edit(){

		$post = Zend_Registry::get('post');

		$form = new Ui_Form();
		$form->setName('albunsEdit');
		$form->setAttrib('id', 'albunsEdit');
		$form->setAction('./Album');


		//		$element = new Ui_Element_Checkbox('ativo');
		//		$element->setCheckedValue('S');
		//		$element->setUncheckedValue('N');
		//		$form->addElement($element);

		$element = new Ui_Element_Text('titulo');
//		$element->setAttrib('obrig', 'obrig');
		$element->setAttrib('size', '50');
		$element->setAttrib('maxlength', '40');
		$form->addElement($element);

		//		$element = new Ui_Element_Textarea('descricao');
		//		$element->setAttrib('cols', '50');
		//		$element->setAttrib('rows', '5');
		//		$element->setAttrib('maxlength', '300');
		//		$form->addElement($element);

		$element = new Ui_Element_Btn('btnSalvar');
		$element->setDisplay('Salvar', PATH_IMAGES.'Buttons/Ok.png');
		$element->setAttrib('validaObrig', 'true');
		$element->setAttrib('sendFormFields', '1');
		$element->setAttrib('params','album='.$post->album);
		$form->addElement($element);

		$element = new Ui_Element_Btn('btnCancelar');
		$element->setDisplay('Cancelar', PATH_IMAGES.'Buttons/Cancelar.png');
		$form->addElement($element);

		$item = new Album;
		$item->a_ativo = 'S';
		if($post->album != ''){
			$item->read($post->album);
		}

		$form->setDataForm($item);

		$view = Zend_Registry::get('view');
		$html = $form->displayTpl($view, 'Albuns/edit.tpl');
		$br = new Browser_Control();
                $view = Zend_Registry::get('view');
		
                
                $w = new Ui_Window('EditAlbum', 'Novo Album', $html);
		$w->setDimension('505', '220');
		$w->setCloseOnEscape('true');
                
		$br->newWindow($w);
		$br->send();
	}

	public function btnsalvarclickAction(){

		$post = Zend_Registry::get('post');

		$item = new Album();

		if($post->album){
			$item->read($post->album);
		}

		$item->setDataFromRequest($post);

		$item->save();

		$br = new Browser_Control();
		$br->setRemove('EditAlbum');
		//		$br->setUpdateGrid('gridAlbuns');
		$br->setHtml('listaAlbuns', Album::montaAlbum(Session_Control::getDataSession('mostraTodosAlbuns')));
		$br->send();
	}

	public function exluiralbumclickAction(){

		$post = Zend_Registry::get('post');
		$album = new Album();
		$album->read($post->album);
		$album->setDeleted();
		$album->save();
		$arquivo = new Arquivo();
		$arquivo->where('id_owner', $album->getID());
		$arquivo->readLst();

		for($j = 0; $j < $arquivo->countItens(); $j++){
			$arq = $arquivo->getItem($j);
			$arq->excluir();
		}

		$br = new Browser_Control();
		//		$br->setUpdateGrid('gridAlbuns');
		$br->setHtml('listaAlbuns', Album::montaAlbum(Session_Control::getDataSession('mostraTodosAlbuns')));
		$br->send();
	}

	public function listaalbunsclickAction(){

		$post = Zend_Registry::get('post');

		if($post->listaalbuns == 'S'){
			$albuns = Album::montaAlbum('true');
		}else{
			$albuns = Album::montaAlbum();
		}

		$br = new Browser_Control();
		$br->setHtml('listaAlbuns', $albuns);
		$br->send();

	}

	public function listaalbunsAction(){
		Browser_Control::setDataGrid('Albuns', 'gridAlbuns');
	}

	public function btnnovoclickAction(){
		$this->edit();
	}

	public function editaralbumclickAction(){
		$this->edit();
	}
	public function gridalbunsdblclickAction(){
		$this->edit();
	}

	public function albunsordemchangeAction(){
		$post = Zend_Registry::get('post');

		$array = explode(',', $post->ordem);
                
		for($i = 1; $i <= count($array); $i++){
			$album = new Album();
			$album->read($array[$i - 1]);
			$album->a_ordem = $i; 
			$album->save();
		}
		return;
	}

	public function btncancelarclickAction(){
		$br = new Browser_Control();
		$br->setRemove('EditAlbum');
		$br->send();
	}
}